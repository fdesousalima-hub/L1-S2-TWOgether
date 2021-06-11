<?php
session_start();
require_once('../FonctionGeneral.php');
require_once('../Annonces/FonctionAnnonces.php');
require_once('FonctionAdmin.php');

  if (!estConnecté()) {
    header("Location: ../index.php");
}else {
  if ($_SESSION['admin']==0) {
    header("Location: ../Profil/index.php");
  }else {

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
  </head>
  <body>

    <a href="../Profil/index.php">Revenir</a>
    <h1>Page Admin</h1>

    <form action="index.php" method="get">
      <label>Utilisateur</label>
      <input type="radio" name="affiche" value="utilisateur">
      <label>Annonces</label>
      <input type="radio" name="affiche" value="annonce">
      <label>Evenements</label>
      <input type="radio" name="affiche" value="evenement">
      <br>
      <button type="submit">Soumettre</button>
    </form>

    <hr>
<a href="#"></a>
    <?php if (isset($_GET['affiche'])) {   //On vérifie quel affichage est choisi
      if ($_GET['affiche']=="utilisateur") {   //pour afficher tout les utilisateurs

        echo "<form action=\"index.php\" method=\"get\">";
        echo "<input type=\"hidden\" name=\"affiche\" value=\"".$_GET['affiche']."\">";
        echo "<h2>Utilisateur</h2>";
        afficheUser();
        echo "<button type=\"submit\">Soumettre</button>";
        echo "</form><hr>";
      }

    if ($_GET['affiche']=="annonce") {    //pour afficher toute les annonces
      echo "<h2>Annnonces</h2>";
      afficheAnnonces();

    }elseif ($_GET['affiche']=="evenement"){ //pour afficher tout les évènements
      echo "<h2>Evenements</h2>";
      afficheEvent();
    }
    }

    if (isset($_GET['users'])) {   //On récupère l'utilisateur choisi
      echo "<a href=\"SupprimerCompte.php?id=".$_GET['users']."\">Supprimer ce compte</a>";
      afficheInfo($_GET['users']);      //pour afficher ses informations
      echo "<h2>Annnonces</h2>";
      afficheAnnoncesPersoUser($_GET['users']); //pour afficher ses annonces
      echo "<h2>Evenements</h2>";
      afficheEventPersoUser($_GET['users']);  //pour afficher ses evenements
    }
    ?>
  </body>
</html>
<?php   }
} ?>
