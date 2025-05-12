-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour projet
CREATE DATABASE IF NOT EXISTS `projet` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `projet`;

-- Listage de la structure de table projet. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('entreprise','individu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet.categories : ~11 rows (environ)
INSERT INTO `categories` (`id`, `name_categorie`, `description`, `type`, `image`, `created_at`, `updated_at`) VALUES
	(13, 'IT Services', 'Professional IT solutions for individuals and organizations, including technical support, network management, and cybersecurity.', 'entreprise', '1742337225.jpg', '2025-03-18 21:12:37', '2025-03-18 21:33:45'),
	(14, 'Delivery', 'Fast and efficient logistics services for transporting goods. Whether for personal packages or business shipments, we ensure timely and secure delivery.', 'entreprise', '1742336166.jpg', '2025-03-18 21:16:06', '2025-03-18 21:33:17'),
	(15, 'Gardening', 'Comprehensive gardening and landscaping services for homes, offices, or public spaces. Includes design, maintenance, and seasonal care for all types of gardens.', 'entreprise', '1742336221.jpg', '2025-03-18 21:17:01', '2025-03-18 21:34:21'),
	(16, 'Cleaning', 'High-quality cleaning services for homes, offices, and industrial spaces. From daily cleaning to deep sanitation, we keep your spaces spotless and hygienic.', 'entreprise', '1742336450.jpg', '2025-03-18 21:20:50', '2025-03-18 21:34:39'),
	(17, 'Educational', 'Tailored training programs for personal or professional development. Offers workshops, courses, and certifications to enhance skills and knowledge.', 'entreprise', '1742336486.jpg', '2025-03-18 21:21:26', '2025-03-18 21:34:52'),
	(18, 'Mechanic', 'Expert automotive repair and maintenance services for cars, motorcycles, and other vehicles. We handle diagnostics, repairs, and routine check-ups.', 'individu', '1742336604.jpg', '2025-03-18 21:23:24', '2025-03-18 21:35:12'),
	(19, 'Aesthetics', 'Beauty and skincare services for personal care. Includes facials, spa treatments, and tailored beauty regimens to enhance your well-being.', 'individu', '1742336697.jpg', '2025-03-18 21:24:57', '2025-03-18 21:35:55'),
	(20, 'Treater', 'Custom meal preparation and catering services for events or daily needs. Focuses on fresh ingredients, dietary preferences, and creative culinary solutions.', 'individu', '1742337396.jpg', '2025-03-18 21:36:36', '2025-03-18 21:36:36'),
	(21, 'Plumber', 'Reliable plumbing services for homes and businesses. From installations to repairs, we ensure your water systems function smoothly.', 'individu', '1742337434.jpg', '2025-03-18 21:37:14', '2025-03-18 21:37:14'),
	(22, 'Babysitter', 'Trusted childcare services for families. We provide supervision, educational activities, and support for parents needing flexible care solutions.', 'individu', '1742337477.jpg', '2025-03-18 21:37:57', '2025-03-18 21:37:57'),
	(28, 'essai', 'essai', 'individu', '1742602884.jpg', '2025-03-21 23:21:24', '2025-03-21 23:21:24');

-- Listage de la structure de table projet. contact_requests
CREATE TABLE IF NOT EXISTS `contact_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet.contact_requests : ~0 rows (environ)

-- Listage de la structure de table projet. failed_jobs
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

-- Listage des données de la table projet.failed_jobs : ~0 rows (environ)

-- Listage de la structure de table projet. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet.migrations : ~9 rows (environ)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_03_08_110209_create_categories_table', 2),
	(7, '2025_03_19_075359_create_contact_requests_table', 3),
	(8, '2014_10_12_000000_create_users_table', 4),
	(10, '2025_03_08_110439_create_prestataires_table', 5),
	(14, '2025_05_10_223008_create_sessions_table', 7),
	(15, '2025_05_11_153436_create_service_requests_table', 8);

-- Listage de la structure de table projet. password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet.password_reset_tokens : ~0 rows (environ)

-- Listage de la structure de table projet. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet.personal_access_tokens : ~0 rows (environ)

-- Listage de la structure de table projet. prestataires
CREATE TABLE IF NOT EXISTS `prestataires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('super_admin','individu','entreprise') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_categorie` bigint unsigned DEFAULT NULL,
  `isConfirmed` enum('active','desactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'desactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prestataires_email_unique` (`email`),
  KEY `prestataires_id_categorie_foreign` (`id_categorie`),
  CONSTRAINT `prestataires_id_categorie_foreign` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet.prestataires : ~5 rows (environ)
INSERT INTO `prestataires` (`id`, `role`, `name`, `email`, `password`, `id_categorie`, `isConfirmed`, `created_at`, `updated_at`, `image`, `description`) VALUES
	(1, 'super_admin', 'rahma', 'rahma@gmail.com', '$2y$10$9GDriDXo687f83cTYI2gkuPxAUFqKatSvwsnlWEsjsp02mRKahCa2', NULL, 'active', '2025-03-21 20:43:21', '2025-03-21 20:43:21', '', 'super_admin'),
	(2, 'individu', 'hedi allaya', 'hediallya@gmail.com', '$2y$10$L9mHcWML5K7txnTFnvi4POwFPgvOnjxhHkys.rZYjB/44BDHI5KHy', 18, 'active', '2025-03-21 20:45:44', '2025-03-21 20:48:20', '1742593544.jpg', 'n,'),
	(8, 'super_admin', 'rahma', 'allayarahma463@gmail.com', '$2y$10$QDef/72bR5qTlAE7/ePlROagz9ElsqoCRqyvD5dLeIeK.EaHdmcSG', NULL, 'active', '2025-03-22 02:00:37', '2025-03-22 02:00:37', '', 'super_admin 2'),
	(9, 'entreprise', 'mouhamed', 'mouhamed@gmail.com', '$2y$10$UuAzBNW7T3lgkg4SsCNb2u8.VZHgMGKfR97F7TvvUSh0KedBpjrQS', 13, 'active', '2025-03-22 18:20:53', '2025-03-22 18:23:59', '1742671253.jpg', 'sdfghjklm'),
	(10, 'individu', 'rahma allaya', 'allayarahm@gmail.com', '$2y$10$yJ5WWz5JsVTP0TqrSOUUHeHLUH26BnjbyV3gYgPoDEDnnCU5iOFmq', 22, 'active', '2025-03-22 18:50:37', '2025-04-30 07:46:35', '1742673037.jpg', 'sdfghjkl'),
	(11, 'entreprise', 'oussama', 'oussama@gmail.com', '$2y$10$j13Pot54ZBN6vtSALpVZPusYD4fFTv5lfKki8qZHwCLBbeqbK.DrS', 13, 'desactive', '2025-05-11 17:17:00', '2025-05-11 17:17:00', '1746987420.png', 'some descrption');

-- Listage de la structure de table projet. service_requests
CREATE TABLE IF NOT EXISTS `service_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `prestataire_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gouvernorat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_requests_user_id_foreign` (`user_id`),
  KEY `service_requests_prestataire_id_foreign` (`prestataire_id`),
  CONSTRAINT `service_requests_prestataire_id_foreign` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet.service_requests : ~0 rows (environ)
INSERT INTO `service_requests` (`id`, `user_id`, `prestataire_id`, `description`, `ville`, `gouvernorat`, `telephone`, `status`, `created_at`, `updated_at`) VALUES
	(3, 2, 9, 'je essai de ecrire un message de demade de setvice', 'Mahdia', 'mahdia', '20646681', 'pending', '2025-05-12 08:42:41', '2025-05-12 08:42:41');

-- Listage de la structure de table projet. sessions
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

-- Listage des données de la table projet.sessions : ~0 rows (environ)

-- Listage de la structure de table projet. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet.users : ~2 rows (environ)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'ilef', 'ilef@gmail.com', NULL, '$2y$10$T/AWd/lBCN96guh5kklOou7A5nHl64.04Du1pj3/ag0SyUDDMzELq', NULL, NULL, '2025-03-21 20:47:23', '2025-03-21 20:47:23'),
	(3, 'rahma', 'rahmaallaya90@gmail.com', NULL, '$2y$10$JkpHQEWgNsd9jLtfE0x.yel/C.CyupV/b5nIGRqiwvY.6JV6WATbe', NULL, NULL, '2025-03-22 01:54:54', '2025-03-22 01:54:54'),
	(4, 'dora', 'dora@gmail.com', NULL, '$2y$10$z18p45sdoNoSJBSxYC74UuprDGl3HwXZBz9K/sNz16zd0p58iSHkW', NULL, NULL, '2025-03-22 18:22:01', '2025-03-22 18:22:01');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
