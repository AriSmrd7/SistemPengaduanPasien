-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Sep 2021 pada 12.45
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_masyarakat`
--

CREATE TABLE `tbl_masyarakat` (
  `id_masyarakat` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_masyarakat`
--

INSERT INTO `tbl_masyarakat` (`id_masyarakat`, `nik`, `nama`, `email`, `password`) VALUES
(1, '32106071219990006', 'Ari Sumardi', 'ari.sumardi@gmail.com', 'd9a8c6c010a37fdc9850fe6d8c064880'),
(2, '32208292202101997', 'Deni Mary', 'deni.mary@gmail.com', 'e518fe30d1041b71415a3a943e970cc7'),
(4, '32201292309101998', 'Abdul Rizwan', 'abdul.rizwan@gmail.com', '30abec4656e3c3a99100e255cac389c6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengaduan`
--

CREATE TABLE `tbl_pengaduan` (
  `id_pengaduan` int(10) NOT NULL,
  `subjek_pengaduan` varchar(150) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `isi_pengaduan` text NOT NULL,
  `bukti_pengaduan` varchar(100) DEFAULT NULL,
  `balasan_pengaduan` enum('Belum','Proses','Selesai') NOT NULL,
  `id_masyarakat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengaduan`
--

INSERT INTO `tbl_pengaduan` (`id_pengaduan`, `subjek_pengaduan`, `tgl_pengaduan`, `isi_pengaduan`, `bukti_pengaduan`, `balasan_pengaduan`, `id_masyarakat`) VALUES
(46, 'Pelayanan Dokter', '2021-04-03', 'Dokter kurang sopan ketika melayani pasien lansia. Tolong tindak tegas oknum seperti ini. Terimakasih', 'contoh perataan histogram.png', 'Selesai', 1),
(47, 'Sarana dan Prasarana', '2021-04-03', 'Sarana dan prasarana yang ada di puskesmas ini kurang memadai', 'concept-XMIUI.png', 'Belum', 1),
(48, 'Antrian yang Lama', '2021-04-03', 'Tolong perbaiki sistem antrian yang ada di puskesmas ini karena dengan sistem yang sekarang membuat pasien mengantre lebih lama dari biasanya. Mohon tanggapi secepatnya. Terimakasih', 'download.jpg', 'Belum', 2),
(49, 'Pelayanan Petugas', '2021-04-03', 'Petugas kurang cepat tanggap terhadap pasien yang sangat membutuhkan bantuan', NULL, 'Belum', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `id_petugas` int(10) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(16) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`id_petugas`, `nama`, `email`, `telepon`, `password`, `level`) VALUES
(1, 'Ari Admin', 'admin@gmail.com', '089651900165', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(2, 'Ari Petugas', 'petugas@gmail.com', '089651900167', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Petugas'),
(3, 'Silvia Nuryani', 'silvia.petugas@gmail.com', '089651900166', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tanggapan`
--

CREATE TABLE `tbl_tanggapan` (
  `id_tanggapan` int(10) NOT NULL,
  `tgl_balas_tanggapan` date NOT NULL,
  `status_tanggapan` enum('Proses','Selesai') NOT NULL,
  `isi_tanggapan` text NOT NULL,
  `id_petugas` int(10) NOT NULL,
  `id_pengaduan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_tanggapan`
--

INSERT INTO `tbl_tanggapan` (`id_tanggapan`, `tgl_balas_tanggapan`, `status_tanggapan`, `isi_tanggapan`, `id_petugas`, `id_pengaduan`) VALUES
(6, '2021-04-03', 'Selesai', 'Sudah disampaikan kepada pihak terkait', 2, 46);

--
-- Trigger `tbl_tanggapan`
--
DELIMITER $$
CREATE TRIGGER `update_balasan` AFTER INSERT ON `tbl_tanggapan` FOR EACH ROW UPDATE tbl_pengaduan SET
balasan_pengaduan = NEW.status_tanggapan
WHERE id_pengaduan = NEW.id_pengaduan
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_masyarakat`
--
ALTER TABLE `tbl_masyarakat`
  ADD PRIMARY KEY (`id_masyarakat`);

--
-- Indeks untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indeks untuk tabel `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tbl_tanggapan`
--
ALTER TABLE `tbl_tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_masyarakat`
--
ALTER TABLE `tbl_masyarakat`
  MODIFY `id_masyarakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengaduan`
--
ALTER TABLE `tbl_pengaduan`
  MODIFY `id_pengaduan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  MODIFY `id_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_tanggapan`
--
ALTER TABLE `tbl_tanggapan`
  MODIFY `id_tanggapan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
