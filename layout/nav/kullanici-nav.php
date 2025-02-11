<?php
    $url = '';
    if(isset($_SESSION['kullanici_adi'])){
        $url = 'http://localhost/kutuphane_otomasyon/kullanici-islemleri/kullanici-islemleri.php';
    }
    else{
        $url = 'http://localhost/kutuphane_otomasyon/kullanici-islemleri/kullanici-giris.php';
    } 
?>