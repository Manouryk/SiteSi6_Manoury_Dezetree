<?php
session_start();
  include "connexion_bdd.php";

  if (isset($_POST['Valider'])) 
  {
    $mail=htmlspecialchars($_POST['mail']);
    $mdp=md5($_POST['password']);
    if(!empty($mail) AND !empty($mdp))
    {
      $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE mail = ? AND password= ?");
      $requser->execute(array($mail, $mdp));    
      $userexist = $requser->rowCount();

      if ($userexist==1)
      {
        $userinfo=$requser->fetch();
        $_SESSION['IdUser'] = $userinfo['IdUser'];
        $_SESSION['mail'] = $userinfo['mail'];
        header("Location: accueil.php?id=".$_SESSION['IdUser']);
      }
       
      else 
		  {
        ?>
        <div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
          <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
              <div class="card card-2"><!-- forme du formualire-->
                  <div class="card-body"><!-- structre du formulaire-->
                    <h2>Mauvais identifiant ou mot de passe !</h2>
                  </div>
              </div>
          </div>
        </div>
        <?php
    	}
	  }   
  }
?>   

<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <!-- Main CSS-->
  <link href="style.css" rel="stylesheet">
	<title>connexion</title>
</head>
<body>
    <div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
        <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
            <div class="card card-2"><!-- forme du formualire-->
                <div class="card-heading"></div><!-- image formulaire-->
                <div class="card-body"><!-- structre du formulaire-->
                    <h2 class="title">Connexion</h2>
                    <form action="" method="post">
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Adresse mail" name="mail">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Mot de passe" name="password">
                        </div>
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit" name="Valider">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
