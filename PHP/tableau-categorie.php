<?php
            $servname = "localhost"; $dbname = "note"; $user = "root"; $pass = "";
            try{
                $dbco = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8", $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sth = $dbco->prepare("SELECT ID_Categorie, Titre, Categorie, Photo
                                       FROM categories");
                $sth-> execute();
                $categories = $sth->fetchAll(PDO::FETCH_ASSOC);
               
            }
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
        ?>

<section id="tableau-categories">
    <div class="tableau">

    <?php
    foreach($categories as $categorie){
    ?>
        <figure onclick="definir('famille', '<?= $categorie['Categorie'] ?>')" style="background-image: url(picture/<?= $categorie['Photo']?>);">
            <figcaption><p><?= ($categorie['Titre']) ?></p></figcaption>
        </figure>
    <?php
    }
    ?>
    </div>
</section>