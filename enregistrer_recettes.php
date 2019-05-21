<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags-->
    <meta charset="UTF-8">
    <!-- Main CSS-->
    <link href="style.css"rel="stylesheet">
	<title>enregistrer une recette</title>
</head>
<body>
	<?php 
	include "header.php";
	include "connexion_bdd.php";

        if(!empty($_SESSION['IdUser']))
        {  
        	if(!empty($_POST['nom']) && !empty($_POST['ingredients']) && !empty($_POST['tempscuisson']) && !empty($_POST['tempspreparation']) && !empty($_POST['recette']))
        	{
        		if($_SERVER["REQUEST_METHOD"] == "POST"){
						// Vérifie si le fichier a été uploadé sans erreur.
						if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
						    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
						    $filename = $_FILES["photo"]["name"];
						    $filetype = $_FILES["photo"]["type"];
						    $filesize = $_FILES["photo"]["size"];

						    // Vérifie l'extension du fichier
						    $ext = pathinfo($filename, PATHINFO_EXTENSION);
						    if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

						    // Vérifie la taille du fichier - 5Mo maximum
						    $maxsize = 5 * 1024 * 1024;
						    if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

						    // Vérifie le type MIME du fichier
						    if(in_array($filetype, $allowed)){
						        // Vérifie si le fichier existe avant de le télécharger.
						        if(file_exists("upload/" . $_FILES["photo"]["name"])){
						            echo $_FILES["photo"]["name"] . " existe déjà.";
						        } else{
						            move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
						            echo 'Votre fichier a été téléchargé avec succès.';
						        } 
						    } else{
						        echo '<div class="input-group">Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.</div>'; 
						    }
						} else{
						    echo "Error: " . $_FILES["photo"]["error"];
						}
					}
        		$ajou = $bdd->prepare('INSERT INTO recettes(IdUser_re, nom, ingredients, tempscuisson, tempspreparation, recette, nom_image) VALUES(:IdUser_re, :nom, :ingredients, :tempscuisson, :tempspreparation, :recette, :nom_image)');
				$ajou->execute(array(
					'IdUser_re' => $_SESSION['IdUser'],
					'nom' => $_POST['nom'],
					'ingredients' => $_POST['ingredients'],
					'tempscuisson' => $_POST['tempscuisson'],
					'tempspreparation' => $_POST['tempspreparation'],
					'recette' => $_POST['recette'],
					'nom_image' => $filename));
					?>
			        <div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
			          <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
			              <div class="card card-2"><!-- forme du formualire-->
			                  <div class="card-body"><!-- structre du formulaire-->
			                    <p class="title">Recette enregistrée avec succès</p>
			                  </div>
			              </div>
			          </div>
			        </div>
					<?php
        	}
        }
		else 
		{
			echo'<a href="formulaire_inscription.php"><input type="button" value="Inscription" class="btn btn--radius btn--green"></a>';
			echo'<a href="connexion.php"><input type="button" value="Connexion" class="btn btn--radius btn--green"></a>';
		} 
?>

    <div class="p-t-180 p-b-100"><!-- fond d'écran-->
        <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
            <div class="card card-2"><!-- forme du formualire-->
                <div class="card-heading"></div><!-- image formulaire-->
                <div class="card-body"><!-- structre du formulaire-->
                    <h2 class="title">Créez votre recette</h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Nom" name="nom">
                        </div>
                        <div class="input-group">
                            <TEXTAREA class="input--style-2" placeholder="Liste des ingrédients" name="ingredients" rows=6 cols=60></TEXTAREA>
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Temps de cuisson (écrire seulement le temps en minutes, ex: 30)" name="tempscuisson">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Temps de préparation (écrire seulement le temps en minutes, ex: 15)" name="tempspreparation">
                        </div>
					    <div class="input-group">
					        <TEXTAREA class="input--style-2" placeholder="Votre recette" name="recette" rows=6 cols=60></TEXTAREA> 
					    </div>
     					Fichier : <input type="file" name="photo" id="fileUpload">
     					<p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .jpeg, .png sont autorisés jusqu'à une taille maximale de 5 Mo.</p>
     					<?php
						?>
                        <?php
					        if(!empty($_SESSION['IdUser']))
					        {  
		                       echo'<div class="p-t-30">
		                            	<button class="btn btn--radius btn--green" type="submit">Valider</button>
		                        	</div>';
					        }
					        else
					        {
					        	echo 'Vous devez vous connecter pour pouvoir ajouter une recette';
					        }

                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>