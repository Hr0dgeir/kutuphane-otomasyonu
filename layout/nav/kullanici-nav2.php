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