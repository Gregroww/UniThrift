<?php
// navbar.php
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="UniThrift Logo">
        </div>
        
        <div class="search-container">
            <div class="input-wrapper">
                <input type="text" placeholder="Cari">
                <input type="text" placeholder="Kota">
                <button class="search-button">
                    🔍
            </button>
            </div>
        </div>
        
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="tentang-kami">Tentang Kami</a>
            <a href="register.php">Masuk</a>
        </div>
    </nav>
</body>
</html>