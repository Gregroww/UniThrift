<?php

require "connect.php";

$nama_pengguna = $_GET['nama_pengguna'];

if (!empty($nama_pengguna)) {
    $sql = "SELECT * FROM barang WHERE nama_pengguna = '$nama_pengguna'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    $foto_ktm = $user['foto_ktm'];
    $username = $user['nama_pengguna'];
    $lokasi = $user['lokasi'];
    $no_hp = $user['no_hp'];
    $email = $user['email'];


} else {
    echo "Nama pengguna tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Penjual</title>
    <link rel="stylesheet" href="style/contact.css">
</head>
<body>
    <header>
    <?php require "navbar.php"; ?>
    </header>

    <div class="card">
        <h2>Kontak Penjual</h2>
        
        <div class="grid-container">
            <div class="left-section">
                <div class="profile">
                    <div class="profile-image-wrapper">
                        <img src="assets/<?php echo $foto_ktm?>" alt="<?php echo $nama_pengguna; ?>" class="profile-image">
                    </div>
                    <h3><?php echo $nama_pengguna; ?></h3>
                    <div class="location">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>  
                        <?php echo htmlspecialchars($lokasi) ?>
                    </div>
                </div>

                <div class="contact-info">
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <?php echo htmlspecialchars($no_hp); ?>
                    </div>
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <?php echo htmlspecialchars($email); ?>
                    </div>
                </div>
            </div>

            <div class="right-section">
                <h4>Lokasi Penjual</h4>
                <div class="map-container">
                    <!-- Map container -->
                </div>
            </div>
        </div>
    </div>
    <?php require "footer.php"; ?>
</body>
</html>