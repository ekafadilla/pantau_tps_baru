<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Services\UrgensiCalculator;

try {
    DB::transaction(function () {
        $dataDummy = [
            ["TPS Hampir Penuh", "Kapasitas TPS mulai meningkat dan ruang pembuangan tersisa sedikit.", [3,2,2,2,2], 4],
            ["Sampah Meluber", "Sampah sudah meluber keluar area TPS dan mulai mengganggu lingkungan sekitar.", [4,4,3,3,3], 3],
            ["Bau Menyengat", "Terdapat bau menyengat dan mulai terlihat gangguan hama di sekitar TPS.", [3,2,3,4,3], 2],
            ["TPS Mulai Terisi", "Kondisi TPS mulai terisi tetapi belum menimbulkan gangguan berarti.", [2,1,2,1,2], 1],
            ["Sampah Mengganggu Akses", "Sampah menumpuk dan mengganggu akses masyarakat di sekitar TPS.", [4,3,4,2,4], 0],
        ];

        foreach ($dataDummy as $item) {
            if (DB::table('laporans')->where('keterangan', $item[1])->exists()) {
                continue;
            }

            $nilai = [
                'kepenuhan_tps' => $item[2][0],
                'sampah_meluber' => $item[2][1],
                'dampak_lingkungan' => $item[2][2],
                'bau_hama' => $item[2][3],
                'gangguan_masyarakat' => $item[2][4],
            ];

            $hasil = app(UrgensiCalculator::class)->hitung($nilai);
            $waktu = now()->subDays($item[3]);

            $id = DB::table('laporans')->insertGetId([
                'id_pengguna' => 1,
                'id_tps' => 1,
                'kategori_kondisi' => $item[0],
                'lokasi' => 'TPS Uji Coba, Wilayah Uji Coba',
                'keterangan' => $item[1],
                'waktu_pelaporan' => $waktu,
                'status_laporan' => 'menunggu',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]);

            DB::table('penilaian_urgensi')->insert(array_merge($nilai, [
                'id_laporan' => $id,
                'jenis_penilaian' => 'masyarakat',
                'id_penilai' => 1,
                'skor_urgensi' => $hasil['skor_urgensi'],
                'rekomendasi_urgensi' => $hasil['rekomendasi_urgensi'],
                'catatan' => null,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]));

            DB::table('riwayat_statuses')->insert([
                'id_laporan' => $id,
                'id_pengguna' => 1,
                'status_sebelumnya' => null,
                'status_baru' => 'menunggu',
                'catatan' => 'Laporan dummy untuk pengujian sistem.',
                'waktu_perubahan' => $waktu,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]);
        }
    });

    echo "Berhasil memproses data dummy." . PHP_EOL;
    echo "Total laporan: " . DB::table('laporans')->count() . PHP_EOL;
    echo "Total penilaian: " . DB::table('penilaian_urgensi')->count() . PHP_EOL;

} catch (\Throwable $e) {
    echo "GAGAL: " . $e->getMessage() . PHP_EOL;
    exit(1);
}

