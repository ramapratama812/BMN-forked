<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PerawatanInventaris extends Model
{
    use HasFactory;

    protected $table = 'perawatan_inventaris';

    protected $fillable = [
        'uuid',
        'barang_id',
        'user_id',
        'tanggal_perawatan',
        'jenis_perawatan',
        'deskripsi',
        'status',
        'biaya',
        'foto_kerusakan',
        'foto_bukti',
        'dokumen_bukti',
        'surat_penghapusan'
    ];

    // UUID terisi otomatis saat data dibuat
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function barang()
    {
        return $this->belongsTo(BmnBarang::class, 'barang_id');
    }

    // Relasi perawatan dengan teknisi (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
