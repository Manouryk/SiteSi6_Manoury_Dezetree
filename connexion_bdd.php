<?php
		try
	{
	    // On se connecte à MySQL
	    $pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=site', 'root', '', $pdo_options2);
	}
	catch(Exception $e)
	{
	    // En cas d'erreur, on affiche un message et on arrête tout
	    echo 'Nous avons un petit probléme sur le site veuiller réessayer plus tard<br/>';
	        die('Erreur : '.$e->getMessage());
	}
?>