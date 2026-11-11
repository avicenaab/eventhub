<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PesertaSeeder::class,
            EventSeeder::class,
            PendaftaranSeeder::class,
            PresensiSeeder::class,
        ]);
    }
}