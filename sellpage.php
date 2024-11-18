<?php
session_start();
require 'connect.php';

if (isset($_SESSION['nama_pengguna'])) {
    $nama_pengguna = $_SESSION['nama_pengguna'];

    // Query untuk mengambil data pengguna, misalnya foto atau ID pengguna
    $query = "SELECT nama_pengguna, foto_ktm FROM users WHERE nama_pengguna = '$nama_pengguna'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $username = $user['nama_pengguna'];
    $foto_ktm = $user['foto_ktm'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Produk</title>
    <link rel="stylesheet" href="style/sellpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
</head>
<body>
    <div class="container">
        <a href="index.php">
        <div class="back-icon">
            <button><i class="ri-arrow-go-back-fill"></i> </button>
        </div>
        </a>
        <div class="title">Jual Produk</div>
    </div>
    <div class="product-form">
        <div class="form-container">
            <div class="left-section">
                <form action="proses_jual_produk.php" method="POST" enctype="multipart/form-data">
                    <!-- Nama Produk -->
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="input-field" required>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="category-grid">
                            <!-- Daftar kategori -->
                            <div class="category-item">
                                <input type="radio" name="category" id="gaming" value="Gaming">
                                <label for="gaming">Gaming</label>
                            </div>
                            <!-- Tambahkan kategori lainnya sesuai kebutuhan -->
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="input-field description" required></textarea>
                    </div>

                    <!-- Harga -->
                    <div class="form-group">
                        <label>Harga</label>
                        <div class="price-input">
                            <span class="currency">Rp</span>
                            <input type="text" name="harga" class="input-field" required>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="form-group">
                        <label>Lokasi</label>
                        <select name="lokasi" class="input-field" required>
                            <option value="">Pilih Lokasi</option>
                            <!-- Tambahkan opsi lokasi -->
                        </select>
                    </div>

                    <!-- Foto Produk -->
                    <div class="form-group">
                        <label>Foto Produk</label>
                        <input type="file" name="foto_produk" accept="image/*" class="input-field" required>
                    </div>

                    <!-- Hidden input untuk menyimpan user ID -->
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                    <!-- Submit Button -->
                    <button type="submit" class="submit-button">Jual</button>
                </form>
            </div>

            <div class="right-section">
                <label>Preview Foto Produk</label>
                <div class="image-upload">
                    <div class="upload-placeholder">
                        <i class="ri-image-add-line"></i>
                    </div>
                    <div class="image-preview">
                        <img src="product-image.jpg" alt="Preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
