<?php
/**** Supprimer une randonnée ****/
// On se connecte à MySQL
try {
    $bdd = new PDO('mysql:host=localhost;dbname=pingpong;charset=utf8', 'root', 'root');
} 
catch(Exception $e)
{
  // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
	
$test = $_GET['supp'];
$resultat = $bdd->prepare("DELETE FROM clubs WHERE id = '$test' ");
$resultat->execute();

header('Location: read.php'); 