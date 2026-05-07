-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Feb 2026 pada 08.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `nomor_anggota` varchar(20) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`nomor_anggota`, `nama_anggota`, `jenis_kelamin`, `alamat`, `no_hp`, `tanggal_daftar`, `tanggal_lahir`) VALUES
('1234564789', 'pupun voice ', 'P', 'jln. raya bekasi', '025187894', '2026-02-05', '2013-02-05'),
('231231', 'acca', 'P', 'jl. raya cimanggu', '0254454545', '2026-02-04', '2026-02-04'),
('54564654218', 'Rahman', 'L', 'jl. raya cariu', '54354534545', '2026-02-04', '2026-02-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_angsuran`
--

CREATE TABLE `data_angsuran` (
  `id_angsuran` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nomor_anggota` varchar(20) DEFAULT NULL,
  `nominal_angsuran` decimal(15,2) DEFAULT NULL,
  `tanggal_angsuran` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Belum Bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_angsuran`
--

INSERT INTO `data_angsuran` (`id_angsuran`, `id_user`, `nomor_anggota`, `nominal_angsuran`, `tanggal_angsuran`, `status`) VALUES
(7, NULL, '54564654218', 23000000.00, '2026-02-04', 'CICIL'),
(9, NULL, '231231', 23000000.00, '2026-02-04', 'CICIL'),
(10, NULL, '231231', 23000000.00, '2026-02-06', 'CICIL'),
(12, NULL, '1234564789', 5000000.00, '2026-02-05', 'CICIL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_iuran`
--

CREATE TABLE `data_iuran` (
  `id_iuran` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nomor_anggota` varchar(20) DEFAULT NULL,
  `iuran_pokok` decimal(15,2) DEFAULT NULL,
  `iuran_wajib` decimal(15,2) DEFAULT NULL,
  `iuran_sukarela` decimal(15,2) DEFAULT NULL,
  `tanggal_iuran` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_iuran`
--

INSERT INTO `data_iuran` (`id_iuran`, `id_user`, `nomor_anggota`, `iuran_pokok`, `iuran_wajib`, `iuran_sukarela`, `tanggal_iuran`) VALUES
(4, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, '54564654218', 50000.00, 50000.00, 50000.00, '2026-02-04'),
(11, NULL, '231231', 50000.00, 50000.00, 50000.00, '2026-02-04'),
(12, NULL, '1234564789', 50000.00, 50000.00, 50000.00, '2026-02-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pembayaran`
--

CREATE TABLE `data_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_angsuran` int(11) NOT NULL,
  `nominal_bayar` decimal(15,2) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pendapatan`
--

CREATE TABLE `data_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_usaha` int(11) DEFAULT NULL,
  `jenis_pendapatan` varchar(50) DEFAULT NULL,
  `jumlah_pendapatan` decimal(15,2) DEFAULT NULL,
  `tanggal_pendapatan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pendapatan`
--

INSERT INTO `data_pendapatan` (`id_pendapatan`, `id_user`, `id_usaha`, `jenis_pendapatan`, `jumlah_pendapatan`, `tanggal_pendapatan`) VALUES
(9, NULL, 7, NULL, 23232323.00, '2026-02-04'),
(10, NULL, 4, NULL, 23232323.00, '2026-02-05'),
(11, NULL, 9, NULL, 23232323.00, '2026-02-05'),
(12, NULL, 8, NULL, 23232323.00, '2026-02-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_usaha`
--

CREATE TABLE `data_usaha` (
  `id_usaha` int(11) NOT NULL,
  `nomor_anggota` varchar(20) DEFAULT NULL,
  `nama_usaha` varchar(100) DEFAULT NULL,
  `alamat_usaha` text DEFAULT NULL,
  `tanggal_usaha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_usaha`
--

INSERT INTO `data_usaha` (`id_usaha`, `nomor_anggota`, `nama_usaha`, `alamat_usaha`, `tanggal_usaha`) VALUES
(4, NULL, 'pop mie ekstra', 'Jl. raya jonggol', '2026-02-04'),
(7, NULL, 'cireng isi', 'Jl. raya jonggol', '2026-02-04'),
(8, NULL, 'galon cariu', 'jl. raya cariu', '2026-02-04'),
(9, NULL, 'boci bocil', 'jln. raya bekasi ', '2026-02-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_angsuran`
--

CREATE TABLE `pembayaran_angsuran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_angsuran` int(11) DEFAULT NULL,
  `nominal_bayar` decimal(15,2) DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `status` enum('Belum Bayar','Lunas') DEFAULT 'Belum Bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran_angsuran`
--

INSERT INTO `pembayaran_angsuran` (`id_pembayaran`, `id_angsuran`, `nominal_bayar`, `tanggal_bayar`, `status`) VALUES
(8, 9, 23000000.00, '2026-02-04', 'Lunas'),
(9, 7, 15000000.00, '2026-02-04', 'Lunas'),
(10, 10, 20000000.00, '2026-02-05', 'Lunas'),
(11, 12, 5000000.00, '2026-02-05', 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nomor_anggota` varchar(50) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `nomor_anggota`, `role`, `created_at`) VALUES
(1, 'fandy', '$2y$10$vxfLXhIgNU9fb7nOhoKai.JJQEBDwQjzXX8uCTI39OTrfcYpXclBC', 'fandy', NULL, 'admin', '2026-02-03 23:57:40'),
(5, 'caca', '$2y$10$boAHw2uErVdaw4JtwpO/I.s3Vbm6R7z4s.bm2si51mbcJUzktrVkW', 'Shasah', '231231', 'user', '2026-02-04 21:54:49'),
(6, 'rahman', '$2y$10$8E6MgN7amFddfhUDNav1HOTZ5tSh0ePoqkzvhXVY5S1FFXS3WdCbC', '', '54564654218', 'user', '2026-02-05 20:07:39'),
(13, 'pupun', '$2y$10$CraT4KGjkSGufBouyJTkIen34Hir.lRbo6fCUlCeWqZU1uRvU81ae', 'pupun', '1234564789', 'user', '2026-02-05 20:32:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nomor_anggota`);

--
-- Indeks untuk tabel `data_angsuran`
--
ALTER TABLE `data_angsuran`
  ADD PRIMARY KEY (`id_angsuran`),
  ADD KEY `nomor_anggota` (`nomor_anggota`);

--
-- Indeks untuk tabel `data_iuran`
--
ALTER TABLE `data_iuran`
  ADD PRIMARY KEY (`id_iuran`),
  ADD KEY `nomor_anggota` (`nomor_anggota`);

--
-- Indeks untuk tabel `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_angsuran` (`id_angsuran`);

--
-- Indeks untuk tabel `data_pendapatan`
--
ALTER TABLE `data_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`),
  ADD KEY `id_usaha` (`id_usaha`);

--
-- Indeks untuk tabel `data_usaha`
--
ALTER TABLE `data_usaha`
  ADD PRIMARY KEY (`id_usaha`),
  ADD KEY `nomor_anggota` (`nomor_anggota`);

--
-- Indeks untuk tabel `pembayaran_angsuran`
--
ALTER TABLE `pembayaran_angsuran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_angsuran` (`id_angsuran`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_angsuran`
--
ALTER TABLE `data_angsuran`
  MODIFY `id_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `data_iuran`
--
ALTER TABLE `data_iuran`
  MODIFY `id_iuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_pendapatan`
--
ALTER TABLE `data_pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `data_usaha`
--
ALTER TABLE `data_usaha`
  MODIFY `id_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_angsuran`
--
ALTER TABLE `pembayaran_angsuran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_angsuran`
--
ALTER TABLE `data_angsuran`
  ADD CONSTRAINT `data_angsuran_ibfk_1` FOREIGN KEY (`nomor_anggota`) REFERENCES `anggota` (`nomor_anggota`);

--
-- Ketidakleluasaan untuk tabel `data_iuran`
--
ALTER TABLE `data_iuran`
  ADD CONSTRAINT `data_iuran_ibfk_1` FOREIGN KEY (`nomor_anggota`) REFERENCES `anggota` (`nomor_anggota`);

--
-- Ketidakleluasaan untuk tabel `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD CONSTRAINT `data_pembayaran_ibfk_1` FOREIGN KEY (`id_angsuran`) REFERENCES `data_angsuran` (`id_angsuran`);

--
-- Ketidakleluasaan untuk tabel `data_pendapatan`
--
ALTER TABLE `data_pendapatan`
  ADD CONSTRAINT `data_pendapatan_ibfk_1` FOREIGN KEY (`id_usaha`) REFERENCES `data_usaha` (`id_usaha`);

--
-- Ketidakleluasaan untuk tabel `data_usaha`
--
ALTER TABLE `data_usaha`
  ADD CONSTRAINT `data_usaha_ibfk_1` FOREIGN KEY (`nomor_anggota`) REFERENCES `anggota` (`nomor_anggota`);

--
-- Ketidakleluasaan untuk tabel `pembayaran_angsuran`
--
ALTER TABLE `pembayaran_angsuran`
  ADD CONSTRAINT `pembayaran_angsuran_ibfk_1` FOREIGN KEY (`id_angsuran`) REFERENCES `data_angsuran` (`id_angsuran`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
