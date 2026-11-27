<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI PANTAU TPS - Supir')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

   <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f4f7f5; color: #26382f; font-size: 14px; }
        a { text-decoration: none; }
        .layout { display: flex; min-height: 100vh; }

        /* SIDEBAR  */
        .sidebar {
            width: 255px;
            min-width: 255px;
            flex: 0 0 255px;
            background: #135331;
            color: white;
            padding: 24px 18px;
            display: flex;
            flex-direction: column;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 4px 6px 22px;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12); /* Garis pemisah bawah logo */
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
            color: #7cd4a4;
            font-size: 11px;
            font-weight: 700;
            margin: 8px 10px 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
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
            color: #98e2b8; /* Warna ikon hijau mint */
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
        /* Aksen pil melengkung di sebelah kiri menu aktif */
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

        /* TOMBOL KELUAR DI BAGIAN BAWAH */
        .sidebar-bottom {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.12); /* Garis pemisah atas tombol keluar */
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
            transition: all 0.2s;
        }
        .logout i {
            font-size: 18px;
            color: #ff8a80; 
        }
        .logout:hover {
            background: #dc2626;
        }

        /* MAIN CONTENT & TOPBAR */
        .main { flex: 1; min-width: 0; }
        .topbar {
            min-height: 72px;
            background: white;
            border-bottom: 1px solid #e4ebe6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            gap: 15px;
        }
        .topbar-title { margin: 0; font-size: 18px; font-weight: 700; color: #26382f; }
        .user-info { display: flex; align-items: center; gap: 10px; font-size: 13px; white-space: nowrap; }
        .user-info span { font-size: 12px; color: #718078; }
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
            font-weight: 700;
        }
        .content { padding: 28px 30px; max-width: 1500px; margin: auto; }
        .card { border-color: #e1e9e3 !important; border-radius: 9px; }
        .btn-success { background: #176b43; border-color: #176b43; }
        .btn-success:hover { background: #125735; border-color: #125735; }

        @media(max-width: 768px) {
            .layout { display: block; }
            .sidebar { width: 100%; min-width: 0; padding: 15px; }
            .brand { padding-bottom: 15px; }
            .sidebar-bottom { margin-top: 20px; }
            .topbar { padding: 15px; }
            .content { padding: 18px 12px; }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/ui-konsisten.css') }}">
</head>
<body>
<div class="layout">

    <!-- SIDEBAR -->
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

        <a class="menu {{ request()->routeIs('supir.dashboard') ? 'active' : '' }}"
           href="{{ route('supir.dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <a class="menu {{ request()->routeIs('supir.tugas.*') ? 'active' : '' }}"
           href="{{ route('supir.tugas.index') }}">
            <i class="bi bi-clipboard-check-fill"></i>
            <span>Daftar Tugas</span>
        </a>

        <!-- PENGATURAN -->
        <div class="menu-title" style="margin-top: 18px;">Pengaturan</div>

        <a class="menu {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}"
           href="{{ route('pengaturan.edit') }}">
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

    <!-- MAIN CONTENT -->
    <main class="main">
        <header class="topbar">
            <h1 class="topbar-title">@yield('page-title', 'Dashboard Supir')</h1>
            <div class="user-info">
                <div>
                    <strong>{{ auth()->user()->name ?? 'Supir' }}</strong><br>
                    <span>Supir</span>
                </div>
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
                </div>
            </div>
        </header>

        <section class="content">
            @yield('content')
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>