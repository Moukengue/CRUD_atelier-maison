<?php
//instruction exécute du code si une condition est vraie et un autre code si cette condition est fausse.
    // Récupération du titre :
    if (isset($_POST['title']) && $_POST['title'] != "") {
        $title = $_POST['title'];
    }
    else {
        $title = Null;
    }
 // Récupération artist :
 if (isset($_POST['artist']) && $_POST['artist'] != "") {
    $artist = $_POST['artist'];
}
else {
    $artist = Null;
}

 // Récupération d'année:
 if (isset($_POST['year']) && $_POST['year'] != "") {
    $year = $_POST['year'];
}
else {
    $year = Null;
}
  // Récupération du genre :
  if (isset($_POST['genre']) && $_POST['genre'] != "") {
    $genre = $_POST['genre'];
}
else {
    $genre = Null;
}
 // Récupération du label:
 if (isset($_POST['label']) && $_POST['label'] != "") {
    $label = $_POST['label'];
}
else {
    $label = Null;
}

 // Récupération du price :
 if (isset($_POST['price']) && $_POST['price'] != "") {
    $price = $_POST['price'];
}
else {
    $price = Null;  
}
// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
    
//  }

 // En cas d'erreur, on renvoie vers le formulaire
 if ($title == Null || $artist == Null || $year == Null || $genre == Null || $label == Null  ) {
    header("Location: disc_new.php");
    exit;
}

    // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    include "db.php"; 
    $db = connexionBase();
    // A supprimer apres la gestion d'image
    $disc_picture = "Nom provisoire.png";

try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("INSERT INTO disc (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) VALUES (:disc_title, :disc_year, :disc_picture, :disc_label, :disc_genre, :disc_price, :artist_id);");
    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(':disc_title', $title, PDO::PARAM_STR);
    $requete->bindValue(':disc_year', $year, PDO::PARAM_STR);
    $requete->bindValue(':disc_picture', $disc_picture, PDO::PARAM_STR);
    $requete->bindValue(':disc_label', $label, PDO::PARAM_STR);
    $requete->bindValue(':disc_genre', $genre, PDO::PARAM_STR);
    $requete->bindValue(':disc_price', $price, PDO::PARAM_STR);
    $requete->bindValue(':artist_id',$artist , PDO::PARAM_STR);
    
    // Lancement de la requête :
    
   $requete->execute();
    // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
    $requete->closeCursor();
}

// Gestion des erreurs
catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_ajout.php)");
}

// Si OK: redirection vers la page artists.php
header("Location: disc.php");

// Fermeture du script
exit;
?>