<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un club</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
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

	?>



	<a href="read.php">Liste des clubs de ping pong</a>
	<h1>Ajouter un club</h1>
	<form action="create.php" method="post" enctype="multipart/form-data">
		<div>
			<label for="nameclub">Nom</label>
			<input type="text" name="nameclub"  value="">
		</div>

		<div>
			<label for="street">Rue</label>
			<input type="text" name="street"  value="">
		</div>
		
		<div>
			<label for="numberstreet">Numéro</label>
			<input type="number" name="numberstreet" value="">
		</div>
		<div>
			<label for="postalcode">Code postal</label>
			<input type="number" name="postalcode"  value="">
		</div>
		<div>
			<label for="city">Ville</label>
            <input type="text" name="city"  value="">
		</div>
		<div>
			<label for="phonenumber">Numéro de téléphone</label>
            <input type="text" name="phonenumber" value="" >
		</div>

		<div>
			<input type="hidden" MAX_FILE_SIZE="9000000" name="MAX_FILE_SIZE" value="9000000" />
			<!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
			Envoyez ce fichier : <input name="userfile"  type="file" />
		</div>
		<input type="submit" name="button" value="Envoyer">
	</form>

	
<?php
ini_set('display_errors', 1);
error_reporting(~0);
		try
		{
		// On se connecte à MySQL
		$bdd = new PDO('mysql:host=localhost;dbname=pingpong;charset=utf8', 'root', 'root');	
		
		if(isset($_POST['button']) && $_FILES) {
			
			// On récupère les données du formulaire
			$req = $bdd->prepare('INSERT INTO clubs (nameclub, street, numberstreet, postalcode, city, phonenumber, imageclub) VALUES (:nameclub, :street, :numberstreet, :postalcode, :city, :phonenumber, :imageclub)');
			if($_FILES) {
				$uploaddir = "img/".$_FILES['userfile']['name'];
		
				echo '<pre>';
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir)) {
					echo "Le club a bien été ajouté, bravo!";
				} 

				if ($_FILES['userfile']["error"]){
					echo "Attention l'image est trop lourde";
				}
		
				echo '</pre>';
			}
			$req->execute(array(
				":nameclub" => $_POST['nameclub'],
				":street" => $_POST['street'],
				":numberstreet" => $_POST['numberstreet'],
				":postalcode" => $_POST['postalcode'],
				":city" => $_POST['city'],
				":phonenumber" => $_POST['phonenumber'],
				":imageclub" => "img/".$_FILES['userfile']['name']
			));

			}
			
		}
		catch(Exception $e)
		{
		// En cas d'erreur, on affiche un message et on arrête tout
			die('Erreur : '.$e->getMessage());
		}

	?>
</body>
</html>
