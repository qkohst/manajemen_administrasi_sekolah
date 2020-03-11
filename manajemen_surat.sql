-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2020 at 03:26 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisis`
--

CREATE TABLE `disposisis` (
  `id` int(10) UNSIGNED NOT NULL,
  `tujuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `suratmasuk_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disposisis`
--

INSERT INTO `disposisis` (`id`, `tujuan`, `isi`, `sifat`, `batas_waktu`, `catatan`, `users_id`, `suratmasuk_id`, `created_at`, `updated_at`) VALUES
(4, 'Kepala Fakultas Teknik', 'Konfirmasi Undangan', 'Segera', '2020-02-06', 'Harap Untuk Ditindaklajuti', 2, 1, '2020-02-06 07:33:32', '2020-02-06 07:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `instansis`
--

CREATE TABLE `instansis` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pimpinan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansis`
--

INSERT INTO `instansis` (`id`, `nama`, `alamat`, `pimpinan`, `email`, `file`, `created_at`, `updated_at`) VALUES
(5, 'UNIVERSITAS PGRI RONGGOLAWE TUBAN', 'Jl. Manunggal No. 61 Tuban Telp. (0356) 477596', 'Prof. Dr. Supiyana Dian Nurtjachyani, M.Kes.', 'prosepective@unirow.ac.id', 'uploads/logo/1581015162logo.png', '2020-02-06 11:52:42', '2020-02-06 11:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klasifikasi`
--

INSERT INTO `klasifikasi` (`id`, `nama`, `kode`, `uraian`, `created_at`, `updated_at`) VALUES
(3, 'Ijin Kegiatan', 'C', 'Ini Kode Klasifikasi Untuk Surat Ijin Kegiatan', '2020-02-06 04:35:33', '2020-02-06 04:35:33'),
(5, 'Undangan', 'A', 'Ini Klasifikasi Untuk Undangan', '2020-02-06 11:27:21', '2020-02-06 11:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_12_102424_create_suratmasuk_table', 1),
(4, '2020_01_12_102608_create_suratkeluar_table', 1),
(5, '2020_01_12_102751_create_klasifikasi_table', 1),
(6, '2020_02_01_133812_tambah_field_userid', 1),
(7, '2020_02_01_150517_create_instansis_table', 1),
(8, '2020_02_03_030401_create_disposisi_table', 1),
(9, '2020_02_04_014420_tambah_foreign_key_constraint', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suratkeluar`
--

CREATE TABLE `suratkeluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_surat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_surat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `filekeluar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suratkeluar`
--

INSERT INTO `suratkeluar` (`id`, `no_surat`, `tujuan_surat`, `isi`, `kode`, `tgl_surat`, `tgl_catat`, `filekeluar`, `keterangan`, `created_at`, `updated_at`, `users_id`) VALUES
(3, '212/Pan.LKMOM/VIII/2026', 'a', 'Ini isi surat', 'A', '2020-02-06', '2020-02-06', 'suratKeluar-PEETA.jpg', 'Harap Untuk Ditindaklanjuti', '2020-02-06 09:46:44', '2020-02-06 11:00:03', 2),
(4, '212/Pan.LKMOM/VIII/2022', 'Kepala Program Studi Di Lingkungan Kampus Unirow', 'Pemeberitahuan Pembayaran Kuliah', 'A', '2020-02-06', '2020-02-06', 'suratKeluar-AgendaSuratMasuk.pdf', 'Harap Untuk Disampaikan Ke Mahasiswa', '2020-02-06 09:50:28', '2020-02-06 09:50:28', 2);

-- --------------------------------------------------------

--
-- Table structure for table `suratmasuk`
--

CREATE TABLE `suratmasuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_surat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_surat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_terima` date NOT NULL,
  `filemasuk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suratmasuk`
--

INSERT INTO `suratmasuk` (`id`, `no_surat`, `asal_surat`, `isi`, `kode`, `tgl_surat`, `tgl_terima`, `filemasuk`, `keterangan`, `created_at`, `updated_at`, `users_id`) VALUES
(1, '22/Pan.DN/HIMATIF/XI/2019', 'Hima TIfF Unirow Tuban', 'Surat Ijin Kegiatan', 'C', '2020-02-04', '2020-02-04', 'suratMasuk-LJK copy copy.jpg', 'Harap Untuk Ditindaklanjuti', '2020-02-03 18:51:33', '2020-02-06 04:36:07', 1),
(2, '212/Pan.LKMOM/VIII/2021', 'Hima TIfF Unirow Tuban', 'Undangan Pengukuhan', 'A', '2020-02-04', '2020-02-04', 'suratMasuk-SK PEMB. TUGAS 20182019.pdf', 'Harap Datang Tepat Waktu', '2020-02-03 19:26:09', '2020-02-06 06:38:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Iqbal', 'iqbal@gmail.com', NULL, '$2y$10$OQfcXgG8XjugEp7i4bRvi.V7wTHvtmNa3Ae8.aLTFefkL74hGgFCa', 'admin', 'WWCDgeThxMYIhdqfnu3zahYcTbMwZ2s8TCLXhGlPF4B6x2JcVTjxXRtUNWPO', '2020-02-04 01:49:00', '2020-02-06 12:28:03'),
(2, 'Qkoh St', 'kukohsantoso013@gmail.com', NULL, '$2y$10$f1G8wzNnJUBSUutITNlMY.ophXIddfaAPlBc3bQ/ML9KWEDxT1dai', 'admin', 'ukw33hzTTe7OeW4IO4hMvuRDXTpYrIO0aZXHH2ElWv5ptUY8FG7yAefWxySr', '2020-02-03 19:33:14', '2020-02-03 19:33:14'),
(4, 'Muhammad Afifudin', 'afif@gmail.com', NULL, '$2y$10$ke55swuFi6j28mG0XKtuHOp18OhM1d5wYJcSuQv/AKVvxBmQUAlGi', 'petugas', 'amt0qD4IpDYrJBYfNFUZYdr05l6EM9E3UfwJiMexu1xfIFQb3h5rU4Uz4m5N', '2020-02-05 22:35:40', '2020-02-06 04:43:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisis`
--
ALTER TABLE `disposisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disposisis_users_id_foreign` (`users_id`),
  ADD KEY `disposisis_suratmasuk_id_foreign` (`suratmasuk_id`);

--
-- Indexes for table `instansis`
--
ALTER TABLE `instansis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suratkeluar_no_surat_unique` (`no_surat`),
  ADD KEY `suratkeluar_users_id_foreign` (`users_id`);

--
-- Indexes for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suratmasuk_no_surat_unique` (`no_surat`),
  ADD KEY `suratmasuk_users_id_foreign` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisis`
--
ALTER TABLE `disposisis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `instansis`
--
ALTER TABLE `instansis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisis`
--
ALTER TABLE `disposisis`
  ADD CONSTRAINT `disposisis_suratmasuk_id_foreign` FOREIGN KEY (`suratmasuk_id`) REFERENCES `suratmasuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisis_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  ADD CONSTRAINT `suratkeluar_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  ADD CONSTRAINT `suratmasuk_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
