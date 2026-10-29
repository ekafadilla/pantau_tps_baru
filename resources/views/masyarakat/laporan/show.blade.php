
@extends('layouts.masyarakat')

@section('header', 'Detail Laporan')

@section('content')
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

<div class="page-heading">
    <div>
        <h1 class="page-title">Detail Laporan</h1>
        <p class="page-description">
            Informasi lengkap dan perkembangan laporan Anda.
        </p>
    </div>

    <a href="{{ route('masyarakat.laporan.index') }}"
       class="btn-app-outline">
        Kembali
    </a>
</div>

<div class="detail-layout">
    <div class="detail-main">
        {{-- Informasi utama --}}
        <div class="app-panel">
            <div class="app-panel-header detail-panel-header">
                <div>
                    <h3 class="app-panel-title">Informasi Laporan</h3>
                    <p class="panel-description">
                        Dikirim pada
                        {{ $laporan->waktu_pelaporan
                            ? \Carbon\Carbon::parse($laporan->waktu_pelaporan)->format('d M Y, H:i')
                            : '-' }}
                    </p>
                </div>

                <span class="status-badge {{ $statusClass }}">
                    {{ ucfirst($status) }}
                </span>
            </div>

            <div class="detail-body">
                <div class="detail-field">
                    <span class="detail-label">TPS</span>
                    <div class="detail-value">
                        {{ $laporan->tps->nama_tps ?? 'Lokasi umum' }}
                    </div>
                </div>

                <div class="detail-field">
                    <span class="detail-label">Kategori Kondisi</span>
                    <div class="detail-value">
                        {{ ucfirst(str_replace('_', ' ', $laporan->kategori_kondisi ?? '-')) }}
                    </div>
                </div>

                <div class="detail-field">
                    <span class="detail-label">Lokasi Kejadian</span>
                    <div class="detail-value">
                        {{ $laporan->lokasi ?? '-' }}
                    </div>
                </div>

                <div class="detail-field">
                    <span class="detail-label">Deskripsi Laporan</span>
                    <div class="detail-value detail-description">
                        {{ $laporan->keterangan ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Foto pendukung --}}
        <div class="app-panel detail-section">
            <div class="app-panel-header">
                <div>
                    <h3 class="app-panel-title">Foto Pendukung</h3>
                    <p class="panel-description">
                        Foto yang disertakan dalam laporan.
                    </p>
                </div>
            </div>

            <div class="photo-grid">
                @forelse ($laporan->fotoLaporan as $foto)
                    <a href="{{ asset('storage/' . $foto->path_foto) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="photo-item">
                        <img
                            src="{{ asset('storage/' . $foto->path_foto) }}"
                            alt="{{ $foto->nama_file ?? 'Foto laporan' }}"
                            loading="lazy"
                        >
                        <span>
                            {{ $foto->nama_file ?? 'Foto pendukung' }}
                        </span>
                    </a>
                @empty
                    <div class="empty-photo">
                        Belum ada foto pendukung yang tersimpan.
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Riwayat status --}}
        <div class="app-panel detail-section">
            <div class="app-panel-header">
                <div>
                    <h3 class="app-panel-title">Riwayat Status</h3>
                    <p class="panel-description">
                        Catatan perubahan status laporan.
                    </p>
                </div>
            </div>

            <div class="history-body">
                @forelse ($laporan->riwayatStatus as $riwayat)
                    <div class="history-item">
                        <div class="history-dot"></div>

                        <div class="history-content">
                            <strong>
                                {{ ucfirst(str_replace('_', ' ', $riwayat->status_baru ?? $riwayat->status_sebelumnya ?? 'Status diperbarui')) }}
                            </strong>

                            @if (!empty($riwayat->keterangan))
                                <p>{{ $riwayat->keterangan }}</p>
                            @endif

                            <small>
                                {{ $riwayat->created_at
                                    ? \Carbon\Carbon::parse($riwayat->created_at)->format('d M Y, H:i')
                                    : 'Waktu tidak tersedia' }}
                            </small>
                        </div>
                    </div>
                @empty
                    <div class="empty-history">
                        <strong>Belum ada riwayat perubahan</strong>
                        <p>
                            Status saat ini:
                            <span class="status-badge {{ $statusClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Ringkasan status --}}
    <aside class="app-panel detail-summary">
        <div class="app-panel-header">
            <h3 class="app-panel-title">Ringkasan Status</h3>
        </div>

        <div class="summary-body">
            <div class="summary-status-icon">✓</div>

            <p class="summary-label">Status Saat Ini</p>

            <span class="status-badge {{ $statusClass }}">
                {{ ucfirst($status) }}
            </span>

            <div class="summary-divider"></div>

            <p class="summary-label">Tanggal Pelaporan</p>
            <strong class="summary-date">
                {{ $laporan->waktu_pelaporan
                    ? \Carbon\Carbon::parse($laporan->waktu_pelaporan)->format('d M Y')
                    : '-' }}
            </strong>

            <div class="summary-divider"></div>

            <p class="summary-help">
                Anda dapat memantau perubahan status laporan melalui halaman ini.
            </p>

            <a href="{{ route('masyarakat.laporan.index') }}"
               class="btn-app-outline summary-button">
                Daftar Laporan
            </a>
        </div>
    </aside>
</div>

<style>
    .detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 260px;
        gap: 20px;
        align-items: start;
    }

    .detail-main {
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-width: 0;
    }

    .detail-section {
        overflow: hidden;
    }

    .detail-panel-header {
        align-items: flex-start;
        gap: 12px;
    }

    .panel-description {
        margin: 5px 0 0;
        color: #718078;
        font-size: 13px;
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

    .status-diverifikasi,
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

    .detail-body {
        padding: 22px;
    }

    .detail-field {
        margin-bottom: 22px;
    }

    .detail-field:last-child {
        margin-bottom: 0;
    }

    .detail-label {
        display: block;
        margin-bottom: 7px;
        color: #718078;
        font-size: 12px;
    }

    .detail-value {
        color: #26382f;
        font-size: 14px;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .detail-description {
        white-space: pre-line;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 14px;
        padding: 20px;
    }

    .photo-item {
        display: block;
        overflow: hidden;
        border: 1px solid #e1e9e3;
        border-radius: 8px;
        color: #405047;
        font-size: 12px;
        text-decoration: none;
    }

    .photo-item img {
        display: block;
        width: 100%;
        height: 145px;
        object-fit: cover;
        background: #f4f7f5;
    }

    .photo-item span {
        display: block;
        padding: 10px;
        overflow-wrap: anywhere;
    }

    .empty-photo,
    .empty-history {
        padding: 20px;
        color: #718078;
        font-size: 13px;
        line-height: 1.7;
    }

    .history-body {
        padding: 22px;
    }

    .history-item {
        position: relative;
        display: flex;
        gap: 13px;
        padding-bottom: 24px;
    }

    .history-item:last-child {
        padding-bottom: 0;
    }

    .history-dot {
        position: relative;
        width: 12px;
        height: 12px;
        flex-shrink: 0;
        margin-top: 4px;
        border: 3px solid #cde7d4;
        border-radius: 50%;
        background: #176b43;
    }

    .history-item:not(:last-child) .history-dot::after {
        position: absolute;
        top: 10px;
        left: 2px;
        width: 2px;
        height: calc(100% + 18px);
        min-height: 30px;
        background: #dce8df;
        content: "";
    }

    .history-content strong {
        display: block;
        color: #26382f;
        font-size: 13px;
    }

    .history-content p {
        margin: 6px 0;
        color: #52685a;
        font-size: 12px;
        line-height: 1.6;
    }

    .history-content small {
        display: block;
        margin-top: 6px;
        color: #718078;
        font-size: 11px;
    }

    .empty-history strong {
        display: block;
        margin-bottom: 8px;
        color: #26382f;
    }

    .empty-history p {
        margin: 0;
    }

    .detail-summary {
        overflow: hidden;
    }

    .summary-body {
        padding: 22px;
        text-align: center;
    }

    .summary-status-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #e2f1e7;
        color: #176b43;
        font-size: 24px;
    }

    .summary-label {
        margin: 0 0 8px;
        color: #718078;
        font-size: 12px;
    }

    .summary-date {
        color: #26382f;
        font-size: 14px;
    }

    .summary-divider {
        height: 1px;
        margin: 20px 0;
        background: #e8eee9;
    }

    .summary-help {
        margin: 0 0 18px;
        color: #718078;
        font-size: 12px;
        line-height: 1.7;
        text-align: left;
    }

    .summary-button {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 39px;
        padding: 0 12px;
        border: 1px solid #dce5de;
        border-radius: 7px;
        color: #405047;
        font-size: 12px;
        text-decoration: none;
    }

    @media (max-width: 950px) {
        .detail-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .detail-panel-header {
            flex-direction: column;
        }

        .detail-body,
        .history-body {
            padding: 18px;
        }

        .photo-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            padding: 16px;
        }
    }
</style>
@endsection
