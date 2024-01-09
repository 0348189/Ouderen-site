<?php include 'include/db_connect.php';
require_once "include/config.php";
session_start();
$query = $pdo->query('SELECT * FROM evenementen');
if (!isset($_GET['titel'])) {
    exit();
}


$titel = htmlspecialchars($_GET['titel']);


$stmt = $pdo->prepare('SELECT * FROM evenementen WHERE titel = :titel');
$stmt->execute(array(':titel' => $titel));


if ($stmt->rowCount() == 0) {
    echo "Dit evenement bestaat niet.";
    exit();
}

$evenement = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['id'])) {
    $stmt2 = $pdo->prepare('SELECT * FROM ingeschreven_voor_evenement WHERE id = :id');
    $stmt2->execute(array(':id' => $_SESSION['id']));
    $user = $stmt2->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBO</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="CSS/evenement.css">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include 'include/header.php'; ?>

    <div class="content">

        <div class="left-content">
            <h1><?php echo $evenement['titel']; ?></h1>
            <img src="images/<?php echo $evenement['img']; ?>" alt="">
        </div>
        <div class="right-content">
            <p><?php echo $evenement['beschrijving']; ?></p>

            <p>Het is een <?php echo strtolower($evenement['soort']) ?>.</p>
            <p>Het is op <?php echo $evenement['datum'] . ' om ' . $evenement['tijd'] ?></p>
            <p>Wilt u meer informatie? Neem dan contact op.</p>
            <?php if ($evenement['capiciteit'] == 0) {
                echo '<p style="text-align:center;color:gray;">Er is helaas geen plek meer!</p>';
            } else if (isset($_SESSION['id']) and isset($user['id'])) {
                if ($_SESSION['id'] == $user['id']) {
                    echo '<p style="text-align:center;color:gray;">U bent al ingeschreven!</p>';
                }
            } else {
                echo '<div class="inschrijven"><p style="margin-bottom:0;">meedoen?</p><p style="margin-top:0;"><a href="confirm.php?titel=' . $evenement['titel'] . '">Klik hier om in te schrijven</a></p></div>';
            }
            ?>

        </div>
    </div>
    <?php
    $query = $pdo->query('SELECT COUNT(*) AS count FROM ingeschreven_voor_evenement WHERE evenement = "' . $titel . '"');
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $rowcount = $row['count'];

    if ($rowcount != 0) {
    ?>
        <div class="al-ingeschreven">
            <p>Deze persoon(en) zijn al ingeschreven voor dit evenement!</p>
            <?php
            echo '<p>';
            $query = $pdo->query('SELECT * FROM ingeschreven_voor_evenement WHERE evenement = "' . $titel . '"');
            if ($rowcount > 1) {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo $row['voornaam'] . ' ' . $row['tussenvoegsel'] .  ' ' . $row['achternaam'] . ', ';
                }
            } else {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo $row['voornaam'] . ' ' . $row['tussenvoegsel'] .  ' ' . $row['achternaam'];
                }
            }

            echo '</p>';
            ?>
        </div>
    <?php
    }
    ?>

    <?php include 'include/footer.php'; ?>
</body>

</html>