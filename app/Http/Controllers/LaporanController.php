<?php

namespace App\Http\Controllers;

use App\Models\DeteksiSpam;
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
            'latitude' => [
                'required',
                'numeric',
                new \App\Rules\DalamWilayahLayanan('lat'),
            ],
            'longitude' => [
                'required',
                'numeric',
                new \App\Rules\DalamWilayahLayanan('lng'),
            ],
            'keterangan' => ['required', 'string', 'max:2000'],
            'foto' => ['required', 'array', 'min:1', 'max:5'],
            'foto.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
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

        $tps = Tps::findOrFail($validated['id_tps']);
        $fotoTersimpan = [];

        try {
            DB::transaction(function () use (
                $validated,
                $request,
                $nilai,
                $hasilUrgensi,
                $tps,
                &$fotoTersimpan
            ) {
                $waktuLaporan = now();

                $laporan = Laporan::create([
                    'id_pengguna' => Auth::id(),
                    'id_tps' => $tps->id,
                    'kategori_kondisi' => $validated['kategori_kondisi'],
                    'lokasi' => $validated['lokasi'] ?? null,
                    'latitude' => $validated['latitude'],
                    'longitude' => $validated['longitude'],
                    'keterangan' => $validated['keterangan'],
                    'waktu_pelaporan' => $waktuLaporan,
                    'status_laporan' => 'menunggu',
                ]);

                // Simpan penilaian urgensi masyarakat.
                $laporan->penilaianUrgensis()->create([
                    'jenis_penilaian' => 'masyarakat',
                    'id_penilai' => Auth::id(),
                    ...$nilai,
                    'skor_urgensi' => $hasilUrgensi['skor_urgensi'],
                    'rekomendasi_urgensi' => $hasilUrgensi['rekomendasi_urgensi'],
                    'catatan' => null,
                ]);

                // Simpan seluruh foto laporan.
                foreach ($request->file('foto', []) as $foto) {
                    $path = $foto->store('foto-laporan', 'public');
                    $fotoTersimpan[] = $path;

                    $laporan->fotoLaporans()->create([
                        'nama_file' => $foto->getClientOriginalName(),
                        'path_foto' => $path,
                    ]);
                }

                // Simpan riwayat awal laporan.
                $laporan->riwayatStatuses()->create([
                    'id_pengguna' => Auth::id(),
                    'status_sebelumnya' => null,
                    'status_baru' => 'menunggu',
                    'catatan' => 'Laporan dibuat oleh masyarakat.',
                    'waktu_perubahan' => $waktuLaporan,
                ]);

                // Perbarui informasi TPS tanpa mengubah status menjadi spam.
                $tps->last_reported_at = $waktuLaporan;

                if (
                    $tps->status === 'bersih' &&
                    strtolower($validated['kategori_kondisi']) !== 'bersih'
                ) {
                    $tps->status = 'terlapor';
                }

                $tps->save();

                // DETEKSI 1: laporan berulang dari pengguna yang sama
                // pada TPS yang sama dalam 7 hari terakhir.
                $batasTujuhHari = $waktuLaporan->copy()->subDays(7);

                $laporanBerulang = Laporan::where('id_tps', $tps->id)
                    ->where('id_pengguna', Auth::id())
                    ->whereBetween('waktu_pelaporan', [
                        $batasTujuhHari,
                        $waktuLaporan,
                    ]);

                $jumlahLaporanBerulang = $laporanBerulang->count();

                if ($jumlahLaporanBerulang > 1) {
                    DeteksiSpam::create([
                        'id_laporan' => $laporan->id,
                        'id_tps' => $tps->id,
                        'id_pengguna' => Auth::id(),
                        'jenis_deteksi' => 'laporan_berulang',
                        'jumlah_laporan' => $jumlahLaporanBerulang,
                        'jumlah_pengguna' => 1,
                        'periode_mulai' => $laporanBerulang
                            ->min('waktu_pelaporan'),
                        'periode_selesai' => $waktuLaporan,
                        'status_peninjauan' => 'perlu_ditinjau',
                    ]);
                }

                // DETEKSI 2: lonjakan laporan dari minimal 5 pengguna
                // berbeda pada TPS yang sama dalam 24 jam.
                $batasDuaPuluhEmpatJam = $waktuLaporan
                    ->copy()
                    ->subDay();

                $laporan24Jam = Laporan::where('id_tps', $tps->id)
                    ->whereBetween('waktu_pelaporan', [
                        $batasDuaPuluhEmpatJam,
                        $waktuLaporan,
                    ]);

                $jumlahPenggunaBerbeda = (clone $laporan24Jam)
                    ->distinct()
                    ->count('id_pengguna');

                if ($jumlahPenggunaBerbeda >= 5) {
                    $jumlahLaporan24Jam = (clone $laporan24Jam)->count();

                    $periodeMulai = (clone $laporan24Jam)
                        ->min('waktu_pelaporan');

                    $deteksiAktif = DeteksiSpam::where('id_tps', $tps->id)
                        ->where('jenis_deteksi', 'lonjakan_laporan_tps')
                        ->where('status_peninjauan', 'perlu_ditinjau')
                        ->where('periode_selesai', '>=', $batasDuaPuluhEmpatJam)
                        ->latest('id')
                        ->first();

                    if ($deteksiAktif) {
                        // Perbarui catatan deteksi yang masih ditinjau.
                        $deteksiAktif->update([
                            'id_laporan' => $laporan->id,
                            'jumlah_laporan' => $jumlahLaporan24Jam,
                            'jumlah_pengguna' => $jumlahPenggunaBerbeda,
                            'periode_mulai' => $periodeMulai,
                            'periode_selesai' => $waktuLaporan,
                        ]);
                    } else {
                        DeteksiSpam::create([
                            'id_laporan' => $laporan->id,
                            'id_tps' => $tps->id,
                            'id_pengguna' => null,
                            'jenis_deteksi' => 'lonjakan_laporan_tps',
                            'jumlah_laporan' => $jumlahLaporan24Jam,
                            'jumlah_pengguna' => $jumlahPenggunaBerbeda,
                            'periode_mulai' => $periodeMulai,
                            'periode_selesai' => $waktuLaporan,
                            'status_peninjauan' => 'perlu_ditinjau',
                        ]);
                    }
                }
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