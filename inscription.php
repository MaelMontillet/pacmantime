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
<html lang="fr">
<link href="sign.css" rel="stylesheet">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<title>S'inscrire - Pac-Man</title>
</head>
	<h1>
	PacMan Time &#128123;&#9203;
	</h1>
<body>
		<br><br>
		 <div class="form">
		 	<div class="image">
</div>
    <div class="header"><h2> Inscription </h2> </div>

    <div class="Login">
     <form action="inscription.php" method="post" class="form-example">
       <ul>
        <li><label for="username"><b>Pseudo:</b></label><input type="text" required class="text" name="pseudo"></li>
        <br>
        <li><label for="username"><b>Mot de passe:</b></label><input type="password" required class="text" name="mdp"></li>
        <br>
        <li><label for="username"><b>Confirmer le mot de passe:</b></label><input type="password" required class="text" name="confmdp"></li>
        <br>
        <li><input type="submit"  value="S'inscrire"   class="button"></li>
		<br><br>
	</ul>
	<?php
	if (isset($_POST['pseudo'],$_POST['mdp'])){
				
				$_POST['pseudo']=strtolower($_POST['pseudo']);
				if (null==$_POST['mdp'] OR null==$_POST['pseudo']){
					
					echo "<p>Veillez à remplir tout les champs<p>" ;
				}
				elseif (strlen($_POST['pseudo'])>10 OR strlen($_POST['mdp'])>10){
					
					echo "<p>Pseudo ou mot de passe trop long ! (10 charachtères maximums)</p>";
				}
				elseif ($_POST['mdp']!=$_POST['confmdp']){
					echo "<p> Mot de passe et confirmation de mot de passe différents </p>";
				}
				else{
					#14 mai codage du systeme d'iscription.
					
						$exist=$bdd->prepare('SELECT * FROM users WHERE pseudo=:pseudo');
						$exist->execute(array('pseudo' => $_POST['pseudo'],));
						if (!($exist->fetch()))
						{
							$exist->closeCursor();
							$req = $bdd->prepare('INSERT INTO users(pseudo,mdp,statut,clef,couleur) VALUES(:pseudo,:mdp,0,\'none\',\'none\')');
							$req->execute(array('pseudo' => $_POST['pseudo'],'mdp' => $_POST['mdp'],));
							$_SESSION['pseudo']=$_POST['pseudo'];
							$req->closeCursor();
							echo '<script> window.location = "index.php" </script>';
						}
						else
						{	
							echo "<p>Le pseudo que vous avez saisi est déjà utilisé !</p>";
							$exist->closeCursor();
						}
				}
	}
	?>
</body>
</html>