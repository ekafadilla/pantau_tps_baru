<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use Illuminate\Http\Request;

class UptdTpsController extends Controller
{
    private function tpsWilayah()
    {
        $user = auth()->user();

        abort_unless($user && $user->role === 'uptd', 403);
        abort_if(!$user->id_wilayah, 403, 'Akun UPTD belum memiliki wilayah.');

        return Tps::where('id_wilayah', $user->id_wilayah);
    }

    public function index(Request $request)
    {
        $query = $this->tpsWilayah();

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nama_tps', 'like', "%{$cari}%")
                  ->orWhere('alamat', 'like', "%{$cari}%");
            });
        }

        $tps = $query->orderBy('nama_tps')
            ->paginate(10)
            ->withQueryString();

        $totalTps = $this->tpsWilayah()->count();

        $totalDenganKoordinat = $this->tpsWilayah()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->count();

        $totalTanpaKoordinat = $totalTps - $totalDenganKoordinat;

        // Data seluruh TPS berkoordinat untuk peta
        $tpsPeta = $this->tpsWilayah()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('nama_tps')
            ->get();

        // Data laporan berkoordinat dari wilayah UPTD yang sama
        $user = auth()->user();

        $laporanPeta = \App\Models\Laporan::whereHas('tps', function ($query) use ($user) {
                $query->where('id_wilayah', $user->id_wilayah);
            })
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->with('tps:id,nama_tps')
            ->orderByDesc('waktu_pelaporan')
            ->get();
        return view('uptd.tps.index', [
            'tps' => $tps,
            'totalTps' => $totalTps,
            'totalDenganKoordinat' => $totalDenganKoordinat,
            'totalTanpaKoordinat' => $totalTanpaKoordinat,
            'tpsPeta' => $tpsPeta,
            'laporanPeta' => $laporanPeta,
        ]);
    }
}