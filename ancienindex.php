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
<html>
    <head>
        <title>Login Pac Man Time</title>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		
    </head>
    <body>
	<?php
	#21 mai tout le systeme de connexion
		if (isset($_SESSION['pseudo']))
		{
			echo '
			<div id="conteneur">
				<p id="pseudo">';  echo $_SESSION ['pseudo']; echo '</p>
				<p id="test"> </p>
				<div>
					<canvas id="canvas" width="1500" height="900" onload="can()">
						<p>Désolé, votre navigateur ne supporte pas Canvas. Mettez-vous à jour</p>
					</canvas>
					
				</div>
				<div>
					<form action="index.php" method="post">
						<p>
							<input type="submit" name="deconexion" value="Deconexion" />
							</br>
							<input type="checkbox" name="mobile" id="mobile" selected="unselected" /> <label for="mobile"> Je suis sur mobile </label>
						</p>
					</form>
				</div>
			</div>
			';
			if (isset($_POST['deconexion']))
			{
				session_destroy();
				header("Refresh:0");
				$set = $bdd->prepare('UPDATE users SET statut = 0 WHERE pseudo=:pseudo');
				$set->execute(array('pseudo' => $_SESSION['pseudo']));
				$set->closeCursor();
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
			if (isset($_POST['pseudo'],$_POST['mdp']))
			{
				$_POST['pseudo']=strtolower($_POST['pseudo']);
				$exist=$bdd->prepare('SELECT * FROM users WHERE pseudo=:pseudo');
				$exist->execute(array('pseudo' => $_POST['pseudo'],));
				if (null==$_POST['mdp'] OR null==$_POST['pseudo'])
				{
					echo "Veillez à remplir tout les champs" ;
					$exist->closeCursor();
				}
				elseif (strlen($_POST['pseudo'])>10 OR strlen($_POST['mdp'])>10)
				{
					echo "Pseudo ou mot de passe trop long ! (10 charachtères maximums)";
				}
				else
				{
					#14 mai codage du systeme d'iscription.
					if ($_POST['mode']=="inscription")
					{
						$exist=$bdd->prepare('SELECT * FROM users WHERE pseudo=:pseudo');
						$exist->execute(array('pseudo' => $_POST['pseudo'],));
						if (!($exist->fetch()))
						{
							$exist->closeCursor();
							$req = $bdd->prepare('INSERT INTO users(pseudo,mdp,statut) VALUES(:pseudo,:mdp,0)');
							$req->execute(array('pseudo' => $_POST['pseudo'],'mdp' => $_POST['mdp'],));
							$_SESSION['pseudo']=$_POST['pseudo'];
							$req->closeCursor();
							header("Refresh:0");
						}
						else
						{	
							echo "Le pseudo que vous avez saisi est déjà utilisé !";
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
								echo 'Statut';
								$test->closeCursor();
							}
						}
						else
						{
							echo 'Mot de passe ou pseudo introuvable';
						}
						$req->closeCursor();
					}
				}
			}
		}
		
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="script.js"></script>
    </body>
</html>