-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2025 pada 07.21
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
-- Database: `pendaftaran_santri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_santri`
--

CREATE TABLE `calon_santri` (
  `id_santri` int(11) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `nama_panggilan` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `jenjang_pendidikan` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jalur_pendaftaran` varchar(100) DEFAULT NULL,
  `status_tempat_tinggal` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ayah`
--

CREATE TABLE `data_ayah` (
  `id_ayah` int(11) NOT NULL,
  `id_santri` int(11) NOT NULL,
  `nama_lengkap` varchar(150) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `suku` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `pendidikan_terakhir` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(150) DEFAULT NULL,
  `penghasilan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ibu`
--

CREATE TABLE `data_ibu` (
  `id_ibu` int(11) NOT NULL,
  `id_santri` int(11) NOT NULL,
  `nama_lengkap` varchar(150) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `suku` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `pendidikan_terakhir` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(150) DEFAULT NULL,
  `penghasilan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikan_santri`
--

CREATE TABLE `pendidikan_santri` (
  `id_pendidikan` int(11) NOT NULL,
  `id_santri` int(11) NOT NULL,
  `nisn` varchar(30) DEFAULT NULL,
  `nama_sekolah_asal` varchar(150) DEFAULT NULL,
  `alamat_sekolah_asal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `calon_santri`
--
ALTER TABLE `calon_santri`
  ADD PRIMARY KEY (`id_santri`);

--
-- Indeks untuk tabel `data_ayah`
--
ALTER TABLE `data_ayah`
  ADD PRIMARY KEY (`id_ayah`),
  ADD KEY `id_santri` (`id_santri`);

--
-- Indeks untuk tabel `data_ibu`
--
ALTER TABLE `data_ibu`
  ADD PRIMARY KEY (`id_ibu`),
  ADD KEY `id_santri` (`id_santri`);

--
-- Indeks untuk tabel `pendidikan_santri`
--
ALTER TABLE `pendidikan_santri`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD KEY `id_santri` (`id_santri`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon_santri`
--
ALTER TABLE `calon_santri`
  MODIFY `id_santri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_ayah`
--
ALTER TABLE `data_ayah`
  MODIFY `id_ayah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_ibu`
--
ALTER TABLE `data_ibu`
  MODIFY `id_ibu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendidikan_santri`
--
ALTER TABLE `pendidikan_santri`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_ayah`
--
ALTER TABLE `data_ayah`
  ADD CONSTRAINT `data_ayah_ibfk_1` FOREIGN KEY (`id_santri`) REFERENCES `calon_santri` (`id_santri`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_ibu`
--
ALTER TABLE `data_ibu`
  ADD CONSTRAINT `data_ibu_ibfk_1` FOREIGN KEY (`id_santri`) REFERENCES `calon_santri` (`id_santri`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendidikan_santri`
--
ALTER TABLE `pendidikan_santri`
  ADD CONSTRAINT `pendidikan_santri_ibfk_1` FOREIGN KEY (`id_santri`) REFERENCES `calon_santri` (`id_santri`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
