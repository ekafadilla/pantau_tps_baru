@extends('layouts.admin')

@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Detail Laporan</h4>
        <p class="text-secondary mb-0">
            Informasi lengkap laporan masyarakat.
        </p>
    </div>

    <a href="{{ route('admin.laporan.index') }}"
       class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="panel mb-4">
    <div class="panel-heading">Informasi Laporan</div>
    <div class="p-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-secondary small mb-1">Nama Pelapor</div>
                <div class="fw-semibold">{{ $laporan->pengguna->name ?? '-' }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Email Pelapor</div>
                <div class="fw-semibold">{{ $laporan->pengguna->email ?? '-' }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Nama TPS</div>
                <div class="fw-semibold">{{ $laporan->tps->nama_tps ?? '-' }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Wilayah UPTD</div>
                <div class="fw-semibold">
                    {{ $laporan->tps->wilayah->nama_wilayah ?? '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Kategori Kondisi</div>
                <div class="fw-semibold">{{ ucfirst($laporan->kategori_kondisi) }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Waktu Pelaporan</div>
                <div class="fw-semibold">
                    {{ $laporan->waktu_pelaporan
                        ? $laporan->waktu_pelaporan->format('d-m-Y H:i')
                        : '-' }}
                </div>
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-1">Lokasi Laporan</div>
                <div>{{ $laporan->lokasi ?: '-' }}</div>
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-1">Keterangan</div>
                <div style="white-space: pre-line">{{ $laporan->keterangan ?: '-' }}</div>
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-2">Status Laporan</div>
                <span class="status">
                    {{ ucfirst($laporan->status_laporan) }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">Foto Laporan</div>
    <div class="p-4">
        @if ($laporan->fotoLaporans->isNotEmpty())
            <div class="row g-3">
                @foreach ($laporan->fotoLaporans as $foto)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($foto->path_foto) }}"
                           target="_blank" rel="noopener">
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($foto->path_foto) }}"
                                alt="Foto laporan"
                                class="img-fluid rounded border"
                                style="width: 100%; height: 230px; object-fit: cover;"
                            >
                        </a>
                        <div class="small text-secondary mt-2">
                            {{ $foto->nama_file }}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-secondary mb-0">Tidak ada foto pada laporan ini.</p>
        @endif
    </div>
</div>
@endsection