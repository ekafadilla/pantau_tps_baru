<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class UptdLaporanController extends Controller
{
    private function laporanWilayah()
    {
        $user = auth()->user();

        abort_unless($user && $user->role === 'uptd', 403);
        abort_if(!$user->id_wilayah, 403, 'Akun UPTD belum memiliki wilayah.');

        return Laporan::whereHas('tps', function ($query) use ($user) {
            $query->where('id_wilayah', $user->id_wilayah);
        });
    }

    public function index(Request $request)
    {
        $query = $this->laporanWilayah()
            ->with(['tps', 'pengguna']);

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('kategori_kondisi', 'like', "%{$cari}%")
                    ->orWhere('lokasi', 'like', "%{$cari}%")
                    ->orWhereHas('tps', function ($tps) use ($cari) {
                        $tps->where('nama_tps', 'like', "%{$cari}%");
                    })
                    ->orWhereHas('pengguna', function ($pengguna) use ($cari) {
                        $pengguna->where('name', 'like', "%{$cari}%");
                    });
            });
        }

        $statusValid = [
            'menunggu',
            'diverifikasi',
            'diproses',
            'ditangani',
            'selesai',
            'ditolak',
        ];

        if ($request->filled('status') &&
            in_array($request->status, $statusValid, true)) {
            $query->where('status_laporan', $request->status);
        }

        $laporan = $query
            ->orderByDesc('waktu_pelaporan')
            ->paginate(10)
            ->withQueryString();

        $dasar = $this->laporanWilayah();

        $totalLaporan = (clone $dasar)->count();
        $menunggu = (clone $dasar)->where('status_laporan', 'menunggu')->count();
        $diproses = (clone $dasar)->whereIn('status_laporan', [
            'diverifikasi', 'diproses', 'ditangani'
        ])->count();
        $selesai = (clone $dasar)->where('status_laporan', 'selesai')->count();

        return view('uptd.laporan.index', compact(
            'laporan',
            'totalLaporan',
            'menunggu',
            'diproses',
            'selesai'
        ));
    }

    public function show(Laporan $laporan)
    {
        $diWilayah = $this->laporanWilayah()
            ->where('id', $laporan->id)
            ->exists();

        abort_unless($diWilayah, 404);

        $laporan->load([
            'tps',
            'pengguna',
            'fotoLaporans',
            'riwayatStatuses',
        ]);

        return view('uptd.laporan.show', compact('laporan'));
    }
}