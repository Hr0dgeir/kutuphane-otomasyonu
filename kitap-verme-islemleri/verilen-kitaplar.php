

<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Verilen Kitaplar");
?>
<?php require '../layout/header.php'; ?>

<link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/kitap-verme-islemleri/verilen-kitaplar.css">

<?php
require '../server.php';

function getBookById($conn, $bookID) {
    $stmt = $conn->prepare("SELECT * FROM verilen_kitaplar WHERE ID = ?");
    $stmt->bind_param("i", $bookID);
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = ''; 

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tags .= "<tr id='" . htmlspecialchars($row['ID'], ENT_QUOTES) . "'>
                <td>" . (!empty($row['ID']) ? htmlspecialchars($row['ID'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['alici']) ? htmlspecialchars($row['alici'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['kitap_ismi']) ? htmlspecialchars($row['kitap_ismi'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['verilen_tarih']) ? htmlspecialchars($row['verilen_tarih'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['alinacak_tarih']) ? htmlspecialchars($row['alinacak_tarih'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['alici_sinif']) ? htmlspecialchars($row['alici_sinif'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['alici_no']) ? htmlspecialchars($row['alici_no'], ENT_QUOTES) : "Boş") . "</td>
            </tr>";

            // Tek bir kitap getirildiği için burada da kırmızı yapalım
            $alinacakTarih = new DateTime($row['alinacak_tarih']);
            $today = new DateTime();

            if ($alinacakTarih < $today) {
                $tags .= "<script>document.getElementById('" . $row['ID'] . "').classList.add('red');</script>";
            }
        }
    } else {
        $tags = "<tr><td colspan='7'>Kitap bulunamadı!</td></tr>";
    }

    $stmt->close();
    return $tags;
}



function searchBooksByReceiverName($conn, $receiverName) {
    $stmt = $conn->prepare("SELECT * FROM verilen_kitaplar WHERE alici LIKE ?");
    $searchTerm = "%$receiverName%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = ''; 
    $today = new DateTime(); // Bugünün tarihi

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $alinacakTarih = new DateTime($row['alinacak_tarih']); // Tarihi DateTime formatına çevir

            // Eğer tarihi geçmişse kırmızı renk ekle
            $rowClass = ($alinacakTarih < $today) ? "red" : "";

            $tags .= "<tr id='" . htmlspecialchars($row['ID'], ENT_QUOTES) . "' class='$rowClass'>
                <td>" . (!empty($row['ID']) ? htmlspecialchars($row['ID'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['alici']) ? htmlspecialchars($row['alici'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['kitap_ismi']) ? htmlspecialchars($row['kitap_ismi'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['verilen_tarih']) ? htmlspecialchars($row['verilen_tarih'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['alinacak_tarih']) ? htmlspecialchars($row['alinacak_tarih'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['alici_sinif']) ? htmlspecialchars($row['alici_sinif'], ENT_QUOTES) : "Boş") . "</td>
                <td>" . (!empty($row['alici_no']) ? htmlspecialchars($row['alici_no'], ENT_QUOTES) : "Boş") . "</td>
            </tr>";
        }
    } else {
        $tags = "<tr><td colspan='7'>Kitap bulunamadı!</td></tr>";
    }

    $stmt->close();
    return $tags;
}


function checkUserBookTime($conn) {
    $stmt = $conn->prepare("SELECT alinacak_tarih, ID FROM verilen_kitaplar");
    $stmt->execute();
    $results = $stmt->get_result();

    $today = new DateTime();
    $overdueBooks = []; // Tarihi geçmiş kitapları saklayacak dizi

    while ($row = $results->fetch_assoc()) {
        $alinacakTarih = new DateTime($row['alinacak_tarih']);
        if ($alinacakTarih < $today) { 
            $overdueBooks[] = $row['ID']; // Geciken kitapları listeye ekliyoruz
        }
    }

    if (!empty($overdueBooks)) {
        echo '<script>';
        foreach ($overdueBooks as $bookID) {
            echo 'document.getElementById("' . $bookID . '").classList.add("red");';
        }
        echo '</script>';
    }
}


function getAllReceivers($conn) {
    $stmt = $conn->prepare("SELECT * FROM verilen_kitaplar");
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = ''; // Eğer hiç satır bulunamazsa da döndürülebilir boş bir string

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tags .= "<tr id=".$row['ID'].">
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
?>

<?php require '../layout/left-panel.php'; ?>
<div class="container">
    <div class="resultTable">
        <table border="1">
            <tr id="Values" class="table-titles">
                <th>ID</th>
                <th>Alıcı Adı</th>
                <th>Alınan Kitap İsmi</th>
                <th>Verilen Tarih</th>
                <th>Alınacak Tarih</th>
                <th>Alıcı Sınıf</th>
                <th>Alıcı No</th>
            </tr>
            <tbody id="tableContainer">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['textboxReceiverName']) && !empty($_GET['textboxReceiverName'])) {
                        $name = $_GET['textboxReceiverName'];
                        echo searchBooksByReceiverName($conn, $name);
                        checkUserBookTime($conn);
                    } else {
                        if(isset($_GET['id'])){
                            $bookId = $_GET['id'];
                            echo getBookById($conn,$bookId);
                            checkUserBookTime($conn);
                        }
                        else{
                            echo getAllReceivers($conn);
                            checkUserBookTime($conn);
                        }
                        
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="searchContainer">
        <form action="" method="get">
            <input name="textboxReceiverName" type="text" placeholder="Alıcı Adına Göre Arama Yap" class="textbox">
            <input type="submit" value="Ara" class="btn" id="btnDelete">
        </form>
    </div>
</div>

<?php require '../layout/footer.php'; ?>