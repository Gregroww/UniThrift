<?php
session_start();
require "connect.php";
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
$query = "SELECT * FROM users WHERE status = 'approved'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data Penjual Page</title>
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
            <h2>Data Penjual</h2>
            <div class="search-bar">
                <input type="text" placeholder="Cari Barang">
                <button class="btn"><i class="ri-search-line"></i></button>
            </div>
            <div class="section">
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Email</th>
                            <th>Lokasi</th>
                            <th>Opsi</th>
                        </tr>
                        <?php
                        $no = 1;
                        while ($user = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $user['nama'] . "</td>";
                            echo "<td>" . $user['nama_pengguna'] . "</td>";
                            echo "<td>" . $user['no_hp'] . "</td>";
                            echo "<td>" . $user['email'] . "</td>";
                            echo "<td>" . $user['lokasi'] . "</td>";
                            echo "<td>    
                                    <form method='POST' action='admin-hapus-user.php' style='display: inline-block;'>
                                        <input type='hidden' name='nama_pengguna' value='" . $user['nama_pengguna'] . "'>
                                        <button type='submit' onclick='return confirmDelete()'><i class='ri-delete-bin-fill'></i></button>
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
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus akun ini?");
    }
    </script>
</body>
</html>
