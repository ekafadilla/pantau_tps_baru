
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
