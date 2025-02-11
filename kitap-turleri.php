<?php
    require 'server.php';
    function getAllBookTypes($conn){
        $stmt = $conn->prepare("SELECT * FROM kitap_turleri");
            $stmt->execute();
            $result = $stmt->get_result();
        
            $data = ''; // Eğer hiç satır bulunamazsa da döndürülebilir boş bir string
        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data .= "<option class='optionInput' value=".$row['Turler'].">".$row['Turler']."</option>";
                }
            } else {
                $data = "<tr><td colspan='5'>Kitap bulunamadı!</td></tr>";
            }
        
            $stmt->close();
            return $data;
    }
    echo getAllBookTypes($conn);
?>