<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        Pendaftaran::create([
            'tanggal_daftar' => '2026-11-01',
            'peserta_id' => 1,
            'event_id' => 1,
            'status_pendaftaran' => 'diterima',
            'status_pembayaran' => 'sudah_bayar',
        ]);

        Pendaftaran::create([
            'tanggal_daftar' => '2026-11-02',
            'peserta_id' => 2,
            'event_id' => 1,
            'status_pendaftaran' => 'menunggu',
            'status_pembayaran' => 'belum_bayar',
        ]);

        Pendaftaran::create([
            'tanggal_daftar' => '2026-11-03',
            'peserta_id' => 1,
            'event_id' => 2,
            'status_pendaftaran' => 'diterima',
            'status_pembayaran' => 'sudah_bayar',
        ]);
    }
}