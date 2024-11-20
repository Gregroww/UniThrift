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
<html>
<head>
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="UniThrift Logo">
        </div>
        
        <div class="search-container">
            <form action="searchkategori.php" method="GET" class="input-wrapper">
                <input type="text" name="search" placeholder="Cari">
                <!-- <input type="text" name="lokasi" placeholder="Kota"> -->
                <select name="kota" class="search-kota">
                    <option value="">Pilih Kota</option>
                    <option value="Ambon">Ambon</option>
                    <option value="Balikpapan">Balikpapan</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Banjarmasin">Banjarmasin</option>
                    <option value="Batam">Batam</option>
                    <option value="Bekasi">Bekasi</option>
                    <option value="Bengkulu">Bengkulu</option>
                    <option value="Bogor">Bogor</option>
                    <option value="Cirebon">Cirebon</option>
                    <option value="Denpasar">Denpasar</option>
                    <option value="Depok">Depok</option>
                    <option value="Gorontalo">Gorontalo</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Jambi">Jambi</option>
                    <option value="Jayapura">Jayapura</option>
                    <option value="Kediri">Kediri</option>
                    <option value="Kupang">Kupang</option>
                    <option value="Madiun">Madiun</option>
                    <option value="Magelang">Magelang</option>
                    <option value="Makassar">Makassar</option>
                    <option value="Malang">Malang</option>
                    <option value="Manado">Manado</option>
                    <option value="Mataram">Mataram</option>
                    <option value="Medan">Medan</option>
                    <option value="Padang">Padang</option>
                    <option value="Palembang">Palembang</option>
                    <option value="Palu">Palu</option>
                    <option value="Pekanbaru">Pekanbaru</option>
                    <option value="Pontianak">Pontianak</option>
                    <option value="Samarinda">Samarinda</option>
                    <option value="Semarang">Semarang</option>
                    <option value="Solo">Solo</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Tasikmalaya">Tasikmalaya</option>
                    <option value="Tegal">Tegal</option>
                    <option value="Yogyakarta">Yogyakarta</option>
                </select>
                <button type="submit" class="search-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div> 
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="tentang-kami.php">Tentang Kami</a>
            <?php if(isset($_SESSION['nama_pengguna'])): ?>
                <a href="logout.php">Keluar</a>
                <a href="sellpage.php" class="jual-btn">Jual</a>
                <a href="pageprofile.php">
                    <img src="assets/<?php echo $foto_ktm; ?>" alt="Foto Profil" class="foto-profil">
                </a>
            <?php else: ?>
                <a href="login.php">Masuk</a>
            <?php endif; ?>
        </div>
    </nav>
</body>
</html>