-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2022 at 01:18 PM
-- Server version: 8.0.25-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'pemilik apotek widya'),
(2, 'user', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 7),
(2, 13),
(2, 14),
(2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '127.0.0.1', 'admin@admin.com', NULL, '2021-10-17 03:57:47', 0),
(2, '127.0.0.1', 'admin@admin.com', NULL, '2021-10-17 03:57:55', 0),
(3, '127.0.0.1', 'mutiara@admin.com', 2, '2021-10-17 03:58:10', 0),
(4, '127.0.0.1', 'mutiara@admin.com', 2, '2021-10-17 03:58:48', 0),
(5, '127.0.0.1', 'user@admin.com', 4, '2021-10-17 07:50:57', 1),
(6, '127.0.0.1', 'mutiara@admin.com', 2, '2021-10-17 07:55:33', 0),
(7, '127.0.0.1', 'ara@admin.com', 5, '2021-10-17 07:57:20', 1),
(8, '127.0.0.1', 'ara@admin.com', NULL, '2021-10-17 08:45:26', 0),
(9, '127.0.0.1', 'ara@admin.com', 5, '2021-10-17 08:45:56', 1),
(10, '127.0.0.1', 'user@user.com', 6, '2021-10-17 08:52:40', 1),
(11, '127.0.0.1', 'mutiara@admin.com', NULL, '2021-10-19 00:59:34', 0),
(12, '127.0.0.1', 'admin@admin.com', NULL, '2021-10-19 00:59:49', 0),
(13, '127.0.0.1', 'mutiara@admin.com', NULL, '2021-10-19 01:00:02', 0),
(14, '127.0.0.1', 'ara@admin.com', 5, '2021-10-19 01:01:57', 1),
(15, '127.0.0.1', 'user@user.com', 6, '2021-10-19 01:16:26', 1),
(16, '127.0.0.1', 'ara@admin.com', 5, '2021-10-19 01:16:45', 1),
(17, '127.0.0.1', 'user@user.com', 6, '2021-10-19 01:23:20', 1),
(18, '127.0.0.1', 'ara@admin.com', 5, '2021-10-19 01:23:56', 1),
(19, '127.0.0.1', 'user@user.com', 6, '2021-10-19 01:36:52', 1),
(20, '127.0.0.1', 'ara@admin.com', 5, '2021-10-19 01:37:09', 1),
(21, '127.0.0.1', 'ara@admin.com', 5, '2021-10-19 11:13:03', 1),
(22, '127.0.0.1', 'ara@admin.com', 5, '2021-10-20 15:25:28', 1),
(23, '127.0.0.1', 'ara@admin.com', 5, '2021-10-20 18:34:13', 1),
(24, '127.0.0.1', 'ara@admin.com', 7, '2021-10-20 19:10:31', 1),
(25, '127.0.0.1', 'ara@admin.com', 7, '2021-10-20 19:10:41', 1),
(26, '127.0.0.1', 'ara@admin.com', 7, '2021-10-21 05:17:54', 1),
(27, '127.0.0.1', 'user@user.com', 6, '2021-10-21 07:46:04', 1),
(28, '127.0.0.1', 'ara@admin.com', 7, '2021-10-21 07:47:58', 1),
(29, '127.0.0.1', 'ara@admin.com', 7, '2021-10-21 10:51:14', 1),
(30, '127.0.0.1', 'ara@admin.com', 7, '2021-10-25 07:44:29', 1),
(31, '127.0.0.1', 'ara@admin.com', 7, '2021-11-01 07:25:20', 1),
(32, '127.0.0.1', 'mutiara@admin.com', NULL, '2021-11-20 00:08:47', 0),
(33, '127.0.0.1', 'mutiara@admin.com', NULL, '2021-11-20 00:08:59', 0),
(34, '127.0.0.1', 'ara@admin.com', 7, '2021-11-20 00:09:57', 1),
(35, '127.0.0.1', 'ara@admin.com', 7, '2021-11-21 10:50:56', 1),
(36, '127.0.0.1', 'ara@admin.com', 7, '2021-11-21 14:08:14', 1),
(37, '127.0.0.1', 'ara@admin.com', 7, '2021-11-24 01:28:22', 1),
(38, '127.0.0.1', 'ara@admin.com', 7, '2021-11-24 12:43:29', 1),
(39, '127.0.0.1', 'ara@admin.com', NULL, '2021-11-24 16:55:00', 0),
(40, '127.0.0.1', 'ara@admin.com', 7, '2021-11-24 16:55:16', 1),
(41, '127.0.0.1', 'ara@admin.com', 7, '2021-11-30 22:19:40', 1),
(42, '127.0.0.1', 'user@user.com', NULL, '2021-12-02 04:16:36', 0),
(43, '127.0.0.1', 'user1@user.com', 8, '2021-12-02 04:22:38', 1),
(44, '127.0.0.1', 'ara@admin.com', 7, '2021-12-02 04:45:43', 1),
(45, '127.0.0.1', 'ara@admin.com', 7, '2021-12-02 06:10:32', 1),
(46, '127.0.0.1', 'ara@admin.com', 7, '2021-12-03 19:45:13', 1),
(47, '127.0.0.1', 'ara@admin.com', 7, '2021-12-04 03:16:17', 1),
(48, '127.0.0.1', 'ara@admin.com', 7, '2021-12-04 04:52:37', 1),
(49, '127.0.0.1', 'ara@admin.com', 7, '2021-12-04 05:00:50', 1),
(50, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-05 20:49:46', 0),
(51, '127.0.0.1', 'ara@admin.com', 7, '2021-12-05 20:49:58', 1),
(52, '127.0.0.1', 'ara@admin.com', 7, '2021-12-05 23:58:33', 1),
(53, '127.0.0.1', 'user@user.com', 6, '2021-12-07 02:14:57', 1),
(54, '127.0.0.1', 'ara@admin.com', 7, '2021-12-07 02:15:34', 1),
(55, '127.0.0.1', 'user@user.com', 6, '2021-12-07 02:58:40', 1),
(56, '127.0.0.1', 'ara@admin.com', 7, '2021-12-07 03:00:05', 1),
(57, '127.0.0.1', 'ara@admin.com', 7, '2021-12-07 10:11:52', 1),
(58, '127.0.0.1', 'ara@admin.com', 7, '2021-12-07 17:31:43', 1),
(59, '127.0.0.1', 'ara@admin.com', 7, '2021-12-11 04:16:37', 1),
(60, '127.0.0.1', 'ara@admin.com', 7, '2021-12-11 09:08:25', 1),
(61, '127.0.0.1', 'ara@admin.com', 7, '2021-12-11 11:26:54', 1),
(62, '127.0.0.1', 'ara@admin.com', 7, '2021-12-11 18:12:52', 1),
(63, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-11 21:59:20', 0),
(64, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-11 21:59:30', 0),
(65, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-11 21:59:40', 0),
(66, '127.0.0.1', 'ara@admin.com', 7, '2021-12-11 21:59:48', 1),
(67, '127.0.0.1', 'ara@admin.com', 7, '2021-12-12 05:12:34', 1),
(68, '127.0.0.1', 'ara@admin.com', 7, '2021-12-13 18:49:51', 1),
(69, '127.0.0.1', 'ara@admin.com', 7, '2021-12-13 18:49:57', 1),
(70, '127.0.0.1', 'ara@admin.com', 7, '2021-12-13 21:52:07', 1),
(71, '127.0.0.1', 'ara@admin.com', 7, '2021-12-14 06:23:33', 1),
(72, '127.0.0.1', 'user@user.com', 6, '2021-12-14 06:28:53', 1),
(73, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-15 01:09:56', 0),
(74, '127.0.0.1', 'user@user.com', NULL, '2021-12-15 01:10:11', 0),
(75, '127.0.0.1', 'user@user.com', 6, '2021-12-15 01:10:34', 1),
(76, '127.0.0.1', 'user@user.com', 6, '2021-12-15 01:23:16', 1),
(77, '127.0.0.1', 'ara@admin.com', 7, '2021-12-15 01:23:34', 1),
(78, '127.0.0.1', 'user@user.com', 6, '2021-12-15 01:33:38', 1),
(79, '127.0.0.1', 'ara@admin.com', 7, '2021-12-15 01:42:16', 1),
(80, '127.0.0.1', 'ara@admin.com', 7, '2021-12-15 09:35:30', 1),
(81, '127.0.0.1', 'ara@admin.com', 7, '2021-12-15 23:58:19', 1),
(82, '127.0.0.1', 'ara@admin.com', 7, '2021-12-16 00:22:20', 1),
(83, '127.0.0.1', 'ara@admin.com', 7, '2021-12-16 00:30:17', 1),
(84, '127.0.0.1', 'ara@admin.com', 7, '2021-12-16 04:09:43', 1),
(85, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-16 22:40:27', 0),
(86, '127.0.0.1', 'ara@admin.com', 7, '2021-12-16 22:40:39', 1),
(87, '127.0.0.1', 'ara@admin.com', 7, '2021-12-17 02:50:28', 1),
(88, '127.0.0.1', 'ara@admin.com', 7, '2021-12-17 06:44:01', 1),
(89, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-17 19:43:54', 0),
(90, '127.0.0.1', 'ara@admin.com', 7, '2021-12-17 19:44:01', 1),
(91, '127.0.0.1', 'ara@admin.com', 7, '2021-12-18 05:37:13', 1),
(92, '127.0.0.1', 'ara@admin.com', 7, '2021-12-19 02:16:22', 1),
(93, '127.0.0.1', 'ara@admin.com', 7, '2021-12-19 11:59:13', 1),
(94, '127.0.0.1', 'ara@admin.com', 7, '2021-12-19 17:34:41', 1),
(95, '127.0.0.1', 'user@user.com', 6, '2021-12-20 06:22:57', 1),
(96, '127.0.0.1', 'user@user.com', 6, '2021-12-20 06:23:07', 1),
(97, '127.0.0.1', 'user@user.com', 6, '2021-12-20 06:33:57', 1),
(98, '127.0.0.1', 'user@user.com', 6, '2021-12-20 06:38:52', 1),
(99, '127.0.0.1', 'user@user.com', 6, '2021-12-20 06:51:20', 1),
(100, '127.0.0.1', 'ara@admin.com', 7, '2021-12-20 07:02:43', 1),
(101, '127.0.0.1', 'ara@admin.com', 7, '2021-12-20 09:39:07', 1),
(102, '127.0.0.1', 'user@user.com', 6, '2021-12-20 19:32:09', 1),
(103, '127.0.0.1', 'ara@admin.com', 7, '2021-12-20 19:46:48', 1),
(104, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-20 20:31:19', 0),
(105, '127.0.0.1', 'ara@admin.com', 7, '2021-12-20 20:31:32', 1),
(106, '127.0.0.1', 'user@user.com', 6, '2021-12-20 20:40:49', 1),
(107, '127.0.0.1', 'ara@admin.com', 7, '2021-12-20 22:41:38', 1),
(108, '127.0.0.1', 'ara@admin.com', 7, '2021-12-21 00:54:47', 1),
(109, '127.0.0.1', 'ara@admin.com', 7, '2021-12-21 19:15:11', 1),
(110, '127.0.0.1', 'ara@admin.com', 7, '2021-12-22 05:43:45', 1),
(111, '127.0.0.1', 'ara@admin.com', 7, '2021-12-22 23:35:17', 1),
(112, '127.0.0.1', 'ara@admin.com', 7, '2021-12-22 23:35:25', 1),
(113, '127.0.0.1', 'ara@admin.com', 7, '2021-12-23 22:26:50', 1),
(114, '127.0.0.1', 'ara@admin.com', NULL, '2021-12-24 02:27:05', 0),
(115, '127.0.0.1', 'ara@admin.com', 7, '2021-12-24 02:27:48', 1),
(116, '127.0.0.1', 'ara@admin.com', 7, '2021-12-24 07:42:00', 1),
(117, '127.0.0.1', 'ara@admin.com', 7, '2021-12-25 03:44:31', 1),
(118, '127.0.0.1', 'user@user.com', 6, '2021-12-25 09:12:35', 1),
(119, '127.0.0.1', 'ara@admin.com', 7, '2021-12-25 11:01:50', 1),
(120, '127.0.0.1', 'ara@admin.com', 7, '2021-12-25 18:26:36', 1),
(121, '127.0.0.1', 'user@user.com', 6, '2021-12-25 18:30:10', 1),
(122, '127.0.0.1', 'ara@admin.com', 7, '2021-12-25 18:45:20', 1),
(123, '127.0.0.1', 'ara@admin.com', 7, '2021-12-26 00:45:15', 1),
(124, '127.0.0.1', 'ara@admin.com', 7, '2021-12-26 10:53:30', 1),
(125, '127.0.0.1', 'ara@admin.com', 7, '2021-12-26 20:33:04', 1),
(126, '127.0.0.1', 'ara@admin.com', 7, '2021-12-27 03:17:02', 1),
(127, '127.0.0.1', 'ara@admin.com', 7, '2021-12-27 14:52:44', 1),
(128, '127.0.0.1', 'ara@admin.com', 7, '2021-12-27 14:52:49', 1),
(129, '127.0.0.1', 'ara@admin.com', 7, '2021-12-27 20:13:52', 1),
(130, '127.0.0.1', 'ara@admin.com', 7, '2021-12-27 23:26:33', 1),
(131, '127.0.0.1', 'ara@admin.com', 7, '2021-12-28 01:50:16', 1),
(132, '127.0.0.1', 'ara@admin.com', 7, '2021-12-28 02:20:48', 1),
(133, '127.0.0.1', 'ara@admin.com', 7, '2021-12-29 04:16:16', 1),
(134, '127.0.0.1', 'ara@admin.com', 7, '2021-12-29 07:40:31', 1),
(135, '127.0.0.1', 'ara@admin.com', 7, '2021-12-30 06:57:20', 1),
(136, '127.0.0.1', 'ara@admin.com', 7, '2021-12-30 21:07:09', 1),
(137, '127.0.0.1', 'ara@admin.com', 7, '2021-12-31 00:41:29', 1),
(138, '127.0.0.1', 'ara@admin.com', 7, '2021-12-31 02:46:29', 1),
(139, '127.0.0.1', 'ara@admin.com', 7, '2022-01-01 01:57:25', 1),
(140, '127.0.0.1', 'user1@user.com', NULL, '2022-01-01 03:57:22', 0),
(141, '127.0.0.1', 'ara@admin.com', 7, '2022-01-01 04:49:38', 1),
(142, '127.0.0.1', 'ara@admin.com', NULL, '2022-01-01 07:52:36', 0),
(143, '127.0.0.1', 'ara@admin.com', 7, '2022-01-01 07:52:44', 1),
(144, '127.0.0.1', 'ara@admin.com', 7, '2022-01-01 21:23:24', 1),
(145, '127.0.0.1', 'ara@admin.com', NULL, '2022-01-02 06:30:32', 0),
(146, '127.0.0.1', 'ara@admin.com', NULL, '2022-01-02 06:30:46', 0),
(147, '127.0.0.1', 'ara@admin.com', NULL, '2022-01-02 06:31:03', 0),
(148, '127.0.0.1', 'ara@admin.com', 7, '2022-01-02 06:31:18', 1),
(149, '127.0.0.1', 'ara@admin.com', 7, '2022-01-02 20:23:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'manage All users'),
(2, 'manage-profile', 'Manage user profile');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1634288397, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_satuan`
--

CREATE TABLE `tb_detail_satuan` (
  `id_obat` int NOT NULL,
  `id_satuan` int NOT NULL,
  `stok` int NOT NULL,
  `harga_jual` int NOT NULL,
  `harga_beli` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_detail_satuan`
--

INSERT INTO `tb_detail_satuan` (`id_obat`, `id_satuan`, `stok`, `harga_jual`, `harga_beli`) VALUES
(1, 1, 4, 30000, 27000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_distributor`
--

CREATE TABLE `tb_distributor` (
  `id_distributor` int NOT NULL,
  `nama_distributor` varchar(255) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_distributor`
--

INSERT INTO `tb_distributor` (`id_distributor`, `nama_distributor`, `no_telp`, `alamat`) VALUES
(2, 'PT. Kimia Farma Tbk', '62213847709', ' Jl. Veteran No. 9 Jakarta 10110'),
(4, 'PT. Kalbe Farma Tbk', '62114287388889', '  JL. Jend Suprapto Kav 4 Jakarta 10510 Jakarta'),
(5, 'PT. Dhainako Putra Sejati', '0271784947', 'Jl. Raya Klegen No. 37 Jetak, Bolon, Colomadu- Karanganyar ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_golongan`
--

CREATE TABLE `tb_golongan` (
  `id_golongan` int NOT NULL,
  `nama_golongan` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_golongan`
--

INSERT INTO `tb_golongan` (`id_golongan`, `nama_golongan`, `warna`) VALUES
(1, 'Obat Bebas', 'Hijau'),
(2, 'Obat Bebas Terbatas', 'Biru'),
(3, 'Obat Keras', 'Merah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id_jenis` int NOT NULL,
  `nama_jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, 'alat kesehatan'),
(2, 'kecantikan'),
(3, 'Obat'),
(7, 'Suplemen dan Susu'),
(8, 'Obat Herbal (jamu)'),
(9, 'Obat Luar'),
(10, 'Obat Herbal Terstandar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `jenis_id` int NOT NULL,
  `satuan_id` int NOT NULL,
  `id_golongan` int NOT NULL,
  `stok` int NOT NULL,
  `harga_jual` int NOT NULL,
  `harga_beli` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `jenis_id`, `satuan_id`, `id_golongan`, `stok`, `harga_jual`, `harga_beli`) VALUES
(2, 'Renadinac 50', 1, 10, 1, 34, 26906, 26250),
(3, 'Pronicy 4 MG (CYPROHEPTADINE) KAPLET 1', 3, 10, 1, 12, 29213, 28500),
(4, 'Wiros Caps (pirox 20mg) 100\'S', 3, 10, 1, 23, 21423, 20900),
(6, 'Ponstan Forte 500MG Kaplet', 3, 10, 1, 3, 257286, 251011),
(7, 'Flucadex Tab 100\'s', 3, 10, 1, 2, 65227, 63636),
(8, 'Mycoral cream 5GR (Kalbe)', 3, 10, 1, 6, 13325, 13000),
(9, 'Acyclovir CR 5% orb errela 24\'s', 3, 10, 1, 8, 76409, 74545),
(10, 'minyak tawon cc', 9, 6, 1, 7, 18450, 18000),
(11, 'Roverton kaplet 100\'s (ambroxol)', 3, 10, 1, 2, 14909, 14545),
(12, 'minyak kayu putih 60ml (cap lang)', 9, 6, 1, 12, 17766, 17333),
(13, 'Acifar cream 5 gr', 3, 11, 1, 6, 5171, 5045),
(14, 'Ambroxol syr 60ml OGB nova', 3, 6, 1, 3, 2795, 2727),
(15, 'alkohol 70% 100 ml medika', 1, 6, 1, 6, 5156, 5030),
(16, 'antasida doen syr 60ml lucas', 3, 6, 1, 6, 2795, 2727),
(17, 'Betadin SOL 15ml', 9, 6, 1, 3, 11644, 11360),
(18, 'Betadin SOL 30ml', 9, 6, 1, 4, 20500, 20000),
(19, 'Bevalex krim', 9, 11, 1, 6, 10250, 10000),
(20, 'Episol Loz 20\'s', 3, 10, 1, 1, 26138, 25500),
(21, 'Hot In Cream strong 60g ', 9, 6, 1, 6, 11890, 11600),
(22, 'Daktarin cream 5gr (kecil)', 9, 11, 1, 3, 21417, 20895),
(23, 'incidal OD 10mg caps 50\'s', 3, 10, 1, 2, 177940, 173600),
(24, 'bioplacenton', 3, 11, 1, 0, 22550, 22000),
(25, 'Amoxicillin 500mg OGB', 3, 10, 1, 5, 35409, 34545),
(26, 'Proris 200MG kaplet/100', 3, 10, 1, 2, 71750, 70000),
(27, 'polysilane SUSP 100ml', 3, 6, 1, 11, 20500, 20000),
(28, 'Urine bag ', 1, 7, 1, 6, 6150, 6000),
(68, 'aspirin', 3, 1, 2, 6, 7057, 6885),
(69, 'Stanza 500MG ', 3, 1, 3, 100, 576, 562);

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat_keluar`
--

CREATE TABLE `tb_obat_keluar` (
  `id_keluar` int NOT NULL,
  `id_obat` int NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `batch` varchar(255) NOT NULL,
  `jumlah_keluar` int NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_obat_keluar`
--

INSERT INTO `tb_obat_keluar` (`id_keluar`, `id_obat`, `id_user`, `batch`, `jumlah_keluar`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 27, 7, '45GT54', 2, 'obat kadaluarsa', '2020-11-27 20:16:21', '2021-12-27 20:16:21', NULL),
(15, 24, 7, 'R43E3SS', 2, 'obat kadaluarsa', '2021-12-28 01:39:03', '2021-12-28 01:39:03', NULL),
(18, 28, 7, '1K00390', 2, '-', '2022-01-01 05:03:49', '2022-01-01 05:03:49', NULL),
(19, 28, 7, '1K00390', 3, '-', '2022-01-01 05:04:42', '2022-01-01 05:04:42', NULL),
(21, 9, 7, 'GG54FFH', 3, 'kadaluarsa ', '2022-01-01 05:26:54', '2022-01-01 05:26:54', NULL),
(22, 21, 7, '1K00390', 6, ' kadaluarsa', '2022-01-01 05:28:36', '2022-01-01 05:28:36', NULL),
(23, 28, 7, 'GG54FFH', 6, 'terjual', '2022-01-02 03:44:50', '2022-01-02 03:44:50', NULL),
(24, 9, 7, 'GG54FFH', 3, 'kadaluarsa', '2022-01-02 04:05:04', '2022-01-02 04:05:04', NULL),
(25, 28, 7, '45GT54', 1, ' kadaluarsa', '2022-01-02 04:12:39', '2022-01-02 04:12:39', NULL),
(26, 17, 7, 'R43E3SS', 4, 'terjual', '2022-01-02 06:35:00', '2022-01-02 06:35:00', NULL);

--
-- Triggers `tb_obat_keluar`
--
DELIMITER $$
CREATE TRIGGER `edit_stok_obat_keluar` AFTER UPDATE ON `tb_obat_keluar` FOR EACH ROW BEGIN
 UPDATE tb_obat SET stok = ( stok + old.jumlah_keluar)-new.jumlah_keluar
 WHERE id_obat = NEW.id_obat;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `input_stok_keluar` AFTER INSERT ON `tb_obat_keluar` FOR EACH ROW BEGIN 
	UPDATE tb_obat SET stok = stok-NEW.jumlah_keluar
    WHERE id_obat = NEW.id_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat_masuk`
--

CREATE TABLE `tb_obat_masuk` (
  `id_masuk` int NOT NULL,
  `id_obat` int NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `id_distributor` int NOT NULL,
  `batch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah_masuk` int NOT NULL,
  `tgl_pesan` date NOT NULL,
  `tgl_expired` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_obat_masuk`
--

INSERT INTO `tb_obat_masuk` (`id_masuk`, `id_obat`, `id_user`, `id_distributor`, `batch`, `jumlah_masuk`, `tgl_pesan`, `tgl_expired`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(72, 28, 7, 5, 'R434SS', 1, '2022-01-02', '2024-10-30', 'Penambahan Stok Obat', '2022-01-01 22:19:38', '2022-01-02 04:09:54', NULL),
(76, 17, 7, 2, 'R43E3SS', 5, '2022-01-02', '2024-08-07', '-', '2022-01-02 06:33:35', '2022-01-02 06:33:35', NULL),
(77, 3, 7, 5, 'F12424', 4, '2021-12-21', '2024-04-03', '-', '2022-01-02 23:32:20', '2022-01-02 23:32:20', NULL);

--
-- Triggers `tb_obat_masuk`
--
DELIMITER $$
CREATE TRIGGER `edit_stok_masuk` AFTER UPDATE ON `tb_obat_masuk` FOR EACH ROW BEGIN 

UPDATE tb_obat set stok = (stok - OLD.jumlah_masuk ) + NEW.jumlah_masuk
WHERE tb_obat.id_obat = NEW.id_obat;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `input_stok_masuk` AFTER INSERT ON `tb_obat_masuk` FOR EACH ROW BEGIN
 UPDATE tb_obat SET stok = stok + NEW.jumlah_masuk 
 WHERE id_obat = NEW.id_obat;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesan`
--

CREATE TABLE `tb_pesan` (
  `id_pesan` int NOT NULL,
  `id_obat` int NOT NULL,
  `id_distributor` int NOT NULL,
  `zat_aktif_prekursor` varchar(255) NOT NULL,
  `bentuk` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pesan`
--

INSERT INTO `tb_pesan` (`id_pesan`, `id_obat`, `id_distributor`, `zat_aktif_prekursor`, `bentuk`, `satuan`, `jumlah`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 25, 0, '-', '-', '-', 5, '-', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_resep`
--

CREATE TABLE `tb_resep` (
  `no_resep` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int NOT NULL,
  `nama_satuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'tablet'),
(5, 'strips'),
(6, 'botol'),
(7, 'pcs'),
(9, 'pack'),
(10, 'box'),
(11, 'Tube'),
(12, 'Sachet');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'default.svg',
  `reset_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status_message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `nama_lengkap`, `password_hash`, `user_image`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'user@user.com', 'indah', 'indah', '$2y$10$VD4Qhsu32j9EAmPJTFJikeBh2S51qQgcO6TmIaHU.X34xEFZaRgJ.', 'default.svg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-17 08:52:14', '2021-10-17 08:52:14', NULL),
(7, 'ara@admin.com', 'mutiara', 'mutiara sukma', '$2y$10$rE7b.F08irrXx1.dyFhLzOO6MGGMcszHB0w8E8ggXpecWlCJ5mF1u', 'default.svg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-20 19:05:51', '2021-10-20 19:05:51', NULL),
(13, 'a55@admin.com', 'kgkfyf', 'bhrshrvf', '$2y$10$vJ8wyNDfZWIzYOjDiS9K5OHBt/N7etBxy635sjd8FsNYIKyrKoJFK', 'default.svg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-01-02 04:14:51', '2022-01-02 04:14:51', NULL),
(14, 'a552@admin.com', 'kgkfyfe', 'bhrshr', '$2y$10$A7holiC9fwRuY6FlB8z7oe42xHCRlbeVU9SzWxU.frPFssk1hWPHa', 'default.svg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-01-02 20:46:21', '2022-01-02 20:46:21', NULL),
(15, 'a55q@admin.com', 'kgkfyfs', 'sbhrshrvf', '$2y$10$/.92Qizsonbvn0SiUEjHN.ZJTAiKub81kdg62.pZOoeFdXO5N4hSq', 'default.svg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-01-02 20:50:44', '2022-01-02 20:50:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_detail_satuan`
--
ALTER TABLE `tb_detail_satuan`
  ADD UNIQUE KEY `id_obat` (`id_obat`),
  ADD UNIQUE KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `tb_distributor`
--
ALTER TABLE `tb_distributor`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indexes for table `tb_golongan`
--
ALTER TABLE `tb_golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_jenis` (`jenis_id`) USING BTREE,
  ADD KEY `id_satuan` (`satuan_id`) USING BTREE,
  ADD KEY `id_golongan` (`id_golongan`);

--
-- Indexes for table `tb_obat_keluar`
--
ALTER TABLE `tb_obat_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_obat` (`id_obat`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `tb_obat_masuk`
--
ALTER TABLE `tb_obat_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_obat` (`id_obat`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `id_distributor` (`id_distributor`) USING BTREE;

--
-- Indexes for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_distributor` (`id_distributor`);

--
-- Indexes for table `tb_resep`
--
ALTER TABLE `tb_resep`
  ADD PRIMARY KEY (`no_resep`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_distributor`
--
ALTER TABLE `tb_distributor`
  MODIFY `id_distributor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_golongan`
--
ALTER TABLE `tb_golongan`
  MODIFY `id_golongan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tb_obat_keluar`
--
ALTER TABLE `tb_obat_keluar`
  MODIFY `id_keluar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_obat_masuk`
--
ALTER TABLE `tb_obat_masuk`
  MODIFY `id_masuk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
  MODIFY `id_pesan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD CONSTRAINT `tb_obat_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `tb_jenis` (`id_jenis`),
  ADD CONSTRAINT `tb_obat_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `tb_satuan` (`id_satuan`),
  ADD CONSTRAINT `tb_obat_ibfk_3` FOREIGN KEY (`id_golongan`) REFERENCES `tb_golongan` (`id_golongan`);

--
-- Constraints for table `tb_obat_keluar`
--
ALTER TABLE `tb_obat_keluar`
  ADD CONSTRAINT `tb_obat_keluar_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`),
  ADD CONSTRAINT `tb_obat_keluar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `tb_obat_masuk`
--
ALTER TABLE `tb_obat_masuk`
  ADD CONSTRAINT `tb_obat_masuk_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`),
  ADD CONSTRAINT `tb_obat_masuk_ibfk_2` FOREIGN KEY (`id_distributor`) REFERENCES `tb_distributor` (`id_distributor`),
  ADD CONSTRAINT `tb_obat_masuk_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
  ADD CONSTRAINT `tb_pesan_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
