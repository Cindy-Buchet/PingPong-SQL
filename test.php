<!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
<form enctype="multipart/form-data" action="test.php" method="post">
  <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
  <input type="hidden" MAX_FILE_SIZE="30000" name="MAX_FILE_SIZE" value="300000" />
  <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
  Envoyez ce fichier : <input name="userfile"  type="file" />
  <input type="submit" value="Envoyer le fichier" />
</form>


<?php
    if($_FILES) {
        $uploaddir = "img/".$_FILES['userfile']['name'];

        echo '<pre>';
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir)) {
            echo "Le fichier est valide, et a été téléchargé
                avec succès. Voici plus d'informations :\n";
        } else {
            echo "Attaque potentielle par téléchargement de fichiers.
                Voici plus d'informations :\n";
            echo "Not uploaded because of error #".$_FILES["userfile"]["error"];
        }

        echo '</pre>';
    }
 
?>
