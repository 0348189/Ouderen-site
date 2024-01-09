<?php 
session_start();

include 'include/db_connect.php';
require_once "include/config.php";
include 'include/header.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCOB</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo.png">
</head>

<body>


    <h3>U bent ingeschreven!</h3>
    <p><a href="index.php">klik hier om terug te gaan</a></p>

    <?php include 'include/footer.php'; ?>
</body>

</html>