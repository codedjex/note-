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

$id = verification($_POST['ID']);
$nom = verification($_POST['Nom']);
$description = verification($_POST['Description']);
$ancienne_image = verification($_POST['Ancienne_Image']);
if ($_FILES['Image']['name'] != "") {
    $image = $categorie . "/" . $_FILES['Image']['name'];
} else {
    $image = $categorie . "/" . explode('/', $ancienne_image)[1];
}
$id_categorie = verification($_POST['Categorie']);
$taille = verification($_POST['Taille']);
$formations = "";
print_r($_FILES);
foreach ($_POST['Formations'] as $formation) {
    if (strlen($formations) > 0) {
        $formations .= ';';
    }
    $formations .= verification($formation);
}
$id_user = $_SESSION['ID_Utilisateur'];

// Insertion des données :
$nouvel_emplacement_image = $categorie . '/' . explode('/', $ancienne_image)[1];
rename('../picture/' . $ancienne_image, '../picture/' . $nouvel_emplacement_image);
$ancienne_image = $nouvel_emplacement_image;

if ($_FILES['Image']['name'] != "") {
    move_uploaded_file($_FILES['Image']['tmp_name'], "../picture/" . $image);
}
if ($ancienne_image != $image) {
    @unlink("../picture/" . $ancienne_image);
}
$modification = $BDD->prepare("UPDATE produits
                        SET Nom = :nom, Description = :description, Image = :image, ID_categorie = :id_categorie, Taille = :taille, Formations = :formations, ID_user = :id_user
                        WHERE ID = '$id'");
$modification->bindParam(':nom', $nom);
$modification->bindParam(':description', $description);
$modification->bindParam(':image', $image);
$modification->bindParam(':id_categorie', $id_categorie);
$modification->bindParam(':taille', $taille);
$modification->bindParam(':formations', $formations);
$modification->bindParam(':id_user', $_SESSION['ID_Utilisateur']);
$modification->execute();

header("Location:../utilisateur.php");

?>