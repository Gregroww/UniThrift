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
    <title>Waiting List (Waiting)</title>
    <link rel="stylesheet" href="style/waitinglist.css">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
            <a href="tentang-kami.php">Tentang Kami</a>
            <?php if(isset($_SESSION['nama_pengguna'])): ?>
                <a href="logout.php">Keluar</a>
                <a href="" class="jual-btn">Jual</a>
                <a href="pageprofile(not-confirm).php">
                <img src="images/<?php echo $foto_ktm; ?>" alt="Foto Profil" class="foto-profil">
                </a>
            <?php endif; ?>
        </div>
    </nav>
    </header>
    <h1>STATUS PENGGUNA</h1>
<div class="modal-container">
    <div class="modal-box">
        <img src="images/time-left 1.png" alt="">
        <h3>PENGAJUAN PEMBUATAN<br> AKUN ANDA SEDANG<br> DIPROSES</h3>
        <a href="pageprofile(not-confirm).php">
        <button class="btn-home">KEMBALI KE PROFIL</button>
        </a>
    </div>
</div>
    <?php require "footer.php"; ?>
</body>
</html>