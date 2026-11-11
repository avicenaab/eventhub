<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Event;

class TambahPendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $pesertas = Peserta::all();
        $events = Event::all();

        if ($pesertas->isEmpty() || $events->isEmpty()) {
            $this->command->error('Data peserta atau event masih kosong!');
            return;
        }

        $statusPendaftaran = ['menunggu', 'diterima', 'ditolak'];
        $statusPembayaran = ['belum_bayar', 'sudah_bayar'];

        for ($i = 0; $i < 50; $i++) {
            Pendaftaran::create([
                'tanggal_daftar' => now()
                    ->subDays(rand(0, 90))
                    ->format('Y-m-d'),

                'peserta_id' => $pesertas->random()->id,
                'event_id' => $events->random()->id,

                'status_pendaftaran' => $statusPendaftaran[array_rand($statusPendaftaran)],

                'status_pembayaran' => $statusPembayaran[array_rand($statusPembayaran)],
            ]);
        }

        $this->command->info('50 data pendaftaran berhasil ditambahkan!');
    }
}