<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\Tps;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AksesRoleTest extends TestCase
{
    use RefreshDatabase;

    private function buat(string $role, bool $terverifikasi = true): User
    {
        return User::create([
            'name' => ucfirst($role) . uniqid(),
            'email' => $role . uniqid() . '@test.local',
            'password' => 'Kopi12345',
            'role' => $role,
            'email_verified_at' => $terverifikasi ? now() : null,
        ]);
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/masyarakat/pengaturan')->assertRedirect('/login');
        $this->get('/pengaturan')->assertRedirect('/login');
    }

    public function test_masyarakat_tidak_bisa_akses_admin(): void
    {
        $u = $this->buat('masyarakat');
        $this->actingAs($u)->get('/admin/pengguna')->assertForbidden();
        $this->actingAs($u)->get('/admin/laporan')->assertForbidden();
        $this->actingAs($u)->get('/admin/tps')->assertForbidden();
    }

    public function test_uptd_dan_supir_tidak_bisa_akses_admin(): void
    {
        $this->actingAs($this->buat('uptd'))->get('/admin/pengguna')->assertForbidden();
        $this->actingAs($this->buat('supir'))->get('/admin/tps')->assertForbidden();
    }

    public function test_masyarakat_tidak_bisa_akses_uptd_dan_supir(): void
    {
        $u = $this->buat('masyarakat');
        $this->actingAs($u)->get('/uptd/laporan')->assertForbidden();
        $this->actingAs($u)->get('/supir/tugas')->assertForbidden();
    }

    public function test_akun_belum_verifikasi_tidak_bisa_buat_laporan(): void
    {
        $u = $this->buat('masyarakat', false);
        $this->actingAs($u)->get('/masyarakat/laporan/buat')
            ->assertRedirect(route('verification.notice'));
    }

    public function test_masyarakat_hanya_bisa_lihat_laporan_sendiri(): void
    {
        $pemilik = $this->buat('masyarakat');
        $lain = $this->buat('masyarakat');
        $wilayah = \App\Models\Wilayah::create(['nama_wilayah' => 'Indramayu']);
        $tps = Tps::create([
            'nama_tps' => 'TPS Tes',
            'alamat' => 'Indramayu',
            'latitude' => -6.33,
            'longitude' => 108.32,
            'id_wilayah' => $wilayah->id,
        ]);
        $laporan = Laporan::create([
            'id_pengguna' => $pemilik->id,
            'id_tps' => $tps->id,
            'kategori_kondisi' => 'tps_penuh',
            'keterangan' => 'Tes',
            'waktu_pelaporan' => now(),
            'status_laporan' => 'menunggu',
        ]);

        $this->actingAs($pemilik)->get('/masyarakat/laporan/' . $laporan->id)->assertOk();
        $this->actingAs($lain)->get('/masyarakat/laporan/' . $laporan->id)->assertForbidden();
    }

    public function test_supir_hanya_bisa_lihat_tugas_sendiri(): void
    {
        $supirA = $this->buat('supir');
        $supirB = $this->buat('supir');
        $wilayah = \App\Models\Wilayah::create(['nama_wilayah' => 'Indramayu']);
        $tps = Tps::create([
            'nama_tps' => 'TPS Tes',
            'alamat' => 'Indramayu',
            'latitude' => -6.33,
            'longitude' => 108.32,
            'id_wilayah' => $wilayah->id,
        ]);
        $laporan = Laporan::create([
            'id_pengguna' => $this->buat('masyarakat')->id,
            'id_tps' => $tps->id,
            'id_supir' => $supirA->id,
            'kategori_kondisi' => 'tps_penuh',
            'keterangan' => 'Tes',
            'waktu_pelaporan' => now(),
            'status_laporan' => 'diproses',
        ]);

        $this->actingAs($supirA)->get('/supir/tugas/' . $laporan->id)->assertOk();
        $this->actingAs($supirB)->get('/supir/tugas/' . $laporan->id)->assertNotFound();
    }

    public function test_hanya_supir_bisa_bagikan_lokasi(): void
    {
        $data = ['latitude' => -6.33, 'longitude' => 108.32, 'akurasi' => 10];
        $this->actingAs($this->buat('supir'))->postJson('/supir/lokasi', $data)->assertOk();
        $this->actingAs($this->buat('masyarakat'))->postJson('/supir/lokasi', $data)->assertForbidden();
    }

    public function test_masyarakat_tidak_bisa_baca_posisi_supir(): void
    {
        $this->actingAs($this->buat('masyarakat'))->getJson('/peta/supir')->assertForbidden();
    }

    public function test_pengaturan_terbuka_untuk_semua_role(): void
    {
        foreach (['masyarakat', 'uptd', 'supir', 'admin'] as $role) {
            $this->actingAs($this->buat($role))->get('/pengaturan')->assertOk();
        }
    }
}