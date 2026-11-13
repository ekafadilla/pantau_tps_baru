<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin DLH',
                'password' => Hash::make ('Admin123'),
                'role' => 'admin',
            ]
        );

        // Akun UPTD
        User::updateOrCreate(
            ['email' => 'uptd@gmail.com'],
            [
                'name' => 'Petugas UPTD',
                'password' => Hash::make('Petugas123'),
                'role' => 'uptd',
            ]
        );

        // Akun Supir
        User::updateOrCreate(
            ['email' => 'supir@gmail.com'],
            [
                'name' => 'Supir Truk',
                'password' => Hash::make('Supir123'),
                'role' => 'supir',
            ]
        );
    }
}