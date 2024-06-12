/*
SQLyog Ultimate
MySQL - 10.4.28-MariaDB : Database - labuanbajo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `aturan` */

CREATE TABLE `aturan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `minimal_tabungan` bigint(20) NOT NULL,
  `maximal_tabungan` bigint(20) DEFAULT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `id_bunga` int(11) DEFAULT NULL,
  `id_iuran` int(11) DEFAULT NULL,
  `status` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aturan` */

insert  into `aturan`(`id`,`minimal_tabungan`,`maximal_tabungan`,`id_pinjaman`,`id_bunga`,`id_iuran`,`status`,`created_at`,`updated_at`) values 
(1,900000,100000000000,1,1,1,1,'2023-09-09 07:54:32','2024-06-12 07:33:53'),
(3,50000,100000,1,1,1,1,'2024-06-12 10:22:14','2024-06-12 10:22:14'),
(4,50000,100000,1,1,1,1,'2024-06-12 10:23:02','2024-06-12 10:23:02'),
(5,50000,100000,1,1,1,1,'2024-06-12 10:23:17','2024-06-12 10:23:17'),
(6,50000,100000,1,1,1,1,'2024-06-12 10:23:48','2024-06-12 10:23:48'),
(7,90000,390000,1,1,1,1,'2024-06-12 10:31:07','2024-06-12 10:31:07'),
(8,90000,390000,1,1,1,1,'2024-06-12 10:31:15','2024-06-12 10:31:15'),
(9,900000,1900000,1,1,1,1,'2024-06-12 10:31:42','2024-06-12 10:31:42');

/*Table structure for table `aturan_bunga` */

CREATE TABLE `aturan_bunga` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bunga` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aturan_bunga` */

insert  into `aturan_bunga`(`id`,`bunga`,`status`,`created_at`,`updated_at`) values 
(1,10,1,'2023-10-05 10:16:25','2023-10-05 10:36:12');

/*Table structure for table `aturan_cicilan` */

CREATE TABLE `aturan_cicilan` (
  `id_cicilan` int(11) NOT NULL AUTO_INCREMENT,
  `cicilan` tinyint(3) DEFAULT NULL,
  `status_cicilan` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cicilan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aturan_cicilan` */

insert  into `aturan_cicilan`(`id_cicilan`,`cicilan`,`status_cicilan`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,1,'2024-06-12 16:07:31','2024-06-12 09:07:31',NULL);

/*Table structure for table `aturan_iuran` */

CREATE TABLE `aturan_iuran` (
  `id_iuran` int(11) NOT NULL AUTO_INCREMENT,
  `iuran` int(11) DEFAULT NULL,
  `status_iuran` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_iuran`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aturan_iuran` */

insert  into `aturan_iuran`(`id_iuran`,`iuran`,`status_iuran`,`created_at`,`updated_at`,`deleted_at`) values 
(1,100000,1,'2024-06-12 16:06:27','2024-06-12 09:06:27',NULL);

/*Table structure for table `aturan_pinjaman` */

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

/*Table structure for table `map_aturan_cicilan` */

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

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

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

/*Table structure for table `simpanan` */

CREATE TABLE `simpanan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `simpanan` */

insert  into `simpanan`(`id`,`id_user`,`id_admin`,`tanggal`,`nominal`,`status`,`created_at`,`updated_at`) values 
(1,2,1,'2023-09-13',100000,0,'2023-09-06 12:52:58','2023-09-06 12:52:58'),
(2,2,1,'2023-09-05',8900123,1,'2023-09-06 13:49:35','2023-09-21 09:22:04'),
(3,2,1,'2023-09-05',3456789,1,'2023-09-06 13:49:49','2023-09-21 08:53:39'),
(4,2,1,'2023-09-05',123123,1,'2023-09-06 13:50:31','2023-09-06 13:50:31'),
(17,2,1,'2023-09-05',500000,1,'2023-09-21 08:26:35','2023-09-21 08:26:35'),
(18,2,1,'2023-09-05',500000,1,'2023-09-21 08:26:38','2023-09-21 08:26:38'),
(19,2,1,'2023-09-05',500000,1,'2023-09-21 08:34:39','2023-09-21 08:34:39'),
(20,2,1,'2023-09-05',500000,1,'2023-09-21 08:34:53','2023-09-21 08:34:53'),
(21,2,1,'2023-09-05',500000,1,'2023-09-21 08:35:12','2023-09-21 08:35:12'),
(22,2,1,'2023-09-05',500000,1,'2023-09-21 08:35:25','2023-09-21 08:35:25'),
(23,2,1,'2023-09-05',500000,1,'2023-09-21 08:36:53','2023-09-21 08:36:53'),
(24,2,1,'2023-09-05',500000,1,'2023-09-21 08:37:09','2023-09-21 08:37:09'),
(25,2,1,'2023-09-05',500000,1,'2023-09-21 08:38:09','2023-09-21 08:38:09'),
(26,2,1,'2023-09-05',500000,1,'2023-09-21 08:38:31','2023-09-21 08:38:31'),
(27,2,1,'2023-09-05',500000,1,'2023-09-21 08:39:00','2023-09-21 08:39:00'),
(28,2,1,'2023-09-05',500000,1,'2023-09-21 08:40:02','2023-09-21 08:40:02'),
(29,2,1,'2023-09-05',500000,1,'2023-09-21 08:40:21','2023-09-21 08:40:21'),
(30,2,1,'2023-09-05',500000,1,'2023-09-21 08:41:17','2023-09-21 08:41:17'),
(31,2,1,'2023-09-21',4567890,1,'2023-09-21 09:21:19','2023-09-21 09:21:19');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`nik`,`telp`,`total_simpanan`,`total_pinjaman`,`minimal_bayar`,`status`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role`) values 
(1,'Hansel','a@a.com','198027319827309','081357260908',0,0,0,1,NULL,'$2y$10$YYkG/.w7akCl/RxeOqMQre5HE4XpJThFScD6Bew7zOe3LChFhF2Qq','eW1IdEKM4ILXqRGaHmbuWWPY8NsdRHfV9ewvH47aYmc4BBBSLkIEfHdI735C','2023-09-06 11:09:22','2023-09-06 11:09:22',0),
(2,'Nasbah 1','b@b.com','12342341345','081237912837',0,0,0,1,NULL,'$2y$10$/v.iKVWRuMzTqiLBqV22q.gWv8faFr7THzBSk1xNsE5d9uXfXdnYG',NULL,'2023-09-06 11:10:16','2023-09-06 11:10:16',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
