
@extends('layouts.masyarakat')

@section('header', 'Laporan Saya')

@section('content')
<div class="page-heading">
    <div>
        <h1 class="page-title">Laporan Saya</h1>
        <p class="page-description">
            Lihat dan pantau perkembangan laporan sampah yang telah Anda kirim.
        </p>
    </div>

    <a href="{{ route('masyarakat.laporan.create') }}" class="btn-app-primary">
        + Buat Laporan
    </a>
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
            <p class="stat-label">Laporan Berjalan</p>
            <h3 class="stat-number">{{ $laporanBerjalan }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-purple">✓</div>
        <div>
            <p class="stat-label">Laporan Selesai</p>
            <h3 class="stat-number">{{ $laporanSelesai }}</h3>
        </div>
    </div>
</div>

{{-- Daftar laporan --}}
<div class="app-panel">
    <div class="app-panel-header">
        <div>
            <h3 class="app-panel-title">Daftar Laporan</h3>
            <p class="panel-description">
                Gunakan pencarian atau filter status untuk menemukan laporan.
            </p>
        </div>
    </div>

    <div class="filter-area">
        <form action="{{ route('masyarakat.laporan.index') }}"
              method="GET"
              class="filter-form">

            <div class="filter-search">
                <label for="cari">Cari laporan</label>
                <input
                    type="text"
                    id="cari"
                    name="cari"
                    value="{{ request('cari') }}"
                    placeholder="Cari lokasi atau keterangan..."
                >
            </div>

            <div class="filter-status">
                <label for="status">Status laporan</label>
                <select id="status" name="status">
                    <option value="">Semua Status</option>
                    <option value="menunggu" @selected(request('status') === 'menunggu')>
                        Menunggu
                    </option>
                    <option value="diverifikasi" @selected(request('status') === 'diverifikasi')>
                        Diverifikasi
                    </option>
                    <option value="diproses" @selected(request('status') === 'diproses')>
                        Diproses
                    </option>
                    <option value="ditangani" @selected(request('status') === 'ditangani')>
                        Ditangani
                    </option>
                    <option value="selesai" @selected(request('status') === 'selesai')>
                        Selesai
                    </option>
                    <option value="ditolak" @selected(request('status') === 'ditolak')>
                        Ditolak
                    </option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn-app-primary">
                    Cari
                </button>

                <a href="{{ route('masyarakat.laporan.index') }}"
                   class="btn-app-outline">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Lokasi / TPS</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($laporan as $item)
                    @php
                        $status = strtolower($item->status_laporan ?? 'menunggu');

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

                    <tr>
                        <td>
                            {{ ($laporan->firstItem() ?? 1) + $loop->index }}
                        </td>

                        <td>
                            <div class="table-main-text">
                                {{ $item->tps->nama_tps ?? 'Lokasi umum' }}
                            </div>
                            <div class="table-sub-text">
                                {{ $item->lokasi }}
                            </div>
                        </td>

                        <td>
                            {{ ucfirst(str_replace('_', ' ', $item->kategori_kondisi)) }}
                        </td>

                        <td>
                            {{ $item->waktu_pelaporan
                                ? \Carbon\Carbon::parse($item->waktu_pelaporan)->format('d/m/Y')
                                : '-' }}
                        </td>

                        <td>
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

                            <strong>
                                {{ request()->filled('cari') || request()->filled('status')
                                    ? 'Laporan tidak ditemukan'
                                    : 'Belum ada laporan' }}
                            </strong>

                            <p>
                                {{ request()->filled('cari') || request()->filled('status')
                                    ? 'Coba ubah kata kunci atau filter status.'
                                    : 'Laporan yang Anda buat akan ditampilkan di halaman ini.' }}
                            </p>

                            @if (!request()->filled('cari') && !request()->filled('status'))
                                <a href="{{ route('masyarakat.laporan.create') }}"
                                   class="btn-app-primary">
                                    Buat Laporan
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($laporan->hasPages())
        <div class="pagination-area">
            {{ $laporan->withQueryString()->links() }}
        </div>
    @endif
</div>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px;
        min-width: 0;
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
        color: #946200;
        background: #fff2cc;
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

    .filter-area {
        padding: 18px 20px;
        border-bottom: 1px solid #e1e9e3;
    }

    .filter-form {
        display: flex;
        align-items: flex-end;
        gap: 14px;
    }

    .filter-search,
    .filter-status {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .filter-search {
        flex: 1;
        min-width: 180px;
    }

    .filter-status {
        width: 190px;
        flex-shrink: 0;
    }

    .filter-form label {
        color: #405047;
        font-size: 12px;
        font-weight: 600;
    }

    .filter-form input,
    .filter-form select {
        width: 100%;
        height: 40px;
        padding: 0 12px;
        border: 1px solid #dce5de;
        border-radius: 7px;
        outline: none;
        background: #fff;
        color: #26382f;
        font: inherit;
        font-size: 13px;
    }

    .filter-form input:focus,
    .filter-form select:focus {
        border-color: #176b43;
        box-shadow: 0 0 0 3px rgba(23, 107, 67, .08);
    }

    .filter-actions {
        display: flex;
        gap: 8px;
    }

    .filter-actions .btn-app-primary,
    .filter-actions .btn-app-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 0 15px;
        border-radius: 7px;
        font-size: 13px;
        text-decoration: none;
        cursor: pointer;
    }

    .filter-actions .btn-app-primary {
        border: 1px solid #176b43;
    }

    .filter-actions .btn-app-outline {
        border: 1px solid #dce5de;
        background: #fff;
        color: #405047;
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
        margin-bottom: 4px;
        color: #26382f;
        font-weight: 600;
    }

    .table-sub-text {
        max-width: 240px;
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

    .table-action {
        color: #176b43;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .table-action:hover {
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

    .pagination-area {
        padding: 16px 20px;
        border-top: 1px solid #e1e9e3;
    }

    @media (max-width: 900px) {
        .filter-form {
            flex-wrap: wrap;
        }

        .filter-search {
            flex-basis: 100%;
        }

        .filter-status {
            flex: 1;
        }
    }

    @media (max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filter-status {
            width: 100%;
            flex-basis: 100%;
        }

        .filter-actions {
            width: 100%;
        }
    }
</style>
@endsection
