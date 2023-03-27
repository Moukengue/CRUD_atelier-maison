<?php 
// Récupération des valeurs :
$id = (isset($_POST['disc_id']) && $_POST['disc_id'] != "") ? $_POST['disc_id'] : Null;
$title = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
$artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
$year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
$genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
$label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
$price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
$disc_picture = (isset($_POST['picture']) && $_POST['picture'] != "") ? $_POST['picture'] : Null;

// En cas d'erreur, on renvoie vers le formulaire

if ($id == Null || $title == Null || $artist == Null || $year == Null || $genre == Null || $label == Null || $price == Null  ) {
   
    header("Location: disc_form.php?id=" . $id);
    exit;
}
// Si la vérification des données est ok :
require "db.php"; 
$db = connexionBase();

try {
    // Construction de la requête UPDATE sans injection SQL :
    $requete = $db->prepare("UPDATE disc SET disc_title = :disc_title, disc_year = :disc_year, disc_picture = :disc_picture, disc_label = :disc_label, disc_genre = :disc_genre, disc_price = :disc_price, artist_id = :artist_id  WHERE disc_id = :id;");
    $requete->bindValue(":id", $id, PDO::PARAM_INT);
    $requete->bindValue(":disc_title", $title, PDO::PARAM_STR);
    $requete->bindValue(":disc_year", $year, PDO::PARAM_STR);
    $requete->bindValue(":disc_picture", $disc_picture, PDO::PARAM_STR);
    $requete->bindValue(":disc_label", $label, PDO::PARAM_STR);
    $requete->bindValue(":disc_genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":disc_price", $price, PDO::PARAM_STR);
    $requete->bindValue(":artist_id", $artist, PDO::PARAM_STR);

    $requete->execute();
    $requete->closeCursor();
}

catch (Exception $e) {
    var_dump($_POST);
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_modif.php)");
}

// Si OK: redirection vers la page disc_detail.php
header("Location: disc_detail.php?id=" . $id);
exit;

?>