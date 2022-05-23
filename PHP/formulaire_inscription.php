<?php
session_start();

$serveur = "localhost";
$dbname = "note";
$user = "root";
$pass = "";
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(!empty ($_POST ['Nom']) && !empty ($_POST ['Prenom']) && !empty ($_POST['Sexe']) && !empty ($_POST ['Email'])  && !empty ($_POST ['Password']) && !empty ($_POST ['Role'])){
    function valid_donnees($donnees){
        $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        } 
    $Nom = utf8_decode (valid_donnees($_POST['Nom']));
    $Prenom = utf8_decode (valid_donnees($_POST['Prenom']));
    $CB = $_POST['Sexe'];
    $Email = valid_donnees($_POST['Email']);
    $Password = password_hash($_POST ['Password'], PASSWORD_DEFAULT);
    $Role = valid_donnees($_POST['Role']);

    $sth = $dbco->prepare("
    SELECT *
    FROM user
    WHERE Email='$Email'
    ");
    $sth->execute([$Email]);
    $users = $sth->fetchAll();
    if(count ($users)==0){


    // var_dump($Nom);
    // var_dump($Prenom);
    // var_dump($CB);
    // var_dump($Email);
    // var_dump($Password);
    // var_dump($Role);


    $sth = $dbco->prepare("
        INSERT INTO user(Nom, Prenom, Sexe, Email, Password, Role)
        VALUES(:nom, :prenom, :sexe, :email, :password, :role)");
    $sth->bindParam(':nom',$Nom);
    $sth->bindParam(':prenom',$Prenom);
    $sth->bindParam(':sexe',$CB);
    $sth->bindParam(':email',$Email);
    $sth->bindParam(':password',$Password);
    $sth->bindParam(':role',$Role);
    $sth->execute();

    $donnees_result = $dbco->prepare("
    SELECT *
    FROM user
    WHERE Email = '$Email'
    ");
    $donnees_result->bindParam('Email',$Email);
    $donnees_result-> execute();
    $result = $donnees_result->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['Email'] = $Email;
    $_SESSION['Role'] = $result[0]["Role"];
    $_SESSION['ID_Utilisateur'] = $result[0]["ID_Utilisateur"];
    $_SESSION['Sexe'] = $result[0]['Sexe'];
    header("location:../utilisateur.php");
    //On renvoie l'utilisateur vers la page de remerciement 

}else{
    setcookie('cookie_form', 1, time()+10);
    header("location:../PHP/inscription.php");
}
        }

   
    

?>