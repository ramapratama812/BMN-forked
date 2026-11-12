<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // Pencarian
        if ($request->filled('search')) {
            $search = trim($request->search);
            $keyword = strtolower($search);

            $variasiAksi = [];

            if (in_array($keyword, ['tambah', 'menambahkan', 'ditambahkan', 'ditambah'])) {
                $variasiAksi = ['Tambah', 'Menambahkan', 'Ditambahkan'];
            } elseif (in_array($keyword, ['edit', 'mengubah', 'diubah', 'diedit'])) {
                $variasiAksi = ['Edit', 'Mengubah', 'Diubah'];
            } elseif (in_array($keyword, ['hapus', 'menghapus', 'dihapus'])) {
                $variasiAksi = ['Hapus', 'Menghapus', 'Dihapus'];
            }

            $query->where(function ($q) use ($search, $variasiAksi) {
                $q->where('deskripsi', 'LIKE', "%{$search}%")
                  ->orWhere('modul', 'LIKE', "%{$search}%")
                  ->orWhere('aksi', 'LIKE', "%{$search}%");

                if (!empty($variasiAksi)) {
                    $q->orWhereIn('aksi', $variasiAksi);
                }

                $q->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('kode_user', 'LIKE', "%{$search}%")
                              ->orWhere('nama_lengkap', 'LIKE', "%{$search}%");
                });
            });
        }

        // Filter aktivitas
        if ($request->filled('aksi')) {
            $aksi = [
                'Menambahkan' => ['Menambahkan', 'Tambah', 'Ditambahkan'],
                'Mengubah'    => ['Mengubah', 'Edit', 'Diubah'],
                'Menghapus'   => ['Menghapus', 'Hapus', 'Dihapus'],
                'Tambah'      => ['Menambahkan', 'Tambah', 'Ditambahkan'],
                'Edit'        => ['Mengubah', 'Edit', 'Diubah'],
                'Hapus'       => ['Menghapus', 'Hapus', 'Dihapus'],
            ];

            if (isset($aksi[$request->aksi])) {
                $query->whereIn('aksi', $aksi[$request->aksi]);
            } else {
                $query->where('aksi', $request->aksi);
            }
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('admin.log-aktivitas.index', [
            'logs' => $logs,
            'title' => 'Log Aktivitas',
        ]);
    }
}
