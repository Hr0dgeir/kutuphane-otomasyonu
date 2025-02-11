<?php require_once '../pageTitle.php';
test("Kütüphane Otamasyonu | Kullanıcı İşlemleri");
?>
<?php require '../layout/header.php'; ?>

<link rel="stylesheet" href="../css/kullanici-islemleri.css">

<div class="container">
    <div class="leftPart">
        <div class="userActionContainer">
            <div class="picture">
                <img src="pictures/indir (5).png" alt="kullanici-resmi" class="img">
            </div>
            <button class="btn">
                Resmi Değiştir
            </button>
            <div class="userInformationsContainer">
                <form action="" method="post">
                    <button class="btn" name="btnPassword">Şifreyi Güncelle</button>
                    <button class="btn" name="btnName">İsmini Güncelle</button>
                    <button class="btn" name="btnBirthday">Mail Adresini Güncelle</button>
                    <button class="btn" name="btnBirthday">Doğum Tarihini Güncelle</button>
                </form> 
            </div>
        </div>
        
    </div>
    <div class="rightPart" id="rightPartID">
        <div class="changePasswordSection">
            <div class="oldPassword">
                <input class="textbox" type="password" placeholder="Lütfen Eski Şifrenizi Giriniz">
            </div>
            <div class="newPassword">
                <form action="">
                    <input class="textbox" type="password" placeholder="Lütfen Yeni Şifrenizi Giriniz">
                    <input class="textbox" type="password" placeholder="Lütfen Tekrar Giriniz">
                    <input class="btn" type="submit" value="Değiştir">
                </form>
            </div>
        </div>
    </div>
</div>
<?php require '../layout/footer.php'; ?><?php

?>


