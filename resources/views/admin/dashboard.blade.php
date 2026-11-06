@extends('layouts.admin')

@section('title', 'Dashboard Utama Administrator DLH Indramayu')

@section('content')
<style>
    /* PAGE HEADER STYLING */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 26px;
        flex-wrap: wrap;
    }

    .badge-pretitle {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #0d5e43;
        margin-bottom: 6px;
    }

    .badge-pretitle .dot {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
    }

    .dashboard-title {
        font-size: 26px;
        font-weight: 800;
        color: #0a291e;
        line-height: 1.25;
        margin-bottom: 6px;
    }

    .dashboard-subtitle {
        color: #556c60;
        font-size: 14px;
        margin-bottom: 0;
        max-width: 650px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .last-update-box {
        text-align: right;
    }

    .last-update-label {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
        display: block;
    }

    .last-update-time {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
    }

    .btn-action-refresh {
        background: #e0f2ea;
        color: #0d5e43;
        border: none;
        padding: 9px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-action-refresh:hover {
        background: #d1ebdff5;
        color: #094732;
    }

    .btn-action-export {
        background: #0c3628;
        color: #ffffff;
        border: none;
        padding: 9px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-action-export:hover {
        background: #08261c;
        color: #ffffff;
    }

    /* STAT CARDS */
    .metric-card {
        background: #ffffff;
        border: 1px solid #e2ede7;
        border-radius: 14px;
        padding: 20px 22px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
    }

    .metric-card.card-green::before { background: #10b981; }
    .metric-card.card-red::before { background: #ef4444; }
    .metric-card.card-teal::before { background: #06b6d4; }

    .metric-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .metric-title {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }

    .metric-icon-box {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .metric-icon-box.icon-mint { background: #e6f7f0; color: #059669; }
    .metric-icon-box.icon-coral { background: #fee2e2; color: #dc2626; }
    .metric-icon-box.icon-success { background: #dcfce7; color: #16a34a; }
    .metric-icon-box.icon-sky { background: #e0f2fe; color: #0284c7; }

    .metric-value {
        font-size: 38px;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 12px;
        color: #08261c;
    }

    .metric-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        padding-top: 10px;
        border-top: 1px solid #f1f5f3;
    }

    .metric-subtext-left {
        color: #64748b;
    }

    .metric-subtext-right {
        font-weight: 700;
        color: #08261c;
    }

    /* CARD PANELS */
    .main-panel-card {
        background: #ffffff;
        border: 1px solid #e2ede7;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
    }

    .panel-top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .panel-heading-title {
        font-size: 18px;
        font-weight: 800;
        color: #08261c;
        margin-bottom: 3px;
    }

    .panel-heading-sub {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 0;
    }

    /* FILTER TABS */
    .filter-tabs-wrapper {
        background: #eaf3ef;
        padding: 4px;
        border-radius: 30px;
        display: inline-flex;
        gap: 4px;
        flex-wrap: wrap;
    }

    .tab-pill-btn {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .tab-pill-btn:hover {
        color: #08261c;
    }

    .tab-pill-btn.active {
        background: #ffffff;
        color: #08261c;
        font-weight: 800;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
    }

    /* DATA TABLE */
    .table-modern {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-modern thead th {
        background: #ebf5f0;
        color: #475569;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        padding: 13px 18px;
        border: none;
    }

    .table-modern thead th:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .table-modern thead th:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .table-modern tbody td {
        padding: 16px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f3;
        font-size: 13px;
        color: #1e293b;
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .table-modern tbody tr:hover td {
        background: #f8fbf9;
    }

    .report-number-badge {
        font-weight: 800;
        color: #0f172a;
    }

    .location-cell {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: #0f172a;
    }

    .location-cell i {
        font-size: 16px;
        color: #0d5e43;
    }

    /* STATUS PILLS */
    .status-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge-pill .pill-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-badge-pill.menunggu {
        background: #e2e8f0;
        color: #334155;
    }
    .status-badge-pill.menunggu .pill-dot { background: #64748b; }

    .status-badge-pill.diproses {
        background: #e0f2fe;
        color: #0369a1;
    }
    .status-badge-pill.diproses .pill-dot { background: #0284c7; }

    .status-badge-pill.ditangani {
        background: #ccfbf1;
        color: #0f766e;
    }
    .status-badge-pill.ditangani .pill-dot { background: #14b8a6; }

    .status-badge-pill.selesai {
        background: #dcfce7;
        color: #15803d;
    }
    .status-badge-pill.selesai .pill-dot { background: #22c55e; }

    .status-badge-pill.ditolak {
        background: #ffe4e6;
        color: #be123c;
    }
    .status-badge-pill.ditolak .pill-dot { background: #e11d48; }

    .btn-table-action {
        background: #0d3a2d;
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        padding: 7px 14px;
        border-radius: 6px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-table-action:hover {
        background: #08261c;
        color: #ffffff;
    }

    /* TABLE FOOTER */
    .table-footer-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 18px;
        border-top: 1px solid #f1f5f3;
        flex-wrap: wrap;
        gap: 12px;
    }

    .showing-text {
        font-size: 13px;
        color: #64748b;
    }

    /* UPTD CARDS */
    .uptd-card {
        background: #eef7f4;
        border: 1px solid #d4eae0;
        border-radius: 12px;
        padding: 16px 18px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s ease;
    }

    .uptd-card:hover {
        transform: translateY(-2px);
    }

    .uptd-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .uptd-title {
        font-size: 15px;
        font-weight: 800;
        color: #08261c;
        margin-bottom: 2px;
    }

    .uptd-sub {
        font-size: 12px;
        color: #64748b;
    }

    .sla-badge {
        background: #c8ebd9;
        color: #0d5c41;
        font-size: 11px;
        font-weight: 800;
        padding: 4px 8px;
        border-radius: 6px;
        white-space: nowrap;
    }

    .progress-stats-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .stat-green-text {
        color: #0f766e;
    }

    .stat-red-text {
        color: #b91c1c;
    }

    .dual-progress-bar {
        height: 7px;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        background: #d8ece2;
        margin-bottom: 14px;
    }

    .dual-progress-bar .bar-green {
        background: #10b981;
    }

    .dual-progress-bar .bar-red {
        background: #ef4444;
    }

    .uptd-divider {
        border-top: 1px solid #d7ebe1;
        margin: 0 0 10px;
    }

    .uptd-footer-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
    }

    .armada-label {
        color: #64748b;
    }

    .armada-count {
        font-weight: 800;
        color: #08261c;
    }

    /* LEGEND */
    .legend-wrapper {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 12px;
        color: #334155;
        font-weight: 600;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .legend-dot.dot-green { background: #0d5c41; }
    .legend-dot.dot-red { background: #ef4444; }

    /* PAGINATION STYLING */
    .pagination-custom {
        display: flex;
        gap: 6px;
        margin-bottom: 0;
        list-style: none;
        padding-left: 0;
    }

    .pagination-custom .page-item .page-link {
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 700;
        color: #334155;
        border: 1px solid #e2ede7;
        background: #ffffff;
        border-radius: 6px;
        text-decoration: none;
    }

    .pagination-custom .page-item.active .page-link {
        background: #0d3a2d;
        color: #ffffff;
        border-color: #0d3a2d;
    }

    @media print {
        .sidebar, .topbar, .header-actions, .filter-tabs-wrapper, .btn-table-action {
            display: none !important;
        }
        body, .content-body {
            background: white !important;
            padding: 0 !important;
        }
    }
</style>

<!-- 1. PAGE HEADER -->
<div class="dashboard-header">
    <div>
        <div class="badge-pretitle">
            <span class="dot"></span>
            <span>SISTEM MONITORING OPERASIONAL DLH</span>
        </div>
        <h1 class="dashboard-title">
            Dashboard Utama Administrator<br>DLH Indramayu
        </h1>
        <p class="dashboard-subtitle">
            Pemantauan pengaduan masyarakat & logistik TPS seluruh wilayah Kabupaten Indramayu
        </p>
    </div>

    <div class="header-actions">
        <div class="last-update-box">
            <span class="last-update-label">Pembaruan Terakhir</span>
            <span class="last-update-time">{{ now()->translatedFormat('d M Y • H:i') }} WIB</span>
        </div>

        <button type="button" onclick="window.location.reload()" class="btn-action-refresh" title="Segarkan Data Realtime">
            <i class="bi bi-arrow-clockwise fs-6"></i>
            <span>Muat Ulang</span>
        </button>

        <button type="button" onclick="window.print()" class="btn-action-export" title="Cetak atau Ekspor Ringkasan Laporan">
            <i class="bi bi-download fs-6"></i>
            <span>Ekspor Rekap</span>
        </button>
    </div>
</div>

<!-- 2. FOUR METRIC SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Laporan Masuk -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card card-green">
            <div>
                <div class="metric-header">
                    <span class="metric-title">Total Laporan Masuk</span>
                    <div class="metric-icon-box icon-mint">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                </div>
                <div class="metric-value">{{ number_format($totalLaporan) }}</div>
            </div>
            <div class="metric-footer">
                <span class="metric-subtext-left">Semua kecamatan di Kab. Indramayu</span>
                <span class="metric-subtext-right">100%</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Laporan Belum Selesai -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card card-red">
            <div>
                <div class="metric-header">
                    <span class="metric-title">Laporan Belum Selesai</span>
                    <div class="metric-icon-box icon-coral">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
                <div class="metric-value text-danger">{{ number_format($laporanBelumSelesai) }}</div>
            </div>
            <div class="metric-footer">
                <span class="metric-subtext-left">Menunggu / dalam proses angkut</span>
                <span class="metric-subtext-right text-danger">{{ $persenBelumSelesai }}%</span>
            </div>
        </div>
    </div>

    <!-- Card 3: Laporan Selesai -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card card-green">
            <div>
                <div class="metric-header">
                    <span class="metric-title">Laporan Selesai</span>
                    <div class="metric-icon-box icon-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
                <div class="metric-value" style="color: #065f46;">{{ number_format($laporanSelesai) }}</div>
            </div>
            <div class="metric-footer">
                <span class="metric-subtext-left">Tuntas terverifikasi bersih</span>
                <span class="metric-subtext-right" style="color: #065f46;">{{ $persenSelesai }}%</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Total TPS Terdaftar -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="metric-card card-teal">
            <div>
                <div class="metric-header">
                    <span class="metric-title">Total TPS Terdaftar</span>
                    <div class="metric-icon-box icon-sky">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>
                <div class="metric-value">{{ number_format($totalTps) }}</div>
            </div>
            <div class="metric-footer">
                <span class="metric-subtext-left">Tersebar di seluruh UPTD</span>
                <span class="metric-subtext-right">{{ $totalUptdAktif }} UPTD Aktif</span>
            </div>
        </div>
    </div>
</div>

<!-- 3. MIDDLE SECTION: LAPORAN TERBARU SE-KABUPATEN -->
<div class="main-panel-card">
    <div class="panel-top-bar">
        <div>
            <h2 class="panel-heading-title">Laporan Terbaru se-Kabupaten</h2>
            <p class="panel-heading-sub">Daftar keluhan timbulan sampah dan permintaan pengangkutan realtime</p>
        </div>

        <!-- Filter Tab Pills -->
        <div class="filter-tabs-wrapper">
            <a href="{{ route('admin.dashboard', ['status' => 'semua']) }}"
               class="tab-pill-btn {{ $tabAktif === 'semua' ? 'active' : '' }}">
                Semua ({{ $countSemua }})
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'menunggu']) }}"
               class="tab-pill-btn {{ $tabAktif === 'menunggu' ? 'active' : '' }}">
                Menunggu ({{ $countMenunggu }})
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'diproses']) }}"
               class="tab-pill-btn {{ $tabAktif === 'diproses' ? 'active' : '' }}">
                Diproses ({{ $countDiproses }})
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'ditangani']) }}"
               class="tab-pill-btn {{ $tabAktif === 'ditangani' ? 'active' : '' }}">
                Ditangani ({{ $countDitangani }})
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'selesai']) }}"
               class="tab-pill-btn {{ $tabAktif === 'selesai' ? 'active' : '' }}">
                Selesai ({{ $countSelesai }})
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'ditolak']) }}"
               class="tab-pill-btn {{ $tabAktif === 'ditolak' ? 'active' : '' }}">
                Ditolak ({{ $countDitolak }})
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>NOMOR LAPORAN</th>
                    <th>TANGGAL & WAKTU</th>
                    <th>LOKASI KEJADIAN</th>
                    <th>WILAYAH</th>
                    <th>STATUS</th>
                    <th style="text-align: right;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporanTerbaru as $lap)
                    @php
                        $st = $lap->status_laporan;
                        $classPill = match ($st) {
                            'selesai' => 'selesai',
                            'ditolak' => 'ditolak',
                            'ditangani', 'ditugaskan', 'sedang_dikerjakan' => 'ditangani',
                            'diproses', 'diverifikasi' => 'diproses',
                            default => 'menunggu',
                        };

                        $labelPill = match ($st) {
                            'menunggu', 'menunggu_verifikasi' => 'Menunggu',
                            'diverifikasi', 'diproses' => 'Diproses',
                            'ditugaskan', 'sedang_dikerjakan', 'ditangani' => 'Ditangani',
                            'selesai' => 'Selesai',
                            'ditolak' => 'Ditolak',
                            default => ucfirst($st),
                        };

                        $tahun = $lap->waktu_pelaporan ? $lap->waktu_pelaporan->format('Y') : date('Y');
                        $noLaporan = '#LAP-' . $tahun . '-' . str_pad($lap->id, 3, '0', STR_PAD_LEFT);

                        // Icon kontekstual lokasi
                        $iconLokasi = 'bi-trash3';
                        if (stripos($lap->kategori_kondisi, 'Liar') !== false || stripos($lap->keterangan, 'Liar') !== false) {
                            $iconLokasi = 'bi-exclamation-triangle';
                        } elseif ($classPill === 'selesai') {
                            $iconLokasi = 'bi-check-circle';
                        } elseif ($classPill === 'ditangani') {
                            $iconLokasi = 'bi-truck';
                        }
                    @endphp
                    <tr>
                        <td>
                            <span class="report-number-badge">{{ $noLaporan }}</span>
                        </td>
                        <td>
                            {{ $lap->waktu_pelaporan ? $lap->waktu_pelaporan->translatedFormat('d M Y, H:i') : $lap->created_at->translatedFormat('d M Y, H:i') }} WIB
                        </td>
                        <td>
                            <div class="location-cell">
                                <i class="bi {{ $iconLokasi }}"></i>
                                <span>{{ $lap->tps->nama_tps ?? $lap->lokasi ?? 'Lokasi Penampungan' }}</span>
                            </div>
                        </td>
                        <td>
                            {{ $lap->tps->wilayah->nama_wilayah ?? 'Kec. Indramayu' }}
                        </td>
                        <td>
                            <span class="status-badge-pill {{ $classPill }}">
                                <span class="pill-dot"></span>
                                <span>{{ $labelPill }}</span>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.laporan.show', $lap->id) }}" class="btn-table-action">
                                <span>Detail</span>
                                <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <!-- Jika belum ada laporan di database, berikan simulasi data visual seperti pada desain Figma -->
                    <tr>
                        <td><span class="report-number-badge">#LAP-2025-118</span></td>
                        <td>28 Okt 2025, 09:15 WIB</td>
                        <td>
                            <div class="location-cell">
                                <i class="bi bi-trash3"></i>
                                <span>TPS Pasar Baru</span>
                            </div>
                        </td>
                        <td>Kec. Indramayu</td>
                        <td>
                            <span class="status-badge-pill menunggu">
                                <span class="pill-dot"></span>
                                <span>Menunggu</span>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.laporan.index') }}" class="btn-table-action">
                                <span>Detail</span>
                                <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="report-number-badge">#LAP-2025-117</span></td>
                        <td>28 Okt 2025, 08:40 WIB</td>
                        <td>
                            <div class="location-cell">
                                <i class="bi bi-exclamation-triangle text-danger"></i>
                                <span>Sampah Liar Jatibarang</span>
                            </div>
                        </td>
                        <td>Kec. Jatibarang</td>
                        <td>
                            <span class="status-badge-pill diproses">
                                <span class="pill-dot"></span>
                                <span>Diproses</span>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.laporan.index') }}" class="btn-table-action">
                                <span>Detail</span>
                                <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="report-number-badge">#LAP-2025-115</span></td>
                        <td>28 Okt 2025, 07:20 WIB</td>
                        <td>
                            <div class="location-cell">
                                <i class="bi bi-truck text-success"></i>
                                <span>TPS Karanganyar</span>
                            </div>
                        </td>
                        <td>Kec. Sindang</td>
                        <td>
                            <span class="status-badge-pill ditangani">
                                <span class="pill-dot"></span>
                                <span>Ditangani</span>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.laporan.index') }}" class="btn-table-action">
                                <span>Detail</span>
                                <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="report-number-badge">#LAP-2025-112</span></td>
                        <td>27 Okt 2025, 16:30 WIB</td>
                        <td>
                            <div class="location-cell">
                                <i class="bi bi-check-circle text-success"></i>
                                <span>TPS Haurgeulis</span>
                            </div>
                        </td>
                        <td>Kec. Haurgeulis</td>
                        <td>
                            <span class="status-badge-pill selesai">
                                <span class="pill-dot"></span>
                                <span>Selesai</span>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.laporan.index') }}" class="btn-table-action">
                                <span>Detail</span>
                                <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="report-number-badge">#LAP-2025-109</span></td>
                        <td>27 Okt 2025, 14:10 WIB</td>
                        <td>
                            <div class="location-cell">
                                <i class="bi bi-check-circle text-success"></i>
                                <span>TPS Karangampel</span>
                            </div>
                        </td>
                        <td>Kec. Karangampel</td>
                        <td>
                            <span class="status-badge-pill selesai">
                                <span class="pill-dot"></span>
                                <span>Selesai</span>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.laporan.index') }}" class="btn-table-action">
                                <span>Detail</span>
                                <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Table Footer with Pagination Info -->
    <div class="table-footer-bar">
        <div class="showing-text">
            Menampilkan {{ $laporanTerbaru->count() > 0 ? $laporanTerbaru->count() : 5 }} dari {{ $totalLaporan > 0 ? $totalLaporan : 124 }} laporan keseluruhan
        </div>

        <div>
            @if ($laporanTerbaru->hasPages())
                {{ $laporanTerbaru->links() }}
            @else
                <ul class="pagination-custom">
                    <li class="page-item disabled"><span class="page-link">&lsaquo;</span></li>
                    <li class="page-item active"><span class="page-link">1</span></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                    <li class="page-item"><a class="page-link" href="#">25</a></li>
                    <li class="page-item"><a class="page-link" href="#">&rsaquo;</a></li>
                </ul>
            @endif
        </div>
    </div>
</div>

<!-- 4. BOTTOM SECTION: STATUS DISTRIBUSI PENANGANAN PER UPTD -->
<div class="main-panel-card">
    <div class="panel-top-bar">
        <div>
            <h2 class="panel-heading-title">Status Distribusi Penanganan per UPTD</h2>
            <p class="panel-heading-sub">Monitoring efektivitas pengangkutan & kepatuhan Service Level Agreement (SLA &lt; 24 Jam)</p>
        </div>

        <!-- Legend -->
        <div class="legend-wrapper">
            <div class="legend-item">
                <span class="legend-dot dot-green"></span>
                <span>Tepat Waktu (SLA Terpenuhi)</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot dot-red"></span>
                <span>Terlambat (&gt;24 Jam)</span>
            </div>
        </div>
    </div>

    <!-- 4 UPTD Cards Grid -->
    <div class="row g-3">
        @foreach ($distribusiUptd as $uptd)
            <div class="col-12 col-md-6 col-xl-3">
                <div class="uptd-card">
                    <div>
                        <!-- Header -->
                        <div class="uptd-card-header">
                            <div>
                                <div class="uptd-title">{{ $uptd['nama'] }}</div>
                                <div class="uptd-sub">{{ $uptd['cakupan'] }}</div>
                            </div>
                            <span class="sla-badge">{{ $uptd['sla'] }}% SLA</span>
                        </div>

                        <!-- Progress Stats -->
                        <div class="progress-stats-row">
                            <span class="stat-green-text">Selesai: {{ $uptd['selesai'] }} Lap</span>
                            <span class="stat-red-text">Aktif: {{ $uptd['aktif'] }} Lap</span>
                        </div>

                        <!-- Dual Color Bar -->
                        <div class="dual-progress-bar">
                            <div class="bar-green" style="width: {{ $uptd['sla'] }}%;"></div>
                            <div class="bar-red" style="width: {{ 100 - $uptd['sla'] }}%;"></div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div>
                        <div class="uptd-divider"></div>
                        <div class="uptd-footer-row">
                            <span class="armada-label">Armada Tersedia</span>
                            <span class="armada-count">{{ $uptd['armada'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
