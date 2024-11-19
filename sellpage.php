<?php
session_start();
require 'connect.php';

if (isset($_SESSION['nama_pengguna'])) {
    $nama_pengguna = $_SESSION['nama_pengguna'];

    // Query untuk mengambil data user berdasarkan nama_pengguna
    $query = "SELECT nama_pengguna, foto_ktm FROM users WHERE nama_pengguna = '$nama_pengguna'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $username = $user['nama_pengguna'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);

    if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] == 0) {
        $file_tmp = $_FILES['foto_barang']['tmp_name'];
        $file_name = $_FILES['foto_barang']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_ext;
        $images_dir = 'images/';
        $file_path = $images_dir . $new_file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            $query = "INSERT INTO barang (nama_barang, harga, deskripsi, gambar, kategori, nama_pengguna)
                      VALUES ('$nama_barang', '$harga', '$deskripsi', '$new_file_name', '$kategori', '$username')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Barang berhasil dijual!'); window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat menyimpan barang.');</script>";
            }
        } else {
            echo "<script>alert('Gagal mengunggah foto barang.');</script>";
        }
    } else {
        echo "<script>alert('Pilih foto barang terlebih dahulu.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form barang</title>
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
        <div class="title">Jual barang</div>
    </div>
    <div class="product-form">
        <div class="form-container">
            <div class="left-section">
                <form action="sellpage.php" method="POST" enctype="multipart/form-data">
                    <!-- Nama barang -->
                    <div class="form-group">
                        <label>Nama barang</label>
                        <input type="text" name="nama_barang" class="input-field" required>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="category-grid">
                            <!-- Daftar kategori -->
                            <div class="category-item">
                                <input type="radio" name="kategori" id="wanita" value="Wanita">
                                <label for="wanita">Wanita</label>
                                <input type="radio" name="kategori" id="pria" value="Pria">
                                <label for="pria">Pria</label>
                                <input type="radio" name="kategori" id="elektronik" value="Elektronik">
                                <label for="elektronik">Elektronik</label>
                                <input type="radio" name="kategori" id="mainan" value="Mainan">
                                <label for="mainan">Mainan</label>
                                <input type="radio" name="kategori" id="gaming" value="Gaming">
                                <label for="gaming">Gaming</label>
                                <input type="radio" name="kategori" id="tas" value="Tas">
                                <label for="tas">Tas</label>
                                <input type="radio" name="kategori" id="buku" value="Buku">
                                <label for="buku">Buku</label>
                                <input type="radio" name="kategori" id="kecantikan" value="Kecantikan">
                                <label for="kecantikan">Kecantikan</label>
                                <input type="radio" name="kategori" id="kendaraan" value="Kendaraan">
                                <label for="kendaraan">Kendaraan</label>
                                <input type="radio" name="kategori" id="olahraga" value="Olahraga">
                                <label for="olahraga">Olahraga</label>
                                <input type="radio" name="kategori" id="perabotan" value="Perabotan">
                                <label for="perabotan">Perabotan</label>
                            </div>
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
                        <select name="lokasi" class="input-field" >
                            <option value="">Pilih Lokasi</option>
                            <!-- Tambahkan opsi lokasi -->
                        </select>
                    </div>
                    <!-- Foto barang -->
                    <div class="form-group ">
                        <label>Foto barang</label>
                        <input type="file" name="foto_barang" accept="image/*" class="input-field" id="inputImage" required>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="submit-button">Jual</button>
                </form>
            </div>
            <div class="right-section">
                <label>Preview Foto barang</label>
                <div class="image-upload">
                    <div class="image-preview">
                        <img id="previewImage" src="product-image.jpg" alt="Preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const inputImage = document.getElementById('inputImage'); 
    const previewImage = document.getElementById('previewImage');
    inputImage.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            previewImage.src = "product-image.jpg";
        }
    });
</script>
</body>
</html>
