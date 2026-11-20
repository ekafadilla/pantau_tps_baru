
@extends('layouts.supir')

@section('page-title', 'Tugas Penanganan Pengemudi')

@section('content')

<style>
    .task-page {
        color: #193c30;
    }

    .task-heading {
        background: #fff;
        border: 1px solid #e4eee7;
        border-radius: 10px;
        padding: 19px 20px;
        margin-bottom: 17px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .task-heading-left {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .task-heading-icon {
        width: 43px;
        height: 43px;
        border-radius: 9px;
        background: #e4f4e9;
        color: #176b43;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .task-heading h4 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .task-heading p {
        font-size: 11px;
        color: #75877d;
        margin: 0;
    }

    .task-heading .badge {
        font-size: 10px;
        font-weight: 500;
        background: #e3f5e9;
        color: #176b43;
    }

    .armada-summary {
        background: #e9f7ee;
        border-radius: 8px;
        padding: 10px 15px;
        min-width: 145px;
        text-align: center;
    }

    .armada-summary small {
        display: block;
        font-size: 10px;
        color: #71877a;
    }

    .armada-summary strong {
        font-size: 13px;
        color: #176b43;
    }

    .task-stat {
        background: white;
        border: 1px solid #e5eee7;
        border-radius: 9px;
        padding: 14px 15px;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
    }

    .task-stat small {
        display: block;
        font-size: 10px;
        color: #75877d;
        margin-bottom: 7px;
    }

    .task-stat h3 {
        font-size: 22px;
        font-weight: 700;
        margin: 0;
        color: #183d30;
    }

    .task-stat-icon {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        background: #e4f4e9;
        color: #176b43;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .task-filter {
        background: white;
        border: 1px solid #e5eee7;
        border-radius: 9px;
        padding: 13px;
        margin-top: 17px;
        margin-bottom: 17px;
    }

    .task-filter .form-control,
    .task-filter .form-select {
        font-size: 11px;
        min-height: 36px;
        border-color: #e3ece5;
        background-color: #f5faf6;
    }

    .task-filter .btn {
        min-height: 36px;
        font-size: 11px;
    }

    .quick-filter {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 7px;
        margin-top: 12px;
    }

    .quick-filter-label {
        font-size: 10px;
        color: #718078;
        margin-right: 3px;
    }

    .quick-filter a {
        font-size: 10px;
        border-radius: 20px;
        padding: 5px 11px;
        background: #edf5ef;
        color: #365747;
        border: 1px solid #e0ece3;
    }

    .quick-filter a:hover,
    .quick-filter a.active {
        background: #176b43;
        border-color: #176b43;
        color: white;
    }

    .task-table-card {
        background: white;
        border: 1px solid #e4eee7;
        border-radius: 9px;
        overflow: hidden;
    }

    .task-table-heading {
        padding: 15px 17px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .task-table-heading h5 {
        font-size: 14px;
        font-weight: 700;
        margin: 0;
    }

    .task-table-heading small {
        font-size: 10px;
        color: #718078;
    }

    .task-table {
        margin: 0;
        font-size: 11px;
        min-width: 850px;
    }

    .task-table thead th {
        background: #e8f4eb;
        color: #4b6557;
        font-size: 10px;
        font-weight: 600;
        padding: 13px 12px;
        border: 0;
        white-space: nowrap;
    }

    .task-table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        border: 0;
    }

    .task-table tbody tr:nth-child(even) {
        background: #f3faf5;
    }

    .task-table tbody tr:hover {
        background: #eaf6ee;
    }

    .report-code {
        color: #183c30;
        font-size: 11px;
        font-weight: 700;
    }

    .report-sub {
        display: block;
        color: #829087;
        font-size: 9px;
        margin-top: 4px;
    }

    .location-name {
        font-weight: 600;
        font-size: 11px;
        color: #263e32;
    }

    .location-sub {
        display: block;
        font-size: 9px;
        color: #78877e;
        margin-top: 3px;
    }

    .category-label {
        display: inline-block;
        background: #e9f3ec;
        color: #42614e;
        border-radius: 4px;
        padding: 5px 7px;
        font-size: 9px;
        margin-bottom: 5px;
    }

    .urgency-badge,
    .status-badge {
        display: inline-block;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: 9px;
        font-weight: 600;
        white-space: nowrap;
    }

    .urgency-rendah {
        color: #176b43;
        background: #dff4e5;
    }

    .urgency-sedang {
        color: #806019;
        background: #fff0c9;
    }

    .urgency-tinggi,
    .urgency-sangat_tinggi {
        color: #a52b2b;
        background: #ffe0df;
    }

    .status-ditugaskan {
        color: #176b43;
        background: #dff4e5;
    }

    .status-sedang_dikerjakan {
        color: #176b43;
        background: #d4f0df;
    }

    .status-perlu_perbaikan {
        color: #8a5b10;
        background: #fff0c9;
    }

    .status-menunggu_pemeriksaan {
        color: #28627e;
        background: #dceef8;
    }

    .status-selesai {
        color: #176b43;
        background: #dff4e5;
    }

    .status-ditolak {
        color: #a52b2b;
        background: #ffe0df;
    }

    .status-default {
        color: #5c6861;
        background: #edf0ed;
    }

    .btn-detail {
        background: #073e32;
        color: white;
        padding: 7px 10px;
        font-size: 10px;
        border-radius: 5px;
        white-space: nowrap;
    }

    .btn-detail:hover {
        background: #176b43;
        color: white;
    }

    .table-empty {
        padding: 40px 15px !important;
        text-align: center;
        color: #829087;
    }

    .task-table-footer {
        background: #eaf5ed;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .task-table-footer small {
        color: #718078;
        font-size: 10px;
    }

    .pagination-simple {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .pagination-simple a,
    .pagination-simple span {
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 10px;
        background: #dcece1;
        color: #42614e;
    }

    .pagination-simple .current {
        background: #073e32;
        color: white;
    }

    .pagination-simple .disabled {
        opacity: .5;
        pointer-events: none;
    }

    .task-bottom {
        margin-top: 17px;
        padding: 16px 18px;
        background: #073e32;
        border-radius: 9px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        color: white;
    }

    .task-bottom h6 {
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .task-bottom p {
        color: #c5dfd1;
        font-size: 10px;
        margin: 0;
        max-width: 550px;
    }

    .task-bottom .safety-icon {
        color: #b8e5ce;
        font-size: 24px;
        margin-right: 12px;
    }

    .task-bottom .btn {
        background: #b9e9d0;
        color: #073e32;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
        padding: 9px 14px;
    }

    @media(max-width: 768px) {
        .task-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .armada-summary {
            width: 100%;
        }

        .task-bottom {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

@php
    $namaSupir = auth()->user()->name ?? 'Supir';

    $baseParams = array_filter([
        'q' => $q,
        'urgensi' => $urgensiFilter,
        'riwayat' => $riwayat ? 1 : null,
    ], fn($value) => $value !== null && $value !== '');

    $statusLabels = [
        'ditugaskan' => 'Tugas Baru',
        'sedang_dikerjakan' => 'Dalam Penanganan',
        'perlu_perbaikan' => 'Perlu Perbaikan',
        'menunggu_pemeriksaan' => 'Menunggu Pemeriksaan',
        'selesai' => 'Selesai',
        'ditolak' => 'Ditolak',
    ];

    $urgensiLabels = [
        'sangat_tinggi' => 'Sangat Tinggi',
        'tinggi' => 'Tinggi',
        'sedang' => 'Sedang',
        'rendah' => 'Rendah',
    ];
@endphp

<div class="task-page">

    {{-- INFORMASI PENGEMUDI --}}
    <div class="task-heading">

        <div class="task-heading-left">
            <div class="task-heading-icon">
                <i class="bi bi-clipboard2-check"></i>
            </div>

            <div>
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <h4>Tugas Penanganan Pengemudi</h4>
                    <span class="badge">Privat Teridentifikasi</span>
                </div>

                <p>
                    Menampilkan tugas penanganan khusus pengemudi:
                    {{ $namaSupir }}
                </p>

                <p>
                    ID Supir: {{ auth()->id() }}
                    | {{ $armadaAktif->kode_armada ?? 'Belum memiliki armada' }}
                </p>
            </div>
        </div>

        <div class="armada-summary">
            <small> <i class="bi bi-truck"></i> Otoritas Akses</small>
            <strong>
                {{ $armadaAktif->kode_armada ?? 'Belum Ada Armada' }}
            </strong>
            @if($armadaAktif?->nomor_polisi)
                <small>{{ $armadaAktif->nomor_polisi }}</small>
            @endif
        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="row g-2">

        <div class="col-6 col-xl-3">
            <div class="task-stat">
                <div>
                    <small>Total Tugas Saya</small>
                    <h3>{{ $totalTugas }}</h3>
                </div>
                <div class="task-stat-icon">
                    <i class="bi bi-collection"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="task-stat">
                <div>
                    <small>Tugas Baru / Menunggu</small>
                    <h3>{{ $tugasBaru }}</h3>
                </div>
                <div class="task-stat-icon">
                    <i class="bi bi-bell"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="task-stat">
                <div>
                    <small>Dalam Penanganan</small>
                    <h3>{{ $dalamPenanganan }}</h3>
                </div>
                <div class="task-stat-icon">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="task-stat">
                <div>
                    <small>Selesai Hari Ini</small>
                    <h3>{{ $selesaiHariIni }}</h3>
                </div>
                <div class="task-stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="task-filter">

        <form action="{{ route('supir.tugas.index') }}"
              method="GET"
              class="row g-2 align-items-center">

            @if($riwayat)
                <input type="hidden" name="riwayat" value="1">
            @endif

            <div class="col-12 col-lg-4">
                <input type="search"
                       name="q"
                       class="form-control"
                       value="{{ $q }}"
                       placeholder="Cari kode laporan atau nama TPS...">
            </div>

            <div class="col-6 col-lg-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="ditugaskan"
                        {{ $statusFilter === 'ditugaskan' ? 'selected' : '' }}>
                        Tugas Baru
                    </option>
                    <option value="dalam_penanganan"
                        {{ $statusFilter === 'dalam_penanganan' ? 'selected' : '' }}>
                        Dalam Penanganan
                    </option>
                    <option value="menunggu_pemeriksaan"
                        {{ $statusFilter === 'menunggu_pemeriksaan' ? 'selected' : '' }}>
                        Menunggu Pemeriksaan
                    </option>
                    <option value="selesai"
                        {{ $statusFilter === 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>
                    <option value="ditolak"
                        {{ $statusFilter === 'ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>
                </select>
            </div>

            <div class="col-6 col-lg-3">
                <select name="urgensi" class="form-select">
                    <option value="">Semua Urgensi</option>
                    <option value="sangat_tinggi"
                        {{ $urgensiFilter === 'sangat_tinggi' ? 'selected' : '' }}>
                        Sangat Tinggi
                    </option>
                    <option value="tinggi"
                        {{ $urgensiFilter === 'tinggi' ? 'selected' : '' }}>
                        Tinggi
                    </option>
                    <option value="sedang"
                        {{ $urgensiFilter === 'sedang' ? 'selected' : '' }}>
                        Sedang
                    </option>
                    <option value="rendah"
                        {{ $urgensiFilter === 'rendah' ? 'selected' : '' }}>
                        Rendah
                    </option>
                </select>
            </div>

            <div class="col-12 col-lg-2 d-flex gap-2">
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>

                <a href="{{ route('supir.tugas.index', $riwayat ? ['riwayat' => 1] : []) }}"
                   class="btn btn-outline-secondary"
                   title="Reset filter">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>

        </form>

        {{-- FILTER CEPAT --}}
        <div class="quick-filter">

            <span class="quick-filter-label">Pintasan:</span>

            <a href="{{ route('supir.tugas.index', $baseParams) }}"
               class="{{ $statusFilter === '' ? 'active' : '' }}">
                Semua Status
            </a>

            <a href="{{ route('supir.tugas.index', array_merge($baseParams, ['status' => 'ditugaskan'])) }}"
               class="{{ $statusFilter === 'ditugaskan' ? 'active' : '' }}">
                Tugas Baru ({{ $tugasBaru }})
            </a>

            <a href="{{ route('supir.tugas.index', array_merge($baseParams, ['status' => 'dalam_penanganan'])) }}"
               class="{{ $statusFilter === 'dalam_penanganan' ? 'active' : '' }}">
                Dalam Penanganan ({{ $dalamPenanganan }})
            </a>

            <a href="{{ route('supir.tugas.index', array_merge($baseParams, ['status' => 'selesai'])) }}"
               class="{{ $statusFilter === 'selesai' ? 'active' : '' }}">
                Selesai
            </a>

        </div>

    </div>

    {{-- PESAN BERHASIL --}}
    @if(session('success'))
        <div class="alert alert-success py-2 small">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABEL TUGAS --}}
    <div class="task-table-card">

        <div class="task-table-heading">
            <div>
                <h5>
                    <i class="bi bi-list-task"></i>
                    {{ $riwayat ? 'Riwayat Penanganan Anda' : 'Daftar Tugas Penanganan Anda' }}
                </h5>
                <small>Daftar penugasan yang terhubung dengan akun Anda.</small>
            </div>

            <small>{{ $tugas->total() }} data ditemukan</small>
        </div>

        <div class="table-responsive">
            <table class="table task-table">

                <thead>
                    <tr>
                        <th>Kode Laporan</th>
                        <th>Lokasi TPS</th>
                        <th>Kategori & Urgensi</th>
                        <th>Waktu Laporan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($tugas as $item)

                        @php
                            $status = $item->status_laporan;

                            $statusClass = in_array($status, [
                                'ditugaskan',
                                'sedang_dikerjakan',
                                'perlu_perbaikan',
                                'menunggu_pemeriksaan',
                                'selesai',
                                'ditolak',
                            ]) ? 'status-' . $status : 'status-default';

                            $urgensi = $item->tingkat_urgensi;

                            $urgensiClass = in_array($urgensi, [
                                'rendah',
                                'sedang',
                                'tinggi',
                                'sangat_tinggi',
                            ]) ? 'urgency-' . $urgensi : '';

                            $tanggalLaporan = $item->waktu_pelaporan;
                        @endphp

                        <tr>

                            <td>
                                <span class="report-code">
                                    #LAP-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                                </span>

                                <span class="report-sub">
                                    ID Laporan: {{ $item->id }}
                                </span>
                            </td>

                            <td>
                                <span class="location-name">
                                    {{ $item->tps->nama_tps
                                        ?? $item->lokasi
                                        ?? 'Lokasi belum tersedia' }}
                                </span>

                                @if($item->lokasi)
                                    <span class="location-sub">
                                        {{ $item->lokasi }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="category-label">
                                    {{ ucfirst(str_replace(
                                        '_',
                                        ' ',
                                        $item->kategori_kondisi ?? '-'
                                    )) }}
                                </span>
                                <br>

                                @if($urgensi)
                                    <span class="urgency-badge {{ $urgensiClass }}">
                                        {{ $urgensiLabels[$urgensi] ?? ucfirst($urgensi) }}
                                    </span>
                                @else
                                    <span class="text-muted">Belum ditentukan</span>
                                @endif
                            </td>

                            <td>
                                @if($tanggalLaporan)
                                    <strong>
                                        {{ $tanggalLaporan->format('d M Y') }}
                                    </strong>
                                    <span class="location-sub">
                                        {{ $tanggalLaporan->format('H:i') }} WIB
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('supir.tugas.show', $item->id) }}"
                                   class="btn btn-detail">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="table-empty">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                <strong>
                                    @if($q || $statusFilter || $urgensiFilter)
                                        Tidak ada tugas yang sesuai dengan filter.
                                    @elseif($riwayat)
                                        Belum ada riwayat penanganan.
                                    @else
                                        Belum ada tugas yang ditugaskan kepada Anda.
                                    @endif
                                </strong>

                                <div class="mt-2">
                                    Silakan periksa kembali filter atau tunggu penugasan dari admin.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="task-table-footer">

            <small>
                Menampilkan
                {{ $tugas->firstItem() ?? 0 }}–{{ $tugas->lastItem() ?? 0 }}
                dari {{ $tugas->total() }} tugas penanganan.
            </small>

            <div class="pagination-simple">

                @if($tugas->onFirstPage())
                    <span class="disabled">Sebelumnya</span>
                @else
                    <a href="{{ $tugas->previousPageUrl() }}">
                        Sebelumnya
                    </a>
                @endif

                <span class="current">
                    {{ $tugas->currentPage() }}
                </span>

                @if($tugas->hasMorePages())
                    <a href="{{ $tugas->nextPageUrl() }}">
                        Selanjutnya
                    </a>
                @else
                    <span class="disabled">Selanjutnya</span>
                @endif

            </div>

        </div>

    </div>

    {{-- INFORMASI KESELAMATAN --}}
    <div class="task-bottom">

        <div class="d-flex align-items-center">
            <i class="bi bi-shield-check safety-icon"></i>

            <div>
                <h6>Aturan Disposisi & Privasi Pengemudi</h6>
                <p>
                    Data tugas hanya ditampilkan sesuai akun pengemudi yang sedang login.
                    Pastikan membaca instruksi penanganan dan menjaga keselamatan
                    selama melaksanakan pekerjaan.
                </p>
            </div>
        </div>

        <a href="{{ route('supir.dashboard') }}" class="btn">
            Kembali ke Dashboard
        </a>

    </div>

</div>
@endsection
