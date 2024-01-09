<?php

include 'include/db_connect.php';
require_once "include/config.php";

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
    <title>Onze Sponsoren</title>
    <link rel="stylesheet" href="CSS/sponsors.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="shortcut icon" href="images/logo.png">
</head>

<body>

    <header class="header"> <!-- Added class="header" -->
        <!-- Your header content goes here -->
    </header>


    <?php include 'include/header.php'; ?>


    <h1 class="sponsortitel">Onze Sponsoren</h1>
    <hr class="ondertitellijn">

    <?php
    $query = $pdo->query('SELECT * FROM sponsoren');
    $rows = $pdo->query('SELECT COUNT(*) AS count FROM sponsoren');
    $row = $rows->fetch(PDO::FETCH_ASSOC);
    $rowcount = $row['count'];

    ?>
    <div class="sponsorlijst">
        <?php
        if ($rowcount > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="sponsor">
                    <a href="<?php echo htmlspecialchars($row['link']) ?>">
                        <img class="plaatje" src="images/<?php echo $row['sponsor_logo'] ?>" alt="evenement">
                    </a>
                    <?php
                    if (isset($_SESSION["is_logged_in"])) {
                    ?>

                        ?> <div class="sponsorlijst"> <?php
                                                        if ($rowcount > 0) {
                                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                    <div class="sponsor">
                                        <a href="<?php echo htmlspecialchars($row['link']) ?>" target="_blank">
                                            <img class="plaatje" src="images/<?php echo $row['sponsor_logo'] ?>" alt="<?php echo $row['sponsor_naam'] ?>">
                                        </a>
                                        <?php
                                                                if (isset($_SESSION["is_logged_in"])) {
                                        ?>

                                            <form method="post">
                                                <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                                                <input type="submit" value="Verwijder sponsoren" name="submit">
                                            </form>

                                        <?php
                                                                }

                                                                if (isset($_POST['submit'])) {
                                                                    $item_id = $_POST["item_id"];

                                                                    $sql = "DELETE FROM sponsoren WHERE id = :item_id";
                                                                    $stmt = $pdo->prepare($sql);
                                                                    $stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
                                                                    $stmt->execute();

                                                                    header("Location: $_SERVER[PHP_SELF]");
                                                                    exit();
                                                                }
                                        ?>
                                    </div>
                            <?php
                                                            }
                                                        } else {
                                                            echo '<h1 class="error">Er is momenteel geen sponsoren.</h1>';
                                                        }
                            ?>
                        </div>
                        <div class="sponsorworden">
                            <h1 class="sponsortitel2">Sponsor worden?</h1>
                            <!-- Lorem ipsum veranderen met echte tekst-->
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente sit, tempora fugit rem, nostrum alias
                                quibusdam necessitatibus voluptatibus quos reiciendis unde?
                                Laudantium nobis nam odio saepe qui ullam. Vero, repellat?</p>

                        <?php
                    }

                    if (isset($_POST['submit'])) {
                        $item_id = $_POST["item_id"];

                        $sql = "DELETE FROM sponsoren WHERE id = :item_id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
                        $stmt->execute();

                        header("Location: $_SERVER[PHP_SELF]");
                        exit();
                    }
                        ?>
                        </div> <?php
                            }
                        } else {
                            echo '<h1 class="error">Er is momenteel geen sponsoren.</h1>';
                        }
                                ?>
                </div>
                <div class="sponsorworden">
                    <h1 class="sponsortitel">Sponsor worden?</h1>
                    <p>Wil je een positieve impact maken en tegelijkertijd jouw bedrijf laten groeien? Word een trotse sponsor van
                        ons! Als sponsor speel je een cruciale rol bij het ondersteunen van onze missie en activiteiten. Je krijgt
                        de kans om jouw merk te promoten aan een breed publiek, terwijl je tegelijkertijd bijdraagt aan het bereiken
                        van belangrijke doelen en het verbeteren van de levens van mensen. Samen kunnen we iets groots bereiken!
                        Neem vandaag nog contact met ons op om de mogelijkheden voor sponsoring te bespreken. Jouw steun maakt echt
                        het verschil!</p>

                    <div class="sponsorcontact">
                        <!-- voorbeelden veranderen met echte contact gegevens-->
                        <h2>06-12345678 - example@domain.com</h2>
                    </div>
                </div>
                <?php include 'include/footer.php'; ?>
</body>

</html>