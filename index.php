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
			PacMan V2
		</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	
<body>

<?php
	#21 mai tout le systeme de connexion
		if (isset($_SESSION['pseudo']))
		{
			echo '
			<h1> PacMan Time &#128123;&#9203; </h1>
			<img src="Pacman.jpg" class="image1" alt="Pacman and co">
			<br>
			<p> &#127759;Histoire de Pac-Man : Pac-Man est un jeu vidéo créé par Tōru Iwatani pour l’entreprise japonaise Namco, sorti au
			Japon le 22 mai 1980. Le jeu consiste à déplacer Pac-Man, un personnage ressemble à un diagramme circulaire à l’intérieur d’un
			labyrinthe, afin de lui faire manger toutes les pac-gommes qui s’y trouvent en évitant d’être touché par des fantômes.</p>
			<br>
			<p> Systeme de Jeu &#128377;&#65039; : Pac-Man doit survivre le plus de temps possible dans un labyrinthe hanté par 
			quatre fantômes.Si Pac-Man mange un fruit alors il peut manger les Fantômes, qui une fois avalé sont éliminés.</p>
			<br>
			<p> Comment Jouer &#129300; : Voici le guide pour jouer pour chacun des personnages &#10549;&#65039; </p>
			<br>
			<p> Pour Pac-Man : </p>
				<li id="pacman">
					Avancer: Z; Gauche : Q ; Droite : D ; Reculer : S.
				</li>
				<li id="pacman">
					Pour avaler les Fantomes : Se diriger vers eux.
					<p> Pour les Fantômes : </p>
				<li id="fantomes">
					Avancer : Utiliser les flèches directionnelles 
				</li>
				<li id="fantomes">
					Pour Manger Pac-Man : Se diriger sur lui.
				</li>
				<br>
			<div>
				<a href="Jeu.php">Jouer</a>
			</div>
			<form action="index.php" method="post">
				<p>
					<input type="submit" name="deconexion" value="Deconexion" />
					</br>
					<input type="checkbox" name="mobile" id="mobile" selected="unselected" /> <label for="mobile"> Je suis sur mobile </label>
				</p>
			</form>
			';
			if (isset($_POST['deconexion']))
			{
				$set = $bdd->prepare('UPDATE users SET statut = 0 WHERE pseudo=:pseudo');
				$set->execute(array('pseudo' => $_SESSION['pseudo']));
				$set->closeCursor();
				session_destroy();
				header("Refresh:0");
				
			}
			
		}
		else
		{
			echo'
			<form action="index.php" method="post">
				<p>
					<input type="text" name="pseudo" />
					</br> </br>
					<input type="password" name="mdp" />
					<select name="mode">
						<option value="connexion" selected="selected">connexion</option>
						<option value="inscription">inscription</option>
					</select>
					<input type="submit" value="Valider" />
				</p>
			</form>';
			if (isset($_POST['pseudo'],$_POST['mdp'])){
				
				$_POST['pseudo']=strtolower($_POST['pseudo']);
				if (null==$_POST['mdp'] OR null==$_POST['pseudo']){
					
					echo "<p>Veillez à remplir tout les champs<p>" ;
				}
				elseif (strlen($_POST['pseudo'])>10 OR strlen($_POST['mdp'])>10){
					
					echo "<p>Pseudo ou mot de passe trop long ! (10 charachtères maximums)</p>";
				}
				else{
					#14 mai codage du systeme d'iscription.
					if ($_POST['mode']=="inscription")
					{
						$exist=$bdd->prepare('SELECT * FROM users WHERE pseudo=:pseudo');
						$exist->execute(array('pseudo' => $_POST['pseudo'],));
						if (!($exist->fetch()))
						{
							$exist->closeCursor();
							$req = $bdd->prepare('INSERT INTO users(pseudo,mdp,statut,clef,couleur) VALUES(:pseudo,:mdp,0,\'none\',\'none\')');
							$req->execute(array('pseudo' => $_POST['pseudo'],'mdp' => $_POST['mdp'],));
							$_SESSION['pseudo']=$_POST['pseudo'];
							$req->closeCursor();
							$set = $bdd->prepare('UPDATE users SET statut = 1 WHERE pseudo=:pseudo');
							$set->execute(array('pseudo' => $_POST['pseudo']));
							$set->closeCursor();
							header("Refresh:0");
						}
						else
						{	
							echo "<p>Le pseudo que vous avez saisi est déjà utilisé !</p>";
							$exist->closeCursor();
						}
					}
					else
					{
						$req = $bdd->prepare('SELECT * FROM users WHERE pseudo=:pseudo AND mdp=:mdp');
						$req->execute(array('pseudo' => $_POST['pseudo'],'mdp' => $_POST['mdp']));
						if ($req->fetch())
						{	
							$req->closeCursor();
							$test = $bdd->prepare('SELECT statut FROM users WHERE pseudo=:pseudo');
							$test->execute(array('pseudo' => $_POST['pseudo']));
							$statut=$test->fetch();
							if ($statut['statut']==0){
								$test->closeCursor();
								$set = $bdd->prepare('UPDATE users SET statut = 1 WHERE pseudo=:pseudo');
								$set->execute(array('pseudo' => $_POST['pseudo']));
								$set->closeCursor();
								$_SESSION['pseudo']=$_POST['pseudo'];
								header("Refresh:0");
								
							}
							else {
								echo '<p>Statut</p>';
								$test->closeCursor();
							}
						}
						else
						{
							echo '<p>Mot de passe ou pseudo introuvable</p>';
						}
						$req->closeCursor();
					}
				}
			}
		}
		
	?>
	</body>
	</html>