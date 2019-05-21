<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <!-- Main CSS-->
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="bg-red p-t-180 p-b-100 "><!-- fond d'écran-->
        <div class="wrapper wrapper--w960"><!-- dimensions du formualire-->
            <div class="card card-2"><!-- forme du formualire-->
                <div class="card-heading"></div><!-- image formulaire-->
                <div class="card-body"><!-- structre du formulaire-->
                    <h2 class="title">Inscription</h2>
                    <form action="cible_inscription.php" method="post">
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Nom" name="nom">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Prenom" name="prenom">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Telephone (ex: 0237569642)" name="tel">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Addresse mail (ex: toto@gmail.com)" name="mail">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Mot de passe" name="password">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Addresse postale" name="addpost">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Code postale (ex: 28000)" name="codepost">
                        </div>
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Ville" name="ville">
                        </div>
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>