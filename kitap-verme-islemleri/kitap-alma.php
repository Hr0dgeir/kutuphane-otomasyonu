<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Kitap Alma İşlemleri");
?>
<?php require '../layout/header.php'; ?>
<?php require '../messageBox.php'; ?>
<link rel="stylesheet" href="../css/kitap-verme-islemleri/kitap-alma.css">

<?php
require '../server.php';
function searchBooksByReceiverName($conn, $receiverName) {
    $stmt = $conn->prepare("SELECT * FROM verilen_kitaplar WHERE alici LIKE ?");
    $searchTerm = "%$receiverName%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = ''; // Eğer hiç satır bulunamazsa da döndürülebilir boş bir string

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tags .= "<tr>
                <td>" . (!empty($row['ID']) ? $row['ID'] : "Boş") . "</td>
                <td>" . (!empty($row['alici']) ? $row['alici'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_ismi']) ? $row['kitap_ismi'] : "Boş") . "</td>
                <td>" . (!empty($row['verilen_tarih']) ? $row['verilen_tarih'] : "Boş") . "</td>
                <td>" . (!empty($row['alinacak_tarih']) ? $row['alinacak_tarih'] : "Boş") . "</td>
                <td>" . (!empty($row['alici_sinif']) ? $row['alici_sinif'] : "Boş") . "</td>
                <td>" . (!empty($row['alici_no']) ? $row['alici_no'] : "Boş") . "</td>
            </tr>";
        }
    } else {
        $tags = "<tr><td colspan='5'>Kitap bulunamadı!</td></tr>";
    }

    $stmt->close();
    return $tags;
}

function getAllReceivers($conn) {
    $stmt = $conn->prepare("SELECT * FROM verilen_kitaplar");
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = ''; // Eğer hiç satır bulunamazsa da döndürülebilir boş bir string

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tags .= "<tr>
                <td>" . (!empty($row['ID']) ? $row['ID'] : "Boş") . "</td>
                <td>" . (!empty($row['alici']) ? $row['alici'] : "Boş") . "</td>
                <td>" . (!empty($row['kitap_ismi']) ? $row['kitap_ismi'] : "Boş") . "</td>
                <td>" . (!empty($row['verilen_tarih']) ? $row['verilen_tarih'] : "Boş") . "</td>
                <td>" . (!empty($row['alinacak_tarih']) ? $row['alinacak_tarih'] : "Boş") . "</td>
                <td>" . (!empty($row['alici_sinif']) ? $row['alici_sinif'] : "Boş") . "</td>
                <td>" . (!empty($row['alici_no']) ? $row['alici_no'] : "Boş") . "</td>
            </tr>";
        }
    } else {
        $tags = "<tr><td colspan='5'>Kitap bulunamadı!</td></tr>";
    }

    $stmt->close();
    return $tags;
}
function deleteReceiver($conn,$id){
    if(isset($_SESSION['kullanici_adi'])){
        $stmt = $conn->prepare("DELETE FROM verilen_kitaplar WHERE id = ?");
    
        if ($stmt === false) {
            die("Sorgu hazırlama hatası: " . $conn->error);
        }
    
        // ID değerini sorguya bağlıyoruz
        $stmt->bind_param("i", $id);
    
        // Sorguyu çalıştırıyoruz
        if ($stmt->execute()) {
            //echo "Kitap başarıyla silindi.";
            message('success','Alıcı Başarılı Bir Şekilde Silindi !');
        } else {
            //echo "Kitap silinirken hata oluştu: " . $stmt->error;
            message('error','Bir Hata Oluştu');
        }
    
        // Kaynakları temizliyoruz
        $stmt->close();
    }
    else{
        message('error','Kitap Almak İçin Giriş Yapınız');
    }
}
?>

<?php require '../layout/left-panel.php'; ?>
<div class="container">
    <div class="resultTable">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Alıcı</th>
                <th>Kitap İsmi</th>
                <th>Verilen Tarih</th>
                <th>Alınacak Tarih</th>
                <th>Alıcı Sınıf</th>
                <th>Alıcı No</th>
            </tr>
            <tbody>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] === "GET") {
                        if (isset($_GET['textboxSearch']) && !empty($_GET['textboxSearch'])) {
                            // Arama işlemi
                            $name = $_GET['textboxSearch'];
                            echo searchBooksByReceiverName($conn, $name);
                        } else {
                            // Varsayılan listeleme (herhangi bir arama yapılmadığında)
                            echo getAllReceivers($conn);
                        }
                    } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
                        if (isset($_POST['textboxDelete']) && !empty($_POST['textboxDelete'])) {
                            // Silme işlemi
                            $id = $_POST['textboxDelete']; // textboxDelete kullanılıyor olmalıydı
                            echo deleteReceiver($conn, $id);
                            echo getAllReceivers($conn);
                        } else {
                            // Eğer POST isteği boş veya eksikse bir işlem yapılmayacak
                            echo "Lütfen silmek için bir ID giriniz.";
                            message('error','Lütfen ID Numarasını Giriniz');
                        }
                    } else {
                        // Desteklenmeyen bir HTTP yöntemi kullanıldığında
                        message('error','Bir Hata Oluştu !');
                    }
                ?>

            </tbody>
        </table>
    </div>
    <form action="" method="get" class="searchContainer">
        <div class="searchContainer">
            <input placeholder="Alıcı İsmine Göre Arama Yap" type="text" class="textbox" name="textboxSearch">
            <input type="submit" value="Ara" class="btn">
        </div>
    </form>
    <form action="" method="post">
        <div class="deleteContainer">
            <input placeholder="Alıcı ID numarasını Giriniz" type="number" class="textbox" name="textboxDelete">
            <input type="submit" value="Sil" class="btn">
        </div>
    </form>
</div>

<?php require '../layout/footer.php'; ?>