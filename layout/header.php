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
        <link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/layout/header.css">
        <link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/normalize.css">
        <link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/left-panel.css">

        <link rel="icon" type="image/png" href="http://localhost/kutuphane_otomasyon/pictures/indir (4).png">
    </head>
    <?php require_once 'nav/kitap-verme-islemleri.php';?>
    <?php require_once 'nav/kitap-islemleri.php';?>
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
        </header>
