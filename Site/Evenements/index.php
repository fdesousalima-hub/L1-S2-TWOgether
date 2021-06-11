<?php require_once('FonctionEvenements.php');
require_once('../FonctionGeneral.php');
$connexion=connexion();
//Permet de supprimer les évènements passé
$reqSupp="DELETE FROM `evenements` WHERE dateFinal <\"".date("Y-m-d")."\"";
$resultat=mysqli_query($connexion,$reqSupp);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Evenements.css">
  </head>
  <body>
    <?php include('../Menu/Menu.php');?>
    <div id="contenu">
      <h1>Evenement</h1>
      <?php if (isset($_GET['creation'])) {
        if ($_GET['creation']=="ok") {
          echo "<h3>Création réussie et envoyée à l'administrateur</h3>";
      }} ?>
      <div class="top">
    <form class="Event" action="index.php" method="get">
      <button type="submit" name="region" value="<?php echo $_SESSION['region_id'] ?>">Les évènements près de chez moi 🔍</button><br><br>
    </form>
    <a href="CreerEvenements.php">Créer un évènement ➡️</a>
    </div>
    <hr>
    <div class="events">
    <?php
    afficheEvent();
     ?>
   </div>
  </div>
  </body>
</html>
