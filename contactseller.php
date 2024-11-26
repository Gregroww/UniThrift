<?php
require "connect.php";

$penjual_nama_pengguna = $_GET['nama_pengguna'] ?? '';

if (empty($penjual_nama_pengguna)) {
    echo "Nama pengguna tidak valid.";
    exit;
}

$sql = "SELECT * FROM users WHERE nama_pengguna = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $penjual_nama_pengguna);

$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


if ($user) {
    $foto_ktm = $user['foto_ktm'];
    $penjual_nama_pengguna = $user['nama_pengguna'];
    $lokasi = $user['lokasi'];
    $no_hp = $user['no_hp'];
    $email = $user['email'];
    $alamat = $user['alamat'];
    $foto_path = "images/" . htmlspecialchars($foto_ktm);
    if (!file_exists($foto_path)) {
        $foto_path = "images/default.jpg";
    }
} else {
    echo "Data pengguna tidak ditemukan.";
    exit;
}

if (empty($lokasi)) {
    $lokasi = "Alamat tidak tersedia.";
}

$sql = "SELECT location.latitude, location.longitude 
    FROM users 
    JOIN location ON users.lokasi = location.kota 
    WHERE users.nama_pengguna = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $penjual_nama_pengguna);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];
} else {
    $latitude = 0;
    $longitude = 0;
}

$stmt->close();
$conn->close();

$map_url = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127150.123456789!2d" . $longitude . "!3d" . $latitude . "!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df1467e22f1381fdd%3A0x5c64a9baf16e2da8!2s" . urlencode($lokasi) . "!5e0!3m2!1sen!2sid!4v1699999999999";
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Penjual</title>
    <link rel="stylesheet" href="style/contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <?php require "navbar.php"; ?>
    </header>
    <div class="card">
        <div class="grid-container">
    
            <div class="left-section">
                <div class="profile">
                    <div class="profile-image-wrapper">
                        <a href="pageprofilelain.php?nama_pengguna=<?php echo urlencode($penjual_nama_pengguna); ?>">
                            <img src="<?php echo $foto_path; ?>" 
                                alt="Foto profil <?php echo htmlspecialchars($penjual_nama_pengguna); ?>" 
                                class="profile-image">
                        </a>
                    </div>
                    <h3><?php echo htmlspecialchars($penjual_nama_pengguna); ?></h3>
                </div>
    
                <div class="contact-container">
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <?php echo htmlspecialchars($lokasi); ?>
                    </div>
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
                <div class="location-detail">
                    <h4>Detail Alamat</h4>
                    <p><?php echo htmlspecialchars($alamat); ?></p>
                </div>
            </div>
        
            <div class="right-section">
                <div class="map-container">
                    <iframe 
                        src="<?php echo $map_url; ?>" 
                        width="100%" 
                        height="100%" 
                        style="border: 0; border-top-right-radius: 20px; border-bottom-right-radius: 20px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    <?php require "footer.php"; ?>
</body>
</html>
