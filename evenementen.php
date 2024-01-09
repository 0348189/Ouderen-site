<?php
include 'include/db_connect.php';
require_once "include/config.php";

session_start();

$query = $pdo->query('SELECT * FROM evenementen');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenementen</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="CSS/evenementen.css">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include 'include/header.php'; ?>

    <div class="content">
        <?php
        $rows = $pdo->query('SELECT COUNT(*) AS count FROM evenementen');
        $row = $rows->fetch(PDO::FETCH_ASSOC);
        $rowcount = $row['count'];

        if ($rowcount > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '        
            <div class="box">
                <img src="images/' . $row['img'] . '" alt="evenement">
                <h1>' . $row['titel'] . '</h1>
                <p><a href="evenement.php?titel=' . $row['titel'] . '">Bekijk evenement</a></p>
            ';
            
            if (isset($_SESSION["is_logged_in"])) { ?> 
                <form method="post">   
                    <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Verwijder evenement" name="submit" onclick="return confirm('Weet je zeker dat je dit evenement wilt verwijderen?');">
                </form>
            <?php 
            }
            
            if (isset($_POST['submit'])) {
                $item_id = $_POST["item_id"];
                
                $sql = "DELETE FROM evenementen WHERE id = :item_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
                $stmt->execute();
                
                // Redirect to the same page to prevent multiple form submissions
                header("Location: $_SERVER[PHP_SELF]");
                exit();
            }
            ?>
            </div>
            <?php
            }
        } else {
            echo '<h1 class="error">Er zijn momenteel geen evenementen.</h1>';
        }
        ?>
    </div>

    <?php include 'include/footer.php';  ?>
</body>

</html>
