<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Kitap Arama İşlemleri");
?>
<?php require '../layout/header.php'; ?>

<link rel="stylesheet" href="../css/kitap-islemleri/kitap-arama.css">

<?php
require '../server.php';
function searchBookByName($conn, $bookName) {
    //echo "<script> alert('Hello World!'); </script>";
    $stmt = $conn->prepare("SELECT * FROM kitaplar WHERE kitap_ismi like ?");
    $searchTerm = "%$bookName%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $books = []; // Verileri saklamak için bir array oluştur

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $books[] = $row; // Her satırı array'e ekle
        }
    } else {
        //echo "Kitap bulunamadı!";
    }
    
    $stmt->close();
    return $books; // Verileri döndür
}

function searchByType($conn, $value){
    //echo "<script> alert('Hello World!'); </script>";
    $stmt = $conn->prepare("SELECT * FROM kitaplar WHERE kitap_türü = ?");
    $stmt->bind_param("s", $value);  // Doğru şekilde bind param kullanımı
    $stmt->execute();
    $result = $stmt->get_result();
    
    $books = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $books[] = $row; 
        }
    } else {
        //echo "Kitap bulunamadı!";
    }
    
    $stmt->close();
    return $books;
}


function searchByAuthor($conn,$bookAuthor){
    //echo "<script> alert('Hello World!'); </script>";
    $stmt = $conn->prepare("SELECT * FROM kitaplar WHERE kitap_yazari LIKE ?");
    $searchTerm = "%$bookAuthor%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $books = []; // Verileri saklamak için bir array oluştur

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $books[] = $row; // Her satırı array'e ekle
        }
    } else {
        //echo "Kitap bulunamadı!";
    }
    
    $stmt->close();
    return $books; // Verileri döndür
}



$bookNameIsActive = false;
$selectTypeIsActive = false;
$bookAuthorIsActive = false;

// POST isteği ile form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Book name search
    if (isset($_POST['textboxName']) && !empty($_POST['textboxName'])) {
        $bookName = $_POST['textboxName'];
        $bookNameIsActive = true;
        $kitaplar = searchBookByName($conn, $bookName);
    } else {
        //echo "Kitap ismi boş olamaz.";
    }

    // Book type search
    if (isset($_POST['typeSelect']) && !empty($_POST['typeSelect'])) {
        $selectType = $_POST['typeSelect'];
        $selectTypeIsActive = true;
        $kitaplarByType = searchByType($conn, $selectType);
    } else {
        //echo "Kitap türü seçilmelidir.";
    }

    // Book author search
    if (isset($_POST['textboxAuthor']) && !empty($_POST['textboxAuthor'])) {
        $bookAuthor = $_POST['textboxAuthor'];
        $bookAuthorIsActive = true;
        $kitaplarByAuthor = searchByAuthor($conn, $bookAuthor);
    } else {
        //echo "Kitap yazarı boş olamaz.";
    }
} else {
    //echo "Form gönderimi hatalı.";
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
<?php require '../layout/left-panel.php'; ?>
<div class="container">
    <div class="resultTable">
        <table border="1">
            <tr class="table-titles">
                <th>Kitabın Numarası</th>
                <th>Kitabın İsmi</th>
                <th>Kitabın Türü</th>
                <th>Kitabın Sayfa Sayısı</th>
                <th>Kitabın Yazarı</th>
            </tr>
            <tbody id='tableBody'>
                <?php
                    if ($bookNameIsActive || $selectTypeIsActive || $bookAuthorIsActive) {
                        $bookList = [];
                        if ($bookNameIsActive) {
                            $bookList = $kitaplar;
                            $bookNameIsActive = false;
                        }
                        if ($selectTypeIsActive) {
                            $bookList = array_merge($bookList, $kitaplarByType);
                            $selectTypeIsActive = false;
                        }
                        if ($bookAuthorIsActive) {
                            $bookList = array_merge($bookList, $kitaplarByAuthor);
                            $bookAuthorIsActive = false;
                        }
                        foreach ($bookList as $kitap) {
                            echo "
                            <tr> 
                                <td>" . $kitap['ID'] . "</td>
                                <td>" . $kitap['kitap_ismi'] . "</td>
                                <td>" . $kitap['kitap_türü'] . "</td>
                                <td>" . $kitap['kitap_sayfa_sayisi'] . "</td>
                                <td>" . $kitap['kitap_yazari'] . "</td>
                            </tr>";
                        }
                    } else{
                        echo getAllBooks($conn);
                    }
                ?>
            </tbody>
            
        </table>
    </div>

    <div class="options">
        <form action="" method="post">
            <div class="InputArea">
                <div class="typeContainer container">
                    <label for="">Lütfen Kitap Türünü Seçiniz</label>
                    <select name="typeSelect" id="" class="selectBox">
                        <?php require '../kitap-turleri.php'; ?>
                    </select>
                </div>
                <div class="nameContainer container">
                    <label for="">Lütfen Kitabın İsmini Giriniz</label>
                    <input name="textboxName" type="text" placeholder="Kitap İsmi" class="textbox">
                </div>
                <div class="authorContainer container">
                    <label for="">Lütfen Kitap Yazarını Giriniz</label>
                    <input name="textboxAuthor" type="text" placeholder="Kitap Yazarı" class="textbox">
                </div>
            </div>
            <div class="buttonsArea">
                <input type="submit" value="Ara" class="btn">
            </div>
        </form>
    </div>
</div>



<?php require '../layout/footer.php'; ?>