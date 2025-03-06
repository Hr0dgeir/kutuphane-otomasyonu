<?php require_once 'pageTitle.php';
test("Kütüphane Otamasyonu | Anasayfa");
?>
<?php require 'layout/header.php';?>
<?php require 'server.php';?>

<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/normalize.css">
<!--<link rel="stylesheet" href="css/kitap-islemleri.css">-->

<div class="container">
    <?php require 'layout/left-panel.php'; ?>
    <div class="middle">
        <div class="info-container">
            <div class="info-box">
                <div class="info-title">
                    <p class="info-p"><strong>Toplam Verilen Kitap Sayısı</strong></p>
                </div>
                <div class="info-data">
                    <p>
                        <?php
                        function getAllGiveAwayBooks($conn) {
                            $stmt = $conn->prepare("SELECT * FROM verilen_kitaplar");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            // Kitap sayısını al
                            $bookCount = $result->num_rows;
                            
                            return $bookCount; // Kitap sayısını döndür
                        }
                        ?>

                        <?php echo getAllGiveAwayBooks($conn);?>
                    </p>
                </div>
            </div>
            <div class="info-box">
                <div class="info-title">
                    <p class="info-p"><strong>Alınması Gereken Kitaplar</strong></p>
                </div>
                <div class="info-data">
                    <?php
                    function getAllBookTakeDays($conn) {
                        $stmt = $conn->prepare("SELECT alinacak_tarih , ID FROM verilen_kitaplar");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $isThereAnyOutDateBook = false;
                            while ($row = $result->fetch_assoc()) {
                                // Veritabanından alınan tarih
                                $alinacakTarih = $row['alinacak_tarih'];

                                // Alınacak tarihi DateTime nesnesine çevir
                                $daysplus15 = new DateTime($alinacakTarih);

                                // Bugünün tarihini al
                                $today = new DateTime();

                                // Eğer alınacak tarih, bugünden önce veya eşitse
                                if ($daysplus15 <= $today) {
                                    echo "Kitap alınması gereken tarih geldi veya geçmiş alınması gereken tarih şu şekilde: " . $alinacakTarih . "<br>";
                                    $idBookToTake = $row["ID"];
                                    echo "Verilen Kitap ID Numarası : " . $idBookToTake ."<strong><a href='kitap-verme-islemleri/verilen-kitaplar.php'> Gitmek İçin Tıklayın </a></strong>";
                                    $isThereAnyOutDateBook = true;
                                    echo "<div class='row'></div>";
                                }
                            }

                            if($isThereAnyOutDateBook == false){
                                echo "Şuan Alınması Gereken Kitap Yoktur";
                            }
                        } 
                        else {
                            echo "Herhangi Bir Verilen Kitap Bilgisi Yoktur";
                        }
                    }
                    ?>
                    <p>
                        <?php
                            echo getAllBookTakeDays($conn);
                        ?>
                    </p>
                </div>
            </div>

            <div class="info-box">
                <div class="info-title">
                    <p class="info-p"><strong>Toplam Kitap Sayısı</strong></p>
                </div>
                <div class="info-data">
                    <?php
                    
                    function getAllBookCount($conn) {
                        $stmt = $conn->prepare("SELECT * FROM Kitaplar");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        // Kitap sayısını al
                        $bookCount = $result->num_rows;
                        
                        return $bookCount; // Kitap sayısını döndür
                    }
                    
                    ?>
                    <p>
                        <?php
                            echo getAllBookCount($conn);
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>





<?php require 'layout/footer.php'?>