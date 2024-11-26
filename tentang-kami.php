<?php
require 'connect.php';

$sql = "SELECT deskripsi FROM aboutus LIMIT 1";
$result = $conn->query($sql);

$deskripsi = "";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $deskripsi = $row['deskripsi'];
} else {
    $deskripsi = "Deskripsi belum tersedia.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Page</title>
    <link rel="stylesheet" href="style/aboutus.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
</head>
<body>
    <header>
        <?php require "navbar.php"; ?>
    </header>
    <div class="main-content">
        <div class="main-text">
            <h3>TENTANG KAMI</h3>
            <p>UniThrift Adalah Website Jual<br>
                Beli Barang Bekas Mahasiswa</p>
        </div>
        <img src="assets/image 13.png" alt="">
    </div>
    <div class="container">
        <div class="image-left">
            <img src="assets/image 15.png" alt="foto1">
        </div>
        <div class="text">
          <p><?php echo htmlspecialchars($deskripsi); ?></p>
        </div>
        <div class="image-right">
            <img src="assets/—Pngtree—online shopping isometric shopping cart_5324780 1.png" alt="foto2">
        </div>
    </div>
    <?php require "footer.php"; ?>
</body>
</html>
