-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 06 Jul 2024 pada 12.04
-- Versi server: 10.5.24-MariaDB-cll-lve-log
-- Versi PHP: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epij4769_pemweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `booking_time` datetime NOT NULL,
  `status` enum('Canceled','Reserved','Completed') NOT NULL DEFAULT 'Reserved',
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_time`, `status`, `customer_id`, `created_at`, `updated_at`, `vehicle_id`) VALUES
(34, '2024-06-13 00:00:14', 'Completed', 1, '2024-06-12 02:12:00', '2024-06-12 02:12:00', 1),
(35, '2024-06-13 01:10:00', 'Completed', 1, '2024-06-12 02:12:49', '2024-06-12 02:12:49', 1),
(36, '2024-06-12 19:30:00', 'Completed', 1, '2024-06-12 02:14:06', '2024-06-12 02:14:06', 2),
(37, '2024-06-12 20:31:00', 'Completed', 1, '2024-06-12 02:16:05', '2024-06-12 02:16:05', 1),
(39, '2024-06-25 16:30:00', 'Completed', 2, '2024-06-25 07:58:30', '2024-06-25 07:58:30', NULL),
(40, '2024-06-26 18:30:00', 'Completed', 1, '2024-06-25 18:17:27', '2024-06-25 18:47:26', 1),
(42, '2024-06-26 18:30:00', 'Completed', 1, '2024-06-26 09:05:04', '2024-06-26 09:57:10', 1),
(43, '2024-06-30 18:30:00', 'Completed', 17, '2024-06-30 08:59:01', '2024-06-30 09:04:50', 3),
(44, '2024-06-30 19:00:00', 'Canceled', 18, '2024-06-30 09:42:43', '2024-07-04 07:46:34', 5),
(45, '2024-07-05 07:30:00', 'Canceled', 1, '2024-07-03 22:19:53', '2024-07-04 07:47:03', 34),
(46, '2024-07-05 09:30:00', 'Completed', 2, NULL, '2024-07-04 15:52:12', 1),
(48, '2024-07-05 18:30:00', 'Completed', 21, '2024-07-04 15:48:06', '2024-07-04 15:48:06', 47),
(49, '2024-07-12 18:30:00', 'Completed', 2, '2024-07-05 11:23:00', '2024-07-05 11:36:32', 1),
(50, '2024-07-12 04:00:00', 'Completed', 35, '2024-07-05 16:42:24', '2024-07-05 16:47:03', 48),
(51, '2024-07-11 15:00:00', 'Completed', 35, '2024-07-05 17:17:16', '2024-07-05 17:44:27', 49),
(52, '2024-07-06 18:30:00', 'Completed', 25, '2024-07-05 18:00:36', '2024-07-05 18:08:05', 50),
(53, '2024-07-06 18:00:00', 'Completed', 25, '2024-07-05 18:23:18', '2024-07-06 04:30:16', 50),
(55, '2024-07-07 01:00:00', 'Completed', 38, '2024-07-05 19:14:53', '2024-07-05 19:21:50', 52),
(56, '2024-07-06 03:55:00', 'Reserved', 38, '2024-07-05 19:30:24', '2024-07-05 19:30:24', 52),
(57, '2024-07-06 18:00:00', 'Canceled', 25, '2024-07-06 04:31:55', '2024-07-06 04:34:04', 53);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('|103.121.108.124', 'i:3;', 1720187776),
('|103.121.108.124:timer', 'i:1720187776;', 1720187776),
('0286dd552c9bea9a69ecb3759e7b94777635514b', 'i:1;', 1720197476),
('0286dd552c9bea9a69ecb3759e7b94777635514b:timer', 'i:1720197476;', 1720197476),
('0a57cb53ba59c46fc4b692527a38a87c78d84028', 'i:2;', 1720189322),
('0a57cb53ba59c46fc4b692527a38a87c78d84028:timer', 'i:1720189322;', 1720189322),
('12c6fc06c99a462375eeb3f43dfd832b08ca9e17', 'i:1;', 1720117015),
('12c6fc06c99a462375eeb3f43dfd832b08ca9e17:timer', 'i:1720117015;', 1720117015),
('22d200f8670dbdb3e253a90eee5098477c95c23d', 'i:1;', 1720194186),
('22d200f8670dbdb3e253a90eee5098477c95c23d:timer', 'i:1720194186;', 1720194186),
('2e01e17467891f7c933dbaa00e1459d23db3fe4f', 'i:2;', 1720206048),
('2e01e17467891f7c933dbaa00e1459d23db3fe4f:timer', 'i:1720206048;', 1720206048),
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:3;', 1719740291),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1719740290;', 1719740290),
('4d134bc072212ace2df385dae143139da74ec0ef', 'i:2;', 1720164905),
('4d134bc072212ace2df385dae143139da74ec0ef:timer', 'i:1720164905;', 1720164905),
('5b384ce32d8cdef02bc3a139d4cac0a22bb029e8', 'i:2;', 1720195816),
('5b384ce32d8cdef02bc3a139d4cac0a22bb029e8:timer', 'i:1720195816;', 1720195816),
('64e095fe763fc62418378753f9402623bea9e227', 'i:1;', 1720206130),
('64e095fe763fc62418378753f9402623bea9e227:timer', 'i:1720206130;', 1720206130),
('761f22b2c1593d0bb87e0b606f990ba4974706de', 'i:1;', 1720196278),
('761f22b2c1593d0bb87e0b606f990ba4974706de:timer', 'i:1720196278;', 1720196278),
('827bfc458708f0b442009c9c9836f7e4b65557fb', 'i:1;', 1720205890),
('827bfc458708f0b442009c9c9836f7e4b65557fb:timer', 'i:1720205890;', 1720205890),
('887309d048beef83ad3eabf2a79a64a389ab1c9f', 'i:1;', 1720189149),
('887309d048beef83ad3eabf2a79a64a389ab1c9f:timer', 'i:1720189149;', 1720189149),
('91032ad7bbcb6cf72875e8e8207dcfba80173f7c', 'i:3;', 1720092975),
('91032ad7bbcb6cf72875e8e8207dcfba80173f7c:timer', 'i:1720092975;', 1720092975),
('92cfceb39d57d914ed8b14d0e37643de0797ae56', 'i:1;', 1720197251),
('92cfceb39d57d914ed8b14d0e37643de0797ae56:timer', 'i:1720197251;', 1720197251),
('972a67c48192728a34979d9a35164c1295401b71', 'i:1;', 1720195672),
('972a67c48192728a34979d9a35164c1295401b71:timer', 'i:1720195672;', 1720195672),
('98fbc42faedc02492397cb5962ea3a3ffc0a9243', 'i:3;', 1720197443),
('98fbc42faedc02492397cb5962ea3a3ffc0a9243:timer', 'i:1720197443;', 1720197443),
('9e6a55b6b4563e652a23be9d623ca5055c356940', 'i:1;', 1718122405),
('9e6a55b6b4563e652a23be9d623ca5055c356940:timer', 'i:1718122405;', 1718122405),
('af3e133428b9e25c55bc59fe534248e6a0c0f17b', 'i:1;', 1720196187),
('af3e133428b9e25c55bc59fe534248e6a0c0f17b:timer', 'i:1720196187;', 1720196187),
('b7eb6c689c037217079766fdb77c3bac3e51cb4c', 'i:1;', 1720206457),
('b7eb6c689c037217079766fdb77c3bac3e51cb4c:timer', 'i:1720206457;', 1720206457),
('cb4e5208b4cd87268b208e49452ed6e89a68e0b8', 'i:1;', 1720195327),
('cb4e5208b4cd87268b208e49452ed6e89a68e0b8:timer', 'i:1720195327;', 1720195327),
('cb7a1d775e800fd1ee4049f7dca9e041eb9ba083', 'i:1;', 1720195789),
('cb7a1d775e800fd1ee4049f7dca9e041eb9ba083:timer', 'i:1720195789;', 1720195789),
('d435a6cdd786300dff204ee7c2ef942d3e9034e2', 'i:1;', 1720164734),
('d435a6cdd786300dff204ee7c2ef942d3e9034e2:timer', 'i:1720164734;', 1720164734),
('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1719301566),
('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1719301566;', 1719301566),
('e1822db470e60d090affd0956d743cb0e7cdf113', 'i:1;', 1720206397),
('e1822db470e60d090affd0956d743cb0e7cdf113:timer', 'i:1720206397;', 1720206397),
('f6e1126cedebf23e1463aee73f9df08783640400', 'i:1;', 1720187971),
('f6e1126cedebf23e1463aee73f9df08783640400:timer', 'i:1720187971;', 1720187971),
('fb644351560d8296fe6da332236b1f8d61b2828a', 'i:2;', 1720198639),
('fb644351560d8296fe6da332236b1f8d61b2828a:timer', 'i:1720198639;', 1720198639),
('fe2ef495a1152561572949784c16bf23abb28057', 'i:1;', 1720204393),
('fe2ef495a1152561572949784c16bf23abb28057:timer', 'i:1720204393;', 1720204393);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cities`
--

CREATE TABLE `cities` (
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'Bogor', 1, '2024-06-07 07:51:04', '2024-06-07 07:51:04'),
(2, 'Bekasi', 1, '2024-06-07 09:04:10', '2024-06-07 09:04:10'),
(3, 'Semarang', 3, '2024-06-07 09:04:29', '2024-06-07 09:04:29'),
(4, 'Surabaya', 2, '2024-06-07 09:05:16', '2024-06-07 09:05:16'),
(5, 'Malang', 2, '2024-06-07 09:05:35', '2024-06-07 09:05:35'),
(6, 'West Jakarta', 4, '2024-06-07 09:06:01', '2024-06-07 09:06:01'),
(7, 'Medan', 5, '2024-06-07 09:06:24', '2024-06-07 09:06:24'),
(9, 'Denpasar', 6, '2024-07-05 13:56:18', '2024-07-05 13:56:18'),
(10, 'Contoh', 8, '2024-07-05 19:30:55', '2024-07-05 19:30:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_code`, `price`, `created_at`, `updated_at`) VALUES
(1, 'NEW2024', 100000, NULL, NULL),
(2, 'KING', 90000, NULL, '2024-07-03 23:54:36'),
(3, 'JUMATBERKAH', 100000, '2024-07-05 17:20:34', '2024-07-05 17:20:34'),
(4, 'SULTANGANTENG', 1000000, '2024-07-05 18:07:48', '2024-07-05 18:07:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `address`, `phone`, `email`, `photo`, `city_id`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'King Of Reviltan', 'You\'re so gorgeous!', '628211315212', 'administrator@gmail.com', 'bench-accounting-nvzvOPQW0gc-unsplash.jpg 2024-07-06 003621', 5, 2, '2024-06-07 06:28:04', '2024-07-05 17:36:21'),
(2, 'Muhammad Sultan Alhakim', 'Perumahan Bumi Mutiara', '082113155212', 'msultanalhakim@gmail.com', 'bench-accounting-nvzvOPQW0gc-unsplash.jpg 2024-06-25 144952', 3, 3, '2024-06-07 06:28:41', '2024-06-25 07:49:52'),
(3, 'Bagus Wijoyoseno', NULL, '082113155212', 'aguswijayantos@gmail.com', 'r-paint-brush-letter-logo-design-with-artistic-brush-stroke-in-black-and-purple-colors-vector.jpg 2024-07-03 233453', 1, 1, NULL, '2024-07-03 16:40:32'),
(5, NULL, NULL, NULL, 'toyotires@gmail.com', NULL, NULL, NULL, '2024-06-10 00:50:20', '2024-06-10 00:50:20'),
(6, NULL, NULL, NULL, 'fakfak@gmail.com', NULL, NULL, NULL, '2024-06-10 01:03:23', '2024-06-10 01:03:23'),
(7, NULL, NULL, NULL, 'wakwak@gmail.com', NULL, NULL, NULL, '2024-06-10 01:06:48', '2024-06-10 01:06:48'),
(8, NULL, NULL, NULL, 'tester@gmail.com', NULL, NULL, NULL, '2024-06-10 01:16:54', '2024-06-10 01:16:54'),
(9, NULL, NULL, NULL, 'rian@gmail.com', NULL, NULL, NULL, '2024-06-10 01:44:39', '2024-06-10 01:44:39'),
(10, NULL, NULL, NULL, 'ipul@gmail.com', NULL, NULL, NULL, '2024-06-10 01:46:17', '2024-06-10 01:46:17'),
(11, NULL, NULL, NULL, 'dasd@gmail.com', NULL, NULL, NULL, '2024-06-10 01:47:26', '2024-06-10 01:47:26'),
(12, NULL, NULL, NULL, 'test1234@gmail.com', NULL, NULL, NULL, '2024-06-10 01:48:51', '2024-06-10 01:48:51'),
(13, NULL, NULL, NULL, 'test12345@gmail.com', NULL, NULL, NULL, '2024-06-10 01:49:37', '2024-06-10 01:49:37'),
(14, NULL, NULL, NULL, 'test4321@gmail.com', NULL, NULL, NULL, '2024-06-10 01:52:05', '2024-06-10 01:52:05'),
(15, 'Margaret Sutedjo', 'You\'re so beautiful!', '6282113155212', 'testing12@gmail.com', 'kanhaiya-sharma-_wew3JYSVpA-unsplash.jpg 2024-06-10 133537', 3, 3, '2024-06-10 06:20:01', '2024-06-10 06:35:37'),
(16, NULL, NULL, NULL, 'diva@gmail.com', NULL, NULL, NULL, '2024-06-10 06:46:24', '2024-06-10 06:46:24'),
(17, 'Warga Dinamorales', 'Warga Perumahan Dinamorales', '08113152212', 'wadimor@gmail.com', 'Reviltan_LogoBlack.png 2024-06-30 154713', 6, 4, '2024-06-11 16:12:04', '2024-06-30 08:47:13'),
(18, 'Muhammad Lepi', 'Cirebon', '089392101921', 'leppi@gmail.com', 'Reviltan_LogoBlack.png 2024-06-30 163952', 3, 3, '2024-06-30 09:36:34', '2024-06-30 09:39:52'),
(19, 'Here We Again', 'Here we go again!', '08211315212', 'herewego@gmail.com', '2024-07-04 020013.bench-accounting-nvzvOPQW0gc-unsplash.jpg', 4, 2, '2024-07-03 19:00:13', '2024-07-03 19:00:30'),
(20, NULL, NULL, NULL, 'wulandari@gmail.com', NULL, NULL, NULL, '2024-07-04 11:15:21', '2024-07-04 11:15:21'),
(21, 'Informatika', 'Informatika Merdeka!', '0829103820240', 'sasageyo@gmail.com', 'car-repair-illustration-concept-vector.jpg 2024-07-04 223351', 5, 2, '2024-07-04 11:38:12', '2024-07-04 15:33:51'),
(22, NULL, NULL, NULL, 'muhammad.asshidiqi@mhs.unsoed.ac.id', NULL, NULL, NULL, '2024-07-05 13:56:04', '2024-07-05 13:56:04'),
(23, NULL, NULL, NULL, 'muhammad.alhakim@mhs.unsoed.ac.id', NULL, NULL, NULL, '2024-07-05 13:58:14', '2024-07-05 13:58:14'),
(24, NULL, NULL, NULL, 'rayhan.aghnat@gmail.com', NULL, NULL, NULL, '2024-07-05 13:58:24', '2024-07-05 13:58:24'),
(25, 'Fextruth', 'Fextruth is the king!', '08211315212', 'fextruth@gmail.com', 'bench-accounting-nvzvOPQW0gc-unsplash.jpg 2024-07-06 005934', 9, 6, '2024-07-05 14:18:39', '2024-07-05 17:59:34'),
(27, NULL, NULL, NULL, 'fakfak2@gmail.com', NULL, NULL, NULL, '2024-07-05 15:41:20', '2024-07-05 15:41:20'),
(28, NULL, NULL, NULL, 'wahwah@gmail.com', NULL, NULL, NULL, '2024-07-05 15:43:53', '2024-07-05 15:43:53'),
(29, NULL, NULL, NULL, 'lolololo@gmail.com', NULL, NULL, NULL, '2024-07-05 15:49:14', '2024-07-05 15:49:14'),
(30, NULL, NULL, NULL, 'muhammadalhakim@mhs.unsoed.ac.id', NULL, NULL, NULL, '2024-07-05 16:07:48', '2024-07-05 16:07:48'),
(31, NULL, NULL, NULL, 'levimuhammad101@gmail.com', NULL, NULL, NULL, '2024-07-05 16:09:12', '2024-07-05 16:09:12'),
(32, NULL, NULL, NULL, 'dzakwan.ramdhani@mhs.unsoed.ac.id', NULL, NULL, NULL, '2024-07-05 16:14:57', '2024-07-05 16:14:57'),
(33, NULL, NULL, NULL, 'brian@gmail.com', NULL, NULL, NULL, '2024-07-05 16:16:35', '2024-07-05 16:16:35'),
(34, NULL, NULL, NULL, 'talitha@gmail.com', NULL, NULL, NULL, '2024-07-05 16:32:53', '2024-07-05 16:32:53'),
(35, 'Diva', 'jalan jalan kapan jalan', '01234455', 'talithaanindyaa012@gmail.com', 'WhatsAppImage2024-06-30at22.14.42_9a70a3f5.jpg 2024-07-06 003830', 9, 6, '2024-07-05 16:35:06', '2024-07-05 17:38:30'),
(36, NULL, NULL, NULL, 'briancp1203@gmail.com', NULL, NULL, NULL, '2024-07-05 16:43:59', '2024-07-05 16:43:59'),
(37, NULL, NULL, NULL, 'msarexy@gmail.com', NULL, NULL, NULL, '2024-07-05 18:57:58', '2024-07-05 18:57:58'),
(38, 'Rexy', 'Rexy is the winner!', '082131931931', 'rexymsa@gmail.com', 'eren-namli-AsRbMgbV3Fc-unsplash.jpg 2024-07-06 020731', 4, 2, '2024-07-05 19:06:27', '2024-07-05 19:07:31'),
(39, NULL, 'Mahasiswa baru', '08211315212', 'mahasiswa@gmail.com', NULL, 1, 1, '2024-07-05 19:27:46', '2024-07-05 19:27:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `details`
--

CREATE TABLE `details` (
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `details`
--

INSERT INTO `details` (`detail_id`, `reference_number`, `quantity`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 'th2he2cXRLDgkU13', 4, 1, NULL, '2024-06-26 20:10:51'),
(2, 'th2he2cXRLDgkU13', 1, 2, '2024-06-26 18:55:44', '2024-06-26 18:55:44'),
(3, 'th2he2cXRLDgkU13', 2, 3, '2024-06-26 18:57:13', '2024-06-26 18:57:13'),
(4, 'th2he2cXRLDgkU13', 3, 5, '2024-06-26 19:00:26', '2024-06-26 19:28:03'),
(5, 'bIANhyOSuSKyOkO', 2, 2, '2024-06-30 09:31:46', '2024-06-30 09:31:46'),
(6, 'bIANhyOSuSKyOkO', 2, 1, '2024-06-30 09:32:09', '2024-06-30 09:32:09'),
(7, 'noTbigpbAsbvCUg', 1, 2, '2024-06-30 09:45:33', '2024-06-30 09:45:33'),
(8, 'noTbigpbAsbvCUg', 1, 1, '2024-06-30 09:45:41', '2024-06-30 09:45:41'),
(9, 'noTbigpbAsbvCUg', 1, 5, '2024-06-30 09:45:50', '2024-06-30 09:45:50'),
(10, 'noTbigpbAsbvCUg', 2, 4, '2024-06-30 09:45:59', '2024-06-30 09:45:59'),
(11, 'QPjAcYyTTDs', 2, 1, '2024-07-04 13:34:58', '2024-07-04 13:34:58'),
(12, 'GyJ258JrX1kZ4MX', 1, 1, '2024-07-04 15:59:35', '2024-07-04 15:59:35'),
(13, 'GyJ258JrX1kZ4MX', 1, 2, '2024-07-04 15:59:44', '2024-07-04 15:59:44'),
(14, 'GyJ258JrX1kZ4MX', 2, 7, '2024-07-04 15:59:53', '2024-07-04 15:59:53'),
(15, 'Jl6otg1MlZEDmzu', 2, 2, '2024-07-05 11:42:19', '2024-07-05 11:42:19'),
(16, 'Jl6otg1MlZEDmzu', 1, 1, '2024-07-05 11:42:28', '2024-07-05 11:42:28'),
(17, 'Jl6otg1MlZEDmzu', 2, 4, '2024-07-05 11:42:38', '2024-07-05 11:42:38'),
(18, '3sBeIyXo3VQ3po3', 1, 2, '2024-07-05 16:47:50', '2024-07-05 16:47:50'),
(19, '3sBeIyXo3VQ3po3', 1, 1, '2024-07-05 16:47:56', '2024-07-05 16:47:56'),
(20, 'adHzwPg34TxzEHb', 2, 5, '2024-07-05 17:51:10', '2024-07-05 17:51:10'),
(21, 'adHzwPg34TxzEHb', 1, 1, '2024-07-05 17:51:16', '2024-07-05 17:51:16'),
(22, 'TSXZ35RuMhpI9qS', 5, 6, '2024-07-05 18:09:37', '2024-07-05 18:09:37'),
(23, 'oJiKFyH0rWCvHBS', 1, 1, '2024-07-05 19:22:43', '2024-07-05 19:22:43'),
(24, 'oJiKFyH0rWCvHBS', 1, 6, '2024-07-05 19:22:49', '2024-07-05 19:22:49'),
(25, 'oJiKFyH0rWCvHBS', 1, 4, '2024-07-05 19:22:54', '2024-07-05 19:22:54'),
(26, 'QpJd7vlci20zBLZ', 1, 1, '2024-07-06 04:30:45', '2024-07-06 04:30:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histories`
--

CREATE TABLE `histories` (
  `history_id` bigint(20) UNSIGNED NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `vehicle_name` varchar(255) DEFAULT NULL,
  `vehicle_color` varchar(255) DEFAULT NULL,
  `chassis_number` varchar(255) DEFAULT NULL,
  `engine_number` varchar(255) DEFAULT NULL,
  `mileage` int(10) UNSIGNED DEFAULT NULL,
  `plate_number` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `payment_method` enum('Cash','Credit Card','Bank Transfer') DEFAULT NULL,
  `payment_status` enum('Failed','Pending','Paid') NOT NULL DEFAULT 'Pending',
  `transaction_status` enum('Failed','Finished') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `histories`
--

INSERT INTO `histories` (`history_id`, `reference_number`, `customer_name`, `email`, `phone`, `address`, `vehicle_name`, `vehicle_color`, `chassis_number`, `engine_number`, `mileage`, `plate_number`, `total`, `discount`, `coupon_code`, `payment_method`, `payment_status`, `transaction_status`, `created_at`, `updated_at`) VALUES
(4, 'ddasda', 'Test', 'msultanalhakim@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '321312', NULL, NULL, NULL, 'Paid', NULL, '2024-06-30 09:41:05', NULL),
(5, 'Jl6otg1MlZEDmzu', 'Muhammad Sultan Alhakim', 'msultanalhakim@gmail.com', '082113155212', 'Perumahan Bumi Mutiara', 'Mercedes Benz AMG GT63', 'Brown', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 2000, 'R 1 CH', '3810000', '90000', 'KING', 'Bank Transfer', 'Paid', 'Finished', '2024-07-05 12:13:44', '2024-07-05 12:13:44'),
(6, '3sBeIyXo3VQ3po3', 'Diva', 'talithaanindyaa012@gmail.com', '01234455', 'jalan jalan kapan jalan', 'Bajaj', 'Oren', '0202', '0606', 100, 'B 123 OK', '130000', '90000', 'KING', 'Bank Transfer', 'Paid', 'Finished', '2024-07-05 16:52:13', '2024-07-05 16:52:13'),
(7, 'TSXZ35RuMhpI9qS', 'Fextruth', 'fextruth@gmail.com', '08211315212', 'Fextruth is the king!', 'Mercedes Benz Amg Gt63', 'Black', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 2000, 'R 1 CH', '5750000', '1000000', 'sultanganteng', 'Bank Transfer', 'Paid', 'Finished', '2024-07-05 18:16:04', '2024-07-05 18:16:04'),
(8, 'oJiKFyH0rWCvHBS', 'Rexy', 'rexymsa@gmail.com', '082131931931', 'Rexy is the winner!', 'Bmw Baru', 'Biru', 'KFLSL09SL', 'FKLSMD002', 40000, 'W 4 HHA', '3200000', '90000', 'KING', 'Bank Transfer', 'Paid', 'Finished', '2024-07-05 19:25:35', '2024-07-05 19:25:35'),
(9, 'QpJd7vlci20zBLZ', 'Fextruth', 'fextruth@gmail.com', '08211315212', 'Fextruth is the king!', 'Mercedes Benz Amg Gt63', 'Black', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 2000, 'N 3 GOO', '50000', '90000', 'KING', 'Cash', 'Paid', 'Finished', '2024-07-06 04:31:17', '2024-07-06 04:31:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`item_id`, `item_code`, `item_name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'SRV', 'Service', '140000', '2024-06-25 18:47:26', '2024-07-04 00:14:39'),
(2, 'SRV-OIL', 'Oil Change', '80000', '2024-06-25 18:47:26', '2024-06-25 18:47:26'),
(3, 'SRV-TRANS', 'Service Transmission', '900000', '2024-06-25 18:47:26', '2024-06-25 18:47:26'),
(4, 'SRV-ENGINE', 'Service Engine', '1800000', '2024-06-25 18:47:26', '2024-06-25 18:47:26'),
(5, 'SRV-SUSP', 'Service Suspension', '500000', '2024-06-25 18:47:26', '2024-06-25 18:47:26'),
(6, 'BR-UP', 'Bore Up', '1350000', '2024-06-25 18:47:26', '2024-06-25 18:47:26'),
(7, 'SRV-TIRES', 'Service Tires', '350000', '2024-06-25 18:47:26', '2024-06-25 18:47:26'),
(8, 'SRV-AUDIO', 'Service Audio', '190000', '2024-07-04 00:12:44', '2024-07-04 00:12:44'),
(9, 'SRV-SPOILER', 'Service Spoiler', '900000', '2024-07-05 19:31:51', '2024-07-05 19:31:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(5, 'default', '{\"uuid\":\"6bd87ce7-712f-4303-91f6-07412b301912\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187764, 1720187764),
(6, 'default', '{\"uuid\":\"481fdc57-0182-492f-a817-daa5e08307fa\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187767, 1720187767),
(7, 'default', '{\"uuid\":\"66ce3170-8c57-4ce0-a06d-c4e7c55bb72c\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187832, 1720187832),
(8, 'default', '{\"uuid\":\"2d9a3a5c-e0e2-462c-8b58-96423fecc5a3\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187835, 1720187835),
(9, 'default', '{\"uuid\":\"aecc167d-ffc7-4b8f-9b95-0b126b84c1ef\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187879, 1720187879),
(10, 'default', '{\"uuid\":\"ac79dc7b-62c7-44cf-b9a1-d009a8a81605\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187883, 1720187883),
(11, 'default', '{\"uuid\":\"58347f05-ccca-4a85-971a-ad471241fa16\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187884, 1720187884),
(12, 'default', '{\"uuid\":\"7da76a31-c5ed-4b95-a6cd-adc59a5ed1c9\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187894, 1720187894),
(13, 'default', '{\"uuid\":\"0b0b9e76-6557-4120-918f-572c8906308d\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187904, 1720187904),
(14, 'default', '{\"uuid\":\"515a6138-11d6-410a-a18a-3bfbb9dd3463\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187911, 1720187911),
(15, 'default', '{\"uuid\":\"e260d932-d1bb-4e8d-84f6-c7b760f3fdff\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720187962, 1720187962),
(16, 'default', '{\"uuid\":\"bd6bfda6-d320-4403-83a2-55276f2de893\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720188227, 1720188227),
(17, 'default', '{\"uuid\":\"e9bed29c-8742-4398-8441-6f33a41570ad\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720188841, 1720188841),
(18, 'default', '{\"uuid\":\"cf7a8eaa-0ff8-401f-baa7-c9f130b18cbf\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720188971, 1720188971),
(19, 'default', '{\"uuid\":\"f7c7d742-3baa-437c-aa80-26a1d45784f3\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720189089, 1720189089),
(20, 'default', '{\"uuid\":\"18ef9d96-82ca-4c91-93b9-28a93d47bef7\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:28;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720189119, 1720189119),
(21, 'default', '{\"uuid\":\"f50181b7-58ac-4075-989f-5889cb1f9195\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:28;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720189163, 1720189163),
(22, 'default', '{\"uuid\":\"b17dbf28-9fc1-4879-b5df-d007279cff30\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:28;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720189262, 1720189262),
(23, 'default', '{\"uuid\":\"b042a901-1e23-48d5-8d72-fa90052714e4\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:28;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720189304, 1720189304),
(24, 'default', '{\"uuid\":\"b311ecc8-b5d0-4f58-9043-c1213ebcbb46\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:29;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720191270, 1720191270),
(25, 'default', '{\"uuid\":\"bc678427-f26e-412d-8924-6f27fd794335\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:30;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720194080, 1720194080),
(26, 'default', '{\"uuid\":\"91804210-627d-4e25-ba66-cea6b4f12d9e\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:30;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720194126, 1720194126),
(27, 'default', '{\"uuid\":\"8420eec0-021f-40fb-9a5a-ac9b0f3ca500\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:31;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720194233, 1720194233),
(28, 'default', '{\"uuid\":\"e0d036bf-b037-4f99-b071-550e7c483b60\",\"displayName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\QueuedVerifyEmailJob\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\QueuedVerifyEmailJob\\\":1:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:32;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1720194554, 1720194554);

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_06_05_120451_create_provinces_table', 1),
(2, '2024_06_05_120502_create_cities_table', 1),
(3, '2024_06_05_121152_create_customers_table', 1),
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinces`
--

CREATE TABLE `provinces` (
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `province_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `provinces`
--

INSERT INTO `provinces` (`province_id`, `province_name`, `created_at`, `updated_at`) VALUES
(1, 'West Java', '2024-06-07 07:50:45', '2024-06-07 07:50:45'),
(2, 'East Java', '2024-06-07 09:02:23', '2024-06-07 09:02:23'),
(3, 'Central Java', '2024-06-07 09:02:40', '2024-06-07 09:02:40'),
(4, 'Jakarta', '2024-06-07 09:03:03', '2024-06-07 09:03:03'),
(5, 'North Sumatera', '2024-06-07 09:03:21', '2024-06-07 09:03:21'),
(6, 'Bali', '2024-07-03 20:06:46', '2024-07-03 20:06:46'),
(8, 'South Papua', '2024-07-03 20:18:51', '2024-07-03 20:18:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7qwOhsQJvxXpwZrVW8lNJ7mg41Vvxm4p4w6q0KoF', 1, '111.94.11.192', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieXBkZUthT0pTZXBkbDRrdm40MnF1OFpEUWtMN1BIVnZNMmlueng2aSI7czozOiJ1cmwiO2E6MDp7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbXN1bHRhbmFsaGFraW0uY29tL2xvZ2luIjt9fQ==', 1720237786),
('CS5bZ66SKWYcpOCKK2Nks0vg2q5KvmdFtNySbAgn', 1, '111.94.11.192', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRGlyVGxJcE1tQmIzQ1FFUDFEOTNFYjBySXZCdU9SeTNyZDdWUFhkYiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwczovL21zdWx0YW5hbGhha2ltLmNvbS93b3Jrc2hvcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1720240445),
('hDTKPAMACAw20ZOiZL5qxVGGY6PN55tIg3CyBxkg', NULL, '205.210.31.141', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRm0wWG12YUhMSVlLdnRsa3dmelFydUREem9xZ2dmd2hXQ1ZFakJSWSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNToiaHR0cDovL21zdWx0YW5hbGhha2ltLmNvbSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI1OiJodHRwOi8vbXN1bHRhbmFsaGFraW0uY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1720241519),
('Jcp3Ydyc8lCwC7csI8azA7Vn10Lws0YRuAtrUViX', 44, '111.94.11.192', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVmVQelc2SkJGMW5ocHV3ZGFCMTFmaE1kTTlwbHg1RGdnM0NiWktIMyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwczovL21zdWx0YW5hbGhha2ltLmNvbS9zZXJ2aWNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDQ7fQ==', 1720240447),
('mibqHxTkgMmIqleNhPQGupyfhKBY9CuCPWhjtujf', NULL, '111.94.11.192', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZHpJQTdMSVcyV0ZQcjUzSllwTGRoVzQyVmNWaVpCdENpUDNKd0hyVSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cHM6Ly93d3cubXN1bHRhbmFsaGFraW0uY29tIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vd3d3Lm1zdWx0YW5hbGhha2ltLmNvbS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1720241265);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `payment_method` enum('Cash','Bank Transfer') DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_status` enum('Failed','Pending','Paid') NOT NULL DEFAULT 'Pending',
  `transaction_status` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `reference_number`, `total`, `payment_method`, `coupon_code`, `vehicle_id`, `payment_status`, `transaction_status`, `file`, `customer_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(1, 'QPjAcYyTTDs', '280000', 'Bank Transfer', NULL, 1, 'Paid', '', 'Receipt th2he2cXRLDgkU13 2024-06-30 051317.png', 1, 40, '2024-06-25 18:47:26', '2024-07-04 13:43:27'),
(2, 'th2he2cXRLDgkU13', '2260000', 'Bank Transfer', 'KING', 1, 'Paid', 'Finished', 'Receipt th2he2cXRLDgkU13 2024-06-30 051317.png', 1, 42, '2024-06-26 09:57:10', '2024-06-30 07:34:22'),
(3, 'bIANhyOSuSKyOkO', '0', 'Cash', 'KING', 3, 'Paid', 'Finished', NULL, 17, 43, '2024-06-30 09:04:50', '2024-06-30 13:55:45'),
(4, 'noTbigpbAsbvCUg', '2700000', 'Bank Transfer', 'king', 5, 'Paid', 'Finished', 'Receipt-noTbigpbAsbvCUg 2024-06-30 044742.png', 18, 44, '2024-06-30 09:44:30', '2024-06-30 09:49:19'),
(5, 'GyJ258JrX1kZ4MX', '830000', 'Bank Transfer', 'KING', 47, 'Paid', 'Finished', 'Receipt-GyJ258JrX1kZ4MX 2024-07-04 110300.png', 21, 48, '2024-07-04 15:52:12', '2024-07-04 16:04:51'),
(6, 'Jl6otg1MlZEDmzu', '3810000', 'Bank Transfer', 'KING', 1, 'Paid', 'Finished', 'Receipt-Jl6otg1MlZEDmzu 2024-07-05 064337.png', 2, 49, '2024-07-05 11:36:32', '2024-07-05 12:13:09'),
(7, '3sBeIyXo3VQ3po3', '130000', 'Bank Transfer', 'KING', 48, 'Paid', 'Finished', 'Receipt-3sBeIyXo3VQ3po3 2024-07-05 115043.jpg', 35, 50, '2024-07-05 16:47:03', '2024-07-05 16:52:13'),
(8, 'adHzwPg34TxzEHb', '1140000', 'Bank Transfer', NULL, 49, 'Pending', NULL, 'Receipt-adHzwPg34TxzEHb 2024-07-06 125208.jpeg', 35, 51, '2024-07-05 17:44:27', '2024-07-05 17:52:08'),
(9, 'TSXZ35RuMhpI9qS', '5750000', 'Bank Transfer', 'sultanganteng', 50, 'Paid', 'Finished', 'Receipt-TSXZ35RuMhpI9qS 2024-07-06 011200.jpeg', 25, 52, '2024-07-05 18:08:05', '2024-07-05 18:16:04'),
(10, 'oJiKFyH0rWCvHBS', '3200000', 'Bank Transfer', 'KING', 52, 'Paid', 'Finished', 'Receipt-oJiKFyH0rWCvHBS 2024-07-06 022349.png', 38, 55, '2024-07-05 19:21:50', '2024-07-05 19:25:35'),
(11, 'QpJd7vlci20zBLZ', '50000', 'Cash', 'KING', 50, 'Paid', 'Finished', NULL, 25, 53, '2024-07-06 04:30:16', '2024-07-06 04:31:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Administrator','User') NOT NULL DEFAULT 'User',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `status`, `customer_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator@gmail.com', '2021-10-09 17:00:00', '$2y$12$nu6hjYQ3W1EmgOsOPkfKrOfYLYPO8JmYRWzFJ3Jp8B2E5pOJ5/MVy', 'Administrator', 'Active', 1, NULL, '2024-06-07 06:28:04', '2024-07-01 17:59:56'),
(3, 'aguswijayanto', 'aguswijayantos@gmail.com', NULL, '$2y$12$l5qzCTI.IEkbLAaf3fT/euosyWX96dI1nJEsiycCN0XCJQ0CLM00.', 'User', 'Active', 3, NULL, '2024-06-07 06:29:52', '2024-07-03 16:40:32'),
(6, 'toyotires', 'toyotires@gmail.com', NULL, '$2y$12$dCCYwNQ.vjg3qgUtMkkGx.m0mSm3JHLx.gT8lSh.komUWn5xl29hW', 'User', 'Active', NULL, NULL, '2024-06-10 00:50:20', '2024-06-10 00:50:20'),
(7, 'fakfak', 'fakfak@gmail.com', NULL, '$2y$12$NwZ56uDdAjZlUT.o/Xz32e8zRHcB131RvOMcRw4ukvEuzZ5.AlTGu', 'User', 'Active', NULL, NULL, '2024-06-10 01:03:23', '2024-06-10 01:03:23'),
(8, 'wakwak', 'wakwak@gmail.com', NULL, '$2y$12$PGVXHcVuhBVZ7xIVUXh85e8JUmGCEqQqbqcCkM6m5NLNQKzKpX2VW', 'User', 'Active', NULL, NULL, '2024-06-10 01:06:48', '2024-06-10 01:06:48'),
(9, 'tester', 'tester@gmail.com', NULL, '$2y$12$NkNPXviTO0Cjil/Nv5TsEuXz4YAkRSdVQOadmlyTcam1kaHN7iq4S', 'User', 'Active', NULL, NULL, '2024-06-10 01:16:54', '2024-06-10 01:16:54'),
(10, 'rian', 'rian@gmail.com', NULL, '$2y$12$Yh84pSm9CfH6WafCJ3OW4OCxsHrYwkqAfAjJweeTXITH4ZBQO2cM.', 'User', 'Active', NULL, NULL, '2024-06-10 01:44:39', '2024-06-10 01:44:39'),
(11, 'ipul', 'ipul@gmail.com', NULL, '$2y$12$lIctUcCshjYnVJ4gGTtdYejBybsqxUwQ/gdrhf4pV8T7ZwqkTfOda', 'User', 'Active', NULL, NULL, '2024-06-10 01:46:17', '2024-06-10 01:46:17'),
(12, 'dasd', 'dasd@gmail.com', NULL, '$2y$12$ULCRr0bq3Hae/SISpKhE5uA6kgjtY1FSsfDs5yOfxMBGBrCXC136C', 'User', 'Active', NULL, NULL, '2024-06-10 01:47:26', '2024-06-10 01:47:26'),
(13, 'wargamakmur', 'test1234@gmail.com', NULL, '$2y$12$ePKuUXmbBEXTOFOEEE.0beEqamYtvFuE9/y1q8on4hhzoou9xrTCG', 'Administrator', 'Active', NULL, NULL, '2024-06-10 01:48:51', '2024-07-01 18:48:31'),
(14, 'test12345', 'test12345@gmail.com', NULL, '$2y$12$waYff9YwW7Qbp0njwf1vBuVuS0a26OYOp27Vi4hcWwOL5wWXzCuI2', 'User', 'Active', 13, NULL, '2024-06-10 01:49:37', '2024-06-10 01:49:37'),
(15, 'testing13', 'test4321@gmail.com', '2024-10-09 17:00:00', '$2y$12$fwDZXo4ePD6HvCe7N5LKcupq7Ikv56Js0lslHAATuRgiHdVDSUrxO', 'User', 'Active', 14, NULL, '2024-06-10 01:52:05', '2024-06-10 06:30:59'),
(16, 'margaret', 'testing12@gmail.com', '2024-06-10 06:20:32', '$2y$12$MIxfoXA2c/prqbk9HuYXjuNwl2UB8wqH2qD.qNWdIm2ekkcTM7N76', 'User', 'Active', 15, NULL, '2024-06-10 06:20:01', '2024-06-10 06:35:37'),
(17, 'diva', 'diva@gmail.com', '2024-06-10 06:46:42', '$2y$12$0iofj3qAe1Q5pL6WFnOM0uHrFxbSrWt6/xHVWAJDEfRTABIPK6kd2', 'User', 'Active', 16, NULL, '2024-06-10 06:46:24', '2024-06-10 06:46:42'),
(18, 'wadimor', 'wadimor@gmail.com', '2024-06-11 16:12:25', '$2y$12$6oquKnEVrZWQo8K2aQb1EejtNaIiFXYEiYpHzewAKD2alO7hnJHee', 'User', 'Active', 17, NULL, '2024-06-11 16:12:04', '2024-07-01 18:08:41'),
(39, 'rayhan123', 'rayhan.aghnat@gmail.com', NULL, '$2y$12$K6bsojsskwabhV0abemPk.fW5u6vHMHk38SR7gQ9COAeaRW98Au4q', 'User', 'Active', 24, NULL, '2024-07-05 16:09:45', '2024-07-05 16:09:45'),
(40, 'dzakonee', 'dzakwan.ramdhani@mhs.unsoed.ac.id', NULL, '$2y$12$gIMh34WO8Zhd/AVo4zz.P.RFWZf/n9GB3gPgziDWAdHvUAcPBp.7u', 'User', 'Active', 32, NULL, '2024-07-05 16:14:57', '2024-07-05 16:14:57'),
(41, 'brian', 'brian@gmail.com', NULL, '$2y$12$6fLRxRxAeRwkJf/gBQe2gO2TMS0PKTuaDxZOD37heyE8o/HLFh62a', 'User', 'Active', 33, NULL, '2024-07-05 16:16:35', '2024-07-05 16:16:35'),
(42, 'talitha', 'talitha@gmail.com', NULL, '$2y$12$x7/rc2xOmzP4d5jx/Cg3L.MO89TxUN1XYFzB2XjUmqhjBBQ1v5ijO', 'User', 'Active', 34, NULL, '2024-07-05 16:32:53', '2024-07-05 16:32:53'),
(43, 'talithaanindya', 'talithaanindyaa012@gmail.com', '2024-07-05 16:36:56', '$2y$12$SSo8hEovR4u7Uzou0/d5yeMbDN9IInQx8PxGlKnzaDR7T9hxX4VBa', 'User', 'Active', 35, NULL, '2024-07-05 16:35:06', '2024-07-05 16:36:56'),
(44, 'fextruth', 'fextruth@gmail.com', '2024-07-05 16:36:35', '$2y$12$VSDoiXCqZc0BXkHUna.kA.l8wjpipSzQKoyR8/h883QuLzleu6U8G', 'User', 'Active', 25, NULL, '2024-07-05 16:36:12', '2024-07-05 16:36:35'),
(45, 'brian123', 'briancp1203@gmail.com', '2024-07-05 16:56:38', '$2y$12$dtFS/AjrHTGbOK3cYOMZsOSdI821LrW5i3Nl9SHjMtYE1qxw/tIgK', 'User', 'Active', 36, NULL, '2024-07-05 16:43:59', '2024-07-05 16:56:38'),
(50, 'msultanalhakim', 'msultanalhakim@gmail.com', '2024-07-05 19:05:37', '$2y$12$oil/lgpMun9Cg5Fg795HCeeq/eO04Pt78obOieJipQ/gw1rtCrq3.', 'User', 'Active', 2, NULL, '2024-07-05 19:05:26', '2024-07-05 19:05:37'),
(51, 'rexymsa', 'rexymsa@gmail.com', '2024-07-05 19:06:37', '$2y$12$o52vMk5VMhD7SgQtQxed8upabkv9QbNqZTTy1.AEXklMdV3RqtVKa', 'User', 'Active', 38, NULL, '2024-07-05 19:06:27', '2024-07-05 19:06:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `vehicle_color` varchar(255) NOT NULL,
  `chassis_number` varchar(255) NOT NULL,
  `engine_number` varchar(255) NOT NULL,
  `mileage` int(10) UNSIGNED NOT NULL,
  `plate_number` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_name`, `vehicle_color`, `chassis_number`, `engine_number`, `mileage`, `plate_number`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'Mercedes Benz AMG GT63', 'Brown', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 2000, 'R 1 CH', 2, '2024-06-09 13:22:50', '2024-07-03 19:28:32'),
(2, 'BMW M5CS', 'Black', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 4000, 'F 6568 FHI', 2, NULL, NULL),
(3, 'Mitsubishi Pajero 2022', 'Black', 'EF0CKKZLAMPARD', 'CFG014L42019XMY', 40000, 'K 1 NG', 17, '2024-06-30 08:37:52', '2024-07-01 04:31:19'),
(5, 'Honda Civic Turbo', 'Black', 'EF09201KSMCLDO0', 'EKRLKWMXMDLAK0', 40000, 'L 3 PI', 18, '2024-06-30 09:41:05', '2024-06-30 09:41:05'),
(7, 'Aston Martin Db 2017', 'Grey', 'F092KCLS03933', 'SKLZMMX92012', 40000, 'F 3021 IGH', 17, '2024-07-01 12:08:49', '2024-07-01 12:08:49'),
(34, 'Honda Civic Turbo', 'Black', 'LKSPA01CZKLXSM', 'DKLSAMC02KDPP', 49281, 'F 3921 OO', 1, '2024-07-01 16:51:50', '2024-07-01 16:51:50'),
(47, 'Mercedes Benz Amg Gt63', 'Black', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 2000, 'R 1 CH', 21, '2024-07-04 15:29:42', '2024-07-04 15:29:42'),
(48, 'Bajaj', 'Oren', '0202', '0606', 100, 'B 123 OK', 35, '2024-07-05 16:41:23', '2024-07-05 16:41:23'),
(49, 'Permadani', 'Merah', '111', '1212', 1111, 'W 00 W', 35, '2024-07-05 17:04:17', '2024-07-05 17:29:00'),
(50, 'Mercedes Benz Amg Gt63', 'Black', '2HXSKLW20KDMLSAKPWL', '4NCS0PVX4LBR790', 2000, 'N 3 GOO', 25, '2024-07-05 18:00:04', '2024-07-05 18:25:28'),
(52, 'Bmw Baru', 'Biru', 'KFLSL09SL', 'FKLSMD002', 40000, 'W 4 HHA', 38, '2024-07-05 19:13:25', '2024-07-05 19:13:25'),
(53, 'Bajaj', 'Red', '001', '002', 2000, 'F 20 GT', 25, '2024-07-06 04:28:21', '2024-07-06 04:28:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `workshops`
--

CREATE TABLE `workshops` (
  `workshop_id` bigint(20) UNSIGNED NOT NULL,
  `workshop_name` varchar(255) DEFAULT NULL,
  `status` enum('Underway','Postponed','Finished') NOT NULL DEFAULT 'Underway',
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `workshops`
--

INSERT INTO `workshops` (`workshop_id`, `workshop_name`, `status`, `vehicle_id`, `booking_id`, `created_at`, `updated_at`) VALUES
(2, 'Workshop 1', 'Postponed', NULL, NULL, '2024-06-12 12:13:47', '2024-07-06 04:34:04'),
(3, 'Workshop 2', 'Underway', NULL, NULL, '2024-06-12 12:14:40', '2024-07-05 16:47:03'),
(4, 'Workshop 3', 'Postponed', NULL, NULL, '2024-06-12 12:14:40', '2024-07-06 03:55:04'),
(5, 'Workshop 4', 'Finished', 52, 56, '2024-06-12 12:14:40', '2024-07-05 19:43:04');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `bookings_customer_id_foreign` (`customer_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `cities_province_id_foreign` (`province_id`);

--
-- Indeks untuk tabel `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `customers_city_id_foreign` (`city_id`),
  ADD KEY `customers_province_id_foreign` (`province_id`);

--
-- Indeks untuk tabel `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `details_reference_number_index` (`reference_number`),
  ADD KEY `details_item_id_foreign` (`item_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`history_id`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_code` (`item_code`) USING BTREE;

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`province_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `reference_number` (`reference_number`) USING BTREE,
  ADD KEY `transactions_booking_id_foreign` (`booking_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_customer_id_foreign` (`customer_id`);

--
-- Indeks untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `vehicles_customer_id_foreign` (`customer_id`);

--
-- Indeks untuk tabel `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`workshop_id`),
  ADD KEY `workshops_vehicle_id_foreign` (`vehicle_id`) USING BTREE,
  ADD KEY `booking_id` (`booking_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `details`
--
ALTER TABLE `details`
  MODIFY `detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `histories`
--
ALTER TABLE `histories`
  MODIFY `history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `provinces`
--
ALTER TABLE `provinces`
  MODIFY `province_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `workshops`
--
ALTER TABLE `workshops`
  MODIFY `workshop_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Ketidakleluasaan untuk tabel `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`province_id`);

--
-- Ketidakleluasaan untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`),
  ADD CONSTRAINT `customers_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`province_id`);

--
-- Ketidakleluasaan untuk tabel `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `details_reference_number_foreign` FOREIGN KEY (`reference_number`) REFERENCES `transactions` (`reference_number`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Ketidakleluasaan untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Ketidakleluasaan untuk tabel `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`),
  ADD CONSTRAINT `workshops_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
