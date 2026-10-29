@extends('layouts.admin')

@section('title', 'Data Laporan')
@section('page-title', 'Data Laporan')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Data Laporan Masyarakat</h4>
    <p class="text-secondary mb-0">
        Pantau laporan kondisi TPS dari seluruh wilayah.
    </p>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Total Laporan</div>
            <div class="stat-number">{{ $totalLaporan }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Menunggu</div>
            <div class="stat-number">{{ $totalMenunggu }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Dalam Penanganan</div>
            <div class="stat-number">{{ $totalDiproses }}</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-label">Selesai</div>
            <div class="stat-number">{{ $totalSelesai }}</div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span>Daftar Laporan</span>
        <span class="text-secondary small">{{ $laporan->total() }} laporan ditemukan</span>
    </div>

    <div class="p-3 border-bottom">
        <form method="GET" action="{{ route('admin.laporan.index') }}">
            <div class="row g-2">
                <div class="col-12 col-lg-4">
                    <input
                        type="text"
                        name="cari"
                        class="form-control"
                        value="{{ $cari }}"
                        placeholder="Cari pelapor, TPS, lokasi, kategori..."
                    >
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <select name="id_wilayah" class="form-select">
                        <option value="">Semua Wilayah UPTD</option>
                        @foreach ($wilayah as $itemWilayah)
                            <option
                                value="{{ $itemWilayah->id }}"
                                {{ (string) $idWilayah === (string) $itemWilayah->id ? 'selected' : '' }}
                            >
                                {{ $itemWilayah->nama_wilayah }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        @foreach ($daftarStatus as $itemStatus)
                            <option value="{{ $itemStatus }}"
                                {{ $status === $itemStatus ? 'selected' : '' }}>
                                {{ ucfirst($itemStatus) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-lg-1 d-grid">
                    <button type="submit" class="btn btn-success" title="Cari">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                <div class="col-6 col-lg-1 d-grid">
                    <a href="{{ route('admin.laporan.index') }}"
                       class="btn btn-outline-secondary" title="Reset filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pelapor</th>
                    <th>Informasi TPS</th>
                    <th>Wilayah UPTD</th>
                    <th>Kategori</th>
                    <th>Waktu Laporan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td>{{ $laporan->firstItem() + $loop->index }}</td>
                        <td>
                            <div class="fw-semibold">
                                {{ $item->pengguna->name ?? 'Pengguna tidak tersedia' }}
                            </div>
                            <small class="text-secondary">
                                {{ $item->pengguna->email ?? '-' }}
                            </small>
                        </td>
                        <td>
                            <div class="fw-semibold">
                                {{ $item->tps->nama_tps ?? 'TPS tidak tersedia' }}
                            </div>
                            <small class="text-secondary">
                                {{ $item->lokasi ?: ($item->tps->alamat ?? '-') }}
                            </small>
                        </td>
                        <td>{{ $item->tps->wilayah->nama_wilayah ?? '-' }}</td>
                        <td>{{ ucfirst($item->kategori_kondisi) }}</td>
                        <td>
                            {{ $item->waktu_pelaporan
                                ? $item->waktu_pelaporan->format('d-m-Y H:i')
                                : '-' }}
                        </td>
                        <td>
                            @php
                                $kelasStatus = [
                                    'menunggu' => '',
                                    'diverifikasi' => '',
                                    'diproses' => 'diproses',
                                    'ditangani' => 'diproses',
                                    'selesai' => 'selesai',
                                    'ditolak' => 'ditolak',
                                ][$item->status_laporan] ?? '';
                            @endphp
                            <span class="status {{ $kelasStatus }}">
                                {{ ucfirst($item->status_laporan) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.laporan.show', $item->id) }}"
                               class="btn btn-sm btn-outline-success">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-inbox fs-2 text-secondary"></i>
                            <p class="mt-2 mb-1 fw-semibold">Belum ada laporan</p>
                            <p class="text-secondary mb-0">
                                Coba ubah kata pencarian atau filter yang digunakan.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($laporan->hasPages())
        <div class="p-3">
            {{ $laporan->links() }}
        </div>
    @endif
</div>
@endsection