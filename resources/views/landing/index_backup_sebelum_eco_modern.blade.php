
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SI Pantau TPS | DLH Kabupaten Indramayu</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f9f7;
            color: #26352c;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button, input {
            font: inherit;
        }

        .container {
            width: 90%;
            max-width: 1180px;
            margin: auto;
        }

        /* NAVBAR */
        .navbar {
            background: #fff;
            border-bottom: 1px solid #e5ebe6;
        }

        .navbar-content {
            min-height: 76px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #176b43;
            color: #fff;
            border-radius: 9px;
            font-size: 23px;
        }

        .brand h2 {
            font-size: 19px;
            color: #176b43;
            line-height: 1.3;
        }

        .brand p {
            font-size: 11px;
            color: #68766d;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 27px;
        }

        .nav-links a {
            font-size: 14px;
            color: #4c5b51;
        }

        .nav-links a:hover {
            color: #176b43;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 17px;
            border-radius: 6px;
            font-size: 13px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-outline {
            border-color: #176b43;
            color: #176b43;
            background: #fff;
        }

        .btn-outline:hover {
            background: #f0f7f2;
        }

        .btn-primary {
            background: #176b43;
            color: #fff;
        }

        .btn-primary:hover {
            background: #105534;
        }

        .btn-white {
            background: #fff;
            color: #176b43;
            white-space: nowrap;
        }

        .btn-white:hover {
            background: #edf5ef;
        }

        /* HERO */
        .hero {
            background: #edf5ef;
            padding: 62px 0;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            gap: 45px;
        }

        .eyebrow {
            display: inline-block;
            background: #dcece0;
            color: #176b43;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .hero h1 {
            font-size: clamp(30px, 4vw, 43px);
            line-height: 1.25;
            color: #1e3828;
            margin-bottom: 17px;
            max-width: 570px;
        }

        .hero-description {
            color: #5b6a60;
            font-size: 15px;
            max-width: 530px;
            margin-bottom: 25px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-image {
            width: 100%;
            height: 330px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
        }

        .hero-caption {
            color: #68766d;
            font-size: 12px;
            margin-top: 9px;
            text-align: right;
        }

        /* SECTION */
        .section {
            padding: 58px 0;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 20px;
            margin-bottom: 25px;
        }

        .section-heading h2 {
            font-size: 25px;
            color: #263d2d;
            margin-bottom: 5px;
        }

        .section-heading p {
            font-size: 14px;
            color: #748078;
        }

        /* STATISTIK */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: -28px;
            position: relative;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e7ece8;
            border-radius: 9px;
            padding: 23px;
            box-shadow: 0 4px 12px rgba(25, 65, 39, 0.04);
        }

        .stat-label {
            color: #748078;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .stat-value {
            color: #176b43;
            font-size: 30px;
            font-weight: bold;
            line-height: 1.3;
        }

        .stat-note {
            color: #7a857e;
            font-size: 12px;
            margin-top: 7px;
        }

        /* PENCARIAN TPS */
        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .search-input {
            flex: 1;
            min-width: 0;
            padding: 12px 14px;
            border: 1px solid #dce4dd;
            background: #fff;
            border-radius: 6px;
            outline: none;
        }

        .search-input:focus {
            border-color: #176b43;
        }

        /* KARTU TPS */
        .tps-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }

        .tps-card {
            background: #fff;
            border: 1px solid #e4eae5;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .tps-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 18px rgba(25, 65, 39, 0.08);
        }

        .tps-image {
            width: 100%;
            height: 155px;
            overflow: hidden;
            background: #e5ece6;
        }

        .tps-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .tps-content {
            padding: 17px;
        }

        .status {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .status-active {
            background: #e1f3e6;
            color: #207344;
        }

        .status-process {
            background: #fff0d6;
            color: #93610b;
        }

        .tps-content h3 {
            font-size: 15px;
            margin-bottom: 8px;
            color: #293d30;
        }

        .tps-location {
            color: #78837b;
            font-size: 12px;
            margin-bottom: 13px;
        }

        .tps-location i {
            color: #176b43;
            margin-right: 4px;
        }

        .tps-detail {
            display: block;
            text-align: center;
            padding: 9px;
            border: 1px solid #176b43;
            color: #176b43;
            border-radius: 5px;
            font-size: 12px;
        }

        .tps-detail:hover {
            background: #176b43;
            color: #fff;
        }

        .empty-result {
            display: none;
            padding: 25px;
            background: #fff;
            border: 1px solid #e4eae5;
            border-radius: 8px;
            color: #68766d;
            text-align: center;
            margin-top: 15px;
        }

        .data-note {
            font-size: 12px;
            color: #7a857e;
            margin-top: 15px;
        }

        /* BANNER PENGADUAN */
        .complaint-banner {
            background: #176b43;
            color: #fff;
            border-radius: 10px;
            padding: 35px 38px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
        }

        .complaint-banner h2 {
            font-size: 23px;
            margin-bottom: 8px;
        }

        .complaint-banner p {
            color: #e0eee4;
            font-size: 14px;
            max-width: 650px;
        }

        /* INFORMASI LAYANAN */
        .information-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .information-card {
            background: #fff;
            border: 1px solid #e5ebe6;
            border-radius: 8px;
            padding: 25px;
        }

        .information-card .icon {
            color: #176b43;
            font-size: 28px;
            margin-bottom: 13px;
        }

        .information-card h3 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .information-card p {
            color: #748078;
            font-size: 13px;
        }

        /* FOOTER */
        .footer {
            background: #183c29;
            color: #fff;
            padding: 35px 0 18px;
            margin-top: 58px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 30px;
            padding-bottom: 25px;
        }

        .footer h3 {
            font-size: 17px;
            margin-bottom: 10px;
        }

        .footer p,
        .footer a {
            color: #d1dfd5;
            font-size: 13px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid #42604c;
            padding-top: 16px;
            text-align: center;
            color: #d1dfd5;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 950px) {
            .navbar-content {
                flex-wrap: wrap;
                padding: 15px 0;
            }

            .nav-links {
                order: 3;
                width: 100%;
                justify-content: center;
                gap: 20px;
            }

            .hero-content {
                gap: 25px;
            }

            .tps-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 650px) {
            .container {
                width: 92%;
            }

            .brand h2 {
                font-size: 16px;
            }

            .nav-actions {
                gap: 6px;
            }

            .nav-actions .btn {
                padding: 8px 10px;
                font-size: 12px;
            }

            .nav-links {
                justify-content: flex-start;
                overflow-x: auto;
                padding: 5px 0;
                gap: 22px;
            }

            .nav-links a {
                white-space: nowrap;
            }

            .hero {
                padding: 40px 0;
            }

            .hero-content {
                grid-template-columns: 1fr;
            }

            .hero-image {
                height: 230px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                margin-top: 20px;
            }

            .section {
                padding: 42px 0;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .search-box {
                flex-direction: column;
            }

            .search-box .btn {
                width: 100%;
            }

            .tps-grid {
                grid-template-columns: 1fr;
            }

            .complaint-banner {
                align-items: flex-start;
                flex-direction: column;
                padding: 25px;
            }

            .information-grid,
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    
/* ==========================================
   LANDING PAGE REDESIGN - SI PANTAU TPS
========================================== */

:root {
    --green-dark: #124b32;
    --green-main: #176b43;
    --green-light: #e8f3eb;
    --text-main: #20382b;
    --text-muted: #718078;
    --surface: #ffffff;
    --border-soft: #e5ece7;
}

html {
    scroll-behavior: smooth;
    scroll-padding-top: 90px;
}

body {
    background: #f7f9f7;
    color: var(--text-main);
    overflow-x: hidden;
}

.container {
    max-width: 1220px;
}

/* NAVBAR */
.navbar {
    position: sticky;
    top: 0;
    z-index: 999;
    background: rgba(255,255,255,.96);
    backdrop-filter: blur(12px);
    box-shadow: 0 3px 18px rgba(20,60,35,.045);
}

.navbar-content {
    min-height: 78px;
}

.brand-icon {
    width: 46px;
    height: 46px;
    border-radius: 13px;
    background: linear-gradient(145deg,#238653,#125333);
    box-shadow: 0 5px 12px rgba(23,107,67,.2);
}

.brand h2 {
    letter-spacing: .3px;
    font-size: 18px;
    font-weight: 800;
}

.nav-links {
    gap: 30px;
}

.nav-links a {
    position: relative;
    font-weight: 600;
    transition: color .2s;
}

.nav-links a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -8px;
    width: 0;
    height: 2px;
    background: var(--green-main);
    transition: width .2s;
}

.nav-links a:hover::after {
    width: 100%;
}

.btn {
    border-radius: 8px;
    font-weight: 600;
    padding: 11px 19px;
    transition: all .2s ease;
}

.btn-primary {
    background: linear-gradient(135deg,#218451,#176b43);
    box-shadow: 0 5px 12px rgba(23,107,67,.13);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 17px rgba(23,107,67,.2);
}

.btn-outline:hover {
    transform: translateY(-2px);
}

/* HERO */
.hero {
    position: relative;
    overflow: hidden;
    padding: 82px 0 88px;
    background:
        radial-gradient(circle at 88% 12%,rgba(181,218,190,.42),transparent 30%),
        linear-gradient(120deg,#eff7f0 0%,#f7faf7 55%,#e8f3eb 100%);
}

.hero::before {
    content: "";
    position: absolute;
    width: 360px;
    height: 360px;
    border: 1px solid rgba(23,107,67,.08);
    border-radius: 50%;
    right: -130px;
    bottom: -220px;
}

.hero-content {
    position: relative;
    z-index: 1;
    gap: 65px;
}

.eyebrow {
    padding: 8px 14px;
    border-radius: 30px;
    background: #dcefe1;
    letter-spacing: .7px;
    font-size: 11px;
}

.hero h1 {
    max-width: 590px;
    font-size: clamp(34px,4.3vw,52px);
    line-height: 1.16;
    letter-spacing: -1.3px;
    font-weight: 800;
    margin-bottom: 21px;
}

.hero-description {
    font-size: 15px;
    line-height: 1.85;
    max-width: 540px;
    color: #607168;
}

.hero-buttons {
    gap: 13px;
}

.hero-image {
    height: 370px;
    border-radius: 20px;
    box-shadow: 0 20px 45px rgba(25,65,39,.15);
    outline: 7px solid rgba(255,255,255,.55);
}

.hero-caption {
    margin-top: 15px;
    font-size: 11px;
    text-align: center;
}

/* STATISTIK */
.stats-grid {
    gap: 22px;
    margin-top: -35px;
    z-index: 5;
}

.stat-card {
    position: relative;
    overflow: hidden;
    padding: 27px;
    border: 1px solid #e8eee9;
    border-radius: 14px;
    box-shadow: 0 9px 25px rgba(30,65,42,.07);
    transition: transform .2s, box-shadow .2s;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(30,65,42,.1);
}

.stat-card::after {
    content: "";
    position: absolute;
    width: 85px;
    height: 85px;
    right: -27px;
    top: -27px;
    border-radius: 50%;
    background: #eff7f0;
}

.stat-card:nth-child(2)::after {
    background: #eaf4ed;
}

.stat-card:nth-child(3)::after {
    background: #edf2e8;
}

.stat-label {
    position: relative;
    z-index: 1;
    font-weight: 600;
}

.stat-value {
    position: relative;
    z-index: 1;
    font-size: 36px;
    letter-spacing: -.8px;
}

.stat-note {
    position: relative;
    z-index: 1;
}

/* SECTION */
.section {
    padding: 76px 0;
}

.section-heading {
    margin-bottom: 30px;
}

.section-heading h2 {
    font-size: 27px;
    font-weight: 800;
    letter-spacing: -.5px;
}

.section-heading p {
    line-height: 1.7;
}

/* PENCARIAN TPS */
.search-box {
    padding: 8px;
    gap: 12px;
    border: 1px solid var(--border-soft);
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 5px 18px rgba(30,65,42,.035);
}

.search-input {
    border: none;
    padding: 13px 15px;
    background: transparent;
}

.search-input:focus {
    border: none;
    box-shadow: none;
}

/* KARTU TPS */
.tps-grid {
    gap: 23px;
}

.tps-card {
    border: 1px solid #e8eee9;
    border-radius: 13px;
    box-shadow: 0 5px 18px rgba(30,65,42,.045);
    transition: transform .25s, box-shadow .25s;
}

.tps-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 28px rgba(30,65,42,.1);
}

.tps-image {
    height: 175px;
}

.tps-image img {
    transition: transform .4s ease;
}

.tps-card:hover .tps-image img {
    transform: scale(1.045);
}

.tps-content {
    padding: 20px;
}

.status {
    border-radius: 20px;
    padding: 5px 11px;
}

.tps-content h3 {
    font-size: 16px;
    font-weight: 700;
}

.tps-detail {
    border-radius: 7px;
    font-weight: 600;
    padding: 10px;
    transition: .2s;
}

.data-note {
    padding: 13px 15px;
    background: #f0f5f1;
    border-left: 3px solid #83ad8e;
    border-radius: 5px;
    line-height: 1.7;
}

/* BANNER PENGADUAN */
.complaint-banner {
    position: relative;
    overflow: hidden;
    padding: 43px 45px;
    border-radius: 17px;
    background:
        radial-gradient(circle at 95% 10%,rgba(255,255,255,.13),transparent 27%),
        linear-gradient(115deg,#155c39,#20784c);
    box-shadow: 0 12px 30px rgba(23,107,67,.14);
}

.complaint-banner h2 {
    font-size: 27px;
    font-weight: 800;
}

.complaint-banner p {
    line-height: 1.8;
}

.btn-white {
    border-radius: 8px;
    padding: 13px 20px;
    font-weight: 700;
}

/* INFORMASI */
.information-grid {
    gap: 23px;
}

.information-card {
    border-radius: 13px;
    padding: 28px;
    box-shadow: 0 5px 18px rgba(30,65,42,.035);
    transition: transform .2s, box-shadow .2s;
}

.information-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 13px 25px rgba(30,65,42,.08);
}

.information-card .icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 54px;
    height: 54px;
    border-radius: 13px;
    background: #eaf4ed;
    font-size: 25px;
}

.information-card h3 {
    font-weight: 700;
    margin-bottom: 10px;
}

.information-card p {
    line-height: 1.8;
}

/* FOOTER */
.footer {
    margin-top: 80px;
    padding: 48px 0 20px;
    background: linear-gradient(135deg,#153d2a,#102f21);
}

.footer h3 {
    font-weight: 700;
}

.footer p {
    max-width: 470px;
    line-height: 1.8;
}

.footer-links a {
    transition: padding .2s;
}

.footer-links a:hover {
    padding-left: 5px;
}

/* RESPONSIVE */
@media (max-width: 950px) {
    .hero {
        padding: 65px 0;
    }

    .hero-content {
        gap: 35px;
    }

    .hero-image {
        height: 300px;
    }

    .stats-grid {
        margin-top: -20px;
    }
}

@media (max-width: 650px) {
    .navbar-content {
        gap: 12px;
    }

    .nav-links {
        order: 3;
        width: 100%;
        padding: 8px 0 3px;
    }

    .hero {
        padding: 48px 0 55px;
    }

    .hero h1 {
        font-size: 35px;
        letter-spacing: -.7px;
    }

    .hero-description {
        font-size: 14px;
    }

    .hero-image {
        height: 235px;
        border-radius: 14px;
    }

    .hero-buttons {
        flex-direction: column;
    }

    .hero-buttons .btn {
        width: 100%;
    }

    .stats-grid {
        gap: 13px;
        margin-top: 20px;
    }

    .stat-card {
        padding: 21px;
    }

    .stat-value {
        font-size: 31px;
    }

    .section {
        padding: 53px 0;
    }

    .section-heading h2 {
        font-size: 23px;
    }

    .search-box {
        padding: 7px;
    }

    .tps-image {
        height: 190px;
    }

    .complaint-banner {
        padding: 28px 23px;
        border-radius: 13px;
    }

    .complaint-banner h2 {
        font-size: 23px;
    }

    .information-card {
        padding: 23px;
    }

    .footer {
        margin-top: 55px;
    }
}

@media (max-width: 380px) {
    .brand h2 {
        font-size: 14px;
    }

    .brand p {
        font-size: 10px;
    }

    .brand-icon {
        width: 39px;
        height: 39px;
    }

    .nav-actions .btn {
        padding: 8px;
        font-size: 11px;
    }

    .hero h1 {
        font-size: 30px;
    }
}

    
/* =================================
   COMPACT MODERN LANDING REDESIGN
================================= */

body {
    font-family: "Inter", "Segoe UI", Arial, sans-serif;
    background: #ffffff;
    color: #27382e;
    font-size: 13px;
}

/* NAVBAR */
.navbar {
    position: sticky;
    top: 0;
    background: rgba(255,255,255,.97);
    box-shadow: none;
    border-bottom: 1px solid #edf0ed;
}

.navbar-content {
    min-height: 66px;
}

.brand {
    gap: 9px;
}

.brand-icon {
    width: 37px;
    height: 37px;
    border-radius: 9px;
    font-size: 19px;
    box-shadow: none;
}

.brand h2 {
    font-size: 15px;
    letter-spacing: 0;
}

.brand p {
    font-size: 10px;
}

.nav-links {
    gap: 25px;
}

.nav-links a {
    font-size: 12px;
    font-weight: 500;
}

.nav-links a::after {
    display: none;
}

.nav-actions .btn {
    padding: 8px 14px;
    font-size: 12px;
    border-radius: 6px;
    box-shadow: none;
}

/* HERO */
.hero {
    padding: 55px 0 60px;
    background: #f5f8f5;
}

.hero-content {
    grid-template-columns: 1.05fr .95fr;
    gap: 55px;
}

.eyebrow {
    padding: 5px 10px;
    margin-bottom: 14px;
    border-radius: 4px;
    font-size: 10px;
    letter-spacing: .4px;
}

.hero h1 {
    max-width: 490px;
    margin-bottom: 14px;
    font-size: clamp(28px, 3.2vw, 39px);
    line-height: 1.22;
    letter-spacing: -.8px;
}

.hero-description {
    max-width: 465px;
    margin-bottom: 20px;
    font-size: 13px;
    line-height: 1.8;
}

.hero-buttons {
    gap: 9px;
}

.hero-buttons .btn {
    padding: 10px 14px;
    font-size: 12px;
    border-radius: 6px;
}

.hero-image {
    height: 285px;
    border-radius: 9px;
    outline: none;
    box-shadow: none;
}

.hero-caption {
    margin-top: 8px;
    font-size: 10px;
}

/* STATISTIK */
.stats-grid {
    margin-top: -22px;
    gap: 14px;
}

.stat-card {
    padding: 18px 20px;
    border: 1px solid #e9eeea;
    border-radius: 8px;
    box-shadow: none;
}

.stat-card:hover {
    transform: none;
    box-shadow: none;
}

.stat-card::after {
    display: none;
}

.stat-label {
    margin-bottom: 5px;
    font-size: 11px;
}

.stat-value {
    font-size: 26px;
    letter-spacing: 0;
}

.stat-note {
    margin-top: 4px;
    font-size: 10px;
}

/* SECTION */
.section {
    padding: 52px 0;
}

.section-heading {
    margin-bottom: 22px;
}

.section-heading h2 {
    margin-bottom: 4px;
    font-size: 21px;
    letter-spacing: -.3px;
}

.section-heading p {
    font-size: 12px;
}

/* SEARCH */
.search-box {
    padding: 5px;
    gap: 7px;
    margin-bottom: 20px;
    border-radius: 7px;
    box-shadow: none;
}

.search-input {
    padding: 10px 12px;
    font-size: 12px;
}

.search-box .btn {
    padding: 9px 14px;
    font-size: 12px;
}

/* TPS CARDS */
.tps-grid {
    gap: 16px;
}

.tps-card {
    border-radius: 8px;
    box-shadow: none;
}

.tps-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(30,65,42,.06);
}

.tps-image {
    height: 135px;
}

.tps-content {
    padding: 14px;
}

.status {
    padding: 4px 8px;
    font-size: 10px;
}

.tps-content h3 {
    margin-bottom: 6px;
    font-size: 13px;
}

.tps-location {
    margin-bottom: 11px;
    font-size: 11px;
}

.tps-detail {
    padding: 8px;
    font-size: 11px;
    border-radius: 5px;
}

.data-note {
    margin-top: 13px;
    padding: 10px 12px;
    font-size: 10px;
}

/* COMPLAINT BANNER */
.complaint-banner {
    padding: 27px 30px;
    border-radius: 9px;
    box-shadow: none;
}

.complaint-banner h2 {
    margin-bottom: 6px;
    font-size: 20px;
}

.complaint-banner p {
    font-size: 12px;
    line-height: 1.7;
}

.complaint-banner .btn {
    padding: 10px 14px;
    font-size: 11px;
}

/* INFORMATION */
.information-grid {
    gap: 15px;
}

.information-card {
    padding: 19px;
    border-radius: 8px;
    box-shadow: none;
}

.information-card:hover {
    transform: none;
    box-shadow: none;
}

.information-card .icon {
    width: 40px;
    height: 40px;
    margin-bottom: 11px;
    border-radius: 7px;
    font-size: 19px;
}

.information-card h3 {
    margin-bottom: 6px;
    font-size: 13px;
}

.information-card p {
    font-size: 11px;
    line-height: 1.7;
}

/* FOOTER */
.footer {
    margin-top: 45px;
    padding: 35px 0 17px;
    background: #183c29;
}

.footer h3 {
    font-size: 14px;
}

.footer p,
.footer a {
    font-size: 11px;
}

.footer-bottom {
    font-size: 10px;
}

/* TABLET */
@media (max-width: 950px) {
    .hero-content {
        gap: 28px;
    }

    .hero-image {
        height: 250px;
    }
}

/* MOBILE */
@media (max-width: 650px) {
    .navbar-content {
        min-height: auto;
        padding: 11px 0;
    }

    .nav-links {
        gap: 20px;
    }

    .hero {
        padding: 37px 0 42px;
    }

    .hero-content {
        gap: 24px;
    }

    .hero h1 {
        font-size: 30px;
    }

    .hero-image {
        height: 215px;
    }

    .hero-buttons {
        flex-direction: row;
    }

    .hero-buttons .btn {
        flex: 1;
        padding: 10px 8px;
        font-size: 11px;
    }

    .stats-grid {
        grid-template-columns: repeat(3,minmax(0,1fr));
        gap: 8px;
        margin-top: 15px;
    }

    .stat-card {
        padding: 12px 9px;
    }

    .stat-label {
        font-size: 9px;
    }

    .stat-value {
        font-size: 20px;
    }

    .stat-note {
        font-size: 9px;
    }

    .section {
        padding: 39px 0;
    }

    .section-heading h2 {
        font-size: 19px;
    }

    .tps-grid {
        grid-template-columns: repeat(2,minmax(0,1fr));
        gap: 11px;
    }

    .tps-image {
        height: 115px;
    }

    .tps-content {
        padding: 11px;
    }

    .tps-content h3 {
        font-size: 12px;
    }

    .tps-location {
        font-size: 10px;
    }

    .complaint-banner {
        padding: 22px;
    }

    .information-card {
        padding: 16px;
    }

    .footer {
        margin-top: 35px;
    }
}

@media (max-width: 380px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .hero-buttons {
        flex-direction: column;
    }

    .tps-grid {
        grid-template-columns: 1fr;
    }
}

</style>
</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container navbar-content">

            <a href="{{ route('landing') }}" class="brand">
                <div class="brand-icon">
                    <i class="bi bi-recycle"></i>
                </div>

                <div>
                    <h2>SI PANTAU TPS</h2>
                    <p>DLH Kabupaten Indramayu</p>
                </div>
            </a>

            <nav class="nav-links">
                <a href="#beranda">Beranda</a>
                <a href="#data-tps">Data TPS</a>
                <a href="#informasi">Informasi</a>
            </nav>

            <div class="nav-actions">
                <a href="{{ route('login') }}" class="btn btn-outline">
                    Masuk
                </a>

                <a href="{{ route('register') }}" class="btn btn-primary">
                    Daftar
                </a>
            </div>

        </div>
    </header>

    <main>

        <!-- HERO -->
        <section class="hero" id="beranda">
            <div class="container hero-content">

                <div>
                    <span class="eyebrow">DINAS LINGKUNGAN HIDUP</span>

                    <h1>Pantau TPS, Wujudkan Lingkungan yang Bersih</h1>

                    <p class="hero-description">
                        Akses informasi tempat penampungan sementara (TPS)
                        dan sampaikan laporan kondisi TPS di Kabupaten
                        Indramayu melalui satu layanan berbasis web.
                    </p>

                    <div class="hero-buttons">
                        <a href="#data-tps" class="btn btn-primary">
                            <i class="bi bi-geo-alt"></i>
                            Lihat Data TPS
                        </a>

                        <a href="{{ route('login') }}" class="btn btn-outline">
                            <i class="bi bi-file-earmark-text"></i>
                            Buat Pengaduan
                        </a>
                    </div>
                </div>

                <div>
                    <img
                        class="hero-image"
                        src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=900&q=80"
                        alt="Ilustrasi pengelolaan sampah"
                    >

                    <p class="hero-caption">
                        Informasi TPS dan pengaduan lingkungan dalam satu layanan
                    </p>
                </div>

            </div>
        </section>

        <!-- STATISTIK -->
        <section class="container">
            <div class="stats-grid">

                <div class="stat-card">
                    <p class="stat-label">Total TPS</p>
                    <div class="stat-value">--</div>
                    <p class="stat-note">Data TPS terdaftar</p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">TPS Aktif</p>
                    <div class="stat-value">--</div>
                    <p class="stat-note">TPS dengan status aktif</p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">Pengaduan Selesai</p>
                    <div class="stat-value">--</div>
                    <p class="stat-note">Laporan yang telah ditangani</p>
                </div>

            </div>
        </section>

        <!-- DATA TPS -->
        <section class="section" id="data-tps">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <h2>Informasi Tempat Penampungan Sementara</h2>
                        <p>Temukan informasi TPS berdasarkan nama atau lokasi.</p>
                    </div>
                </div>

                <div class="search-box">
                    <input
                        type="text"
                        id="searchTPS"
                        class="search-input"
                        placeholder="Cari nama TPS atau lokasi..."
                        aria-label="Cari nama TPS atau lokasi"
                    >

                    <button
                        type="button"
                        class="btn btn-primary"
                        id="searchButton"
                    >
                        <i class="bi bi-search"></i>
                        Cari TPS
                    </button>
                </div>

                <div class="tps-grid" id="tpsGrid">

                    <!-- DATA CONTOH, BELUM TERHUBUNG KE DATABASE -->
                    <article class="tps-card" data-search="tps contoh indramayu">
                        <div class="tps-image">
                            <img
                                src="https://images.unsplash.com/photo-1605600659873-d808a13e4d9a?auto=format&fit=crop&w=600&q=80"
                                alt="Ilustrasi fasilitas pengelolaan sampah"
                                loading="lazy"
                            >
                        </div>

                        <div class="tps-content">
                            <span class="status status-active">Contoh Data</span>
                            <h3>TPS Contoh 1</h3>

                            <p class="tps-location">
                                <i class="bi bi-geo-alt"></i>
                                Kabupaten Indramayu
                            </p>

                            <a href="{{ route('login') }}" class="tps-detail">
                                Informasi TPS
                            </a>
                        </div>
                    </article>

                    <article class="tps-card" data-search="tps contoh jatibarang">
                        <div class="tps-image">
                            <img
                                src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=600&q=80"
                                alt="Ilustrasi pengelolaan sampah"
                                loading="lazy"
                            >
                        </div>

                        <div class="tps-content">
                            <span class="status status-active">Contoh Data</span>
                            <h3>TPS Contoh 2</h3>

                            <p class="tps-location">
                                <i class="bi bi-geo-alt"></i>
                                Kecamatan Jatibarang
                            </p>

                            <a href="{{ route('login') }}" class="tps-detail">
                                Informasi TPS
                            </a>
                        </div>
                    </article>

                    <article class="tps-card" data-search="tps contoh sindang">
                        <div class="tps-image">
                            <img
                                src="https://images.unsplash.com/photo-1605600659873-d808a13e4d9a?auto=format&fit=crop&w=600&q=80"
                                alt="Ilustrasi fasilitas TPS"
                                loading="lazy"
                            >
                        </div>

                        <div class="tps-content">
                            <span class="status status-process">Contoh Data</span>
                            <h3>TPS Contoh 3</h3>

                            <p class="tps-location">
                                <i class="bi bi-geo-alt"></i>
                                Kecamatan Sindang
                            </p>

                            <a href="{{ route('login') }}" class="tps-detail">
                                Informasi TPS
                            </a>
                        </div>
                    </article>

                    <article class="tps-card" data-search="tps contoh lohbener">
                        <div class="tps-image">
                            <img
                                src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=600&q=80"
                                alt="Ilustrasi kegiatan pengelolaan sampah"
                                loading="lazy"
                            >
                        </div>

                        <div class="tps-content">
                            <span class="status status-active">Contoh Data</span>
                            <h3>TPS Contoh 4</h3>

                            <p class="tps-location">
                                <i class="bi bi-geo-alt"></i>
                                Kecamatan Lohbener
                            </p>

                            <a href="{{ route('login') }}" class="tps-detail">
                                Informasi TPS
                            </a>
                        </div>
                    </article>

                </div>

                <div class="empty-result" id="emptyResult">
                    Data TPS yang dicari tidak ditemukan.
                </div>

                <p class="data-note">
                    Catatan: data TPS pada halaman ini masih berupa contoh.
                    Data akan dihubungkan ke database setelah fitur pengelolaan
                    TPS selesai dibuat.
                </p>

            </div>
        </section>

        <!-- PENGADUAN -->
        <section class="container" id="pengaduan">
            <div class="complaint-banner">

                <div>
                    <h2>Menemukan masalah pada TPS?</h2>

                    <p>
                        Masyarakat dapat menyampaikan laporan mengenai kondisi
                        TPS dengan menyertakan informasi kejadian dan lokasi
                        agar dapat ditindaklanjuti oleh petugas terkait.
                    </p>
                </div>

                <a href="{{ route('login') }}" class="btn btn-white">
                    <i class="bi bi-file-earmark-text"></i>
                    Mulai Pengaduan
                </a>

            </div>
        </section>

        <!-- INFORMASI -->
        <section class="section" id="informasi">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <h2>Layanan SI Pantau TPS</h2>
                        <p>
                            Fitur untuk membantu masyarakat memperoleh informasi
                            dan menyampaikan laporan kondisi TPS.
                        </p>
                    </div>
                </div>

                <div class="information-grid">

                    <div class="information-card">
                        <div class="icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <h3>Informasi Lokasi TPS</h3>

                        <p>
                            Membantu masyarakat melihat informasi lokasi TPS
                            yang tersedia di wilayah Kabupaten Indramayu.
                        </p>
                    </div>

                    <div class="information-card">
                        <div class="icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>

                        <h3>Pengaduan Masyarakat</h3>

                        <p>
                            Menyediakan layanan pelaporan masalah TPS dengan
                            menyertakan informasi kejadian, foto, dan lokasi.
                        </p>
                    </div>

                    <div class="information-card">
                        <div class="icon">
                            <i class="bi bi-bar-chart-line"></i>
                        </div>

                        <h3>Informasi Penanganan</h3>

                        <p>
                            Membantu masyarakat mengetahui perkembangan
                            penanganan pengaduan yang telah disampaikan.
                        </p>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">

            <div class="footer-content">

                <div>
                    <h3>SI Pantau TPS</h3>

                    <p>
                        Sistem Pengaduan dan Monitoring TPS Sampah Berbasis Web
                        untuk mendukung pengelolaan lingkungan di Kabupaten
                        Indramayu.
                    </p>
                </div>

                <div>
                    <h3>Menu</h3>

                    <div class="footer-links">
                        <a href="#beranda">Beranda</a>
                        <a href="#data-tps">Data TPS</a>
                        <a href="#informasi">Informasi</a>
                        <a href="#pengaduan">Pengaduan</a>
                        <a href="{{ route('login') }}">Masuk</a>
                        <a href="{{ route('register') }}">Daftar</a>
                    </div>
                </div>

            </div>

            <div class="footer-bottom">
                &copy; {{ date('Y') }} SI Pantau TPS — DLH Kabupaten Indramayu
            </div>

        </div>
    </footer>

    <!-- PENCARIAN TPS -->
    <script>
        const searchInput = document.getElementById('searchTPS');
        const searchButton = document.getElementById('searchButton');
        const tpsCards = document.querySelectorAll('.tps-card');
        const emptyResult = document.getElementById('emptyResult');

        function cariTPS() {
            const keyword = searchInput.value.toLowerCase().trim();
            let jumlahTampil = 0;

            tpsCards.forEach(function (card) {
                const namaLokasi = card.textContent.toLowerCase();
                const dataSearch = card.dataset.search.toLowerCase();

                if (
                    namaLokasi.includes(keyword) ||
                    dataSearch.includes(keyword)
                ) {
                    card.style.display = '';
                    jumlahTampil++;
                } else {
                    card.style.display = 'none';
                }
            });

            emptyResult.style.display =
                jumlahTampil === 0 ? 'block' : 'none';
        }

        searchButton.addEventListener('click', cariTPS);
        searchInput.addEventListener('input', cariTPS);

        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                cariTPS();
            }
        });
    </script>

</body>
</html>
