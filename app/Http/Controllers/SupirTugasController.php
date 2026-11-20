<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\BuktiPenanganan;
use Illuminate\Http\Request;

class SupirTugasController extends Controller
{
    // Mengambil tugas milik supir yang sedang login
    private function tugasMilikSupir()
    {
        return Laporan::where('id_supir', auth()->id());
    }


    // ==========================================
    // DAFTAR TUGAS
    // ==========================================

    public function index(Request $request)
    {
        $dasar = $this->tugasMilikSupir();

        // Statistik
        $totalTugas = (clone $dasar)->count();

        $tugasBaru = (clone $dasar)
            ->where('status_laporan', 'ditugaskan')
            ->count();

        $dalamPenanganan = (clone $dasar)
            ->whereIn('status_laporan', [
                'sedang_dikerjakan',
                'perlu_perbaikan',
            ])
            ->count();

        $selesaiHariIni = (clone $dasar)
            ->where('status_laporan', 'selesai')
            ->whereDate('updated_at', today())
            ->count();

        // Filter
        $q = trim((string) $request->input('q', ''));
        $statusFilter = $request->input('status', '');
        $urgensiFilter = $request->input('urgensi', '');
        $riwayat = $request->boolean('riwayat');

        $statusValid = [
            'ditugaskan',
            'dalam_penanganan',
            'menunggu_pemeriksaan',
            'selesai',
            'ditolak',
        ];

        if (!in_array($statusFilter, $statusValid, true)) {
            $statusFilter = '';
        }

        $urgensiValid = [
            'sangat_tinggi',
            'tinggi',
            'sedang',
            'rendah',
        ];

        if (!in_array($urgensiFilter, $urgensiValid, true)) {
            $urgensiFilter = '';
        }

        // Query daftar tugas
        $query = (clone $dasar)->with([
            'tps',
            'armada',
            'pengguna',
        ]);

        // Filter riwayat
        if ($riwayat) {
            $query->whereIn('status_laporan', [
                'selesai',
                'ditolak',
            ]);
        } elseif (!in_array($statusFilter, ['selesai', 'ditolak'], true)) {
            $query->whereNotIn('status_laporan', [
                'selesai',
                'ditolak',
            ]);
        }

        // Filter status
        if ($statusFilter === 'ditugaskan') {
            $query->where('status_laporan', 'ditugaskan');
        }

        if ($statusFilter === 'dalam_penanganan') {
            $query->whereIn('status_laporan', [
                'sedang_dikerjakan',
                'perlu_perbaikan',
            ]);
        }

        if ($statusFilter === 'menunggu_pemeriksaan') {
            $query->where('status_laporan', 'menunggu_pemeriksaan');
        }

        if ($statusFilter === 'selesai') {
            $query->where('status_laporan', 'selesai');
        }

        if ($statusFilter === 'ditolak') {
            $query->where('status_laporan', 'ditolak');
        }

        // Filter urgensi
        if ($urgensiFilter !== '') {
            $query->where('tingkat_urgensi', $urgensiFilter);
        }

        // Pencarian
        if ($q !== '') {
            $kodeCari = strtoupper(str_replace('#', '', $q));

            $idCari = null;

            if (preg_match('/^LAP-0*(\d+)$/', $kodeCari, $hasil)) {
                $idCari = (int) $hasil[1];
            } elseif (ctype_digit($q)) {
                $idCari = (int) $q;
            }

            $query->where(function ($filter) use ($q, $idCari) {
                $like = "%{$q}%";

                $filter->where('lokasi', 'like', $like)
                    ->orWhere('kategori_kondisi', 'like', $like)
                    ->orWhere('keterangan', 'like', $like)

                    ->orWhereHas('tps', function ($tps) use ($like) {
                        $tps->where('nama_tps', 'like', $like);
                    })

                    ->orWhereHas('armada', function ($armada) use ($like) {
                        $armada->where('kode_armada', 'like', $like);
                    });

                if ($idCari !== null) {
                    $filter->orWhere('id', $idCari);
                }
            });
        }

        // Pagination
        $tugas = $query
            ->latest('created_at')
            ->paginate(5)
            ->withQueryString();

        // Armada terbaru
        $armadaAktif = (clone $dasar)
            ->with('armada')
            ->whereNotNull('id_armada')
            ->latest('updated_at')
            ->first()?->armada;

        return view('supir.tugas.index', compact(
            'tugas',
            'q',
            'statusFilter',
            'urgensiFilter',
            'riwayat',
            'totalTugas',
            'tugasBaru',
            'dalamPenanganan',
            'selesaiHariIni',
            'armadaAktif'
        ));
    }


    // ==========================================
    // MENCARI TUGAS AKTIF UNTUK MENU SIDEBAR
    // ==========================================

    public function aktif()
    {
        $tugas = $this->tugasMilikSupir()
            ->whereIn('status_laporan', [
                'ditugaskan',
                'sedang_dikerjakan',
                'perlu_perbaikan',
                'menunggu_pemeriksaan',
            ])
            ->orderByRaw("
                CASE status_laporan
                    WHEN 'sedang_dikerjakan' THEN 1
                    WHEN 'perlu_perbaikan' THEN 2
                    WHEN 'ditugaskan' THEN 3
                    WHEN 'menunggu_pemeriksaan' THEN 4
                    ELSE 5
                END
            ")
            ->latest('updated_at')
            ->first();

        if (!$tugas) {
            return redirect()
                ->route('supir.tugas.index')
                ->with(
                    'info',
                    'Belum ada tugas aktif yang ditugaskan kepada Anda.'
                );
        }

        return redirect()->route(
            'supir.tugas.show',
            $tugas->id
        );
    }


    // ==========================================
    // DETAIL TUGAS
    // ==========================================

    public function show($id)
    {
        $tugas = $this->tugasMilikSupir()
            ->with([
                'tps.wilayah',
                'armada',
                'pengguna',
                'fotoLaporans',
                'buktiPenanganans.supir',
            ])
            ->findOrFail($id);

        $armadaAktif = $tugas->armada;

        return view('supir.tugas.show', compact(
            'tugas',
            'armadaAktif'
        ));
    }


    // ==========================================
    // MULAI PENANGANAN
    // ==========================================

    public function mulai($id)
    {
        $tugas = $this->tugasMilikSupir()
            ->findOrFail($id);

        if (!in_array($tugas->status_laporan, [
            'ditugaskan',
            'perlu_perbaikan',
        ], true)) {
            return back()->with(
                'error',
                'Tugas tidak dapat dimulai pada status sekarang.'
            );
        }

        $tugas->status_laporan = 'sedang_dikerjakan';

        if (!$tugas->waktu_mulai) {
            $tugas->waktu_mulai = now();
        }

        $tugas->save();

        return back()->with(
            'success',
            'Penanganan tugas berhasil dimulai.'
        );
    }


    // ==========================================
    // SIMPAN PROGRES DAN FOTO
    // ==========================================

    public function perbaruiProgres(Request $request, $id)
    {
        $tugas = $this->tugasMilikSupir()
            ->findOrFail($id);

        if ($tugas->status_laporan !== 'sedang_dikerjakan') {
            return back()->with(
                'error',
                'Mulai penanganan terlebih dahulu sebelum mengirim progres.'
            );
        }

        $validated = $request->validate([
            'keterangan' => 'required|string|max:1000',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ], [
            'keterangan.required' => 'Catatan progres harus diisi.',
            'foto.required' => 'Foto bukti penanganan wajib diunggah.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 4 MB.',
        ]);

        $path = $request->file('foto')
            ->store('bukti-penanganan', 'public');

        BuktiPenanganan::create([
            'id_laporan' => $tugas->id,
            'id_supir' => auth()->id(),
            'foto_path' => $path,
            'keterangan' => $validated['keterangan'],
            'waktu_pengiriman' => now(),
        ]);

        return back()->with(
            'success',
            'Pembaruan progres dan foto berhasil disimpan.'
        );
    }


    // ==========================================
    // SELESAIKAN PENANGANAN
    // ==========================================

    public function selesaikan($id)
    {
        $tugas = $this->tugasMilikSupir()
            ->findOrFail($id);

        if ($tugas->status_laporan !== 'sedang_dikerjakan') {
            return back()->with(
                'error',
                'Tugas belum berada dalam proses penanganan.'
            );
        }

        if ($tugas->buktiPenanganans()->count() === 0) {
            return back()->with(
                'error',
                'Unggah minimal satu foto bukti sebelum mengirim tugas.'
            );
        }

        $tugas->status_laporan = 'menunggu_pemeriksaan';
        $tugas->waktu_kirim_pemeriksaan = now();
        $tugas->save();

        return back()->with(
            'success',
            'Penanganan berhasil dikirim dan menunggu pemeriksaan.'
        );
    }
}
