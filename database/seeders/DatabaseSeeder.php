<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SuperAdminSeeder::class,
            PesertaSeeder::class,
            EventSeeder::class,
            PendaftaranSeeder::class,
            PresensiSeeder::class,
            EventHubDummySeeder::class,
        ]);
    }
}