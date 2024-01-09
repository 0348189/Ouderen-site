<?php include 'include/db_connect.php';
require_once "include/config.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/contact.css">
    <link rel="shortcut icon" href="images/logo.png">
</head>

<body>
    <?php include 'include/header.php'; ?>

    <div>
        <h1 class="contacttitel">Contact</h1>
        <hr class="ondertitellijn">
        <!-- Contact formulier -->
        <div class="mail-contact">
            <form action="mailto:recipient@example.com" method="get" enctype="text/plain">
                <label for="subject">Onderwerp:</label><br>
                <input type="text" name="subject" placeholder=""><br><br>
                <label for="body">Inhoud:</label><br>
                <textarea name="body" rows="15" cols="20" placeholder="Type hier uw mail..."></textarea><br>
                <input type="submit" value="Send">
            </form>
        </div>

    </div>


    <div class="directcontact">
        <h1 class="contacttitel">Direct contact</h1>
        <div class="contactgegevens">
            <h3>direct contact opnemen?</h4>
                <!-- voorbeelden veranderen met echte contact gegevens-->
                <h2>06-12345678 - example@domain.com</h2>
        </div>
    </div>

    <?php include 'include/footer.php'; ?>
</body>

</html>