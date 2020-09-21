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
<link href="styleconnexion.css" rel="stylesheet">
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telephone=no">
		<title>
			Se connecter - Pac-Man
		</title>
		
	</head>
	<h1>
PacMan Time &#128123;&#9203;
</h1>
	<body id="b">
		<br><br>
		 <div class="form">
		 	<div class="image">
</div>
    <div class="header"><h2> Connexion </h2> </div>

    <div class="Login">
     <form action="connexion.php" method="post" class="form-example">
       <ul>
         <li><span class="bonhomme"><i class="fa fa-user"></i></span><input type="text" required class="text" placeholder="Pseudo" name="pseudo"></li>
         <br>
         <li><span class="cadenas"><i class="fa fa-lock"></i></span><input type="password" required class="text" placeholder="Mot de passe" name="mdp"></li>
         <br><br>
         <li><input type="submit"  value="Se connecter"   class="button"></li>
         <li><div class="line"><span class="check"><input type="checkbox" id="t" <label for="t"> Se souvenir de moi</label></span><span class="check"><a href="#">Forget Password</a><!--lien vers la page redirectionnelle à mettre--></span></div></li>
       </ul>
     
    </div>
<div class="register">
  <span class="accountprompt">Besoin de créer un compte ?</span><div class="sign"><a href="inscription.php">Créer un compte</a><br><br></div>
 </form>
<?php
#21 mai tout le systeme de connexion
if (isset($_POST['pseudo'],$_POST['mdp'])){
	$_POST['pseudo']=strtolower($_POST['pseudo']);
	echo $_POST['pseudo'] . $_POST['mdp'];
	if (null==$_POST['mdp'] OR null==$_POST['pseudo']){					
		echo "<p>Veillez à remplir tout les champs<p>" ;
	}
	elseif (strlen($_POST['pseudo'])>10 OR strlen($_POST['mdp'])>10){
		echo "<p>Pseudo ou mot de passe trop long ! (10 charachtères maximums)</p>";
	}
	else{
		$req = $bdd->prepare('SELECT * FROM users WHERE pseudo=:pseudo AND mdp=:mdp');
		$req->execute(array('pseudo' => $_POST['pseudo'],'mdp' => $_POST['mdp']));
	if ($req->fetch())
		{	
			$req->closeCursor();
			$_SESSION['pseudo']=$_POST['pseudo'];
			echo '<script> window.location = "index.php" </script>';
		}
	else{
		echo '<p>Mot de passe ou pseudo introuvable</p>';
	}
	$req->closeCursor();
	}
}
?>
</body>
</html>