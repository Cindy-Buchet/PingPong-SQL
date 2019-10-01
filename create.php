<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un club</title>
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
			
					
					if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir)) {
						$ajoutclub = "Le club a bien été ajouté, bravo!";
					} 

					if ($_FILES['userfile']["error"]){
						$ajoutclub =  "Attention l'image est trop lourde";
					}
			
				}
				$req->execute(array(
					":nameclub" => htmlspecialchars($_POST['nameclub']),
					":street" => htmlspecialchars($_POST['street']),
					":numberstreet" => htmlspecialchars($_POST['numberstreet']),
					":postalcode" => htmlspecialchars($_POST['postalcode']),
					":city" => htmlspecialchars($_POST['city']),
					":phonenumber" => htmlspecialchars($_POST['phonenumber']),
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
  
    <main class="container">
		<div class="row create-padding">
			<div class="col-md-3 offset-md-2 img-create">
				<div class=""></div>
				<h1>Ajouter un club de ping pong</h1>
			</div>
			<div class="col-md-5 create">
				<form class="create-form" action="create.php" method="post" enctype="multipart/form-data">
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
					<p class="erreur"><?php echo (isset($ajoutclub)? $ajoutclub: NULL) ?></p>
				</form>
			</div>
		</div>


		

		
	
	</main>
</body>
</html>
