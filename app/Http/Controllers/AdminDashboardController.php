<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use App\Models\Wilayah;
use App\Models\Tps;

class AdminDashboardController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        $totalPengguna = User::count();
        $totalMasyarakat = User::where('role', 'masyarakat')->count();
        $totalUptd = User::where('role', 'uptd')->count();
        $totalSupir = User::where('role', 'supir')->count();

        $totalWilayah = Wilayah::count();
        $totalTps = Tps::count();
        $totalLaporan = Laporan::count();

        $laporanMenunggu = Laporan::whereIn(
            'status_laporan',
            ['menunggu', 'menunggu_verifikasi']
        )->count();

        $laporanDiproses = Laporan::whereIn(
            'status_laporan',
            ['diproses', 'ditangani', 'ditugaskan', 'sedang_dikerjakan']
        )->count();

        $laporanSelesai = Laporan::where('status_laporan', 'selesai')->count();
        $laporanDitolak = Laporan::where('status_laporan', 'ditolak')->count();

        $laporanTerbaru = Laporan::with(['pengguna', 'tps'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengguna',
            'totalMasyarakat',
            'totalUptd',
            'totalSupir',
            'totalWilayah',
            'totalTps',
            'totalLaporan',
            'laporanMenunggu',
            'laporanDiproses',
            'laporanSelesai',
            'laporanDitolak',
            'laporanTerbaru'
        ));
    }
}