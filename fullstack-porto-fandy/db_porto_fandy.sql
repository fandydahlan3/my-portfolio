-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2026 at 04:37 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_porto_fandy`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `tech_stack` varchar(255) DEFAULT NULL,
  `project_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `category`, `image`, `description`, `tech_stack`, `project_url`, `created_at`) VALUES
(2, 'Sistem Informasi PSB', 'Web Development', '/public/images/project-psb.png', 'Aplikasi Pendaftaran Santri Baru (PSB) Online\nSistem informasi berbasis web yang dirancang untuk memudahkan proses registrasi calon santri secara efisien. Dibangun menggunakan NativePHP untuk pengolahan data yang ringan dan Bootstrap 5 untuk antarmuka yang modern serta responsif di berbagai perangkat.', 'NativePHP, Bootstrap 5, Mysql', 'https://github.com/fandydahlan3/my-portfolio/tree/main/psb.smpit-arrisalahcariu.sch.id', '2026-05-10 06:12:13'),
(3, 'Analisis K-means & SAW Atlet', 'Data Science', 'public/images/SAW_lead.png', 'Sistem ini menerapkan metodologi data science untuk menentukan atlet panjat tebing yang paling kompetitif untuk diikutsertakan dalam perlombaan melalui dua tahapan komputasi yang terintegrasi. Pada tahap awal, algoritma K-Means Clustering digunakan untuk melakukan segmentasi atlet berdasarkan fitur fisik dan performa multidimensi, seperti ape index, kekuatan genggaman, dan daya tahan otot, guna memetakan spesialisasi atlet ke dalam kelompok yang homogen (misalnya kelompok spesialis Speed, Lead, atau Boulder). Setelah profil atlet teridentifikasi, metode Simple Additive Weighting (SAW) diterapkan untuk melakukan pemeringkatan di dalam setiap kelompok tersebut dengan mengalkulasi bobot kriteria strategis, seperti catatan waktu terbaik dan konsistensi hasil latihan. Integrasi ini menghasilkan keputusan yang objektif dan berbasis data, sehingga mempermudah pelatih dalam mendelegasikan atlet yang memiliki kesiapan fisik serta teknis paling optimal sesuai dengan kategori perlombaan yang diikuti.', 'Excel', 'https://drive.google.com/file/d/1Z0_DGZEVaacOS8vgwnwXQefwwFNU5kpG/view?usp=drive_link', '2026-05-10 06:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `image_url`) VALUES
(1, 'Node.js', '/images/node.png'),
(2, 'React', '/images/react.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
