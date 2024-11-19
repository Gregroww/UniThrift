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
            <a href="index.php">Beranda</a>
            <a href="tentang-kami.php">Tentang Kami</a>
            <?php if(isset($_SESSION['nama_pengguna'])): ?>
                <a href="logout.php">Keluar</a>
                <a href="sellpage.php" class="jual-btn">Jual</a>
                <a href="pageprofile.php">
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
        <img src="images/profilebanner.jpg" alt="Profile Banner">
      </div>
      <div class="background">
        <div class="profile-image-container">
            <!-- Menampilkan foto profil dari database -->
            <img src="images/<?php echo htmlspecialchars($user['foto_ktm']); ?>" alt="Foto Pengguna" class="profile-image">
            <div class="edit-icon">
                <button><i class="ri-pencil-line"> </i> </button>
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
</body>
<?php require "footer.php"; ?>
</html>