<?php


// Initialize the session
session_start();

include 'include/db_connect.php';
include 'include/header.php';


// Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Include inc/config file
require_once "include/config.php";

// Define variables and initialize with empty values
$email = $wachtwoord = "";
$email_err = $wachtwoord_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Voer uw E-mail alstublieft in.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if wachtwoord is empty
    if (empty(trim($_POST["wachtwoord"]))) {
        $wachtwoord_err = "Voer uw wachtwoord alstublieft in.";
    } else {
        $wachtwoord = trim($_POST["wachtwoord"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($wachtwoord_err)) {
        // Prepare a select statement
        $sql = "SELECT id, email, wachtwoord FROM users WHERE email = :email";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if email exists, if yes then verify wachtwoord
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $email = $row["email"];
                        $hashed_wachtwoord = $row["wachtwoord"];
                        if (password_verify($wachtwoord, $hashed_wachtwoord)) {
                            // wachtwoord is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect user to index page
                            header("location: index.php");
                        } else {
                            // wachtwoord is not valid, display a generic error message
                            $login_err = "Fout E-mail of wachtwoord.";
                        }
                    }
                } else {
                    // email doesn't exist, display a generic error message
                    $login_err = "Fout E-mail of wachtwoord.";
                }
            } else {
                echo "Oeps! Er is iets fout gegaan. Probeer het later nog een keer.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/login.register.style.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="shortcut icon" href="images/logo.png">
    <style>
        .wrapper {
            width: 100%;
        }

        .reset {
            margin-left: 5%;
        }
    </style>
</head>

<body>
    <section>
        <div class="login-box">
            <div class="wrapper">
                <h2>Login</h2><br>

                <?php
                if (!empty($login_err)) {
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div><br>
                    <div class="form-group">
                        <div class="child"><label>Wachtwoord</label></div>
                        <input type="password" name="wachtwoord" class="form-control <?php echo (!empty($wachtwoord_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $wachtwoord_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login"><input type="reset" class="btn btn-primary reset" value="reset" style="background-color:grey; border-color:grey;"><br><br>
                        <p>Bent u nog niet lid <a href="register.php">registreer nu</a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <?php include 'include/footer.php'; ?>
    </footer>
</body>

</html>