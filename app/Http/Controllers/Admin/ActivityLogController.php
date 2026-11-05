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

        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }

        if ($request->filled('modul')) {
            $query->where('modul', $request->modul);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('deskripsi', 'like', "%{$search}%")
                    ->orWhere('modul', 'like', "%{$search}%")
                    ->orWhere('aksi', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('admin.log-aktivitas.index', [
            'logs' => $logs,
            'title' => 'Log Aktivitas',
        ]);
    }
}
