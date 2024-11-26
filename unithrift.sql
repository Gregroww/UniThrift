-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 26 Nov 2024 pada 05.55
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
-- Database: `unithrift`
--
CREATE DATABASE IF NOT EXISTS `unithrift` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `unithrift`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aboutus`
--

CREATE TABLE `aboutus` (
  `foto1` varchar(255) NOT NULL,
  `foto2` varchar(255) NOT NULL,
  `foto3` varchar(255) NOT NULL,
  `deskripsi` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aboutus`
--

INSERT INTO `aboutus` (`foto1`, `foto2`, `foto3`, `deskripsi`) VALUES
('', '', '', 'ini deskripsi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kategori` enum('Wanita','Pria','Elektronik','Mainan','Gaming','Tas','Buku','Kecantikan','Kendaraan','Olahraga','Perabotan') NOT NULL,
  `nama_pengguna` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `deskripsi`, `gambar`, `kategori`, `nama_pengguna`) VALUES
(1, 'Honda Vario 125', 17500000, 'Motor ini gacor', 'Picture1.png', 'Kendaraan', 'aiman'),
(2, 'Laptop Lenovo V14-ADA 82C6', 3800000, 'Laptop Gaming', 'Picture2.png', 'Elektronik', 'aaa'),
(3, 'Iphone 12 64GB', 4000000, 'HP mewah ni bos', 'Picture3.png', 'Elektronik', 'aiman'),
(4, 'Berani Tidak Disukai (Novel)', 40000, 'Novel bagus', 'Picture4.png', 'Buku', 'aiman'),
(5, 'TV LED Sharp 32inch (Smart TV)', 1400000, 'TV masih keadaan mulus', 'Picture5.png', 'Elektronik', 'aiman'),
(6, 'Celana Hiking Uniqlo ori', 150000, 'ini celana bagus', 'Picture6.png', 'Pria', 'aiman'),
(7, 'Daihatsu Sigra', 98000000, 'Mobil rongsok', 'Picture7.png', 'Kendaraan', 'aiman'),
(8, 'Samsung Galaxy A13', 1235000, 'HP masih dalam keadaan mulus', 'Picture8.png', 'Elektronik', 'aaa'),
(9, 'Panasonic Lumix DMC-F3', 705000, 'Kamera HD bagus', 'Picture9.png', 'Elektronik', 'aaa'),
(10, 'Buku Filosofi Teras', 60000, 'Buku ini sangat bermanfaat', 'Picture10.png', 'Buku', 'aiman'),
(11, 'Redmi Note 13', 2000000, 'Minus pemakaian', 'Picture13.png', 'Elektronik', 'aiman'),
(12, 'iPhone 15', 13000000, 'Free casing', 'Picture14.png', 'Elektronik', 'aiman'),
(13, 'Iphone 16', 22000000, 'Minus pemakaian', '673ebbe5627e6.png', 'Elektronik', 'aiman'),
(14, 'qwerty', 5000, 'wasd', '6744e310e1d9f.png', 'Gaming', 'aiman'),
(15, 'qqq', 1000, 'qwerty', '6744e3391e8b6.png', 'Gaming', 'aiman'),
(16, 'cccc', 12345, 'cv', '6744e3588e68a.png', 'Pria', 'aiman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `location`
--

CREATE TABLE `location` (
  `kota` varchar(50) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `location`
--

INSERT INTO `location` (`kota`, `latitude`, `longitude`) VALUES
('Balikpapan', -1.269160, 116.828873),
('Samarinda', -0.502106, 117.153709);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `nama` varchar(50) NOT NULL,
  `nama_pengguna` varchar(20) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL,
  `foto_ktm` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nama`, `nama_pengguna`, `no_hp`, `email`, `kata_sandi`, `foto_ktm`, `role`, `lokasi`, `alamat`, `id_barang`, `status`) VALUES
('aaa', 'aaa', '123', 'user123@gmail.com', '$2y$10$Y2p6yqxau53qnZKANI9GmOKr.iATKdvEh9oKyu1YNIfNq/3jjvZeq', 'Cuplikan layar 2024-02-16 202255.png', 'user', 'Samarinda', '', NULL, 'approved'),
('aiman', 'aiman', '123', 'user@gmail.com', '$2y$10$GFp6WOnB.knPEvHMHIvzcu9GAWOcVU2h2iHod10y3ZIk1ZQ/9jHxq', 'Cuplikan layar 2024-02-17 220322.png', 'user', 'Balikpapan', '', NULL, 'approved'),
('fff', 'fff', '12345', 'user1@gmail.com', '$2y$10$z2M0BmHnN6j1PwLE2j7CXu53F0UOe7.JQtMLafPBWliS7C0c0.yM6', 'Cuplikan layar 2024-02-09 225744.png', 'user', 'Balikpapan', '', NULL, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_nama_pengguna` (`nama_pengguna`);

--
-- Indeks untuk tabel `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`kota`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nama_pengguna`),
  ADD KEY `fk_id_barang` (`id_barang`),
  ADD KEY `fk_lokasi_user` (`lokasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_nama_pengguna` FOREIGN KEY (`nama_pengguna`) REFERENCES `users` (`nama_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_lokasi_user` FOREIGN KEY (`lokasi`) REFERENCES `location` (`kota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
