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
        $sql_insert = "INSERT INTO aboutus (deskripsi) VALUES ('Deskripsi awal')";
        if ($conn->query($sql_insert) === TRUE) {
            $deskripsi = "Deskripsi awal";
        } else {
            die("Error inserting default data: " . $conn->error);
        }
    }
} else {
    die("Error executing SELECT query: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deskripsi'])) {
    $deskripsi = $_POST['deskripsi'];
    $sql_update = "UPDATE aboutus SET deskripsi = ?";
    $stmt = $conn->prepare($sql_update);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $deskripsi);

    if ($stmt->execute()) {
        echo "Perubahan berhasil disimpan!";
    } else {
        echo "Error updating data: " . $stmt->error;
    }
    $stmt->close();
    exit();
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
            <div class="section-about_us">
                <h2>UniThrift Website Jual Beli Barang Anda</h2>
                <textarea 
                    id="aboutUsDescription" 
                    name="deskripsi" 
                    rows="20" 
                    style="width: 100%; font-size: 16px; font-family: Arial, sans-serif;"
                    placeholder="Masukkan deskripsi tentang website Anda..."><?php echo htmlspecialchars($deskripsi); ?></textarea>
            </div>
            <div class="button-simpan">
                <button class="btn-simpan" onclick="saveChanges()">Simpan</button>
            </div>
        </div>
    </div>
    <script src="scripts/script.js"></script> 
    <script>
        function saveChanges() {
            const deskripsi = document.getElementById('aboutUsDescription').value;

            fetch('admin-tentang-kami.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'deskripsi=' + encodeURIComponent(deskripsi)
            })
            .then(response => response.text())
            .then(data => {
                alert('Perubahan berhasil disimpan!');
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan perubahan.');
            });
        }
    </script>
</body>
</html>
