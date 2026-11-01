@extends('layouts.uptd')

@section('title', 'Data Laporan UPTD')
@section('page-title', 'Data Laporan')
@section('content')
<div class="container-fluid py-4 uptd-report-page">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Data Laporan</h3>
            <p class="text-muted mb-0">Kelola dan pantau laporan pada wilayah UPTD Anda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3 mb-4">
        @foreach([
            ['Total Laporan', $totalLaporan],
            ['Menunggu', $menunggu],
            ['Dalam Proses', $diproses],
            ['Selesai', $selesai]
        ] as [$judul, $jumlah])
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="text-muted small mb-2">{{ $judul }}</div>
                        <div class="fs-3 fw-bold">{{ $jumlah }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('uptd.laporan.index') }}" class="row g-2 mb-4">
                <div class="col-md-6">
                    <input
                        type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari kategori, lokasi, TPS, atau pelapor"
                        value="{{ request('cari') }}"
                    >
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        @foreach([
                            'menunggu' => 'Menunggu',
                            'diverifikasi' => 'Diverifikasi',
                            'diproses' => 'Diproses',
                            'ditangani' => 'Ditangani',
                            'selesai' => 'Selesai',
                            'ditolak' => 'Ditolak'
                        ] as $nilai => $label)
                            <option value="{{ $nilai }}" @selected(request('status') === $nilai)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-success flex-fill" type="submit">Cari</button>
                    <a href="{{ route('uptd.laporan.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>TPS</th>
                            <th>Pelapor</th>
                            <th>Kategori</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $item)
                            @php
                                $warnaStatus = [
                                    'menunggu' => 'warning',
                                    'diverifikasi' => 'info',
                                    'diproses' => 'primary',
                                    'ditangani' => 'primary',
                                    'selesai' => 'success',
                                    'ditolak' => 'danger'
                                ];
                            @endphp
                            <tr>
                                <td>{{ $laporan->firstItem() + $loop->index }}</td>
                                <td>{{ $item->tps->nama_tps ?? '-' }}</td>
                                <td>{{ $item->pengguna->name ?? '-' }}</td>
                                <td>{{ $item->kategori_kondisi }}</td>
                                <td>
                                    {{ $item->waktu_pelaporan
                                        ? $item->waktu_pelaporan->format('d-m-Y H:i')
                                        : '-' }}
                                </td>
                                <td>
                                    <span class="badge text-bg-{{ $warnaStatus[$item->status_laporan] ?? 'secondary' }}">
                                        {{ ucfirst($item->status_laporan) }}
                                    </span>
                                </td>
                                <td>
                                    <a
                                        href="{{ route('uptd.laporan.show', $item->id) }}"
                                        class="btn btn-sm btn-outline-success"
                                    >Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    Belum ada laporan pada wilayah ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $laporan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection