<div class="header">
		<h1><b>Site de recettes</b></h1>
	</div>	
	<div class="navbar">
		<a class="active" href="accueil.php">Accueil</a>
		<a href="recette.php">Recettes</a>
	<?php
		session_start();
        	if(!empty($_SESSION['IdUser']))
        	{ 
        		?>
        			<a href="enregistrer_recettes.php">Créer une recette</a>
        			<div class="dropdown">
  						<button class="dropbtn">Mon Compte
  							<i class="fa fa-caret-down"></i>
  						</button>
  						<div class="dropdown-content">		
	        				<a href="deconnexion.php">Deconnexion</a>
	        				<a href="compte.php">Mon compte</a>
	        			</div>
	        		</div>
    			<?php
        	}
			else 
			{
				?>
					<a href="connexion.php" style="float: right;">Connexion</a>
					<a href="formulaire_inscription.php" style="float: right;">Inscription</a>
				<?php
			} 	 	
	?>
	</div>