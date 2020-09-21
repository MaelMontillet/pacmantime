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

/*gaubert
lun. 29 juin 15:19 (il y a 16 heures)
À moi*/
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>game-over</title>
    <link href="game-over-style.css" rel="stylesheet">
</head>

<body>


<img src="1200px-Pac-Man_Logo.svg.png"
     align="center"
     alt = "oups, une erreur vient de se produire. Veuillez actualiser la page."
     width="2000"
     height="500">

<div>
    <div class="pacman">
        <div class="pacman-eyes"></div>
        <div class="pacman-mouth"></div>
        <div class="pacman-food"></div>
        <div class="quitter-rejouer"></div>
        <div class="game-over"></div>
    </div>
<p class="quitter-rejouer">
    Bonne partie!
    Cliquez pour rejouer
</p>

<p class="game-over">
    GAME OVER!
</p>

    </div>
<?php
	$_SESSION['jouer']='false';
?>
<script> window.addEventListener("click", function reload(event){
	window.location = "index.php";
});
</body>
</html>