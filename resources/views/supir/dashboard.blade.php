@extends('layouts.supir')

@section('page-title', 'Dashboard Supir')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Dashboard Supir</h2>
        <p class="text-muted mb-0">
            Ringkasan tugas penanganan TPS yang ditugaskan kepada Anda.
        </p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Tugas</p>
                    <h3 class="fw-bold mb-0">{{ $totalTugas }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Tugas Aktif</p>
                    <h3 class="fw-bold mb-0">{{ $tugasAktif }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Menunggu Pemeriksaan</p>
                    <h3 class="fw-bold mb-0">{{ $menungguPemeriksaan }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Tugas Selesai</p>
                    <h3 class="fw-bold mb-0">{{ $tugasSelesai }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between
                        align-items-center gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-1">Tugas Terbaru</h5>
                    <p class="text-muted mb-0 small">
                        Daftar penugasan terbaru untuk akun Anda.
                    </p>
                </div>

                <a href="{{ route('supir.tugas.index') }}"
                   class="btn btn-success">
                    Lihat Semua Tugas
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Lokasi TPS</th>
                            <th>Armada</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tugasTerbaru as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $item->tps->nama_tps
                                        ?? $item->lokasi
                                        ?? '-' }}
                                </td>
                                <td>
                                    {{ $item->armada->kode_armada ?? '-' }}
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ ucfirst(str_replace(
                                            '_',
                                            ' ',
                                            $item->status_laporan
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
                                <td colspan="5"
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
</div>
@endsection
