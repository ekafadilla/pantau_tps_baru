@extends('layouts.supir')

@section('page-title', 'Detail Tugas')

@section('content')
<div class="container py-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="mb-1">Detail Tugas Penanganan</h2>
            <p class="text-muted mb-0">Informasi laporan TPS yang ditugaskan kepada Anda.</p>
        </div>
        <a href="{{ route('supir.tugas.index') }}" class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

        {{-- PETA-SUPIR --}}
    @php
        $latTujuan = $tugas->latitude ?? $tugas->tps->latitude ?? null;
        $lngTujuan = $tugas->longitude ?? $tugas->tps->longitude ?? null;
    @endphp

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <h5 class="mb-2">Bagikan Lokasi</h5>
            <p class="text-muted small mb-3">
                Bagikan lokasi Anda saat menuju TPS agar UPTD dapat memantau posisi Anda.
            </p>
            <x-peta
                mode="live"
                :height="320"
                :share-url="route('supir.lokasi.simpan')"
                :tujuan="($latTujuan !== null && $lngTujuan !== null)
                    ? ['lat' => (float) $latTujuan, 'lng' => (float) $lngTujuan, 'label' => 'lokasi laporan']
                    : null"
            />
        </div>
    </div>
<div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <h5 class="mb-3">Informasi Laporan</h5>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Nomor Laporan</div>
                <div class="col-md-8">#{{ $tugas->id }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Nama TPS</div>
                <div class="col-md-8">
                    {{ $tugas->tps->nama_tps ?? '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Lokasi</div>
                <div class="col-md-8">
                    {{ $tugas->lokasi ?? '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Kategori Kondisi</div>
                <div class="col-md-8">
                    {{ ucfirst(str_replace('_', ' ', $tugas->kategori_kondisi ?? '-')) }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Urgensi Akhir</div>
                <div class="col-md-8">
                    {{ $tugas->tingkat_urgensi
                        ? ucfirst(str_replace('_', ' ', $tugas->tingkat_urgensi))
                        : 'Belum ditetapkan' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Waktu Pelaporan</div>
                <div class="col-md-8">
                    {{ $tugas->waktu_pelaporan
                        ? \Carbon\Carbon::parse($tugas->waktu_pelaporan)->format('d-m-Y H:i')
                        : '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Keterangan</div>
                <div class="col-md-8">
                    {{ $tugas->keterangan ?: '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Pelapor</div>
                <div class="col-md-8">
                    {{ $tugas->pengguna->name ?? '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">Armada</div>
                <div class="col-md-8">
                    {{ $tugas->armada->nama_armada ?? '-' }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 text-muted">Status Penanganan</div>
                <div class="col-md-8">
                    @php
                        $statusMap = [
                            'diproses' => ['primary', 'Diproses'],
                            'menunggu_pemeriksaan' => ['info', 'Menunggu Pemeriksaan'],
                            'perlu_perbaikan' => ['warning', 'Perlu Perbaikan'],
                            'selesai' => ['success', 'Selesai'],
                            'ditolak' => ['danger', 'Ditolak'],
                        ];

                        [$warnaStatus, $labelStatus] = $statusMap[$tugas->status_laporan]
                            ?? ['secondary', ucfirst(str_replace('_', ' ', $tugas->status_laporan))];
                    @endphp

                    <span class="badge bg-{{ $warnaStatus }}">
                        {{ $labelStatus }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- CATATAN PERBAIKAN DARI UPTD --}}
    @if ($tugas->status_laporan === 'perlu_perbaikan')
        @php
            $catatanPerbaikan = $tugas->riwayatStatuses
                ->where('status_baru', 'perlu_perbaikan')
                ->sortByDesc('waktu_perubahan')
                ->first();
        @endphp

        <div class="alert alert-warning border-0 shadow-sm mb-3">
            <h5 class="mb-2">
                <i class="bi bi-exclamation-triangle me-1"></i>
                Bukti Perlu Diperbaiki
            </h5>
            <p class="mb-1">
                Petugas UPTD meminta Anda memperbaiki bukti penanganan.
            </p>
            <div class="mt-2">
                <strong>Catatan dari UPTD:</strong>
                <p class="mb-0 mt-1">
                    {{ $catatanPerbaikan->catatan ?? 'Tidak ada catatan tambahan.' }}
                </p>
            </div>
        </div>
    @endif
    {{-- FORM BUKTI PENANGANAN --}}
    @if (in_array($tugas->status_laporan, ['diproses', 'perlu_perbaikan']))
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h5 class="mb-2">Kirim Bukti Penanganan</h5>
                <p class="text-muted small mb-3">
                    Unggah foto setelah penanganan TPS selesai dilakukan.
                    Bukti akan diperiksa oleh petugas UPTD.
                </p>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Periksa kembali data yang diisi:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('supir.tugas.bukti', $tugas->id) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Bukti Penanganan</label>
                        <input type="file" name="foto[]" id="foto"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp"
                               multiple required>
                        <small class="text-muted">
                            Pilih 1–5 foto, maksimal 5 MB per foto.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_bukti" class="form-label">
                            Keterangan Penanganan
                        </label>
                        <textarea name="keterangan" id="keterangan_bukti"
                                  class="form-control" rows="4"
                                  maxlength="1000" required
                                  placeholder="Jelaskan penanganan yang sudah dilakukan...">{{ old('keterangan') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Kirim Bukti ke UPTD
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection