<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION['kullanici_adi'])) {
        //echo 'Oturumda Kullanici Bilgisi Var';
        $kullaniciAdi = $_SESSION['kullanici_adi'];
    } else {
        //echo 'Oturumda kullanıcı bilgisi yok.';
        $kullaniciAdi = 'Giriş Yap';
    }

    //$pageTitle = isset($_SESSION['pagetitle']) ? $_SESSION['pagetitle'] : "Varsayılan Başlık";
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> 
        <?php 
        //require_once 'pageTitle.php';
        //echo $_COOKIE['pagetitle'];
        //echo "<script> document.title = '" . $_COOKIE['pagetitle'] . "'; </script>";
        //echo $pageTitle;
        ?> 
        </title>
        <link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/header.css">
        <link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/normalize.css">
        <link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/left-panel.css">

        <link rel="icon" type="image/png" href="http://localhost/kutuphane_otomasyon/pictures/indir (4).png">
    </head>
    <body>
        <header class="header">
            <div class="leftPart">
                <a href="http://localhost/kutuphane_otomasyon/index.php" class="leftPart">
                    <img src="http://localhost/kutuphane_otomasyon/pictures/indir (4).png" alt="" class="headerImg">
                    <p class="headerImgText">Kütüphane Otomasyonu</p>
                </a>
            </div>
            <div class="middlePart">
                <nav class="navBar">
                    <select onchange="window.location.href=this.value;" class="headerNavBarBookSelect">
                        <option class="bookOption" value="">Kitap İşlemleri</option>
                        <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-islemleri/kitap-ekleme.php">Kitap Ekleme</option>
                        <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-islemleri/kitap-silme.php">Kitap Silme</option>
                        <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-islemleri/kitap-guncelleme.php">Kitap Güncelleme</option>
                        <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-islemleri/kitap-arama.php">Kitap Arama</option>
                    </select>
                </nav>
                <nav class="navBar">
                    <select onchange="window.location.href=this.value;" class="headerNavBarBookSelect">
                        <option class="bookOption" value="">Kitap Verme İşlemleri</option>
                        <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-verme-islemleri/kitap-alma.php">Kitap Alma</option>
                        <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-verme-islemleri/kitap-verme.php">Kitap Verme</option>
                        <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-verme-islemleri/verilen-kitaplar.php">Verilen Kitaplar</option>
                    </select>
                </nav>
            </div>
            <div class="rightPart">
                <?php
                $url = '';
                if(isset($_SESSION['kullanici_adi'])){
                    $url = 'http://localhost/kutuphane_otomasyon/kullanici-islemleri/kullanici-islemleri.php';
                }
                else{
                    $url = 'http://localhost/kutuphane_otomasyon/kullanici-islemleri/kullanici-giris.php';
                }
                
                ?>
                <a href=<?php echo $url; ?> class="rightPart">
                    <img src="http://localhost/kutuphane_otomasyon/pictures/indir (5).png" alt="Kullanıcı Fotoğrafı" class="headerImg">
                    <p class="userName"><?php echo $kullaniciAdi; ?></p>
                </a>
            </div>
        </header>
