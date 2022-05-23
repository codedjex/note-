<?php
session_start();

            $servname = "localhost"; $dbname = "note"; $user = "root"; $pass = "";$ID = $_GET["ID"] ;
            try{
                $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sth = $dbco->prepare("
                SELECT ID,Nom,Image,Description,Formations
                FROM produits
                WHERE ID= $ID
                
                ");
                $sth-> execute();
                $produits = $sth->fetchAll(PDO::FETCH_ASSOC);
               
            }
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }

            // Exécution de la requête chargeant la liste des formations :
            $donnees_formations = $dbco->prepare("SELECT Titre, Formation
                                                 FROM formations");
            $donnees_formations->execute();
            $formations = $donnees_formations->fetchAll();
        ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Document</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style\font.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/svg" sizes="64x64" href="picture/logo-note2.svg">
        <link rel="stylesheet" href="style\header.css">
        <link rel="stylesheet" href="style\footer.css">
        <link rel="stylesheet" href="page-produit.css">
        <link rel="stylesheet" href="style/identification.css">
        <script src='java\presentation.js' async></script>
        <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
        <script src="java/header.js" async></script>
        <script src="java/filtre_produit.js" async></script>
        <script src='java/identification.js' async></script>
        <script src="https://kit.fontawesome.com/29ac4cabe1.js"></script>
    </head>
    <body>
      
    <?php
        include 'PHP/header.php';
        ?>
           <?php
                foreach($produits as $produit){
                    ?>
        <article class="wiki">
            <embed src="https://fr.wikipedia.org/wiki/<?php echo utf8_encode( $produit['Nom']) ?>#firstHeading" width="100%" height="500" object-fit= "contain"/>
        </article>
        <?php  
                }
                ?>
        <main class="contenair-produit">
      <?php
                foreach($produits as $produit){
                    $tableau_formations = explode(';', utf8_encode ($produit['Formations']));
                    $valeurs_formations = "";
                    foreach ($formations as $formation) {
                        if (in_array($formation['Formation'], $tableau_formations)) {
                            $valeurs_formations .= ((strlen($valeurs_formations) > 0) ? ", " : "") . $formation['Titre'];
                        }
                    }
                    ?>
                <article class="instru">
                    <h1><?php echo utf8_encode ($produit['Nom']) ?></h1>
                        <figure>
                            <img title= <?php echo $produit['Nom'] ?> src="picture/<?php echo $produit['Image']?>" alt="Image <?php echo $produit['Nom'] ?>">
                            <?php
                            if (strlen($valeurs_formations) > 0) {
                            ?>
                                <figcaption><?php echo $valeurs_formations ?> </figcaption>
                            <?php
                            }
                            ?>
                        </figure>
                        <p> <?php echo utf8_encode ($produit['Description']) ?></p>
                </article>
                    <?php  
                }
                ?> 
        </main>

    
         <?php
         include 'PHP/footer.php'
         ?>
       
    </body>
    </html>
