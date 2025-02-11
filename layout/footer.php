<?php
    //session_start();
    if (isset($_SESSION['kullanici_adi'])) {
        //echo 'Oturumda Kullanici Bilgisi Var';
        $kullaniciAdi = $_SESSION['kullanici_adi'];
    } else {
        //echo 'Oturumda kullanıcı bilgisi yok.';
        $kullaniciAdi = 'Giriş Yap';
    }
?>

<?php require_once 'nav/kitap-islemleri.php';?>
<?php require_once 'nav/kitap-verme-islemleri.php';?>
<link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/layout/footer.css">
    <footer class="footer">
        <div class="leftPart">
            <a href="http://localhost/kutuphane_otomasyon/index.php" class="leftPart">
                <img src="http://localhost/kutuphane_otomasyon/pictures/indir (4).png" alt="" class="footerImg">
                <p class="footerImgText">Kütüphane Otomasyonu</p>
            </a>
        </div>
        <div class="middlePart">
            <nav class="navBar">
                <?php kitapIslemleri();?>
            </nav>
            <nav class="navBar">
                <?php kitapVermeİslemleri();?>
            </nav>
        </div>
        <div class="rightPart">
            <?php
                require_once 'nav/kullanici-nav.php';    
            ?>
            <a href=<?php echo $url; ?> class="rightPart">
                <img src="http://localhost/kutuphane_otomasyon/pictures/indir (5).png" alt="Kullanıcı Fotoğrafı" class="headerImg">
                <p class="userName"><?php echo $kullaniciAdi; ?></p>
            </a>
        </div>
    </footer>
</body>
</html>