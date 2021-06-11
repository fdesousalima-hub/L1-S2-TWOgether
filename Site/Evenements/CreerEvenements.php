<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
    <link rel="stylesheet" href="../CSS/Menu.css" >
    <link rel="stylesheet" href="../CSS/Evenements.css">
  </head>
  <body>
    <?php include('../Menu/Menu.php');
    //Redirection
    $url="http://localhost".$_SERVER['REQUEST_URI'];
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=$url && ( !isset($_SESSION['lien']) || $_SESSION['lien']!=$url)) {
      $_SESSION['lien']=Redirection();
    }else {
      $_SESSION['lien']=$url;
    }?>
    <div id="contenu">
      <h1>Créer votre évenement</h1>
      <form id="formule" action="SauvegardeEvenement.php" enctype="multipart/form-data" method="post">
      <div class="partie">
        <label for="Nom">Son nom</label>
        <input type="text" name="nom" required>
      </div>
      <div class="partie">
        <label for="Nom">Date de l'evenement</label>
        <input type="date" name="date" value="<?php  echo date("Y-m-d"); ?>" >
      </div>
      <div class="partie">
        <label for="image">Images<br><span>nous vous recommandons une image de 280x350<span></label>
        <input type="file" name="fic" accept="image/*" required>
      </div>
      <div class="partie">
        <label for="description">Description</label><br>
        <textarea name="description" rows="5" cols="50" maxlength="1000"
        placeholder="1000 charactères max.
Les administrateurs vérifieront votre publication avant qu'elle soit visible." required></textarea>
      </div>
      <div class="partie">
        <label id="region" for="region">Région:</label>
          <?php
          if (!estConnecté()) {
            header("Location: ../Connexion/index.php?erreur=nonCo");
          }
          //Permet d'afficher les régions
          $connexion=connexion();
          $req="SELECT * FROM regions;";
          $resultat=mysqli_query($connexion,$req);

          $reqSESSION="SELECT * FROM regions WHERE id=\"".$_SESSION['region_id']."\";";
          $resultatSESSION=mysqli_query($connexion,$reqSESSION);
          $ligneSESSION= mysqli_fetch_assoc($resultatSESSION);

          echo "<select name=\"region\" required>";
          while ($ligne = mysqli_fetch_assoc($resultat)) {
            if ($ligneSESSION['id']!=$ligne['id']) {
              echo "<option value=\"".$ligne['id']."\">".$ligne['nom']."</option>";
            }else {
              echo "<option value=\"".$ligne['id']."\" selected>".$ligne['nom']."</option>";
            }
            }
          echo "</select>";
          ?>
      </div>
      <button type="submit" name="button">Créer</button>
      <a href="index.php"><button type="button" name="button">Retour</button></a>
      </form>
    </div>
  </body>
</html>
