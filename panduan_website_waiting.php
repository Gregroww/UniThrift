<?php
session_start();
require 'connect.php';

if (isset($_SESSION['nama_pengguna'])) {
    $nama_pengguna = $_SESSION['nama_pengguna'];
    $query = "SELECT foto_ktm FROM users WHERE nama_pengguna = '$nama_pengguna'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $foto_ktm = $user['foto_ktm'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Guide Page</title>
    <link rel="stylesheet" href="style/websiteguide.css">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
</head>
<body>
    <header>
    <nav class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="UniThrift Logo">
        </div>
        <div class="search-container">
            <div class="input-wrapper">
                <input type="text" placeholder="Cari">
                <input type="text" placeholder="Kota">
                <button class="search-button">
                <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div> 
        <div class="nav-links">
            <a href="waiting_list1.php">Beranda</a>
            <a href="tentang-kami-waiting.php">Tentang Kami</a>
            <?php if(isset($_SESSION['nama_pengguna'])): ?>
                <a href="logout.php">Keluar</a>
                <a href="pageprofile(not-confirm).php">
                <img src="images/<?php echo $foto_ktm; ?>" alt="Foto Profil" class="foto-profil">
                </a>
            <?php endif; ?>
        </div>
    </nav>
    </header>
    <h1>PANDUAN WEBSITE</h1>
    <div class="container1">
        <div class="text">
            <h2>Cara Lihat Produk</h2>
            <p>Untuk melihat produk di UniThrift, Anda hanya perlu masuk ke halaman utama dan menjelajahi kategori yang tersedia. Gunakan fitur pencarian untuk menemukan kategori atau barang tertentu. Setiap produk dilengkapi dengan foto, deskripsi, dan informasi harga agar Anda dapat membuat keputusan yang tepat.</p>
        </div>
        <div class="gambar">
            <img src="images/image 17.png" alt="foto1">
        </div>
    </div>
    <div class="container2">
        <div class="text">
            <h2>Cara Beli Produk</h2>
            <p>Jika Anda tertarik untuk membeli produk, silakan klik pada item yang diinginkan untuk melihat deskripsi lebih lengkap atau detail spesifikasi. Apabila Anda memiliki pertanyaan lebih lanjut atau ingin mendapatkan informasi tambahan tentang produk tersebut, jangan ragu untuk langsung menghubungi penjual.</p>
        </div>
        <div class="gambar">
            <img src="images/Screenshot 2024-11-07 150943 1.png" alt="foto2">
        </div>
    </div>
    <div class="container3">
        <div class="text">
            <h2>Cara Jual Produk</h2>
            <p>Untuk menjual produk di UniThrift, pastikan Anda sudah memiliki akun. Masuk ke akun Anda dan pilih opsi 'Jual'. Isi formulir unggahan produk dengan lengkap, termasuk foto, deskripsi, harga, dan kondisi barang. Setelah semua informasi terisi, klik 'Jual'. Tim kami akan meninjau produk Anda sebelum tampil di website. Begitu disetujui, produk Anda akan tersedia untuk dilihat dan dibeli oleh pengguna lain.</p>
        </div>
        <div class="gambar">
            <img src="images/Screenshot 2024-11-07 190110 1.png" alt="foto3">
        </div>
    </div>
    <footer class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <img src="images/logo.png" alt="UniThrift Logo">
            <div class="footer-bottom">
                <p class="footer-text">Copyright © 2024 UniThrift. All rights reserved.</p>
                <div class="footer-links">
                    <a href="tentang-kami-waiting.php">Tentang Kami</a>
                    <a href="panduan_website_waiting.php">Panduan Website</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>