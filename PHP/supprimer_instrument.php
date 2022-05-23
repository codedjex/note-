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

// Vérification des données :
function verification($donnees) {
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

$id = verification($_POST['ID']);
$ancienne_image = verification($_POST['Ancienne_Image']);

// Suppression des données :
@unlink("../picture/" . $ancienne_image);

$suppression = $BDD->prepare("DELETE FROM produits
                              WHERE ID = '" . $id . "'");
$suppression->execute();

header("Location:../utilisateur.php");

?>