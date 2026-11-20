@extends('layouts.admin')

@section('title', 'Detail TPS - ' . $tps->nama_tps)
@section('page-title', 'Detail TPS')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Detail Tempat Penampungan Sampah</h4>
        <p class="text-secondary mb-0">Informasi lengkap data TPS dan riwayat pelaporan terkait.</p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.tps.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>

        <a href="{{ route('admin.tps.edit', $tps->id) }}" class="btn btn-success">
            <i class="bi bi-pencil-square"></i> Edit TPS
        </a>
    </div>
</div>

<div class="panel mb-4">
    <div class="panel-heading d-flex justify-content-between align-items-center">
        <span>Informasi TPS</span>
        <span class="badge text-bg-light border">ID TPS: #{{ $tps->id }}</span>
    </div>

    <div class="p-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-secondary small mb-1">Nama TPS</div>
                <div class="fw-bold fs-5 text-success">{{ $tps->nama_tps }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Wilayah UPTD</div>
                <div class="fw-semibold">
                    {{ $tps->wilayah->nama_wilayah ?? '-' }}
                </div>
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-1">Alamat Lengkap</div>
                <div>{{ $tps->alamat ?: '-' }}</div>
            </div>

            <div class="col-md-4">
                <div class="text-secondary small mb-1">Titik Latitude</div>
                <div>{{ $tps->latitude ?? 'Belum ditentukan' }}</div>
            </div>

            <div class="col-md-4">
                <div class="text-secondary small mb-1">Titik Longitude</div>
                <div>{{ $tps->longitude ?? 'Belum ditentukan' }}</div>
            </div>

            <div class="col-md-4">
                <div class="text-secondary small mb-1">Aksi Lokasi Peta</div>
                @if ($tps->latitude !== null && $tps->longitude !== null)
                    <a href="https://www.google.com/maps?q={{ $tps->latitude }},{{ $tps->longitude }}"
                       target="_blank" rel="noopener"
                       class="btn btn-sm btn-outline-success">
                        <i class="bi bi-geo-alt-fill"></i> Buka di Google Maps
                    </a>
                @else
                    <span class="text-muted small">Koordinat belum tersedia</span>
                @endif
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-1">Keterangan / Catatan Inventaris</div>
                <div class="p-3 bg-light rounded" style="white-space: pre-line;">{{ $tps->keterangan ?: 'Tidak ada catatan tambahan.' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- RIWAYAT LAPORAN DI TPS INI -->
<div class="panel">
    <div class="panel-heading d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span>Riwayat Laporan Masyarakat di TPS Ini</span>
        <a href="{{ route('admin.laporan.index', ['cari' => $tps->nama_tps]) }}" class="btn btn-sm btn-outline-success">
            Lihat di Menu Laporan &rarr;
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th style="width: 50px;">No.</th>
                    <th>Pelapor</th>
                    <th>Kategori Kondisi</th>
                    <th>Waktu Laporan</th>
                    <th>Status</th>
                    <th style="width: 90px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tps->laporans as $lap)
                    @php
                        $status = $lap->status_laporan;
                        $classStatus = match ($status) {
                            'selesai' => 'selesai',
                            'ditolak' => 'ditolak',
                            'diproses', 'ditangani', 'ditugaskan', 'sedang_dikerjakan' => 'diproses',
                            'diverifikasi' => 'diverifikasi',
                            default => 'menunggu',
                        };
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-semibold">{{ $lap->pengguna->name ?? '-' }}</div>
                            <small class="text-secondary">{{ $lap->pengguna->email ?? '' }}</small>
                        </td>
                        <td>{{ $lap->kategori_kondisi }}</td>
                        <td>{{ $lap->waktu_pelaporan?->format('d-m-Y H:i') ?? '-' }} WIB</td>
                        <td>
                            <span class="status {{ $classStatus }}">
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.laporan.show', $lap->id) }}" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-4">
                            <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                            Belum ada laporan masyarakat yang tercatat untuk TPS ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
