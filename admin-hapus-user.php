<?php
session_start();
require "connect.php";
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST['nama_pengguna'])) {
    $nama_pengguna = $_POST['nama_pengguna'];
    $query = "DELETE FROM users WHERE nama_pengguna = '$nama_pengguna'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Akun berhasil dihapus!'); window.location.href = 'admin-konfirmasi-akun.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus akun.'); window.location.href = 'admin-konfirmasi-akun.php';</script>";
    }
} else {
    echo "<script>alert('Data tidak valid!'); window.location.href = 'admin-konfirmasi-akun.php';</script>";
}
?>