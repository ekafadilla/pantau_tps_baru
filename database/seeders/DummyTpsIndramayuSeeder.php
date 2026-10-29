<?php

namespace Database\Seeders;

use App\Models\Tps;
use Illuminate\Database\Seeder;

class DummyTpsIndramayuSeeder extends Seeder
{
    public function run(): void
    {
        $dataTps = [
            [
                'id_wilayah' => 2,
                'nama_tps' => 'TPS dekat SMP Unggulan Kabupaten Indramayu',
                'alamat' => 'Area sekitar SMP Unggulan Kabupaten Indramayu, Kabupaten Indramayu, Jawa Barat',
                'latitude' => null,
                'longitude' => null,
                'keterangan' => '[DUMMY - PERLU VERIFIKASI] Lokasi TPS disebut dalam pemberitaan RRI tanggal 10 April 2026. Koordinat dan status inventaris resmi belum diverifikasi. Sumber: https://rri.co.id/cirebon/regional/2324950/dlh-indramayu-respons-sampah-menumpuk',
            ],
            [
                'id_wilayah' => 1,
                'nama_tps' => 'TPS 3R Desa Cangkingan',
                'alamat' => 'Desa Cangkingan, Kecamatan Kedokan Bunder, Kabupaten Indramayu, Jawa Barat',
                'latitude' => null,
                'longitude' => null,
                'keterangan' => '[DUMMY - PERLU VERIFIKASI] TPS 3R disebut dalam publikasi resmi Pemkab Indramayu tanggal 24 April 2025. Penempatan wilayah UPTD hanya sementara untuk pengujian aplikasi dan bukan penetapan wilayah operasional resmi. Sumber: https://indramayukab.go.id/solutif-tangani-masalah-sampah-desa-cangkingan-miliki-perdes-pengelolaan-lingkungan-hingga-tps-3r/',
            ],
        ];

        $ditambahkan = 0;
        $dilewati = 0;

        foreach ($dataTps as $data) {
            $sudahAda = Tps::where('nama_tps', $data['nama_tps'])->exists();

            if ($sudahAda) {
                $dilewati++;
                continue;
            }

            Tps::create($data);
            $ditambahkan++;
        }

        $this->command->info("TPS baru ditambahkan: {$ditambahkan}");
        $this->command->info("TPS dilewati karena sudah ada: {$dilewati}");
    }
}