<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Produk</title>
    <link rel="stylesheet" href="style/sellpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css">
</head>
<body>
    <div class="container">
        <div class="back-icon">
            <button><i class="ri-arrow-go-back-fill"></i> </button>
        </div>
        <div class="title">Update Produk</div>
    </div>
    <div class="product-form">
        <div class="form-container">
            <div class="left-section">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="input-field">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <div class="category-grid">
                        <div class="category-item">
                            <input type="radio" name="category" id="gaming">
                            <label for="gaming">Gaming</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="kecantikan">
                            <label for="kecantikan">Kecantikan</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="wanita">
                            <label for="wanita">Wanita</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="kendaraan">
                            <label for="kendaraan">Kendaraan</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="buku">
                            <label for="buku">Buku</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="elektronik">
                            <label for="elektronik">Elektronik</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="pria">
                            <label for="pria">Pria</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="perabotan">
                            <label for="perabotan">Perabotan</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="olahraga">
                            <label for="olahraga">Olahraga</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="tas">
                            <label for="tas">Tas</label>
                        </div>
                        <div class="category-item">
                            <input type="radio" name="category" id="mainan">
                            <label for="mainan">Mainan</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="input-field description"></textarea>
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <div class="price-input">
                        <span class="currency">Rp</span>
                        <input type="text" class="input-field">
                    </div>
                </div>

                <div class="form-group">
                    <label>Lokasi</label>
                    <select class="input-field">
                        <option value="">Pilih Lokasi</option>
                    </select>
                </div>

                <button class="submit-button">Perbarui</button>
            </div>

            <div class="right-section">
                <label>Foto Produk</label>
                <div class="image-upload">
                    <div class="upload-placeholder">
                        <i class="ri-image-add-line"></i>
                    </div>
                    <div class="image-preview">
                        <img src="product-image.jpg" alt="Preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>