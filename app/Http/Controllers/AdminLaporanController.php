<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLaporanController extends Controller
{
    private function pastikanAdmin(): void
    {
        abort_unless(
            Auth::check() && Auth::user()->role === 'admin',
            403
        );
    }

    public function index(Request $request)
    {
        $this->pastikanAdmin();

        $cari = $request->query('cari');
        $idWilayah = $request->query('id_wilayah');
        $status = $request->query('status');

        $daftarStatus = [
            'menunggu',
            'diverifikasi',
            'diproses',
            'ditangani',
            'selesai',
            'ditolak',
        ];

        $query = Laporan::with([
            'pengguna',
            'tps.wilayah',
        ]);

        if ($cari) {
            $query->where(function ($q) use ($cari) {
                $q->where('kategori_kondisi', 'like', "%{$cari}%")
                    ->orWhere('lokasi', 'like', "%{$cari}%")
                    ->orWhere('keterangan', 'like', "%{$cari}%")
                    ->orWhereHas('pengguna', function ($pengguna) use ($cari) {
                        $pengguna->where('name', 'like', "%{$cari}%")
                            ->orWhere('email', 'like', "%{$cari}%");
                    })
                    ->orWhereHas('tps', function ($tps) use ($cari) {
                        $tps->where('nama_tps', 'like', "%{$cari}%");
                    });
            });
        }

        if ($idWilayah !== null && $idWilayah !== '') {
            $query->whereHas('tps', function ($tps) use ($idWilayah) {
                $tps->where('id_wilayah', $idWilayah);
            });
        }

        if (in_array($status, $daftarStatus, true)) {
            $query->where('status_laporan', $status);
        } else {
            $status = '';
        }

        $laporan = $query
            ->orderByDesc('waktu_pelaporan')
            ->paginate(10)
            ->withQueryString();

        $wilayah = Wilayah::orderBy('nama_wilayah')->get();

        $totalLaporan = Laporan::count();
        $totalMenunggu = Laporan::where('status_laporan', 'menunggu')->count();
        $totalDiproses = Laporan::whereIn('status_laporan', [
            'diverifikasi',
            'diproses',
            'ditangani',
        ])->count();
        $totalSelesai = Laporan::where('status_laporan', 'selesai')->count();

        return view('admin.laporan.index', compact(
            'laporan',
            'wilayah',
            'cari',
            'idWilayah',
            'status',
            'daftarStatus',
            'totalLaporan',
            'totalMenunggu',
            'totalDiproses',
            'totalSelesai'
        ));
    }

    public function show(Laporan $laporan)
    {
        $this->pastikanAdmin();

        $laporan->load([
            'pengguna',
            'tps.wilayah',
            'fotoLaporans',
            'riwayatStatuses',
        ]);

        return view('admin.laporan.show', compact('laporan'));
    }
}