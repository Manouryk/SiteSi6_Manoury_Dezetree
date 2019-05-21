<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags-->
    <meta charset="UTF-8">
    <!-- Main CSS-->
    <link href="style.css" rel="stylesheet">
	<title>Compte</title>
</head>
<body>
	<?php
		include "header.php";
		include "connexion_bdd.php";
		if(!empty($_SESSION['IdUser']))
	    {
	        $id = ($_SESSION['IdUser']);
	    }



	    $recette = $bdd->query("SELECT * FROM recettes WHERE IdUser_re = $id");	
	    
			
		while($donnees = $recette->fetch())
		{
			?>
            <div class="input--style-2">
		    	<div class="title">
                <h2><strong>Nom :</strong> <?php echo $donnees['nom']; ?></h2>
                </div>
		    	<img src="<?php echo 'upload/'.$donnees['nom_image'];?>" alt="..."><br />
		    	<div class="p-t-30">
		    		<?php
		    		echo'<a class="btn btn--radius btn--green" href="afficher_recette.php?id='.$donnees['idrecette'].'" name="Voir">Voir</a>';
		    		?>
		    	</div>
		    </div>
            <?php

        }
        if(!empty($_SESSION['IdUser']))
        {
        	$recette = $bdd->query("SELECT * FROM recettes WHERE IdUser_re = $id");
        	$donnees = $recette->fetch();
            $idre = $donnees['idrecette'];
	        if($donnees['IdUser_re'] == ($_SESSION['IdUser']))
	        {
				if (isset($_POST['Suprimmer']))
				{
					$delete = $bdd->prepare("DELETE FROM recettes WHERE idrecette = :id");
					$delete->execute(array( ':id' => $idre));
					$deleteuser = $bdd->prepare("DELETE FROM utilisateurs WHERE IdUser = :idu");
					$deleteuser->execute(array(':idu' => $_SESSION['IdUser']));
					session_destroy();
					header('Location: accueil.php');
					exit();
				}
				?>       
				<form action="" method="post">
					<div class="p-t-30">
						<button class="btn btn--radius btn--green" type="submit" name="Suprimmer">Suprimmer votre compte</button>
					</div>
				</form> 
				<?php 
	        }
        }        
    ?>

</body>
</html>