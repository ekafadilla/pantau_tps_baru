<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Laporan;
use App\Models\RiwayatStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->with(['tps', 'pengguna', 'supir']);

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
        $user = auth()->user();

        $diWilayah = $this->laporanWilayah()
            ->where('id', $laporan->id)
            ->exists();

        abort_unless($diWilayah, 404);

        $laporan->load([
            'tps',
            'pengguna',
            'supir',
            'armada',
            'fotoLaporans',
            'riwayatStatuses.pengguna',
            'penilaianUrgensis.penilai',
        ]);

        // Daftar supir aktif yang ditugaskan pada TPS laporan ini
        $supirList = User::where('role', 'supir')
            ->where('id_wilayah', $user->id_wilayah)
            ->whereHas('tpsTugas', function ($query) use ($laporan) {
                $query->where('tps.id', $laporan->id_tps)
                    ->where('supir_tps.status', true);
            })
            ->with(['tpsTugas' => function ($query) use ($laporan) {
                $query->where('tps.id', $laporan->id_tps)
                    ->where('supir_tps.status', true);
            }])
            ->orderBy('name')
            ->get();

        // Daftar armada dari wilayah yang sama
        $armadaList = Armada::where('id_wilayah', $user->id_wilayah)
            ->orderBy('kode_armada')
            ->get();

        return view('uptd.laporan.show', compact('laporan', 'supirList', 'armadaList'));
    }


    public function verifikasiUrgensi(Request $request, Laporan $laporan)
    {
        $diWilayah = $this->laporanWilayah()
            ->where('id', $laporan->id)
            ->exists();

        abort_unless($diWilayah, 404);

        abort_unless(
            in_array($laporan->status_laporan, ['menunggu', 'diverifikasi']),
            422,
            'Penilaian urgensi hanya dapat dilakukan pada laporan yang masih aktif.'
        );


        $validated = $request->validate([
            'kepenuhan_tps' => ['required', 'integer', 'between:1,4'],
            'sampah_meluber' => ['required', 'integer', 'between:1,4'],
            'dampak_lingkungan' => ['required', 'integer', 'between:1,4'],
            'bau_hama' => ['required', 'integer', 'between:1,4'],
            'gangguan_masyarakat' => ['required', 'integer', 'between:1,4'],
            'tingkat_urgensi' => ['required', 'in:rendah,sedang,tinggi,sangat_tinggi'],
            'alasan_perubahan' => ['nullable', 'string', 'max:1000'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ]);

        $nilai = [
            'kepenuhan_tps' => (int) $validated['kepenuhan_tps'],
            'sampah_meluber' => (int) $validated['sampah_meluber'],
            'dampak_lingkungan' => (int) $validated['dampak_lingkungan'],
            'bau_hama' => (int) $validated['bau_hama'],
            'gangguan_masyarakat' => (int) $validated['gangguan_masyarakat'],
        ];

        $hasil = app(\App\Services\UrgensiCalculator::class)->hitung($nilai);

        if ($validated['tingkat_urgensi'] !== $hasil['rekomendasi_urgensi']
            && empty(trim($validated['alasan_perubahan'] ?? ''))) {
            return back()
                ->withErrors([
                    'alasan_perubahan' => 'Alasan wajib diisi jika keputusan berbeda dari rekomendasi sistem.',
                ])
                ->withInput();
        }

        $daftarCatatan = [];

        if (!empty(trim($validated['alasan_perubahan'] ?? ''))) {
            $daftarCatatan[] = 'Alasan perubahan keputusan: ' . $validated['alasan_perubahan'];
        }

        if (!empty(trim($validated['catatan'] ?? ''))) {
            $daftarCatatan[] = 'Catatan pemeriksaan: ' . $validated['catatan'];
        }

        $catatan = count($daftarCatatan) > 0
            ? implode("\n", $daftarCatatan)
            : null;

        DB::transaction(function () use ($laporan, $nilai, $hasil, $validated, $catatan) {
            $laporan->penilaianUrgensis()->create(array_merge(
                [
                    'jenis_penilaian' => 'uptd',
                    'id_penilai' => auth()->id(),
                ],
                $nilai,
                [
                    'skor_urgensi' => $hasil['skor_urgensi'],
                    'rekomendasi_urgensi' => $hasil['rekomendasi_urgensi'],
                    'catatan' => $catatan,
                ]
            ));

            $laporan->update([
                'tingkat_urgensi' => $validated['tingkat_urgensi'],
            ]);
        });

        return back()->with('success', 'Penilaian ulang berhasil disimpan dan urgensi akhir telah ditetapkan.');
    }
    public function verifikasi(Laporan $laporan)
    {
        $diWilayah = $this->laporanWilayah()
            ->where('id', $laporan->id)
            ->exists();

        abort_unless($diWilayah, 404);
        abort_unless($laporan->status_laporan === 'menunggu', 422, 'Laporan tidak dalam status menunggu.');

        $statusLama = $laporan->status_laporan;
        $laporan->update(['status_laporan' => 'diverifikasi']);

        RiwayatStatus::create([
            'id_laporan'        => $laporan->id,
            'id_pengguna'       => auth()->id(),
            'status_sebelumnya' => $statusLama,
            'status_baru'       => 'diverifikasi',
            'catatan'           => 'Laporan telah diverifikasi oleh UPTD.',
            'waktu_perubahan'   => now(),
        ]);

        return back()->with('success', 'Laporan berhasil diverifikasi.');
    }

    public function tugaskan(Request $request, Laporan $laporan)
    {
        $user = auth()->user();

        $diWilayah = $this->laporanWilayah()
            ->where('id', $laporan->id)
            ->exists();

        abort_unless($diWilayah, 404);

        abort_unless(
            !empty($laporan->tingkat_urgensi),
            422,
            'Tetapkan urgensi akhir melalui penilaian UPTD sebelum menugaskan supir.'
        );

        abort_unless(
            in_array($laporan->status_laporan, ['diverifikasi', 'menunggu'], true),
            422,
            'Laporan tidak dapat ditugaskan pada status ini.'
        );

        $validated = $request->validate([
            'id_supir'             => ['required', 'exists:users,id'],
            'id_armada'            => ['nullable', 'exists:armadas,id'],
            'target_waktu'         => ['nullable', 'date'],
            'instruksi_penanganan' => ['nullable', 'string', 'max:1000'],
        ]);

        // Pastikan supir berasal dari wilayah yang sama
        // dan memiliki penugasan aktif pada TPS laporan
        $supir = User::where('id', $validated['id_supir'])
            ->where('role', 'supir')
            ->where('id_wilayah', $user->id_wilayah)
            ->whereHas('tpsTugas', function ($query) use ($laporan) {
                $query->where('tps.id', $laporan->id_tps)
                    ->where('supir_tps.status', true);
            })
            ->first();

        abort_unless(
            $supir,
            422,
            'Supir tidak terdaftar pada TPS ini atau penugasannya tidak aktif.'
        );

        // Pastikan armada berasal dari wilayah yang sama
        if (!empty($validated['id_armada'])) {
            $armada = Armada::where('id', $validated['id_armada'])
                ->where('id_wilayah', $user->id_wilayah)
                ->first();

            abort_unless($armada, 422, 'Armada tidak valid atau bukan dari wilayah Anda.');
        }

        $statusLama = $laporan->status_laporan;

        $laporan->update([
            'id_supir'             => $validated['id_supir'],
            'id_armada'            => $validated['id_armada'] ?? null,
            'target_waktu'         => $validated['target_waktu'] ?? null,
            'instruksi_penanganan' => $validated['instruksi_penanganan'] ?? null,
            'status_laporan'       => 'diproses',
            'waktu_mulai'          => now(),
        ]);

        RiwayatStatus::create([
            'id_laporan'        => $laporan->id,
            'id_pengguna'       => auth()->id(),
            'status_sebelumnya' => $statusLama,
            'status_baru'       => 'diproses',
            'catatan'           => 'Laporan ditugaskan kepada supir: ' . $supir->name . '. ' . ($validated['instruksi_penanganan'] ?? ''),
            'waktu_perubahan'   => now(),
        ]);

        return back()->with('success', 'Laporan berhasil ditugaskan kepada ' . $supir->name . '.');
    }
    public function tolak(Request $request, Laporan $laporan)
    {
        $diWilayah = $this->laporanWilayah()
            ->where('id', $laporan->id)
            ->exists();

        abort_unless($diWilayah, 404);
        abort_unless(
            in_array($laporan->status_laporan, ['menunggu', 'diverifikasi'], true),
            422,
            'Laporan tidak dapat ditolak pada status ini.'
        );

        $validated = $request->validate([
            'catatan_tolak' => ['required', 'string', 'max:500'],
        ]);

        $statusLama = $laporan->status_laporan;
        $laporan->update(['status_laporan' => 'ditolak']);

        RiwayatStatus::create([
            'id_laporan'        => $laporan->id,
            'id_pengguna'       => auth()->id(),
            'status_sebelumnya' => $statusLama,
            'status_baru'       => 'ditolak',
            'catatan'           => $validated['catatan_tolak'],
            'waktu_perubahan'   => now(),
        ]);

        return back()->with('success', 'Laporan telah ditolak.');
    }
}

