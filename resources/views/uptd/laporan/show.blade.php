@extends('layouts.uptd')

@section('title', 'Detail Laporan UPTD')
@section('page-title', 'Detail Laporan')
@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('uptd.laporan.index') }}" class="text-decoration-none">
            &larr; Kembali ke Data Laporan
        </a>
        <h3 class="fw-bold mt-3 mb-1">Detail Laporan</h3>
        <p class="text-muted mb-0">Informasi laporan pengaduan dari masyarakat.</p>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
                <h5 class="fw-bold mb-0">Laporan #{{ $laporan->id }}</h5>
                <span class="badge text-bg-secondary">{{ ucfirst($laporan->status_laporan) }}</span>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="text-muted small">Nama TPS</div>
                    <div class="fw-semibold">{{ $laporan->tps->nama_tps ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Nama Pelapor</div>
                    <div class="fw-semibold">{{ $laporan->pengguna->name ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Kategori Kondisi</div>
                    <div>{{ $laporan->kategori_kondisi }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Waktu Pelaporan</div>
                    <div>
                        {{ $laporan->waktu_pelaporan
                            ? $laporan->waktu_pelaporan->format('d-m-Y H:i')
                            : '-' }}
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-muted small">Lokasi</div>
                    <div>{{ $laporan->lokasi ?: ($laporan->tps->alamat ?? '-') }}</div>
                </div>
                <div class="col-12">
                    <div class="text-muted small">Keterangan</div>
                    <div class="mt-1" style="white-space: pre-line">{{ $laporan->keterangan }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Foto Laporan</h5>
            <div class="row g-3">
                @forelse($laporan->fotoLaporans as $foto)
                    <div class="col-6 col-md-4 col-xl-3">
                        <a href="{{ asset('storage/' . $foto->path_foto) }}" target="_blank">
                            <img
                                src="{{ asset('storage/' . $foto->path_foto) }}"
                                alt="{{ $foto->nama_file }}"
                                class="img-fluid rounded border"
                                style="width:100%;height:180px;object-fit:cover"
                            >
                        </a>
                        <div class="small text-muted mt-1">{{ $foto->nama_file }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">Tidak ada foto pada laporan ini.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Riwayat Status</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Waktu</th>
                            <th>Status Sebelumnya</th>
                            <th>Status Baru</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan->riwayatStatuses->sortByDesc('waktu_perubahan') as $riwayat)
                            <tr>
                                <td>
                                    {{ $riwayat->waktu_perubahan
                                        ? \Carbon\Carbon::parse($riwayat->waktu_perubahan)->format('d-m-Y H:i')
                                        : '-' }}
                                </td>
                                <td>{{ $riwayat->status_sebelumnya ? ucfirst($riwayat->status_sebelumnya) : '-' }}</td>
                                <td>{{ ucfirst($riwayat->status_baru) }}</td>
                                <td>{{ $riwayat->catatan ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    Belum ada riwayat status.
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