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

<?php

if (isset($_POST['getcoeur'])){
	$select= $bdd->prepare('SELECT coeur FROM users WHERE clef=:clef');
	$select->execute(array('clef' => $_POST['clef']));
	if ($data=$select->fetch()){
		$result=$data['coeur'];
	}
	echo $result;
	$select->closeCursor();
}
if (isset($_POST['coeurenmoins'])){
	$select= $bdd->prepare('SELECT coeur,time FROM users WHERE clef=:clef');
	$select->execute(array('clef' => $_POST['clef']));
	if ($data=$select->fetch()){
		$result=$data['coeur'];
		$tps=(int)((Time()-1500000000)-($data['time']-1500000000));
	}
	echo $tps.' ';
	$select->closeCursor();
	if ($tps>500){
		$tpsupdate=Time();
		$set = $bdd->prepare('UPDATE users SET coeur=coeur-1,time=:time WHERE clef=:clef');
		$set->execute(array('clef' => $_POST['clef'],'time' => Time()));
		$set->closeCursor();
		$result-=1;
	}
	echo $result;
}

if (isset($_POST['gameover'])){
	$set = $bdd->prepare('UPDATE users SET positionx=1 , positiony=1,couleur=\'none\',clef=\'none\',coeur=3,statut=0 WHERE clef=:clef');
	$set->execute(array('clef' => $_POST['clef']));
	$set->closeCursor();
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
	
	
	
	
	