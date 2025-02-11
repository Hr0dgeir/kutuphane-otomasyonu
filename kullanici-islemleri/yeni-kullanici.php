<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Yeni Kullanıcı Ekleme");
?>
<?php require '../layout/header.php'; ?>
<?php require '../messageBox.php'; ?>



<link rel="stylesheet" href='../css/yeni-kullanici.css'>
<div class="newAccountContainer">
    <form action="" method="post">
        <div class="nameArea section">
            <label for="">Lütfen İsminizi Giriniz</label>
            <input required name='textboxName' class="textbox" type="text" placeholder="İsminizi Giriniz">
        </div>
        <div class="passwordArea section">
            <label for="">Lütfen Şifrenizi Giriniz</label>
            <input required class="textbox" type="password" placeholder="Şifrenizi Giriniz">
            <input required name='textboxPassword' class="textbox" type="password" placeholder="Şifrenizi Tekrar Giriniz">
        </div>
        <div class="mailArea section">
            <label for="">Lütfen Mail Adresinizi Giriniz</label>
            <input required name='textboxMail' class="textbox" type="mail" placeholder="Mailinizi Giriniz">
        </div>
        <div class="birtdayArea section">
            <label for="">Lütfen Doğum Tarihizi Giriniz</label>
            <input required name='textboxBirthday' class="textbox" type="date" placeholder="Doğum Tarihinizi Giriniz">
        </div>
        <div class="btnArea section">
            <input class="btn" type="submit" value="Oluştur">
        </div>
    </form>
    <button class="btn">
        <a href="kullanici-giris.php" class="btnNewAccLink">Zaten Hesabınız Var mı ?</a>
    </button>
</div>
<?php require '../layout/footer.php'; ?><?php
require '../server.php';
//echo "Bağlantı başarılı!";

function addNewUser($conn,$userName,$userPassword,$userBirthday,$userMail){
    $sql = "INSERT INTO kullanicilar (kullanici_adi, kullanici_sifre, kullanici_dogum_tarihi, kullanici_mail) VALUES ('$userName','$userPassword','$userBirthday','$userMail')";

    if ($conn->query($sql) === TRUE) {
        //echo 'Yeni Kullanici Başarıyla Eklendi !';
        message('success','Kullanıcı Başarılı Bir Şekilde Eklendi !');
    } else {
        //echo "Hata: " . $sql . "<br>" . $conn->error;
        message('error','Bir Hata Oluştu !');
    }
}

function searchMail($conn,$userMail){
    $sql = "SELECT * from kullanicilar where kullanici_mail ='$userMail'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        //echo "true"; // Değer bulundu
        //echo '<script> alert("Bu Mail Adresi Kullanılmakta"); </script>';
        message('error','Bu Mail Adresi Kullanılmakta !');
        return false;
    } else {
        //echo "false"; // Değer bulunamadı
        return true;
    }
    
    mysqli_close($connection);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = htmlspecialchars(trim($_POST['textboxName']));
    $userPassword = htmlspecialchars(trim($_POST['textboxPassword']));
    $userBirthday = filter_var(trim($_POST['textboxBirthday']));
    $userMail = htmlspecialchars(trim($_POST['textboxMail']));

    if ($userName && $userPassword && $userBirthday && $userMail && searchMail($conn,$userMail)) {
        //echo "Kitap başarıyla eklendi.";
        addNewUser($conn,$userName,$userPassword,$userBirthday,$userMail);
        $conn->close();
        exit();
    } else {
        //echo "Lütfen tüm alanları doğru şekilde doldurun.";
    }
}


?>



