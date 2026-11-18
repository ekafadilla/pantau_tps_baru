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
        :root {
            --green-main:   #176b43;
            --green-active: #1f8a56;
            --green-dark:   #125735;
            --green-light:  #e2f1e7;
            --green-soft:   #f4f7f5;
            --text-main:    #1a2e22;
            --text-muted:   #6b7f74;
            --border:       #dde8e1;
            --white:        #ffffff;
            --sidebar-w:    240px;
            --topbar-h:     64px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 14px;
            color: var(--text-main);
            background: var(--green-soft);
        }

        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; }

        /* ── LAYOUT ── */
        .app-layout {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            background: linear-gradient(170deg, var(--green-main) 0%, var(--green-dark) 100%);
            color: var(--white);
            z-index: 1050;
            transition: transform .25s ease;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 22px 18px 20px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .sidebar-brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--white);
            color: var(--green-main);
            font-size: 20px;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.25;
            letter-spacing: .2px;
        }

        .sidebar-brand-text small {
            display: block;
            font-size: 11px;
            font-weight: 400;
            opacity: .7;
        }

        .sidebar-nav {
            flex: 1;
            padding: 14px 10px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(255,255,255,.45);
            padding: 10px 10px 4px;
        }

        .nav-link-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255,255,255,.8);
            transition: background .15s, color .15s;
        }

        .nav-link-item i {
            font-size: 16px;
            flex-shrink: 0;
            opacity: .85;
        }

        .nav-link-item:hover {
            background: rgba(255,255,255,.12);
            color: var(--white);
        }

        .nav-link-item.active {
            background: rgba(255,255,255,.18);
            color: var(--white);
            font-weight: 600;
        }

        .nav-link-item.active i { opacity: 1; }

        .sidebar-footer {
            padding: 14px 10px;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.1);
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-info { flex: 1; min-width: 0; }
        .user-info .u-name { font-weight: 600; font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-info .u-role { font-size: 11px; opacity: .65; }

        .btn-logout {
            background: none;
            border: none;
            color: rgba(255,255,255,.65);
            font-size: 16px;
            padding: 4px;
            border-radius: 5px;
            transition: color .15s, background .15s;
        }
        .btn-logout:hover { color: var(--white); background: rgba(255,255,255,.15); }

        /* ── MAIN WRAPPER ── */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        /* ── TOPBAR ── */
        .topbar {
            height: var(--topbar-h);
            min-height: var(--topbar-h);
            display: flex;
            align-items: center;
            padding: 0 24px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            gap: 12px;
            z-index: 100;
        }

        .topbar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 22px;
            color: var(--text-main);
            padding: 4px 6px;
            border-radius: 6px;
        }

        .topbar-title {
            flex: 1;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-main);
        }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            background: var(--green-light);
            color: var(--green-main);
            font-size: 12px;
            font-weight: 600;
        }

        /* ── CONTENT ── */
        .page-content {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
        }

        /* ── OVERLAY (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 1040;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                transform: translateX(-100%);
            }

            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .topbar-toggle { display: flex; }
        }

        /* ── UTILITY OVERRIDES ── */
        .card { border-radius: 12px; }
        .card.border-0 { box-shadow: 0 1px 4px rgba(0,0,0,.07); }

        .badge { font-weight: 600; border-radius: 6px; }

        .btn-success { background: var(--green-main); border-color: var(--green-main); }
        .btn-success:hover { background: var(--green-active); border-color: var(--green-active); }
        .btn-outline-success { color: var(--green-main); border-color: var(--green-main); }
        .btn-outline-success:hover { background: var(--green-main); border-color: var(--green-main); }

        .form-control:focus, .form-select:focus {
            border-color: var(--green-main);
            box-shadow: 0 0 0 .2rem rgba(23,107,67,.18);
        }

        .table th { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .4px; }

        .summary-card .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px;
        }
        .summary-label { font-size: 12px; color: var(--text-muted); font-weight: 500; margin-bottom: 4px; }
        .summary-number { font-size: 26px; font-weight: 700; color: var(--text-main); line-height: 1; }
        .summary-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 500;
            color: var(--green-main);
            background: var(--green-light);
            border: 1px solid transparent;
            transition: background .15s;
        }
        .btn-detail:hover { background: #c8e3d4; color: var(--green-dark); }

        @yield('styles')
    </style>

    @stack('head')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="app-layout">

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="bi bi-recycle"></i>
            </div>
            <div class="sidebar-brand-text">
                SI PANTAU TPS
                <small>Portal UPTD</small>
            </div>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-label">Menu Utama</span>

            <a href="{{ route('dashboard.role', 'uptd') }}"
               class="nav-link-item {{ request()->routeIs('dashboard.role') && request()->route('role') === 'uptd' ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>

            <a href="{{ route('uptd.laporan.index') }}"
               class="nav-link-item {{ request()->routeIs('uptd.laporan.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-data"></i> Data Laporan
            </a>

            <a href="{{ route('uptd.tps.index') }}"
               class="nav-link-item {{ request()->routeIs('uptd.tps.*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i> Data TPS Wilayah
            </a>

            <span class="nav-label" style="margin-top:8px">Akun</span>

            <a href="{{ route('pengaturan.edit') }}"
               class="nav-link-item {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Pengaturan
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="u-name">{{ auth()->user()->name ?? 'Pengguna' }}</div>
                    <div class="u-role">UPTD</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout" title="Keluar">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ── MAIN ── -->
    <div class="main-wrapper">

        <!-- Topbar -->
        <header class="topbar">
            <button class="topbar-toggle" id="sidebarToggle" aria-label="Buka sidebar">
                <i class="bi bi-list"></i>
            </button>
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            <div class="topbar-right">
                <div class="topbar-badge">
                    <i class="bi bi-patch-check"></i> UPTD
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="page-content">
            @yield('content')
        </main>

    </div><!-- /.main-wrapper -->
</div><!-- /.app-layout -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('sidebarOverlay');
        const toggle   = document.getElementById('sidebarToggle');

        function open()  { sidebar.classList.add('open');  overlay.classList.add('open'); }
        function close() { sidebar.classList.remove('open'); overlay.classList.remove('open'); }

        toggle?.addEventListener('click', () => sidebar.classList.contains('open') ? close() : open());
        overlay?.addEventListener('click', close);
    })();
</script>
@stack('scripts')
</body>
</html>
