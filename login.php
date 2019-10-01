<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>echo
  <?php
    session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=pingpong;charset=utf8', 'root', 'root');	

    // Si il a cliqué sur connexion
    if (isset($_POST['connexion'])){

      $login = $_POST['login'];
      $pwd = sha1($_POST['pwd']);
        
      if (isset($_POST['login']) && isset($_POST['pwd'])) {
        
        // Vérifier que l'utilisateur existe
        $req = $bdd->prepare('SELECT id FROM users WHERE pseudo = :pseudo AND pwd = :pwd');
        
        $req->execute(array(
          'pseudo' => $login,
          'pwd' => $pwd));
        $resultat = $req->fetch();
        
        
        // Mauvais mdp ou pseudo
        if (!$resultat) {
          $_SESSION['resultat'] =  'Mauvais identifiant ou mot de passe !';
          header('location:index.php');
        }
        
        // C'est ok
        else {
          // on enregistre les paramètres de notre visiteur comme variables de session 
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

    function checkInfo() {
      return !empty($_POST['new_login']) && !empty($_POST['new_pwd']);
    }

    // Si il a cliqué sur inscription
    if (isset($_POST['inscription'])){
      if ($_POST['new_pwd'] != $_POST['new_pwd2']){
        $_SESSION['inscri'] = "Veuillez confirmer le bon mot de passe";
      }

      else if (checkInfo()) {
        $new_login = $_POST['new_login'];
        $new_pwd = sha1($_POST['new_pwd']);

        $prepa = $bdd->prepare('INSERT INTO users (pseudo, pwd) VALUES (:pseudo, :pwd)');
        
        $prepa->execute(array(
          ':pseudo' => $new_login,
          ':pwd' => $new_pwd
        ));

        $prepa->fetch();

        $_SESSION['inscri'] = "Vous vous êtes bien inscris!";

      }
      else {
        $_SESSION['inscri'] = "C'est râté";
      }
      
      header ('location: index.php');

    }
    ?>
  </body>
</html>