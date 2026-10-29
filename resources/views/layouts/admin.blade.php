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
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 245px; min-width: 245px; background: #176b43; color: white; padding: 25px 16px; }
        .brand { display: flex; align-items: center; gap: 10px; padding: 5px 10px 30px; font-size: 18px; font-weight: bold; color: white; }
        .brand i { font-size: 27px; }
        .menu-title { margin: 10px 12px; color: #c7e2d2; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; }
        .menu { display: flex; align-items: center; gap: 12px; padding: 12px; margin-bottom: 7px; border-radius: 6px; color: white; }
        .menu i { font-size: 18px; width: 20px; text-align: center; }
        .menu:hover, .menu.active { background: #2c8058; color: white; }
        .sidebar-bottom { margin-top: 35px; border-top: 1px solid #438563; padding-top: 18px; }
        .logout { width: 100%; padding: 11px; border: 0; border-radius: 6px; background: white; color: #176b43; text-align: left; }
        .main { flex: 1; min-width: 0; }
        .topbar { height: 72px; display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 0 30px; background: white; border-bottom: 1px solid #e4ebe6; }
        .topbar-title { margin: 0; font-size: 18px; font-weight: bold; }
        .user-info { display: flex; align-items: center; gap: 10px; }
        .user-info small { color: #718078; }
        .avatar { width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #e2f1e7; color: #176b43; font-weight: bold; }
        .content { max-width: 1500px; margin: auto; padding: 28px 30px; }
        .stat-card, .panel { background: white; border: 1px solid #e1e9e3; border-radius: 9px; }
        .stat-card { height: 100%; padding: 19px; }
        .stat-label { color: #718078; font-size: 13px; }
        .stat-number { margin-top: 12px; font-size: 28px; font-weight: bold; }
        .stat-icon { width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background: #e7f4eb; color: #176b43; font-size: 19px; }
        .panel-heading { padding: 18px 20px; border-bottom: 1px solid #e8eee9; font-size: 16px; font-weight: bold; }
        .table th { background: #f8faf8; color: #647168; font-size: 12px; }
        .table td, .table th { padding: 13px 16px; vertical-align: middle; }
        .status { display: inline-block; padding: 5px 9px; border-radius: 20px; background: #fff2d8; color: #946200; font-size: 11px; }
        .status.selesai { background: #e2f5e8; color: #176b43; }
        .status.ditolak { background: #fde8e7; color: #ad302b; }
        .status.diproses { background: #e5efff; color: #245ab1; }
        @media(max-width: 768px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 15px; }
            .brand { padding-bottom: 15px; }
            .topbar { padding: 0 15px; }
            .content { padding: 20px 15px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <i class="bi bi-recycle"></i><span>SI PANTAU TPS</span>
        </a>

        <div class="menu-title">Menu Admin</div>

        <a href="{{ route('admin.dashboard') }}"
           class="menu {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i><span>Dashboard</span>
        </a>

        <a href="{{ route('admin.pengguna.index') }}" class="menu {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i><span>Data Pengguna</span>
        </a>

        <a href="{{ route('admin.wilayah.index') }}"
           class="menu {{ request()->routeIs('admin.wilayah.*') ? 'active' : '' }}">
            <i class="bi bi-geo"></i><span>Data Wilayah</span>
        </a>

        <a href="{{ route('admin.tps.index') }}" class="menu {{ request()->routeIs('admin.tps.*') ? 'active' : '' }}">
            <i class="bi bi-trash"></i><span>Data TPS</span>
        </a>

        <a href="{{ route('admin.laporan.index') }}"
           class="menu {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i><span>Data Laporan</span>
        </a>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout" type="submit">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="main">
        <header class="topbar">
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
</body>
</html>