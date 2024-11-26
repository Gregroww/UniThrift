<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['nama_pengguna'])) {
    header("Location: login.php");
    exit();
}

// Mendapatkan ID barang dari parameter GET
if (isset($_GET['id_barang'])) {
    $id_barang = intval($_GET['id_barang']);

    // Query untuk mendapatkan data barang berdasarkan ID
    $query = "SELECT * FROM barang WHERE id_barang = '$id_barang' AND nama_pengguna = '{$_SESSION['nama_pengguna']}'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Barang tidak ditemukan atau Anda tidak memiliki akses!'); window.location.href = 'index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID Barang tidak valid!'); window.location.href = 'index.php';</script>";
    exit();
}

// Proses update barang
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);

    // Cek apakah ada file gambar baru yang diunggah
    if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] == 0) {
        $file_tmp = $_FILES['foto_barang']['tmp_name'];
        $file_name = $_FILES['foto_barang']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_ext;
        $images_dir = 'images/';
        $file_path = $images_dir . $new_file_name;

        // Upload file baru
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Hapus file gambar lama
            if (file_exists("images/" . $product['gambar'])) {
                unlink("images/" . $product['gambar']);
            }

            $query = "UPDATE barang SET nama_barang = '$nama_barang', harga = '$harga', deskripsi = '$deskripsi', kategori = '$kategori', gambar = '$new_file_name' WHERE id_barang = '$id_barang'";
        } else {
            echo "<script>alert('Gagal mengunggah foto barang baru.');</script>";
        }
    } else {
        // Jika tidak ada gambar baru, hanya update data lainnya
        $query = "UPDATE barang SET nama_barang = '$nama_barang', harga = '$harga', deskripsi = '$deskripsi', kategori = '$kategori' WHERE id_barang = '$id_barang'";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Barang berhasil diupdate!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengupdate barang.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Barang</title>
    <link rel="stylesheet" href="style/updatebarang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
</head>
<body>
    <div class="container">
        <div class="title">Update Barang</div>
    </div>
    <div class="product-form">
        <div class="form-container">
            <div class="left-section">
                <form action="updatepage.php?id_barang=<?php echo $id_barang; ?>" method="POST" enctype="multipart/form-data">
                    <!-- Nama barang -->
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="input-field" value="<?php echo htmlspecialchars($product['nama_barang']); ?>" required>
                    </div>
                    <!-- Kategori -->
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="category-grid">
                            <?php
                            $categories = ['Wanita', 'Pria', 'Elektronik', 'Mainan', 'Gaming', 'Tas', 'Buku', 'Kecantikan', 'Kendaraan', 'Olahraga', 'Perabotan'];
                            foreach ($categories as $category) {
                                $checked = ($product['kategori'] == $category) ? 'checked' : '';
                                echo "
                                <div class='category-item'>
                                    <input type='radio' name='kategori' id='$category' value='$category' $checked>
                                    <label for='$category'>$category</label>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>
                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="input-field description" required><?php echo htmlspecialchars($product['deskripsi']); ?></textarea>
                    </div>

                    <!-- Harga -->
                    <div class="form-group">
                        <label>Harga</label>
                        <div class="price-input">
                            <span class="currency">Rp</span>
                            <input type="text" name="harga" class="input-field" value="<?php echo htmlspecialchars($product['harga']); ?>" required>
                        </div>
                    </div>

                    <!-- Foto barang -->
                    <div class="form-group">
                        <label for="inputImage">Foto Barang</label>
                        <div class="input-wrapper">
                            <input type="file" name="foto_barang" accept="image/*" class="input-field" id="inputImage">
                            <span class="file-name" id="file-name">Pilih foto baru (opsional)</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-button">Update</button>
                    <button type="button" class="submit-button-batal" onclick="window.location.href='index.php';">Batal</button>
                </form>
            </div>
            <div class="right-section">
                <label>Preview Foto Barang</label>
                <div class="image-upload">
                    <div class="image-preview">
                        <img id="previewImage" src="images/<?php echo htmlspecialchars($product['gambar']); ?>" alt="Preview">
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
            previewImage.src = "images/<?php echo htmlspecialchars($product['gambar']); ?>";
        }
    });
    </script>
</body>
</html>