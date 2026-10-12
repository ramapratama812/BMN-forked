<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatanInventarisFoto extends Model
{
    use HasFactory;

    protected $table = 'perawatan_inventaris_fotos';

    protected $fillable = [
        'perawatan_inventaris_id',
        'foto_bukti',
    ];

    public function perawatanInventaris()
    {
        return $this->belongsTo(PerawatanInventaris::class, 'perawatan_inventaris_id');
    }
}
