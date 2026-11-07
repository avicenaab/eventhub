<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensis';

    protected $fillable = [
        'pendaftaran_id',
        'waktu_hadir',
        'status_kehadiran',
    ];

    protected $casts = [
        'waktu_hadir' => 'datetime',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}