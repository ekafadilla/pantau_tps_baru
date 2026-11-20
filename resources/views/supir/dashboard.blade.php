
@extends('layouts.supir')

@section('page-title', 'Dashboard Supir')

@section('content')
<div class="container-fluid">

    {{-- Sambutan --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Selamat Datang, {{ $namaSupir }}!
        </h2>
        <p class="text-muted mb-0">
            Pantau tugas dan aktivitas penanganan TPS Anda di sini.
        </p>
    </div>

    {{-- Statistik Tugas --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Tugas</p>
                    <h3 class="fw-bold mb-1">{{ $totalTugas }}</h3>
                    <small class="text-muted">Seluruh penugasan Anda</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Tugas Aktif</p>
                    <h3 class="fw-bold mb-1">{{ $tugasAktif }}</h3>
                    <small class="text-muted">Tugas yang perlu ditangani</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Menunggu Pemeriksaan</p>
                    <h3 class="fw-bold mb-1">{{ $menungguPemeriksaan }}</h3>
                    <small class="text-muted">Menunggu verifikasi petugas</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Tugas Selesai</p>
                    <h3 class="fw-bold mb-1">{{ $tugasSelesai }}</h3>
                    <small class="text-muted">Penanganan telah selesai</small>
                </div>
            </div>
        </div>

    </div>

    {{-- Tugas Aktif --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between
                        align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-1">Tugas Aktif</h5>
                    <p class="text-muted small mb-0">
                        Informasi penugasan yang sedang menjadi tanggung jawab Anda.
                    </p>
                </div>

                <a href="{{ route('supir.tugas.index') }}"
                   class="btn btn-success btn-sm">
                    Lihat Semua Tugas
                </a>
            </div>

            @if ($tugasBerjalan)

                @php
                    $statusAktif = $tugasBerjalan->status_laporan;

                    $statusClass = match ($statusAktif) {
                        'selesai' => 'bg-success',
                        'sedang_dikerjakan' => 'bg-primary',
                        'menunggu_pemeriksaan' => 'bg-info text-dark',
                        'perlu_perbaikan' => 'bg-warning text-dark',
                        'ditugaskan' => 'bg-secondary',
                        default => 'bg-light text-dark border',
                    };

                    $urgensiAktif = $tugasBerjalan->tingkat_urgensi;

                    $urgensiClass = match ($urgensiAktif) {
                        'tinggi' => 'bg-danger',
                        'sedang' => 'bg-warning text-dark',
                        'rendah' => 'bg-success',
                        default => 'bg-light text-dark border',
                    };
                @endphp

                <div class="border rounded-3 p-3 border-start border-success border-4">

                    <div class="d-flex justify-content-between
                                align-items-start flex-wrap gap-2 mb-3">

                        <div>
                            <span class="text-muted small">Nomor Laporan</span>
                            <h5 class="fw-bold mb-0">
                                #{{ $tugasBerjalan->id }}
                            </h5>
                        </div>

                        <span class="badge {{ $statusClass }} px-3 py-2">
                            {{ ucfirst(str_replace('_', ' ', $statusAktif)) }}
                        </span>

                    </div>

                    <div class="row g-3 mb-3">

                        <div class="col-12 col-md-6">
                            <small class="text-muted">Lokasi TPS</small>
                            <p class="fw-semibold mb-0">
                                {{ $tugasBerjalan->tps->nama_tps
                                    ?? $tugasBerjalan->lokasi
                                    ?? '-' }}
                            </p>
                        </div>

                        <div class="col-12 col-md-6">
                            <small class="text-muted">Kategori Masalah</small>
                            <p class="fw-semibold mb-0">
                                {{ ucfirst(str_replace(
                                    '_',
                                    ' ',
                                    $tugasBerjalan->kategori_kondisi ?? '-'
                                )) }}
                            </p>
                        </div>

                        <div class="col-12 col-md-6">
                            <small class="text-muted">Armada</small>
                            <p class="fw-semibold mb-0">
                                {{ $tugasBerjalan->armada->kode_armada ?? '-' }}

                                @if ($tugasBerjalan->armada?->nomor_polisi)
                                    ({{ $tugasBerjalan->armada->nomor_polisi }})
                                @endif
                            </p>
                        </div>

                        <div class="col-12 col-md-6">
                            <small class="text-muted">Tingkat Urgensi</small>
                            <p class="mb-0">
                                <span class="badge {{ $urgensiClass }}">
                                    {{ $urgensiAktif
                                        ? ucfirst($urgensiAktif)
                                        : 'Belum ditentukan' }}
                                </span>
                            </p>
                        </div>

                        <div class="col-12 col-md-6">
                            <small class="text-muted">Target Penanganan</small>
                            <p class="fw-semibold mb-0">
                                {{ $tugasBerjalan->target_waktu
                                    ? \Carbon\Carbon::parse(
                                        $tugasBerjalan->target_waktu
                                    )->format('d-m-Y H:i')
                                    : 'Belum ditentukan' }}
                            </p>
                        </div>

                    </div>

                    @if ($tugasBerjalan->instruksi_penanganan)
                        <div class="bg-light rounded-3 p-3 mb-3">
                            <small class="text-muted fw-semibold">
                                Instruksi Penanganan
                            </small>
                            <p class="mb-0 mt-1">
                                {{ $tugasBerjalan->instruksi_penanganan }}
                            </p>
                        </div>
                    @endif

                    <div class="text-end">
                        <a href="{{ route(
                            'supir.tugas.show',
                            $tugasBerjalan->id
                        ) }}"
                           class="btn btn-success">
                            Lihat Detail Tugas
                        </a>
                    </div>

                </div>

            @else

                <div class="text-center py-4">
                    <h6 class="fw-semibold">Belum Ada Tugas Aktif</h6>
                    <p class="text-muted mb-0">
                        Saat ini belum ada penugasan yang perlu ditangani.
                    </p>
                </div>

            @endif

        </div>
    </div>

    {{-- Daftar Tugas Terbaru --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between
                        align-items-center flex-wrap gap-2 mb-3">

                <div>
                    <h5 class="fw-bold mb-1">Tugas Terbaru</h5>
                    <p class="text-muted small mb-0">
                        Daftar lima penugasan terbaru untuk akun Anda.
                    </p>
                </div>

                <a href="{{ route('supir.tugas.index') }}"
                   class="btn btn-outline-success btn-sm">
                    Lihat Semua
                </a>

            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Lokasi TPS</th>
                            <th>Kategori</th>
                            <th>Urgensi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($tugasTerbaru as $item)

                            @php
                                $status = $item->status_laporan;

                                $statusClass = match ($status) {
                                    'selesai' => 'bg-success',
                                    'sedang_dikerjakan' => 'bg-primary',
                                    'menunggu_pemeriksaan' => 'bg-info text-dark',
                                    'perlu_perbaikan' => 'bg-warning text-dark',
                                    'ditugaskan' => 'bg-secondary',
                                    default => 'bg-light text-dark border',
                                };

                                $urgensi = $item->tingkat_urgensi;

                                $urgensiClass = match ($urgensi) {
                                    'tinggi' => 'bg-danger',
                                    'sedang' => 'bg-warning text-dark',
                                    'rendah' => 'bg-success',
                                    default => 'bg-light text-dark border',
                                };
                            @endphp

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $item->tps->nama_tps
                                            ?? $item->lokasi
                                            ?? '-' }}
                                    </div>
                                    <small class="text-muted">
                                        Laporan #{{ $item->id }}
                                    </small>
                                </td>

                                <td>
                                    {{ ucfirst(str_replace(
                                        '_',
                                        ' ',
                                        $item->kategori_kondisi ?? '-'
                                    )) }}
                                </td>

                                <td>
                                    <span class="badge {{ $urgensiClass }}">
                                        {{ $urgensi
                                            ? ucfirst($urgensi)
                                            : 'Belum ditentukan' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst(str_replace(
                                            '_',
                                            ' ',
                                            $status ?? '-'
                                        )) }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route(
                                        'supir.tugas.show',
                                        $item->id
                                    ) }}"
                                       class="btn btn-sm btn-outline-success">
                                        Detail
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="text-center text-muted py-4">
                                    Belum ada tugas yang ditugaskan kepada Anda.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>
    </div>

    {{-- Pengingat Penanganan --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
            <div class="d-flex gap-3 align-items-start">
                <div>
                    <h6 class="fw-bold mb-1">
                        Pengingat Penanganan
                    </h6>
                    <p class="text-muted small mb-0">
                        Pastikan membaca instruksi penanganan sebelum
                        melaksanakan tugas. Perbarui status pekerjaan
                        dan kirim bukti penanganan setelah pekerjaan selesai.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
