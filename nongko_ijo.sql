-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2026 at 05:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nongko_ijo`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `jenis_masalah` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `waktu_kejadian` datetime NOT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `jenis_masalah`, `keterangan`, `waktu_kejadian`, `latitude`, `longitude`, `foto`, `created_at`) VALUES
(1, 'Pohon Tumbang/Rusak', 'kebkaran hutan\r\n', '0000-00-00 00:00:00', '-7.708126227997437', '111.63873975068823', NULL, '2026-09-13 07:16:04'),
(2, 'Potensi Kebakaran', 'ada putung rokok', '0000-00-00 00:00:00', '-7.706781433646314', '111.66495516546765', NULL, '2026-09-13 09:13:55'),
(3, 'Potensi Kebakaran', 'putung rokok', '0000-00-00 00:00:00', '-7.685691892689694', '111.61726387702481', NULL, '2026-09-13 09:16:46'),
(4, 'Pohon Tumbang/Rusak', 'ada yg memotong tanpa izin berwenang ', '0000-00-00 00:00:00', '-7.726830407728421', '111.69949257703931', NULL, '2026-09-13 09:18:25'),
(5, 'Pencemaran / Sampah', 'sungai menumpuk sampah', '0000-00-00 00:00:00', '-7.701288', '111.618740', '1789294921_Screenshot_2026_09_13_172140.png', '2026-09-13 10:22:01'),
(6, 'Pencemaran / Sampah', 'terjadinya penumpukan sampah', '0000-00-00 00:00:00', '-7.700129', '111.550119', '1789295416_Screenshot_2026_09_13_172140.png', '2026-09-13 10:30:16'),
(7, 'Penebangan Liar (Illegal Logging)', 'tidak ada perizinan', '0000-00-00 00:00:00', '-7.641296', '111.515851', '1789295610_Screenshot_2026_09_13_104536.png', '2026-09-13 10:33:30'),
(8, 'Penebangan Liar (Illegal Logging)', 'tes', '0000-00-00 00:00:00', '-7.672259', '111.633401', '1789295644_Screenshot_2025_08_14_115013.png', '2026-09-13 10:34:04'),
(9, 'Pencemaran / Sampah', 'tes', '0000-00-00 00:00:00', '-7.722443', '111.693998', '1789299474_Screenshot_2026_09_13_172140.png', '2026-09-13 11:37:54'),
(10, 'Penebangan Liar (Illegal Logging)', 'terjadi penebangan illegal di daerah saradan', '0000-00-00 00:00:00', '-7.544817', '111.745442', '1789299742_Screenshot_2025_02_07_213126.png', '2026-09-13 11:42:22'),
(11, 'Kebakaran Hutan', 'test', '2026-09-13 19:08:00', '-7.700499', '111.659486', '1789301296_Screenshot_2025_02_09_180845.png', '2026-09-13 12:08:16'),
(12, 'Penebangan Liar (Illegal Logging)', 'cobaaja', '2026-09-13 19:28:00', '-7.686647', '111.615266', '1789302609_Screenshot_2025_05_18_115811.png', '2026-09-13 12:30:09'),
(13, 'Kebakaran Hutan', 'ada api kecil', '2026-09-30 13:40:00', '-7.820704', '111.757066', '1790750436_IMG_1514.JPG', '2026-09-30 06:40:36'),
(14, 'Kebakaran Hutan', 'ada api kecil', '2026-09-30 13:40:00', '-7.820704', '111.757066', '1790750459_IMG_1514.JPG', '2026-09-30 06:40:59'),
(15, 'Kebakaran Hutan', 'ada api kecil', '2026-09-30 13:40:00', '-7.820704', '111.757066', '1790750484_IMG_1514.JPG', '2026-09-30 06:41:24'),
(16, 'Kebakaran Hutan', 'cek', '2026-10-07 11:30:00', '-7.712591', '111.639910', '1791347989_WhatsApp_Image_2026_10_06_at_16.44.29.jpeg', '2026-10-07 04:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `rekap_laporan`
--

CREATE TABLE `rekap_laporan` (
  `jenis_masalah` varchar(100) NOT NULL,
  `total_laporan` int(11) DEFAULT 0,
  `kejadian_terakhir` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekap_laporan`
--

INSERT INTO `rekap_laporan` (`jenis_masalah`, `total_laporan`, `kejadian_terakhir`) VALUES
('Kebakaran Hutan', 5, '2026-10-07 11:30:00'),
('Pencemaran / Sampah', 3, '0000-00-00 00:00:00'),
('Penebangan Liar (Illegal Logging)', 4, '2026-09-13 19:28:00'),
('Pohon Tumbang/Rusak', 2, '0000-00-00 00:00:00'),
('Potensi Kebakaran', 2, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekap_laporan`
--
ALTER TABLE `rekap_laporan`
  ADD PRIMARY KEY (`jenis_masalah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
