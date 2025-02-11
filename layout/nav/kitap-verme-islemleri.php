<?php
function kitapVermeİslemleri(){
    echo '<select onchange="window.location.href=this.value;" class="headerNavBarBookSelect">
            <option class="bookOption" value="">Kitap Verme İşlemleri</option>
            <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-verme-islemleri/kitap-alma.php">Kitap Alma</option>
            <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-verme-islemleri/kitap-verme.php">Kitap Verme</option>
            <option class="bookOption" value="http://localhost/kutuphane_otomasyon/kitap-verme-islemleri/verilen-kitaplar.php">Verilen Kitaplar</option>
        </select>';
}
?>