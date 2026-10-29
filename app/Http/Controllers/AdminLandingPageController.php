<?php

namespace App\Http\Controllers;

use App\Models\PengaturanLandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLandingPageController extends Controller
{
    private function pastikanAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403
        );
    }

    public function edit()
    {
        $this->pastikanAdmin();

        $default = [
            'judul_hero' => 'Pantau TPS, Wujudkan Lingkungan yang Bersih',
            'deskripsi_hero' => 'Akses informasi tempat penampungan sementara (TPS) dan sampaikan laporan kondisi TPS di Kabupaten Indramayu melalui satu layanan berbasis web.',
            'judul_tombol_tps' => 'Lihat Data TPS',
            'judul_tombol_laporan' => 'Laporkan Kondisi TPS',
            'judul_layanan' => 'Layanan SI Pantau TPS',
            'deskripsi_layanan' => 'Akses informasi TPS dan sampaikan laporan kondisi TPS di Kabupaten Indramayu.',
            'teks_footer' => 'Sistem informasi untuk mendukung pemantauan dan pelaporan kondisi TPS di Kabupaten Indramayu.',
        ];

        $pengaturan = PengaturanLandingPage::pluck('nilai', 'kunci')->toArray();
        $pengaturan = array_merge($default, $pengaturan);

        return view('admin.landing.edit', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $this->pastikanAdmin();

        $data = $request->validate([
            'judul_hero' => ['required', 'string', 'max:255'],
            'deskripsi_hero' => ['required', 'string', 'max:2000'],
            'judul_tombol_tps' => ['required', 'string', 'max:100'],
            'judul_tombol_laporan' => ['required', 'string', 'max:100'],
            'judul_layanan' => ['required', 'string', 'max:255'],
            'deskripsi_layanan' => ['required', 'string', 'max:2000'],
            'teks_footer' => ['required', 'string', 'max:2000'],
        ]);

        DB::transaction(function () use ($data) {
            foreach ($data as $kunci => $nilai) {
                PengaturanLandingPage::updateOrCreate(
                    ['kunci' => $kunci],
                    ['nilai' => $nilai]
                );
            }
        });

        return redirect()
            ->route('admin.landing.edit')
            ->with('success', 'Pengaturan landing page berhasil disimpan.');
    }
}