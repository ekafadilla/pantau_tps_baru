<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SI PANTAU TPS - UPTD')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        html, body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 14px;
            color: #26382f;
            background: #f4f7f5;
        }

        a { text-decoration: none; }

        /* Layout utama */
        .layout {
            display: flex;
            min-height: 100vh;
            background: #f4f7f5;
        }

        /* Sidebar — mengikuti Dashboard UPTD */
        .sidebar {
            position: fixed;
            z-index: 1050;
            inset: 0 auto 0 0;
            width: 235px;
            min-width: 235px;
            height: 100vh;
            padding: 22px 15px;
            overflow-y: auto;
            color: #fff;
            background: linear-gradient(180deg, #125735 0%, #0e432c 100%);
            box-shadow: 3px 0 18px rgba(15, 55, 35, .12);
            transition: transform .25s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 9px 30px;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .brand i { font-size: 23px; }

        .menu-title {
            margin: 8px 10px 13px;
            color: #c6dfd0;
            font-size: 10px;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .sidebar .menu {
            position: relative;
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 43px;
            margin-bottom: 6px;
            padding: 11px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,.88);
            font-size: 12px;
            line-height: 1.4;
            transition: background .18s ease, color .18s ease;
        }

        .sidebar .menu i {
            flex: 0 0 18px;
            width: 18px;
            font-size: 16px;
            text-align: center;
        }

        .sidebar .menu:hover {
            color: #fff;
            background: rgba(255,255,255,.11);
        }

        .sidebar .menu.active {
            color: #fff;
            background: #246d49;
            box-shadow: inset 3px 0 #b9dfc6, 0 2px 8px rgba(0,0,0,.08);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.18);
        }

        .sidebar .logout {
            display: flex;
            align-items: center;
            gap: 11px;
            width: 100%;
            min-height: 43px;
            padding: 11px 12px;
            border: 0;
            border-radius: 8px;
            color: #fff;
            background: transparent;
            font-family: inherit;
            font-size: 12px;
            font-weight: 500;
            text-align: left;
            cursor: pointer;
            transition: background .18s ease;
        }

        .sidebar .logout:hover {
            background: rgba(255,255,255,.11);
        }

        /* Area konten dan navbar */
        .main {
            display: flex;
            flex-direction: column;
            width: calc(100% - 235px);
            min-width: 0;
            min-height: 100vh;
            margin-left: 235px;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            flex: 0 0 66px;
            align-items: center;
            justify-content: space-between;
            height: 66px;
            min-height: 66px;
            padding: 0 28px;
            background: #fff;
            border-bottom: 1px solid #e5ebe6;
            box-shadow: 0 2px 8px rgba(30,60,40,.025);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .topbar-title {
            color: #26382f;
            font-size: 16px;
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menu-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border: 1px solid #e3eae4;
            border-radius: 7px;
            color: #176b43;
            background: #fff;
            font-size: 20px;
            cursor: pointer;
        }

        .dashboard-profile-link {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 6px 9px;
            border-radius: 8px;
            color: inherit;
            text-decoration: none;
            transition: background .18s ease;
        }

        .dashboard-profile-link:hover {
            color: inherit;
            background: #f4f7f5;
        }

        .dashboard-profile-link strong {
            color: #26382f;
            font-size: 12px;
            font-weight: 600;
        }

        .dashboard-profile-link span {
            color: #78857c;
            font-size: 10px;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            color: #176b43;
            background: #e2f1e7;
            font-size: 13px;
            font-weight: 700;
        }

        /* Area halaman */
        .content {
            flex: 1;
            width: 100%;
            min-width: 0;
            padding: 24px 28px;
            overflow-x: hidden;
            background: #f4f7f5;
        }

        /* Komponen umum */
        .card {
            border: 1px solid #e3eae4;
            border-radius: 10px;
            box-shadow: 0 2px 9px rgba(30,60,40,.025);
        }

        .card.border-0 { border: 1px solid #e3eae4 !important; }

        .summary-card .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
        }

        .summary-label {
            margin-bottom: 5px;
            color: #78857c;
            font-size: 11px;
            font-weight: 500;
        }

        .summary-number {
            color: #26382f;
            font-size: 23px;
            font-weight: 700;
            line-height: 1.2;
        }

        .summary-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            border-radius: 9px;
            font-size: 17px;
        }

        .table th {
            color: #596b60;
            background: #f7f9f7;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .4px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table td {
            color: #435349;
            font-size: 12px;
            vertical-align: middle;
        }

        .btn-success {
            background: #176b43;
            border-color: #176b43;
        }

        .btn-success:hover {
            background: #2c8058;
            border-color: #2c8058;
        }

        .btn-outline-success {
            color: #176b43;
            border-color: #176b43;
        }

        .btn-outline-success:hover {
            color: #fff;
            background: #176b43;
        }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 10px;
            border: 1px solid transparent;
            border-radius: 7px;
            color: #176b43;
            background: #e2f1e7;
            font-size: 11px;
            font-weight: 600;
            transition: background .15s ease;
        }

        .btn-detail:hover {
            color: #125735;
            background: #c8e3d4;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #176b43;
            box-shadow: 0 0 0 .2rem rgba(23,107,67,.13);
        }

        .badge {
            border-radius: 6px;
            font-weight: 600;
        }

        .sidebar-overlay { display: none; }

        @yield('styles')
    </style>

    @stack('head')
    <link rel="stylesheet" href="{{ asset('css/ui-konsisten.css') }}">
</head>
<body>

<div class="layout">

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <i class="bi bi-recycle"></i>
            <span>SI PANTAU TPS</span>
        </div>

        <div class="menu-title">Menu Utama</div>

        <a class="menu {{ request()->routeIs('dashboard.role') ? 'active' : '' }}"
           href="{{ route('dashboard.role', ['role' => 'uptd']) }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>

        <a href="{{ route('uptd.laporan.index') }}"
           class="menu {{ request()->routeIs('uptd.laporan.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i> Data Laporan
        </a>

        <a href="{{ route('uptd.tps.index') }}"
           class="menu {{ request()->routeIs('uptd.tps.*') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i> Data TPS Wilayah
        </a>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button type="button" class="menu-toggle" id="sidebarToggle" aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            </div>

            <div class="topbar-right">
                <a href="{{ route('pengaturan.edit') }}"
                   class="dashboard-profile-link"
                   aria-label="Buka pengaturan akun UPTD"
                   title="Pengaturan Akun">
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <strong>{{ auth()->user()->name ?? 'Pengguna' }}</strong><br>
                        <span>UPTD</span>
                    </div>
                </a>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');

    function openSidebar() {
        sidebar.classList.add('show');
        overlay.classList.add('show');
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }

    toggle?.addEventListener('click', function () {
        sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
    });

    overlay?.addEventListener('click', closeSidebar);
})();
</script>

@stack('scripts')
</body>
</html>
