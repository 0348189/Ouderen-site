<?php include 'include/db_connect.php';
require_once "include/config.php";
session_start();

if (!$_SESSION["loggedin"]) {
    header("Location: login.php");
}

if (!isset($_GET['titel'])) {
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->execute(array(':id' => $_SESSION['id']));
$evenement = $stmt->fetch(PDO::FETCH_ASSOC);

$titel = htmlspecialchars($_GET['titel']);

$stmt = $pdo->prepare('UPDATE evenementen SET capiciteit = capiciteit - 1 WHERE titel = :titel');
$stmt->execute(array(':titel' => $titel));

$stmt = $pdo->prepare('INSERT INTO ingeschreven_voor_evenement (evenement, voornaam, tussenvoegsel, achternaam, id) VALUES (:titel, :voornaam, :tussenvoegsel, :achternaam, :id)');
$stmt->execute(array(':titel' => $titel, ':voornaam' =>  $evenement['voornaam'], ':tussenvoegsel' => $evenement['tussenvoegsel'], ':achternaam' => $evenement['achternaam'], ':id' => $_SESSION['id']));

header("location: ingeschreven_evenement_gelukt.php");