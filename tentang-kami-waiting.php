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
    <title>About Us Page</title>
    <link rel="stylesheet" href="style/aboutus.css">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
</head>
<body>
    <header>
    <nav class="navbar">
        <div class="logo">
            <img src="assets/logo.png" alt="UniThrift Logo">
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
            <a href="tentang-kami.php">Tentang Kami</a>
            <?php if(isset($_SESSION['nama_pengguna'])): ?>
                <a href="logout.php">Keluar</a>
                <a href="pageprofile(not-confirm).php">
                <img src="assets/<?php echo $foto_ktm; ?>" alt="Foto Profil" class="foto-profil">
                </a>
            <?php endif; ?>
        </div>
    </nav>
    </header>
    <div class="main-content">
        <div class="main-text">
            <h3>TENTANG KAMI</h3>
            <p>UniThrift Adalah Website Jual<br>
                Beli Barang Bekas Mahasiswa</p>
        </div>
        <img src="assets/image 13.png" alt="">
    </div>
    <div class="container">
        <div class="image-left">
            <img src="assets/image 15.png" alt="foto1">
        </div>
        <div class="text">
            <p>Selamat datang di Unithrift, platform jual beli barang bekas khusus mahasiswa yang dirancang
                untuk memudahkan transaksi dalam komunitas kampus.
                Unithrift didirikan dengan tujuan untuk membantu mahasiswa menemukan kebutuhan mereka dengan
                harga terjangkau,
                sekaligus memberikan kesempatan bagi mahasiswa lainnya untuk menjual barang yang sudah tidak
                terpakai.
            </p>
            <br>
            <p>Di UniTrift, setiap pengguna adalah seorang mahasiswa,
                sehingga Anda bisa membeli dan menjual barang dengan sesama rekan kampus.
                Kepercayaan dan keamanan adalah prioritas kami, maka dari itu, untuk mendaftar di UniTrift,
                setiap pengguna perlu mengonfirmasi status mahasiswa mereka dengan mengunggah kartu tanda
                mahasiswa.
            </p>
        </div>
        <div class="image-right">
            <img src="assets/—Pngtree—online shopping isometric shopping cart_5324780 1.png" alt="foto2">
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