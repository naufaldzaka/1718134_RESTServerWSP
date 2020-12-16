-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2020 pada 16.21
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tokokamera`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'KAMERA-1', 1, 1, 0, '1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `id_typebarang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `jenis_barang`, `harga`, `id_typebarang`, `nama_barang`) VALUES
(2, 'Kamera', 10000000, 1, 'Canon 5D'),
(3, 'Kamera', 15000000, 2, 'Fujifilm XT10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_typebarang`
--

CREATE TABLE `tb_typebarang` (
  `id_typebarang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_typebarang`
--

INSERT INTO `tb_typebarang` (`id_typebarang`, `nama_barang`, `deskripsi`) VALUES
(1, 'DSLR', 'kamera digital yang menggunakan sistem cermin otomatis dan pentaprisma atau pentamirror untuk meneruskan cahaya dari lensa menuju ke viewfinder'),
(2, 'Mirorrless', 'kamera yang pada dasarnya sama seperti kamera DSLR tapi tidak memakai cermin/pentaprisma. Mirrorless mempunyai banyak nama lain seperti Mirrorless Interchangeable-Lens Camera (MILC), Compact System Camera (CSC), Mirrorless System Camera (MSC), Digital Single Lens Mirrorless (DSLM).Ciri dari Mirrorless adalah ukurannya yang relatif kecil, beratnya yang ringan, lensa yang dapat diganti-ganti, hasil bidikan yang dihasilkan juga tidak jauh beda dengan DSLR, karena beberapa mirrorless ada yang sudah full format'),
(3, 'Kamera Analog', 'kamera fotografi yang menggunakan proses kimiawi untuk menangkap gambar, biasanya di atas kertas , film , atau hard plate . Proses analog ini adalah satu-satunya metode yang tersedia bagi fotografer selama lebih dari satu abad sebelum penemuan fotografi digital , yang menggunakan sensor elektronik untuk merekam gambar ke media digital'),
(4, 'Kamera Polaroid', 'kamera langsung jadi adalah model kamera yang dapat memproses foto sendiri di dalam badan kamera setelah dilakukan pemotretan. Kamera polaroid ini menggunakan film khusus yang dinamakan film polaroid. Film polaroid yang dapat menghasilkan gambar berwarna dinamakan film polacolor'),
(5, 'Action Kamera', 'kamera aksi merupakan kamera yang sering digunakan untuk mendukung aktivitas di luar ruan. Biasanya kamera ini lebih tahan lingkungan ekstrem dan bisa dibawa menyelam di dalam air');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_typebarang` (`id_typebarang`);

--
-- Indeks untuk tabel `tb_typebarang`
--
ALTER TABLE `tb_typebarang`
  ADD PRIMARY KEY (`id_typebarang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_typebarang`
--
ALTER TABLE `tb_typebarang`
  MODIFY `id_typebarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`id_typebarang`) REFERENCES `tb_typebarang` (`id_typebarang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
