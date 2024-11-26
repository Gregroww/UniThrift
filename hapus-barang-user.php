<?php
session_start();
require 'connect.php';

// Cek apakah user sudah login
if (!isset($_SESSION['nama_pengguna'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['id_barang'])) {
    $id_barang = mysqli_real_escape_string($conn, $_POST['id_barang']);
    $nama_pengguna = $_SESSION['nama_pengguna'];

    // Cek apakah barang milik user yang sedang login
    $check_query = "SELECT * FROM barang WHERE id_barang = '$id_barang' AND nama_pengguna = '$nama_pengguna'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $query = "DELETE FROM barang WHERE id_barang = '$id_barang'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Barang berhasil dihapus!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menghapus barang.'); window.location.href = 'productpage.php';</script>";
        }
    } else {
        echo "<script>alert('Anda tidak memiliki izin untuk menghapus barang ini.'); window.location.href = 'productpage.php';</script>";
    }
} else {
    echo "<script>alert('ID Barang tidak valid.'); window.location.href = 'productpage.php';</script>";
}
?>
