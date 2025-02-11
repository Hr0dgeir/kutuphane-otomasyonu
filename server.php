<?php
    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbName = 'kutuphane_otomasyonu';

    $conn = new mysqli($serverName, $userName, $password, $dbName);
    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }
?>