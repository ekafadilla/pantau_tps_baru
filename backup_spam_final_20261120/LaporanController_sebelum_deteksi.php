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
            'latitude' => ['required', 'numeric', new \App\Rules\DalamWilayahLayanan('lat')],
            'longitude' => ['required', 'numeric', new \App\Rules\DalamWilayahLayanan('lng')],
            'keterangan' => ['required', 'string', 'max:2000'],
            'foto' => ['required', 'array', 'min:1', 'max:5'],
            'foto.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'kepenuhan_tps' => ['required', 'integer', 'between:1,4'],
            'sampah_meluber' => ['required', 'integer', 'between:1,4'],
            'dampak_lingkungan' => ['required', 'integer', 'between:1,4'],
            'bau_hama' => ['required', 'integer', 'between:1,4'],
            'gangguan_masyarakat' => ['required', 'integer', 'between:1,4'],
        ]);

        $nilai = [
            'kepenuhan_tps' => $validated['kepenuhan_tps'],
            'sampah_meluber' => $validated['sampah_meluber'],
            'dampak_lingkungan' => $validated['dampak_lingkungan'],
            'bau_hama' => $validated['bau_hama'],
            'gangguan_masyarakat' => $validated['gangguan_masyarakat'],
        ];

        $hasilUrgensi = app(\App\Services\UrgensiCalculator::class)
            ->hitung($nilai);

        $fotoTersimpan = [];

        try {
            DB::transaction(function () use (
                $validated,
                $request,
                $nilai,
                $hasilUrgensi,
                &$fotoTersimpan
            ) {
                $laporan = Laporan::create([
                    'id_pengguna' => Auth::id(),
                    'id_tps' => $validated['id_tps'],
                    'kategori_kondisi' => $validated['kategori_kondisi'],
                    'lokasi' => $validated['lokasi'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
                    'keterangan' => $validated['keterangan'],
                    'waktu_pelaporan' => now(),
                    'status_laporan' => 'menunggu',
                ]);

                $laporan->penilaianUrgensis()->create([
                    'jenis_penilaian' => 'masyarakat',
                    'id_penilai' => Auth::id(),
                    ...$nilai,
                    'skor_urgensi' => $hasilUrgensi['skor_urgensi'],
                    'rekomendasi_urgensi' => $hasilUrgensi['rekomendasi_urgensi'],
                    'catatan' => null,
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

        // After laporan berhasil disimpan, perbarui statistik TPS
        // 1. Update timestamp laporan terakhir
        $tps->update([
            'last_reported_at' => now(),
        ]);

        // 2. Jika TPS masih berstatus "bersih" namun laporan menyatakan masalah,
        //    ubah status menjadi "terlapor" agar petugas tahu ada keluhan.
        if ($tps->status === 'bersih' && $validated['kategori_kondisi'] !== 'bersih') {
            $tps->update(['status' => 'terlapor']);
        }

        // 3. Hitung berapa banyak reporter berbeda yang melaporkan TPS ini dalam 24 jam terakhir.
        $uniqueReporters = \App\Models\Laporan::where('id_tps', $tps->id)
            ->where('created_at', '>=', now()->subDay())
            ->distinct('id_pengguna')
            ->count('id_pengguna');
        if ($uniqueReporters >= 5) {
            // Tandai TPS sebagai "potensi_spam" (bisa ditambahkan kolom atau cache)
            $tps->update(['status' => 'potensi_spam']);
        }

        // 4. Deteksi laporan berulang dari user yang sama dalam 1‑2 minggu.
        $repeatCount = \App\Models\Laporan::where('id_tps', $tps->id)
            ->where('id_pengguna', Auth::id())
            ->whereBetween('created_at', [now()->subWeeks(2), now()])
            ->count();
        if ($repeatCount > 1) {
            // Bisa memberi peringatan atau menambah skor spam pengguna.
            \App\Models\User::where('id', Auth::id())->increment('spam_score');
        }

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
        'fotoLaporans',
        'riwayatStatuses',
    ]);

    return view('masyarakat.laporan.show', compact('laporan'));
}
}


