<?php require_once('FonctionAnnonces.php'); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
    <link rel="stylesheet" href="../CSS/Menu.css" >
    <link rel="stylesheet" href="../CSS/Annonces.css">
    <link rel="stylesheet" href="../CSS/Map.css">
  </head>
  <body>
    <?php include('../Menu/Menu.php'); ?>
    <div id="contenu">
      <h1>Annonces</h1>
      <?php  //Vérification de la création
      if (isset($_GET['creation'])) {
        if ($_GET['creation']=="ok") {
          echo "<h1>Creation reussit</h1>";
        }
      } ?>
      <div class="top">
    <a href="CreerAnnonce.php"><p>Créer mon annonce ➡️</p></a>
    </div>
    <hr>
    <?php
    if(isset($_GET['region'])){
      afficheAnnonces();
    }else {
      include_once('MAPAnnonces.php');
    }
    ?>
  </div>
  </body>
</html>
