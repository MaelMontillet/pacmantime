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
	
	
if ( isset($_POST['positionx']) && isset($_POST['positiony']) && isset(($_POST['pseudo'])) ){
	
	$set = $bdd->prepare('UPDATE users SET positionx=:positionx , positiony=:positiony WHERE pseudo=:pseudo');
	$set->execute(array('pseudo' => $_POST['pseudo'] , 'positionx' => $_POST['positionx'], 'positiony' => $_POST['positiony']));
	$set->closeCursor();
	$result=array();
	$req = $bdd->query('SELECT positionx, positiony, pseudo  FROM users WHERE statut=1');
	while ($reponse = $req->fetch()){
		$result[] =  'P';
		$result[]= 	$reponse['pseudo'];
		$result[] = $reponse['positionx'];
		$result[] = $reponse['positiony'];
	}
	for ($i=0; $i<count($result); $i+=4)
	{
		echo $result[$i] . ' ' . $result[$i+1] . ' ' . $result[$i+2]. ' ' .$result[$i+3] . ' ';
	}
	$req->closeCursor();
	}
?>
	
	
	
	
	