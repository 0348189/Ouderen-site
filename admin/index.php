<head>
    <meta charset="UTF-8">
    <title>PCOB Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="img/logo.png">
</head>

<?php

include '../include/db_connect.php';
include '../include/config.php';

session_start();

if (isset($_SESSION["is_logged_in"])) {
} else {
    header('Location: login.php');
}

$titel = $foto = $link = $beschrijving = $home_beschrijving = $sponsor_naam = $sponsor_logo = "";
$error_message = "";

if (isset($_FILES["fileToUpload"])) {
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


if (isset($_POST["capiciteit"])) {
    include_once 'php/admin-evenementen.php';
}

if (isset($_POST["link"])) {
    include_once 'php/admin-nieuws.php';
}

if (isset($_POST["sponsor_naam"])) {
    include_once 'php/admin-sponsor.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<body translate="no">
    <h2>PCOB Admin Dashboard</h2>
    <div class="warpper">
        <input class="radio" id="one" name="group" type="radio" checked="">
        <input class="radio" id="two" name="group" type="radio">
        <input class="radio" id="three" name="group" type="radio">
        <div class="tabs">
            <label class="tab" id="one-tab" for="one">Evenementen info toevoegen</label>
            <label class="tab" id="two-tab" for="two">Nieuws toevoegen</label>
            <label class="tab" id="three-tab" for="three">Sponsoren toevoegen</label>
            <label class="tab" id="four-tab" for="four"><a href="logout.php">Uitloggen</a></label>
            <label class="tab" id="five-tab" for="five"><a href="../index.php">Home pagina</a></label>
        </div>
        <div class="panels">
            <div class="panel" id="one-panel">
                <div class="panel-title">Evenementen info toevoegen</div>
                <p>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    Selecteer een foto:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="text" name="titel" id="titel" minlength="1" maxlength="255" placeholder="titel"><br><br>
                    <input type="text" name="capiciteit" id="capiciteit" minlength="1" maxlength="255" placeholder="capaciteit"><br><br>
                    <input type="text" name="tijd" id="tijd" minlength="1" maxlength="255" placeholder="tijd"><br><br>
                    <input type="text" name="datum" id="datum" minlength="1" maxlength="255" placeholder="datum"><br><br>
                    <input type="text" name="soort" id="soort" minlength="1" maxlength="255" placeholder="soort"><br><br>
                    <textarea name="beschrijving" id="beschrijving" rows="15" cols="65" minlength="1" maxlength="255" placeholder="beschrijving"></textarea><?php echo $error_message; ?><br><br>
                    <input type="submit" value="Upload afbeelding" name="submit">
                </form>
                </p>
            </div>
            <div class="panel" id="two-panel">
                <div class="panel-title">Nieuws toevoegen</div>
                <p>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    Selecteer een foto:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="text" name="titel" id="titel" minlength="1" maxlength="255" placeholder="titel"><br><br>
                    <input type="text" name="link" id="link" minlength="1" maxlength="255" placeholder="link"><br><br>
                    <textarea name="beschrijving" id="beschrijving" rows="15" cols="65" minlength="1" placeholder="beschrijving"></textarea><?php echo $error_message; ?><br><br>
                    <input type="submit" value="Upload afbeelding" name="submit">
                </form>
                </p>
            </div>
            <div class="panel" id="three-panel">
                <div class="panel-title">Sponsoren toevoegen</div>
                <p>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    Selecteer een foto:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="text" name="linkSponsor" id="linkSponsor" minlength="1" maxlength="255" placeholder="link"><br><br>
                    <input type="text" name="sponsor_naam" id="sponsor_naam" minlength="1" maxlength="255" placeholder="sponsor_naam"><br><br>
                    <input type="submit" value="Upload afbeelding" name="submit">
                </form>
                </p>
            </div>
        </div>
    </div>
</body>

</html>