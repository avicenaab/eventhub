<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    public function run(): void
    {
        Peserta::create([
            'nama' => 'Andi Saputra',
            'email' => 'andi@gmail.com',
            'no_hp' => '081234567890',
            'instansi' => 'IPB University',
        ]);

        Peserta::create([
            'nama' => 'Dina Putri',
            'email' => 'dina@gmail.com',
            'no_hp' => '081234567891',
            'instansi' => 'Universitas Indonesia',
        ]);
    }
}