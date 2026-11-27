<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SI PANTAU TPS - UPTD')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
<<<<<<< HEAD
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            width: 100%;
            height: 100%;
            font-family: 'Inter', Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #26382f;
            background: #f4f7f5;
            overflow: hidden;
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        .layout {
            display: flex;
            width: 100%;
            height: 100vh;
            min-height: 0;
            overflow: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            flex: 0 0 255px;
            width: 255px;
            min-width: 255px;
            height: 100vh;
            padding: 24px 18px;
            color: #ffffff;
            background: #135331;
            box-shadow: 3px 0 18px rgba(20, 70, 43, .08);
            transition: transform .28s ease;
=======
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
>>>>>>> fitur-peta
        }

        .brand {
            display: flex;
            align-items: center;
<<<<<<< HEAD
            gap: 12px;
            padding: 4px 6px 22px;
            margin-bottom: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.12);
            color: #98e2b8;
            font-size: 21px;
        }

        .brand-text {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.3px;
            line-height: 1.25;
            color: #ffffff;
        }

        .brand-text span {
            display: block;
            margin-top: 2px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.8px;
            color: #98e2b8;
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding-right: 4px;
            margin-right: -4px;
            margin-top: 6px;
            margin-bottom: 10px;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .menu-title {
            margin: 10px 10px 10px;
            color: #7cd4a4;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .menu {
            position: relative;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            margin-bottom: 6px;
            border-radius: 10px;
            font-size: 14px;
            color: #e6f4ec;
            transition: all 0.2s ease;
        }

        .menu i {
            width: 20px;
            font-size: 18px;
            text-align: center;
            color: #98e2b8;
        }

        .menu:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        .menu.active {
            background: #278855;
            color: #ffffff;
            font-weight: 700;
        }

        .menu.active i {
            color: #a9f0c7;
        }

        .menu.active::before {
            content: '';
            position: absolute;
            left: -18px;
            top: 22%;
            height: 56%;
            width: 4px;
            background: #a9f0c7;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-bottom {
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }

        .logout {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.25s ease;
        }

        .logout i {
            font-size: 18px;
            color: #ff8a80;
            transition: color 0.25s ease;
        }

        .logout:hover {
            background: #dc3545;
            border-color: #dc3545;
            color: #ffffff;
        }

        .logout:hover i {
            color: #ffffff;
        }

        /* ===== MAIN & TOPBAR ===== */
        .main {
            display: flex;
            flex-direction: column;
            width: calc(100% - 255px);
            height: 100vh;
            min-width: 0;
            margin-left: 255px;
            overflow: hidden;
        }

        .topbar {
            position: relative;
            z-index: 100;
            display: flex;
            flex: 0 0 72px;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 72px;
            min-height: 72px;
            padding: 0 30px;
            gap: 15px;
            background: #ffffff;
            border-bottom: 1px solid #e4ebe6;
            box-shadow: 0 2px 10px rgba(30, 60, 40, .025);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .topbar-title {
            margin: 0;
            color: #26382f;
            font-size: 18px;
            font-weight: 700;
        }

        .menu-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border: 1px solid #e1e9e3;
            border-radius: 8px;
            background: #ffffff;
            color: #176b43;
            font-size: 19px;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .menu-toggle:hover {
            background: #e8f4eb;
            transform: scale(1.04);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 10px;
            border-radius: 10px;
            color: inherit;
            font-size: 13px;
            white-space: nowrap;
            transition: background .2s ease;
        }

        .user-info:hover {
            background: #f4f8f5;
        }

        .user-info strong {
            font-size: 12px;
            font-weight: 700;
            color: #26382f;
        }

        .user-info span {
            color: #718078;
            font-size: 11px;
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
            font-weight: 700;
            font-size: 14px;
        }

        .sidebar-overlay {
            display: none;
        }

        .content {
            flex: 1;
            width: 100%;
            max-width: 1500px;
            min-height: 0;
            margin: 0 auto;
            padding: 28px 30px;
            overflow-y: auto;
            background: #f4f7f5;
        }

        .content > .container-fluid {
            padding: 0 !important;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .main {
                width: 100%;
                margin-left: 0;
            }

            .menu-toggle {
                display: inline-flex;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                z-index: 1040;
                background: rgba(0, 0, 0, 0.45);
            }

            body.sidebar-open .sidebar-overlay {
                display: block;
            }

            .topbar {
                padding: 0 15px;
            }

            .content {
                padding: 20px 15px;
            }
        }

        @media (max-width: 480px) {
            .user-info strong {
                display: inline-block;
                max-width: 115px;
                overflow: hidden;
                text-overflow: ellipsis;
                vertical-align: bottom;
            }
        }
    </style>
    @stack('styles')
=======
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
>>>>>>> fitur-peta
</head>

<body>
<div class="layout">

<<<<<<< HEAD
    {{-- SIDEBAR UPTD --}}
    <aside class="sidebar" id="uptdSidebar">
        <a href="{{ route('dashboard.role', ['role' => 'uptd']) }}" class="brand">
            <div class="brand-icon">
                <i class="bi bi-recycle"></i>
            </div>
            <div class="brand-text">
                SI PANTAU TPS
                <span>DLH INDRAMAYU</span>
            </div>
        </a>

        <div class="sidebar-menu">
            <div class="menu-title">Menu Utama</div>

            <a class="menu {{ request()->routeIs('dashboard.role') && request()->route('role') === 'uptd' ? 'active' : '' }}"
               href="{{ route('dashboard.role', ['role' => 'uptd']) }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('uptd.laporan.index') }}"
               class="menu {{ request()->routeIs('uptd.laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Data Laporan</span>
            </a>

            <a href="{{ route('uptd.tps.index') }}"
               class="menu {{ request()->routeIs('uptd.tps.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt-fill"></i>
                <span>Data TPS Wilayah</span>
            </a>

            <div class="menu-title" style="margin-top: 18px;">Pengaturan</div>

            <a href="{{ route('uptd.pengaturan.edit') }}"
               class="menu {{ request()->routeIs('uptd.pengaturan.*') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                <span>Pengaturan Akun</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>
=======
<div class="layout">

    @include('components.uptd.sidebar')
>>>>>>> fitur-peta

    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
<<<<<<< HEAD
                <button type="button"
                    class="menu-toggle"
                    id="sidebarToggle"
                    aria-label="Buka menu"
                    aria-expanded="false">
                    <i class="bi bi-list"></i>
                </button>

                <div class="topbar-title">@yield('page-title', 'Dashboard UPTD')</div>
=======
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
>>>>>>> fitur-peta
            </div>

            <a href="{{ route('uptd.pengaturan.edit') }}"
               class="user-info text-decoration-none"
               aria-label="Buka pengaturan akun UPTD"
               title="Pengaturan Akun">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <strong>{{ auth()->user()->name }}</strong><br>
                    <span>UPTD</span>
                </div>
            </a>
        </header>

        <main class="content">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
<<<<<<< HEAD
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');

        function closeSidebar() {
            document.body.classList.remove('sidebar-open');
            if (toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            }
        }

        if (toggle) {
            toggle.addEventListener('click', function () {
                const isOpen = document.body.classList.toggle('sidebar-open');
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });
    });
=======
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
>>>>>>> fitur-peta
</script>

@stack('scripts')
</body>
<<<<<<< HEAD
</html>
=======
</html>

>>>>>>> fitur-peta
