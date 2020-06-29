<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pacmantime;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
	#21 mai tout le systeme de connexion
		if (isset($_SESSION['gameover'])){
			unset ($_SESSION['clef']);
			unset ($_POST['clef']);
			unset($_POST['jouer']);
			unset($_POST['couleur']);
			unset($_SESSION['gameover']);
			echo'<form action="jeu.php" method="post">
			<p>
				<input type="submit" name="retour_site" value="retour au site" />
			</p>
		</form>';
		}
		elseif ( (isset($_SESSION['pseudo']) && (isset($_POST['jouer'])))){
			echo '
			<div id="conteneur">
				<p id="pseudo" hidden>';  echo $_SESSION ['pseudo']; echo '</p>
				<p id="clef" hidden>';  echo $_SESSION ['clef']; echo '</p>
				<p id="test" > </p>
				<p>';
				$req = $bdd->prepare('SELECT positionx,positiony,couleur,personnage FROM users WHERE pseudo=:pseudo');
				$req->execute(array('pseudo' => $_SESSION['pseudo']));
				
				if ($hidvars = $req->fetch()){
					echo '<p id="x" hidden>';  echo (int)($hidvars['positionx']); echo '</p>
					<p id="y" hidden>';  echo (int)($hidvars['positiony']); echo '</p>
					<p id="couleur" hidden>'; echo  $hidvars['couleur']; echo '</p>
					<p id="perso" hidden>'; echo $hidvars['personnage']; echo '</p>';
				}
				$req->closeCursor();
				echo '<div>
					<canvas id="canvas" onload="can()">
						<p>Désolé, votre navigateur ne supporte pas Canvas. Mettez-vous à jour</p>
					</canvas>
					
				</div>
				<div>
					<form action="jeu.php" method="post">
						<p>
							<input type="submit" name="retour_site" value="retour au site" />
							</br>
							<input type="checkbox" name="mobile" id="mobile" selected="unselected" /> <label for="mobile"> Je suis sur mobile </label>
						</p>
					</form>
				</div>
			</div>
			';	
		}
		elseif ( !(isset($_SESSION['pseudo']))) {
			
		echo '<p>Merci de vous connecter au service.</p>
		<form action="jeu.php" method="post">
			<p>
				<input type="submit" name="retour_site" value="retour au site" />
			</p>
		</form>';
		}
		else{
			echo '
			<form action="jeu.php" method="post">
				<p>
					<input type="text" name="clef" />
					<input type="submit" value="Valider" />
				</p>
			</form>	';
			if ( (isset($_POST['clef'])) || (isset($_SESSION['clef']))){
				if (!(isset($_POST['clef']))){
					$_POST['clef']=$_SESSION['clef'];
				}
				if ((null==$_POST['clef']) && (!(isset($_SESSION['clef'])))){
					
					echo "<p>Vous devez remplir le champs<p>" ;
				}
				elseif (strlen($_POST['clef'])>10){
					
					echo "<p>La clef saisie est trop longue ! (10 charachtères maximums)<p>";
				}
				else{
					$_SESSION['clef']=$_POST['clef'];
					$set = $bdd->prepare('UPDATE users SET clef=:clef WHERE pseudo=:pseudo');
					$set->execute(array('pseudo' => $_SESSION['pseudo'],'clef' => $_POST['clef']));
					$set->closeCursor();
					$req = $bdd->prepare('SELECT * FROM users WHERE pseudo!=:pseudo AND clef=:clef');
					$req->execute(array('pseudo'=> $_SESSION['pseudo'], 'clef' => $_POST['clef']));
					$lcouleurs=array('silver','white','red','purple','green','lime','olive','yellow','navy','blue','aqua','orange','blueviolet','brown','forestgreen','fuchsia');
					$findpac=array($_SESSION['pseudo']);
					echo '<ul>';
					while ($aff = $req->fetch()){
						$findpac[]=$aff['pseudo'];
						echo'<p>'; echo $aff['pseudo']; echo '</p>';
						if ($aff['couleur']!='none'){
								unset($lcouleurs[array_search($aff['couleur'], $lcouleurs)]);
						}
					}
					$req->closeCursor();
					$req = $bdd->prepare('SELECT couleur FROM users WHERE pseudo=:pseudo');
					$req->execute(array('pseudo'=> $_SESSION['pseudo']));
					if ($c = $req->fetch()){
						if ($c['couleur']=='none'){
							$couleur=$lcouleurs[array_rand($lcouleurs,1)];
							$req->closeCursor();
							$set = $bdd->prepare('UPDATE users SET couleur=:couleur WHERE pseudo=:pseudo');
							$set->execute(array('pseudo' => $_SESSION['pseudo'],'couleur' => $couleur ));
							$set->closeCursor();
						}
					}
					$pac=$findpac[array_rand($findpac,1)];
					echo'<p>';print_r( $findpac); echo $pac;echo'</p>';
					forEach ($findpac as $nom){
						if ($nom == $pac){
							$set = $bdd->prepare('UPDATE users SET personnage= \'P\' WHERE pseudo=:pseudo');
							$set->execute(array('pseudo' => $nom));
							$set->closeCursor();
						}
						else{
							$set = $bdd->prepare('UPDATE users SET personnage= \'F\' WHERE pseudo=:pseudo');
							$set->execute(array('pseudo' => $nom));
							$set->closeCursor();
							$set = $bdd->prepare('UPDATE users SET positionx=24,positiony=17 WHERE pseudo=:pseudo');
							$set->execute(array('pseudo' => $nom));
							$set->closeCursor();
						}
					echo '</ul>';
					header("Refresh:10");
					echo '<form action="jeu.php" method="post">
						<p>
							<input type="submit" name="jouer" value="Jouer" />
						</p>
					</form>';
					}
				}

			}
		}
		if (isset($_POST['retour_site'])){
				/*session_destroy();
				header("Refresh:0");
				$set = $bdd->prepare('UPDATE users SET statut = 0 WHERE pseudo=:pseudo');
				$set->execute(array('pseudo' => $_SESSION['pseudo']));
				$set->closeCursor();*/
				echo '<script> window.location = "index.php" </script>';
		}
		
		
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="script.js"></script>
	</body>
</html>