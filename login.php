<?php
session_start();
require "connect.php";

if (isset($_POST["submit"])) {
    $nama_pengguna = $_POST["nama_pengguna"];
    $kata_sandi = $_POST["kata_sandi"];
    $usernameadmin = 'admin';
    $passwordadmin = 'admin';

    // Cek apakah login sebagai admin
    if ($nama_pengguna === $usernameadmin && $kata_sandi === $passwordadmin) {
        $_SESSION['username'] = $usernameadmin;
        $_SESSION['login'] = true;
        $_SESSION['admin'] = true;
        
        echo "<script>
                alert('Login berhasil sebagai Admin! Selamat datang $usernameadmin');
                document.location.href = 'admin-konfirmasi-akun.php';
              </script>";
        exit;
    }

    $query = "SELECT * FROM users WHERE nama_pengguna = '$nama_pengguna'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Cek password dan status akun
        if (password_verify($kata_sandi, $user['kata_sandi'])) {
            if ($user['status'] === 'approved') {
                $_SESSION['login'] = true;
                $_SESSION['nama_pengguna'] = $user['nama_pengguna'];
                $_SESSION['role'] = $user['role'];

                echo "<script>
                        alert('Login berhasil!');
                        document.location.href = 'index.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Akun Anda masih menunggu persetujuan admin.');
                        document.location.href = 'login.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Nama pengguna atau kata sandi salah!');
                    document.location.href = 'login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Nama pengguna atau kata sandi salah!');
                document.location.href = 'login.php';
              </script>";
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
