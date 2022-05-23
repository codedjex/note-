<?php
session_start();
?>
<?php
if(isset($_COOKIE['cookie_id'])){
       echo '<h2 id="text-danger">identifiant ou mot de passe invalide</h2>';     }
        ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Note</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/svg" sizes="64x64" href="picture/logo-note2.svg">
        <link rel="stylesheet" href="style/header.css">
        <link rel="stylesheet" href="style/presentation.css">
        <link rel="stylesheet" href="style/tableau-categorie.css">
        <link rel="stylesheet" href="style/grille.css">
        <link rel="stylesheet" href="style/footer.css">
        <link rel="stylesheet" href="style/identification.css">
        <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
        <script src="java/header.js" async></script>
        <script src="java/tableau-categorie.js" async></script>
        <script src='java/filtre.js' async></script>
        <script src='java/identification.js' async></script>
        <script src='java/presentation.js' async></script>
        <script src="https://kit.fontawesome.com/29ac4cabe1.js"></script>
    </head>
    <body>

        <?php
        include 'PHP/header.php';
        ?>
            <main>
                <section id="presentation">
                <?php
                include 'PHP/presentation.php';
                ?>   
                </section>
              
                <div id="contenu">
                    <?php
                    include 'PHP/tableau-categorie.php';
                    ?>

                    <?php
                    include 'PHP/grille.php';
                    ?>
                </div>
            </main>
         <?php
         include 'PHP/footer.php';
         ?>
    </body>
</html>