<?php
include "db.php"; // inclut la connexion a la base de 
$db = connexionBase();
$requete = $db->query("SELECT * FROM  disc inner join  artist on artist.artist_id=disc.artist_id ORDER BY disc_id");
$discs = $requete->fetchAll(PDO::FETCH_OBJ);
$requete->closeCursor();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <title> Liste Atelie</title>
</head>

<body>
   <div class="container">
      <h1>Liste des disques (<?= count($discs) ?> )</h1><br>
   
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
         <a class="btn btn-primary" href="disc_new.php" role="button">Ajouter</a>
      </div>
      <div class="row">
         <?php foreach ($discs as $disc) : // pour boucle sur la variable discs ?>
         <table class="col-6">
               <tr>
                  <td style="width: 300px;"><img src="img/jaquettes/<?= $disc->disc_picture ?>" class="img-responsive mw-100" style="width: 18rem;"></td>
                  <td>
                     <p><b><?= $disc->disc_title ?></b></p>
                     <p><b><?= $disc->artist_name ?></b></p>
                     <p><b>Label: </b><?= $disc->disc_label ?></p>
                     <p><b>Year: </b><?= $disc->disc_year ?></p>
                     <p><b>Genre: </b><?= $disc->disc_genre ?></p>
                     <a href="disc_detail.php?id=<?= $disc->disc_id ?>" class="btn btn-primary">Détail</a>
                  </td>
               </tr>
            </table>
            <?php endforeach; ?>
      </div>
   </div>
</body>

</html>