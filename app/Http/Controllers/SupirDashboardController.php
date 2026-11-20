<?php

namespace App\Http\Controllers;

use App\Models\Laporan;

class SupirDashboardController extends Controller
{
    public function index()
    {
        // Data laporan milik supir yang sedang login
        $dasar = Laporan::where('id_supir', auth()->id());

        // Total tugas
        $totalTugas = (clone $dasar)->count();

        // Tugas aktif
        $tugasAktif = (clone $dasar)
            ->whereIn('status_laporan', [
                'ditugaskan',
                'sedang_dikerjakan',
                'perlu_perbaikan',
            ])
            ->count();

        // Menunggu pemeriksaan
        $menungguPemeriksaan = (clone $dasar)
            ->where('status_laporan', 'menunggu_pemeriksaan')
            ->count();

        // Tugas selesai
        $tugasSelesai = (clone $dasar)
            ->where('status_laporan', 'selesai')
            ->count();

        // Tugas aktif terbaru
        $tugasBerjalan = (clone $dasar)
            ->with([
                'tps',
                'armada',
            ])
            ->whereIn('status_laporan', [
                'ditugaskan',
                'sedang_dikerjakan',
                'perlu_perbaikan',
            ])
            ->latest('updated_at')
            ->first();

        // Lima tugas terbaru
        $tugasTerbaru = (clone $dasar)
            ->with([
                'tps',
                'armada',
            ])
            ->latest()
            ->take(5)
            ->get();

        // Armada dari penugasan terbaru
        $armadaAktif = (clone $dasar)
            ->with('armada')
            ->whereNotNull('id_armada')
            ->latest('updated_at')
            ->first()?->armada;

        // Nama supir
        $namaSupir = auth()->user()->name ?? 'Supir';

        return view('supir.dashboard', compact(
            'totalTugas',
            'tugasAktif',
            'menungguPemeriksaan',
            'tugasSelesai',
            'tugasBerjalan',
            'tugasTerbaru',
            'namaSupir',
            'armadaAktif'
        ));
    }
}
