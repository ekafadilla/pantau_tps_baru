<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with('tps')
            ->where('id_pengguna', Auth::id());

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('kategori_kondisi', 'like', "%{$cari}%")
                    ->orWhere('lokasi', 'like', "%{$cari}%")
                    ->orWhereHas('tps', function ($tps) use ($cari) {
                        $tps->where('nama_tps', 'like', "%{$cari}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status_laporan', $request->status);
        }

        $laporan = $query
            ->latest('waktu_pelaporan')
            ->paginate(10)
            ->withQueryString();

        $totalLaporan = Laporan::where('id_pengguna', Auth::id())->count();

        $laporanBerjalan = Laporan::where('id_pengguna', Auth::id())
            ->whereIn('status_laporan', [
                'menunggu',
                'diverifikasi',
                'diproses',
                'ditangani',
            ])
            ->count();

        $laporanSelesai = Laporan::where('id_pengguna', Auth::id())
            ->where('status_laporan', 'selesai')
            ->count();

        return view('masyarakat.laporan.index', compact(
            'laporan',
            'totalLaporan',
            'laporanBerjalan',
            'laporanSelesai'
        ));
    }

    public function create()
    {
        $tps = Tps::orderBy('nama_tps')->get();

        return view('masyarakat.laporan.create', compact('tps'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_tps' => ['required', 'exists:tps,id'],
            'kategori_kondisi' => ['required', 'string', 'max:100'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['required', 'string', 'max:2000'],
            'foto' => ['required', 'array', 'min:1', 'max:5'],
            'foto.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $fotoTersimpan = [];

        try {
            DB::transaction(function () use ($validated, $request, &$fotoTersimpan) {
                $laporan = Laporan::create([
                    'id_pengguna' => Auth::id(),
                    'id_tps' => $validated['id_tps'],
                    'kategori_kondisi' => $validated['kategori_kondisi'],
                    'lokasi' => $validated['lokasi'] ?? null,
                    'keterangan' => $validated['keterangan'],
                    'waktu_pelaporan' => now(),
                    'status_laporan' => 'menunggu',
                ]);

                foreach ($request->file('foto', []) as $foto) {
                    $path = $foto->store('foto-laporan', 'public');
                    $fotoTersimpan[] = $path;

                    $laporan->fotoLaporans()->create([
                        'nama_file' => $foto->getClientOriginalName(),
                        'path_foto' => $path,
                    ]);
                }

                $laporan->riwayatStatuses()->create([
                    'id_pengguna' => Auth::id(),
                    'status_sebelumnya' => null,
                    'status_baru' => 'menunggu',
                    'catatan' => 'Laporan dibuat oleh masyarakat.',
                    'waktu_perubahan' => now(),
                ]);
            });
        } catch (\Throwable $e) {
            foreach ($fotoTersimpan as $path) {
                Storage::disk('public')->delete($path);
            }

            throw $e;
        }

        return redirect()
            ->route('masyarakat.laporan.index')
            ->with('success', 'Laporan berhasil dikirim.');
    }
    public function show(Laporan $laporan)
{
    // Pengguna hanya boleh melihat laporannya sendiri.
    abort_unless(
        (int) $laporan->id_pengguna === (int) auth()->id(),
        403
    );

    $laporan->load([
        'tps',
        'fotoLaporan',
        'riwayatStatus',
    ]);

    return view('masyarakat.laporan.show', compact('laporan'));
}
}