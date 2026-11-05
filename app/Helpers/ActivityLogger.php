<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function catat(
        string $aksi,
        string $modul,
        string $deskripsi
    ): void {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aksi' => $aksi,
            'modul' => $modul,
            'deskripsi' => $deskripsi,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
