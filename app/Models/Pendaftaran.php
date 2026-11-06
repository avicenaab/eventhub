<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'tanggal_daftar',
        'peserta_id',
        'event_id',
        'status_pendaftaran',
        'status_pembayaran',
    ];
}