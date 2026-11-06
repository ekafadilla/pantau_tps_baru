<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard Utama Administrator DLH Indramayu') | SI PANTAU TPS</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #072118;
            --sidebar-hover: #123326;
            --sidebar-active: #1b4334;
            --sidebar-text: #9cbdaf;
            --sidebar-text-active: #ffffff;
            --accent-green: #10b981;
            --dark-pine: #0a291e;
            --body-bg: #f2f7f4;
            --card-border: #e2ede7;
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            margin: 0;
            background: var(--body-bg);
            color: #1e293b;
            font-size: 14px;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-width: 260px;
            background: var(--sidebar-bg);
            color: white;
            padding: 24px 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 8px 14px;
        }

        .brand-icon-box {
            width: 42px;
            height: 42px;
            background: #143a2d;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #34d399;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .brand-text-title {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #ffffff;
            line-height: 1.2;
        }

        .brand-text-sub {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.8px;
            color: #7ba694;
        }

        .role-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #0d2c20;
            border: 1px solid #1a4534;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            color: #bbf7d0;
            margin: 4px 8px 22px;
        }

        .role-pill .dot {
            width: 7px;
            height: 7px;
            background: #22c55e;
            border-radius: 50%;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 14px;
            border-radius: 8px;
            color: var(--sidebar-text);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .menu-link i {
            font-size: 18px;
            width: 22px;
            text-align: center;
        }

        .menu-link:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
        }

        .menu-link.active {
            background: var(--sidebar-active);
            color: var(--sidebar-text-active);
            font-weight: 700;
        }

        .submenu-container {
            padding: 4px 0 6px 36px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .submenu-link {
            padding: 8px 12px;
            border-radius: 6px;
            color: var(--sidebar-text);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }

        .submenu-link:hover, .submenu-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.08);
            font-weight: 600;
        }

        .sidebar-bottom {
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            background: transparent;
            border: none;
            color: #8dafa1;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
        }

        /* MAIN CONTENT AREA */
        .main-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */
        .topbar {
            height: 68px;
            background: #ffffff;
            border-bottom: 1px solid #e4eee8;
            padding: 0 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .breadcrumb-text {
            font-size: 13px;
            color: #64748b;
        }

        .breadcrumb-text span {
            color: #0f172a;
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notif-bell-btn {
            position: relative;
            background: transparent;
            border: none;
            font-size: 19px;
            color: #475569;
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 6px;
        }

        .notif-bell-btn .notif-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border: 2px solid #ffffff;
            border-radius: 50%;
        }

        .divider-v {
            width: 1px;
            height: 28px;
            background: #e2e8f0;
        }

        .user-profile-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-profile-info {
            text-align: right;
            line-height: 1.25;
        }

        .user-name-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .user-sub-title {
            font-size: 11px;
            color: #64748b;
        }

        .avatar-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #082017;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
            border: 2px solid #e2f1ea;
        }

        /* PAGE CONTENT CONTAINER */
        .content-body {
            flex: 1;
            padding: 30px 36px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }

        /* RESPONSIVE */
        @media(max-width: 992px) {
            .layout {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                min-width: 100%;
            }
            .topbar {
                padding: 0 18px;
            }
            .content-body {
                padding: 20px 16px;
            }
        }
    </style>
</head>
<body>

<div class="layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div>
            <!-- Brand -->
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <div class="brand-icon-box">
                    <i class="bi bi-trash3-fill"></i>
                </div>
                <div>
                    <div class="brand-text-title">SI PANTAU TPS</div>
                    <div class="brand-text-sub">DLH KAB. INDRAMAYU</div>
                </div>
            </a>

            <!-- Role Badge -->
            <div class="role-pill">
                <span class="dot"></span>
                <span>Peran: Administrator</span>
            </div>

            <!-- Menu List -->
            <nav class="sidebar-menu">
                <!-- 1. Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>

                <!-- 2. Laporan -->
                <a href="{{ route('admin.laporan.index') }}"
                   class="menu-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Laporan</span>
                </a>

                <!-- 3. Data Master -->
                @php
                    $isMasterActive = request()->routeIs('admin.tps.*') || request()->routeIs('admin.wilayah.*') || request()->routeIs('admin.landing.*');
                @endphp
                <div>
                    <a class="menu-link {{ $isMasterActive ? 'active' : '' }}"
                       data-bs-toggle="collapse"
                       href="#collapseDataMaster"
                       role="button"
                       aria-expanded="{{ $isMasterActive ? 'true' : 'false' }}">
                        <i class="bi bi-stack"></i>
                        <span>Data Master</span>
                        <i class="bi bi-chevron-down ms-auto" style="font-size: 11px;"></i>
                    </a>
                    <div class="collapse {{ $isMasterActive ? 'show' : '' }}" id="collapseDataMaster">
                        <div class="submenu-container">
                            <a href="{{ route('admin.tps.index') }}"
                               class="submenu-link {{ request()->routeIs('admin.tps.*') ? 'active' : '' }}">
                                <i class="bi bi-trash"></i>
                                <span>Data TPS</span>
                            </a>
                            <a href="{{ route('admin.wilayah.index') }}"
                               class="submenu-link {{ request()->routeIs('admin.wilayah.*') ? 'active' : '' }}">
                                <i class="bi bi-geo-alt"></i>
                                <span>Data Wilayah</span>
                            </a>
                            <a href="{{ route('admin.landing.edit') }}"
                               class="submenu-link {{ request()->routeIs('admin.landing.*') ? 'active' : '' }}">
                                <i class="bi bi-layout-text-window-reverse"></i>
                                <span>Landing Page</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 4. Pengguna -->
                <a href="{{ route('admin.pengguna.index') }}"
                   class="menu-link {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Pengguna</span>
                </a>

                <!-- 5. Rekapitulasi -->
                <a href="{{ route('admin.laporan.index') }}?rekap=1"
                   class="menu-link {{ request()->has('rekap') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-line-fill"></i>
                    <span>Rekapitulasi</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Bottom: Keluar -->
        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <header class="topbar">
            <div class="breadcrumb-text">
                Sistem / <span>Portal Monitoring DLH</span>
            </div>

            <div class="topbar-right">
                <button type="button" class="notif-bell-btn" title="Notifikasi Pengaduan Masuk">
                    <i class="bi bi-bell"></i>
                    <span class="notif-dot"></span>
                </button>

                <div class="divider-v"></div>

                <div class="user-profile-header">
                    <div class="user-profile-info">
                        <div class="user-name-title">Admin DLH Indramayu</div>
                        <div class="user-sub-title">{{ auth()->user()->name }} • Super Admin</div>
                    </div>
                    <div class="avatar-circle">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="content-body">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>