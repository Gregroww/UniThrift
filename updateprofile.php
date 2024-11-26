<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['nama_pengguna'])) {
    header("Location: login.php");
    exit();
}

$nama_pengguna = $_SESSION['nama_pengguna'];

$query = $conn->prepare("SELECT * FROM users WHERE nama_pengguna = ?");
$query->bind_param("s", $nama_pengguna);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();


if (!$user) {
    echo "Pengguna tidak ditemukan.";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $location = $_POST['location'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $profile_picture = $user['foto_ktm'];
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $upload_dir = 'images/';
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_path = $upload_dir . basename($file_name);

        if (move_uploaded_file($file_tmp, $file_path)) {
            $profile_picture = $file_path;
        }
    }

    $update_query = $conn->prepare("UPDATE users SET nama = ?, lokasi = ?, alamat = ?, no_hp = ?, email = ?, foto_ktm = ? WHERE nama_pengguna = ?");
    $update_query->bind_param("sssssss", $name, $location, $address, $phone, $email, $profile_picture, $nama_pengguna);
    $update_query->execute();

    echo "Profile updated successfully!";
    header("Location: pageprofile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>
  <link rel="stylesheet" href="style/updateprofile.css">
</head>
<body>
    <div class="profile-update-form">
        <h2>Update Profile</h2>
        <form method="POST" enctype="multipart/form-data">
            <!-- Foto Profil -->
            <div class="form-group profile-picture-group">
                <label for="profilePicture">Foto Profil</label>
                <div class="profile-picture">
                    <img id="profileImage" src="images/<?php echo htmlspecialchars($user['foto_ktm']); ?>" alt="Foto Profil">
                </div>
                <input type="file" name="profile_picture" id="profilePicture" accept="image/*" onchange="previewImage(event)">
            </div>
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" value="<?= $user['nama']; ?>" placeholder="Masukkan nama Anda">
            </div>
            <div class="form-group">
                <label for="location">Lokasi</label>
                <input type="text" name="location" id="location" value="<?= $user['lokasi']; ?>" placeholder="Masukkan lokasi Anda">
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" name="address" id="address" value="<?= $user['alamat']; ?>" placeholder="Masukkan alamat Anda">
            </div>
            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="tel" name="phone" id="phone" value="<?= $user['no_hp']; ?>" placeholder="Masukkan nomor telepon">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= $user['email']; ?>" placeholder="Masukkan email Anda">
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
    <script>
    function previewImage(event) {
      const profileImage = document.getElementById('profileImage');
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          profileImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    }
    </script>
</body>
</html>
