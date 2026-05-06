-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql100.infinityfree.com
-- Waktu pembuatan: 04 Bulan Mei 2026 pada 09.31
-- Versi server: 11.4.10-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40396515_psb_arrisalah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_santri`
--

CREATE TABLE `calon_santri` (
  `id_santri` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nama_panggilan` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `jenjang_pendidikan` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kewarganegaraan` varchar(50) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `jml_saudara_kandung` int(11) DEFAULT NULL,
  `jml_saudara_tiri` int(11) DEFAULT NULL,
  `jml_saudara_angkat` int(11) DEFAULT NULL,
  `status_santri` varchar(50) DEFAULT NULL,
  `tinggal_dengan` varchar(50) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `alamat_jalan` varchar(100) DEFAULT NULL,
  `alamat_rt_rw` varchar(20) DEFAULT NULL,
  `alamat_desa` varchar(50) DEFAULT NULL,
  `alamat_kecamatan` varchar(50) DEFAULT NULL,
  `alamat_kabupaten` varchar(50) DEFAULT NULL,
  `alamat_provinsi` varchar(50) DEFAULT NULL,
  `alamat_kodepos` varchar(10) DEFAULT NULL,
  `gol_darah` varchar(5) DEFAULT NULL,
  `riwayat_penyakit` text DEFAULT NULL,
  `kelainan_jasmani` text DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `calon_santri`
--

INSERT INTO `calon_santri` (`id_santri`, `foto`, `nama_lengkap`, `nama_panggilan`, `jenis_kelamin`, `jenjang_pendidikan`, `tempat_lahir`, `tanggal_lahir`, `kewarganegaraan`, `hobi`, `anak_ke`, `jml_saudara_kandung`, `jml_saudara_tiri`, `jml_saudara_angkat`, `status_santri`, `tinggal_dengan`, `alamat_lengkap`, `alamat_jalan`, `alamat_rt_rw`, `alamat_desa`, `alamat_kecamatan`, `alamat_kabupaten`, `alamat_provinsi`, `alamat_kodepos`, `gol_darah`, `riwayat_penyakit`, `kelainan_jasmani`, `berat_badan`) VALUES
(6, NULL, 'Akbar Maulana', 'Abay', 'Laki-laki', 'SMK IT AR-RISALAH', 'Bogor', '2010-06-11', 'WNI', 'Hadroh, Kaligrafi, Badmintoon & volly', 3, 3, 0, 0, 'SMP IT AR-RISALAH', 'Orangtua', 'Kp burangkeng desa Ciledung kec setu bekasi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60),
(5, NULL, 'Jihan Talita Ulfa ', 'Jihan ', 'Perempuan', 'SMP IT AR-RISALAH', 'Bogor ', '2014-05-03', 'Indonesia ', 'Volli', 2, 0, 1, 0, 'SMP IT AR-RISALAH', 'Orang tua ', 'Kp. Gunung Haur. RT 010/005. Tanjung Sari. Kab Bogor .', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(3, NULL, 'Khayla maulida husna', 'Khayla', 'Perempuan', 'SMP IT AR-RISALAH', 'Bogor', '2014-03-11', 'Indonesia', 'Ngtrip', 3, 4, 0, 0, 'SMP IT AR-RISALAH', 'Orang tua', 'Jangkar desa Mekarwangi Cariu bogor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40),
(7, NULL, 'Akbar Maulana', 'Abay', 'Laki-laki', 'SMK IT AR-RISALAH', 'Bogor', '2010-06-11', 'WNI', 'Hadroh, Kaligrafi, Badmintoon & volly', 3, 3, 0, 0, 'SMP IT AR-RISALAH', 'Orangtua', 'Kp burangkeng desa Ciledung kec setu bekasi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60),
(8, NULL, 'Salsa Nabila Rachmadani', 'Salsa', 'Perempuan', 'SMP IT AR-RISALAH', 'Karawang', '2014-07-22', 'Indonesia', 'membaca buku', 2, 1, 0, 0, 'SMP IT AR-RISALAH', 'orang tua', 'kp bakan pedes desa. cintaasih kec.Pangkalan karawang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ayah`
--

CREATE TABLE `data_ayah` (
  `id_ayah` int(11) NOT NULL,
  `id_santri` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `suku` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_ayah` varchar(50) DEFAULT NULL,
  `alamat_ayah` text DEFAULT NULL,
  `pendidikan_terakhir` varchar(50) DEFAULT NULL,
  `keterangan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `penghasilan_ayah` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `data_ayah`
--

INSERT INTO `data_ayah` (`id_ayah`, `id_santri`, `nama_lengkap`, `no_hp`, `suku`, `tempat_lahir`, `tanggal_lahir`, `status_ayah`, `alamat_ayah`, `pendidikan_terakhir`, `keterangan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`) VALUES
(6, 6, 'Saodih', '', 'Sunda', 'Bekasi', '1974-11-04', NULL, NULL, 'SD/MI', NULL, 'Petani', '2'),
(5, 5, 'Dharma Rizali ', '081313581516', '-', 'Bingin rupit ', '1983-06-11', NULL, NULL, 'SMA/SMK/MA', NULL, 'Wirausaha ', '4'),
(3, 3, 'soleh udin', '085885518535', 'Sunda', 'Bogor', '1983-12-07', NULL, NULL, '', NULL, 'Wira swasta', '3'),
(7, 7, 'Saodih', '', 'Sunda', 'Bekasi', '1974-11-04', NULL, NULL, 'SD/MI', NULL, 'Petani', '2'),
(8, 8, 'Ma\' mur', '082213440070', 'sunda', 'Karawang', '1979-09-03', NULL, NULL, 'SMA/SMK/MA', NULL, 'Wiraswasta', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ibu`
--

CREATE TABLE `data_ibu` (
  `id_ibu` int(11) NOT NULL,
  `id_santri` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `suku` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_ibu` varchar(50) DEFAULT NULL,
  `alamat_ibu` text DEFAULT NULL,
  `pendidikan_terakhir` varchar(50) DEFAULT NULL,
  `keterangan_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `penghasilan_ibu` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `data_ibu`
--

INSERT INTO `data_ibu` (`id_ibu`, `id_santri`, `nama_lengkap`, `no_hp`, `suku`, `tempat_lahir`, `tanggal_lahir`, `status_ibu`, `alamat_ibu`, `pendidikan_terakhir`, `keterangan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`) VALUES
(6, 6, 'Winah', '085888831165', 'Sunda', 'Bogor', '1970-06-11', NULL, NULL, 'SD/MI', NULL, 'Irt', '0'),
(5, 5, 'Sulastri ', '082315242731', 'Sunda', 'Bogor ', '1989-09-24', NULL, NULL, 'SD/MI', NULL, 'Pedagang ', '2'),
(3, 3, 'Siti Aisyah ', '', 'Sunda', 'Bogor', '1988-01-10', NULL, NULL, 'Lainnya', NULL, 'Ibu rumah tangga', '0'),
(7, 7, 'Winah', '085888831165', 'Sunda', 'Bogor', '1970-06-11', NULL, NULL, 'SD/MI', NULL, 'Irt', '0'),
(8, 8, 'Purnamawati', '085711525601', 'Sunda', 'Karawang', '1976-03-02', NULL, NULL, 'S1', NULL, 'PNS', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_data`
--

CREATE TABLE `login_data` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `login_data`
--

INSERT INTO `login_data` (`id_user`, `email`, `password`) VALUES
(1, 'fandy@gmail.com', 'Arrisalah2026');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikan_santri`
--

CREATE TABLE `pendidikan_santri` (
  `id_pendidikan` int(11) NOT NULL,
  `id_santri` int(11) DEFAULT NULL,
  `nama_sekolah_asal` varchar(100) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `tahun_lulus` varchar(10) DEFAULT NULL,
  `no_sttb` varchar(50) DEFAULT NULL,
  `alamat_sekolah` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pendidikan_santri`
--

INSERT INTO `pendidikan_santri` (`id_pendidikan`, `id_santri`, `nama_sekolah_asal`, `nisn`, `tahun_lulus`, `no_sttb`, `alamat_sekolah`) VALUES
(6, 6, 'SMP PLUS AL BURHANIYAH', '0102201806', '2026', '-', NULL),
(5, 5, 'MI Mambaul islamiyah', '-', '-', '-', NULL),
(3, 3, 'Mis alkhoriyah', '3141429346', '2026', 'Belum ada', NULL),
(7, 7, 'SMP PLUS AL BURHANIYAH', '0102201806', '2026', '-', NULL),
(8, 8, 'SDIT Al Anshoriyah', '3142778490', '2025/ 2026', '-', NULL);

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
  ADD PRIMARY KEY (`id_ayah`);

--
-- Indeks untuk tabel `data_ibu`
--
ALTER TABLE `data_ibu`
  ADD PRIMARY KEY (`id_ibu`);

--
-- Indeks untuk tabel `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `pendidikan_santri`
--
ALTER TABLE `pendidikan_santri`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon_santri`
--
ALTER TABLE `calon_santri`
  MODIFY `id_santri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `data_ayah`
--
ALTER TABLE `data_ayah`
  MODIFY `id_ayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `data_ibu`
--
ALTER TABLE `data_ibu`
  MODIFY `id_ibu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `login_data`
--
ALTER TABLE `login_data`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pendidikan_santri`
--
ALTER TABLE `pendidikan_santri`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
