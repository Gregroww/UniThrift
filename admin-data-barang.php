<?php
session_start();
require "connect.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Query untuk mengambil data semua barang dari tabel barang
$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data Barang</title>
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
</head>
<body>
    <div class="header">
        <div class="header-logo">
            <img src="assets/logo.png" alt="UniThrift" width="140" height="70">
        </div>
        <div class="header-admin">
            <p>Admin</p>
        </div>
    </div>
    <div class="main-container">
        <div class="sidebar">
            <ul>
                <li><a href="admin-konfirmasi-akun.php"><i class="fas fa-box"></i> Konfirmasi Akun</a></li>
                <li><a href="admin-data-penjual.php"><i class="fas fa-box"></i> Data Penjual</a></li>
                <li><a href="admin-data-barang.php"><i class="fas fa-box"></i> Data Barang</a></li>
                <li><a href="admin-tentang-kami.php"><i class="fas fa-box"></i> Tentang Kami</a></li>
                <li><a href="index.php"><i class="fas fa-box"></i> Keluar</a></li>
            </ul>            
            <div class="footer">
                <p>&copy;Copyright 2024 UniThrift</p>
            </div>
        </div>
        <div class="content">
            <h2>Data Barang</h2>
            <div class="section">
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Foto Barang</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Nama Penjual</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                        <?php
                        $no = 1;
                        while ($barang = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td><img src='images/" . $barang['foto_barang'] . "' alt='Foto Barang' style='border: 2px solid black;' class='thumbnail' onclick='openPopup(this)'></td>";
                            echo "<td>" . $barang['nama_barang'] . "</td>";
                            echo "<td>" . $barang['deskripsi'] . "</td>";
                            echo "<td>" . $barang['nama_penjual'] . "</td>";
                            echo "<td>Rp." . number_format($barang['harga'], 0, ',', '.') . "</td>";
                            echo "<td>
                                    <form method='POST' action='delete-barang.php' style='display: inline-block;'>
                                        <input type='hidden' name='id_barang' value='" . $barang['id'] . "'>
                                        <button type='submit'><i class='ri-delete-bin-fill'></i></button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/script.js"></script>
    <script>
        // Fungsi untuk membuka gambar dalam ukuran besar
        function openPopup(img) {
            document.getElementById("popup-img").src = img.src;
            document.querySelector(".popup-overlay").style.display = "flex";
        }
        function closePopup() {
            document.querySelector(".popup-overlay").style.display = "none";
        }
    </script>
</body>
</html>
