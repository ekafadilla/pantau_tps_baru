<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\Tps;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UptdAlurTest extends TestCase
{
    use RefreshDatabase;

    private function uptd(Wilayah $wilayah): User
    {
        return User::create([
            'name' => 'UPTD ' . uniqid(),
            'email' => uniqid() . '@test.local',
            'password' => 'Kopi12345',
            'role' => 'uptd',
            'id_wilayah' => $wilayah->id,
            'email_verified_at' => now(),
        ]);
    }

    private function laporan(Wilayah $wilayah, string $status, ?string $urgensi = null): Laporan
    {
        $pengguna = User::create([
            'name' => 'Warga ' . uniqid(),
            'email' => uniqid() . '@test.local',
            'password' => 'Kopi12345',
            'role' => 'masyarakat',
            'email_verified_at' => now(),
        ]);

        $tps = Tps::create([
            'nama_tps' => 'TPS ' . uniqid(),
            'alamat' => 'Tes',
            'latitude' => -6.33,
            'longitude' => 108.32,
            'id_wilayah' => $wilayah->id,
        ]);

        return Laporan::create([
            'id_pengguna' => $pengguna->id,
            'id_tps' => $tps->id,
            'kategori_kondisi' => 'tps_penuh',
            'keterangan' => 'Tes',
            'waktu_pelaporan' => now(),
            'status_laporan' => $status,
            'tingkat_urgensi' => $urgensi,
        ]);
    }

    public function test_tugaskan_ditolak_jika_belum_diverifikasi(): void
    {
        $w = Wilayah::create(['nama_wilayah' => 'Indramayu']);
        $laporan = $this->laporan($w, 'menunggu', 'sedang');

        $this->actingAs($this->uptd($w))
            ->post('/uptd/laporan/' . $laporan->id . '/tugaskan', ['id_supir' => 1])
            ->assertStatus(422);

        $this->assertEquals('menunggu', $laporan->fresh()->status_laporan);
    }

    public function test_urgensi_ditolak_jika_belum_diverifikasi(): void
    {
        $w = Wilayah::create(['nama_wilayah' => 'Indramayu']);
        $laporan = $this->laporan($w, 'menunggu');

        $this->actingAs($this->uptd($w))
            ->post('/uptd/laporan/' . $laporan->id . '/verifikasi-urgensi', [
                'kepenuhan_tps' => 1, 'sampah_meluber' => 1, 'dampak_lingkungan' => 1,
                'bau_hama' => 1, 'gangguan_masyarakat' => 1, 'tingkat_urgensi' => 'rendah',
            ])
            ->assertStatus(422);

        $this->assertEquals(0, $laporan->fresh()->penilaianUrgensis()->count());
    }

    public function test_verifikasi_hanya_sekali(): void
    {
        $w = Wilayah::create(['nama_wilayah' => 'Indramayu']);
        $laporan = $this->laporan($w, 'menunggu');
        $uptd = $this->uptd($w);

        $this->actingAs($uptd)
            ->post('/uptd/laporan/' . $laporan->id . '/verifikasi')
            ->assertStatus(302);
        $this->assertEquals('diverifikasi', $laporan->fresh()->status_laporan);

        // Percobaan kedua (misalnya klik ganda) harus ditolak dan tidak menambah riwayat
        $this->actingAs($uptd)
            ->post('/uptd/laporan/' . $laporan->id . '/verifikasi')
            ->assertStatus(422);

        $this->assertEquals(1, $laporan->fresh()->riwayatStatuses()->where('status_baru', 'diverifikasi')->count());
    }
}