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
    
    <div class="book-container">
        <div class="book-card">
            <img src="filosofi-teras.jpg" alt="Buku Filosofi Teras" class="book-image">
            <div class="book-details">
                <div class="book-title">Buku Filosofi Teras</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <div class="book-card">
            <img src="berani-tidak-disukai.jpg" alt="Buku Berani Tidak Disukai" class="book-image">
            <div class="book-details">
                <div class="book-title">Buku Berani Tidak Disukai</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <div class="book-card">
            <img src="harry-potter.jpg" alt="Harry Potter and The Deathly Hallows" class="book-image">
            <div class="book-details">
                <div class="book-title">Harry Potter and The Deathly Hallows</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <div class="book-card">
            <img src="mysterious-howling.jpg" alt="The Mysterious Howling" class="book-image">
            <div class="book-details">
                <div class="book-title">The Mysterious Howling</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <div class="book-card">
            <img src="bukan-pasar-malam.jpg" alt="Bukan Pasar Malam" class="book-image">
            <div class="book-details">
                <div class="book-title">Bukan Pasar Malam</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <!-- Duplicate books for second row -->
        <div class="book-card">
            <img src="filosofi-teras.jpg" alt="Buku Filosofi Teras" class="book-image">
            <div class="book-details">
                <div class="book-title">Buku Filosofi Teras</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <div class="book-card">
            <img src="berani-tidak-disukai.jpg" alt="Buku Berani Tidak Disukai" class="book-image">
            <div class="book-details">
                <div class="book-title">Buku Berani Tidak Disukai</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <div class="book-card">
            <img src="harry-potter.jpg" alt="Harry Potter and The Deathly Hallows" class="book-image">
            <div class="book-details">
                <div class="book-title">Harry Potter and The Deathly Hallows</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <div class="book-card">
            <img src="mysterious-howling.jpg" alt="The Mysterious Howling" class="book-image">
            <div class="book-details">
                <div class="book-title">The Mysterious Howling</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
        
        <div class="book-card">
            <img src="bukan-pasar-malam.jpg" alt="Bukan Pasar Malam" class="book-image">
            <div class="book-details">
                <div class="book-title">Bukan Pasar Malam</div>
                <div class="book-price">Rp. 40.000</div>
            </div>
        </div>
    </div>

    <div class="pagination">
        <button>&lt;</button>
        <button class="active">1</button>
        <button>2</button>
        <button>&gt;</button>
    </div>
    <!--Footer-->
    <?php require "footer.php"; ?>
</body>
</html>