<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupirTpsDummySeeder extends Seeder
{
    public function run(): void
    {
        $supirs = DB::table('users')
            ->where('role', 'supir')
            ->where('email', 'like', 'supir.dummy.wilayah%')
            ->get();

        foreach ($supirs as $supir) {
            $tpsList = DB::table('tps')
                ->where('id_wilayah', $supir->id_wilayah)
                ->get();

            foreach ($tpsList as $tps) {
                DB::table('supir_tps')->insertOrIgnore([
                    'id_supir' => $supir->id,
                    'id_tps' => $tps->id,
                    'rute' => null,
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}