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

        return view('uptd.tps.index', compact(
            'tps',
            'totalTps',
            'totalDenganKoordinat',
            'totalTanpaKoordinat'
        ));
    }
}