<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags-->
    <meta charset="UTF-8">
    <!-- Main CSS-->
    <link href="style.css" rel="stylesheet">
	<title>recette</title>
</head>
<body>
	<?php
		include "header.php";
		include "connexion_bdd.php";
		$recette = $bdd->query("SELECT * FROM recettes");		
		
		while($donnees = $recette->fetch())
		{
		?>
		    <div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
        		<div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
            		<div class="card card-2"><!-- forme du formualire-->
                		<div class="card-body"><!-- structre du formulaire-->
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
		    			</div>
		    		</div>
		    	</div>
		    </div>
			<?php
					
		}
	?>

</body>
</html>