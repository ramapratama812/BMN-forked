<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKerusakanFoto extends Model
{
    protected $table = 'laporan_kerusakan_fotos';

    protected $fillable = [
        'laporan_kerusakan_id',
        'foto',
    ];

    public function laporanKerusakan()
    {
        return $this->belongsTo(LaporanKerusakan::class, 'laporan_kerusakan_id');
    }
}
