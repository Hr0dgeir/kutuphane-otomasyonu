<?php
function kitapIslemleri(){
    echo '<select onchange="window.location.href=this.value;" class="headerNavBarBookSelect">
            <option class="bookOption" value="">Kitap İşlemleri</option>
            <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-islemleri/kitap-ekleme.php">Kitap Ekleme</option>
            <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-islemleri/kitap-silme.php">Kitap Silme</option>
            <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-islemleri/kitap-guncelleme.php">Kitap Güncelleme</option>
            <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-islemleri/kitap-arama.php">Kitap Arama</option>
        </select>';
}
?>