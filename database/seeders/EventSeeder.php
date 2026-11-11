<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'nama_event' => 'IT Fest',
            'deskripsi' => 'Festival teknologi dan informasi',
            'tanggal_mulai' => '2026-12-01',
            'tanggal_selesai' => '2026-12-02',
            'lokasi' => 'IPB University',
            'kuota' => 100,
            'biaya' => 50000,
            'status_event' => 'berlangsung',
        ]);
    }
}