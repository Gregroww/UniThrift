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
                <li><a href="admin-konfirmasi-akun.php"><i class="fas fa-box"></i> Konfirmasi Akun</a></li>
                <li><a href="admin-data-penjual.php"><i class="fas fa-box"></i> Data Penjual</a></li>
                <li><a href="admin-data-barang.php"><i class="fas fa-box"></i> Data Barang</a></li>
                <li><a href="admin-tentang-kami.php"><i class="fas fa-box"></i> Tentang Kami</a></li>
                <li><a href="keluar"><i class="fas fa-box"></i> Keluar</a></li>
            </ul>            
            <div class="footer">
                <p>&copy;Copyright 2024 UniThrift</p>
            </div>
        </div>
        <div class="content">
            <h2>Tentang Kami</h2>
            <div class="button-simpan">
                <button class="btn-simpan"><p>Simpan</p></button>
            </div>
            <div class="section-about_us" contenteditable="true">
                <h2>UniThrift
                    Website Jual Beli Barang Anda
                </h2>
                <p>Selamat datang di UniTrift, platform jual beli barang bekas khusus 
                    mahasiswa yang dirancang untuk memudahkan transaksi dalam 
                    komunitas kampus. UniTrift didirikan dengan tujuan untuk membantu 
                    mahasiswa menemukan kebutuhan mereka dengan harga terjangkau, 
                    sekaligus memberikan kesempatan bagi mahasiswa lainnya untuk 
                    menjual barang yang sudah tidak terpakai.</p>
            </div>
        </div>
    </div>
    <script src="scripts/script.js"></script> 
</body>
</html>
