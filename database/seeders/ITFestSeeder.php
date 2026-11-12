<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use App\Models\Event;
use App\Models\Peserta;
use App\Models\Pendaftaran;
use App\Models\Presensi;

class ITFestSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // ==========================================
            // 1. DATA EVENT
            // ==========================================

            $event = Event::create([
                'nama_event' => 'IT Fest',
                'deskripsi' => 'Festival teknologi dan informasi yang menghadirkan berbagai kegiatan, kompetisi, dan inovasi teknologi.',
                'tanggal_mulai' => '2026-12-01',
                'tanggal_selesai' => '2026-12-02',
                'lokasi' => 'IPB University',
                'latitude' => null,
                'longitude' => null,
                'kuota' => 100,
                'biaya' => 50000,
                'status_event' => 'berlangsung',
            ]);

            // ==========================================
            // 2. DAFTAR 50 NAMA PESERTA
            // ==========================================

            $daftarNama = [
                'Andika Pratama',
                'Nabila Putri',
                'Fajar Ramadhan',
                'Alya Safitri',
                'Rizky Maulana',
                'Citra Maharani',
                'Dimas Saputra',
                'Salsa Aprilia',
                'Farhan Akbar',
                'Zahra Amelia',
                'Rafi Kurniawan',
                'Intan Permatasari',
                'Bagas Firmansyah',
                'Nadia Khairunnisa',
                'Rangga Aditya',
                'Putri Azzahra',
                'Arif Setiawan',
                'Tiara Anindya',
                'Ilham Fauzi',
                'Dewi Anggraini',
                'Reza Pahlevi',
                'Anisa Rahmawati',
                'Galih Prakoso',
                'Mutiara Salsabila',
                'Bima Arya',
                'Syifa Nurhaliza',
                'Kevin Alexander',
                'Aurel Maharani',
                'Yoga Pratama',
                'Vina Oktaviani',
                'Raka Alfarizi',
                'Nadya Febriani',
                'Aditia Nugraha',
                'Fitria Handayani',
                'Daffa Alghifari',
                'Bella Anastasya',
                'Hafiz Ramadhan',
                'Aisyah Humaira',
                'Rendi Kurnia',
                'Nisa Apriliani',
                'Ari Wibowo',
                'Larasati Putri',
                'Eko Prasetyo',
                'Shabrina Zahra',
                'Muhammad Iqbal',
                'Tasya Amelia',
                'Gilang Ramadhan',
                'Vania Kartika',
                'Rizal Firmansyah',
                'Nayla Azzahra',
            ];

            // ==========================================
            // 3. DISTRIBUSI STATUS PENDAFTARAN
            // ==========================================

            $statusPendaftaran = array_merge(
                array_fill(0, 35, 'diterima'),
                array_fill(0, 10, 'menunggu'),
                array_fill(0, 5, 'ditolak')
            );

            // ==========================================
            // 4. DISTRIBUSI STATUS KEHADIRAN
            // ==========================================

            $statusKehadiran = array_merge(
                array_fill(0, 23, 'hadir'),
                array_fill(0, 7, 'belum_hadir'),
                array_fill(0, 2, 'izin'),
                array_fill(0, 1, 'sakit'),
                array_fill(0, 2, 'alpa')
            );

            $indexPresensi = 0;

            // ==========================================
            // 5. MEMBUAT 50 PESERTA DAN PENDAFTARAN
            // ==========================================

            foreach ($daftarNama as $index => $nama) {

                $nomor = str_pad(
                    $index + 1,
                    3,
                    '0',
                    STR_PAD_LEFT
                );

                // Buat data peserta
                $peserta = Peserta::create([
                    'nama' => $nama,
                    'email' => "itfest{$nomor}@example.test",
                    'no_hp' => '0812' . str_pad(
                        $index + 1,
                        8,
                        '0',
                        STR_PAD_LEFT
                    ),
                    'instansi' => match (($index + 1) % 4) {
                        0 => 'Universitas Indonesia',
                        1 => 'IPB University',
                        2 => 'Universitas Brawijaya',
                        3 => 'Universitas Gadjah Mada',
                    },
                ]);

                // Ambil status pendaftaran
                $status = $statusPendaftaran[$index];

                // Buat public token
                $publicToken = (string) Str::uuid();

                // Buat attendance code unik
                do {
                    $attendanceCode = Str::upper(
                        Str::random(8)
                    );
                } while (
                    Pendaftaran::where(
                        'attendance_code',
                        $attendanceCode
                    )->exists()
                );

                // Buat pendaftaran
                $pendaftaran = Pendaftaran::create([
                    'public_token' => $publicToken,
                    'attendance_code' => $attendanceCode,
                    'tanggal_daftar' => Carbon::parse('2026-11-01')
                        ->addDays($index % 20),
                    'peserta_id' => $peserta->id,
                    'event_id' => $event->id,
                    'status_pendaftaran' => $status,
                    'status_pembayaran' => 'belum_bayar',
                ]);

                // ======================================
                // 6. PRESENSI KHUSUS PENDAFTARAN DITERIMA
                // ======================================

                if ($status === 'diterima') {

                    $kehadiran = $statusKehadiran[$indexPresensi];

                    $waktuHadir = null;

                    if ($kehadiran === 'hadir') {
                        $waktuHadir = Carbon::parse(
                            '2026-12-01 08:00:00'
                        )->addMinutes($indexPresensi * 5);
                    }

                    Presensi::create([
                        'pendaftaran_id' => $pendaftaran->id,
                        'waktu_hadir' => $waktuHadir,
                        'status_kehadiran' => $kehadiran,
                    ]);

                    $indexPresensi++;
                }
            }

            // ==========================================
            // 7. INFORMASI HASIL SEEDING
            // ==========================================

            $this->command->info('====================================');
            $this->command->info('IT FEST DUMMY DATA BERHASIL DIBUAT');
            $this->command->info('====================================');
            $this->command->info('Event       : 1');
            $this->command->info('Peserta     : 50');
            $this->command->info('Pendaftaran : 50');
            $this->command->info('Diterima    : 35');
            $this->command->info('Menunggu    : 10');
            $this->command->info('Ditolak     : 5');
            $this->command->info('Presensi    : 35');
            $this->command->info('====================================');
            $this->command->info('Hadir       : 23');
            $this->command->info('Belum Hadir : 7');
            $this->command->info('Izin        : 2');
            $this->command->info('Sakit       : 1');
            $this->command->info('Alpa        : 2');
            $this->command->info('====================================');
        });
    }
}