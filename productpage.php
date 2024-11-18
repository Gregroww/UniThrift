<?php 
require 'connect.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="product.css">
</head>
<body>
    <div class="container">
        <div class="product-card">
            <div class="product-grid">
                <!-- Bagian Kiri: Gambar Produk dan Profil Penjual -->
                <div class="left-section">
                    <div class="image-container">
                        <img src="product-image.jpg" alt="Honda Beat Sport" class="product-image">
                    </div>

                    <!-- Profil Penjual -->
                    <div class="seller-info">
                        <div class="profile">
                            <div class="avatar-container">
                                <img class="seller-avatar" src="seller-avatar.jpg" alt="M. Rafly Pratama">
                            </div>
                            <span class="seller-name">M. Rafly Pratama</span>
                        </div>
                    </div>
                </div>
                
                <!-- Bagian Kanan -->
                <div class="right-section">
                    <div class="top-section">
                        <div class="date">05 Sep 2024</div>
                        <div class="title-section">
                            <h1>Honda Beat<br>Sport</h1>
                            <div class="price">Rp. 15.000.000</div>
                        </div>
                        
                        <button class="contact-button">Hubungi Penjual</button>

                        <div class="category">
                            <h2>Kategori</h2>
                            <div class="tags">
                                <span class="tag">#Kendaraan</span>
                                <span class="tag">#Motor</span>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Produk -->
                    <div class="description">
                        <h2>Deskripsi Produk</h2>
                        <p>Good Condition BPKB dan STNK asli penjual</p>
                        <p>Warna: Silver KM 1500</p>
                        <div class="location">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                            Tenggarong
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
