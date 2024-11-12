<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Masuk</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="back-button">
        <a href="#">←</a>
    </div>
    <div class="container">
        <div class="login-card">
            <h1>Masuk</h1>
            <form action="process.php" method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Nama Pengguna" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                </div>
                <button type="submit" class="login-button">MASUK</button>
                <div class="forgot-password">
                    <a href="#">Lupa password?</a>
                </div>
                <div class="register-link">
                    Belum punya akun? Buat di <a href="#">sini</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>