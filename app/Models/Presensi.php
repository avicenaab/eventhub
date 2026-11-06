<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    public function pendaftaran()
{
    return $this->belongsTo(Pendaftaran::class);
}
}
