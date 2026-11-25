<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard Admin') | SI PANTAU TPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f4f7f5; color: #26382f; font: 14px Arial, Helvetica, sans-serif; }
        a { text-decoration: none; }
        .layout { 
            display: flex; 
            min-height: 100vh; 
            align-items: flex-start;
        }
                nav[role="navigation"] svg {
            width: 20px !important;
            height: 20px !important;
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            min-width: 255px;
            flex: 0 0 255px;
            background: #135331;
            color: white;
            padding: 24px 18px;
            display: flex;
            flex-direction: column;
            position: sticky;
            height: 100vh;
            top:0;
            max-height: 100vh;
        }

        .sidebar-menu{
            flex: 1;
            overflow-y: auto;
            padding-right: 4px;
            margin-right: -4px;
            margin-top: 10px;
            margin-bottom: 10px;

        }

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb{
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .sidebar-bottom {
            padding-top: 16px;
            margin-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 4px 6px 22px;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            color: white;
        }
        .brand-icon {
            width: 42px;
            height: 42px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            color: #98e2b8;
        }
        .brand-text {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.3px;
            line-height: 1.25;
        }
        .brand-text span {
            display: block;
            font-size: 10px;
            font-weight: 600;
            color: #98e2b8;
            letter-spacing: 0.8px;
            margin-top: 2px;
        }
        .menu-title {
            margin: 8px 10px 10px;
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
            transition: all 0.2s;
        }
        .menu i {
            font-size: 18px;
            width: 20px;
            text-align: center;
            color: #98e2b8;
        }
        .menu:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }
        .menu.active {
            background: #278855;
            color: white;
            font-weight: 700;
        }
        .menu.active i {
            color: #a9f0c7;
        }
        .menu.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 22%;
            height: 56%;
            width: 4px;
            background: #a9f0c7;
            border-radius: 0 4px 4px 0;
        }

        /* TOMBOL KELUAR & EFEK HOVER MERAH */
        .sidebar-bottom {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }
        .logout {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.22);
            padding: 12px;
            border-radius: 10px;
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
            color: white;
        }
        .logout:hover i {
            color: white;
        }

        /* MAIN CONTENT & TOPBAR */
        .main { flex: 1; min-width: 0; }
        .topbar {
            min-height: 72px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 0 30px;
            background: white;
            border-bottom: 1px solid #e4ebe6;
        }
        .topbar-title { margin: 0; font-size: 18px; font-weight: bold; }
        .user-info { display: flex; align-items: center; gap: 10px; }
        .user-info small { color: #718078; }
        .avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e2f1e7;
            color: #176b43;
            font-weight: bold;
        }
        .content { max-width: 1500px; margin: auto; padding: 28px 30px; }

        /* KOMPONEN KHUSUS HALAMAN ADMIN */
        .stat-card, .panel { background: white; border: 1px solid #e1e9e3; border-radius: 9px; }
        .stat-card { height: 100%; padding: 19px; }
        .stat-label { color: #718078; font-size: 13px; }
        .stat-number { margin-top: 12px; font-size: 28px; font-weight: bold; }
        .stat-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #e7f4eb;
            color: #176b43;
            font-size: 19px;
        }
        .panel-heading { padding: 18px 20px; border-bottom: 1px solid #e8eee9; font-size: 16px; font-weight: bold; }
        .table th { background: #f8faf8; color: #647168; font-size: 12px; }
        .table td, .table th { padding: 13px 16px; vertical-align: middle; }
        .status { display: inline-block; padding: 5px 9px; border-radius: 20px; background: #fff2d8; color: #946200; font-size: 11px; }
        .status.selesai { background: #e2f5e8; color: #176b43; }
        .status.ditolak { background: #fde8e7; color: #ad302b; }
        .status.diproses { background: #e5efff; color: #245ab1; }

        /* RESPONSIF HAMBURGER MENU (MOBILE) */
        @media(max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -265px;
                height: 100vh;
                z-index: 1050;
                transition: left 0.3s ease;
                overflow-y: auto;
            }
            .sidebar.show {
                left: 0;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.45);
                z-index: 1040;
            }
            .sidebar-overlay.show {
                display: block;
            }
            .topbar { padding: 0 15px; }
            .content { padding: 20px 15px; }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/ui-konsisten.css') }}">
</head>
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="layout">
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <div class="brand-icon">
                <i class="bi bi-recycle"></i>
            </div>
            <div class="brand-text">
                SI PANTAU TPS
                <span>DLH INDRAMAYU</span>
            </div>
        </a>

        <!-- bagian tengah -->
        <div class="sidebar-menu">
            <div class="menu-title">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="menu {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.pengguna.index') }}"
               class="menu {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Data Pengguna</span>
            </a>

            <a href="{{ route('admin.wilayah.index') }}"
               class="menu {{ request()->routeIs('admin.wilayah.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt-fill"></i>
                <span>Data Wilayah</span>
            </a>

            <a href="{{ route('admin.tps.index') }}"
               class="menu {{ request()->routeIs('admin.tps.*') ? 'active' : '' }}">
                <i class="bi bi-trash-fill"></i>
                <span>Data TPS</span>
            </a>

            <a href="{{ route('admin.laporan.index') }}"
               class="menu {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Data Laporan</span>
            </a>

        <a href="{{ route('admin.spam.index') }}"
           class="menu {{ request()->routeIs('admin.spam.*') ? 'active' : '' }}">
            <i class="bi bi-shield-exclamation"></i><span>Deteksi Spam</span>
        </a>
        <a href="{{ route('pengaturan.edit') }}" class="menu {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Pengaturan
        </a>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout" type="submit">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- OVERLAY MOBILE -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <div class="main">
        <header class="topbar">
            <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka menu"><i class="bi bi-list"></i></button>
            <h1 class="topbar-title">@yield('page-title', 'Dashboard Admin')</h1>
            <div class="user-info">
                <div>
                    <strong>{{ auth()->user()->name }}</strong><br>
                    <small>Admin</small>
                </div>
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>

        <footer class="text-center text-secondary small pb-4">
            SI PANTAU TPS &copy; {{ date('Y') }} | DLH Kabupaten Indramayu
        </footer>
    </div>
</div>
<script>
(function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');

    if (!sidebar || !overlay || !toggle) return;

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
        document.body.classList.remove('sidebar-open');
    }

    function toggleSidebar() {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
        document.body.classList.toggle('sidebar-open');
    }

    toggle.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeSidebar();
    });

    sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 991) closeSidebar();
        });
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 991) closeSidebar();
    });
})();
</script>
</body>
</html>

