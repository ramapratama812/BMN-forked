<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class LaporanKerusakan extends Model
{
    protected $table = 'laporan_kerusakan';

    protected $fillable = [
        'uuid',
        'barang_id',
        'teknisi_id',
        'user_id',
        'jenis_kerusakan',
        'deskripsi',
        'foto',
        'dokumen_bukti',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function barang()
    {
        return $this->belongsTo(BmnBarang::class, 'barang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke teknisi
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
