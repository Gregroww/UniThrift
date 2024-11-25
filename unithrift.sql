-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 25 Nov 2024 pada 12.03
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
-- Database: unithrift
--
CREATE DATABASE IF NOT EXISTS unithrift DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE unithrift;

-- --------------------------------------------------------

--
-- Struktur dari tabel aboutus
--

CREATE TABLE aboutus (
  foto1 varchar(255) NOT NULL,
  foto2 varchar(255) NOT NULL,
  foto3 varchar(255) NOT NULL,
  deskripsi varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel barang
--

CREATE TABLE barang (
  id_barang int(11) NOT NULL,
  nama_barang varchar(255) NOT NULL,
  harga int(11) NOT NULL,
  deskripsi varchar(255) NOT NULL,
  gambar varchar(255) NOT NULL,
  kategori enum('Wanita','Pria','Elektronik','Mainan','Gaming','Tas','Buku','Kecantikan','Kendaraan','Olahraga','Perabotan') NOT NULL,
  nama_pengguna varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel barang
--

INSERT INTO barang (id_barang, nama_barang, harga, deskripsi, gambar, kategori, nama_pengguna) VALUES
(1, 'Honda Vario 125', 17500000, 'Motor ini gacor', 'Picture1.png', 'Kendaraan', 'rafly'),
(2, 'Laptop Lenovo V14-ADA 82C6', 3800000, 'Laptop Gaming', 'Picture2.png', 'Elektronik', 'rafly'),
(3, 'Iphone 12 64GB', 4000000, 'HP mewah ni bos', 'Picture3.png', 'Elektronik', 'cel'),
(4, 'Berani Tidak Disukai (Novel)', 40000, 'Novel bagus', 'Picture4.png', 'Buku', 'rafly'),
(5, 'TV LED Sharp 32inch (Smart TV)', 1400000, 'TV masih keadaan mulus', 'Picture5.png', 'Elektronik', 'rafly'),
(6, 'Celana Hiking Uniqlo ori', 150000, 'ini celana bagus', 'Picture6.png', 'Pria', 'rafly'),
(7, 'Daihatsu Sigra', 98000000, 'Mobil bagus ini', 'Picture7.png', 'Kendaraan', 'cel'),
(8, 'Samsung Galaxy A13', 1235000, 'HP masih dalam keadaan mulus', 'Picture8.png', 'Elektronik', 'rafly'),
(9, 'Panasonic Lumix DMC-F3', 705000, 'Kamera HD bagus', 'Picture9.png', 'Elektronik', 'rafly'),
(10, 'Buku Filosofi Teras', 60000, 'Buku ini sangat bermanfaat', 'Picture10.png', 'Buku', 'rafly'),
(11, 'Redmi Note 13', 2000000, 'Minus pemakaian', 'Picture13.png', 'Elektronik', 'cel'),
(12, 'iPhone 15', 13000000, 'Free casing', 'Picture14.png', 'Elektronik', 'cel'),
(13, 'Iphone 16', 22000000, 'Minus pemakaian', '673ebbe5627e6.png', 'Elektronik', 'cel');

-- --------------------------------------------------------

--
-- Struktur dari tabel users
--

CREATE TABLE users (
  nama varchar(50) NOT NULL,
  nama_pengguna varchar(20) NOT NULL,
  no_hp varchar(15) NOT NULL,
  email varchar(50) NOT NULL,
  kata_sandi varchar(255) NOT NULL,
  foto_ktm varchar(255) NOT NULL,
  role varchar(10) DEFAULT NULL,
  lokasi varchar(255) DEFAULT NULL,
  id_barang int(11) DEFAULT NULL,
  status enum('pending','approved','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel users
--

INSERT INTO users (nama, nama_pengguna, no_hp, email, kata_sandi, foto_ktm, role, lokasi, id_barang, status) VALUES
('cel', 'cel', '123', 'celio@gmail.com', '$2y$10$PZXY6DRVss/HpC6oLv1swujOXGQPGca1ZN2iUPuS6c6oAoKLB1ye6', 'profil.png', 'user', 'Balikpapan', NULL, 'approved'),
('q', 'q', '1', 'dddddd@gmail.com', '$2y$10$d6uCitiVcZ8.XrdOLfRNSecZFntUQZFZho.fKt2fPSeTNgqS6gwsu', 'Screenshot 2024-11-12 113947.png', 'user', '', NULL, 'pending'),
('rafly', 'rafly', '123', 'rafly@gmail.com', '$2y$10$zToXUhBAqV3FPZZ83z2D4.gwIHTOQf6IsxBsyHdS2Xj9wrwTF49Cu', 'foto_profil.jpg', 'user', 'Samarinda', NULL, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel barang
--
ALTER TABLE barang
  ADD PRIMARY KEY (id_barang),
  ADD KEY fk_nama_pengguna (nama_pengguna);

--
-- Indeks untuk tabel users
--
ALTER TABLE users
  ADD PRIMARY KEY (nama_pengguna),
  ADD KEY fk_id_barang (id_barang);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel barang
--
ALTER TABLE barang
  MODIFY id_barang int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel barang
--
ALTER TABLE barang
  ADD CONSTRAINT fk_nama_pengguna FOREIGN KEY (nama_pengguna) REFERENCES users (nama_pengguna) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel users
--
ALTER TABLE users
  ADD CONSTRAINT fk_id_barang FOREIGN KEY (id_barang) REFERENCES barang (id_barang) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;