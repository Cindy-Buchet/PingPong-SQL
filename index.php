<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/accueil.css" media="screen" title="no title" charset="utf-8">
    <title>Connexion / Inscription</title>
</head>
<body>
<?php session_start() ?>
<section class="accueil">
    <div class="container">
    <h1>Accueil</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3 accueil-form">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="connexion-tab" data-toggle="tab" href="#connexion" role="tab" aria-controls="connexion" aria-selected="true">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="inscription-tab" data-toggle="tab" href="#inscription" role="tab" aria-controls="inscription" aria-selected="false">Inscription</a>
                    </li>
                </ul>


                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="connexion" role="tabpanel" aria-labelledby="connexion-tab">
                        
                        <!-- CONNEXION -->
                        <form action="login.php" method="post">
                            <h2>Se connecter</h2>
                            <div class="form-group">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" name="login" class="form-control" id="pseudo" aria-describedby="emailHelp" placeholder="Pseudo">
                            </div>

                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" name="pwd" class="form-control" id="password" placeholder="Mot de passe">
                            </div>
                            <input type="submit" value="Connexion" name="connexion">
                        
                            <?php echo (isset($_SESSION['resultat'])? "<p>Mauvais pseudo ou mot de passe</p>": NULL);?>
                        
                        </form>
                    
                    </div>


                    <div class="tab-pane fade" id="inscription" role="tabpanel" aria-labelledby="inscription-tab">
                        
                        <!-- INSCRIPTION -->
                        <form action="login.php" method="post">
                            <h2>S'inscrire</h2>
                            <div class="form-group">
                                <label for="pseudo2">Pseudo</label>
                                <input type="text" name="new_login" class="form-control" id="pseudo2" >
                            </div>

                            <div class="form-group">
                                <label for="password2">Mot de passe</label>
                                <input type="password" name="new_pwd" class="form-control" id="password2" >
                            </div>
                            <input type="submit" name="inscription" value="Inscription">
                        
                            <?php echo (isset($_SESSION['inscri'])? $_SESSION['inscri']: NULL) ?>
                        </form>
                    
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php session_unset(); ?>
   
</body>
</html>