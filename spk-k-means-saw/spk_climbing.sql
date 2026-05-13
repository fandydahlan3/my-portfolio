-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2026 at 03:18 PM
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
-- Database: `spk_climbing`
--

-- --------------------------------------------------------

--
-- Table structure for table `atlet`
--

CREATE TABLE `atlet` (
  `id` int NOT NULL,
  `nama_atlet` varchar(100) NOT NULL,
  `c1` float DEFAULT NULL,
  `c2` float DEFAULT NULL,
  `c3` float DEFAULT NULL,
  `c4` float DEFAULT NULL,
  `c5` float DEFAULT NULL,
  `c6` float DEFAULT NULL,
  `c7` float DEFAULT NULL,
  `c8` float DEFAULT NULL,
  `c9` float DEFAULT NULL,
  `c10` float DEFAULT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `cluster` varchar(50) DEFAULT NULL,
  `skor_saw` float DEFAULT NULL,
  `ranking_nasional` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `atlet`
--

INSERT INTO `atlet` (`id`, `nama_atlet`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `c8`, `c9`, `c10`, `bulan`, `tahun`, `cluster`, `skor_saw`, `ranking_nasional`, `created_at`) VALUES
(1, 'Atlet 1', 80, 78, 80, 87, 79, 89, 89, 78, 87, 89, 5, 2026, '0', 0.8906, 2, '2026-05-09 06:56:00'),
(2, 'atlet 2', 76, 76, 78, 88, 87, 67, 86, 77, 86, 66, 5, 2026, '1', 0.8779, 3, '2026-05-09 10:19:56'),
(3, 'atlet3', 55, 70, 78, 88, 89, 78, 90, 80, 99, 100, 5, 2026, '1', 0.9086, 1, '2026-05-09 10:20:25'),
(4, 'atlet 4', 60, 70, 90, 68, 90, 80, 79, 90, 90, 100, 5, 2026, '1', 0.8959, 2, '2026-05-13 04:30:21'),
(5, 'atlet 6', 60, 70, 70, 70, 80, 80, 80, 80, 80, 100, 5, 2026, '1', 0.8344, 4, '2026-05-13 04:45:24'),
(6, 'atlet5', 90, 98, 70, 80, 70, 87, 87, 88, 78, 90, 5, 2026, '0', 0.9635, 1, '2026-05-13 14:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` varchar(5) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot_speed` float DEFAULT NULL,
  `bobot_lead` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama_kriteria`, `bobot_speed`, `bobot_lead`) VALUES
('C1', 'Kecepatan', 0.6, 0.13),
('C10', 'Absensi', 0.03, 0.13),
('C2', 'Power Tungkai', 0.1, 0.2),
('C3', 'Agility', 0.05, 0.5),
('C4', 'Daya Tahan Otot', 0.05, 0.1),
('C5', 'Koordinasi Mata Tangan', 0.04, 0.13),
('C6', 'Fleksibilitas', 0.04, 0.13),
('C7', 'Keseimbangan', 0.03, 0.7),
('C8', 'Mental', 0.03, 0.1),
('C9', 'Disiplin', 0.03, 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'viewer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`) VALUES
(1, 'admin', '$2a$12$zPIlSlzxVjAAqKdQGzF9Nuj1SV3oj72OMzx8c.y0t1nsQwuEoPyfS', 'Administrator SPK', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atlet`
--
ALTER TABLE `atlet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atlet`
--
ALTER TABLE `atlet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
