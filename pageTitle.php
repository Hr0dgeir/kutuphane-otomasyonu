<?php
    function test($name = "Varsayılan Başlık"){
        $title = $name;
        $cookie_name = "pagetitle";
        $cookie_expireDate = time() + 86400;
        setcookie($cookie_name, $title, $cookie_expireDate, "/"); 
        echo "<script> document.title = '" . $title . "'; </script>";
        //echo $title;
    }
    /*
    function test($name = "Varsayılan Başlık"){
        $_SESSION['pagetitle'] = $name; // Başlığı oturumda sakla
    }
    */
    //test('Bu bir testtir');
?>