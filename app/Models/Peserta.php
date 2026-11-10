<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;

class Peserta extends Model
{
    // Menentukan nama tabel secara spesifik
    protected $table = 'pesertas';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'instansi',
    ];

    // Relasi: Satu peserta bisa memiliki banyak pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}