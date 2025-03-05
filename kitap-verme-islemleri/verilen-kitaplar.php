<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Verilen Kitaplar");
?>
<?php require '../layout/header.php'; ?>

<link rel="stylesheet" href="http://localhost/kutuphane_otomasyon/css/kitap-verme-islemleri/verilen-kitaplar.css">

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
?>

<?php require '../layout/left-panel.php'; ?>
<div class="container">
    <div class="resultTable">
        <table border="1">
            <tr>
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
                    } else {
                        echo getAllReceivers($conn);
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