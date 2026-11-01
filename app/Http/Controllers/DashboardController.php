<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!in_array($user->role, ['masyarakat', 'uptd', 'supir', 'admin'])) {
            abort(403, 'Role akun tidak dikenali.');
        }

        return redirect()->route('dashboard.role', [
            'role' => $user->role,
        ]);
    }

    public function show(string $role)
    {
        $user = auth()->user();

        $roles = [
            'masyarakat' => 'Masyarakat',
            'uptd' => 'UPTD',
            'supir' => 'Supir',
            'admin' => 'Admin',
        ];

        abort_unless(array_key_exists($role, $roles), 404);
        abort_unless($user->role === $role, 403);

        // Arahkan Supir ke dashboard khusus Supir.
        if ($role === 'supir') {
            return redirect()->route('supir.dashboard');
        }

        // Arahkan Admin ke dashboard khusus Admin.
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $query = Laporan::query();

        if ($role === 'masyarakat') {
            $query->where('id_pengguna', $user->id);
        } elseif ($role === 'uptd') {
            abort_if(
                empty($user->id_wilayah),
                403,
                'Akun UPTD belum memiliki wilayah kerja.'
            );

            $query->whereHas('tps', function ($tps) use ($user) {
                $tps->where('id_wilayah', $user->id_wilayah);
            });
        }

        $totalLaporan = (clone $query)->count();

        $laporanMenunggu = (clone $query)
            ->where('status_laporan', 'menunggu')
            ->count();

        $laporanDiproses = (clone $query)
            ->whereIn('status_laporan', ['diproses', 'ditangani'])
            ->count();

        $laporanSelesai = (clone $query)
            ->where('status_laporan', 'selesai')
            ->count();

        $laporanTerbaru = (clone $query)
            ->with('tps')
            ->latest('waktu_pelaporan')
            ->take(5)
            ->get();

// Data grafik status laporan
$grafikStatus = [
    (clone $query)->where('status_laporan', 'menunggu')->count(),
    (clone $query)->whereIn('status_laporan', ['diproses', 'ditangani'])->count(),
    (clone $query)->where('status_laporan', 'selesai')->count(),
];

// Data grafik tren laporan 7 hari terakhir
$grafikTrenLabel = [];
$grafikTrenData = [];

for ($i = 6; $i >= 0; $i--) {
    $tanggal = now()->subDays($i);

    $grafikTrenLabel[] = $tanggal->format('d M');

    $grafikTrenData[] = (clone $query)
        ->whereDate('waktu_pelaporan', $tanggal->toDateString())
        ->count();
}


        return view(
            $role === 'masyarakat'
                ? 'masyarakat.laporan.dashboard'
                : 'dashboard.index',
            [
                'role' => $role,
                'roleLabel' => $roles[$role],
                'totalLaporan' => $totalLaporan,
                'laporanMenunggu' => $laporanMenunggu,
                'laporanDiproses' => $laporanDiproses,
                'laporanSelesai' => $laporanSelesai,
                'laporanTerbaru' => $laporanTerbaru,
		'grafikStatus' => $grafikStatus,
		'grafikTrenLabel' => $grafikTrenLabel,
		'grafikTrenData' => $grafikTrenData,
            ]
        );
    }
}