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

	if(!empty($_GET['id'])) 
    {
        $id = ($_GET['id']);
    }

    $recette = $bdd->query("SELECT * FROM recettes WHERE idrecette = $id");

		
	while($donnees = $recette->fetch())
	{
		?>
    	<div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
        	<div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
            	<div class="card card-2"><!-- forme du formualire-->
                	<div class="card-body"><!-- structre du formulaire-->
                		<div class="card-heading-recette">
						<img src="<?php echo 'upload/'.$donnees['nom_image'];?>" alt="..."></br>
						</div>
                		<div class="title">
                			<h2><strong>Nom :</strong> <?php echo $donnees['nom']; ?></h2>
                		</div>
                		<div class="input--style-2">
                			<strong>Liste de ingrédients :</strong> <?php echo $donnees['ingredients']; ?>
                		</div>
                		<div class="input--style-2">
                			<strong>Temps de cuisson :</strong> <?php echo $donnees['tempscuisson']; ?><strong> minutes</strong>
                		</div>
                		<div class="input--style-2">
                			<strong>Temps de preparation :</strong> <?php echo $donnees['tempspreparation']; ?><strong> minutes</strong>
                		</div>
                		<div class="input--style-2">
                			<strong>Détails de la recette :</strong> <?php echo $donnees['recette']; ?>
                		</div>
                			<?php
                			if(!empty($_SESSION['IdUser']))
                			{
                				$idre = $donnees['idrecette'];
	                		    if($donnees['IdUser_re'] == ($_SESSION['IdUser']))
	                		    {
							        if (isset($_POST['Suprimmer']))
									{
										$delete = $bdd->prepare("DELETE FROM recettes WHERE idrecette = :id");
										$delete->execute(array( ':id' => $idre));
										header('Location: recette.php');

									}
									?>       
							        <form action="" method="post">
								        <div class="p-t-30">
								            <button class="btn btn--radius btn--green" type="submit" name="Suprimmer">Suprimmer</button>
										</div>
								    </form> 
								     <?php 
	                		    }
                			}                		    
	                		?>          		                		        						
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	
	if(!empty($_SESSION['IdUser']))
	{
		?>
		<div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
        	<div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
            	<div class="card card-2"><!-- forme du formualire-->
                	<div class="card-body"><!-- structre du formulaire-->
						<form action="" method="post">
							<div class="input-group">
                            	<input class="input--style-2" type="text" placeholder="Ajouter votre Nom" name="nom">
                        	</div>
							<div class="input-group">
								<TEXTAREA class="input--style-2" placeholder="Ajouter un commentaire public..." name="Commentaire" rows=6 cols=60></TEXTAREA> 
							</div>
							<div class="p-t-30">
								<button class="btn btn--radius btn--green" type="submit" name="Valider">Valider</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>				
		<?php
		
		?>
		<?php
		if(!empty($_POST['Commentaire']))
		{
			$ajoucom = $bdd->prepare('INSERT INTO commentaires(idcom_re, commentaire, nom, 	IdUser_com) VALUES(:idcom_re, :commentaire, :nom, :IdUser_com)');
			$ajoucom->execute(array('idcom_re' => $id, 'commentaire' => $_POST['Commentaire'], 'nom' => $_POST['nom'], 'IdUser_com' => $_SESSION['IdUser']));
		}		
	}

	$com = $bdd->query("SELECT * FROM commentaires WHERE idcom_re = $id");
	?>
	<div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
        <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
            <div class="card card-2"><!-- forme du formualire-->
                <div class="card-body"><!-- structre du formulaire-->
                <div class="title">
                	<h2><strong>Commentaire :</strong></h2>
                </div>
                <?php
					while($donnees_com = $com->fetch())
					{
					?>
						<div class="input--style-2">
							<strong><?php if(!empty($donnees_com['nom'])){echo $donnees_com['nom'];} else{echo'Inconnu';}?> :</strong> <?php echo $donnees_com['commentaire']; ?>
						</div>						
				    	<?php
						if(!empty($_SESSION['IdUser']))
	                	{
	                		$idcom = $donnees_com['idcom'];
		                	if($donnees_com['IdUser_com'] == ($_SESSION['IdUser']))
		                	{
								if (isset($_POST['Suprimmer_com']))
								{
									$delete = $bdd->prepare("DELETE FROM commentaires WHERE idcom = :idc");
									$delete->execute(array( ':idc' => $idcom));
									header('Location: afficher_recette.php?id='.$donnees_com['idcom_re'].'');
								}
								?>       
								<form action="" method="post">
									<div class="p-t-30">
									    <button class="btn btn--radius btn--green" type="submit" name="Suprimmer_com">Suprimmer</button>
									</div>
								</form> 
								<?php 
		                	}
	                	}
	                	?>
	                	<p>-------------------------------------------------------------</p>
	                	<?php
	                }
				?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>