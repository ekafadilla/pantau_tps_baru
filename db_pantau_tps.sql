-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: pantau_tps_baru
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `armadas`
--

DROP TABLE IF EXISTS `armadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `armadas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_wilayah` bigint unsigned NOT NULL,
  `kode_armada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_armada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_polisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_armada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `armadas_kode_armada_unique` (`kode_armada`),
  KEY `armadas_id_wilayah_foreign` (`id_wilayah`),
  CONSTRAINT `armadas_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayahs` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armadas`
--

LOCK TABLES `armadas` WRITE;
/*!40000 ALTER TABLE `armadas` DISABLE KEYS */;
/*!40000 ALTER TABLE `armadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bukti_penanganans`
--

DROP TABLE IF EXISTS `bukti_penanganans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bukti_penanganans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_laporan` bigint unsigned NOT NULL,
  `id_supir` bigint unsigned NOT NULL,
  `foto_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_pengiriman` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bukti_penanganans_id_laporan_foreign` (`id_laporan`),
  KEY `bukti_penanganans_id_supir_foreign` (`id_supir`),
  CONSTRAINT `bukti_penanganans_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bukti_penanganans_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bukti_penanganans`
--

LOCK TABLES `bukti_penanganans` WRITE;
/*!40000 ALTER TABLE `bukti_penanganans` DISABLE KEYS */;
/*!40000 ALTER TABLE `bukti_penanganans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deteksi_spams`
--

DROP TABLE IF EXISTS `deteksi_spams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deteksi_spams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_laporan` bigint unsigned DEFAULT NULL,
  `id_tps` bigint unsigned NOT NULL,
  `id_pengguna` bigint unsigned DEFAULT NULL,
  `jenis_deteksi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_laporan` int unsigned NOT NULL DEFAULT '1',
  `jumlah_pengguna` int unsigned NOT NULL DEFAULT '1',
  `periode_mulai` timestamp NULL DEFAULT NULL,
  `periode_selesai` timestamp NULL DEFAULT NULL,
  `status_peninjauan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'perlu_ditinjau',
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `catatan_uptd` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deteksi_spams_id_laporan_foreign` (`id_laporan`),
  KEY `deteksi_spams_id_tps_jenis_deteksi_index` (`id_tps`,`jenis_deteksi`),
  KEY `deteksi_spams_status_peninjauan_created_at_index` (`status_peninjauan`,`created_at`),
  KEY `deteksi_spams_id_pengguna_jenis_deteksi_index` (`id_pengguna`,`jenis_deteksi`),
  CONSTRAINT `deteksi_spams_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `deteksi_spams_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `deteksi_spams_id_tps_foreign` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deteksi_spams`
--

LOCK TABLES `deteksi_spams` WRITE;
/*!40000 ALTER TABLE `deteksi_spams` DISABLE KEYS */;
/*!40000 ALTER TABLE `deteksi_spams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foto_laporans`
--

DROP TABLE IF EXISTS `foto_laporans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foto_laporans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_laporan` bigint unsigned NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foto_laporans_id_laporan_foreign` (`id_laporan`),
  CONSTRAINT `foto_laporans_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto_laporans`
--

LOCK TABLES `foto_laporans` WRITE;
/*!40000 ALTER TABLE `foto_laporans` DISABLE KEYS */;
/*!40000 ALTER TABLE `foto_laporans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporans`
--

DROP TABLE IF EXISTS `laporans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laporans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pengguna` bigint unsigned NOT NULL,
  `id_tps` bigint unsigned NOT NULL,
  `id_supir` bigint unsigned DEFAULT NULL,
  `id_armada` bigint unsigned DEFAULT NULL,
  `kategori_kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_pelaporan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tingkat_urgensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_waktu` timestamp NULL DEFAULT NULL,
  `instruksi_penanganan` text COLLATE utf8mb4_unicode_ci,
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_kirim_pemeriksaan` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporans_id_pengguna_foreign` (`id_pengguna`),
  KEY `laporans_id_tps_foreign` (`id_tps`),
  KEY `laporans_id_supir_foreign` (`id_supir`),
  KEY `laporans_id_armada_foreign` (`id_armada`),
  CONSTRAINT `laporans_id_armada_foreign` FOREIGN KEY (`id_armada`) REFERENCES `armadas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `laporans_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `laporans_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `laporans_id_tps_foreign` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporans`
--

LOCK TABLES `laporans` WRITE;
/*!40000 ALTER TABLE `laporans` DISABLE KEYS */;
INSERT INTO `laporans` VALUES (1,1,1,NULL,NULL,'Sampah Menumpuk','Area depan TPS - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Sampah terlihat menumpuk dan belum seluruhnya terangkut.','2026-10-28 11:03:53','menunggu','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(2,1,1,NULL,NULL,'Sampah Berserakan','Sisi jalan dekat TPS - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Beberapa sampah berserakan di sekitar tempat penampungan.','2026-10-27 10:03:53','diverifikasi','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(3,1,1,NULL,NULL,'TPS Penuh','Bagian utama TPS - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Kapasitas penampungan terlihat hampir penuh.','2026-10-26 09:03:53','diproses','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(4,1,1,NULL,NULL,'Sampah Menumpuk','Pintu masuk TPS - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Tumpukan sampah menghalangi sebagian akses masuk.','2026-10-25 08:03:53','ditangani','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(5,1,1,NULL,NULL,'Sampah Berserakan','Area sekitar kontainer - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Ditemukan sampah di luar area penampungan.','2026-10-24 07:03:53','selesai','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(6,1,1,NULL,NULL,'TPS Penuh','Samping tempat penampungan - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Sampah terlihat melebihi batas area penampungan.','2026-10-23 06:03:53','menunggu','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(7,1,1,NULL,NULL,'Sampah Menumpuk','Area belakang TPS - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Terdapat tumpukan sampah yang perlu diperiksa petugas.','2026-10-22 05:03:53','diproses','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(8,1,1,NULL,NULL,'Kondisi TPS','Area sekitar TPS - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Laporan contoh untuk pengujian tampilan dan filter.','2026-10-21 04:03:53','ditolak','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(9,1,1,NULL,NULL,'Sampah Berserakan','Jalan di dekat TPS - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Sampah ditemukan di sekitar akses jalan menuju TPS.','2026-10-20 03:03:53','diverifikasi','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL),(10,1,1,NULL,NULL,'TPS Penuh','Bagian depan penampungan - UPTD Kebersihan Indramayu',NULL,NULL,'[DUMMY] [DUMMY] Laporan simulasi untuk pengujian daftar laporan.','2026-10-19 02:03:53','selesai','2026-10-28 11:03:53','2026-10-28 11:03:53',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `laporans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lokasi_supirs`
--

DROP TABLE IF EXISTS `lokasi_supirs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lokasi_supirs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_supir` bigint unsigned NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `akurasi` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lokasi_supirs_id_supir_unique` (`id_supir`),
  CONSTRAINT `lokasi_supirs_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lokasi_supirs`
--

LOCK TABLES `lokasi_supirs` WRITE;
/*!40000 ALTER TABLE `lokasi_supirs` DISABLE KEYS */;
/*!40000 ALTER TABLE `lokasi_supirs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_27_182812_add_role_to_users_table',2),(5,'2026_10_27_185937_create_wilayahs_table',3),(6,'2026_10_27_185938_create_tps_table',3),(7,'2026_10_27_185939_create_laporans_table',3),(8,'2026_10_27_185940_create_foto_laporans_table',3),(9,'2026_10_27_185941_create_riwayat_statuses_table',3),(10,'2026_10_27_203020_add_id_wilayah_to_users_table',4),(11,'2026_10_28_000001_create_armadas_and_add_penugasan_to_laporans',5),(12,'2026_10_28_181500_create_pengaturan_landing_pages_table',6),(13,'2024_10_01_000001_add_spam_columns_to_users_table',7),(14,'2026_11_10_180342_create_penilaian_urgensi_table',7),(15,'2026_11_10_184209_create_supir_tps_table',7),(16,'2026_11_18_064919_add_coordinates_to_laporans_table',7),(17,'2026_11_18_100000_create_lokasi_supirs_table',7),(18,'2026_11_18_110322_tandai_akun_lama_terverifikasi',7),(19,'2026_11_20_000001_add_lokasi_to_tps_table',7),(20,'2026_11_20_044659_create_deteksi_spams_table',7),(21,'2026_11_20_045226_add_jumlah_pengguna_to_deteksi_spams_table',7),(22,'2026_11_20_045331_add_jumlah_pengguna_column_to_deteksi_spams_table',7),(23,'2026_11_24_152028_add_catatan_uptd_to_deteksi_spams_table',7),(24,'2026_11_24_183415_add_status_kehadiran_to_users_table',7),(25,'2026_11_24_184230_add_keterangan_to_armadas_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengaturan_landing_pages`
--

DROP TABLE IF EXISTS `pengaturan_landing_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengaturan_landing_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kunci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengaturan_landing_pages_kunci_unique` (`kunci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaturan_landing_pages`
--

LOCK TABLES `pengaturan_landing_pages` WRITE;
/*!40000 ALTER TABLE `pengaturan_landing_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengaturan_landing_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penilaian_urgensi`
--

DROP TABLE IF EXISTS `penilaian_urgensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penilaian_urgensi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_laporan` bigint unsigned NOT NULL,
  `jenis_penilaian` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_penilai` bigint unsigned DEFAULT NULL,
  `kepenuhan_tps` tinyint unsigned NOT NULL,
  `sampah_meluber` tinyint unsigned NOT NULL,
  `dampak_lingkungan` tinyint unsigned NOT NULL,
  `bau_hama` tinyint unsigned NOT NULL,
  `gangguan_masyarakat` tinyint unsigned NOT NULL,
  `skor_urgensi` decimal(5,2) NOT NULL,
  `rekomendasi_urgensi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penilaian_urgensi_id_penilai_foreign` (`id_penilai`),
  KEY `penilaian_urgensi_id_laporan_jenis_penilaian_index` (`id_laporan`,`jenis_penilaian`),
  CONSTRAINT `penilaian_urgensi_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penilaian_urgensi_id_penilai_foreign` FOREIGN KEY (`id_penilai`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penilaian_urgensi`
--

LOCK TABLES `penilaian_urgensi` WRITE;
/*!40000 ALTER TABLE `penilaian_urgensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `penilaian_urgensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riwayat_statuses`
--

DROP TABLE IF EXISTS `riwayat_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riwayat_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_laporan` bigint unsigned NOT NULL,
  `id_pengguna` bigint unsigned DEFAULT NULL,
  `status_sebelumnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_baru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `waktu_perubahan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riwayat_statuses_id_laporan_foreign` (`id_laporan`),
  KEY `riwayat_statuses_id_pengguna_foreign` (`id_pengguna`),
  CONSTRAINT `riwayat_statuses_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `riwayat_statuses_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_statuses`
--

LOCK TABLES `riwayat_statuses` WRITE;
/*!40000 ALTER TABLE `riwayat_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `riwayat_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('9WNd8a2YRXK6UwcIVRmKOQ9ICbwNsZcGcIcSNVSS',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI0VjlPOHhvdFNGTno5ZjI4dUUzd3ZWYWFOdDR0UHFaSHg5TjFyVnlVIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifX0=',1793211745),('JWHcvnIzDT0TIdVkMr7y3i0xRUghJ6mLdZTtCfNO',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJJVFNJMGxPRExLNUllaDRlZTBBUzRZNTB6YUNHMlg0d3NyQzlndG5aIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2Rhc2hib2FyZFwvdXB0ZCIsInJvdXRlIjoiZGFzaGJvYXJkLnJvbGUifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInBhc3N3b3JkX2hhc2hfd2ViIjoiOGIxMzMxYjZjMDliMTJiNDlhYjIxM2M0NTM0MjFiM2JiN2NjMDQ5NzEwNjY1MDQxYmMwOTNlYmIyYTY3ODgyMyJ9',1793256049),('MvQAvXqHdpTRh3Q5rN9fXjwKWvfks05VvFoH9N5Y',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJPZzJQTkhjbkN1djJCSU9zUzNZeGpRdmk5YTAwUEZoMERwQk9BbFcxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJsYW5kaW5nIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793203132);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supir_tps`
--

DROP TABLE IF EXISTS `supir_tps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supir_tps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_supir` bigint unsigned NOT NULL,
  `id_tps` bigint unsigned NOT NULL,
  `rute` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `supir_tps_id_supir_id_tps_unique` (`id_supir`,`id_tps`),
  KEY `supir_tps_id_tps_status_index` (`id_tps`,`status`),
  CONSTRAINT `supir_tps_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `supir_tps_id_tps_foreign` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supir_tps`
--

LOCK TABLES `supir_tps` WRITE;
/*!40000 ALTER TABLE `supir_tps` DISABLE KEYS */;
/*!40000 ALTER TABLE `supir_tps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tps`
--

DROP TABLE IF EXISTS `tps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_wilayah` bigint unsigned NOT NULL,
  `nama_tps` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bersih',
  `last_cleaned_at` timestamp NULL DEFAULT NULL,
  `last_reported_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tps_id_wilayah_foreign` (`id_wilayah`),
  CONSTRAINT `tps_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayahs` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tps`
--

LOCK TABLES `tps` WRITE;
/*!40000 ALTER TABLE `tps` DISABLE KEYS */;
INSERT INTO `tps` VALUES (1,2,'manda',NULL,'safbc',4.0000000,12.0000000,'dsd','2026-10-28 10:57:20','2026-10-28 10:57:20','bersih',NULL,NULL),(2,2,'TPS dekat SMP Unggulan Kabupaten Indramayu',NULL,'Area sekitar SMP Unggulan Kabupaten Indramayu, Kabupaten Indramayu, Jawa Barat',NULL,NULL,'[DUMMY - PERLU VERIFIKASI] Lokasi TPS disebut dalam pemberitaan RRI tanggal 10 April 2026. Koordinat dan status inventaris resmi belum diverifikasi. Sumber: https://rri.co.id/cirebon/regional/2324950/dlh-indramayu-respons-sampah-menumpuk','2026-10-28 11:07:03','2026-10-28 11:07:03','bersih',NULL,NULL),(3,1,'TPS 3R Desa Cangkingan',NULL,'Desa Cangkingan, Kecamatan Kedokan Bunder, Kabupaten Indramayu, Jawa Barat',NULL,NULL,'[DUMMY - PERLU VERIFIKASI] TPS 3R disebut dalam publikasi resmi Pemkab Indramayu tanggal 24 April 2025. Penempatan wilayah UPTD hanya sementara untuk pengujian aplikasi dan bukan penetapan wilayah operasional resmi. Sumber: https://indramayukab.go.id/solutif-tangani-masalah-sampah-desa-cangkingan-miliki-perdes-pengelolaan-lingkungan-hingga-tps-3r/','2026-10-28 11:07:03','2026-10-28 11:07:03','bersih',NULL,NULL),(4,8,'anggi',NULL,'-',-10.0000000,9.0000000,NULL,'2026-11-05 21:39:17','2026-11-05 21:39:17','bersih',NULL,NULL);
/*!40000 ALTER TABLE `tps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_spammer` tinyint(1) NOT NULL DEFAULT '0',
  `spam_score` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('masyarakat','uptd','supir','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'masyarakat',
  `id_wilayah` bigint unsigned DEFAULT NULL,
  `status_kehadiran` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `keterangan_kehadiran` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_wilayah_foreign` (`id_wilayah`),
  CONSTRAINT `users_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayahs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'eka','ekafadilla2006@gmail.com','2026-11-27 01:14:10','$2y$12$IGJZw4OtKv8YBuL9X1nEBu6Cgf.a7.F6d6LLXw0z7kBmCdKVYYkta','pGlhE4Z6ulwzFwpD97TSkVKAh977oeaszGCNmII7zywsQHRAXfmshKHubiGd',0,0,'2026-10-27 11:56:18','2026-10-27 11:56:18','masyarakat',NULL,'tersedia',NULL),(2,'UPTD Kebersihan Indramayu','uptd.indramayu@example.test','2026-11-27 01:14:10','$2y$12$r/KA6NtHMMlezq1CC2EPWueGGyqMad9Gth69CaOmDSu9A8cnNIk8u',NULL,0,0,'2026-10-27 13:40:18','2026-10-27 13:40:18','uptd',2,'tersedia',NULL),(3,'Supir TPS','supir.tps@example.test','2026-11-27 01:14:10','$2y$12$yAZP70vGOPHSKV1a/4tUZuv9sFBXsosVWv.e9fJTp4r86KKadNhOO',NULL,0,0,'2026-10-28 09:54:12','2026-10-28 09:54:12','supir',NULL,'tersedia',NULL),(4,'Administrator','admin@pantautps.test','2026-11-27 01:14:10','$2y$12$CISWBN/a9NcxwDIIbV80Lemdf.RD9jdOGcFtIwOOXwlCQZXfZE1pe','uws3FHhGUOypIB00068146ak6WrNZpzeOiKjUu3M8IhEiRI7SPE9eJl3ie26',0,0,'2026-10-28 10:20:59','2026-10-28 10:23:23','admin',NULL,'tersedia',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wilayahs`
--

DROP TABLE IF EXISTS `wilayahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wilayahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_wilayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wilayahs`
--

LOCK TABLES `wilayahs` WRITE;
/*!40000 ALTER TABLE `wilayahs` DISABLE KEYS */;
INSERT INTO `wilayahs` VALUES (1,'UPTD Pengelolaan Sampah (Pusat / Kelas A)','Unit kerja DLH Kabupaten Indramayu','2026-10-27 13:37:33','2026-10-27 13:37:33'),(2,'UPTD Kebersihan Indramayu','Unit kerja DLH Kabupaten Indramayu','2026-10-27 13:37:49','2026-10-27 13:37:49'),(3,'UPTD Kebersihan Jatibarang','Unit kerja DLH Kabupaten Indramayu','2026-10-27 13:38:07','2026-10-27 13:38:07'),(4,'UPTD Kebersihan Karangampel','Unit kerja DLH Kabupaten Indramayu','2026-10-27 13:38:18','2026-10-27 13:38:18'),(5,'UPTD Kebersihan Losarang','Unit kerja DLH Kabupaten Indramayu','2026-10-27 13:38:22','2026-10-27 13:38:22'),(6,'UPTD Kebersihan Kandanghaur','Unit kerja DLH Kabupaten Indramayu','2026-10-27 13:38:33','2026-10-27 13:38:33'),(7,'UPTD Kebersihan Haurgeulis','Unit kerja DLH Kabupaten Indramayu','2026-10-27 13:38:37','2026-10-27 13:38:37'),(8,'TPA Pecuk (Tempat Pemrosesan Akhir Pecuk)','Tempat Pemrosesan Akhir Pecuk','2026-10-27 13:38:45','2026-10-27 13:38:45');
/*!40000 ALTER TABLE `wilayahs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-27 15:16:14
