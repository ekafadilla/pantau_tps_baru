@extends('layouts.admin')

@section('title', 'Detail TPS')
@section('page-title', 'Detail TPS')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Detail Tempat Penampungan Sampah</h4>
        <p class="text-secondary mb-0">Informasi lengkap data TPS.</p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.tps.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <a href="{{ route('admin.tps.edit', $tps->id) }}" class="btn btn-success">
            <i class="bi bi-pencil-square"></i> Edit TPS
        </a>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        Informasi TPS
    </div>

    <div class="p-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-secondary small mb-1">Nama TPS</div>
                <div class="fw-semibold fs-5">{{ $tps->nama_tps }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Wilayah UPTD</div>
                <div class="fw-semibold">
                    {{ $tps->wilayah->nama_wilayah ?? '-' }}
                </div>
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-1">Alamat</div>
                <div>{{ $tps->alamat ?: '-' }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Latitude</div>
                <div>{{ $tps->latitude ?? 'Belum tersedia' }}</div>
            </div>

            <div class="col-md-6">
                <div class="text-secondary small mb-1">Longitude</div>
                <div>{{ $tps->longitude ?? 'Belum tersedia' }}</div>
            </div>

            <div class="col-12">
                <div class="text-secondary small mb-1">Keterangan</div>
                <div style="white-space: pre-line">{{ $tps->keterangan ?: '-' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection