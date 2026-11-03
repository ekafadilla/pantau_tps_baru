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
    /* UPTD-NAV-MODERN-V2 */

/* Layout dan ukuran dasar */
html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    color: #26382f;
    background: #f4f7f5;
}

body { overflow: hidden; }

.layout {
    display: flex;
    width: 100%;
    height: 100vh;
    min-height: 0;
    overflow: hidden;
}

/* Sidebar */
.sidebar {
    position: fixed;
    z-index: 1000;
    inset: 0 auto 0 0;
    display: flex;
    flex-direction: column;
    width: 235px;
    min-width: 235px;
    height: 100vh;
    padding: 22px 15px;
    overflow-y: auto;
    background: #176b43;
    color: #fff;
    box-shadow: 3px 0 18px rgba(20,70,43,.08);
    transition: transform .28s ease;
}

.brand {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 8px 9px 30px;
    color: white;
    font-size: 16px;
    font-weight: 700;
}

.brand i { font-size: 24px; }

.menu-title {
    margin: 8px 10px 13px;
    color: #c6dfd0;
    font-size: 10px;
    letter-spacing: 1.2px;
}

.menu {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 42px;
    padding: 11px 12px;
    margin-bottom: 6px;
    border-radius: 8px;
    color: #fff;
    font-size: 12px;
    transition: background .2s ease, transform .2s ease;
}

.menu i {
    width: 18px;
    font-size: 16px;
    text-align: center;
}

.menu:hover {
    color: #fff;
    background: rgba(255,255,255,.13);
    transform: translateX(3px);
}

.menu.active {
    color: #fff;
    background: #2c8058;
    box-shadow: inset 3px 0 #d8f0df;
}

.sidebar-bottom {
    margin-top: auto;
    padding-top: 18px;
    border-top: 1px solid #438563;
}

.logout {
    width: 100%;
    padding: 10px 12px;
    border: 0;
    border-radius: 7px;
    background: #fff;
    color: #176b43;
    font-size: 12px;
    text-align: left;
    cursor: pointer;
    transition: background .2s, transform .2s;
}

.logout:hover {
    background: #e8f4eb;
    transform: translateY(-1px);
}

/* Area utama */
.main {
    display: flex;
    flex-direction: column;
    width: calc(100% - 235px);
    height: 100vh;
    min-width: 0;
    margin-left: 235px;
    overflow: hidden;
}

/* Navbar tetap di atas */
.topbar {
    position: relative;
    z-index: 100;
    display: flex;
    flex: 0 0 66px;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 66px;
    min-height: 66px;
    padding: 0 28px;
    gap: 12px;
    background: #fff;
    border-bottom: 1px solid #e8eee9;
    box-shadow: 0 2px 10px rgba(30,60,40,.025);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.topbar-title {
    margin: 0;
    color: #26382f;
    font-size: 17px;
    font-weight: 700;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 12px;
    white-space: nowrap;
}

.user-info strong { font-size: 12px; }
.user-info span { color: #718078; font-size: 11px; }

.avatar {
    display: flex;
    flex: 0 0 34px;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #e2f1e7;
    color: #176b43;
    font-size: 14px;
    font-weight: 700;
}

/* Tombol menu mobile */
.menu-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    border: 1px solid #e1e9e3;
    border-radius: 7px;
    background: white;
    color: #176b43;
    font-size: 19px;
    cursor: pointer;
    transition: background .2s, transform .2s;
}

.menu-toggle:hover {
    background: #e8f4eb;
    transform: scale(1.04);
}

.sidebar-overlay { display: none; }

/* Konten halaman dapat digulir sendiri */
.content {
    flex: 1;
    width: 100%;
    max-width: 1500px;
    min-height: 0;
    margin: 0 auto;
    padding: 22px 28px;
    overflow-y: auto;
    background: #f4f7f5;
}

.content > .container-fluid {
    padding: 0 !important;
}

/* =================================
   HALAMAN DATA LAPORAN
================================= */

.uptd-report-page {
    padding: 0 !important;
}

.uptd-report-page h3 {
    margin: 0 0 6px !important;
    color: #26382f;
    font-size: 20px !important;
    font-weight: 700;
}

.uptd-report-page > .d-flex:first-child {
    margin-bottom: 20px !important;
}

.uptd-report-page .text-muted {
    color: #78857c !important;
    font-size: 12px;
}

.uptd-report-page .row.g-3 {
    --bs-gutter-x: 12px;
    --bs-gutter-y: 12px;
    margin-bottom: 18px !important;
}

.uptd-report-page .card {
    height: 100%;
    border: 1px solid #e1e9e3 !important;
    border-radius: 10px !important;
    background: #fff;
    box-shadow: 0 3px 12px rgba(30,60,40,.025) !important;
    transition: transform .2s ease, box-shadow .2s ease;
}

.uptd-report-page .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 16px rgba(30,60,40,.06) !important;
}

.uptd-report-page .card-body {
    padding: 16px !important;
}

.uptd-report-page .card-body .small {
    font-size: 11px !important;
}

.uptd-report-page .card-body .fs-3 {
    margin-top: 5px;
    color: #176b43;
    font-size: 23px !important;
    font-weight: 700;
}

/* Form pencarian dan filter */
.uptd-report-page > .card {
    border: 1px solid #e1e9e3 !important;
    border-radius: 10px !important;
    background: #fff;
    box-shadow: 0 3px 12px rgba(30,60,40,.025) !important;
}

.uptd-report-page > .card > .card-body {
    padding: 17px !important;
}

.uptd-report-page form {
    align-items: center;
}

.uptd-report-page .form-control,
.uptd-report-page .form-select {
    min-height: 38px;
    border: 1px solid #dfe8e1;
    border-radius: 7px;
    color: #26382f;
    font-size: 12px;
    box-shadow: none;
}

.uptd-report-page .form-control:focus,
.uptd-report-page .form-select:focus {
    border-color: #2c8058;
    box-shadow: 0 0 0 3px rgba(44,128,88,.10);
}

.uptd-report-page .btn {
    min-height: 36px;
    border-radius: 7px;
    font-size: 11px;
    transition: all .2s ease;
}

.uptd-report-page .btn-success {
    border-color: #176b43;
    background: #176b43;
}

.uptd-report-page .btn-success:hover {
    border-color: #125735;
    background: #125735;
    transform: translateY(-1px);
}

.uptd-report-page .btn-outline-secondary {
    border-color: #dfe8e1;
    color: #59685e;
}

.uptd-report-page .btn-outline-secondary:hover {
    background: #f0f5f1;
    color: #176b43;
}

/* Tabel laporan */
.uptd-report-page .table-responsive {
    border: 1px solid #edf1ee;
    border-radius: 8px;
}

.uptd-report-page .table {
    min-width: 760px;
    margin-bottom: 0;
    font-size: 11px;
}

.uptd-report-page .table thead th {
    padding: 12px 13px;
    border-bottom: 1px solid #e5ece6;
    background: #f7faf7;
    color: #647168;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.uptd-report-page .table tbody td {
    padding: 12px 13px;
    border-color: #edf1ee;
    color: #35463b;
    vertical-align: middle;
}

.uptd-report-page .table tbody tr {
    transition: background .18s ease;
}

.uptd-report-page .table-hover tbody tr:hover > * {
    background: #f5faf6;
}

.uptd-report-page .badge {
    padding: 6px 9px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
}

.uptd-report-page .btn-outline-success {
    border-color: #2c8058;
    color: #176b43;
}

.uptd-report-page .btn-outline-success:hover {
    background: #176b43;
    color: white;
}

/* Pagination */
.uptd-report-page .pagination {
    gap: 4px;
    margin-bottom: 0;
}

.uptd-report-page .page-link {
    min-width: 30px;
    padding: 6px 10px;
    border: 1px solid #e1e9e3;
    border-radius: 6px !important;
    color: #176b43;
    font-size: 11px;
}

.uptd-report-page .page-item.active .page-link {
    border-color: #176b43;
    background: #176b43;
    color: white;
}

/* Notifikasi */
.uptd-report-page .alert {
    padding: 11px 14px;
    border-radius: 8px;
    font-size: 12px;
}

/* Responsif */
@media (max-width: 900px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.show {
        transform: translateX(0);
    }

    .main {
        width: 100%;
        margin-left: 0;
    }

    .menu-toggle {
        display: inline-flex;
    }

    .sidebar-overlay.show {
        position: fixed;
        z-index: 999;
        inset: 0;
        display: block;
        background: rgba(20,35,25,.38);
        animation: overlayFade .2s ease;
    }

    .content { padding: 20px 16px; }
}

@media (max-width: 650px) {
    .topbar {
        height: 60px;
        min-height: 60px;
        flex-basis: 60px;
        padding: 0 13px;
    }

    .topbar-title { font-size: 14px; }
    .user-info { gap: 6px; }
    .user-info strong {
        display: block;
        max-width: 125px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .avatar {
        width: 30px;
        height: 30px;
        flex-basis: 30px;
    }

    .content { padding: 16px 12px; }
    .uptd-report-page h3 { font-size: 18px !important; }
    .uptd-report-page > .card > .card-body { padding: 12px !important; }
}

@keyframes overlayFade {
    from { opacity: 0; }
    to { opacity: 1; }
}
/* UPTD-FINAL-CONSISTENT */

/* Ukuran layout disamakan dengan dashboard */
html, body {
    height: 100%;
}

body {
    overflow: hidden !important;
    background: #f4f7f5 !important;
}

.layout {
    display: flex !important;
    width: 100% !important;
    height: 100vh !important;
    min-height: 0 !important;
    overflow: hidden !important;
}

.sidebar {
    position: fixed !important;
    display: flex !important;
    flex-direction: column !important;
    top: 0 !important;
    left: 0 !important;
    width: 235px !important;
    min-width: 235px !important;
    height: 100vh !important;
    padding: 22px 15px !important;
    transform: translateX(0);
    transition: transform .28s ease !important;
}

.main {
    display: flex !important;
    flex-direction: column !important;
    width: calc(100% - 235px) !important;
    height: 100vh !important;
    min-width: 0 !important;
    margin-left: 235px !important;
    overflow: hidden !important;
}

.topbar {
    position: sticky !important;
    top: 0 !important;
    z-index: 1000 !important;
    display: flex !important;
    flex: 0 0 66px !important;
    align-items: center !important;
    justify-content: space-between !important;
    width: 100% !important;
    height: 66px !important;
    min-height: 66px !important;
    padding: 0 28px !important;
    background: #fff !important;
    border-bottom: 1px solid #e8eee9 !important;
    box-shadow: 0 2px 10px rgba(30,60,40,.025) !important;
}

.topbar-left {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.topbar-title {
    margin: 0 !important;
    font-size: 17px !important;
    font-weight: 700 !important;
    color: #26382f !important;
}

.sidebar-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    width: 35px !important;
    height: 35px !important;
    border: 1px solid #e1e9e3 !important;
    border-radius: 7px !important;
    background: #fff !important;
    color: #176b43 !important;
    transition: background .2s, transform .2s;
}

.sidebar-toggle:hover {
    background: #e2f1e7 !important;
    transform: scale(1.04);
}

.user-info {
    display: flex !important;
    align-items: center !important;
    gap: 9px !important;
}

.avatar {
    width: 34px !important;
    height: 34px !important;
    flex: 0 0 34px !important;
    border-radius: 50% !important;
    background: #e2f1e7 !important;
    color: #176b43 !important;
}

.content {
    flex: 1 !important;
    width: 100% !important;
    max-width: none !important;
    min-height: 0 !important;
    padding: 22px 28px !important;
    overflow-y: auto !important;
    background: #f4f7f5 !important;
}

/* Kartu ringkasan */
.uptd-report-page .summary-card {
    position: relative;
    min-height: 116px;
    overflow: hidden;
    border: 1px solid #e1e9e3 !important;
    border-radius: 11px !important;
    background: #fff !important;
    box-shadow: 0 3px 12px rgba(30,60,40,.035) !important;
    transition: transform .22s ease, box-shadow .22s ease;
}

.uptd-report-page .summary-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(30,60,40,.08) !important;
}

.uptd-report-page .summary-card .card-body {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 17px 18px !important;
}

.uptd-report-page .summary-label {
    margin-bottom: 7px;
    color: #718078;
    font-size: 11px;
    font-weight: 600;
}

.uptd-report-page .summary-number {
    color: #26382f;
    font-size: 25px;
    font-weight: 700;
    line-height: 1.2;
}

.uptd-report-page .summary-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 43px;
    height: 43px;
    flex: 0 0 43px;
    border-radius: 12px;
    font-size: 19px;
}

.uptd-report-page .summary-card::after {
    content: "";
    position: absolute;
    right: -22px;
    bottom: -34px;
    width: 90px;
    height: 90px;
    border: 13px solid rgba(23,107,67,.045);
    border-radius: 50%;
}

/* Tombol Detail */
.uptd-report-page .btn-detail {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-width: 82px;
    min-height: 33px;
    padding: 7px 11px !important;
    border: 1px solid #176b43 !important;
    border-radius: 7px !important;
    background: #f5faf6 !important;
    color: #176b43 !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    text-decoration: none;
    transition: all .2s ease;
}

.uptd-report-page .btn-detail:hover {
    background: #176b43 !important;
    color: #fff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 9px rgba(23,107,67,.15);
}

.uptd-report-page .btn-detail i {
    font-size: 12px;
}

/* Responsif: gunakan sistem sidebar bawaan layout */
@media (max-width: 768px) {
    .sidebar {
        z-index: 1050 !important;
        transform: translateX(-100%) !important;
    }

    body.sidebar-open .sidebar {
        transform: translateX(0) !important;
    }

    .main {
        width: 100% !important;
        margin-left: 0 !important;
    }

    .sidebar-toggle {
        display: inline-flex !important;
    }

    .topbar {
        flex-basis: 65px !important;
        height: 65px !important;
        min-height: 65px !important;
        padding: 0 15px !important;
    }

    .content {
        padding: 20px 15px !important;
    }
}

@media (max-width: 480px) {
    .topbar {
        flex-basis: 60px !important;
        height: 60px !important;
        min-height: 60px !important;
    }

    .topbar-title { font-size: 15px !important; }
    .content { padding: 16px 12px !important; }

    .uptd-report-page .summary-card { min-height: 100px; }
    .uptd-report-page .summary-card .card-body { padding: 13px !important; }
    .uptd-report-page .summary-icon {
        width: 36px;
        height: 36px;
        flex-basis: 36px;
        font-size: 16px;
    }
    .uptd-report-page .summary-number { font-size: 21px; }
}
</style>
    @stack('styles')
</head>

<body>
<div class="layout">

    <aside class="sidebar" id="uptdSidebar">
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
<script>
    function toggleUptdSidebar() {
        document.getElementById('uptdSidebar').classList.toggle('show');
        document.getElementById('uptdSidebarOverlay').classList.toggle('show');
    }

    function closeUptdSidebar() {
        document.getElementById('uptdSidebar').classList.remove('show');
        document.getElementById('uptdSidebarOverlay').classList.remove('show');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') closeUptdSidebar();
    });

    document.querySelectorAll('#uptdSidebar .menu').forEach(function(menu) {
        menu.addEventListener('click', function() {
            if (window.innerWidth <= 900) closeUptdSidebar();
        });
    });
</script>
</body>
</html>
