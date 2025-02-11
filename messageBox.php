<link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/messageBox.css">
<?php
function message($status, $message) {
    // Duruma göre CSS sınıfı belirle
    $class = ($status === 'success') ? 'success-box' : (($status === 'error') ? 'error-box' : null);

    // Eğer geçerli bir durum ve mesaj varsa kutuyu döndür
    if ($class && $message) {
        echo "
        <div id='messageBox' class='message-box $class'>
            <strong>" . ($status === 'success' ? 'Başarılı!' : 'Hata!') . "</strong> $message
        </div>
        <script>
            window.onload = function() {
                const messageBox = document.getElementById('messageBox');
                if (messageBox) {
                    setTimeout(() => {
                        messageBox.classList.add('hide');
                        setTimeout(() => messageBox.remove(), 1000);
                    }, 2000);
                }
            };
        </script>
        ";
    }
}
?>
