<?php
require "connect.php";
if (isset($_POST["submit"])) {
    $nama = $_POST['nama'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $kata_sandi = password_hash($_POST['kata_sandi'], PASSWORD_DEFAULT);
    $foto_ktm = $_FILES['foto_ktm']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($foto_ktm);
    $role = 'user';

    $checkQuery = "SELECT * FROM users WHERE nama_pengguna = '$nama_pengguna'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "
        <script>
        alert('nama_pengguna sudah digunakan! Silakan gunakan nama_pengguna lain.');
        document.location.href = 'register.php';
        </script>
        ";
    } else {
        if (move_uploaded_file($_FILES['foto_ktm']['tmp_name'], $target_file)) {
            $query = "INSERT INTO users (nama, nama_pengguna, no_hp, email, kata_sandi, foto_ktm, role) VALUES ('$nama', '$nama_pengguna', '$no_hp', '$email', '$kata_sandi', '$foto_ktm', '$role')";
            if (mysqli_query($conn, $query)) {
                echo "
                <script>
                alert('Registrasi berhasil!');
                document.location.href = 'login.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Registrasi gagal!');
                document.location.href = 'register.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
            alert('Gagal mengunggah file!');
            document.location.href = 'register.php';
            </script>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="back-button">
        <a href="index.php">←</a>
    </div>
    <div class="container">
        <div class="login-card">
            <h1>Registrasi</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="text" name="nama" placeholder="Nama" required>
                </div>
                <div class="input-group">
                    <input type="text" name="nama_pengguna" placeholder="Nama Pengguna" required>
                </div>
                <div class="input-group">
                    <input type="tel" name="no_hp" placeholder="Nomor Telepon" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="kata_sandi" placeholder="Kata Sandi" required>
                </div>
                <div class="input-group file-input">
                    <input type="text" placeholder="Unggah Kartu Mahasiswa" readonly>
                    <label for="student-card" class="file-label">UNGGAH FILE</label>
                    <input type="file" id="student-card" name="foto_ktm" class="hidden-file-input" required>
                </div>
                <button type="submit" name="submit" class="login-button">REGISTRASI</button>
                <div class="register-link">
                    Sudah punya akun? Masuk di <a href="login.php">sini</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>