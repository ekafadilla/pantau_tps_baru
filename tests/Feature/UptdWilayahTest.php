<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\Tps;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UptdWilayahTest extends TestCase
{
    use RefreshDatabase;

    private function wilayah(string $nama): Wilayah
    {
        return Wilayah::create(['nama_wilayah' => $nama]);
    }

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

    private function laporan(Wilayah $wilayah): Laporan
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
            'status_laporan' => 'menunggu',
        ]);
    }

    public function test_uptd_bisa_lihat_laporan_di_wilayahnya(): void
    {
        $w = $this->wilayah('Indramayu');
        $laporan = $this->laporan($w);

        $this->actingAs($this->uptd($w))
            ->get('/uptd/laporan/' . $laporan->id)
            ->assertOk();
    }

    public function test_uptd_wilayah_lain_tidak_bisa_lihat_laporan(): void
    {
        $laporan = $this->laporan($this->wilayah('Indramayu'));
        $uptdLain = $this->uptd($this->wilayah('Cirebon'));

        $this->actingAs($uptdLain)
            ->get('/uptd/laporan/' . $laporan->id)
            ->assertNotFound();
    }

    public function test_uptd_wilayah_lain_tidak_bisa_verifikasi(): void
    {
        $laporan = $this->laporan($this->wilayah('Indramayu'));
        $uptdLain = $this->uptd($this->wilayah('Cirebon'));

        $this->actingAs($uptdLain)
            ->post('/uptd/laporan/' . $laporan->id . '/verifikasi')
            ->assertNotFound();

        $this->assertEquals('menunggu', $laporan->fresh()->status_laporan);
    }

    public function test_uptd_wilayah_lain_tidak_bisa_tolak(): void
    {
        $laporan = $this->laporan($this->wilayah('Indramayu'));
        $uptdLain = $this->uptd($this->wilayah('Cirebon'));

        $this->actingAs($uptdLain)
            ->post('/uptd/laporan/' . $laporan->id . '/tolak', ['catatan_tolak' => 'Tes'])
            ->assertNotFound();

        $this->assertEquals('menunggu', $laporan->fresh()->status_laporan);
    }

    public function test_masyarakat_tidak_bisa_verifikasi_laporan(): void
    {
        $laporan = $this->laporan($this->wilayah('Indramayu'));
        $masyarakat = User::create([
            'name' => 'Lain',
            'email' => uniqid() . '@test.local',
            'password' => 'Kopi12345',
            'role' => 'masyarakat',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($masyarakat)
            ->post('/uptd/laporan/' . $laporan->id . '/verifikasi')
            ->assertForbidden();

        $this->assertEquals('menunggu', $laporan->fresh()->status_laporan);
    }
}