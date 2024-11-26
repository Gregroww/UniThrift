<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['nama_pengguna'])) {
    header("Location: login.php");
    exit;
}

$nama_pengguna = $_SESSION['nama_pengguna'];


$query = $conn->prepare("SELECT * FROM users WHERE nama_pengguna = ?");
$query->bind_param("s", $nama_pengguna);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Pengguna tidak ditemukan.";
    exit;
}

$queryBarang = $conn->prepare("SELECT * FROM barang WHERE nama_pengguna = ?");
$queryBarang->bind_param("s", $nama_pengguna);
$queryBarang->execute();
$resultBarang = $queryBarang->get_result();

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Pengguna - UniThrift</title>
  <link rel="stylesheet" href="style/pageprofile.css">
  <link rel="stylesheet" href="style/navbar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
</head>
<body>
<nav class="navbar">
        <div class="logo">
            <img src="assets/logo.png" alt="UniThrift Logo">
        </div>
        <div class="search-container">
            <form action="searchkategori.php" method="GET" class="input-wrapper">
                <input type="text" name="search" placeholder="Cari">
                <!-- <input type="text" name="lokasi" placeholder="Kota"> -->
                <select name="lokasi" class="search-kota">
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
                    <p class="fa-solid fa-magnifying-glass"></p>
                </button>
            </form>
        </div> 
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="tentang-kami.php">Tentang Kami</a>
            <?php if(isset($_SESSION['nama_pengguna'])): ?>
                <a href="logout.php">Keluar</a>
                <a href="sellpage.php" class="jual-btn no-hover">Jual</a>
                <a href="pageprofile.php" class="no-hover">
                    <img src="images/<?php echo htmlspecialchars($user['foto_ktm']); ?>" alt="Foto Profil" class="foto-profil">
                </a>
            <?php else: ?>
                <a href="login.php">Masuk</a>
            <?php endif; ?>
        </div>
    </nav>
  <!-- Main Content -->
  <main class="profile-container">
    <h1 class="profile-title">Profil Pengguna</h1>
    <div class="profile-card">
      <div class="profile-banner">
        <img src="assets/profilebanner.jpg" alt="Profile Banner">
      </div>
      <div class="background">
        <div class="profile-image-container">
            <!-- Menampilkan foto profil dari database -->
            <img src="images/<?php echo htmlspecialchars($user['foto_ktm']); ?>" alt="Foto Pengguna" class="profile-image">
            <div class="edit-icon">
                <a href="updateprofile.php">
                    <button><i class="ri-pencil-line"> </i></button>
                </a>
            </div>
        </div>
        <div class="profile-details">
            <div class="profile-menu">
                <!-- Menampilkan data pengguna dari database -->
                <h2 class="profile-name"><?php echo htmlspecialchars($user['nama']); ?></h2>
                <p class="profile-username"><?php echo htmlspecialchars($user['nama_pengguna']); ?></p>
                <p class="profile-location">
                    <i class="ri-map-pin-2-line"></i> <?php echo htmlspecialchars($user['lokasi']); ?>
                </p>
            </div>
            <div class="contact-info">
                <p>
                    <i class="ri-whatsapp-line"></i> <?php echo htmlspecialchars($user['no_hp']); ?>
                </p>
                <p>
                    <i class="ri-mail-line"></i> <?php echo htmlspecialchars($user['email']); ?>
                </p>
            </div>
        </div>        
      </div>
    </div>
    </main>
    <section class="product-section">
    <div class="product-container">
        <h2 class="product-title">Produk yang dijual</h2>
        <div class="product-grid">
            <?php while ($barang = $resultBarang->fetch_assoc()): ?>
                <div class="product-card">
                    <form action="productpage.php" method="GET">
                        <button type="submit" name="id" value="<?php echo htmlspecialchars($barang['id_barang']); ?>" class="product-link">
                            <img src="images/<?php echo htmlspecialchars($barang['gambar']); ?>" alt="<?php echo htmlspecialchars($barang['nama_barang']); ?>" class="product-image">
                            <h3 class="product-name"><?php echo htmlspecialchars($barang['nama_barang']); ?></h3>
                            <p class="product-price">Rp. <?php echo number_format($barang['harga'], 0, ',', '.'); ?></p>
                        </button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    </section>
</body>
<?php require "footer.php"; ?>
</html>