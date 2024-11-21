<?php
session_start();
require "connect.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST['action'])) {
    $namaPengguna = $_POST['nama_pengguna'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $updateQuery = "UPDATE users SET status = 'approved' WHERE nama_pengguna = '$namaPengguna'";
        mysqli_query($conn, $updateQuery);
    } elseif ($action === 'reject') {
        $deleteQuery = "DELETE FROM users WHERE nama_pengguna = '$namaPengguna'";
        mysqli_query($conn, $deleteQuery);
    }
}

$query = "SELECT * FROM users WHERE status = 'pending'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Confirmation Page</title>
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
                <li><a href="logout.php"><i class="fas fa-box"></i> Keluar</a></li>
            </ul>            
            <div class="footer">
                <p>&copy;Copyright 2024 UniThrift</p>
            </div>
        </div>
        <div class="content">
            <h2>Konfirmasi Akun</h2>
            <div class="section">
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Foto KTM</th>
                            <th>Nama Pengguna</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                        <?php
                        $no = 1;
                        while ($user = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td><img src='images/" . $user['foto_ktm'] . "' alt='KTM' width='50'style='border: 2px solid black; cursor: pointer;' class='thumbnail' onclick='openPopup(this)'>
                                    <div class='popup-overlay' onclick='closePopup()' style='display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8);'>
                                        <img id='popup-img' src='' alt='Popup Image' style='display: block; margin: auto; max-width: 90%; max-height: 90%;'>
                                    </div>
                                </td>";
                            echo "<td>" . $user['nama_pengguna'] . "</td>";
                            echo "<td>" . $user['nama'] . "</td>";
                            echo "<td>" . $user['no_hp'] . "</td>";
                            echo "<td>" . $user['email'] . "</td>";
                            echo "<td>
                                    <form method='POST' style='display: inline-block;'>
                                        <input type='hidden' name='nama_pengguna' value='" . $user['nama_pengguna'] . "'>
                                        <button type='submit' name='action' value='approve'><i class='ri-checkbox-line ri-3x'></i></button>
                                    </form>
                                    <form method='POST' style='display: inline-block;'>
                                        <input type='hidden' name='nama_pengguna' value='" . $user['nama_pengguna'] . "'>
                                        <button type='submit' name='action' value='reject'><i class='ri-close-fill ri-3x' style='color: red;'></i></button>
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
</body>
</html>
