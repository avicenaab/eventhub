<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class EventHubDummySeeder extends Seeder
{
    public function run(): void
    {
        // Contoh titik koordinat wilayah Jabodetabek / Bogor & sekitarnya untuk integrasi Maps
        $locations = [
            ['name' => 'Kampus IPB Dramaga, Bogor', 'lat' => -6.5599, 'lng' => 106.7267],
            ['name' => 'Botani Square & Sekitarnya, Bogor', 'lat' => -6.5971, 'lng' => 106.8060],
            ['name' => 'Stadion Pakansari, Cibinong', 'lat' => -6.4919, 'lng' => 106.8342],
            ['name' => 'Bekasi Cyber Park & Pusat Kota Bekasi', 'lat' => -6.2383, 'lng' => 106.9756],
            ['name' => 'JCC Senayan, Jakarta Pusat', 'lat' => -6.2133, 'lng' => 106.8076],
            ['name' => 'ICE BSD City, Tangerang', 'lat' => -6.3016, 'lng' => 106.6386],
        ];

        $topics = [
            'Tech & AI Summit', 'Cloud & DevOps Workshop', 'Cybersecurity Bootcamp',
            'UI/UX Design Sprint', 'Startup Pitch & Networking', 'Data Science Clinic',
            'IoT & Embedded Systems Lab', 'Digital Product Expo', 'Web Engineering Meetup',
            'Career & Portfolio Review'
        ];

        $now = now();
        $hasEventCoords = Schema::hasColumn('events', 'coordinates');
        $hasLat = Schema::hasColumn('events', 'latitude');
        $hasLng = Schema::hasColumn('events', 'longitude');

        DB::transaction(function () use ($locations, $topics, $now, $hasEventCoords, $hasLat, $hasLng) {
            for ($i = 1; $i <= 200; $i++) {
                $loc = $locations[$i % count($locations)];
                // Variasi kecil pada koordinat agar titik di peta tidak saling menumpuk persis
                $lat = round($loc['lat'] + ((($i % 10) - 5) * 0.0018), 6);
                $lng = round($loc['lng'] + ((($i % 7) - 3) * 0.0018), 6);

                // Distribusi: 1..60 Selesai, 61..100 Ongoing, 101..200 Akan Datang
                if ($i <= 60) {
                    $status = 'completed';
                    $startAt = $now->copy()->subDays(65 - $i);
                    $endAt = $startAt->copy()->addHours(4);
                } elseif ($i <= 100) {
                    $status = 'ongoing';
                    $startAt = $now->copy()->subHours(2);
                    $endAt = $now->copy()->addHours(4);
                } else {
                    $status = 'upcoming';
                    $startAt = $now->copy()->addDays($i - 100);
                    $endAt = $startAt->copy()->addHours(3);
                }

                $topic = $topics[$i % count($topics)];
                $title = "{$topic} #{$i} - " . Str::before($loc['name'], ',');

                $eventData = [
                    'title'       => $title,
                    'slug'        => Str::slug($title) . '-' . $i,
                    'description' => "Sesi {$topic} ke-{$i} yang diselenggarakan di {$loc['name']}.",
                    'location'    => $loc['name'],
                    'status'      => $status,
                    'start_at'    => $startAt,
                    'end_at'      => $endAt,
                    'quota'       => 100,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];

                if ($hasEventCoords) {
                    $eventData['coordinates'] = json_encode(['lat' => $lat, 'lng' => $lng]);
                }
                if ($hasLat) {
                    $eventData['latitude'] = $lat;
                }
                if ($hasLng) {
                    $eventData['longitude'] = $lng;
                }

                // Filter hanya kolom yang benar-benar ada di tabel `events`
                $filteredEventData = array_filter(
                    $eventData,
                    fn ($key) => Schema::hasColumn('events', $key),
                    ARRAY_FILTER_USE_KEY
                );

                $eventId = DB::table('events')->insertGetId($filteredEventData);

                // Generate jumlah pendaftar (misal 15 s.d. 85 pendaftar per event)
                $registrantCount = random_int(15, 85);

                for ($p = 1; $p <= $registrantCount; $p++) {
                    $pesertaId = DB::table('pesertas')->insertGetId([
                        'name'       => "Peserta Event {$i} - {$p}",
                        'email'      => "peserta.e{$i}.p{$p}@example.test",
                        'phone'      => '0859' . str_pad((string) random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    $pendaftaranData = [
                        'event_id'        => $eventId,
                        'peserta_id'      => $pesertaId,
                        'status'          => $status === 'completed' ? 'attended' : 'confirmed',
                        'public_token'    => Str::random(32),
                        'attendance_code' => strtoupper(Str::random(8)),
                        'created_at'      => $now,
                        'updated_at'      => $now,
                    ];

                    $filteredPendaftaran = array_filter(
                        $pendaftaranData,
                        fn ($key) => Schema::hasColumn('pendaftarans', $key),
                        ARRAY_FILTER_USE_KEY
                    );

                    DB::table('pendaftarans')->insert($filteredPendaftaran);
                }
            }
        });
    }
}