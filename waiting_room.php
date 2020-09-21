<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pacmantime;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_PERSISTENT => true));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>
			Jouer a Pac-Man
		</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<h1>
		PacMan Time &#128123;&#9203;
	</h1>	
	<body id="b">
	<?php
	if ( !(isset($_SESSION['pseudo']))) {
			echo '<script> window.location = "index.php" </script>';
	}
	else{
		$req = $bdd->prepare('SELECT clef FROM users WHERE clef=:clef');
		$req->execute(array('clef' => $_SESSION['clef']));
		$nbrclef=0;
		while ($testclef=$req->fetch()){
			$nbrclef+=1;
		}
		echo '<p>En attente de joueurs... '. $nbrclef .' / '. $_SESSION['nbr'].'</p>';
		if ($nbrclef==$_SESSION['nbr']){
			echo '<script> window.location = "jeu.php" </script>';
		}
		header("Refresh:1");
		
	}