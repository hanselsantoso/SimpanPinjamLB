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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aturan` */

/*Table structure for table `aturan_bunga` */

DROP TABLE IF EXISTS `aturan_bunga`;

CREATE TABLE `aturan_bunga` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bunga` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aturan_bunga` */

/*Table structure for table `aturan_bunga_pinjaman` */

DROP TABLE IF EXISTS `aturan_bunga_pinjaman`;

CREATE TABLE `aturan_bunga_pinjaman` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bunga_pinjaman` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aturan_bunga_pinjaman` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aturan_cicilan` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aturan_iuran` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aturan_pinjaman` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `log_shu` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `map_aturan_cicilan` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemegang_shu` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pinjaman_d` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pinjaman_h` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `simpanan` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `simpanan_h` */

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`alamat`,`nik`,`telp`,`tanggal_lahir`,`tempat_lahir`,`total_simpanan`,`total_pinjaman`,`minimal_bayar`,`status`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role`) values 
(1,'SuperAdmin','super@super.com',NULL,'','',NULL,NULL,0,0,0,0,NULL,'$2y$10$YYkG/.w7akCl/RxeOqMQre5HE4XpJThFScD6Bew7zOe3LChFhF2Qq',NULL,NULL,NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
