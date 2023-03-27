<?php
// On charge l'enregistrement correspondant à l'ID passé en paramètre :
require "db.php";
$db = connexionBase();
$requete = $db->query("SELECT * FROM artist");
$artists = $requete->fetchAll(PDO::FETCH_OBJ);
$requete->closeCursor();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Le formulaire d'ajout</title>
</head>

<body>
    <div class="container">
        <h1>Ajouter un Vinyle</h1>
        <form class="row g-3" action="script_disc_ajout.php" method="post" enctype="multipart/form-data">
            <div class="col-12">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
            </div>
            <div class="col-12">
                <label for="artist">Artist</label>
                <select class="form-select" aria-label="artist" name="artist" id="artist">
                    <option value="" disabled selected>Veuillez sélectionner l'artiste</option>
                    <?php foreach ($artists as $artist) : ?>
                        <option value="<?= $artist->artist_id ?>"> <?= $artist->artist_name ?></option>
                        <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12">
                <label for="year">Year</label>
                <input type="text" class="form-control" placeholder="Enter year" name="year" id="year">
            </div>
            <div class="col-12">
                <label for="genre">Genre </label>
                <input type="text" class="form-control" placeholder="Enter genre" name="genre" id="genre">
            </div>
            <div class="col-12">
                <label for="label">Label </label>
                <input type="text" class="form-control" placeholder="Enter genre" name="label" id="label">
            </div>
            <div class="col-12">
                <label for="price">Price</label>
                <input type="text" class="form-control" placeholder="Enter price" name="price" id="price">
            </div>
            <div>
                <label for="picture">Picture</label>
                <input type="file" class="form-control" placeholder="Aucun fichier choisi" name="picture" id="picture">
            </div>
            <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-primary"  type="submit">Ajouter</button>
            <a href="disc.php" class="btn btn-primary" >Retour</a>
             </div>
        </form>

    </div>
</body>

</html>