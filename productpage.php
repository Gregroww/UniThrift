<?php
require "connect.php";

$id_brg = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_brg > 0) {
    $query = "SELECT barang.*, users.foto_ktm, users.lokasi FROM barang JOIN users ON barang.nama_pengguna = users.nama_pengguna WHERE barang.id_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_brg);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Barang tidak ditemukan.";
        exit;
    }
} else {
    echo "ID barang tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="style/product.css">
</head>
<body>
    <header>
        <?php require "navbar.php"; ?>
    </header>
    <div class="container">
        <div class="product-card">
            <div class="product-grid">
                <!-- Bagian Kiri: Gambar Produk dan Profil Penjual -->
                <div class="left-section">
                    <div class="image-container">
                        <img src="images/<?php echo htmlspecialchars($product['gambar']); ?>" 
                            alt="<?php echo htmlspecialchars($product['nama_barang']); ?>" 
                            class="product-image">
                    </div>
                    <!-- Profil Penjual -->
                    <?php if (isset($_SESSION['nama_pengguna']) && $product['nama_pengguna'] === $_SESSION['nama_pengguna']): ?>
                        <a href="pageprofile.php?nama_pengguna=<?php echo urlencode($product['nama_pengguna']); ?>" class="seller-info">
                            <div class="profile">
                                <div class="avatar-container">  
                                <img class="seller-avatar" src="images/<?php echo htmlspecialchars($product['foto_ktm']); ?>" 
                                    alt="<?php echo htmlspecialchars($product['nama_pengguna']); ?>">
                                </div>
                                <span class="seller-name"><?php echo htmlspecialchars($product['nama_pengguna']); ?></span>
                            </div>
                        </a>
                    <?php elseif (isset($_SESSION['nama_pengguna'])): ?>
                        <a href="pageprofilelain.php?nama_pengguna=<?php echo urlencode($product['nama_pengguna']); ?>" class="seller-info">
                            <div class="profile">
                                <div class="avatar-container">  
                                <img class="seller-avatar" src="images/<?php echo htmlspecialchars($product['foto_ktm']); ?>" 
                                    alt="<?php echo htmlspecialchars($product['nama_pengguna']); ?>">
                                </div>
                                <span class="seller-name"><?php echo htmlspecialchars($product['nama_pengguna']); ?></span>
                            </div>
                        </a>
                    <?php else: ?>
                        <a href="pageprofilelain.php?nama_pengguna=<?php echo urlencode($product['nama_pengguna']); ?>" class="seller-info">
                            <div class="profile">
                                <div class="avatar-container">  
                                <img class="seller-avatar" src="images/<?php echo htmlspecialchars($product['foto_ktm']); ?>" 
                                    alt="<?php echo htmlspecialchars($product['nama_pengguna']); ?>">
                                </div>
                                <span class="seller-name"><?php echo htmlspecialchars($product['nama_pengguna']); ?></span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
                <!-- Bagian Kanan -->
                <div class="right-section">
                    <div class="top-section">
                        <div class="date"><?php echo date("d M Y"); ?></div>
                        <div class="title-section">
                            <h1><?php echo htmlspecialchars($product['nama_barang']); ?></h1>
                            <div class="price">Rp. <?php echo number_format($product['harga'], 0, ',', '.'); ?></div>
                        </div>
                        <!-- If-Else untuk Tombol Edit atau Hubungi Penjual -->
                        <?php if (isset($_SESSION['nama_pengguna']) && $product['nama_pengguna'] === $_SESSION['nama_pengguna']): ?>
                            <!-- Tombol Edit Barang jika milik user -->
                            <form action="updatebarang.php" method="get" style="margin-top: 10px;">
                                <input type="hidden" name="id_barang" value="<?php echo intval($product['id_barang']); ?>">
                                <button type="submit" class="edit-button">Edit Barang</button>
                                <button type="button" class="delete-button" onclick="confirmDeletion(<?php echo $product['id_barang']; ?>)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        <?php elseif (isset($_SESSION['nama_pengguna'])): ?>
                            <!-- Tombol Hubungi Penjual jika bukan milik user -->
                            <form action="contactseller.php" method="get">
                                <input type="hidden" name="nama_pengguna" value="<?php echo htmlspecialchars($product['nama_pengguna']); ?>">
                                <button type="submit" class="contact-button">Hubungi Penjual</button>
                            </form>
                        <?php else: ?>
                            <!-- Tombol Hubungi Penjual jika pengguna belum login -->
                            <form action="contactseller.php" method="get">
                                <input type="hidden" name="nama_pengguna" value="<?php echo htmlspecialchars($product['nama_pengguna']); ?>">
                                <button type="submit" class="contact-button">Hubungi Penjual</button>
                            </form>
                        <?php endif; ?>
                        <div class="category">
                            <h2>Kategori</h2>
                            <div class="tags">
                                <a href="searchkategori.php?search=<?php echo urlencode($product['kategori']); ?>" class="tag">#<?php echo htmlspecialchars($product['kategori']); ?></a>
                            </div>
                        </div>
                    </div>
                    <!-- Deskripsi Produk -->
                    <div class="description">
                        <h2>Deskripsi Produk</h2>
                        <p><?php echo htmlspecialchars($product['deskripsi']); ?></p>
                        <div class="location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <?php echo htmlspecialchars($product['lokasi']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php require "footer.php"; ?>

    <script>
    function confirmDeletion(id) {
        const confirmation = confirm("Apakah Anda yakin ingin menghapus barang ini?");
        if (confirmation) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'hapus-barang-user.php';

            const idField = document.createElement('input');
            idField.type = 'hidden';
            idField.name = 'id_barang';
            idField.value = id;

            form.appendChild(idField);
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>
</body>
</html>