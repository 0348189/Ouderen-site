<?php

if(isset($_POST["titel"])) {
    $error_messages = array(
        $_POST["titel"],
        $_POST["capiciteit"],
        $_FILES['fileToUpload']['name'],
        $_POST["tijd"],
        $_POST["datum"],
        $_POST["soort"],
        $_POST["beschrijving"],
    );

    for ($i = 0; $i < count($error_messages) - 1; $i++) {
    }

    if(empty($error_messages[$i])){
        $error_message = "vul alle velden in";
    } else {
        $titel = $_POST["titel"];
        $capiciteit = $_POST["capiciteit"];
        $img = $_FILES['fileToUpload']['name'];
        $tijd = $_POST["tijd"];
        $datum = $_POST["datum"];
        $soort = $_POST["soort"];
        $beschrijving = $_POST["beschrijving"];
    }

    if (empty($error_message)) {
        $sql = "INSERT INTO evenementen (titel, capiciteit, img, tijd, datum, soort, beschrijving) VALUES (:titel, :capiciteit, :img, :tijd, :datum, :soort, :beschrijving)";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":titel", $param_titel);
            $stmt->bindParam(":capiciteit", $param_capiciteit);
            $stmt->bindParam(":img", $param_img);
            $stmt->bindParam(":tijd", $param_tijd);
            $stmt->bindParam(":datum", $param_datum);
            $stmt->bindParam(":soort", $param_soort);
            $stmt->bindParam(":beschrijving", $param_beschrijving);
          
            $param_titel = $titel;
            $param_capiciteit = $capiciteit;
            $param_img = $_FILES['fileToUpload']['name'];
            $param_tijd = $tijd;
            $param_datum = $datum;
            $param_soort = $soort;
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