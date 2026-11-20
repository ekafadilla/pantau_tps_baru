<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard {{ $roleLabel }} | SI Pantau TPS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
* { box-sizing: border-box; }

html, body {
    margin: 0;
    width: 100%;
    height: 100%;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    color: #26382f;
    background: #f4f7f5;
}

body { overflow: hidden; }
a { color: inherit; text-decoration: none; }

.layout {
    display: flex;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.sidebar {
    position: fixed;
    z-index: 1000;
    inset: 0 auto 0 0;
    width: 220px;
    padding: 20px 14px;
    overflow-y: auto;
    background: #176b43;
    color: white;
    transition: transform .25s ease;
}

.brand {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 5px 8px 25px;
    font-size: 16px;
    font-weight: bold;
}

.brand i { font-size: 23px; }

.menu-title {
    margin: 8px 10px 12px;
    color: #c7e2d2;
    font-size: 10px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.menu {
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 39px;
    padding: 10px;
    margin-bottom: 5px;
    border-radius: 6px;
    font-size: 12px;
    transition: background .2s;
}

.menu i {
    width: 17px;
    font-size: 16px;
    text-align: center;
}

.menu.active, .menu:hover { background: #2c8058; }

.sidebar-bottom {
    margin-top: 28px;
    padding-top: 15px;
    border-top: 1px solid #438563;
}

.logout {
    width: 100%;
    padding: 10px;
    border: 0;
    border-radius: 6px;
    background: white;
    color: #176b43;
    font-size: 12px;
    text-align: left;
    cursor: pointer;
}

.main {
    display: flex;
    flex-direction: column;
    width: calc(100% - 220px);
    height: 100vh;
    min-width: 0;
    margin-left: 220px;
    overflow: hidden;
}

.topbar {
    position: relative;
    z-index: 100;
    display: flex;
    flex: 0 0 58px;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    height: 58px;
    min-height: 58px;
    padding: 0 24px;
    background: white;
    border-bottom: 1px solid #e1e9e3;
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.topbar-title {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: #26382f;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 12px;
    white-space: nowrap;
}

.user-info strong { font-size: 12px; }
.user-info span { color: #718078; font-size: 11px; }

.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 33px;
    height: 33px;
    border-radius: 50%;
    background: #e2f1e7;
    color: #176b43;
    font-weight: bold;
}

.menu-toggle {
    display: none;
    width: 34px;
    height: 34px;
    border: 1px solid #e1e9e3;
    border-radius: 6px;
    background: white;
    color: #176b43;
    font-size: 19px;
    cursor: pointer;
}

.sidebar-overlay { display: none; }

.content {
    flex: 1;
    width: 100%;
    max-width: 1500px;
    margin: 0 auto;
    padding: 20px 24px;
    overflow-y: auto;
}

.content > .container-fluid { padding: 0 !important; }

.welcome {
    padding: 19px 21px;
    margin-bottom: 20px;
    border: 1px solid #d3e6fb;
    border-radius: 8px;
    background: #e6f2ff;
}

.welcome h1 { margin: 0 0 7px; font-size: 20px; }
.welcome p { margin: 0; color: #596b7c; font-size: 12px; line-height: 1.6; }

.section-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 20px 0 12px;
}

.section-heading h2 { margin: 0; font-size: 15px; }

.stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 12px;
}

.stat-card {
    padding: 15px;
    border: 1px solid #e1e9e3;
    border-radius: 8px;
    background: white;
}

.stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    color: #6d7a71;
    font-size: 11px;
}

.stat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 7px;
    background: #e7f4eb;
    color: #176b43;
    font-size: 16px;
}

.stat-number { margin-top: 10px; font-size: 23px; font-weight: bold; }
.stat-note { margin-top: 4px; color: #78857c; font-size: 10px; }

.chart-grid {
    display: grid;
    grid-template-columns: 1.6fr 1fr;
    gap: 14px;
    margin-top: 18px;
}

.chart-card {
    min-width: 0;
    padding: 16px;
    border: 1px solid #e1e9e3;
    border-radius: 8px;
    background: white;
}

.chart-heading { margin-bottom: 13px; }
.chart-heading h3 { margin: 0; font-size: 13px; }
.chart-heading p { margin: 5px 0 0; color: #78857c; font-size: 10px; }

.chart-container {
    position: relative;
    width: 100%;
    height: 220px;
}

.panel, .simple-card {
    overflow: hidden;
    border: 1px solid #e1e9e3;
    border-radius: 8px;
    background: white;
}

.panel-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 17px;
    border-bottom: 1px solid #e8eee9;
}

.panel-heading h2 { margin: 0; font-size: 13px; }
.table-wrap { overflow-x: auto; }

table { width: 100%; border-collapse: collapse; font-size: 11px; }
th, td { padding: 11px 16px; border-bottom: 1px solid #edf1ee; text-align: left; white-space: nowrap; }
th { background: #f8faf8; color: #647168; }

.status {
    display: inline-block;
    padding: 5px 8px;
    border-radius: 20px;
    background: #fff2d8;
    color: #946200;
    font-size: 10px;
}

.status-diproses { background: #e5efff; color: #245ab1; }
.status-selesai { background: #e2f5e8; color: #176b43; }
.status-ditolak { background: #fde8e7; color: #ad302b; }

.empty { padding: 28px 15px; color: #78857c; font-size: 12px; text-align: center; }
.empty i { display: block; margin-bottom: 8px; font-size: 27px; }

.help-panel {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px;
    margin-top: 16px;
    border: 1px solid #dcece0;
    border-radius: 8px;
    background: #eef7f0;
}

.help-icon { color: #176b43; font-size: 20px; }
.help-panel h3 { margin: 0 0 5px; font-size: 12px; }
.help-panel p { margin: 0; color: #627267; font-size: 11px; line-height: 1.5; }

.simple-card { padding: 20px; }

footer {
    flex-shrink: 0;
    padding: 10px;
    background: #f4f7f5;
    color: #7b857e;
    font-size: 10px;
    text-align: center;
}

@media (max-width: 900px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.show { transform: translateX(0); }

    .main { width: 100%; margin-left: 0; }

    .menu-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar-overlay.show {
        position: fixed;
        z-index: 999;
        inset: 0;
        display: block;
        background: rgba(0,0,0,.35);
    }

    .chart-grid { grid-template-columns: 1fr; }
}

@media (max-width: 650px) {
    .topbar { padding: 0 13px; }
    .topbar-title { font-size: 13px; }
    .user-info { gap: 6px; }
    .user-info strong { max-width: 115px; overflow: hidden; text-overflow: ellipsis; }
    .avatar { width: 30px; height: 30px; }
    .content { padding: 14px 12px; }
    .welcome { padding: 15px; }
    .welcome h1 { font-size: 17px; }
    .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 9px; }
    .stat-card { padding: 12px; }
    .stat-number { font-size: 20px; }
    .chart-container { height: 200px; }
}
</style>
@if ($role === 'uptd')
<style>
/* UPTD PROFESSIONAL DASHBOARD */

/* Layout */
.layout {
    display: flex !important;
    height: 100vh !important;
    min-height: 0 !important;
    overflow: hidden !important;
    background: #f4f7f5 !important;
}

/* Sidebar */
.sidebar {
    position: fixed !important;
    z-index: 1050 !important;
    inset: 0 auto 0 0 !important;
    width: 235px !important;
    min-width: 235px !important;
    height: 100vh !important;
    padding: 22px 15px !important;
    overflow-y: auto !important;
    color: #fff !important;
    background: linear-gradient(180deg, #125735 0%, #0e432c 100%) !important;
    box-shadow: 3px 0 18px rgba(15, 55, 35, .12) !important;
    transition: transform .25s ease !important;
}

.brand {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 8px 9px 30px !important;
    color: #fff !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    letter-spacing: .2px !important;
}

.brand i {
    font-size: 23px !important;
}

.menu-title {
    margin: 8px 10px 13px !important;
    color: #c6dfd0 !important;
    font-size: 10px !important;
    letter-spacing: 1.2px !important;
}

.sidebar .menu {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    gap: 11px !important;
    min-height: 43px !important;
    margin-bottom: 6px !important;
    padding: 11px 12px !important;
    border-radius: 8px !important;
    color: rgba(255,255,255,.88) !important;
    font-size: 12px !important;
    line-height: 1.4 !important;
    transition: background .18s ease, color .18s ease !important;
}

.sidebar .menu i {
    flex: 0 0 18px !important;
    width: 18px !important;
    font-size: 16px !important;
    text-align: center !important;
}

.sidebar .menu:hover {
    color: #fff !important;
    background: rgba(255,255,255,.11) !important;
}

.sidebar .menu.active {
    color: #fff !important;
    background: #246d49 !important;
    box-shadow: inset 3px 0 #b9dfc6, 0 2px 8px rgba(0,0,0,.08) !important;
}

.sidebar-bottom {
    margin-top: auto !important;
    padding-top: 20px !important;
    border-top: 1px solid rgba(255,255,255,.18) !important;
}

.sidebar .logout {
    display: flex !important;
    align-items: center !important;
    gap: 11px !important;
    width: 100% !important;
    min-height: 43px !important;
    padding: 11px 12px !important;
    border: 0 !important;
    border-radius: 8px !important;
    color: #fff !important;
    background: transparent !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    text-align: left !important;
    cursor: pointer !important;
    transition: background .18s ease !important;
}

.sidebar .logout:hover {
    background: rgba(255,255,255,.11) !important;
}

/* Main area and navbar */
.main {
    display: flex !important;
    flex-direction: column !important;
    width: calc(100% - 235px) !important;
    height: 100vh !important;
    min-width: 0 !important;
    margin-left: 235px !important;
    overflow: hidden !important;
}

.topbar {
    position: relative !important;
    z-index: 100 !important;
    display: flex !important;
    flex: 0 0 66px !important;
    align-items: center !important;
    justify-content: space-between !important;
    height: 66px !important;
    min-height: 66px !important;
    padding: 0 28px !important;
    background: #fff !important;
    border-bottom: 1px solid #e5ebe6 !important;
    box-shadow: 0 2px 8px rgba(30,60,40,.025) !important;
}

.topbar-title {
    color: #26382f !important;
    font-size: 16px !important;
    font-weight: 700 !important;
}

.dashboard-profile-link {
    display: flex !important;
    align-items: center !important;
    gap: 9px !important;
    padding: 6px 9px !important;
    border-radius: 8px !important;
    color: inherit !important;
    text-decoration: none !important;
    transition: background .18s ease !important;
}

.dashboard-profile-link:hover {
    color: inherit !important;
    background: #f4f7f5 !important;
}

.dashboard-profile-link:focus-visible {
    outline: 2px solid #176b43 !important;
    outline-offset: 2px !important;
}

/* Content */
.content {
    flex: 1 !important;
    width: 100% !important;
    padding: 24px 28px !important;
    overflow-y: auto !important;
    background: #f4f7f5 !important;
}

/* Welcome panel */
.welcome {
    position: relative !important;
    overflow: hidden !important;
    padding: 23px 26px !important;
    margin-bottom: 23px !important;
    border: 1px solid #dce9df !important;
    border-radius: 11px !important;
    background: linear-gradient(110deg, #e8f3eb 0%, #f8fbf8 100%) !important;
    box-shadow: 0 3px 12px rgba(23,107,67,.035) !important;
}

.welcome::after {
    content: "" !important;
    position: absolute !important;
    top: -65px !important;
    right: -35px !important;
    width: 185px !important;
    height: 185px !important;
    border: 24px solid rgba(44,128,88,.05) !important;
    border-radius: 50% !important;
    pointer-events: none !important;
}

.welcome h1 {
    position: relative !important;
    z-index: 1 !important;
    margin: 0 0 8px !important;
    color: #174e34 !important;
    font-size: 21px !important;
    font-weight: 700 !important;
    line-height: 1.4 !important;
}

.welcome p {
    position: relative !important;
    z-index: 1 !important;
    max-width: 650px !important;
    margin: 0 !important;
    color: #66796c !important;
    font-size: 12px !important;
    line-height: 1.7 !important;
}

/* Section headings and statistics */
.section-heading {
    margin: 22px 0 13px !important;
}

.section-heading h2 {
    margin: 0 !important;
    color: #26382f !important;
    font-size: 15px !important;
    font-weight: 700 !important;
}

.stats {
    gap: 13px !important;
}

.stat-card {
    padding: 16px !important;
    border: 1px solid #e3eae4 !important;
    border-radius: 10px !important;
    background: #fff !important;
    box-shadow: 0 2px 9px rgba(30,60,40,.025) !important;
    transition: box-shadow .18s ease, transform .18s ease !important;
}

.stat-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 14px rgba(30,60,40,.06) !important;
}

.stat-number {
    color: #26382f !important;
}

/* Charts, tables and panels */
.chart-grid {
    gap: 14px !important;
    margin-top: 18px !important;
}

.chart-card,
.panel,
.simple-card {
    border: 1px solid #e3eae4 !important;
    border-radius: 10px !important;
    background: #fff !important;
    box-shadow: 0 2px 9px rgba(30,60,40,.025) !important;
}

.chart-card {
    padding: 16px !important;
}

.panel-heading {
    padding: 15px 17px !important;
}

.panel-heading h2,
.chart-heading h3 {
    color: #26382f !important;
}

th {
    background: #f7f9f7 !important;
}

.help-panel {
    border-color: #dce9df !important;
    border-radius: 9px !important;
    background: #edf5ef !important;
}

footer {
    padding: 11px !important;
}

/* Responsive */
@media (max-width: 900px) {
    .sidebar {
        transform: translateX(-100%) !important;
    }

    .sidebar.show {
        transform: translateX(0) !important;
    }

    .main {
        width: 100% !important;
        margin-left: 0 !important;
    }

    .content {
        padding: 20px 16px !important;
    }

    .chart-grid {
        grid-template-columns: 1fr !important;
    }

    .sidebar-overlay.show {
        position: fixed !important;
        z-index: 1040 !important;
        inset: 0 !important;
        display: block !important;
        background: rgba(15,30,20,.42) !important;
    }
}

@media (max-width: 650px) {
    .topbar {
        height: 60px !important;
        min-height: 60px !important;
        flex-basis: 60px !important;
        padding: 0 14px !important;
    }

    .topbar-title {
        font-size: 14px !important;
    }

    .content {
        padding: 15px 12px !important;
    }

    .welcome {
        padding: 18px !important;
    }

    .welcome h1 {
        font-size: 18px !important;
    }

    .section-heading h2 {
        font-size: 14px !important;
    }

    .stats {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 10px !important;
    }

    .stat-card {
        padding: 12px !important;
    }

    .stat-number {
        font-size: 20px !important;
    }

    .chart-container {
        height: 200px !important;
    }
}</style>
@endif

</head>
<body>
<div class="layout">
    @if ($role === 'uptd')
    @include('components.uptd.sidebar')
@else
    <aside class="sidebar" id="sidebar">
        <div class="brand"><i class="bi bi-recycle"></i><span>SI PANTAU TPS</span></div>
        <div class="menu-title">Menu Utama</div>

        <a class="menu active" href="{{ route('dashboard.role', ['role' => $role]) }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>

        @if ($role === 'admin')
            <div class="menu"><i class="bi bi-people"></i> Data Pengguna</div>
            <div class="menu"><i class="bi bi-geo"></i> Data Wilayah</div>
            <div class="menu"><i class="bi bi-trash"></i> Data TPS</div>
        @elseif ($role === 'supir')
            <div class="menu"><i class="bi bi-truck"></i> Tugas Pengangkutan</div>
        @endif

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </aside>
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
@endif

    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                @if ($role === 'uptd')
                    <button type="button" class="menu-toggle" onclick="toggleSidebar()" aria-label="Buka menu">
                        <i class="bi bi-list"></i>
                    </button>
                @endif
                <div class="topbar-title">Dashboard {{ $roleLabel }}</div>
            </div>
            @if ($role === 'uptd')
                <a href="{{ route('pengaturan.edit') }}"
                   class="user-info dashboard-profile-link"
                   aria-label="Buka pengaturan akun UPTD"
                   title="Pengaturan Akun">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div><strong>{{ auth()->user()->name }}</strong><br><span>{{ $roleLabel }}</span></div>
                </a>
            @else
                <div class="user-info">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div><strong>{{ auth()->user()->name }}</strong><br><span>{{ $roleLabel }}</span></div>
                </div>
            @endif
        </header>

        <main class="content">
            @if ($role === 'uptd')
                <section class="welcome">
                    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <p>
                        Ringkasan laporan dan kondisi TPS untuk wilayah kerja
                        {{ auth()->user()->wilayah->nama_wilayah ?? 'belum ditentukan' }}.
                    </p>
                </section>

                <div class="section-heading"><h2>Ringkasan Laporan Wilayah</h2></div>

                <section class="stats">
                    <div class="stat-card"><div class="stat-top"><span>Total Laporan</span><span class="stat-icon"><i class="bi bi-file-text"></i></span></div><div class="stat-number">{{ $totalLaporan }}</div><div class="stat-note">Laporan di wilayah kerja</div></div>
                    <div class="stat-card"><div class="stat-top"><span>Menunggu</span><span class="stat-icon"><i class="bi bi-clock-history"></i></span></div><div class="stat-number">{{ $laporanMenunggu }}</div><div class="stat-note">Menunggu pemeriksaan</div></div>
                    <div class="stat-card"><div class="stat-top"><span>Diproses</span><span class="stat-icon"><i class="bi bi-arrow-repeat"></i></span></div><div class="stat-number">{{ $laporanDiproses }}</div><div class="stat-note">Sedang ditindaklanjuti</div></div>
                    <div class="stat-card"><div class="stat-top"><span>Selesai</span><span class="stat-icon"><i class="bi bi-check-circle"></i></span></div><div class="stat-number">{{ $laporanSelesai }}</div><div class="stat-note">Laporan selesai</div></div>
                </section>

                <section class="chart-grid">
    <div class="chart-card">
        <div class="chart-heading">
            <h3>Tren Laporan</h3>
            <p>Jumlah laporan selama 7 hari terakhir</p>
        </div>
        <div class="chart-container">
            <canvas id="grafikTren"></canvas>
        </div>
    </div>

    <div class="chart-card">
        <div class="chart-heading">
            <h3>Status Laporan</h3>
            <p>Perbandingan status laporan wilayah</p>
        </div>
        <div class="chart-container">
            <canvas id="grafikStatus"></canvas>
        </div>
    </div>
</section>
<section class="panel" style="margin-top: 27px;">
                    <div class="panel-heading"><h2>Laporan Terbaru di Wilayah</h2></div>
                    @if ($laporanTerbaru->isEmpty())
                        <div class="empty">
                            <i class="bi bi-inbox"></i>
                            <strong>Belum ada laporan</strong>
                            <p>Belum ada laporan yang tercatat pada TPS di wilayah kerja ini.</p>
                        </div>
                    @else
                        <div class="table-wrap">
                            <table>
                                <thead><tr><th>No.</th><th>Nama TPS</th><th>Kategori</th><th>Tanggal</th><th>Status</th></tr></thead>
                                <tbody>
                                @foreach ($laporanTerbaru as $laporan)
                                    @php
                                        $status = $laporan->status_laporan;
                                        $statusClass = match ($status) {
                                            'selesai' => 'status-selesai',
                                            'diproses', 'ditangani' => 'status-diproses',
                                            'ditolak' => 'status-ditolak',
                                            default => '',
                                        };
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $laporan->tps->nama_tps ?? 'TPS tidak tersedia' }}</td>
                                        <td>{{ $laporan->kategori_kondisi }}</td>
                                        <td>{{ $laporan->waktu_pelaporan?->format('d-m-Y') ?? '-' }}</td>
                                        <td><span class="status {{ $statusClass }}">{{ ucfirst($status) }}</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </section>

                <section class="help-panel">
                    <i class="bi bi-info-circle help-icon"></i>
                    <div><h3>Informasi Wilayah Kerja</h3><p>Data pada dashboard ini dibatasi berdasarkan wilayah yang terhubung dengan akun UPTD Anda.</p></div>
                </section>

            @else
                <section class="welcome">
                    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <p>Anda berhasil masuk ke Sistem Pengaduan dan Monitoring TPS Sampah Kabupaten Indramayu.</p>
                </section>
                <section class="simple-card">
                    <h2 style="margin-top: 0;">Dashboard {{ $roleLabel }}</h2>
                    <p>Halaman ini akan menampilkan fitur sesuai hak akses {{ strtolower($roleLabel) }}.</p>
                </section>
            @endif
        </main>

        <footer>SI Pantau TPS &copy; {{ date('Y') }} | DLH Kabupaten Indramayu</footer>
    </div>
</div>
@if ($role === 'uptd')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    const trenCanvas = document.getElementById('grafikTren');

    if (trenCanvas) {
        new Chart(trenCanvas, {
            type: 'bar',
            data: {
                labels: @json($grafikTrenLabel),
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: @json($grafikTrenData),
                    backgroundColor: '#2c8058',
                    borderRadius: 5,
                    maxBarThickness: 35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        grid: { color: '#edf1ee' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    const statusCanvas = document.getElementById('grafikStatus');

    if (statusCanvas) {
        new Chart(statusCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Diproses', 'Selesai'],
                datasets: [{
                    data: @json($grafikStatus),
                    backgroundColor: ['#b7d9c3', '#2c8058', '#176b43'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 7,
                            padding: 15,
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    }
</script>
@endif
</body>
</html>





