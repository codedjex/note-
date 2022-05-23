<?php

session_start();

// Connexion à la base de données :
try {    
    $BDD = new PDO('mysql:host=localhost;dbname=note;charset=utf8', 'root', '');
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die ('Erreur : ' . $e->getMessage());
}

// Récupération du nom de la catégorie de l'instrument :
$donnees_categories = $BDD->prepare("SELECT Categorie
                                    FROM categories
                                    WHERE ID_Categorie = '" . $_POST['Categorie'] . "'");
$donnees_categories->execute();
$categories = $donnees_categories->fetchAll();
$categorie = $categories[0]['Categorie'];

// Vérification des données :
function verification($donnees) {
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

$nom = verification($_POST['Nom']);
$description = verification($_POST['Description']);
$image = $categorie . "/" . $_FILES['Image']['name'] ;
$id_categorie = verification($_POST['Categorie']);
$taille = verification($_POST['Taille']);
$formations = "";
print_r($_POST);
foreach ($_POST['Formations'] as $formation) {
    if (strlen($formations) > 0) {
        $formations .= ';';
    }
    $formations .= verification($formation);
}

// Insertion des données :
move_uploaded_file($_FILES['Image']['tmp_name'], "../picture/" . $image);

$ajout = $BDD->prepare("INSERT INTO produits(ID, Nom, Description, Image, ID_categorie, Taille, Formations, ID_user)
                        VALUES (NULL, :nom, :description, :image, :id_categorie, :taille, :formations, :id_user)");
$ajout->bindParam(':nom', $nom);
$ajout->bindParam(':description', $description);
$ajout->bindParam(':image', $image);
$ajout->bindParam(':id_categorie', $id_categorie);
$ajout->bindParam(':taille', $taille);
$ajout->bindParam(':formations', $formations);
$ajout->bindParam(':id_user', $_SESSION['ID_Utilisateur']);
$ajout->execute();

header("Location:../utilisateur.php");

?>