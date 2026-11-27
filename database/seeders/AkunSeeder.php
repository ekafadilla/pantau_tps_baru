<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            [
                'name' => 'Eka',
                'email' => 'ekafadilla2006@gmail.com',
                'role' => 'masyarakat',
            ],
            [
                'name' => 'UPTD Kebersihan Indramayu',
                'email' => 'uptd.indramayu@example.test',
                'role' => 'uptd',
            ],
            [
                'name' => 'Supir TPS',
                'email' => 'supir.tps@example.test',
                'role' => 'supir',
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@pantautps.test',
                'role' => 'admin',
            ],
        ];

        foreach ($akun as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => 'pantautps123',
                    'role' => $data['role'],
                ]
            );
        }

        $this->command->info('Berhasil membuat atau memperbarui 4 akun.');
    }
}