<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyLaporanSeeder extends Seeder
{
    public function run(): void
    {
        // Cegah data dummy dibuat berulang kali.
        if (Laporan::where('keterangan', 'like', '[DUMMY] %')->exists()) {
            $this->command->warn(
                'Data dummy sudah tersedia. Seeder tidak menambahkan data lagi.'
            );
            return;
        }

        $pengguna = User::where('role', 'masyarakat')
            ->orderBy('id')
            ->get();

        $daftarTps = Tps::with('wilayah')
            ->orderBy('id')
            ->get();

        if ($pengguna->isEmpty()) {
            $this->command->error(
                'Belum ada akun dengan role masyarakat. Buat akun masyarakat terlebih dahulu.'
            );
            return;
        }

        if ($daftarTps->isEmpty()) {
            $this->command->error(
                'Data TPS masih kosong. Tambahkan data TPS terlebih dahulu.'
            );
            return;
        }

        $contohLaporan = [
            [
                'kategori' => 'Sampah Menumpuk',
                'lokasi' => 'Area depan TPS',
                'keterangan' => ' [DUMMY] Sampah terlihat menumpuk dan belum seluruhnya terangkut.',
                'status' => 'menunggu',
                'hari' => 0,
            ],
            [
                'kategori' => 'Sampah Berserakan',
                'lokasi' => 'Sisi jalan dekat TPS',
                'keterangan' => ' [DUMMY] Beberapa sampah berserakan di sekitar tempat penampungan.',
                'status' => 'diverifikasi',
                'hari' => 1,
            ],
            [
                'kategori' => 'TPS Penuh',
                'lokasi' => 'Bagian utama TPS',
                'keterangan' => ' [DUMMY] Kapasitas penampungan terlihat hampir penuh.',
                'status' => 'diproses',
                'hari' => 2,
            ],
            [
                'kategori' => 'Sampah Menumpuk',
                'lokasi' => 'Pintu masuk TPS',
                'keterangan' => ' [DUMMY] Tumpukan sampah menghalangi sebagian akses masuk.',
                'status' => 'ditangani',
                'hari' => 3,
            ],
            [
                'kategori' => 'Sampah Berserakan',
                'lokasi' => 'Area sekitar kontainer',
                'keterangan' => ' [DUMMY] Ditemukan sampah di luar area penampungan.',
                'status' => 'selesai',
                'hari' => 4,
            ],
            [
                'kategori' => 'TPS Penuh',
                'lokasi' => 'Samping tempat penampungan',
                'keterangan' => ' [DUMMY] Sampah terlihat melebihi batas area penampungan.',
                'status' => 'menunggu',
                'hari' => 5,
            ],
            [
                'kategori' => 'Sampah Menumpuk',
                'lokasi' => 'Area belakang TPS',
                'keterangan' => ' [DUMMY] Terdapat tumpukan sampah yang perlu diperiksa petugas.',
                'status' => 'diproses',
                'hari' => 6,
            ],
            [
                'kategori' => 'Kondisi TPS',
                'lokasi' => 'Area sekitar TPS',
                'keterangan' => ' [DUMMY] Laporan contoh untuk pengujian tampilan dan filter.',
                'status' => 'ditolak',
                'hari' => 7,
            ],
            [
                'kategori' => 'Sampah Berserakan',
                'lokasi' => 'Jalan di dekat TPS',
                'keterangan' => ' [DUMMY] Sampah ditemukan di sekitar akses jalan menuju TPS.',
                'status' => 'diverifikasi',
                'hari' => 8,
            ],
            [
                'kategori' => 'TPS Penuh',
                'lokasi' => 'Bagian depan penampungan',
                'keterangan' => ' [DUMMY] Laporan simulasi untuk pengujian daftar laporan.',
                'status' => 'selesai',
                'hari' => 9,
            ],
        ];

        DB::transaction(function () use ($pengguna, $daftarTps, $contohLaporan) {
            foreach ($contohLaporan as $index => $data) {
                $user = $pengguna[$index % $pengguna->count()];
                $tps = $daftarTps[$index % $daftarTps->count()];

                Laporan::create([
                    'id_pengguna' => $user->id,
                    'id_tps' => $tps->id,
                    'kategori_kondisi' => $data['kategori'],
                    'lokasi' => $data['lokasi']
                        . ' - ' . ($tps->wilayah->nama_wilayah ?? 'Wilayah TPS'),
                    'keterangan' => '[DUMMY] ' . trim($data['keterangan']),
                    'waktu_pelaporan' => now()
                        ->subDays($data['hari'])
                        ->subHours($index),
                    'status_laporan' => $data['status'],
                ]);
            }
        });

        $this->command->info('Berhasil menambahkan 10 data dummy laporan.');
    }
}