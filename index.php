<?php
require "connect.php";

function getRandomProducts($conn, $limit = 10) {
    $query = "SELECT id_barang, nama_barang, harga, gambar FROM barang ORDER BY RAND() LIMIT $limit";
    $result = mysqli_query($conn, $query);

    $products = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row; 
        }
    }
    return $products;  
}

$randomProducts = getRandomProducts($conn); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniThrift</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
    <?php require "navbar.php"; ?>
    </header>

    <nav class="categories">
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-person-dress"></i>
        </div>
            <span class="text-category">Wanita</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-person"></i>
        </div>
            <span class="text-category">Pria</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-mobile-screen-button"></i>
        </div>
            <span class="text-category">Elektronik</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-robot"></i>
        </div>
            <span class="text-category">Mainan</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-gamepad"></i>
        </div>
            <span class="text-category">Gaming</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-bag-shopping"></i>
        </div>
            <span class="text-category">Tas</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-book"></i>
        </div>
            <span class="text-category">Buku</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
        </div>
            <span class="text-category">Kecantikan</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-motorcycle"></i>
        </div>
            <span class="text-category">Kendaraan</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
        <i class="fa-solid fa-football"></i>
        </div>
            <span class="text-category">Olahraga</span>
        </a>
        <a href="#" class="category">
        <div class="ikon">
            <i class="fa-solid fa-couch"></i>
        </div>
            <span class="text-category">Perabotan</span>
        </a>
    </nav>

    <div class="banner">
        <img src="images/UniThrift.png" alt="UniThrift" class="banner-image">
    </div>

    <div class="product-title">
        <span class="title">Kategori Terpopuler</span>
    </div>

    <section class="popular-categories">
    
        <div class="category-grid">
            <div class="category-card">
                <img src="images/1.png" class="category-image" alt="Gaming">
            </div>
            <div class="category-card">
                <img src="images/2.png" class="category-image" alt="Buku">
            </div>
            <div class="category-card">
                <img src="images/3.png" class="category-image" alt="Olahraga">
            </div>
        </div>
    
        <div class="category-grid">
            <div class="category-card">
                <img src="images/4.png" class="category-image" alt="Kecantikan">
            </div>
            <div class="category-card">
                <img src="images/5.png" class="category-image" alt="Elektronik">
            </div>
            <div class="category-card">
                <img src="images/6.png" class="category-image" alt="Tas">
            </div>
            <div class="category-card">
                <img src="images/7.png" class="category-image" alt="Perabotan">
            </div>
        </div>
    </section>
    

    <div class="product-title">
        <span class="title">Produk</span>
    </div>

    <form action="productpage.php" method="GET">
    <main class="main-section">
        <div class="main-content">
            <div class="content-grid">
                <?php if (!empty($randomProducts)): ?>
                    <?php foreach ($randomProducts as $product): ?>
                        <div class="content-box">

                            <button type="submit" name="id" value="<?php echo htmlspecialchars($product['id_barang']); ?>" class="content-button">
                               
                                <img 
                                    src="assets/<?php echo htmlspecialchars($product['gambar']); ?>" 
                                    alt="<?php echo htmlspecialchars($product['nama_barang']); ?>" 
                                    class="content-image">
                               
                                <div class="title-box">
                                    <p><?php echo htmlspecialchars($product['nama_barang']); ?></p>
                                </div>
                                
                                <div class="price-box">
                                    Rp. <?php echo number_format($product['harga'], 0, ',', '.'); ?>
                                </div>
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada produk yang tersedia saat ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</form>
    <?php require "footer.php"; ?>
</body>
</html>