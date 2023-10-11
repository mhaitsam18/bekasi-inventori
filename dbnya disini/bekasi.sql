-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2022 at 02:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bekasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kondisi` enum('baik','buruk','rusak','') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal_pengadaan` date NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_inventaris` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `jenis`, `kode`, `kategori_id`, `kondisi`, `keterangan`, `tanggal_pengadaan`, `gambar`, `id_lokasi`, `is_active`, `is_inventaris`, `deleted_at`) VALUES
(1, 'Printer Hp', 'Elektronika', '02.06.02.01.031\n', 2, 'baik', 'Baik Banget', '2022-02-01', 'barang.jpg', 2, 1, 0, NULL),
(3, 'Tanah', '500 m2', '02.06.02.01.032', 1, '', '', '2022-02-01', 'bukti.jpg', 1, 0, 1, NULL),
(5, 'Laptop', 'Elektronika', '02.06.02.01.033', 2, 'baik', 'Baik Banget', '2022-03-01', 'barang.jpg', 1, 1, 1, NULL),
(6, 'pulpen', 'Alat Tulis', '02.06.02.01.034', 2, 'baik', 'Baik Banget', '2022-02-01', 'barang.jpg', 1, 1, 1, NULL),
(7, 'komputer', 'Elektronika', '02.06.02.01.035', 2, 'buruk', 'Komputernya sudah ketinggalan jaman', '2022-02-01', 'barang.jpg', 2, 1, 1, NULL),
(8, 'Meja Kantor', 'Perabotan', '02.06.02.01.036', 2, 'baik', 'Baik Banget', '2022-02-01', 'barang.jpg', 1, 0, 0, NULL),
(10, 'Sound System', 'Elektronika', '02.06.02.01.037', 2, 'baik', 'Baik Banget', '2022-02-02', 'barang.jpg', 1, 1, 1, NULL),
(11, 'Mic', 'Elektronika', '02.06.02.01.038', 2, 'baik', 'Baik Banget', '2022-02-22', 'barang.jpg', 2, 0, 0, NULL),
(13, 'Lampu Sorot', 'Elektronika', '02.06.02.01.039', 2, 'baik', 'Baik Banget', '2022-02-25', 'barang.jpg', 2, 1, 0, NULL),
(15, 'Tanah', '100 Hektar', '02.06.02.01.040', 1, 'baik', 'Baik Banget', '2022-04-07', 'barang.jpg', 1, 1, 1, NULL),
(16, 'Coffe Machine', '', '02.06.02.01.041', 2, 'baik', 'bisa digunakan', '2022-07-10', 'barang.jpg', 1, 1, 1, NULL),
(17, 'Televisi', '', '02.06.02.01.042', 2, 'baik', 'Bagus', '2022-07-28', 'barang1.jpg', 1, 1, 0, NULL),
(18, 'Gelas', '', '02.06.02.01.043', 2, 'baik', 'oke', '2022-08-30', 'resep-obat.jpg', 2, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kartu_inventaris_barang`
--

CREATE TABLE `kartu_inventaris_barang` (
  `id` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `id_staff` bigint(20) UNSIGNED DEFAULT NULL,
  `status_pengesahan` int(11) NOT NULL DEFAULT 0,
  `kode_pengesahan` varchar(255) DEFAULT NULL,
  `id_camat` int(11) DEFAULT NULL,
  `is_valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kartu_inventaris_barang`
--

INSERT INTO `kartu_inventaris_barang` (`id`, `id_lokasi`, `id_staff`, `status_pengesahan`, `kode_pengesahan`, `id_camat`, `is_valid`, `created_at`, `updated_at`, `deleted_at`, `closed_at`) VALUES
(10, 1, 6, 0, NULL, NULL, 0, '2022-04-11 01:27:18', '2022-04-11 01:27:18', NULL, NULL),
(11, 1, 6, 0, NULL, NULL, 0, '2022-04-11 01:27:23', '2022-04-11 01:27:23', NULL, NULL),
(12, 2, 6, 0, NULL, NULL, 0, '2022-04-11 01:31:36', '2022-04-11 01:31:36', NULL, NULL),
(13, 2, 6, 0, NULL, NULL, 0, '2022-04-11 01:31:53', '2022-04-11 01:31:53', NULL, NULL),
(14, 1, 6, 1, '648GwNduIEAYKXD', 5, 0, '2022-04-11 01:32:50', '2022-04-10 00:00:00', NULL, NULL),
(15, 1, 6, 0, NULL, NULL, 0, '2022-06-27 01:36:53', '2022-06-27 01:36:53', NULL, NULL),
(16, 1, 6, 0, NULL, NULL, 0, '2022-06-27 02:32:19', '2022-06-27 02:32:19', NULL, NULL),
(17, 2, 6, 1, 'iTLSKJ1VFx2WrhB', 5, 0, '2022-06-27 02:32:28', '2022-07-21 00:00:00', NULL, NULL),
(18, 1, 6, 0, NULL, NULL, 0, '2022-07-27 15:44:16', '2022-07-27 15:44:16', NULL, NULL),
(19, 2, 6, 0, NULL, NULL, 0, '2022-08-26 17:39:42', '2022-08-26 17:39:42', NULL, NULL),
(20, 1, 6, 1, 'kgeSMTSRrS2r6Rf', 5, 0, '2022-08-26 19:08:44', '2022-08-26 00:00:00', NULL, NULL),
(21, 2, 6, 1, 'cwSx3cMcgSPA6QV', 5, 0, '2022-08-26 19:27:45', '2022-08-26 00:00:00', NULL, '2022-08-26 08:16:41'),
(22, 2, 6, 1, 'UgM38MIXOOYgpPt', 5, 0, '2022-08-26 20:21:07', '2022-08-26 00:00:00', NULL, NULL),
(23, 2, 6, 0, NULL, NULL, 0, '2022-08-26 20:28:22', '2022-08-26 20:28:22', NULL, NULL),
(24, 2, 6, 0, NULL, NULL, 0, '2022-08-26 20:45:19', '2022-08-26 20:45:19', NULL, NULL),
(25, 2, 6, 0, NULL, NULL, 0, '2022-08-26 20:51:45', '2022-08-26 20:51:45', NULL, NULL),
(26, 2, 6, 0, NULL, NULL, 0, '2022-08-26 20:52:10', '2022-08-26 20:52:10', NULL, NULL),
(27, 2, 6, 1, '79BGm8btwLAzhNc', 5, 0, '2022-08-26 20:52:28', '2022-08-26 00:00:00', NULL, NULL),
(28, 1, 6, 0, NULL, NULL, 0, '2022-08-26 21:26:13', '2022-08-26 21:26:13', NULL, NULL),
(29, 2, 6, 0, NULL, NULL, 0, '2022-08-26 22:18:02', '2022-08-26 22:18:02', NULL, NULL),
(30, 2, 6, 0, NULL, NULL, 0, '2022-08-26 22:18:22', '2022-08-26 22:18:22', NULL, NULL),
(31, 2, 6, 0, NULL, NULL, 0, '2022-08-26 22:31:37', '2022-08-26 22:31:37', NULL, NULL),
(32, 2, 6, 1, 'iLwCpVaYqlXwYqC', 5, 1, '2022-08-26 22:31:39', '2022-08-26 00:00:00', NULL, NULL),
(33, 1, 6, 0, NULL, NULL, 1, '2022-08-27 02:09:48', '2022-08-27 02:09:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kartu_inventaris_ruangan`
--

CREATE TABLE `kartu_inventaris_ruangan` (
  `id` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `status_pengesahan` int(11) NOT NULL DEFAULT 0,
  `kode_pengesahan` varchar(255) DEFAULT NULL,
  `id_camat` int(11) DEFAULT NULL,
  `is_valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kartu_inventaris_ruangan`
--

INSERT INTO `kartu_inventaris_ruangan` (`id`, `id_lokasi`, `status_pengesahan`, `kode_pengesahan`, `id_camat`, `is_valid`, `created_at`, `updated_at`, `deleted_at`, `closed_at`) VALUES
(1, 1, 1, 'X8WK1YjYVmcIojo', 5, 1, '2022-02-05 00:43:08', '2022-02-05 00:00:00', NULL, '2022-08-26 08:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kib` varchar(5) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `kib`, `deleted_at`) VALUES
(1, 'Tanah', 'A', NULL),
(2, 'Peralatan dan Mesin', 'B', NULL),
(3, 'Gedung dan Bangunan', 'C', NULL),
(4, 'Jalan, Irigasi dan Jaringan', 'D', NULL),
(5, 'Aset Tetap Lainnya', 'E', NULL),
(6, 'Konstruksi Dalam Pengerjaan', 'F', NULL),
(7, 'Aset Lainnya', 'G', NULL),
(8, 'Berkas', 'H', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama_kecamatan`, `deleted_at`) VALUES
(1, 'Bantar Gebang', NULL),
(2, 'Bekasi Barat', NULL),
(3, 'Bekasi Selatan', NULL),
(4, 'Bekasi Timur', NULL),
(5, 'Bekasi Utara', NULL),
(6, 'Jatiasih', NULL),
(7, 'Jatisampurna', NULL),
(8, 'Medan Satria', NULL),
(9, 'Mustika Jaya', NULL),
(10, 'Pondok Gede', NULL),
(11, 'Pondok Melati', NULL),
(12, 'Rawalumbu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_lokasi`, `alamat`, `id_kecamatan`, `deleted_at`) VALUES
(1, 'Kantor Tambun', 'Tambun', 1, NULL),
(2, 'Gudang Inventaris Cikarang', 'Jl. Raya Pantura, Cikarang', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengesahan_barang`
--

CREATE TABLE `pengesahan_barang` (
  `id` int(11) NOT NULL,
  `id_kartu_inventaris_barang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengesahan_barang`
--

INSERT INTO `pengesahan_barang` (`id`, `id_kartu_inventaris_barang`, `id_barang`, `created_at`, `deleted_at`) VALUES
(45, 5, 5, '2022-04-11 01:27:18', NULL),
(46, 3, 3, '2022-04-11 01:27:23', NULL),
(47, 3, 5, '2022-04-11 01:27:23', NULL),
(48, 7, 7, '2022-04-11 01:31:53', NULL),
(49, 16, 3, '2022-04-11 01:32:50', NULL),
(50, 16, 5, '2022-04-11 01:32:50', NULL),
(51, 16, 16, '2022-04-11 01:32:50', NULL),
(52, 15, 3, '2022-06-27 01:36:53', NULL),
(53, 15, 5, '2022-06-27 01:36:53', NULL),
(54, 15, 16, '2022-06-27 01:36:53', NULL),
(55, 16, 3, '2022-06-27 02:32:19', NULL),
(56, 16, 5, '2022-06-27 02:32:19', NULL),
(57, 16, 16, '2022-06-27 02:32:19', NULL),
(58, 17, 7, '2022-06-27 02:32:28', NULL),
(59, 18, 5, '2022-07-27 15:44:16', NULL),
(60, 18, 16, '2022-07-27 15:44:16', NULL),
(61, 10, 5, '2022-08-26 19:08:44', NULL),
(62, 10, 10, '2022-08-26 19:08:44', NULL),
(63, 10, 16, '2022-08-26 19:08:44', NULL),
(64, 11, 7, '2022-08-26 19:27:45', NULL),
(65, 22, 7, '2022-08-26 20:21:07', NULL),
(66, 18, 7, '2022-08-26 20:28:22', NULL),
(67, 18, 18, '2022-08-26 20:28:22', NULL),
(68, 13, 7, '2022-08-26 20:45:19', NULL),
(69, 13, 13, '2022-08-26 20:45:19', NULL),
(70, 13, 18, '2022-08-26 20:45:19', NULL),
(71, 7, 13, '2022-08-26 20:51:45', NULL),
(72, 7, 18, '2022-08-26 20:51:45', NULL),
(73, 13, 18, '2022-08-26 20:52:10', NULL),
(74, 11, 18, '2022-08-26 20:52:28', NULL),
(75, 15, 5, '2022-08-26 21:26:13', NULL),
(76, 15, 10, '2022-08-26 21:26:13', NULL),
(77, 15, 15, '2022-08-26 21:26:13', NULL),
(78, 15, 16, '2022-08-26 21:26:13', NULL),
(79, 11, 18, '2022-08-26 22:18:02', NULL),
(80, 7, 7, '2022-08-26 22:18:22', NULL),
(81, 7, 18, '2022-08-26 22:18:22', NULL),
(82, 11, 7, '2022-08-26 22:31:37', NULL),
(83, 11, 18, '2022-08-26 22:31:37', NULL),
(84, 18, 7, '2022-08-26 22:31:39', NULL),
(85, 6, 5, '2022-08-27 02:09:48', NULL),
(86, 6, 6, '2022-08-27 02:09:48', NULL),
(87, 6, 10, '2022-08-27 02:09:49', NULL),
(88, 6, 15, '2022-08-27 02:09:49', NULL),
(89, 6, 16, '2022-08-27 02:09:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengesahan_ruangan`
--

CREATE TABLE `pengesahan_ruangan` (
  `id` int(11) NOT NULL,
  `id_kartu_inventaris_ruangan` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengesahan_ruangan`
--

INSERT INTO `pengesahan_ruangan` (`id`, `id_kartu_inventaris_ruangan`, `id_ruangan`, `created_at`, `deleted_at`) VALUES
(1, 1, 1, '2022-02-05 00:43:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `id_lokasi`, `status`, `keterangan`, `is_active`, `deleted_at`) VALUES
(1, 'Aula Pertemuan Kota', 1, 'Tersedia', 'Kondisi bagus', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tabel` enum('user','barang','kategori','transaksi') NOT NULL,
  `id_subjek` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nomor_anggota` varchar(10) NOT NULL,
  `tanggal_datang` datetime NOT NULL,
  `tanggal_distribusi` datetime NOT NULL,
  `status` enum('datang','dikirim') NOT NULL DEFAULT 'datang',
  `bap` varchar(255) NOT NULL,
  `approval` int(11) NOT NULL,
  `waktu` enum('Pagi','Siang','Sore','Malam') NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_barang`, `nomor_anggota`, `tanggal_datang`, `tanggal_distribusi`, `status`, `bap`, `approval`, `waktu`, `jumlah_barang`, `deleted_at`) VALUES
(5, '02.06.02.01.037', '004', '2021-06-10 00:00:00', '2021-06-11 00:00:00', 'dikirim', 'Contoh-BAP-SiVaCam.docx', 1, 'Pagi', 0, NULL),
(6, '02.06.02.01.036', '004', '2021-06-10 00:00:00', '2021-06-10 00:00:00', 'datang', 'Contoh-BAP-SiVaCam.docx', 1, 'Pagi', 0, NULL),
(7, '02.06.02.01.035', '003', '2022-01-10 00:00:00', '2022-01-15 00:00:00', 'datang', 'Contoh-BAP-SiVaCam.docx', 2, 'Pagi', 0, NULL),
(8, '02.06.02.01.034', '003', '2022-01-19 00:00:00', '2022-02-04 00:00:00', 'datang', 'Contoh-BAP-SiVaCam.docx', 0, 'Pagi', 0, NULL),
(9, '02.06.02.01.033', '003', '2022-01-12 00:00:00', '2022-01-14 00:00:00', 'datang', 'Contoh-BAP-SiVaCam.docx', 0, 'Pagi', 0, NULL),
(10, '02.06.02.01.032', '003', '2022-01-15 00:00:00', '2022-02-05 00:00:00', 'datang', 'Contoh-BAP-SiVaCam.docx', 0, 'Pagi', 0, NULL),
(11, '02.06.02.01.031', '003', '2022-08-18 00:00:00', '2022-08-18 00:00:00', 'datang', 'Contoh-BAP-SiVaCam.docx', 0, 'Siang', 0, NULL),
(12, '02.06.02.01.033', '003', '2022-08-18 00:00:00', '2022-08-18 00:00:00', 'datang', 'Contoh-BAP-SiVaCam.docx', 0, 'Sore', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `nama_operator` varchar(50) NOT NULL,
  `nomor_anggota` varchar(10) NOT NULL,
  `hak_akses` enum('petugas','admin','kelurahan','kecamatan','pengelola') NOT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama_operator`, `nomor_anggota`, `hak_akses`, `id_kecamatan`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$M45NK6SWkZWDEHsdn9avPeguEwwyPq.EG0BwUFj3QyG', 'Admin', '001', 'admin', NULL, NULL),
(2, 'dediajalah', '$2y$10$NJtABZXhhXQrJJYJ31cjSejm8z5a3HUd.ZqeFbHCBHIwiTfYFiSca', 'dedi', '002', 'admin', NULL, NULL),
(3, 'bedul', '$2y$10$NJtABZXhhXQrJJYJ31cjSejm8z5a3HUd.ZqeFbHCBHIwiTfYFiSca', 'Bedul', '003', 'petugas', 1, NULL),
(4, 'kusno', '$2y$10$NJtABZXhhXQrJJYJ31cjSejm8z5a3HUd.ZqeFbHCBHIwiTfYFiSca', 'kusno', '004', 'petugas', 1, NULL),
(5, 'natdev', '$2y$10$0lIw67UmrY5B5vgKrzxfU.R82z.wmaTKdwKaPq6Qg5cyl67ua4MPy', 'Natalia Devi', '005', 'kecamatan', 1, NULL),
(6, 'sentaurus', '$2y$10$0lIw67UmrY5B5vgKrzxfU.R82z.wmaTKdwKaPq6Qg5cyl67ua4MPy', 'Senta Ruslamon', '006', 'pengelola', 1, NULL),
(7, 'sem', '$2y$10$0lIw67UmrY5B5vgKrzxfU.R82z.wmaTKdwKaPq6Qg5cyl67ua4MPy', 'Solihin Emda', '007', 'kelurahan', 1, NULL),
(8, 'darwin', '$2y$10$0lIw67UmrY5B5vgKrzxfU.R82z.wmaTKdwKaPq6Qg5cyl67ua4MPy', 'Darwin', '008', 'kecamatan', 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kartu_inventaris_barang`
--
ALTER TABLE `kartu_inventaris_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pengesahan` (`kode_pengesahan`);

--
-- Indexes for table `kartu_inventaris_ruangan`
--
ALTER TABLE `kartu_inventaris_ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengesahan_barang`
--
ALTER TABLE `pengesahan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengesahan_ruangan`
--
ALTER TABLE `pengesahan_ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_anggota` (`nomor_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kartu_inventaris_barang`
--
ALTER TABLE `kartu_inventaris_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kartu_inventaris_ruangan`
--
ALTER TABLE `kartu_inventaris_ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengesahan_barang`
--
ALTER TABLE `pengesahan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pengesahan_ruangan`
--
ALTER TABLE `pengesahan_ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
