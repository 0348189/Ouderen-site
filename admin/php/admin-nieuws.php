<?php

if(isset($_POST["titel"])) {
    $error_messages = array(
        $_POST["titel"],
        $_FILES['fileToUpload']['name'],
        $_POST["link"],
        $_POST["beschrijving"]
    );

    for ($i = 0; $i < count($error_messages) - 1; $i++) {
    }

    if(empty($error_messages[$i])){
        $error_message = "vul alle velden in";
    } else {
        $titel = $_POST["titel"];
        $foto = $_FILES['fileToUpload']['name'];
        $link = $_POST["link"];
        $beschrijving = $_POST["beschrijving"];
    }

    if (empty($error_message)) {
        $sql = "INSERT INTO nieuws (titel, foto, link, beschrijving) VALUES (:titel, :foto, :link, :beschrijving)";

        if($stmt = $pdo->prepare($sql)){

            $stmt->bindParam(":titel", $param_titel);
            $stmt->bindParam(":foto", $param_foto);
            $stmt->bindParam(":link", $param_link);
            $stmt->bindParam(":beschrijving", $param_beschrijving);

            $param_titel = $titel;
            $param_foto = $_FILES['fileToUpload']['name'];
            $param_link = $link;
            $param_beschrijving = $beschrijving;
            
            if($stmt->execute()){

            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later nog een keer.";
            }
            unset($stmt);
        }
        unset($pdo);
    }
}