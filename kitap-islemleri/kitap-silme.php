<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Kitap Silme İşlemleri");
?>
<?php require '../layout/header.php'; ?>
<?php require '../messageBox.php';?>
<link rel="stylesheet" href="../css/kitap-islemleri/kitap-silme.css">

<?php
require '../server.php';
$sql = "SELECT * FROM kitaplar";  // 'kitaplar' tablosundan tüm verileri al
$result = $conn->query($sql);
// $tags dizisini başlatıyoruz
$tags = "";
if ($result->num_rows > 0) {
    // Veriler var, her birini işleme
    while($row = $result->fetch_assoc()) {
        $ID = $row['ID'];
        $author = $row['kitap_yazari'];
        $pageCount = $row['kitap_sayfa_sayisi'];
        $bookType = $row['kitap_türü'];
        $bookName = $row['kitap_ismi'];
        
        // Her kitap için yeni bir <tr> satırı ekliyoruz
        $tags .= "<tr>
            <td>$ID</td>
            <td>$bookName</td>
            <td>$bookType</td>
            <td>$pageCount</td>
            <td>$author</td>
        </tr>";
    }
} else {
    echo "Kayıt bulunamadı.";
}
// Bağlantıyı kapatma

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

function getAllData($conn){
    $stmt = $conn->prepare("SELECT * FROM kitaplar");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tags = '';
        while ($row = $result->fetch_assoc()) {
            //$books[] = $row; // Her satırı array'e ekle
            $tags .= "<tr>
            <td>" . $row['ID'] . "</td>
            <td>" . $row['kitap_ismi'] . "</td>
            <td>" . $row['kitap_türü'] . "</td>
            <td>" . $row['kitap_sayfa_sayisi'] . "</td>
            <td>" . $row['kitap_yazari'] . "</td>
        </tr>";
        }
    } else {
        //echo "Kitap bulunamadı!";
    }

    $stmt->close();
    return $tags; // Verileri döndür
}
function deleteBook($conn, $bookID) {
    if(isset($_SESSION['kullanici_adi'])){
        // SQL sorgusu kitap ID'sine göre silmek için hazırlanıyor
        $stmt = $conn->prepare("DELETE FROM kitaplar WHERE id = ?");
        
        if ($stmt === false) {
            die("Sorgu hazırlama hatası: " . $conn->error);
        }

        // ID değerini sorguya bağlıyoruz
        $stmt->bind_param("i", $bookID);

        // Sorguyu çalıştırıyoruz
        if ($stmt->execute()) {
            //echo "Kitap başarıyla silindi.";
            message('success','Kitap Başarıyla Silindi');
        } else {
            //echo "Kitap silinirken hata oluştu: " . $stmt->error;
            message('error','Kitap Silinirken Bir Hata Oluştu');
        }

        // Kaynakları temizliyoruz
        $stmt->close();
    }
    else{
        message('error','Kitap Silmek İçin Giriş Yapınız');
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

<?php
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    if(isset($_POST['textboxDelete']) && $_POST['textboxDelete']){
        $ID = $_POST['textboxDelete'];
        deleteBook($conn,$ID);
    }
}

?>
<?php require '../layout/left-panel.php'; ?>
<div class="booksTable">
    <table border="1">
        <tr>
            <th>ID</th>
            <th>İsim</th>
            <th>Türü</th>
            <th>Sayfa Sayısı</th>
            <th>Yazar</th>
        </tr>
        <tbody id="dataContainer">
            <?php
                // Kitapları listelemek için mantık
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['textboxSearch']) && $_GET['textboxSearch']) {
                        // Arama işlemi gerçekleşiyor
                        $searchValue = $_GET['textboxSearch'];
                        echo searchBook($conn, $searchValue);
                    } else {
                        // Varsayılan olarak tüm kitapları listele
                        echo getAllBooks($conn);
                    }
                }

                // Veritabanı bağlantısını kapat
                $conn->close();
            ?>
        </tbody>
    </table>
    <div class="inputArea">
        <div class="searchArea">
            <form action="" method="get" class="formContainer">
                <input name="textboxSearch" class="textbox" type="text" placeholder="Arama Yapacağınız Kitabın İsmini Yazınız">
                <input class="btn" type="submit" value="Ara ">
            </form>
        </div>
        <div class="deleteArea">
            <form action="" method="post">
                <input name="textboxDelete" type="text" class="textbox" placeholder="Silmek İstediğiniz Kitabın ID numarasını giriniz">
                <input class="btn" type="submit" value="Sil ">
            </form>
        </div>
    </div>
</div>





<?php require '../layout/footer.php'; ?>