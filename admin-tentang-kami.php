<?php
session_start();
require "connect.php";
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$deskripsi = "";

$sql = "SELECT deskripsi FROM aboutus LIMIT 1";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $deskripsi = $row['deskripsi'];
    } else {
        $deskripsi = "Deskripsi belum diatur.";
    }
} else {
    echo "Error executing query: " . $conn->error;
}

if (isset($_POST['deskripsi'])) {
    $deskripsi = $_POST['deskripsi'];

    $sql = "UPDATE aboutus SET deskripsi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $deskripsi);

    if ($stmt->execute()) {
        echo "Perubahan berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin About Us Page</title>
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
                <li><a href="admin-konfirmasi-akun.php"><i class="fa-solid fa-inbox"></i> Konfirmasi Akun</a></li>
                <li><a href="admin-data-penjual.php"><i class="fa-solid fa-user"></i> Data Penjual</a></li>
                <li><a href="admin-data-barang.php"><i class="fa-solid fa-cart-shopping"></i> Data Barang</a></li>
                <li><a href="admin-tentang-kami.php"><i class="fa-solid fa-question"></i> Tentang Kami</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a></li>
            </ul>          
            <div class="footer">
                <p>&copy; 2024 UniThrift</p>
            </div>
        </div>
        <div class="content">
            <h2>Tentang Kami</h2>
            <div class="section-about_us" id="aboutUsContent">
                <h2>UniThrift Website Jual Beli Barang Anda</h2>
                <form action="admin-tentang-kami.php" method="POST">
                    <textarea 
                        id="aboutUsDescription" 
                        name="deskripsi" 
                        rows="20" 
                        style="width: 100%; font-size: 16px; font-family: Arial, sans-serif;"
                        placeholder="Masukkan deskripsi tentang website Anda..."><?php echo htmlspecialchars($deskripsi); ?></textarea>
                </form>
            </div>
            <div class="button-simpan">
                <button class="btn-simpan" onclick="saveChanges()">Simpan</button>
            </div>
        </div>
    </div>
    <script src="scripts/script.js"></script> 
</body>
</html>