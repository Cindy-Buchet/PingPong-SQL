<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Clubs de tennis de table</title>
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
      <nav class="navbar navbar-expand-md navbar-light">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarToggler">
        <a class="navbar-brand" href="index.php">Ping Pong</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="read.php">Liste</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create.php">Ajouter</a>
          </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <?php
             // On récupère nos variables de session
              if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
                echo "<p>Connecté sous: " . $_SESSION['login'] . "</p>";

                // On affiche un lien pour fermer notre session
                echo '<a href="./logout.php">Me déconnecter</a>';
              }
              else {
                header ('location: index.php');
              }
          ?>
        </div>
      </div>
    </nav>
  </header>
    <section class="container">
    
      <h1>Liste des clubs de tennis de table</h1>
      <div class="row">
  
      <?php

        try
        {
          // On se connecte à MySQL
          $bdd = new PDO('mysql:host=localhost;dbname=pingpong;charset=utf8', 'root', 'root');	

          
          $resultat = $bdd->prepare('SELECT * FROM clubs');
          $resultat->execute();
         
          while ($donnees = $resultat->fetch())
          {
            ?>

              <article class='col-md-4'>
                <div class="card club">
                  <img class="card-img-top" src=' <?php echo $donnees['imageclub'] ?> ' alt=' <?php $donnees['nameclub']  ?>'>

                  <div class="card-body">
                    <p class="nom"> <?php echo $donnees['nameclub']  ?> </p>
                    <p class="rue"><i class="fa fa-home"></i> <?php echo $donnees['street']  . ", " . $donnees['numberstreet'] ?> </p>
                    <p class="ville"> <?php echo $donnees['postalcode'] . " "  . $donnees['city'] ?> </p>
                    <p><i class="fa fa-phone"></i> <?php echo $donnees['phonenumber'] ?> </p>
                  </div>

                  <div class="card-footer">
                    <a href='delete.php?supp=<?php echo $donnees['id'] ?>'><i class="fa fa-trash"></i> Supprimer</a>
                    <a href='update.php?numero=<?php echo  $donnees['id'] ?>'><i class="fa fa-pencil"></i> Modifier</a>
                  </div>

                </div>
              </article>

            <?php
          }
          
        }

        catch(Exception $e)
        {
          // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
        }

      ?>

      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     </body>
</html>
