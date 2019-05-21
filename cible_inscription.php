<!DOCTYPE html>
<html>
<head>
	    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <!-- Main CSS-->
    <link href="style.css" rel="stylesheet">
	<title>cible</title>
</head>
<body>

<?php
	include "connexion_bdd.php";

	$mail = htmlspecialchars($_POST['mail']);
	$tel = htmlspecialchars($_POST['tel']);
	
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['tel']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['addpost']) && !empty($_POST['codepost']) && !empty($_POST['ville']))
    {
        $reqmail = $bdd->prepare("SELECT * FROM utilisateurs WHERE mail = ?");
        $reqmail->execute(array($mail));
        $mailexist = $reqmail->rowCount();

    	if($mailexist > 0 ) 
    	{
	        ?>
	        <div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
	          <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
	              <div class="card card-2"><!-- forme du formualire-->
	                  <div class="card-body"><!-- structre du formulaire-->
	                    <h2>Cette adresse mail est déjà utilisé !</h2>
	                    <div class="p-t-30">
							<a href="accueil.php"><button class="btn btn--radius btn--green" type="submit">Retour à l'accueil</button></a>
						</div>
	                  </div>
	              </div>
	          </div>
	        </div>
	        <?php	    		
    	}
    	else
    	{
    	    $reqtel = $bdd->prepare("SELECT * FROM utilisateurs WHERE tel = ?");
        	$reqtel->execute(array($tel));
        	$telexist = $reqtel->rowCount();

    		if($telexist > 0)
    		{
		        ?>
		        <div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
		          <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
		              <div class="card card-2"><!-- forme du formualire-->
		                  <div class="card-body"><!-- structre du formulaire-->
		                    <h2>Ce numéro de téléphone est déjà utilisé !</h2>
		                    <div class="p-t-30">
								<a href="accueil.php"><button class="btn btn--radius btn--green" type="submit">Retour à l'accueil</button></a>
							</div>
		                  </div>
		              </div>
		          </div>
		        </div>
		        <?php  			
    		}
    		else
	    	{
		    	$ajou = $bdd->prepare('INSERT INTO utilisateurs(nom, prenom, tel, mail, password, addpost, codepost, ville) VALUES(:nom, :prenom, :tel, :mail, :password, :addpost, :codepost, :ville)');
				$ajou->execute(array(
					'nom' => $_POST['nom'],
					'prenom' => $_POST['prenom'],
					'tel' => $_POST['tel'],
					'mail' => $_POST['mail'],
					'password' => md5($_POST['password']),
					'addpost' => $_POST['addpost'],
					'codepost' => $_POST['codepost'],
					'ville' => $_POST['ville']));
					?>
					<div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
				        <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
				            <div class="card card-2"><!-- forme du formualire-->
				                <div class="card-heading"></div><!-- image formulaire-->
				                <div class="card-body"><!-- structre du formulaire-->
				                    <h2 class="title">Inscription terminée</h2>
				                    <div class="p-t-30">
										<a href="accueil.php"><button class="btn btn--radius btn--green" type="submit">Retour à l'accueil</button></a>
									</div>
				                </div>
				            </div>
				        </div>
				    </div>
					<?php

	    	}
  		}  
    }


    else
    {
	    ?>
		<div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
		    <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
		        <div class="card card-2"><!-- forme du formualire-->
		            <div class="card-body"><!-- structre du formulaire-->
		                <h2>L'inscription a échouée !</h2>
				                    <div class="p-t-30">
										<a href="accueil.php"><button class="btn btn--radius btn--green" type="submit">Retour à l'accueil</button></a>
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