<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Tps;
use App\Models\Laporan;

class DummyReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // -------------------------------------------------
        // 1. Buat beberapa pengguna (user)
        // -------------------------------------------------
        $usersData = [
            ['name' => 'Ari', 'email' => 'ari@example.com', 'password' => Hash::make('secret')],
            ['name' => 'Budi', 'email' => 'budi@example.com', 'password' => Hash::make('secret')],
            ['name' => 'Cici', 'email' => 'cici@example.com', 'password' => Hash::make('secret')],
            ['name' => 'Dedi', 'email' => 'dedi@example.com', 'password' => Hash::make('secret')],
            ['name' => 'Eka', 'email' => 'eka@example.com', 'password' => Hash::make('secret')],
            ['name' => 'Fajar', 'email' => 'fajar@example.com', 'password' => Hash::make('secret')],
        ];
        $users = [];
        foreach ($usersData as $data) {
            $users[] = User::firstOrCreate(['email' => $data['email']], $data);
        }

        // -------------------------------------------------
        // 2. Buat dua TPS
        // -------------------------------------------------
        $tps1 = Tps::firstOrCreate(
            ['nama_tps' => 'TPS A', 'lokasi' => 'Jalan Merdeka 1'],
            ['status' => 'bersih', 'last_cleaned_at' => Carbon::now()->subMonths(2)]
        );
        $tps2 = Tps::firstOrCreate(
            ['nama_tps' => 'TPS B', 'lokasi' => 'Jalan Sudirman 2'],
            ['status' => 'bersih', 'last_cleaned_at' => Carbon::now()->subMonths(3)]
        );

        // -------------------------------------------------
        // 3. Scenario 1: banyak orang melaporkan TPS yang sama (potensi_spam)
        // -------------------------------------------------
        $today = Carbon::now();
        foreach ($users as $i => $user) {
            // Hanya 5 laporan pertama yang masuk untuk men-trigger potensi_spam
            if ($i >= 5) {
                break;
            }
            Laporan::create([
                'id_pengguna' => $user->id,
                'id_tps' => $tps1->id,
                'kategori_kondisi' => 'sampah menumpuk',
                'lokasi' => $tps1->lokasi,
                'latitude' => -6.200000,
                'longitude' => 106.816666,
                'keterangan' => 'Laporan massal dari banyak warga.',
                'waktu_pelaporan' => $today->copy()->subHours($i),
                'status_laporan' => 'menunggu',
            ]);
        }

        // -------------------------------------------------
        // 4. Scenario 2: satu orang melaporkan TPS yang sama berulang dalam 1‑2 minggu
        // -------------------------------------------------
        $userAri = $users[0]; // Ari
        // Laporan pertama (hari ini)
        Laporan::create([
            'id_pengguna' => $userAri->id,
            'id_tps' => $tps2->id,
            'kategori_kondisi' => 'sampah menumpuk',
            'lokasi' => $tps2->lokasi,
            'latitude' => -6.210000,
            'longitude' => 106.826666,
            'keterangan' => 'Laporan pertama oleh Ari.',
            'waktu_pelaporan' => $today->copy(),
            'status_laporan' => 'menunggu',
        ]);
        // Laporan kedua, satu minggu kemudian
        Laporan::create([
            'id_pengguna' => $userAri->id,
            'id_tps' => $tps2->id,
            'kategori_kondisi' => 'sampah menumpuk',
            'lokasi' => $tps2->lokasi,
            'latitude' => -6.210000,
            'longitude' => 106.826666,
            'keterangan' => 'Laporan kedua oleh Ari, seminggu kemudian.',
            'waktu_pelaporan' => $today->copy()->addDays(7),
            'status_laporan' => 'menunggu',
        ]);

        // -------------------------------------------------
        // 5. Scenario 3: laporan fiktif setelah TPS sudah bersih
        // -------------------------------------------------
        // Tandai TPS B sebagai bersih (sekarang)
        $tps2->update([
            'status' => 'bersih',
            'last_cleaned_at' => $today->copy()->subDays(1),
        ]);
        // Buat laporan yang menyatakan masalah padahal sudah bersih
        Laporan::create([
            'id_pengguna' => $users[1]->id, // Budi
            'id_tps' => $tps2->id,
            'kategori_kondisi' => 'bersih',
            'lokasi' => $tps2->lokasi,
            'latitude' => -6.210000,
            'longitude' => 106.826666,
            'keterangan' => 'Laporan fiktif: TPS sudah bersih padahal sudah ditangani.',
            'waktu_pelaporan' => $today->copy()->addDays(2),
            'status_laporan' => 'menunggu',
        ]);
    }
}
?>