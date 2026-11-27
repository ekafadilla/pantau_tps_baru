<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupirDummySeeder extends Seeder
{
    public function run(): void
    {
        $wilayahs = DB::table('wilayahs')->orderBy('id')->get();
        $password = Hash::make('Supir123!');

        foreach ($wilayahs as $wilayah) {
            for ($i = 1; $i <= 3; $i++) {
                $email = "supir.dummy.wilayah{$wilayah->id}.{$i}@example.test";

                DB::table('users')->insertOrIgnore([
                    'name' => "Supir {$i} - {$wilayah->nama_wilayah}",
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => $password,
                    'role' => 'supir',
                    'id_wilayah' => $wilayah->id,
                    'is_spammer' => 0,
                    'spam_score' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}