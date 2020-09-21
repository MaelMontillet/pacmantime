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
		if ($_SESSION['salle']=='salle1'){
			$req = $bdd->prepare('INSERT INTO salle1 (pseudo,statut,positionx,positiony) VALUES(:pseudo,0,0,0)');
			$req->execute(array('pseudo' => $_SESSION['pseudo']));
			$req->closeCursor();
		}
		$req = $bdd->prepare('SELECT clef FROM users WHERE clef=:clef');
		$req->execute(array('clef' => $_SESSION['clef']));
		$i=1;
		while ($testclef=$req->fetch()){
			$i+=1;
		}
		$req->closeCursor();
		$req = $bdd->prepare('SELECT pacman,couleur FROM groupes WHERE nom=:clef');
		$req->execute(array('clef' => $_SESSION['clef']));
		if ($group=$req->fetch()){
			$l=array();
			$stk='';
			for ($ii=0; $ii<strlen($group['couleur']); $ii++){
				if ($group['couleur'][$ii]==' ' &&$stk!=""){
					array_push($l,$stk);
					$stk='';
				}
				else{
					$stk=$stk.$group['couleur'][$ii];
				}
			}
			$req->closeCursor();
			$couleur=$l[($i)];
			if ($_SESSION['salle']=='salle1'){
				if ($group['pacman']==$i){
					$set = $bdd->prepare('UPDATE salle1 SET statut=1,couleur=:couleur WHERE pseudo=:pseudo');
					$set->execute(array('pseudo' => $_SESSION['pseudo'], 'couleur' => $couleur));
					$set->closeCursor();
				}
			}
			else {
				$set = $bdd->prepare('UPDATE users SET couleur=:couleur WHERE pseudo=:pseudo');
				$set->execute(array('pseudo' => $_SESSION['pseudo'], 'couleur' => $couleur));
				$set->closeCursor();
			}
		}
		$req = $bdd->prepare('SELECT nbrjoueurs FROM groupes WHERE nom=:clef');
		$req->execute(array('clef' => $_SESSION['clef']));
		if ($ligne=$req->fetch()){
			$_SESSION['nbr']=$ligne['nbrjoueurs'];
		}
		$req->closeCursor();
		$set = $bdd->prepare('UPDATE users SET clef=:clef WHERE pseudo=:pseudo');
		$set->execute(array('pseudo' => $_SESSION['pseudo'],'clef' => $_SESSION['clef']));
		$set->closeCursor();
		/*while ($a==0){
			echo $nbr;
			$req = $bdd->prepare('SELECT clef FROM users WHERE clef=:clef');
			$req->execute(array('clef' => $_SESSION['clef']));
			$nbrclef=0;
			while ($testclef=$req->fetch()){
				$nbrclef+=1;
			}
			echo $nbrclef;
			if ($nbrclef==$nbr){
				$a==1;
			}
			sleep(10);
		}*/
		/*echo '<script> window.location = "waiting_room.php" </script>';*/
	}
	?>
	</body>
</html>