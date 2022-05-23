<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/inscription.css">
    <title>Document</title>
</head>
<body>

    <section class="container-fluid pt-5">
        
        <article class="mx-auto col-4 py-2">
        <h1>Formulaire d'inscription</h1>
        <?php
if(isset($_COOKIE['cookie_form'])){
       echo '<h2 class="text-danger">Utilisateur déjà éxistant</h2>';     }
        ?>
            <form class="needs-validation" method="post" action="formulaire_inscription.php" novalidate>
                <div class="form-group mb-3">
                        <label class="form-label" for="Nom">Nom</label>
                        <input class="form-control rounded-4" name="Nom" type="text" placeholder="Nom" required  maxlenght="50">
                        <div class="invalid-feedback">Veuillez entrer un nom valide</div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Prenom">Prénom</label>
                        <input class="form-control rounded-4" name="Prenom" type="text" placeholder="Prénom" required  maxlenght="50">
                        <div class="invalid-feedback">Veuillez entrer un prénom valide</div>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="Email">Identifiant</label>
                        <input class="form-control rounded-4" name="Email" type="text" placeholder="Mail" required  maxlenght="50">
                        <div class="invalid-feedback">Veuillez entrer un email valide</div>
                    </div>
                    <div class="form-floating mb-3">
                            <label for="pass">Mot de passe</label>
                            <input class="form-control rounded-4" name="Password" type="Password" placeholder="Password" required  minlenght="4" maxlenght="8">
                            <div class="invalid-feedback">Veuillez entrer un mot de passe valide</div>
                        </div>
                        <div class="form-floating mb-3">
                            <label for="role">Role</label>
                            <input class="form-control rounded-4" name="Role" type="type" placeholder="admin/visiteur..." required  maxlenght="8">
                            <div class="invalid-feedback">Veuillez entrer votre role</div>
                        </div>
                        <div class="col-12 mb-3"><p>Sexe</p>
                                <div class="mb-2 col-2">
                                    <input id="credit" name="Sexe" value="male"type="radio" class="form-check-input" checked="" required="">
                                    <label class="form-check-label" for="credit">Male</label>
                                </div>
                                <div class="col-10">
                                    <input id="credit" name="Sexe" value="female" type="radio" class="form-check-input" checked="" required="">
                                    <label class="form-check-label" for="credit">Female</label>
                                </div>
                        </div>  
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="same-address" required="">
                        <label class="form-check-label" for="same-address">Accepter notre charte d'utilisation</label>
                        <div class="invalid-feedback">Veuillez valider notre charte d'utilisation</div>
                    </div>    
                    
                    <button class="w-100 btn btn-primary col-4" value="Submit">
                        <span>Soumettre</span>
                    </button>
            </form>
        
    </section>  
</body>
</html>