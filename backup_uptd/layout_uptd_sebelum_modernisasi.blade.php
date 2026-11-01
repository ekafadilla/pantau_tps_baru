<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SI PANTAU TPS - UPTD')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --green-main: #176b43;
            --green-active: #2c8058;
            --green-dark: #125735;
            --green-light: #e2f1e7;
            --green-soft: #f4f7f5;
            --text-main: #26382f;
            --text-muted: #718078;
            --border-color: #e1e9e3;
            --white: #ffffff;
            --sidebar-width: 250px;
        }

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
            color: var(--text-main);
            background: var(--green-soft);
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        /* ===== LAYOUT UTAMA ===== */

        .layout {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .sidebar {
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            height: 100vh;
            padding: 25px 16px 18px;
            overflow-y: auto;
            color: var(--white);
            background: linear-gradient(
                160deg,
                var(--green-main) 0%,
                var(--green-dark) 100%
            );
            z-index: 1050;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 5px 10px 30px;
            color: var(--white);
            font-size: 18px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            border-radius: 11px;
            color: var(--green-main);
            background: var(--white);
            font-size: 23px;
        }

        .menu-title {
            margin: 5px 12px 12px;
            color: #c7e2d2;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 45px;
            padding: 11px 13px;
            margin-bottom: 6px;
            border: 1px solid transparent;
            border-radius: 8px;
            color: var(--white);
            font-size: 13px;
            font-weight: 500;
            transition: background .2s ease, transform .2s ease;
        }

        .menu i {
            width: 20px;
            font-size: 17px;
            text-align: center;
        }

        .menu:hover {
            color: var(--white);
            background: rgba(255, 255, 255, .12);
            transform: translateX(2px);
        }

        .menu.active {
            color: var(--white);
            background: linear-gradient(
                100deg,
                var(--green-active),
                var(--green-main)
            );
            border-color: rgba(255, 255, 255, .13);
            box-shadow: 0 3px 10px rgba(0, 0, 0, .10);
            font-weight: 600;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, .20);
        }

        .logout {
            display: flex;
            align-items: center;
            gap: 11px;
            width: 100%;
            padding: 11px 13px;
            border: 1px solid transparent;
            border-radius: 8px;
            color: var(--green-main);
            background: var(--white);
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            transition: .2s ease;
            cursor: pointer;
        }

        .logout:hover {
            color: var(--green-dark);
            background: var(--green-light);
        }

        /* ===== AREA KONTEN ===== */

        .main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            min-height: 72px;
            padding: 0 30px;
            background: var(--white);
            border-bottom: 1px solid var(--border-color);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .topbar-title {
            margin: 0;
            color: var(--text-main);
            font-size: 17px;
            font-weight: 700;
        }

        .sidebar-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--green-main);
            background: var(--white);
            font-size: 19px;
            cursor: pointer;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 11px;
            white-space: nowrap;
        }

        .user-info strong {
            display: block;
            color: var(--text-main);
            font-size: 13px;
            font-weight: 700;
        }

        .user-info span {
            display: block;
            margin-top: 2px;
            color: var(--text-muted);
            font-size: 12px;
        }

        .avatar {
            display: flex;
            flex: 0 0 40px;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid #d3e8da;
            border-radius: 50%;
            color: var(--green-main);
            background: var(--green-light);
            font-size: 15px;
            font-weight: 700;
        }

        .content {
            width: 100%;
            max-width: 1600px;
            min-height: calc(100vh - 72px);
            margin: 0 auto;
            padding: 26px 30px;
        }

        .content > .container-fluid {
            padding: 0 !important;
        }

        /* ===== KOMPONEN UMUM ===== */

        .card {
            overflow: hidden;
            border: 1px solid var(--border-color) !important;
            border-radius: 10px !important;
            box-shadow: 0 2px 8px rgba(23, 107, 67, .045);
        }

        .btn-success {
            color: var(--white);
            background: linear-gradient(
                100deg,
                var(--green-main),
                var(--green-active)
            );
            border-color: var(--green-main);
        }

        .btn-success:hover,
        .btn-success:focus {
            color: var(--white);
            background: var(--green-dark);
            border-color: var(--green-dark);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--green-active);
            box-shadow: 0 0 0 .2rem rgba(44, 128, 88, .12);
        }

        .sidebar-overlay {
            display: none;
        }

        /* ===== RESPONSIVE ===== */

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 250px;
                min-width: 250px;
                height: 100vh;
                transform: translateX(-100%);
                transition: transform .25s ease;
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: flex;
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 1040;
                display: block;
                visibility: hidden;
                background: rgba(0, 0, 0, .35);
                opacity: 0;
                transition: .25s ease;
            }

            body.sidebar-open .sidebar-overlay {
                visibility: visible;
                opacity: 1;
            }

            .topbar {
                min-height: 65px;
                padding: 0 15px;
            }

            .topbar-title {
                font-size: 15px;
            }

            .content {
                min-height: calc(100vh - 65px);
                padding: 20px 15px;
            }
        }

        @media (max-width: 480px) {
            .user-info strong {
                max-width: 115px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .user-info {
                gap: 7px;
            }

            .avatar {
                width: 35px;
                height: 35px;
                flex-basis: 35px;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <a href="{{ route('dashboard.role', ['role' => 'uptd']) }}" class="brand">
            <span class="brand-icon">
                <i class="bi bi-recycle"></i>
            </span>
            <span>SI PANTAU TPS</span>
        </a>

        <div class="menu-title">Menu Utama</div>

        <a
            class="menu {{ request()->routeIs('dashboard.role') && request()->route('role') === 'uptd' ? 'active' : '' }}"
            href="{{ route('dashboard.role', ['role' => 'uptd']) }}"
        >
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <a
            class="menu {{ request()->routeIs('uptd.laporan.*') ? 'active' : '' }}"
            href="{{ route('uptd.laporan.index') }}"
        >
            <i class="bi bi-file-earmark-text"></i>
            <span>Data Laporan</span>
        </a>

        <a
            class="menu {{ request()->routeIs('uptd.tps.*') ? 'active' : '' }}"
            href="{{ route('uptd.tps.index') }}"
        >
            <i class="bi bi-geo-alt"></i>
            <span>Data TPS Wilayah</span>
        </a>

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

    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button
                    type="button"
                    class="sidebar-toggle"
                    id="sidebarToggle"
                    aria-label="Buka menu navigasi"
                    aria-expanded="false"
                >
                    <i class="bi bi-list"></i>
                </button>

                <h1 class="topbar-title">
                    @yield('page-title', 'Dashboard UPTD')
                </h1>
            </div>

            <div class="user-info">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>Petugas UPTD</span>
                </div>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
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
</script>

@stack('scripts')
</body>
</html>
