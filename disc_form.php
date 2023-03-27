<?php
// On charge l'enregistrement correspondant à l'ID passé en paramètre :
require "db.php";
$db = connexionBase();
$requete = $db->prepare("SELECT * FROM  disc inner join  artist on artist.artist_id =  disc.artist_id where disc_id=?");
$requete->execute(array($_GET["id"]));
$disc = $requete->fetch(PDO::FETCH_OBJ);
$requete->closeCursor();
$requete = $db->query("SELECT * FROM artist");
$artists = $requete->fetchAll(PDO::FETCH_OBJ);
$requete->closeCursor();
?>








<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title> Le formulaire de modification</title>
</head>

<body>
  <div class="container">
    <h1>Modifier un vinyle</h1>
    <form class="row g-3" action="script_disc_modif.php" method="post" enctype="multipart/form-data">
    <input type="text" class="form-control" name="disc_id" id="title" value="<?= $disc->disc_id ?>" hidden>
      <div class="col-12">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $disc->disc_title ?>">
      </div>
      <div class="col-12">
        <label for="year">Year</label>
        <input type="text" class="form-control" name="year" id="year"value="<?= $disc->disc_year ?>">
      </div>
      <div class="col-12">
        <label for="label">Label</label>
        <input type="text" class="form-control" name="label" id="label" value="<?= $disc->disc_label ?>">
      </div>

      <div class="col-12">
                <label for="artist">Artist</label>
                <select class="form-select" aria-label="artist" name="artist" id="artist">
                    <option value="<?= $disc->artist_id ?>" disabled selected><?= $disc->artist_name ?></option>
                    <?php foreach ($artists as $artist) : ?>
                        <option value="<?= $artist->artist_id ?>"> <?= $artist->artist_name ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
      <div class="col-12">
        <label for="genre">Genre</label>
        <input type="text" class="form-control" name="genre" id="genre" value="<?= $disc->disc_genre ?>">
      </div>
      <div class="col-12">
        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="price" value="<?= $disc->disc_price ?>">
      </div>
      <div class="mb-3">
        <label for="picture" class="form-label">Picture</label>
        <input class="form-control" type="file" id="picture" value="<?= $disc->disc_picture ?>">
      </div>
      <div class="mb-3 col-2">
                <img src="img/jaquettes/<?= $disc->disc_picture ?>" class="img-responsive" style="width: 18rem;">
            </div>
            <div class="d-grid gap-2 d-md-block">
      <button class="btn btn-primary"  type="submit">Modifier</button>
      <a href="disc_detail.php?id=<?= $disc->disc_id ?>" class="btn btn-primary">Retour</a>
       </div>
  </div>
  </form>
</body>

</html>