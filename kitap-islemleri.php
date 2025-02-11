<?php require_once 'pageTitle.php';
test("Kütüphane Otamasyonu | Kitap İşlemleri");
?>
<?php require 'layout/header.php'?>
<?php require 'left-panel.php'; ?>

<link rel="stylesheet" href="css/kitap-islemleri.css">
<div class="container">
    <a href="kitap-islemleri/kitap-ekleme.php">
        <div class="process" id="addNewBook">
            <img src="pictures/indir (1).png" alt="YeniKitapEklemeGörseli">
            <p>Yeni Kitap Ekle</p>
        </div>
    </a>
    <a href="kitap-islemleri/kitap-silme.php">
        <div class="process" id="deleteBook">
            <img src="pictures/indir (2).png" alt="KitapSilmeGörseli">
            <p>Kitap Sil</p>
        </div>
    </a>
            
    <a href="kitap-islemleri/kitap-guncelleme.php">
        <div class="process" id="updateBook">
            <img src="pictures/indir (3).png" alt="KitapGüncellemeGörseli">
            <p>Kitap Güncelle</p>
        </div>
    </a>
    <a href="kitap-islemleri/kitap-arama.php">
        <div class="process" id="kitapAra">
            <img src="pictures/indir.png" alt="KitapAramaGörseli">
            <p>Kitap Ara</p>
        </div>
    </a>
</div>
<?php require 'layout/footer.php'?>