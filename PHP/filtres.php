<?php

// Récupération des données json :
$json = file_get_contents('php://input');
$filtres = json_decode($json);
$filtres = json_decode(json_encode($filtres), true);

// Connexion à la base de données :
try {
    $BDD = new PDO('mysql:host=localhost;dbname=note;charset=utf8', 'root', '');
}
catch (Exeption $e) {
    die ('Erreur : ' . $e->getMessage());
}

// Construction de la chaine de conditions :
$conditions = '';
$AND_necessaire = FALSE;
if (count($filtres) > 0) {
    $conditions .= ' WHERE ';
    if (array_key_exists('famille', $filtres)) {
        $conditions .= ($AND_necessaire) ? ' AND ' : '';
        $conditions .= "Categorie = '" . $filtres['famille'] . "'";
        $AND_necessaire = TRUE;
    }
    if (array_key_exists('taille', $filtres)) {
        $conditions .= ($AND_necessaire) ? ' AND ' : '';
        $conditions .= "Taille >= '" . ($filtres['taille'] - 1) . "' AND Taille <= '" . ($filtres['taille'] + 1) . "'";
        $AND_necessaire = TRUE;
    }
    if (array_key_exists('formation', $filtres)) {
        $conditions .= ($AND_necessaire) ? " AND " : "";
        $conditions .= "Formations LIKE '%" . $filtres['formation'] . "%'";
        $AND_necessaire = TRUE;
    }
}
$requete = "SELECT ID, Nom, Image
            FROM produits
            INNER JOIN categories ON produits.ID_Categorie = categories.ID_Categorie" . $conditions . "
            ORDER BY Nom";

// Requête SQL :
$donnees_produits = $BDD->prepare($requete);
$donnees_produits->execute();
$produits = $donnees_produits->fetchAll();

echo json_encode($produits);
?>