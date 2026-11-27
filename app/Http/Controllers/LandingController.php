<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Tps;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class LandingController extends Controller
{
    
    private const STATUS_BERJALAN = ['menunggu', 'diverifikasi', 'diproses', 'ditangani'];

    
    public function index(): View
    {
        return view('landing.index', [
            'landing' => $this->payload(),
        ]);
    }

    
    public function data(): JsonResponse
    {
        return response()
            ->json($this->payload())
            ->header('Cache-Control', 'no-store, max-age=0');
    }

    private function payload(): array
    {

    // ini bagian ngambil data dari DB, biar ada data" tpd d landing pagenya
    
        $daftarTps = Tps::query()
            ->with('wilayah:id,nama_wilayah')
            ->withCount([
                'laporans as laporan_berjalan' => fn ($q) =>
                    $q->whereIn('status_laporan', self::STATUS_BERJALAN),
            ])
            ->orderBy('nama_tps')
            ->limit(200)
            ->get()
            ->map(fn (Tps $tps) => [
                'id'               => $tps->id,
                'nama'             => $tps->nama_tps,
                'alamat'           => $tps->alamat,
                'wilayah'          => $tps->wilayah?->nama_wilayah,
                'laporan_berjalan' => (int) $tps->laporan_berjalan,
            ])
            ->values();

        $totalTps = Tps::count();

        return [
            'stats' => [
                'total_tps'         => $totalTps,
                
                'tps_aktif'         => $totalTps,
                'pengaduan_selesai' => Laporan::where('status_laporan', 'selesai')->count(),
            ],
            'tps'        => $daftarTps,
            'updated_at' => now()->toIso8601String(),
        ];
    }
}