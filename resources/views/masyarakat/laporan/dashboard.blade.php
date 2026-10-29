@extends('layouts.masyarakat')

@section('header', 'Dashboard Masyarakat')

@section('content')
<div class="page-heading">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-description">
            Pantau laporan sampah yang telah Anda sampaikan kepada
            Dinas Lingkungan Hidup Kabupaten Indramayu.
        </p>
    </div>

    <a href="{{ route('masyarakat.laporan.create') }}"
       class="btn-app-primary">
        + Buat Laporan
    </a>
</div>

{{-- Banner sambutan --}}
<div class="welcome-banner">
    <div class="welcome-text">
        <h2>Halo, {{ auth()->user()->name }}!</h2>
        <p>
            Terima kasih telah berpartisipasi menjaga kebersihan
            lingkungan. Mari bersama wujudkan Indramayu yang lebih bersih.
        </p>
    </div>

    <div class="welcome-icon">♻</div>
</div>

{{-- Ringkasan laporan --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon stat-green">▤</div>
        <div>
            <p class="stat-label">Total Laporan</p>
            <h3 class="stat-number">{{ $totalLaporan }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-yellow">◷</div>
        <div>
            <p class="stat-label">Menunggu</p>
            <h3 class="stat-number">{{ $laporanMenunggu }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-blue">↻</div>
        <div>
            <p class="stat-label">Diproses</p>
            <h3 class="stat-number">{{ $laporanDiproses }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-purple">✓</div>
        <div>
            <p class="stat-label">Selesai</p>
            <h3 class="stat-number">{{ $laporanSelesai }}</h3>
        </div>
    </div>
</div>

{{-- Laporan terbaru --}}
<div class="app-panel">
    <div class="app-panel-header">
        <div>
            <h3 class="app-panel-title">Laporan Terbaru</h3>
            <p class="panel-description">
                Daftar laporan yang terakhir Anda buat.
            </p>
        </div>

        <a href="{{ route('masyarakat.laporan.index') }}"
           class="btn-app-outline">
            Lihat Semua
        </a>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Lokasi / TPS</th>
                    <th>Kategori</th>
                    <th>Tanggal Laporan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($laporanTerbaru as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <div class="table-main-text">
                                {{ $laporan->tps->nama_tps ?? 'Lokasi umum' }}
                            </div>
                            <div class="table-sub-text">
                                {{ $laporan->lokasi }}
                            </div>
                        </td>

                        <td>
                            {{ ucfirst(str_replace('_', ' ', $laporan->kategori_kondisi)) }}
                        </td>

                        <td>
                            {{ $laporan->waktu_pelaporan
                                ? \Carbon\Carbon::parse($laporan->waktu_pelaporan)->format('d/m/Y')
                                : '-' }}
                        </td>

                        <td>
                            @php
                                $status = strtolower($laporan->status_laporan ?? 'menunggu');

                                $statusClass = match ($status) {
                                    'menunggu' => 'status-menunggu',
                                    'diverifikasi' => 'status-diverifikasi',
                                    'diproses' => 'status-diproses',
                                    'ditangani' => 'status-ditangani',
                                    'selesai' => 'status-selesai',
                                    'ditolak' => 'status-ditolak',
                                    default => 'status-menunggu',
                                };
                            @endphp

                            <span class="status-badge {{ $statusClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('masyarakat.laporan.index') }}"
                               class="table-action">
                                Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-table">
                            <div class="empty-icon">▤</div>
                            <strong>Belum ada laporan</strong>
                            <p>
                                Anda belum membuat laporan sampah.
                                Silakan buat laporan pertama Anda.
                            </p>
                            <a href="{{ route('masyarakat.laporan.create') }}"
                               class="btn-app-primary">
                                Buat Laporan
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Informasi bantuan --}}
<div class="help-panel">
    <div class="help-icon">i</div>

    <div>
        <h3>Butuh Bantuan?</h3>
        <p>
            Jika mengalami kendala saat membuat laporan, silakan
            hubungi Dinas Lingkungan Hidup Kabupaten Indramayu melalui
            saluran layanan resmi yang tersedia.
        </p>
    </div>
</div>

<style>
    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 22px;
    }

    .welcome-banner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 26px 30px;
        margin-bottom: 22px;
        border-radius: 12px;
        background: #e7f3ea;
        border: 1px solid #d5e9da;
    }

    .welcome-text h2 {
        margin: 0 0 8px;
        color: #176b43;
        font-size: 22px;
        font-weight: 700;
    }

    .welcome-text p {
        max-width: 650px;
        margin: 0;
        color: #52685a;
        font-size: 14px;
        line-height: 1.7;
    }

    .welcome-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #d2e9d9;
        color: #176b43;
        font-size: 34px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        padding: 20px;
        background: #fff;
        border: 1px solid #e1e9e3;
        border-radius: 10px;
    }

    .stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        border-radius: 10px;
        font-size: 23px;
        font-weight: 600;
    }

    .stat-green {
        color: #176b43;
        background: #e2f1e7;
    }

    .stat-yellow {
        color: #9a6b09;
        background: #fff3d5;
    }

    .stat-blue {
        color: #2368a4;
        background: #e3effb;
    }

    .stat-purple {
        color: #6b50a3;
        background: #eee8fb;
    }

    .stat-label {
        margin: 0 0 6px;
        color: #718078;
        font-size: 13px;
    }

    .stat-number {
        margin: 0;
        color: #26382f;
        font-size: 25px;
        font-weight: 700;
    }

    .panel-description {
        margin: 5px 0 0;
        color: #718078;
        font-size: 13px;
    }

    .app-table {
        width: 100%;
        border-collapse: collapse;
    }

    .app-table th {
        padding: 14px 16px;
        color: #65746a;
        background: #f7f9f7;
        border-bottom: 1px solid #e1e9e3;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .app-table td {
        padding: 15px 16px;
        color: #405047;
        border-bottom: 1px solid #edf1ed;
        font-size: 13px;
        vertical-align: middle;
    }

    .app-table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-main-text {
        color: #26382f;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .table-sub-text {
        max-width: 220px;
        color: #718078;
        font-size: 12px;
        line-height: 1.5;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        color: #946200;
        background: #fff2cc;
    }

    .status-diverifikasi {
        color: #245f9b;
        background: #e2efff;
    }

    .status-diproses {
        color: #245f9b;
        background: #e2efff;
    }

    .status-ditangani {
        color: #6b50a3;
        background: #eee8fb;
    }

    .status-selesai {
        color: #176b43;
        background: #e2f1e7;
    }

    .status-ditolak {
        color: #a12c2c;
        background: #fde8e8;
    }

    .table-action {
        color: #176b43;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .table-action:hover {
        color: #125735;
        text-decoration: underline;
    }

    .empty-table {
        padding: 40px 20px !important;
        text-align: center !important;
    }

    .empty-icon {
        margin-bottom: 10px;
        color: #9aaca0;
        font-size: 30px;
    }

    .empty-table strong {
        display: block;
        color: #26382f;
        font-size: 15px;
    }

    .empty-table p {
        margin: 8px 0 18px;
        color: #718078;
        font-size: 13px;
    }

    .help-panel {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 20px;
        margin-top: 22px;
        border: 1px solid #dce8df;
        border-radius: 10px;
        background: #fff;
    }

    .help-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #e2f1e7;
        color: #176b43;
        font-weight: 700;
    }

    .help-panel h3 {
        margin: 2px 0 7px;
        color: #26382f;
        font-size: 15px;
        font-weight: 600;
    }

    .help-panel p {
        margin: 0;
        color: #718078;
        font-size: 13px;
        line-height: 1.7;
    }

    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .page-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .welcome-banner {
            padding: 20px;
        }

        .welcome-text h2 {
            font-size: 19px;
        }

        .welcome-icon {
            display: none;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>
@endsection