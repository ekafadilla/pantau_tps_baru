
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SI Pantau TPS | DLH Kabupaten Indramayu</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   <style>
:root {
    --forest: #123d2b;
    --forest-2: #18583b;
    --green: #218653;
    --lime: #c7ef65;
    --mint: #eaf5e9;
    --paper: #f7f9f4;
    --white: #ffffff;
    --ink: #183528;
    --muted: #738078;
    --line: #e5ece5;
    --shadow: 0 16px 40px rgba(18,61,43,.09);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
    scroll-padding-top: 85px;
}

body {
    font-family: "Inter", "Segoe UI", Arial, sans-serif;
    background: var(--paper);
    color: var(--ink);
    line-height: 1.65;
    font-size: 14px;
    overflow-x: hidden;
}

a {
    text-decoration: none;
    color: inherit;
}

button, input {
    font: inherit;
}

.container {
    width: min(90%, 1200px);
    margin: auto;
}

/* NAVBAR */
.navbar {
    position: sticky;
    top: 0;
    z-index: 999;
    background: rgba(255,255,255,.88);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border-bottom: 1px solid rgba(18,61,43,.08);
    transition: box-shadow .3s ease, background .3s ease;
}

.navbar-content {
    min-height: 72px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 25px;
}

.brand {
    display: flex;
    align-items: center;
    gap: 11px;
    flex-shrink: 0;
}

.brand-icon {
    width: 42px;
    height: 42px;
    display: grid;
    place-items: center;
    border-radius: 13px;
    color: white;
    font-size: 21px;
    background: linear-gradient(145deg, #2ba66a, #124b32);
    box-shadow: 0 7px 17px rgba(33,134,83,.22);
    transition: transform .3s ease;
}

.brand:hover .brand-icon {
    transform: rotate(-9deg) scale(1.06);
}

.brand h2 {
    color: var(--forest);
    font-size: 16px;
    font-weight: 850;
    line-height: 1.3;
    letter-spacing: -.4px;
}

.brand p {
    color: var(--muted);
    font-size: 10px;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 31px;
}

.nav-links a {
    position: relative;
    color: #52645a;
    font-size: 13px;
    font-weight: 600;
    transition: color .25s ease;
}

.nav-links a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -8px;
    width: 0;
    height: 2px;
    border-radius: 5px;
    background: var(--green);
    transition: width .3s ease;
}

.nav-links a:hover {
    color: var(--green);
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: 9px;
}

/* BUTTON */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 17px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: transform .25s ease, box-shadow .25s ease,
                background .25s ease, color .25s ease;
}

.btn:hover {
    transform: translateY(-3px);
}

.btn-primary {
    color: white;
    background: linear-gradient(135deg, #25945b, #176b43);
    box-shadow: 0 7px 18px rgba(33,134,83,.2);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2da96a, #155b39);
    box-shadow: 0 11px 23px rgba(33,134,83,.28);
}

.btn-outline {
    color: var(--forest-2);
    border-color: #b8d2bf;
    background: white;
}

.btn-outline:hover {
    color: var(--green);
    border-color: var(--green);
    background: #f0f8f0;
}

.btn-white {
    color: var(--forest);
    background: white;
    white-space: nowrap;
}

.btn-white:hover {
    background: var(--lime);
}

/* HERO */
.hero {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    padding: 75px 0 88px;
    background:
        radial-gradient(ellipse at 85% 15%, rgba(199,239,101,.22), transparent 29%),
        radial-gradient(ellipse at 0% 100%, rgba(33,134,83,.10), transparent 35%),
        linear-gradient(120deg, #f0f7ed 0%, #f8faf5 52%, #e8f3e8 100%);
}

.hero::before,
.hero::after {
    content: "";
    position: absolute;
    z-index: -1;
    border-radius: 50%;
    pointer-events: none;
}

.hero::before {
    width: 420px;
    height: 420px;
    right: -180px;
    top: -210px;
    border: 1px solid rgba(33,134,83,.13);
    box-shadow: 0 0 0 35px rgba(33,134,83,.025),
                0 0 0 75px rgba(33,134,83,.02);
}

.hero::after {
    width: 180px;
    height: 180px;
    left: -100px;
    bottom: -100px;
    background: rgba(199,239,101,.15);
    filter: blur(8px);
}

.hero-content {
    display: grid;
    grid-template-columns: 1.03fr .97fr;
    align-items: center;
    gap: 65px;
}

.eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 12px;
    margin-bottom: 20px;
    border: 1px solid #d5e9d5;
    border-radius: 30px;
    color: #176b43;
    background: rgba(255,255,255,.72);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1px;
}

.eyebrow::before {
    content: "";
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #8ccf46;
    box-shadow: 0 0 0 4px rgba(140,207,70,.15);
}

.hero h1 {
    max-width: 560px;
    margin-bottom: 19px;
    color: var(--forest);
    font-size: clamp(34px, 4.2vw, 51px);
    font-weight: 850;
    line-height: 1.13;
    letter-spacing: -1.8px;
}

.hero-description {
    max-width: 490px;
    margin-bottom: 26px;
    color: #687a6e;
    font-size: 14px;
    line-height: 1.9;
}

.hero-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 11px;
}

.hero-buttons .btn {
    padding: 12px 18px;
}

.hero-image {
    display: block;
    width: 100%;
    height: 335px;
    object-fit: cover;
    border: 5px solid rgba(255,255,255,.8);
    border-radius: 21px;
    box-shadow: 0 22px 48px rgba(18,61,43,.17);
    transition: transform .6s cubic-bezier(.2,.8,.2,1);
}

.hero-image:hover {
    transform: translateY(-6px) scale(1.012);
}

.hero-caption {
    margin-top: 12px;
    color: #7c8a80;
    font-size: 11px;
    text-align: center;
}

/* STATISTIK */
.stats-grid {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 17px;
    margin-top: -28px;
}

.stat-card {
    position: relative;
    overflow: hidden;
    padding: 22px 23px;
    border: 1px solid rgba(220,232,220,.9);
    border-radius: 15px;
    background: white;
    box-shadow: 0 10px 28px rgba(18,61,43,.055);
    transition: transform .3s ease, box-shadow .3s ease;
}

.stat-card::before {
    content: "";
    position: absolute;
    width: 4px;
    left: 0;
    top: 18px;
    bottom: 18px;
    border-radius: 0 5px 5px 0;
    background: var(--green);
}

.stat-card:nth-child(2)::before {
    background: #8dbd43;
}

.stat-card:nth-child(3)::before {
    background: #e2aa48;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow);
}

.stat-label {
    color: #78867d;
    font-size: 12px;
    font-weight: 600;
}

.stat-value {
    margin-top: 5px;
    color: var(--forest);
    font-size: 31px;
    font-weight: 850;
    letter-spacing: -1px;
    line-height: 1.4;
}

.stat-note {
    margin-top: 4px;
    color: #96a198;
    font-size: 11px;
}

/* SECTION */
.section {
    padding: 76px 0;
}

.section-heading {
    display: flex;
    justify-content: space-between;
    align-items: end;
    gap: 20px;
    margin-bottom: 27px;
}

.section-heading h2 {
    margin-bottom: 5px;
    color: var(--forest);
    font-size: 27px;
    font-weight: 850;
    letter-spacing: -.8px;
}

.section-heading p {
    color: var(--muted);
    font-size: 13px;
}

/* SEARCH */
.search-box {
    display: flex;
    gap: 9px;
    margin-bottom: 23px;
    padding: 6px;
    border: 1px solid var(--line);
    border-radius: 12px;
    background: white;
    box-shadow: 0 5px 18px rgba(18,61,43,.035);
    transition: border-color .25s, box-shadow .25s;
}

.search-box:focus-within {
    border-color: #8dbd9b;
    box-shadow: 0 0 0 4px rgba(33,134,83,.08);
}

.search-input {
    flex: 1;
    min-width: 0;
    padding: 11px 13px;
    border: 0;
    outline: 0;
    color: var(--ink);
    background: transparent;
    font-size: 13px;
}

.search-input:focus {
    border: 0;
    box-shadow: none;
}

/* TPS CARDS */
.tps-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0,1fr));
    gap: 17px;
}

.tps-card {
    overflow: hidden;
    border: 1px solid var(--line);
    border-radius: 14px;
    background: white;
    box-shadow: 0 5px 18px rgba(18,61,43,.035);
    transition: transform .35s ease, box-shadow .35s ease,
                border-color .35s ease;
}

.tps-card:hover {
    transform: translateY(-7px);
    border-color: #c6dfc8;
    box-shadow: 0 17px 32px rgba(18,61,43,.11);
}

.tps-image {
    height: 155px;
    overflow: hidden;
    background: #e7efe7;
}

.tps-image img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .6s ease;
}

.tps-card:hover .tps-image img {
    transform: scale(1.07);
}

.tps-content {
    padding: 17px;
}

.status {
    display: inline-block;
    padding: 5px 10px;
    margin-bottom: 10px;
    border-radius: 30px;
    font-size: 10px;
    font-weight: 750;
}

.status-active {
    color: #237447;
    background: #e7f5e8;
}

.status-process {
    color: #95651a;
    background: #fff3d9;
}

.tps-content h3 {
    margin-bottom: 7px;
    color: var(--forest);
    font-size: 14px;
    font-weight: 750;
}

.tps-location {
    margin-bottom: 14px;
    color: #849087;
    font-size: 11px;
}

.tps-location i {
    margin-right: 4px;
    color: var(--green);
}

.tps-detail {
    display: block;
    padding: 9px;
    border: 1px solid #c8dfcd;
    border-radius: 8px;
    color: var(--forest-2);
    font-size: 11px;
    font-weight: 700;
    text-align: center;
    transition: all .25s ease;
}

.tps-detail:hover {
    color: white;
    border-color: var(--green);
    background: var(--green);
}

.empty-result {
    display: none;
    margin-top: 15px;
    padding: 25px;
    border: 1px solid var(--line);
    border-radius: 12px;
    color: var(--muted);
    background: white;
    text-align: center;
}

.data-note {
    margin-top: 17px;
    padding: 12px 15px;
    border-left: 3px solid #9acb65;
    border-radius: 5px;
    color: #778579;
    background: #edf5e9;
    font-size: 11px;
    line-height: 1.8;
}

/* BANNER PENGADUAN */
.complaint-banner {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 25px;
    padding: 38px 40px;
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 19px;
    color: white;
    background:
        radial-gradient(circle at 90% 10%, rgba(199,239,101,.23), transparent 28%),
        linear-gradient(120deg, #123d2b, #20774a);
    box-shadow: 0 15px 35px rgba(18,61,43,.16);
}

.complaint-banner::after {
    content: "";
    position: absolute;
    z-index: -1;
    width: 220px;
    height: 220px;
    right: 15%;
    bottom: -165px;
    border: 1px solid rgba(255,255,255,.16);
    border-radius: 50%;
    box-shadow: 0 0 0 25px rgba(255,255,255,.035),
                0 0 0 55px rgba(255,255,255,.025);
}

.complaint-banner h2 {
    margin-bottom: 8px;
    font-size: 24px;
    font-weight: 850;
    letter-spacing: -.5px;
}

.complaint-banner p {
    max-width: 650px;
    color: #d7e9dc;
    font-size: 12px;
    line-height: 1.8;
}

.complaint-banner .btn {
    position: relative;
    z-index: 1;
    padding: 12px 18px;
}

/* INFORMASI */
.information-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 17px;
}

.information-card {
    padding: 24px;
    border: 1px solid var(--line);
    border-radius: 14px;
    background: white;
    box-shadow: 0 5px 18px rgba(18,61,43,.035);
    transition: transform .3s ease, box-shadow .3s ease,
                border-color .3s ease;
}

.information-card:hover {
    transform: translateY(-6px);
    border-color: #c8dfca;
    box-shadow: var(--shadow);
}

.information-card .icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 47px;
    height: 47px;
    margin-bottom: 16px;
    border-radius: 13px;
    color: #20794b;
    background: linear-gradient(145deg, #e8f6e8, #d9eddb);
    font-size: 22px;
    transition: transform .3s ease;
}

.information-card:hover .icon {
    transform: rotate(-7deg) scale(1.08);
}

.information-card h3 {
    margin-bottom: 8px;
    color: var(--forest);
    font-size: 14px;
    font-weight: 800;
}

.information-card p {
    color: var(--muted);
    font-size: 12px;
    line-height: 1.8;
}

/* ANIMASI SCROLL */
.js-reveal .reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity .75s ease, transform .75s cubic-bezier(.2,.7,.2,1);
}

.js-reveal .reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.js-reveal .reveal-delay-1 {
    transition-delay: .12s;
}

.js-reveal .reveal-delay-2 {
    transition-delay: .23s;
}

.js-reveal .reveal-delay-3 {
    transition-delay: .34s;
}

@keyframes heroFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-7px); }
}

.hero-image {
    animation: heroFloat 6s ease-in-out infinite;
}

/* RESPONSIVE */
@media (max-width: 950px) {
    .hero {
        padding: 60px 0 72px;
    }

    .hero-content {
        gap: 32px;
    }

    .hero h1 {
        font-size: clamp(31px, 4vw, 43px);
    }

    .hero-image {
        height: 270px;
    }

    .tps-grid {
        grid-template-columns: repeat(2, minmax(0,1fr));
    }
}

@media (max-width: 650px) {
    .container {
        width: 92%;
    }

    .navbar-content {
        min-height: auto;
        flex-wrap: wrap;
        gap: 10px;
        padding: 12px 0;
    }

    .brand h2 {
        font-size: 14px;
    }

    .nav-actions {
        gap: 6px;
    }

    .nav-actions .btn {
        padding: 8px 11px;
        font-size: 11px;
    }

    .nav-links {
        order: 3;
        width: 100%;
        justify-content: flex-start;
        gap: 23px;
        overflow-x: auto;
        padding: 5px 0;
    }

    .nav-links a {
        flex-shrink: 0;
        font-size: 12px;
    }

    .hero {
        padding: 43px 0 55px;
    }

    .hero-content {
        grid-template-columns: 1fr;
        gap: 26px;
    }

    .hero h1 {
        font-size: 34px;
        letter-spacing: -1px;
    }

    .hero-description {
        font-size: 13px;
    }

    .hero-image {
        height: 225px;
        border-radius: 15px;
    }

    .hero-buttons .btn {
        padding: 10px 12px;
        font-size: 11px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
        gap: 10px;
        margin-top: 17px;
    }

    .stat-card {
        padding: 15px 19px;
    }

    .stat-value {
        font-size: 25px;
    }

    .section {
        padding: 48px 0;
    }

    .section-heading {
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
    }

    .section-heading h2 {
        font-size: 23px;
    }

    .search-box {
        flex-direction: column;
    }

    .search-box .btn {
        width: 100%;
    }

    .tps-grid {
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap: 11px;
    }

    .tps-image {
        height: 120px;
    }

    .tps-content {
        padding: 12px;
    }

    .tps-content h3 {
        font-size: 12px;
    }

    .complaint-banner {
        align-items: flex-start;
        flex-direction: column;
        padding: 26px 23px;
    }

    .complaint-banner h2 {
        font-size: 21px;
    }

    .information-grid {
        grid-template-columns: 1fr;
    }

    .information-card {
        padding: 20px;
    }
}

@media (max-width: 380px) {
    .hero h1 {
        font-size: 30px;
    }

    .hero-buttons {
        flex-direction: column;
    }

    .tps-grid {
        grid-template-columns: 1fr;
    }
}

/* AKSESIBILITAS: HORMATI PENGATURAN REDUKSI ANIMASI */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        scroll-behavior: auto !important;
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
    }

    .js-reveal .reveal {
        opacity: 1;
        transform: none;
    }
}

/* =========================================================
   FOOTER LANDING PAGE (DIPINDAHKAN KE LUAR MEDIA QUERY)
   ========================================================= */
body footer.landing-footer {
    display: block;
    width: 100%;
    background-color: #176b43;
    color: #ffffff;
    padding: 45px 0 20px;
    margin-top: 50px;
    box-sizing: border-box;
}

body footer.landing-footer .footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 1.3fr 0.8fr 1.3fr 1fr;
    gap: 35px;
    align-items: start;
}

body footer.landing-footer .footer-col {
    display: flex;
    flex-direction: column;
}

body footer.landing-footer .footer-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 12px;
}

body footer.landing-footer .footer-brand i {
    font-size: 24px;
    color: #86efac;
}

body footer.landing-footer .footer-title {
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    margin: 0 0 16px;
}

body footer.landing-footer p {
    font-size: 13px;
    line-height: 1.6;
    color: #d1e4d8;
    margin: 0 0 10px;
}

body footer.landing-footer ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

body footer.landing-footer li {
    margin-bottom: 10px;
    font-size: 13px;
    color: #d1e4d8;
}

body footer.landing-footer a {
    color: #d1e4d8;
    text-decoration: none;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: color 0.2s ease;
}

/* PETA */
body footer.landing-footer .col-map-box {
    width: 100%;
    height: 140px;
    border-radius: 8px;
    overflow: hidden;
    margin-top: 15px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

body footer.landing-footer .col-map-box iframe {
    width: 100%;
    height: 100%;
    border: 0;
}
/* PETA END */

body footer.landing-footer a:hover {
    color: #86efac;
}

body footer.landing-footer .contact-info i {
    color: #86efac;
    font-size: 15px;
}

/* Style Tombol Sosial Media */
body footer.landing-footer .social-media-icons {
    display: flex;
    gap: 10px;
    margin-top: 5px;
}

body footer.landing-footer .social-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
}

body footer.landing-footer .social-icon:hover {
    transform: translateY(-3px);
}

body footer.landing-footer .social-icon.tiktok:hover { background: #000000; }
body footer.landing-footer .social-icon.instagram:hover { background: #e1306c; }
body footer.landing-footer .social-icon.facebook:hover { background: #1877f2; }
body footer.landing-footer .social-icon.youtube:hover { background: #ff0000; }

body footer.landing-footer .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.15);
    margin-top: 35px;
    padding-top: 18px;
    text-align: center;
    font-size: 12px;
    color: #a3c9b1;
}

/* Responsif Layar HP untuk Footer */
@media (max-width: 768px) {
    body footer.landing-footer .footer-container {
        grid-template-columns: 1fr;
        gap: 25px;
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


<!-- FOOTER LANDING PAGE -->
<footer class="landing-footer">
    <div class="footer-container">
        
        <!-- Kolom 1: Profil & Deskripsi  -->
        <div class="footer-col brand-col">
            <div class="footer-brand">
                <i class="bi bi-recycle"></i>
                <span>SI PANTAU TPS</span>
            </div>
            <p>Sistem Pengaduan dan Monitoring TPS Sampah Berbasis Web untuk mendukung pengelolaan lingkungan di Kabupaten Indramayu.</p>

            {{-- peta lokasi --}}
            <div class="col-map-box">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.513476251214!2d108.3243!3d-6.3314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb94df5555555%3A0x123456789abcdef!2sDinas%20Lingkungan%20Hidup%20Kabupaten%20Indramayu!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- Kolom 2: Menu Navigasi -->
        <div class="footer-col">
            <h4 class="footer-title">Menu</h4>
            <ul class="footer-links">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#tps">Data TPS</a></li>
                <li><a href="#informasi">Informasi</a></li>
                <li><a href="#alur">Alur Pengaduan</a></li>
                <li><a href="{{ route('login') }}">Masuk</a></li>
                <li><a href="{{ route('register') }}">Daftar</a></li>
            </ul>
        </div>

        <!-- Kolom 3: Kontak & Alamat + Peta -->
        <div class="footer-col">
            <h4 class="footer-title">Kontak & Lokasi</h4>
            <ul class="contact-info">
                <li>
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Jl. Pahlawan No. 49, Lemahabang, Kec. Indramayu, Kab. Indramayu</span>
                </li>
            </ul>

            

            <!-- Kontak Lainnya (WhatsApp & Email) -->
            <ul class="contact-info" style="margin-top: 12px;">
                <li>
                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-whatsapp"></i>
                        <span>+62 812-3456-7890</span>
                    </a>
                </li>
                <li>
                    <a href="mailto:dlh@indramayukab.go.id">
                        <i class="bi bi-envelope-fill"></i>
                        <span>dlh@indramayukab.go.id</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Kolom 4: Ikon Sosial Media Interaktif -->
        <div class="footer-col">
            <h4 class="footer-title">Ikuti Kami</h4>
            <p>Dapatkan informasi kebersihan lingkungan:</p>
            <div class="social-media-icons">
                <a href="https://www.tiktok.com/@dlh.indramayu" target="_blank" title="TikTok DLH Indramayu" class="social-icon tiktok">
                    <i class="bi bi-tiktok"></i>
                </a>
                <a href="https://www.instagram.com/dlh.indramayu" target="_blank" title="Instagram DLH Indramayu" class="social-icon instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.facebook.com/dlh.indramayu" target="_blank" title="Facebook DLH Indramayu" class="social-icon facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.youtube.com/@dlhindramayu" target="_blank" title="YouTube DLH Indramayu" class="social-icon youtube">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 SI Pantau TPS — Dinas Lingkungan Hidup Kabupaten Indramayu</p>
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

<!-- LANDING-SCROLL-REVEAL -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.classList.add('js-reveal');

    const revealItems = document.querySelectorAll(
        '.hero-content > *, .stat-card, .section-heading, .tps-card, .complaint-banner, .information-card, .footer-content > *'
    );

    revealItems.forEach(function (item, index) {
        item.classList.add('reveal');
        if (index % 4 === 1) item.classList.add('reveal-delay-1');
        if (index % 4 === 2) item.classList.add('reveal-delay-2');
        if (index % 4 === 3) item.classList.add('reveal-delay-3');
    });

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -35px 0px'
        });

        revealItems.forEach(function (item) {
            observer.observe(item);
        });
    } else {
        revealItems.forEach(function (item) {
            item.classList.add('is-visible');
        });
    }
});
</script>
</body>
</html>
