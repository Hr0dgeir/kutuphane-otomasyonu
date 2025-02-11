<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Kitap Ekleme İşlemleri");
?>
<?php require '../layout/header.php'; ?>
<?php require '../messageBox.php'; ?>

<link rel="stylesheet" href="../css/kitap-islemleri/kitap-ekleme.css">
<form action="" class="form" method='post'>
    <div class="formInputArea">
        <label for="">Kitap İsmi</label>
        <input type="text" class="textbox" name="textboxIsmi" required>
    </div>
    <div class="formInputArea">
        <label for="">Kitap Türü</label>
        <!--<input type="text" class="textbox" name="textboxTürü" required>-->
        <select class="optionInput" name="textboxTürü" id="">
            <?php require '../kitap-turleri.php'; 
            //echo getAllBookTypes($conn);
            ?>
        </select>
    </div>
    <div class="formInputArea">
        <label for="">Kitap Sayfa Sayısı</label>
        <input type="text" class="textbox" name="textboxSayfaSayisi" required>
    </div>
    <div class="formInputArea">
        <label for="">Kitap Yazarı</label>
        <input type="text" class="textbox" name="textboxYazar" required>
    </div>
    <div class="buttonsContainer">
        <input type="submit" value="Ekle" class="btn">
        <input type="reset" value="Sil" class="btn"> 
    </div>
</form>
<?php require '../layout/left-panel.php'; ?>
<?php require '../layout/footer.php'; ?><?php
require '../server.php';
//echo "Bağlantı başarılı!";

function addNewBook($conn,$bookName, $bookType, $bookPageCount, $bookAuthor){
    if(isset($_SESSION['kullanici_adi'])){
        //echo 'Kullanıcı adı var : '.$_SESSION['kullanici_adi'];
        $sql = "INSERT INTO kitaplar (kitap_ismi, kitap_türü, kitap_sayfa_sayisi, kitap_yazari) VALUES ('$bookName', '$bookType', '$bookPageCount', '$bookAuthor')";

        if ($conn->query($sql) === TRUE) {
            //echo 'Kitap Başarıyla Eklendi !';
            message('success', 'Kitap Başarılı Bir Şekilde Eklendi !');
        } else {
            //echo "Hata: " . $sql . "<br>" . $conn->error;
            message('error', 'Bir Hata Oluştu !');
        }
    }
    else{
        //echo 'Kullanıcı Adı Yok';
        message('error','Kitap Eklemek İçin Giriş Yapınız');
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kitapIsmi = htmlspecialchars(trim($_POST['textboxIsmi']));
    $kitapTuru = htmlspecialchars(trim($_POST['textboxTürü']));
    $kitapSayfaSayisi = filter_var(trim($_POST['textboxSayfaSayisi']), FILTER_VALIDATE_INT);
    $kitapYazar = htmlspecialchars(trim($_POST['textboxYazar']));

    if ($kitapIsmi && $kitapTuru && $kitapSayfaSayisi && $kitapYazar) {
        //echo "Kitap başarıyla eklendi.";
        addNewBook($conn,$kitapIsmi,$kitapTuru,$kitapSayfaSayisi,$kitapYazar);
        $conn->close();
        //header("Location: kitap-ekleme.php");
        //echo "<script>window.location.href='kitap-ekleme.php';</script>";
        //exit(); // Yönlendirme sonrası kod çalışmasını durdurmak için exit() kullanıyoruz
    } else {
        //echo "Lütfen tüm alanları doğru şekilde doldurun.";
        message('error', 'Lütfen Tüm Alanları Doldurunuz');
    }
}
?>
