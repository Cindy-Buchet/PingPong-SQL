<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modifier un club</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>
<body>
<?php
      // On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
      session_start ();

    ?>
	<div class="fond"></div>
    <header>
      <nav class="navbar navbar-expand-md navbar-light ">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarToggler">
        <a class="navbar-brand" href="index.php">Ping Pong</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item ">
            <a class="nav-link" href="read.php">Liste</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="create.php">Ajouter</a>
          </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <?php
             // On récupère nos variables de session
              if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
                echo "<p>Connecté sous: " . $_SESSION['login'] . "</p>";

                // On affiche un lien pour fermer notre session
                echo '<a class="deco" href="./logout.php">Me déconnecter</a>';
              }
              else {
                header ('location: index.php');
              }
          ?>
        </div>
      </div>
    </nav>
  </header>

	<?php
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
			
	}
	

	catch(Exception $e)
	{
	  // En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
	?>
   
	<main class="container">
		<div class="row update-padding">
			<div class="col-md-3 offset-md-2 img-update">
				<div class=""></div>
				<h1>Modifier le club: <?php echo $nameclub ?></h1>
			</div>
			<div class="col-md-5 create">
				<form action="update.php?numero=<?php echo $id ?>" method="post">
					<div>
						<label for="nameclub">Nom</label>
						<input type="text" name="nameclub" value='<?php 
							echo $nameclub;
						?>'>
					</div>

					<div>
						<label for="street">Rue</label>
						<input type="text" name="street" value='<?php 
							echo $street;
						?>'>
					</div>
					
					<div>
						<label for="numberstreet">Numéro</label>
						<input type="number" name="numberstreet" value='<?php 
							echo $numberstreet;
						?>'>
					</div>
					<div>
						<label for="postalcode">Code postal</label>
						<input type="number" name="postalcode" value='<?php 
							echo $postalcode;
						?>'>
					</div>
					<div>
						<label for="city">Ville</label>
						<input type="text" name="city" value='<?php 
							echo $city;
						?>'>
					</div>
					<div>
						<label for="phonenumber">Numéro de téléphone</label>
						<input type="text" name="phonenumber" value='<?php 
							echo $phonenumber;
						?>'>
					</div>
					<input type="submit" name="submit" value="Enregistrer">
				</form>
			</div>
		</div>
		<?php
	try {
		// On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=pingpong;charset=utf8', 'root', 'root');	

        // On récupère le id
	    $id = $_GET['numero'];


	  	
		// Changer les données

		if(isset($_POST['submit'])) {
						
			// On récupère les données du formulaire
			$id = $_GET['numero'];
			$req = $bdd->prepare("UPDATE clubs SET nameclub=:nameclub, street=:street, numberstreet=:numberstreet, postalcode=:postalcode, city=:city, phonenumber = :phonenumber WHERE id=:id");

			
			if($req->execute(array(
				":id" => $id,
				":nameclub" => htmlspecialchars($_POST['nameclub']),
				":street" => htmlspecialchars($_POST['street']),
				":numberstreet" => htmlspecialchars($_POST['numberstreet']),
				":postalcode" => htmlspecialchars($_POST['postalcode']),
				":city" => htmlspecialchars($_POST['city']),
				":phonenumber" => htmlspecialchars($_POST['phonenumber'])
			)))
			header ('location: update.php?numero=' . $id);
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
