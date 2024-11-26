<?php
require "connect.php";

$search = isset($_GET['search']) ? $_GET['search'] : '';
$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$barang = [];
if (!empty($search) || !empty($lokasi)) {
    $sql = "SELECT barang.*, users.lokasi FROM barang 
    JOIN users ON barang.nama_pengguna = users.nama_pengguna 
    WHERE (barang.nama_barang LIKE '%$search%' OR barang.kategori LIKE '%$search%')";
    if (!empty($lokasi)) {
        $sql .= " AND users.lokasi = '$lokasi'";
    }
    $sql .= " LIMIT $limit OFFSET $offset"; // Limit the results to 10 items with offset
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
    <title>Katalog</title>
    <link rel="stylesheet" href="style/searchkategori.css">
</head>
<body>
    <header>
    <?php require "navbar.php"; ?>
    </header>
    <h1>Hasil Pencarian<?php echo !empty($search) ? ": " . htmlspecialchars($search) : ""; ?><?php echo !empty($lokasi) ? " di " . htmlspecialchars($lokasi) : ""; ?></h1>
    <form action="productpage.php" method="GET">
        <div class="book-container">
            <?php if (!empty($barang)): ?>
                <?php foreach ($barang as $item): ?>
                    <div class="book-card">
                        <button type="submit" name="id" value="<?php echo htmlspecialchars($item['id_barang']); ?>" class="book-button">
                            <img src="images/<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['nama_barang']); ?>" class="book-image">
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
                <?php require "notfound.php"; ?>
            <?php endif; ?>
        </div>
    </form>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <button onclick="navigateToPage(<?php echo $page - 1; ?>)">&lt;</button>
        <?php endif; ?>
        <span class="page"> <?php echo $page; ?></span>
        <?php if (count($barang) == $limit): ?>
            <button onclick="navigateToPage(<?php echo $page + 1; ?>)">&gt;</button>
        <?php endif; ?>
    </div>
    <!--Footer-->
    <?php require "footer.php"; ?>
    <script src="scripts/script.js"></script>
    <script>
    function navigateToPage(page) {
        const searchParams = new URLSearchParams(window.location.search);
        searchParams.set('page', page);
        window.location.search = searchParams.toString();
    }
    </script>
</body>
</html>