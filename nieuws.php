<?php
session_start();
include 'include/db_connect.php';
require_once "include/config.php";
include 'include/header.php';

$query = $pdo->query('SELECT * FROM nieuws');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuws</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nieuws.css">
    <link rel="shortcut icon" href="images/logo.png">
</head>

<body>

    <?php
    $rows = $pdo->query('SELECT COUNT(*) AS count FROM nieuws');
    $row = $rows->fetch(PDO::FETCH_ASSOC);
    $rowcount = $row['count'];

    if ($rowcount > 0) {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <div class="content">
            <h1>' . $row['titel'] . '</h1>
            <div class="divided">
                <p>' . $row['beschrijving'] .
                '</p>
                <img src="images/' . $row['foto'] .
                '" alt="evenement">
                
            </div>
            ';
            
            if (isset($row['link'])) {
                echo '<p>Meer weten? <a href="' . $row['link'] . '">' . $row['link'] . '</a></p>';
            } else {
                echo ' ';
            }

            if (isset($_SESSION["is_logged_in"])) {
                ?>
                <form method="post">
                    <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Verwijder nieuws" name="submit">
                </form>
            <?php
            }

            if (isset($_POST['submit'])) {
                $item_id = $_POST["item_id"];

                $sql = "DELETE FROM nieuws WHERE id = :item_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
                $stmt->execute();

                header("Location: $_SERVER[PHP_SELF]");
                exit();
            }

            echo '</div>';
        }
    } else {
        echo '<h1 class="error">Er is momenteel geen Nieuws.</h1>';
    }

    include 'include/footer.php'; 
    ?>
</body>

</html>
