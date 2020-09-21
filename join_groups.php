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
	#21 mai tout le systeme de connexion
		if (isset($_POST['join'])){
			echo '<script> window.location = "preparation_partie.php" </script>';
		}
		if ( !(isset($_SESSION['pseudo']))) {
			echo '<script> window.location = "index.php" </script>';
		}
		else{
			echo '
				<form action="join_groups.php" method="post">
					<p>
						</br>
						clef de goupage
						<input type="text" name="clef"/>
						</br>
						<input type="submit" value="Valider" />
					</p>
				</form>	';
			
			if ((isset($_POST['clef'])) || (isset($_SESSION['clef']))){
				if ((isset($_POST['clef'])) && (null==$_POST['clef'])){
					
					echo "<p>Vous devez remplir le champs<p>" ;
				}
				elseif ((isset($_POST['clef'])) &&(strlen($_POST['clef'])>10)){
					
					echo "<p>La clef saisie est trop longue ! (10 charachtères maximums)<p>";
				}
				else{
					if (isset($_POST['clef'])){
						$_SESSION['clef']=$_POST['clef'];
					}
					$a=0;
					$exist=$bdd->prepare('SELECT nom FROM groupes WHERE nom=:clef');
					$exist->execute(array('clef' => $_SESSION['clef']));
					if ($exist->fetch()){
						$a=1;
					}
					$exist->closeCursor();
					if ($a==0){
						echo 'Créer la partie';
						echo '<form action="join_groups.php" method="post">
							<p>
								nombres de joueurs
								<input type="text" name="nbr_joueurs"/>
								</br>
								<input type="submit" name="creer" value="Créer la partie !" />
							</p>
						</form>	';
						if (isset($_POST['nbr_joueurs'])){
							if (null==$_POST['nbr_joueurs']){
								echo' <p> Veillez à remplir tout les champs</p>';
							}
							elseif ($_POST['nbr_joueurs']>6){
								echo "<p> Nombre de joueurs trop important ! (6 maximums)<p>";
							}
							else{
								$test = $bdd->query('SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = \'salle1\'');
								if (!($test->fetch())){
									$_SESSION['salle']='salle1';
									$test->closeCursor();
									$new= $bdd->query('CREATE TABLE salle1 (
									id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
									pseudo VARCHAR(12) NOT NULL,
									positionx TINYINT UNSIGNED NOT NULL,
									positiony TINYINT UNSIGNED NOT NULL )');
									$new->closeCursor();
								}
								else{
									$test->closeCursor();
									$test = $bdd->query('SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = \'salle2\'');
									if (!($test->fetch())){
										$_SESSION['salle']='salle2';
										$test->closeCursor();
										$new= $bdd->query('CREATE TABLE salle2 (
										id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
										pseudo VARCHAR(12) NOT NULL,
										positionx TINYINT UNSIGNED NOT NULL,
										positiony TINYINT UNSIGNED NOT NULL )');
										$new->closeCursor();
									}
								}
								$_SESSION['nbr_joueurs']=$_POST['nbr_joueurs'];
								$lcouleurs=array('silver','white','red','purple','green','lime','olive','yellow','navy','blue','aqua','orange','blueviolet','brown','forestgreen','fuchsia');
								$couleurgroup=' ';
								for ($i=0; $i < $_SESSION['nbr_joueurs']; $i++){	
									$couleur=$lcouleurs[array_rand($lcouleurs,1)];
									unset($lcouleurs[array_search($couleur, $lcouleurs)]);
									$couleurgroup=$couleurgroup . ' ' . $couleur.' ';
								}
								$pacman=rand(1,$_SESSION['nbr_joueurs']);
								$req = $bdd->prepare('INSERT INTO groupes(nom,nbrjoueurs,pacman,couleur) VALUES(:clef,:nbrjr,:pacman,:couleur)');
								$req->execute(array('clef' => $_SESSION['clef'],'nbrjr' => $_SESSION['nbr_joueurs'],'pacman'=>$pacman , 'couleur'=>$couleurgroup));
								$req->closeCursor();
								echo '<script> window.location = "preparation_partie.php" </script>';
							}
						}
					}
					else {
						$req = $bdd->prepare('SELECT * FROM users WHERE pseudo=:pseudo');
						$req->execute(array('pseudo' => $_SESSION['pseudo']));
						if ($test=$req->fetch()){
							$testclef=$test['clef'];
							echo $testclef;
						}
						$req->closeCursor();
						$nbrj=$bdd->prepare('SELECT nbrjoueurs FROM groupes WHERE nom=:clef');
						$nbrj->execute(array('clef' => $_SESSION['clef']));
						if ($test2=$nbrj->fetch()){
							
							$testnbr=$test2['nbrjoueurs'];
						}
						$nbrj->closeCursor();
						$nbrj2 = $bdd->prepare('SELECT clef FROM users WHERE clef=:clef');
						$nbrj2->execute(array('clef' => $_SESSION['clef']));
						$testnbr2=1;
						while ($nbrj2line=$nbrj2->fetch()){
							$testnbr2+=1;
						}
						$nbrj2->closeCursor();
						if ($testclef!='none'){
							echo '<p>Votre compte est déjà dans la partie "'.$testclef.'"</p>';
						}
						elseif ($testnbr2>$testnbr){
							echo '<p>la partie est déjà complète.</p>';
						}
						else{
							echo '<form action="join_groups.php" method="post">
								<p>
									<input type="submit" name="join" value="Rejoindre la partie !" />
								</p>
							</form>';
						}
						
					}
				}
			}
			
		}
	
		
	?>
	</body>