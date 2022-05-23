<?php

session_start();

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
if (count($filtres) > 0 || $_SESSION['Role'] != 'admin') {
    $conditions .= ' WHERE ';
    if ($_SESSION['Role'] != 'admin') {
        $conditions .= ($AND_necessaire) ? 'AND' : '';
        $conditions .= "ID_User = '" . $_SESSION['ID_Utilisateur'] . "'";
        $AND_necessaire = TRUE;
    }
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
$requete = "SELECT *
            FROM produits
            INNER JOIN categories ON produits.ID_Categorie = categories.ID_Categorie" . $conditions . "
            ORDER BY Nom";

// Requête SQL :
$donnees_instruments = $BDD->prepare($requete);
$donnees_instruments->execute();
$instruments = $donnees_instruments->fetchAll();

// Exécutione de la requête chargeant la liste des catégories :
$donnees_categories = $BDD->prepare("SELECT ID_Categorie, Titre
                                     FROM categories");
$donnees_categories->execute();
$categories = $donnees_categories->fetchAll();

// Exécution de la requête chargeant la liste des formations :
$donnees_formations = $BDD->prepare("SELECT Titre, Formation
                                     FROM formations");
$donnees_formations->execute();
$formations = $donnees_formations->fetchAll();

$a_afficher = "";
foreach ($instruments as $instrument) {
    $a_afficher .= "<article class=\"col-4 py-4 \">
                    <form  action=\"PHP/modifier_instrument.php\" method=\"post\" enctype=\"multipart/form-data\">
                        <h1 class=\"display-5 fw-bold mx-4\">" . $instrument['Nom'] . "</h1>
                        <input class=\"form-control rounded-4\" type=\"hidden\"
                               name=\"ID\"
                               value=\"" . $instrument['ID'] . "\">
                        <div class=\"form-floating mb-3 \">
                            <label  for=\"nom_instrument_" . $instrument['ID'] . "\">Nom: </label>
                            <input class=\"form-control rounded-4 \" id=\"nom_instrument_" . $instrument['ID'] . "\"
                                   type=\"text\"
                                   name=\"Nom\"
                                   value=\"" . $instrument['Nom'] . "\">
                        </div>
                        <div class=\"form-floating mb-3\">
                            <label for=\"description_instrument_" . $instrument['ID'] . "\">Description: </label>
                            <textarea class=\"form-control rounded-4\"id=\"description_instrument_" . $instrument['ID'] . "\"
                                      name=\"Description\">" . $instrument['Description'] . "</textarea>
                        </div>
                        <input type=\"hidden\"
                               name=\"Ancienne_Image\"
                               value=\"" . $instrument['Image'] . "\">
                        <div class=\"form-floating mb-3\">
                            <label for=\"image_instrument_" . $instrument['ID'] . "\">Image : </label>
                            <input class=\"form-control rounded-4\" id=\"image_instrument_" . $instrument['ID'] . "\"
                                   type=\"file\"
                                   name=\"Image\"
                                   accept=\".jpg, .jpeg\"
                                   value=\"picture/" . $instrument['Image'] . "\">
                        </div>
                        <div class=\"form-floating mb-3\">
                            <label for=\"categorie_instrument_" . $instrument['ID'] . "\">Catégorie : </label>
                            <select class=\"form-control rounded-4\" id=\"categorie_instrument_" . $instrument['ID'] . "\"
                                    name=\"Categorie\">";
                                
    foreach ($categories as $categorie) {
        $a_afficher .=             "<option value=\"" . $categorie['ID_Categorie'] . "\" ";
        $a_afficher .=             ($categorie['ID_Categorie'] == $instrument['ID_categorie']) ? 'selected' : '';
        $a_afficher .=             ">" . $categorie['Titre'] . "</option>";
    }                           
    $a_afficher .=         "</select>
                        </div>
                        <div class=\"form-floating mb-3\">
                            <label for=\"taille_instrument_" . $instrument['ID'] . "\">Taille : </label>
                            <input class=\"form-control rounded-4\" id=\"taille_instrument_" . $instrument['ID'] . "\"
                                   type=\"number\"
                                   name=\"Taille\"
                                   min=\"1\"
                                   max=\"5\"
                                   value=\"" . $instrument['Taille'] . "\">
                        </div>
                        <div class=\" mb-3\">
                            <label for=\"formations_instrument_" . $instrument['ID'] . "\">Formations : </label>
                            <select class=\"form-control rounded-6 h-auto\"id=\"formations_instrument_" . $instrument['ID'] . "\"
                                    name=\"Formations[]\"
                                    multiple
                                    size=\"6\">";

    foreach ($formations as $formation) {
        $a_afficher .=             "<option value=\"" . $formation['Formation'] . "\" ";
        $a_afficher .=             (strpos($instrument['Formations'], $formation['Formation']) !== false) ? 'selected' : '';
        $a_afficher .=             ">" . $formation['Titre'] . "</option>";
    }
    $a_afficher .=         "</select>
                        </div>
                        <div class=\"form-floating\">
                            <button class=\"btn btn-success col-5 mx-auto\" type=\"submit\">Modifier</button>
                            <button class=\"btn btn-danger col-5 mx-auto\" type=\"submit\" formaction=\"PHP/supprimer_instrument.php\">Supprimer</button>
                        </div>
                    </form>
                </article>";
}
    echo json_encode($a_afficher);
?>