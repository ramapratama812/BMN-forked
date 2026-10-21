<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BmnBarang;
use App\Models\LaporanKerusakan;
use App\Models\BmnJenisKerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanKerusakanController extends Controller
{
    public function form($id)
    {
        $barang = BmnBarang::findOrFail($id);
        $jenis_kerusakan = BmnJenisKerusakan::all();

        return view(
            'user.inventaris.lapor_kerusakan',
            compact('barang', 'jenis_kerusakan')
        );
    }

    public function store(Request $request)
    {
        // Validasi data laporan dan file unggahan.
        $request->validate([
            'barang_id' => [
                'required',
                'exists:bmn_barangs,id',
            ],

            'jenis_kerusakan' => [
                'required',
            ],

            'deskripsi' => [
                'required',
                'string',
            ],

            // Foto opsional, hanya JPG/JPEG/PNG, maksimal 4 MB.
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:4096',
            ],

            // Dokumen pendukung opsional, maksimal 10 MB.
            'dokumen_bukti' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:10240',
            ],
        ], [
            'barang_id.required' =>
                'Barang wajib dipilih.',

            'barang_id.exists' =>
                'Barang yang dipilih tidak ditemukan.',

            'jenis_kerusakan.required' =>
                'Jenis kerusakan wajib dipilih.',

            'deskripsi.required' =>
                'Deskripsi kerusakan wajib diisi.',

            'foto.image' =>
                'File bukti harus berupa gambar yang valid.',

            'foto.mimes' =>
                'Format foto bukti harus JPG, JPEG, atau PNG.',

            'foto.max' =>
                'Ukuran foto bukti maksimal 4 MB.',

            'dokumen_bukti.file' =>
                'Dokumen pendukung tidak valid.',

            'dokumen_bukti.mimes' =>
                'Dokumen harus berformat PDF, DOC, atau DOCX.',

            'dokumen_bukti.max' =>
                'Ukuran dokumen pendukung maksimal 10 MB.',
        ]);

        $userId = Auth::id();
        $deskripsi = trim($request->deskripsi);

        // Cek laporan identik yang masih aktif.
        $duplikat = LaporanKerusakan::where(
                'barang_id',
                $request->barang_id
            )
            ->where('user_id', $userId)
            ->where('jenis_kerusakan', $request->jenis_kerusakan)
            ->where('deskripsi', $deskripsi)
            ->whereIn('status', ['pending', 'disetujui'])
            ->exists();

        // Batalkan jika laporan yang sama masih aktif.
        if ($duplikat) {
            return redirect()
                ->route('user.inventaris.detail', [
                    'id' => $request->barang_id,
                    'from' => $request->from,
                ])
                ->with(
                    'error',
                    'Laporan yang sama sudah ada dan masih dalam proses.'
                );
        }

        // Simpan foto jika lolos validasi.
        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')
                ->store('laporan/kerusakan', 'public');
        }

        // Simpan dokumen jika lolos validasi.
        $dokumenPath = null;

        if ($request->hasFile('dokumen_bukti')) {
            $dokumenPath = $request->file('dokumen_bukti')
                ->store('laporan/dokumen', 'public');
        }

        // Simpan laporan baru.
        LaporanKerusakan::create([
            'barang_id' => $request->barang_id,
            'user_id' => $userId,
            'jenis_kerusakan' => $request->jenis_kerusakan,
            'deskripsi' => $deskripsi,
            'foto' => $foto,
            'dokumen_bukti' => $dokumenPath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('user.inventaris.detail', [
                'id' => $request->barang_id,
                'from' => $request->from,
            ])
            ->with(
                'success',
                'Laporan telah dikirim, menunggu verifikasi admin.'
            );
    }
}