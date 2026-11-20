
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SI PANTAU TPS - Supir')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f1f8f3;
            color: #23372e;
            font-size: 14px;
        }

        a {
            text-decoration: none;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 258px;
            min-width: 258px;
            flex: 0 0 258px;
            background: #073e32;
            color: white;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            height: 100vh;
            position: sticky;
            top: 0;
            align-self: flex-start;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 10px 22px;
            color: white;
        }

        .brand i {
            font-size: 25px;
        }

        .brand-name {
            font-size: 16px;
            font-weight: bold;
        }

        .brand-subtitle {
            font-size: 10px;
            color: #b8d8c8;
            margin-top: 2px;
        }

        .sidebar-caption {
            font-size: 10px;
            color: #a9cdbb;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin: 12px 10px 9px;
        }

        /* ARMADA */
        .armada-card {
            background: #145747;
            border: 1px solid #246b56;
            border-radius: 9px;
            padding: 12px;
            margin: 0 5px 18px;
        }

        .armada-card small {
            display: block;
            color: #b9daca;
            font-size: 10px;
            margin-bottom: 5px;
        }

        .armada-card strong {
            display: block;
            color: white;
            font-size: 12px;
        }

        .armada-card .armada-detail {
            color: #c5dfd1;
            font-size: 10px;
            margin-top: 4px;
        }

        /* MENU */
        .menu {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 12px;
            margin-bottom: 5px;
            border-radius: 7px;
            color: #e6f3eb;
            font-size: 13px;
            transition: .2s;
        }

        .menu i {
            font-size: 16px;
            width: 19px;
            text-align: center;
        }

        .menu:hover,
        .menu.active {
            background: #174f40;
            color: white;
        }

        .menu.active {
            font-weight: bold;
        }

        .sidebar-divider {
            border-top: 1px solid #285d4d;
            margin: 15px 5px;
        }

        /* KELUAR */
        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        .logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            border: none;
            border-radius: 6px;
            background: transparent;
            color: #e9f5ee;
            text-align: left;
            padding: 11px 12px;
            font-size: 13px;
            cursor: pointer;
        }

        .logout:hover {
            background: #174f40;
        }

        .sidebar-footer {
            color: #9bbcaf;
            font-size: 10px;
            padding: 12px 10px 0;
        }

        /* MAIN */
        .main {
            flex: 1;
            min-width: 0;
        }

        /* HEADER */
        .topbar {
            min-height: 72px;
            background: white;
            border-bottom: 1px solid #e4ece6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 28px;
        }

        .topbar-heading {
            min-width: 150px;
        }

        .topbar-heading small {
            display: block;
            color: #718078;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .topbar-heading strong {
            color: #203b30;
            font-size: 15px;
        }

        .topbar-tools {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 13px;
            flex: 1;
        }

        /* PENCARIAN */
        .top-search {
            width: 100%;
            max-width: 310px;
            position: relative;
        }

        .top-search input {
            width: 100%;
            height: 37px;
            background: #f1f6f3;
            border: 1px solid #e5eee8;
            border-radius: 7px;
            padding: 8px 38px 8px 34px;
            font-size: 11px;
            outline: none;
        }

        .top-search input:focus {
            border-color: #176b43;
            background: white;
            box-shadow: 0 0 0 2px rgba(23, 107, 67, .08);
        }

        .top-search .search-icon {
            position: absolute;
            left: 12px;
            top: 10px;
            color: #73857a;
            font-size: 13px;
        }

        .top-search button {
            position: absolute;
            right: 7px;
            top: 6px;
            border: none;
            background: transparent;
            color: #176b43;
        }

        /* NOTIFIKASI */
        .notification-link {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            color: #365447;
            font-size: 17px;
        }

        .notification-link:hover {
            background: #edf5ef;
            color: #176b43;
        }

        /* PROFIL */
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 8px;
            border-left: 1px solid #e6ece8;
            color: #203b30;
        }

        .user-info strong {
            font-size: 12px;
        }

        .user-info small {
            display: block;
            color: #718078;
            font-size: 10px;
            margin-top: 2px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            min-width: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e1f1e7;
            color: #176b43;
            font-weight: bold;
        }

        /* CONTENT */
        .content {
            max-width: 1600px;
            margin: auto;
            padding: 27px 30px;
        }

        .card {
            border-color: #e3ece5 !important;
            border-radius: 9px;
        }

        .btn-success {
            background: #176b43;
            border-color: #176b43;
        }

        .btn-success:hover {
            background: #125735;
            border-color: #125735;
        }

        /* RESPONSIVE */
        @media (max-width: 1000px) {
            .sidebar {
                width: 225px;
                min-width: 225px;
                flex-basis: 225px;
            }

            .topbar {
                padding: 12px 18px;
            }

            .content {
                padding: 22px 18px;
            }
        }

        @media (max-width: 768px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-width: 0;
                height: auto;
                min-height: auto;
                position: relative;
                padding: 12px;
                overflow: visible;
            }

            .brand {
                padding-bottom: 12px;
            }

            .armada-card,
            .sidebar-footer {
                display: none;
            }

            .sidebar-caption {
                margin-top: 5px;
            }

            .sidebar nav {
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
            }

            .menu {
                padding: 9px;
                margin: 0;
                font-size: 11px;
            }

            .sidebar-divider,
            .sidebar-bottom {
                display: none;
            }

            .topbar {
                flex-wrap: wrap;
                padding: 12px 15px;
                gap: 12px;
            }

            .topbar-tools {
                width: 100%;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .top-search {
                max-width: none;
                flex: 1;
                min-width: 150px;
            }

            .content {
                padding: 18px 12px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        {{-- LOGO --}}
        <div class="brand">
            <i class="bi bi-recycle"></i>

            <div>
                <div class="brand-name">SI PANTAU TPS</div>
                <div class="brand-subtitle">
                    Dinas Lingkungan Hidup Kab. Indramayu
                </div>
            </div>
        </div>

        {{-- INFORMASI ARMADA --}}
        <div class="sidebar-caption">Informasi Armada</div>

        <div class="armada-card">

            <small>
                <i class="bi bi-truck me-1"></i>
                ARMADA TERKAIT
            </small>

            @if(isset($armadaAktif) && $armadaAktif)

                <strong>{{ $armadaAktif->kode_armada }}</strong>

                <div class="armada-detail">
                    {{ $armadaAktif->nomor_polisi ?? 'Nomor polisi belum tersedia' }}
                </div>

            @else

                <strong>Belum ada armada</strong>

                <div class="armada-detail">
                    Belum terdapat penugasan armada.
                </div>

            @endif

        </div>

        {{-- MENU SUPIR --}}
        <div class="sidebar-caption">Menu Supir</div>

        <nav>

            {{-- DASHBOARD --}}
            <a href="{{ route('supir.dashboard') }}"
               class="menu {{ request()->routeIs('supir.dashboard') ? 'active' : '' }}">

                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>

            </a>

            {{-- TUGAS PENANGANAN --}}
            <a href="{{ route('supir.tugas.index') }}"
               class="menu {{ request()->routeIs('supir.tugas.index') && !request()->boolean('riwayat') ? 'active' : '' }}">

                <i class="bi bi-truck"></i>
                <span>Tugas Penanganan</span>

            </a>

            {{-- DETAIL DAN PROGRES TUGAS --}}
            <a href="{{ route('supir.tugas.aktif') }}"
               class="menu {{ request()->routeIs('supir.tugas.show', 'supir.tugas.aktif') ? 'active' : '' }}">

                <i class="bi bi-clipboard2-check"></i>
                <span>Detail & Progres Tugas</span>

            </a>

            {{-- RIWAYAT PENANGANAN --}}
            <a href="{{ route('supir.tugas.index', ['riwayat' => 1]) }}"
               class="menu {{ request()->boolean('riwayat') ? 'active' : '' }}">

                <i class="bi bi-clock-history"></i>
                <span>Riwayat Penanganan</span>

            </a>

            {{-- PROFIL --}}
            <a href="#profil-akun" class="menu">

                <i class="bi bi-person"></i>
                <span>Profil</span>

            </a>

        </nav>

        <div class="sidebar-divider"></div>

        {{-- KELUAR --}}
        <div class="sidebar-bottom">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="logout">
                    <i class="bi bi-box-arrow-left"></i>
                    Keluar Sistem
                </button>
            </form>

            <div class="sidebar-footer">
                Terminal Pengemudi DLH Indramayu
            </div>

        </div>

    </aside>

    {{-- MAIN --}}
    <main class="main">

        {{-- HEADER --}}
        <header class="topbar">

            <div class="topbar-heading">

                <small>SUPIR / KONSOL OPERASIONAL</small>

                <strong>
                    @yield('page-title', 'Dashboard Supir')
                </strong>

            </div>

            <div class="topbar-tools">

                {{-- PENCARIAN --}}
                <form action="{{ route('supir.tugas.index') }}"
                      method="GET"
                      class="top-search">

                    @if(request()->boolean('riwayat'))
                        <input type="hidden" name="riwayat" value="1">
                    @endif

                    <i class="bi bi-search search-icon"></i>

                    <input type="search"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Cari tugas, TPS, atau kode laporan...">

                    <button type="submit" title="Cari">
                        <i class="bi bi-arrow-right"></i>
                    </button>

                </form>

                {{-- PINTASAN DAFTAR TUGAS --}}
                <a href="{{ route('supir.tugas.index') }}"
                   class="notification-link"
                   title="Buka daftar tugas">

                    <i class="bi bi-bell"></i>

                </a>

                {{-- PROFIL AKUN --}}
                <div class="user-info" id="profil-akun">

                    <div>
                        <strong>
                            {{ auth()->user()->name ?? 'Supir' }}
                        </strong>

                        <small>Area Supir</small>
                    </div>

                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'S', 0, 1)) }}
                    </div>

                </div>

            </div>

        </header>

        {{-- KONTEN HALAMAN --}}
        <section class="content">
            @yield('content')
        </section>

    </main>

</div>

</body>
</html>
