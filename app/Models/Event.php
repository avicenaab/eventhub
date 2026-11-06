<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function pendaftarans()
{
    return $this->hasMany(Pendaftaran::class);
}
}
