<?php
session_start();
require "connect.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'search') {
    $barang = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";
    $query = "SELECT * FROM barang";
    if (!empty($barang)) {
        $query .= " WHERE nama_barang LIKE '$barang%'";
    }
    $result = mysqli_query($conn, $query);

    $output = "";
    $no = 1;
    while ($barang = mysqli_fetch_assoc($result)) {
        $output .= "<tr>";
        $output .= "<td>" . $no++ . "</td>";
        $output .= "<td><img src='images/" . $barang['gambar'] . "' alt='Foto Barang' style='border: 2px solid black;' class='thumbnail' onclick='openPopup(this)'></td>";
        $output .= "<td>" . $barang['nama_barang'] . "</td>";
        $output .= "<td>" . $barang['deskripsi'] . "</td>";
        $output .= "<td>" . $barang['nama_pengguna'] . "</td>";
        $output .= "<td>Rp." . number_format($barang['harga'], 0, ',', '.') . "</td>";
        $output .= "<td>
                        <form method='POST' action='admin-hapus-barang.php' style='display: inline-block;'>
                            <input type='hidden' name='id_barang' value='" . $barang['id_barang'] . "'>
                            <button type='submit'><i class='ri-delete-bin-fill ri-2x'></i></button>
                        </form>
                    </td>";
        $output .= "</tr>";
    }
    echo $output;
    exit();
}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <p>&copy;Copyright 2024 UniThrift</p>
            </div>
        </div>
        <div class="content">
            <h2>Data Barang</h2>
            <div class="search-bar">
                <form id="search-form" method="GET" action="admin-data-barang.php">
                    <input type="text" id="search-input" name="search" placeholder="Cari Barang">
                    <button type="submit" class="btn"><i class="ri-search-line"></i></button>
                </form>
            </div>
            <div class="section">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto Barang</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Nama Penjual</th>
                                <th>Harga</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            $query = "SELECT * FROM barang";
                            $result = mysqli_query($conn, $query);
                            $no = 1;
                            while ($barang = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td><img src='images/" . $barang['gambar'] . "' alt='Foto Barang' style='border: 2px solid black;' class='thumbnail' onclick='openPopup(this)'>
                                        <div class='popup-overlay' onclick='closePopup()' style='display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8);'>
                                        <img id='popup-img' src='' alt='Popup Image' style='display: block; margin: auto; max-width: 90%; max-height: 90%;'>
                                        </div>
                                     </td>";
                                echo "<td>" . $barang['nama_barang'] . "</td>";
                                echo "<td>" . $barang['deskripsi'] . "</td>";
                                echo "<td>" . $barang['nama_pengguna'] . "</td>";
                                echo "<td>Rp." . number_format($barang['harga'], 0, ',', '.') . "</td>";
                                echo "<td>
                                        <form method='POST' action='admin-hapus-barang.php' style='display: inline-block;'>
                                            <input type='hidden' name='id_barang' value='" . $barang['id_barang'] . "'>
                                            <button type='submit'><i class='ri-delete-bin-fill ri-2x'></i></button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                let searchValue = $(this).val();
                $.ajax({
                    url: 'admin-data-barang.php',
                    type: 'GET',
                    data: { action: 'search', search: searchValue },
                    success: function(data) {
                        $('#table-body').html(data);
                    }
                });
            });
        });

        function openPopup(img) {
            const popupOverlay = document.querySelector('.popup-overlay');
            const popupImg = document.querySelector('#popup-img');
            popupImg.src = img.src;
            popupOverlay.style.display = 'block';
        }

        function closePopup() {
            const popupOverlay = document.querySelector('.popup-overlay');
            popupOverlay.style.display = 'none';
        }
    </script>
</body>
</html>
