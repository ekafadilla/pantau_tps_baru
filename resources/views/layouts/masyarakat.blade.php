
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

        .menu {
    display: flex;
    align-items: center;
    gap: 13px;
    min-height: 44px;
    margin-bottom: 6px;
    padding: 10px 15px;
    border-radius: 8px;
    color: #ffffff !important;
    font-size: 14px;
    text-decoration: none !important;
    transition: background .15s ease;
}

.menu i {
    width: 20px;
    font-size: 18px;
    text-align: center;
}

.menu:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff !important;
}

.menu.active {
    background: #2c8058;
    color: #ffffff !important;
    font-weight: 600;
}

       /* --- DESAIN SIDEBAR MODERN & ELEGAN --- */
.sidebar {
    position: fixed;
    z-index: 1000;
    inset: 0 auto 0 0;
    width: 255px;
    padding: 28px 20px;
    overflow-y: auto;
    background: linear-gradient(180deg, #115334 0%, #0d3e27 100%);
    color: #ffffff;
    display: flex;
    flex-direction: column;
    box-shadow: 4px 0 24px rgba(0, 0, 0, 0.08);
}

/* BRAND / LOGO */
.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-bottom: 24px;
    margin-bottom: 16px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
}

.brand-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(4px);
    color: #86efac;
    font-size: 22px;
}

.brand-text {
    font-size: 16px;
    font-weight: 800;
    letter-spacing: .5px;
    color: #ffffff;
    line-height: 1.2;
}

.brand-text span {
    display: block;
    font-size: 10px;
    font-weight: 500;
    color: #a7f3d0;
    letter-spacing: 1px;
}

/* JUDUL SECTION MENU */
.menu-title {
    margin: 16px 0 8px 8px;
    color: #6ee7b7;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    opacity: 0.8;
}

/* ITEM MENU */
.menu {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 44px;
    padding: 10px 14px;
    margin-bottom: 4px;
    border-radius: 10px;
    color: #d1fae5 !important;
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none !important;
    transition: all .2s ease;
}

.menu i {
    font-size: 18px;
    color: #a7f3d0;
    transition: transform .2s ease;
}

.menu:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff !important;
    transform: translateX(3px);
}

.menu:hover i {
    color: #ffffff;
}

/* MENU AKTIF */
.menu.active {
    background: #1e7e4d !important;
    color: #ffffff !important;
    font-weight: 700;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.18);
}

.menu.active i {
    color: #86efac;
}

.menu.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 25%;
    height: 50%;
    width: 4px;
    background: #86efac;
    border-radius: 0 4px 4px 0;
}

/* BAGIAN BAWAH & TOMBOL KELUAR */
.sidebar-bottom {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.12);
}

.logout {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    min-height: 44px;
    padding: 10px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
}

.logout i {
    font-size: 18px;
    color: #fca5a5;
}

.logout:hover {
    background: #dc2626;
    border-color: #dc2626;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.logout:hover i {
    color: #ffffff;
}

/* Secara default (di Desktop), tombol hamburger DISEMBUNYIKAN */
.btn-toggle-sidebar {
    display: none !important;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: #ffffff;
    color: #176b43;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    transition: all .2s ease;
    margin-right: 14px;
}

/* HANYA MUNCUL di layar Tablet / Mobile (<= 1024px) */
@media (max-width: 1024px) {
    .btn-toggle-sidebar {
        display: inline-flex !important;
    }

    .sidebar {
        transform: translateX(-100%);
        transition: transform .3s ease;
    }

    .sidebar.show {
        transform: translateX(0);
        box-shadow: 6px 0 30px rgba(0, 0, 0, 0.2);
    }

    .app-main {
        margin-left: 0 !important;
    }
}
    </style>
</head>

<body>

 <aside class="sidebar" id="sidebar">
    <!-- BRAND / LOGO -->
    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-recycle"></i>
        </div>
        <div class="brand-text">
            SI PANTAU TPS
            <span>DLH INDRAMAYU</span>
        </div>
    </div>

    <!-- MENU UTAMA -->
    <div class="menu-title">Menu Utama</div>
    
    <a class="menu {{ request()->routeIs('dashboard.role') && request()->route('role') === 'masyarakat' ? 'active' : '' }}" 
       href="{{ route('dashboard.role', ['role' => 'masyarakat']) }}">
        <i class="bi bi-grid-1x2-fill"></i>
        <span>Dashboard</span>
    </a>

    <a class="menu {{ request()->routeIs('masyarakat.laporan.index') ? 'active' : '' }}" 
       href="{{ route('masyarakat.laporan.index') }}">
        <i class="bi bi-file-earmark-text-fill"></i>
        <span>Laporan Saya</span>
    </a>

    <a class="menu {{ request()->routeIs('masyarakat.laporan.create') ? 'active' : '' }}" 
       href="{{ route('masyarakat.laporan.create') }}">
        <i class="bi bi-plus-circle-fill"></i>
        <span>Buat Laporan</span>
    </a>

    <!-- PENGATURAN -->
    <div class="menu-title" style="margin-top: 18px;">Pengaturan</div>
    
    <a class="menu {{ request()->routeIs('masyarakat.pengaturan.*') ? 'active' : '' }}" 
       href="{{ route('masyarakat.pengaturan.edit') }}">
        <i class="bi bi-gear-fill"></i>
        <span>Pengaturan Akun</span>
    </a>

    <!-- TOMBOL KELUAR -->
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

    <main class="app-main">
       
        <header class="app-header">
    <!-- Bagian Kiri: Tombol Hamburger & Judul Halaman (Hanya 1 judul) -->
    <div style="display: flex; align-items: center; gap: 14px;">
        <button type="button" class="btn-toggle-sidebar" id="sidebarToggle" title="Buka Menu">
            <i class="bi bi-list"></i>
        </button>
        <h1 class="app-header-title" style="margin: 0; font-size: 19px; font-weight: 700; color: #1e293b;">
            @yield('header', 'Dashboard Masyarakat')
        </h1>
    </div>
    
    
    <a href="{{ route('masyarakat.pengaturan.edit') }}" class="app-user" title="Pengaturan Akun" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 11px;">
        <div class="app-avatar" style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 50%; background: #e2f1e7; color: #176b43; font-weight: 700; font-size: 15px;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div>
            <div class="app-user-name" style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ auth()->user()->name }}</div>
            <div class="app-user-role" style="font-size: 12px; color: #718078;">Masyarakat</div>
        </div>
    </a>
</header>
        <section class="app-content">
            @yield('content')
        </section>
    </main>
             <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const toggleBtn = document.getElementById('sidebarToggle');
                    const sidebar 
                    = document.getElementById('sidebar');

                    if (toggleBtn && sidebar) {
                        toggleBtn.addEventListener('click', function (e) {
                            e.stopPropagation();
                            sidebar.classList.toggle('show');
                        });

                        // Tutup sidebar jika mengklik di luar area sidebar (saat di tablet/HP)
                        document.addEventListener('click', function (e) {
                            if (window.innerWidth <= 1024 && !sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                                sidebar.classList.remove('show');
                            }
                        });
                    }
                });
            </script>
</body>
</html>
