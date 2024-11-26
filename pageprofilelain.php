<?php
session_start();
require 'connect.php';

$User = null;
if (isset($_SESSION['nama_pengguna'])) {
    $sql_user = "SELECT * FROM users WHERE nama_pengguna = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("s", $_SESSION['nama_pengguna']);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $User = $result_user->fetch_assoc();
}

$viewedUser = null;
$nama_pengguna = $_GET['nama_pengguna'] ?? '';
if (!empty($nama_pengguna)) {
    $sql_viewed_user = "SELECT * FROM users WHERE nama_pengguna = ?";
    $stmt_viewed_user = $conn->prepare($sql_viewed_user);
    $stmt_viewed_user->bind_param("s", $nama_pengguna);
    $stmt_viewed_user->execute();
    $result_viewed_user = $stmt_viewed_user->get_result();
    $viewedUser = $result_viewed_user->fetch_assoc();
}

if (!$viewedUser) {
    echo "Pengguna tidak ditemukan.";
    exit;
}

$foto_ktm = $viewedUser['foto_ktm'] ?: 'default.jpg';
$nama = $viewedUser['nama'];
$lokasi = $viewedUser['lokasi'];
$no_hp = $viewedUser['no_hp'];
$email = $viewedUser['email'];
$nama_pengguna = $viewedUser['nama_pengguna'];

$sql_products = "SELECT * FROM barang WHERE nama_pengguna = ?";
$stmt_products = $conn->prepare($sql_products);
$stmt_products->bind_param("s", $nama_pengguna);
$stmt_products->execute();
$result_products = $stmt_products->get_result();
$products = $result_products->fetch_all(MYSQLI_ASSOC);
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
        <?php if ($User): ?>
            <a href="logout.php">Keluar</a>
            <a href="sellpage.php" class="jual-btn">Jual</a>
            <a href="pageprofile.php?nama_pengguna=<?php echo htmlspecialchars($User['nama_pengguna']); ?>">
                <img src="images/<?php echo htmlspecialchars($User['foto_ktm']); ?>" alt="Foto Profil" class="foto-profil">
            </a>
        <?php else: ?>
            <a href="login.php">Masuk</a>
        <?php endif; ?>
    </div>
</nav>

<main class="profile-container">
    <h1 class="profile-title">Profil Pengguna</h1>
    <div class="profile-card">
        <div class="profile-banner">
            <img src="assets/profilebanner.jpg" alt="Profile Banner">
        </div>
        <div class="background">
            <div class="profile-image-container">
                <img src="images/<?php echo htmlspecialchars($foto_ktm); ?>" alt="Foto Profil" class="profile-image">
            </div>
            <div class="profile-details">
                <div class="profile-menu">
                    <h2 class="profile-name"><?php echo htmlspecialchars($nama); ?></h2>
                    <p class="profile-username"><?php echo htmlspecialchars($nama_pengguna); ?></p>
                    <p class="profile-location">
                        <i class="ri-map-pin-2-line"></i> <?php echo htmlspecialchars($lokasi); ?>
                    </p>
                </div>
                <div class="contact-info">
                    <p>
                        <i class="ri-whatsapp-line"></i> <?php echo htmlspecialchars($no_hp); ?>
                    </p>
                    <p>
                        <i class="ri-mail-line"></i> <?php echo htmlspecialchars($email); ?>
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
            <?php foreach ($products as $product): ?>
                <article class="product-card">
                    <a href="productpage.php?id=<?php echo $product['id_barang']; ?>" class="product-link">
                        <img src="images/<?php echo htmlspecialchars($product['gambar']); ?>" alt="<?php echo htmlspecialchars($product['nama_barang']); ?>" class="product-image">
                    </a>
                    <h3 class="product-name"><?php echo htmlspecialchars($product['nama_barang']); ?></h3>
                    <p class="product-price">Rp. <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require 'footer.php'; ?>
</body>
</html>
