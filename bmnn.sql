-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2026 at 04:49 PM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmn`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kondisi` int(11) DEFAULT NULL,
  `tahun_pengadaan` year(4) DEFAULT NULL,
  `asal_pengadaan` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `nomor_seri` varchar(255) DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `jenis_barang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `studio` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `limit` int(11) NOT NULL DEFAULT 1,
  `sisa_limit` int(11) NOT NULL DEFAULT 1,
  `foto` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `uuid`, `kode_barang`, `nama_barang`, `jenis_barang`, `jumlah`, `kondisi`, `tahun_pengadaan`, `asal_pengadaan`, `catatan`, `nomor_seri`, `merk`, `jenis_barang_id`, `status`, `studio`, `deskripsi`, `qr_code`, `limit`, `sisa_limit`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'uod0FAn8nzhDPRwY', 'JGHPOVFUQACB', 'aperiam', NULL, NULL, NULL, NULL, NULL, NULL, '8ZCTE14Y3O7FSDX2', 'Maggio-Okuneva', 1, 'tersedia', 'studio1', 'Blanditiis laboriosam consequatur atque esse dolorem nam.', '2026-03-11 20:21:14_qr.png', 3, 5, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(2, 'xdYUGrDVdPCa3JRE', 'IJ7RSN4PXVY3', 'vitae', NULL, NULL, NULL, NULL, NULL, NULL, 'BECAG3KTO8UHF7RZ', 'Hartmann Ltd', 2, 'tersedia', 'studio1', 'Delectus odit reprehenderit nulla et debitis saepe.', '2026-03-11 20:21:14_qr.png', 4, 4, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(3, '0nKlxUQ7clbLNJ16', '5QAYVXSCZTB1', 'officia', NULL, NULL, NULL, NULL, NULL, NULL, 'TZS7IDQXU0RWGF1E', 'Kemmer-Gutmann', 7, 'tersedia', 'studio1', 'Assumenda quia animi eligendi numquam.', '2026-03-11 20:21:14_qr.png', 1, 4, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(4, 'kWhmHmvrV8WaqdxG', 'Q9OU5SC387NR', 'incidunt', NULL, NULL, NULL, NULL, NULL, NULL, 'DOFJZ3PLE841R2CK', 'Sawayn, Schmidt and Ziemann', 2, 'tersedia', 'studio1', 'Excepturi eveniet consectetur esse praesentium.', '2026-03-11 20:21:14_qr.png', 3, 3, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(5, 'Rps5yEIqzsDxGYDj', 'YZ5COBVPKX9H', 'qui', NULL, NULL, NULL, NULL, NULL, NULL, 'FNBOUEGDIAPR2J3T', 'Brown, Kris and Lueilwitz', 4, 'tersedia', 'studio1', 'Eaque qui perspiciatis itaque aut aut asperiores.', '2026-03-11 20:21:14_qr.png', 4, 3, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(6, 'lHmSg6IRfkcQNnXQ', 'VSC9TIOU56A3', 'inventore', NULL, NULL, NULL, NULL, NULL, NULL, 'WCJZBMTH3LVPY4GF', 'Robel, Kunde and Schmeler', 6, 'tersedia', 'studio1', 'Eos facere est quaerat qui est neque dolor.', '2026-03-11 20:21:14_qr.png', 5, 5, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(7, 'WtL8BvxBuDfhA3EC', '47CSN1Z692DP', 'nostrum', NULL, NULL, NULL, NULL, NULL, NULL, '1YWL0GRTZQU7N9DA', 'McLaughlin, Lindgren and Bernier', 7, 'tersedia', 'studio1', 'Dicta nesciunt aliquid ratione nobis.', '2026-03-11 20:21:14_qr.png', 3, 1, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(8, 'rizfgkFoJReYFc3p', 'WY32R7ADKFU5', 'qui', NULL, NULL, NULL, NULL, NULL, NULL, 'T58YXIUAKQZ3VNFD', 'Price Inc', 5, 'tersedia', 'studio1', 'Officiis ut incidunt quo voluptas quia repellat.', '2026-03-11 20:21:14_qr.png', 2, 5, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(9, 'KdJvK7ZMkHtFXM7S', 'CG8N1EMSR9ZA', 'accusantium', NULL, NULL, NULL, NULL, NULL, NULL, 'G685RK9ZJY0SFHCW', 'Effertz-Steuber', 10, 'tersedia', 'studio1', 'Fuga ex dolore et voluptas aut.', '2026-03-11 20:21:14_qr.png', 4, 2, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(10, 'MyvLlzAoGKePhE2A', '9O0TXJBU43CQ', 'ea', NULL, NULL, NULL, NULL, NULL, NULL, 'X28ZIYO0JHW3VP6U', 'Koss-Walsh', 6, 'tersedia', 'studio1', 'Voluptas tenetur ad sunt facere ad optio.', '2026-03-11 20:21:14_qr.png', 3, 5, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(11, 'NsdKrubvw4V2oKXI', 'IFBWR7Q1XK3V', 'quia', NULL, NULL, NULL, NULL, NULL, NULL, 'RF3VGY7WXZUHAKTQ', 'Dach, Hammes and Abshire', 9, 'tersedia', 'studio1', 'Ex ex aut sint aut et.', '2026-03-11 20:21:14_qr.png', 1, 4, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(12, 'MncGeF6n56iMrg5L', '6O5K1T3FGLJZ', 'beatae', NULL, NULL, NULL, NULL, NULL, NULL, 'WQGI6Y7HDA29BUXO', 'Robel PLC', 4, 'tersedia', 'studio1', 'Id voluptate et aut veniam ut.', '2026-03-11 20:21:14_qr.png', 5, 4, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(13, 'F0VTgXzygofoBEMb', 'FE89CQHS7KNO', 'quis', NULL, NULL, NULL, NULL, NULL, NULL, '93Y52N8GSBEAZT4M', 'Von, Jast and Shanahan', 2, 'tersedia', 'studio1', 'Incidunt ea deserunt voluptatem magni enim id.', '2026-03-11 20:21:14_qr.png', 5, 4, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(14, '7oODw7qz4eWUU2An', 'A4ZSOWT95LVK', 'deserunt', NULL, NULL, NULL, NULL, NULL, NULL, '6K91E04MP2VJSHAU', 'Gulgowski and Sons', 10, 'tersedia', 'studio1', 'Sed dicta et doloremque voluptate.', '2026-03-11 20:21:14_qr.png', 2, 2, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(15, '1kvLqoTJ413gSFte', '12AGD7Y9NW6X', 'doloribus', NULL, NULL, NULL, NULL, NULL, NULL, 'TUCDLAFNYJWS6Z0I', 'Barrows-Bernhard', 2, 'tersedia', 'studio1', 'Libero eveniet voluptas laborum maiores qui ea.', '2026-03-11 20:21:14_qr.png', 3, 1, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(16, 'r2OwDmLqGD7p1zf4', '1CMQVG4PBU3I', 'omnis', NULL, NULL, NULL, NULL, NULL, NULL, 'QZPA8K21WHXM9V5Y', 'Flatley, Gutmann and Turcotte', 2, 'tersedia', 'studio1', 'Nemo dolores a optio sunt officiis cum unde sed.', '2026-03-11 20:21:14_qr.png', 3, 2, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(17, 'Yv5gmPfyTQIdxpnX', 'MT63NZBOKSPE', 'aut', NULL, NULL, NULL, NULL, NULL, NULL, 'XB9LSJ0ZWC3DGA15', 'Muller-O\'Conner', 6, 'tersedia', 'studio1', 'Ut qui est consequuntur quisquam nisi dolorem.', '2026-03-11 20:21:14_qr.png', 4, 2, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(18, 'K0rejXHSaQMitZIS', 'I4VSA7R5L61Y', 'qui', NULL, NULL, NULL, NULL, NULL, NULL, 'NCXEW6Q1KVDTZ9OM', 'Kovacek, Kertzmann and Ryan', 1, 'tersedia', 'studio1', 'Doloribus molestias et placeat voluptatum voluptate maxime est est.', '2026-03-11 20:21:14_qr.png', 2, 3, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(19, 'chMQTh2adHg8iSrO', 'WV6C2Q7RBJ4N', 'deleniti', NULL, NULL, NULL, NULL, NULL, NULL, 'SIU9Z7QHXRV0O1P3', 'Klein, Blanda and Jacobi', 9, 'tersedia', 'studio1', 'Sed impedit iusto id repudiandae.', '2026-03-11 20:21:14_qr.png', 4, 2, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(20, 'VgjK64iKNvpr8vi4', 'Z95O468RF0U1', 'soluta', NULL, NULL, NULL, NULL, NULL, NULL, 'Z8OKQW5L6RDICVXE', 'Kris-O\'Kon', 6, 'tersedia', 'studio1', 'Autem eos non quasi.', '2026-03-11 20:21:14_qr.png', 1, 1, 'default.jpg', '2026-03-11 12:21:14', '2026-03-11 12:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `bmn_barangs`
--

CREATE TABLE `bmn_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nup` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `nomor_seri` varchar(255) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `persentase_kondisi` int(11) DEFAULT NULL,
  `nilai_perolehan` decimal(15,2) DEFAULT NULL,
  `tanggal_perolehan` date DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `unit_kerja` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `ruangan` varchar(255) NOT NULL,
  `pengguna_id` char(36) DEFAULT NULL,
  `posisi` varchar(255) DEFAULT NULL,
  `asal_pengadaan` varchar(255) DEFAULT NULL,
  `peruntukan` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bmn_barangs`
--

INSERT INTO `bmn_barangs` (`id`, `uuid`, `kode_barang`, `nup`, `nama_barang`, `kategori`, `merk`, `nomor_seri`, `jumlah`, `persentase_kondisi`, `nilai_perolehan`, `tanggal_perolehan`, `kondisi`, `unit_kerja`, `foto`, `ruangan`, `pengguna_id`, `posisi`, `asal_pengadaan`, `peruntukan`, `catatan`, `qr_code`, `created_at`, `updated_at`) VALUES
(4, 'fbce0c8a-2c51-48f6-b15e-34aff4bde921', 'BRG-2026-0004', '1', 'Kursi Kayu', 'Kursi', 'Karsuari', NULL, 4, 60, 900000.00, '2012-03-10', 'Kurang Baik', 'Umum', 'bmn/foto/1773261083_barang.jpg', 'Lobby', NULL, 'bmn/posisi/1773261083_posisi.jpg', 'APBN', NULL, NULL, 'bmn/qrcode/qr_BRG-2026-0004.png', '2026-03-11 12:31:24', '2026-03-11 12:31:24'),
(6, '9ed33e7e-4311-4c28-81f6-0e5e0591a5dc', 'BRG-2026-0006', '1', 'Mixer', 'Mixer', 'Ashley', NULL, 3, 69, 2400000.00, '2015-03-02', 'Kurang Baik', 'Teknik', 'bmn/foto/1773261268_barang.jpg', 'Mahmud', NULL, 'bmn/posisi/1773261268_posisi.jpg', 'APBN', NULL, NULL, 'bmn/qrcode/qr_BRG-2026-0006.png', '2026-03-11 12:34:29', '2026-03-11 12:34:29'),
(13, '9adb5de6-bef0-4457-a78d-e4b835feacb9', 'BRG-2026-0012', '1', 'AC Berdiri', 'AC', 'Daikin', NULL, 1, 90, 4000000.00, '2023-12-14', 'Sangat Baik', 'Umum', 'bmn/foto/1776172515_barang.jpg', 'Lobby', NULL, 'bmn/posisi/1776172515_posisi.jpg', 'APBN', NULL, NULL, 'bmn/qrcode/qr_BRG-2026-0012.png', '2026-04-14 13:15:15', '2026-04-14 13:15:15'),
(19, 'a991d98a-5cc0-4fab-8178-239fb943e83b', 'BRG-2026-0018', '1', 'AC Sharp', 'AC', 'Sharp', NULL, 4, 79, 1500000.00, '2025-03-03', 'Baik', 'Teknik', 'bmn/foto/1776178581_barang.jpg', 'Ruang Rapat', NULL, 'bmn/posisi/1776178581_posisi.jpeg', 'APBN', NULL, NULL, 'bmn/qrcode/qr_BRG-2026-0018.png', '2026-04-14 14:56:21', '2026-08-09 04:26:21'),
(22, '969d4fc9-d669-4c0e-b2ac-3ed7b94b691a', 'BRG-2026-0021', '0005', 'AC PANASONIC CS-YN9TKJ', 'AC', 'Panasonic', NULL, 5, 80, 3800000.00, '2026-03-29', 'Baik', 'Teknik', 'bmn/foto/1776201577_barang.jpg', 'MCR', NULL, 'bmn/posisi/1776201577_posisi.jpg', 'APBN', NULL, 'barang baru dan standby', 'bmn/qrcode/qr_BRG-2026-0021.png', '2026-04-14 21:19:37', '2026-04-14 21:19:37'),
(29, 'cbf90b9b-33ce-4ee1-b2bf-49a9550e2949', '3050204004BRT1-1', '83', 'A.C Split', 'MESIN PERALATAN NON TIK', 'SHARP 2PK JETSTREM', NULL, 1, 80, 6985000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788157988_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788411657_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004BRT1-1.png', '2026-08-20 06:05:45', '2026-09-03 05:00:57'),
(32, '345864b3-c2c5-40f7-81fe-d34a5f153ada', '3060101056BRT1-1', '10', 'Battery Charger (Peralatan Studio Audio)', 'MESIN PERALATAN NON TIK', 'CHARGER SONY', NULL, 1, 80, 4030000.00, '2016-10-21', 'Baik', 'Berita', 'bmn/foto/1788412606_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788412606_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060101056BRT1-1.png', '2026-08-28 06:39:35', '2026-09-03 05:18:05'),
(33, '65109523-b157-42b6-8522-449b7a481f5b', '3060102128BRT1-1', '5', 'Camera Digital', 'MESIN PERALATAN NON TIK', 'KAMERA DSLR CANON/EOS 6D/38024000818', NULL, 1, 80, 25000000.00, '2014-05-12', 'Baik', 'Berita', 'bmn/foto/1788413110_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788413110_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102128BRT1-1.png', '2026-08-28 06:43:57', '2026-09-03 05:25:10'),
(35, '2ca1b557-248f-4f01-b577-371e841d5b65', '3060102003BRT1-1', '35', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'SONY/Type DCR-SX33E/SX34E', NULL, 1, 80, 12650000.00, '2020-05-14', 'Baik', 'Berita', 'bmn/foto/1788413569_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788413569_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-1.png', '2026-08-31 06:37:40', '2026-09-03 05:32:49'),
(36, '609a0cf1-c4f3-4982-b09a-6de334604e7e', '3100203017BRT1-1', '21', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788418920_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788418920_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-1.png', '2026-08-31 06:40:22', '2026-09-03 07:02:00'),
(37, '678f6014-5bd3-49de-b87d-49401636beac', '3050104005BRT1-1', '30', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'KRISBOW (BERITA), INFORMA (KEUANGAN/BMN/ATK)', NULL, 1, 80, 2850000.00, '2024-10-03', 'Baik', 'Berita', 'bmn/foto/1789974264_barang.jpg', 'Berita', NULL, 'bmn/posisi/1789974264_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005BRT1-1.png', '2026-08-31 06:58:48', '2026-09-21 07:04:24'),
(39, '21d35b49-2fb2-4267-9dc4-1d9edddcc880', '3050204004BRT1-2', '84', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'SHARP 2PK JETSTREM', NULL, 1, 80, 6985000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788411803_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788411803_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004BRT1-2.png', '2026-09-03 05:03:23', '2026-09-03 05:03:23'),
(40, '7a5482a4-7b45-4a46-98cc-91a3ea7a982f', '3050204004BRT1-3', '109', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'PANASONIC GN19WKJ', NULL, 1, 80, 8750000.00, '2021-12-10', 'Baik', 'Berita', 'bmn/foto/1788412045_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788412045_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004BRT1-3.png', '2026-09-03 05:07:25', '2026-09-03 05:07:25'),
(41, '3b0bd754-f4c4-42c8-b464-7bc8e0af9bd5', '3050204004BRT1-4', '120', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'SHARP AH-X18ZY / 2PK INVERTER', NULL, 1, 80, 8991000.00, '2023-12-01', 'Baik', 'Berita', 'bmn/foto/1788412259_barang.png', 'Berita', NULL, 'bmn/posisi/1788412259_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004BRT1-4.png', '2026-09-03 05:10:59', '2026-09-03 05:14:55'),
(42, '2979c8ec-2558-45f8-8e7d-54462fdb5867', '3050204004BRT1-5', '121', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'SHARP AH-A9ZCY / 1 PK', NULL, 1, 80, 4440000.00, '2023-12-01', 'Baik', 'Berita', 'bmn/foto/1788412460_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788412460_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004BRT1-5.png', '2026-09-03 05:14:20', '2026-09-03 05:14:20'),
(43, 'd604905c-dc30-46db-831d-2bb98ddd1535', '3060101056BRT1-2', '11', 'Battery Charger (Peralatan Studio Audio)', 'MESIN PERALATAN NON TIK', 'CHARGER SONY', NULL, 1, 80, 4030000.00, '2016-10-21', 'Baik', 'Berita', 'bmn/foto/1788412780_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788412780_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060101056BRT1-2.png', '2026-09-03 05:19:40', '2026-09-03 05:19:40'),
(44, '12053515-cdea-45fb-9d7c-a07bb94aafcb', '3050201003KMB1-1', '378', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'KMB', 'bmn/foto/1788414864_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KMB1-1.png', '2026-09-03 05:23:28', '2026-09-03 05:54:24'),
(45, '39043f06-eb12-4b49-aa39-ab54965f01f7', '3050201003KMB1-2', '379', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'KMB', 'bmn/foto/1788414876_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KMB1-2.png', '2026-09-03 05:27:04', '2026-09-03 05:54:36'),
(46, '6a9ffbab-613e-44b4-88cd-b432c0934269', '3060102128BRT1-2', '8', 'Camera Digital', 'MESIN PERALATAN NON TIK', 'KAMERA GO PRO HERO 3', NULL, 1, 80, 5489000.00, '2026-09-03', 'Baik', 'Berita', 'bmn/foto/1788413278_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788413278_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102128BRT1-2.png', '2026-09-03 05:27:58', '2026-09-03 05:27:58'),
(47, 'b415f5f4-f989-44a3-8a71-478e0481d27d', '3050201003KMB1-3', '385', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2026-09-26', 'Baik', 'KMB', 'bmn/foto/1788414889_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KMB1-3.png', '2026-09-03 05:29:30', '2026-09-03 05:54:49'),
(48, 'd8cfabb1-3f3d-4e15-9e83-99d26639fc56', '3050201003KMB1-4', '387', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'KMB', 'bmn/foto/1788414899_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KMB1-4.png', '2026-09-03 05:32:17', '2026-09-03 05:54:59'),
(49, '15e5ec81-4979-4fff-83c4-cb3c5059c8ac', '3050201003KMB1-5', '388', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'KMB', 'bmn/foto/1788414912_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KMB1-5.png', '2026-09-03 05:35:44', '2026-09-03 05:55:12'),
(50, '95a406cd-b032-4e41-afce-6b27c8307d7f', '3050201003KMB1-6', '390', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'KMB', 'bmn/foto/1788414927_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KMB1-6.png', '2026-09-03 05:36:51', '2026-09-03 05:55:27'),
(51, '79d5e4e1-8a08-4785-b7a3-861c4677a9d7', '3060102003BRT1-2', '57', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'CAMCORDER/CAMERA SONY PXW-X70', NULL, 1, 80, 26400000.00, '2020-12-02', 'Baik', 'Berita', 'bmn/foto/1788413892_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788413892_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-2.png', '2026-09-03 05:37:06', '2026-09-03 05:38:12'),
(52, 'b8e03539-d11f-47df-bb90-9fbf43386d9a', '3050201003KMB1-7', '391', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'KMB', 'bmn/foto/1788414940_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KMB1-7.png', '2026-09-03 05:37:45', '2026-09-03 05:55:40'),
(53, '62d1bda0-2245-4e6e-83de-40dcd82d1c0e', '3050201003KMB1-8', '392', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'KMB', 'bmn/foto/1788414954_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KMB1-8.png', '2026-09-03 05:39:37', '2026-09-03 05:55:54'),
(54, '22fb8280-b06b-4cb1-a85f-46f953f3c522', '3060102003BRT1-3', '58', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'CAMCORDER/CAMERA SONY PXW-X70', NULL, 1, 80, 26400000.00, '2020-12-02', 'Baik', 'Berita', 'bmn/foto/1788413997_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788413997_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-3.png', '2026-09-03 05:39:57', '2026-09-03 05:39:57'),
(55, 'fc21549b-131d-4c71-9e29-bb7647a8d2ba', '3100102002KMB1-1', '69', 'Lap top', 'MESIN PERALATAN KHUSUS TIK', 'APPLE MACBOOK AIR M 13 MA', NULL, 1, 80, 16330000.00, '2025-09-19', 'Baik', 'KMB', 'bmn/foto/1788414844_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KMB1-1.png', '2026-09-03 05:44:39', '2026-09-03 05:54:04'),
(56, 'b9d7d622-c3fc-4fdd-b665-03dacc4b6b2a', '3100102002KMB1-2', '78', 'Lap top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS TUF F15 FX506 9INCLUDE ADOBE CREATIVE CLOUDS & MAGICSOFT CG HD)', NULL, 1, 80, 82244550.00, '2023-12-29', 'Baik', 'KMB', 'bmn/foto/1788414685_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KMB1-2.png', '2026-09-03 05:46:09', '2026-09-03 05:51:25'),
(57, 'ec7e744a-d2ab-4dd1-a30f-b62349edd27e', '3060102003BRT1-4', '60', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'PANASONIC AG-UX90', NULL, 1, 80, 34500000.00, '2026-09-03', 'Baik', 'Berita', 'bmn/foto/1788414437_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788414437_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-4.png', '2026-09-03 05:47:17', '2026-09-03 05:47:17'),
(58, 'b0070dee-7dba-4736-aded-1fc8e9074050', '3100102002KMB1-3', '80', 'Lap top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS TUF F15 FX506HEB (VMIX PRO) ASUS TUF F15 FX506HEB (VMIX PRO)', NULL, 1, 80, 56254500.00, '2023-12-29', 'Baik', 'KMB', 'bmn/foto/1788415161_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KMB1-3.png', '2026-09-03 05:59:21', '2026-09-03 05:59:21'),
(59, '493bdf8f-6203-4a34-ada9-4f1a0b9fbb85', '3060102003BRT1-5', '61', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'PANASONIC AG-UX90', NULL, 1, 80, 34500000.00, '2022-09-20', 'Baik', 'Berita', 'bmn/foto/1788415239_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788415240_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-5.png', '2026-09-03 06:00:40', '2026-09-03 06:00:40'),
(60, 'cebe91a0-f864-43d1-8ff5-a047e6be836b', '3100102002KMB1-4', '81', 'Lap top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS TUF F15 FX506HEB (VMIX PRO) ASUS TUF F15 FX506HEB (VMIX PRO)', NULL, 1, 80, 56254500.00, '2023-12-29', 'Baik', 'KMB', 'bmn/foto/1788415249_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KMB1-4.png', '2026-09-03 06:00:50', '2026-09-03 06:00:50'),
(61, '97593d1d-33e7-4b3d-ab8a-aff2be0c426b', '3060102003BRT1-6', '71', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'CANON LEGRIA HF G70', NULL, 1, 80, 19975000.00, '2025-08-06', 'Baik', 'Berita', 'bmn/foto/1788415343_barang.png', 'Berita', NULL, 'bmn/posisi/1788415343_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-6.png', '2026-09-03 06:02:23', '2026-09-03 06:02:23'),
(62, '1e60087e-6037-495a-b987-6d9111c016fb', '3050104015KMB1-1', '19', 'Locker', 'MESIN PERALATAN NON TIK', 'IINFORMA KIEV LOKER BESI MULTI 9 PINTU', NULL, 1, 80, 2328000.00, '2025-12-15', 'Baik', 'KMB', 'bmn/foto/1788415393_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104015KMB1-1.png', '2026-09-03 06:03:13', '2026-09-03 06:03:13'),
(63, 'd86425ec-6a16-4ad3-a2b5-d263fe01643e', '3060102003BRT1-7', '72', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'KAMERA VIDEO ENG / CANON LEGRIA HF G70', NULL, 1, 80, 19992000.00, '2025-08-11', 'Baik', 'Berita', 'bmn/foto/1788415468_barang.png', 'Berita', NULL, 'bmn/posisi/1788415468_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-7.png', '2026-09-03 06:04:28', '2026-09-03 06:04:28'),
(64, 'e530422f-ace6-4e6c-b439-63abd683dd11', '3050201001KMB1-1', '3', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA/MEJA KERJA STAF', NULL, 1, 80, 3000000.00, '2021-05-27', 'Baik', 'KMB', 'bmn/foto/1788415727_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001KMB1-1.png', '2026-09-03 06:08:47', '2026-09-03 06:08:47'),
(65, 'bab7df9c-fe5d-49ff-99e1-2f25ad955dbb', '3050201001KMB1-2', '12', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA / TYPE KAYU KOMBINASI BESI METAL', NULL, 1, 80, 1827000.00, '2026-02-14', 'Baik', 'KMB', 'bmn/foto/1788415915_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001KMB1-2.png', '2026-09-03 06:11:55', '2026-09-03 06:11:55'),
(66, '09aa0ac4-fcaf-4aac-8fbc-f33132dda256', '3050201001KMB1-3', '13', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA / TYPE KAYU KOMBINASI BESI METAL', NULL, 1, 80, 1827000.00, '2026-02-14', 'Baik', 'KMB', 'bmn/foto/1788415964_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001KMB1-3.png', '2026-09-03 06:12:44', '2026-09-03 06:12:44'),
(67, '42c48b26-9204-469c-b279-87f7b3dadf09', '3050201001KMB1-4', '15', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'MEJA KERJA INFORMA 2 LACI', NULL, 1, 80, 2414000.00, '2026-05-26', 'Baik', 'KMB', 'bmn/foto/1788416016_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001KMB1-4.png', '2026-09-03 06:13:36', '2026-09-03 06:15:51'),
(68, '0c6e6d2b-464b-425a-ace4-9b71ccbeef16', '3050201002KMB1-1', '152', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA GUINI MEJA KANTOR', NULL, 1, 80, 1717000.00, '2025-08-27', 'Baik', 'KMB', 'bmn/foto/1788416241_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KMB1-1.png', '2026-09-03 06:17:21', '2026-09-03 06:17:21'),
(69, 'c1e37764-2950-4dc6-9276-2a2aaff58c82', '3050201002KMB1-2', '156', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA GUINI MEJA KANTOR', NULL, 1, 80, 1717000.00, '2025-08-27', 'Baik', 'KMB', 'bmn/foto/1788416299_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KMB1-2.png', '2026-09-03 06:18:19', '2026-09-03 06:18:19'),
(70, '0c372dda-5967-4a6c-be49-e947114c27bc', '3050201002KMB1-3', '102', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'KMB', 'bmn/foto/1788416456_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KMB1-3.png', '2026-09-03 06:20:56', '2026-09-03 06:20:56'),
(71, 'a9032a98-5167-41eb-875f-f1ee04533885', '3050201002KMB1-4', '100', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3474999.00, '2022-06-28', 'Baik', 'KMB', 'bmn/foto/1788416508_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KMB1-4.png', '2026-09-03 06:21:48', '2026-09-03 06:21:48'),
(72, 'd4b284e2-6185-47c6-abe9-7692e6267152', '3050201002KMB1-5', '144', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'KMB', 'bmn/foto/1788416629_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KMB1-5.png', '2026-09-03 06:23:21', '2026-09-03 06:23:49'),
(73, 'ab38729f-5a6a-4a5a-a939-ce7632c85b2b', '3100102001KMB1-1', '74', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC EDITING / INTEL CORE i9-14900 / MONITOR AOC 24g4g', NULL, 1, 80, 32900000.00, '2024-12-05', 'Baik', 'KMB', 'bmn/foto/1788416839_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001KMB1-1.png', '2026-09-03 06:27:20', '2026-09-03 06:27:20'),
(74, 'b001c9af-9745-4b95-8716-b4f03a39bedb', '3100102001KMB1-2', '90', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B385OW', NULL, 1, 80, 9450000.00, '2025-08-15', 'Baik', 'KMB', 'bmn/foto/1788417006_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001KMB1-2.png', '2026-09-03 06:30:06', '2026-09-03 06:30:06'),
(75, '25da2996-e5ee-4f72-9bef-f012f710461f', '3100102001KMB1-3', '102', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'KOMPUTER EDITING / INTEL CORE i7 14700 / MONITOR XIAOMI', NULL, 1, 80, 43600000.00, '2025-11-07', 'Baik', 'KMB', 'bmn/foto/1788417203_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001KMB1-3.png', '2026-09-03 06:33:23', '2026-09-03 06:33:23'),
(76, '31fc886c-21f7-4d65-84ce-1a85c8dcbf50', '3100203003KMB1-1', '114', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L-3210', NULL, 1, 80, 2155000.00, '2026-02-09', 'Baik', 'KMB', 'bmn/foto/1788417323_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003KMB1-1.png', '2026-09-03 06:35:23', '2026-09-03 06:35:23'),
(77, '59830ef1-ab07-49a8-942b-61dd33ae04b2', '3050201005KMB1-1', '59', 'Sice', 'MESIN PERALATAN NON TIK', 'Kursi Minimalis', NULL, 1, 80, 2950000.00, '2014-11-26', 'Baik', 'KMB', 'bmn/foto/1788417718_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201005KMB1-1.png', '2026-09-03 06:41:58', '2026-09-03 06:41:58'),
(78, 'ef09c949-fe77-4b1a-8356-6cd57b9fddb7', '3060201004KMB1-1', '8', 'Telephone Mobile', 'MESIN PERALATAN NON TIK', 'HP OPPO RENO 7', NULL, 1, 80, 7000000.00, '2022-08-09', 'Baik', 'KMB', 'bmn/foto/1788418060_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060201004KMB1-1.png', '2026-09-03 06:47:40', '2026-09-03 06:47:40'),
(79, '15dd83ca-1197-4daa-a7bb-5fee38685689', '3060201004KMB1-2', '11', 'Telephone Mobile', 'MESIN PERALATAN NON TIK', 'IPHONE 13 128GB', NULL, 1, 80, 13597000.00, '2024-02-21', 'Baik', 'KMB', 'bmn/foto/1788418227_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060201004KMB1-2.png', '2026-09-03 06:50:27', '2026-09-03 06:50:27'),
(80, 'a5dcd88d-3141-444a-b6b3-1dbd50d56a4d', '3060102003BRT1-8', '73', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'CAMERA VIDEO ENG CANON LEGRIA HF G70', NULL, 1, 80, 19992000.00, '2025-09-02', 'Baik', 'Berita', 'bmn/foto/1788418337_barang.png', 'Berita', NULL, 'bmn/posisi/1788418337_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-8.png', '2026-09-03 06:52:17', '2026-09-03 06:52:17'),
(81, '2a1ae309-49da-4777-babd-78756fea229b', '3060102003BRT1-9', '74', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'CANON LEGRIA HF G70', NULL, 1, 80, 19975000.00, '2025-09-11', 'Baik', 'Berita', 'bmn/foto/1788418395_barang.png', 'Berita', NULL, 'bmn/posisi/1788418395_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-9.png', '2026-09-03 06:53:15', '2026-09-03 06:53:15'),
(82, '6f20bbc2-eb25-4344-8f53-019ff7bb7b2d', '3060201004KMB1-3', '17', 'Telephone Mobile', 'MESIN PERALATAN NON TIK', 'IPHONE 16 PRO MAX 512 GB', NULL, 1, 80, 28048980.00, '2025-09-25', 'Baik', 'KMB', 'bmn/foto/1788418425_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060201004KMB1-3.png', '2026-09-03 06:53:45', '2026-09-03 06:53:45'),
(83, 'e3ad645f-9f47-4b08-a22c-cc4764820d19', '3100102009KMB1-1', '27', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET XIAOMI REDMI PAD 2', NULL, 1, 80, 3780500.00, '2025-11-07', 'Baik', 'KMB', 'bmn/foto/1788418487_barang.jpg', 'KMB', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009KMB1-1.png', '2026-09-03 06:54:47', '2026-09-03 06:54:47'),
(84, '3c498435-e3bd-4aa9-bea4-6d3202a5edb1', '3060102003BRT1-10', '75', 'Camera Electronic', 'MESIN PERALATAN NON TIK', 'CANON LEGRIA HF G70', NULL, 1, 80, 19975000.00, '2025-09-18', 'Baik', 'Berita', 'bmn/foto/1788418523_barang.png', 'Berita', NULL, 'bmn/posisi/1788418524_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102003BRT1-10.png', '2026-09-03 06:55:24', '2026-09-03 06:55:24'),
(85, '3d5b1539-a824-466c-aab0-264390355c3b', '3100203017BRT1-2', '22', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788418998_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788418998_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-2.png', '2026-09-03 07:03:18', '2026-09-03 07:03:18'),
(86, '6fda45e7-30de-4c5b-aaec-6ce088f85955', '3100203017BRT1-3', '23', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788420112_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788420112_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-3.png', '2026-09-03 07:21:52', '2026-09-03 07:21:52'),
(87, '53ca2422-9a13-4186-bdcf-a013cb332053', '3100203017BRT1-4', '25', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788420166_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788420166_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-4.png', '2026-09-03 07:22:47', '2026-09-04 06:30:43'),
(88, '8a8a7f79-f351-4f43-8dca-5ed45615ba73', '3050204004KEU1-1', '116', 'A.C Split', 'MESIN PERALATAN NON TIK', 'SHARP 1,5PK', NULL, 1, 80, 7500000.00, '2023-05-04', 'Baik', 'Keuangan', 'bmn/foto/1788479246_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004KEU1-1.png', '2026-09-03 23:47:26', '2026-09-03 23:47:26'),
(89, '6e3e280b-a69e-44fd-86be-437ce17a91ef', '3050204004KEU1-2', '122', 'A.C Split', 'MESIN PERALATAN NON TIK', 'LG 2PK / H18TN4', NULL, 1, 80, 7421000.00, '2024-02-21', 'Baik', 'Keuangan', 'bmn/foto/1788479561_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004KEU1-2.png', '2026-09-03 23:52:42', '2026-09-03 23:52:42'),
(90, '8be4b9ac-e203-48e3-bfc4-8af10a40e99f', '3100203017KEU1-1', '76', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Keuangan', 'bmn/foto/1788490383_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017KEU1-1.png', '2026-09-04 02:53:03', '2026-09-04 02:53:03'),
(91, 'fac109f1-f2b0-4969-a041-5a37c36315ea', '3050104005KEU1-1', '23', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA / 4 DOOR DRAWER', NULL, 1, 80, 2721000.00, '2024-02-26', 'Baik', 'Keuangan', 'bmn/foto/1788490609_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-1.png', '2026-09-04 02:56:49', '2026-09-04 02:56:49'),
(92, 'b5c49e2b-6957-41f1-a720-3a73ad79228f', '3050104005KEU1-2', '24', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA / 4 DOOR DRAWER', NULL, 1, 80, 2721000.00, '2024-02-26', 'Baik', 'Keuangan', 'bmn/foto/1788490694_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-2.png', '2026-09-04 02:58:14', '2026-09-04 02:58:14'),
(93, '18ec237e-0079-4051-8beb-e2d07bb8dc72', '3050104005KEU1-3', '25', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 LACI', NULL, 1, 80, 3350000.00, '2024-10-28', 'Baik', 'Keuangan', 'bmn/foto/1788490908_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-3.png', '2026-09-04 03:01:48', '2026-09-04 03:01:48'),
(94, 'a9ccf52b-37c4-4dc6-b827-d104f3f754a2', '3050104005KEU1-4', '26', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'KRISBOW (BERITA), INFORMA (KEUANGAN/BMN/ATK)', NULL, 1, 80, 2850000.00, '2024-10-03', 'Baik', 'Keuangan', 'bmn/foto/1788490967_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-4.png', '2026-09-04 03:02:47', '2026-09-04 03:02:47'),
(95, 'd7f85b9d-25ab-4b16-915c-40de63b21935', '3050104005KEU1-5', '27', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'KRISBOW (BERITA), INFORMA (KEUANGAN/BMN/ATK)', NULL, 1, 80, 2850000.00, '2024-10-03', 'Baik', 'Keuangan', 'bmn/foto/1788491016_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-5.png', '2026-09-04 03:03:36', '2026-09-04 03:03:36'),
(96, '45b2752f-76d7-4fed-9286-2f5a42c03b0c', '3050104005KEU1-6', '31', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 LACI', NULL, 1, 80, 3455000.00, '2025-08-11', 'Baik', 'Keuangan', 'bmn/foto/1788491079_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-6.png', '2026-09-04 03:04:39', '2026-09-04 03:07:20'),
(97, 'e8d5f9d6-defd-48cb-ad9f-aafdc43498c9', '3050104005KEU1-7', '32', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 LACI', NULL, 1, 80, 3455000.00, '2025-08-11', 'Baik', 'Keuangan', 'bmn/foto/1788491133_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-7.png', '2026-09-04 03:05:34', '2026-09-04 03:07:01'),
(98, '96f17a20-f844-406a-8641-bccc3b8e90a8', '3050104005KEU1-8', '33', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 LACI', NULL, 1, 80, 3455000.00, '2025-08-11', 'Baik', 'Keuangan', 'bmn/foto/1788491199_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-8.png', '2026-09-04 03:06:39', '2026-09-04 03:06:39'),
(99, 'a4ca2cbe-a37d-408c-a623-ea82cda8d13a', '3050104005KEU1-9', '34', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 LACI', NULL, 1, 80, 3455000.00, '2025-08-11', 'Baik', 'Keuangan', 'bmn/foto/1788491341_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-9.png', '2026-09-04 03:09:01', '2026-09-04 03:09:01'),
(100, '459b5568-5f6d-48fe-93e8-7caad140fb09', '3050104005KEU1-10', '35', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 DRAWER WHITE', NULL, 1, 80, 2133030.00, '2026-02-23', 'Baik', 'Keuangan', 'bmn/foto/1788502465_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-10.png', '2026-09-04 03:13:22', '2026-09-04 06:14:25'),
(101, 'b41abf9c-c91a-4f2a-8118-f17faec865b3', '3050104005KEU1-11', '36', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 DRAWER WHITE', NULL, 1, 80, 2133030.00, '2026-02-23', 'Baik', 'Keuangan', 'bmn/foto/1788491768_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-11.png', '2026-09-04 03:16:08', '2026-09-04 03:16:08'),
(102, 'a4b2022d-ccb0-4470-831c-8dff391158a8', '3050104005KEU1-12', '37', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 DRAWER WHITE', NULL, 1, 80, 2133030.00, '2026-02-23', 'Baik', 'Keuangan', 'bmn/foto/1788502573_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-12.png', '2026-09-04 06:16:13', '2026-09-04 06:16:13'),
(103, '798707a9-f9c7-4b0a-9e32-a23af5401812', '3100203017BRT1-5', '26', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788502721_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788502721_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-5.png', '2026-09-04 06:18:41', '2026-09-04 06:30:28'),
(104, '6373e08d-a0f3-41aa-91be-936c2fde0b01', '3050104005KEU1-13', '38', 'Filing Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA 4 DRAWER WHITE', NULL, 1, 80, 2133030.00, '2026-02-23', 'Baik', 'Keuangan', 'bmn/foto/1788502860_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005KEU1-13.png', '2026-09-04 06:21:01', '2026-09-04 06:21:01'),
(105, '054739fb-2204-41aa-9271-b44f1b2f1f06', '3100203017BRT1-6', '27', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788503156_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788503156_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-6.png', '2026-09-04 06:23:35', '2026-09-04 06:30:16'),
(106, '17085c51-e5c5-4f74-9b96-5eea1079cb89', '3100203017BRT1-7', '28', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-12-05', 'Baik', 'Berita', 'bmn/foto/1788503258_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788503258_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-7.png', '2026-09-04 06:27:38', '2026-09-04 06:29:51'),
(107, '46f946b2-0fd4-4f66-9c63-6a54672940ea', '3100203017BRT1-8', '30', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788503559_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788503559_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-8.png', '2026-09-04 06:32:40', '2026-09-04 06:32:40'),
(108, '95740925-c9d9-47c6-8ce8-57496995376d', '3100203017BRT1-9', '31', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-02', 'Baik', 'Berita', 'bmn/foto/1788503640_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788503640_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-9.png', '2026-09-04 06:34:00', '2026-09-04 06:36:38'),
(109, '3d54cbd4-d375-40f7-9b00-3b1fef0c0944', '3100203017BRT1-10', '33', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-02', 'Baik', 'Berita', 'bmn/foto/1788503702_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788503702_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-10.png', '2026-09-04 06:35:02', '2026-09-04 06:35:02'),
(110, '587215f0-2d4f-4c44-bdc2-d2b800b5fa87', '3100203017BRT1-11', '34', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788503877_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788503877_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-11.png', '2026-09-04 06:36:14', '2026-09-04 06:37:57'),
(111, '085fa526-5bd7-49c4-b715-a69a86948567', '3100203017BRT1-12', '35', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788504003_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788504003_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-12.png', '2026-09-04 06:39:35', '2026-09-04 06:40:03'),
(112, 'b67eab55-3297-45cf-9717-2c751785527b', '3100203017BRT1-13', '36', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 2TB', NULL, 1, 80, 2285000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1788741621_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788504060_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-13.png', '2026-09-04 06:41:00', '2026-09-07 00:40:21'),
(113, 'de04c3cc-3632-4bed-b3a9-c789d700d87d', '3100203017BRT1-14', '40', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788504143_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788504143_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-14.png', '2026-09-04 06:42:23', '2026-09-04 06:42:23'),
(114, '7b48aa09-4107-4974-8b5b-284a9237e425', '3050201003KEU1-1', '286', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Keuangan', 'bmn/foto/1788504146_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-1.png', '2026-09-04 06:42:26', '2026-09-04 06:42:26'),
(115, '58c93df7-7fd4-4bbf-a8ef-d1da78cc2a99', '3100203017PU1-1', '38', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-29', 'Baik', 'PU', 'bmn/foto/1788504396_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PU1-1.png', '2026-09-04 06:46:36', '2026-09-04 06:46:36'),
(116, 'd7af6316-d522-4652-ad44-0e459836653c', '3050201003KEU1-2', '287', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Keuangan', 'bmn/foto/1788504399_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-2.png', '2026-09-04 06:46:39', '2026-09-04 06:46:39'),
(117, '95581485-46a6-48e9-9dcc-20dd67ed9abb', '3100203017PU1-2', '39', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-14', 'Baik', 'PU', 'bmn/foto/1788504735_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PU1-2.png', '2026-09-04 06:50:57', '2026-09-04 06:52:15'),
(118, 'c14c38c5-5bb6-4d8e-b911-771b9d040700', '3100203017PU1-3', '47', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'PU', 'bmn/foto/1788504709_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PU1-3.png', '2026-09-04 06:51:49', '2026-09-04 06:51:49'),
(119, '75201ecd-1c3c-4de7-80fb-59be8adff9e9', '3100203017PU1-4', '93', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1300000.00, '2019-04-24', 'Baik', 'PU', 'bmn/foto/1788504796_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PU1-4.png', '2026-09-04 06:53:16', '2026-09-04 06:53:16'),
(120, '04e18cf3-2e31-4ed6-8079-0e47431ccd54', '3050201003KEU1-3', '288', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Keuangan', 'bmn/foto/1788504835_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-3.png', '2026-09-04 06:53:55', '2026-09-04 06:53:55'),
(121, 'b0c38e08-636d-4901-8503-f41020d816a7', '3100203017PU1-5', '24', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'PU', 'bmn/foto/1788504883_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PU1-5.png', '2026-09-04 06:54:43', '2026-09-04 06:54:43'),
(122, '9b6871a0-4550-4a42-8ab1-381a410f4528', '3050201003KEU1-4', '290', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Keuangan', 'bmn/foto/1788505033_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-4.png', '2026-09-04 06:57:13', '2026-09-04 06:57:13'),
(123, 'b915e0ac-c880-403b-b7b2-dc3883e8f2e5', '3050201003KEU1-5', '305', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Keuangan', 'bmn/foto/1788505266_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-5.png', '2026-09-04 07:01:06', '2026-09-04 08:04:08'),
(124, '1561bcf4-fd81-49cf-b12d-7cde8d038fff', '3050201003KEU1-6', '306', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Keuangan', 'bmn/foto/1788506603_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-6.png', '2026-09-04 07:23:23', '2026-09-04 08:04:35'),
(125, '85a47b90-a092-4bc6-a52d-ee9990580e43', '3050201003KEU1-7', '362', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Keuangan', 'bmn/foto/1788509444_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-7.png', '2026-09-04 08:10:44', '2026-09-04 08:10:44'),
(126, '3e3ec34c-5165-4493-857b-e87ed966f11e', '3050201003KEU1-8', '363', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Keuangan', 'bmn/foto/1788509687_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-8.png', '2026-09-04 08:14:47', '2026-09-04 08:14:47'),
(127, '6fdaad16-a8f8-4ec0-ae8a-0f9f1dbd0b02', '3050201003KEU1-9', '364', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Keuangan', 'bmn/foto/1788509895_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-9.png', '2026-09-04 08:18:15', '2026-09-04 08:18:15'),
(128, '678cac1f-bb6d-4d2c-bc1f-62005d23eb62', '3050201003KEU1-10', '365', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Keuangan', 'bmn/foto/1788510009_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-10.png', '2026-09-04 08:20:09', '2026-09-04 08:20:09'),
(129, '943c866b-9e61-4fa4-9132-f2aa003acf09', '3050201003KEU1-11', '375', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'Keuangan', 'bmn/foto/1788510162_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-11.png', '2026-09-04 08:22:42', '2026-09-04 08:22:42'),
(130, 'ab3f4c2a-8d11-497b-b6f9-8763b030a694', '3050201003KEU1-12', '376', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'Keuangan', 'bmn/foto/1788510364_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003KEU1-12.png', '2026-09-04 08:26:04', '2026-09-04 08:26:04'),
(131, 'bc31a461-c559-4eed-a89d-cc183cb3dc5b', '3050201020KEU1-1', '46', 'Kursi Fiber Glass/Plastik', 'MESIN PERALATAN NON TIK', 'KURSI PLASTIK MG11672 CHAIR BLUE', NULL, 1, 80, 225000.00, '2025-05-19', 'Baik', 'Keuangan', 'bmn/foto/1788510760_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201020KEU1-1.png', '2026-09-04 08:32:40', '2026-09-09 06:31:41'),
(132, 'ed3c6dd0-1377-4311-aa59-3c9c5345eb48', '3100203017BRT1-15', '41', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788741538_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788741538_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-15.png', '2026-09-07 00:38:58', '2026-09-07 00:38:58'),
(133, '16856589-798c-4861-98a1-f17e4df33969', '3100203017BRT1-16', '44', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788741735_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788741735_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-16.png', '2026-09-07 00:42:15', '2026-09-07 00:42:15'),
(134, '2665382c-4ef3-4698-b634-5c2190555812', '3100203017BRT1-17', '45', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788741810_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788741810_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-17.png', '2026-09-07 00:43:30', '2026-09-07 00:43:30'),
(135, '935d801f-d11f-43b6-a525-910821e82987', '3100203017BRT1-18', '46', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788741898_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788741898_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-18.png', '2026-09-07 00:44:58', '2026-09-07 00:44:58'),
(136, '36787fa7-e040-4aaf-b0a9-afde7b9236b0', '3100203017BRT1-19', '68', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788742019_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788742019_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-19.png', '2026-09-07 00:46:59', '2026-09-07 00:47:23'),
(137, 'ee58c57f-09cd-4bbd-8673-781305737b8a', '3100203017BRT1-20', '69', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788742119_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788742119_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-20.png', '2026-09-07 00:48:39', '2026-09-07 00:48:39'),
(138, '3d395cdf-009d-468f-9171-668dfb9472c9', '3100203017BRT1-21', '70', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788742197_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788742197_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-21.png', '2026-09-07 00:49:58', '2026-09-07 00:49:58'),
(139, 'c5c013e0-5602-495d-bfd6-69cf591a6873', '3100203017BRT1-22', '71', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788742260_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788742260_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-22.png', '2026-09-07 00:51:00', '2026-09-07 00:51:00'),
(140, 'fc95252b-4c0a-4607-9603-838a45bb4dbf', '3100203017BRT1-23', '73', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788742347_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788742347_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-23.png', '2026-09-07 00:52:28', '2026-09-07 00:52:28'),
(141, '8c78a049-9c65-4e19-a966-b319cd305592', '3100203017BRT1-24', '74', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788742400_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788742400_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-24.png', '2026-09-07 00:53:20', '2026-09-07 00:53:20'),
(142, 'a006ea6e-0ebb-4069-b1a2-9463ce20abe9', '3100203017BRT1-25', '75', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788742455_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788742455_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-25.png', '2026-09-07 00:54:15', '2026-09-07 00:54:15'),
(143, '4030de0f-874d-47c1-9ef9-267e7e9d855d', '3100203017BRT1-26', '77', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Berita', 'bmn/foto/1788743019_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788743019_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-26.png', '2026-09-07 01:03:39', '2026-09-07 01:03:39'),
(144, '6f0fc5e1-e042-4f8d-a9c0-91ad95964a7a', '3100203017BRT1-27', '102', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1300000.00, '2019-04-24', 'Baik', 'Berita', 'bmn/foto/1788766504_barang.jpg', 'Berita', NULL, 'bmn/posisi/1788766504_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017BRT1-27.png', '2026-09-07 07:35:04', '2026-09-07 07:35:04'),
(146, '8cd66bb9-d7a1-48fb-a66c-208afbe31b3f', '3100102002KEU1-1', '35', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A416E / 14\" / i7', NULL, 1, 80, 15440000.00, '2022-05-31', 'Baik', 'Keuangan', 'bmn/foto/1788936212_barang.png', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-1.png', '2026-09-09 06:43:33', '2026-09-09 06:43:33'),
(147, 'ded2acaa-3cc3-4877-bdd2-fa0aa576a1f9', '3100102002KEU1-2', '36', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A416E / 14\" / i7', NULL, 1, 80, 15440000.00, '2022-05-31', 'Baik', 'Keuangan', 'bmn/foto/1788936394_barang.png', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-2.png', '2026-09-09 06:46:34', '2026-09-09 06:46:34'),
(148, 'e2aa8126-97eb-40d2-b0e1-0723869c54f6', '3100102002KEU1-3', '56', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'LAPTOP LENOVO YOGA 7 2IN1 14IML9', NULL, 1, 80, 23450000.00, '2024-12-17', 'Baik', 'Keuangan', 'bmn/foto/1788936682_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-3.png', '2026-09-09 06:51:22', '2026-09-09 06:51:22'),
(149, '9c444d9c-828e-4108-86f4-79cf6347af5b', '3100102002KEU1-4', '60', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'LENOVO IDEAPAD DUET 3i 2IN1 TOUCH INTEL N200 8GB', NULL, 1, 80, 10700000.00, '2024-12-17', 'Baik', 'Keuangan', 'bmn/foto/1788936883_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-4.png', '2026-09-09 06:54:43', '2026-09-09 06:54:43');
INSERT INTO `bmn_barangs` (`id`, `uuid`, `kode_barang`, `nup`, `nama_barang`, `kategori`, `merk`, `nomor_seri`, `jumlah`, `persentase_kondisi`, `nilai_perolehan`, `tanggal_perolehan`, `kondisi`, `unit_kerja`, `foto`, `ruangan`, `pengguna_id`, `posisi`, `asal_pengadaan`, `peruntukan`, `catatan`, `qr_code`, `created_at`, `updated_at`) VALUES
(150, 'b13f3e11-1f3f-4061-afa0-d786c6128d7a', '3100102002KEU1-5', '61', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'LENOVO IDEAPAD DUET 3i 2IN1 TOUCH INTEL N200 8GB', NULL, 1, 80, 10700000.00, '2024-12-17', 'Baik', 'Keuangan', 'bmn/foto/1788937069_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-5.png', '2026-09-09 06:57:49', '2026-09-09 06:57:49'),
(151, 'b3496543-8a55-4c4c-89ce-76e0069c536e', '3100102002KEU1-6', '64', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS TP3407SA-OLED 71511M CORE ULTRA 7', NULL, 1, 80, 21750000.00, '2025-08-11', 'Baik', 'Keuangan', 'bmn/foto/1788937262_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-6.png', '2026-09-09 07:01:02', '2026-09-09 07:01:02'),
(152, 'dce5333e-9846-48d0-9e75-a4e86b60fa89', '3100102002KEU1-7', '65', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS/A1404VA-VIPS 5853M', NULL, 1, 80, 8880000.00, '2025-08-15', 'Baik', 'Keuangan', 'bmn/foto/1788937516_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-7.png', '2026-09-09 07:05:16', '2026-09-09 07:05:16'),
(153, 'c6c703fd-2453-41c4-912b-f1dd483b6e48', '3100102002KEU1-8', '66', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS/A1404VA-VIPS 5853M', NULL, 1, 80, 8880000.00, '2025-08-15', 'Baik', 'Keuangan', 'bmn/foto/1788937669_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-8.png', '2026-09-09 07:07:49', '2026-09-09 07:07:49'),
(154, 'd92a6de9-983c-4ed5-818d-1877900c2083', '3100102002KEU1-9', '67', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS/A1404VA-VIPS 5853M', NULL, 1, 80, 8880000.00, '2025-08-15', 'Baik', 'Keuangan', 'bmn/foto/1788937821_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002KEU1-9.png', '2026-09-09 07:10:21', '2026-09-09 07:10:21'),
(155, 'cfb47071-7375-4126-bcc8-a0673ee25f5c', 'BRG-2026-0022', '70', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS VIVOBOOK 14 A1404VA-VIPS7853M', NULL, 1, 80, NULL, '2025-12-10', 'Baik', 'Keuangan', 'bmn/foto/1788937978_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_BRG-2026-0022.png', '2026-09-09 07:12:58', '2026-09-09 07:12:58'),
(156, 'e993535e-09da-4ed8-8879-e23a9fe20b4a', '3050104001KEU1-1', '15', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3960000.00, '2021-02-22', 'Baik', 'Keuangan', 'bmn/foto/1788938391_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001KEU1-1.png', '2026-09-09 07:17:21', '2026-09-09 07:19:51'),
(157, '48e04028-f362-42af-ae66-4d5fa31ad4bb', '3050104001KEU1-2', '17', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3960000.00, '2021-02-22', 'Baik', 'Keuangan', 'bmn/foto/1788938576_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001KEU1-2.png', '2026-09-09 07:22:56', '2026-09-09 07:22:56'),
(158, '695ccbb2-298f-4bd3-9cfb-f4526a64b093', '3050104001KEU1-3', '24', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'LEMARI PUTIH 4 PINTU INFORMA', NULL, 1, 80, 3975000.00, '2022-06-28', 'Baik', 'Keuangan', 'bmn/foto/1788938836_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001KEU1-3.png', '2026-09-09 07:27:17', '2026-09-09 07:27:17'),
(159, '07f3623b-7ace-4b42-820a-cca51afd1b76', '3050204001KEU1-1', '17', 'Lemari Es', 'MESIN PERALATAN NON TIK', 'kulkas SHARP Tipe SJ-X197W-DW', NULL, 1, 80, 2038000.00, '2022-12-28', 'Baik', 'Keuangan', 'bmn/foto/1788939072_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204001KEU1-1.png', '2026-09-09 07:31:12', '2026-09-09 07:31:12'),
(160, '6397ddb5-4564-4267-9f1d-347704896522', '3050201002KEU1-1', '99', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Keuangan', 'bmn/foto/1788939289_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-1.png', '2026-09-09 07:34:49', '2026-09-09 07:34:49'),
(161, 'a54d6b60-bfa8-4dee-9d8b-44b2a71accc9', '3050201002KEU1-2', '105', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Keuangan', 'bmn/foto/1788939563_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-2.png', '2026-09-09 07:39:23', '2026-09-09 07:39:23'),
(162, '2b128f39-f319-4f9d-8420-cfa6508cf449', '3050201002KEU1-3', '106', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Keuangan', 'bmn/foto/1788939683_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-3.png', '2026-09-09 07:41:23', '2026-09-09 07:41:23'),
(163, '0682dd6b-05a2-4f03-aba6-5bf551c342c6', '3050201002KEU1-4', '107', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Keuangan', 'bmn/foto/1790058451_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-4.png', '2026-09-09 07:45:28', '2026-09-22 06:27:31'),
(164, 'ff8518f9-57e5-4696-9e0f-f796001d1756', '3050201002KEU1-5', '108', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Keuangan', 'bmn/foto/1788940047_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-5.png', '2026-09-09 07:47:27', '2026-09-09 07:47:27'),
(165, '637cf5e2-8657-4148-a968-6cea6efc76db', '3050201002KEU1-6', '109', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Keuangan', 'bmn/foto/1788940147_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-6.png', '2026-09-09 07:49:08', '2026-09-09 07:49:08'),
(166, 'ccab6a23-f815-4aa1-9123-4d1aff3c8e5c', '3050201002KEU1-7', '128', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Keuangan', 'bmn/foto/1788940333_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-7.png', '2026-09-09 07:52:13', '2026-09-09 07:52:13'),
(167, '54e2b2ff-1966-49bd-8317-cf6b2f8252bb', 'TEKNIK000011', '1234', 'PC Intel 9', 'MESIN PERALATAN KHUSUS TIK', 'I9 4060', NULL, 1, 100, 50000000.00, '2026-09-11', 'Sangat Baik', 'Teknik', 'bmn/foto/1789091232_barang.jpg', 'TX', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_TEKNIK000011.png', '2026-09-11 01:47:12', '2026-09-11 01:47:12'),
(168, '4505bb1e-9b2a-4667-8d8c-17db9a7a56b4', 'TEKNIK00001199', '1245', 'PC Intel 9 AMD', 'MESIN PERALATAN KHUSUS TIK', 'I9 40605', NULL, 1, 100, 357855555.00, '2026-09-11', 'Sangat Baik', 'Teknik', 'bmn/foto/1789091352_barang.jpg', 'TX', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_TEKNIK00001199.png', '2026-09-11 01:49:12', '2026-09-11 01:49:12'),
(173, '7aa9f1d2-a128-4d50-92e2-dc8289755f75', '3060102170BRT1-1', '3', 'Gimbal Tripod', 'MESIN PERALATAN NON TIK', 'DJI OSMO MOBILE SE', NULL, 1, 80, 1599000.00, '2024-02-21', 'Baik', 'Berita', 'bmn/foto/1789974766_barang.jpg', 'Berita', NULL, 'bmn/posisi/1789974766_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102170BRT1-1.png', '2026-09-21 07:12:46', '2026-09-21 07:12:46'),
(174, 'ffb692e1-9b85-42b9-af08-ab7eb7034e22', '3060102170BRT1-2', '4', 'Gimbal Tripod', 'MESIN PERALATAN NON TIK', 'DJI OSMO MOBILE SE', NULL, 1, 80, 1599000.00, '2024-02-21', 'Baik', 'Berita', 'bmn/foto/1789974840_barang.jpg', 'Berita', NULL, 'bmn/posisi/1789974840_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102170BRT1-2.png', '2026-09-21 07:14:00', '2026-09-21 07:14:00'),
(175, '9d9593d6-1de2-4463-9f55-b50966a880db', '3100201012BRT1-1', '5', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 606000.00, '2013-07-31', 'Baik', 'Berita', 'bmn/foto/1789975007_barang.jpg', 'Berita', NULL, 'bmn/posisi/1789975007_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012BRT1-1.png', '2026-09-21 07:15:24', '2026-09-21 07:16:47'),
(176, 'bd774164-4711-4388-ac13-eb2292484004', '3100201012BRT1-2', '6', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 606000.00, '2013-07-31', 'Baik', 'Berita', 'bmn/foto/1790055551_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790055551_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012BRT1-2.png', '2026-09-22 05:38:18', '2026-09-22 05:39:11'),
(177, 'f56e729f-65b2-42cd-8ef6-f6a80b6e23f9', '3100201012BRT1-3', '14', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 710000.00, '2013-10-30', 'Baik', 'Berita', 'bmn/foto/1790055639_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790055639_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012BRT1-3.png', '2026-09-22 05:40:39', '2026-09-22 05:40:39'),
(178, '51c62bfa-2f99-4262-b0ea-da6362407843', '3100201012BRT1-4', '20', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE', NULL, 1, 80, 750000.00, '2013-12-17', 'Baik', 'Berita', 'bmn/foto/1790056134_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790056134_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012BRT1-4.png', '2026-09-22 05:48:54', '2026-09-22 05:48:54'),
(179, '1456592a-1b54-463b-8bc8-63c0c936ee91', '3050201003BRT1-1', '256', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI HADAP STENLIS MATRIX', NULL, 1, 80, 330000.00, '2016-06-14', 'Baik', 'Berita', 'bmn/foto/1790057122_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790057122_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-1.png', '2026-09-22 06:03:58', '2026-09-22 06:05:22'),
(180, '0af4b2b8-0655-4622-a129-52a1b110db4b', '3050201003BRT1-2', '257', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI HADAP STENLIS MATRIX', NULL, 1, 80, 330000.00, '2016-06-14', 'Baik', 'Berita', 'bmn/foto/1790057292_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790057292_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-2.png', '2026-09-22 06:08:12', '2026-09-22 06:08:12'),
(181, '97a7ffbe-91c6-4159-aef3-da1e4daea0fd', '3050201003BRT1-3', '258', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI HADAP STENLIS MATRIX', NULL, 1, 80, 330000.00, '2016-06-14', 'Baik', 'Berita', 'bmn/foto/1790057404_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790057404_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-3.png', '2026-09-22 06:10:04', '2026-09-22 06:10:04'),
(182, '504abf54-6845-4137-a06a-2cebc35454e6', '3050201003BRT1-4', '259', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI HADAP STENLIS MATRIX', NULL, 1, 80, 330000.00, '2026-09-22', 'Baik', 'Berita', 'bmn/foto/1790057473_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790057473_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-4.png', '2026-09-22 06:11:13', '2026-09-22 06:11:13'),
(183, 'bf01a257-e949-4444-82ff-093045c6be20', '3050201003BRT1-5', '260', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI HADAP STENLIS MATRIX', NULL, 1, 80, 330000.00, '2016-06-14', 'Baik', 'Berita', 'bmn/foto/1790057529_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790057529_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-5.png', '2026-09-22 06:12:09', '2026-09-22 06:12:09'),
(184, '8b0aeb88-46f7-4d61-874d-9d8b99a54d45', '3050201003BRT1-6', '289', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Berita', 'bmn/foto/1790057649_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790057649_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-6.png', '2026-09-22 06:14:09', '2026-09-22 06:14:09'),
(185, '2cb48fb8-c2d3-45bc-a56b-cdf85d38f2ff', '3050201003BRT1-7', '296', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Berita', 'bmn/foto/1790057713_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790057713_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-7.png', '2026-09-22 06:15:13', '2026-09-22 06:15:13'),
(186, '11ade813-408a-4c8f-b844-b2f7499033ef', '3050201003BRT1-8', '297', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Berita', 'bmn/foto/1790057771_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790057771_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-8.png', '2026-09-22 06:16:12', '2026-09-22 06:16:12'),
(187, 'bd754d59-7315-4b26-88af-02c7b99995e8', '3050201002KEU1-8', '136', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Keuangan', 'bmn/foto/1790058566_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-8.png', '2026-09-22 06:29:26', '2026-09-22 06:29:26'),
(188, 'd214654c-b2cc-41e0-b95b-cd3300c2c695', '3050201002KEU1-9', '137', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Keuangan', 'bmn/foto/1790058646_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002KEU1-9.png', '2026-09-22 06:30:46', '2026-09-22 06:30:46'),
(189, '4e7682ec-7673-48ce-95b4-fca308ac4a07', '3100102001KEU1-1', '36', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'KOMPUTER EDITING-RAKITAN', NULL, 1, 80, 39400000.00, '2020-11-30', 'Baik', 'Keuangan', 'bmn/foto/1790058742_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001KEU1-1.png', '2026-09-22 06:32:22', '2026-09-22 06:32:22'),
(190, 'c0b2040d-b30e-4167-b4a6-6be7609a43f9', '3100102001KEU1-2', '44', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'LCD SAMSUNG 19\"/PROSESOR 9TH GEN/i5-9400F', NULL, 1, 80, 11910000.00, '2021-02-22', 'Baik', 'Keuangan', 'bmn/foto/1790058856_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001KEU1-2.png', '2026-09-22 06:34:16', '2026-09-22 06:34:16'),
(191, '150dbeb3-3c85-40a0-8bf2-96124cc25aa5', '3100102001KEU1-3', '60', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'Monitor Samsung/intel core i7-12700/CPU Venom RX Nemesis', NULL, 1, 80, 14950000.00, '2023-03-07', 'Baik', 'Keuangan', 'bmn/foto/1790058921_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001KEU1-3.png', '2026-09-22 06:35:21', '2026-09-22 06:35:21'),
(192, 'e20cbb5c-158f-4cab-821f-c8e0eeccc3e1', '3100203003KEU1-1', '75', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'BROTHER T-710', NULL, 1, 80, 5500000.00, '2018-04-24', 'Baik', 'Keuangan', 'bmn/foto/1790059054_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003KEU1-1.png', '2026-09-22 06:37:34', '2026-09-22 06:37:34'),
(193, 'eded50d1-e077-41f0-92e4-00b953ad0ac5', '3100203003KEU1-2', '77', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L-3110', NULL, 1, 80, 4080000.00, '2021-02-22', 'Baik', 'Keuangan', 'bmn/foto/1790059139_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003KEU1-2.png', '2026-09-22 06:38:59', '2026-09-22 06:38:59'),
(194, '452ac7a3-6474-4f62-9e6e-85d4f72af71c', '3100203003KEU1-3', '81', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON Ecotank L3210', NULL, 1, 80, 2500000.00, '2022-05-31', 'Baik', 'Keuangan', 'bmn/foto/1790059223_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003KEU1-3.png', '2026-09-22 06:40:23', '2026-09-22 06:40:23'),
(195, '50924c50-07f8-4e33-8444-2ef01b71f991', '3100203003KEU1-4', '94', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2687000.00, '2023-12-01', 'Baik', 'Keuangan', 'bmn/foto/1790059322_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003KEU1-4.png', '2026-09-22 06:42:02', '2026-09-22 06:42:02'),
(196, '3b1b7057-b126-4c85-9023-c341e84dc060', '3100203003KEU1-5', '102', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2541650.00, '2024-02-28', 'Baik', 'Keuangan', 'bmn/foto/1790059416_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003KEU1-5.png', '2026-09-22 06:42:41', '2026-09-22 06:43:36'),
(197, '3dedbe65-085b-4297-8162-4c9e054bb4d9', '3100203003KEU1-6', '103', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2541650.00, '2024-02-28', 'Baik', 'Keuangan', 'bmn/foto/1790059483_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003KEU1-6.png', '2026-09-22 06:44:43', '2026-09-22 06:44:43'),
(198, 'e30110fd-5045-4e9a-aabf-733c98adfca9', '3100203003KEU1-7', '112', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'BROTHER DCP-T720DW', NULL, 1, 80, 3670000.00, '2025-09-11', 'Baik', 'Keuangan', 'bmn/foto/1790059557_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003KEU1-7.png', '2026-09-22 06:45:57', '2026-09-22 06:45:57'),
(199, '02124648-7dfc-4f75-af68-e92578c204f6', '3050104003KEU1-1', '13', 'Rak Besi', 'MESIN PERALATAN NON TIK', 'RAK ARSIP (CUSTOM) RANGKA HOLLOW GALVANIS', NULL, 1, 80, 5272500.00, '2024-12-05', 'Baik', 'Keuangan', 'bmn/foto/1790059658_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104003KEU1-1.png', '2026-09-22 06:47:39', '2026-09-22 06:47:39'),
(200, '67ed1435-ff1d-48ae-80d1-d7eda05438d5', '3050104003KEU1-2', '15', 'Rak Besi', 'MESIN PERALATAN NON TIK', 'RAK ARSIP (CUSTOM) / RANGKA HOLLOW GALVANIS 4X4 / LANTAI TRIPLEK', NULL, 1, 80, 4884000.00, '2024-12-05', 'Baik', 'Keuangan', 'bmn/foto/1790059713_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104003KEU1-2.png', '2026-09-22 06:48:33', '2026-09-22 06:48:33'),
(202, 'efcd307c-1134-495c-8fa2-5a8e2913b197', '3050104001KEU1-4', '18', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA 2 PINTU', NULL, 1, 80, 3960000.00, '2021-05-27', 'Baik', 'Keuangan', 'bmn/foto/1790060282_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001KEU1-4.png', '2026-09-22 06:58:02', '2026-09-22 07:47:38'),
(203, '367fd572-d262-4864-819d-7089f67426c8', '3100203004KEU1-1', '2', 'Scanner (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON DS-1630', NULL, 1, 80, 7700000.00, '2023-12-01', 'Baik', 'Keuangan', 'bmn/foto/1790060373_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203004KEU1-1.png', '2026-09-22 06:59:33', '2026-09-22 06:59:33'),
(204, 'd279f265-fc0e-4677-81ab-f9e827cb5ba8', '3100203004KEU1-2', '3', 'Scanner (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON DS-1630', NULL, 1, 80, 7700000.00, '2023-12-01', 'Baik', 'Keuangan', 'bmn/foto/1790060415_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203004KEU1-2.png', '2026-09-22 07:00:15', '2026-09-22 07:00:15'),
(205, '3dd06372-3d0f-4781-9d47-5dfba2fe9624', '3100203004KEU1-3', '5', 'Scanner (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON WORKFORCE DS-570W11', NULL, 1, 80, 12000000.00, '2025-01-30', 'Baik', 'Keuangan', 'bmn/foto/1790060487_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203004KEU1-3.png', '2026-09-22 07:01:27', '2026-09-22 07:01:27'),
(206, '6e6b6ea4-69e8-4fcd-8527-f3a3eb9aee19', '3100203004KEU1-4', '7', 'Scanner (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON DS-410', NULL, 1, 80, 5100000.00, '2026-02-09', 'Baik', 'Keuangan', 'bmn/foto/1790060556_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203004KEU1-4.png', '2026-09-22 07:02:36', '2026-09-22 07:02:36'),
(207, '9fda1611-7003-4ba3-8d73-60aaca57b44b', '3100102009KEU1-1', '2', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'XIAOMI PAD 6 / KEYBOARD / SMART PEN', NULL, 1, 80, 7990000.00, '2023-12-04', 'Baik', 'Keuangan', 'bmn/foto/1790060647_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009KEU1-1.png', '2026-09-22 07:04:07', '2026-09-22 07:04:07'),
(208, '9e598878-95a4-4797-8d15-3837aba39c98', '3100102009KEU1-2', '28', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET XIAOMI REDMI PAD 2', NULL, 1, 80, 3780000.00, '2025-11-07', 'Baik', 'Keuangan', 'bmn/foto/1790060691_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009KEU1-2.png', '2026-09-22 07:04:51', '2026-09-22 07:04:51'),
(209, '073ddea8-4d3a-4f86-b4b5-6ee5d3ee1ea3', '3060201004KEU1-1', '15', 'Telephone Mobile', 'MESIN PERALATAN NON TIK', 'HP SAMSUNG M54 5G  (WIRYADI)', NULL, 1, 80, 5750000.00, '2024-05-15', 'Baik', 'Keuangan', 'bmn/foto/1790060787_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060201004KEU1-1.png', '2026-09-22 07:06:27', '2026-09-22 07:09:40'),
(210, '1480cefd-3639-4072-abb6-e4cc41dfe52e', '3050206002KEU1-1', '74', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'Keuangan', 'bmn/foto/1790060915_barang.jpg', 'Keuangan', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002KEU1-1.png', '2026-09-22 07:07:30', '2026-09-22 07:09:38'),
(211, 'cec3aef7-77c5-46b7-8532-644693444b14', '3050201003BRT1-9', '298', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Berita', 'bmn/foto/1790061331_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790061331_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-9.png', '2026-09-22 07:15:31', '2026-09-22 07:15:31'),
(212, '5de887f7-0c25-4ea0-b6d0-4804f578771d', '3050201003BRT1-10', '300', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Berita', 'bmn/foto/1790061397_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790061397_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-10.png', '2026-09-22 07:16:37', '2026-09-22 07:16:37'),
(213, '184878d1-f938-4b66-9978-e53b4634e0b7', '3050201003BRT1-11', '314', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Berita', 'bmn/foto/1790061514_barang.jpg', 'Berita', NULL, 'bmn/posisi/1790061514_posisi.jpeg', 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-11.png', '2026-09-22 07:18:34', '2026-09-22 07:18:34'),
(214, '774bcf2a-5b40-4bc0-a581-0af8922b5058', '3050201003BRT1-12', '338', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'Berita', 'bmn/foto/1790061670_barang.jpeg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-12.png', '2026-09-22 07:21:10', '2026-09-22 07:21:10'),
(215, 'a6310dda-a6bb-4659-af02-702a6b6afd4d', '3050201003BRT1-13', '339', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'Berita', 'bmn/foto/1790061743_barang.jpeg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-13.png', '2026-09-22 07:22:24', '2026-09-22 07:22:24'),
(216, '998784da-b0fb-4802-b0b4-66eef519b501', '3050201003BRT1-14', '340', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'Berita', 'bmn/foto/1790061796_barang.jpeg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-14.png', '2026-09-22 07:23:16', '2026-09-22 07:23:16'),
(217, '8fa88ea4-e9d1-4e13-a212-f72e9b8a3c85', '3050201003BRT1-15', '341', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'Berita', 'bmn/foto/1790061842_barang.jpeg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-15.png', '2026-09-22 07:24:02', '2026-09-22 07:24:02'),
(218, '4f032799-0de6-441f-bc21-6cfc55aefd85', '3050201003BRT1-16', '373', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'Berita', 'bmn/foto/1790128784_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-16.png', '2026-09-22 07:27:01', '2026-09-23 01:59:44'),
(219, '431d5118-99ac-4aec-a0c7-252595733e54', '3050201003BRT1-17', '374', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'Berita', 'bmn/foto/1790062089_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003BRT1-17.png', '2026-09-22 07:28:09', '2026-09-22 07:28:09'),
(220, '3068bc83-aeed-4b0d-a985-37576d70cdf6', '3100102002BRT1-1', '32', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'DEL 3401/i3-1005G1', NULL, 1, 80, 9400000.00, '2021-02-22', 'Baik', 'Berita', 'bmn/foto/1790062191_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002BRT1-1.png', '2026-09-22 07:29:51', '2026-09-22 07:29:51'),
(221, '51e6373b-c146-4261-bb51-9ad17b483b7c', '3100102002BRT1-2', '42', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A416FA-FHD323 i3', NULL, 1, 80, 9000000.00, '2022-08-09', 'Baik', 'Berita', 'bmn/foto/1790062297_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002BRT1-2.png', '2026-09-22 07:31:37', '2026-09-22 07:31:37'),
(222, '9b8c9d86-59cd-4831-be59-3fd9d602ecc5', '3100102002BRT1-3', '45', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A1402ZA / CORE i7-1260P / 14\"', NULL, 1, 80, 15000000.00, '2023-03-07', 'Baik', 'Berita', 'bmn/foto/1790062400_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002BRT1-3.png', '2026-09-22 07:33:20', '2026-09-22 07:33:20'),
(223, '16a68186-cb53-4070-89d4-c2d1aa122ce8', '3100102002BRT1-4', '46', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A1402ZA / CORE i7-1260P / 14\"', NULL, 1, 80, 15000000.00, '2023-03-07', 'Baik', 'Berita', 'bmn/foto/1790062475_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002BRT1-4.png', '2026-09-22 07:34:35', '2026-09-22 07:34:35'),
(224, '5d16fd76-421e-4f8d-8aff-0341994527ee', '3050104001BRT1-1', '16', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3960000.00, '2021-02-22', 'Baik', 'Berita', 'bmn/foto/1790063287_barang.jpg', 'Berita', NULL, NULL, NULL, NULL, NULL, 'bmn/qrcode/qr_3050104001BRT1-1.png', '2026-09-22 07:41:01', '2026-09-22 07:48:07'),
(225, 'f593b0db-e276-4580-acec-719e24c79e0a', '3050104005PU1-1', '22', 'Filling Cabinet Besi', 'MESIN PERALATAN NON TIK', 'INFORMA / 4 DOOR DRAWER', NULL, 1, 80, 2721000.00, '2024-02-26', 'Baik', 'PU', 'bmn/foto/1790123489_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005PU1-1.png', '2026-09-23 00:31:29', '2026-09-23 00:31:29'),
(226, '33ca4d83-4c18-45ba-a476-fde765b42569', '3050201003PU1-1', '344', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'PU', 'bmn/foto/1790123594_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PU1-1.png', '2026-09-23 00:33:14', '2026-09-23 00:33:14'),
(227, '0c6b77b9-33bb-44de-ab25-92d2985b37de', '3050201003PU1-2', '345', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'PU', 'bmn/foto/1790123691_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PU1-2.png', '2026-09-23 00:34:51', '2026-09-23 00:34:51'),
(228, '50bb817a-6e3f-4d69-b796-98a85c1367b5', '3050201003PU1-3', '346', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'PU', 'bmn/foto/1790124003_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PU1-3.png', '2026-09-23 00:40:03', '2026-09-23 00:40:03'),
(229, '1b172761-02ed-4a11-a38c-7497e36bfb03', '3050201003PU1-4', '380', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'PU', 'bmn/foto/1790124087_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PU1-4.png', '2026-09-23 00:41:27', '2026-09-23 00:41:27'),
(230, 'cf306816-4529-482a-af24-1e86a3cfd1e5', '3050201003PU1-5', '381', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'PU', 'bmn/foto/1790124149_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PU1-5.png', '2026-09-23 00:42:29', '2026-09-23 00:42:29'),
(231, '45015ca8-d8f8-4f70-80f9-221b006de6fc', '3100102002PU1-1', '48', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A1402ZA / CORE i7-1260P / 14\"', NULL, 1, 80, 15000000.00, '2023-03-07', 'Baik', 'PU', 'bmn/foto/1790124263_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002PU1-1.png', '2026-09-23 00:44:23', '2026-09-23 00:44:23'),
(232, '70a5447e-72b7-40aa-b3a2-e72aeb2f7e6f', '3100102002PU1-2', '49', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A1402ZA / CORE i7-1260P / 14\"', NULL, 1, 80, 15000000.00, '2023-03-07', 'Baik', 'PU', 'bmn/foto/1790124347_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002PU1-2.png', '2026-09-23 00:45:47', '2026-09-23 00:45:47'),
(233, '08f02362-bb8d-43ab-9ec6-29602f555a49', '3100102002PU1-3', '71', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'NB ASUS EXPERTBOOK P1 P1403CVA-S67151WS', NULL, 1, 80, 17097000.00, '2025-12-10', 'Baik', 'PU', 'bmn/foto/1790124434_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002PU1-3.png', '2026-09-23 00:47:14', '2026-09-23 00:47:14'),
(234, '41621199-62ba-4049-b501-e05f6a9f80f7', '3050201002PU1-1', '123', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'SIANTONO OT 156', NULL, 1, 80, 1954000.00, '2023-12-04', 'Baik', 'PU', 'bmn/foto/1790124586_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PU1-1.png', '2026-09-23 00:49:46', '2026-09-23 00:49:46'),
(235, '9f71ae95-1a74-42a2-835b-d1bbbb7aec46', '3050201002PU1-2', '124', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'SIANTONO OT 156', NULL, 1, 80, 1954000.00, '2023-12-04', 'Baik', 'PU', 'bmn/foto/1790124662_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PU1-2.png', '2026-09-23 00:51:02', '2026-09-23 00:51:02'),
(236, 'ba49eeb8-4a91-40b7-b8ef-6ec86fddf94a', '3050201002PU1-3', '125', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'SIANTONO OT 156', NULL, 1, 80, 1954000.00, '2023-12-04', 'Baik', 'PU', 'bmn/foto/1790124699_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PU1-3.png', '2026-09-23 00:51:39', '2026-09-23 00:51:39'),
(237, '2c0efc91-0edc-4a00-a91b-a8adf99621a8', '3050201002PU1-4', '146', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'PU', 'bmn/foto/1790124796_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PU1-4.png', '2026-09-23 00:53:16', '2026-09-23 00:53:16'),
(238, '03a1a8ee-4c64-4272-be1b-f7ebefee317c', '3050201002PU1-5', '134', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'PU', 'bmn/foto/1790124844_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PU1-5.png', '2026-09-23 00:54:04', '2026-09-23 00:54:04'),
(239, '9dc6a4ab-8d56-44da-afbb-013b2de46959', '3100102001PU1-1', '64', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC ALL IN ONE / MY PC AXIOO/ INTEL CORE i5', NULL, 1, 80, 14500000.00, '2023-12-01', 'Baik', 'PU', 'bmn/foto/1790124982_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PU1-1.png', '2026-09-23 00:56:22', '2026-09-23 00:56:22'),
(240, 'd995d3d6-ad8e-49af-86e7-ab4d1a638eaf', '3100102001PU1-2', '72', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC EDITING / INTEL CORE i9-14900 / MONITOR AOC 24g4g', NULL, 1, 80, 32900000.00, '2024-12-05', 'Baik', 'PU', 'bmn/foto/1790125071_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PU1-2.png', '2026-09-23 00:57:51', '2026-09-23 00:57:51'),
(241, '7bea7823-3666-4eb5-92e4-913f9183df36', '3100203003PU1-1', '89', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2445000.00, '2023-03-08', 'Baik', 'PU', 'bmn/foto/1790125147_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003PU1-1.png', '2026-09-23 00:59:07', '2026-09-23 00:59:07'),
(242, '4b58dcb1-8047-4bd4-b438-98c7da49aed7', '3100203003PU1-2', '92', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2687000.00, '2023-12-01', 'Baik', 'PU', 'bmn/foto/1790125197_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003PU1-2.png', '2026-09-23 00:59:58', '2026-09-23 00:59:58'),
(243, '415b9a00-e92e-4315-904f-a18041024d9c', '3100203003PU1-3', '93', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2687000.00, '2023-12-01', 'Baik', 'PU', 'bmn/foto/1790125249_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003PU1-3.png', '2026-09-23 01:00:49', '2026-09-23 01:00:49'),
(244, '90206685-f3a7-446a-9d8a-365a203c19df', '3100203003PU1-4', '111', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON / TYPE L350', NULL, 1, 80, 3292000.00, '2025-08-13', 'Baik', 'PU', 'bmn/foto/1790125325_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003PU1-4.png', '2026-09-23 01:02:05', '2026-09-23 01:02:05'),
(245, '02d41faa-6c07-4b4e-8648-041d29f5e8a4', '3050201005PU1-1', '77', 'Sice', 'MESIN PERALATAN NON TIK', 'SOFA MADRID 2D (GARLIC WALNUT)', NULL, 1, 80, 4730000.00, '2021-11-12', 'Baik', 'PU', 'bmn/foto/1790125443_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201005PU1-1.png', '2026-09-23 01:04:03', '2026-09-23 01:04:03'),
(246, 'c4476d6e-320f-4fcc-ab80-dd54bca6501c', '3100102009PU1-1', '24', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET XIAOMI REDMI PAD 2', NULL, 1, 80, 3780500.00, '2025-11-07', 'Baik', 'PU', 'bmn/foto/1790125531_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009PU1-1.png', '2026-09-23 01:05:31', '2026-09-23 01:05:31'),
(247, '819518d1-9df1-4e24-8dc7-1260be1adf2b', '3050206002PU1-1', '77', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'PU', 'bmn/foto/1790125600_barang.jpg', 'Katim Humas & Staff PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002PU1-1.png', '2026-09-23 01:06:40', '2026-09-23 01:06:40'),
(248, 'edae6b73-f5ba-4f2c-a452-45ffdbc1d5c8', '3050204004PU2-1', '146', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'GREE 1,5PK STANDAR / GWC-12M0055', NULL, 1, 80, 6771000.00, '2025-08-12', 'Baik', 'PU', 'bmn/foto/1790126756_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004PU2-1.png', '2026-09-23 01:25:56', '2026-09-23 01:25:56'),
(249, '5c3de05a-e8e7-4147-a6fe-b2e1d36a40d5', '3050206036PU2-1', '17', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN PREMIUM', NULL, 1, 80, 3368000.00, '2023-12-04', 'Baik', 'Program', 'bmn/foto/1790126832_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036PU2-1.png', '2026-09-23 01:27:12', '2026-09-23 03:23:40'),
(250, '315b9f15-3b36-4b3d-8ae1-8a04a37271a3', '3100102001PU2-1', '39', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'LCD SAMSUNG 19\"/PROSESOR 9TH GEN/i5-9400F', NULL, 1, 80, 11910000.00, '2021-02-22', 'Baik', 'PU', 'bmn/foto/1790127095_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PU2-1.png', '2026-09-23 01:31:35', '2026-09-23 01:31:35'),
(251, 'f95382b4-b3f9-4c86-a66d-0255cccac310', '3100102001PU2-2', '84', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'AIO LENOVO 3 241MBO5 (RX1D)', NULL, 1, 80, 12500000.00, '2025-01-30', 'Baik', 'PU', 'bmn/foto/1790127220_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PU2-2.png', '2026-09-23 01:33:40', '2026-09-23 01:33:40'),
(252, '5dd0f00d-98a7-4579-8b6a-9c4b7a6b6d4b', '3050104001PU2-1', '27', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA Lemari Besi Pintu Swing', NULL, 1, 80, 2988000.00, '2023-07-26', 'Baik', 'PU', 'bmn/foto/1790127317_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001PU2-1.png', '2026-09-23 01:35:17', '2026-09-23 01:35:17'),
(253, '50595028-1010-4333-9202-939a1f4ef162', '3050201001PU2-1', '6', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA/MEJA KERJA STAF', NULL, 1, 80, 3000000.00, '2021-05-28', 'Baik', 'PU', 'bmn/foto/1790127393_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001PU2-1.png', '2026-09-23 01:36:33', '2026-09-23 01:36:33'),
(254, '69155df0-0f48-4401-bf47-9e190774f352', '3080715005BRT1-1', '38', 'Lighting Equipment', 'MESIN PERALATAN NON TIK', 'LIGHTING 500H', NULL, 1, 80, 1996500.00, '2014-10-29', 'Baik', 'Berita', 'bmn/foto/1790129373_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3080715005BRT1-1.png', '2026-09-23 02:09:33', '2026-09-23 02:09:33'),
(255, 'ad667922-a76c-499b-886f-acf82072c403', '3050201002PU2-1', '122', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'PU', 'bmn/foto/1790129451_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PU2-1.png', '2026-09-23 02:10:51', '2026-09-23 02:10:51'),
(256, '9087cba5-85ff-49f2-b012-c43c477f6d37', '3080715005BRT1-2', '39', 'Lighting Equipment', 'MESIN PERALATAN NON TIK', 'LIGHTING 500H', NULL, 1, 80, 1996500.00, '2014-10-29', 'Baik', 'Berita', 'bmn/foto/1790129574_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3080715005BRT1-2.png', '2026-09-23 02:12:17', '2026-09-23 02:12:54'),
(257, '4fcde3ca-f26d-4ad2-84d0-21c0acacfad8', '3050104015BRT1-1', '9', 'Locker', 'MESIN PERALATAN NON TIK', 'LOCKER METAL PREMIUM', NULL, 1, 80, 3480000.00, '2023-12-04', 'Baik', 'Berita', 'bmn/foto/1790129718_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104015BRT1-1.png', '2026-09-23 02:15:18', '2026-09-23 02:15:18'),
(258, 'e90bf1b0-f086-48c2-bbf5-3386b7c6ec57', '3050201005PU2-1', '70', 'Sice', 'MESIN PERALATAN NON TIK', 'SOFA QUINZEY - ABU', NULL, 1, 80, 14500000.00, '2019-04-24', 'Baik', 'PU', 'bmn/foto/1790129756_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201005PU2-1.png', '2026-09-23 02:15:56', '2026-09-23 02:15:56'),
(259, '287c39be-af48-4856-8b26-5bf1843b12c1', '3050201001BRT1-1', '5', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA/MEJA KERJA STAF', NULL, 1, 80, 3000000.00, '2021-05-27', 'Baik', 'Berita', 'bmn/foto/1790129817_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001BRT1-1.png', '2026-09-23 02:16:57', '2026-09-23 02:16:57'),
(260, '53ac0f72-8ca1-4c82-9efa-7c485fc7a5c6', '3100102009PU2-1', '5', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'XIAOMI PAD 6 / KEYBOARD / SMART PEN', NULL, 1, 80, 7990000.00, '2023-12-04', 'Baik', 'PU', 'bmn/foto/1790129867_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009PU2-1.png', '2026-09-23 02:17:47', '2026-09-23 02:17:47'),
(261, '2aa3c995-4987-4a0e-aca6-8f7b65c1cdc8', '3050201002BRT1-1', '110', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Berita', 'bmn/foto/1790129912_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002BRT1-1.png', '2026-09-23 02:18:32', '2026-09-23 02:18:32'),
(262, 'e081b9ce-37e3-4a92-b0f0-b6907f4308c4', '3050201002BRT1-2', '111', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Berita', 'bmn/foto/1790129961_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002BRT1-2.png', '2026-09-23 02:19:21', '2026-09-23 02:19:21'),
(263, '628918b7-96a2-47ba-bfe9-0d87518e3789', '3060201004PU2-1', '16', 'Telephone Mobile', 'MESIN PERALATAN KHUSUS TIK', 'SMARTPHONE XIAOMI / NOTE 14 5G', NULL, 1, 80, 3860000.00, '2025-08-13', 'Baik', 'PU', 'bmn/foto/1790130002_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060201004PU2-1.png', '2026-09-23 02:20:02', '2026-09-23 02:20:02'),
(264, '251ae141-6059-4a7e-b8b4-5313861d044f', '3050206002PU2-1', '119', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG 43\" / UA43CU8000', NULL, 1, 80, 5463000.00, '2024-02-21', 'Baik', 'PU', 'bmn/foto/1790130125_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002PU2-1.png', '2026-09-23 02:22:05', '2026-09-23 02:22:05'),
(265, '33480af8-abb9-493b-81c6-e37d9b98480c', '3050201002BRT1-3', '112', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Berita', 'bmn/foto/1790131237_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002BRT1-3.png', '2026-09-23 02:40:37', '2026-09-23 02:40:37'),
(266, 'e5ffd9b5-55f7-4b2c-979a-c2ca60074cb7', '3050201002BRT-4', '113', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Berita', 'bmn/foto/1790131453_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002BRT-4.png', '2026-09-23 02:43:37', '2026-09-23 02:44:13'),
(267, 'de208383-e414-4bb0-b31b-74556a480a35', '3050201002BRT1-5', '126', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'SIANTONO OT 156', NULL, 1, 80, 1954000.00, '2023-12-04', 'Baik', 'Berita', 'bmn/foto/1790131538_barang.jpeg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002BRT1-5.png', '2026-09-23 02:45:39', '2026-09-23 02:45:39'),
(268, '6b7f8a6f-ea11-4d71-8ee6-84e56450b13a', '3050201002BRT1-6', '135', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Berita', 'bmn/foto/1790131611_barang.jpeg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002BRT1-6.png', '2026-09-23 02:46:51', '2026-09-23 02:46:51'),
(269, '8b2b65b5-6729-45d5-94cd-9fb2ea793c93', '3100102003BRT1-1', '7', 'Note Book', 'MESIN PERALATAN KHUSUS TIK', 'ASUS BR11OCK/ 11,6\"', NULL, 1, 80, 4329000.00, '2022-09-21', 'Baik', 'Berita', 'bmn/foto/1790131709_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102003BRT1-1.png', '2026-09-23 02:48:29', '2026-09-23 02:48:29'),
(270, 'd74e693d-6f97-4a92-bee3-fd85c4f049ed', '3050204004PRG3-1', '151', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'DAIKIN AC 1,5 PK TYPE STC35YV', NULL, 1, 80, 9629250.00, '2025-12-16', 'Baik', 'Program', 'bmn/foto/1790132049_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004PRG3-1.png', '2026-09-23 02:54:09', '2026-09-23 02:54:09'),
(271, '68be5df2-1059-482b-9ae9-e42000415ad3', '3050206036PRG3-1', '13', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN/Premium Bottom Loading/HWD-C590G-BK', NULL, 1, 80, 2768000.00, '2023-07-26', 'Baik', 'Program', 'bmn/foto/1790132575_barang.jpg', 'Ruang Katim PU', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036PRG3-1.png', '2026-09-23 03:02:55', '2026-09-23 03:02:55'),
(272, '3ac2010c-0aaa-4bad-b710-d3573f1c79de', '3100102001BRT1-1', '47', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'Dell Inspiron 3881 sn DG57X63, 5GJJX53', NULL, 1, 80, 26345000.00, '2021-07-27', 'Baik', 'Berita', 'bmn/foto/1790145479_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-1.png', '2026-09-23 06:37:59', '2026-09-23 06:37:59'),
(273, '5f35d52b-bb6f-4634-9668-4a7ded78cd25', '3100102001BRT1-2', '48', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'Dell Inspiron 3881 sn DG57X63, 5GJJX53', NULL, 1, 80, 26345000.00, '2021-07-27', 'Baik', 'Berita', 'bmn/foto/1790145543_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-2.png', '2026-09-23 06:39:03', '2026-09-23 06:39:03'),
(274, '971b89ab-4391-4dc3-8704-8018d2c3886c', '3100102001BRT1-3', '75', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC EDITING / INTEL CORE i9-14900 / MONITOR AOC 24g4g', NULL, 1, 80, 32900000.00, '2024-12-05', 'Baik', 'Berita', 'bmn/foto/1790145646_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-3.png', '2026-09-23 06:40:46', '2026-09-23 06:40:46'),
(275, 'f1099f0d-0a03-4399-93ea-3e66d0d9de0b', '3100102001BRT1-4', '76', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC EDITING / INTEL CORE i9-14900 / MONITOR AOC 24g4g', NULL, 1, 80, 32900000.00, '2024-12-05', 'Baik', 'Berita', 'bmn/foto/1790146041_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-4.png', '2026-09-23 06:47:21', '2026-09-23 06:47:21'),
(276, '8a047f4d-f6fc-4b74-8c77-feedffa69c00', '3100102001BRT1-5', '94', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850WS', NULL, 1, 80, 9480000.00, '2025-08-20', 'Baik', 'Berita', 'bmn/foto/1790146143_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-5.png', '2026-09-23 06:49:03', '2026-09-23 06:49:03'),
(277, '3e5748b7-a595-42f2-a523-bc76f66dedfa', '3100102001BRT1-6', '95', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850WS', NULL, 1, 80, 9480000.00, '2025-08-20', 'Baik', 'Berita', 'bmn/foto/1790146358_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-6.png', '2026-09-23 06:52:39', '2026-09-23 06:52:39');
INSERT INTO `bmn_barangs` (`id`, `uuid`, `kode_barang`, `nup`, `nama_barang`, `kategori`, `merk`, `nomor_seri`, `jumlah`, `persentase_kondisi`, `nilai_perolehan`, `tanggal_perolehan`, `kondisi`, `unit_kerja`, `foto`, `ruangan`, `pengguna_id`, `posisi`, `asal_pengadaan`, `peruntukan`, `catatan`, `qr_code`, `created_at`, `updated_at`) VALUES
(278, 'f5f59ef7-f752-4269-975b-24fa757b3f66', '3100102001BRT1-7', '96', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850WS', NULL, 1, 80, 9480000.00, '2025-08-20', 'Baik', 'Berita', 'bmn/foto/1790146439_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-7.png', '2026-09-23 06:53:59', '2026-09-23 06:53:59'),
(279, '486c32e2-f341-4ce3-9b21-ad966d78a5c4', '3100102001BRT1-8', '97', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850WS', NULL, 1, 80, 9480000.00, '2025-08-20', 'Baik', 'Berita', 'bmn/foto/1790146499_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-8.png', '2026-09-23 06:54:59', '2026-09-23 06:54:59'),
(280, 'e1b87cdd-65ba-435a-950d-4845759032bc', '3100102001BRT1-9', '98', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850WS', NULL, 1, 80, 9480000.00, '2025-08-20', 'Baik', 'Berita', 'bmn/foto/1790146554_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-9.png', '2026-09-23 06:55:54', '2026-09-23 06:55:54'),
(281, 'b4e5f406-7634-4d9a-9ca3-bca55f8f02d0', '3100102001BRT1-10', '99', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850WS', NULL, 1, 80, 9480000.00, '2025-08-20', 'Baik', 'Berita', 'bmn/foto/1790146609_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-10.png', '2026-09-23 06:56:50', '2026-09-23 06:56:50'),
(282, 'd638f211-fb66-4f81-8be8-26a7f72497e8', '3100102001BRT1-11', '100', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'MONITOR SAMSUNG : ESSENTIAL S3 24 / CORE i5 124001', NULL, 1, 80, 11885000.00, '2025-08-20', 'Baik', 'Berita', 'bmn/foto/1790146698_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001BRT1-11.png', '2026-09-23 06:58:18', '2026-09-23 06:58:18'),
(283, 'f53c0b28-cd18-4dd2-b1b7-485ab782986c', '3100203003BRT1-1', '79', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON Ecotank L3210', NULL, 1, 80, 2580000.00, '2022-05-31', 'Baik', 'Berita', 'bmn/foto/1790146787_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003BRT1-1.png', '2026-09-23 06:59:47', '2026-09-23 06:59:47'),
(284, 'a6067996-b30d-4c78-aa41-36d244e2ffc1', '3100203003BRT1-2', '88', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2445000.00, '2023-03-08', 'Baik', 'Berita', 'bmn/foto/1790146880_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003BRT1-2.png', '2026-09-23 07:01:20', '2026-09-23 07:01:20'),
(285, '5ad0dfed-a562-45f4-aa44-4c2386058e11', '3100203003BRT1-3', '96', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2687000.00, '2023-12-01', 'Baik', 'Berita', 'bmn/foto/1790146943_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003BRT1-3.png', '2026-09-23 07:02:23', '2026-09-23 07:02:23'),
(286, 'df767708-76c4-4ce1-915b-4bb4ef2fcb13', '3050201005BRT1-1', '78', 'Sice', 'MESIN PERALATAN NON TIK', 'SOFA MADRID 2D (GARLIC WALNUT)', NULL, 1, 80, 4730000.00, '2021-11-12', 'Baik', 'Berita', 'bmn/foto/1790147045_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201005BRT1-1.png', '2026-09-23 07:04:05', '2026-09-23 07:04:05'),
(287, 'b97f2dc0-8918-4cdb-9f66-8d0434579747', '3100102009BRT1-1', '4', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'XIAOMI PAD 6 / KEYBOARD / SMART PEN', NULL, 1, 80, 7990000.00, '2023-12-04', 'Baik', 'Berita', 'bmn/foto/1790147150_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009BRT1-1.png', '2026-09-23 07:05:50', '2026-09-23 07:05:50'),
(288, '31f90c79-a2f7-4db3-9e1c-859d9f5ab4a4', '3100203017PRG3-1', '2', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEKSI PROGRAM', NULL, 1, 80, 700000.00, '2013-09-11', 'Baik', 'Program', 'bmn/foto/1790147234_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-1.png', '2026-09-23 07:07:14', '2026-09-23 07:07:14'),
(289, '2e8c5efe-59ed-44df-a950-383b3ebffd2b', '3100203017PRG3-2', '3', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEKSI PROGRAM', NULL, 1, 80, 700000.00, '2013-09-11', 'Baik', 'Program', 'bmn/foto/1790147350_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-2.png', '2026-09-23 07:09:10', '2026-09-23 07:09:10'),
(290, '81c39147-7ae2-4383-aeee-8836fdbe2b55', '3060201004BRT1-1', '9', 'Telephone Mobile', 'MESIN PERALATAN NON TIK', 'IPHONE 13 128GB  (BERITA-9,10) (KMB-11)', NULL, 1, 80, 13597000.00, '2024-02-21', 'Baik', 'Berita', 'bmn/foto/1790147442_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060201004BRT1-1.png', '2026-09-23 07:10:42', '2026-09-23 07:10:42'),
(291, '850a5915-2735-4b2d-9e9b-a2654fe27d45', '3100203017PRG3-3', '6', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790147518_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-3.png', '2026-09-23 07:11:58', '2026-09-23 07:11:58'),
(292, '60ce78ab-7d60-4dea-bcb0-7f208fba8058', '3060201004BRT1-2', '10', 'Telephone Mobile', 'MESIN PERALATAN NON TIK', 'IPHONE 13 128GB  (BERITA-9,10) (KMB-11)', NULL, 1, 80, 13597000.00, '2024-02-21', 'Baik', 'Berita', 'bmn/foto/1790147569_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060201004BRT1-2.png', '2026-09-23 07:12:49', '2026-09-23 07:12:49'),
(293, '7a2104cb-c8cc-45ca-9dc6-67a05bb7e5a3', '3050206002BRT1-1', '73', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'Berita', 'bmn/foto/1790147671_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002BRT1-1.png', '2026-09-23 07:14:31', '2026-09-23 07:14:31'),
(294, '3bfcfbd1-cb60-4a9f-95df-2440cb3d7d2f', '3100203017PRG3-4', '7', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790147722_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-4.png', '2026-09-23 07:15:22', '2026-09-23 07:15:22'),
(295, '59108f3e-2cff-4ffc-9f87-5af0f11a5d7f', '3050206002BRT1-2', '111', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG 43 INCH', NULL, 1, 80, 4430000.00, '2023-12-04', 'Baik', 'Berita', 'bmn/foto/1790147754_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002BRT1-2.png', '2026-09-23 07:15:54', '2026-09-23 07:15:54'),
(296, 'c5cf5e46-4707-4015-94c5-417ae96edc7e', '3100203017PRG3-5', '9', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-17', 'Baik', 'Program', 'bmn/foto/1790147792_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-5.png', '2026-09-23 07:16:32', '2026-09-23 07:16:32'),
(297, '3aa319c0-3d50-48fd-8e40-7adcf20091a8', '3060102045BRT1-1', '12', 'Tripod Camera', 'MESIN PERALATAN NON TIK', 'TRIPOD', NULL, 1, 80, 6600000.00, '2017-09-22', 'Baik', 'Berita', 'bmn/foto/1790147830_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102045BRT1-1.png', '2026-09-23 07:17:10', '2026-09-23 07:17:10'),
(298, '1249027a-5fd3-4a72-83c6-b39ba6d0c43f', '3100203017PRG3-6', '10', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790147859_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-6.png', '2026-09-23 07:17:39', '2026-09-23 07:17:39'),
(299, 'aa2aec76-6b33-40de-b00d-2636631b0e9d', '3060102045BRT1-2', '13', 'Tripod Camera', 'MESIN PERALATAN NON TIK', 'TRIPOD', NULL, 1, 80, 6600000.00, '2017-09-22', 'Baik', 'Berita', 'bmn/foto/1790147878_barang.jpg', 'Berita', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102045BRT1-2.png', '2026-09-23 07:17:58', '2026-09-23 07:17:58'),
(300, 'cd87f210-59cb-4ff5-8f63-2e96c613b765', '3100203017PRG3-7', '11', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790147928_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-7.png', '2026-09-23 07:18:48', '2026-09-23 07:18:48'),
(301, '6f5db22d-df2c-40ff-9038-27763a7b352c', '3100203017PRG3-8', '12', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148072_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-8.png', '2026-09-23 07:21:12', '2026-09-23 07:21:12'),
(302, '1d4e808a-6b2a-407f-8791-bbd5fa4791b7', '3100203017PRG3-9', '13', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148317_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-9.png', '2026-09-23 07:25:17', '2026-09-23 07:25:17'),
(303, '129838b0-4414-45a0-bbb0-8ac576b56a10', '3100203017PRG3-10', '14', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148380_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-10.png', '2026-09-23 07:26:20', '2026-09-23 07:26:20'),
(304, '83989fd3-d12f-407e-b93c-ef18be524642', '3100203017PRG3-11', '15', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148502_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-11.png', '2026-09-23 07:28:22', '2026-09-23 07:28:22'),
(305, '614e9245-31d9-4049-b005-ff3e90db1c30', '3100203017PRG3-12', '16', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148587_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-12.png', '2026-09-23 07:29:47', '2026-09-23 07:29:47'),
(306, '9f18f0e1-6846-4330-8dad-031c2c06fb77', '3100203017PRG3-13', '17', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148654_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-13.png', '2026-09-23 07:30:54', '2026-09-23 07:30:54'),
(307, 'd0f2b183-d89e-47be-95fd-07750512a33c', '3100203017PRG3-14', '18', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148705_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-14.png', '2026-09-23 07:31:46', '2026-09-23 07:31:46'),
(308, '9b7c0e30-3df4-48fa-915a-d00ba7974824', '3100203017PRG3-15', '19', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148766_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-15.png', '2026-09-23 07:32:46', '2026-09-23 07:32:46'),
(309, '6add1282-441d-4e91-a944-bfb977d62840', '3100203017PRG3-16', '20', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790148848_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-16.png', '2026-09-23 07:34:09', '2026-09-23 07:34:09'),
(310, '2c7191ed-5b39-43ef-b013-342ed09f7631', '3100203017PRG3-17', '42', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790217121_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-17.png', '2026-09-24 02:31:34', '2026-09-24 02:32:01'),
(312, '9073bd4a-785c-44b9-888a-c12c57d9ffc7', '3100203017PRG3-18', '43', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790228468_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-18.png', '2026-09-24 05:41:09', '2026-09-24 05:41:09'),
(313, 'c895ff8a-c58a-4fd5-9205-b488ea798914', '3100203017PRG3-19', '48', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790228552_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-19.png', '2026-09-24 05:42:33', '2026-09-24 05:42:33'),
(314, '15dffade-3e3c-4ce3-96bb-d29d1aa63b48', '3100203017PRG3-20', '49', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790228613_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-20.png', '2026-09-24 05:43:33', '2026-09-24 05:43:33'),
(315, 'ac5ef73d-d5e4-42d7-bd9f-f64051de874b', '3100203017PRG3-21', '50', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790228662_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-21.png', '2026-09-24 05:44:22', '2026-09-24 05:44:22'),
(316, 'a4c7242f-ea86-409b-b570-21b60ad70120', '3100203017PRG3-22', '51', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790228757_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-22.png', '2026-09-24 05:45:57', '2026-09-24 05:45:57'),
(317, '3747f6db-6d11-480f-a96e-24e6a8d0a93f', '3050204004PRG1-1', '115', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'DAIKIN 1,5PK', NULL, 1, 80, 7000000.00, '2023-04-12', 'Baik', 'Program', 'bmn/foto/1790228891_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004PRG1-1.png', '2026-09-24 05:48:11', '2026-09-24 05:48:11'),
(318, '89b1c6ea-3bc4-4575-b641-7f9e701cfd74', '3100203017PRG3-23', '52', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'PU', 'bmn/foto/1790228950_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-23.png', '2026-09-24 05:49:10', '2026-09-24 05:49:10'),
(319, '20d9bbc8-ced8-4ea3-ad05-868538cd88ff', '3100203017PRG3-24', '53', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790229002_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-24.png', '2026-09-24 05:50:02', '2026-09-24 05:50:02'),
(320, '9f3fb995-8ed0-4320-99cd-87eae2f0e2ca', '3100203017PRG3-25', '54', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790229040_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-25.png', '2026-09-24 05:50:40', '2026-09-24 05:50:40'),
(321, '638b9848-96a4-42dc-8c34-3434448789d1', '3050204004PRG1-2', '147', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'AC SPLIT LG 2 PK', NULL, 1, 80, 8880000.00, '2025-08-26', 'Baik', 'Program', 'bmn/foto/1790229632_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004PRG1-2.png', '2026-09-24 06:00:32', '2026-09-24 06:00:32'),
(322, '2985c526-3900-4a1a-8e92-8ab51a6cdc6d', '3100203017PRG3-26', '55', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790229704_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-26.png', '2026-09-24 06:01:45', '2026-09-24 06:01:45'),
(323, 'b29f516b-28fb-4aaf-a1ea-4504bfb8c2f3', '3100203017PRG3-27', '56', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790229751_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-27.png', '2026-09-24 06:02:31', '2026-09-24 06:02:31'),
(324, '3578adf3-2beb-4359-9fe7-eda4013870ca', '3100203017PRG3-28', '57', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790229821_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-28.png', '2026-09-24 06:03:41', '2026-09-24 06:03:41'),
(325, 'ce3f832f-f6d8-42e9-aa5f-d0b75c981867', '3050204004PRG1-3', '118', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'SHARP AH-X18ZY', NULL, 1, 80, 8991000.00, '2023-12-01', 'Baik', 'Program', 'bmn/foto/1790229830_barang.png', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004PRG1-3.png', '2026-09-24 06:03:50', '2026-09-24 06:03:50'),
(326, '2d2abfbc-fecf-4292-a439-ef2c63419d3a', '3100203017PRG3-29', '58', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790229879_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-29.png', '2026-09-24 06:04:39', '2026-09-24 06:04:39'),
(327, 'aedc0b21-9787-47f3-80b4-7ba37f0e8ccc', '3050206036PRG1-1', '23', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN / HWD-C580S', NULL, 1, 80, 3227000.00, '2024-02-21', 'Baik', 'Program', 'bmn/foto/1790229965_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036PRG1-1.png', '2026-09-24 06:06:05', '2026-09-24 06:06:05'),
(328, '54be5949-f7cb-4cb9-a97a-d21cf534738a', '3100203017PRG3-30', '59', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790230065_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-30.png', '2026-09-24 06:07:45', '2026-09-24 06:07:45'),
(329, 'ccc64474-107b-40b0-bfba-62a56bf548f7', '3050201003PRG1-1', '291', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790230087_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-1.png', '2026-09-24 06:08:07', '2026-09-24 06:08:07'),
(330, 'f119f955-dc0d-41b8-92c4-99c549947ea6', '3100203017PRG3-31', '60', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1499998.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790230609_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-31.png', '2026-09-24 06:09:15', '2026-09-24 06:16:49'),
(331, '9ccd7dc1-a687-44e1-967c-5605c69a82b5', '3050201003PRG1-2', '292', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790230315_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-2.png', '2026-09-24 06:11:55', '2026-09-24 06:11:55'),
(332, 'f1421d41-ebe8-46c9-a93a-3c8e9f79f1aa', '3050201003PRG1-3', '293', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790230387_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-3.png', '2026-09-24 06:13:07', '2026-09-24 06:13:07'),
(333, '0c5b888e-229c-45b6-bef8-062f57692543', '3050201003PRG1-4', '294', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790230462_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-4.png', '2026-09-24 06:14:22', '2026-09-24 06:14:22'),
(334, '94db5f83-1cff-46d1-8c39-2b2e42721bc5', '3050201003PRG1-5', '295', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790230637_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-5.png', '2026-09-24 06:17:17', '2026-09-24 06:17:17'),
(335, '00e1ad85-acb2-40b6-af0b-af9b809e1541', '3050201003PRG1-6', '386', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'Program', 'bmn/foto/1790230723_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-6.png', '2026-09-24 06:18:43', '2026-09-24 06:18:43'),
(336, 'dd271e50-39b2-46ee-b6a4-8c30422c2419', '3050201003PRG1-7', '389', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'Program', 'bmn/foto/1790230778_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-7.png', '2026-09-24 06:19:38', '2026-09-24 06:19:38'),
(337, 'f723ba30-dd0e-4cc7-8bc5-53de7b89e059', '3050201003PRG1-8', '393', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'Program', 'bmn/foto/1790230835_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-8.png', '2026-09-24 06:20:35', '2026-09-24 06:20:35'),
(338, 'f8ab9e7c-f280-487c-8951-3246da121b53', '3100203017PRG3-32', '61', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790230836_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-32.png', '2026-09-24 06:20:36', '2026-09-24 06:20:36'),
(339, '810b52f8-0a90-4e15-8a9f-1f0153409cef', '3100203017PRG3-33', '63', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790230885_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-33.png', '2026-09-24 06:21:25', '2026-09-24 06:21:25'),
(340, 'd6f9e3b3-4437-4918-8182-b7258bd913a1', '3050201003PRG1-9', '394', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'G KENEDY WORKING CHAIR LOW BACK', NULL, 1, 80, 1048050.00, '2025-09-26', 'Baik', 'Program', 'bmn/foto/1790230915_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-9.png', '2026-09-24 06:21:55', '2026-09-24 06:21:55'),
(341, 'c03afae9-107b-4ca8-a7b1-388fc6686725', '3050201003PRG1-10', '368', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA / KURSI PROGRAM', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Program', 'bmn/foto/1790231100_barang.jpeg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-10.png', '2026-09-24 06:25:00', '2026-09-24 06:25:00'),
(342, 'f8e19dd6-e3fb-4c77-b093-c44fc8eb148d', '3050201003PRG1-11', '307', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR RED', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790231193_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-11.png', '2026-09-24 06:26:33', '2026-09-24 06:26:33'),
(343, 'd98b9b87-9cd1-4056-a42e-883b35906888', '3050201003PRG1-13', '308', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAF CHAIR RED', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790231243_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-13.png', '2026-09-24 06:27:23', '2026-09-24 06:27:23'),
(344, '789ce6a8-505d-4ece-9c42-204f3070e432', '3050201003PRG1-12', '309', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAF CHAIR RED', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790236653_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-12.png', '2026-09-24 06:28:43', '2026-09-24 07:57:33'),
(345, 'faac01ae-58f2-43c7-9a33-9a0184a65fe4', '3050201003PRG1-14', '310', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAF CHAIR RED', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790231747_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-14.png', '2026-09-24 06:35:47', '2026-09-24 06:35:47'),
(346, '8cbea960-8b2e-4596-bbaa-34a6faf5a450', '3050201003PRG1-15', '377', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA INFORMA TIPE G-ZAKI WORKING CHAIR LOMBACK', NULL, 1, 80, 628500.00, '2025-06-11', 'Baik', 'Program', 'bmn/foto/1790231815_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-15.png', '2026-09-24 06:36:55', '2026-09-24 06:36:55'),
(347, 'bb92199c-ebe2-4f0a-8062-bffc3bf67054', '3100203017PRG3-34', '64', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790233386_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-34.png', '2026-09-24 07:03:06', '2026-09-24 07:03:06'),
(348, 'f6336c43-748b-4de9-aa7a-461997837d77', '3100203017PRG3-35', '65', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790233431_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-35.png', '2026-09-24 07:03:51', '2026-09-24 07:03:51'),
(349, 'a30e959b-91b5-458a-8835-e55d79f60e20', '3100203017PRG3-36', '66', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790233481_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-36.png', '2026-09-24 07:04:41', '2026-09-24 07:04:41'),
(350, '1448ae7a-7354-446c-b61b-4bf1baa894c6', '3050201003PRG1-16', '311', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAF CHAIR RED', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790233586_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-16.png', '2026-09-24 07:06:26', '2026-09-24 07:58:37'),
(351, '26c7d6fc-6f23-4be9-b66b-673883a4c100', '3100203017PRG3-37', '67', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790234450_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-37.png', '2026-09-24 07:20:50', '2026-09-24 07:20:50'),
(352, '7480a63f-be75-4ce3-b450-c9fd57cff790', '3100203017PRG3-38', '78', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790234565_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-38.png', '2026-09-24 07:22:45', '2026-09-24 07:34:42'),
(353, '8708d831-caf3-4a38-acb0-a9400cfdd37f', '3100203017PRG3-39', '79', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790234608_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-39.png', '2026-09-24 07:23:28', '2026-09-24 07:40:00'),
(354, '558e19a9-76c2-4584-9c79-61eedbf5e76f', '3100203017PRG3-40', '80', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790234648_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-40.png', '2026-09-24 07:24:08', '2026-09-24 07:40:13'),
(355, '6f27083d-1033-40ce-aec0-095145c36e91', '3100203017PRG3-41', '81', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790234698_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-41.png', '2026-09-24 07:24:58', '2026-09-24 07:40:25'),
(356, '4f2e7e2d-6c54-4948-94b8-e6469ff4ea4c', '3100203017PRG3-42', '82', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790234856_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-42.png', '2026-09-24 07:27:36', '2026-09-24 07:42:07'),
(357, '605f0807-6079-4941-b8ce-04b64f02ec0d', '3050201003PRG1-17', '312', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAF CHAIR RED', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790235767_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-17.png', '2026-09-24 07:42:47', '2026-09-24 07:59:00'),
(358, '2db607a9-9f71-4e79-b5e5-66e6cb53f1c6', '3100203017PRG3-43', '83', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790235841_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-43.png', '2026-09-24 07:44:01', '2026-09-24 07:44:01'),
(359, '717d6e6c-ec05-459f-a2f0-ecad101b1373', '3100203017PRG3-44', '84', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790235882_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-44.png', '2026-09-24 07:44:43', '2026-09-24 07:44:43'),
(360, 'b13cd78f-5c0f-4c65-9046-ff1af74d3d97', '3050201003PRG1-18', '313', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAF CHAIR RED', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790235887_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG1-18.png', '2026-09-24 07:44:47', '2026-09-24 07:56:23'),
(361, '22ae4833-0dd5-48b0-bede-3da19e7599cd', '3100203017PRG3-45', '85', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790235923_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-45.png', '2026-09-24 07:45:23', '2026-09-24 07:45:23'),
(362, 'acab8e16-419f-4d7f-a25d-7d33db1a52ff', '3100203017PRG3-46', '87', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790235967_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-46.png', '2026-09-24 07:46:07', '2026-09-24 07:46:07'),
(363, '3a029cc7-c0ad-46e8-bb09-81a9eca353fe', '3100203017PRG3-47', '88', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790236078_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-47.png', '2026-09-24 07:47:58', '2026-09-24 07:47:58'),
(364, '27fa7318-a5e0-4bce-b6cd-8479bca5ee74', '3100203017PRG3-48', '90', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790236138_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-48.png', '2026-09-24 07:48:58', '2026-09-24 07:48:58'),
(365, 'e4bd40e0-e9e1-41ea-a416-dff28dabca3a', '3100203017PRG3-49', '91', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790236178_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-49.png', '2026-09-24 07:49:38', '2026-09-24 07:49:38'),
(366, 'a90f0f1a-223c-4bc9-a752-1044d4f02968', '3100203017PRG3-50', '92', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 750000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790236216_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-50.png', '2026-09-24 07:50:16', '2026-09-24 07:50:16'),
(367, 'b088c8d8-9d94-4d8b-a529-9ca8c3f7a176', '3100203017PRG3-51', '95', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1300000.00, '2019-04-24', 'Baik', 'Program', 'bmn/foto/1790236267_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-51.png', '2026-09-24 07:51:07', '2026-09-24 07:51:07'),
(368, 'd3fdcd85-6f3a-4592-a20a-ff0b5fa8a619', '3100203017PRG3-52', '96', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1300000.00, '2019-04-24', 'Baik', 'Program', 'bmn/foto/1790236305_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-52.png', '2026-09-24 07:51:45', '2026-09-24 07:51:45'),
(369, 'df19d4d4-0f09-4316-ab8d-832282456fd0', '3100203017PRG3-53', '97', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1300000.00, '2019-04-24', 'Baik', 'Program', 'bmn/foto/1790236532_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-53.png', '2026-09-24 07:55:32', '2026-09-24 07:55:32'),
(370, 'f6cf8e0f-63f8-41b6-ad21-40e7b9b97020', '3100203017PRG3-54', '99', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1300000.00, '2019-04-24', 'Baik', 'Program', 'bmn/foto/1790236649_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-54.png', '2026-09-24 07:57:29', '2026-09-24 07:57:29'),
(371, '5f72461f-85b0-463d-9066-cb6d148516f1', '3100203017PRG3-55', '100', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1300000.00, '2019-04-24', 'Baik', 'Program', 'bmn/foto/1790236684_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-55.png', '2026-09-24 07:58:04', '2026-09-24 07:58:04'),
(372, 'a92be829-52e5-47f5-9fbe-d6323c945ca9', '3100203017PRG3-56', '101', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1300000.00, '2019-04-24', 'Baik', 'Program', 'bmn/foto/1790297818_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-56.png', '2026-09-25 00:56:58', '2026-09-25 00:56:58'),
(373, '68c5f9a9-5d9e-4541-8ba3-919f0568f036', '3100203017PRG3-57', '4', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'HARDISK REC', NULL, 1, 80, 5500000.00, '2016-03-08', 'Baik', 'Program', 'bmn/foto/1790300369_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-57.png', '2026-09-25 01:39:29', '2026-09-25 01:39:29'),
(374, '9ca16716-7df2-4b64-b575-5a8ad4909731', '3100203017PRG3-58', '5', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'HARDISK REC', NULL, 1, 80, 5500000.00, '2016-03-08', 'Baik', 'Program', 'bmn/foto/1790301411_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-58.png', '2026-09-25 01:56:51', '2026-09-25 01:56:51'),
(375, '5d38e74c-8dc3-4fe5-bdc6-029d8b13228a', '3100203017PRG3-59', '29', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790301555_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-59.png', '2026-09-25 01:59:15', '2026-09-25 01:59:15'),
(376, '8a600798-2a54-4e97-a0a9-d9d302fce266', '3100203017PRG3-60', '32', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790301645_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-60.png', '2026-09-25 02:00:45', '2026-09-25 02:00:45'),
(377, '57319b23-493d-4737-b44c-82b8efeb2b42', '3100203017PRG3-61', '62', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 1TB', NULL, 1, 80, 1500000.00, '2018-04-24', 'Baik', 'Program', 'bmn/foto/1790301764_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-61.png', '2026-09-25 02:02:44', '2026-09-25 02:06:41'),
(378, '8b14157b-be11-4a71-893c-2c9d651044f8', '3100102002PRG1-1', '47', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A1402ZA / CORE i7-1260P / 14\"', NULL, 1, 80, 15000000.00, '2023-03-07', 'Baik', 'Program', 'bmn/foto/1790302058_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002PRG1-1.png', '2026-09-25 02:07:38', '2026-09-25 02:07:38'),
(379, '350d63fc-7137-403d-b467-a7a5d7caa9d1', '3050104001PRG1-1', '19', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA 2 PINTU', NULL, 1, 80, 3960000.00, '2021-05-27', 'Baik', 'Program', 'bmn/foto/1790302192_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001PRG1-1.png', '2026-09-25 02:09:52', '2026-09-25 02:09:52'),
(380, '5d697bfa-5ebd-4e54-a809-29c9b0509d0c', '3100203017PRG3-62', '107', 'External/ Portable Hardisk', 'MESIN PERALATAN KHUSUS TIK', 'Tandberg RDX sn 88821097969, 88821097970, 88821068998, 88821097968, 88821097967', NULL, 1, 80, 207000000.00, '2024-11-07', 'Baik', 'Program', 'bmn/foto/1790302201_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203017PRG3-62.png', '2026-09-25 02:10:01', '2026-09-25 02:10:01'),
(381, 'c2cb3ec4-07e3-43e8-8417-7432d7b3c37d', '3100102002PRG1-2', '54', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'LAPTOP GRAFIS / ASUS TUF A15 FA507UV-R946KLM', NULL, 1, 80, 27830000.00, '2024-12-05', 'Baik', 'Program', 'bmn/foto/1790302362_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002PRG1-2.png', '2026-09-25 02:12:42', '2026-09-25 02:12:42'),
(382, 'ac170444-de2d-4223-b1cc-a8d8c1e844b2', '3100201012PRG3-1', '7', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 2, 80, 800000.00, '2013-08-31', 'Baik', 'Program', 'bmn/foto/1790302369_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012PRG3-1.png', '2026-09-25 02:12:49', '2026-09-25 02:13:57'),
(383, '1be3f2b4-8dd5-4c5a-aba6-23bdebf16ed7', '3100201012PRG3-2', '8', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 800000.00, '2013-08-31', 'Baik', 'Program', 'bmn/foto/1790302644_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012PRG3-2.png', '2026-09-25 02:17:24', '2026-09-25 02:17:24'),
(384, 'b3889cd7-9961-4183-82e8-4354656b35f8', '3100201012PRG3-3', '9', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 800000.00, '2013-08-31', 'Baik', 'Program', 'bmn/foto/1790302706_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012PRG3-3.png', '2026-09-25 02:18:26', '2026-09-25 02:18:26'),
(385, '592cd903-0c85-4a0d-a2e6-37535c638b84', '3100201012PRG3-4', '10', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 800000.00, '2013-08-31', 'Baik', 'Program', 'bmn/foto/1790302767_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012PRG3-4.png', '2026-09-25 02:19:27', '2026-09-25 02:19:27'),
(386, '70125a71-f31d-44ad-b54d-82decd7adeea', '3050104001PRG1-2', '28', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA Lemari Besi Pintu Swing', NULL, 1, 80, 2988000.00, '2023-07-26', 'Baik', 'Program', 'bmn/foto/1790302792_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001PRG1-2.png', '2026-09-25 02:19:52', '2026-09-25 02:19:52'),
(387, 'd11156d5-48ed-4a5e-ad36-9eec1ed3c6a1', '3100201012PRG3-5', '12', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 700000.00, '2013-10-11', 'Baik', 'Program', 'bmn/foto/1790302836_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012PRG3-5.png', '2026-09-25 02:20:36', '2026-09-25 02:20:36'),
(388, 'f8685b35-4995-412b-be43-b40446555d78', '3100201012PRG3-6', '13', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE 500GB', NULL, 1, 80, 700000.00, '2013-11-10', 'Baik', 'Program', 'bmn/foto/1790302901_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012PRG3-6.png', '2026-09-25 02:21:41', '2026-09-25 02:21:41'),
(389, '0d33f808-692a-46b9-a093-df82a13a462a', '3050104015PRG1-1', '15', 'Locker', 'MESIN PERALATAN NON TIK', 'INFORMA - LOCKER 15 DOOR DEPTH 50 WHITE', NULL, 1, 80, 4088100.00, '2025-11-13', 'Baik', 'Program', 'bmn/foto/1790302962_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104015PRG1-1.png', '2026-09-25 02:22:42', '2026-09-25 02:22:42'),
(390, '9624e3c1-7f75-445a-974d-adceba8753ed', '3100201012PRG3-7', '19', 'Hard Disk', 'MESIN PERALATAN KHUSUS TIK', 'SEAGATE', NULL, 1, 80, 750000.00, '2013-12-17', 'Baik', 'Program', 'bmn/foto/1790302990_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100201012PRG3-7.png', '2026-09-25 02:23:10', '2026-09-25 02:23:10'),
(392, 'e553a43b-24f0-4d03-80e3-06e28de7aeb7', '3050201003PRG3-1', '342', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'Program', 'bmn/foto/1790303075_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG3-1.png', '2026-09-25 02:24:35', '2026-09-25 02:26:18'),
(393, 'b2d41c50-b54e-4c03-aff2-0f466131db48', '3050201003PRG3-2', '343', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-04-12', 'Baik', 'Program', 'bmn/foto/1790303117_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG3-2.png', '2026-09-25 02:25:17', '2026-09-25 02:26:24'),
(394, '7f11b4e4-ce3b-446c-9054-3a77c5ecab25', '3050201003PRG3-3', '285', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'ZENIA STAFF CHAIR BLUE', NULL, 1, 80, 809000.00, '2020-12-31', 'Baik', 'Program', 'bmn/foto/1790303256_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG3-3.png', '2026-09-25 02:27:36', '2026-09-25 02:27:36'),
(395, 'a7f50285-33c0-40df-80ec-45551717dd59', '3100102002PRG3-1', '85', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS / TUF GAMING A15', NULL, 1, 80, 12750000.00, '2026-03-03', 'Baik', 'Program', 'bmn/foto/1790303379_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002PRG3-1.png', '2026-09-25 02:29:39', '2026-09-25 02:29:39'),
(396, 'f5b4293c-e51e-4ac1-98e6-edb46f5f56e3', '3050201002PRG3-1', '98', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'MEJA KERJA KAYU JATI', NULL, 1, 80, 14500000.00, '2021-05-27', 'Baik', 'Program', 'bmn/foto/1790303547_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG3-1.png', '2026-09-25 02:32:27', '2026-09-25 02:32:27'),
(397, 'f9c2ee3b-503f-4bcc-be97-300cadc194df', '3050201002PRG3-2', '147', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Program', 'bmn/foto/1790303777_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG3-2.png', '2026-09-25 02:36:17', '2026-09-25 02:36:17'),
(398, '39851ef4-d4e3-43f9-af30-9b545fa857d5', '3050201002PRG1-4', '118', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Program', 'bmn/foto/1790304864_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-4.png', '2026-09-25 02:54:24', '2026-09-25 02:54:24'),
(399, '1fe76cc3-2fcd-49ea-acdf-66d8d2c9b9c3', '3050201002PRG1-5', '119', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Program', 'bmn/foto/1790304941_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-5.png', '2026-09-25 02:55:41', '2026-09-25 02:55:41'),
(400, 'e2ff40b3-6cc5-4a58-a8fc-4b19eb35a158', '3050201002PRG1-9', '120', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Program', 'bmn/foto/1790305035_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-9.png', '2026-09-25 02:57:15', '2026-09-25 02:57:15'),
(401, '9245b364-6ae5-47ce-a621-5741b4edddce', '3050201002PRG1-10', '121', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Program', 'bmn/foto/1790305097_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-10.png', '2026-09-25 02:58:17', '2026-09-25 02:58:17'),
(402, 'a8e08815-0bae-4efc-a6bf-63e960652bd7', '3050201002PRG1-11', '150', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA GUINI MEJA KANTOR', NULL, 1, 80, 1717000.00, '2025-08-27', 'Baik', 'Program', 'bmn/foto/1790305231_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-11.png', '2026-09-25 03:00:31', '2026-09-25 03:00:31'),
(403, '96155c8f-eca7-4b92-a199-0d85c8b79075', '3050201002PRG3-3', '145', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Program', 'bmn/foto/1790305357_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG3-3.png', '2026-09-25 03:02:38', '2026-09-25 03:02:38'),
(404, 'a01ad949-6079-49b6-93a9-ff6bbbdb06e4', '3050201002PRG3-4', '148', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Program', 'bmn/foto/1790305397_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG3-4.png', '2026-09-25 03:03:17', '2026-09-25 03:03:17');
INSERT INTO `bmn_barangs` (`id`, `uuid`, `kode_barang`, `nup`, `nama_barang`, `kategori`, `merk`, `nomor_seri`, `jumlah`, `persentase_kondisi`, `nilai_perolehan`, `tanggal_perolehan`, `kondisi`, `unit_kerja`, `foto`, `ruangan`, `pengguna_id`, `posisi`, `asal_pengadaan`, `peruntukan`, `catatan`, `qr_code`, `created_at`, `updated_at`) VALUES
(405, 'fd2225a7-56ef-43d5-a34f-2b12a1cbb761', '3050201002PRG1-12', '151', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA GUINI MEJA KANTOR', NULL, 1, 80, 1717000.00, '2025-08-27', 'Baik', 'Program', 'bmn/foto/1790305458_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-12.png', '2026-09-25 03:04:18', '2026-09-25 03:04:18'),
(406, '91fd9635-586c-4145-9a2d-a05b7ac780db', '3100102001PRG3-1', '63', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC ALL IN ONE / MY PC AXIOO/ INTEL CORE i5', NULL, 1, 80, 14500000.00, '2023-12-01', 'Baik', 'Program', 'bmn/foto/1790305465_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PRG3-1.png', '2026-09-25 03:04:25', '2026-09-25 03:04:25'),
(407, '6bb6e5ad-0164-43cd-a11d-369baa691dfb', '3100102001PRG3-2', '83', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC EDITING (RAKITAN) PROCESSOR INTEL CORE i9-14900K / MONITOR AOC Q27G4F-27\'\' FHD', NULL, 1, 80, 67500000.00, '2024-12-17', 'Baik', 'Program', 'bmn/foto/1790305527_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PRG3-2.png', '2026-09-25 03:05:27', '2026-09-25 03:05:27'),
(408, 'dc372814-9a08-44c1-a845-e4d5118b9ccf', '3050201002PRG1-13', '153', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA GUINI MEJA KANTOR', NULL, 1, 80, 1717000.00, '2025-08-27', 'Baik', 'Program', 'bmn/foto/1790305582_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-13.png', '2026-09-25 03:06:22', '2026-09-25 03:06:22'),
(409, 'aa60c28d-1d94-458b-9522-7c89c36909d9', '3100102001PRG3-3', '43', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'LCD SAMSUNG 19\"/PROSESOR 9TH GEN/i5-9400F', NULL, 1, 80, 11910000.00, '2021-02-22', 'Baik', 'Program', 'bmn/foto/1790305594_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PRG3-3.png', '2026-09-25 03:06:34', '2026-09-25 03:06:34'),
(410, 'ddf74c5b-0894-4fc1-863c-b441dcd17a72', '3100203003PRG3-1', '90', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2445000.00, '2023-03-08', 'Baik', 'Program', 'bmn/foto/1790305724_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003PRG3-1.png', '2026-09-25 03:08:44', '2026-09-25 03:08:44'),
(411, '4a5efa36-d146-4aee-8397-8d924456c666', '3050206002PRG3-1', '113', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG 43 INCH', NULL, 1, 80, 4430000.00, '2023-12-04', 'Baik', 'Program', 'bmn/foto/1790305823_barang.jpg', 'Dokpus', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002PRG3-1.png', '2026-09-25 03:10:23', '2026-09-25 03:10:23'),
(412, '62f8758e-c701-438f-a672-8c0c4dd497e1', '3050204004PRG2-1', '82', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'SHARP 2PK JETSTREM', NULL, 1, 80, 6985000.00, '2017-05-12', 'Baik', 'Program', 'bmn/foto/1790306119_barang.jpg', 'Ruang Tata Rias', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004PRG2-1.png', '2026-09-25 03:15:19', '2026-09-25 03:15:19'),
(413, '0823efbf-65fb-44f8-94b8-77e7fc43f5a0', '3050201003PRG2-1', '315', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA/KURSI KERJA STAF', NULL, 1, 80, 1200000.00, '2021-05-27', 'Baik', 'Program', 'bmn/foto/1790306228_barang.jpg', 'Ruang Tata Rias', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG2-1.png', '2026-09-25 03:17:08', '2026-09-25 03:17:08'),
(414, '9b3b1a61-7c69-479d-a06a-a9c508fc93df', '3050201003PRG2-2', '316', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA/KURSI KERJA STAF', NULL, 1, 80, 1200000.00, '2021-05-27', 'Baik', 'Program', 'bmn/foto/1790306280_barang.jpg', 'Ruang Tata Rias', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003PRG2-2.png', '2026-09-25 03:18:00', '2026-09-25 03:18:00'),
(415, 'de9a304c-b67f-47d6-b8f9-d6ad9db01c7a', '3050204004TU1-1', '124', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'LG 1,5PK / H12TN4', NULL, 1, 80, 5832000.00, '2024-02-21', 'Baik', 'TU', 'bmn/foto/1790556012_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TU1-1.png', '2026-09-28 00:40:12', '2026-09-28 00:40:12'),
(416, 'f4c364b3-13ea-4d10-a8d9-18d4650d0391', '3050201003TU1-1', '284', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'COUNCIL VISITOR CHAIR BLACK', NULL, 1, 80, 1149000.00, '2020-12-31', 'Baik', 'TU', 'bmn/foto/1790556121_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU1-1.png', '2026-09-28 00:42:02', '2026-09-28 00:42:02'),
(417, 'be0387cf-5c62-4a49-8425-61cf697bea7c', '3050201003TU1-2', '317', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA/KURSI KERJA STAF', NULL, 1, 80, 1200000.00, '2021-05-27', 'Baik', 'TU', 'bmn/foto/1790556271_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU1-2.png', '2026-09-28 00:44:31', '2026-09-28 00:44:31'),
(418, 'f303af16-9a21-4571-b916-51b609cf734d', '3050201003TU1-3', '326', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'Kursi Kerja Putar Ichiko / Kursi Kerja Putar Indachi 1 / Ichiko 7', NULL, 1, 80, 1746250.00, '2023-10-18', 'Baik', 'TU', 'bmn/foto/1790556434_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU1-3.png', '2026-09-28 00:47:15', '2026-09-28 00:47:15'),
(419, 'ae0a4cda-869e-4a90-807d-1e79b7310698', '3100102002TU1-1', '37', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A416E / 14\" / i7', NULL, 1, 80, 15440000.00, '2022-05-31', 'Baik', 'TU', 'bmn/foto/1790556515_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002TU1-1.png', '2026-09-28 00:48:35', '2026-09-28 00:48:35'),
(420, '4e17dbe8-cf82-47a8-95e6-88b1a95732e8', '3050104001TU1-1', '25', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'LEMARI PUTIH 4 PINTU INFORMA', NULL, 1, 80, 3975000.00, '2022-06-28', 'Baik', 'TU', 'bmn/foto/1790556612_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001TU1-1.png', '2026-09-28 00:50:12', '2026-09-28 00:50:12'),
(421, '3321ae4f-d34e-43dc-805f-4f1aa243ce5f', '3050201001TU1-1', '7', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA/MEJA KERJA STAF', NULL, 1, 80, 3000000.00, '2021-05-27', 'Baik', 'TU', 'bmn/foto/1790557100_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001TU1-1.png', '2026-09-28 00:51:17', '2026-09-28 00:58:20'),
(422, 'ca9030f4-4dde-4fe7-b09c-075940b1fda5', '3050201001TU1-2', '11', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA KANA MEJA KANTOR / WARNA PUTIH', NULL, 1, 80, 2028000.00, '2025-12-15', 'Baik', 'TU', 'bmn/foto/1790556745_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001TU1-2.png', '2026-09-28 00:52:25', '2026-09-28 00:52:25'),
(423, '1e928c81-539f-475c-bd12-08a951da2bc8', '3050201002TU1-1', '127', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'NEGEN WORKSTATION', NULL, 1, 80, 3053000.00, '2023-12-04', 'Baik', 'TU', 'bmn/foto/1790556861_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002TU1-1.png', '2026-09-28 00:54:21', '2026-09-28 00:55:38'),
(424, '01030672-4103-4226-bf95-9d065b0692cd', '3050201002TU1-2', '129', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'MAINE STAFF DESK 120 KALDI WOOD', NULL, 1, 80, 2451000.00, '2024-02-26', 'Baik', 'TU', 'bmn/foto/1790557015_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002TU1-2.png', '2026-09-28 00:56:55', '2026-09-28 00:56:55'),
(425, 'c991985b-88c5-43cd-83cd-485d365c4366', '3050201002TU1-3', '130', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'MAINE STAFF DESK 120 KALDI WOOD', NULL, 1, 80, 2451000.00, '2024-02-26', 'Baik', 'TU', 'bmn/foto/1790557174_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002TU1-3.png', '2026-09-28 00:59:34', '2026-09-28 00:59:34'),
(426, '1972f2c5-79e0-4eb5-9fe4-e33232a92a30', '3100102001TU1-1', '52', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'Rakitan i7 / VenomRX / Sky Walker / Monitor Pro MP241', NULL, 1, 80, 15200000.00, '2022-05-31', 'Baik', 'TU', 'bmn/foto/1790557524_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001TU1-1.png', '2026-09-28 01:05:24', '2026-09-28 01:05:24'),
(427, 'bac568d2-34b1-4431-8d9d-af0657c12ca6', '3050201002PRG1-14', '154', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA GUINI MEJA KANTOR', NULL, 1, 80, 1717000.00, '2025-08-27', 'Baik', 'Program', 'bmn/foto/1790558076_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-14.png', '2026-09-28 01:14:36', '2026-09-28 01:14:36'),
(428, 'a61b931d-11d7-4a81-ab2e-7372322c0877', '3050201002PRG1-15', '131', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'MAINE STAFF DESK 120 KALDI WOOD', NULL, 1, 80, 2451000.00, '2024-02-26', 'Baik', 'Program', 'bmn/foto/1790558237_barang.jpeg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-15.png', '2026-09-28 01:17:17', '2026-09-28 01:17:17'),
(429, '380413a1-06f4-489a-a0ea-ee4bf808ad5e', '3050201002PRG1-16', '155', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA GUINI MEJA KANTOR', NULL, 1, 80, 1717000.00, '2025-08-27', 'Baik', 'Program', 'bmn/foto/1790558418_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-16.png', '2026-09-28 01:20:18', '2026-09-28 01:20:18'),
(430, 'bab1b036-ff93-4842-8bc8-7a525b2c2232', '3050201002PRG1-17', '143', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Program', 'bmn/foto/1790558750_barang.jpeg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002PRG1-17.png', '2026-09-28 01:25:50', '2026-09-28 01:25:50'),
(431, 'd51b74ad-690c-4e22-a43b-3c4829d4419e', '3100102001PRG1-1', '42', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'LCD SAMSUNG 19\"/PROSESOR 9TH GEN/i5-9400F', NULL, 1, 80, 11910000.00, '2021-02-22', 'Baik', 'Program', 'bmn/foto/1790558939_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PRG1-1.png', '2026-09-28 01:28:59', '2026-09-28 01:28:59'),
(432, 'fbc0a7ac-ad8e-493f-a274-c676cb2c6798', '3100102001TU1-2', '65', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC ALL IN ONE / MY PC AXIOO/ INTEL CORE i5', NULL, 1, 80, 14500000.00, '2023-12-01', 'Baik', 'TU', 'bmn/foto/1790558950_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001TU1-2.png', '2026-09-28 01:29:10', '2026-09-28 01:29:10'),
(433, '80c8f523-0d1f-4014-8ac5-3ecde88f7fc5', '3100102001TU1-3', '68', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'AIO LENOVO A340-221CB / Intel Core i5 / W10 Touch Screen 22\"', NULL, 1, 80, 12600000.00, '2024-02-21', 'Baik', 'TU', 'bmn/foto/1790559023_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001TU1-3.png', '2026-09-28 01:30:23', '2026-09-28 01:30:23'),
(434, '7d8d939c-44be-4535-b213-872b3b0fab43', '3100203003TU1-1', '86', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2445000.00, '2023-03-08', 'Baik', 'TU', 'bmn/foto/1790559101_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003TU1-1.png', '2026-09-28 01:31:41', '2026-09-28 01:31:41'),
(435, 'b49f0aee-a2b2-4c33-abde-fb847f7f44e9', '3100203003TU1-2', '105', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2541650.00, '2024-02-28', 'Baik', 'TU', 'bmn/foto/1790559162_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003TU1-2.png', '2026-09-28 01:32:42', '2026-09-28 01:32:42'),
(436, '32c77eb0-bf75-42e9-aa95-68baa59404da', '3100102001PRG1-2', '89', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850W', NULL, 1, 80, 9450000.00, '2025-08-15', 'Baik', 'Program', 'bmn/foto/1790559169_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PRG1-2.png', '2026-09-28 01:32:49', '2026-09-28 01:32:49'),
(437, '2a33e2b1-2ec2-4e08-bb60-59d01311532e', '3100203003TU1-3', '108', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON ECOTANK L5290', NULL, 1, 80, 4500000.00, '2025-01-30', 'Baik', 'TU', 'bmn/foto/1790559226_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003TU1-3.png', '2026-09-28 01:33:46', '2026-09-28 01:33:46'),
(438, '8488a239-47df-4c2b-bf57-383a8d8a3bd8', '3100102001PRG1-4', '91', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850WS', NULL, 1, 80, 9450000.00, '2025-08-15', 'Baik', 'Program', NULL, 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PRG1-4.png', '2026-09-28 01:34:26', '2026-09-28 01:34:26'),
(439, '72d8a967-919e-40af-8d41-754450a38094', '3100102009TU1-1', '1', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'XIAOMI PAD 6 / KEYBOARD / SMART PEN', NULL, 1, 80, 7990000.00, '2023-12-04', 'Baik', 'TU', 'bmn/foto/1790559290_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009TU1-1.png', '2026-09-28 01:34:50', '2026-09-28 01:34:50'),
(440, 'a1defb59-7661-4f81-88cb-d0a62ef7f4a2', '3100102001PRG1-5', '92', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B3850WS', NULL, 1, 80, 9450000.00, '2025-08-15', 'Baik', 'Program', 'bmn/foto/1790559334_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001PRG1-5.png', '2026-09-28 01:35:34', '2026-09-28 01:35:34'),
(441, 'a3166c05-9144-4ca6-9480-c4b6fd839ac2', '3050206002TU1-1', '114', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG 43 INCH', NULL, 1, 80, 4430000.00, '2023-12-04', 'Baik', 'TU', 'bmn/foto/1790559371_barang.jpg', 'Kasubag Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002TU1-1.png', '2026-09-28 01:36:11', '2026-09-28 01:36:11'),
(442, 'db9e9b5d-b37a-47f8-85ec-f12f4950cc73', '3100203003PRG1-2', '95', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2687000.00, '2023-12-01', 'Baik', 'Program', 'bmn/foto/1790559628_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003PRG1-2.png', '2026-09-28 01:40:28', '2026-09-28 01:40:28'),
(443, 'dc456a44-69ed-45f4-90d8-8d8cf54f669a', '3050204004TU3-1', '119', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'SHARP AH-X18ZY / 2PK INVERTER', NULL, 1, 80, 8991000.00, '2023-12-01', 'Baik', 'TU', 'bmn/foto/1790559749_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TU3-1.png', '2026-09-28 01:42:29', '2026-09-28 01:42:29'),
(444, 'fe6f86fb-7103-4f62-afda-49ea35da6902', '3050201005PRG1-1', '55', 'Sice', 'MESIN PERALATAN NON TIK', 'KURSI TAMU', NULL, 1, 80, 2596000.00, '2011-03-09', 'Baik', 'Program', 'bmn/foto/1790559760_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201005PRG1-1.png', '2026-09-28 01:42:40', '2026-09-28 01:42:40'),
(445, '07cc3cc6-88d2-42b7-b417-9f5247bb8e88', '3100102009PRG1-1', '19', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET REDMI PAD PRO', NULL, 1, 80, 5000000.00, '2025-09-09', 'Baik', 'Program', 'bmn/foto/1790559846_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009PRG1-1.png', '2026-09-28 01:44:06', '2026-09-28 01:44:06'),
(446, '6a962655-d5ff-4396-b952-f9715538dfce', '3100102009PRG1-2', '3', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'XIAOMI PAD 6 / KEYBOARD / SMART PEN', NULL, 1, 80, 7990000.00, '2023-12-04', 'Baik', 'Program', 'bmn/foto/1790559904_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009PRG1-2.png', '2026-09-28 01:45:05', '2026-09-28 01:45:05'),
(447, '80ac8689-7045-40c6-824b-756796fa3cb4', '3100102009PRG1-3', '22', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET XIAOMI REDMI PAD 2', NULL, 1, 80, 3780500.00, '2025-11-07', 'Baik', 'Program', 'bmn/foto/1790560003_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009PRG1-3.png', '2026-09-28 01:46:43', '2026-09-28 01:46:43'),
(448, '8909f6c6-acf6-46d2-8edf-054f0cbbac72', '3050201003TU3-1', '283', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'FRANCESSCO VISITOR CHAIRGREY', NULL, 1, 80, 2198000.00, '2020-12-31', 'Baik', 'TU', 'bmn/foto/1790560039_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU3-1.png', '2026-09-28 01:47:19', '2026-09-28 01:47:19'),
(449, '68482419-55c4-4871-8f42-0884acbd6c16', '3050206002PRG1-1', '129', 'Televisi', 'MESIN PERALATAN NON TIK', 'XIAOMI TV A 43 FD 2025', NULL, 1, 80, 3800000.00, '2025-12-24', 'Baik', 'Program', 'bmn/foto/1790560090_barang.jpg', 'Program', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002PRG1-1.png', '2026-09-28 01:48:10', '2026-09-28 01:48:10'),
(450, 'fc7f2509-7d8b-4888-abd6-ab97b3c73a50', '3050201003TU3-2', '331', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA BUSA / INFORMA ROES 163 VISITOR CHAIR BLUE', NULL, 1, 80, 1405000.00, '2023-12-04', 'Baik', 'TU', 'bmn/foto/1790560214_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU3-2.png', '2026-09-28 01:50:14', '2026-09-28 01:50:14'),
(451, '560cecc2-74ff-4760-9dcf-ce22c2e06ad4', '3050206036TU4-1', '12', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN/Premium Bottom Loading/HWD-C590G-BK', NULL, 1, 80, 2768000.00, '2023-07-25', 'Baik', 'TU', 'bmn/foto/1790560222_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036TU4-1.png', '2026-09-28 01:50:22', '2026-09-28 01:50:22'),
(452, '4b341b67-01d6-4a48-8a9c-5d5ffe2a593d', '3050201003TU3-3', '332', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI KERJA BUSA / INFORMA ROES 163 VISITOR CHAIR BLUE', NULL, 1, 80, 1405000.00, '2023-12-04', 'Baik', 'TU', 'bmn/foto/1790560278_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU3-3.png', '2026-09-28 01:51:18', '2026-09-28 01:51:18'),
(453, '68cfe2ac-a526-4919-8946-8ad6b253bd83', '3050201003TU4-1', '319', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'Kursi Kerja Putar Indachi', NULL, 1, 80, 1746250.00, '2023-10-18', 'Baik', 'TU', 'bmn/foto/1790560305_barang.jpeg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU4-1.png', '2026-09-28 01:51:45', '2026-09-28 01:51:45'),
(454, '79918271-0d36-45ff-8190-cd7efe51c1fc', '3100102002TU3-1', '41', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A416FA-VIPS752 i7', NULL, 1, 80, 16000000.00, '2022-08-09', 'Baik', 'TU', 'bmn/foto/1790560383_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002TU3-1.png', '2026-09-28 01:53:03', '2026-09-28 01:53:03'),
(455, '0c47116a-4eef-4bc5-a9dd-1f7a1ac2e7c3', '3050201003TU4-2', '320', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'Kursi Kerja Putar Indachi', NULL, 1, 80, 1746250.00, '2023-10-18', 'Baik', 'TU', 'bmn/foto/1790560493_barang.jpeg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU4-2.png', '2026-09-28 01:54:53', '2026-09-28 01:54:53'),
(456, '7d804f25-ec6e-4811-9687-76331752e910', '3050201002TU3-1', '97', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'MEJA KERJA KAYU JATI', NULL, 1, 80, 14500000.00, '2021-09-27', 'Baik', 'TU', 'bmn/foto/1790560505_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002TU3-1.png', '2026-09-28 01:55:05', '2026-09-28 01:55:05'),
(457, 'cf2fd8f0-477e-4fed-a3ad-388c9e9f8e71', '3050201003TU4-3', '321', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'Kursi Kerja Putar Indachi', NULL, 1, 80, 1746250.00, '2023-10-18', 'Baik', 'TU', 'bmn/foto/1790560758_barang.jpeg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU4-3.png', '2026-09-28 01:59:18', '2026-09-28 01:59:18'),
(458, '9b24fba1-1918-4393-a2e0-6c346ec08764', '3050201005TU3-1', '73', 'Sice', 'MESIN PERALATAN NON TIK', 'SOFA SET KAYU JATI', NULL, 1, 80, 29700000.00, '2021-02-22', 'Baik', 'TU', 'bmn/foto/1790560949_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201005TU3-1.png', '2026-09-28 02:02:29', '2026-09-28 02:02:29'),
(459, 'b3bbde06-3e50-45bd-82cd-eb6146c2ec0c', '3050201003TU4-4', '322', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'Kursi Kerja Putar Indachi', NULL, 1, 80, 1746250.00, '2023-10-18', 'Baik', 'TU', 'bmn/foto/1790561048_barang.jpeg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU4-4.png', '2026-09-28 02:04:08', '2026-09-28 02:04:08'),
(460, '1ab9c688-1c8e-46d1-b1be-633df5e7d678', '3100102009TU3-1', '12', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'SAMSUNG GALAXY TAB S9 FE / BOX COVER / KEYBOARD SLIM', NULL, 1, 80, 13490000.00, '2023-12-04', 'Baik', 'TU', 'bmn/foto/1790561053_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009TU3-1.png', '2026-09-28 02:04:13', '2026-09-28 02:04:13'),
(461, '33b97171-efd7-46d1-8467-07c4c5733bbd', '3050201003TU4-5', '323', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'Kursi Kerja Putar Indachi', NULL, 1, 80, 1746250.00, '2023-10-18', 'Baik', 'TU', 'bmn/foto/1790561122_barang.jpeg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU4-5.png', '2026-09-28 02:05:22', '2026-09-28 02:05:22'),
(462, 'be21b2e6-4cb0-4bba-b754-5cadacebfcb3', '3050201003TU4-6', '324', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'Kursi Kerja Putar Indachi', NULL, 1, 80, 1746250.00, '2023-10-18', 'Baik', 'TU', 'bmn/foto/1790561193_barang.jpeg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU4-6.png', '2026-09-28 02:06:33', '2026-09-28 02:06:33'),
(463, 'b97607d6-5a7d-4e0e-bc10-72c03e81527d', '3050206002TU3-1', '110', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG/QLED-Q60C/50\"', NULL, 1, 80, 8688000.00, '2023-07-25', 'Baik', 'TU', 'bmn/foto/1790561220_barang.jpg', 'Ruang Kepsta', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002TU3-1.png', '2026-09-28 02:07:00', '2026-09-28 02:07:00'),
(464, 'd8a4a248-120b-416a-b620-f194a15fbb49', '3050201003TU4-7', '325', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'Kursi Kerja Putar Indachi', NULL, 1, 80, 1746250.00, '2023-10-18', 'Baik', 'TU', 'bmn/foto/1790561337_barang.jpeg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU4-7.png', '2026-09-28 02:08:57', '2026-09-28 02:08:57'),
(465, 'f2becd9d-c4a4-491c-9fc0-da17f2c8df07', '3050201008TU4-1', '5', 'Meja Rapat', 'MESIN PERALATAN NON TIK', 'MEJA RAPAT', NULL, 1, 80, 950000.00, '2015-12-22', 'Baik', 'TU', 'bmn/foto/1790561484_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201008TU4-1.png', '2026-09-28 02:11:24', '2026-09-28 02:11:24'),
(466, 'cbbe0d2b-eee5-46d0-9388-39ba08b05f33', '3050201008TU4-2', '6', 'Meja Rapat', 'MESIN PERALATAN NON TIK', 'MEJA RAPAT', NULL, 1, 80, 950000.00, '2015-12-22', 'Baik', 'TU', 'bmn/foto/1790561549_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201008TU4-2.png', '2026-09-28 02:12:29', '2026-09-28 02:12:29'),
(467, '25022639-8eb8-4a93-8bf0-85bb1aa8bcbf', '3050201008TU4-3', '7', 'Meja Rapat', 'MESIN PERALATAN NON TIK', 'MEJA RAPAT', NULL, 1, 80, 950000.00, '2015-12-22', 'Baik', 'TU', 'bmn/foto/1790561620_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201008TU4-3.png', '2026-09-28 02:13:40', '2026-09-28 02:13:40'),
(468, '2b2d2fa8-55e5-45d8-8171-b444a5a4f5f6', '3050201008TU4-4', '8', 'Meja Rapat', 'MESIN PERALATAN NON TIK', 'MEJA RAPAT', NULL, 1, 80, 950000.00, '2015-12-22', 'Baik', 'TU', 'bmn/foto/1790561681_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201008TU4-4.png', '2026-09-28 02:14:41', '2026-09-28 02:14:41'),
(469, 'dcd12c77-eca0-4abe-b64a-6fdc96a98be5', '3050201008TU4-5', '9', 'Meja Rapat', 'MESIN PERALATAN NON TIK', 'MEJA RAPAT', NULL, 1, 80, 950000.00, '2015-12-22', 'Baik', 'TU', 'bmn/foto/1790561879_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201008TU4-5.png', '2026-09-28 02:17:59', '2026-09-28 02:17:59'),
(470, '81b0a35b-382e-45dd-bd23-0f1390bef8c2', '3050201008TU4-6', '10', 'Meja Rapat', 'MESIN PERALATAN NON TIK', 'MEJA RAPAT', NULL, 1, 80, 950000.00, '2015-12-22', 'Baik', 'TU', 'bmn/foto/1790561945_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201008TU4-6.png', '2026-09-28 02:19:05', '2026-09-28 02:19:05'),
(471, '515bde79-db69-4749-af38-181163dca603', '3050201008TU4-7', '11', 'Meja Rapat', 'MESIN PERALATAN NON TIK', 'MEJA RAPAT', NULL, 1, 80, 950000.00, '2015-12-22', 'Baik', 'TU', 'bmn/foto/1790562002_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201008TU4-7.png', '2026-09-28 02:20:02', '2026-09-28 02:20:02'),
(472, '5c9db1b2-2bed-4710-8ff7-838ee43b454b', '3050201008TU4-8', '12', 'Meja Rapat', 'MESIN PERALATAN NON TIK', 'MEJA SUDUT SAMBUNGAN', NULL, 1, 80, 500000.00, '2015-12-22', 'Baik', 'TU', 'bmn/foto/1790562118_barang.jpeg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201008TU4-8.png', '2026-09-28 02:21:59', '2026-09-28 02:21:59'),
(473, '3fe51a4f-e12d-48ab-8486-3eb758591a0e', '3060102132TU4-1', '2', 'Video Conference', 'MESIN PERALATAN NON TIK', 'Huawei Ideahub Pro 65\"', NULL, 1, 80, 198000000.00, '2021-12-16', 'Baik', 'TU', 'bmn/foto/1790562255_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102132TU4-1.png', '2026-09-28 02:24:15', '2026-09-28 02:24:15'),
(474, 'c8f61da9-8773-4737-95bc-38e30e159c4b', '3050206008TU4-1', '1', 'Sound System', 'MESIN PERALATAN NON TIK', 'Amplifier TOA 2120', NULL, 1, 80, 3775000.00, '2022-10-21', 'Baik', 'TU', 'bmn/foto/1790562342_barang.jpg', 'Ruang Rapat', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206008TU4-1.png', '2026-09-28 02:25:42', '2026-09-28 02:25:42'),
(475, 'ae807b10-1fa6-41b8-8bff-3c8bf158fdf0', '3050201003TU2-1', '282', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'COUNCIL VISITOR CHAIR BLACK', NULL, 1, 80, 1149000.00, '2020-12-31', 'Baik', 'TU', 'bmn/foto/1790563910_barang.jpg', 'Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003TU2-1.png', '2026-09-28 02:51:50', '2026-09-28 02:51:50'),
(476, '5b232e93-017f-4b91-9754-41c6ed0fe2d7', '3050201002TU2-1', '142', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'TU', 'bmn/foto/1790564244_barang.jpg', 'Tata Usaha', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002TU2-1.png', '2026-09-28 02:57:24', '2026-09-28 02:57:24'),
(477, '9b72fdac-83fa-476a-83c3-809f94c82203', '3050206036TX1-1', '14', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN/Premium Bottom Loading/HWD-C590G-BK', NULL, 1, 80, 2768000.00, '2023-07-26', 'Baik', 'Teknik', 'bmn/foto/1790565919_barang.jpg', 'Lobby Teknik Transmisi BJM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036TX1-1.png', '2026-09-28 03:25:19', '2026-09-28 03:25:19'),
(478, '57b40c7e-0426-4faf-95a1-22b276e406df', '3050104001TX1-1', '26', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA Lemari Besi Pintu Swing', NULL, 1, 80, 2988000.00, '2023-07-26', 'Baik', 'Teknik', 'bmn/foto/1790566028_barang.jpg', 'Lobby Teknik Transmisi BJM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001TX1-1.png', '2026-09-28 03:27:08', '2026-09-28 03:27:08'),
(479, '1ddecfe9-ba19-4be3-a580-0dc0e36e2789', '3060102135TX1-1', '1', 'LCD Monitor', 'MESIN PERALATAN NON TIK', 'LG 22 INCH', NULL, 1, 80, 1398000.00, '2011-12-02', 'Baik', 'Teknik', 'bmn/foto/1790566229_barang.jpg', 'Lobby Teknik Transmisi BJM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102135TX1-1.png', '2026-09-28 03:30:29', '2026-09-28 03:30:29'),
(480, '04704fbd-73fa-4fcb-8a57-6cce2cf70f1a', '3050201005TX1-1', '76', 'Sice', 'MESIN PERALATAN NON TIK', '-', NULL, 1, 80, 7110000.00, '2021-08-05', 'Baik', 'Teknik', 'bmn/foto/1790567245_barang.jpg', 'Lobby Teknik Transmisi BJM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201005TX1-1.png', '2026-09-28 03:47:25', '2026-09-28 03:47:25'),
(481, '53d07d0c-89d1-4a64-a5d7-6bfa8b1a699b', '3050206072TEK1-1', '1', 'Lampu', 'MESIN PERALATAN NON TIK', 'SPOT LIGHT', NULL, 1, 80, 11500000.00, '2014-12-19', 'Baik', 'Teknik', 'bmn/foto/1790578302_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206072TEK1-1.png', '2026-09-28 06:51:42', '2026-09-28 06:51:42'),
(482, '2cd0ed92-2324-44bc-a335-7a6c5add9e42', '3050206072TEK1-2', '2', 'Lampu', 'MESIN PERALATAN NON TIK', 'SPOT LIGHT', NULL, 1, 80, 11500000.00, '2014-12-19', 'Baik', 'Teknik', 'bmn/foto/1790578350_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206072TEK1-2.png', '2026-09-28 06:52:30', '2026-09-28 06:52:30'),
(483, '6621d6e1-e365-4ad2-b820-4fdc1dd4d120', '3050206072TEK1-3', '3', 'Lampu', 'MESIN PERALATAN NON TIK', 'SPOT LIGHT', NULL, 1, 80, 11500000.00, '2014-12-14', 'Baik', 'Teknik', 'bmn/foto/1790578392_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206072TEK1-3.png', '2026-09-28 06:53:12', '2026-09-28 06:53:12'),
(484, '56342923-a843-4192-bf67-bc48ca0dd472', '3050206072TEK1-4', '4', 'Lampu', 'MESIN PERALATAN NON TIK', 'SPOT LIGHT', NULL, 1, 80, 11500000.00, '2014-12-14', 'Baik', 'Teknik', 'bmn/foto/1790578442_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206072TEK1-4.png', '2026-09-28 06:54:02', '2026-09-28 06:54:02'),
(485, '6bb0dda4-32bb-4bac-bad5-3d9c26739f86', '3050206072TEK1-5', '5', 'Lampu', 'MESIN PERALATAN NON TIK', 'SPOT LIGHT', NULL, 1, 80, 11500000.00, '2014-12-14', 'Baik', 'Teknik', 'bmn/foto/1790578481_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206072TEK1-5.png', '2026-09-28 06:54:41', '2026-09-28 06:54:41'),
(486, '1dec18e7-87cd-4112-bac8-2686b498f45e', '3050206072TEK1-6', '6', 'Lampu', 'MESIN PERALATAN NON TIK', 'SPOT LIGHT', NULL, 1, 80, 11500000.00, '2014-12-14', 'Baik', 'Teknik', 'bmn/foto/1790578519_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206072TEK1-6.png', '2026-09-28 06:55:19', '2026-09-28 06:55:19'),
(487, '511d3ecd-a28b-4b29-8202-a2c2a0257d06', '3050206072TEK1-7', '7', 'Lampu', 'MESIN PERALATAN NON TIK', 'SPOT LIGHT', NULL, 1, 80, 11500000.00, '2014-12-14', 'Baik', 'Teknik', 'bmn/foto/1790578552_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206072TEK1-7.png', '2026-09-28 06:55:52', '2026-09-28 06:55:52'),
(488, '55994f1c-fa52-437d-be6b-5cc553036767', '3050206072TEK1-8', '8', 'Lampu', 'MESIN PERALATAN NON TIK', 'SPOT LIGHT', NULL, 1, 80, 11500000.00, '2014-12-14', 'Baik', 'Teknik', 'bmn/foto/1790578612_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206072TEK1-8.png', '2026-09-28 06:56:53', '2026-09-28 06:56:53'),
(489, 'f5170da2-cd98-4a35-9ffb-23cd0f817476', '3050206002TEK1-1', '107', 'Televisi', 'MESIN PERALATAN NON TIK', 'TOSHIBA LED TV 32\" HD SMART ANDROID TV', NULL, 1, 80, 3500000.00, '2021-12-06', 'Baik', 'Teknik', 'bmn/foto/1790578698_barang.jpg', 'Studio 3', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002TEK1-1.png', '2026-09-28 06:58:18', '2026-09-28 06:58:18'),
(490, 'c6840eea-3424-4ecc-9249-397b7921102f', '3050204004TX3-1', '137', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1,5 PK', NULL, 1, 80, 5940000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790578954_barang.jpg', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX3-1.png', '2026-09-28 07:02:34', '2026-09-28 07:02:34'),
(491, '1e32b42b-dc50-485f-a172-4c2fb0b715bb', '3050204004TX3-2', '138', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1,5 PK', NULL, 1, 80, 5940000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790579010_barang.jpg', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX3-2.png', '2026-09-28 07:03:30', '2026-09-28 07:03:30'),
(492, '52991891-9d67-403d-a834-35536bc0858d', '3050204004TX3-3', '139', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1,5 PK', NULL, 1, 80, 5940000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790579068_barang.jpg', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX3-3.png', '2026-09-28 07:04:28', '2026-09-28 07:04:28'),
(493, 'a31d84ca-75d3-46dd-a47d-d35876d728d3', '3050204004TX3-4', '140', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1 PK', NULL, 1, 80, 3769000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790579229_barang.png', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX3-4.png', '2026-09-28 07:07:10', '2026-09-28 07:07:10'),
(494, 'ac0d1008-c980-46f4-87c4-284745c1a7c1', '3050204004TX3-5', '141', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1 PK', NULL, 1, 80, 3769000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790579307_barang.png', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX3-5.png', '2026-09-28 07:08:27', '2026-09-28 07:08:27'),
(495, '31262e6c-a911-497d-aff5-92d5fcd72462', '3050206036TX3-1', '20', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN PREMIUM', NULL, 1, 80, 3368000.00, '2023-12-04', 'Baik', 'Teknik', 'bmn/foto/1790579532_barang.jpg', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036TX3-1.png', '2026-09-28 07:12:12', '2026-09-28 07:12:12'),
(496, 'a1caa6e7-82e6-41a5-8267-a6084824fde0', '3050203001TX3-1', '8', 'Mesin Penghisap Debu/Vacuum Cleaner', 'MESIN PERALATAN NON TIK', 'Philips FC8291', NULL, 1, 80, 1132412.00, '2018-12-13', 'Baik', 'Teknik', 'bmn/foto/1790579617_barang.jpg', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050203001TX3-1.png', '2026-09-28 07:13:37', '2026-09-28 07:13:37'),
(497, '132bbd91-70a0-42a5-9270-136a3c998423', '3100203002TX3-1', '14', 'Monitor', 'MESIN PERALATAN KHUSUS TIK', 'LCD LG 18,5 inci (MONOITOR KOMPUTER)', NULL, 1, 80, 1750000.00, '2011-04-08', 'Baik', 'Teknik', 'bmn/foto/1790579689_barang.jpg', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203002TX3-1.png', '2026-09-28 07:14:49', '2026-09-28 07:14:49'),
(498, '5e63a079-9361-4786-b0b4-3876b0476708', '3050206002TX3-1', '80', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'Teknik', 'bmn/foto/1790579764_barang.jpg', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002TX3-1.png', '2026-09-28 07:16:04', '2026-09-28 07:16:04'),
(499, '7c005f9f-357d-4b91-98cb-0758787c456f', '3050206002TX3-2', '124', 'Televisi', 'MESIN PERALATAN KHUSUS TIK', 'TV Led 20 Inch', NULL, 1, 80, 2440000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790579829_barang.jpg', 'Transmisi Batulicin', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002TX3-2.png', '2026-09-28 07:17:09', '2026-09-28 07:17:09'),
(500, '81c63c7e-a4c4-44aa-a048-7549324cb53a', '3050204004TX2-1', '108', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'PANASONIC GN19WKJ', NULL, 1, 80, 8750000.00, '2021-12-10', 'Baik', 'Teknik', 'bmn/foto/1790580054_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX2-1.png', '2026-09-28 07:20:55', '2026-09-28 07:20:55'),
(501, '9aeb851c-236d-406a-8e04-ba239b8d26cf', '3050204004TX2-2', '132', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1,5 PK', NULL, 1, 80, 5562000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790580152_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX2-2.png', '2026-09-28 07:22:32', '2026-09-28 07:22:32'),
(502, '7de70b40-031f-43b2-8a58-08f3c9f7f5e4', '3050204004TX2-3', '133', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1,5 PK', NULL, 1, 80, 5562000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790580451_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX2-3.png', '2026-09-28 07:27:31', '2026-09-28 07:27:31'),
(503, 'f05c8640-86d8-4781-8e35-f5f513949454', '3050204004TX2-4', '134', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1,5 PK', NULL, 1, 80, 5562000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790580501_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX2-4.png', '2026-09-28 07:28:21', '2026-09-28 07:28:21'),
(504, '4e127776-65e3-49b3-aadb-9524beeafd7a', '3050204004TX2-5', '135', 'A.C. Split', 'MESIN PERALATAN NON TIK', '1 PK', NULL, 1, 80, 2725000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790580788_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX2-5.png', '2026-09-28 07:33:08', '2026-09-28 07:33:08'),
(505, 'b519db32-6697-46cf-932f-064d6e191512', '3050204004TX6-1', '114', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'PANASONIC GN19WKJ', NULL, 1, 80, 8750000.00, '2021-12-10', 'Baik', 'Teknik', 'bmn/foto/1790581329_barang.jpg', 'Transmisi Kotabaru', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004TX6-1.png', '2026-09-28 07:42:09', '2026-09-28 07:42:09'),
(506, 'a9d7c34d-028e-4d0b-8a7a-bbbd63fda9ba', '3050206036TX6-1', '19', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN PREMIUM', NULL, 1, 80, 3368000.00, '2023-12-04', 'Baik', 'Teknik', 'bmn/foto/1790581407_barang.jpg', 'Transmisi Kotabaru', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036TX6-1.png', '2026-09-28 07:43:27', '2026-09-28 07:43:27'),
(507, '5c6984f5-8f81-46c0-b336-321e3cfe4a9a', '4010130001TX2-1', '1', 'Bangunan Gedung Tempat Kerja Lainnya Permanen', 'BANGUNAN DAN GEDUNG', 'Transmisi Amuntai', NULL, 1, 80, 191394000.00, '1993-12-31', 'Baik', 'Teknik', 'bmn/foto/1790581428_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_4010130001TX2-1.png', '2026-09-28 07:43:48', '2026-09-28 07:43:48'),
(508, '511a5a26-4c0d-4f5b-9c4d-24d82eabf9de', '3030301140TX6-1', '2', 'Grounding Test', 'MESIN PERALATAN NON TIK', 'Kyoritsu KEW 4105A Digital Earth Tester', NULL, 1, 80, 4365000.00, '2023-05-09', 'Baik', 'Teknik', 'bmn/foto/1790581473_barang.jpg', 'Transmisi Kotabaru', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3030301140TX6-1.png', '2026-09-28 07:44:33', '2026-09-28 07:44:33'),
(509, '54ae5f04-0045-4281-9192-b0f5c07e4da4', '3100102001TX6-1', '80', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO / PROCESSOR INTEL CORE i3-1335/RAM 8GB / MONITOR ASUS', NULL, 1, 80, 11400000.00, '2024-12-17', 'Baik', 'Teknik', 'bmn/foto/1790581543_barang.jpg', 'Transmisi Kotabaru', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001TX6-1.png', '2026-09-28 07:45:43', '2026-09-28 07:45:43'),
(510, '7597509d-9667-484a-b65a-b09222eb1fc6', '3050206002TX6-1', '121', 'Televisi', 'MESIN PERALATAN KHUSUS TIK', 'SAMSUNG 43\" / UA43CU8000', NULL, 1, 80, 5463000.00, '2024-02-21', 'Baik', 'Teknik', 'bmn/foto/1790581619_barang.jpg', 'Transmisi Kotabaru', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002TX6-1.png', '2026-09-28 07:46:59', '2026-09-28 07:46:59'),
(511, '90dd0137-d9b3-47b6-91c0-b999ac1a15c3', '3030205001TX6-1', '7', 'Tool Kit Set', 'MESIN PERALATAN NON TIK', 'Toolkit Hozan S22', NULL, 1, 80, 2949743.00, '2018-12-13', 'Baik', 'Teknik', 'bmn/foto/1790581717_barang.jpg', 'Transmisi Kotabaru', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3030205001TX6-1.png', '2026-09-28 07:48:37', '2026-09-28 07:48:37'),
(512, 'eaad7094-22c6-4e36-b168-18adefe5c11b', '4030103003TX2-1', '3', 'Bangunan Menara Televisi', 'BANGUNAN DAN GEDUNG', 'Tower Amuntai', NULL, 1, 80, 1235098000.00, '1982-12-31', 'Baik', 'Teknik', 'bmn/foto/1790666698_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_4030103003TX2-1.png', '2026-09-29 07:24:58', '2026-09-29 07:24:58'),
(513, '769b6109-b23d-417a-b01e-eb57711f47c6', '3050105007TX2-1', '3', 'CCTV - Camera Control Television System', 'MESIN PERALATAN NON TIK', '6 Titik 5 MP, Hardisk dan Box DVR', NULL, 1, 80, 14567000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790666788_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050105007TX2-1.png', '2026-09-29 07:26:28', '2026-09-29 07:26:28'),
(514, '7bfc8d21-e97c-437f-8955-37650d6359ba', '4010104002TX2-1', '3', 'Gedung Instalasi Pemancar', 'BANGUNAN DAN GEDUNG', 'Pemancar Amuntai', NULL, 1, 80, 459197000.00, '1982-12-31', 'Baik', 'Teknik', 'bmn/foto/1790740840_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_4010104002TX2-1.png', '2026-09-30 04:00:40', '2026-09-30 04:00:40'),
(515, '2c53e8c1-6f03-4e29-8c9f-fd538f3976e4', '5030901001TX2-1', '4', 'Instalasi Penangkal Petir Manual', 'INSTALASI DAN JARINGAN', '-', NULL, 1, 80, 4500000.00, '1992-12-31', 'Baik', 'Teknik', 'bmn/foto/1790740992_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_5030901001TX2-1.png', '2026-09-30 04:03:12', '2026-09-30 04:03:12'),
(516, '3046ae5a-ba1c-4dbb-bf85-354cce418fe9', '5030603002TX2-1', '1', 'Instalasi Pusat Pengatur Listrik Kapasitas Sedang', 'INSTALASI DAN JARINGAN', 'MDP (Main Distribution Panel) / LEN/MDP 70 KVA', NULL, 1, 80, 15355000.00, '2016-12-23', 'Baik', 'Teknik', 'bmn/foto/1790741111_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_5030603002TX2-1.png', '2026-09-30 04:05:11', '2026-09-30 04:05:11'),
(517, 'aac9c562-0b42-4ec8-961e-3bdcf178b493', '3050203003TX2-1', '8', 'Mesin Pemotong Rumput', 'MESIN PERALATAN NON TIK', 'STIHL SFR3001', NULL, 1, 80, 2565000.00, '2023-12-04', 'Baik', 'Teknik', 'bmn/foto/1790741179_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050203003TX2-1.png', '2026-09-30 04:06:19', '2026-09-30 04:06:19'),
(518, '245d7e41-2374-412e-9a2c-b976e6ec65bb', '4040104001TX2-1', '1', 'Pagar Permanen', 'BANGUNAN DAN GEDUNG', 'Pekerjaan Pager (139 Meter)', NULL, 1, 80, 304892000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790741263_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_4040104001TX2-1.png', '2026-09-30 04:07:43', '2026-09-30 04:07:43'),
(519, '51d46ea9-7d8d-4f3b-8eb7-b47f888db3e6', '3050105045TX2-1', '4', 'Penangkal Petir', 'MESIN PERALATAN NON TIK', 'Grounding Tower, Indoor, Outdoor dan Catu Daya', NULL, 1, 80, 266216000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790741354_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050105045TX2-1.png', '2026-09-30 04:09:14', '2026-09-30 04:09:14'),
(520, '4501ff36-b019-49c3-b616-27964ef26035', '4010202010TX2-1', '7', 'Rumah Negara Golongan II Tipe D Permanen', 'RUMAH NEGARA', 'Rumdin Amuntai', NULL, 1, 80, 130837000.00, '1992-12-31', 'Baik', 'Teknik', 'bmn/foto/1790741484_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_4010202010TX2-1.png', '2026-09-30 04:11:24', '2026-09-30 04:11:24'),
(521, '0e541e88-b6c1-4dad-9ca3-d5b7da19f434', '2010304001TX2-1', '3', 'Tanah Lapangan Pemancar TV/Radio/Radar', 'TANAH', '-', NULL, 1, 80, 2148000000.00, '1982-12-31', 'Baik', 'Teknik', 'bmn/foto/1790741589_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_2010304001TX2-1.png', '2026-09-30 04:13:09', '2026-09-30 04:13:09'),
(522, 'd05c93f5-49dc-4b99-8bed-ed296ee418eb', '3050206002TX2-1', '91', 'Televisi', 'MESIN PERALATAN NON TIK', 'SHARP/AQUOS TV SET 32\'\' LED', NULL, 1, 80, 3800000.00, '2020-09-17', 'Baik', 'Teknik', 'bmn/foto/1790741687_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002TX2-1.png', '2026-09-30 04:14:48', '2026-09-30 04:14:48'),
(523, '1d8c85da-fa07-458f-82c4-000e5a514226', '3050206002TX2-2', '125', 'Televisi', 'MESIN PERALATAN NON TIK', 'TV Led 20 Inch', NULL, 1, 80, 2281000.00, '2023-12-27', 'Baik', 'Teknik', 'bmn/foto/1790741764_barang.jpg', 'Transmisi Amuntai', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002TX2-2.png', '2026-09-30 04:16:04', '2026-09-30 04:16:04'),
(524, 'ee7aff27-adac-4ac2-9adc-c385bcb54ec3', '3050204004UMM2-1', '71', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'LG 1,5PK', NULL, 1, 80, 4600000.00, '2016-08-29', 'Baik', 'Umum', 'bmn/foto/1790752233_barang.jpg', 'Ruang Katim Umum', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004UMM2-1.png', '2026-09-30 07:10:33', '2026-09-30 07:10:33'),
(525, 'bee75987-896f-4626-a79f-fe6deede4d17', '3050104013UMM2-1', '3', 'Buffet', 'MESIN PERALATAN NON TIK', 'INFORMA / TYPE KIAN CBNT', NULL, 1, 80, 1942698.00, '2926-02-14', 'Baik', 'Umum', 'bmn/foto/1790752330_barang.jpg', 'Ruang Katim Umum', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104013UMM2-1.png', '2026-09-30 07:12:11', '2026-09-30 07:12:11'),
(526, '5c043fc0-8b3f-4f84-98ac-ba68e6ef294b', '3050201003UMM2-1', '347', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'Umum', 'bmn/foto/1790752408_barang.jpeg', 'Ruang Katim Umum', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM2-1.png', '2026-09-30 07:13:28', '2026-09-30 07:13:28'),
(527, 'bb90fd9b-df9f-4c80-81a2-66e71a046c86', '3100102002UMM2-1', '50', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A1402ZA / CORE i7-1260P', NULL, 1, 80, 15000000.00, '2023-03-13', 'Baik', 'Umum', 'bmn/foto/1790752466_barang.jpg', 'Ruang Katim Umum', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002UMM2-1.png', '2026-09-30 07:14:26', '2026-09-30 07:14:26'),
(528, '71e9656c-0bd2-4d39-8731-1bc5d220df2b', '3050201001UMM2-2', '10', 'Meja Kerja Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA KANA MEJA KANTOR / WARNA PUTIH', NULL, 1, 80, 2028000.00, '2025-12-15', 'Baik', 'Umum', 'bmn/foto/1790752652_barang.jpg', 'Ruang Katim Umum', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201001UMM2-2.png', '2026-09-30 07:17:32', '2026-09-30 07:17:32'),
(529, '28d25492-648e-45b0-866e-d42b783de688', '3050204004UMM1-1', '87', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'LG FLOOR STANDING 3PK', NULL, 1, 80, 18944375.00, '2017-06-20', 'Baik', 'Umum', 'bmn/foto/1790811444_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004UMM1-1.png', '2026-09-30 23:37:24', '2026-09-30 23:37:24');
INSERT INTO `bmn_barangs` (`id`, `uuid`, `kode_barang`, `nup`, `nama_barang`, `kategori`, `merk`, `nomor_seri`, `jumlah`, `persentase_kondisi`, `nilai_perolehan`, `tanggal_perolehan`, `kondisi`, `unit_kerja`, `foto`, `ruangan`, `pengguna_id`, `posisi`, `asal_pengadaan`, `peruntukan`, `catatan`, `qr_code`, `created_at`, `updated_at`) VALUES
(530, '868b6f11-ecd9-41aa-b202-3036947b42cd', '3050204004UMM1-2', '88', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'LG FLOOR STANDING 3PK', NULL, 1, 80, 18944375.00, '2017-06-20', 'Baik', 'Umum', 'bmn/foto/1790811488_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004UMM1-2.png', '2026-09-30 23:38:08', '2026-09-30 23:38:08'),
(531, 'd327d08d-5975-45ce-bad9-9c1d91eb023a', '3050206036UMM1-1', '21', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN PREMIUM', NULL, 1, 80, 3368000.00, '2023-12-04', 'Baik', 'Umum', 'bmn/foto/1790811549_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036UMM1-1.png', '2026-09-30 23:39:09', '2026-09-30 23:39:09'),
(532, 'bbd273b9-d7b9-4842-baf0-7a00b17d4362', '3050104020UMM1-1', '1', 'Lemari Display', 'MESIN PERALATAN NON TIK', 'RAK  KACA UNTUK PIALA/TROPI TVRI KALSEL', NULL, 1, 80, 999092.00, '2015-12-16', 'Baik', 'Umum', 'bmn/foto/1790811658_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104020UMM1-1.png', '2026-09-30 23:40:58', '2026-09-30 23:40:58'),
(533, '5fc3edd8-3cdd-4808-83e9-5fb4573822d8', '3050201014UMM1-1', '3', 'Meja Resepsionis', 'MESIN PERALATAN NON TIK', 'HPL', NULL, 1, 80, 13750000.00, '2022-06-28', 'Baik', 'Umum', 'bmn/foto/1790811814_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201014UMM1-1.png', '2026-09-30 23:43:34', '2026-09-30 23:43:34'),
(534, '14a4cf61-5863-4a23-a378-400535658159', '3050105017UMM1-1', '2', 'Mesin Absensi', 'MESIN PERALATAN NON TIK', 'REVO WF-206BNC', NULL, 1, 80, 4380000.00, '2020-12-31', 'Baik', 'Umum', 'bmn/foto/1790811899_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050105017UMM1-1.png', '2026-09-30 23:44:59', '2026-09-30 23:44:59'),
(535, '3310c0b6-2888-4e85-a225-e09dad21a0d6', '3100102001UMM1-1', '88', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO ASUS / P44OVAK-B385OW', NULL, 1, 80, 9450000.00, '2025-08-15', 'Baik', 'Umum', 'bmn/foto/1790811962_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001UMM1-1.png', '2026-09-30 23:46:02', '2026-09-30 23:46:02'),
(536, 'b47f35d4-74c3-4e75-8600-135635af5f6e', '3050201005UMM1-1', '60', 'Umum', 'MESIN PERALATAN NON TIK', 'KURSI TAMU', NULL, 1, 80, 16940000.00, '2014-10-27', 'Baik', 'Umum', 'bmn/foto/1790812207_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201005UMM1-1.png', '2026-09-30 23:50:07', '2026-09-30 23:50:07'),
(537, '77da038d-a952-4350-98c7-4b4495c1ccfe', '3050206002UMM1-1', '69', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'Umum', 'bmn/foto/1790812259_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002UMM1-1.png', '2026-09-30 23:50:59', '2026-09-30 23:50:59'),
(538, 'bb810829-097b-4b26-828f-a65f2f60b72c', '3050206002UMM1-2', '70', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'Umum', 'bmn/foto/1790812318_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002UMM1-2.png', '2026-09-30 23:51:58', '2026-09-30 23:51:58'),
(539, '500b7783-5158-4bfe-988f-f0df90035d41', '3050206002UMM1-3', '71', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'Umum', 'bmn/foto/1790812357_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002UMM1-3.png', '2026-09-30 23:52:37', '2026-09-30 23:52:37'),
(540, '8f6ad5f9-fee6-4288-bf9d-344a4fcc9c35', '3050206002UMM1-4', '72', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'Umum', 'bmn/foto/1790812421_barang.jpg', 'Lobby Utama', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002UMM1-4.png', '2026-09-30 23:53:41', '2026-09-30 23:53:41'),
(541, '3f450839-26aa-4a57-9418-2c2bffd105f1', '3050204004UMM3-1', '95', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'SHARP 1,5PK', NULL, 1, 80, 5484600.00, '2019-12-31', 'Baik', 'Umum', 'bmn/foto/1790812724_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004UMM3-1.png', '2026-09-30 23:58:44', '2026-09-30 23:58:44'),
(542, 'ff2f187e-303c-47d4-b8a9-e4e1f32b08d9', '3050104005UMM3-1', '15', 'Filling Cabinet Besi', 'MESIN PERALATAN NON TIK', '-', NULL, 1, 80, 603000.00, '1999-12-31', 'Baik', 'Umum', 'bmn/foto/1790812814_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005UMM3-1.png', '2026-10-01 00:00:14', '2026-10-01 00:00:14'),
(543, 'df11b4ab-1b1f-48fe-968e-5e895390fcb0', '3050201003UMM3-1', '354', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 1665000.00, '2023-12-14', 'Baik', 'Umum', 'bmn/foto/1790814701_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM3-1.png', '2026-10-01 00:31:41', '2026-10-01 00:31:41'),
(544, 'e2725315-f5f4-43eb-9766-a89f73191767', '3050201003UMM3-2', '356', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Umum', 'bmn/foto/1790816002_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM3-2.png', '2026-10-01 00:53:22', '2026-10-01 00:53:22'),
(545, 'c3628d7c-e108-4ef0-b153-929debe5f8bc', '3050201003UMM3-3', '359', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Umum', 'bmn/foto/1790816125_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM3-3.png', '2026-10-01 00:55:25', '2026-10-01 00:55:25'),
(546, 'bfb959b8-6459-4dce-a26c-230ea194a997', '3050201003UMM3-4', '360', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Umum', 'bmn/foto/1790816186_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM3-4.png', '2026-10-01 00:56:26', '2026-10-01 00:56:26'),
(547, 'a62b11b0-1259-4b09-9835-5a3e1ffa50c8', '3100102002UMM3-1', '22', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'LENOVO G40-80 CORE i3 LAYAR 14\"', NULL, 1, 80, 9020000.00, '2016-05-19', 'Baik', 'Umum', 'bmn/foto/1790816302_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002UMM3-1.png', '2026-10-01 00:58:22', '2026-10-01 00:58:22'),
(548, '5439188c-897d-4d5a-8122-b2b3505b3c7b', '3100102002UMM3-2', '63', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A1404VA-VIPS711M i7', NULL, 1, 80, 14250000.00, '2025-08-11', 'Baik', 'Umum', 'bmn/foto/1790816390_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002UMM3-2.png', '2026-10-01 00:59:50', '2026-10-01 00:59:50'),
(549, 'e16dcef9-fb8d-4cc2-b26c-c004646ef871', '3100102002UMM3-3', '68', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS/A1404VA-VIPS 5853M', NULL, 1, 80, 8800000.00, '2025-08-15', 'Baik', 'Umum', 'bmn/foto/1790816483_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002UMM3-3.png', '2026-10-01 01:01:23', '2026-10-01 01:01:23'),
(550, '2fd3d20f-6db0-4512-baaf-87a072054453', '3050201002UMM3-1', '104', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Umum', 'bmn/foto/1790816676_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM3-1.png', '2026-10-01 01:04:36', '2026-10-01 01:04:36'),
(551, '6e2b3d39-68ff-4f46-a7eb-58f9fb846a77', '3050201002UMM3-2', '101', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Umum', 'bmn/foto/1790816757_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM3-2.png', '2026-10-01 01:05:57', '2026-10-01 01:05:57'),
(552, 'ab1cace2-b9fe-47ad-a2eb-321750c347c7', '3050201002UMM3-3', '140', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Umum', 'bmn/foto/1790816899_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM3-3.png', '2026-10-01 01:08:19', '2026-10-01 01:08:19'),
(553, '8bff3f66-cc90-4f91-bcab-9e4de61a16c9', '3050201002UMM3-4', '141', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Umum', 'bmn/foto/1790817028_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM3-4.png', '2026-10-01 01:10:28', '2026-10-01 01:10:28'),
(554, '2367c9c9-d92f-498a-9dc3-94c0a7f43b4b', '3100102001UMM3-1', '69', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'AIO AXIOO MY PC ONE PRO K5 8N5-24', NULL, 1, 80, 14000000.00, '2024-02-21', 'Baik', 'Umum', 'bmn/foto/1790817103_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001UMM3-1.png', '2026-10-01 01:11:43', '2026-10-01 01:11:43'),
(555, '9cf81178-3b4f-4dc7-b059-299fe20dc76a', '3100203003UMM3-1', '113', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2805000.00, '2025-09-11', 'Baik', 'Umum', 'bmn/foto/1790817193_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM3-1.png', '2026-10-01 01:13:13', '2026-10-01 01:13:13'),
(556, '63666d48-a964-4d3d-9763-6932e048247d', '3100203003UMM3-2', '84', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2730000.00, '2022-09-07', 'Baik', 'Umum', 'bmn/foto/1790817267_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM3-2.png', '2026-10-01 01:14:27', '2026-10-01 01:14:27'),
(557, '6fdf429a-93bf-46bd-a829-08aef6b07a0c', '3100203003UMM3-3', '91', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2687000.00, '2023-12-01', 'Baik', 'Umum', 'bmn/foto/1790817323_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM3-3.png', '2026-10-01 01:15:23', '2026-10-01 01:15:23'),
(558, 'cc660c97-9ac3-49d9-af01-a2cf5b45bf7c', '3100203003UMM3-4', '98', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 4500000.00, '2024-01-25', 'Baik', 'Umum', 'bmn/foto/1790817364_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM3-4.png', '2026-10-01 01:16:04', '2026-10-01 01:16:04'),
(559, 'b1762ce8-9e4e-4651-b897-a7b6fbd33451', '3100203003UMM3-5', '106', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2541650.00, '2024-02-28', 'Baik', 'Umum', 'bmn/foto/1790817419_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM3-5.png', '2026-10-01 01:17:00', '2026-10-01 01:17:00'),
(560, '4f244b6c-adb6-4e66-989c-9985dc73f00a', '3100203003UMM3-6', '107', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON L3210', NULL, 1, 80, 2541650.00, '2024-02-28', 'Baik', 'Umum', 'bmn/foto/1790817510_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM3-6.png', '2026-10-01 01:18:30', '2026-10-01 01:18:30'),
(561, 'e7ff2cec-a801-467e-821c-cbf5fe14259f', '3100203004UMM3-1', '1', 'Scanner (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON Work Force DS-1630', NULL, 1, 80, 7500000.00, '2022-05-31', 'Baik', 'Umum', 'bmn/foto/1790817627_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203004UMM3-1.png', '2026-10-01 01:20:27', '2026-10-01 01:20:27'),
(562, '2772d10d-c3a8-40cc-a0c7-c7b5967706ca', '3100102009UMM3-1', '29', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET XIAOMI REDMI PAD 2', NULL, 1, 80, 3780500.00, '2025-11-07', 'Baik', 'Umum', 'bmn/foto/1790817707_barang.jpg', 'SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009UMM3-1.png', '2026-10-01 01:21:47', '2026-10-01 01:21:47'),
(563, 'aa493298-81e0-477c-93a8-5ffc6beaf566', '3050201002UMM2-1', '149', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA SIEBEN MEJA KANTOR', NULL, 1, 80, 4000000.00, '2025-05-07', 'Baik', 'Umum', 'bmn/foto/1790821049_barang.jpg', 'Ruang Katim Umum', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM2-1.png', '2026-10-01 02:17:29', '2026-10-01 02:17:29'),
(564, '4eba1668-441c-4766-8edb-0e059fd560a3', '3100203003UMM2-1', '100', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'BROTHER DCP-T7210W', NULL, 1, 80, 2700000.00, '2024-01-25', 'Baik', 'Umum', 'bmn/foto/1790821179_barang.jpg', 'Ruang Katim Umum', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM2-1.png', '2026-10-01 02:19:39', '2026-10-01 02:19:39'),
(565, 'b4c98509-e5a8-417b-b2c7-13754566cffb', '3100102009UMM2-1', '13', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'SAMSUNG GALAXY TAB S9 FE', NULL, 1, 80, NULL, '2023-12-04', 'Baik', 'Umum', 'bmn/foto/1790821249_barang.jpg', 'Ruang Katim Umum', NULL, NULL, '13490000', NULL, NULL, 'bmn/qrcode/qr_3100102009UMM2-1.png', '2026-10-01 02:20:49', '2026-10-01 02:20:49'),
(566, 'e85a7a91-ce39-4d39-b558-f015a8ab29aa', '3050206002UMM2-1', '76', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG SMART TV LED 32\'\'', NULL, 1, 80, 3680000.00, '2017-05-12', 'Baik', 'Umum', 'bmn/foto/1790821397_barang.jpg', 'Ruang Katim Umum', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002UMM2-1.png', '2026-10-01 02:23:17', '2026-10-01 02:23:17'),
(567, 'e8592217-c396-4dd6-b6af-ee9c53836a61', '3050201002UMM4-6', '103', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Umum', 'bmn/foto/1790828285_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM4-6.png', '2026-10-01 04:18:05', '2026-10-01 04:18:05'),
(568, 'c34f5569-eb46-42df-b9ba-bddeb287c925', '3050204004UMM4-1', '83', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'SHARP 2PK JETSTREM', NULL, 1, 80, 6985000.00, '2017-05-12', 'Baik', 'Umum', 'bmn/foto/1790828391_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004UMM4-1.png', '2026-10-01 04:19:51', '2026-10-01 04:19:51'),
(569, 'd1df503a-04cc-4918-a9dd-30dfd5511b41', '3050201002UMM4-8', '132', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'MAINE STAFF DESK 120 KALDI WOOD', NULL, 1, 80, 2451000.00, '2024-02-26', 'Baik', 'Umum', 'bmn/foto/1790828429_barang.jpeg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM4-8.png', '2026-10-01 04:20:29', '2026-10-01 04:20:29'),
(570, '0c2148b6-1611-4b69-868f-b5d8b1027cfb', '3050204004UMM4-2', '125', 'A.C. Split', 'MESIN PERALATAN NON TIK', 'LG 2PK H18TN4', NULL, 1, 80, 7600000.00, '2024-04-17', 'Baik', 'Umum', 'bmn/foto/1790828529_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050204004UMM4-2.png', '2026-10-01 04:22:09', '2026-10-01 04:22:09'),
(571, '520e147b-1dfe-4bd0-9288-55551f6687c4', '3050201002UMM4-10', '133', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'MAINE STAFF DESK 120 KALDI WOOD', NULL, 1, 80, 2428000.00, '2024-02-26', 'Baik', 'Umum', 'bmn/foto/1790828602_barang.jpeg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM4-10.png', '2026-10-01 04:23:22', '2026-10-01 04:23:22'),
(572, '606f673a-4397-4c87-b6c2-69fad2fcb910', '3050201002UMM4-11', '138', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Umum', 'bmn/foto/1790828678_barang.jpeg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM4-11.png', '2026-10-01 04:24:38', '2026-10-01 04:24:38'),
(573, '6d0f0783-ca6c-4554-a779-cbaf00e2fef6', '3060102128UMM4-1', '14', 'Camera Digital', 'MESIN PERALATAN NON TIK', 'CAMERA KODAK WPZ2 - WHITE TCR CARD READER 4 IN 1', NULL, 1, 80, 3999000.00, '2025-12-15', 'Baik', 'Umum', 'bmn/foto/1790828682_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3060102128UMM4-1.png', '2026-10-01 04:24:42', '2026-10-01 04:24:42'),
(574, 'a0b1242b-c5ed-46ae-a2d9-1019a2650aa2', '3050206036UMM4-1', '11', 'Dispenser', 'MESIN PERALATAN NON TIK', 'SANKEN/Premium Bottom Loading/HWD-C590G-BK', NULL, 1, 80, 2768000.00, '2023-07-25', 'Baik', 'Umum', 'bmn/foto/1790828878_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206036UMM4-1.png', '2026-10-01 04:27:58', '2026-10-01 04:27:58'),
(575, '49893275-4c2a-4ff3-b77f-f1fe46fd728a', '3050201002UMM4-12', '139', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA MAINE STAFF DESK 120', NULL, 1, 80, 3000000.00, '2025-05-07', 'Baik', 'Umum', 'bmn/foto/1790828893_barang.jpeg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM4-12.png', '2026-10-01 04:28:13', '2026-10-01 04:28:13'),
(576, '358c5c8b-a14d-47a9-931e-5a18f289eb8c', '3050104005UMM4-1', '28', 'Filling Cabinet Besi', 'MESIN PERALATAN NON TIK', 'KRISBOW (BERITA), INFORMA (KEUANGAN/BMN/ATK)', NULL, 1, 80, 2850000.00, '2024-10-03', 'Baik', 'Umum', 'bmn/foto/1790829029_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104005UMM4-1.png', '2026-10-01 04:30:29', '2026-10-01 04:30:29'),
(577, 'd399faa7-ce0f-484f-8c88-b126e6982bb4', '3100102001UMM4-2', '70', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'AIO AXIOO MY PC ONE PRO K5 8N5-24', NULL, 1, 80, 14000000.00, '2024-02-21', 'Baik', 'Umum', 'bmn/foto/1790829436_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001UMM4-2.png', '2026-10-01 04:37:16', '2026-10-01 04:37:16'),
(578, '50e535f4-5d2d-4dbe-bc46-9c44ec645b61', '3050201003UMM4-1', '353', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INDHACI BIANCA', NULL, 1, 80, 1344000.00, '2023-12-04', 'Baik', 'Umum', 'bmn/foto/1790829494_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM4-1.png', '2026-10-01 04:38:14', '2026-10-01 04:38:14'),
(579, '4e88772c-6fcb-4e1d-928d-ff07eeda0320', '3050201003UMM4-2', '355', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 1665000.00, '2023-12-14', 'Baik', 'Umum', 'bmn/foto/1790829661_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM4-2.png', '2026-10-01 04:41:01', '2026-10-01 04:41:01'),
(580, '86069851-bf57-48c6-aaaf-7c52a1acf75c', '3050201003UMM4-3', '357', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Umum', 'bmn/foto/1790829760_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM4-3.png', '2026-10-01 04:42:40', '2026-10-01 04:42:40'),
(581, '6411ec86-9310-4f4e-a97c-5c2bf63c42b7', '3050201003UMM4-4', '358', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Umum', 'bmn/foto/1790829862_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM4-4.png', '2026-10-01 04:44:22', '2026-10-01 04:44:22'),
(582, 'd1629fd5-303c-4869-bdaf-e64409df4e31', '3050201003UMM4-5', '361', 'Kursi Besi/Metal', 'MESIN PERALATAN NON TIK', 'KURSI RAPAT INDHACHI BIANCA', NULL, 1, 80, 1361000.00, '2024-02-26', 'Baik', 'Umum', 'bmn/foto/1790829946_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201003UMM4-5.png', '2026-10-01 04:45:46', '2026-10-01 04:45:46'),
(583, '6fa9b741-e37f-4b12-997f-f2250841b530', '3100102002UMM4-1', '27', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ACER ASPIRE EI4475G/GREY/14\'\'', NULL, 1, 80, 12200000.00, '2017-05-12', 'Baik', 'Umum', 'bmn/foto/1790897651_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002UMM4-1.png', '2026-10-01 23:34:11', '2026-10-01 23:34:11'),
(584, '5a02d2f0-e689-4a58-9fba-034481337511', '3100102002UMM4-2', '44', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'ASUS A416FA-FHD323 i3', NULL, 1, 80, 9000000.00, '2022-08-09', 'Baik', 'Umum', 'bmn/foto/1790897724_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002UMM4-2.png', '2026-10-01 23:35:24', '2026-10-01 23:35:24'),
(585, '34929d8e-0b81-4d71-90f8-ce77c2a0a7ef', '3100102002UMM4-3', '57', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'LAPTOP LENOVO YOGA 7 2IN1 14IML9', NULL, 1, 80, 23450000.00, '2024-12-17', 'Baik', 'Umum', 'bmn/foto/1790897799_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002UMM4-3.png', '2026-10-01 23:36:39', '2026-10-01 23:36:39'),
(586, '0eac50c7-cc56-43dd-a464-3445d1488038', '3100102002UMM4-4', '59', 'Lap Top', 'MESIN PERALATAN KHUSUS TIK', 'LAPTOP LENOVO YOGA 7 2IN1 14IML9', NULL, 1, 80, 23450000.00, '2024-12-17', 'Baik', 'Umum', 'bmn/foto/1790897872_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102002UMM4-4.png', '2026-10-01 23:37:52', '2026-10-01 23:37:52'),
(587, '6be2a708-9a23-4f3b-b03c-eab12d48e1a8', '3050104001UMM4-1', '21', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'LEMARI PUTIH 4 PINTU INFORMA', NULL, 1, 80, 3975000.00, '2022-06-28', 'Baik', 'Umum', 'bmn/foto/1790898189_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001UMM4-1.png', '2026-10-01 23:43:09', '2026-10-01 23:43:09'),
(588, 'ec9bc136-017c-4dbe-89dd-d9ec96407383', '3050104001UMM4-2', '22', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'LEMARI PUTIH 4 PINTU INFORMA', NULL, 1, 80, 3975000.00, '2022-06-28', 'Baik', 'Umum', 'bmn/foto/1790898313_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001UMM4-2.png', '2026-10-01 23:45:13', '2026-10-01 23:45:13'),
(589, '9dd3b11b-df97-40d8-824c-a4a0c792b6d5', '3050104001UMM4-3', '29', 'Lemari Besi/Metal', 'MESIN PERALATAN NON TIK', 'LEMARI ARSIP / INFORMA', NULL, 1, 80, 4048000.00, '2023-12-14', 'Baik', 'Umum', 'bmn/foto/1790898369_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050104001UMM4-3.png', '2026-10-01 23:46:09', '2026-10-01 23:46:09'),
(590, 'a2383406-766f-4a1d-80cd-bdc6f5f963d8', '3050201002UMM4-1', '114', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Umum', 'bmn/foto/1790898425_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM4-1.png', '2026-10-01 23:47:05', '2026-10-01 23:47:05'),
(591, 'e3465d42-1bc1-4068-8d92-80db52545a4f', '3050201002UMM4-2', '115', 'Meja Kerja Kayu', 'MESIN PERALATAN NON TIK', 'INFORMA', NULL, 1, 80, 3475000.00, '2022-06-28', 'Baik', 'Umum', 'bmn/foto/1790898463_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050201002UMM4-2.png', '2026-10-01 23:47:43', '2026-10-01 23:47:43'),
(592, '1357576b-9dd7-43bb-ba11-1c399a1b370e', '3100102001UMM4-3', '81', 'P.C Unit', 'MESIN PERALATAN KHUSUS TIK', 'PC AIO / PROCESSOR INTEL CORE i3-1335/RAM 8GB / MONITOR ASUS', NULL, 1, 80, 11400000.00, '2024-12-17', 'Baik', 'Umum', 'bmn/foto/1790898718_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102001UMM4-3.png', '2026-10-01 23:51:58', '2026-10-01 23:51:58'),
(593, 'dff323b8-442a-4ef7-baaf-ee44d5531e2a', '3100203003UMM4-1', '76', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'BROTHER T-710', NULL, 1, 80, 5500000.00, '2018-04-24', 'Baik', 'Umum', 'bmn/foto/1790898874_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM4-1.png', '2026-10-01 23:54:35', '2026-10-01 23:54:35'),
(594, '9fde1fc1-2976-4682-93ec-395d4bb71235', '3100203003UMM4-2', '80', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON Ecotank L3210', NULL, 1, 80, 2580000.00, '2022-05-31', 'Baik', 'Umum', 'bmn/foto/1790898947_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM4-2.png', '2026-10-01 23:55:47', '2026-10-01 23:55:47'),
(595, 'd45c007c-311e-4be8-83a6-b73614b1413d', '3100203003UMM4-5', '82', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON Ecotank L3210', NULL, 1, 80, 2580000.00, '2022-05-31', 'Baik', 'Umum', 'bmn/foto/1790899099_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM4-5.png', '2026-10-01 23:58:19', '2026-10-01 23:58:19'),
(596, 'e70c8e7e-e06a-4318-99d6-dfb0c689f68a', '3100203003UMM4-12', '109', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'BROTHER PRINTER INK TANK DCP-T720DW', NULL, 1, 80, 4437000.00, '2025-08-11', 'Baik', 'Umum', 'bmn/foto/1790899421_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM4-12.png', '2026-10-02 00:03:41', '2026-10-02 00:03:41'),
(597, '52b03f5c-2c72-4369-a7f0-5ccd6c297a29', '3100203003UMM4-13', '110', 'Printer (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'BROTHER PRINTER INK TANK DCP-T720DW', NULL, 1, 80, 4437000.00, '2025-08-11', 'Baik', 'Umum', 'bmn/foto/1790899492_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203003UMM4-13.png', '2026-10-02 00:04:52', '2026-10-02 00:04:52'),
(598, 'a4a21424-aa07-43d2-8bcf-f474cf4cf25e', '3100203004UMM4-2', '6', 'Scanner (Peralatan Personal Komputer)', 'MESIN PERALATAN KHUSUS TIK', 'EPSON DS-410', NULL, 1, 80, 5075000.00, '2025-12-01', 'Baik', 'Umum', 'bmn/foto/1790899693_barang.png', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100203004UMM4-2.png', '2026-10-02 00:08:13', '2026-10-02 00:08:13'),
(599, 'c95a1916-4049-4c70-943b-cbb2a7b911f9', '3100102009UMM4-1', '11', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'SAMSUNG TAB A9', NULL, 1, 80, 2990000.00, '2023-12-04', 'Baik', 'Umum', 'bmn/foto/1790899788_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009UMM4-1.png', '2026-10-02 00:09:48', '2026-10-02 00:09:48'),
(600, '595fbfa2-194a-4c59-8421-2e7e3cf0da7c', '3100102009UMM4-2', '20', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'SAMSUNG GALAXY TAB A9', NULL, 1, 80, 4000000.00, '2025-11-07', 'Baik', 'Umum', 'bmn/foto/1790899861_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009UMM4-2.png', '2026-10-02 00:11:01', '2026-10-02 00:11:01'),
(601, '9a8fcdbd-39c2-4ce8-99ce-eecf6f0d3448', '3100102009UMM4-4', '30', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET XIAOMI REDMI PAD 2', NULL, 1, 80, 3780500.00, '2025-11-07', 'Baik', 'Umum', 'bmn/foto/1790899979_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009UMM4-4.png', '2026-10-02 00:12:59', '2026-10-02 00:12:59'),
(602, '8cb5edf0-750c-4e29-a86d-620cd17cc743', '3100102009UMM4-5', '31', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET XIAOMI REDMI PAD 2', NULL, 1, 80, 3780500.00, '2025-11-07', 'Baik', 'Umum', 'bmn/foto/1790900063_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009UMM4-5.png', '2026-10-02 00:14:24', '2026-10-02 00:14:24'),
(603, 'cc18d35a-a396-409e-9ed0-111a943b017d', '3100102009UMM4-6', '32', 'Tablet PC', 'MESIN PERALATAN KHUSUS TIK', 'TABLET XIAOMI REDMI PAD 2 + STYLUS PEN & KEYBOARD', NULL, 1, 80, 3780500.00, '2025-12-24', 'Baik', 'Umum', 'bmn/foto/1790900153_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3100102009UMM4-6.png', '2026-10-02 00:15:54', '2026-10-02 00:15:54'),
(604, '5c992caa-0951-451f-bbf8-b9dc7c62d7e4', '3050206002UMM4-1', '115', 'Televisi', 'MESIN PERALATAN NON TIK', 'SAMSUNG 43 INCH', NULL, 1, 80, 4430000.00, '2023-12-04', 'Baik', 'Umum', 'bmn/foto/1790900207_barang.jpg', 'Umum & SDM', NULL, NULL, 'Digunakan sendiri untuk operasional', NULL, NULL, 'bmn/qrcode/qr_3050206002UMM4-1.png', '2026-10-02 00:16:47', '2026-10-02 00:16:47'),
(605, 'fc1a2cd2-ec48-48d1-847e-95f8916a8dbf', '1234134', '67676767', 'Laptop', 'MESIN PERALATAN KHUSUS TIK', 'MBG', '9564196495194252', 1, 90, 5000000.00, '2026-10-05', 'Sangat Baik', 'AAAA', NULL, 'AAAAA', NULL, NULL, 'MBG', NULL, NULL, 'bmn/qrcode/qr_1234134.png', '2026-10-05 00:04:45', '2026-10-05 00:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `bmn_jenis_kerusakans`
--

CREATE TABLE `bmn_jenis_kerusakans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `nama_jenis_kerusakan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bmn_jenis_kerusakans`
--

INSERT INTO `bmn_jenis_kerusakans` (`id`, `uuid`, `nama_jenis_kerusakan`, `created_at`, `updated_at`) VALUES
(2, '0c72a422-3414-4e18-864c-46a94dda5ab3', 'Rusak Sedang', '2026-03-11 12:26:10', '2026-08-09 12:25:01'),
(3, 'c761a16d-5df5-4b03-88d7-30253278db54', 'Rusak Berat', '2026-03-11 12:26:16', '2026-08-09 12:24:29'),
(4, 'f0b5fe77-54d2-4c03-9b45-028368540b3f', 'Rusak Ringan', '2026-04-14 15:04:18', '2026-08-09 12:24:45'),
(5, '2459978d-9b4e-424c-a6e6-60d097bd1fc4', 'rusak parah', '2026-10-07 00:10:01', '2026-10-07 00:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `bmn_kategoris`
--

CREATE TABLE `bmn_kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bmn_kategoris`
--

INSERT INTO `bmn_kategoris` (`id`, `uuid`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(21, 'e4c47ae9-f215-4a0e-9d8f-71071d3da805', 'MESIN PERALATAN NON TIK', '2026-08-28 06:20:24', '2026-08-28 06:20:24'),
(23, '3762bc64-70ab-4cb3-adf5-d5f7218bd8ff', 'MESIN PERALATAN KHUSUS TIK', '2026-08-31 06:38:23', '2026-08-31 06:38:23'),
(26, 'e75e3ade-cea9-4033-98a4-82c77f62d6b0', 'BANGUNAN DAN GEDUNG', '2026-09-28 07:37:30', '2026-09-28 07:37:30'),
(27, '3356bd18-911e-475e-b0c6-4c8c643fbfc4', 'INSTALASI DAN JARINGAN', '2026-09-30 04:01:21', '2026-09-30 04:01:21'),
(28, 'b9d1496c-25c4-46bb-9f3b-5b383d740882', 'RUMAH NEGARA', '2026-09-30 04:09:46', '2026-09-30 04:09:46'),
(29, 'be2115a5-8ad1-4484-9173-2129f9d64619', 'TANAH', '2026-09-30 04:11:52', '2026-09-30 04:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `bmn_ruangans`
--

CREATE TABLE `bmn_ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bmn_ruangans`
--

INSERT INTO `bmn_ruangans` (`id`, `uuid`, `nama_ruangan`, `created_at`, `updated_at`) VALUES
(9, 'e9e34ffc-78f7-4d39-aaf8-869c8e6db9eb', 'Berita', '2026-08-20 06:23:31', '2026-08-20 06:23:31'),
(10, '7c82b7f8-7487-43a1-bcd3-1b5d4bdf587b', 'KMB', '2026-09-03 05:19:39', '2026-09-03 05:19:39'),
(11, 'ae3543a0-aa76-40b5-bbc8-2c9410719c57', 'Keuangan', '2026-09-03 23:38:11', '2026-09-03 23:38:11'),
(12, '63d96e48-4243-4f9c-a6d4-9cf5554be62b', 'Katim Humas & Staff PU', '2026-09-04 06:43:44', '2026-09-04 06:43:44'),
(21, 'da1ae6c9-6bc2-42ea-bf33-8208f1b33ac1', 'Ruang Katim PU', '2026-09-23 01:07:35', '2026-09-23 01:07:35'),
(22, '63deafe0-e6e1-40b4-864c-4702dcbcd367', 'Dokpus', '2026-09-23 02:51:25', '2026-09-23 02:51:25'),
(24, '587bf536-6a6e-49d3-9d16-b9b47f1e27a7', 'Program', '2026-09-24 05:39:00', '2026-09-24 05:39:00'),
(25, '6490a181-76e3-4f84-9ca6-828507ed392e', 'Ruang Tata Rias', '2026-09-25 03:14:07', '2026-09-25 03:14:07'),
(26, '35fe2861-cc4b-4097-92a6-b92ed6d7e17f', 'Kasubag Tata Usaha', '2026-09-28 00:38:23', '2026-09-28 00:38:23'),
(27, 'd6b1c08f-5072-4d84-90ab-f358447f3f4d', 'Ruang Kepsta', '2026-09-28 01:37:04', '2026-09-28 01:37:04'),
(28, 'd7f5a4ba-30bb-4e76-9b8e-a32ec5c4b4a2', 'Ruang Rapat', '2026-09-28 01:49:17', '2026-09-28 01:49:17'),
(29, '33192480-2664-4e0e-b08d-9069b81f2d47', 'Tata Usaha', '2026-09-28 02:09:48', '2026-09-28 02:09:48'),
(30, '6877c903-3ef4-4f74-b447-d97e1f93f692', 'Lobby Teknik Transmisi BJM', '2026-09-28 02:56:51', '2026-09-28 02:56:51'),
(31, 'bd7643f3-0143-42e6-9ef9-5e43a3dfec80', 'Studio 3', '2026-09-28 02:58:53', '2026-09-28 02:58:53'),
(32, 'b47f68f4-2978-4952-b49e-ade8f3a22ce6', 'Transmisi Batulicin', '2026-09-28 07:00:06', '2026-09-28 07:00:06'),
(33, '241fde4c-0b05-47e6-a79d-a7d49376808d', 'Transmisi Amuntai', '2026-09-28 07:19:36', '2026-09-28 07:19:36'),
(34, '6df99a8b-3739-4ce9-8932-13c8a3134e23', 'Transmisi Kotabaru', '2026-09-28 07:40:00', '2026-09-28 07:40:00'),
(35, 'e739fceb-dcfa-41fb-8fa3-fa961a62db09', 'Lobby Utama', '2026-09-28 07:50:47', '2026-09-28 07:50:47'),
(36, '0754dc50-d77f-4ab8-816b-280e09d43424', 'Ruang Katim Umum', '2026-09-30 07:09:09', '2026-09-30 07:09:09'),
(37, '86cc3d84-73db-4a00-9135-a788a2b23f49', 'SDM', '2026-09-30 23:56:36', '2026-09-30 23:56:36'),
(38, 'b419db2c-ccbb-4cba-9326-e3d7d3bd73ad', 'Umum & SDM', '2026-10-01 04:16:01', '2026-10-01 04:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('0a7d46a14b89c92bb03894cd9ba67a31', 's:1994:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFd0lEQVR4nO2dXWgcVRiGn63JJlm7qWkjjRX7Q1tTrZjE2osqNRZFBHvhD0hE7IUIol6oeGGLNxZUhOpNVUSEUhAxIIpEsaU3ldqf1KK1tKnSmFhFbSGNNonmZ5MSL6ZrNuvM7syZOWfObL7nptCzu9/u+8w355zZzW5qenoawR6q4n4CgelYGfwI6uxLaXgmWkhZ3SEq4fvFUkl2CdEpoByWCLJDSJwiiolZTHxCbJLgRQxyzAtJgohiDIqZZ6oQkEwZYPR5m+mQpIpwQ3O36BVSSSKK0SRGj5BKFlFMxGLMziFCWaLtkLnUGcVE1CnRdchclgGRvf5ohMx1GXkiyCG8EJExm5B5hBMiMtwJkYu6EJFRGsV81ISIDH8o5BRciMgIRsC8ZGNoGf43htIZ4fGxeZQOsQx/QqQ7osFHjtIhllFeiHRHtJTJUzrEMkoLke7QQ4lcvYWIDL145CunLMtwFyLdYQaXnKVDLEOEWMb/hcjpyixFeUuHWMZsIdId8VCQu3SIZYgQyxAhljEjROaPeLmcv3SIZcT3d+oLm6C1HZbdANc1Q+MSyMyH2gxMTcLo33BxAH45DT+dgO498M9Qcuv6ZOZDDiZOWTUZuPsR2Hg/LL8x2H2ncnCwCz58HUb+SkbdoHT2pcwJWd0K23ZDJhvucYb/hDeehDPf2V1Xhc6+lDOHmOiO/h4YHw3/OPULYesuWLrG7roqdKycNjepX5qErveieaxMFh5/2e66ijinLFNL3uo0vHUArrp65v8uTcHZ09B/EgbPw+gwZOqh+RZoaYd5JY6Z7R3wwzF76ypgdpU1mYPP34dHt8LJQ3DgUzi+H0ZH3G+/dgNs2wVVaffx1k3+gomrrgLml737PoBv9sLA7+Vv23MEvvrEWSG5sarF/roBMb8xnMz5CyVP73HvsQWL7K8bEPt36hNj3mOZ+oqrG99OfUEjrG5zNmrXrHCOumwD1GUhXQPVNVBV7fzrRamJ17a6PjErJJWCTQ9D+0NOKBpfmBV1FTAnZMVaeHYnNC03VjLWuoqYEdJ8q7OMrL3SSLnY64ZAv5B0LTy9o3wo589CTzec+9m5iDcxBrlx51rUA88kp25I9AvZcB8sXuo9PngO3n0RTh1yH0/XJqtuSJzZTeeXcq2/x3tsKgevbvEOBeAKxWMmrrph+O9qr06alnmPnfga/ugvff/C609JqBsS/UKyDd5jfnbON29MVt2Q6BcyMe49tqip9H1vuh1aFIOJq25I9Au5OOA91tIO167yGLsDnn87eXVDMjNzdfaltLwvcuZbuL7NfSxdA699Bvs/hl9/dJacjUug7U5Ysz6ZdVW5vLDSv5Q4ugc2P+E9XlMH924p/Ri5CSfEJNQNif5TVu/3zqpGlaN7Yff25NQNiZmrbO+8ABcCvBeR59g+2PkcdH/p7B2SUjcEs4Xo2iAOD8JLD8Kpw/5uPzEGH+2AN59yPqQwOqJ2tMdVNygFuZvbjg5dgFcec96vvm0zNK+DhsVQNx9yYzA0CL/1Om+fHuxywizk8Bew7q7k1FXE/euZ5IPX5ig6K9n7Ts0cRYRYhrsQS36PqeJxyVk6xDK8hUiX6MUj39IdIlL0UCJXOWVZRnkh0iXRUiZP6RDL8CdEuiQa5IuUk0fw36CS61zBCXCGkQ6xjOBCZD4JRsC81DpEpPhDISf1U5ZIKY1iPuHmEJHiTohcwk/qImU2IfOIZpUlUhwiyCG6Ze9clxLR65ef7w6L/Hx3ZaOnQ/JUcqdoOkXrFZKnksRonivNCMmTZDGGFi1m55CkrsQMPm+zHVJIErolhgMoPiGF2CQn5i62Q0ieOMVYcjq1S0gxOgVZIqAYu4W4oSLJ0vDd+BfqsmiZCLeeXwAAAABJRU5ErkJggg==\";', 2104984853),
('0cf285b71ecf9764b378a678890f5791', 's:2130:\"data:image/png;base64,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\";', 2103848615),
('10aa77d4417aa3a2ff61f32ac2753f10', 's:2194:\"data:image/png;base64,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\";', 2104794354),
('12e189c425dd818f207a34027cec6f82', 's:3070:\"data:image/png;base64,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\";', 2104794619),
('146384898261f9e368419a2b24d6c480', 's:2006:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFgUlEQVR4nO2dTW8bRRjH//sSt3EKpsFSTBo7IIHUVuQGl6JeEAoVQhGHyIrTL8GhF74Dl0pc+QBEIoFSIOoB5Qa3AuWAFBEhaFo3aqUEJWnTeHc5RJs6zszsi3dmnrHnd6xVZ/f57f+Z2Zm17URRBAsdfN0HkBV/aS/zFdRpjjkyjkUGDuWE5Cl+WqhKIiVEpoAkqAgiIUSniF50i9EmhJIEHjrkKBdigoheVIpxVf0hwEwZgNrjVpIQU0WwkJ0WqUIGSUQvssRIETLIInopWozSMcSSTKEJGaZk9FJUUgpLyDDLAIo7/0KEDLuMmCLq0LcQK+Mk/dajLyFWBpt+6pJbiJUhJm99cgmxMtKRp06ZhVgZ2chaL3tjSIzUN4Y2Gf2T5ubRJoQYqYTYdBRDmjrahBAjUYhNR7Ek1dMmhBhCITYdchDVlSvEypALr762ZRGDKcSmQw2sOhv39HvRXHrZwb1rZe7rb9zex7/76q5P27KIcSohlNrV7x+O4nJFfM18sX6IT+8+V3RExeMv7UXda1xkEzJTcRJlAMBCwweJzxEUxIkzppSO1nS64a16xsFszZN8NHLprjvZhCzU0883rqeUZwIkhVytumiMpT+0uUkPo2aH5BiSQnjt6vFBhJCxoXZuxMHc5GAYORZCZfzwHGB+ii3k1mYHv26HzNdMb1tx/ckl5FrNw/gZ9rzp+4cBfngYMF+brXk4X5J5ZGogJ4TXrp4FEe60A6zcZwvxXQfNDBMBqpASMuqBOxb89CjA0wD4bTvE33uD2bYAYkI+ueCh7LPb1XcPXiRjmZOSK1UP02WzbxNdgM6AzrvCwyjCrS4hK/c73PdYNDgl/tJeRCYhr5aADybY7eqXJyEePXtxzfz8JET7KbtttRrmCgEItaxm3YfvstvNt5unW9Qy498A4HLFxUzF3LZFRoho7eqbzdMtStS2TB7cSQiplx1cqbLb1R87If7aPT3ErW2FeHzAHvoWDG5bJIQsCgq4zElChKM7dxZTZRdXqyROLTMkjlrUrkStaYUzjgDA9dfNTIl2ITMVB29zNqI2dkPc2+HPyO+0A/x3yH59fsrHiPazy472Qxalg9euYoIIuP2AnZJXSg4+es28FWDtuRZtRN24WMKNi/lXDFsNnzllpozWhLyXcSMqKx9PehjTfsllQ6sQ2XfVZz2Hu7dCFW1CPAeYV7BcbtpSigvo+W7B2ZqHKmcjqkjen3AxcdaMpZROc8zRlhBVyxuu42Chbs5sS0ueRRtRAPD5n8/xNWfPg8dnl0Ywd4F9Oq1pHzfXxVNoKmgRItqIAoAvNzpYZ6xfifjqnw5XyDvjHt4652R+Tx1oaVmigXZjN8xVuNV2wHxE6PhvGrICfCxE1cB+vgTho5+8p0qS2Dk82sjiIVrApEBcf+UJEW1EAcCPOYUk/d83X3Lx7rj2laJElB+hqF3tdyKsbeUXspog04R7EqVCjjai+H9ybSvAAb/rJHJ3m7/XDgDNukf+owsnqiN7HFls+HAdOe0qZrXNf4/aqMt9kEIn2j6wkzTTyTugd5MktTVNT0g3zK9novKc1jDQ25XoTzuGDCuEGEwhun/2Z1hg1dkmhBhcITYlcuHVV5gQK0UOorralkWMRCE2JcWSVE+bEGKkEmJTUgz2i5QNJPNvUNl1ruxk6TA2IcTILMSOJ9nIWq9cCbFS0pGnTrlblpUiJm99+hpDrBQ2/dSl70HdSjlJv/UoZJZlpRxRRB0Km/YOu5Sizt/+fHef2J/vHnCkJCRmkJMiq0VLFRIzSGJkj5VKhMSYLEbVpEXpGGLqTEzlcStNSDcmpEXHBaRNSDeU5OhOMQkhMTrF6BYRQ0pILzIFURHQC2khLPJIolp8Fv8DLpcHxKYKj5sAAAAASUVORK5CYII=\";', 2101685935),
('16e9935933bbdd4bdbab35e4c84cb460', 's:3058:\"data:image/png;base64,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\";', 2101167297),
('1f83760cdefa8060984bff6176bfe520', 's:2722:\"data:image/png;base64,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\";', 2101612348),
('217d19546ac19ac3d87f86a71aa08d4b', 's:1418:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAADyUlEQVR4nO2dP2gTURzHfwltrdFiqTXE0NJOOmRQF90kOEkWIYPgKlpwlA7qKIijg6OD4CR0yJhROhSnQFUCihUcxZi08Q/atCVxCJcm18vl7t3787u872fsEe7l+8n3vXe5NEl0Oh0CfJgwPYCw5Ivl0K+g9VIhoWIsKkhwbohI+EHhKomVEJUCRsFFEAshJkW4MS3GmBBOEoZhQo52IXEQ4UanmKSuExHFUwaR3nFraUhcRXihui1KhYyTCDeqxCgRMs4i3MgWo3UNAaOR2hCbmuFGVlOkNcRmGUTynr8UIbbLcJCRQ2QhkDFI1DwiCYEMb6LkIiwEMvwRzUdICGQEQySn0EIgIxxh88KFITMCXxiiGdEJcvGIhjAjkBC0Qw5BckRDmDFSCNohl1F5oiHM8BWCdqjBL9ehQiBDLcPyxZTFDE8haIcevHKO3affZZGen6bbt87Rhdwczc0eo8Z2izarDXr5+jM1dlrGxmWlkKnJJD17fIUWzp7o/S2bSVE2k6Lc+Vm6s7pBBwdmJokjQkxNV/dXcnTj+pLnsa2vv+ju6oa0c12+dGZARj/LizN0MXeaKu/r0s7nR75Y7vS/x2Xlop5JH/c9ns2kNI3kKANCbFnMG9v+a8T3H/80jaRLf+5WNqTyoU47TW8p32p/6V21oXlEh1gp5PeffXr0tEIft5rUbndfnO12hzarDXr4pEKtvbaxsVm5yyIi+vTlJ9178JamJpM0e2qKtpstYzurfnoNsWX9cLO336Zafde4DCd/K6cszlg5ZS0tnKRXz68OPX5z5Q3V6rsaR3QIGsIMCGFGksjeBZ0b+WK5g4YwA0KYASHMgBBmQAgzIIQZEMIMCGEGhDADQpgBIcyAEGYkicx/8SPosl4qJNAQZkAIMyCEGbG4pz45kaD0/LTQY03dGxelJ2S9VEhwvXO4vDhDay+uCT02XyxLHo0anI0VpixmQAgzIIQZA0JwgWgG6/9hhzOeX8/Edbc1jrhnJTSEGRDCDE8hWNz14JUzGsKMoULQErUMy9e3IZCiBr9cMWUxY6QQtEQuo/JEQ5gRSAhaIgd8kXIMCf0bVHifKzxhZhg0hBmhhWA9CUfYvIQaAinBEMlJeMqCFH9E84m0hkCKN1FyibyoQ8ogUfOQssuClC4ycpC27bVdiqznj5/vjgh+vnvMUdIQh3FuiqopWqkQh3ESo3qt1CLEIc5idG1atK4hcd2J6Ry31ob0E4e2mHgBGRPSDyc5plvMQoiDSTGmRTiwEuJGpSAuAtywFuKFiCSu4XvxHxBvhJnXdirnAAAAAElFTkSuQmCC\";', 2106527068),
('23b62a7be6786a79fc548bf3ce1140a9', 's:2610:\"data:image/png;base64,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\";', 2091565116),
('2ea0dec677013d97ca2cf070a270aaa0', 's:2142:\"data:image/png;base64,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\";', 2104885430),
('364b9657d077976ce5c6aff48ce4cc00', 's:2494:\"data:image/png;base64,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\";', 2101679455),
('37c8e48c8588811ead2432dc11852ab0', 's:2830:\"data:image/png;base64,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\";', 2101167292),
('5bc4f7c92ce639c3b84cc7226899d4a4', 's:3190:\"data:image/png;base64,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\";', 2101167278),
('67f79f4aa4273a4a50bd49acf6f41cb2', 's:2462:\"data:image/png;base64,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\";', 2103848401),
('6823081d15ad4f61570bd5ba896d0637', 's:1850:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFDElEQVR4nO2dTWgdVRiGn5vcpJKapI1tQVtEm1pNaS3+EGwkKxFb24LuKkJbzEbqRlTEhSsXLhR1IUFdKhViN/6ArVUQMUhDFaRqW4qJUWnVRQqmjTdN0vS6OLnkZjozd37OnDln8j1wIeTcJF++577nnJm5P6VqtYpgD+W8C4jNvu74j6ChsVIGlWRCyeqEJGl+VCyVZJeQLAU0whJBdgjJU4SXnMXkJ8QmCUHkIMe8EBdEeDEopsnUHwLclAFG6zaTEFdF+JFxWrIVUiQRXjISk42QIovwolmM2TVEaIjehCynZHjRlBR9CVnOMkDb/69HyHKXUUNDH9ILERlLSdmPdEJEhj8p+pJciMgIJ2F/kgkRGdFI0Kf4QkRGPGL2Sw4MLSP6gaEkIz0RDh4lIZYRTYikQw8R+igJsYzGQiQdemnQT0mIZYQLkXRkQ0hfg4WIjGwJ6K9MWZbhL0TSYQafPktCLEOEWMb157Lymq4GXoGHn/Qf+/0MvLTXbD0mqTvHJQmxjKVCZDHPh7q+S0IsQ4RYhgixjEUhsn7ky0L/JSGW4d7r1OOwog227oAtD8Cm7dB5E7R3wQ1tcKUC05fhnz/g/CicGYGfv4PpqVxLLqaQlZ3w6FOw6wC0tQfcp0Pd1qyHrX2wcz/MX4WTx+Gz92D8tNmaFyiekDvvh+cGoXNN/J9tLsOO3XBqOGchRVnQ+/bAodeh3Jr8d8xMw4nP9dUUh33d1eIs6rfeBU+/lk4GwMgxmKnoqSkBxRDS1AzPvg2tKxrfd3YGJifg6qz/+DdH9NYWk2KsIX174ZaNwePXrsFXH8KXh+HC6OL3b74denqh9xHY9iBM/AVnv8++3hCKIWTPQPj4uy/Ctx9f//2/x9Xt64/UJmDdhmzqi4H7Qlavg9u2BI+PHPWX4WVyQt1yxv01pKc3fPzY+2bq0IT7Qrq3B49VLsO5H8zVogH3haxaGzx2fjR4zFLcF7KyI3js0kVzdWjCfSFtIUKu/GeuDk24L2RuJnisJcKBomW4L6RyKXisvctcHZpQQix5R85ETP0bPLZhk7k6dDA0VnI/IWE7qY4u2LjNXC0acF/Irz+Gj+86EO/3taQ8W5wS94WM/xK+m+p/XF0naURLK+wegJcP66stAe6fy5qbheFPgp8XDPDMG7D5PnXGt/5sb/tquOMeuLsf+h9TxzR/nsu+5hAWhQyNlZy9cvjFB/DQE9AUEPjmsrpmvnO/ug5SmVLNb7bo8biwsXJ/ygL1qP/0nWj3Lbeqxd4mGXUUQwjAkbfg9EjeVaSmOEKqVXj1IAxHuPZhMUuFuHyACDA/B4MvwJuH1It84nJqGAaf119XI+r6budEmpaTx9Vt873qWYs9vbB2Pdy4Si3m8/MwOw2TF9Ul3N9+ghNH1dc54//2TK7utlzEMysVZw0pCCLEMvyFuL64u4JPnyUhlhEsRFKSLQH9DU+ISMmGkL7KlGUZjYVISvTSoJ+SEMuIJkRSogd5I2X3iP8ZVHKeKz4xZhhJiGXEFyLrSTxi9itZQkRKNBL0KfmUJVLCSdifdGuISPEnRV/SL+oiZSkp+6FnlyVSFBr6oG/bu9ylaPr/5eO70yIf311ssklIjSInJaMpOlshNYokJuO10oyQGi6LMbRpMbuGuLoTM1i32YTU40JacngA5SekHpvk5JxiO4TUyFOMJdOpXUK8ZCnIEgFe7BbiRxJJljbfj/8BY0yN8gD3RuAAAAAASUVORK5CYII=\";', 2103863075),
('75423feabbf64151c731c08fd8a8cca4', 's:2994:\"data:image/png;base64,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\";', 2091528931),
('7b0a2303f5ff0ac464faaa7d402a1fb6', 's:2122:\"data:image/png;base64,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\";', 2104989242),
('800d32753dd1b24a70a76bd1f6d77cac', 's:3238:\"data:image/png;base64,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\";', 2091529004),
('94adc8cd81cfeea61af2e3a2ea09eb30', 's:3094:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAIsElEQVR4nO2dfXAcZR3Hv7t7u/eSu0ua2DRtbVPSVluTMm2AWi2QgoAj0lGRlzEVRiXoiFLbGafCgChacRxeOjJQ3jJjIVrQTmfA2pYyTGsq5W0MkUxrCFokpJWSlIS7y+Vu7/Z2/SNeSC67e7t7u7fPJs/nr+SefZ599vfZ3/M8+5ILoygKKOTgc7sDZhmsbzN9BtX2tzNO9MUJGJIzxErwjUKqJKKEOCmgGKQIIkKImyIKcVuMa0JIkqCFG3LKLsQLIgoppxi2XDsCvCkDKG+/y5IhXhWhhtPZ4qiQmSSiEKfEOCJkJosoxG4xZZ1DKMWxNUNmU2YUYlem2JYhs1kGYN/x2yJktsvIY0ccShZCZUyl1HiUJITKUKeUuFgWQmXoYzU+loRQGcawEifTQqgMc5iNF70wJAzDF4Y0M0rHyMUjzRDCMCSEZoc9GIkjzRDCKCqEZoe9FIsnzRDC0BVCs8MZ9OKqKYTKcBat+NIhizBUhdDsKA9qcaYZQhhUCGFMu5flxHAV3v5NhG7YUHQ7RZahpDJQEmkoY2nIp4ch9Z2G9NYAMn89DnkobnfXiGDyPS6i/mCHYVkwFQGgIjD+QUMdhIs+A2BcVvaVPoztOozMC90u9tJZpgxZJE/mDMtCWL8SVU/8AJVPbQU7r9LtLtnG5Lh7cg7xtzRizp7bwNbNcbsrtuNJIQDA1c9F1a7NAEPEHz7ZhmeFAIBv5SIEN13sdjdsZWJSd2v+kPpOYeTaewEAjMABQQHcghr4murh/1IzhPOX6dYP3nQ5Ur/vLEdXHWWwvk2p7W9nXF9lKZIMJZYc//n/n8nvnUX21T6k2l+A/8rzEN3RBibAq9b3NdSBq69Frn+wTD12FteFFEM80IXkklqEf/J1zW18zQ2mhLB1cyBsaIKvcRF8n14IbkENmEgATCgAJStBSaQhD8Ug/fM9ZP/xH4j7uyZOGqchXggApPcc0xXCzS2+BGZCfgRaWxC4eh34xsXa2wk+oCIArq4K/Kp6BK+/CMrdrUg/+xpG79kDZWTU0jEYxRNC5KE4lJQIJuhXLWeqw7r1fWsaUNWxFWwkaGn/jOBD8Lr18F92LmJtDyHbddJSO0ZgAbIvCCfgOO0yMatbVTreDyUpltwFtjqCyie3gFvxyZLbUmOwvk3xxLKXXfyJ8aFEg9zpYf0GsjmMPXrQnr5Egoj8cpMtbanhiSEr2NqiW57tLj6EpHZ3InTLleBqP55vFCkH6cQAsj3vQj4zDCWWAlMZBH/eMggbmsCw6uersHY5+LWfQvb1t80diAGIF+L/2jqEbr5Cs1zqHUDuX+8Xb0iUMPbYIYTvuAaZv/UivfdlZI70QImnVDfnP78CVU9u0cxM4dJVs0AIw4Cp8INdUAN+9TkIXL0OwudW6FZJPvgXw82nOg5DfL4L8qkPi26bffktpPccQ3CTenbyq88xvF8zuC6Eb1yM2v52S3XFF9+EeKDLRAXJkIw82e6TmkLYmqjx/ZrAE5O6GlLvAOI/esLRfSipjGYZEw05sk/XM8QKYucJxG95BMpo2lJ9dm4UvjVLwTcuAtcwD2xNFGx1GEw4CPh5MH5+/L6aX/12zXgjztxl9pSQ3GAMyR3PIb37qPnKDIPA9RcicO168M0Nmisot/GUkNGf/gHi82+YrudrWozow9+Db8k8B3plL2SeJhqE724FEzV3+4O/YBmq/rTNEzIAAjJE6h3A8MbtE78zoQCqD94FbmHNtG25uipE7rkR8R8+ZqzxgIDo/TeBzb80odWHdz9A9pU+5N75APJIYvzNl1QG/JqlqLj1y6aOp1RcF6LICpDNffx7LInE7R2oemqL6vaBjRdAPNQNcd/rRdsObDwfXP1czfLc+8OI//h3yL7Uq1rOBIWi+7AbFnD/ix8LyXQeR/rZVzXLI9tbDb114r+iWbNMyUj4aNMDmjIA6N/QdIDa/naG2DkkcdfTkIcTqmVsVRiRe79TtA1uSa1mWeboCeROntGtzxp4zmI3xApRYkkkfv6MZrm/pRHBGy7RbYPVeU6SO3W2aB+EixuLbmM3xAoBAPG51yAe7tEsD99xDbh67SzQu9Lm5uu/08VfuBL+FipkGonbOyAn1a/ImaAf0QfbNN/Nkodimu0KLavALZ+vUdaEyp3fN99ZG5hYZdX2tzMkPjmUz4wg+eu9iGxXfyjEr25AaPNVGPvtvmll2a5/g29eqlqPCfCo3ncnUn98CVLvKSipDLiF1RAuORfC2uW2HoMR8gsr15e9Rkh1HIH/q5/VfEerYvNVyBzpgdTTP+Xz9P4uhG7+oma7TNCP0Le+oLtvJZ3VfAXJCYgfsvIktu2CklZ/ds74OER3tAH+qeeX1P0OxM4TlveZPtiFxM92W65vBc8IyZ08g+RD+zXLfcvmI3znddM+j29tR+608WcgecRDbyB+6+MQD/wdSkYyXd8qU4SQdoFYyNjOA5B6BzTLQzdeCqGlacpnyocJjHzlV8gc07kAnLx9SsTob/Yi9t2dQDYHJZ5C5qj1LDPC5Lh7JkMAADkZ8W27oEg5zU0i930bzJyp1x/yUBwftd6PkW/ch9TTRyG9/V/IsTEosgw5mUaufwjii28i8YtncHb9bRjbOfUNlfSfi9+msQvVr2cicbU1UykclbyVIbMAKoQwVIWQPrnPFNTiTDOEMDSF0CxxFq346mYIleIMenGlQxZhFBVCs8ReisWTZghhGBJCs8Qe6BcpexDT/4OK3ucyj5kRhmYIYZgWQucTc5iNl6UMoVKMYSVOlocsKkUfq/EpaQ6hUtQpJS4lT+pUylRKjYctqywqZRw74mDbsne2S7Hr+Om/7y4R+u+7ZziOZEiemZwpTg3RjgrJM5PEOD1XlkVIHi+LKdeipaxziFdXYuXsd1kzZDJeyBY3TiDXhEyGJDluZzERQvK4KcZtEXmIElKIk4JIEVAI0ULUsCKJ1OCr8T+wEi/tjvtdJAAAAABJRU5ErkJggg==\";', 2106518328);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('97e0905d7a6e65c72d9d258fbeee09d7', 's:2306:\"data:image/png;base64,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\";', 2104449320),
('9c98cf4d72006df27abf007d5a2415f1', 's:2158:\"data:image/png;base64,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\";', 2104885595),
('affd624ce96b95168964c7c447d265ad', 's:2078:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFuElEQVR4nO2dS2hcVRjH//cxM8nkpXZiTbShxtRiakER24KSiLQVtBbpQoKCC0FKcVVdCIK4MQoWxMciC5cWRIXgykpiF1XRqKW2iI92kdTapE3SqHnMTGbmzr0u4iTzuO977j1nJt9vOcN9zPe7//Odc2e4IxmGAUIcVN4n4JXekRXPV9DksVYpjHMJA0nkhPgpvltElSSUkDAFOCGKICGE8BRRDW8x3ISIJMEKHnIiF1IPIqqJUowc1YGA+pQBRHvekSSkXkWYEXZaQhXSSCKqCUtMKEIaWUQ1rMVE2kMIZ5gmZDMloxpWSWGWkM0sA2D3+ZkI2ewySrCoQ2AhJKOSoPUIJIRkmBOkLr6FkAx7/NbHlxCS4Q4/dfIshGR4w2u9aGEoGK4XhpSM4LhZPFJCBMOVEEoHG9zUkRIiGI5CKB1scaonJUQwbIVQOsLBrq6WQkhGuFjVl4YswTAVQumIBrM6192v36Omu1XC8T1x7O1S0JmUMJs2MDFTxDs/5jGXYX/dkhAb4gpw8nAztndsDCQ9HRJ6OmTcv1XBoc8yKOhsj1kzZNFwtcFgj1Iho5wdt8jY160EPkZ1vamp23BHm315trWz/61cxREpHZXMpe3LMcOoXOV1p4TY8O1VDTcy5k3i6pKOiZki82OSEBsWc8ALp1ZxfrYI/f/vjXTDwMS0hue/yGJVY39MmmU5cGFOx5HRLOIKkGqWMJ8xmM+syln/xpD6B38mj7VKNGQJRqhDVt/NEsaGWmpeHzmXx4kf8hWv7e6U8dTdKh7sUtDTLiMZA/5dNbCQNfDnooGxKQ3jlzUs52t2BwCIycATfSr2b1fRn5KxNSlBkYGlnIG5jIGfZ3WMT2n4+i/3jdjq/Es8/FGa2UyrBJceUr6g6kgAw4NNePyu2lNJJSWkksDOLcDBXhXpgoE3v8vh498qu+mhPhWvPRRHZ7I28KV99KcUPLsrhosLRbx0OoffF0JsBAHgMmTtvlVGkwrc3iZhbChpKsOMlpiE4cEmvDGQWH/t5T1xvH+gyVSGGTu3KBg90oy9DFbZYaAC0Td0VZZw8E4VR++LuS5kOc/siuGX+SJ0A3jxgbjn7ROqhA8OJPDYJxn8s+p589DoHVkxuE17393fFGj7tx4Jtn0qKeO5e+N476xFU+KEULOspZyBK4s60gV/gdUNA/MZHdPLOjTdeR9P3yPeMkyIMzpzRcPbE/n1RqtIwJM7VAwPJNAcc76Bly8aGDlXwMlfC1jIronoSACv7EtgqD9muV1Xq4zbWiRcd7hnFSXchYxPaTj6ZeVAXjSAzy9pUCTgxKPOQ9Pxr1ZxarJyOruYA149k0N3m4SBbdYfsz8l43qa/T0pv3AdsvJFA69/k7N8f/Sihr+z9lfv6ctajYxyPjxfsN3+poQQDwFah6uQ76eLtsOFAeDsNfur99M/7Av+07WNG4NmtJOQDSamnYeK6RX7BZzTPvJF2KZMEWpaw1nI5KLzajljE4AbGd3yVorbfYgGVyEzy86zG7vZq9tFnZg3SczhKiSrBZtu+l2viAxXIbmAs00Bnk7IHK5CGrGgQZEB/g9+JNagbwwFhIQIBgkRDBIiGOtCqLHzpVR/SohgkBDBICGCUSGE+ggfyutOCREM08cz0Q+vo6N6VKKECAYJEQxTIdTco8GszpQQwbAUQikJF6v62iaEpISDXV1pyBIMRyGUErY41ZMSIhiuhFBK2EAPUq5DPP8HFd3n8o6XEYYSIhiehVA/8YbXevlKCElxh586+R6ySIo9fusTqIeQFHOC1CVwUycplQStB5NZFklZg0UdmE17N7sUVp+f/r47IPT33Q1OKAkp0chJCWuIDlVIiUYSE3avjERIiXoWE9WkJdIeUq8zsSjPO9KElFMPaeFxAXETUo5IcninWAghJXiK4S2ihFBCqglTkCgCqhFaiBl+JIlafDP+A7+OTZMs9ciXAAAAAElFTkSuQmCC\";', 2101644615),
('b8769f93bcf179a0134f4bdb6c95b488', 's:2250:\"data:image/png;base64,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\";', 2101611828),
('bed64240efc345a0b4ba7601e77fbec1', 's:2558:\"data:image/png;base64,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\";', 2103847875),
('c17ade9a25f6f237bc745dc8b1f76721', 's:3022:\"data:image/png;base64,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\";', 2101680406),
('c1eed943c9c2c503290c00b8a1e83372', 's:2910:\"data:image/png;base64,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\";', 2103774804),
('d2415223cacf69106eb9e28197ec1e81', 's:3334:\"data:image/png;base64,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\";', 2103774804),
('dfc24c64529cec3f15584db7e32bf292', 's:2658:\"data:image/png;base64,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\";', 2101680432),
('e402efcb9ef8c88f6951f2b6903e2b3b', 's:2910:\"data:image/png;base64,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\";', 2102548282),
('e85ef138219bba485cc7d0cf2f64d2c7', 's:1626:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAEZUlEQVR4nO2dPWgTYRjH/3c2/YjUlNqKilVE8KNgKS6CdijiIBQFXR0dhA5OXUTQwbWKg64ODg66CKIigotxEBFbPypVK4glaiuatLVJP9I4yEkT3/t+3/eeuzy/MW8v9+T55f++d8n1YlQqFTB0aIi6AL8MZwd8v4OG+u4ZKmpRgUE5IUGa7xWqkkgJUSnADSqCSAiJUkQtUYuJTAglCXZEIUe7kDiIqEWnGFPXjoB4ygD01q0lIXEVIUJ1WpQKSZKIWlSJUSIkySJqkS1G6xrCuCM1IfWUjFpkJUVaQupZBiDv9UsRUu8yLGT0IbQQllFN2H6EEsIyxITpS2AhLMOZoP0JJIRleCNIn3wLYRn+8NsvPjEkhucTQ05GeLycPHJCiOFJCKdDDl76yAkhhqsQTodc3PrJCSGGoxBOhxqc+morhGWoxa6/PGURQyiE06EHUZ85IcRgIcT477MsVdPV4R2D6N00IBybmpvAjZEzKnYbC1Z/xsUJIUaVEF7Mo2F13zkhxGAhxGAhxPgnhNePaLH6zwkhRuz+T90LO9r343j3eeHYSqWMy0+PeXqewf03kU5lhGP331/C2NTjwDXawQkhBgshhgnwgk6F4exAhRNCDBZCDBZCDBZCDBZCDBZCDBZCDBZCDBbigBFBe1iIA6k1Tdr3yUJsMdBgNmrfa90JMeDtliTrmjoVVyLGBKK/8aNODMOEabh/DdSe7tJQTTVDffeMRCZkpVJ2HG9r3uj6HNvaemWV44tECllY/u043pXpcRxvMJvQ3XlIZkmeSaSQ+aW84/i+zcccp63+7aewtrFNdlmeIPGdummm0BpwEZ1dmP7vsXzpK4pLs2hJtQq3WZ/uwonuC3g0cQ2F0rd/j3ekt+HA1pPY2XEwUC0yqLrYWuU3h04XW4dhOCt+zqO7z2JXR5/r9jOlKSyulJBOZWwvaBAh+yIH68AqkVMWALzM3fX0d+uaN6AjvdWXDJUkVsjkzBuM/8gG3n5+qYDbb85JrMgbiRUCAA8/XMH3uY++t1ssF3Fn7CI+50fwq5hTUJk9VUKSdoK4WC7i5ugQRr8+cD03sfj08zmuvziN3Ow7AMCXwiuVJQKo7juJoyyVlCtLeDRxFc8mb2FPZz+6MnvR3rIFzalWNJiNWFieR76Uw+TMW4xPP8G3ufdV238pvEbPxiPa6hXenomv09JH7ayU6DUkjrAQYgiFJG1xp4qoz5wQYtgK4ZSoxa6/jglhKWpw6itPWcRwFcIpkYtbPzkhxPAkhFMiB76Rcgzx/RtU/DmXf/zMMJwQYvgWwuuJP/z2K1BCWIo3gvQp8JTFUpwJ2p9QawhLEROmL6EXdZZSTdh+SDnKYil/kdEHaYe99S5F1uvnn+8OCf98d8JRkhCLJCdF1RStVIhFksSoXiu1CLGIsxhdBy1a15C4HonprFtrQlYTh7RE8QaKTMhqKMmJOsUkhFhEKSZqERakhNSiUhAVAbWQFiIiiCSqzRfxB9cFrTjOLUy5AAAAAElFTkSuQmCC\";', 2091516178);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi_catatan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengembalian`
--

CREATE TABLE `detail_pengembalian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_pengembalian` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `guidebook`
--

CREATE TABLE `guidebook` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `file` varchar(2048) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guidebook`
--

INSERT INTO `guidebook` (`id`, `uuid`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, '1fe2e1cc-d797-4682-adfa-71c4d1f58107', '1786281336.pdf', 'unused', '2026-08-09 13:15:36', '2026-09-15 02:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `uuid`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'c1fff697-fd25-4f2b-8425-4ec731e2d2b1', 'Technical Director (TD)', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(2, 'fec7ae00-df3b-4c1a-bf8e-11ff55080e21', 'Petugas Khusus', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(3, 'b6d47208-e4f5-477a-bfa4-eda77d777cf1', 'Petugas Inventaris', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(4, 'a8ae4f0e-e783-4ed8-8d3a-5184e8b37f9c', 'Petugas Perbaikan', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(5, '3ecd897e-e4a0-42f7-a1ef-9376d7335f3a', 'Administrator', '2026-03-11 12:21:14', '2026-03-11 12:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `uuid`, `jenis_barang`, `created_at`, `updated_at`) VALUES
(1, '1660dce5-a628-47bd-9059-d19d86c62ffb', 'Kamera', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(2, '4d48c53d-628f-476d-93dc-408db434cf6e', 'Lensa', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(3, 'bd2146c9-6675-44ce-9c27-1dabd1cb1e1d', 'Action Cam', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(4, '5181d0c1-d31b-433f-ba91-da5ed950eff2', 'Baterai', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(5, '07d90647-fb75-4b69-91e9-9cbe8eeb67be', 'Drone', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(6, '2d22cb31-9d99-4fcd-b8be-e017fbb1a7fb', 'Microphone', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(7, '74a331e9-4411-4061-b3ed-85ee2ec10c0b', 'Smartphone', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(8, '21ecfe06-8c65-4bc4-8fd2-fff8efadfa6b', 'Equipment', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(9, 'c60e7625-6d42-4cb5-bd97-608cc4828c29', 'Komunikasi', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(10, '8c801358-786d-4b21-9009-4f2e015a74a7', 'Memory', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(11, 'ab84f247-6542-413d-8e9b-094085672b52', 'Laptop', '2026-03-11 12:21:14', '2026-03-11 12:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
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
-- Table structure for table `laporan_kerusakan`
--

CREATE TABLE `laporan_kerusakan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `teknisi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_kerusakan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_kerusakan`
--

INSERT INTO `laporan_kerusakan` (`id`, `uuid`, `user_id`, `barang_id`, `teknisi_id`, `jenis_kerusakan`, `deskripsi`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(12, '7078bf09-73e3-4e06-aed4-d9fe38727556', 12, 19, 7, 'Rusak Berat', 'Ac tidak menyala (tes)', 'laporan/kerusakan/yr6kjbwaTVP2ytsL0XljfP9Fz5f1U7eOYVvHfslM.jpg', 'disetujui', '2026-08-09 23:42:40', '2026-08-09 23:46:45'),
(25, '7a5538f0-b071-47c6-835a-6bb43296285f', 12, 167, NULL, 'Rusak Berat', 'Pc rusak mati total', 'laporan/kerusakan/yuilscNkArorEVy0HgFPgpGGDO9FK4iT7YB0BBTx.jpg', 'ditolak', '2026-09-14 01:50:41', '2026-09-14 02:01:33'),
(30, '768fff13-af81-4e65-be7c-781ec268a6fc', 3, 577, NULL, 'Rusak Sedang', 'Layar Mati', 'laporan/kerusakan/LIYw89d64xxQNVs358Vk1UpdYJBQ0K3U1ZdLhvXB.png', 'ditolak', '2026-10-06 05:11:01', '2026-10-06 05:46:57'),
(31, '90ceddbc-0817-4d83-9a55-e7a61f657351', 3, 568, NULL, 'Rusak Sedang', 'ac tidak dingin', NULL, 'ditolak', '2026-10-06 05:37:59', '2026-10-08 01:24:32'),
(32, '7477c91f-2046-4482-b244-812b8d444ab0', 3, 574, NULL, 'Rusak Ringan', 'Kerusakan pada bagian fisik barang', NULL, 'pending', '2026-10-06 05:43:02', '2026-10-06 05:43:02'),
(33, 'da3015bf-5d5a-4899-abd8-891013ec561a', 3, 574, NULL, 'Rusak Ringan', 'Kerusakan pada bagian fisik barang', NULL, 'pending', '2026-10-06 05:43:22', '2026-10-06 05:43:22'),
(34, '2cd59949-043f-4cf4-8ca2-d4cace9ea355', 3, 568, NULL, 'Rusak Ringan', 'gak hidup', NULL, 'pending', '2026-10-06 23:53:10', '2026-10-06 23:53:10'),
(35, 'bcfe3337-1361-43a8-b18f-fbe256d9fb39', 3, 568, NULL, 'Rusak Sedang', 'gak nyala', NULL, 'ditolak', '2026-10-08 00:11:41', '2026-10-08 00:12:40'),
(36, '35974d2c-eec8-44f4-9fb2-580e5ddc5911', 3, 567, NULL, 'rusak parah', 'kaki meja patah', NULL, 'pending', '2026-10-08 01:22:43', '2026-10-08 01:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `waktu_login` timestamp NOT NULL,
  `gambar` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `id_user`, `waktu_login`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-03-11 12:21:21', NULL, '2026-03-11 12:21:21', '2026-03-11 12:21:21'),
(2, 2, '2026-03-11 12:36:47', NULL, '2026-03-11 12:36:47', '2026-03-11 12:36:47'),
(3, 3, '2026-03-11 12:37:00', NULL, '2026-03-11 12:37:00', '2026-03-11 12:37:00'),
(4, 2, '2026-03-11 12:37:57', NULL, '2026-03-11 12:37:57', '2026-03-11 12:37:57'),
(6, 3, '2026-03-11 12:40:50', NULL, '2026-03-11 12:40:50', '2026-03-11 12:40:50'),
(8, 2, '2026-03-11 12:41:08', NULL, '2026-03-11 12:41:08', '2026-03-11 12:41:08'),
(10, 2, '2026-03-11 12:44:16', NULL, '2026-03-11 12:44:16', '2026-03-11 12:44:16'),
(11, 1, '2026-03-12 14:43:35', NULL, '2026-03-12 14:43:35', '2026-03-12 14:43:35'),
(12, 1, '2026-03-12 14:45:26', NULL, '2026-03-12 14:45:26', '2026-03-12 14:45:26'),
(13, 1, '2026-03-12 18:11:48', NULL, '2026-03-12 18:11:48', '2026-03-12 18:11:48'),
(14, 1, '2026-03-12 18:15:12', NULL, '2026-03-12 18:15:12', '2026-03-12 18:15:12'),
(15, 2, '2026-03-12 18:18:39', NULL, '2026-03-12 18:18:39', '2026-03-12 18:18:39'),
(16, 2, '2026-03-13 06:56:13', NULL, '2026-03-13 06:56:13', '2026-03-13 06:56:13'),
(17, 1, '2026-03-15 11:43:14', NULL, '2026-03-15 11:43:14', '2026-03-15 11:43:14'),
(18, 1, '2026-03-24 15:04:41', NULL, '2026-03-24 15:04:41', '2026-03-24 15:04:41'),
(19, 1, '2026-03-24 19:32:40', NULL, '2026-03-24 19:32:40', '2026-03-24 19:32:40'),
(20, 2, '2026-03-24 19:33:06', NULL, '2026-03-24 19:33:06', '2026-03-24 19:33:06'),
(21, 1, '2026-03-24 19:50:09', NULL, '2026-03-24 19:50:09', '2026-03-24 19:50:09'),
(22, 3, '2026-03-24 19:50:23', NULL, '2026-03-24 19:50:23', '2026-03-24 19:50:23'),
(23, 1, '2026-03-24 19:50:32', NULL, '2026-03-24 19:50:32', '2026-03-24 19:50:32'),
(24, 3, '2026-03-24 19:51:22', NULL, '2026-03-24 19:51:22', '2026-03-24 19:51:22'),
(25, 1, '2026-03-24 20:37:12', NULL, '2026-03-24 20:37:12', '2026-03-24 20:37:12'),
(26, 3, '2026-03-24 21:19:11', NULL, '2026-03-24 21:19:11', '2026-03-24 21:19:11'),
(27, 2, '2026-03-24 21:19:23', NULL, '2026-03-24 21:19:23', '2026-03-24 21:19:23'),
(28, 1, '2026-03-24 21:28:15', NULL, '2026-03-24 21:28:15', '2026-03-24 21:28:15'),
(29, 2, '2026-03-24 21:42:13', NULL, '2026-03-24 21:42:13', '2026-03-24 21:42:13'),
(30, 1, '2026-03-24 21:42:52', NULL, '2026-03-24 21:42:52', '2026-03-24 21:42:52'),
(31, 1, '2026-03-28 02:12:05', NULL, '2026-03-28 02:12:05', '2026-03-28 02:12:05'),
(32, 1, '2026-03-30 13:10:19', NULL, '2026-03-30 13:10:19', '2026-03-30 13:10:19'),
(33, 2, '2026-03-30 18:50:33', NULL, '2026-03-30 18:50:33', '2026-03-30 18:50:33'),
(34, 3, '2026-03-30 18:58:37', NULL, '2026-03-30 18:58:37', '2026-03-30 18:58:37'),
(35, 2, '2026-03-30 19:03:14', NULL, '2026-03-30 19:03:14', '2026-03-30 19:03:14'),
(36, 1, '2026-03-31 07:03:39', NULL, '2026-03-31 07:03:39', '2026-03-31 07:03:39'),
(37, 2, '2026-03-31 07:10:35', NULL, '2026-03-31 07:10:35', '2026-03-31 07:10:35'),
(38, 3, '2026-03-31 07:11:02', NULL, '2026-03-31 07:11:02', '2026-03-31 07:11:02'),
(39, 1, '2026-03-31 07:20:18', NULL, '2026-03-31 07:20:18', '2026-03-31 07:20:18'),
(40, 1, '2026-03-31 07:20:22', NULL, '2026-03-31 07:20:22', '2026-03-31 07:20:22'),
(41, 1, '2026-03-31 07:41:28', NULL, '2026-03-31 07:41:28', '2026-03-31 07:41:28'),
(42, 1, '2026-03-31 07:41:30', NULL, '2026-03-31 07:41:30', '2026-03-31 07:41:30'),
(43, 1, '2026-03-31 07:41:47', NULL, '2026-03-31 07:41:47', '2026-03-31 07:41:47'),
(44, 2, '2026-03-31 07:44:36', NULL, '2026-03-31 07:44:36', '2026-03-31 07:44:36'),
(45, 2, '2026-03-31 07:59:00', NULL, '2026-03-31 07:59:00', '2026-03-31 07:59:00'),
(46, 1, '2026-03-31 07:59:38', NULL, '2026-03-31 07:59:38', '2026-03-31 07:59:38'),
(48, 1, '2026-03-31 09:47:43', NULL, '2026-03-31 09:47:43', '2026-03-31 09:47:43'),
(49, 5, '2026-03-31 09:49:06', NULL, '2026-03-31 09:49:06', '2026-03-31 09:49:06'),
(50, 5, '2026-03-31 09:51:16', NULL, '2026-03-31 09:51:16', '2026-03-31 09:51:16'),
(51, 1, '2026-03-31 10:54:01', NULL, '2026-03-31 10:54:01', '2026-03-31 10:54:01'),
(52, 1, '2026-03-31 10:54:26', NULL, '2026-03-31 10:54:26', '2026-03-31 10:54:26'),
(53, 5, '2026-03-31 10:55:19', NULL, '2026-03-31 10:55:19', '2026-03-31 10:55:19'),
(54, 3, '2026-03-31 11:02:20', NULL, '2026-03-31 11:02:20', '2026-03-31 11:02:20'),
(55, 5, '2026-03-31 11:03:10', NULL, '2026-03-31 11:03:10', '2026-03-31 11:03:10'),
(56, 3, '2026-03-31 11:07:09', NULL, '2026-03-31 11:07:09', '2026-03-31 11:07:09'),
(57, 5, '2026-03-31 12:57:50', NULL, '2026-03-31 12:57:50', '2026-03-31 12:57:50'),
(58, 2, '2026-03-31 13:08:45', NULL, '2026-03-31 13:08:45', '2026-03-31 13:08:45'),
(59, 2, '2026-03-31 13:28:37', NULL, '2026-03-31 13:28:37', '2026-03-31 13:28:37'),
(60, 1, '2026-04-09 15:51:10', NULL, '2026-04-09 15:51:10', '2026-04-09 15:51:10'),
(61, 1, '2026-04-14 08:39:06', NULL, '2026-04-14 08:39:06', '2026-04-14 08:39:06'),
(62, 1, '2026-04-14 08:40:08', NULL, '2026-04-14 08:40:08', '2026-04-14 08:40:08'),
(63, 2, '2026-04-14 08:42:57', NULL, '2026-04-14 08:42:57', '2026-04-14 08:42:57'),
(64, 2, '2026-04-14 08:44:23', NULL, '2026-04-14 08:44:23', '2026-04-14 08:44:23'),
(65, 1, '2026-04-14 12:12:40', NULL, '2026-04-14 12:12:40', '2026-04-14 12:12:40'),
(66, 2, '2026-04-14 12:31:09', NULL, '2026-04-14 12:31:09', '2026-04-14 12:31:09'),
(67, 2, '2026-04-14 12:43:24', NULL, '2026-04-14 12:43:24', '2026-04-14 12:43:24'),
(68, 1, '2026-04-14 12:43:29', NULL, '2026-04-14 12:43:29', '2026-04-14 12:43:29'),
(69, 5, '2026-04-14 12:44:57', NULL, '2026-04-14 12:44:57', '2026-04-14 12:44:57'),
(70, 1, '2026-04-14 12:45:36', NULL, '2026-04-14 12:45:36', '2026-04-14 12:45:36'),
(71, 1, '2026-04-14 12:46:13', NULL, '2026-04-14 12:46:13', '2026-04-14 12:46:13'),
(72, 1, '2026-04-14 13:07:53', NULL, '2026-04-14 13:07:53', '2026-04-14 13:07:53'),
(73, 1, '2026-04-14 14:36:52', NULL, '2026-04-14 14:36:52', '2026-04-14 14:36:52'),
(74, 3, '2026-04-14 15:10:44', NULL, '2026-04-14 15:10:44', '2026-04-14 15:10:44'),
(75, 3, '2026-04-14 15:11:18', NULL, '2026-04-14 15:11:18', '2026-04-14 15:11:18'),
(76, 1, '2026-04-14 15:13:35', NULL, '2026-04-14 15:13:35', '2026-04-14 15:13:35'),
(77, 2, '2026-04-14 15:14:07', NULL, '2026-04-14 15:14:07', '2026-04-14 15:14:07'),
(78, 1, '2026-04-14 15:14:27', NULL, '2026-04-14 15:14:27', '2026-04-14 15:14:27'),
(79, 2, '2026-04-14 15:15:35', NULL, '2026-04-14 15:15:35', '2026-04-14 15:15:35'),
(80, 1, '2026-04-14 21:09:35', NULL, '2026-04-14 21:09:35', '2026-04-14 21:09:35'),
(81, 6, '2026-04-14 22:19:11', NULL, '2026-04-14 22:19:11', '2026-04-14 22:19:11'),
(82, 1, '2026-04-14 22:40:27', NULL, '2026-04-14 22:40:27', '2026-04-14 22:40:27'),
(83, 2, '2026-04-14 22:41:18', NULL, '2026-04-14 22:41:18', '2026-04-14 22:41:18'),
(84, 1, '2026-04-15 00:49:37', NULL, '2026-04-15 00:49:37', '2026-04-15 00:49:37'),
(85, 5, '2026-04-15 00:50:34', NULL, '2026-04-15 00:50:34', '2026-04-15 00:50:34'),
(86, 3, '2026-04-15 00:50:48', NULL, '2026-04-15 00:50:48', '2026-04-15 00:50:48'),
(87, 2, '2026-04-15 00:51:04', NULL, '2026-04-15 00:51:04', '2026-04-15 00:51:04'),
(88, 3, '2026-04-15 00:51:17', NULL, '2026-04-15 00:51:17', '2026-04-15 00:51:17'),
(89, 1, '2026-04-15 00:51:20', NULL, '2026-04-15 00:51:20', '2026-04-15 00:51:20'),
(90, 3, '2026-04-15 00:52:50', NULL, '2026-04-15 00:52:50', '2026-04-15 00:52:50'),
(91, 3, '2026-04-15 01:12:56', NULL, '2026-04-15 01:12:56', '2026-04-15 01:12:56'),
(92, 1, '2026-04-15 01:13:28', NULL, '2026-04-15 01:13:28', '2026-04-15 01:13:28'),
(93, 3, '2026-04-15 01:25:02', NULL, '2026-04-15 01:25:02', '2026-04-15 01:25:02'),
(94, 2, '2026-04-15 01:27:52', NULL, '2026-04-15 01:27:52', '2026-04-15 01:27:52'),
(95, 1, '2026-04-16 05:22:03', NULL, '2026-04-16 05:22:03', '2026-04-16 05:22:03'),
(96, 1, '2026-04-17 05:57:08', NULL, '2026-04-17 05:57:08', '2026-04-17 05:57:08'),
(97, 1, '2026-04-20 15:41:38', NULL, '2026-04-20 15:41:38', '2026-04-20 15:41:38'),
(98, 1, '2026-04-20 15:46:07', NULL, '2026-04-20 15:46:07', '2026-04-20 15:46:07'),
(99, 2, '2026-04-20 15:50:42', NULL, '2026-04-20 15:50:42', '2026-04-20 15:50:42'),
(101, 1, '2026-04-20 15:52:13', NULL, '2026-04-20 15:52:13', '2026-04-20 15:52:13'),
(102, 1, '2026-04-20 15:57:11', NULL, '2026-04-20 15:57:11', '2026-04-20 15:57:11'),
(103, 2, '2026-04-20 15:59:35', NULL, '2026-04-20 15:59:35', '2026-04-20 15:59:35'),
(104, 1, '2026-04-20 16:00:41', NULL, '2026-04-20 16:00:41', '2026-04-20 16:00:41'),
(105, 3, '2026-04-20 16:04:18', NULL, '2026-04-20 16:04:18', '2026-04-20 16:04:18'),
(106, 2, '2026-04-20 16:04:37', NULL, '2026-04-20 16:04:37', '2026-04-20 16:04:37'),
(107, 2, '2026-04-20 16:16:21', NULL, '2026-04-20 16:16:21', '2026-04-20 16:16:21'),
(108, 2, '2026-04-21 10:46:19', NULL, '2026-04-21 10:46:19', '2026-04-21 10:46:19'),
(109, 1, '2026-04-21 11:21:33', NULL, '2026-04-21 11:21:33', '2026-04-21 11:21:33'),
(110, 1, '2026-06-29 02:22:37', NULL, '2026-06-29 02:22:37', '2026-06-29 02:22:37'),
(111, 1, '2026-07-29 07:41:13', NULL, '2026-07-29 07:41:13', '2026-07-29 07:41:13'),
(112, 3, '2026-07-29 07:42:03', NULL, '2026-07-29 07:42:03', '2026-07-29 07:42:03'),
(113, 3, '2026-07-29 07:42:17', NULL, '2026-07-29 07:42:17', '2026-07-29 07:42:17'),
(115, 1, '2026-08-04 01:02:22', NULL, '2026-08-04 01:02:22', '2026-08-04 01:02:22'),
(116, 1, '2026-08-04 01:03:09', NULL, '2026-08-04 01:03:09', '2026-08-04 01:03:09'),
(117, 1, '2026-08-04 01:03:12', NULL, '2026-08-04 01:03:12', '2026-08-04 01:03:12'),
(118, 1, '2026-08-04 01:03:12', NULL, '2026-08-04 01:03:12', '2026-08-04 01:03:12'),
(119, 1, '2026-08-04 01:03:16', NULL, '2026-08-04 01:03:16', '2026-08-04 01:03:16'),
(120, 1, '2026-08-04 01:03:51', NULL, '2026-08-04 01:03:51', '2026-08-04 01:03:51'),
(121, 1, '2026-08-04 01:04:09', NULL, '2026-08-04 01:04:09', '2026-08-04 01:04:09'),
(122, 1, '2026-08-04 01:04:23', NULL, '2026-08-04 01:04:23', '2026-08-04 01:04:23'),
(123, 1, '2026-08-04 01:04:59', NULL, '2026-08-04 01:04:59', '2026-08-04 01:04:59'),
(124, 1, '2026-08-04 01:05:19', NULL, '2026-08-04 01:05:19', '2026-08-04 01:05:19'),
(125, 1, '2026-08-04 03:46:59', NULL, '2026-08-04 03:46:59', '2026-08-04 03:46:59'),
(126, 1, '2026-08-06 02:52:19', NULL, '2026-08-06 02:52:19', '2026-08-06 02:52:19'),
(127, 1, '2026-08-07 06:39:26', NULL, '2026-08-07 06:39:26', '2026-08-07 06:39:26'),
(128, 1, '2026-08-07 06:39:27', NULL, '2026-08-07 06:39:27', '2026-08-07 06:39:27'),
(129, 1, '2026-08-07 06:46:46', NULL, '2026-08-07 06:46:46', '2026-08-07 06:46:46'),
(130, 1, '2026-08-07 08:01:57', NULL, '2026-08-07 08:01:57', '2026-08-07 08:01:57'),
(131, 1, '2026-08-07 12:45:05', NULL, '2026-08-07 12:45:05', '2026-08-07 12:45:05'),
(132, 1, '2026-08-08 01:04:27', NULL, '2026-08-08 01:04:27', '2026-08-08 01:04:27'),
(133, 1, '2026-08-09 04:13:17', NULL, '2026-08-09 04:13:17', '2026-08-09 04:13:17'),
(134, 1, '2026-08-09 04:23:40', NULL, '2026-08-09 04:23:40', '2026-08-09 04:23:40'),
(135, 7, '2026-08-09 05:03:48', NULL, '2026-08-09 05:03:48', '2026-08-09 05:03:48'),
(136, 1, '2026-08-09 05:10:49', NULL, '2026-08-09 05:10:49', '2026-08-09 05:10:49'),
(137, 12, '2026-08-09 05:12:27', NULL, '2026-08-09 05:12:27', '2026-08-09 05:12:27'),
(138, 1, '2026-08-09 05:51:46', NULL, '2026-08-09 05:51:46', '2026-08-09 05:51:46'),
(139, 7, '2026-08-09 05:52:46', NULL, '2026-08-09 05:52:46', '2026-08-09 05:52:46'),
(140, 1, '2026-08-09 06:13:24', NULL, '2026-08-09 06:13:24', '2026-08-09 06:13:24'),
(141, 7, '2026-08-09 06:18:34', NULL, '2026-08-09 06:18:34', '2026-08-09 06:18:34'),
(142, 1, '2026-08-09 06:19:00', NULL, '2026-08-09 06:19:00', '2026-08-09 06:19:00'),
(143, 7, '2026-08-09 06:40:13', NULL, '2026-08-09 06:40:13', '2026-08-09 06:40:13'),
(144, 1, '2026-08-09 06:48:46', NULL, '2026-08-09 06:48:46', '2026-08-09 06:48:46'),
(145, 12, '2026-08-09 07:00:18', NULL, '2026-08-09 07:00:18', '2026-08-09 07:00:18'),
(146, 1, '2026-08-09 11:25:51', NULL, '2026-08-09 11:25:51', '2026-08-09 11:25:51'),
(147, 1, '2026-08-09 11:39:06', NULL, '2026-08-09 11:39:06', '2026-08-09 11:39:06'),
(148, 1, '2026-08-09 13:31:13', NULL, '2026-08-09 13:31:13', '2026-08-09 13:31:13'),
(149, 1, '2026-08-09 13:46:39', NULL, '2026-08-09 13:46:39', '2026-08-09 13:46:39'),
(152, 1, '2026-08-09 14:50:36', NULL, '2026-08-09 14:50:36', '2026-08-09 14:50:36'),
(153, 1, '2026-08-09 20:52:44', NULL, '2026-08-09 20:52:44', '2026-08-09 20:52:44'),
(154, 1, '2026-08-09 23:32:34', NULL, '2026-08-09 23:32:34', '2026-08-09 23:32:34'),
(155, 1, '2026-08-09 23:33:12', NULL, '2026-08-09 23:33:12', '2026-08-09 23:33:12'),
(156, 12, '2026-08-09 23:35:03', NULL, '2026-08-09 23:35:03', '2026-08-09 23:35:03'),
(157, 1, '2026-08-09 23:40:59', NULL, '2026-08-09 23:40:59', '2026-08-09 23:40:59'),
(158, 1, '2026-08-09 23:42:00', NULL, '2026-08-09 23:42:00', '2026-08-09 23:42:00'),
(159, 7, '2026-08-09 23:44:06', NULL, '2026-08-09 23:44:06', '2026-08-09 23:44:06'),
(160, 1, '2026-08-09 23:44:40', NULL, '2026-08-09 23:44:40', '2026-08-09 23:44:40'),
(161, 1, '2026-08-09 23:45:37', NULL, '2026-08-09 23:45:37', '2026-08-09 23:45:37'),
(162, 7, '2026-08-09 23:46:31', NULL, '2026-08-09 23:46:31', '2026-08-09 23:46:31'),
(163, 1, '2026-08-09 23:47:33', NULL, '2026-08-09 23:47:33', '2026-08-09 23:47:33'),
(164, 1, '2026-08-09 23:47:50', NULL, '2026-08-09 23:47:50', '2026-08-09 23:47:50'),
(165, 10, '2026-08-09 23:50:02', NULL, '2026-08-09 23:50:02', '2026-08-09 23:50:02'),
(166, 1, '2026-08-09 23:50:35', NULL, '2026-08-09 23:50:35', '2026-08-09 23:50:35'),
(167, 1, '2026-08-09 23:50:45', NULL, '2026-08-09 23:50:45', '2026-08-09 23:50:45'),
(169, 14, '2026-08-09 23:51:15', NULL, '2026-08-09 23:51:15', '2026-08-09 23:51:15'),
(170, 1, '2026-08-09 23:52:10', NULL, '2026-08-09 23:52:10', '2026-08-09 23:52:10'),
(172, 12, '2026-08-09 23:52:50', NULL, '2026-08-09 23:52:50', '2026-08-09 23:52:50'),
(173, 1, '2026-08-09 23:54:54', NULL, '2026-08-09 23:54:54', '2026-08-09 23:54:54'),
(174, 1, '2026-08-09 23:55:27', NULL, '2026-08-09 23:55:27', '2026-08-09 23:55:27'),
(175, 10, '2026-08-09 23:55:29', NULL, '2026-08-09 23:55:29', '2026-08-09 23:55:29'),
(177, 1, '2026-08-09 23:56:22', NULL, '2026-08-09 23:56:22', '2026-08-09 23:56:22'),
(179, 12, '2026-08-09 23:57:19', NULL, '2026-08-09 23:57:19', '2026-08-09 23:57:19'),
(181, 1, '2026-08-09 23:57:31', NULL, '2026-08-09 23:57:31', '2026-08-09 23:57:31'),
(182, 1, '2026-08-09 23:59:05', NULL, '2026-08-09 23:59:05', '2026-08-09 23:59:05'),
(184, 12, '2026-08-10 00:00:26', NULL, '2026-08-10 00:00:26', '2026-08-10 00:00:26'),
(189, 1, '2026-08-10 00:06:28', NULL, '2026-08-10 00:06:28', '2026-08-10 00:06:28'),
(190, 15, '2026-08-10 00:06:46', NULL, '2026-08-10 00:06:46', '2026-08-10 00:06:46'),
(192, 1, '2026-08-10 00:09:18', NULL, '2026-08-10 00:09:18', '2026-08-10 00:09:18'),
(193, 1, '2026-08-10 00:13:42', NULL, '2026-08-10 00:13:42', '2026-08-10 00:13:42'),
(194, 14, '2026-08-10 00:13:52', NULL, '2026-08-10 00:13:52', '2026-08-10 00:13:52'),
(195, 1, '2026-08-10 00:14:50', NULL, '2026-08-10 00:14:50', '2026-08-10 00:14:50'),
(196, 1, '2026-08-10 00:16:54', NULL, '2026-08-10 00:16:54', '2026-08-10 00:16:54'),
(197, 14, '2026-08-10 00:19:00', NULL, '2026-08-10 00:19:00', '2026-08-10 00:19:00'),
(198, 1, '2026-08-10 00:20:14', NULL, '2026-08-10 00:20:14', '2026-08-10 00:20:14'),
(199, 14, '2026-08-10 00:21:59', NULL, '2026-08-10 00:21:59', '2026-08-10 00:21:59'),
(200, 1, '2026-08-10 00:23:27', NULL, '2026-08-10 00:23:27', '2026-08-10 00:23:27'),
(201, 14, '2026-08-10 00:24:23', NULL, '2026-08-10 00:24:23', '2026-08-10 00:24:23'),
(202, 1, '2026-08-10 00:25:48', NULL, '2026-08-10 00:25:48', '2026-08-10 00:25:48'),
(203, 1, '2026-08-10 07:28:50', NULL, '2026-08-10 07:28:50', '2026-08-10 07:28:50'),
(204, 1, '2026-08-11 01:21:41', NULL, '2026-08-11 01:21:41', '2026-08-11 01:21:41'),
(205, 1, '2026-08-11 01:37:18', NULL, '2026-08-11 01:37:18', '2026-08-11 01:37:18'),
(206, 1, '2026-08-11 01:37:22', NULL, '2026-08-11 01:37:22', '2026-08-11 01:37:22'),
(207, 1, '2026-08-11 01:37:32', NULL, '2026-08-11 01:37:32', '2026-08-11 01:37:32'),
(208, 1, '2026-08-11 01:37:34', NULL, '2026-08-11 01:37:34', '2026-08-11 01:37:34'),
(210, 1, '2026-08-11 01:37:58', NULL, '2026-08-11 01:37:58', '2026-08-11 01:37:58'),
(211, 15, '2026-08-11 01:38:06', NULL, '2026-08-11 01:38:06', '2026-08-11 01:38:06'),
(212, 17, '2026-08-11 01:39:53', NULL, '2026-08-11 01:39:53', '2026-08-11 01:39:53'),
(213, 1, '2026-08-11 01:41:36', NULL, '2026-08-11 01:41:36', '2026-08-11 01:41:36'),
(214, 1, '2026-08-11 01:41:51', NULL, '2026-08-11 01:41:51', '2026-08-11 01:41:51'),
(215, 7, '2026-08-11 01:42:46', NULL, '2026-08-11 01:42:46', '2026-08-11 01:42:46'),
(216, 1, '2026-08-11 01:43:13', NULL, '2026-08-11 01:43:13', '2026-08-11 01:43:13'),
(217, 12, '2026-08-11 01:52:11', NULL, '2026-08-11 01:52:11', '2026-08-11 01:52:11'),
(218, 1, '2026-08-11 02:07:37', NULL, '2026-08-11 02:07:37', '2026-08-11 02:07:37'),
(219, 1, '2026-08-11 06:01:10', NULL, '2026-08-11 06:01:10', '2026-08-11 06:01:10'),
(220, 1, '2026-08-11 06:22:50', NULL, '2026-08-11 06:22:50', '2026-08-11 06:22:50'),
(221, 1, '2026-08-12 01:00:56', NULL, '2026-08-12 01:00:56', '2026-08-12 01:00:56'),
(222, 1, '2026-08-12 07:14:52', NULL, '2026-08-12 07:14:52', '2026-08-12 07:14:52'),
(223, 1, '2026-08-12 16:38:51', NULL, '2026-08-12 16:38:51', '2026-08-12 16:38:51'),
(224, 1, '2026-08-13 00:01:43', NULL, '2026-08-13 00:01:43', '2026-08-13 00:01:43'),
(225, 1, '2026-08-13 02:05:46', NULL, '2026-08-13 02:05:46', '2026-08-13 02:05:46'),
(226, 1, '2026-08-14 07:42:38', NULL, '2026-08-14 07:42:38', '2026-08-14 07:42:38'),
(227, 1, '2026-08-20 00:52:22', NULL, '2026-08-20 00:52:22', '2026-08-20 00:52:22'),
(228, 1, '2026-08-20 01:05:24', NULL, '2026-08-20 01:05:24', '2026-08-20 01:05:24'),
(229, 1, '2026-08-20 01:11:15', NULL, '2026-08-20 01:11:15', '2026-08-20 01:11:15'),
(230, 19, '2026-08-20 01:12:04', NULL, '2026-08-20 01:12:04', '2026-08-20 01:12:04'),
(231, 1, '2026-08-20 01:25:18', NULL, '2026-08-20 01:25:18', '2026-08-20 01:25:18'),
(232, 18, '2026-08-20 01:25:55', NULL, '2026-08-20 01:25:55', '2026-08-20 01:25:55'),
(233, 19, '2026-08-20 01:27:22', NULL, '2026-08-20 01:27:22', '2026-08-20 01:27:22'),
(234, 1, '2026-08-20 01:54:41', NULL, '2026-08-20 01:54:41', '2026-08-20 01:54:41'),
(236, 18, '2026-08-20 01:55:03', NULL, '2026-08-20 01:55:03', '2026-08-20 01:55:03'),
(237, 1, '2026-08-20 01:57:27', NULL, '2026-08-20 01:57:27', '2026-08-20 01:57:27'),
(238, 15, '2026-08-20 01:58:02', NULL, '2026-08-20 01:58:02', '2026-08-20 01:58:02'),
(239, 19, '2026-08-20 02:01:17', NULL, '2026-08-20 02:01:17', '2026-08-20 02:01:17'),
(240, 1, '2026-08-20 02:04:46', NULL, '2026-08-20 02:04:46', '2026-08-20 02:04:46'),
(241, 18, '2026-08-20 02:04:59', NULL, '2026-08-20 02:04:59', '2026-08-20 02:04:59'),
(242, 1, '2026-08-20 02:05:08', NULL, '2026-08-20 02:05:08', '2026-08-20 02:05:08'),
(243, 1, '2026-08-20 02:05:53', NULL, '2026-08-20 02:05:53', '2026-08-20 02:05:53'),
(244, 18, '2026-08-20 02:06:12', NULL, '2026-08-20 02:06:12', '2026-08-20 02:06:12'),
(245, 17, '2026-08-20 02:07:18', NULL, '2026-08-20 02:07:18', '2026-08-20 02:07:18'),
(246, 1, '2026-08-20 02:07:33', NULL, '2026-08-20 02:07:33', '2026-08-20 02:07:33'),
(247, 1, '2026-08-20 05:04:12', NULL, '2026-08-20 05:04:12', '2026-08-20 05:04:12'),
(248, 1, '2026-08-20 05:11:18', NULL, '2026-08-20 05:11:18', '2026-08-20 05:11:18'),
(249, 19, '2026-08-20 05:12:58', NULL, '2026-08-20 05:12:58', '2026-08-20 05:12:58'),
(250, 18, '2026-08-20 05:28:47', NULL, '2026-08-20 05:28:47', '2026-08-20 05:28:47'),
(251, 1, '2026-08-20 06:16:27', NULL, '2026-08-20 06:16:27', '2026-08-20 06:16:27'),
(252, 19, '2026-08-21 07:50:44', NULL, '2026-08-21 07:50:44', '2026-08-21 07:50:44'),
(253, 19, '2026-08-23 11:43:49', NULL, '2026-08-23 11:43:49', '2026-08-23 11:43:49'),
(254, 19, '2026-08-23 23:33:56', NULL, '2026-08-23 23:33:56', '2026-08-23 23:33:56'),
(255, 1, '2026-08-25 01:32:25', NULL, '2026-08-25 01:32:25', '2026-08-25 01:32:25'),
(256, 1, '2026-08-25 05:52:24', NULL, '2026-08-25 05:52:24', '2026-08-25 05:52:24'),
(257, 19, '2026-08-26 00:42:56', NULL, '2026-08-26 00:42:56', '2026-08-26 00:42:56'),
(258, 1, '2026-08-26 04:13:46', NULL, '2026-08-26 04:13:46', '2026-08-26 04:13:46'),
(259, 1, '2026-08-26 04:27:59', NULL, '2026-08-26 04:27:59', '2026-08-26 04:27:59'),
(260, 19, '2026-08-26 05:09:39', NULL, '2026-08-26 05:09:39', '2026-08-26 05:09:39'),
(261, 7, '2026-08-26 05:20:56', NULL, '2026-08-26 05:20:56', '2026-08-26 05:20:56'),
(263, 2, '2026-08-26 05:22:53', NULL, '2026-08-26 05:22:53', '2026-08-26 05:22:53'),
(265, 10, '2026-08-26 05:29:07', NULL, '2026-08-26 05:29:07', '2026-08-26 05:29:07'),
(266, 7, '2026-08-26 05:29:56', NULL, '2026-08-26 05:29:56', '2026-08-26 05:29:56'),
(267, 7, '2026-08-26 05:32:21', NULL, '2026-08-26 05:32:21', '2026-08-26 05:32:21'),
(268, 1, '2026-08-26 06:15:54', NULL, '2026-08-26 06:15:54', '2026-08-26 06:15:54'),
(269, 1, '2026-08-26 14:17:27', NULL, '2026-08-26 14:17:27', '2026-08-26 14:17:27'),
(270, 1, '2026-08-27 00:35:08', NULL, '2026-08-27 00:35:08', '2026-08-27 00:35:08'),
(271, 19, '2026-08-27 02:09:03', NULL, '2026-08-27 02:09:03', '2026-08-27 02:09:03'),
(272, 1, '2026-08-27 04:58:05', NULL, '2026-08-27 04:58:05', '2026-08-27 04:58:05'),
(273, 7, '2026-08-28 05:09:42', NULL, '2026-08-28 05:09:42', '2026-08-28 05:09:42'),
(274, 1, '2026-08-28 05:10:07', NULL, '2026-08-28 05:10:07', '2026-08-28 05:10:07'),
(275, 19, '2026-08-28 06:03:49', NULL, '2026-08-28 06:03:49', '2026-08-28 06:03:49'),
(276, 1, '2026-08-28 15:33:11', NULL, '2026-08-28 15:33:11', '2026-08-28 15:33:11'),
(277, 1, '2026-08-31 01:01:19', NULL, '2026-08-31 01:01:19', '2026-08-31 01:01:19'),
(278, 19, '2026-08-31 06:22:29', NULL, '2026-08-31 06:22:29', '2026-08-31 06:22:29'),
(279, 1, '2026-09-01 07:12:51', NULL, '2026-09-01 07:12:51', '2026-09-01 07:12:51'),
(280, 19, '2026-09-02 02:24:16', NULL, '2026-09-02 02:24:16', '2026-09-02 02:24:16'),
(281, 19, '2026-09-02 05:49:15', NULL, '2026-09-02 05:49:15', '2026-09-02 05:49:15'),
(282, 1, '2026-09-02 07:44:11', NULL, '2026-09-02 07:44:11', '2026-09-02 07:44:11'),
(283, 19, '2026-09-03 02:14:43', NULL, '2026-09-03 02:14:43', '2026-09-03 02:14:43'),
(284, 18, '2026-09-03 02:18:03', NULL, '2026-09-03 02:18:03', '2026-09-03 02:18:03'),
(285, 1, '2026-09-03 02:18:12', NULL, '2026-09-03 02:18:12', '2026-09-03 02:18:12'),
(286, 18, '2026-09-03 05:09:31', NULL, '2026-09-03 05:09:31', '2026-09-03 05:09:31'),
(287, 1, '2026-09-03 05:48:54', NULL, '2026-09-03 05:48:54', '2026-09-03 05:48:54'),
(288, 15, '2026-09-03 05:53:13', NULL, '2026-09-03 05:53:13', '2026-09-03 05:53:13'),
(290, 2, '2026-09-03 05:54:51', NULL, '2026-09-03 05:54:51', '2026-09-03 05:54:51'),
(291, 10, '2026-09-03 05:55:26', NULL, '2026-09-03 05:55:26', '2026-09-03 05:55:26'),
(292, 1, '2026-09-03 05:57:01', NULL, '2026-09-03 05:57:01', '2026-09-03 05:57:01'),
(293, 19, '2026-09-03 05:57:53', NULL, '2026-09-03 05:57:53', '2026-09-03 05:57:53'),
(294, 1, '2026-09-03 05:58:32', NULL, '2026-09-03 05:58:32', '2026-09-03 05:58:32'),
(295, 19, '2026-09-03 05:58:39', NULL, '2026-09-03 05:58:39', '2026-09-03 05:58:39'),
(297, 1, '2026-09-03 23:37:23', NULL, '2026-09-03 23:37:23', '2026-09-03 23:37:23'),
(298, 19, '2026-09-04 01:41:07', NULL, '2026-09-04 01:41:07', '2026-09-04 01:41:07'),
(302, 1, '2026-09-04 02:21:32', NULL, '2026-09-04 02:21:32', '2026-09-04 02:21:32'),
(303, 1, '2026-09-04 02:24:08', NULL, '2026-09-04 02:24:08', '2026-09-04 02:24:08'),
(305, 1, '2026-09-04 02:25:08', NULL, '2026-09-04 02:25:08', '2026-09-04 02:25:08'),
(308, 1, '2026-09-04 06:13:28', NULL, '2026-09-04 06:13:28', '2026-09-04 06:13:28'),
(309, 19, '2026-09-04 06:14:54', NULL, '2026-09-04 06:14:54', '2026-09-04 06:14:54'),
(310, 1, '2026-09-04 06:23:40', NULL, '2026-09-04 06:23:40', '2026-09-04 06:23:40'),
(311, 23, '2026-09-04 06:25:02', NULL, '2026-09-04 06:25:02', '2026-09-04 06:25:02'),
(312, 19, '2026-09-05 06:22:02', NULL, '2026-09-05 06:22:02', '2026-09-05 06:22:02'),
(313, 19, '2026-09-07 00:00:59', NULL, '2026-09-07 00:00:59', '2026-09-07 00:00:59'),
(314, 19, '2026-09-07 01:05:57', NULL, '2026-09-07 01:05:57', '2026-09-07 01:05:57'),
(315, 19, '2026-09-07 05:06:03', NULL, '2026-09-07 05:06:03', '2026-09-07 05:06:03'),
(316, 19, '2026-09-08 03:12:08', NULL, '2026-09-08 03:12:08', '2026-09-08 03:12:08'),
(317, 19, '2026-09-08 07:38:03', NULL, '2026-09-08 07:38:03', '2026-09-08 07:38:03'),
(318, 1, '2026-09-08 08:19:51', NULL, '2026-09-08 08:19:51', '2026-09-08 08:19:51'),
(319, 19, '2026-09-09 02:43:35', NULL, '2026-09-09 02:43:35', '2026-09-09 02:43:35'),
(320, 1, '2026-09-09 02:44:39', NULL, '2026-09-09 02:44:39', '2026-09-09 02:44:39'),
(321, 19, '2026-09-09 02:55:16', NULL, '2026-09-09 02:55:16', '2026-09-09 02:55:16'),
(322, 19, '2026-09-09 03:00:25', NULL, '2026-09-09 03:00:25', '2026-09-09 03:00:25'),
(323, 18, '2026-09-09 03:02:53', NULL, '2026-09-09 03:02:53', '2026-09-09 03:02:53'),
(324, 18, '2026-09-09 03:03:30', NULL, '2026-09-09 03:03:30', '2026-09-09 03:03:30'),
(325, 1, '2026-09-09 06:01:14', NULL, '2026-09-09 06:01:14', '2026-09-09 06:01:14'),
(326, 19, '2026-09-09 06:04:15', NULL, '2026-09-09 06:04:15', '2026-09-09 06:04:15'),
(327, 1, '2026-09-09 06:27:34', NULL, '2026-09-09 06:27:34', '2026-09-09 06:27:34'),
(328, 23, '2026-09-09 06:28:49', NULL, '2026-09-09 06:28:49', '2026-09-09 06:28:49'),
(329, 18, '2026-09-09 06:58:14', NULL, '2026-09-09 06:58:14', '2026-09-09 06:58:14'),
(330, 18, '2026-09-09 06:59:01', NULL, '2026-09-09 06:59:01', '2026-09-09 06:59:01'),
(331, 18, '2026-09-09 06:59:12', NULL, '2026-09-09 06:59:12', '2026-09-09 06:59:12'),
(332, 18, '2026-09-09 07:00:22', NULL, '2026-09-09 07:00:22', '2026-09-09 07:00:22'),
(333, 19, '2026-09-09 07:09:42', NULL, '2026-09-09 07:09:42', '2026-09-09 07:09:42'),
(334, 19, '2026-09-10 00:35:54', NULL, '2026-09-10 00:35:54', '2026-09-10 00:35:54'),
(335, 1, '2026-09-10 00:53:25', NULL, '2026-09-10 00:53:25', '2026-09-10 00:53:25'),
(336, 19, '2026-09-10 01:07:39', NULL, '2026-09-10 01:07:39', '2026-09-10 01:07:39'),
(337, 1, '2026-09-10 01:08:17', NULL, '2026-09-10 01:08:17', '2026-09-10 01:08:17'),
(338, 19, '2026-09-10 01:10:45', NULL, '2026-09-10 01:10:45', '2026-09-10 01:10:45'),
(339, 1, '2026-09-10 01:20:21', NULL, '2026-09-10 01:20:21', '2026-09-10 01:20:21'),
(340, 1, '2026-09-10 01:20:53', NULL, '2026-09-10 01:20:53', '2026-09-10 01:20:53'),
(341, 1, '2026-09-10 01:23:16', NULL, '2026-09-10 01:23:16', '2026-09-10 01:23:16'),
(342, 19, '2026-09-10 06:19:42', NULL, '2026-09-10 06:19:42', '2026-09-10 06:19:42'),
(343, 1, '2026-09-10 06:40:53', NULL, '2026-09-10 06:40:53', '2026-09-10 06:40:53'),
(344, 1, '2026-09-10 06:48:02', NULL, '2026-09-10 06:48:02', '2026-09-10 06:48:02'),
(345, 1, '2026-09-11 01:09:09', NULL, '2026-09-11 01:09:09', '2026-09-11 01:09:09'),
(346, 1, '2026-09-11 01:11:59', NULL, '2026-09-11 01:11:59', '2026-09-11 01:11:59'),
(347, 15, '2026-09-11 01:12:31', NULL, '2026-09-11 01:12:31', '2026-09-11 01:12:31'),
(350, 15, '2026-09-11 01:13:33', NULL, '2026-09-11 01:13:33', '2026-09-11 01:13:33'),
(352, 15, '2026-09-11 01:14:11', NULL, '2026-09-11 01:14:11', '2026-09-11 01:14:11'),
(353, 1, '2026-09-11 01:14:18', NULL, '2026-09-11 01:14:18', '2026-09-11 01:14:18'),
(355, 24, '2026-09-11 01:15:20', NULL, '2026-09-11 01:15:20', '2026-09-11 01:15:20'),
(356, 24, '2026-09-11 02:48:30', NULL, '2026-09-11 02:48:30', '2026-09-11 02:48:30'),
(357, 19, '2026-09-14 00:03:13', NULL, '2026-09-14 00:03:13', '2026-09-14 00:03:13'),
(358, 1, '2026-09-14 00:16:44', NULL, '2026-09-14 00:16:44', '2026-09-14 00:16:44'),
(359, 1, '2026-09-14 00:57:32', NULL, '2026-09-14 00:57:32', '2026-09-14 00:57:32'),
(360, 24, '2026-09-14 01:24:00', NULL, '2026-09-14 01:24:00', '2026-09-14 01:24:00'),
(361, 24, '2026-09-14 01:48:26', NULL, '2026-09-14 01:48:26', '2026-09-14 01:48:26'),
(362, 12, '2026-09-14 01:49:37', NULL, '2026-09-14 01:49:37', '2026-09-14 01:49:37'),
(363, 12, '2026-09-14 02:02:57', NULL, '2026-09-14 02:02:57', '2026-09-14 02:02:57'),
(364, 1, '2026-09-14 05:15:13', NULL, '2026-09-14 05:15:13', '2026-09-14 05:15:13'),
(365, 1, '2026-09-14 05:23:26', NULL, '2026-09-14 05:23:26', '2026-09-14 05:23:26'),
(366, 1, '2026-09-14 23:36:04', NULL, '2026-09-14 23:36:04', '2026-09-14 23:36:04'),
(367, 12, '2026-09-15 00:45:05', NULL, '2026-09-15 00:45:05', '2026-09-15 00:45:05'),
(368, 15, '2026-09-15 00:53:35', NULL, '2026-09-15 00:53:35', '2026-09-15 00:53:35'),
(369, 15, '2026-09-15 00:54:06', NULL, '2026-09-15 00:54:06', '2026-09-15 00:54:06'),
(370, 1, '2026-09-15 00:54:33', NULL, '2026-09-15 00:54:33', '2026-09-15 00:54:33'),
(371, 15, '2026-09-15 00:55:54', NULL, '2026-09-15 00:55:54', '2026-09-15 00:55:54'),
(372, 15, '2026-09-15 00:56:24', NULL, '2026-09-15 00:56:24', '2026-09-15 00:56:24'),
(373, 15, '2026-09-15 00:56:46', NULL, '2026-09-15 00:56:46', '2026-09-15 00:56:46'),
(374, 15, '2026-09-15 00:57:09', NULL, '2026-09-15 00:57:09', '2026-09-15 00:57:09'),
(375, 15, '2026-09-15 00:57:40', NULL, '2026-09-15 00:57:40', '2026-09-15 00:57:40'),
(376, 28, '2026-09-15 01:05:47', NULL, '2026-09-15 01:05:47', '2026-09-15 01:05:47'),
(377, 28, '2026-09-15 01:08:09', NULL, '2026-09-15 01:08:09', '2026-09-15 01:08:09'),
(378, 28, '2026-09-15 01:08:46', NULL, '2026-09-15 01:08:46', '2026-09-15 01:08:46'),
(379, 28, '2026-09-15 01:09:18', NULL, '2026-09-15 01:09:18', '2026-09-15 01:09:18'),
(380, 28, '2026-09-15 01:09:41', NULL, '2026-09-15 01:09:41', '2026-09-15 01:09:41'),
(381, 10, '2026-09-15 01:16:53', NULL, '2026-09-15 01:16:53', '2026-09-15 01:16:53'),
(382, 2, '2026-09-15 01:17:14', NULL, '2026-09-15 01:17:14', '2026-09-15 01:17:14'),
(383, 2, '2026-09-15 01:17:48', NULL, '2026-09-15 01:17:48', '2026-09-15 01:17:48'),
(384, 10, '2026-09-15 01:21:22', NULL, '2026-09-15 01:21:22', '2026-09-15 01:21:22'),
(385, 10, '2026-09-15 01:21:53', NULL, '2026-09-15 01:21:53', '2026-09-15 01:21:53'),
(386, 10, '2026-09-15 01:22:16', NULL, '2026-09-15 01:22:16', '2026-09-15 01:22:16'),
(387, 10, '2026-09-15 01:23:18', NULL, '2026-09-15 01:23:18', '2026-09-15 01:23:18'),
(388, 1, '2026-09-15 01:41:55', NULL, '2026-09-15 01:41:55', '2026-09-15 01:41:55'),
(389, 1, '2026-09-15 05:58:37', NULL, '2026-09-15 05:58:37', '2026-09-15 05:58:37'),
(390, 24, '2026-09-15 05:59:00', NULL, '2026-09-15 05:59:00', '2026-09-15 05:59:00'),
(391, 1, '2026-09-15 06:17:21', NULL, '2026-09-15 06:17:21', '2026-09-15 06:17:21'),
(392, 1, '2026-09-16 02:14:16', NULL, '2026-09-16 02:14:16', '2026-09-16 02:14:16'),
(393, 1, '2026-09-16 02:14:40', NULL, '2026-09-16 02:14:40', '2026-09-16 02:14:40'),
(394, 15, '2026-09-16 02:16:13', NULL, '2026-09-16 02:16:13', '2026-09-16 02:16:13'),
(395, 15, '2026-09-16 02:16:41', NULL, '2026-09-16 02:16:41', '2026-09-16 02:16:41'),
(396, 3, '2026-09-16 02:19:31', NULL, '2026-09-16 02:19:31', '2026-09-16 02:19:31'),
(397, 15, '2026-09-16 02:21:44', NULL, '2026-09-16 02:21:44', '2026-09-16 02:21:44'),
(399, 15, '2026-09-16 02:24:23', NULL, '2026-09-16 02:24:23', '2026-09-16 02:24:23'),
(400, 15, '2026-09-16 02:24:56', NULL, '2026-09-16 02:24:56', '2026-09-16 02:24:56'),
(401, 15, '2026-09-16 02:25:08', NULL, '2026-09-16 02:25:08', '2026-09-16 02:25:08'),
(403, 15, '2026-09-16 02:25:52', NULL, '2026-09-16 02:25:52', '2026-09-16 02:25:52'),
(404, 30, '2026-09-16 02:26:34', NULL, '2026-09-16 02:26:34', '2026-09-16 02:26:34'),
(405, 24, '2026-09-16 02:28:34', NULL, '2026-09-16 02:28:34', '2026-09-16 02:28:34'),
(407, 19, '2026-09-16 03:59:08', NULL, '2026-09-16 03:59:08', '2026-09-16 03:59:08'),
(413, 15, '2026-09-16 04:17:00', NULL, '2026-09-16 04:17:00', '2026-09-16 04:17:00'),
(414, 19, '2026-09-16 04:17:32', NULL, '2026-09-16 04:17:32', '2026-09-16 04:17:32'),
(415, 19, '2026-09-16 04:31:55', NULL, '2026-09-16 04:31:55', '2026-09-16 04:31:55'),
(416, 15, '2026-09-16 04:32:45', NULL, '2026-09-16 04:32:45', '2026-09-16 04:32:45'),
(417, 15, '2026-09-16 04:32:51', NULL, '2026-09-16 04:32:51', '2026-09-16 04:32:51'),
(418, 1, '2026-09-16 07:35:02', NULL, '2026-09-16 07:35:02', '2026-09-16 07:35:02'),
(419, 24, '2026-09-16 07:35:35', NULL, '2026-09-16 07:35:35', '2026-09-16 07:35:35'),
(420, 24, '2026-09-16 07:47:56', NULL, '2026-09-16 07:47:56', '2026-09-16 07:47:56'),
(421, 1, '2026-09-17 01:22:37', NULL, '2026-09-17 01:22:37', '2026-09-17 01:22:37'),
(422, 24, '2026-09-17 01:22:59', NULL, '2026-09-17 01:22:59', '2026-09-17 01:22:59'),
(423, 24, '2026-09-17 01:30:04', NULL, '2026-09-17 01:30:04', '2026-09-17 01:30:04'),
(424, 1, '2026-09-17 01:30:32', NULL, '2026-09-17 01:30:32', '2026-09-17 01:30:32'),
(426, 12, '2026-09-17 03:06:09', NULL, '2026-09-17 03:06:09', '2026-09-17 03:06:09'),
(427, 19, '2026-09-17 05:26:31', NULL, '2026-09-17 05:26:31', '2026-09-17 05:26:31'),
(430, 19, '2026-09-17 05:35:02', NULL, '2026-09-17 05:35:02', '2026-09-17 05:35:02'),
(431, 1, '2026-09-17 05:38:36', NULL, '2026-09-17 05:38:36', '2026-09-17 05:38:36'),
(433, 30, '2026-09-17 05:58:27', NULL, '2026-09-17 05:58:27', '2026-09-17 05:58:27'),
(434, 15, '2026-09-17 05:58:57', NULL, '2026-09-17 05:58:57', '2026-09-17 05:58:57'),
(435, 15, '2026-09-17 05:59:17', NULL, '2026-09-17 05:59:17', '2026-09-17 05:59:17'),
(436, 15, '2026-09-17 05:59:32', NULL, '2026-09-17 05:59:32', '2026-09-17 05:59:32'),
(437, 30, '2026-09-17 05:59:50', NULL, '2026-09-17 05:59:50', '2026-09-17 05:59:50'),
(440, 1, '2026-09-17 06:24:33', NULL, '2026-09-17 06:24:33', '2026-09-17 06:24:33'),
(441, 28, '2026-09-17 06:33:12', NULL, '2026-09-17 06:33:12', '2026-09-17 06:33:12'),
(443, 30, '2026-09-17 06:41:25', NULL, '2026-09-17 06:41:25', '2026-09-17 06:41:25'),
(444, 30, '2026-09-17 06:41:33', NULL, '2026-09-17 06:41:33', '2026-09-17 06:41:33'),
(445, 30, '2026-09-17 06:44:56', NULL, '2026-09-17 06:44:56', '2026-09-17 06:44:56'),
(446, 1, '2026-09-17 07:18:15', NULL, '2026-09-17 07:18:15', '2026-09-17 07:18:15'),
(447, 24, '2026-09-17 08:01:13', NULL, '2026-09-17 08:01:13', '2026-09-17 08:01:13'),
(448, 1, '2026-09-20 23:56:53', NULL, '2026-09-20 23:56:53', '2026-09-20 23:56:53'),
(449, 1, '2026-09-20 23:57:09', NULL, '2026-09-20 23:57:09', '2026-09-20 23:57:09'),
(450, 1, '2026-09-21 00:14:29', NULL, '2026-09-21 00:14:29', '2026-09-21 00:14:29'),
(451, 19, '2026-09-21 06:38:08', NULL, '2026-09-21 06:38:08', '2026-09-21 06:38:08'),
(452, 1, '2026-09-21 07:12:50', NULL, '2026-09-21 07:12:50', '2026-09-21 07:12:50'),
(453, 1, '2026-09-21 07:12:51', NULL, '2026-09-21 07:12:51', '2026-09-21 07:12:51'),
(454, 1, '2026-09-22 05:28:47', NULL, '2026-09-22 05:28:47', '2026-09-22 05:28:47'),
(455, 1, '2026-09-22 06:19:18', NULL, '2026-09-22 06:19:18', '2026-09-22 06:19:18'),
(456, 19, '2026-09-22 06:23:05', NULL, '2026-09-22 06:23:05', '2026-09-22 06:23:05'),
(457, 1, '2026-09-23 00:28:44', NULL, '2026-09-23 00:28:44', '2026-09-23 00:28:44'),
(458, 19, '2026-09-23 01:54:13', NULL, '2026-09-23 01:54:13', '2026-09-23 01:54:13'),
(459, 19, '2026-09-23 02:41:19', NULL, '2026-09-23 02:41:19', '2026-09-23 02:41:19'),
(461, 1, '2026-09-23 06:25:33', NULL, '2026-09-23 06:25:33', '2026-09-23 06:25:33'),
(462, 1, '2026-09-23 06:25:36', NULL, '2026-09-23 06:25:36', '2026-09-23 06:25:36'),
(463, 1, '2026-09-23 06:26:16', NULL, '2026-09-23 06:26:16', '2026-09-23 06:26:16'),
(464, 1, '2026-09-23 06:26:34', NULL, '2026-09-23 06:26:34', '2026-09-23 06:26:34'),
(465, 19, '2026-09-23 06:34:27', NULL, '2026-09-23 06:34:27', '2026-09-23 06:34:27'),
(466, 1, '2026-09-23 06:51:24', NULL, '2026-09-23 06:51:24', '2026-09-23 06:51:24'),
(467, 1, '2026-09-23 06:55:47', NULL, '2026-09-23 06:55:47', '2026-09-23 06:55:47'),
(468, 1, '2026-09-24 00:42:13', NULL, '2026-09-24 00:42:13', '2026-09-24 00:42:13'),
(469, 1, '2026-09-24 00:42:25', NULL, '2026-09-24 00:42:25', '2026-09-24 00:42:25'),
(470, 1, '2026-09-24 02:27:05', NULL, '2026-09-24 02:27:05', '2026-09-24 02:27:05'),
(471, 18, '2026-09-24 02:44:21', NULL, '2026-09-24 02:44:21', '2026-09-24 02:44:21'),
(472, 28, '2026-09-24 02:45:39', NULL, '2026-09-24 02:45:39', '2026-09-24 02:45:39'),
(473, 19, '2026-09-24 05:16:18', NULL, '2026-09-24 05:16:18', '2026-09-24 05:16:18'),
(474, 19, '2026-09-24 05:20:59', NULL, '2026-09-24 05:20:59', '2026-09-24 05:20:59'),
(475, 1, '2026-09-24 05:34:30', NULL, '2026-09-24 05:34:30', '2026-09-24 05:34:30'),
(476, 28, '2026-09-24 05:34:57', NULL, '2026-09-24 05:34:57', '2026-09-24 05:34:57'),
(477, 1, '2026-09-25 00:36:14', NULL, '2026-09-25 00:36:14', '2026-09-25 00:36:14'),
(478, 28, '2026-09-25 00:37:56', NULL, '2026-09-25 00:37:56', '2026-09-25 00:37:56'),
(479, 19, '2026-09-25 01:58:33', NULL, '2026-09-25 01:58:33', '2026-09-25 01:58:33'),
(480, 19, '2026-09-25 07:47:43', NULL, '2026-09-25 07:47:43', '2026-09-25 07:47:43'),
(481, 1, '2026-09-28 00:29:17', NULL, '2026-09-28 00:29:17', '2026-09-28 00:29:17'),
(482, 28, '2026-09-28 00:31:31', NULL, '2026-09-28 00:31:31', '2026-09-28 00:31:31'),
(483, 19, '2026-09-28 00:52:53', NULL, '2026-09-28 00:52:53', '2026-09-28 00:52:53'),
(484, 19, '2026-09-28 01:10:55', NULL, '2026-09-28 01:10:55', '2026-09-28 01:10:55'),
(485, 1, '2026-09-28 03:08:05', NULL, '2026-09-28 03:08:05', '2026-09-28 03:08:05'),
(486, 19, '2026-09-28 03:09:02', NULL, '2026-09-28 03:09:02', '2026-09-28 03:09:02'),
(487, 1, '2026-09-28 06:45:35', NULL, '2026-09-28 06:45:35', '2026-09-28 06:45:35'),
(488, 28, '2026-09-28 06:45:48', NULL, '2026-09-28 06:45:48', '2026-09-28 06:45:48'),
(489, 1, '2026-09-29 05:29:12', NULL, '2026-09-29 05:29:12', '2026-09-29 05:29:12'),
(490, 28, '2026-09-29 05:30:08', NULL, '2026-09-29 05:30:08', '2026-09-29 05:30:08'),
(491, 19, '2026-09-29 07:21:23', NULL, '2026-09-29 07:21:23', '2026-09-29 07:21:23'),
(492, 19, '2026-09-30 02:15:32', NULL, '2026-09-30 02:15:32', '2026-09-30 02:15:32'),
(493, 1, '2026-09-30 04:40:25', NULL, '2026-09-30 04:40:25', '2026-09-30 04:40:25'),
(494, 19, '2026-09-30 07:04:54', NULL, '2026-09-30 07:04:54', '2026-09-30 07:04:54'),
(495, 1, '2026-09-30 23:33:02', NULL, '2026-09-30 23:33:02', '2026-09-30 23:33:02'),
(496, 28, '2026-09-30 23:33:29', NULL, '2026-09-30 23:33:29', '2026-09-30 23:33:29'),
(497, 19, '2026-10-01 02:11:20', NULL, '2026-10-01 02:11:20', '2026-10-01 02:11:20'),
(498, 19, '2026-10-01 02:11:35', NULL, '2026-10-01 02:11:35', '2026-10-01 02:11:35'),
(499, 1, '2026-10-01 04:12:09', NULL, '2026-10-01 04:12:09', '2026-10-01 04:12:09'),
(500, 28, '2026-10-01 04:13:24', NULL, '2026-10-01 04:13:24', '2026-10-01 04:13:24'),
(501, 1, '2026-10-01 07:43:08', NULL, '2026-10-01 07:43:08', '2026-10-01 07:43:08'),
(502, 19, '2026-10-01 07:44:30', NULL, '2026-10-01 07:44:30', '2026-10-01 07:44:30'),
(503, 1, '2026-10-01 07:49:22', NULL, '2026-10-01 07:49:22', '2026-10-01 07:49:22'),
(504, 28, '2026-10-01 07:52:35', NULL, '2026-10-01 07:52:35', '2026-10-01 07:52:35'),
(505, 1, '2026-10-01 23:29:08', NULL, '2026-10-01 23:29:08', '2026-10-01 23:29:08'),
(506, 28, '2026-10-01 23:30:05', NULL, '2026-10-01 23:30:05', '2026-10-01 23:30:05'),
(507, 19, '2026-10-01 23:48:10', NULL, '2026-10-01 23:48:10', '2026-10-01 23:48:10'),
(508, 1, '2026-10-02 01:12:04', NULL, '2026-10-02 01:12:04', '2026-10-02 01:12:04'),
(509, 24, '2026-10-02 01:22:08', NULL, '2026-10-02 01:22:08', '2026-10-02 01:22:08'),
(510, 19, '2026-10-02 03:04:19', NULL, '2026-10-02 03:04:19', '2026-10-02 03:04:19'),
(511, 19, '2026-10-02 03:10:10', NULL, '2026-10-02 03:10:10', '2026-10-02 03:10:10'),
(513, 19, '2026-10-02 03:12:41', NULL, '2026-10-02 03:12:41', '2026-10-02 03:12:41'),
(514, 1, '2026-10-02 03:18:22', NULL, '2026-10-02 03:18:22', '2026-10-02 03:18:22'),
(515, 1, '2026-10-02 07:58:15', NULL, '2026-10-02 07:58:15', '2026-10-02 07:58:15'),
(516, 19, '2026-10-02 11:45:48', NULL, '2026-10-02 11:45:48', '2026-10-02 11:45:48'),
(517, 1, '2026-10-03 03:01:54', NULL, '2026-10-03 03:01:54', '2026-10-03 03:01:54'),
(518, 1, '2026-10-04 23:41:22', NULL, '2026-10-04 23:41:22', '2026-10-04 23:41:22'),
(519, 1, '2026-10-04 23:43:11', NULL, '2026-10-04 23:43:11', '2026-10-04 23:43:11'),
(520, 24, '2026-10-04 23:48:01', NULL, '2026-10-04 23:48:01', '2026-10-04 23:48:01'),
(521, 24, '2026-10-04 23:52:25', NULL, '2026-10-04 23:52:25', '2026-10-04 23:52:25'),
(522, 24, '2026-10-04 23:52:41', NULL, '2026-10-04 23:52:41', '2026-10-04 23:52:41'),
(523, 1, '2026-10-04 23:52:56', NULL, '2026-10-04 23:52:56', '2026-10-04 23:52:56'),
(524, 32, '2026-10-04 23:58:47', NULL, '2026-10-04 23:58:47', '2026-10-04 23:58:47'),
(525, 1, '2026-10-04 23:59:46', NULL, '2026-10-04 23:59:46', '2026-10-04 23:59:46'),
(526, 1, '2026-10-05 00:01:02', NULL, '2026-10-05 00:01:02', '2026-10-05 00:01:02'),
(527, 1, '2026-10-05 01:08:27', NULL, '2026-10-05 01:08:27', '2026-10-05 01:08:27'),
(528, 1, '2026-10-05 01:09:38', NULL, '2026-10-05 01:09:38', '2026-10-05 01:09:38'),
(529, 1, '2026-10-05 01:11:28', NULL, '2026-10-05 01:11:28', '2026-10-05 01:11:28'),
(530, 1, '2026-10-05 01:23:07', NULL, '2026-10-05 01:23:07', '2026-10-05 01:23:07'),
(531, 24, '2026-10-05 01:43:36', NULL, '2026-10-05 01:43:36', '2026-10-05 01:43:36'),
(532, 15, '2026-10-05 01:48:31', NULL, '2026-10-05 01:48:31', '2026-10-05 01:48:31'),
(533, 1, '2026-10-05 01:52:31', NULL, '2026-10-05 01:52:31', '2026-10-05 01:52:31'),
(534, 30, '2026-10-05 01:53:11', NULL, '2026-10-05 01:53:11', '2026-10-05 01:53:11'),
(535, 33, '2026-10-05 02:19:09', NULL, '2026-10-05 02:19:09', '2026-10-05 02:19:09'),
(536, 19, '2026-10-05 02:27:18', NULL, '2026-10-05 02:27:18', '2026-10-05 02:27:18'),
(537, 1, '2026-10-05 02:36:02', NULL, '2026-10-05 02:36:02', '2026-10-05 02:36:02'),
(538, 1, '2026-10-05 05:45:17', NULL, '2026-10-05 05:45:17', '2026-10-05 05:45:17'),
(539, 1, '2026-10-05 07:09:21', NULL, '2026-10-05 07:09:21', '2026-10-05 07:09:21'),
(540, 1, '2026-10-05 23:51:17', NULL, '2026-10-05 23:51:17', '2026-10-05 23:51:17'),
(541, 1, '2026-10-06 00:51:15', NULL, '2026-10-06 00:51:15', '2026-10-06 00:51:15'),
(542, 24, '2026-10-06 01:08:53', NULL, '2026-10-06 01:08:53', '2026-10-06 01:08:53'),
(543, 1, '2026-10-06 01:11:15', NULL, '2026-10-06 01:11:15', '2026-10-06 01:11:15'),
(544, 30, '2026-10-06 01:14:47', NULL, '2026-10-06 01:14:47', '2026-10-06 01:14:47'),
(545, 1, '2026-10-06 01:17:41', NULL, '2026-10-06 01:17:41', '2026-10-06 01:17:41'),
(546, 1, '2026-10-06 03:11:00', NULL, '2026-10-06 03:11:00', '2026-10-06 03:11:00'),
(547, 1, '2026-10-06 05:08:18', NULL, '2026-10-06 05:08:18', '2026-10-06 05:08:18'),
(548, 3, '2026-10-06 05:09:48', NULL, '2026-10-06 05:09:48', '2026-10-06 05:09:48'),
(549, 1, '2026-10-06 05:11:39', NULL, '2026-10-06 05:11:39', '2026-10-06 05:11:39'),
(550, 1, '2026-10-06 05:36:17', NULL, '2026-10-06 05:36:17', '2026-10-06 05:36:17'),
(551, 3, '2026-10-06 05:37:15', NULL, '2026-10-06 05:37:15', '2026-10-06 05:37:15'),
(552, 1, '2026-10-06 05:38:15', NULL, '2026-10-06 05:38:15', '2026-10-06 05:38:15'),
(553, 3, '2026-10-06 05:42:22', NULL, '2026-10-06 05:42:22', '2026-10-06 05:42:22'),
(554, 1, '2026-10-06 05:43:38', NULL, '2026-10-06 05:43:38', '2026-10-06 05:43:38'),
(555, 1, '2026-10-06 23:47:03', NULL, '2026-10-06 23:47:03', '2026-10-06 23:47:03'),
(556, 1, '2026-10-06 23:50:42', NULL, '2026-10-06 23:50:42', '2026-10-06 23:50:42'),
(557, 1, '2026-10-06 23:51:50', NULL, '2026-10-06 23:51:50', '2026-10-06 23:51:50'),
(558, 3, '2026-10-06 23:52:29', NULL, '2026-10-06 23:52:29', '2026-10-06 23:52:29'),
(559, 1, '2026-10-06 23:53:32', NULL, '2026-10-06 23:53:32', '2026-10-06 23:53:32'),
(560, 24, '2026-10-07 00:02:51', NULL, '2026-10-07 00:02:51', '2026-10-07 00:02:51'),
(561, 1, '2026-10-07 00:05:09', NULL, '2026-10-07 00:05:09', '2026-10-07 00:05:09'),
(562, 1, '2026-10-07 00:05:18', NULL, '2026-10-07 00:05:18', '2026-10-07 00:05:18'),
(563, 30, '2026-10-07 00:06:04', NULL, '2026-10-07 00:06:04', '2026-10-07 00:06:04'),
(564, 1, '2026-10-07 02:02:07', NULL, '2026-10-07 02:02:07', '2026-10-07 02:02:07'),
(565, 1, '2026-10-07 03:12:23', NULL, '2026-10-07 03:12:23', '2026-10-07 03:12:23'),
(566, 1, '2026-10-07 05:50:44', NULL, '2026-10-07 05:50:44', '2026-10-07 05:50:44'),
(567, 1, '2026-10-07 06:10:31', NULL, '2026-10-07 06:10:31', '2026-10-07 06:10:31'),
(568, 1, '2026-10-07 06:20:55', NULL, '2026-10-07 06:20:55', '2026-10-07 06:20:55'),
(569, 1, '2026-10-07 06:34:11', NULL, '2026-10-07 06:34:11', '2026-10-07 06:34:11'),
(570, 1, '2026-10-08 00:10:10', NULL, '2026-10-08 00:10:10', '2026-10-08 00:10:10'),
(571, 3, '2026-10-08 00:10:54', NULL, '2026-10-08 00:10:54', '2026-10-08 00:10:54'),
(572, 1, '2026-10-08 00:11:58', NULL, '2026-10-08 00:11:58', '2026-10-08 00:11:58'),
(573, 1, '2026-10-08 00:13:18', NULL, '2026-10-08 00:13:18', '2026-10-08 00:13:18'),
(574, 1, '2026-10-08 00:50:21', NULL, '2026-10-08 00:50:21', '2026-10-08 00:50:21'),
(575, 1, '2026-10-08 01:04:34', NULL, '2026-10-08 01:04:34', '2026-10-08 01:04:34'),
(576, 24, '2026-10-08 01:05:46', NULL, '2026-10-08 01:05:46', '2026-10-08 01:05:46'),
(577, 1, '2026-10-08 01:08:38', NULL, '2026-10-08 01:08:38', '2026-10-08 01:08:38'),
(578, 30, '2026-10-08 01:11:38', NULL, '2026-10-08 01:11:38', '2026-10-08 01:11:38'),
(579, 1, '2026-10-08 01:20:10', NULL, '2026-10-08 01:20:10', '2026-10-08 01:20:10'),
(580, 1, '2026-10-08 01:20:48', NULL, '2026-10-08 01:20:48', '2026-10-08 01:20:48'),
(581, 3, '2026-10-08 01:21:41', NULL, '2026-10-08 01:21:41', '2026-10-08 01:21:41'),
(582, 1, '2026-10-08 01:23:04', NULL, '2026-10-08 01:23:04', '2026-10-08 01:23:04'),
(583, 1, '2026-10-08 01:35:06', NULL, '2026-10-08 01:35:06', '2026-10-08 01:35:06'),
(584, 1, '2026-10-08 01:35:57', NULL, '2026-10-08 01:35:57', '2026-10-08 01:35:57'),
(585, 1, '2026-10-08 01:51:26', NULL, '2026-10-08 01:51:26', '2026-10-08 01:51:26'),
(586, 1, '2026-10-08 02:02:04', NULL, '2026-10-08 02:02:04', '2026-10-08 02:02:04'),
(587, 1, '2026-10-08 05:52:13', NULL, '2026-10-08 05:52:13', '2026-10-08 05:52:13'),
(588, 19, '2026-10-08 06:55:33', NULL, '2026-10-08 06:55:33', '2026-10-08 06:55:33'),
(589, 1, '2026-10-08 08:16:04', NULL, '2026-10-08 08:16:04', '2026-10-08 08:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_11_17_120946_create_jabatan_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2024_10_24_020418_create_jenis_barang_table', 1),
(6, '2024_10_24_020444_create_barang_table', 1),
(7, '2024_11_04_001540_create_peruntukan_table', 1),
(8, '2024_11_04_002537_create_perawatan_table', 1),
(9, '2024_11_04_002636_create_peminjaman_table', 1),
(10, '2024_11_04_002709_create_pengembalian_table', 1),
(11, '2024_11_05_061543_create_detail_peminjaman_table', 1),
(12, '2024_11_05_061552_create_detail_pengembalian_table', 1),
(13, '2024_12_22_182303_create_log_table', 1),
(14, '2024_12_27_083246_create_catatan_table', 1),
(15, '2025_01_20_134343_create_guidebook_table', 1),
(16, '2025_10_06_130658_add_notes_to_schedules_table', 1),
(17, '2025_10_22_041056_create_bmn_barangs_table', 1),
(18, '2025_10_22_104929_add_studio_to_barang_table', 1),
(19, '2025_10_22_110718_add_uuid_to_barang_table', 1),
(20, '2025_10_22_111639_modify_nomor_seri_nullable_on_barang_table', 1),
(21, '2025_10_22_112024_modify_merk_nullable_on_barang_table', 1),
(22, '2025_10_22_112500_modify_jenis_barang_nullable_on_barang_table', 1),
(23, '2025_10_22_113022_modify_qr_code_nullable_on_barang_table', 1),
(24, '2025_10_22_113236_modify_limit_nullable_on_barang_table', 1),
(25, '2025_10_23_095547_add_extra_fields_to_barang_table', 1),
(26, '2025_10_23_101256_add_fields_to_barang_table', 1),
(27, '2025_10_23_101542_add_new_fields_to_barang_table', 1),
(28, '2025_10_29_080354_add_pengadaan_fields_to_barang_table', 1),
(29, '2025_10_29_083323_add_asal_pengadaan_to_barang_table', 1),
(30, '2025_10_30_123324_add_uuid_to_bmn_barangs_table', 1),
(31, '2025_10_30_123727_add_qr_code_to_bmn_barangs_table', 1),
(32, '2025_11_18_165108_create_slider_images_table', 1),
(33, '2025_11_20_120757_create_perawatan_inventaris_table', 1),
(34, '2025_11_26_142152_create_surat_table', 1),
(35, '2025_12_27_155322_create_bmn_ruangans_table', 1),
(36, '2025_12_27_155347_create_bmn_kategoris_table', 1),
(37, '2025_12_27_172841_create_bmn_jenis_kerusakans_table', 1),
(38, '2025_12_28_122618_update_bmn_barangs_table', 1),
(39, '2025_12_30_222249_create_laporan_kerusakan_table', 1),
(40, '2026_02_10_120307_add_user_id_to_laporan_kerusakan_table', 1),
(41, '2026_02_26_185608_create_penggunas_table', 1),
(42, '2026_02_26_191148_create_unit_kerjas_table', 1),
(43, '2026_03_03_082340_add_pengguna_id_to_bmn_barangs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('abdulkhalikadi.d@gmail.com', '$2y$12$HzEXf5/XHndJFcxf4dBdE.Sm5G.Blh/TXUueIaW.VfqEYDyj2DlyS', '2026-09-09 03:05:24'),
('rafisha@gmail.com', '$2y$12$hqEsZfs5FvOWlwRX19K3h.8C5jEpIobPeLrzjQjS3/GXKPLCRGr3y', '2026-09-09 03:03:35'),
('yuli.anita@mhs.politala.ac.id', '$2y$12$bePHnyMdYDqzYHKcLGF5menWC7wUE7QjPASVCHNMS8KRrYdqtRQ.6', '2026-10-05 02:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `nomor_peminjaman` varchar(255) NOT NULL,
  `peruntukan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_penggunaan` date NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `qr_code` varchar(2048) DEFAULT NULL,
  `peminjam` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_pengembalian` varchar(255) NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `peminjam` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penggunas`
--

CREATE TABLE `penggunas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penggunas`
--

INSERT INTO `penggunas` (`id`, `uuid`, `nama`, `nip`, `created_at`, `updated_at`) VALUES
(1, 'a146f18e-bcf0-4715-b3f8-d4d33faa067c', 'Abdi', '2309376', '2026-03-11 12:25:24', '2026-04-14 15:05:26'),
(2, 'a146f1ab-7fac-4247-990d-cfaf235edb26', 'Digda', '2326527', '2026-03-11 12:25:43', '2026-04-14 15:05:34'),
(3, 'a2756939-31f0-4815-a23c-516c9c1639ce', 'jani', '09898879', '2026-08-09 05:00:02', '2026-08-09 05:00:02'),
(4, 'a2756964-5fb7-4ab8-b29c-0bf88d2d8cf4', 'jems', '09878978', '2026-08-09 05:00:30', '2026-08-09 05:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `perawatan`
--

CREATE TABLE `perawatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_perawatan` varchar(255) NOT NULL,
  `surat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perawatan_inventaris`
--

CREATE TABLE `perawatan_inventaris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_perawatan` date DEFAULT NULL,
  `jenis_perawatan` enum('perbaikan','rencana_penghapusan','penghapusan') NOT NULL DEFAULT 'perbaikan',
  `deskripsi` text DEFAULT NULL,
  `status` enum('pending','proses','diperbaiki','tidak_dapat_diperbaiki','selesai') NOT NULL DEFAULT 'proses',
  `biaya` int(11) DEFAULT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL,
  `foto_kerusakan` varchar(255) DEFAULT NULL,
  `surat_penghapusan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perawatan_inventaris`
--

INSERT INTO `perawatan_inventaris` (`id`, `uuid`, `barang_id`, `user_id`, `tanggal_perawatan`, `jenis_perawatan`, `deskripsi`, `status`, `biaya`, `foto_bukti`, `foto_kerusakan`, `surat_penghapusan`, `created_at`, `updated_at`) VALUES
(5, 'e3873389-dbb6-4fd6-93e2-374ceaa296d6', 6, 2, '2026-03-11', 'perbaikan', 'Keluhan: Terkadang mati sendiri\nTindakan Perbaikan: sudah rusak total', 'tidak_dapat_diperbaiki', 0, 'perawatan/bukti/BqLPz0DwHnQLS4ujdkX27nInrie34lTHP2pv1c3W.jpg', 'laporan_kerusakan/qkxVjvcp9w1ork81JOK1dsKSYxdcAgQKeV1AGJBm.jpg', NULL, '2026-03-11 12:56:50', '2026-03-11 12:56:50'),
(9, '2fc237cb-5833-4249-ae28-ce2f10e7e858', 6, NULL, '2026-03-11', 'penghapusan', NULL, 'pending', NULL, NULL, NULL, 'surat_penghapusan/qTyleWqpbvIe3SH9bhBU6ThACa597W31C9yhXtWR.jpg', '2026-03-11 13:03:56', '2026-03-11 13:03:56'),
(14, '9ce3bc3a-b186-479b-bc03-54d946c0881c', 13, 7, '2026-08-09', 'perbaikan', 'Keluhan: kd dingin lagi na\nTindakan Perbaikan: ni sdh belah kd kawa lagi di tambal', 'tidak_dapat_diperbaiki', 221, 'perawatan/bukti/Buo1Fuo9A1WPv9uEQYFSKbdcbjmI7uXiFAVyY5hT.webp', NULL, NULL, '2026-08-09 06:41:16', '2026-08-09 06:41:16'),
(17, '761f4403-36c8-4464-8174-51f34e850744', 13, NULL, '2026-08-09', 'penghapusan', NULL, 'pending', NULL, NULL, NULL, 'surat_penghapusan/NbeS97T0RSjfqYidtJUvVPTE9djeAKewUf0bGi7Q.jpg', '2026-08-09 12:53:14', '2026-08-09 12:53:14'),
(19, 'fd9ad70f-3da0-4ad3-819e-8b5c205489f9', 13, NULL, '2026-08-09', 'penghapusan', NULL, 'pending', NULL, NULL, NULL, 'surat_penghapusan/4bth3vtlJn17oDC5e1OlX5nFsJDb1pSPgwH9YVhF.jpg', '2026-08-09 13:00:59', '2026-08-09 13:00:59'),
(21, 'b5f26a64-eb47-4d24-9d8c-79665607427d', 22, 14, '2026-08-10', 'perbaikan', 'Keluhan: Kd mau beputar\nTindakan Perbaikan: apa nang diputar', 'tidak_dapat_diperbaiki', 0, 'perawatan/bukti/9DF0q7VOrqRtK6t7OffClO6bOCusfnh9juxSBi2O.jpg', 'laporan/kerusakan/rbVQrslnWMJpMl10mHkBZp575nebCJ8cgotTk5DP.jpg', NULL, '2026-08-09 23:55:36', '2026-08-09 23:55:36'),
(29, '2500db4e-22d0-4eff-a47e-bfb47084bd1b', 13, NULL, '2026-08-20', 'penghapusan', NULL, 'pending', NULL, NULL, NULL, 'surat_penghapusan/mjzQAijcricFfgazS2rqKL5bN0w52wq2fVCEezD8.png', '2026-08-20 02:02:37', '2026-08-20 02:02:37'),
(30, '576c5b02-e621-44ae-9b6c-0c5dc55587c4', 13, NULL, '2026-08-20', 'rencana_penghapusan', NULL, 'pending', NULL, NULL, NULL, NULL, '2026-08-20 02:03:11', '2026-08-20 02:03:11'),
(33, 'a712d0d3-aae7-41e0-8e9d-b1bc7873890e', 4, NULL, '2026-09-03', 'penghapusan', NULL, 'pending', NULL, NULL, NULL, 'surat_penghapusan/3SpUJsDb1Wo4SthDhkBissWv3bn5Zu0GnsCRcuM6.jpg', '2026-09-03 05:48:44', '2026-09-03 05:48:44'),
(34, '5d1dc1e5-bd14-4bfa-96c9-a790790f8650', 6, NULL, '2026-09-03', 'penghapusan', NULL, 'pending', NULL, NULL, NULL, 'surat_penghapusan/vGZmyqckK82UE5FKQCtfugWouJljwqhGAQttYKLf.jpg', '2026-09-03 05:49:19', '2026-09-03 05:49:19'),
(35, 'f78f4434-f7f7-4dde-9063-c3ea01a33cd7', 22, NULL, '2026-09-03', 'penghapusan', NULL, 'pending', NULL, NULL, NULL, 'surat_penghapusan/RQnm334Xv0i7djKQtge4k91pT3HBqc0mkzPmaxik.jpg', '2026-09-03 05:50:16', '2026-09-03 05:50:16'),
(38, '3898ea91-f138-43f3-ad97-1adf66a75869', 29, 24, '2026-09-11', 'perbaikan', 'Keluhan: tes\nTindakan Perbaikan: Tes', 'selesai', 100000, 'perawatan/bukti/H385aO6uOSCZjfquUmRPlxbauOMqyv8OM8AGNGAl.jpg', 'laporan_kerusakan/62sEXgCsmhTigXQZr2LyvyN0bug7nxeYXDiT7So1.png', NULL, '2026-09-11 01:16:40', '2026-09-11 01:17:25'),
(39, '9c28f82b-7b7f-4487-bfe8-016317a7688c', 22, NULL, '2026-09-11', 'penghapusan', NULL, 'pending', NULL, NULL, NULL, 'surat_penghapusan/7DO05jaeg5UnxD9MqbRtufRNh5nuvIT2Bvhv46Ej.pdf', '2026-09-11 01:23:07', '2026-09-11 01:23:07'),
(41, 'e6ca0687-4098-4706-ac66-17369b3bd0f5', 168, NULL, '2026-09-11', 'perbaikan', NULL, 'pending', NULL, NULL, NULL, NULL, '2026-09-11 01:49:24', '2026-09-11 01:49:24'),
(42, '6e9e2027-ebf3-4a65-91db-6fa1634b65bb', 167, 24, '2026-09-11', 'perbaikan', 'Keluhan: Lelet\nTindakan Perbaikan: Merakit ulang PC', 'selesai', 10000000, 'perawatan/bukti/QR1m2fXbpEH9zDQxPNXW9lWMBDdTLgcQdOYM8Xln.jpg', 'laporan_kerusakan/MP0Ws6TdVHwc37efyYNA6Dhj3vT0xBFl0YaZE75S.jpg', NULL, '2026-09-11 02:54:08', '2026-09-11 03:02:11'),
(43, '960dc08c-cfdc-4acb-a7fa-d22a8ec8e27a', 167, 24, '2026-09-17', 'perbaikan', 'Keluhan: Pc rusak mati total\nTindakan Perbaikan: Mengganti VGA RTX 9090', 'selesai', 100000000, 'perawatan/bukti/OLnh9rhKui7vt2ZZNZLET30B7prtVwTcyrLAt9tG.jpg', 'laporan/kerusakan/wfgjNyNdOdpv0nLhE1Fg4TpJ41YQbhbUAE5pKZR3.jpg', NULL, '2026-09-17 03:01:48', '2026-09-17 03:02:13'),
(45, 'c1ba65ed-a56c-4f7a-bda9-f4d79536f053', 167, 24, '2026-09-17', 'perbaikan', 'Keluhan: Rusak\nTindakan Perbaikan: Dh bener', 'selesai', 0, 'perawatan/bukti/vOiSjcswfK1x78NXX1aNId36HA7bK2g3bEx5oiuT.jpg', NULL, NULL, '2026-09-17 03:11:16', '2026-09-17 03:11:26'),
(47, '2b9b5316-00ca-4fa2-8adc-9f6b31272431', 167, 24, '2026-09-17', 'perbaikan', 'Keluhan: Rusak\nTindakan Perbaikan: Rusak', 'tidak_dapat_diperbaiki', 0, 'perawatan/bukti/m1QeLXvb5NNYFnj2lHs1ONi2kJvQSSrS66HYGnZV.jpg', NULL, NULL, '2026-09-17 03:12:16', '2026-09-17 03:12:16'),
(49, '0294df26-0e52-453f-915a-bbfb664106fd', 29, 24, '2026-10-05', 'perbaikan', 'Keluhan: jsahfhsdfaldf\nTindakan Perbaikan: dhfjahdf', 'diperbaiki', 91697312, 'perawatan/bukti/ccvEcIgCTuUMcKuQBatC05ttGZKI7GPqBT5Hmyhs.jpg', NULL, NULL, '2026-10-04 23:50:22', '2026-10-04 23:50:22'),
(50, '4d4f06c6-8a51-4f9a-9c09-ac6a5e819d07', 41, NULL, '2026-10-06', 'perbaikan', NULL, 'pending', NULL, NULL, NULL, NULL, '2026-10-05 23:57:48', '2026-10-05 23:57:48'),
(51, 'e4f07b22-9d0f-455b-a6a4-e2623cb15fbc', 89, NULL, '2026-10-08', 'perbaikan', NULL, 'pending', NULL, NULL, NULL, NULL, '2026-10-08 02:14:51', '2026-10-08 02:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `peruntukan`
--

CREATE TABLE `peruntukan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `peruntukan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peruntukan`
--

INSERT INTO `peruntukan` (`id`, `uuid`, `peruntukan`, `created_at`, `updated_at`) VALUES
(1, '8529e595-5ed5-497b-b4b0-095a36f82735', 'Inspirasi Indonesia', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(2, '41fa5e97-129a-4ab2-883c-4c0b4308460b', 'Pesona Indonesia', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(3, '3a9f7abd-798f-486d-ba07-97cb96aef489', 'Anak Indonesia', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(4, '83e6426d-b1b5-4536-b539-f07df444ac70', 'Jejak Islam', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(5, '14648654-6d29-4aac-81cb-5a10b565a948', 'Potensi Banua', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(6, '951948db-a83a-476d-9782-32a0ab398542', 'Lensa Olahraga', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(7, '0a9cb921-1649-46da-aba2-e756418197be', 'Live Cross', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(8, '0677a3ee-725c-4c6f-a8ba-89b78c1bfbcf', 'Dangdut Keliling', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(9, '99bd95d3-79fd-4c02-b6f0-c9e172e9600b', 'Reformasi Birokrasi', '2026-03-11 12:21:14', '2026-03-11 12:21:14'),
(10, 'cabb6f90-200e-4dbf-83f0-86e430afd225', 'Hari yang Berkah', '2026-03-11 12:21:14', '2026-03-11 12:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1Px2SZV8yAo4xEyvI4forHmcrUyqJuv7jThdQiWH', 1, '36.75.61.187', 'Mozilla/5.0 (iPad; CPU OS 27_0_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/154.0.8037.55 Mobile/15E148 Safari/604.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXc0T1RZa05vM2F6cGFmYTRJd2tlNVVTaFVaYnBxVUk3S3RtQWNzcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9lc2ltYmEubGFuanVuZy10dnJpa2Fsc2VsLmlkL3Bhc3N3b3JkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1791447365),
('7uSe0z73H3RtuTUjmvriFZRy3ewei8vg07JML7Ql', 1, '103.13.164.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia0FoaUZseExzWll3QWRvNkVPcUNMVkVKMzl2b245UmxveE41S1FteSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9lc2ltYmEubGFuanVuZy10dnJpa2Fsc2VsLmlkL2FkbWluL2Jtbi9wZW5nZ3VuYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNjoicGFzc3dvcmRWZXJpZmllZCI7YjoxO30=', 1791439658),
('DHI7gCLupPBDPttbYGfr12fdlEQEyE5O8BUkNsOy', NULL, '36.75.61.187', 'Mozilla/5.0 (iPad; CPU OS 27_0_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/154.0.8037.55 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjc5aUhqNzNodHRLTmM5U2dvRVViWjU2eVBqZUtYMFFLRlpTaFRXZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9lc2ltYmEubGFuanVuZy10dnJpa2Fsc2VsLmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1791447251),
('pxyfihfzaiBKfINpWDchMmQT5IQ6D4Apylh05n4u', 19, '103.13.164.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:157.0) Gecko/20100101 Firefox/157.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNkl5WmgzZ3E1cUMyWTI5YWZoR0ZqUng2NHQ4TjVvMlVyWFA3WE9JayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly9lc2ltYmEubGFuanVuZy10dnJpa2Fsc2VsLmlkL2JhcmFuZy9wcmludC1xcmNvZGU/a2F0ZWdvcmk9Ym1uJnJ1YW5nYW49S2FzdWJhZyUyMFRhdGElMjBVc2FoYSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O3M6MTY6InBhc3N3b3JkVmVyaWZpZWQiO2I6MTt9', 1791443428),
('Rgjmv9U4HvCub6HalcOARmfGsVMHId4RA4PRFaPh', NULL, '103.13.164.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2pUSHRIRFlVYjVhSWxVMGV0MWl6andscHhKQmVXTG9VZFJsY0Y3YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9lc2ltYmEubGFuanVuZy10dnJpa2Fsc2VsLmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1791436282);

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `image_path`, `created_at`, `updated_at`) VALUES
(2, 'slider/kNex45F398z070XGANUAgAeCQMTCJ6TEaXFkVy9t.jpg', '2026-04-14 13:06:43', '2026-04-14 13:06:43'),
(3, 'slider/g56EcgLEuz3H1PQRbXJdpbH4o4yZqIXAtq6Hwy4i.jpg', '2026-08-09 11:30:39', '2026-08-09 11:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_uuid` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerjas`
--

CREATE TABLE `unit_kerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama_unit_kerja` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_kerjas`
--

INSERT INTO `unit_kerjas` (`id`, `uuid`, `nama_unit_kerja`, `created_at`, `updated_at`) VALUES
(1, 'a146f1bc-e4fb-49eb-b293-3570a9d47e4b', 'Umum', '2026-03-11 12:25:54', '2026-03-11 12:25:54'),
(2, 'a146f1c6-499c-431a-b846-b1e7859d50fa', 'Teknik', '2026-03-11 12:26:00', '2026-08-10 00:36:23'),
(3, 'a29bb8dc-42a1-42cc-90a2-2dff1b1e6f22', 'Berita', '2026-08-28 06:04:10', '2026-08-28 06:04:10'),
(4, 'a2a7baf3-23c5-4040-8976-488998ba80ee', 'KMB', '2026-09-03 05:19:57', '2026-09-03 05:19:57'),
(5, 'a2a94395-9b80-407b-b7ec-44b53dd1d51a', 'Keuangan', '2026-09-03 23:37:50', '2026-09-03 23:37:50'),
(6, 'a2a9dbc7-25ee-4186-8885-39515567b538', 'PU', '2026-09-04 06:43:24', '2026-09-04 06:43:24'),
(7, 'a2cfc167-ff78-4ba1-82e0-95f7a307c740', 'Program', '2026-09-23 02:51:07', '2026-09-23 02:51:07'),
(9, 'a2d1fb1b-1679-4205-882f-70fb8f26421a', 'TU', '2026-09-24 05:24:07', '2026-09-24 05:24:07'),
(10, 'a2e7a8b8-a671-4d6c-b2ad-2951fdf427bb', 'AAAA', '2026-10-05 00:01:58', '2026-10-05 00:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `kode_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nomor_hp` varchar(13) NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `foto` varchar(2048) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `nama_lengkap`, `kode_user`, `email`, `nip`, `nomor_hp`, `jabatan_id`, `qr_code`, `role`, `email_verified_at`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '316357d5-634e-4803-ae0a-858ec33c728b', 'Superadminn', 'USR061224', 'superadmin@gmail.com', '1992345657435123', '0892348987656', 3, '1773260474_qr.png', 'superadmin', NULL, '$2y$12$HtEbKSJURlT5cHpWNMz8u.YRp1M3J92lFjni4obQ6.5bBGzmgiYSm', '1788936948.png', NULL, '2026-03-11 12:21:14', '2026-09-09 06:55:48'),
(2, 'fbaa3392-5135-43b2-8877-8639a1827534', 'LucasL', 'USR106129', 'lucas@gmail.com', '2333333', '0823655212', 3, '1773260526_qr.png', 'user', NULL, NULL, NULL, NULL, '2026-03-11 12:22:06', '2026-09-15 01:17:38'),
(3, '3ccc00fb-8d79-4d09-a0f5-7a2c629ab142', 'Bagas', 'USR176755', 'bagas@gmail.com', '2356890', '0825367281', 3, '1773260555_qr.png', 'user', NULL, NULL, '1774954974.jpg', NULL, '2026-03-11 12:22:35', '2026-03-31 11:02:54'),
(5, '63f780c5-37c0-4abc-ac98-35346934069c', 'Mahmudah', 'USR231372', 'mahmud@gmail.com', '2309123411', '088832761', 3, '1774950534_qr.png', 'admin', NULL, '$2y$12$I8TEhfyuHjLGgXpGmH8/VeujjYIr3qvBV0kkPU65b8fU6vwySftdq', NULL, NULL, '2026-03-31 09:48:55', '2026-03-31 09:48:55'),
(6, 'd0dff727-8b49-4452-8d66-38a65a00c016', 'josep', 'USR754678', 'josep@example.com', '912781729012', '088223415210', 3, '1776205100_qr.png', 'admin', NULL, '$2y$12$hYEM/i196YWQxvKn..HA2e6fW4L4FK2lUFIwPGE.m9ohw0vyavHm6', NULL, NULL, '2026-04-14 22:18:20', '2026-04-14 22:18:20'),
(7, 'd328fc60-24e7-4f30-bcd2-46c6dff2ae55', 'Muhammad Firdaus', 'USR666038', 'penyu@gmail.com', '030324034567', '089512538686', 4, '1785807046_qr.png', 'admin', NULL, NULL, '1786254829.jpg', NULL, '2026-08-04 01:30:46', '2026-08-09 23:49:10'),
(8, '62c9e465-893d-4fba-b786-ae9a989fb7ce', 'Akhmad Saputra', 'USR18387', 'akhmadsaputra449@gmail.com', '030324006', '88744973553', 4, '1785807072_qr.png', 'admin', NULL, '$2y$12$WBx.ym22KBvquGs0HNmLz.g9WV4COlOpaSCy488FFLnpyfYsxEC96', NULL, NULL, '2026-08-04 01:31:12', '2026-09-15 01:04:52'),
(10, '1f231ea5-5791-441f-85eb-6943cd099bb3', 'Nazwa Mariamah', 'USR893228', 'nazwamariamah2@gmail.com', '28092004', '085251616056', 1, '1785807276_qr.png', 'tim_perbaikan', NULL, NULL, NULL, NULL, '2026-08-04 01:34:36', '2026-09-15 01:23:13'),
(12, 'd4f8505f-d31d-4ebb-80b9-b0e14e46864f', 'toha', 'USR325533', 'toha@nila.com', '0987643728282', '089512537878', 3, '1786252323_qr.png', 'user', NULL, NULL, NULL, NULL, '2026-08-09 05:12:03', '2026-08-09 05:12:03'),
(14, '14421272-e92b-4823-9432-954079446104', 'Siti Nurkholishah', 'USR678618', 'situnurkholishah7@gmail.com', '0008563747373', '083298726523', 3, '1786287794_qr.png', 'admin', NULL, NULL, NULL, NULL, '2026-08-09 15:03:14', '2026-08-10 00:21:36'),
(15, 'e5d5a811-f109-44f8-8107-00ff0d32b19f', 'Adi', 'USR43232', '111222@gmail.com', '111222', '8111222', 2, '1786320365_qr.png', 'user', NULL, NULL, NULL, NULL, '2026-08-10 00:06:05', '2026-09-16 02:25:06'),
(17, '030b6163-03c1-4bd0-af47-98a9d6d65add', 'Alek', 'USR931799', 'alek@gmail.com', '030324123', '85348137563', 3, '1786325929_qr.png', 'user', NULL, NULL, NULL, NULL, '2026-08-10 01:38:49', '2026-08-10 01:38:49'),
(18, 'a9661553-5cda-4503-8381-61722560b459', 'Rafisha Ahmad', 'USR261877', 'rafisha@gmail.com', '030324052', '081257809942', 3, '1787188023_qr.png', 'user', NULL, '$2y$12$myJeCluMwb/712EcaYCQROUs.Dxds3oFZbSbkKZZSxcxu3dAs3h7O', 'default.jpeg', NULL, '2026-08-20 01:07:04', '2026-10-02 03:20:49'),
(19, '7fc3cf1c-a445-4ed9-8275-085520f8753a', 'Abdul Khalik Adi Darmawan', 'USR264319', 'abdulkhalikadi.d@gmail.com', '030324056', '895608176699', 3, '1787188035_qr.png', 'admin', NULL, '$2y$12$I9QrPJZknNYTnuK3QPFdve0sjoUud16YEWrkJXv9PZ/rwyzMkFJYK', NULL, NULL, '2026-08-20 01:07:15', '2026-08-20 01:07:15'),
(23, '5bc984ec-cda6-424a-b53d-7be623c55526', 'Ica', 'USR129342', 'user@admin', '123', '123', 3, '1788503061_qr.png', 'admin', NULL, '$2y$12$XCtnGLXIaFPrNMw.Yl7Y2ekq4/yNdF38Vq1svGCnIj5diHqJz716e', NULL, NULL, '2026-09-04 06:24:22', '2026-09-04 06:24:22'),
(24, 'a683bd44-05ef-4342-a8ce-8261288b0798', 'Aiditt', 'USR689263', 'asdaa2@gmail.com', '11227', '11227', 4, '1789089296_qr.png', 'tim_perbaikan', NULL, NULL, '1789526755.jpg', NULL, '2026-09-11 01:14:56', '2026-09-16 02:45:55'),
(28, '8b29729e-2ec2-4125-bb33-5216fabf8c47', 'ABTestadminjabatan', 'USR472441', 'r@gmail', '122222', '12222', 3, '1789434324_qr.png', 'admin', NULL, '$2y$12$xKloPI9riOHSX4gqeU2nSua430/yHYl5iNiinroQlu5hjTsWQPsi.', NULL, NULL, '2026-09-15 01:05:24', '2026-09-17 06:25:02'),
(30, '192415b7-6cc0-412f-bb2d-4468deb75735', 'tesuser', 'USR276882', 'asdsa@fadaas', '213246498', '12346498', 1, '1789525573_qr.png', 'user', NULL, NULL, '1789629470.jpg', NULL, '2026-09-16 02:26:13', '2026-10-06 01:15:42'),
(32, '1f15628c-cc62-4d66-a93b-accaebbfc6a4', 'Ramadhani', 'USR486061', 'ramapratama812@gmail.com', '0000000000', '085705877180', 4, '1791158214_qr.png', 'tim_perbaikan', NULL, NULL, NULL, NULL, '2026-10-04 23:56:54', '2026-10-04 23:56:54'),
(33, '096481d9-390d-4243-835e-a372aa0736ff', 'Lili', 'USR974478', 'yuli.anita@mhs.politala.ac.id', '12345', '081256705482', 3, '1791166659_qr.png', 'admin', NULL, '$2y$12$ehT22BdQ1H1fn8yAgSmcUuSKQNIaW2epYp/Bi.NmFAOWCnRI53ily', NULL, NULL, '2026-10-05 02:17:39', '2026-10-05 02:17:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barang_kode_barang_unique` (`kode_barang`),
  ADD KEY `barang_jenis_barang_id_foreign` (`jenis_barang_id`);

--
-- Indexes for table `bmn_barangs`
--
ALTER TABLE `bmn_barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bmn_barangs_nama_barang_nup_unique` (`nama_barang`,`nup`),
  ADD UNIQUE KEY `bmn_barangs_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `bmn_barangs_kode_barang_unique` (`kode_barang`),
  ADD KEY `bmn_barangs_pengguna_id_foreign` (`pengguna_id`);

--
-- Indexes for table `bmn_jenis_kerusakans`
--
ALTER TABLE `bmn_jenis_kerusakans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bmn_jenis_kerusakans_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `bmn_jenis_kerusakans_nama_jenis_kerusakan_unique` (`nama_jenis_kerusakan`);

--
-- Indexes for table `bmn_kategoris`
--
ALTER TABLE `bmn_kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bmn_kategoris_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `bmn_kategoris_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `bmn_ruangans`
--
ALTER TABLE `bmn_ruangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bmn_ruangans_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `bmn_ruangans_nama_ruangan_unique` (`nama_ruangan`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_peminjaman_kode_peminjaman_foreign` (`kode_peminjaman`),
  ADD KEY `detail_peminjaman_kode_barang_foreign` (`kode_barang`);

--
-- Indexes for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pengembalian_kode_pengembalian_foreign` (`kode_pengembalian`),
  ADD KEY `detail_pengembalian_kode_barang_foreign` (`kode_barang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guidebook`
--
ALTER TABLE `guidebook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_kerusakan_barang_id_foreign` (`barang_id`),
  ADD KEY `laporan_kerusakan_teknisi_id_foreign` (`teknisi_id`),
  ADD KEY `laporan_kerusakan_user_id_foreign` (`user_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjaman_kode_peminjaman_unique` (`kode_peminjaman`),
  ADD KEY `peminjaman_peruntukan_id_foreign` (`peruntukan_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengembalian_kode_pengembalian_unique` (`kode_pengembalian`),
  ADD KEY `pengembalian_kode_peminjaman_foreign` (`kode_peminjaman`);

--
-- Indexes for table `penggunas`
--
ALTER TABLE `penggunas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penggunas_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `penggunas_nip_unique` (`nip`);

--
-- Indexes for table `perawatan`
--
ALTER TABLE `perawatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perawatan_kode_perawatan_unique` (`kode_perawatan`);

--
-- Indexes for table `perawatan_inventaris`
--
ALTER TABLE `perawatan_inventaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perawatan_inventaris_uuid_unique` (`uuid`),
  ADD KEY `perawatan_inventaris_barang_id_foreign` (`barang_id`),
  ADD KEY `perawatan_inventaris_user_id_foreign` (`user_id`);

--
-- Indexes for table `peruntukan`
--
ALTER TABLE `peruntukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_kerjas`
--
ALTER TABLE `unit_kerjas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unit_kerjas_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `unit_kerjas_nama_unit_kerja_unique` (`nama_unit_kerja`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_kode_user_unique` (`kode_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`),
  ADD KEY `users_jabatan_id_foreign` (`jabatan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bmn_barangs`
--
ALTER TABLE `bmn_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT for table `bmn_jenis_kerusakans`
--
ALTER TABLE `bmn_jenis_kerusakans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bmn_kategoris`
--
ALTER TABLE `bmn_kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `bmn_ruangans`
--
ALTER TABLE `bmn_ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guidebook`
--
ALTER TABLE `guidebook`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=590;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penggunas`
--
ALTER TABLE `penggunas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perawatan`
--
ALTER TABLE `perawatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perawatan_inventaris`
--
ALTER TABLE `perawatan_inventaris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `peruntukan`
--
ALTER TABLE `peruntukan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_kerjas`
--
ALTER TABLE `unit_kerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_jenis_barang_id_foreign` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bmn_barangs`
--
ALTER TABLE `bmn_barangs`
  ADD CONSTRAINT `bmn_barangs_pengguna_id_foreign` FOREIGN KEY (`pengguna_id`) REFERENCES `penggunas` (`uuid`) ON DELETE SET NULL;

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_peminjaman_kode_peminjaman_foreign` FOREIGN KEY (`kode_peminjaman`) REFERENCES `peminjaman` (`kode_peminjaman`) ON DELETE CASCADE;

--
-- Constraints for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  ADD CONSTRAINT `detail_pengembalian_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pengembalian_kode_pengembalian_foreign` FOREIGN KEY (`kode_pengembalian`) REFERENCES `pengembalian` (`kode_pengembalian`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  ADD CONSTRAINT `laporan_kerusakan_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `bmn_barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_kerusakan_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laporan_kerusakan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_peruntukan_id_foreign` FOREIGN KEY (`peruntukan_id`) REFERENCES `peruntukan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_kode_peminjaman_foreign` FOREIGN KEY (`kode_peminjaman`) REFERENCES `peminjaman` (`kode_peminjaman`) ON DELETE CASCADE;

--
-- Constraints for table `perawatan_inventaris`
--
ALTER TABLE `perawatan_inventaris`
  ADD CONSTRAINT `perawatan_inventaris_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `bmn_barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perawatan_inventaris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
