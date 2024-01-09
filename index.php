<?php include 'include/db_connect.php';

require_once "include/config.php"; 

session_start();
$queryev = $pdo->query('SELECT * FROM evenementen ORDER BY id DESC LIMIT 1 ');    
$querynie = $pdo->query('SELECT * FROM nieuws ORDER BY id DESC LIMIT 1 ');
$querydat = $pdo->query('SELECT * FROM evenementen ORDER BY id DESC LIMIT 3 ');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCOB</title>
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="shortcut icon" href="images/logo.png">
</head>

<body>

    <?php include 'include/header.php'; ?>

    <div class = "banner">
     <img src="images/shutterstock_248866879.jpg" alt="stock">
    </div>

<div class="bov">
    <div class="nwspos">

        <div class="nwsdiv">
        <h2>Nieuws</h2>
        <?php
        
        while ($row = $querynie->fetch(PDO::FETCH_ASSOC)) {
            $description = $row['beschrijving'];
            $descriptionWords = preg_split('/\s+/', $description);
            $shortDescription = implode(' ', array_slice($descriptionWords, 0, 20));
            echo '
            <div class="box">
                <h2>' . $row['titel'] . '</h2>
                <h4>' . $shortDescription . '.....</h4>
            </div>
            ';
        }
        

       ?>
            <h3><a href="nieuws.php"> Lees verder </a></h3>
        </div>

    </div>

    <div class="infokbo" >
        <h1>Welkom bij de Seniorenvereniging Enschede!</h1>

        <p>  Wij zijn er voor alle senioren vanaf 65 jaar in Enschede. Ons doel is om senioren te verenigen in een algemene vereniging met een christelijke signatuur. We willen een vitale, gezellige en maatschappelijk betrokken vereniging creëren waar senioren van alle leeftijden, aard en geslacht zich thuis voelen. <br><br>
            Onze vereniging is gevestigd in Enschede en bedient ook de omliggende deelgebieden. Senioren uit randgemeenten zijn ook welkom.<br>
        </p>
    </div>

</div>

<div class="ond">
    <div class="infokbo">
    <p>De vereniging is begin januari 2023 gestart met een interim-bestuur, dat werkt aan het vestigen van een solide bestuur en het aantrekken van jongere senioren om de continuïteit te waarborgen.<br><br>
            Senioren willen samen maatschappelijke activiteiten ondernemen. In Nederland is bijna 20% van de bevolking 65 jaar en ouder, wat aangeeft dat senioren een belangrijke en groeiende groep vormen.<br>
            Sluit u vandaag nog aan bij de Seniorenvereniging Enschede en ontdek wat wij te bieden hebben!<br></p> 
            </div>

        
            <div class="calender">
            <h2>Kalendar</h2>
                <?php
                while ($row = $querydat->fetch(PDO::FETCH_ASSOC)) {
                    echo '        
                    <div class="calenderbox">
                        <table>
                            <tr>
                                <td class="row">' . $row['titel'] . '</td>
                                <td class="row">' . $row['datum'] . '</td>
                                <td class="row">' . $row['tijd'] . '</td>
                            </tr>
                        </table>
                    </div>
                ';
            }
            ?>
        </div>
</div>


    <div class="leden-voordelen">
            <h2>Leden voordelen</h2>
            <p>
                Als u lid word van PCOB krijgt u toegang tot bepaalde voordelen. Van verschillende organisaties. Van korting op kleding naar korting op je ansjovis op de markt.<br>
                Dit zijn de voordelen:
                -<br>
                -<br>
                -<br>
                -<br>
                -<br>
                -<br>
                -<br>
                -<br>
                -<br>
                -<br>
        </p>
        
    </div>
    <?php include 'include/footer.php'; ?>
    </body>
</html>