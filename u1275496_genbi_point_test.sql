-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk genbi_poin
CREATE DATABASE IF NOT EXISTS `genbi_poin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `genbi_poin`;

-- membuang struktur untuk table genbi_poin.absensis
CREATE TABLE IF NOT EXISTS `absensis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `jadwal_absensi_id` bigint unsigned NOT NULL,
  `status` enum('Hadir','Izin','Tidak Hadir') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_true` tinyint(1) NOT NULL DEFAULT '0',
  `image_bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `absensis_user_id_foreign` (`user_id`),
  KEY `absensis_jadwal_absensi_id_foreign` (`jadwal_absensi_id`),
  CONSTRAINT `absensis_jadwal_absensi_id_foreign` FOREIGN KEY (`jadwal_absensi_id`) REFERENCES `jadwal_absensis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `absensis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.absensis: ~9 rows (lebih kurang)
INSERT INTO `absensis` (`id`, `user_id`, `jadwal_absensi_id`, `status`, `is_true`, `image_bukti`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 1, 'Hadir', 1, '01J85DDCZ4107A9S1RJ8HMHZTC.jpg', '2024-09-19 08:11:35', '2024-09-22 06:03:13', NULL),
	(2, 2, 3, 'Hadir', 1, '01J8A7MAR809CES9CPZA7W55R9.jpg', '2024-02-21 05:06:43', '2024-09-21 11:03:22', NULL),
	(3, 2, 4, 'Izin', 1, '01J8A7T2DGRGCTA2WNF332DCVJ.jpg', '2024-09-21 05:09:51', '2024-09-21 05:10:15', NULL),
	(4, 2, 5, 'Izin', 0, '01J8C0JEJ9AECSQH2SK5E4P36S.jpg', '2024-09-21 21:41:50', '2024-09-21 21:41:50', NULL),
	(5, 8, 4, 'Hadir', 1, '01J8C0Q5WMYHZ127Z3KTTCR923.jpg', '2024-09-21 21:44:25', '2024-09-21 21:48:05', NULL),
	(6, 8, 5, 'Tidak Hadir', 0, '01J8C0STF0CRSWTY4VHHB4NCY8.jpg', '2024-09-21 21:45:52', '2024-09-21 21:49:31', NULL),
	(7, 12, 6, 'Tidak Hadir', 1, '01J8CXQDG4HVRWY3B717ZFXAYS.jpg', '2024-09-22 06:11:22', '2024-09-22 06:13:05', NULL),
	(8, 3, 6, 'Hadir', 0, '01J8E997GN9RMZCWDH9YAXZ5GW.png', '2024-09-22 18:52:34', '2024-09-22 18:52:34', NULL),
	(9, 12, 1, 'Hadir', 1, '01J8EC8797SYKVDTJB6MQ5GV1G.jpg', '2024-09-22 19:44:27', '2024-09-22 19:44:27', NULL);

-- membuang struktur untuk table genbi_poin.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.cache: ~15 rows (lebih kurang)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('0ade7c2cf97f75d009975f4d720d1fa6c19f4897', 'i:1;', 1727059523),
	('0ade7c2cf97f75d009975f4d720d1fa6c19f4897:timer', 'i:1727059523;', 1727059523),
	('356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1727130929),
	('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1727130929;', 1727130929),
	('77de68daecd823babbb58edb1c8e14d7106e83bb', 'i:1;', 1727056410),
	('77de68daecd823babbb58edb1c8e14d7106e83bb:timer', 'i:1727056410;', 1727056410),
	('7b52009b64fd0a2a49e6d8a939753077792b0554', 'i:1;', 1727010738),
	('7b52009b64fd0a2a49e6d8a939753077792b0554:timer', 'i:1727010738;', 1727010738),
	('a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1727131047),
	('a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1727131047;', 1727131047),
	('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1726980168),
	('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1726980168;', 1726980168),
	('fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f', 'i:1;', 1726980410),
	('fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f:timer', 'i:1726980410;', 1726980410),
	('spatie.permission.cache', 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:81:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:20:"view_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:1;a:4:{s:1:"a";i:2;s:1:"b";s:24:"view_any_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:2;a:4:{s:1:"a";i:3;s:1:"b";s:22:"create_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:3;a:4:{s:1:"a";i:4;s:1:"b";s:22:"update_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:4;a:4:{s:1:"a";i:5;s:1:"b";s:23:"restore_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:5;a:4:{s:1:"a";i:6;s:1:"b";s:27:"restore_any_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:6;a:4:{s:1:"a";i:7;s:1:"b";s:25:"replicate_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:7;a:4:{s:1:"a";i:8;s:1:"b";s:23:"reorder_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:8;a:4:{s:1:"a";i:9;s:1:"b";s:22:"delete_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:9;a:4:{s:1:"a";i:10;s:1:"b";s:26:"delete_any_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:10;a:4:{s:1:"a";i:11;s:1:"b";s:28:"force_delete_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:11;a:4:{s:1:"a";i:12;s:1:"b";s:32:"force_delete_any_jadwal::absensi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:12;a:4:{s:1:"a";i:13;s:1:"b";s:13:"view_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:13;a:4:{s:1:"a";i:14;s:1:"b";s:17:"view_any_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:14;a:4:{s:1:"a";i:15;s:1:"b";s:15:"create_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:4:{s:1:"a";i:16;s:1:"b";s:15:"update_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:16;a:4:{s:1:"a";i:17;s:1:"b";s:16:"restore_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:17;a:4:{s:1:"a";i:18;s:1:"b";s:20:"restore_any_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:18;a:4:{s:1:"a";i:19;s:1:"b";s:18:"replicate_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:19;a:4:{s:1:"a";i:20;s:1:"b";s:16:"reorder_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:20;a:4:{s:1:"a";i:21;s:1:"b";s:15:"delete_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:21;a:4:{s:1:"a";i:22;s:1:"b";s:19:"delete_any_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:22;a:4:{s:1:"a";i:23;s:1:"b";s:21:"force_delete_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:23;a:4:{s:1:"a";i:24;s:1:"b";s:25:"force_delete_any_kegiatan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:24;a:4:{s:1:"a";i:25;s:1:"b";s:22:"view_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:25;a:4:{s:1:"a";i:26;s:1:"b";s:26:"view_any_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:26;a:4:{s:1:"a";i:27;s:1:"b";s:24:"create_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:27;a:4:{s:1:"a";i:28;s:1:"b";s:24:"update_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:28;a:4:{s:1:"a";i:29;s:1:"b";s:25:"restore_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:29;a:4:{s:1:"a";i:30;s:1:"b";s:29:"restore_any_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:30;a:4:{s:1:"a";i:31;s:1:"b";s:27:"replicate_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:31;a:4:{s:1:"a";i:32;s:1:"b";s:25:"reorder_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:32;a:4:{s:1:"a";i:33;s:1:"b";s:24:"delete_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:33;a:4:{s:1:"a";i:34;s:1:"b";s:28:"delete_any_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:34;a:4:{s:1:"a";i:35;s:1:"b";s:30:"force_delete_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:35;a:4:{s:1:"a";i:36;s:1:"b";s:34:"force_delete_any_penilaian::deputi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:36;a:4:{s:1:"a";i:37;s:1:"b";s:30:"view_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:37;a:4:{s:1:"a";i:38;s:1:"b";s:34:"view_any_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:38;a:4:{s:1:"a";i:39;s:1:"b";s:32:"create_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:39;a:4:{s:1:"a";i:40;s:1:"b";s:32:"update_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:40;a:4:{s:1:"a";i:41;s:1:"b";s:33:"restore_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:41;a:4:{s:1:"a";i:42;s:1:"b";s:37:"restore_any_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:42;a:4:{s:1:"a";i:43;s:1:"b";s:35:"replicate_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:43;a:4:{s:1:"a";i:44;s:1:"b";s:33:"reorder_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:44;a:4:{s:1:"a";i:45;s:1:"b";s:32:"delete_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:45;a:4:{s:1:"a";i:46;s:1:"b";s:36:"delete_any_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:46;a:4:{s:1:"a";i:47;s:1:"b";s:38:"force_delete_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:47;a:4:{s:1:"a";i:48;s:1:"b";s:42:"force_delete_any_penilaian::deputi::answer";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:48;a:4:{s:1:"a";i:49;s:1:"b";s:32:"view_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:49;a:4:{s:1:"a";i:50;s:1:"b";s:36:"view_any_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:50;a:4:{s:1:"a";i:51;s:1:"b";s:34:"create_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:51;a:4:{s:1:"a";i:52;s:1:"b";s:34:"update_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:52;a:4:{s:1:"a";i:53;s:1:"b";s:35:"restore_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:53;a:4:{s:1:"a";i:54;s:1:"b";s:39:"restore_any_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:54;a:4:{s:1:"a";i:55;s:1:"b";s:37:"replicate_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:55;a:4:{s:1:"a";i:56;s:1:"b";s:35:"reorder_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:56;a:4:{s:1:"a";i:57;s:1:"b";s:34:"delete_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:57;a:4:{s:1:"a";i:58;s:1:"b";s:38:"delete_any_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:58;a:4:{s:1:"a";i:59;s:1:"b";s:40:"force_delete_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:59;a:4:{s:1:"a";i:60;s:1:"b";s:44:"force_delete_any_penilaian::deputi::question";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:60;a:4:{s:1:"a";i:61;s:1:"b";s:9:"view_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:61;a:4:{s:1:"a";i:62;s:1:"b";s:13:"view_any_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:62;a:4:{s:1:"a";i:63;s:1:"b";s:11:"create_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:63;a:4:{s:1:"a";i:64;s:1:"b";s:11:"update_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:64;a:4:{s:1:"a";i:65;s:1:"b";s:11:"delete_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:65;a:4:{s:1:"a";i:66;s:1:"b";s:15:"delete_any_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:66;a:4:{s:1:"a";i:67;s:1:"b";s:9:"view_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:67;a:4:{s:1:"a";i:68;s:1:"b";s:13:"view_any_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:68;a:4:{s:1:"a";i:69;s:1:"b";s:11:"create_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:69;a:4:{s:1:"a";i:70;s:1:"b";s:11:"update_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:70;a:4:{s:1:"a";i:71;s:1:"b";s:12:"restore_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:71;a:4:{s:1:"a";i:72;s:1:"b";s:16:"restore_any_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:72;a:4:{s:1:"a";i:73;s:1:"b";s:14:"replicate_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:73;a:4:{s:1:"a";i:74;s:1:"b";s:12:"reorder_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:74;a:4:{s:1:"a";i:75;s:1:"b";s:11:"delete_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:75;a:4:{s:1:"a";i:76;s:1:"b";s:15:"delete_any_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:76;a:4:{s:1:"a";i:77;s:1:"b";s:17:"force_delete_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:77;a:4:{s:1:"a";i:78;s:1:"b";s:21:"force_delete_any_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:78;a:4:{s:1:"a";i:79;s:1:"b";s:20:"page_PenilaianDeputi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:79;a:4:{s:1:"a";i:80;s:1:"b";s:12:"page_Ranking";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:80;a:4:{s:1:"a";i:81;s:1:"b";s:18:"page_RankingDeputi";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}}s:5:"roles";a:4:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:11:"super_admin";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:6:"deputi";s:1:"c";s:3:"web";}i:2;a:3:{s:1:"a";i:3;s:1:"b";s:3:"bph";s:1:"c";s:3:"web";}i:3;a:3:{s:1:"a";i:4;s:1:"b";s:6:"member";s:1:"c";s:3:"web";}}}', 1727187400);

-- membuang struktur untuk table genbi_poin.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.cache_locks: ~0 rows (lebih kurang)

-- membuang struktur untuk table genbi_poin.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table genbi_poin.jadwal_absensis
CREATE TABLE IF NOT EXISTS `jadwal_absensis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_poin` int NOT NULL,
  `start_time` timestamp NOT NULL,
  `end_time` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.jadwal_absensis: ~4 rows (lebih kurang)
INSERT INTO `jadwal_absensis` (`id`, `nama_kegiatan`, `jumlah_poin`, `start_time`, `end_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Absensi 1', 30, '2024-09-19 15:09:00', '2024-09-19 17:09:00', '2024-09-19 08:10:21', '2024-09-19 08:10:21', NULL),
	(2, 'Absensi 2', 203, '2024-09-21 06:21:00', '2024-09-21 07:21:00', '2024-09-21 01:21:37', '2024-09-21 01:22:10', NULL),
	(3, 'Absensi 3', 2020, '2024-02-21 12:06:00', '2024-02-29 12:06:00', '2024-09-21 05:06:15', '2024-09-21 11:02:20', NULL),
	(4, 'Absensi 4', 20, '2024-09-21 12:07:00', '2024-09-30 12:07:00', '2024-09-21 05:07:39', '2024-09-21 05:07:39', NULL),
	(5, 'Coba 3', 10, '2024-09-22 04:41:00', '2024-09-30 04:41:00', '2024-09-21 21:41:09', '2024-09-21 21:41:09', NULL),
	(6, 'COba Absensi Demo', 30, '2024-09-22 13:03:00', '2024-09-23 16:03:00', '2024-09-22 06:04:09', '2024-09-22 18:51:51', NULL);

-- membuang struktur untuk table genbi_poin.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table genbi_poin.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Membuang data untuk tabel genbi_poin.job_batches: ~0 rows (lebih kurang)

-- membuang struktur untuk table genbi_poin.kegiatans
CREATE TABLE IF NOT EXISTS `kegiatans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `image_bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` text COLLATE utf8mb4_unicode_ci,
  `link` text COLLATE utf8mb4_unicode_ci,
  `jenis` enum('Responsibility','Kontribusi','Event','Kreativitas') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatans_user_id_foreign` (`user_id`),
  CONSTRAINT `kegiatans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.kegiatans: ~2 rows (lebih kurang)
INSERT INTO `kegiatans` (`id`, `user_id`, `nama`, `tanggal`, `image_bukti`, `resume`, `link`, `jenis`, `score`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 'Contoh Kagiatan 1', '2024-09-04', 'foto_kegiatan/01J85CQM17YG190NB210Z7C0ZA.png', NULL, NULL, 'Responsibility', 40, '2024-09-19 07:59:42', '2024-09-22 00:50:19', NULL),
	(2, 2, 'anskdansd', '2024-09-01', 'foto_kegiatan/01J85D1GJRF7Q6PXX3E6WRJCQ8.png', NULL, NULL, 'Kontribusi', 40, '2024-09-19 08:05:06', '2024-09-19 08:05:19', NULL),
	(3, 6, 'Kegiatan Member 2', '2024-09-04', 'foto_kegiatan/01J85DJFY4FA605MJJXPJ7CHCX.jpg', NULL, NULL, 'Event', 3, '2024-09-19 08:14:22', '2024-09-21 22:09:12', NULL),
	(4, 12, 'Membuat Aritkel Di Website Genbi', '2024-09-22', 'foto_kegiatan/01J8CXNW4A4XFVX1GJEAH3K2KM.jpg', NULL, 'https://google.com/', 'Event', 24, '2024-09-22 06:10:31', '2024-09-22 19:42:16', NULL),
	(5, 13, 'COBA 1', '2024-09-23', 'foto_kegiatan/01J8E926X04HW9Z9N39FAEMQ65.jpg', NULL, NULL, 'Kontribusi', 20, '2024-09-22 18:48:44', '2024-09-22 18:48:44', NULL);

-- membuang struktur untuk table genbi_poin.kontaks
CREATE TABLE IF NOT EXISTS `kontaks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kontaks_user_id_foreign` (`user_id`),
  CONSTRAINT `kontaks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.kontaks: ~0 rows (lebih kurang)
INSERT INTO `kontaks` (`id`, `user_id`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 'Hi, Message dari member 1', '2024-09-19 09:03:09', '2024-09-19 09:03:09', NULL);

-- membuang struktur untuk table genbi_poin.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.migrations: ~13 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_09_01_102820_create_kegiatans_table', 1),
	(5, '2024_09_01_163630_create_jadwal_absensis_table', 1),
	(6, '2024_09_01_163633_create_absensis_table', 1),
	(7, '2024_09_03_152551_create_kontaks_table', 1),
	(8, '2024_09_03_163402_create_penilaian_deputis_table', 1),
	(9, '2024_09_03_163419_create_penilaian_deputi_questions_table', 1),
	(10, '2024_09_03_163420_create_package_penilaian_deputis_table', 1),
	(11, '2024_09_03_163502_create_penilaian_deputi_options_table', 1),
	(12, '2024_09_03_163516_create_penilaian_deputi_answers_table', 1),
	(14, '2024_09_12_131922_create_penilaian_deputi_answers_options_table', 1),
	(16, '2024_09_19_171024_rename_option_column_in_penilaian_deputi_option_table', 3),
	(17, '2024_09_21_070137_make_pd_option_id_nullable_in_penilaian_deputi_answers_options', 4),
	(18, '2024_09_21_100252_add_is_submited_to_penilaian_deputi_answers_table', 5),
	(19, '2024_09_12_105311_create_permission_tables', 6);

-- membuang struktur untuk table genbi_poin.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.model_has_permissions: ~0 rows (lebih kurang)

-- membuang struktur untuk table genbi_poin.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.model_has_roles: ~13 rows (lebih kurang)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(4, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 3),
	(4, 'App\\Models\\User', 6),
	(2, 'App\\Models\\User', 7),
	(4, 'App\\Models\\User', 8),
	(3, 'App\\Models\\User', 9),
	(2, 'App\\Models\\User', 10),
	(4, 'App\\Models\\User', 12),
	(4, 'App\\Models\\User', 13),
	(4, 'App\\Models\\User', 14),
	(4, 'App\\Models\\User', 15),
	(4, 'App\\Models\\User', 16),
	(4, 'App\\Models\\User', 17),
	(4, 'App\\Models\\User', 18);

-- membuang struktur untuk table genbi_poin.package_penilaian_deputis
CREATE TABLE IF NOT EXISTS `package_penilaian_deputis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penilaian_deputi_id` bigint unsigned NOT NULL,
  `penilaian_deputi_question_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_penilaian_deputis_penilaian_deputi_id_foreign` (`penilaian_deputi_id`),
  KEY `package_penilaian_deputis_penilaian_deputi_question_id_foreign` (`penilaian_deputi_question_id`),
  CONSTRAINT `package_penilaian_deputis_penilaian_deputi_id_foreign` FOREIGN KEY (`penilaian_deputi_id`) REFERENCES `penilaian_deputis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `package_penilaian_deputis_penilaian_deputi_question_id_foreign` FOREIGN KEY (`penilaian_deputi_question_id`) REFERENCES `penilaian_deputi_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.package_penilaian_deputis: ~39 rows (lebih kurang)
INSERT INTO `package_penilaian_deputis` (`id`, `penilaian_deputi_id`, `penilaian_deputi_question_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, NULL, NULL, NULL),
	(2, 1, 2, NULL, NULL, NULL),
	(3, 1, 3, NULL, NULL, NULL),
	(4, 1, 4, NULL, NULL, NULL),
	(5, 1, 5, NULL, NULL, NULL),
	(6, 1, 6, NULL, NULL, NULL),
	(7, 1, 7, NULL, NULL, NULL),
	(8, 1, 8, NULL, NULL, NULL),
	(9, 1, 9, NULL, NULL, NULL),
	(10, 1, 10, NULL, NULL, NULL),
	(11, 1, 11, NULL, NULL, NULL),
	(12, 1, 12, NULL, NULL, NULL),
	(13, 1, 13, NULL, NULL, NULL),
	(14, 1, 14, NULL, NULL, NULL),
	(15, 1, 15, NULL, NULL, NULL),
	(16, 2, 16, NULL, NULL, NULL),
	(17, 2, 17, NULL, NULL, NULL),
	(18, 2, 18, NULL, NULL, NULL),
	(19, 2, 19, NULL, NULL, NULL),
	(20, 2, 20, NULL, NULL, NULL),
	(21, 2, 21, NULL, NULL, NULL),
	(22, 2, 22, NULL, NULL, NULL),
	(23, 2, 23, NULL, NULL, NULL),
	(24, 2, 24, NULL, NULL, NULL),
	(25, 2, 25, NULL, NULL, NULL),
	(26, 2, 26, NULL, NULL, NULL),
	(27, 2, 27, NULL, NULL, NULL),
	(28, 2, 28, NULL, NULL, NULL),
	(29, 2, 29, NULL, NULL, NULL),
	(30, 2, 30, NULL, NULL, NULL),
	(31, 7, 23, '2024-09-21 05:04:29', '2024-09-21 05:04:29', NULL),
	(32, 7, 21, '2024-09-21 05:04:29', '2024-09-21 05:04:29', NULL),
	(33, 7, 30, '2024-09-21 05:04:29', '2024-09-21 05:04:29', NULL),
	(34, 7, 28, '2024-09-21 05:04:29', '2024-09-21 05:04:29', NULL),
	(35, 8, 14, '2024-09-21 06:13:36', '2024-09-21 06:13:36', NULL),
	(36, 8, 28, '2024-09-21 06:13:36', '2024-09-21 06:13:36', NULL),
	(37, 8, 3, '2024-09-21 06:13:36', '2024-09-21 06:13:36', NULL),
	(38, 8, 16, '2024-09-21 06:13:36', '2024-09-21 06:13:36', NULL),
	(39, 8, 18, '2024-09-21 06:13:36', '2024-09-21 06:13:36', NULL),
	(40, 9, 97, '2024-09-22 06:06:53', '2024-09-22 06:06:53', NULL),
	(41, 9, 25, '2024-09-22 06:06:53', '2024-09-22 06:06:53', NULL),
	(42, 9, 30, '2024-09-22 06:06:53', '2024-09-22 06:06:53', NULL),
	(43, 9, 16, '2024-09-22 06:06:53', '2024-09-22 06:06:53', NULL),
	(44, 9, 23, '2024-09-22 06:06:53', '2024-09-22 06:06:53', NULL);

-- membuang struktur untuk table genbi_poin.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.password_reset_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table genbi_poin.penilaian_deputis
CREATE TABLE IF NOT EXISTS `penilaian_deputis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` timestamp NOT NULL,
  `end_time` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.penilaian_deputis: ~5 rows (lebih kurang)
INSERT INTO `penilaian_deputis` (`id`, `judul`, `start_time`, `end_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Penilaian Deputi Bulan September 2024', '2024-09-01 02:00:00', '2024-09-30 10:00:00', NULL, '2024-09-21 04:59:29', NULL),
	(2, 'Penilaian Deputi Bulan November 2024', '2024-11-01 02:00:00', '2024-11-30 10:00:00', NULL, NULL, NULL),
	(3, 'Penilaian Deputi Bulan Desember 2024', '2024-12-01 02:00:00', '2024-12-31 10:00:00', NULL, NULL, NULL),
	(7, 'Penilaian Deputi Bulan Agustus', '2024-08-01 12:03:51', '2024-08-31 12:03:58', '2024-09-21 05:04:29', '2024-09-21 05:04:29', NULL),
	(8, 'Coba 1', '2024-09-01 13:12:55', '2024-09-18 13:13:00', '2024-09-21 06:13:36', '2024-09-21 06:18:11', NULL),
	(9, 'Penilaian Deputi Bulan September Demo', '2024-09-22 13:05:57', '2024-09-30 13:06:05', '2024-09-22 06:06:53', '2024-09-22 06:06:53', NULL);

-- membuang struktur untuk table genbi_poin.penilaian_deputi_answers
CREATE TABLE IF NOT EXISTS `penilaian_deputi_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `deputi_id` bigint unsigned NOT NULL,
  `penilaian_deputi_id` bigint unsigned NOT NULL,
  `is_submited` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penilaian_deputi_answers_user_id_foreign` (`user_id`),
  KEY `penilaian_deputi_answers_deputi_id_foreign` (`deputi_id`),
  KEY `penilaian_deputi_answers_penilaian_deputi_id_foreign` (`penilaian_deputi_id`),
  CONSTRAINT `penilaian_deputi_answers_deputi_id_foreign` FOREIGN KEY (`deputi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penilaian_deputi_answers_penilaian_deputi_id_foreign` FOREIGN KEY (`penilaian_deputi_id`) REFERENCES `penilaian_deputis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penilaian_deputi_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.penilaian_deputi_answers: ~8 rows (lebih kurang)
INSERT INTO `penilaian_deputi_answers` (`id`, `user_id`, `deputi_id`, `penilaian_deputi_id`, `is_submited`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 2, 7, 1, 1, '2024-09-21 00:12:54', '2024-09-23 07:24:51', NULL),
	(4, 2, 7, 7, 1, '2024-09-21 06:08:30', '2024-09-21 06:08:30', NULL),
	(5, 2, 7, 8, 1, '2024-09-21 06:14:10', '2024-09-21 06:16:58', NULL),
	(6, 8, 10, 7, NULL, '2024-09-22 05:19:59', '2024-09-22 05:19:59', NULL),
	(7, 8, 10, 8, NULL, '2024-09-22 05:20:17', '2024-09-22 05:20:17', NULL),
	(8, 8, 10, 1, 1, '2024-09-22 05:20:30', '2024-09-22 05:21:11', NULL),
	(9, 12, 3, 9, 1, '2024-09-22 06:13:51', '2024-09-22 06:14:25', NULL),
	(10, 12, 3, 8, NULL, '2024-09-22 06:15:08', '2024-09-22 06:15:08', NULL);

-- membuang struktur untuk table genbi_poin.penilaian_deputi_answers_options
CREATE TABLE IF NOT EXISTS `penilaian_deputi_answers_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pd_question_id` bigint unsigned NOT NULL,
  `pd_option_id` bigint unsigned DEFAULT NULL,
  `pd_answer_id` bigint unsigned NOT NULL,
  `score` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penilaian_deputi_answers_options_pd_question_id_foreign` (`pd_question_id`),
  KEY `penilaian_deputi_answers_options_pd_option_id_foreign` (`pd_option_id`),
  KEY `penilaian_deputi_answers_options_pd_answer_id_foreign` (`pd_answer_id`),
  CONSTRAINT `penilaian_deputi_answers_options_pd_answer_id_foreign` FOREIGN KEY (`pd_answer_id`) REFERENCES `penilaian_deputi_answers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penilaian_deputi_answers_options_pd_option_id_foreign` FOREIGN KEY (`pd_option_id`) REFERENCES `penilaian_deputi_options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penilaian_deputi_answers_options_pd_question_id_foreign` FOREIGN KEY (`pd_question_id`) REFERENCES `penilaian_deputi_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.penilaian_deputi_answers_options: ~53 rows (lebih kurang)
INSERT INTO `penilaian_deputi_answers_options` (`id`, `pd_question_id`, `pd_option_id`, `pd_answer_id`, `score`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 3, 5, '2024-09-21 00:12:54', '2024-09-21 03:17:56', NULL),
	(2, 2, 7, 3, 4, '2024-09-21 00:12:54', '2024-09-21 00:45:48', NULL),
	(3, 3, 11, 3, 5, '2024-09-21 00:12:54', '2024-09-21 00:45:55', NULL),
	(4, 4, 20, 3, 1, '2024-09-21 00:12:54', '2024-09-21 00:45:59', NULL),
	(5, 5, 21, 3, 5, '2024-09-21 00:12:54', '2024-09-21 00:46:03', NULL),
	(6, 6, 28, 3, 3, '2024-09-21 00:12:54', '2024-09-21 00:46:27', NULL),
	(7, 7, 31, 3, 5, '2024-09-21 00:12:54', '2024-09-21 00:46:07', NULL),
	(8, 8, 36, 3, 5, '2024-09-21 00:12:54', '2024-09-21 00:46:33', NULL),
	(9, 9, 41, 3, 5, '2024-09-21 00:12:54', '2024-09-21 00:46:36', NULL),
	(10, 10, 50, 3, 1, '2024-09-21 00:12:54', '2024-09-21 00:46:13', NULL),
	(11, 11, 51, 3, 5, '2024-09-21 00:12:54', '2024-09-21 00:46:24', NULL),
	(12, 12, 57, 3, 4, '2024-09-21 00:12:54', '2024-09-21 00:46:30', NULL),
	(13, 13, 64, 3, 2, '2024-09-21 00:12:54', '2024-09-21 00:46:10', NULL),
	(14, 14, 67, 3, 4, '2024-09-21 00:12:54', '2024-09-21 00:46:21', NULL),
	(15, 15, 72, 3, 4, '2024-09-21 00:12:54', '2024-09-21 00:46:17', NULL),
	(16, 23, NULL, 4, 0, '2024-09-21 06:08:30', '2024-09-21 06:08:30', NULL),
	(17, 21, NULL, 4, 0, '2024-09-21 06:08:30', '2024-09-21 06:08:30', NULL),
	(18, 30, NULL, 4, 0, '2024-09-21 06:08:30', '2024-09-21 06:08:30', NULL),
	(19, 28, NULL, 4, 0, '2024-09-21 06:08:30', '2024-09-21 06:08:30', NULL),
	(20, 14, 69, 5, 2, '2024-09-21 06:14:11', '2024-09-21 06:15:48', NULL),
	(21, 28, 136, 5, 5, '2024-09-21 06:14:11', '2024-09-21 06:16:25', NULL),
	(22, 3, 12, 5, 4, '2024-09-21 06:14:11', '2024-09-21 06:16:22', NULL),
	(23, 16, 78, 5, 3, '2024-09-21 06:14:11', '2024-09-21 06:16:29', NULL),
	(24, 18, 90, 5, 1, '2024-09-21 06:14:11', '2024-09-21 06:16:19', NULL),
	(25, 23, NULL, 6, 0, '2024-09-22 05:19:59', '2024-09-22 05:19:59', NULL),
	(26, 21, NULL, 6, 0, '2024-09-22 05:19:59', '2024-09-22 05:19:59', NULL),
	(27, 30, NULL, 6, 0, '2024-09-22 05:19:59', '2024-09-22 05:19:59', NULL),
	(28, 28, NULL, 6, 0, '2024-09-22 05:19:59', '2024-09-22 05:19:59', NULL),
	(29, 14, NULL, 7, 0, '2024-09-22 05:20:17', '2024-09-22 05:20:17', NULL),
	(30, 28, NULL, 7, 0, '2024-09-22 05:20:17', '2024-09-22 05:20:17', NULL),
	(31, 3, NULL, 7, 0, '2024-09-22 05:20:17', '2024-09-22 05:20:17', NULL),
	(32, 16, NULL, 7, 0, '2024-09-22 05:20:17', '2024-09-22 05:20:17', NULL),
	(33, 18, NULL, 7, 0, '2024-09-22 05:20:17', '2024-09-22 05:20:17', NULL),
	(34, 1, 1, 8, 5, '2024-09-22 05:20:30', '2024-09-22 05:20:33', NULL),
	(35, 2, 7, 8, 4, '2024-09-22 05:20:30', '2024-09-22 05:20:36', NULL),
	(36, 3, 15, 8, 1, '2024-09-22 05:20:30', '2024-09-22 05:20:39', NULL),
	(37, 4, 19, 8, 2, '2024-09-22 05:20:30', '2024-09-22 05:20:41', NULL),
	(38, 5, 22, 8, 4, '2024-09-22 05:20:30', '2024-09-22 05:20:44', NULL),
	(39, 6, 28, 8, 3, '2024-09-22 05:20:30', '2024-09-22 05:20:46', NULL),
	(40, 7, 34, 8, 2, '2024-09-22 05:20:30', '2024-09-22 05:20:48', NULL),
	(41, 8, 40, 8, 1, '2024-09-22 05:20:30', '2024-09-22 05:20:50', NULL),
	(42, 9, 41, 8, 5, '2024-09-22 05:20:30', '2024-09-22 05:20:53', NULL),
	(43, 10, 48, 8, 3, '2024-09-22 05:20:30', '2024-09-22 05:20:55', NULL),
	(44, 11, 52, 8, 4, '2024-09-22 05:20:30', '2024-09-22 05:20:58', NULL),
	(45, 12, 57, 8, 4, '2024-09-22 05:20:30', '2024-09-22 05:21:01', NULL),
	(46, 13, 64, 8, 2, '2024-09-22 05:20:30', '2024-09-22 05:21:04', NULL),
	(47, 14, 70, 8, 1, '2024-09-22 05:20:30', '2024-09-22 05:21:06', NULL),
	(48, 15, 71, 8, 5, '2024-09-22 05:20:30', '2024-09-22 05:21:09', NULL),
	(49, 97, 151, 9, 5, '2024-09-22 06:13:51', '2024-09-22 06:13:58', NULL),
	(50, 25, 123, 9, 3, '2024-09-22 06:13:51', '2024-09-22 06:14:02', NULL),
	(51, 30, 149, 9, 2, '2024-09-22 06:13:51', '2024-09-22 06:14:06', NULL),
	(52, 16, 80, 9, 1, '2024-09-22 06:13:51', '2024-09-22 06:14:09', NULL),
	(53, 23, 111, 9, 5, '2024-09-22 06:13:51', '2024-09-22 06:14:11', NULL),
	(54, 14, NULL, 10, 0, '2024-09-22 06:15:08', '2024-09-22 06:15:08', NULL),
	(55, 28, NULL, 10, 0, '2024-09-22 06:15:08', '2024-09-22 06:15:08', NULL),
	(56, 3, NULL, 10, 0, '2024-09-22 06:15:08', '2024-09-22 06:15:08', NULL),
	(57, 16, NULL, 10, 0, '2024-09-22 06:15:08', '2024-09-22 06:15:08', NULL),
	(58, 18, NULL, 10, 0, '2024-09-22 06:15:08', '2024-09-22 06:15:08', NULL);

-- membuang struktur untuk table genbi_poin.penilaian_deputi_options
CREATE TABLE IF NOT EXISTS `penilaian_deputi_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penilaian_deputi_question_id` bigint unsigned NOT NULL,
  `option_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penilaian_deputi_options_penilaian_deputi_question_id_foreign` (`penilaian_deputi_question_id`),
  CONSTRAINT `penilaian_deputi_options_penilaian_deputi_question_id_foreign` FOREIGN KEY (`penilaian_deputi_question_id`) REFERENCES `penilaian_deputi_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.penilaian_deputi_options: ~150 rows (lebih kurang)
INSERT INTO `penilaian_deputi_options` (`id`, `penilaian_deputi_question_id`, `option_text`, `score`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'Bagus sekali', 5, NULL, NULL, NULL),
	(2, 1, 'Bagus', 4, NULL, NULL, NULL),
	(3, 1, 'Cukup', 3, NULL, NULL, NULL),
	(4, 1, 'Kurang', 2, NULL, NULL, NULL),
	(5, 1, 'Kurang sekali', 1, NULL, NULL, NULL),
	(6, 2, 'Bagus sekali', 5, NULL, NULL, NULL),
	(7, 2, 'Bagus', 4, NULL, NULL, NULL),
	(8, 2, 'Cukup', 3, NULL, NULL, NULL),
	(9, 2, 'Kurang', 2, NULL, NULL, NULL),
	(10, 2, 'Kurang sekali', 1, NULL, NULL, NULL),
	(11, 3, 'Bagus sekali', 5, NULL, NULL, NULL),
	(12, 3, 'Bagus', 4, NULL, NULL, NULL),
	(13, 3, 'Cukup', 3, NULL, NULL, NULL),
	(14, 3, 'Kurang', 2, NULL, NULL, NULL),
	(15, 3, 'Kurang sekali', 1, NULL, NULL, NULL),
	(16, 4, 'Bagus sekali', 5, NULL, NULL, NULL),
	(17, 4, 'Bagus', 4, NULL, NULL, NULL),
	(18, 4, 'Cukup', 3, NULL, NULL, NULL),
	(19, 4, 'Kurang', 2, NULL, NULL, NULL),
	(20, 4, 'Kurang sekali', 1, NULL, NULL, NULL),
	(21, 5, 'Bagus sekali', 5, NULL, NULL, NULL),
	(22, 5, 'Bagus', 4, NULL, NULL, NULL),
	(23, 5, 'Cukup', 3, NULL, NULL, NULL),
	(24, 5, 'Kurang', 2, NULL, NULL, NULL),
	(25, 5, 'Kurang sekali', 1, NULL, NULL, NULL),
	(26, 6, 'Bagus sekali', 5, NULL, NULL, NULL),
	(27, 6, 'Bagus', 4, NULL, NULL, NULL),
	(28, 6, 'Cukup', 3, NULL, NULL, NULL),
	(29, 6, 'Kurang', 2, NULL, NULL, NULL),
	(30, 6, 'Kurang sekali', 1, NULL, NULL, NULL),
	(31, 7, 'Bagus sekali', 5, NULL, NULL, NULL),
	(32, 7, 'Bagus', 4, NULL, NULL, NULL),
	(33, 7, 'Cukup', 3, NULL, NULL, NULL),
	(34, 7, 'Kurang', 2, NULL, NULL, NULL),
	(35, 7, 'Kurang sekali', 1, NULL, NULL, NULL),
	(36, 8, 'Bagus sekali', 5, NULL, NULL, NULL),
	(37, 8, 'Bagus', 4, NULL, NULL, NULL),
	(38, 8, 'Cukup', 3, NULL, NULL, NULL),
	(39, 8, 'Kurang', 2, NULL, NULL, NULL),
	(40, 8, 'Kurang sekali', 1, NULL, NULL, NULL),
	(41, 9, 'Bagus sekali', 5, NULL, NULL, NULL),
	(42, 9, 'Bagus', 4, NULL, NULL, NULL),
	(43, 9, 'Cukup', 3, NULL, NULL, NULL),
	(44, 9, 'Kurang', 2, NULL, NULL, NULL),
	(45, 9, 'Kurang sekali', 1, NULL, NULL, NULL),
	(46, 10, 'Bagus sekali', 5, NULL, NULL, NULL),
	(47, 10, 'Bagus', 4, NULL, NULL, NULL),
	(48, 10, 'Cukup', 3, NULL, NULL, NULL),
	(49, 10, 'Kurang', 2, NULL, NULL, NULL),
	(50, 10, 'Kurang sekali', 1, NULL, NULL, NULL),
	(51, 11, 'Bagus sekali', 5, NULL, NULL, NULL),
	(52, 11, 'Bagus', 4, NULL, NULL, NULL),
	(53, 11, 'Cukup', 3, NULL, NULL, NULL),
	(54, 11, 'Kurang', 2, NULL, NULL, NULL),
	(55, 11, 'Kurang sekali', 1, NULL, NULL, NULL),
	(56, 12, 'Bagus sekali', 5, NULL, NULL, NULL),
	(57, 12, 'Bagus', 4, NULL, NULL, NULL),
	(58, 12, 'Cukup', 3, NULL, NULL, NULL),
	(59, 12, 'Kurang', 2, NULL, NULL, NULL),
	(60, 12, 'Kurang sekali', 1, NULL, NULL, NULL),
	(61, 13, 'Bagus sekali', 5, NULL, NULL, NULL),
	(62, 13, 'Bagus', 4, NULL, NULL, NULL),
	(63, 13, 'Cukup', 3, NULL, NULL, NULL),
	(64, 13, 'Kurang', 2, NULL, NULL, NULL),
	(65, 13, 'Kurang sekali', 1, NULL, NULL, NULL),
	(66, 14, 'Bagus sekali', 5, NULL, NULL, NULL),
	(67, 14, 'Bagus', 4, NULL, NULL, NULL),
	(68, 14, 'Cukup', 3, NULL, NULL, NULL),
	(69, 14, 'Kurang', 2, NULL, NULL, NULL),
	(70, 14, 'Kurang sekali', 1, NULL, NULL, NULL),
	(71, 15, 'Bagus sekali', 5, NULL, NULL, NULL),
	(72, 15, 'Bagus', 4, NULL, NULL, NULL),
	(73, 15, 'Cukup', 3, NULL, NULL, NULL),
	(74, 15, 'Kurang', 2, NULL, NULL, NULL),
	(75, 15, 'Kurang sekali', 1, NULL, NULL, NULL),
	(76, 16, 'Bagus sekali', 5, NULL, NULL, NULL),
	(77, 16, 'Bagus', 4, NULL, NULL, NULL),
	(78, 16, 'Cukup', 3, NULL, NULL, NULL),
	(79, 16, 'Kurang', 2, NULL, NULL, NULL),
	(80, 16, 'Kurang sekali', 1, NULL, NULL, NULL),
	(81, 17, 'Bagus sekali', 5, NULL, NULL, NULL),
	(82, 17, 'Bagus', 4, NULL, NULL, NULL),
	(83, 17, 'Cukup', 3, NULL, NULL, NULL),
	(84, 17, 'Kurang', 2, NULL, NULL, NULL),
	(85, 17, 'Kurang sekali', 1, NULL, NULL, NULL),
	(86, 18, 'Bagus sekali', 5, NULL, NULL, NULL),
	(87, 18, 'Bagus', 4, NULL, NULL, NULL),
	(88, 18, 'Cukup', 3, NULL, NULL, NULL),
	(89, 18, 'Kurang', 2, NULL, NULL, NULL),
	(90, 18, 'Kurang sekali', 1, NULL, NULL, NULL),
	(91, 19, 'Bagus sekali', 5, NULL, NULL, NULL),
	(92, 19, 'Bagus', 4, NULL, NULL, NULL),
	(93, 19, 'Cukup', 3, NULL, NULL, NULL),
	(94, 19, 'Kurang', 2, NULL, NULL, NULL),
	(95, 19, 'Kurang sekali', 1, NULL, NULL, NULL),
	(96, 20, 'Bagus sekali', 5, NULL, NULL, NULL),
	(97, 20, 'Bagus', 4, NULL, NULL, NULL),
	(98, 20, 'Cukup', 3, NULL, NULL, NULL),
	(99, 20, 'Kurang', 2, NULL, NULL, NULL),
	(100, 20, 'Kurang sekali', 1, NULL, NULL, NULL),
	(101, 21, 'Bagus sekali', 5, NULL, NULL, NULL),
	(102, 21, 'Bagus', 4, NULL, NULL, NULL),
	(103, 21, 'Cukup', 3, NULL, NULL, NULL),
	(104, 21, 'Kurang', 2, NULL, NULL, NULL),
	(105, 21, 'Kurang sekali', 1, NULL, NULL, NULL),
	(106, 22, 'Bagus sekali', 5, NULL, NULL, NULL),
	(107, 22, 'Bagus', 4, NULL, NULL, NULL),
	(108, 22, 'Cukup', 3, NULL, NULL, NULL),
	(109, 22, 'Kurang', 2, NULL, NULL, NULL),
	(110, 22, 'Kurang sekali', 1, NULL, NULL, NULL),
	(111, 23, 'Bagus sekali', 5, NULL, NULL, NULL),
	(112, 23, 'Bagus', 4, NULL, NULL, NULL),
	(113, 23, 'Cukup', 3, NULL, NULL, NULL),
	(114, 23, 'Kurang', 2, NULL, NULL, NULL),
	(115, 23, 'Kurang sekali', 1, NULL, NULL, NULL),
	(116, 24, 'Bagus sekali', 5, NULL, NULL, NULL),
	(117, 24, 'Bagus', 4, NULL, NULL, NULL),
	(118, 24, 'Cukup', 3, NULL, NULL, NULL),
	(119, 24, 'Kurang', 2, NULL, NULL, NULL),
	(120, 24, 'Kurang sekali', 1, NULL, NULL, NULL),
	(121, 25, 'Bagus sekali', 5, NULL, NULL, NULL),
	(122, 25, 'Bagus', 4, NULL, NULL, NULL),
	(123, 25, 'Cukup', 3, NULL, NULL, NULL),
	(124, 25, 'Kurang', 2, NULL, NULL, NULL),
	(125, 25, 'Kurang sekali', 1, NULL, NULL, NULL),
	(126, 26, 'Bagus sekali', 5, NULL, NULL, NULL),
	(127, 26, 'Bagus', 4, NULL, NULL, NULL),
	(128, 26, 'Cukup', 3, NULL, NULL, NULL),
	(129, 26, 'Kurang', 2, NULL, NULL, NULL),
	(130, 26, 'Kurang sekali', 1, NULL, NULL, NULL),
	(131, 27, 'Bagus sekali', 5, NULL, NULL, NULL),
	(132, 27, 'Bagus', 4, NULL, NULL, NULL),
	(133, 27, 'Cukup', 3, NULL, NULL, NULL),
	(134, 27, 'Kurang', 2, NULL, NULL, NULL),
	(135, 27, 'Kurang sekali', 1, NULL, NULL, NULL),
	(136, 28, 'Bagus sekali', 5, NULL, NULL, NULL),
	(137, 28, 'Bagus', 4, NULL, NULL, NULL),
	(138, 28, 'Cukup', 3, NULL, NULL, NULL),
	(139, 28, 'Kurang', 2, NULL, NULL, NULL),
	(140, 28, 'Kurang sekali', 1, NULL, NULL, NULL),
	(141, 29, 'Bagus sekali', 5, NULL, NULL, NULL),
	(142, 29, 'Bagus', 4, NULL, NULL, NULL),
	(143, 29, 'Cukup', 3, NULL, NULL, NULL),
	(144, 29, 'Kurang', 2, NULL, NULL, NULL),
	(145, 29, 'Kurang sekali', 1, NULL, NULL, NULL),
	(146, 30, 'Bagus sekali', 5, NULL, NULL, NULL),
	(147, 30, 'Bagus', 4, NULL, NULL, NULL),
	(148, 30, 'Cukup', 3, NULL, NULL, NULL),
	(149, 30, 'Kurang', 2, NULL, NULL, NULL),
	(150, 30, 'Kurang sekali', 1, NULL, NULL, NULL),
	(151, 97, 'Baik sekali', 5, '2024-09-22 06:05:30', '2024-09-22 06:05:30', NULL),
	(152, 97, 'Baik', 4, '2024-09-22 06:05:30', '2024-09-22 06:05:30', NULL),
	(153, 97, 'Cukup', 3, '2024-09-22 06:05:30', '2024-09-22 06:05:30', NULL),
	(154, 97, 'Kurang', 2, '2024-09-22 06:05:30', '2024-09-22 06:05:30', NULL),
	(155, 97, 'Kurang Sekali', 1, '2024-09-22 06:05:30', '2024-09-22 06:05:30', NULL);

-- membuang struktur untuk table genbi_poin.penilaian_deputi_questions
CREATE TABLE IF NOT EXISTS `penilaian_deputi_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.penilaian_deputi_questions: ~30 rows (lebih kurang)
INSERT INTO `penilaian_deputi_questions` (`id`, `question`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Bagaimana Anda menilai kualitas pelatihan yang Anda terima?', NULL, NULL, NULL),
	(2, 'Seberapa puas Anda dengan layanan pelanggan yang diberikan?', NULL, NULL, NULL),
	(3, 'Seberapa efektif metode pengajaran yang digunakan?', NULL, NULL, NULL),
	(4, 'Seberapa relevan materi pelatihan dengan pekerjaan Anda?', NULL, NULL, NULL),
	(5, 'Bagaimana kualitas materi pelatihan yang disediakan?', NULL, NULL, NULL),
	(6, 'Seberapa memadai fasilitas pelatihan yang ada?', NULL, NULL, NULL),
	(7, 'Bagaimana kinerja instruktur dalam menyampaikan materi?', NULL, NULL, NULL),
	(8, 'Seberapa baik komunikasi dengan instruktur?', NULL, NULL, NULL),
	(9, 'Seberapa cepat respons instruktur terhadap pertanyaan Anda?', NULL, NULL, NULL),
	(10, 'Bagaimana kualitas alat bantu belajar yang digunakan?', NULL, NULL, NULL),
	(11, 'Seberapa jelas penjelasan materi oleh instruktur?', NULL, NULL, NULL),
	(12, 'Seberapa sering pelatihan dilakukan?', NULL, NULL, NULL),
	(13, 'Bagaimana penilaian Anda terhadap aplikasi pelatihan online?', NULL, NULL, NULL),
	(14, 'Seberapa baik sistem evaluasi dalam pelatihan?', NULL, NULL, NULL),
	(15, 'Bagaimana kesesuaian waktu pelatihan dengan jadwal Anda?', NULL, NULL, NULL),
	(16, 'Bagaimana pengalaman Anda dengan sesi praktik?', NULL, NULL, NULL),
	(17, 'Seberapa banyak materi tambahan yang disediakan?', NULL, NULL, NULL),
	(18, 'Bagaimana sistem penilaian selama pelatihan?', NULL, NULL, NULL),
	(19, 'Seberapa mudah mengakses materi pelatihan?', NULL, NULL, NULL),
	(20, 'Bagaimana penilaian Anda terhadap penyampaian materi oleh instruktur?', NULL, NULL, NULL),
	(21, 'Seberapa banyak feedback yang diterima setelah pelatihan?', NULL, NULL, NULL),
	(22, 'Bagaimana kualitas video atau bahan ajar digital?', NULL, NULL, NULL),
	(23, 'Seberapa baik dukungan teknis yang disediakan?', NULL, NULL, NULL),
	(24, 'Seberapa relevan studi kasus yang digunakan dalam pelatihan?', NULL, NULL, NULL),
	(25, 'Bagaimana tingkat kepuasan Anda dengan hasil akhir pelatihan?', NULL, NULL, NULL),
	(26, 'Seberapa banyak materi yang bermanfaat untuk pekerjaan Anda?', NULL, NULL, NULL),
	(27, 'Bagaimana penilaian Anda terhadap waktu yang dihabiskan untuk pelatihan?', NULL, NULL, NULL),
	(28, 'Seberapa banyak keterampilan baru yang Anda pelajari?', NULL, NULL, NULL),
	(29, 'Bagaimana cara instruktur menjawab pertanyaan Anda?', NULL, NULL, NULL),
	(30, 'Seberapa baik pelatihan ini mempersiapkan Anda untuk tugas pekerjaan baru?', NULL, NULL, NULL),
	(97, 'Pertanyaan Demo', '2024-09-22 06:05:30', '2024-09-22 06:05:30', NULL);

-- membuang struktur untuk table genbi_poin.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.permissions: ~81 rows (lebih kurang)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(2, 'view_any_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(3, 'create_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(4, 'update_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(5, 'restore_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(6, 'restore_any_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(7, 'replicate_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(8, 'reorder_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(9, 'delete_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(10, 'delete_any_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(11, 'force_delete_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(12, 'force_delete_any_jadwal::absensi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(13, 'view_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(14, 'view_any_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(15, 'create_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(16, 'update_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(17, 'restore_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(18, 'restore_any_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(19, 'replicate_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(20, 'reorder_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(21, 'delete_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(22, 'delete_any_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(23, 'force_delete_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(24, 'force_delete_any_kegiatan', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(25, 'view_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(26, 'view_any_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(27, 'create_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(28, 'update_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(29, 'restore_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(30, 'restore_any_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(31, 'replicate_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(32, 'reorder_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(33, 'delete_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(34, 'delete_any_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(35, 'force_delete_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(36, 'force_delete_any_penilaian::deputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(37, 'view_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(38, 'view_any_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(39, 'create_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(40, 'update_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(41, 'restore_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(42, 'restore_any_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(43, 'replicate_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(44, 'reorder_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(45, 'delete_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(46, 'delete_any_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(47, 'force_delete_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(48, 'force_delete_any_penilaian::deputi::answer', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(49, 'view_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(50, 'view_any_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(51, 'create_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(52, 'update_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(53, 'restore_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(54, 'restore_any_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(55, 'replicate_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(56, 'reorder_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(57, 'delete_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(58, 'delete_any_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(59, 'force_delete_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(60, 'force_delete_any_penilaian::deputi::question', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(61, 'view_role', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(62, 'view_any_role', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(63, 'create_role', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(64, 'update_role', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(65, 'delete_role', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(66, 'delete_any_role', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(67, 'view_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(68, 'view_any_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(69, 'create_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(70, 'update_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(71, 'restore_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(72, 'restore_any_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(73, 'replicate_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(74, 'reorder_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(75, 'delete_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(76, 'delete_any_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(77, 'force_delete_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(78, 'force_delete_any_user', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(79, 'page_PenilaianDeputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(80, 'page_Ranking', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(81, 'page_RankingDeputi', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17');

-- membuang struktur untuk table genbi_poin.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.roles: ~4 rows (lebih kurang)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'super_admin', 'web', '2024-09-22 05:25:17', '2024-09-22 05:25:17'),
	(2, 'deputi', 'web', '2024-09-22 05:26:51', '2024-09-22 05:26:51'),
	(3, 'bph', 'web', '2024-09-22 05:37:53', '2024-09-22 05:37:53'),
	(4, 'member', 'web', '2024-09-22 05:39:28', '2024-09-22 05:39:28');

-- membuang struktur untuk table genbi_poin.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.role_has_permissions: ~127 rows (lebih kurang)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(63, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(73, 1),
	(74, 1),
	(75, 1),
	(76, 1),
	(77, 1),
	(78, 1),
	(79, 1),
	(80, 1),
	(81, 1),
	(1, 2),
	(2, 2),
	(4, 2),
	(13, 2),
	(14, 2),
	(16, 2),
	(37, 2),
	(38, 2),
	(80, 2),
	(81, 2),
	(1, 3),
	(2, 3),
	(3, 3),
	(4, 3),
	(9, 3),
	(10, 3),
	(25, 3),
	(26, 3),
	(27, 3),
	(28, 3),
	(33, 3),
	(34, 3),
	(37, 3),
	(38, 3),
	(49, 3),
	(50, 3),
	(51, 3),
	(52, 3),
	(57, 3),
	(58, 3),
	(80, 3),
	(81, 3),
	(1, 4),
	(2, 4),
	(4, 4),
	(13, 4),
	(14, 4),
	(15, 4),
	(16, 4),
	(21, 4),
	(22, 4),
	(25, 4),
	(26, 4),
	(28, 4),
	(79, 4),
	(80, 4),
	(81, 4);

-- membuang struktur untuk table genbi_poin.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
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

-- Membuang data untuk tabel genbi_poin.sessions: ~2 rows (lebih kurang)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('OqTGNFq4t7qHXu3xM74MLHJkdpQknFLBX55BEBjl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiejY4OXV6S1VWekhmS0N0alFsUGswaFA5T1VEd2ozR3J0eFBzNHZKSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9nZW5iaS1wb2luLnRlc3QvYWRtaW4vamFkd2FsLWFic2Vuc2lzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJDN6bEZQQWJ0YnRaMnFtQ2h0Nnp0OS42UUJwMHVLamVCbEp5elB0dGRrOVgvbkFoV0JIRXBHIjtzOjY6InRhYmxlcyI7YToxOntzOjE4OiJMaXN0VXNlcnNfcGVyX3BhZ2UiO3M6MzoiYWxsIjt9fQ==', 1727138846),
	('XYcX3A40cqCAguGd0TU4NXQdygp6mHdMWOzrJS6T', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoicXlqR0hEWmUySktTWjNDeVkyekZMQW51SllKd2Rkdkk0YW9YMkc3SCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vZ2VuYmktcG9pbi50ZXN0L2FkbWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTQ7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRxaE9JcFlQZkNkZjhqaExySkdVLnFPUXhGQ0FZZUd3RzliNmtVQjV1Q015emlZNzg4LzkuZSI7fQ==', 1727132650);

-- membuang struktur untuk table genbi_poin.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komsat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel genbi_poin.users: ~20 rows (lebih kurang)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `komsat`, `bidang`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Rifki Romadhan', 'ikki@gmail.com', NULL, '$2y$12$3zlFPAbtbtZ2qmCht6zt9.6QBp0uKjeBlJyzPttdk9X/nAhWBHEpG', NULL, NULL, 'PXpurhWgBcjMFhvB0N0arMZu5FnEH7hGTkhYj5Py5sISd9BfhncvptEzpW8P', '2024-09-19 07:45:41', '2024-09-19 07:45:41', NULL),
	(2, 'Member 1', 'member@gmail.com', '2024-09-19 07:54:29', '$2y$12$Qm4pr0fgd3FxvSr/q3MLluEpDZLbQ8s/yXoWwjzJv3awT5OVccQw6', 'ump', 'ekonomi', 'otH04XuRe0AIZdtGErT7SehzUat1Qz2mviXulSzpiQ78PMkLda6BIhCiE7Ih', '2024-09-19 07:54:48', '2024-09-19 07:54:48', NULL),
	(3, 'Deputi 2', 'dep2@gmail.com', '2024-09-19 07:55:20', '$2y$12$l1dLDDhFm5r57XOVHpJpbO3nMKWf2KPcNq73wqzHBMB.JWJK6i9D.', 'unsoed', 'medeks', 'FPNwaJmaNEvQkzI45ryVPqC1uVSGyDXe8GnYz4S89h2KyWbd3s7AL7EdtBUV', '2024-09-19 07:55:42', '2024-09-19 07:55:42', NULL),
	(6, 'Member 2', 'member2@gmail.com', '2024-09-19 08:12:56', '$2y$12$xb/zzTHNwNgDjyTH/6UxP.NWZVLRZe6fSsCggK5MuV7xFMkzkG.uO', 'unsoed', 'medeks', NULL, '2024-09-19 08:13:25', '2024-09-19 08:13:25', NULL),
	(7, 'Deputi 1', 'dep@gmail.com', '2024-09-19 08:34:43', '$2y$12$K/is3jn4DxdUQ6n1KuZi2uXkIE2s4bUaXWZqvPY34zHfUobN0eHwy', 'ump', 'ekonomi', NULL, '2024-09-19 08:35:24', '2024-09-19 08:35:24', NULL),
	(8, 'Member 3', 'member3@gmail.com', '2024-09-21 21:43:04', '$2y$12$srf3TKiso1nc7cj9.S1OGezSZHp/.j2hcbBpnhM0wKRHqriJLyL5.', 'uin', 'lingkungan', NULL, '2024-09-21 21:43:31', '2024-09-21 21:43:31', NULL),
	(9, 'BPH BARU', 'bph1@gmail.com', '2024-09-21 21:46:38', '$2y$12$g0NLMVjY77QaNgJiez4.fuJm0g561JylAWYucDnVnjfeFba5zCYPG', 'unsoed', 'bph', NULL, '2024-09-21 21:47:16', '2024-09-21 21:47:25', NULL),
	(10, 'DEPUTI UIN LINGKUNGAN', 'deputilingkunganUIN@gmail.com', '2024-09-22 05:19:08', '$2y$12$rTRNwg0U/ElhZM3kuS7WmeGY9tHbm03opP/ZnxoDLncKIHqnwvpvG', 'uin', 'lingkungan', NULL, '2024-09-22 05:19:40', '2024-09-22 05:19:40', NULL),
	(12, 'Member Medeks unsoed', 'membermedeksunsoed@gmail.com', '2024-09-22 06:01:13', '$2y$12$yGQbNnu/yJqLNhHTIFBk1.BBaluAxbgmW4w.mAvA3rllf8to./bpO', 'unsoed', 'medeks', NULL, '2024-09-22 06:01:50', '2024-09-22 06:01:50', NULL),
	(13, 'Member Medeks UIN ', 'membermedeksuin@gmail.com', '2024-09-22 18:47:21', '$2y$12$1p20svSnOvoBVuNGGvshnuOGX8f81H4j2EcVE1MUMY6vSh4Aos7Bu', 'uin', 'medeks', NULL, '2024-09-22 18:47:50', '2024-09-22 18:47:50', NULL),
	(14, 'Daniel Clark', 'lcharles@yahoo.com', NULL, '$2y$12$qhOIpYPfCdf8jhLrJGU.qOQxFCAYeGwG9b6kUB5uCMyziY788/9.e', 'uin', 'bph', NULL, '2024-09-23 15:35:13', '2024-09-23 15:35:13', NULL),
	(15, 'Joe Holmes PhD', 'deannamcknight@yahoo.com', NULL, '$2y$12$ODJPwVZDcR5KrowYj81F6eE6hISlf/NhApjxFVQSYHbUdYben6Za6', 'uin', 'medeks', NULL, '2024-09-23 15:35:14', '2024-09-23 15:35:14', NULL),
	(16, 'Sandra Costa', 'sara36@yahoo.com', NULL, '$2y$12$Y8jcQKUkQsTexIELhqWJ9uF9gE7Y9NAJxiesGPuPPqoaRRmsVlzuG', 'unsoed', 'pendidikan', NULL, '2024-09-23 15:35:14', '2024-09-23 15:35:14', NULL),
	(17, 'Kimberly White', 'kennethburns@crawford-wu.com', NULL, '$2y$12$6cJWu6Ph/gW24zTccz05we/FJGqLkRYP/aqmpbC.V1wEH7You0jCu', 'ump', 'kesehatan', NULL, '2024-09-23 15:35:15', '2024-09-23 15:35:15', NULL),
	(18, 'Jason Taylor', 'oneillkatherine@yahoo.com', NULL, '$2y$12$WWwpzP/zPaqTPoF7EOIO/O4cIA3s3sxHsrw4o9pptdLZrybRIs99K', 'unsoed', 'kesehatan', NULL, '2024-09-23 15:35:15', '2024-09-23 15:35:15', NULL),
	(19, 'Erica Murray', 'coleallison@peterson-williams.org', NULL, '$2y$12$aQHRaDSXAAasVeQM48VI4OtA0UsGrDSLv7lXccsWajf3PG46Pm.Jq', 'unsoed', 'pendidikan', NULL, '2024-09-23 15:35:16', '2024-09-23 15:35:16', NULL),
	(20, 'Susan Allen', 'zwilson@roth-martinez.info', NULL, '$2y$12$g7uNcguV/eRTUjU8wx8DDOqcYYC4wEmJsGM2DIXmTX1YurBgyxwZe', 'ump', 'pendidikan', NULL, '2024-09-23 15:35:16', '2024-09-23 15:35:16', NULL),
	(21, 'Ashley Perry', 'laurenmitchell@gmail.com', NULL, '$2y$12$.snNB/djH91teBaYfbN4XeHHQ9X5cV/wkGq0hWGckBaXPFJyUXk2O', 'unsoed', 'ekonomi', NULL, '2024-09-23 15:35:17', '2024-09-23 15:35:17', NULL),
	(22, 'John Mccarty', 'ernestmiller@yahoo.com', NULL, '$2y$12$et903x4dr3xO0zvsBniWVOx26BAd.kAi7dgRARMTOA9gBnR6TmG8i', 'unsoed', 'medeks', NULL, '2024-09-23 15:35:17', '2024-09-23 15:35:17', NULL),
	(23, 'Nathan Olson', 'michael54@gmail.com', NULL, '$2y$12$5NjvyJYChDxRD7rcA8p4QOvKMs8Y7wYdJxEgnW1Q7YX6JluuOLIpq', 'uin', 'medeks', NULL, '2024-09-23 15:35:17', '2024-09-23 15:35:17', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
