<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>echo
  <?php
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];
    session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=pingpong;charset=utf8', 'root', 'root');	

    // Vérifier que l'utilisateur existe
    if (isset($_POST['connexion'])){
        
      if (isset($_POST['login']) && isset($_POST['pwd'])) {
        
        $req = $bdd->prepare('SELECT id FROM users WHERE pseudo = :pseudo AND pwd = :pwd');
        
        $req->execute(array(
          'pseudo' => $login,
          'pwd' => $pwd));
        $resultat = $req->fetch();

        if (!$resultat) {
          // Mauvais mdp ou pseudo
          $_SESSION['resultat'] =  'Mauvais identifiant ou mot de passe !';
          header('location:index.php');
        }
        
        else {
          // dans ce cas, tout est ok, on peut démarrer notre session

          // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
          $_SESSION['login'] = $_POST['login'];
          $_SESSION['pwd'] = $_POST['pwd'];
          $_SESSION['resultat'] = 'Vous êtes connecté !';

          
          // on redirige notre visiteur vers une autre page
          header ('location: read.php');
        }

      }
      else {
        echo 'Les variables du formulaire ne sont pas déclarées.';
      }
    }

    if (isset($_POST['inscription'])){
      $_SESSION['inscri'] = "Vous devez vous inscrire";
      header ('location: index.php');
    }
    ?>
  </body>
</html>