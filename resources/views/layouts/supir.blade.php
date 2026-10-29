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
        .sidebar { width: 245px; min-width: 245px; flex: 0 0 245px; background: #176b43; color: white; padding: 25px 16px; }
        .brand { display: flex; align-items: center; gap: 10px; padding: 5px 10px 30px; font-size: 18px; font-weight: bold; color: white; }
        .brand i { font-size: 27px; }
        .menu-title { color: #c7e2d2; font-size: 11px; margin: 10px 12px; text-transform: uppercase; letter-spacing: 1px; }
        .menu { display: flex; align-items: center; gap: 12px; padding: 12px; margin-bottom: 7px; border-radius: 6px; font-size: 14px; color: white; }
        .menu i { font-size: 18px; }
        .menu.active, .menu:hover { background: #2c8058; color: white; }
        .sidebar-bottom { margin-top: 35px; border-top: 1px solid #438563; padding-top: 18px; }
        .logout { width: 100%; background: white; color: #176b43; border: none; padding: 11px; border-radius: 6px; cursor: pointer; text-align: left; }
        .main { flex: 1; min-width: 0; }
        .topbar { min-height: 72px; background: white; border-bottom: 1px solid #e4ebe6; display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; gap: 15px; }
        .topbar-title { margin: 0; font-size: 18px; font-weight: 700; color: #26382f; }
        .user-info { display: flex; align-items: center; gap: 10px; font-size: 13px; white-space: nowrap; }
        .user-info span { font-size: 12px; color: #718078; }
        .avatar { width: 38px; height: 38px; min-width: 38px; display: flex; justify-content: center; align-items: center; border-radius: 50%; background: #e2f1e7; color: #176b43; font-weight: 700; }
        .content { padding: 28px 30px; max-width: 1500px; margin: auto; }
        .card { border-color: #e1e9e3 !important; border-radius: 9px; }
        .btn-success { background: #176b43; border-color: #176b43; }
        .btn-success:hover { background: #125735; border-color: #125735; }
        @media(max-width: 768px) {
            .layout { display: block; }
            .sidebar { width: 100%; min-width: 0; padding: 15px; }
            .brand { padding-bottom: 15px; }
            .topbar { padding: 15px; }
            .content { padding: 18px 12px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">
            <i class="bi bi-recycle"></i>
            <span>SI PANTAU TPS</span>
        </div>

        <div class="menu-title">Menu Supir</div>

        <a href="{{ route('supir.dashboard') }}"
           class="menu {{ request()->routeIs('supir.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('supir.tugas.index') }}"
           class="menu {{ request()->routeIs('supir.tugas.*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check"></i>
            <span>Daftar Tugas</span>
        </a>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout">
                    <i class="bi bi-box-arrow-left"></i>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

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
</body>
</html>