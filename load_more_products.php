<?php
require "connect.php";

function getProducts($conn, $offset = 0, $limit = 10) {
    $query = "SELECT id_barang, nama_barang, harga, gambar FROM barang LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $query);

    $products = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row; 
        }
    }
    return $products;  
}

$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;

$products = getProducts($conn, $offset, $limit);
echo json_encode($products);
?>