<?php // On se connecte à la BDD via notre fichier db.php :
require "db.php";
$db = connexionBase();

// On récupère l'ID passé en paramètre :
$id = $_GET["id"];

// On crée une requête préparée avec condition de recherche :
$requete = $db->prepare("SELECT * FROM  disc inner join  artist on artist.artist_id =  disc.artist_id where disc_id=?");
// on ajoute l'ID du disque passé dans l'URL en paramètre et on exécute :
$requete->execute(array($id));

// on récupère le 1e (et seul) résultat :
$disc = $requete->fetch(PDO::FETCH_OBJ);

// on clôt la requête en BDD
$requete->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title> La page de détail</title>
</head>

<body>


    <div class="container">
        <h1> Détails </h1><br>
        <form class="row g-3" >
            <div class="col-6">
                <label for=" title">Title </label>
                <input type="text" class="form-control" name="title" id="title" value="<?= $disc->disc_title ?>" readonly>
            </div>
            <div class="col-6">
                <label for=" year">Year </label>
                <input type="text" class="form-control" name="year" id="year" value="<?= $disc->disc_year ?>" readonly>
            </div>
            <div class="col-6">
                <label for="label">Label </label>
                <input type="text" class="form-control" name="label" id="label" value="<?= $disc->disc_label ?>" readonly>
            </div>
            <div class="col-6">
                <label for="artist">Artist </label>
                <input type="text" class="form-control" name="artist" id="artist" value="<?= $disc->artist_name ?>" readonly>
            </div>
            <div class="col-6">
                <label for="genre">Genre </label>
                <input type="text" class="form-control" name="Genre" id="genre" value="<?= $disc->disc_genre ?>" readonly>
            </div>
            <div class="col-6">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" value="<?= $disc->disc_price ?>" readonly>
            </div>

            <div class="mb-3 col-2">
            <label for="picture" class="form-label">Picture</label>
                <img src="img/jaquettes/<?= $disc->disc_picture ?>" class="img-responsive" style="width: 18rem;">
            </div>
            <div class="d-grid gap-2 d-md-block">
                <a href="disc_form.php?id=<?= $disc->disc_id ?>" class="btn btn-primary">Modifier</a>
                <a href="script_disc_delete.php?id=<?= $disc->disc_id ?>" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce disque?');">Supprimer</a>
                <a href="disc.php" class="btn btn-primary" >Retour</a>

            </div>
        </form>
    </div>
</body>

</html>