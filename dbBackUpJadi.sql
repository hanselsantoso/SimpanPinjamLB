/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - labuan_bajo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`labuan_bajo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `labuan_bajo`;

/*Table structure for table `aturan` */

DROP TABLE IF EXISTS `aturan`;

CREATE TABLE `aturan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `minimal_tabungan` bigint(20) NOT NULL,
  `maximal_tabungan` bigint(20) DEFAULT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `id_bunga` int(11) DEFAULT NULL,
  `id_bunga_pinjaman` int(11) DEFAULT NULL,
  `id_cicilan` int(11) DEFAULT NULL,
  `id_iuran` int(11) DEFAULT NULL,
  `status` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aturan` */

insert  into `aturan`(`id`,`minimal_tabungan`,`maximal_tabungan`,`id_pinjaman`,`id_bunga`,`id_bunga_pinjaman`,`id_cicilan`,`id_iuran`,`status`,`created_at`,`updated_at`) values 
(1,0,100000000,1,1,1,1,1,1,'2024-06-15 09:37:22','2024-06-15 10:14:45'),
(2,20000000,5000000,1,2,NULL,2,2,1,'2024-06-24 08:02:46','2024-06-24 08:02:46');

/*Table structure for table `aturan_bunga` */

DROP TABLE IF EXISTS `aturan_bunga`;

CREATE TABLE `aturan_bunga` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bunga` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aturan_bunga` */

insert  into `aturan_bunga`(`id`,`bunga`,`status`,`created_at`,`updated_at`) values 
(1,1,1,'2023-10-05 10:16:25','2024-06-23 13:32:13'),
(2,2,1,'2024-06-24 08:01:09','2024-06-24 08:01:09');

/*Table structure for table `aturan_bunga_pinjaman` */

DROP TABLE IF EXISTS `aturan_bunga_pinjaman`;

CREATE TABLE `aturan_bunga_pinjaman` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bunga_pinjaman` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aturan_bunga_pinjaman` */

insert  into `aturan_bunga_pinjaman`(`id`,`bunga_pinjaman`,`status`,`created_at`,`updated_at`) values 
(1,5,1,'2024-06-15 09:55:37','2024-06-15 09:55:37'),
(2,10,1,'2024-06-24 08:01:21','2024-06-24 08:01:21');

/*Table structure for table `aturan_cicilan` */

DROP TABLE IF EXISTS `aturan_cicilan`;

CREATE TABLE `aturan_cicilan` (
  `id_cicilan` int(11) NOT NULL AUTO_INCREMENT,
  `cicilan` tinyint(3) DEFAULT NULL,
  `status_cicilan` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cicilan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aturan_cicilan` */

insert  into `aturan_cicilan`(`id_cicilan`,`cicilan`,`status_cicilan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,12,1,'2024-06-19 19:56:04','2024-06-19 12:56:04',NULL),
(2,24,1,'2024-06-24 08:01:29','2024-06-24 08:01:29',NULL);

/*Table structure for table `aturan_iuran` */

DROP TABLE IF EXISTS `aturan_iuran`;

CREATE TABLE `aturan_iuran` (
  `id_iuran` int(11) NOT NULL AUTO_INCREMENT,
  `iuran` int(11) DEFAULT NULL,
  `status_iuran` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_iuran`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aturan_iuran` */

insert  into `aturan_iuran`(`id_iuran`,`iuran`,`status_iuran`,`created_at`,`updated_at`,`deleted_at`) values 
(1,100000,1,'2024-06-12 16:06:27','2024-06-12 09:06:27',NULL),
(2,200000,1,'2024-06-24 08:02:10','2024-06-24 08:02:10',NULL);

/*Table structure for table `aturan_pinjaman` */

DROP TABLE IF EXISTS `aturan_pinjaman`;

CREATE TABLE `aturan_pinjaman` (
  `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT,
  `pinjaman` float DEFAULT NULL,
  `status_pinjaman` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pinjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aturan_pinjaman` */

insert  into `aturan_pinjaman`(`id_pinjaman`,`pinjaman`,`status_pinjaman`,`created_at`,`updated_at`,`deleted_at`) values 
(1,50,1,'2024-06-12 16:32:47','2024-06-12 09:32:47',NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `log_bunga` */

DROP TABLE IF EXISTS `log_bunga`;

CREATE TABLE `log_bunga` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_log` date DEFAULT NULL,
  `status_log` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `log_bunga` */

/*Table structure for table `log_shu` */

DROP TABLE IF EXISTS `log_shu`;

CREATE TABLE `log_shu` (
  `id_log_shu` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemegang_shu` int(11) DEFAULT NULL,
  `shu` bigint(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_log_shu` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log_shu`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `log_shu` */

insert  into `log_shu`(`id_log_shu`,`id_pemegang_shu`,`shu`,`tanggal`,`status_log_shu`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,20000,'2024-06-23',1,'2024-06-23 13:49:50','2024-06-23 13:49:50',NULL),
(2,2,25000,'2024-06-23',1,'2024-06-23 13:49:50','2024-06-23 13:49:50',NULL),
(3,3,5000,'2024-06-23',1,'2024-06-23 13:49:50','2024-06-23 13:49:50',NULL),
(4,1,-77806,'2024-06-30',1,'2024-06-30 09:53:26','2024-06-30 09:53:26',NULL),
(5,2,-97258,'2024-06-30',1,'2024-06-30 09:53:26','2024-06-30 09:53:26',NULL),
(6,3,-19452,'2024-06-30',1,'2024-06-30 09:53:26','2024-06-30 09:53:26',NULL);

/*Table structure for table `map_aturan_cicilan` */

DROP TABLE IF EXISTS `map_aturan_cicilan`;

CREATE TABLE `map_aturan_cicilan` (
  `id_map` int(11) NOT NULL AUTO_INCREMENT,
  `id_aturan` int(11) DEFAULT NULL,
  `id_cicilan` int(11) DEFAULT NULL,
  `status_map` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_map`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `map_aturan_cicilan` */

insert  into `map_aturan_cicilan`(`id_map`,`id_aturan`,`id_cicilan`,`status_map`,`created_at`,`updated_at`,`deleted_at`) values 
(1,6,1,1,'2024-06-12 17:23:48',NULL,NULL),
(2,8,1,1,'2024-06-12 17:31:15',NULL,NULL),
(3,9,1,1,'2024-06-12 17:31:42',NULL,NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(8,'2014_10_12_000000_create_users_table',1),
(9,'2014_10_12_100000_create_password_reset_tokens_table',1),
(10,'2014_10_12_100000_create_password_resets_table',1),
(11,'2019_08_19_000000_create_failed_jobs_table',1),
(12,'2019_12_14_000001_create_personal_access_tokens_table',1),
(13,'2023_09_02_142803_add_role_as_to_users_table',1),
(14,'2023_09_06_092059_create_simpanan_table',1),
(15,'2023_09_08_102021_create_aturan_table',2),
(16,'2023_09_22_043727_create_bunga_table',3);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pemegang_shu` */

DROP TABLE IF EXISTS `pemegang_shu`;

CREATE TABLE `pemegang_shu` (
  `id_pemegang_shu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemegang_shu` varchar(255) DEFAULT NULL,
  `persentase_pemegang_shu` tinyint(3) DEFAULT NULL,
  `status_pemegang_shu` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pemegang_shu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemegang_shu` */

insert  into `pemegang_shu`(`id_pemegang_shu`,`nama_pemegang_shu`,`persentase_pemegang_shu`,`status_pemegang_shu`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Organisasi',40,1,NULL,'2024-06-23 13:02:56',NULL),
(2,'Pengurus',50,1,NULL,NULL,NULL),
(3,'Nasabah',10,1,NULL,NULL,NULL);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `pinjaman_d` */

DROP TABLE IF EXISTS `pinjaman_d`;

CREATE TABLE `pinjaman_d` (
  `id_pinjaman_d` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman_h` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `pinjaman` bigint(20) DEFAULT NULL,
  `status_pinjaman_d` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pinjaman_d`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pinjaman_d` */

insert  into `pinjaman_d`(`id_pinjaman_d`,`id_pinjaman_h`,`id_admin`,`tanggal`,`pinjaman`,`status_pinjaman_d`,`created_at`,`updated_at`,`deleted_at`) values 
(25,3,1,'2024-07-21',350000,1,'2024-06-21 05:48:58','2024-06-21 05:49:09',NULL),
(26,3,1,'2024-08-21',348611,1,'2024-06-21 05:48:58','2024-06-21 05:49:10',NULL),
(27,3,1,'2024-09-21',347222,1,'2024-06-21 05:48:58','2024-06-21 05:49:12',NULL),
(28,3,1,'2024-10-21',345833,1,'2024-06-21 05:48:58','2024-06-24 08:04:57',NULL),
(29,3,1,'2024-11-21',344444,0,'2024-06-21 05:48:58','2024-06-21 05:48:58',NULL),
(30,3,1,'2024-12-21',343056,0,'2024-06-21 05:48:58','2024-06-21 05:48:58',NULL),
(31,3,1,'2025-01-21',341667,0,'2024-06-21 05:48:58','2024-06-21 05:48:58',NULL),
(32,3,1,'2025-02-21',340278,0,'2024-06-21 05:48:58','2024-06-21 05:48:58',NULL),
(33,3,1,'2025-03-21',338889,0,'2024-06-21 05:48:58','2024-06-21 05:48:58',NULL),
(34,3,1,'2025-04-21',337500,0,'2024-06-21 05:48:58','2024-06-21 05:48:58',NULL),
(35,3,1,'2025-05-21',336111,0,'2024-06-21 05:48:58','2024-06-21 05:48:58',NULL),
(36,3,1,'2025-06-21',334722,0,'2024-06-21 05:48:58','2024-06-21 05:48:58',NULL),
(37,4,1,'2024-07-30',87500,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(38,4,1,'2024-08-30',87153,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(39,4,1,'2024-09-30',86806,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(40,4,1,'2024-10-30',86458,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(41,4,1,'2024-11-30',86111,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(42,4,1,'2024-12-30',85764,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(43,4,1,'2025-01-30',85417,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(44,4,1,'2025-03-02',85069,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(45,4,1,'2025-03-30',84722,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(46,4,1,'2025-04-30',84375,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(47,4,1,'2025-05-30',84028,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(48,4,1,'2025-06-30',83681,0,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(49,5,1,'2024-07-30',17500,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(50,5,1,'2024-08-30',17431,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(51,5,1,'2024-09-30',17361,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(52,5,1,'2024-10-30',17292,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(53,5,1,'2024-11-30',17222,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(54,5,1,'2024-12-30',17153,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(55,5,1,'2025-01-30',17083,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(56,5,1,'2025-03-02',17014,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(57,5,1,'2025-03-30',16944,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(58,5,1,'2025-04-30',16875,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(59,5,1,'2025-05-30',16806,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL),
(60,5,1,'2025-06-30',16736,0,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL);

/*Table structure for table `pinjaman_h` */

DROP TABLE IF EXISTS `pinjaman_h`;

CREATE TABLE `pinjaman_h` (
  `id_pinjaman_h` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `total_pinjaman` bigint(20) DEFAULT NULL,
  `total_cicilan` bigint(20) DEFAULT NULL,
  `tanggal_pinjaman` date DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `status_pinjaman_h` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pinjaman_h`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pinjaman_h` */

insert  into `pinjaman_h`(`id_pinjaman_h`,`id_user`,`total_pinjaman`,`total_cicilan`,`tanggal_pinjaman`,`jatuh_tempo`,`status_pinjaman_h`,`created_at`,`updated_at`,`deleted_at`) values 
(3,2,4000000,8,'2024-06-21','2025-06-21',1,'2024-06-21 05:48:58','2024-06-24 08:04:57',NULL),
(4,3,1000000,12,'2024-06-30','2025-06-30',1,'2024-06-30 09:52:56','2024-06-30 09:52:56',NULL),
(5,4,200000,12,'2024-06-30','2025-06-30',1,'2024-06-30 09:53:09','2024-06-30 09:53:09',NULL);

/*Table structure for table `simpanan` */

DROP TABLE IF EXISTS `simpanan`;

CREATE TABLE `simpanan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_simpanan_h` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `simpanan` */

insert  into `simpanan`(`id`,`id_simpanan_h`,`id_admin`,`tanggal`,`nominal`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(3,1,1,'2024-06-15',10000000,0,'2024-06-15 05:33:46','2024-06-15 05:33:46',NULL),
(4,1,1,'2024-06-15',5000000,1,'2024-06-15 05:33:58','2024-06-15 05:33:58',NULL),
(8,1,1,'2024-06-23',150000,2,'2024-06-23 13:42:47','2024-06-23 13:42:47',NULL),
(10,1,1,'2024-06-23',5000,3,'2024-06-23 13:49:50','2024-06-23 13:49:50',NULL),
(11,1,1,'2024-06-24',151500,2,'2024-06-24 08:05:35','2024-06-24 08:05:35',NULL),
(12,1,1,'2024-06-30',153015,2,'2024-06-30 09:39:07','2024-06-30 09:39:07',NULL),
(13,2,1,'2024-06-30',1000000,0,'2024-06-30 09:52:29','2024-06-30 09:52:29',NULL),
(14,3,1,'2024-06-30',9000000,0,'2024-06-30 09:52:48','2024-06-30 09:52:48',NULL),
(15,1,1,'2024-06-30',-6484,3,'2024-06-30 09:53:26','2024-06-30 09:53:26',NULL),
(16,3,1,'2024-06-30',-6484,3,'2024-06-30 09:53:26','2024-06-30 09:53:26',NULL),
(17,2,1,'2024-06-30',-6484,3,'2024-06-30 09:53:26','2024-06-30 09:53:26',NULL);

/*Table structure for table `simpanan_h` */

DROP TABLE IF EXISTS `simpanan_h`;

CREATE TABLE `simpanan_h` (
  `id_simpanan_h` int(11) NOT NULL AUTO_INCREMENT,
  `total_simpanan` bigint(20) DEFAULT NULL,
  `tanggal_simpanan` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_simpanan_h` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_simpanan_h`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `simpanan_h` */

insert  into `simpanan_h`(`id_simpanan_h`,`total_simpanan`,`tanggal_simpanan`,`id_user`,`status_simpanan_h`,`created_at`,`updated_at`,`deleted_at`) values 
(1,15454515,'2024-06-15',2,1,'2024-06-14 08:02:14','2024-06-30 09:39:07',NULL),
(2,1000000,'2024-06-30',4,1,'2024-06-30 09:52:29','2024-06-30 09:52:29',NULL),
(3,9000000,'2024-06-30',3,1,'2024-06-30 09:52:48','2024-06-30 09:52:48',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nik` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `total_simpanan` bigint(20) NOT NULL DEFAULT 0,
  `total_pinjaman` bigint(20) NOT NULL DEFAULT 0,
  `minimal_bayar` bigint(20) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`alamat`,`nik`,`telp`,`tanggal_lahir`,`tempat_lahir`,`total_simpanan`,`total_pinjaman`,`minimal_bayar`,`status`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role`) values 
(1,'Hansel','a@a.com',NULL,'198027319827309','081357260908',NULL,NULL,0,0,0,1,NULL,'$2y$10$YYkG/.w7akCl/RxeOqMQre5HE4XpJThFScD6Bew7zOe3LChFhF2Qq','kxlFA4xvLRdwN45tHvaqalWhYAbStcTuJFNwp2SBjVarv1V0FUaNPTrIWXoa','2023-09-06 11:09:22','2023-09-06 11:09:22',0),
(2,'asdasdasd','b@b.com','tokek','12342341345','081237912837','2024-07-10','123asdasd',0,0,0,1,NULL,'$2y$10$/v.iKVWRuMzTqiLBqV22q.gWv8faFr7THzBSk1xNsE5d9uXfXdnYG',NULL,'2023-09-06 11:10:16','2024-06-30 17:31:38',1),
(3,'Nasabah 2','c@c.com',NULL,'123716231210827','0861231923617',NULL,NULL,0,0,0,1,NULL,'$2y$10$6DIk1D6yVmiGp4CTX8g81Oh3gQYDK1SM1NLOZdYckFu71gM2q7hhq',NULL,'2024-06-24 07:54:57','2024-06-30 17:32:04',1),
(4,'Nasabah 3','d@d.com',NULL,'1872631982391870','08123618231',NULL,NULL,0,0,0,1,NULL,'$2y$10$rIPAlkupHNXJsGTNCfVG/.hMRU7n1QcWII873n3sg8J/NKF7SkemG',NULL,'2024-06-24 07:57:23','2024-06-24 07:57:23',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
