<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';

public function pendaftarans()
{
    return $this->hasMany(Pendaftaran::class);
}
}
