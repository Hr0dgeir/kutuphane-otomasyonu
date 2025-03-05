<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Kitap Verme İşlemleri");
?>
<?php require '../layout/header.php'; ?>
<?php require '../messageBox.php';?>

<?php
require '../server.php';

function addNewReceiver($conn,$receiverName, $bookName, $date, $receiverClass, $receiverNo, $dateToTake){
    if(isset($_SESSION['kullanici_adi'])){
        $sql = "INSERT INTO verilen_kitaplar (alici, kitap_ismi, verilen_tarih, alici_sinif ,alici_no,alinacak_tarih) VALUES ('$receiverName', '$bookName', '$date', '$receiverClass', '$receiverNo','$dateToTake')";

        if ($conn->query($sql) === TRUE) {
            //echo 'Yeni Alıcı Başarıyla Eklendi !';
            message('success','Yeni Alıcı Başarılı Bir Şekilde Eklendi !');
        } else {
            //echo "Hata: " . $sql . "<br>" . $conn->error;
            message('error','Bir Hata Oluştu !');
        }
    }
    else{
        message('error','Kitap Vermek İçin Giriş Yapınız');
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['textboxName']) && isset($_POST['textboxBookName']) && isset($_POST['textboxDate']) && isset($_POST['textboxClass']) && isset($_POST['textboxNo'])){
       $rName = $_POST['textboxName'];
       $bookName = $_POST['textboxBookName'];
       $date = $_POST['textboxDate'];
       $rClass = $_POST['textboxClass'];
       $rNo = $_POST['textboxNo']; 

       $daysplus15 = new DateTime($date);
       $daysplus15->modify('+15 days');
       $daysplus15 = $daysplus15->format('Y-m-d');
       
       //echo $daysplus15->format('Y-m-d');
       
       addNewReceiver($conn,$rName, $bookName, $date, $rClass, $rNo , $daysplus15);
    }
}
?>

<?php require '../layout/left-panel.php'; ?>
<link rel="stylesheet" href="../css/kitap-verme-islemleri/kitap-verme.css">
<div class="container">
    <form action="" method="POST">
        <div class="receiverNameArea section">
            <label for="">Alıcı İsmini Giriniz</label>
            <input placeholder="Alıcı İsmini Girin" required name="textboxName" type="text" class="textbox">
        </div>
        <div class="receiverBookNameArea section">
            <label for="">Verilen Kitap İsmini Giriniz</label>
            <input placeholder="Verilen Kitap İsmini Girin" required name="textboxBookName" type="text" class="textbox">
        </div>
        <div class="receiverDateArea section">
            <label for="">Verilen Tarihi Giriniz</label>
            <input placeholder="Verilen Tarihi Girin" required name="textboxDate" type="date" class="textbox">
        </div>
        <div class="receiverClassArea section">
            <label for="">Alıcı Sınıfını Giriniz</label>
            <input placeholder="Alıcı Sınıfını Girin" required name="textboxClass" type="text" class="textbox">
        </div>
        <div class="receiverSchoolNumberArea section">
            <label for="">Alıcı Okul Numarasını Giriniz</label>
            <input placeholder="Alıcı Numarasıni Girin" required name="textboxNo" type="number" class="textbox">
        </div>
        <div class="buttonsArea section">
            <input type="submit" value="Ekle" class="btn">
        </div>
    </form>
</div>


<?php require '../layout/footer.php'; ?>