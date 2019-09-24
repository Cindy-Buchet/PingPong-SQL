<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Clubs de tennis de table</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
	<a href="create.php">Ajouter un club de ping pong</a>
    <h1>Liste des clubs de tennis de table</h1>
    <table>
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


        try
        {
          // On se connecte à MySQL
          $bdd = new PDO('mysql:host=localhost;dbname=pingpong;charset=utf8', 'root', 'root');	

          
          $resultat = $bdd->prepare('SELECT * FROM clubs');
          $resultat->execute();
          echo "<tr><th>Supprimer</th><th>Nom</th><th>Rue</th><th>Numéro</th><th>Code postal</th><th>Ville</th><th>Numéro de téléphone</th><th>Image</th></tr>";
          
          while ($donnees = $resultat->fetch())
          {
            echo 
            "<tr><td>
                <a href='delete.php?supp=". $donnees['id'] . "'>" . "X" . "</a>
            </td>".
            
            "<td>".
                "<a href='update.php?numero=".$donnees['id']."'>" . $donnees['nameclub'] . "</a>".
            "</td><td>" . 
            $donnees['street'] . "</td><td>"  . 
            $donnees['numberstreet'] . "</td><td>"  . 
            $donnees['postalcode'] . "</td><td>"  . 
            $donnees['city'] . "</td><td>" .
            $donnees['phonenumber'] . "</td><td>" .
            "<img src='" . $donnees['imageclub'] . "' alt='" . $donnees['nameclub'] . "' /></td></tr>";
            
          }
          
        }

        catch(Exception $e)
        {
          // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
        }

      ?>

    </table>
  </body>
</html>
