<?php
session_start();
require "connect.php";

if (isset($_POST["submit"])) {
    $nama_pengguna = $_POST["nama_pengguna"];
    $kata_sandi = $_POST["kata_sandi"];

    $query = "SELECT * FROM users WHERE nama_pengguna = '$nama_pengguna'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($kata_sandi, $user['kata_sandi'])) {
            $_SESSION['login'] = true;
            $_SESSION['nama_pengguna'] = $user['nama_pengguna'];
            $_SESSION['role'] = $user['role'];

            echo "
            <script>
            alert('Login berhasil!');
            document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Nama pengguna atau kata sandi salah!');
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('Nama pengguna atau kata sandi salah!');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Masuk</title>
    <link rel="stylesheet" href="style/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="back-button">
        <a href="index.php">←</a>
    </div>
    <div class="container">
        <div class="login-card">
            <h1>Masuk</h1>
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" name="nama_pengguna" placeholder="Nama Pengguna" required>
                </div>
                <div class="input-group">
                    <input type="password" name="kata_sandi" placeholder="Kata Sandi" required>
                </div>
                <div class="forgot-password">
                    <a href="#">Lupa password?</a>
                </div>
                <button type="submit" name="submit" class="login-button">MASUK</button>
                <div class="register-link">
                    Belum punya akun? Buat di <a href="register.php">sini</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>