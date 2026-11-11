<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Presensi;

class PresensiSeeder extends Seeder
{
    public function run(): void
    {
        Presensi::create([
            'pendaftaran_id' => 4,
            'waktu_hadir' => '2026-12-01 08:00:00',
            'status_kehadiran' => 'hadir',
        ]);

        Presensi::create([
            'pendaftaran_id' => 5,
            'waktu_hadir' => null,
            'status_kehadiran' => 'belum_hadir',
        ]);
    }
}