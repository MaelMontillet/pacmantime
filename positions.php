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

<?php
if (isset($_POST['gameover'])){
	$set = $bdd->prepare('UPDATE users SET positionx=1 , positiony=1,couleur=\'none\',clef=\'none\',coeurs=3 WHERE clef=:clef');
	$set->execute(array('clef' => $_POST['clef']));
	$set->closeCursor();
	$_SESSION['gameover']='true';
}

if ( isset($_POST['positionx']) && isset($_POST['positiony']) && isset(($_POST['pseudo'])) ){
	
	$set = $bdd->prepare('UPDATE users SET positionx=:positionx , positiony=:positiony WHERE pseudo=:pseudo');
	$set->execute(array('pseudo' => $_POST['pseudo'] , 'positionx' => $_POST['positionx'], 'positiony' => $_POST['positiony']));
	$set->closeCursor();
	$result=array();
	$req = $bdd->prepare('SELECT positionx, positiony, pseudo, personnage, couleur  FROM users WHERE statut=1 AND clef=:clef');
	$req->execute(array('clef' => $_POST['clef']));
	while ($reponse = $req->fetch()){
		$result[] = $reponse['personnage'];
		$result[]= 	$reponse['pseudo'];
		$result[] = $reponse['positionx'];
		$result[] = $reponse['positiony'];
		$result[] = $reponse['couleur'];
	}
	for ($i=0; $i<count($result); $i+=5)
	{
		echo $result[$i] . ' ' . $result[$i+1] . ' ' . $result[$i+2]. ' ' .$result[$i+3] . ' ' .$result[$i+4]. ' ';
	}
	$req->closeCursor();
}
?>
	
	
	
	
	