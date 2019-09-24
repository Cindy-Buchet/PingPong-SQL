<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion / Inscription</title>
</head>
<body>
    <?php session_start() ?>
    <body>
        <section class="container">
            
        <h1>Se connecter / S'inscrire</h1>
        <form action="login.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <h2>Se connecter</h2>
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="login" class="form-control" id="pseudo" aria-describedby="emailHelp" placeholder="Pseudo">
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="pwd" class="form-control" id="password" placeholder="Mot de passe">
                    </div>
                    <?php echo (isset($_SESSION['resultat'])? "<p>Mauvais pseudo ou mot de passe</p>": NULL);?>
                    <input type="submit" value="Connexion" name="connexion">

                </div>

                <div class="col-md-6">
                    <h2>S'inscrire</h2>
                    <div class="form-group">
                        <label for="pseudo2">Pseudo</label>
                        <input type="text" name="new_login" class="form-control" id="pseudo2" aria-describedby="emailHelp" placeholder="Pseudo">
                    </div>

                    <div class="form-group">
                        <label for="password2">Mot de passe</label>
                        <input type="password" name="new_pwd" class="form-control" id="password2" placeholder="Mot de passe">
                    </div>
                    <?php echo (isset($_SESSION['inscri'])? "<p>Veuilez compléter les champs</p>": NULL) ?>
                    <input type="submit" name="inscription" value="Inscription">

                </div>
            </div>


        </form>

    </section>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php session_unset(); ?>
    </body>
</body>
</html>