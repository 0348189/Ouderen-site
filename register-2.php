<?php
session_start();

include 'include/db_connect.php';
include 'include/header.php';
require_once "include/config.php";

$voornaam = $tussenvoegsel = $achternaam = $geboortedatum = $email = $telefoonnummer = $wachtwoord = $straatnaam = $huisnummer = $postcode = $woonplaats = "";
$voornaam_err = $tussenvoegsel_err = $achternaam_err = $geboortedatum = $email_err = $telefoonnummer_err = $wachtwoord_err = $straatnaam_err = $huisnummer_err = $postcode_err = $woonplaats_err = "";
$email = $_SESSION['email'];
$telefoonnummer = $_SESSION['telefoonnummer'];
$wachtwoord = $_SESSION['wachtwoord'];

if (empty($email) || empty($telefoonnummer) || empty($wachtwoord)) {
    header('location: register.php');
}

if(isset($_POST["voornaam"])){

    if(empty(trim($_POST["voornaam"]))){
        $voornaam_err = "Voer uw voornaam in.";     
    } else {
        $voornaam = trim($_POST["voornaam"]);
    }

    $tussenvoegsel = trim($_POST["tussenvoegsel"]);

    if(empty(trim($_POST["achternaam"]))){
        $achternaam_err = "Voer uw achternaam in.";     
    } else {
        $achternaam = trim($_POST["achternaam"]);
    }

    if(empty(trim($_POST["geboortedatum"]))){
        $geboortedatum_err = "Voer uw geboortedatum in.";     
    } elseif(substr($_POST['geboortedatum'], 0 , 4 ) >= 2023 || strlen($_POST['geboortedatum']) > 10) { 
        $geboortedatum_err = "Voer een jaar in onder de 2023";
    } else {
        $geboortedatum = trim($_POST["geboortedatum"]);
    }

    if(empty(trim($_POST["straatnaam"]))){
        $straatnaam_err = "Voer uw straatnaam in.";     
    } else {
        $straatnaam = trim($_POST["straatnaam"]);
    }

    if(empty(trim($_POST["huisnummer"]))){
        $huisnummer_err = "Voer uw huisnummer in.";     
    } else {
        $huisnummer = trim($_POST["huisnummer"]);
    }

    if(empty(trim($_POST["postcode"]))){
        $postcode_err = "Voer uw postcode in.";     
    } else {
        $postcode = trim($_POST["postcode"]);
    }

    if(empty(trim($_POST["woonplaats"]))){
        $woonplaats_err = "Voer uw woonplaats in.";     
    } else {
        $woonplaats = trim($_POST["woonplaats"]);
    }

    if(empty($voornaam_err) && empty($tussenvoegsel_err) && empty($achternaam_err) && empty($geboortedatum_err) && empty($email_err) && empty($telefoonnummer_err) && empty($wachtwoord_err) && empty($straatnaam_err) && empty($huisnummer_err) && empty($postcode_err) && empty($woonplaats_err)){    
        $sql = "INSERT INTO users (voornaam, tussenvoegsel, achternaam, geboortedatum, email, telefoonnummer, wachtwoord, straatnaam, huisnummer, postcode, woonplaats) VALUES (:voornaam, :tussenvoegsel, :achternaam, :geboortedatum, :email, :telefoonnummer, :wachtwoord, :straatnaam, :huisnummer, :postcode, :woonplaats)";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":voornaam", $param_voornaam);
            $stmt->bindParam(":tussenvoegsel", $param_tussenvoegsel);
            $stmt->bindParam(":achternaam", $param_achternaam);
            $stmt->bindParam(":geboortedatum", $param_geboortedatum);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":telefoonnummer", $param_telefoonnummer);
            $stmt->bindParam(":wachtwoord", $param_wachtwoord);
            $stmt->bindParam(":straatnaam", $param_straatnaam);
            $stmt->bindParam(":huisnummer", $param_huisnummer);
            $stmt->bindParam(":postcode", $param_postcode);
            $stmt->bindParam(":woonplaats", $param_woonplaats);
            
            $param_voornaam = $voornaam;
            $param_tussenvoegsel = $tussenvoegsel;
            $param_achternaam = $achternaam;
            $param_geboortedatum = $geboortedatum;
            $param_email = $email;
            $param_telefoonnummer = $telefoonnummer;    
            $param_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $param_straatnaam = $straatnaam;
            $param_huisnummer = $huisnummer;
            $param_postcode = $postcode;
            $param_woonplaats = $woonplaats;
            
            if($stmt->execute()){

            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later nog een keer.";
            }
            unset($stmt);
        }
    header('location: login.php');
    }
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registreer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/login.register.style.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="shortcut icon" href="images/logo.png">
    <style>
        .wrapper{ width: 100%;}
        .reset { margin-left: 5%;}
    </style>
</head>
<body>
    <section>
        <div class="login-box2">
            <div class="wrapper">
            <br><br>
                <h2>Lid worden</h2><br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="flex-container">
                        <div class="content1 content">
                            <div class="form-group input-box">
                            <label>Voornaam</label>
                                <input type="text" name="voornaam" class="form-control <?php echo (!empty($voornaam_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $voornaam; ?>">
                                <span class="invalid-feedback"><?php echo $voornaam_err; ?></span>
                            </div>
                            <div class="form-group input-box">
                                <label>Tussenvoegsels</label>
                                <input type="text" name="tussenvoegsel" placeholder="optioneel" class="form-control <?php echo (!empty($tussenvoegsel_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tussenvoegsel; ?>">
                                <span class="invalid-feedback"><?php echo $tussenvoegsel_err; ?></span>
                            </div>
                            <div class="form-group input-box">
                                <label>Achternaam</label>
                                <input type="text" name="achternaam" class="form-control <?php echo (!empty($achternaam_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $achternaam; ?>">
                                <span class="invalid-feedback"><?php echo $achternaam_err; ?></span>
                            </div>
                        </div>
                        <div class="content2 content">
                            <div class="form-group input-box">
                                <label>Geboortedatum</label>
                                <input type="date" name="geboortedatum" class="form-control <?php echo (!empty($geboortedatum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $geboortedatum; ?>">
                                <span class="invalid-feedback"><?php echo $geboortedatum_err; ?></span>
                            </div>
                        </div>
                        <div class="content3 content">
                            <div class="form-group input-box">
                                <label>Straatnaam</label>
                                <input type="text" name="straatnaam" class="form-control <?php echo (!empty($straatnaam_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $straatnaam; ?>">
                                <span class="invalid-feedback"><?php echo $straatnaam_err; ?></span>
                            </div>
                            <div class="form-group input-box">
                                <label>Huisnummer</label>
                                <input type="text" name="huisnummer" class="form-control <?php echo (!empty($huisnummer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $huisnummer; ?>">
                                <span class="invalid-feedback"><?php echo $huisnummer_err; ?></span>
                            </div>
                        </div>
                        <div class="content6 content">
                            <div class="form-group input-box">
                                <label>Postcode</label>
                                <input type="text" name="postcode" class="form-control <?php echo (!empty($postcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $postcode; ?>">
                                <span class="invalid-feedback"><?php echo $postcode_err; ?></span>
                            </div>
                            <div class="form-group input-box">
                                <label>woonplaats</label>
                                <input type="text" name="woonplaats" class="form-control <?php echo (!empty($woonplaats_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $woonplaats; ?>">
                                <span class="invalid-feedback"><?php echo $woonplaats_err; ?></span>
                            </div>
                        </div>
                        <div class="content7 content">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary button" value="Lid worden" name="registreer"><input type="reset" class="btn btn-primary reset" value="reset" style="background-color:grey; border-color:grey;"><br><br>
                                <p>Bent u al lid? <a href="login.php">Login hier</a>.<p>
                            </div>
                        </div>
                    </div><br>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <?php include 'include/footer.php';?>
    </footer>
</body>
</html>