<div class="left-panel">
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Hakkımızda
        </a>
    </div>

    <div class="items-title">
        <h3>Kitap Verme İşlemleri</h3>
    </div>
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Kitap Verme
        </a>
    </div>
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Kitap Alma
        </a>
    </div>
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Verilen Kitaplar
        </a>
    </div>

    <div class="items-title">
        <h3>Kitap İşlemleri</h3>
    </div>
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Kitap Arama
        </a>
    </div>
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Kitap Güncelleme
        </a>
    </div>
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Kitap Silme
        </a>
    </div>
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Kitap Ekleme
        </a>
    </div>

    <div class="items-title">
        <h3>Kullanıcı İşlemleri</h3>
    </div>
    <?php
    if(isset($_SESSION['kullanici_adi'])){
        echo '<div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Kullanıcı Ayarları
        </a>
    </div>';
    }
    else{
        echo '<div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Kullanıcı Girişi
        </a>
    </div>
    
    <div class="left-panel-item">
        <a href="http://localhost/kutuphane_otomasyon/hakkimizda.php" class="left-panel-a">
            Yeni Kullanıcı
        </a>
    </div>
    '
    ;
    }

    ?>
</div>