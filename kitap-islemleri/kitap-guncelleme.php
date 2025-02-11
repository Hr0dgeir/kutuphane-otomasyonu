<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Kitap Güncelleme İşlemleri");
?>
<?php require '../layout/header.php'; ?>
<?php require '../messageBox.php';?>
<link rel="stylesheet" href="../css/kitap-islemleri/kitap-guncelleme.css">

<?php
require '../server.php';

function searchBook($conn, $bookName) {
    $stmt = $conn->prepare("SELECT * FROM kitaplar WHERE kitap_ismi LIKE ?");
    $searchTerm = "%$bookName%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = ''; // Eğer hiç satır bulunamazsa da döndürülebilir boş bir string

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tags .= "<tr>
                <td>" . (!empty($row['ID']) ? $row['ID'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_ismi']) ? $row['kitap_ismi'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_türü']) ? $row['kitap_türü'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_sayfa_sayisi']) ? $row['kitap_sayfa_sayisi'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_yazari']) ? $row['kitap_yazari'] : "Boş") . "</td>
            </tr>";
        }
    } else {
        $tags = "<tr><td colspan='5'>Kitap bulunamadı!</td></tr>";
    }

    $stmt->close();
    return $tags;
}

function updateBook($conn, $bookID, $bookName, $bookPageCount, $bookType, $bookAuthor) {
    if(isset($_SESSION['kullanici_adi'])){
        $stmt = $conn->prepare("UPDATE kitaplar SET kitap_ismi = ?, kitap_sayfa_sayisi = ?, kitap_türü = ?, kitap_yazari = ? WHERE ID = ?");
    
        $stmt->bind_param("sissi", $bookName, $bookPageCount, $bookType, $bookAuthor, $bookID);
        
        if ($stmt->execute()) {
            //echo "Kitap başarıyla güncellendi!";
            message('success','Kitap Başarılı Bir şekilde Güncellendi !');
        } else {
            //echo "Güncelleme sırasında bir hata oluştu: " . $stmt->error;
            message('error','Bir Hata Oluştu !');
        }
    
        $stmt->close();
    }
    else{
        message('error','Kitap Güncellemek İçin Giriş Yapınız');
    }
}
function getAllBooks($conn) {
    $stmt = $conn->prepare("SELECT * FROM kitaplar");
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = ''; // Eğer hiç satır bulunamazsa da döndürülebilir boş bir string

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $tags .= "<tr>
                <td>" . (!empty($row['ID']) ? $row['ID'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_ismi']) ? $row['kitap_ismi'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_türü']) ? $row['kitap_türü'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_sayfa_sayisi']) ? $row['kitap_sayfa_sayisi'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_yazari']) ? $row['kitap_yazari'] : "Boş") . "</td>
            </tr>";
        }
    } else {
        $tags = "<tr><td colspan='5'>Kitap bulunamadı!</td></tr>";
    }

    $stmt->close();
    return $tags;
}

?>


<?php require '../left-panel.php'; ?>
<div class="container">
    <div class="ResultArea">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Kitap İsmi</th>
                <th>Kitap Sayfa Sayısı</th>
                <th>Kitap Türü</th>
                <th>Kitap Yazarı</th>
            </tr>
            <tbody id="tableContainer">
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['textboxSearch']) && $_GET['textboxSearch']) {
                        // Kitap arama işlemi yapılıyor
                        $searchValue = $_GET['textboxSearch'];
                        echo searchBook($conn, $searchValue);
                    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['textboxID']) && isset($_POST['textboxName']) && isset($_POST['textboxPageCount']) && isset($_POST['textboxBookType']) && isset($_POST['textboxBookAuthor'])) {
                        // Kitap güncelleme işlemi yapılıyor
                        $ID = $_POST['textboxID'];
                        $bookName = $_POST['textboxName'];
                        $bookPageCount = $_POST['textboxPageCount'];
                        $bookType = $_POST['textboxBookType'];
                        $bookAuthor = $_POST['textboxBookAuthor'];
                        updateBook($conn, $ID, $bookName, $bookPageCount, $bookType, $bookAuthor);
                        echo getAllBooks($conn); // Güncellenmiş listeyi göster
                    } else {
                        // Varsayılan olarak tüm kitapları göster
                        echo getAllBooks($conn);
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="searchArea">
        <form action="" method="get">
            <input type="text" class="textbox" name="textboxSearch" placeholder="Lütfen Aramak İstediğiniz Kitabın İsmini Yazınız">
            <input class="btn" type="submit" value="Ara">
        </form>
    </div>
    <form action="" method="Post">
        <div class="inputArea">
            <div class="itemEditArea">
                <input required name="textboxID" class="textbox" type="number" placeholder="Lütfen Kitap ID Numarasını Giriniz">
                <input required name="textboxName" class="textbox" type="text" placeholder="Lütfen Kitap İsmini Giriniz">
                <input required name="textboxPageCount" class="textbox" type="text" placeholder="Lütfen Kitap Sayfa Sayisini Giriniz">
                <!--<input required name="textboxBookType" class="textbox" type="text" placeholder="Lütfen Kitap Türünü Giriniz">-->
                <select name="textboxBookType" id="" class="optionInput">
                    <?php require '../kitap-turleri.php'; ?>
                </select>
                <input required name="textboxBookAuthor" class="textbox" type="text" placeholder="Lütfen Kitap Yazarını Giriniz">
            </div>
            <div class="buttonsArea">
                <input type="submit" value="Güncelle" class="btn">
                <input type="reset" value="Verileri Sil" class="btn">
            </div>
        </div>
    </form>
</div>




<?php require '../layout/footer.php'; ?>