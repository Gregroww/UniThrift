<?php
session_start();
require 'connect.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST['id_barang'])) {
    $id_barang = mysqli_real_escape_string($conn, $_POST['id_barang']);
    $query = "DELETE FROM barang WHERE id_barang = '$id_barang'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Barang berhasil dihapus!'); window.location.href = 'admin-data-barang.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus barang.'); window.location.href = 'admin-data-barang.php';</script>";
    }
} else {
    echo "<script>alert('ID Barang tidak valid.'); window.location.href = 'admin-data-barang.php';</script>";
}

?>
