<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerawatanInventaris;
use App\Models\BmnBarang;
use App\Models\Barang;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PerawatanInventarisController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil ID barang yang sudah ditarik ke daftar Rencana Penghapusan
        $barangDihapusIds = PerawatanInventaris::where('jenis_perawatan', 'rencana_penghapusan')
            ->pluck('barang_id');

        // 2. Filter query utama agar barang yang mau dihapus hilang dari antrean
        $query = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'perbaikan')
            ->where('status', '!=', 'selesai')
            ->whereNotIn('barang_id', $barangDihapusIds); // <-- Tambahkan logika ini

        // (Opsional) Jika Anda ingin filter di view tetap berfungsi untuk 'search'
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->latest()->get();

        $title = "Perawatan Inventaris";
        return view('admin.perawatan_inventaris.index', compact('data', 'title'));
    }

    public function detail($id)
    {
        $data = PerawatanInventaris::with(['barang', 'user'])->findOrFail($id);
        $title = "Detail Perbaikan Barang";

        return view('admin.perawatan_inventaris.detail', compact('data', 'title'));
    }

    private function cekBarangSudahDiproses($barang_id)
    {
        return PerawatanInventaris::where('barang_id', $barang_id)
            ->whereIn('status', ['pending','proses']) // belum selesai
            ->exists();
    }

    public function storeFromBarang($barang_id)
    {
        if ($this->cekBarangSudahDiproses($barang_id) || \App\Models\LaporanKerusakan::where('barang_id', $barang_id)->whereIn('status', ['pending', 'disetujui'])->exists()) {
            return back()->with('error', 'Barang ini sudah masuk proses perawatan atau sedang di antrean teknisi!');
        }

        PerawatanInventaris::create([
            'uuid' => Str::uuid(),
            'barang_id' => $barang_id,
            'tanggal_perawatan' => now(),
            'jenis_perawatan' => 'perbaikan',
            'status' => 'pending', // Pending agar menunggu admin menulis keluhan
        ]);

        return redirect()->route('perawatan_inventaris.index')->with('success', 'Barang dialihkan ke daftar antrean. Silahkan Tulis Keluhan.');
    }

    public function perbaikiForm($id)
    {
        $data = PerawatanInventaris::with('barang')->findOrFail($id);
        $title = "Mulai / Edit Perbaikan";
        return view('admin.perawatan_inventaris.perbaiki', compact('data', 'title'));
    }

    public function perbaikiSubmit(Request $request, $id)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'foto'    => 'nullable|array',
            'foto.*'  => 'image|mimes:jpg,jpeg,png|max:4096'
        ]);

        $p = PerawatanInventaris::findOrFail($id);

        $fotoPath = null;
        $savedPaths = [];

        if ($request->hasFile('foto')) {
            $inputFotos = $request->file('foto');
            if (!is_array($inputFotos)) {
                $inputFotos = [$inputFotos];
            }

            foreach ($inputFotos as $index => $f) {
                $path = $f->store('laporan_kerusakan', 'public');
                $savedPaths[] = $path;

                if ($index === 0) {
                    $fotoPath = $path;
                }
            }
        }

        $laporan = \App\Models\LaporanKerusakan::create([
            'uuid'            => \Illuminate\Support\Str::uuid(),
            'barang_id'       => $p->barang_id,
            'user_id'         => Auth::id(), // Admin yang melapor
            'jenis_kerusakan' => 'Maintenance',
            'deskripsi'       => $request->keluhan,
            'foto'            => $fotoPath, // Simpan path foto ke database
            'status'          => 'disetujui'
        ]);

        foreach ($savedPaths as $path) {
            \App\Models\LaporanKerusakanFoto::create([
                'laporan_kerusakan_id' => $laporan->id,
                'foto' => $path
            ]);
        }

        // Hapus status dari PerawatanInventaris (akan dibuat ulang oleh Teknisi saat memproses)
        $p->delete();

        return redirect()->route('perawatan_inventaris.index')
                        ->with('success', 'Keluhan berhasil disimpan dan telah dikirim ke halaman Teknisi.');
    }

    public function perbaiki($id)
    {
        $p = PerawatanInventaris::findOrFail($id);
        $p->update(['status' => 'proses']);

        return back()->with('success', 'Barang mulai diperbaiki.');
    }

    public function hapuskan($id)
    {
        $item = PerawatanInventaris::with('barang')->findOrFail($id);
        $barang_id = $item->barang_id;

        // Cek duplicate rencana_penghapusan
        $cek = PerawatanInventaris::where('barang_id', $barang_id)
            ->where('jenis_perawatan', 'rencana_penghapusan')
            ->whereIn('status', ['pending', 'proses'])
            ->first();

        if ($cek) {
            return back()->with('error', 'Barang ini sudah ada dalam rencana penghapusan!');
        }

        if (!in_array($item->status, ['diperbaiki', 'tidak_dapat_diperbaiki'])) {
            $item->delete();
        }

        PerawatanInventaris::create([
            'uuid' => Str::uuid(),
            'barang_id' => $barang_id,
            'tanggal_perawatan' => now(),
            'jenis_perawatan' => 'rencana_penghapusan',
            'status' => 'pending',
        ]);

        return redirect()->route('rencana_penghapusan.index')
                        ->with('success', 'Barang berhasil masuk ke Data Penghapusan.');
    }

    public function verifikasiSelesai($id)
    {
        $p = PerawatanInventaris::with('barang')->findOrFail($id);

        // 1. Idempoten: jika sudah berstatus selesai, jangan proses ulang atau gandakan mutasi
        if ($p->status === 'selesai') {
            return redirect()->route('perawatan_inventaris.index')
                ->with('info', 'Perawatan inventaris ini sudah diverifikasi selesai sebelumnya.');
        }

        // 2. Jangan aktifkan kembali barang jika status pekerjaan teknisi 'tidak_dapat_diperbaiki'
        if ($p->status === 'tidak_dapat_diperbaiki') {
            $p->update(['status' => 'selesai']);

            return redirect()->route('perawatan_inventaris.index')
                ->with('warning', 'Perawatan diselesaikan. Barang tetap berstatus rusak karena tidak dapat diperbaiki.');
        }

        // 3. Pastikan status hasil pekerjaan teknisi memang 'diperbaiki' (atau 'proses' jika diverifikasi langsung)
        if (!in_array($p->status, ['diperbaiki', 'proses'])) {
            return redirect()->route('perawatan_inventaris.index')
                ->with('error', 'Perawatan belum dapat diverifikasi selesai karena status perbaikan belum siap.');
        }

        DB::beginTransaction();
        try {
            // Update status perawatan menjadi 'selesai'
            $p->update(['status' => 'selesai']);

            // Pulihkan kondisi BMN Barang
            $bmnItem = $p->barang ?: BmnBarang::find($p->barang_id);

            if ($bmnItem) {
                $bmnItem->update([
                    'kondisi' => 'Baik',
                    'persentase_kondisi' => 100,
                ]);

                // Sinkronkan ke tabel operasional peminjaman (Barang)
                $barang = Barang::where('kode_barang', $bmnItem->kode_barang)->first();
                if ($barang) {
                    $activeLoansCount = DetailPeminjaman::where('kode_barang', $bmnItem->kode_barang)
                        ->whereHas('peminjaman', function ($q) {
                            $q->where('status', 'Proses');
                        })
                        ->count();

                    $maxLimit = !is_null($barang->limit)
                        ? $barang->limit
                        : max(1, (int) ($bmnItem->jumlah ?: 1));

                    $sisaLimit = max(0, $maxLimit - $activeLoansCount);
                    $newStatus = ($sisaLimit > 0) ? 'tersedia' : 'tidak-tersedia';

                    $barang->update([
                        'status' => $newStatus,
                        'sisa_limit' => $sisaLimit,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('perawatan_inventaris.index')
                ->with('success', 'Perbaikan telah diverifikasi dan diselesaikan. Kondisi barang kini pulih dan layak digunakan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('perawatan_inventaris.index')
                ->with('error', 'Terjadi kesalahan saat memverifikasi penyelesaian: ' . $e->getMessage());
        }
    }
}
