<?php
namespace App\Http\Controllers;

use App\Models\Laporan;

class SupirDashboardController extends Controller
{
    public function index()
    {
        $dasar = Laporan::where('id_supir', auth()->id());

        $totalTugas = (clone $dasar)->count();

        $tugasAktif = (clone $dasar)
            ->whereIn('status_laporan', [
                'ditugaskan',
                'sedang_dikerjakan',
                'perlu_perbaikan',
            ])
            ->count();

        $menungguPemeriksaan = (clone $dasar)
            ->where('status_laporan', 'menunggu_pemeriksaan')
            ->count();

        $tugasSelesai = (clone $dasar)
            ->where('status_laporan', 'selesai')
            ->count();

        $tugasTerbaru = (clone $dasar)
            ->with(['tps', 'armada'])
            ->latest()
            ->take(5)
            ->get();

        return view('supir.dashboard', compact(
            'totalTugas',
            'tugasAktif',
            'menungguPemeriksaan',
            'tugasSelesai',
            'tugasTerbaru'
        ));
    }
}