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

$initialProducts = getProducts($conn, 0, 10);
$randomProducts = getProducts($conn); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniThrift</title>
    <link rel="stylesheet" href="style/styles.css">
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
        <a href="searchkategori.php?search=Wanita" class="category">
            <div class="ikon">
                <i class="fa-solid fa-person-dress"></i>
            </div>
            <span class="text-category">Wanita</span>
        </a>
        <a href="searchkategori.php?search=Pria" class="category">
            <div class="ikon">
                <i class="fa-solid fa-person"></i>
            </div>
            <span class="text-category">Pria</span>
        </a>
        <a href="searchkategori.php?search=Elektronik" class="category">
            <div class="ikon">
                <i class="fa-solid fa-mobile-screen-button"></i>
            </div>
            <span class="text-category">Elektronik</span>
        </a>
        <a href="searchkategori.php?search=Mainan" class="category">
            <div class="ikon">
                <i class="fa-solid fa-robot"></i>
            </div>
            <span class="text-category">Mainan</span>
        </a>
        <a href="searchkategori.php?search=Gaming" class="category">
            <div class="ikon">
                <i class="fa-solid fa-gamepad"></i>
            </div>
            <span class="text-category">Gaming</span>
        </a>
        <a href="searchkategori.php?search=Tas" class="category">
            <div class="ikon">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <span class="text-category">Tas</span>
        </a>
        <a href="searchkategori.php?search=Buku" class="category">
            <div class="ikon">
                <i class="fa-solid fa-book"></i>
            </div>
            <span class="text-category">Buku</span>
        </a>
        <a href="searchkategori.php?search=Kecantikan" class="category">
            <div class="ikon">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </div>
            <span class="text-category">Kecantikan</span>
        </a>
        <a href="searchkategori.php?search=Kendaraan" class="category">
            <div class="ikon">
                <i class="fa-solid fa-motorcycle"></i>
            </div>
            <span class="text-category">Kendaraan</span>
        </a>
        <a href="searchkategori.php?search=Olahraga" class="category">
            <div class="ikon">
                <i class="fa-solid fa-football"></i>
            </div>
            <span class="text-category">Olahraga</span>
        </a>
        <a href="searchkategori.php?search=Perabotan" class="category">
            <div class="ikon">
                <i class="fa-solid fa-couch"></i>
            </div>
            <span class="text-category">Perabotan</span>
        </a>
    </nav>
    <div class="banner">
        <img src="assets/UniThrift.png" alt="UniThrift" class="banner-image" id="bannerImage1">
        <img src="assets/banner2.1.png" alt="Banner 2" class="banner-image" id="bannerImage2">
        <img src="assets/banner4.png" alt="Banner 3" class="banner-image" id="bannerImage3">
    </div>
    <div class="product-title">
        <span class="title">Kategori Terpopuler</span>
    </div>
    <section class="popular-categories">
        <div class="category-grid">
            <div class="category-card">
                <a href="searchkategori.php?search=Gaming">
                    <img src="assets/1.png" class="category-image" alt="Gaming">
                </a>
            </div>
            <div class="category-card">
                <a href="searchkategori.php?search=Buku">
                    <img src="assets/2.png" class="category-image" alt="Buku">
                </a>
            </div>
            <div class="category-card">
                <a href="searchkategori.php?search=Olahraga">
                    <img src="assets/3.png" class="category-image" alt="Olahraga">
                </a>
            </div>
        </div>

        <div class="category-grid">
            <div class="category-card">
                <a href="searchkategori.php?search=Kecantikan">
                    <img src="assets/4.png" class="category-image" alt="Kecantikan">
                </a>
            </div>
            <div class="category-card">
                <a href="searchkategori.php?search=Elektronik">
                    <img src="assets/5.png" class="category-image" alt="Elektronik">
                </a>
            </div>
            <div class="category-card">
                <a href="searchkategori.php?search=Tas">
                    <img src="assets/6.png" class="category-image" alt="Tas">
                </a>
            </div>
            <div class="category-card">
                <a href="searchkategori.php?search=Perabotan">
                    <img src="assets/7.png" class="category-image" alt="Perabotan">
                </a>
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
                                    src="images/<?php echo htmlspecialchars($product['gambar']); ?>" 
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
    <div class="load-more-container">
        <button id="load-more" class="load-more-button">Lihat Lainnya</button>
    </div>
    <script>
        let offset = 10;
        const limit = 10;
        document.getElementById('load-more').addEventListener('click', function () {
            this.style.display = 'none';
            fetch('load_more_products.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `offset=${offset}&limit=${limit}`
            })
            .then(response => response.json())
            .then(data => {
                const contentGrid = document.querySelector('.content-grid');
                if (data.length > 0) {
                    data.forEach(product => {
                        const productBox = document.createElement('div');
                        productBox.className = 'content-box';
                        productBox.innerHTML = `
                            <form action="productpage.php" method="GET">
                                <button type="submit" name="id" value="${product.id_barang}" class="content-button">
                                    <img 
                                        src="images/${product.gambar}" 
                                        alt="${product.nama_barang}" 
                                        class="content-image">
                                    <div class="title-box">
                                        <p>${product.nama_barang}</p>
                                    </div>
                                    <div class="price-box">
                                        Rp. ${parseInt(product.harga).toLocaleString('id-ID')}
                                    </div>
                                </button>
                            </form>
                        `;
                        contentGrid.appendChild(productBox);
                    });
                    offset += limit;
                } else {
                    document.getElementById('load-more').style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching more products:', error));
        });

        document.addEventListener("DOMContentLoaded", function () {
        const banners = document.querySelectorAll(".banner-image");
        let currentIndex = 0;
        function changeBanner() {
            banners.forEach((banner, index) => {
                banner.classList.remove("active");
            });
            banners[currentIndex].classList.add("active");
            currentIndex = (currentIndex + 1) % banners.length;
            }
            setInterval(changeBanner, 5000);
            changeBanner();
        });
    </script>
    <?php require "footer.php"; ?>
</body>
</html>