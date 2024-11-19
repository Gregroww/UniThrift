<?php
require "connect.php";

$nama_barang = $_GET['nama_barang'];

$barang = [];
if (!empty($nama_barang)) {
    $sql = "SELECT * FROM barang WHERE nama_barang LIKE '%$nama_barang%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $barang[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>
    <link rel="stylesheet" href="searchkategori.css">
</head>
<body>
    <header>
    <?php require "navbar.php"; ?>
    </header>
    <h1>Hasil Pencarian/Kategori: Buku</h1>
    
    <form action="productpage.php" method="GET">
        <div class="book-container">
            <?php if (!empty($barang)): ?>
                <?php foreach ($barang as $item): ?>
                    <div class="book-card">
                        <button type="submit" name="id" value="<?php echo htmlspecialchars($item['id_barang']); ?>" class="book-button">
                            <img src="assets/<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['nama_barang']); ?>" class="book-image">
                            <div class="book-details">
                                <div class="book-title"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
                                <div class="book-price">
                                    Rp. <?php echo number_format($item['harga'], 0, ',', '.'); ?>
                                </div>
                            </div>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada barang yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </form>

    <div class="pagination">
        <button id="prev">&lt;</button>
        <button class="page" data-page="1">1</button>
        <button class="page" data-page="2">2</button>
        <button id="next">&gt;</button>
    </div>
    <div id="results"></div>
    <!--Footer-->
    <?php require "footer.php"; ?>
    <script src="script.js"></script>
</body>
</html>
