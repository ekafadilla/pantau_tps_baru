<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard {{ $roleLabel }} | SI Pantau TPS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f4f7f5; color: #26382f; }
        a { color: inherit; text-decoration: none; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 245px; min-width: 245px; max-width: 245px; flex: 0 0 245px; flex-shrink: 0; background: #176b43; color: white; padding: 25px 16px; }
        .brand { display: flex; align-items: center; gap: 10px; padding: 5px 10px 30px; font-size: 18px; font-weight: bold; }
        .brand i { font-size: 27px; }
        .menu-title { color: #c7e2d2; font-size: 11px; margin: 10px 12px; text-transform: uppercase; letter-spacing: 1px; }
        .menu { display: flex; align-items: center; gap: 12px; padding: 12px; margin-bottom: 7px; border-radius: 6px; font-size: 14px; }
        .menu i { font-size: 18px; }
        .menu.active, .menu:hover { background: #2c8058; }
        .sidebar-bottom { margin-top: 35px; border-top: 1px solid #438563; padding-top: 18px; }
        .logout { width: 100%; background: white; color: #176b43; border: none; padding: 11px; border-radius: 6px; cursor: pointer; font-size: 14px; text-align: left; }
        .main { flex: 1; min-width: 0; }
        .topbar {
            height: 72px;
            min-height: 72px;
            background: #ffffff;
            border-bottom: 1px solid #e4ebe6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            gap: 15px;
        }
        .topbar-title {
            margin: 0;
            font-size: 18px;
            line-height: 1.4;
            font-weight: 700;
            color: #26382f;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            line-height: 1.4;
            white-space: nowrap;
        }
        .user-info strong {
            font-size: 13px;
            font-weight: 700;
        }
        .user-info span {
            font-size: 12px;
            color: #718078;
        }
        .avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: #e2f1e7;
            color: #176b43;
            font-size: 15px;
            font-weight: 700;
        }
        .content { padding: 28px 30px; max-width: 1500px; margin: auto; }
        .welcome { background: #e6f2ff; border: 1px solid #d3e6fb; border-radius: 9px; padding: 24px; margin-bottom: 25px; }
        .welcome h1 { font-size: 23px; margin: 0 0 9px; }
        .welcome p { margin: 0; font-size: 14px; line-height: 1.6; color: #596b7c; }
        .section-heading { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin: 25px 0 15px; }
        .section-heading h2 { font-size: 17px; margin: 0; }
        .stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
        .stat-card { background: white; border: 1px solid #e1e9e3; border-radius: 9px; padding: 19px; }
        .stat-top { display: flex; justify-content: space-between; align-items: center; gap: 8px; color: #6d7a71; font-size: 13px; }
        .stat-icon { width: 38px; height: 38px; border-radius: 8px; background: #e7f4eb; color: #176b43; display: flex; align-items: center; justify-content: center; font-size: 19px; }
        .stat-number { font-size: 27px; font-weight: bold; margin-top: 14px; }
        .stat-note { color: #78857c; font-size: 12px; margin-top: 5px; }
        .panel, .simple-card { background: white; border: 1px solid #e1e9e3; border-radius: 9px; overflow: hidden; }
        .panel-heading { padding: 18px 20px; border-bottom: 1px solid #e8eee9; display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .panel-heading h2 { margin: 0; font-size: 16px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th, td { padding: 15px 20px; text-align: left; border-bottom: 1px solid #edf1ee; white-space: nowrap; }
        th { background: #f8faf8; color: #647168; font-weight: bold; }
        .status { display: inline-block; padding: 6px 9px; border-radius: 20px; font-size: 11px; background: #fff2d8; color: #946200; }
        .status-diproses { background: #e5efff; color: #245ab1; }
        .status-selesai { background: #e2f5e8; color: #176b43; }
        .status-ditolak { background: #fde8e7; color: #ad302b; }
        .empty { padding: 35px 20px; text-align: center; color: #78857c; font-size: 13px; }
        .empty i { display: block; font-size: 30px; margin-bottom: 10px; color: #9aa99f; }
        .help-panel { margin-top: 22px; padding: 20px; background: #eef7f0; border: 1px solid #dcece0; border-radius: 9px; display: flex; align-items: flex-start; gap: 14px; }
        .help-icon { font-size: 24px; color: #176b43; }
        .help-panel h3 { margin: 0 0 7px; font-size: 15px; }
        .help-panel p { margin: 0; color: #627267; font-size: 13px; line-height: 1.6; }
        footer { text-align: center; padding: 24px 15px; color: #7b857e; font-size: 12px; }
        .simple-card { padding: 25px; }
        @media (max-width: 1000px) { .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); } .sidebar { width: 210px; } }
        @media (max-width: 650px) {
            .layout { display: block; } .sidebar { width: 100%; padding: 15px; }
            .brand { padding: 5px 8px 15px; } .menu-title { display: none; }
            .menu { display: inline-flex; margin: 3px; padding: 10px; }
            .sidebar-bottom { margin-top: 10px; padding-top: 10px; }
            .logout { width: auto; padding: 10px 14px; }
            .topbar { padding: 15px 18px; } .content { padding: 20px 15px; }
            .stats { gap: 10px; } .stat-card { padding: 14px; }
            .stat-top { align-items: flex-start; } .stat-number { font-size: 23px; }
            .welcome { padding: 20px; } .welcome h1 { font-size: 20px; }
            .section-heading { align-items: flex-start; flex-wrap: wrap; }
        }
    
        /* === STANDAR TAMPILAN DASHBOARD DAN HALAMAN UPTD === */
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #26382f;
            background: #f4f7f5;
        }

        .layout {
            display: flex;
            align-items: stretch;
            width: 100%;
            min-height: 100vh;
        }

        .sidebar {
            box-sizing: border-box;
            width: 245px;
            min-width: 245px;
            max-width: 245px;
            flex: 0 0 245px;
            padding: 25px 16px;
            background: #176b43;
            color: #ffffff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px 30px;
            font-size: 18px;
            line-height: 1.4;
            font-weight: 700;
        }

        .brand i {
            font-size: 27px;
        }

        .menu-title {
            margin: 10px 12px;
            font-size: 11px;
            line-height: 1.4;
            letter-spacing: 1px;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 42px;
            padding: 12px;
            margin-bottom: 7px;
            border-radius: 6px;
            font-size: 14px;
            line-height: 18px;
        }

        .menu i {
            flex: 0 0 18px;
            font-size: 18px;
            text-align: center;
        }

        .sidebar-bottom {
            margin-top: 35px;
            padding-top: 18px;
        }

        .main {
            flex: 1 1 0%;
            width: 0;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            width: 100%;
            height: 72px;
            min-height: 72px;
            padding: 0 30px;
            background: #ffffff;
            border-bottom: 1px solid #e4ebe6;
        }

        .topbar-title {
            margin: 0;
            font-size: 18px;
            line-height: 1.4;
            font-weight: 700;
            color: #26382f;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            line-height: 1.4;
            white-space: nowrap;
        }

        .user-info strong {
            font-size: 13px;
            font-weight: 700;
        }

        .user-info span {
            font-size: 12px;
            color: #718078;
        }

        .avatar {
            display: flex;
            flex: 0 0 38px;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e2f1e7;
            color: #176b43;
            font-size: 15px;
            font-weight: 700;
        }

        .content {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 28px 30px;
        }

        /* Hilangkan padding tambahan dari Bootstrap pada halaman UPTD */
        .content > .container-fluid {
            padding: 0 !important;
        }

        @media (max-width: 768px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-width: 0;
                max-width: none;
                padding: 15px;
            }

            .brand {
                padding: 5px 10px 15px;
            }

            .topbar {
                height: 72px;
                min-height: 72px;
                padding: 0 18px;
            }

            .content {
                padding: 20px 15px;
            }

            .user-info {
                gap: 8px;
            }
        }
        /* === AKHIR STANDAR TAMPILAN === */
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand"><i class="bi bi-recycle"></i><span>SI PANTAU TPS</span></div>
        <div class="menu-title">Menu Utama</div>

        <a class="menu active" href="{{ route('dashboard.role', ['role' => $role]) }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>

        @if ($role === 'uptd')
            <a href="{{ route('uptd.laporan.index') }}" class="menu text-decoration-none"><i class="bi bi-file-earmark-text"></i> Data Laporan</a>
            <a href="{{ route('uptd.tps.index') }}" class="menu {{ request()->routeIs('uptd.tps.*') ? 'active' : '' }}"><i class="bi bi-geo-alt"></i> Data TPS Wilayah</a>
        @elseif ($role === 'admin')
            <div class="menu"><i class="bi bi-people"></i> Data Pengguna</div>
            <div class="menu"><i class="bi bi-geo"></i> Data Wilayah</div>
            <div class="menu"><i class="bi bi-trash"></i> Data TPS</div>
        @elseif ($role === 'supir')
            <div class="menu"><i class="bi bi-truck"></i> Tugas Pengangkutan</div>
        @endif

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout"><i class="bi bi-box-arrow-right"></i> Keluar</button>
            </form>
        </div>
    </aside>

    <div class="main">
        <header class="topbar">
            <div class="topbar-title">Dashboard {{ $roleLabel }}</div>
            <div class="user-info">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div><strong>{{ auth()->user()->name }}</strong><br><span>{{ $roleLabel }}</span></div>
            </div>
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
</body>
</html>