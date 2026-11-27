-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2026 at 01:36 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pantau_tps`
--

-- --------------------------------------------------------

--
-- Table structure for table `armadas`
--

CREATE TABLE `armadas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_wilayah` bigint UNSIGNED NOT NULL,
  `kode_armada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_armada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_polisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_armada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bukti_penanganans`
--

CREATE TABLE `bukti_penanganans` (
  `id` bigint UNSIGNED NOT NULL,
  `id_laporan` bigint UNSIGNED NOT NULL,
  `id_supir` bigint UNSIGNED NOT NULL,
  `foto_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_pengiriman` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-4673bef3d306fc9811aca9422994f981', 'i:1;', 1795181802),
('laravel-cache-4673bef3d306fc9811aca9422994f981:timer', 'i:1795181802;', 1795181802),
('laravel-cache-5333b96e99671666b74491d9869b1206', 'i:1;', 1795179757),
('laravel-cache-5333b96e99671666b74491d9869b1206:timer', 'i:1795179757;', 1795179757),
('laravel-cache-94d92f976fd06fd3e8cf53ec4e03d646', 'i:1;', 1795181487),
('laravel-cache-94d92f976fd06fd3e8cf53ec4e03d646:timer', 'i:1795181487;', 1795181487),
('laravel-cache-bd307a3ec329e10a2cff8fb87480823da114f8f4', 'i:1;', 1795178713),
('laravel-cache-bd307a3ec329e10a2cff8fb87480823da114f8f4:timer', 'i:1795178713;', 1795178713),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a', 'i:2;', 1795179790),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a:timer', 'i:1795179790;', 1795179790),
('laravel-cache-e966410e9e632c455c7e63ef891d0ed5', 'i:2;', 1795179386),
('laravel-cache-e966410e9e632c455c7e63ef891d0ed5:timer', 'i:1795179386;', 1795179386);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deteksi_spams`
--

CREATE TABLE `deteksi_spams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_laporan` bigint UNSIGNED DEFAULT NULL,
  `id_tps` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED DEFAULT NULL,
  `jenis_deteksi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_laporan` int UNSIGNED NOT NULL DEFAULT '1',
  `jumlah_pengguna` int UNSIGNED NOT NULL DEFAULT '1',
  `periode_mulai` timestamp NULL DEFAULT NULL,
  `periode_selesai` timestamp NULL DEFAULT NULL,
  `status_peninjauan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'perlu_ditinjau',
  `catatan_admin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto_laporans`
--

CREATE TABLE `foto_laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `id_laporan` bigint UNSIGNED NOT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `id_tps` bigint UNSIGNED NOT NULL,
  `id_supir` bigint UNSIGNED DEFAULT NULL,
  `id_armada` bigint UNSIGNED DEFAULT NULL,
  `kategori_kondisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_pelaporan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_laporan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tingkat_urgensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_waktu` timestamp NULL DEFAULT NULL,
  `instruksi_penanganan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_kirim_pemeriksaan` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_supirs`
--

CREATE TABLE `lokasi_supirs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_supir` bigint UNSIGNED NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `akurasi` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_landing_pages`
--

CREATE TABLE `pengaturan_landing_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `kunci` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_urgensi`
--

CREATE TABLE `penilaian_urgensi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_laporan` bigint UNSIGNED NOT NULL,
  `jenis_penilaian` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_penilai` bigint UNSIGNED DEFAULT NULL,
  `kepenuhan_tps` tinyint UNSIGNED NOT NULL,
  `sampah_meluber` tinyint UNSIGNED NOT NULL,
  `dampak_lingkungan` tinyint UNSIGNED NOT NULL,
  `bau_hama` tinyint UNSIGNED NOT NULL,
  `gangguan_masyarakat` tinyint UNSIGNED NOT NULL,
  `skor_urgensi` decimal(5,2) NOT NULL,
  `rekomendasi_urgensi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_statuses`
--

CREATE TABLE `riwayat_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `id_laporan` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED DEFAULT NULL,
  `status_sebelumnya` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_baru` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `waktu_perubahan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aA7Ay5USiyMk7Phvvo8wnIa1hm9oVh1Q6s5G1TXV', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJKclJGY3o4RGx2V0hlSzVsWmpRYm50OFJ2WlRkTENRZlJXdmlQSG8xIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MTksInBhc3N3b3JkX2hhc2hfd2ViIjoiYWVmOTZjN2FmMGJiYWVhNjhkNzdmMDhlYWU1MTVlYzRiNmVlOWVmMzk2ODZkOTFkZTM0OTA4OTdlMGZjODE1NCJ9', 1795179327),
('tk9DW5RUwbQMkGIKPBwdtwI6TA7sUwvsdMU6YK2H', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJFN1JxUUVodVBRUzdnT1dqWENBenN3a0pHR2FpU3FPNWVEZ0ZiU1VpIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL21hc3lhcmFrYXRcL2xhcG9yYW5cL2J1YXQiLCJyb3V0ZSI6Im1hc3lhcmFrYXQubGFwb3Jhbi5jcmVhdGUifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjE5LCJwYXNzd29yZF9oYXNoX3dlYiI6ImFlZjk2YzdhZjBiYmFlYTY4ZDc3ZjA4ZWFlNTE1ZWM0YjZlZTllZjM5Njg2ZDkxZGUzNDkwODk3ZTBmYzgxNTQifQ==', 1795181745);

-- --------------------------------------------------------

--
-- Table structure for table `supir_tps`
--

CREATE TABLE `supir_tps` (
  `id` bigint UNSIGNED NOT NULL,
  `id_supir` bigint UNSIGNED NOT NULL,
  `id_tps` bigint UNSIGNED NOT NULL,
  `rute` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tps`
--

CREATE TABLE `tps` (
  `id` bigint UNSIGNED NOT NULL,
  `id_wilayah` bigint UNSIGNED NOT NULL,
  `nama_tps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bersih',
  `last_cleaned_at` timestamp NULL DEFAULT NULL,
  `last_reported_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tps`
--

INSERT INTO `tps` (`id`, `id_wilayah`, `nama_tps`, `lokasi`, `alamat`, `latitude`, `longitude`, `keterangan`, `created_at`, `updated_at`, `status`, `last_cleaned_at`, `last_reported_at`) VALUES
(1, 1, 'TPS Pasar Baru Indramayu', NULL, 'Jl. Jend. Sudirman, Lemahmekar, Kec. Indramayu', '-6.3275800', '108.3249400', 'TPS Kontainer & Bak Terbuka Pasar Baru', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(2, 1, 'TPS Pasar Mambo Indramayu', NULL, 'Jl. Ahmad Yani, Lemahabang, Kec. Indramayu', '-6.3318500', '108.3221100', 'TPS Kawasan Pusat Pertokoan & Pasar Mambo', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(3, 1, 'TPS Pasar Daerah Sindang', NULL, 'Jl. MT Haryono, Penganjang, Kec. Sindang', '-6.3389200', '108.3164500', 'TPS Kontainer Pasar Sindang', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(4, 1, 'TPS Terminal Sindang', NULL, 'Jl. Murahnara, Sindang, Kec. Sindang', '-6.3421500', '108.3148000', 'TPS Bak Terbuka Area Terminal', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(5, 1, 'TPS Pasar Lohbener', NULL, 'Jl. Raya Pantura Lohbener, Kec. Lohbener', '-6.4012400', '108.2718900', 'TPS Kontainer Jalur Pantura Lohbener', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(6, 2, 'TPS Pasar Karangampel', NULL, 'Jl. Raya Karangampel, Dukuh Tengah, Kec. Karangampel', '-6.4628500', '108.4519200', 'TPS Kontainer Utama Pasar Karangampel', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(7, 2, 'TPS Pasar Balongan', NULL, 'Jl. Raya Balongan, Kec. Balongan', '-6.3764200', '108.3781500', 'TPS Kawasan Pasar & Pemukiman Balongan', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(8, 2, 'TPS Pasar Juntinyuat', NULL, 'Jl. Raya Juntinyuat, Kec. Juntinyuat', '-6.4215600', '108.4193400', 'TPS Bak Pasangan Pasar Juntinyuat', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(9, 3, 'TPS Pasar Daerah Jatibarang', NULL, 'Jl. Mayor Dasuki, Jatibarang, Kec. Jatibarang', '-6.4731200', '108.3084500', 'TPS Kontainer Utama Pasar Jatibarang', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(10, 3, 'TPS Pasar Hewan Jatibarang', NULL, 'Jl. Raya Bulak, Kec. Jatibarang', '-6.4689400', '108.3021800', 'TPS Kontainer Area Pasar Hewan & Bulak', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(11, 3, 'TPS Pasar Kertasemaya', NULL, 'Jl. Raya Pantura Tulungagung, Kec. Kertasemaya', '-6.5184200', '108.3387100', 'TPS Jalur Pantura Kertasemaya', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(12, 3, 'TPS Pasar Sliyeg', NULL, 'Jl. Raya Sliyeg, Kec. Sliyeg', '-6.4478100', '108.3612900', 'TPS Bak Terbuka Pasar Sliyeg', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(13, 4, 'TPS Pasar Losarang', NULL, 'Jl. Raya Pantura Krimun, Kec. Losarang', '-6.4187500', '108.1654200', 'TPS Kontainer Jalur Pantura Losarang', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(14, 4, 'TPS Pasar Lelea', NULL, 'Jl. Raya Lelea, Kec. Lelea', '-6.4621900', '108.2048500', 'TPS Bak Pasangan Pasar Lelea', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(15, 5, 'TPS Pasar Eretan / Kandanghaur', NULL, 'Jl. Raya Pantura Eretan Wetan, Kec. Kandanghaur', '-6.3428900', '108.0894500', 'TPS Kontainer Kawasan Pasar & Pesisir Eretan', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(16, 5, 'TPS Pasar Parean Kandanghaur', NULL, 'Jl. Raya Pantura Parean Girang, Kec. Kandanghaur', '-6.3654100', '108.1128400', 'TPS Jalur Pantura Parean', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(17, 6, 'TPS Pasar Daerah Haurgeulis', NULL, 'Jl. Ahmad Yani, Haurgeulis, Kec. Haurgeulis', '-6.4612800', '107.9421500', 'TPS Kontainer Utama Pasar Haurgeulis', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(18, 6, 'TPS Pasar Patrol', NULL, 'Jl. Raya Pantura Patrol, Kec. Patrol', '-6.3189400', '107.9912500', 'TPS Kontainer Jalur Pantura Patrol', '2026-11-20 06:19:08', '2026-11-20 06:19:08', 'bersih', NULL, NULL),
(19, 1, 'TPS Bak Terbuka Indramayu #1', NULL, 'Jl. Raya Indramayu Blok 1, Kec. Indramayu, Kab. Indramayu', '-6.3187000', '108.3122000', 'TPS Wilayah Kec. Indramayu', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(20, 1, 'TPS Desa Indramayu #2', NULL, 'Jl. Raya Indramayu Blok 2, Kec. Indramayu, Kab. Indramayu', '-6.3387000', '108.3304000', 'TPS Wilayah Kec. Indramayu', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(21, 1, 'TPS Kontainer Indramayu #3', NULL, 'Jl. Raya Indramayu Blok 3, Kec. Indramayu, Kab. Indramayu', '-6.3320000', '108.3318000', 'TPS Wilayah Kec. Indramayu', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(22, 1, 'TPS Jalan Raya Indramayu #4', NULL, 'Jl. Raya Indramayu Blok 4, Kec. Indramayu, Kab. Indramayu', '-6.3249000', '108.3259000', 'TPS Wilayah Kec. Indramayu', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(23, 1, 'TPS Pemukiman Indramayu #5', NULL, 'Jl. Raya Indramayu Blok 5, Kec. Indramayu, Kab. Indramayu', '-6.3203000', '108.3248000', 'TPS Wilayah Kec. Indramayu', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(24, 1, 'TPS Simpang Indramayu #6', NULL, 'Jl. Raya Indramayu Blok 6, Kec. Indramayu, Kab. Indramayu', '-6.3410000', '108.3203000', 'TPS Wilayah Kec. Indramayu', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(25, 1, 'TPS Depo Indramayu #7', NULL, 'Jl. Raya Indramayu Blok 7, Kec. Indramayu, Kab. Indramayu', '-6.3232000', '108.3341000', 'TPS Wilayah Kec. Indramayu', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(26, 1, 'TPS Balai Desa Indramayu #8', NULL, 'Jl. Raya Indramayu Blok 8, Kec. Indramayu, Kab. Indramayu', '-6.3320000', '108.3178000', 'TPS Wilayah Kec. Indramayu', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(27, 1, 'TPS Bak Terbuka Sindang #1', NULL, 'Jl. Raya Sindang Blok 1, Kec. Sindang, Kab. Indramayu', '-6.3393000', '108.3182000', 'TPS Wilayah Kec. Sindang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(28, 1, 'TPS Desa Sindang #2', NULL, 'Jl. Raya Sindang Blok 2, Kec. Sindang, Kab. Indramayu', '-6.3405000', '108.3172000', 'TPS Wilayah Kec. Sindang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(29, 1, 'TPS Kontainer Sindang #3', NULL, 'Jl. Raya Sindang Blok 3, Kec. Sindang, Kab. Indramayu', '-6.3399000', '108.3289000', 'TPS Wilayah Kec. Sindang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(30, 1, 'TPS Jalan Raya Sindang #4', NULL, 'Jl. Raya Sindang Blok 4, Kec. Sindang, Kab. Indramayu', '-6.3502000', '108.3047000', 'TPS Wilayah Kec. Sindang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(31, 1, 'TPS Pemukiman Sindang #5', NULL, 'Jl. Raya Sindang Blok 5, Kec. Sindang, Kab. Indramayu', '-6.3259000', '108.3065000', 'TPS Wilayah Kec. Sindang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(32, 1, 'TPS Simpang Sindang #6', NULL, 'Jl. Raya Sindang Blok 6, Kec. Sindang, Kab. Indramayu', '-6.3478000', '108.3214000', 'TPS Wilayah Kec. Sindang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(33, 1, 'TPS Depo Sindang #7', NULL, 'Jl. Raya Sindang Blok 7, Kec. Sindang, Kab. Indramayu', '-6.3352000', '108.3020000', 'TPS Wilayah Kec. Sindang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(34, 1, 'TPS Balai Desa Sindang #8', NULL, 'Jl. Raya Sindang Blok 8, Kec. Sindang, Kab. Indramayu', '-6.3440000', '108.3186000', 'TPS Wilayah Kec. Sindang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(35, 1, 'TPS Bak Terbuka Pasekan #1', NULL, 'Jl. Raya Pasekan Blok 1, Kec. Pasekan, Kab. Indramayu', '-6.2779000', '108.3267000', 'TPS Wilayah Kec. Pasekan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(36, 1, 'TPS Desa Pasekan #2', NULL, 'Jl. Raya Pasekan Blok 2, Kec. Pasekan, Kab. Indramayu', '-6.3037000', '108.3277000', 'TPS Wilayah Kec. Pasekan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(37, 1, 'TPS Kontainer Pasekan #3', NULL, 'Jl. Raya Pasekan Blok 3, Kec. Pasekan, Kab. Indramayu', '-6.3039000', '108.3253000', 'TPS Wilayah Kec. Pasekan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(38, 1, 'TPS Jalan Raya Pasekan #4', NULL, 'Jl. Raya Pasekan Blok 4, Kec. Pasekan, Kab. Indramayu', '-6.2775000', '108.3359000', 'TPS Wilayah Kec. Pasekan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(39, 1, 'TPS Pemukiman Pasekan #5', NULL, 'Jl. Raya Pasekan Blok 5, Kec. Pasekan, Kab. Indramayu', '-6.2932000', '108.3249000', 'TPS Wilayah Kec. Pasekan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(40, 1, 'TPS Simpang Pasekan #6', NULL, 'Jl. Raya Pasekan Blok 6, Kec. Pasekan, Kab. Indramayu', '-6.3037000', '108.3266000', 'TPS Wilayah Kec. Pasekan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(41, 1, 'TPS Depo Pasekan #7', NULL, 'Jl. Raya Pasekan Blok 7, Kec. Pasekan, Kab. Indramayu', '-6.2759000', '108.3350000', 'TPS Wilayah Kec. Pasekan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(42, 1, 'TPS Balai Desa Pasekan #8', NULL, 'Jl. Raya Pasekan Blok 8, Kec. Pasekan, Kab. Indramayu', '-6.2876000', '108.3476000', 'TPS Wilayah Kec. Pasekan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(43, 1, 'TPS Bak Terbuka Cantigi #1', NULL, 'Jl. Raya Cantigi Blok 1, Kec. Cantigi, Kab. Indramayu', '-6.3148000', '108.2690000', 'TPS Wilayah Kec. Cantigi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(44, 1, 'TPS Desa Cantigi #2', NULL, 'Jl. Raya Cantigi Blok 2, Kec. Cantigi, Kab. Indramayu', '-6.3128000', '108.2546000', 'TPS Wilayah Kec. Cantigi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(45, 1, 'TPS Kontainer Cantigi #3', NULL, 'Jl. Raya Cantigi Blok 3, Kec. Cantigi, Kab. Indramayu', '-6.3196000', '108.2557000', 'TPS Wilayah Kec. Cantigi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(46, 1, 'TPS Jalan Raya Cantigi #4', NULL, 'Jl. Raya Cantigi Blok 4, Kec. Cantigi, Kab. Indramayu', '-6.3103000', '108.2547000', 'TPS Wilayah Kec. Cantigi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(47, 1, 'TPS Pemukiman Cantigi #5', NULL, 'Jl. Raya Cantigi Blok 5, Kec. Cantigi, Kab. Indramayu', '-6.3166000', '108.2537000', 'TPS Wilayah Kec. Cantigi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(48, 1, 'TPS Simpang Cantigi #6', NULL, 'Jl. Raya Cantigi Blok 6, Kec. Cantigi, Kab. Indramayu', '-6.2999000', '108.2547000', 'TPS Wilayah Kec. Cantigi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(49, 1, 'TPS Depo Cantigi #7', NULL, 'Jl. Raya Cantigi Blok 7, Kec. Cantigi, Kab. Indramayu', '-6.3075000', '108.2688000', 'TPS Wilayah Kec. Cantigi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(50, 1, 'TPS Balai Desa Cantigi #8', NULL, 'Jl. Raya Cantigi Blok 8, Kec. Cantigi, Kab. Indramayu', '-6.3226000', '108.2679000', 'TPS Wilayah Kec. Cantigi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(51, 1, 'TPS Bak Terbuka Arahan #1', NULL, 'Jl. Raya Arahan Blok 1, Kec. Arahan, Kab. Indramayu', '-6.3761000', '108.2548000', 'TPS Wilayah Kec. Arahan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(52, 1, 'TPS Desa Arahan #2', NULL, 'Jl. Raya Arahan Blok 2, Kec. Arahan, Kab. Indramayu', '-6.3704000', '108.2546000', 'TPS Wilayah Kec. Arahan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(53, 1, 'TPS Kontainer Arahan #3', NULL, 'Jl. Raya Arahan Blok 3, Kec. Arahan, Kab. Indramayu', '-6.3686000', '108.2551000', 'TPS Wilayah Kec. Arahan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(54, 1, 'TPS Jalan Raya Arahan #4', NULL, 'Jl. Raya Arahan Blok 4, Kec. Arahan, Kab. Indramayu', '-6.3621000', '108.2441000', 'TPS Wilayah Kec. Arahan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(55, 1, 'TPS Pemukiman Arahan #5', NULL, 'Jl. Raya Arahan Blok 5, Kec. Arahan, Kab. Indramayu', '-6.3759000', '108.2421000', 'TPS Wilayah Kec. Arahan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(56, 1, 'TPS Simpang Arahan #6', NULL, 'Jl. Raya Arahan Blok 6, Kec. Arahan, Kab. Indramayu', '-6.3700000', '108.2635000', 'TPS Wilayah Kec. Arahan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(57, 1, 'TPS Depo Arahan #7', NULL, 'Jl. Raya Arahan Blok 7, Kec. Arahan, Kab. Indramayu', '-6.3687000', '108.2615000', 'TPS Wilayah Kec. Arahan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(58, 1, 'TPS Balai Desa Arahan #8', NULL, 'Jl. Raya Arahan Blok 8, Kec. Arahan, Kab. Indramayu', '-6.3602000', '108.2552000', 'TPS Wilayah Kec. Arahan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(59, 1, 'TPS Bak Terbuka Lohbener #1', NULL, 'Jl. Raya Lohbener Blok 1, Kec. Lohbener, Kab. Indramayu', '-6.3947000', '108.2849000', 'TPS Wilayah Kec. Lohbener', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(60, 1, 'TPS Desa Lohbener #2', NULL, 'Jl. Raya Lohbener Blok 2, Kec. Lohbener, Kab. Indramayu', '-6.4081000', '108.2819000', 'TPS Wilayah Kec. Lohbener', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(61, 1, 'TPS Kontainer Lohbener #3', NULL, 'Jl. Raya Lohbener Blok 3, Kec. Lohbener, Kab. Indramayu', '-6.3965000', '108.2704000', 'TPS Wilayah Kec. Lohbener', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(62, 1, 'TPS Jalan Raya Lohbener #4', NULL, 'Jl. Raya Lohbener Blok 4, Kec. Lohbener, Kab. Indramayu', '-6.3869000', '108.2591000', 'TPS Wilayah Kec. Lohbener', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(63, 1, 'TPS Pemukiman Lohbener #5', NULL, 'Jl. Raya Lohbener Blok 5, Kec. Lohbener, Kab. Indramayu', '-6.4039000', '108.2627000', 'TPS Wilayah Kec. Lohbener', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(64, 1, 'TPS Simpang Lohbener #6', NULL, 'Jl. Raya Lohbener Blok 6, Kec. Lohbener, Kab. Indramayu', '-6.3955000', '108.2647000', 'TPS Wilayah Kec. Lohbener', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(65, 1, 'TPS Depo Lohbener #7', NULL, 'Jl. Raya Lohbener Blok 7, Kec. Lohbener, Kab. Indramayu', '-6.3964000', '108.2685000', 'TPS Wilayah Kec. Lohbener', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(66, 1, 'TPS Balai Desa Lohbener #8', NULL, 'Jl. Raya Lohbener Blok 8, Kec. Lohbener, Kab. Indramayu', '-6.4053000', '108.2660000', 'TPS Wilayah Kec. Lohbener', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(67, 2, 'TPS Bak Terbuka Karangampel #1', NULL, 'Jl. Raya Karangampel Blok 1, Kec. Karangampel, Kab. Indramayu', '-6.4511000', '108.4451000', 'TPS Wilayah Kec. Karangampel', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(68, 2, 'TPS Desa Karangampel #2', NULL, 'Jl. Raya Karangampel Blok 2, Kec. Karangampel, Kab. Indramayu', '-6.4495000', '108.4477000', 'TPS Wilayah Kec. Karangampel', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(69, 2, 'TPS Kontainer Karangampel #3', NULL, 'Jl. Raya Karangampel Blok 3, Kec. Karangampel, Kab. Indramayu', '-6.4519000', '108.4570000', 'TPS Wilayah Kec. Karangampel', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(70, 2, 'TPS Jalan Raya Karangampel #4', NULL, 'Jl. Raya Karangampel Blok 4, Kec. Karangampel, Kab. Indramayu', '-6.4579000', '108.4596000', 'TPS Wilayah Kec. Karangampel', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(71, 2, 'TPS Pemukiman Karangampel #5', NULL, 'Jl. Raya Karangampel Blok 5, Kec. Karangampel, Kab. Indramayu', '-6.4503000', '108.4401000', 'TPS Wilayah Kec. Karangampel', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(72, 2, 'TPS Simpang Karangampel #6', NULL, 'Jl. Raya Karangampel Blok 6, Kec. Karangampel, Kab. Indramayu', '-6.4565000', '108.4479000', 'TPS Wilayah Kec. Karangampel', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(73, 2, 'TPS Depo Karangampel #7', NULL, 'Jl. Raya Karangampel Blok 7, Kec. Karangampel, Kab. Indramayu', '-6.4576000', '108.4423000', 'TPS Wilayah Kec. Karangampel', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(74, 2, 'TPS Balai Desa Karangampel #8', NULL, 'Jl. Raya Karangampel Blok 8, Kec. Karangampel, Kab. Indramayu', '-6.4493000', '108.4668000', 'TPS Wilayah Kec. Karangampel', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(75, 2, 'TPS Bak Terbuka Balongan #1', NULL, 'Jl. Raya Balongan Blok 1, Kec. Balongan, Kab. Indramayu', '-6.3646000', '108.3922000', 'TPS Wilayah Kec. Balongan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(76, 2, 'TPS Desa Balongan #2', NULL, 'Jl. Raya Balongan Blok 2, Kec. Balongan, Kab. Indramayu', '-6.3718000', '108.3901000', 'TPS Wilayah Kec. Balongan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(77, 2, 'TPS Kontainer Balongan #3', NULL, 'Jl. Raya Balongan Blok 3, Kec. Balongan, Kab. Indramayu', '-6.3883000', '108.3705000', 'TPS Wilayah Kec. Balongan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(78, 2, 'TPS Jalan Raya Balongan #4', NULL, 'Jl. Raya Balongan Blok 4, Kec. Balongan, Kab. Indramayu', '-6.3906000', '108.3708000', 'TPS Wilayah Kec. Balongan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(79, 2, 'TPS Pemukiman Balongan #5', NULL, 'Jl. Raya Balongan Blok 5, Kec. Balongan, Kab. Indramayu', '-6.3792000', '108.3885000', 'TPS Wilayah Kec. Balongan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(80, 2, 'TPS Simpang Balongan #6', NULL, 'Jl. Raya Balongan Blok 6, Kec. Balongan, Kab. Indramayu', '-6.3891000', '108.3895000', 'TPS Wilayah Kec. Balongan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(81, 2, 'TPS Depo Balongan #7', NULL, 'Jl. Raya Balongan Blok 7, Kec. Balongan, Kab. Indramayu', '-6.3637000', '108.3872000', 'TPS Wilayah Kec. Balongan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(82, 2, 'TPS Balai Desa Balongan #8', NULL, 'Jl. Raya Balongan Blok 8, Kec. Balongan, Kab. Indramayu', '-6.3873000', '108.3878000', 'TPS Wilayah Kec. Balongan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(83, 2, 'TPS Bak Terbuka Juntinyuat #1', NULL, 'Jl. Raya Juntinyuat Blok 1, Kec. Juntinyuat, Kab. Indramayu', '-6.4265000', '108.4057000', 'TPS Wilayah Kec. Juntinyuat', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(84, 2, 'TPS Desa Juntinyuat #2', NULL, 'Jl. Raya Juntinyuat Blok 2, Kec. Juntinyuat, Kab. Indramayu', '-6.4136000', '108.4308000', 'TPS Wilayah Kec. Juntinyuat', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(85, 2, 'TPS Kontainer Juntinyuat #3', NULL, 'Jl. Raya Juntinyuat Blok 3, Kec. Juntinyuat, Kab. Indramayu', '-6.4241000', '108.4160000', 'TPS Wilayah Kec. Juntinyuat', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(86, 2, 'TPS Jalan Raya Juntinyuat #4', NULL, 'Jl. Raya Juntinyuat Blok 4, Kec. Juntinyuat, Kab. Indramayu', '-6.4293000', '108.4161000', 'TPS Wilayah Kec. Juntinyuat', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(87, 2, 'TPS Pemukiman Juntinyuat #5', NULL, 'Jl. Raya Juntinyuat Blok 5, Kec. Juntinyuat, Kab. Indramayu', '-6.4231000', '108.4244000', 'TPS Wilayah Kec. Juntinyuat', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(88, 2, 'TPS Simpang Juntinyuat #6', NULL, 'Jl. Raya Juntinyuat Blok 6, Kec. Juntinyuat, Kab. Indramayu', '-6.4348000', '108.4238000', 'TPS Wilayah Kec. Juntinyuat', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(89, 2, 'TPS Depo Juntinyuat #7', NULL, 'Jl. Raya Juntinyuat Blok 7, Kec. Juntinyuat, Kab. Indramayu', '-6.4263000', '108.4107000', 'TPS Wilayah Kec. Juntinyuat', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(90, 2, 'TPS Balai Desa Juntinyuat #8', NULL, 'Jl. Raya Juntinyuat Blok 8, Kec. Juntinyuat, Kab. Indramayu', '-6.4241000', '108.4043000', 'TPS Wilayah Kec. Juntinyuat', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(91, 2, 'TPS Bak Terbuka Kedokan Bunder #1', NULL, 'Jl. Raya Kedokan Bunder Blok 1, Kec. Kedokan Bunder, Kab. Indramayu', '-6.4841000', '108.3997000', 'TPS Wilayah Kec. Kedokan Bunder', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(92, 2, 'TPS Desa Kedokan Bunder #2', NULL, 'Jl. Raya Kedokan Bunder Blok 2, Kec. Kedokan Bunder, Kab. Indramayu', '-6.4698000', '108.4242000', 'TPS Wilayah Kec. Kedokan Bunder', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(93, 2, 'TPS Kontainer Kedokan Bunder #3', NULL, 'Jl. Raya Kedokan Bunder Blok 3, Kec. Kedokan Bunder, Kab. Indramayu', '-6.4645000', '108.4185000', 'TPS Wilayah Kec. Kedokan Bunder', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(94, 2, 'TPS Jalan Raya Kedokan Bunder #4', NULL, 'Jl. Raya Kedokan Bunder Blok 4, Kec. Kedokan Bunder, Kab. Indramayu', '-6.4818000', '108.4219000', 'TPS Wilayah Kec. Kedokan Bunder', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(95, 2, 'TPS Pemukiman Kedokan Bunder #5', NULL, 'Jl. Raya Kedokan Bunder Blok 5, Kec. Kedokan Bunder, Kab. Indramayu', '-6.4770000', '108.4200000', 'TPS Wilayah Kec. Kedokan Bunder', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(96, 2, 'TPS Simpang Kedokan Bunder #6', NULL, 'Jl. Raya Kedokan Bunder Blok 6, Kec. Kedokan Bunder, Kab. Indramayu', '-6.4564000', '108.4225000', 'TPS Wilayah Kec. Kedokan Bunder', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(97, 2, 'TPS Depo Kedokan Bunder #7', NULL, 'Jl. Raya Kedokan Bunder Blok 7, Kec. Kedokan Bunder, Kab. Indramayu', '-6.4566000', '108.4071000', 'TPS Wilayah Kec. Kedokan Bunder', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(98, 2, 'TPS Balai Desa Kedokan Bunder #8', NULL, 'Jl. Raya Kedokan Bunder Blok 8, Kec. Kedokan Bunder, Kab. Indramayu', '-6.4831000', '108.4274000', 'TPS Wilayah Kec. Kedokan Bunder', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(99, 2, 'TPS Bak Terbuka Krangkeng #1', NULL, 'Jl. Raya Krangkeng Blok 1, Kec. Krangkeng, Kab. Indramayu', '-6.4942000', '108.4692000', 'TPS Wilayah Kec. Krangkeng', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(100, 2, 'TPS Desa Krangkeng #2', NULL, 'Jl. Raya Krangkeng Blok 2, Kec. Krangkeng, Kab. Indramayu', '-6.4948000', '108.4763000', 'TPS Wilayah Kec. Krangkeng', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(101, 2, 'TPS Kontainer Krangkeng #3', NULL, 'Jl. Raya Krangkeng Blok 3, Kec. Krangkeng, Kab. Indramayu', '-6.4974000', '108.4800000', 'TPS Wilayah Kec. Krangkeng', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(102, 2, 'TPS Jalan Raya Krangkeng #4', NULL, 'Jl. Raya Krangkeng Blok 4, Kec. Krangkeng, Kab. Indramayu', '-6.5035000', '108.4783000', 'TPS Wilayah Kec. Krangkeng', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(103, 2, 'TPS Pemukiman Krangkeng #5', NULL, 'Jl. Raya Krangkeng Blok 5, Kec. Krangkeng, Kab. Indramayu', '-6.4937000', '108.4819000', 'TPS Wilayah Kec. Krangkeng', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(104, 2, 'TPS Simpang Krangkeng #6', NULL, 'Jl. Raya Krangkeng Blok 6, Kec. Krangkeng, Kab. Indramayu', '-6.5120000', '108.4769000', 'TPS Wilayah Kec. Krangkeng', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(105, 2, 'TPS Depo Krangkeng #7', NULL, 'Jl. Raya Krangkeng Blok 7, Kec. Krangkeng, Kab. Indramayu', '-6.5184000', '108.4639000', 'TPS Wilayah Kec. Krangkeng', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(106, 2, 'TPS Balai Desa Krangkeng #8', NULL, 'Jl. Raya Krangkeng Blok 8, Kec. Krangkeng, Kab. Indramayu', '-6.5090000', '108.4800000', 'TPS Wilayah Kec. Krangkeng', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(107, 3, 'TPS Bak Terbuka Jatibarang #1', NULL, 'Jl. Raya Jatibarang Blok 1, Kec. Jatibarang, Kab. Indramayu', '-6.4803000', '108.3187000', 'TPS Wilayah Kec. Jatibarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(108, 3, 'TPS Desa Jatibarang #2', NULL, 'Jl. Raya Jatibarang Blok 2, Kec. Jatibarang, Kab. Indramayu', '-6.4700000', '108.3031000', 'TPS Wilayah Kec. Jatibarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(109, 3, 'TPS Kontainer Jatibarang #3', NULL, 'Jl. Raya Jatibarang Blok 3, Kec. Jatibarang, Kab. Indramayu', '-6.4856000', '108.2982000', 'TPS Wilayah Kec. Jatibarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(110, 3, 'TPS Jalan Raya Jatibarang #4', NULL, 'Jl. Raya Jatibarang Blok 4, Kec. Jatibarang, Kab. Indramayu', '-6.4734000', '108.3034000', 'TPS Wilayah Kec. Jatibarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(111, 3, 'TPS Pemukiman Jatibarang #5', NULL, 'Jl. Raya Jatibarang Blok 5, Kec. Jatibarang, Kab. Indramayu', '-6.4582000', '108.2970000', 'TPS Wilayah Kec. Jatibarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(112, 3, 'TPS Simpang Jatibarang #6', NULL, 'Jl. Raya Jatibarang Blok 6, Kec. Jatibarang, Kab. Indramayu', '-6.4758000', '108.3061000', 'TPS Wilayah Kec. Jatibarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(113, 3, 'TPS Depo Jatibarang #7', NULL, 'Jl. Raya Jatibarang Blok 7, Kec. Jatibarang, Kab. Indramayu', '-6.4623000', '108.3211000', 'TPS Wilayah Kec. Jatibarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(114, 3, 'TPS Balai Desa Jatibarang #8', NULL, 'Jl. Raya Jatibarang Blok 8, Kec. Jatibarang, Kab. Indramayu', '-6.4822000', '108.3137000', 'TPS Wilayah Kec. Jatibarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(115, 3, 'TPS Bak Terbuka Sliyeg #1', NULL, 'Jl. Raya Sliyeg Blok 1, Kec. Sliyeg, Kab. Indramayu', '-6.4586000', '108.3708000', 'TPS Wilayah Kec. Sliyeg', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(116, 3, 'TPS Desa Sliyeg #2', NULL, 'Jl. Raya Sliyeg Blok 2, Kec. Sliyeg, Kab. Indramayu', '-6.4423000', '108.3476000', 'TPS Wilayah Kec. Sliyeg', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(117, 3, 'TPS Kontainer Sliyeg #3', NULL, 'Jl. Raya Sliyeg Blok 3, Kec. Sliyeg, Kab. Indramayu', '-6.4396000', '108.3497000', 'TPS Wilayah Kec. Sliyeg', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(118, 3, 'TPS Jalan Raya Sliyeg #4', NULL, 'Jl. Raya Sliyeg Blok 4, Kec. Sliyeg, Kab. Indramayu', '-6.4353000', '108.3748000', 'TPS Wilayah Kec. Sliyeg', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(119, 3, 'TPS Pemukiman Sliyeg #5', NULL, 'Jl. Raya Sliyeg Blok 5, Kec. Sliyeg, Kab. Indramayu', '-6.4352000', '108.3527000', 'TPS Wilayah Kec. Sliyeg', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(120, 3, 'TPS Simpang Sliyeg #6', NULL, 'Jl. Raya Sliyeg Blok 6, Kec. Sliyeg, Kab. Indramayu', '-6.4378000', '108.3665000', 'TPS Wilayah Kec. Sliyeg', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(121, 3, 'TPS Depo Sliyeg #7', NULL, 'Jl. Raya Sliyeg Blok 7, Kec. Sliyeg, Kab. Indramayu', '-6.4355000', '108.3728000', 'TPS Wilayah Kec. Sliyeg', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(122, 3, 'TPS Balai Desa Sliyeg #8', NULL, 'Jl. Raya Sliyeg Blok 8, Kec. Sliyeg, Kab. Indramayu', '-6.4331000', '108.3682000', 'TPS Wilayah Kec. Sliyeg', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(123, 3, 'TPS Bak Terbuka Widasari #1', NULL, 'Jl. Raya Widasari Blok 1, Kec. Widasari, Kab. Indramayu', '-6.4572000', '108.2669000', 'TPS Wilayah Kec. Widasari', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(124, 3, 'TPS Desa Widasari #2', NULL, 'Jl. Raya Widasari Blok 2, Kec. Widasari, Kab. Indramayu', '-6.4687000', '108.2876000', 'TPS Wilayah Kec. Widasari', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(125, 3, 'TPS Kontainer Widasari #3', NULL, 'Jl. Raya Widasari Blok 3, Kec. Widasari, Kab. Indramayu', '-6.4622000', '108.2631000', 'TPS Wilayah Kec. Widasari', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(126, 3, 'TPS Jalan Raya Widasari #4', NULL, 'Jl. Raya Widasari Blok 4, Kec. Widasari, Kab. Indramayu', '-6.4485000', '108.2711000', 'TPS Wilayah Kec. Widasari', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(127, 3, 'TPS Pemukiman Widasari #5', NULL, 'Jl. Raya Widasari Blok 5, Kec. Widasari, Kab. Indramayu', '-6.4599000', '108.2862000', 'TPS Wilayah Kec. Widasari', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(128, 3, 'TPS Simpang Widasari #6', NULL, 'Jl. Raya Widasari Blok 6, Kec. Widasari, Kab. Indramayu', '-6.4599000', '108.2659000', 'TPS Wilayah Kec. Widasari', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(129, 3, 'TPS Depo Widasari #7', NULL, 'Jl. Raya Widasari Blok 7, Kec. Widasari, Kab. Indramayu', '-6.4518000', '108.2836000', 'TPS Wilayah Kec. Widasari', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(130, 3, 'TPS Balai Desa Widasari #8', NULL, 'Jl. Raya Widasari Blok 8, Kec. Widasari, Kab. Indramayu', '-6.4702000', '108.2731000', 'TPS Wilayah Kec. Widasari', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(131, 3, 'TPS Bak Terbuka Tukdana #1', NULL, 'Jl. Raya Tukdana Blok 1, Kec. Tukdana, Kab. Indramayu', '-6.5327000', '108.2915000', 'TPS Wilayah Kec. Tukdana', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(132, 3, 'TPS Desa Tukdana #2', NULL, 'Jl. Raya Tukdana Blok 2, Kec. Tukdana, Kab. Indramayu', '-6.5513000', '108.2926000', 'TPS Wilayah Kec. Tukdana', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(133, 3, 'TPS Kontainer Tukdana #3', NULL, 'Jl. Raya Tukdana Blok 3, Kec. Tukdana, Kab. Indramayu', '-6.5525000', '108.3033000', 'TPS Wilayah Kec. Tukdana', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(134, 3, 'TPS Jalan Raya Tukdana #4', NULL, 'Jl. Raya Tukdana Blok 4, Kec. Tukdana, Kab. Indramayu', '-6.5358000', '108.2929000', 'TPS Wilayah Kec. Tukdana', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(135, 3, 'TPS Pemukiman Tukdana #5', NULL, 'Jl. Raya Tukdana Blok 5, Kec. Tukdana, Kab. Indramayu', '-6.5444000', '108.2788000', 'TPS Wilayah Kec. Tukdana', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(136, 3, 'TPS Simpang Tukdana #6', NULL, 'Jl. Raya Tukdana Blok 6, Kec. Tukdana, Kab. Indramayu', '-6.5426000', '108.3011000', 'TPS Wilayah Kec. Tukdana', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(137, 3, 'TPS Depo Tukdana #7', NULL, 'Jl. Raya Tukdana Blok 7, Kec. Tukdana, Kab. Indramayu', '-6.5280000', '108.2990000', 'TPS Wilayah Kec. Tukdana', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(138, 3, 'TPS Balai Desa Tukdana #8', NULL, 'Jl. Raya Tukdana Blok 8, Kec. Tukdana, Kab. Indramayu', '-6.5513000', '108.2898000', 'TPS Wilayah Kec. Tukdana', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(139, 3, 'TPS Bak Terbuka Bangodua #1', NULL, 'Jl. Raya Bangodua Blok 1, Kec. Bangodua, Kab. Indramayu', '-6.5203000', '108.3098000', 'TPS Wilayah Kec. Bangodua', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(140, 3, 'TPS Desa Bangodua #2', NULL, 'Jl. Raya Bangodua Blok 2, Kec. Bangodua, Kab. Indramayu', '-6.5334000', '108.3020000', 'TPS Wilayah Kec. Bangodua', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(141, 3, 'TPS Kontainer Bangodua #3', NULL, 'Jl. Raya Bangodua Blok 3, Kec. Bangodua, Kab. Indramayu', '-6.5143000', '108.3007000', 'TPS Wilayah Kec. Bangodua', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(142, 3, 'TPS Jalan Raya Bangodua #4', NULL, 'Jl. Raya Bangodua Blok 4, Kec. Bangodua, Kab. Indramayu', '-6.5271000', '108.3063000', 'TPS Wilayah Kec. Bangodua', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(143, 3, 'TPS Pemukiman Bangodua #5', NULL, 'Jl. Raya Bangodua Blok 5, Kec. Bangodua, Kab. Indramayu', '-6.5393000', '108.3110000', 'TPS Wilayah Kec. Bangodua', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(144, 3, 'TPS Simpang Bangodua #6', NULL, 'Jl. Raya Bangodua Blok 6, Kec. Bangodua, Kab. Indramayu', '-6.5135000', '108.3107000', 'TPS Wilayah Kec. Bangodua', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(145, 3, 'TPS Depo Bangodua #7', NULL, 'Jl. Raya Bangodua Blok 7, Kec. Bangodua, Kab. Indramayu', '-6.5240000', '108.2879000', 'TPS Wilayah Kec. Bangodua', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(146, 3, 'TPS Balai Desa Bangodua #8', NULL, 'Jl. Raya Bangodua Blok 8, Kec. Bangodua, Kab. Indramayu', '-6.5213000', '108.2909000', 'TPS Wilayah Kec. Bangodua', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(147, 3, 'TPS Bak Terbuka Kertasemaya #1', NULL, 'Jl. Raya Kertasemaya Blok 1, Kec. Kertasemaya, Kab. Indramayu', '-6.5177000', '108.3452000', 'TPS Wilayah Kec. Kertasemaya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(148, 3, 'TPS Desa Kertasemaya #2', NULL, 'Jl. Raya Kertasemaya Blok 2, Kec. Kertasemaya, Kab. Indramayu', '-6.5270000', '108.3242000', 'TPS Wilayah Kec. Kertasemaya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(149, 3, 'TPS Kontainer Kertasemaya #3', NULL, 'Jl. Raya Kertasemaya Blok 3, Kec. Kertasemaya, Kab. Indramayu', '-6.5094000', '108.3239000', 'TPS Wilayah Kec. Kertasemaya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(150, 3, 'TPS Jalan Raya Kertasemaya #4', NULL, 'Jl. Raya Kertasemaya Blok 4, Kec. Kertasemaya, Kab. Indramayu', '-6.5188000', '108.3276000', 'TPS Wilayah Kec. Kertasemaya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(151, 3, 'TPS Pemukiman Kertasemaya #5', NULL, 'Jl. Raya Kertasemaya Blok 5, Kec. Kertasemaya, Kab. Indramayu', '-6.5301000', '108.3411000', 'TPS Wilayah Kec. Kertasemaya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(152, 3, 'TPS Simpang Kertasemaya #6', NULL, 'Jl. Raya Kertasemaya Blok 6, Kec. Kertasemaya, Kab. Indramayu', '-6.5064000', '108.3420000', 'TPS Wilayah Kec. Kertasemaya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(153, 3, 'TPS Depo Kertasemaya #7', NULL, 'Jl. Raya Kertasemaya Blok 7, Kec. Kertasemaya, Kab. Indramayu', '-6.5201000', '108.3317000', 'TPS Wilayah Kec. Kertasemaya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(154, 3, 'TPS Balai Desa Kertasemaya #8', NULL, 'Jl. Raya Kertasemaya Blok 8, Kec. Kertasemaya, Kab. Indramayu', '-6.5325000', '108.3382000', 'TPS Wilayah Kec. Kertasemaya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(155, 3, 'TPS Bak Terbuka Sukagumiwang #1', NULL, 'Jl. Raya Sukagumiwang Blok 1, Kec. Sukagumiwang, Kab. Indramayu', '-6.5496000', '108.3335000', 'TPS Wilayah Kec. Sukagumiwang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(156, 3, 'TPS Desa Sukagumiwang #2', NULL, 'Jl. Raya Sukagumiwang Blok 2, Kec. Sukagumiwang, Kab. Indramayu', '-6.5464000', '108.3625000', 'TPS Wilayah Kec. Sukagumiwang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(157, 3, 'TPS Kontainer Sukagumiwang #3', NULL, 'Jl. Raya Sukagumiwang Blok 3, Kec. Sukagumiwang, Kab. Indramayu', '-6.5396000', '108.3600000', 'TPS Wilayah Kec. Sukagumiwang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(158, 3, 'TPS Jalan Raya Sukagumiwang #4', NULL, 'Jl. Raya Sukagumiwang Blok 4, Kec. Sukagumiwang, Kab. Indramayu', '-6.5545000', '108.3566000', 'TPS Wilayah Kec. Sukagumiwang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(159, 3, 'TPS Pemukiman Sukagumiwang #5', NULL, 'Jl. Raya Sukagumiwang Blok 5, Kec. Sukagumiwang, Kab. Indramayu', '-6.5502000', '108.3469000', 'TPS Wilayah Kec. Sukagumiwang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(160, 3, 'TPS Simpang Sukagumiwang #6', NULL, 'Jl. Raya Sukagumiwang Blok 6, Kec. Sukagumiwang, Kab. Indramayu', '-6.5542000', '108.3619000', 'TPS Wilayah Kec. Sukagumiwang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(161, 3, 'TPS Depo Sukagumiwang #7', NULL, 'Jl. Raya Sukagumiwang Blok 7, Kec. Sukagumiwang, Kab. Indramayu', '-6.5409000', '108.3471000', 'TPS Wilayah Kec. Sukagumiwang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(162, 3, 'TPS Balai Desa Sukagumiwang #8', NULL, 'Jl. Raya Sukagumiwang Blok 8, Kec. Sukagumiwang, Kab. Indramayu', '-6.5494000', '108.3374000', 'TPS Wilayah Kec. Sukagumiwang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(163, 4, 'TPS Bak Terbuka Losarang #1', NULL, 'Jl. Raya Losarang Blok 1, Kec. Losarang, Kab. Indramayu', '-6.4136000', '108.1770000', 'TPS Wilayah Kec. Losarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(164, 4, 'TPS Desa Losarang #2', NULL, 'Jl. Raya Losarang Blok 2, Kec. Losarang, Kab. Indramayu', '-6.4290000', '108.1802000', 'TPS Wilayah Kec. Losarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(165, 4, 'TPS Kontainer Losarang #3', NULL, 'Jl. Raya Losarang Blok 3, Kec. Losarang, Kab. Indramayu', '-6.4130000', '108.1796000', 'TPS Wilayah Kec. Losarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(166, 4, 'TPS Jalan Raya Losarang #4', NULL, 'Jl. Raya Losarang Blok 4, Kec. Losarang, Kab. Indramayu', '-6.4201000', '108.1717000', 'TPS Wilayah Kec. Losarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(167, 4, 'TPS Pemukiman Losarang #5', NULL, 'Jl. Raya Losarang Blok 5, Kec. Losarang, Kab. Indramayu', '-6.4090000', '108.1681000', 'TPS Wilayah Kec. Losarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(168, 4, 'TPS Simpang Losarang #6', NULL, 'Jl. Raya Losarang Blok 6, Kec. Losarang, Kab. Indramayu', '-6.4095000', '108.1665000', 'TPS Wilayah Kec. Losarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(169, 4, 'TPS Depo Losarang #7', NULL, 'Jl. Raya Losarang Blok 7, Kec. Losarang, Kab. Indramayu', '-6.4234000', '108.1575000', 'TPS Wilayah Kec. Losarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(170, 4, 'TPS Balai Desa Losarang #8', NULL, 'Jl. Raya Losarang Blok 8, Kec. Losarang, Kab. Indramayu', '-6.4259000', '108.1759000', 'TPS Wilayah Kec. Losarang', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(171, 4, 'TPS Bak Terbuka Lelea #1', NULL, 'Jl. Raya Lelea Blok 1, Kec. Lelea, Kab. Indramayu', '-6.4492000', '108.2086000', 'TPS Wilayah Kec. Lelea', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(172, 4, 'TPS Desa Lelea #2', NULL, 'Jl. Raya Lelea Blok 2, Kec. Lelea, Kab. Indramayu', '-6.4668000', '108.2123000', 'TPS Wilayah Kec. Lelea', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(173, 4, 'TPS Kontainer Lelea #3', NULL, 'Jl. Raya Lelea Blok 3, Kec. Lelea, Kab. Indramayu', '-6.4652000', '108.2170000', 'TPS Wilayah Kec. Lelea', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(174, 4, 'TPS Jalan Raya Lelea #4', NULL, 'Jl. Raya Lelea Blok 4, Kec. Lelea, Kab. Indramayu', '-6.4584000', '108.2157000', 'TPS Wilayah Kec. Lelea', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(175, 4, 'TPS Pemukiman Lelea #5', NULL, 'Jl. Raya Lelea Blok 5, Kec. Lelea, Kab. Indramayu', '-6.4707000', '108.1904000', 'TPS Wilayah Kec. Lelea', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(176, 4, 'TPS Simpang Lelea #6', NULL, 'Jl. Raya Lelea Blok 6, Kec. Lelea, Kab. Indramayu', '-6.4520000', '108.2004000', 'TPS Wilayah Kec. Lelea', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(177, 4, 'TPS Depo Lelea #7', NULL, 'Jl. Raya Lelea Blok 7, Kec. Lelea, Kab. Indramayu', '-6.4765000', '108.1927000', 'TPS Wilayah Kec. Lelea', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(178, 4, 'TPS Balai Desa Lelea #8', NULL, 'Jl. Raya Lelea Blok 8, Kec. Lelea, Kab. Indramayu', '-6.4512000', '108.2133000', 'TPS Wilayah Kec. Lelea', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(179, 4, 'TPS Bak Terbuka Cikedung #1', NULL, 'Jl. Raya Cikedung Blok 1, Kec. Cikedung, Kab. Indramayu', '-6.5196000', '108.1632000', 'TPS Wilayah Kec. Cikedung', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(180, 4, 'TPS Desa Cikedung #2', NULL, 'Jl. Raya Cikedung Blok 2, Kec. Cikedung, Kab. Indramayu', '-6.5174000', '108.1756000', 'TPS Wilayah Kec. Cikedung', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(181, 4, 'TPS Kontainer Cikedung #3', NULL, 'Jl. Raya Cikedung Blok 3, Kec. Cikedung, Kab. Indramayu', '-6.5347000', '108.1638000', 'TPS Wilayah Kec. Cikedung', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(182, 4, 'TPS Jalan Raya Cikedung #4', NULL, 'Jl. Raya Cikedung Blok 4, Kec. Cikedung, Kab. Indramayu', '-6.5304000', '108.1817000', 'TPS Wilayah Kec. Cikedung', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(183, 4, 'TPS Pemukiman Cikedung #5', NULL, 'Jl. Raya Cikedung Blok 5, Kec. Cikedung, Kab. Indramayu', '-6.5283000', '108.1540000', 'TPS Wilayah Kec. Cikedung', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(184, 4, 'TPS Simpang Cikedung #6', NULL, 'Jl. Raya Cikedung Blok 6, Kec. Cikedung, Kab. Indramayu', '-6.5117000', '108.1736000', 'TPS Wilayah Kec. Cikedung', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(185, 4, 'TPS Depo Cikedung #7', NULL, 'Jl. Raya Cikedung Blok 7, Kec. Cikedung, Kab. Indramayu', '-6.5295000', '108.1717000', 'TPS Wilayah Kec. Cikedung', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(186, 4, 'TPS Balai Desa Cikedung #8', NULL, 'Jl. Raya Cikedung Blok 8, Kec. Cikedung, Kab. Indramayu', '-6.5249000', '108.1738000', 'TPS Wilayah Kec. Cikedung', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(187, 4, 'TPS Bak Terbuka Terisi #1', NULL, 'Jl. Raya Terisi Blok 1, Kec. Terisi, Kab. Indramayu', '-6.5342000', '108.1406000', 'TPS Wilayah Kec. Terisi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(188, 4, 'TPS Desa Terisi #2', NULL, 'Jl. Raya Terisi Blok 2, Kec. Terisi, Kab. Indramayu', '-6.5263000', '108.1441000', 'TPS Wilayah Kec. Terisi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(189, 4, 'TPS Kontainer Terisi #3', NULL, 'Jl. Raya Terisi Blok 3, Kec. Terisi, Kab. Indramayu', '-6.5328000', '108.1471000', 'TPS Wilayah Kec. Terisi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(190, 4, 'TPS Jalan Raya Terisi #4', NULL, 'Jl. Raya Terisi Blok 4, Kec. Terisi, Kab. Indramayu', '-6.5439000', '108.1368000', 'TPS Wilayah Kec. Terisi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(191, 4, 'TPS Pemukiman Terisi #5', NULL, 'Jl. Raya Terisi Blok 5, Kec. Terisi, Kab. Indramayu', '-6.5490000', '108.1331000', 'TPS Wilayah Kec. Terisi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(192, 4, 'TPS Simpang Terisi #6', NULL, 'Jl. Raya Terisi Blok 6, Kec. Terisi, Kab. Indramayu', '-6.5425000', '108.1185000', 'TPS Wilayah Kec. Terisi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(193, 4, 'TPS Depo Terisi #7', NULL, 'Jl. Raya Terisi Blok 7, Kec. Terisi, Kab. Indramayu', '-6.5475000', '108.1176000', 'TPS Wilayah Kec. Terisi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(194, 4, 'TPS Balai Desa Terisi #8', NULL, 'Jl. Raya Terisi Blok 8, Kec. Terisi, Kab. Indramayu', '-6.5529000', '108.1251000', 'TPS Wilayah Kec. Terisi', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(195, 5, 'TPS Bak Terbuka Kandanghaur #1', NULL, 'Jl. Raya Kandanghaur Blok 1, Kec. Kandanghaur, Kab. Indramayu', '-6.3494000', '108.0923000', 'TPS Wilayah Kec. Kandanghaur', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(196, 5, 'TPS Desa Kandanghaur #2', NULL, 'Jl. Raya Kandanghaur Blok 2, Kec. Kandanghaur, Kab. Indramayu', '-6.3431000', '108.0789000', 'TPS Wilayah Kec. Kandanghaur', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(197, 5, 'TPS Kontainer Kandanghaur #3', NULL, 'Jl. Raya Kandanghaur Blok 3, Kec. Kandanghaur, Kab. Indramayu', '-6.3577000', '108.0825000', 'TPS Wilayah Kec. Kandanghaur', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(198, 5, 'TPS Jalan Raya Kandanghaur #4', NULL, 'Jl. Raya Kandanghaur Blok 4, Kec. Kandanghaur, Kab. Indramayu', '-6.3293000', '108.0870000', 'TPS Wilayah Kec. Kandanghaur', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(199, 5, 'TPS Pemukiman Kandanghaur #5', NULL, 'Jl. Raya Kandanghaur Blok 5, Kec. Kandanghaur, Kab. Indramayu', '-6.3495000', '108.0870000', 'TPS Wilayah Kec. Kandanghaur', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(200, 5, 'TPS Simpang Kandanghaur #6', NULL, 'Jl. Raya Kandanghaur Blok 6, Kec. Kandanghaur, Kab. Indramayu', '-6.3347000', '108.0838000', 'TPS Wilayah Kec. Kandanghaur', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(201, 5, 'TPS Depo Kandanghaur #7', NULL, 'Jl. Raya Kandanghaur Blok 7, Kec. Kandanghaur, Kab. Indramayu', '-6.3542000', '108.0873000', 'TPS Wilayah Kec. Kandanghaur', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(202, 5, 'TPS Balai Desa Kandanghaur #8', NULL, 'Jl. Raya Kandanghaur Blok 8, Kec. Kandanghaur, Kab. Indramayu', '-6.3571000', '108.0969000', 'TPS Wilayah Kec. Kandanghaur', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(203, 5, 'TPS Bak Terbuka Gabuswetan #1', NULL, 'Jl. Raya Gabuswetan Blok 1, Kec. Gabuswetan, Kab. Indramayu', '-6.4301000', '108.0796000', 'TPS Wilayah Kec. Gabuswetan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(204, 5, 'TPS Desa Gabuswetan #2', NULL, 'Jl. Raya Gabuswetan Blok 2, Kec. Gabuswetan, Kab. Indramayu', '-6.4137000', '108.0851000', 'TPS Wilayah Kec. Gabuswetan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(205, 5, 'TPS Kontainer Gabuswetan #3', NULL, 'Jl. Raya Gabuswetan Blok 3, Kec. Gabuswetan, Kab. Indramayu', '-6.4160000', '108.0898000', 'TPS Wilayah Kec. Gabuswetan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(206, 5, 'TPS Jalan Raya Gabuswetan #4', NULL, 'Jl. Raya Gabuswetan Blok 4, Kec. Gabuswetan, Kab. Indramayu', '-6.4216000', '108.0899000', 'TPS Wilayah Kec. Gabuswetan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(207, 5, 'TPS Pemukiman Gabuswetan #5', NULL, 'Jl. Raya Gabuswetan Blok 5, Kec. Gabuswetan, Kab. Indramayu', '-6.4306000', '108.0974000', 'TPS Wilayah Kec. Gabuswetan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(208, 5, 'TPS Simpang Gabuswetan #6', NULL, 'Jl. Raya Gabuswetan Blok 6, Kec. Gabuswetan, Kab. Indramayu', '-6.4399000', '108.0870000', 'TPS Wilayah Kec. Gabuswetan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(209, 5, 'TPS Depo Gabuswetan #7', NULL, 'Jl. Raya Gabuswetan Blok 7, Kec. Gabuswetan, Kab. Indramayu', '-6.4202000', '108.0790000', 'TPS Wilayah Kec. Gabuswetan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(210, 5, 'TPS Balai Desa Gabuswetan #8', NULL, 'Jl. Raya Gabuswetan Blok 8, Kec. Gabuswetan, Kab. Indramayu', '-6.4323000', '108.0785000', 'TPS Wilayah Kec. Gabuswetan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(211, 5, 'TPS Bak Terbuka Kroya #1', NULL, 'Jl. Raya Kroya Blok 1, Kec. Kroya, Kab. Indramayu', '-6.4917000', '108.0649000', 'TPS Wilayah Kec. Kroya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(212, 5, 'TPS Desa Kroya #2', NULL, 'Jl. Raya Kroya Blok 2, Kec. Kroya, Kab. Indramayu', '-6.4994000', '108.0524000', 'TPS Wilayah Kec. Kroya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(213, 5, 'TPS Kontainer Kroya #3', NULL, 'Jl. Raya Kroya Blok 3, Kec. Kroya, Kab. Indramayu', '-6.4993000', '108.0505000', 'TPS Wilayah Kec. Kroya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(214, 5, 'TPS Jalan Raya Kroya #4', NULL, 'Jl. Raya Kroya Blok 4, Kec. Kroya, Kab. Indramayu', '-6.4862000', '108.0592000', 'TPS Wilayah Kec. Kroya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(215, 5, 'TPS Pemukiman Kroya #5', NULL, 'Jl. Raya Kroya Blok 5, Kec. Kroya, Kab. Indramayu', '-6.4876000', '108.0723000', 'TPS Wilayah Kec. Kroya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(216, 5, 'TPS Simpang Kroya #6', NULL, 'Jl. Raya Kroya Blok 6, Kec. Kroya, Kab. Indramayu', '-6.5001000', '108.0548000', 'TPS Wilayah Kec. Kroya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(217, 5, 'TPS Depo Kroya #7', NULL, 'Jl. Raya Kroya Blok 7, Kec. Kroya, Kab. Indramayu', '-6.4944000', '108.0587000', 'TPS Wilayah Kec. Kroya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(218, 5, 'TPS Balai Desa Kroya #8', NULL, 'Jl. Raya Kroya Blok 8, Kec. Kroya, Kab. Indramayu', '-6.4999000', '108.0591000', 'TPS Wilayah Kec. Kroya', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(219, 5, 'TPS Bak Terbuka Bongas #1', NULL, 'Jl. Raya Bongas Blok 1, Kec. Bongas, Kab. Indramayu', '-6.3972000', '108.0371000', 'TPS Wilayah Kec. Bongas', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL);
INSERT INTO `tps` (`id`, `id_wilayah`, `nama_tps`, `lokasi`, `alamat`, `latitude`, `longitude`, `keterangan`, `created_at`, `updated_at`, `status`, `last_cleaned_at`, `last_reported_at`) VALUES
(220, 5, 'TPS Desa Bongas #2', NULL, 'Jl. Raya Bongas Blok 2, Kec. Bongas, Kab. Indramayu', '-6.4087000', '108.0168000', 'TPS Wilayah Kec. Bongas', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(221, 5, 'TPS Kontainer Bongas #3', NULL, 'Jl. Raya Bongas Blok 3, Kec. Bongas, Kab. Indramayu', '-6.4077000', '108.0296000', 'TPS Wilayah Kec. Bongas', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(222, 5, 'TPS Jalan Raya Bongas #4', NULL, 'Jl. Raya Bongas Blok 4, Kec. Bongas, Kab. Indramayu', '-6.4128000', '108.0213000', 'TPS Wilayah Kec. Bongas', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(223, 5, 'TPS Pemukiman Bongas #5', NULL, 'Jl. Raya Bongas Blok 5, Kec. Bongas, Kab. Indramayu', '-6.4011000', '108.0304000', 'TPS Wilayah Kec. Bongas', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(224, 5, 'TPS Simpang Bongas #6', NULL, 'Jl. Raya Bongas Blok 6, Kec. Bongas, Kab. Indramayu', '-6.3871000', '108.0275000', 'TPS Wilayah Kec. Bongas', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(225, 5, 'TPS Depo Bongas #7', NULL, 'Jl. Raya Bongas Blok 7, Kec. Bongas, Kab. Indramayu', '-6.3948000', '108.0439000', 'TPS Wilayah Kec. Bongas', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(226, 5, 'TPS Balai Desa Bongas #8', NULL, 'Jl. Raya Bongas Blok 8, Kec. Bongas, Kab. Indramayu', '-6.4010000', '108.0241000', 'TPS Wilayah Kec. Bongas', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(227, 6, 'TPS Bak Terbuka Haurgeulis #1', NULL, 'Jl. Raya Haurgeulis Blok 1, Kec. Haurgeulis, Kab. Indramayu', '-6.4569000', '107.9323000', 'TPS Wilayah Kec. Haurgeulis', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(228, 6, 'TPS Desa Haurgeulis #2', NULL, 'Jl. Raya Haurgeulis Blok 2, Kec. Haurgeulis, Kab. Indramayu', '-6.4488000', '107.9458000', 'TPS Wilayah Kec. Haurgeulis', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(229, 6, 'TPS Kontainer Haurgeulis #3', NULL, 'Jl. Raya Haurgeulis Blok 3, Kec. Haurgeulis, Kab. Indramayu', '-6.4587000', '107.9442000', 'TPS Wilayah Kec. Haurgeulis', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(230, 6, 'TPS Jalan Raya Haurgeulis #4', NULL, 'Jl. Raya Haurgeulis Blok 4, Kec. Haurgeulis, Kab. Indramayu', '-6.4647000', '107.9329000', 'TPS Wilayah Kec. Haurgeulis', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(231, 6, 'TPS Pemukiman Haurgeulis #5', NULL, 'Jl. Raya Haurgeulis Blok 5, Kec. Haurgeulis, Kab. Indramayu', '-6.4539000', '107.9289000', 'TPS Wilayah Kec. Haurgeulis', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(232, 6, 'TPS Simpang Haurgeulis #6', NULL, 'Jl. Raya Haurgeulis Blok 6, Kec. Haurgeulis, Kab. Indramayu', '-6.4674000', '107.9440000', 'TPS Wilayah Kec. Haurgeulis', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(233, 6, 'TPS Depo Haurgeulis #7', NULL, 'Jl. Raya Haurgeulis Blok 7, Kec. Haurgeulis, Kab. Indramayu', '-6.4638000', '107.9493000', 'TPS Wilayah Kec. Haurgeulis', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(234, 6, 'TPS Balai Desa Haurgeulis #8', NULL, 'Jl. Raya Haurgeulis Blok 8, Kec. Haurgeulis, Kab. Indramayu', '-6.4567000', '107.9503000', 'TPS Wilayah Kec. Haurgeulis', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(235, 6, 'TPS Bak Terbuka Patrol #1', NULL, 'Jl. Raya Patrol Blok 1, Kec. Patrol, Kab. Indramayu', '-6.3127000', '107.9910000', 'TPS Wilayah Kec. Patrol', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(236, 6, 'TPS Desa Patrol #2', NULL, 'Jl. Raya Patrol Blok 2, Kec. Patrol, Kab. Indramayu', '-6.3322000', '107.9841000', 'TPS Wilayah Kec. Patrol', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(237, 6, 'TPS Kontainer Patrol #3', NULL, 'Jl. Raya Patrol Blok 3, Kec. Patrol, Kab. Indramayu', '-6.3085000', '107.9866000', 'TPS Wilayah Kec. Patrol', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(238, 6, 'TPS Jalan Raya Patrol #4', NULL, 'Jl. Raya Patrol Blok 4, Kec. Patrol, Kab. Indramayu', '-6.3072000', '107.9911000', 'TPS Wilayah Kec. Patrol', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(239, 6, 'TPS Pemukiman Patrol #5', NULL, 'Jl. Raya Patrol Blok 5, Kec. Patrol, Kab. Indramayu', '-6.3147000', '107.9797000', 'TPS Wilayah Kec. Patrol', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(240, 6, 'TPS Simpang Patrol #6', NULL, 'Jl. Raya Patrol Blok 6, Kec. Patrol, Kab. Indramayu', '-6.3212000', '107.9854000', 'TPS Wilayah Kec. Patrol', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(241, 6, 'TPS Depo Patrol #7', NULL, 'Jl. Raya Patrol Blok 7, Kec. Patrol, Kab. Indramayu', '-6.3053000', '107.9921000', 'TPS Wilayah Kec. Patrol', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(242, 6, 'TPS Balai Desa Patrol #8', NULL, 'Jl. Raya Patrol Blok 8, Kec. Patrol, Kab. Indramayu', '-6.3206000', '107.9860000', 'TPS Wilayah Kec. Patrol', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(243, 6, 'TPS Bak Terbuka Anjatan #1', NULL, 'Jl. Raya Anjatan Blok 1, Kec. Anjatan, Kab. Indramayu', '-6.3775000', '107.9575000', 'TPS Wilayah Kec. Anjatan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(244, 6, 'TPS Desa Anjatan #2', NULL, 'Jl. Raya Anjatan Blok 2, Kec. Anjatan, Kab. Indramayu', '-6.3793000', '107.9395000', 'TPS Wilayah Kec. Anjatan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(245, 6, 'TPS Kontainer Anjatan #3', NULL, 'Jl. Raya Anjatan Blok 3, Kec. Anjatan, Kab. Indramayu', '-6.3758000', '107.9392000', 'TPS Wilayah Kec. Anjatan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(246, 6, 'TPS Jalan Raya Anjatan #4', NULL, 'Jl. Raya Anjatan Blok 4, Kec. Anjatan, Kab. Indramayu', '-6.3590000', '107.9514000', 'TPS Wilayah Kec. Anjatan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(247, 6, 'TPS Pemukiman Anjatan #5', NULL, 'Jl. Raya Anjatan Blok 5, Kec. Anjatan, Kab. Indramayu', '-6.3691000', '107.9396000', 'TPS Wilayah Kec. Anjatan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(248, 6, 'TPS Simpang Anjatan #6', NULL, 'Jl. Raya Anjatan Blok 6, Kec. Anjatan, Kab. Indramayu', '-6.3615000', '107.9583000', 'TPS Wilayah Kec. Anjatan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(249, 6, 'TPS Depo Anjatan #7', NULL, 'Jl. Raya Anjatan Blok 7, Kec. Anjatan, Kab. Indramayu', '-6.3552000', '107.9641000', 'TPS Wilayah Kec. Anjatan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(250, 6, 'TPS Balai Desa Anjatan #8', NULL, 'Jl. Raya Anjatan Blok 8, Kec. Anjatan, Kab. Indramayu', '-6.3792000', '107.9549000', 'TPS Wilayah Kec. Anjatan', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(251, 6, 'TPS Bak Terbuka Gantar #1', NULL, 'Jl. Raya Gantar Blok 1, Kec. Gantar, Kab. Indramayu', '-6.5126000', '107.9338000', 'TPS Wilayah Kec. Gantar', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(252, 6, 'TPS Desa Gantar #2', NULL, 'Jl. Raya Gantar Blok 2, Kec. Gantar, Kab. Indramayu', '-6.5307000', '107.9231000', 'TPS Wilayah Kec. Gantar', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(253, 6, 'TPS Kontainer Gantar #3', NULL, 'Jl. Raya Gantar Blok 3, Kec. Gantar, Kab. Indramayu', '-6.5101000', '107.9318000', 'TPS Wilayah Kec. Gantar', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(254, 6, 'TPS Jalan Raya Gantar #4', NULL, 'Jl. Raya Gantar Blok 4, Kec. Gantar, Kab. Indramayu', '-6.5171000', '107.9259000', 'TPS Wilayah Kec. Gantar', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(255, 6, 'TPS Pemukiman Gantar #5', NULL, 'Jl. Raya Gantar Blok 5, Kec. Gantar, Kab. Indramayu', '-6.5259000', '107.9203000', 'TPS Wilayah Kec. Gantar', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(256, 6, 'TPS Simpang Gantar #6', NULL, 'Jl. Raya Gantar Blok 6, Kec. Gantar, Kab. Indramayu', '-6.5258000', '107.9137000', 'TPS Wilayah Kec. Gantar', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(257, 6, 'TPS Depo Gantar #7', NULL, 'Jl. Raya Gantar Blok 7, Kec. Gantar, Kab. Indramayu', '-6.5056000', '107.9226000', 'TPS Wilayah Kec. Gantar', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(258, 6, 'TPS Balai Desa Gantar #8', NULL, 'Jl. Raya Gantar Blok 8, Kec. Gantar, Kab. Indramayu', '-6.5046000', '107.9112000', 'TPS Wilayah Kec. Gantar', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(259, 6, 'TPS Bak Terbuka Sukra #1', NULL, 'Jl. Raya Sukra Blok 1, Kec. Sukra, Kab. Indramayu', '-6.3176000', '107.9574000', 'TPS Wilayah Kec. Sukra', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(260, 6, 'TPS Desa Sukra #2', NULL, 'Jl. Raya Sukra Blok 2, Kec. Sukra, Kab. Indramayu', '-6.3054000', '107.9506000', 'TPS Wilayah Kec. Sukra', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(261, 6, 'TPS Kontainer Sukra #3', NULL, 'Jl. Raya Sukra Blok 3, Kec. Sukra, Kab. Indramayu', '-6.3143000', '107.9485000', 'TPS Wilayah Kec. Sukra', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(262, 6, 'TPS Jalan Raya Sukra #4', NULL, 'Jl. Raya Sukra Blok 4, Kec. Sukra, Kab. Indramayu', '-6.3138000', '107.9428000', 'TPS Wilayah Kec. Sukra', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(263, 6, 'TPS Pemukiman Sukra #5', NULL, 'Jl. Raya Sukra Blok 5, Kec. Sukra, Kab. Indramayu', '-6.3013000', '107.9601000', 'TPS Wilayah Kec. Sukra', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(264, 6, 'TPS Simpang Sukra #6', NULL, 'Jl. Raya Sukra Blok 6, Kec. Sukra, Kab. Indramayu', '-6.3115000', '107.9515000', 'TPS Wilayah Kec. Sukra', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(265, 6, 'TPS Depo Sukra #7', NULL, 'Jl. Raya Sukra Blok 7, Kec. Sukra, Kab. Indramayu', '-6.3206000', '107.9485000', 'TPS Wilayah Kec. Sukra', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL),
(266, 6, 'TPS Balai Desa Sukra #8', NULL, 'Jl. Raya Sukra Blok 8, Kec. Sukra, Kab. Indramayu', '-6.3152000', '107.9372000', 'TPS Wilayah Kec. Sukra', '2026-11-20 06:19:09', '2026-11-20 06:19:09', 'bersih', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_spammer` tinyint(1) NOT NULL DEFAULT '0',
  `spam_score` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('masyarakat','uptd','supir','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'masyarakat',
  `id_wilayah` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_spammer`, `spam_score`, `created_at`, `updated_at`, `role`, `id_wilayah`) VALUES
(12, 'Admin', 'admin@gmail.com', '2026-11-20 12:56:44', '$2y$12$Bs1Uh3xIDnJgKXVUvb3RLOpdnfhBovJ6AuoPJMjNC2X8Mz840PtJy', NULL, 0, 0, '2026-11-20 04:50:43', '2026-11-20 04:58:07', 'admin', NULL),
(13, 'Petugas UPTD', 'uptd@gmail.com', '2026-11-20 12:56:44', '$2y$12$Lu3wXy2YvurrJXaiFTQGe.NPImdRlyTVmkb3NOeHMfXGTf3E2zPYu', NULL, 0, 0, '2026-11-20 04:50:43', '2026-11-20 04:58:07', 'uptd', NULL),
(14, 'Supir Armada', 'supir@gmail.com', '2026-11-20 12:56:44', '$2y$12$5dsaSCcY24n3yLKc1QPzb.T/Twyl39ly2BAkW/qSAeUue1/LtQjAu', NULL, 0, 0, '2026-11-20 04:50:43', '2026-11-20 04:58:07', 'supir', NULL),
(19, 'Wildan', 'wildan@gmail.com', '2026-11-20 12:56:44', '$2y$12$9dlWVoCegsZ6KZis2JXlTe29zxyNGxqIUwp9XhCAaVSthmZNES/my', NULL, 0, 0, '2026-11-20 04:53:27', '2026-11-20 04:58:08', 'masyarakat', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wilayahs`
--

CREATE TABLE `wilayahs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_wilayah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wilayahs`
--

INSERT INTO `wilayahs` (`id`, `nama_wilayah`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'UPTD Kebersihan Indramayu', 'Meliputi Kecamatan Indramayu, Sindang, Pasekan, Cantigi, Arahan, dan Lohbener', '2026-11-20 13:14:46', '2026-11-20 13:14:46'),
(2, 'UPTD Kebersihan Karangampel', 'Meliputi Kecamatan Karangampel, Balongan, Juntinyuat, Kedokan Bunder, dan Krangkeng', '2026-11-20 13:14:46', '2026-11-20 13:14:46'),
(3, 'UPTD Kebersihan Jatibarang', 'Meliputi Kecamatan Jatibarang, Sliyeg, Widasari, Tukdana, Bangodua, Kertasemaya, dan Sukagumiwang', '2026-11-20 13:14:46', '2026-11-20 13:14:46'),
(4, 'UPTD Kebersihan Losarang', 'Meliputi Kecamatan Losarang, Lelea, Cikedung, dan Terisi', '2026-11-20 13:14:46', '2026-11-20 13:14:46'),
(5, 'UPTD Kebersihan Kandanghaur', 'Meliputi Kecamatan Kandanghaur, Gabuswetan, Kroya, dan Bongas', '2026-11-20 13:14:46', '2026-11-20 13:14:46'),
(6, 'UPTD Kebersihan Haurgeulis', 'Meliputi Kecamatan Haurgeulis, Patrol, Anjatan, Gantar, dan Sukra', '2026-11-20 13:14:46', '2026-11-20 13:14:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armadas`
--
ALTER TABLE `armadas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `armadas_kode_armada_unique` (`kode_armada`),
  ADD KEY `armadas_id_wilayah_foreign` (`id_wilayah`);

--
-- Indexes for table `bukti_penanganans`
--
ALTER TABLE `bukti_penanganans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bukti_penanganans_id_laporan_foreign` (`id_laporan`),
  ADD KEY `bukti_penanganans_id_supir_foreign` (`id_supir`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `deteksi_spams`
--
ALTER TABLE `deteksi_spams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deteksi_spams_id_laporan_foreign` (`id_laporan`),
  ADD KEY `deteksi_spams_id_tps_jenis_deteksi_index` (`id_tps`,`jenis_deteksi`),
  ADD KEY `deteksi_spams_status_peninjauan_created_at_index` (`status_peninjauan`,`created_at`),
  ADD KEY `deteksi_spams_id_pengguna_jenis_deteksi_index` (`id_pengguna`,`jenis_deteksi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `foto_laporans`
--
ALTER TABLE `foto_laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_laporans_id_laporan_foreign` (`id_laporan`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporans_id_pengguna_foreign` (`id_pengguna`),
  ADD KEY `laporans_id_tps_foreign` (`id_tps`),
  ADD KEY `laporans_id_supir_foreign` (`id_supir`),
  ADD KEY `laporans_id_armada_foreign` (`id_armada`);

--
-- Indexes for table `lokasi_supirs`
--
ALTER TABLE `lokasi_supirs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lokasi_supirs_id_supir_unique` (`id_supir`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaturan_landing_pages`
--
ALTER TABLE `pengaturan_landing_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengaturan_landing_pages_kunci_unique` (`kunci`);

--
-- Indexes for table `penilaian_urgensi`
--
ALTER TABLE `penilaian_urgensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_urgensi_id_penilai_foreign` (`id_penilai`),
  ADD KEY `penilaian_urgensi_id_laporan_jenis_penilaian_index` (`id_laporan`,`jenis_penilaian`);

--
-- Indexes for table `riwayat_statuses`
--
ALTER TABLE `riwayat_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_statuses_id_laporan_foreign` (`id_laporan`),
  ADD KEY `riwayat_statuses_id_pengguna_foreign` (`id_pengguna`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `supir_tps`
--
ALTER TABLE `supir_tps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supir_tps_id_supir_id_tps_unique` (`id_supir`,`id_tps`),
  ADD KEY `supir_tps_id_tps_status_index` (`id_tps`,`status`);

--
-- Indexes for table `tps`
--
ALTER TABLE `tps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tps_id_wilayah_foreign` (`id_wilayah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_wilayah_foreign` (`id_wilayah`);

--
-- Indexes for table `wilayahs`
--
ALTER TABLE `wilayahs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armadas`
--
ALTER TABLE `armadas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bukti_penanganans`
--
ALTER TABLE `bukti_penanganans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deteksi_spams`
--
ALTER TABLE `deteksi_spams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_laporans`
--
ALTER TABLE `foto_laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lokasi_supirs`
--
ALTER TABLE `lokasi_supirs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pengaturan_landing_pages`
--
ALTER TABLE `pengaturan_landing_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaian_urgensi`
--
ALTER TABLE `penilaian_urgensi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `riwayat_statuses`
--
ALTER TABLE `riwayat_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supir_tps`
--
ALTER TABLE `supir_tps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tps`
--
ALTER TABLE `tps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `wilayahs`
--
ALTER TABLE `wilayahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `armadas`
--
ALTER TABLE `armadas`
  ADD CONSTRAINT `armadas_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayahs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `bukti_penanganans`
--
ALTER TABLE `bukti_penanganans`
  ADD CONSTRAINT `bukti_penanganans_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bukti_penanganans_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `deteksi_spams`
--
ALTER TABLE `deteksi_spams`
  ADD CONSTRAINT `deteksi_spams_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `deteksi_spams_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `deteksi_spams_id_tps_foreign` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `foto_laporans`
--
ALTER TABLE `foto_laporans`
  ADD CONSTRAINT `foto_laporans_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_id_armada_foreign` FOREIGN KEY (`id_armada`) REFERENCES `armadas` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `laporans_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `laporans_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `laporans_id_tps_foreign` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `lokasi_supirs`
--
ALTER TABLE `lokasi_supirs`
  ADD CONSTRAINT `lokasi_supirs_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian_urgensi`
--
ALTER TABLE `penilaian_urgensi`
  ADD CONSTRAINT `penilaian_urgensi_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_urgensi_id_penilai_foreign` FOREIGN KEY (`id_penilai`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `riwayat_statuses`
--
ALTER TABLE `riwayat_statuses`
  ADD CONSTRAINT `riwayat_statuses_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_statuses_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `supir_tps`
--
ALTER TABLE `supir_tps`
  ADD CONSTRAINT `supir_tps_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supir_tps_id_tps_foreign` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tps`
--
ALTER TABLE `tps`
  ADD CONSTRAINT `tps_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayahs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayahs` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
