
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SI PANTAU TPS')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #176b43;
            --primary-hover: #125735;
            --primary-light: #e2f1e7;
            --sidebar-active: #2c8058;
            --page-bg: #f4f7f5;
            --surface: #ffffff;
            --border: #e1e9e3;
            --text: #26382f;
            --muted: #718078;
            --sidebar-width: 245px;
            --header-height: 72px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--page-bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        /* SIDEBAR */
        .app-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1000;
            width: var(--sidebar-width);
            padding: 25px 16px;
            overflow-y: auto;
            background: var(--primary);
            color: #fff;
        }

        .app-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 15px 28px;
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            white-space: nowrap;
        }

        .app-brand i {
            font-size: 32px;
        }

        .app-menu-label {
            margin: 8px 15px 12px;
            color: #c6e2d2;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .app-menu {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 48px;
            margin-bottom: 7px;
            padding: 12px 15px;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            text-decoration: none;
            transition: background .15s ease;
        }

        .app-menu i {
            width: 22px;
            font-size: 19px;
            text-align: center;
        }

        .app-menu:hover,
        .app-menu.active {
            background: var(--sidebar-active);
            color: #fff;
        }

        .app-logout {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.2);
        }

        .app-logout button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            min-height: 43px;
            padding: 10px 15px;
            border: 0;
            border-radius: 8px;
            background: #fff;
            color: var(--primary);
            font-size: 14px;
            cursor: pointer;
        }

        /* AREA KONTEN */
        .app-main {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
        }

        /* HEADER */
        .app-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            min-height: var(--header-height);
            padding: 16px 30px;
            border-bottom: 1px solid #e4ebe6;
            background: var(--surface);
        }

        .app-header-title {
            margin: 0;
            font-size: 21px;
            font-weight: 700;
        }

        .app-user {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 0;
        }

        .app-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 15px;
            font-weight: 700;
        }

        .app-user-name {
            max-width: 190px;
            overflow: hidden;
            font-size: 13px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .app-user-role {
            margin-top: 3px;
            color: var(--muted);
            font-size: 12px;
        }

        /* KONTEN HALAMAN */
        .app-content {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 28px 30px;
        }

        .page-heading {
            margin-bottom: 22px;
        }

        .page-title {
            margin: 0 0 7px;
            font-size: 21px;
            font-weight: 700;
        }

        .page-description {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        /* PANEL DAN KARTU */
        .app-panel,
        .app-stat-card {
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--surface);
        }

        .app-panel {
            margin-bottom: 22px;
            overflow: hidden;
        }

        .app-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 19px 22px;
            border-bottom: 1px solid #e8eee9;
        }

        .app-panel-title {
            margin: 0 0 5px;
            font-size: 16px;
            font-weight: 700;
        }

        .app-panel-body {
            padding: 22px;
        }

        .app-muted {
            color: var(--muted);
            font-size: 13px;
        }

        /* TOMBOL */
        .btn-app-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 9px 15px;
            border: 1px solid var(--primary);
            border-radius: 7px;
            background: var(--primary);
            color: #fff;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-app-primary:hover {
            border-color: var(--primary-hover);
            background: var(--primary-hover);
            color: #fff;
        }

        .btn-app-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 40px;
            padding: 9px 14px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: #fff;
            color: var(--text);
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
        }

        /* FORM */
        .form-label {
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border-color: #dce5df;
            border-radius: 7px;
            font-size: 13px;
        }

        textarea.form-control {
            min-height: 110px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #77a98b;
            box-shadow: 0 0 0 3px rgba(23,107,67,.10);
        }

        /* TABEL */
        .table-responsive {
            width: 100%;
        }

        .app-table {
            margin: 0;
            vertical-align: middle;
            font-size: 13px;
        }

        .app-table thead th {
            padding: 14px 12px;
            background: #f7f9f7;
            color: #526258;
            font-weight: 600;
            white-space: nowrap;
        }

        .app-table tbody td {
            padding: 14px 12px;
        }

        /* STATUS */
        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-menunggu {
            background: #fff0cc;
            color: #916000;
        }

        .status-diverifikasi {
            background: #e5efff;
            color: #2458a6;
        }

        .status-diproses {
            background: #dcecff;
            color: #2458a6;
        }

        .status-ditangani {
            background: #e5e0ff;
            color: #5c42a6;
        }

        .status-selesai {
            background: #dff5e6;
            color: #217342;
        }

        .status-ditolak {
            background: #ffe3e3;
            color: #a52c2c;
        }

        .app-empty {
            padding: 38px 15px;
            color: var(--muted);
            text-align: center;
        }

        .app-empty i {
            display: block;
            margin-bottom: 12px;
            font-size: 34px;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination .page-link {
            color: var(--primary);
        }

        .pagination .active .page-link {
            border-color: var(--primary);
            background: var(--primary);
            color: #fff;
        }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            :root {
                --sidebar-width: 210px;
            }

            .app-content {
                padding: 22px 20px;
            }

            .app-header {
                padding-right: 20px;
                padding-left: 20px;
            }
        }

        @media (max-width: 700px) {
            :root {
                --sidebar-width: 68px;
            }

            .app-sidebar {
                padding: 18px 8px;
            }

            .app-brand {
                justify-content: center;
                padding: 5px 0 25px;
            }

            .app-brand span,
            .app-menu-label,
            .app-menu span,
            .app-logout span {
                display: none;
            }

            .app-menu {
                justify-content: center;
                padding: 12px 5px;
            }

            .app-main {
                margin-left: var(--sidebar-width);
            }

            .app-header {
                align-items: flex-start;
                gap: 10px;
                padding: 15px 12px;
            }

            .app-header-title {
                font-size: 17px;
            }

            .app-user {
                gap: 7px;
            }

            .app-user-name {
                max-width: 100px;
                font-size: 12px;
            }

            .app-content {
                padding: 18px 12px;
            }

            .app-panel-header,
            .app-panel-body {
                padding: 15px;
            }

            .mobile-stack {
                flex-direction: column;
                align-items: stretch !important;
            }
        }
    </style>
</head>

<body>

    <aside class="app-sidebar">
        <div class="app-brand">
            <i class="bi bi-recycle"></i>
            <span>SI PANTAU TPS</span>
        </div>

        <div class="app-menu-label">Menu Utama</div>

        <a href="{{ route('dashboard') }}"
           class="app-menu {{ request()->routeIs('dashboard', 'dashboard.role') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('masyarakat.laporan.index') }}"
           class="app-menu {{ request()->routeIs('masyarakat.laporan.index', 'masyarakat.laporan.show') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i>
            <span>Laporan Saya</span>
        </a>

        <a href="{{ route('masyarakat.laporan.create') }}"
           class="app-menu {{ request()->routeIs('masyarakat.laporan.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i>
            <span>Buat Laporan</span>
        </a>

        <a href="{{ route('masyarakat.pengaturan.edit') }}">
            <i class="bi bi-gear"></i>
            <span>Pengaturan Akun</span>
        </a>

        <div class="app-logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="app-main">
        <header class="app-header">
            <h1 class="app-header-title">@yield('header', 'Dashboard Masyarakat')</h1>

            <div class="app-user">
                <div class="app-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <div class="app-user-name">{{ auth()->user()->name }}</div>
                    <div class="app-user-role">Masyarakat</div>
                </div>
            </div>
        </header>

        <section class="app-content">
            @yield('content')
        </section>
    </main>

</body>
</html>
