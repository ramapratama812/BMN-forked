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

    // Filter berdasarkan aksi
    if ($request->filled('aksi')) {
        $query->where('aksi', $request->aksi);
    }

    // Filter berdasarkan modul
    if ($request->filled('modul')) {
        $query->where('modul', $request->modul);
    }

    // Pencarian
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('deskripsi', 'like', "%{$search}%")
              ->orWhere('modul', 'like', "%{$search}%")
              ->orWhere('aksi', 'like', "%{$search}%")
              ->orWhereHas('user', function ($userQuery) use ($search) {
                  $userQuery->where('kode_user', 'like', "%{$search}%");
              });
        });
    }

    $logs = $query->paginate(10)->withQueryString();

    $totalAktivitas = ActivityLog::count();

    $totalModul = ActivityLog::distinct('modul')
        ->count('modul');

    $moduls = ActivityLog::select('modul')
        ->distinct()
        ->orderBy('modul')
        ->pluck('modul');

    return view('admin.log-aktivitas.index', compact(
    'logs',
    'totalAktivitas',
    'totalModul',
    'moduls'
));
}
}
