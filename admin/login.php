<?php
$message = '';

$gebruikersnaam = 'admin';
$wachtwoord = 'qwert';


// Check if gebruikersnaam and wachtwoord are correct
if (isset($_POST['gebruikersnaam'])) {
	
	if ($_POST['gebruikersnaam'] == $gebruikersnaam && $_POST['wachtwoord'] == $wachtwoord) {
		session_start();
		$_SESSION["is_logged_in"] = "yes";
		header('Location: index.php');
	}
	else {
		$message = 'Gebruikersnaam en/of wachtwoord onjuist.';
	}
	
	
	
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/logo.png">
        <title>PCOB Admin Login</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>


	<center>
		<form method="POST" action="login.php" class="login-form">
			<label for="gebruikersnaam">Gebruikersnaam</label><br>
			<input type="text" name="gebruikersnaam" id="gebruikersnaam" maxlength="16"><br><br>
			<label for="wachtwoord">Wachtwoord</label><br>
			<input type="password" name="wachtwoord" id="wachtwoord" maxlength="16"><br><br>
			<input type="submit" value="Login">
		</form>
	<br>
	<?php echo $message; ?>
	</center>
	
    </body>
</html>
