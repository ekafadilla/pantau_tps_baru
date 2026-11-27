<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

try {
    DB::transaction(function () {
        $idWilayah = 1;

        if (!DB::table('wilayahs')->where('id', $idWilayah)->exists()) {
            throw new Exception('Wilayah uji coba ID 1 tidak ditemukan.');
        }

        // TPS tambahan untuk pengujian
        $dataTps = [
            [
                'nama_tps' => 'TPS Uji Coba 2',
                'alamat' => 'Lokasi simulasi bagian utara wilayah uji coba',
            ],
            [
                'nama_tps' => 'TPS Uji Coba 3',
                'alamat' => 'Lokasi simulasi bagian selatan wilayah uji coba',
            ],
        ];

        $idTps = [1];

        foreach ($dataTps as $item) {
            $tps = DB::table('tps')
                ->where('nama_tps', $item['nama_tps'])
                ->first();

            if (!$tps) {
                $idBaru = DB::table('tps')->insertGetId([
                    'id_wilayah' => $idWilayah,
                    'nama_tps' => $item['nama_tps'],
                    'alamat' => $item['alamat'],
                    'latitude' => null,
                    'longitude' => null,
                    'keterangan' => 'Data simulasi untuk pengujian SI Pantau TPS, bukan TPS resmi.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $idTps[] = $idBaru;
            } else {
                $idTps[] = $tps->id;
            }
        }

        // Supir lama dimasukkan ke wilayah uji coba
        $supirLama = DB::table('users')
            ->where('id', 3)
            ->where('role', 'supir')
            ->first();

        if (!$supirLama) {
            throw new Exception('Akun supir ID 3 tidak ditemukan.');
        }

        DB::table('users')->where('id', 3)->update([
            'id_wilayah' => $idWilayah,
            'updated_at' => now(),
        ]);

        // Membuat dua akun supir simulasi
        $dataSupir = [
            [
                'name' => 'Supir Simulasi 2',
                'email' => 'supir.simulasi2@example.test',
            ],
            [
                'name' => 'Supir Simulasi 3',
                'email' => 'supir.simulasi3@example.test',
            ],
        ];

        $idSupir = [3];

        foreach ($dataSupir as $item) {
            $supir = DB::table('users')
                ->where('email', $item['email'])
                ->first();

            if (!$supir) {
                $idBaru = DB::table('users')->insertGetId([
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'password' => Hash::make('Supir123!'),
                    'role' => 'supir',
                    'id_wilayah' => $idWilayah,
                    'email_verified_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $idSupir[] = $idBaru;
            } else {
                if ($supir->role !== 'supir') {
                    throw new Exception('Email simulasi sudah digunakan oleh akun non-supir.');
                }

                DB::table('users')->where('id', $supir->id)->update([
                    'id_wilayah' => $idWilayah,
                    'updated_at' => now(),
                ]);

                $idSupir[] = $supir->id;
            }
        }

        // Pembagian TPS berdasarkan rute simulasi
        $penugasan = [
            [$idSupir[0], $idTps[0], 'Rute A - TPS 1 dan TPS 2'],
            [$idSupir[0], $idTps[1], 'Rute A - TPS 1 dan TPS 2'],

            [$idSupir[1], $idTps[1], 'Rute B - TPS 2 dan TPS 3'],
            [$idSupir[1], $idTps[2], 'Rute B - TPS 2 dan TPS 3'],

            [$idSupir[2], $idTps[2], 'Rute C - TPS 3'],
        ];

        foreach ($penugasan as $item) {
            $sudahAda = DB::table('supir_tps')
                ->where('id_supir', $item[0])
                ->where('id_tps', $item[1])
                ->exists();

            if (!$sudahAda) {
                DB::table('supir_tps')->insert([
                    'id_supir' => $item[0],
                    'id_tps' => $item[1],
                    'rute' => $item[2],
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    });

    echo "Berhasil membuat data simulasi supir dan TPS." . PHP_EOL;

} catch (\Throwable $e) {
    echo "GAGAL: " . $e->getMessage() . PHP_EOL;
    exit(1);
}

echo PHP_EOL . "DATA SUPIR:" . PHP_EOL;
dump(DB::table('users')->where('role', 'supir')->select('id', 'name', 'email', 'id_wilayah')->get()->toArray());

echo PHP_EOL . "DATA TPS:" . PHP_EOL;
dump(DB::table('tps')->select('id', 'nama_tps', 'id_wilayah')->get()->toArray());

echo PHP_EOL . "PEMBAGIAN RUTE:" . PHP_EOL;
dump(DB::table('supir_tps')
    ->join('users', 'supir_tps.id_supir', '=', 'users.id')
    ->join('tps', 'supir_tps.id_tps', '=', 'tps.id')
    ->select('users.name as supir', 'tps.nama_tps', 'supir_tps.rute', 'supir_tps.status')
    ->orderBy('users.id')
    ->get()
    ->toArray());