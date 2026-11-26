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

    private function pastikanDiWilayah(Laporan $laporan): void
    {
        $diWilayah = $this->laporanWilayah()
            ->where('id', $laporan->id)
            ->exists();

        abort_unless($diWilayah, 404);
    }

    public function index(Request $request)
    {
        $query = $this->laporanWilayah()
            ->with([
                'tps:id,nama_tps,status,last_reported_at,last_cleaned_at',
                'pengguna',
                'supir',
            ]);

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
            'menunggu_pemeriksaan',
            'perlu_perbaikan',
            'selesai',
            'ditolak',
        ];

        if ($request->filled('status')
            && in_array($request->status, $statusValid, true)) {
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
            'diverifikasi',
            'diproses',
            'ditangani',
            'menunggu_pemeriksaan',
            'perlu_perbaikan',
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

        $this->pastikanDiWilayah($laporan);

        $laporan->load([
            'tps',
            'pengguna',
            'supir',
            'armada',
            'fotoLaporans',
            'buktiPenanganans.supir',
            'riwayatStatuses.pengguna',
            'penilaianUrgensis.penilai',
        ]);

        // Tampilkan semua supir dari wilayah UPTD beserta kondisi kehadirannya
        $supirList = User::where('role', 'supir')
            ->where('id_wilayah', $user->id_wilayah)
            ->withCount([
                'tugasSupir as tugas_aktif_count' => function ($query) {
                    $query->whereIn('status_laporan', [
                        'diproses',
                        'ditangani',
                        'menunggu_pemeriksaan',
                        'perlu_perbaikan',
                    ]);
                },
            ])
            ->with(['tpsTugas' => function ($query) use ($laporan) {
                $query->where('tps.id', $laporan->id_tps)
                    ->where('supir_tps.status', true);
            }])
            ->orderBy('name')
            ->get()
            ->each(function ($supir) {
                $supir->boleh_ditugaskan = false;
                $supir->alasan_tidak_tersedia = null;

                if ((int) $supir->tugas_aktif_count > 0) {
                    $supir->status_penugasan = 'Sedang bertugas';
                    $supir->alasan_tidak_tersedia = 'Supir sedang menangani laporan lain.';
                } elseif ($supir->status_kehadiran !== 'tersedia') {
                    $supir->status_penugasan = ucwords(str_replace(
                        '_',
                        ' ',
                        $supir->status_kehadiran ?: 'tidak diketahui'
                    ));
                    $supir->alasan_tidak_tersedia = 'Supir tidak sedang tersedia.';
                } elseif ($supir->tpsTugas->isEmpty()) {
                    $supir->status_penugasan = 'Belum terdaftar di TPS ini';
                    $supir->alasan_tidak_tersedia = 'Supir belum memiliki penugasan aktif pada TPS laporan ini.';
                } else {
                    $supir->status_penugasan = 'Tersedia';
                    $supir->boleh_ditugaskan = true;
                }
            });
        // Hanya tampilkan armada tersedia dari wilayah yang sama
        $armadaList = Armada::where('id_wilayah', $user->id_wilayah)
            ->where('status_armada', 'tersedia')
            ->orderBy('kode_armada')
            ->get();

        return view('uptd.laporan.show', compact('laporan', 'supirList', 'armadaList'));
    }

    // Tahap 2: penilaian ulang urgensi, hanya setelah laporan diverifikasi
    public function verifikasiUrgensi(Request $request, Laporan $laporan)
    {
        $this->pastikanDiWilayah($laporan);

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
            $daftarCatatan[] = 'Alasan perubahan keputusan: '.$validated['alasan_perubahan'];
        }

        if (!empty(trim($validated['catatan'] ?? ''))) {
            $daftarCatatan[] = 'Catatan pemeriksaan: '.$validated['catatan'];
        }

        $catatan = count($daftarCatatan) > 0
            ? implode("\n", $daftarCatatan)
            : null;

        DB::transaction(function () use ($laporan, $nilai, $hasil, $validated, $catatan) {
            $terkunci = Laporan::whereKey($laporan->id)->lockForUpdate()->firstOrFail();

            abort_unless(
                in_array($terkunci->status_laporan, ['menunggu', 'diverifikasi'], true),
                422, 'Penilaian urgensi tidak dapat dilakukan pada status laporan ini.'
            );

            $terkunci->penilaianUrgensis()->create(array_merge(
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

            $terkunci->update([
                'tingkat_urgensi' => $validated['tingkat_urgensi'],
            ]);
        });

        return back()->with('success', 'Penilaian ulang berhasil disimpan dan urgensi akhir telah ditetapkan.');
    }

    // Tahap 1: verifikasi awal, hanya dari status menunggu
    public function verifikasi(Laporan $laporan)
    {
        $this->pastikanDiWilayah($laporan);

        DB::transaction(function () use ($laporan) {
            $terkunci = Laporan::whereKey($laporan->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $terkunci->status_laporan === 'menunggu',
                422,
                'Laporan tidak dalam status menunggu.'
            );

            $statusLama = $terkunci->status_laporan;

            $terkunci->update([
                'status_laporan' => 'diverifikasi',
            ]);

            RiwayatStatus::create([
                'id_laporan' => $terkunci->id,
                'id_pengguna' => auth()->id(),
                'status_sebelumnya' => $statusLama,
                'status_baru' => 'diverifikasi',
                'catatan' => 'Laporan telah diverifikasi oleh petugas UPTD.',
                'waktu_perubahan' => now(),
            ]);
        });

        return back()->with('success', 'Laporan berhasil diverifikasi. Silakan lanjutkan penilaian urgensi.');
    }

    // Tahap 3: penugasan, hanya dari status diverifikasi dan sudah ada urgensi akhir
    public function tugaskan(Request $request, Laporan $laporan)
    {
        $user = auth()->user();

        $this->pastikanDiWilayah($laporan);

        $validated = $request->validate([
            'id_supir' => ['required', 'exists:users,id'],
            'id_armada' => ['nullable', 'exists:armadas,id'],
            'target_waktu' => ['nullable', 'date'],
            'instruksi_penanganan' => ['nullable', 'string', 'max:1000'],
        ]);

        // Supir harus dari wilayah yang sama dan punya penugasan aktif pada TPS laporan
        $supir = User::where('id', $validated['id_supir'])
            ->where('role', 'supir')
            ->where('id_wilayah', $user->id_wilayah)
            ->where('status_kehadiran', 'tersedia')
            ->whereDoesntHave('tugasSupir', function ($query) {
                $query->whereIn('status_laporan', [
                    'diproses',
                    'ditangani',
                    'menunggu_pemeriksaan',
                    'perlu_perbaikan',
                ]);
            })
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

        // Armada harus dari wilayah yang sama
        if (!empty($validated['id_armada'])) {
            $armada = Armada::where('id', $validated['id_armada'])
                ->where('id_wilayah', $user->id_wilayah)
                ->where('status_armada', 'tersedia')
                ->first();

            abort_unless(
                $armada,
                422,
                'Armada tidak tersedia atau bukan dari wilayah Anda.'
            );
        }

        DB::transaction(function () use ($laporan, $validated, $user) {
            $terkunci = Laporan::whereKey($laporan->id)->lockForUpdate()->firstOrFail();

            abort_unless(
                $terkunci->status_laporan === 'diverifikasi',
                422,
                'Laporan harus diverifikasi terlebih dahulu sebelum ditugaskan.'
            );

            abort_unless(
                !empty($terkunci->tingkat_urgensi),
                422,
                'Tetapkan urgensi akhir melalui penilaian UPTD sebelum menugaskan supir.'
            );

            // Kunci dan periksa ulang supir agar tidak menerima tugas bersamaan
            $supir = User::whereKey($validated['id_supir'])
                ->lockForUpdate()
                ->first();

            abort_unless(
                $supir
                && $supir->role === 'supir'
                && (int) $supir->id_wilayah === (int) $user->id_wilayah
                && $supir->status_kehadiran === 'tersedia'
                && $supir->tpsTugas()
                    ->where('tps.id', $laporan->id_tps)
                    ->where('supir_tps.status', true)
                    ->exists()
                && !$supir->tugasSupir()
                    ->whereIn('status_laporan', [
                        'diproses',
                        'ditangani',
                        'menunggu_pemeriksaan',
                        'perlu_perbaikan',
                    ])
                    ->exists(),
                422,
                'Supir sudah tidak tersedia atau sedang menangani tugas lain.'
            );
            // Kunci dan periksa ulang armada agar tidak dipakai oleh tugas lain
            $armada = null;

            if (!empty($validated['id_armada'])) {
                $armada = Armada::whereKey($validated['id_armada'])
                    ->lockForUpdate()
                    ->first();

                abort_unless(
                    $armada
                    && (int) $armada->id_wilayah === (int) $user->id_wilayah
                    && $armada->status_armada === 'tersedia',
                    422,
                    'Armada sudah tidak tersedia atau bukan dari wilayah Anda.'
                );
            }

            $statusLama = $terkunci->status_laporan;

            $terkunci->update([
                'id_supir' => $validated['id_supir'],
                'id_armada' => $validated['id_armada'] ?? null,
                'target_waktu' => $validated['target_waktu'] ?? null,
                'instruksi_penanganan' => $validated['instruksi_penanganan'] ?? null,
                'status_laporan' => 'diproses',
                'waktu_mulai' => now(),
            ]);

            if ($armada) {
                $armada->update(['status_armada' => 'digunakan']);
            }

            RiwayatStatus::create([
                'id_laporan' => $terkunci->id,
                'id_pengguna' => auth()->id(),
                'status_sebelumnya' => $statusLama,
                'status_baru' => 'diproses',
                'catatan' => 'Laporan ditugaskan kepada supir: '.$supir->name.'. '.($validated['instruksi_penanganan'] ?? ''),
                'waktu_perubahan' => now(),
            ]);
        });

        return back()->with('success', 'Laporan berhasil ditugaskan kepada '.$supir->name.'.');
    }

    public function tolak(Request $request, Laporan $laporan)
    {
        $this->pastikanDiWilayah($laporan);

        $validated = $request->validate([
            'catatan_tolak' => ['required', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($laporan, $validated) {
            $terkunci = Laporan::whereKey($laporan->id)->lockForUpdate()->firstOrFail();

            abort_unless(
                in_array($terkunci->status_laporan, ['menunggu', 'diverifikasi'], true),
                422,
                'Laporan tidak dapat ditolak pada status ini.'
            );

            $statusLama = $terkunci->status_laporan;
            $terkunci->update(['status_laporan' => 'ditolak']);

            RiwayatStatus::create([
                'id_laporan' => $terkunci->id,
                'id_pengguna' => auth()->id(),
                'status_sebelumnya' => $statusLama,
                'status_baru' => 'ditolak',
                'catatan' => $validated['catatan_tolak'],
                'waktu_perubahan' => now(),
            ]);
        });

        return back()->with('success', 'Laporan telah ditolak.');
    }

    // 2. Proses Pembatalan / Penolakan Laporan (Spam / Urgensi)
    public function batalkan(Request $request, $id)
    {
        $request->validate([
            'alasan_batal' => 'required|string|max:255',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status_laporan' => 'ditolak', // sesuaikan dengan enum/nilai status di DB Anda
            'catatan_uptd' => $request->alasan_batal,
        ]);

        // Opsional: Jika ditandai spam, tambah spam_score pelapor
        if (str_contains(strtolower($request->alasan_batal), 'spam') && $laporan->user) {
            $laporan->user->increment('spam_score');
        }

        return redirect()->route('uptd.laporan.index')
            ->with('success', 'Laporan berhasil dibatalkan.');
    }

    // Tahap pemeriksaan bukti penanganan oleh UPTD
    public function setujuiBukti(Laporan $laporan)
    {
        $this->pastikanDiWilayah($laporan);

        DB::transaction(function () use ($laporan) {
            $terkunci = Laporan::whereKey($laporan->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $terkunci->status_laporan === 'menunggu_pemeriksaan',
                422,
                'Bukti penanganan belum siap diperiksa atau sudah diproses.'
            );

            $statusLama = $terkunci->status_laporan;

            $terkunci->update([
                'status_laporan' => 'selesai',
            ]);

            // Kembalikan armada jika tidak ada tugas aktif lain
            if ($terkunci->id_armada) {
                $armada = Armada::whereKey($terkunci->id_armada)
                    ->lockForUpdate()
                    ->first();

                if ($armada && $armada->status_armada === 'digunakan') {
                    $masihDigunakan = Laporan::where('id_armada', $armada->id)
                        ->whereIn('status_laporan', [
                            'diproses',
                            'ditangani',
                            'menunggu_pemeriksaan',
                            'perlu_perbaikan',
                        ])
                        ->exists();

                    if (!$masihDigunakan) {
                        $armada->update([
                            'status_armada' => 'tersedia',
                        ]);
                    }
                }
            }
            RiwayatStatus::create([
                'id_laporan' => $terkunci->id,
                'id_pengguna' => auth()->id(),
                'status_sebelumnya' => $statusLama,
                'status_baru' => 'selesai',
                'catatan' => 'Bukti penanganan telah diperiksa dan disetujui oleh UPTD.',
                'waktu_perubahan' => now(),
            ]);
        });

        return back()->with('success', 'Bukti penanganan disetujui. Laporan telah selesai.');
    }

    public function mintaPerbaikanBukti(Request $request, Laporan $laporan)
    {
        $this->pastikanDiWilayah($laporan);

        $validated = $request->validate([
            'catatan_perbaikan' => ['required', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($laporan, $validated) {
            $terkunci = Laporan::whereKey($laporan->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_unless(
                $terkunci->status_laporan === 'menunggu_pemeriksaan',
                422,
                'Bukti penanganan belum siap diperiksa atau sudah diproses.'
            );

            $statusLama = $terkunci->status_laporan;

            $terkunci->update([
                'status_laporan' => 'perlu_perbaikan',
            ]);

            RiwayatStatus::create([
                'id_laporan' => $terkunci->id,
                'id_pengguna' => auth()->id(),
                'status_sebelumnya' => $statusLama,
                'status_baru' => 'perlu_perbaikan',
                'catatan' => $validated['catatan_perbaikan'],
                'waktu_perubahan' => now(),
            ]);
        });

        return back()->with('success', 'Permintaan perbaikan bukti berhasil dikirim kepada supir.');
    }
}
