<?php

if(isset($_POST["sponsor_naam"])) {
    $error_messages = array(
        $_POST["sponsor_naam"],
        $_POST['linkSponsor'],
        $_FILES['fileToUpload']['name']
    );

    for ($i = 0; $i < count($error_messages) - 1; $i++) {
    }

    if(empty($error_messages[$i])){
        $error_message = "vul alle velden in";
    } else {
        $sponsor_naam = $_POST["sponsor_naam"];
        $link = $_POST['linkSponsor'];
        $sponsor_logo = $_FILES['fileToUpload']['name'];
    }

    if (empty($error_message)) {
        $sql = "INSERT INTO sponsoren (sponsor_naam, sponsor_logo, link) VALUES (:sponsor_naam, :sponsor_logo, :link)";

        if($stmt = $pdo->prepare($sql)){

            $stmt->bindParam(":sponsor_naam", $param_sponsor_naam);
            $stmt->bindParam(":link", $param_link);
            $stmt->bindParam(":sponsor_logo", $param_sponsor_logo);

            $param_sponsor_naam = $sponsor_naam;
            $param_link = $link;
            $param_sponsor_logo = $_FILES['fileToUpload']['name'];
            
            if($stmt->execute()){

            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later nog een keer.";
            }
            unset($stmt);
        }
        unset($pdo);
    }
}