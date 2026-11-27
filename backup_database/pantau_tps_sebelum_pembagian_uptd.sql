-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: db_pantau_tps_baru
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `armadas_kode_armada_unique` (`kode_armada`),
  KEY `armadas_id_wilayah_foreign` (`id_wilayah`),
  CONSTRAINT `armadas_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayahs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
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
  CONSTRAINT `bukti_penanganans_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
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
  CONSTRAINT `laporans_id_armada_foreign` FOREIGN KEY (`id_armada`) REFERENCES `armadas` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `laporans_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `laporans_id_supir_foreign` FOREIGN KEY (`id_supir`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `laporans_id_tps_foreign` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporans`
--

LOCK TABLES `laporans` WRITE;
/*!40000 ALTER TABLE `laporans` DISABLE KEYS */;
/*!40000 ALTER TABLE `laporans` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_27_182812_add_role_to_users_table',1),(5,'2026_10_27_185937_create_wilayahs_table',1),(6,'2026_10_27_185938_create_tps_table',1),(7,'2026_10_27_185939_create_laporans_table',1),(8,'2026_10_27_185940_create_foto_laporans_table',1),(9,'2026_10_27_185941_create_riwayat_statuses_table',1),(10,'2026_10_27_203020_add_id_wilayah_to_users_table',1),(11,'2026_10_28_000001_create_armadas_and_add_penugasan_to_laporans',1),(12,'2026_10_28_181500_create_pengaturan_landing_pages_table',1);
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
INSERT INTO `sessions` VALUES ('eRlV0rD6y5BUrtPb00Hk89dfqNqEeUgtb4hq0eZM',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI5bXd2NHFNcVh5RjB1R1lhZDB6bllTZmZXUk5sTUlTWTNMeU1WYXo3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL3VwdGQiLCJyb3V0ZSI6ImRhc2hib2FyZC5yb2xlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9',1794332417),('fU94koXddAmI0zVvPhGTpbsELxfK42JqGqDoTtCe',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI3cE1INk1jYlhzQmJTam1JeXYwNktzTmZydlNOQ0FMcWNnM3Frb0xZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmRcL3VwdGQiLCJyb3V0ZSI6ImRhc2hib2FyZC5yb2xlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInBhc3N3b3JkX2hhc2hfd2ViIjoiMjlhZmE3OWE1MTNhZjlmODY1ZmUxNTU0MzEwMWY4ZTY2YTc2MzA4NjNhYjJkNDUyZGVmY2E1ZThmYjgwM2IxNSJ9',1794242014),('KDE970610SYitNBTv4HBTi6TuUfli7sRBrxGirqL',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ4TEV4SnJ5OTJqY1JUdFdjZ1pYMlNPV2ZaZEhyRnZPd09BS2RzblMzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJsYW5kaW5nIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1794241561);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
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
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tps_id_wilayah_foreign` (`id_wilayah`),
  CONSTRAINT `tps_id_wilayah_foreign` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayahs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tps`
--

LOCK TABLES `tps` WRITE;
/*!40000 ALTER TABLE `tps` DISABLE KEYS */;
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('masyarakat','uptd','supir','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'masyarakat',
  `id_wilayah` bigint unsigned DEFAULT NULL,
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
INSERT INTO `users` VALUES (1,'Eka','ekafadilla2006@gmail.com',NULL,'$2y$12$dLyTPfZPfNsQGyWSKItrbexKTDERFQBkJYAsmsuVLdiUZULWO64AG',NULL,'2026-11-09 09:32:06','2026-11-09 09:32:06','masyarakat',NULL),(2,'UPTD Kebersihan Indramayu','uptd.indramayu@example.test',NULL,'$2y$12$SIZjLPRyK1DLUekhAEI1zu8yEKOBYrcESn.RlhhnB4WyODjgPhbQe','Fnw0Vw7htss4sQ9fT9blDHtR7acSgLZsyW8EvtjDfBEilSOVsWWMT0AKTD2O','2026-11-09 09:32:06','2026-11-09 09:32:06','uptd',NULL),(3,'Supir TPS','supir.tps@example.test',NULL,'$2y$12$XbTrVfQKRRqI7rbOmp.14Ot5EB/tCWTj97oT5kHwfVPMOcaLmK7uS',NULL,'2026-11-09 09:32:07','2026-11-09 09:32:07','supir',NULL),(4,'Administrator','admin@pantautps.test',NULL,'$2y$12$VStb7VmTVGxX2v.WcVhyBePb7xgZnfGmEKAJNBoNIJkK71YT0Z7ha',NULL,'2026-11-09 09:32:07','2026-11-09 09:32:07','admin',NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wilayahs`
--

LOCK TABLES `wilayahs` WRITE;
/*!40000 ALTER TABLE `wilayahs` DISABLE KEYS */;
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

-- Dump completed on 2026-11-11  0:51:38
