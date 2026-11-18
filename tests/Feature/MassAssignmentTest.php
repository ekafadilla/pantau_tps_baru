<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MassAssignmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_masyarakat_tidak_bisa_naikkan_role_lewat_profil(): void
    {
        $wilayah = Wilayah::create(['nama_wilayah' => 'Indramayu']);
        $user = User::create([
            'name' => 'Warga',
            'email' => 'warga@test.local',
            'password' => 'Kopi12345',
            'role' => 'masyarakat',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)->put('/pengaturan/profil', [
            'name' => 'Warga Baru',
            'email' => 'warga@test.local',
            'role' => 'admin',
            'id_wilayah' => $wilayah->id,
        ]);

        $user->refresh();
        $this->assertEquals('masyarakat', $user->role);
        $this->assertNull($user->id_wilayah);
    }

    public function test_registrasi_tidak_bisa_memilih_role(): void
    {
        $this->post('/register', [
            'name' => 'Pendaftar',
            'email' => 'daftar@test.local',
            'password' => 'Kopi12345',
            'password_confirmation' => 'Kopi12345',
            'role' => 'admin',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'daftar@test.local',
            'role' => 'masyarakat',
        ]);
    }
}