<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Helpers\ActivityLogger;
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

        // Pencarian berdasarkan deskripsi, modul, atau pengguna
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('deskripsi', 'like', "%{$search}%")
                    ->orWhere('modul', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where(
                            'kode_user',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('admin.log_aktivitas.index', [
            'logs' => $logs,
            'title' => 'Log Aktivitas',
        ]);
    }
}