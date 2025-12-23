-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2025 at 11:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_lacak_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `armada`
--

CREATE TABLE `armada` (
  `ID` int NOT NULL,
  `plat_nomor` varchar(9) DEFAULT NULL,
  `sopir_ID` char(16) DEFAULT NULL,
  `jenis_ID` int DEFAULT NULL,
  `keterangan` text,
  `latitude` text,
  `longitude` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `armada`
--

INSERT INTO `armada` (`ID`, `plat_nomor`, `sopir_ID`, `jenis_ID`, `keterangan`, `latitude`, `longitude`) VALUES
(1, 'B1040ERN', '3456789012345678', 2, 'Avanza', '-6.409286', '106.955578'),
(8, 'B1243KRU', '2345678901234567', 2, 'Avanza', NULL, NULL),
(12, 'RI1', '', 2, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_pin`
--

CREATE TABLE `auth_pin` (
  `id` int NOT NULL,
  `pin` int NOT NULL,
  `created_at` date NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `auth_pin`
--

INSERT INTO `auth_pin` (`id`, `pin`, `created_at`, `is_used`) VALUES
(1, 117683, '2025-09-03', 1),
(2, 902410, '2025-09-03', 1),
(3, 103742, '2025-09-04', 1),
(4, 323483, '2025-10-29', 1),
(5, 58445, '2025-11-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` char(16) NOT NULL,
  `NamaLengkap` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text,
  `no_telp` varchar(15) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activation_key` text,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `NamaLengkap`, `email`, `password`, `no_telp`, `active`, `activation_key`, `created_at`) VALUES
('1111', 'Xoro', 'gerrant.825220147@stu.untar.ac.id', '$2y$10$9lOLqiBsbooXfLwjA16zDezOQc90dBrvXStYCMxGQXDYQ5AQ2LA5.', '62811111111', 1, 'BECF8D1117773B3', NULL),
('112233', 'GHiya', 'gerranthiya@projectdeck.online', '$2y$10$o.IqE.6BL.cWSInogv4unOe2sW8XWfDnY4KgmK6oxdB5uFLMZFb6e', '621122', 1, NULL, '2025-07-01'),
('1231', 'Likoisme', 'backup.gerrant@gmail.com', '$2y$10$gPlRgm2xa8apKCxLQ4xykeK4PbG9WiY.UX6GQ8BrszwhFnfYJDOXm', '6213331312', 0, 'E35BEB8A9FFC8BE', NULL),
('3275', 'Gerrant Hiya', 'jipbagus@gmail.com', '$2y$10$HMDXUbvKRsUxMk23lCABJuIz6/KxMGfWGqBlIUl.LgqIn6zOxaBIq', '85213321603', 1, NULL, '2025-07-01'),
('3277', 'Gerrant', 'beastheat6@gmail.com', '$2y$10$x7VRukMOrBF/FdPRlLBsEe.WLGtE99Ql6C4OFQr15EQ5JJvZs7GSW', '6281288888888', 1, '214B0AE63F9CEAB', '2025-07-01'),
('3673', 'Richardiustus', NULL, NULL, '81208092138', 1, NULL, '2025-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `golongan_bobot`
--

CREATE TABLE `golongan_bobot` (
  `ID` int NOT NULL,
  `range_low` double(10,2) DEFAULT NULL,
  `range_high` double(10,2) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `is_deactive` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `golongan_bobot`
--

INSERT INTO `golongan_bobot` (`ID`, `range_low`, `range_high`, `harga`, `created_at`, `created_by`, `is_deactive`) VALUES
(1, 0.00, 5.00, '555.00', '2025-09-10 06:41:26', 'gerrante.hiya@gmail.com', 0),
(2, 6.00, 10.00, '800.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0),
(3, 11.00, 20.00, '1000.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0),
(4, 21.00, 30.00, '950.00', '2025-05-08 00:00:00', 'gerrante.hiya@gmail.com', 0),
(5, 31.00, 40.00, '900.00', '2025-05-08 00:00:00', 'gerrante.hiya@gmail.com', 0),
(8, 41.00, 100.00, '750.00', '2025-09-09 00:00:00', 'gerrante.hiya@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `golongan_jarak`
--

CREATE TABLE `golongan_jarak` (
  `ID` int NOT NULL,
  `range_low` double(10,2) DEFAULT NULL,
  `range_high` double(10,2) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `is_deactive` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `golongan_jarak`
--

INSERT INTO `golongan_jarak` (`ID`, `range_low`, `range_high`, `harga`, `created_at`, `created_by`, `is_deactive`) VALUES
(1, 0.00, 20.00, '1550.00', '2025-09-10 06:39:06', NULL, 0),
(2, 21.00, 50.00, '1400.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0),
(3, 51.00, 100.00, '1300.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0),
(4, 101.00, 150.00, '1250.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0),
(5, 151.00, 200.00, '1200.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0),
(6, 201.00, 250.00, '1180.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0),
(8, 301.00, 500.00, '1100.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0),
(9, 501.00, 9999.00, '1000.00', '2025-05-07 00:00:00', 'gerrante.hiya@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `golongan_volume`
--

CREATE TABLE `golongan_volume` (
  `ID` int NOT NULL,
  `range_low` int DEFAULT NULL,
  `range_high` int DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `is_deactive` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `golongan_volume`
--

INSERT INTO `golongan_volume` (`ID`, `range_low`, `range_high`, `harga`, `created_at`, `created_by`, `is_deactive`) VALUES
(1, 8000, 12000, '1000.00', '2025-05-08 00:00:00', 'gerrante.hiya@gmail.com', 0),
(2, 12001, 15000, '1150.00', '2025-05-08 00:00:00', 'gerrante.hiya@gmail.com', 0),
(3, 100000, 999999, '990.00', '2025-05-22 00:00:00', 'gerrante.hiya@gmail.com', 0),
(4, 1000000, 5000000, '950.00', '2025-05-22 00:00:00', 'gerrante.hiya@gmail.com', 0),
(5, 15001, 99999, '1000.00', '2025-05-22 00:00:00', 'gerrante.hiya@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_armada`
--

CREATE TABLE `jenis_armada` (
  `id_jenis_armada` int NOT NULL,
  `nama_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_armada`
--

INSERT INTO `jenis_armada` (`id_jenis_armada`, `nama_jenis`) VALUES
(1, 'Truk'),
(2, 'Mobil'),
(3, 'Motor');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_paket`
--

CREATE TABLE `kategori_paket` (
  `ID` int NOT NULL,
  `Nama` varchar(30) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `created_by` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_deactivate` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_paket`
--

INSERT INTO `kategori_paket` (`ID`, `Nama`, `harga`, `created_at`, `created_by`, `is_deactivate`) VALUES
(1, 'Elektronik', 0, '2025-05-08', 'gerrante.hiya@gmail.com', 0),
(2, 'Hewan Hidup', 0, '2025-05-08', 'gerrante.hiya@gmail.com', 0),
(3, 'Cairan', 0, '2025-05-08', 'gerrante.hiya@gmail.com', 0),
(4, 'Hewan Mati/Daging Mentah', 0, '2025-05-08', 'gerrante.hiya@gmail.com', 0),
(5, 'Aksesoris Pria/Wanita', 0, '2025-05-08', 'gerrante.hiya@gmail.com', 0),
(6, 'Alat olahraga kecil', 0, '2025-05-23', 'gerrante.hiya@gmail.com', 0),
(7, 'Kendaraan non-mesin', 20000, '2025-05-23', 'gerrante.hiya@gmail.com', 0),
(8, 'Pakaian', 0, '2025-05-23', 'gerrante.hiya@gmail.com', 0),
(9, 'Dokumen', 1000, '2025-06-03', 'gerrante.hiya@gmail.com', 0),
(10, 'Logam Mulia', 15000, '2025-06-03', 'gerrante.hiya@gmail.com', 0),
(11, 'Kendaraan Bermotor', 200000, '2025-10-29', 'gerrante.hiya@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kontrak_sopir`
--

CREATE TABLE `kontrak_sopir` (
  `ID` varchar(255) NOT NULL,
  `sopir_ID` char(16) NOT NULL,
  `file_kontrak` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kontrak_sopir`
--

INSERT INTO `kontrak_sopir` (`ID`, `sopir_ID`, `file_kontrak`, `tanggal_mulai`, `tanggal_akhir`, `is_valid`) VALUES
('002/345', '3456789012345678', '4a91fcf9f4218b40d68d5d55eaa5a4ae.jpg', '2025-10-29', '2026-11-30', 1),
('2025/KDX-S/001', '3456789012345678', '4a91fcf9f4218b40d68d5d55eaa5a4ae1.pdf', '2025-05-14', '2025-07-14', 1),
('2025/KDX-S/002', '2345678901234567', '3f0906fcbd39e6773fc19d724c3c3ed8.png', '2025-05-21', '2026-05-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loc_hist`
--

CREATE TABLE `loc_hist` (
  `ID` int NOT NULL,
  `armada_ID` int NOT NULL,
  `created_at` datetime NOT NULL,
  `longitude` text NOT NULL,
  `latitude` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loc_hist`
--

INSERT INTO `loc_hist` (`ID`, `armada_ID`, `created_at`, `longitude`, `latitude`) VALUES
(1, 1, '2025-11-07 22:34:36', '106.955578', '-6.409286'),
(2, 1, '2025-11-07 00:00:00', '106.9184241', '-6.3952944'),
(3, 1, '2025-11-08 12:25:37', '106.924131', '-6.381020'),
(4, 1, '2025-11-08 12:27:37', '106.925731', '-6.381871'),
(5, 1, '2025-11-08 12:29:37', '106.928952', '-6.382118'),
(6, 1, '2025-11-08 12:31:37', '106.932338', '-6.382533'),
(7, 1, '2025-11-08 12:33:37', '106.935275', '-6.384452'),
(8, 1, '2025-11-08 12:35:37', '106.939588', '-6.387021'),
(9, 1, '2025-11-08 12:37:37', '106.944046', '-6.388765'),
(10, 1, '2025-11-08 12:39:37', '106.946235', '-6.388679');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `ID` int NOT NULL,
  `metode` varchar(255) NOT NULL,
  `is_card` tinyint(1) NOT NULL DEFAULT '0',
  `bank` varchar(255) DEFAULT NULL,
  `deactivate` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`ID`, `metode`, `is_card`, `bank`, `deactivate`) VALUES
(1, 'QRIS', 0, NULL, 0),
(2, 'Debit', 1, 'BCA', 0),
(3, 'Credit Card', 1, 'BCA', 0),
(4, 'Debit', 1, 'Mandiri', 0),
(5, 'Credit Card', 1, 'Mandiri', 0),
(6, 'Cash', 0, '', 0),
(7, 'Credit Card', 1, 'Mega', 0);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_report`
--

CREATE TABLE `monthly_report` (
  `ID` int NOT NULL,
  `created_at` date NOT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `ttl_tarif_terbentuk` int NOT NULL,
  `ttl_tarif_dibayar` int NOT NULL,
  `ttl_tarif_blm_dibayar` int NOT NULL,
  `jml_paket_terkirim` int NOT NULL,
  `jml_paket_hilang` int NOT NULL,
  `ttl_customer` int NOT NULL,
  `ttl_invoice_bfr` int DEFAULT NULL,
  `ttl_paket_hilang_bfr` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `monthly_report`
--

INSERT INTO `monthly_report` (`ID`, `created_at`, `bulan`, `tahun`, `ttl_tarif_terbentuk`, `ttl_tarif_dibayar`, `ttl_tarif_blm_dibayar`, `jml_paket_terkirim`, `jml_paket_hilang`, `ttl_customer`, `ttl_invoice_bfr`, `ttl_paket_hilang_bfr`) VALUES
(1, '2025-09-18', 7, 2025, 19300, 0, 19300, 1, 0, 4, 275030, 1),
(2, '2025-09-18', 8, 2025, 0, 0, 0, 0, 0, 4, 19300, 0),
(3, '2025-09-18', 9, 2025, 0, 0, 0, 0, 0, 4, 0, 0),
(4, '2025-09-18', 5, 2025, 290899, 247599, 43300, 5, 2, 4, 0, 0),
(5, '2025-09-18', 6, 2025, 568430, 302830, 265600, 2, 4, 4, 247599, 2),
(6, '2025-09-18', 4, 2025, 0, 0, 0, 0, 0, 0, 0, 0),
(7, '2025-10-29', 10, 2025, 1451575512, 0, 1451575512, 0, 0, 4, 0, 0),
(8, '2025-10-29', 10, 2025, 2147483647, 2147483647, 2147483647, 1, 1, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `ID` int NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `rand_code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID` varchar(255) NOT NULL,
  `ID_pengiriman` varchar(255) NOT NULL,
  `jumlah_bayar` int NOT NULL,
  `sisa_tunggakan` int NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `metode_bayar` int NOT NULL,
  `nomor_kartu` int DEFAULT NULL,
  `atas_nama_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`ID`, `ID_pengiriman`, `jumlah_bayar`, `sisa_tunggakan`, `tanggal_bayar`, `metode_bayar`, `nomor_kartu`, `atas_nama_bayar`) VALUES
('BAYAR1', 'KRM12025', 37899, 0, '2025-05-28 10:04:02', 1, NULL, NULL),
('BAYAR10', 'KRM82025', 71430, 0, '2025-06-23 14:49:58', 2, 123, 'Gerrant'),
('BAYAR11', 'KRM92025', 20000, 27800, '2025-06-23 15:22:27', 6, NULL, 'Richardiustus'),
('BAYAR12', 'KRM92025', 27800, 0, '2025-06-23 15:24:33', 6, NULL, 'Gerrant'),
('BAYAR13', 'KRM92025', 27800, 0, '2025-06-23 15:24:34', 6, NULL, 'Gerrant'),
('BAYAR14', 'KRM102025', 19300, 0, '2025-10-29 04:32:04', 6, NULL, 'Gerrant'),
('BAYAR15', 'KRM202025', 1500000000, 647483647, '2025-10-29 04:33:04', 2, 321, 'Gerrant'),
('BAYAR16', 'KRM202025', 647483647, 0, '2025-10-29 04:33:33', 1, NULL, 'Gerrant'),
('BAYAR17', 'KRM122025', 6817000, 0, '2025-10-31 09:27:27', 2, 4321, 'Gerrant'),
('BAYAR18', 'KRM242025', 3194240, 0, '2025-11-08 16:41:48', 2, 4321, 'Gerrant'),
('BAYAR2', 'KRM22025', 40650, 0, '2025-06-03 01:46:52', 2, 2345, 'Melindiustus'),
('BAYAR3', 'KRM62025', 68750, 0, '2025-06-03 06:02:14', 4, 966, 'Angel'),
('BAYAR4', 'KRM52025', 20000, 23300, '2025-06-03 06:02:58', 6, NULL, 'Richard'),
('BAYAR5', 'KRM52025', 23300, 0, '2025-06-03 06:03:43', 4, 99, 'Liko'),
('BAYAR6', 'KRM32025', 28500, 0, '2025-06-03 06:04:13', 6, NULL, 'Liko'),
('BAYAR7', 'KRM42025', 28500, 0, '2025-06-03 06:04:36', 6, NULL, 'Geopark'),
('BAYAR8', 'KRM72025', 105800, 0, '2025-06-05 01:48:36', 1, NULL, 'Anting'),
('BAYAR9', 'KRM92025', 50000, 47800, '2025-06-23 14:45:05', 6, NULL, 'Gerrant');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `ID` char(16) NOT NULL,
  `sender_ID` char(16) DEFAULT NULL,
  `receiver_name` varchar(30) DEFAULT NULL,
  `receiver_telp` varchar(15) DEFAULT NULL,
  `alamat_tujuan` text,
  `kota_tujuan` varchar(255) DEFAULT NULL,
  `armada_ID` int DEFAULT NULL,
  `bobot` float(5,2) DEFAULT NULL,
  `jarak` float(6,2) DEFAULT NULL,
  `kategori_ID` int DEFAULT NULL,
  `harga_total` int NOT NULL,
  `tipe_kurir` int DEFAULT NULL,
  `sent_date` date NOT NULL,
  `target_tiba` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `hilang` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`ID`, `sender_ID`, `receiver_name`, `receiver_telp`, `alamat_tujuan`, `kota_tujuan`, `armada_ID`, `bobot`, `jarak`, `kategori_ID`, `harga_total`, `tipe_kurir`, `sent_date`, `target_tiba`, `received_date`, `volume`, `hilang`) VALUES
('KRM102025', '3275', 'Michelle', '622100000', 'Cimanggis Golf Estate, Tapos-Depok', 'DEPOK', 1, 0.50, 5.00, 9, 19300, 2, '2025-07-04', '2025-07-06', '2025-09-04', 0, 0),
('KRM112025', '1111', 'Michelle', '622100000', 'pontianak', 'PONTIANAK', 1, 999.99, 753.00, 1, 6758500, 1, '2025-10-06', '2025-10-10', '2025-10-29', 30000000, 0),
('KRM12025', '3275', 'Melindiustus', '6281111111111', 'Graha Greenville 11470', 'JAKARTA BARAT', 1, 0.00, 27.00, 1, 37899, NULL, '2025-05-22', NULL, '2025-09-03', 100000, 0),
('KRM122025', '112233', 'Central Park Management', '622184301294', 'abc', 'KOTAWARINGIN TIMUR', NULL, 999.99, 792.00, 3, 6817000, 4, '2025-10-06', '2025-10-08', NULL, 30000000, 0),
('KRM132025', '1111', 'Michelle', '622100000', 'mempawah', 'Mempawah', NULL, 999.99, NULL, 3, 345000000, 5, '2025-10-06', '2025-10-10', NULL, 24000000, 0),
('KRM142025', '1111', 'Michelle', '622100000', 'mempawah', 'Mempawah', NULL, 999.99, NULL, 3, 345000000, 5, '2025-10-06', '2025-10-10', NULL, 48000000, 0),
('KRM152025', '1111', 'Michelle', '622100000', 'mempawah', 'Mempawah', NULL, 999.99, NULL, 3, 345000000, 5, '2025-10-06', '2025-10-10', NULL, 48000000, 0),
('KRM162025', '112233', 'Michelle', '622100000', 'Ketpang', 'Ketapang', 1, 10.00, NULL, 3, 345000000, 4, '2025-10-06', '2025-10-10', NULL, 48000000, 1),
('KRM172025', '112233', 'Michelle', '622100000', 'Pemangkat', 'Pemangkat', NULL, 10.00, NULL, 3, 50000000, 8, '2025-10-06', '2025-10-13', NULL, 48, 0),
('KRM182025', '112233', 'Duar', '62123', 'pemangkatsan', 'Pemangkat', NULL, 0.00, NULL, 2, 12, 6, '2025-10-10', '2025-10-14', NULL, 0, 0),
('KRM192025', '1111', 'Duar', '62123', 'ketapng 123', 'Ketapang', 8, 2.00, NULL, 3, 8000000, 3, '2025-10-10', '2025-10-17', '2025-11-08', 35, 0),
('KRM202025', '1111', 'Gerrant', '629821', 'pontianak 123', 'pontianak', 1, 999.99, NULL, 11, 2147483647, 1, '2025-10-29', '2025-10-31', NULL, 18, 0),
('KRM212025', '1111', 'Michelle', '622100000', 'alamat ketapang', 'Ketapang', NULL, 10.00, NULL, 6, 345000000, 4, '2025-11-01', '2025-11-05', NULL, 1000, 0),
('KRM22025', '3673', 'Gerrant Hiya', '6285213321603', 'Tanjung Priok 14320', 'JAKARTA UTARA', 8, 0.00, 29.00, 1, 40650, NULL, '2025-05-22', NULL, '2025-09-03', 50000, 0),
('KRM222025', '1111', 'Michelle', '622100000', 'mempawah-123', 'Mempawah', NULL, 20.00, NULL, 1, 180000, 7, '2025-11-06', '2025-11-13', NULL, 0.2, 0),
('KRM232025', '1111', 'Gerrant', '62123', 'Sambas', 'Sambas', NULL, 20.00, NULL, 5, 59166667, 9, '2025-11-08', '2025-11-12', NULL, 10, 0),
('KRM242025', '112233', 'Gerrant', '62123', 'ktpg', 'Ketapang', 8, 44.50, NULL, 1, 3194240, 4, '2025-11-08', '2025-11-12', NULL, 0.55552, 0),
('KRM252025', '3277', 'Duar', '622184301294', 'mempawah', 'Mempawah', 1, 44.50, NULL, 1, 4950000, 7, '2025-11-09', '2025-11-16', NULL, 5.5, 0),
('KRM32025', '3673', 'Liko', '628121212121', 'Ancol 14430', 'JAKARTA UTARA', 8, 0.20, 19.00, 1, 28500, NULL, '2025-05-23', NULL, NULL, 0, 1),
('KRM42025', '3673', 'Central Park Management', '622184301294', 'Mall Central Park Jakbar 11470', 'JAKARTA BARAT', 1, 0.20, 19.00, 3, 28500, NULL, '2025-05-23', NULL, '2025-09-04', 0, 0),
('KRM52025', '3275', 'Untar', '6221', 'Universitas Tarumanagara 11450', 'JAKARTA BARAT', 1, 0.25, 27.00, 1, 43300, 1, '2025-05-23', '2025-05-27', '2025-09-04', 0, 0),
('KRM62025', '3275', 'Michelle', '622100000', 'Bogor, 16115', 'BOGOR', 1, 1.20, 27.00, 1, 68750, 3, '2025-05-27', '2025-05-28', NULL, 960000, 1),
('KRM72025', '3277', 'Williamto', '62123', 'Perumahan Citra Garden 5, Kalideres, Jakarta Barat 11720', 'JAKARTA BARAT', 1, 0.51, 32.00, 9, 105800, 9, '2025-06-04', '2025-06-05', NULL, 0, 1),
('KRM82025', '3277', 'Gerrant Hiya', '6285213321603', 'Jl. Letjen S. Parman No. 1, Grogol Petamburan 11440, Jakarta Barat, DKI Jakarta', 'JAKARTA BARAT', 1, 1.00, 26.00, 1, 71430, 7, '2025-06-05', '2025-06-07', '2025-09-03', 30000, 0),
('KRM92025', '3673', 'Untar', '62123', 'Jl Grogol Petamburan', 'JAKARTA BARAT', 1, 2.00, 27.00, 3, 97800, 9, '2025-06-23', '2025-06-24', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE `sopir` (
  `ID` char(16) NOT NULL,
  `NamaLengkap` varchar(30) NOT NULL,
  `foto_SIM` text,
  `hire_date` date NOT NULL,
  `kontrak_sopir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`ID`, `NamaLengkap`, `foto_SIM`, `hire_date`, `kontrak_sopir`, `is_active`) VALUES
('1234567890123456', 'Orang-Orangan Sawah', NULL, '2025-05-09', NULL, 0),
('2345678901234567', 'Gajah Loncat', '2345678901234567.jpg', '2025-05-09', '1', 1),
('3456789012345678', 'Batu Kepala', '3456789012345678.jpg', '2025-05-14', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `NamaLengkap` varchar(100) DEFAULT NULL,
  `is_super` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`email`, `password`, `NamaLengkap`, `is_super`) VALUES
('gerrante.hiya@gmail.com', '$2y$10$d8rxng1IcKQbj01WEPv4u.OXw1MgODczI..gNmiA.EGjUTO9afiUm', 'Gerrant Hiya', 1),
('gerranthiya@e-digital.space', '$2y$10$pHUycBpSokONMw9iLHI0i.8agtylymSCuzD20Wgfi3i6tBSyK98by', 'Liko', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kurir`
--

CREATE TABLE `tipe_kurir` (
  `ID` int NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `durasi_hari` int NOT NULL,
  `biaya` int NOT NULL,
  `minimal_kg` int NOT NULL,
  `deactivate` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipe_kurir`
--

INSERT INTO `tipe_kurir` (`ID`, `tipe`, `durasi_hari`, `biaya`, `minimal_kg`, `deactivate`) VALUES
(1, 'pontianak-pesawat', 2, 33000, 2, 0),
(2, 'pontianak-kapal laut', 5, 2500, 10, 0),
(4, 'Ketapang-pesawat', 4, 34500, 10, 0),
(5, 'Mempawah-pesawat', 4, 34500, 10, 0),
(6, 'Pemangkat-pesawat', 4, 34500, 10, 0),
(7, 'Mempawah-kapal laut', 7, 4500, 10, 0),
(8, 'Pemangkat-kapal laut', 7, 5000, 10, 0),
(9, 'Sambas-pesawat', 4, 35500, 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `plat_nomor` (`plat_nomor`);

--
-- Indexes for table `auth_pin`
--
ALTER TABLE `auth_pin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `golongan_bobot`
--
ALTER TABLE `golongan_bobot`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `golongan_jarak`
--
ALTER TABLE `golongan_jarak`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `golongan_volume`
--
ALTER TABLE `golongan_volume`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jenis_armada`
--
ALTER TABLE `jenis_armada`
  ADD PRIMARY KEY (`id_jenis_armada`);

--
-- Indexes for table `kategori_paket`
--
ALTER TABLE `kategori_paket`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kontrak_sopir`
--
ALTER TABLE `kontrak_sopir`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `loc_hist`
--
ALTER TABLE `loc_hist`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `monthly_report`
--
ALTER TABLE `monthly_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `tipe_kurir`
--
ALTER TABLE `tipe_kurir`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armada`
--
ALTER TABLE `armada`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `auth_pin`
--
ALTER TABLE `auth_pin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `golongan_bobot`
--
ALTER TABLE `golongan_bobot`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `golongan_jarak`
--
ALTER TABLE `golongan_jarak`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `golongan_volume`
--
ALTER TABLE `golongan_volume`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_armada`
--
ALTER TABLE `jenis_armada`
  MODIFY `id_jenis_armada` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_paket`
--
ALTER TABLE `kategori_paket`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `loc_hist`
--
ALTER TABLE `loc_hist`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `monthly_report`
--
ALTER TABLE `monthly_report`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipe_kurir`
--
ALTER TABLE `tipe_kurir`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
