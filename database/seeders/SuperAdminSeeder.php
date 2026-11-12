<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $name = env('SUPER_ADMIN_NAME');
        $email = env('SUPER_ADMIN_EMAIL');
        $password = env('SUPER_ADMIN_PASSWORD');

        if (! $name || ! $email || ! $password) {
            throw new RuntimeException('Isi SUPER_ADMIN_NAME, SUPER_ADMIN_EMAIL, dan SUPER_ADMIN_PASSWORD di .env sebelum menjalankan seeder.');
        }

        User::updateOrCreate(
            ['email' => strtolower($email)],
            ['name' => $name, 'password' => Hash::make($password), 'is_super_admin' => true]
        );
    }
}
