<?php

namespace App\Models;

use App\Models\Peruntukan;
use App\Models\DetailPeminjaman;
use App\Models\DetailPengembalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
	use HasFactory;
	protected $table = 'peminjaman';
	protected $with = 'peruntukan';

	protected $fillable = [
		'uuid',
		'kode_peminjaman',
		'nomor_peminjaman',
		'peruntukan_id',
		'nomor_surat',
		'tanggal_penggunaan',
		'tanggal_peminjaman',
		'tanggal_kembali',
		'peminjam',
		'qr_code',
		'status'
	];

	public function peruntukan(): BelongsTo
	{
		return $this->belongsTo(Peruntukan::class, 'peruntukan_id', 'id');
	}

	public function pengembalian(): HasMany
	{
		return $this->hasMany(Pengembalian::class, 'kode_peminjaman', 'kode_peminjaman');
	}

	public function detailPeminjaman(): HasMany
	{
		return $this->hasMany(DetailPeminjaman::class, 'kode_peminjaman', 'kode_peminjaman');
	}

	/**
	 * Menghitung status riil transaksi peminjaman berdasarkan rincian pengembalian fisik barang.
	 * Aturan:
	 * - Masih Dipinjam: belum ada barang yang dikembalikan.
	 * - Dikembalikan Sebagian: sebagian barang telah dikembalikan, namun masih ada barang yang belum kembali.
	 * - Selesai: seluruh barang dalam transaksi sudah dikembalikan.
	 */
	public function getComputedStatusAttribute(): string
	{
		$totalPinjam = $this->detailPeminjaman ? $this->detailPeminjaman->count() : 0;
		if ($totalPinjam === 0) {
			return $this->status === 'Selesai' ? 'Selesai' : 'Masih Dipinjam';
		}

		$totalKembali = 0;
		if ($this->relationLoaded('pengembalian')) {
			$totalKembali = $this->pengembalian->flatMap(function ($p) {
				return $p->detailPengembalian;
			})->count();
		} else {
			$totalKembali = DetailPengembalian::whereHas('pengembalian', function ($q) {
				$q->where('kode_peminjaman', $this->kode_peminjaman);
			})->count();
		}

		if ($totalKembali === 0) {
			return 'Masih Dipinjam';
		}

		if ($totalKembali < $totalPinjam) {
			return 'Dikembalikan Sebagian';
		}

		return 'Selesai';
	}

	/**
	 * Peta pengembalian per kode barang untuk memudahkan pengecekan status individual barang.
	 */
	public function getReturnDetailsMapAttribute(): array
	{
		$map = [];
		$pengembalianList = $this->relationLoaded('pengembalian')
			? $this->pengembalian
			: $this->pengembalian()->with('detailPengembalian')->get();

		foreach ($pengembalianList as $pg) {
			if ($pg->detailPengembalian) {
				foreach ($pg->detailPengembalian as $detail) {
					$map[$detail->kode_barang] = [
						'tanggal_kembali' => $pg->tanggal_kembali,
						'status' => $detail->status,
						'deskripsi' => $detail->deskripsi,
						'kode_pengembalian' => $pg->kode_pengembalian,
					];
				}
			}
		}

		return $map;
	}
}
