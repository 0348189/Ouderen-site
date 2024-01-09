<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>
</head>

<body>
    <nav>
        <div class="topnav">
            <div class="left">
                <img src="images/logo-header.png" alt="">
            </div>
            <div class="middle" id="myLinks">
                <p><a href="index.php">Home</a></p>
                <p><a href="evenementen.php">Evenementen</a></p>
                <p><a href="nieuws.php">Nieuws</a></p>
                <p><a href="sponsors.php">Sponsoren</a></p>
                <p><a href="contact.php">Contact</a></p>
                <?php
                if (isset($_SESSION["is_logged_in"])) {?>
                    <p><a href="admin/login.php">Admin</a></p>
                <?php } ?>
                <?php if (isset($_SESSION["loggedin"])) {
                    echo '<p><a href="include/logout.php">Log uit</a></p>';
                } else {
                    echo '<p><a href="register.php">Lid worden</a></p>';
                } ?>
            </div>
            <div class="right">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </div>
    </nav>
</body>


</html>
