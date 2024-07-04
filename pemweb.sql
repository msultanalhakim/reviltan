/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `booking_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_time` datetime NOT NULL,
  `status` enum('Canceled','Reserved','Completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Reserved',
  `customer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vehicle_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `bookings_customer_id_foreign` (`customer_id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `city_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`city_id`),
  KEY `cities_province_id_foreign` (`province_id`),
  CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `coupun_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`coupun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `customer_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `province_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  KEY `customers_city_id_foreign` (`city_id`),
  KEY `customers_province_id_foreign` (`province_id`),
  CONSTRAINT `customers_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`),
  CONSTRAINT `customers_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `details`;
CREATE TABLE `details` (
  `detail_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `details_reference_number_index` (`reference_number`),
  KEY `details_item_id_foreign` (`item_id`),
  CONSTRAINT `details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  CONSTRAINT `details_reference_number_foreign` FOREIGN KEY (`reference_number`) REFERENCES `transactions` (`reference_number`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
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

DROP TABLE IF EXISTS `histories`;
CREATE TABLE `histories` (
  `history_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` enum('Cash','Credit Card','Bank Transfer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('Failed','Pending','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Paid',
  `transaction_status` enum('Failed','Finished') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `booking_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`history_id`),
  KEY `histories_vehicle_id_foreign` (`vehicle_id`),
  KEY `histories_booking_id_foreign` (`booking_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `histories_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  CONSTRAINT `histories_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `histories_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `item_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_code` (`item_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;
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

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
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

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `province_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `province_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
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

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `transaction_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` enum('Cash','Bank Transfer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_id` bigint unsigned DEFAULT NULL,
  `payment_status` enum('Failed','Pending','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `booking_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  UNIQUE KEY `reference_number` (`reference_number`) USING BTREE,
  KEY `transactions_booking_id_foreign` (`booking_id`),
  KEY `customer_id` (`customer_id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `transactions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Administrator','User') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `customer_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_customer_id_foreign` (`customer_id`),
  CONSTRAINT `users_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `vehicle_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chassis_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` int unsigned NOT NULL,
  `plate_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`),
  KEY `vehicles_customer_id_foreign` (`customer_id`),
  CONSTRAINT `vehicles_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `workshops`;
CREATE TABLE `workshops` (
  `workshop_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `workshop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Underway','Postponed','Finished') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Underway',
  `vehicle_id` bigint unsigned DEFAULT NULL,
  `booking_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`workshop_id`),
  KEY `workshops_vehicle_id_foreign` (`vehicle_id`) USING BTREE,
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `workshops_customer_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bookings` (`booking_id`, `booking_time`, `status`, `customer_id`, `created_at`, `updated_at`, `vehicle_id`) VALUES
(33, '2024-06-13 13:05:00', 'Completed', 1, '2024-06-12 09:10:52', '2024-06-12 09:10:52', 1);
INSERT INTO `bookings` (`booking_id`, `booking_time`, `status`, `customer_id`, `created_at`, `updated_at`, `vehicle_id`) VALUES
(34, '2024-06-13 00:00:14', 'Completed', 1, '2024-06-12 09:12:00', '2024-06-12 09:12:00', 1);
INSERT INTO `bookings` (`booking_id`, `booking_time`, `status`, `customer_id`, `created_at`, `updated_at`, `vehicle_id`) VALUES
(35, '2024-06-13 01:10:00', 'Completed', 1, '2024-06-12 09:12:49', '2024-06-12 09:12:49', 1);
INSERT INTO `bookings` (`booking_id`, `booking_time`, `status`, `customer_id`, `created_at`, `updated_at`, `vehicle_id`) VALUES
(36, '2024-06-12 19:30:00', 'Completed', 1, '2024-06-12 09:14:06', '2024-06-12 09:14:06', 2),
(37, '2024-06-12 20:31:00', 'Completed', 1, '2024-06-12 09:16:05', '2024-06-12 09:16:05', 1),
(38, '2024-06-12 21:31:00', 'Completed', 1, '2024-06-12 09:20:58', '2024-06-25 15:02:32', 1),
(39, '2024-06-25 16:30:00', 'Completed', 2, '2024-06-25 14:58:30', '2024-06-25 14:58:30', NULL),
(40, '2024-06-26 18:30:00', 'Completed', 1, '2024-06-26 01:17:27', '2024-06-26 01:47:26', 1),
(41, '2024-06-26 18:30:00', 'Canceled', 1, '2024-06-26 02:02:53', '2024-06-26 02:02:53', 1),
(42, '2024-06-26 18:30:00', 'Completed', 1, '2024-06-26 16:05:04', '2024-06-26 16:57:10', 1),
(43, '2024-06-30 18:30:00', 'Completed', 17, '2024-06-30 15:59:01', '2024-06-30 16:04:50', 3),
(44, '2024-06-30 19:00:00', 'Completed', 18, '2024-06-30 16:42:43', '2024-06-30 16:44:30', 5);

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:3;', 1719740291);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1719740290;', 1719740290);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('9e6a55b6b4563e652a23be9d623ca5055c356940', 'i:1;', 1718122405);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('9e6a55b6b4563e652a23be9d623ca5055c356940:timer', 'i:1718122405;', 1718122405),
('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1719301566),
('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1719301566;', 1719301566);



INSERT INTO `cities` (`city_id`, `city_name`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'Bogor', 1, '2024-06-07 14:51:04', '2024-06-07 14:51:04');
INSERT INTO `cities` (`city_id`, `city_name`, `province_id`, `created_at`, `updated_at`) VALUES
(2, 'Bekasi', 1, '2024-06-07 16:04:10', '2024-06-07 16:04:10');
INSERT INTO `cities` (`city_id`, `city_name`, `province_id`, `created_at`, `updated_at`) VALUES
(3, 'Semarang', 3, '2024-06-07 16:04:29', '2024-06-07 16:04:29');
INSERT INTO `cities` (`city_id`, `city_name`, `province_id`, `created_at`, `updated_at`) VALUES
(4, 'Surabaya', 2, '2024-06-07 16:05:16', '2024-06-07 16:05:16'),
(5, 'Malang', 2, '2024-06-07 16:05:35', '2024-06-07 16:05:35'),
(6, 'West Jakarta', 4, '2024-06-07 16:06:01', '2024-06-07 16:06:01'),
(7, 'Medan', 5, '2024-06-07 16:06:24', '2024-06-07 16:06:24'),
(8, 'Depok', 1, NULL, NULL);

INSERT INTO `coupons` (`coupun_id`, `coupon_code`, `price`, `created_at`, `updated_at`) VALUES
(1, 'NEW2024', 100000, NULL, NULL);
INSERT INTO `coupons` (`coupun_id`, `coupon_code`, `price`, `created_at`, `updated_at`) VALUES
(2, 'KING', 1600000, NULL, NULL);


INSERT INTO `customers` (`customer_id`, `customer_name`, `address`, `phone`, `email`, `photo`, `city_id`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'King of Reviltan', 'You\'re so gorgeous!', '628211315212', 'administrator@gmail.com', 'kanhaiya-sharma-_wew3JYSVpA-unsplash.jpg 2024-06-10 111106064848', 5, 2, '2024-06-07 13:28:04', '2024-06-10 11:00:48');
INSERT INTO `customers` (`customer_id`, `customer_name`, `address`, `phone`, `email`, `photo`, `city_id`, `province_id`, `created_at`, `updated_at`) VALUES
(2, 'Muhammad Sultan Alhakim', 'Perumahan Bumi Mutiara', '082113155212', 'msultanalhakim@gmail.com', 'bench-accounting-nvzvOPQW0gc-unsplash.jpg 2024-06-25 144952', 3, 3, '2024-06-07 13:28:41', '2024-06-25 14:49:52');
INSERT INTO `customers` (`customer_id`, `customer_name`, `address`, `phone`, `email`, `photo`, `city_id`, `province_id`, `created_at`, `updated_at`) VALUES
(3, NULL, NULL, NULL, 'aguswijayanto@gmail.com', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `customers` (`customer_id`, `customer_name`, `address`, `phone`, `email`, `photo`, `city_id`, `province_id`, `created_at`, `updated_at`) VALUES
(4, NULL, NULL, NULL, 'hanasui@gmail.com', NULL, NULL, NULL, '2024-06-10 07:48:11', '2024-06-10 07:48:11'),
(5, NULL, NULL, NULL, 'toyotires@gmail.com', NULL, NULL, NULL, '2024-06-10 07:50:20', '2024-06-10 07:50:20'),
(6, NULL, NULL, NULL, 'fakfak@gmail.com', NULL, NULL, NULL, '2024-06-10 08:03:23', '2024-06-10 08:03:23'),
(7, NULL, NULL, NULL, 'wakwak@gmail.com', NULL, NULL, NULL, '2024-06-10 08:06:48', '2024-06-10 08:06:48'),
(8, NULL, NULL, NULL, 'tester@gmail.com', NULL, NULL, NULL, '2024-06-10 08:16:54', '2024-06-10 08:16:54'),
(9, NULL, NULL, NULL, 'rian@gmail.com', NULL, NULL, NULL, '2024-06-10 08:44:39', '2024-06-10 08:44:39'),
(10, NULL, NULL, NULL, 'ipul@gmail.com', NULL, NULL, NULL, '2024-06-10 08:46:17', '2024-06-10 08:46:17'),
(11, NULL, NULL, NULL, 'dasd@gmail.com', NULL, NULL, NULL, '2024-06-10 08:47:26', '2024-06-10 08:47:26'),
(12, NULL, NULL, NULL, 'test1234@gmail.com', NULL, NULL, NULL, '2024-06-10 08:48:51', '2024-06-10 08:48:51'),
(13, NULL, NULL, NULL, 'test12345@gmail.com', NULL, NULL, NULL, '2024-06-10 08:49:37', '2024-06-10 08:49:37'),
(14, NULL, NULL, NULL, 'test4321@gmail.com', NULL, NULL, NULL, '2024-06-10 08:52:05', '2024-06-10 08:52:05'),
(15, 'Margaret Sutedjo', 'You\'re so beautiful!', '6282113155212', 'testing12@gmail.com', 'kanhaiya-sharma-_wew3JYSVpA-unsplash.jpg 2024-06-10 133537', 3, 3, '2024-06-10 13:20:01', '2024-06-10 13:35:37'),
(16, NULL, NULL, NULL, 'diva@gmail.com', NULL, NULL, NULL, '2024-06-10 13:46:24', '2024-06-10 13:46:24'),
(17, 'Warga Dinamorales', 'Warga Perumahan Dinamorales', '08113152212', 'wadimor@gmail.com', 'Reviltan_LogoBlack.png 2024-06-30 154713', 6, 4, '2024-06-11 23:12:04', '2024-06-30 15:47:13'),
(18, 'Muhammad Lepi', 'Cirebon', '089392101921', 'leppi@gmail.com', 'Reviltan_LogoBlack.png 2024-06-30 163952', 3, 3, '2024-06-30 16:36:34', '2024-06-30 16:39:52');

INSERT INTO `details` (`detail_id`, `reference_number`, `quantity`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 'th2he2cXRLDgkU13', 4, 1, NULL, '2024-06-27 03:10:51');
INSERT INTO `details` (`detail_id`, `reference_number`, `quantity`, `item_id`, `created_at`, `updated_at`) VALUES
(2, 'th2he2cXRLDgkU13', 1, 2, '2024-06-27 01:55:44', '2024-06-27 01:55:44');
INSERT INTO `details` (`detail_id`, `reference_number`, `quantity`, `item_id`, `created_at`, `updated_at`) VALUES
(3, 'th2he2cXRLDgkU13', 2, 3, '2024-06-27 01:57:13', '2024-06-27 01:57:13');
INSERT INTO `details` (`detail_id`, `reference_number`, `quantity`, `item_id`, `created_at`, `updated_at`) VALUES
(4, 'th2he2cXRLDgkU13', 3, 5, '2024-06-27 02:00:26', '2024-06-27 02:28:03'),
(5, 'bIANhyOSuSKyOkO', 2, 2, '2024-06-30 16:31:46', '2024-06-30 16:31:46'),
(6, 'bIANhyOSuSKyOkO', 2, 1, '2024-06-30 16:32:09', '2024-06-30 16:32:09'),
(7, 'noTbigpbAsbvCUg', 1, 2, '2024-06-30 16:45:33', '2024-06-30 16:45:33'),
(8, 'noTbigpbAsbvCUg', 1, 1, '2024-06-30 16:45:41', '2024-06-30 16:45:41'),
(9, 'noTbigpbAsbvCUg', 1, 5, '2024-06-30 16:45:50', '2024-06-30 16:45:50'),
(10, 'noTbigpbAsbvCUg', 2, 4, '2024-06-30 16:45:59', '2024-06-30 16:45:59');



INSERT INTO `histories` (`history_id`, `reference_number`, `total`, `coupon_code`, `payment_method`, `payment_status`, `transaction_status`, `vehicle_id`, `customer_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(1, 'th2he2cXRLDgkU13', '2260000', 'KING', 'Bank Transfer', 'Paid', 'Finished', 1, 1, 42, '2024-06-30 14:34:22', '2024-06-30 14:34:22');
INSERT INTO `histories` (`history_id`, `reference_number`, `total`, `coupon_code`, `payment_method`, `payment_status`, `transaction_status`, `vehicle_id`, `customer_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(2, 'noTbigpbAsbvCUg', '2700000', 'king', 'Bank Transfer', 'Paid', 'Finished', 5, 18, 44, '2024-06-30 16:49:19', '2024-06-30 16:49:19');


INSERT INTO `items` (`item_id`, `item_code`, `item_name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'SRV', 'Service', '120000', '2024-06-26 01:47:26', '2024-06-26 01:47:26');
INSERT INTO `items` (`item_id`, `item_code`, `item_name`, `price`, `created_at`, `updated_at`) VALUES
(2, 'SRV-OIL', 'Oil Change', '80000', '2024-06-26 01:47:26', '2024-06-26 01:47:26');
INSERT INTO `items` (`item_id`, `item_code`, `item_name`, `price`, `created_at`, `updated_at`) VALUES
(3, 'SRV-TRANS', 'Service Transmission', '900000', '2024-06-26 01:47:26', '2024-06-26 01:47:26');
INSERT INTO `items` (`item_id`, `item_code`, `item_name`, `price`, `created_at`, `updated_at`) VALUES
(4, 'SRV-ENGINE', 'Service Engine', '1800000', '2024-06-26 01:47:26', '2024-06-26 01:47:26'),
(5, 'SRV-SUSP', 'Service Suspension', '500000', '2024-06-26 01:47:26', '2024-06-26 01:47:26'),
(6, 'BR-UP', 'Bore Up', '1350000', '2024-06-26 01:47:26', '2024-06-26 01:47:26'),
(7, 'SRV-TIRES', 'Service Tires', '350000', '2024-06-26 01:47:26', '2024-06-26 01:47:26');





INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_06_05_120451_create_provinces_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2024_06_05_120502_create_cities_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2024_06_05_121152_create_customers_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2024_06_05_121182_create_users_table', 1),
(5, '2024_06_05_121192_create_cache_table', 1),
(6, '2024_06_05_121212_create_jobs_table', 1),
(7, '2024_06_05_121627_create_bookings_table', 1),
(8, '2024_06_05_122347_create_workshops_table', 1),
(9, '2024_06_05_122358_create_vehicles_table', 1),
(10, '2024_06_05_122420_create_transactions_table', 1),
(11, '2024_06_05_122448_create_histories_table', 1),
(18, '2024_06_26_184408_create_items_table', 2),
(19, '2024_06_26_184419_create_details_table', 2),
(20, '2024_06_29_173703_create_coupons_table', 3);



INSERT INTO `provinces` (`province_id`, `province_name`, `created_at`, `updated_at`) VALUES
(1, 'West Java', '2024-06-07 14:50:45', '2024-06-07 14:50:45');
INSERT INTO `provinces` (`province_id`, `province_name`, `created_at`, `updated_at`) VALUES
(2, 'East Java', '2024-06-07 16:02:23', '2024-06-07 16:02:23');
INSERT INTO `provinces` (`province_id`, `province_name`, `created_at`, `updated_at`) VALUES
(3, 'Central Java', '2024-06-07 16:02:40', '2024-06-07 16:02:40');
INSERT INTO `provinces` (`province_id`, `province_name`, `created_at`, `updated_at`) VALUES
(4, 'Jakarta', '2024-06-07 16:03:03', '2024-06-07 16:03:03'),
(5, 'North Sumatera', '2024-06-07 16:03:21', '2024-06-07 16:03:21');

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Fn49CqmJ7GLhGIyPjCjdYc8N10BWSCyYZgOWFl9W', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibm5Cb2tqaDlLOFpSRW9vRHR1WEJDUVZ6WXJRclhPWUcwZ0dlRFZ0YiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY2l0eSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1719741048);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Ui0gpN5wSv0TY9sylSZVU6zPxcRb9qqwWSLDlEK2', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZFAzcnRxM2hYclJNaUpmQ0NBakNSb0E2TXNsY3FsckczY0pSbkI1bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zZXJ2aWNlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7fQ==', 1719741028);


INSERT INTO `transactions` (`transaction_id`, `reference_number`, `total`, `payment_method`, `coupon_code`, `vehicle_id`, `payment_status`, `transaction_status`, `file`, `customer_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(1, 'QPjAcYyTTDs', NULL, NULL, NULL, 1, 'Failed', '', NULL, 1, 40, '2024-06-26 01:47:26', '2024-06-26 01:47:26');
INSERT INTO `transactions` (`transaction_id`, `reference_number`, `total`, `payment_method`, `coupon_code`, `vehicle_id`, `payment_status`, `transaction_status`, `file`, `customer_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(2, 'th2he2cXRLDgkU13', '2260000', 'Bank Transfer', 'KING', 1, 'Paid', 'Finished', 'Receipt th2he2cXRLDgkU13 2024-06-30 051317.png', 1, 42, '2024-06-26 16:57:10', '2024-06-30 14:34:22');
INSERT INTO `transactions` (`transaction_id`, `reference_number`, `total`, `payment_method`, `coupon_code`, `vehicle_id`, `payment_status`, `transaction_status`, `file`, `customer_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(3, 'bIANhyOSuSKyOkO', '400000', NULL, 'KING', 3, 'Pending', NULL, NULL, 17, 43, '2024-06-30 16:04:50', '2024-06-30 16:33:38');
INSERT INTO `transactions` (`transaction_id`, `reference_number`, `total`, `payment_method`, `coupon_code`, `vehicle_id`, `payment_status`, `transaction_status`, `file`, `customer_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(4, 'noTbigpbAsbvCUg', '2700000', 'Bank Transfer', 'king', 5, 'Paid', 'Finished', 'Receipt-noTbigpbAsbvCUg 2024-06-30 044742.png', 18, 44, '2024-06-30 16:44:30', '2024-06-30 16:49:19');

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `status`, `customer_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator@gmail.com', '2021-10-10 00:00:00', '$2y$12$XHxp4y.9P8t7dTxvtw9qEewK1iYDPxdOo2ijqDDEZt2oQTuXLmUue', 'Administrator', 'Active', 1, NULL, '2024-06-07 13:28:04', '2024-06-07 13:28:04');
INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `status`, `customer_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'msultanalhakim', 'msultanalhakim@gmail.com', '2024-06-25 14:45:30', '$2y$12$qsij0TOiPAW4OenAXJYPSer7Vf/olbw6XNd7ks.m2iFtLeCTU06Fu', 'User', 'Active', 2, NULL, '2024-06-07 13:28:41', '2024-06-25 14:45:30');
INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `status`, `customer_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'aguswijayanto', 'aguswijayantos@gmail.com', NULL, '$2y$12$l5qzCTI.IEkbLAaf3fT/euosyWX96dI1nJEsiycCN0XCJQ0CLM00.', 'User', 'Active', 3, NULL, '2024-06-07 13:29:52', '2024-06-07 13:29:52');
INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `status`, `customer_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'hanasui', 'hanasui@gmail.com', NULL, '$2y$12$CrJxB7yEcF2aPl36660gJ.p69P8uML2k0Q5hBC7zSeK0JpY2yaZFS', 'User', 'Active', NULL, NULL, '2024-06-10 07:48:11', '2024-06-10 07:48:11'),
(6, 'toyotires', 'toyotires@gmail.com', NULL, '$2y$12$dCCYwNQ.vjg3qgUtMkkGx.m0mSm3JHLx.gT8lSh.komUWn5xl29hW', 'User', 'Active', NULL, NULL, '2024-06-10 07:50:20', '2024-06-10 07:50:20'),
(7, 'fakfak', 'fakfak@gmail.com', NULL, '$2y$12$NwZ56uDdAjZlUT.o/Xz32e8zRHcB131RvOMcRw4ukvEuzZ5.AlTGu', 'User', 'Active', NULL, NULL, '2024-06-10 08:03:23', '2024-06-10 08:03:23'),
(8, 'wakwak', 'wakwak@gmail.com', NULL, '$2y$12$PGVXHcVuhBVZ7xIVUXh85e8JUmGCEqQqbqcCkM6m5NLNQKzKpX2VW', 'User', 'Active', NULL, NULL, '2024-06-10 08:06:48', '2024-06-10 08:06:48'),
(9, 'tester', 'tester@gmail.com', NULL, '$2y$12$NkNPXviTO0Cjil/Nv5TsEuXz4YAkRSdVQOadmlyTcam1kaHN7iq4S', 'User', 'Active', NULL, NULL, '2024-06-10 08:16:54', '2024-06-10 08:16:54'),
(10, 'rian', 'rian@gmail.com', NULL, '$2y$12$Yh84pSm9CfH6WafCJ3OW4OCxsHrYwkqAfAjJweeTXITH4ZBQO2cM.', 'User', 'Active', NULL, NULL, '2024-06-10 08:44:39', '2024-06-10 08:44:39'),
(11, 'ipul', 'ipul@gmail.com', NULL, '$2y$12$lIctUcCshjYnVJ4gGTtdYejBybsqxUwQ/gdrhf4pV8T7ZwqkTfOda', 'User', 'Active', NULL, NULL, '2024-06-10 08:46:17', '2024-06-10 08:46:17'),
(12, 'dasd', 'dasd@gmail.com', NULL, '$2y$12$ULCRr0bq3Hae/SISpKhE5uA6kgjtY1FSsfDs5yOfxMBGBrCXC136C', 'User', 'Active', NULL, NULL, '2024-06-10 08:47:26', '2024-06-10 08:47:26'),
(13, 'test1234', 'test1234@gmail.com', NULL, '$2y$12$ePKuUXmbBEXTOFOEEE.0beEqamYtvFuE9/y1q8on4hhzoou9xrTCG', 'User', 'Active', NULL, NULL, '2024-06-10 08:48:51', '2024-06-10 08:48:51'),
(14, 'test12345', 'test12345@gmail.com', NULL, '$2y$12$waYff9YwW7Qbp0njwf1vBuVuS0a26OYOp27Vi4hcWwOL5wWXzCuI2', 'User', 'Active', 13, NULL, '2024-06-10 08:49:37', '2024-06-10 08:49:37'),
(15, 'testing13', 'test4321@gmail.com', '2024-10-10 00:00:00', '$2y$12$fwDZXo4ePD6HvCe7N5LKcupq7Ikv56Js0lslHAATuRgiHdVDSUrxO', 'User', 'Active', 14, NULL, '2024-06-10 08:52:05', '2024-06-10 13:30:59'),
(16, 'margaret', 'testing12@gmail.com', '2024-06-10 13:20:32', '$2y$12$MIxfoXA2c/prqbk9HuYXjuNwl2UB8wqH2qD.qNWdIm2ekkcTM7N76', 'User', 'Active', 15, NULL, '2024-06-10 13:20:01', '2024-06-10 13:35:37'),
(17, 'diva', 'diva@gmail.com', '2024-06-10 13:46:42', '$2y$12$0iofj3qAe1Q5pL6WFnOM0uHrFxbSrWt6/xHVWAJDEfRTABIPK6kd2', 'User', 'Active', 16, NULL, '2024-06-10 13:46:24', '2024-06-10 13:46:42'),
(18, 'wadimor', 'wadimor@gmail.com', '2024-06-11 23:12:25', '$2y$12$U8m7wSl3LN4KM6X5exY0susvWZ/6vxqN/OiNTg9yXSAUasKm5ZVvG', 'User', 'Active', 17, NULL, '2024-06-11 23:12:04', '2024-06-11 23:12:25'),
(19, 'leppi', 'leppi@gmail.com', '2024-06-11 23:12:25', '$2y$12$eFVdxBNUxOOvBGrIPXDFAuKtFO/UImMWxgQ/toMNE5Iai5/rxzw5K', 'User', 'Active', 18, NULL, '2024-06-30 16:36:34', '2024-06-30 16:36:34');

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_name`, `vehicle_color`, `chassis_number`, `engine_number`, `mileage`, `plate_number`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'Mercedes Benz AMG GT63', 'Black', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 2000, 'R 1 CH', 1, '2024-06-09 20:22:50', '2024-06-09 20:22:50');
INSERT INTO `vehicles` (`vehicle_id`, `vehicle_name`, `vehicle_color`, `chassis_number`, `engine_number`, `mileage`, `plate_number`, `customer_id`, `created_at`, `updated_at`) VALUES
(2, 'BMW M5CS', 'Black', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 4000, 'F 6568 FHI', 2, NULL, NULL);
INSERT INTO `vehicles` (`vehicle_id`, `vehicle_name`, `vehicle_color`, `chassis_number`, `engine_number`, `mileage`, `plate_number`, `customer_id`, `created_at`, `updated_at`) VALUES
(3, 'Mitsubishi Pajero 2019', 'Black', 'EF0CKKZLAMPARD', 'CFG014L42019XMY', 40000, 'K 1 NG', 17, '2024-06-30 15:37:52', '2024-06-30 15:37:52');
INSERT INTO `vehicles` (`vehicle_id`, `vehicle_name`, `vehicle_color`, `chassis_number`, `engine_number`, `mileage`, `plate_number`, `customer_id`, `created_at`, `updated_at`) VALUES
(4, 'Mitsubishi Pajero 2019', 'Black', 'EF0CKKZLAMPARD', 'CFG014L42019XMY', 40000, 'K 1 NG', 17, '2024-06-30 15:38:13', '2024-06-30 15:38:13'),
(5, 'Honda Civic Turbo', 'Black', 'EF09201KSMCLDO0', 'EKRLKWMXMDLAK0', 40000, 'L 3 PI', 18, '2024-06-30 16:41:05', '2024-06-30 16:41:05');

INSERT INTO `workshops` (`workshop_id`, `workshop_name`, `status`, `vehicle_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(2, 'Workshop 1', 'Postponed', NULL, NULL, '2024-06-12 19:13:47', '2024-06-30 16:44:30');
INSERT INTO `workshops` (`workshop_id`, `workshop_name`, `status`, `vehicle_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(3, 'Workshop 2', 'Underway', 2, NULL, '2024-06-12 19:14:40', '2024-06-25 15:01:15');
INSERT INTO `workshops` (`workshop_id`, `workshop_name`, `status`, `vehicle_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(4, 'Workshop 3', 'Finished', 1, NULL, NULL, NULL);
INSERT INTO `workshops` (`workshop_id`, `workshop_name`, `status`, `vehicle_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(5, 'Workshop 4', 'Underway', 1, NULL, NULL, NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;