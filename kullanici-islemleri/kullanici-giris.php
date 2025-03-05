<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Kullanıcı Giriş");
?>
<?php require '../layout/header.php'; ?>
<?php require '../messageBox.php';?>
<link rel="stylesheet" href="../css/kullanici-islemleri/kullanici-giris.css">
<div class="container-user-login">
    <div class="userLogin">
        <form action="" method="post">
            <div class="section mailArea">
                <label for="">Mail Adresinizi Giriniz</label>
                <input class="textbox" type="mail" required name="textboxMail" placeholder="Mail Adresinizi Giriniz">
            </div>
            <div class="section passwordArea">
                <label for="">Lütfen Şifrenizi Giriniz</label>
                <input placeholder="Şifrenizi Giriniz" type="password" required class="textbox" name="textboxPassword">
            </div>
            <div class="section buttonArea">
                <input class="btn" type="submit" value="Giriş Yap">
            </div>
        </form>
        <button class="btn">
            <a href="yeni-kullanici.php" class="btnNewAccLink">Yeni Hesap Oluşturun</a>
        </button>
    </div>
</div>

<?php require '../layout/left-panel.php'; ?>
<?php require '../layout/footer.php'; ?><?php 
require '../server.php';
//echo "Bağlantı başarılı!";


//
function checkUser($conn, $userMail,$userPassword) {
    // Basit SELECT sorgusu
    $sql = "SELECT kullanici_sifre FROM kullanicilar WHERE kullanici_mail = '$userMail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu
        $userData = $result->fetch_assoc();  // Veriyi al
        //echo 'Kişi Başarıyla bulundu';
        //print_r($userData);
        $password = $userData['kullanici_sifre'];
        if($password == $userPassword){
            //echo 'Giriş Başarılı';
            getUserName($conn, $userMail);
        }
        else{
            //echo 'Giriş Başarısız';
            return false;
        }
        
        //print_r();  // Kullanıcı verilerini ekrana yazdır
    } else {
        //echo 'Kişi bulunamadı';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userMail = $_POST['textboxMail'];  // Formdan gelen mail adresini al
    $userPassword = $_POST['textboxPassword'];
    if(checkUser($conn, $userMail,$userPassword)){
        //echo 'Giriş Başarılı';
        $conn->close();
        //header("Location: " . $_SERVER['PHP_SELF']);  // Sayfayı yenile
    }
    else{
        //echo 'Giriş Başarısız';
        $conn->close();
        //header("Location: " . $_SERVER['PHP_SELF']);  // Sayfayı yenile
    }
    
    exit();
}
function getUserName($conn, $userMail){
    $sql = "SELECT kullanici_adi FROM kullanicilar WHERE kullanici_mail = '$userMail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu
        $userData = $result->fetch_assoc();  // Veriyi al
        //echo 'Kişi Başarıyla bulundu';
        //print_r($userData);
        $userName = $userData['kullanici_adi'];
        if($userMail){
            //echo 'Giriş Başarılı';
            message('success','Giriş Başarılı ! Ana Sayfaya Yönlendiriliyorsunuz.');
            echo '<script>
                setTimeout(function() {
                    window.location.href = "../index.php";
                }, 2000);
            </script>'; 
            //session_start();
            $_SESSION['kullanici_adi'] = $userName;
            return true;
        }
        else{
            //echo 'Giriş Başarısız';
            message('error','Giriş Başarısız !');
            return false;
        }
        
        //print_r();  // Kullanıcı verilerini ekrana yazdır
    } else {
        //echo 'Kişi bulunamadı';
        message('error','Kişi Bulunamadı !');
    }
}
?>

