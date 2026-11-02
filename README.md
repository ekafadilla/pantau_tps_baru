<div align="center">

# ♻️ SI PANTAU TPS

### Sistem Informasi Pelaporan Kondisi Tempat Penampungan Sementara (TPS) Berbasis Web

<p>
  <img src="https://img.shields.io/badge/Laravel-PHP-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Database-MySQL-blue?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Map-Leaflet-green?style=for-the-badge&logo=leaflet" alt="Leaflet">
  <img src="https://img.shields.io/badge/Platform-Web-orange?style=for-the-badge&logo=googlechrome" alt="Web">
</p>

**Mempermudah pelaporan, membantu monitoring, dan mendukung penanganan kondisi TPS.**

</div>

---

## 📌 Tentang Proyek

**SI Pantau TPS** merupakan sistem informasi berbasis web yang dikembangkan untuk mempermudah masyarakat dalam melaporkan kondisi Tempat Penampungan Sementara (TPS) serta membantu petugas dalam melakukan monitoring dan pengelolaan laporan.

Sistem ini menyediakan media pelaporan yang lebih terstruktur dengan informasi berupa foto, lokasi, waktu, kategori kondisi TPS, dan keterangan. Laporan yang masuk dapat dikelola oleh petugas melalui dashboard untuk mendukung proses verifikasi, penentuan urgensi, pemantauan status, serta pencatatan tindak lanjut.

Proyek ini dikembangkan sebagai bentuk dukungan terhadap pengelolaan informasi kondisi TPS yang lebih terorganisasi.

## 🎯 Tujuan

- Mempermudah masyarakat melaporkan kondisi TPS.
- Membantu petugas mengetahui lokasi TPS yang membutuhkan penanganan.
- Memudahkan pemantauan status dan tindak lanjut laporan.
- Menyediakan riwayat kondisi dan penanganan TPS.
- Mendukung penentuan prioritas penanganan berdasarkan tingkat urgensi.

## ✨ Fitur Utama

| Fitur | Deskripsi |
|---|---|
| Pelaporan TPS | Masyarakat dapat mengirim laporan kondisi TPS disertai foto dan keterangan. |
| Informasi Lokasi | Menampilkan informasi lokasi TPS dan laporan melalui peta. |
| Monitoring Laporan | Memantau perkembangan dan status laporan. |
| Verifikasi Laporan | Petugas dapat memeriksa laporan yang masuk. |
| Tingkat Urgensi | Mengelompokkan laporan berdasarkan tingkat urgensi. |
| Tindak Lanjut | Mencatat proses dan hasil penanganan laporan. |
| Riwayat TPS | Menyimpan riwayat laporan dan kondisi TPS. |
| Dashboard | Menyediakan informasi sesuai hak akses masing-masing pengguna. |

## 👥 Hak Akses Pengguna

Sistem dirancang dengan lima jenis pengguna:

1. **Pengunjung** – Melihat informasi publik yang tersedia.
2. **Masyarakat** – Membuat laporan dan memantau laporan sendiri.
3. **UPTD** – Mengelola, memverifikasi, dan memantau laporan serta penanganannya.
4. **Petugas Lapangan** – Melihat dan menjalankan tugas penanganan.
5. **Admin** – Mengelola data pengguna, TPS, petugas, dan data sistem.

## 🔄 Alur Pelaporan

1. Masyarakat membuka halaman sistem.
2. Masyarakat mengisi laporan kondisi TPS.
3. Laporan dikirim beserta foto, lokasi, dan keterangan.
4. UPTD memeriksa dan memverifikasi laporan.
5. Laporan dikelompokkan berdasarkan tingkat urgensi.
6. Petugas melakukan penanganan sesuai penugasan.
7. Status dan tindak lanjut laporan diperbarui.
8. Riwayat penanganan dapat dipantau melalui sistem.

## 🛠️ Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP | Bahasa pemrograman sisi server |
| Laravel | Framework pengembangan aplikasi web |
| MySQL | Pengelolaan basis data |
| HTML | Struktur halaman web |
| CSS | Pengaturan tampilan halaman |
| JavaScript | Interaksi pada halaman web |
| Leaflet.js | Menampilkan peta interaktif |
| OpenStreetMap | Sumber data peta |

## ⚙️ Instalasi dan Menjalankan Proyek

### 1. Persiapan

Pastikan perangkat telah memiliki:

- PHP
- Composer
- MySQL
- Node.js dan NPM
- XAMPP atau lingkungan server lokal lainnya
- Git

### 2. Clone Repository

```bash
git clone URL_REPOSITORY
```

Masuk ke direktori proyek:

```bash
cd pantau_tps_baru
```

### 3. Install Dependency

```bash
composer install
npm install
```

### 4. Konfigurasi Environment

Salin file konfigurasi:

```bash
cp .env.example .env
```

Pada Windows PowerShell, gunakan:

```powershell
Copy-Item .env.example .env
```

Kemudian buat application key:

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Buat database MySQL, kemudian sesuaikan konfigurasi pada file `.env`.

Contoh:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama database dan kredensial dengan konfigurasi lokal.

### 6. Migrasi Database

```bash
php artisan migrate
```

### 7. Build Asset

```bash
npm run build
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

## 📂 Struktur Proyek

```text
pantau_tps_baru/
│
├── app/
│   ├── Http/
│   ├── Models/
│   └── Providers/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   └── web.php
│
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

## 🎓 Informasi Proyek

| Keterangan | Detail |
|---|---|
| Nama Proyek | SI Pantau TPS |
| Jenis Proyek | Proyek Pengembangan Sistem Informasi |
| Program Studi | D3 Teknik Informatika |
| Institusi | Politeknik Negeri Indramayu |
| Tahun | 2026 |
| Metode Pengembangan | Waterfall |

## 👩‍💻 Tim Pengembang

Proyek ini dikembangkan oleh Kelompok 5:

- Amanda Zulfah
- Anggi Kumalasari
- Eka Fadilla
- Nadifa Aulia

---

<div align="center">

**SI PANTAU TPS**

_Mendukung pelaporan dan monitoring kondisi TPS yang lebih terstruktur._

© 2026 Kelompok 5 – D3 Teknik Informatika, Politeknik Negeri Indramayu

</div>
