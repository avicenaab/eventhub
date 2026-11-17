<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peserta;
use App\Models\Event;
use App\Models\Presensi;

class Pendaftaran extends Model
{
    protected $fillable = [
        'public_token',
        'attendance_code',
        'tanggal_daftar',
        'peserta_id',
        'event_id',
        'status_pendaftaran',
        'status_pembayaran',
    ];

    // Relasi ke tabel Pesertas
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    // Relasi ke tabel Events
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relasi ke tabel Presensis
    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }
}