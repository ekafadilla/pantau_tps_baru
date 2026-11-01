<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI PANTAU TPS - UPTD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f4f7f5; color: #26382f; font-size: 14px; }
        a { text-decoration: none; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 245px; min-width: 245px; max-width: 245px; flex: 0 0 245px; flex-shrink: 0; background: #176b43; color: white; padding: 25px 16px; }
        .brand { display: flex; align-items: center; gap: 10px; padding: 5px 10px 30px; font-size: 18px; font-weight: bold; color: white; }
        .brand i { font-size: 27px; }
        .menu-title { color: #c7e2d2; font-size: 11px; margin: 10px 12px; text-transform: uppercase; letter-spacing: 1px; }
        .menu { display: flex; align-items: center; gap: 12px; padding: 12px; margin-bottom: 7px; border-radius: 6px; font-size: 14px; color: white; }
        .menu i { font-size: 18px; }
        .menu.active, .menu:hover { background: #2c8058; color: white; }
        .sidebar-bottom { margin-top: 35px; border-top: 1px solid #438563; padding-top: 18px; }
        .logout { width: 100%; background: white; color: #176b43; border: none; padding: 11px; border-radius: 6px; cursor: pointer; text-align: left; }
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
        .card { border-color: #e1e9e3 !important; border-radius: 9px; }
        .btn-success { background: #176b43; border-color: #176b43; }
        .btn-success:hover { background: #125735; border-color: #125735; }
        @media(max-width: 768px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 15px; }
            .brand { padding-bottom: 15px; }
            .topbar { padding: 15px; }
            .content { padding: 18px 12px; }
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
        <a class="menu" href="{{ route('dashboard.role', ['role' => 'uptd']) }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>
        <a class="menu {{ request()->routeIs('uptd.laporan.*') ? 'active' : '' }}" href="{{ route('uptd.laporan.index') }}">
            <i class="bi bi-file-earmark-text"></i> Data Laporan
        </a>
        <a class="menu" href="{{ route('dashboard.role', ['role' => 'uptd']) }}">
            <i class="bi bi-geo-alt"></i> Data TPS Wilayah
        </a>
        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout"><i class="bi bi-box-arrow-right"></i> Keluar</button>
            </form>
        </div>
    </aside>
    <div class="main">
        <header class="topbar">
            <div class="topbar-title">@yield('page-title', 'Dashboard UPTD')</div>
            <div class="user-info">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div><strong>{{ auth()->user()->name }}</strong><br><span>UPTD</span></div>
            </div>
        </header>
        <main class="content">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>