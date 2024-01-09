<?php
session_start();
include 'include/db_connect.php';
include 'include/header.php';
require_once "include/config.php";

$email = $telefoonnummer = $wachtwoord = $bevestig_wachtwoord = "";
$email_err = $telefoonnummer_err = $wachtwoord_err = $bevestig_wachtwoord_err = "";

if(isset($_POST["email"])){

    if(empty(trim($_POST["email"]))){
        $email_err = "Voer een E-mailadres in.";
    } else{
        $sql = "SELECT id FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            $param_email = trim($_POST["email"]);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "Dit E-mail is al in gebruik.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later nog een keer.";
            }

            unset($stmt);
        }
    }

    if(empty(trim($_POST["telefoonnummer"]))){
        $telefoonnummer_err = "Voer uw telefoonnummer in.";     
    } elseif(strlen(str_replace(' ', '', $_POST["telefoonnummer"])) !== 10){
        $telefoonnummer_err = "Uw telefoonnummer is niet 10 cijfers.";
    } elseif(!is_numeric(str_replace(' ', '', $_POST["telefoonnummer"]))){
        $telefoonnummer_err = "Een geldig telefoonnummer kan alleen cijfers bevatten";
    } else {
        $sql = "SELECT id FROM users WHERE telefoonnummer = :telefoonnummer";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":telefoonnummer", $param_telefoonnummer, PDO::PARAM_STR);
            
            $param_telefoonnummer = trim($_POST["telefoonnummer"]);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $telefoonnummer_err = "Dit telefoonnumer is al in gebruik.";
                } else{
                    $telefoonnummer = trim($_POST["telefoonnummer"]);
                }
            } else{
                echo "Oeps! Er is iets fout gegaan. Probeer het later nog een keer.";
            }
    
            unset($stmt);
        }
    }

    if(empty(trim($_POST["wachtwoord"]))){
        $wachtwoord_err = "Voer een wachtwoord in.";     
    } elseif(strlen(trim($_POST["wachtwoord"])) < 6){
        $wachtwoord_err = "Wachtwoord moet minimaal 6 tekens hebben.";
    } else{
        $wachtwoord = trim($_POST["wachtwoord"]);
    }

    if(empty(trim($_POST["bevestig_wachtwoord"]))){
        $bevestig_wachtwoord_err = "Bevestig uw wachtwoord.";     
    } else{
        $bevestig_wachtwoord = trim($_POST["bevestig_wachtwoord"]);
        if(empty($wachtwoord_err) && ($wachtwoord != $bevestig_wachtwoord)){
            $bevestig_wachtwoord_err = "Wachtwoorden komen niet overheen.";
        }
    }

    if(empty($email_err) && empty($telefoonnummer_err) && empty($wachtwoord_err) && empty($bevestig_wachtwoord_err)){
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['telefoonnummer'] = $_POST['telefoonnummer'];
        $_SESSION['wachtwoord'] = $_POST['wachtwoord'];
        
        header('location: register-2.php');
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
        <div class="login-box">
            <div class="wrapper">
            <br>
                <h2>Lid worden</h2><br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="content1 content">
                            <div class="form-group input-box">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            <div class="form-group input-box">
                                <label>Telefoonnummer</label>
                                <input type="tel" name="telefoonnummer" class="form-control <?php echo (!empty($telefoonnummer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefoonnummer; ?>">
                                <span class="invalid-feedback"><?php echo $telefoonnummer_err; ?></span>
                            </div>
                        </div><br>
                        <div class="content2 content">
                            <div class="form-group input-box">
                                <label>Wachtwoord</label>
                                <input type="password" name="wachtwoord" class="form-control <?php echo (!empty($wachtwoord_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $wachtwoord; ?>">
                                <span class="invalid-feedback"><?php echo $wachtwoord_err; ?></span>
                            </div>
                            <div class="form-group input-box">
                                <label>Bevestig wachtwoord</label>
                                <input type="password" name="bevestig_wachtwoord" class="form-control <?php echo (!empty($bevestig_wachtwoord_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bevestig_wachtwoord; ?>">
                                <span class="invalid-feedback"><?php echo $bevestig_wachtwoord_err; ?></span>
                            </div>
                        </div>
                        <div class="content7 content">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary button" value="Volgende pagina" name="registreer"><input type="reset" class="btn btn-primary reset" value="reset" style="background-color:grey; border-color:grey;"><br><br>
                                <p>Bent u al lid? <a href="login.php">Login hier</a>.<p>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <?php include 'include/footer.php';?>
    </footer>
</body>
</html>