<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modifier un club</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des clubs de tennis de table</a>
	<h1>Modifier un club</h1>

	<?php
        // On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
        session_start ();

        // On récupère nos variables de session
        if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {

          // On teste pour voir si nos variables ont bien été enregistrées
          
          echo 'Vous êtes connecté sous le pseudo de: '.$_SESSION['login'];

          // On affiche un lien pour fermer notre session
          echo '<a href="./logout.php">Déconnection</a>';
        }
        else {
			header ('location: index.htm');
        }

	try {
		// On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=pingpong;charset=utf8', 'root', 'root');	

        // On récupère le id
	    $id = $_GET['numero'];
	
	
        // On va prendre les données du club
        $resultat = $bdd->prepare("SELECT * FROM clubs WHERE id = '$id' ");
        $resultat->execute();

        // On enregistre les données dans des variables
	    while ($donnees = $resultat->fetch())  {
            $nameclub = $donnees['nameclub'];
            $street = $donnees['street'];
            $numberstreet = $donnees['numberstreet'];
            $postalcode = $donnees['postalcode'];
            $city = $donnees['city'];
            $phonenumber = $donnees['phonenumber'];
            
        } 

	  	
	 // Changer les données

	 if(isset($_POST['submit'])) {
					
		// On récupère les données du formulaire
		$id = $_GET['numero'];
		$req = $bdd->prepare("UPDATE clubs SET nameclub=:nameclub, street=:street, numberstreet=:numberstreet, postalcode=:postalcode, city=:city, phonenumber = :phonenumber WHERE id=:id");

		
		if($req->execute(array(
			":id" => $id,
			":nameclub" => $_POST['nameclub'],
			":street" => $_POST['street'],
			":numberstreet" => $_POST['numberstreet'],
			":postalcode" => $_POST['postalcode'],
			":city" => $_POST['city'],
			":phonenumber" => $_POST['phonenumber']
		))){
			echo "Success";
		}else{
			echo "Failed : ".var_dump($req->errorInfo());
		}
	  }  
			
	}
	

	catch(Exception $e)
	{
	  // En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
	?>
	
	<form action="update.php?numero=<?php echo $test ?>" method="post">
		<div>
			<label for="nameclub">Nom</label>
			<input type="text" name="nameclub" value=' <?php 
				echo $nameclub;
			?>'>
		</div>

		<div>
			<label for="street">Rue</label>
			<input type="text" name="street" value=' <?php 
				echo $street;
			?>'>
		</div>
		
		<div>
			<label for="numberstreet">Numéro</label>
			<input type="number" name="numberstreet" value= <?php 
				echo $numberstreet;
			?>>
		</div>
		<div>
			<label for="postalcode">Code postal</label>
			<input type="number" name="postalcode" value="<?php 
				echo $postalcode;
			?>">
		</div>
		<div>
			<label for="city">Ville</label>
            <input type="text" name="city" value=<?php 
                echo $city;
            ?>>
		</div>
		<div>
			<label for="phonenumber">Numéro de téléphone</label>
            <input type="text" name="phonenumber" value=<?php 
                echo $phonenumber;
            ?>>
		</div>
		<button type="submit" name="submit">Envoyer</button>
	</form>
	
</body>
</html>
