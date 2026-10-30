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

        return view('user.inventaris.lapor_kerusakan', compact('barang', 'jenis_kerusakan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'jenis_kerusakan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|array',
            'foto.*' => 'image|max:4096'
        ]);

        $fotoPath = null;
        $savedPaths = [];

        if ($request->hasFile('foto')) {
            $inputFotos = $request->file('foto');
            if (!is_array($inputFotos)) {
                $inputFotos = [$inputFotos];
            }

            foreach ($inputFotos as $index => $f) {
                $path = $f->store('laporan/kerusakan', 'public');
                $savedPaths[] = $path;

                if ($index === 0) {
                    $fotoPath = $path;
                }
            }
        }

        $laporan = LaporanKerusakan::create([
            'barang_id' => $request->barang_id,
            'user_id' => Auth::id(),
            'jenis_kerusakan' => $request->jenis_kerusakan,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'status' => 'pending',
        ]);

        foreach ($savedPaths as $path) {
            \App\Models\LaporanKerusakanFoto::create([
                'laporan_kerusakan_id' => $laporan->id,
                'foto' => $path
            ]);
        }

        return redirect()->route('user.inventaris.detail', [
                'id' => $request->barang_id,
                'from' => $request->from // Mengembalikan parameter from ke URL
            ])
            ->with('success', 'Laporan telah dikirim, menunggu verifikasi admin.');
    }
}
