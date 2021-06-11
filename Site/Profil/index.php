<?php require_once('FonctionProfil.php'); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Profil.css">
  </head>

  <body>
    <?php include('../Menu/Menu.php'); ?>
    <div id="contenu">
      <h1>Profil</h1>
      <div id="Statut">
      <?php
      if (!estConnecté()) {
        header("Location: ../index.php");
      }
      //Affiche les info de l'utilisateur
      $req="SELECT nom FROM regions WHERE id=\"".$_SESSION['region_id']."\";";
      $connexion=connexion();
      $resultat=mysqli_query($connexion,$req);
      $ligne=mysqli_fetch_assoc($resultat);
        echo "<p><span class=\"list\">Nom</span>:&nbsp;".$_SESSION['nom']."</p>";
        echo "<p><span class=\"list\">Prenom</span>:&nbsp;".$_SESSION['prenom']."</p>";
        echo "<p><span class=\"list\">Pseudo</span>:&nbsp;".$_SESSION['pseudo']."</p>";
        if (!empty($_SESSION['phone'])) {
          echo "<p><span class=\"list\">Téléphone</span>:&nbsp;".$_SESSION['phone']."</p>";
        }
        echo "<p><span class=\"list\">Email</span>:&nbsp;".$_SESSION['email']."</p>";
        echo "<p><span class=\"list\">Région</span>:&nbsp;".$ligne['nom']."</p>";
        if ($_SESSION['admin']==1) {
         echo "<a href=\"../Admin/index.php\">Page Administrateur -</a>";
       } ?>
       
       <a href="ModifProfil.php">Modifier le profil ➡️</a>
        </div>
       <hr>
       <form id="choix" action="#affperso" method="get">
         <label>Annonces</label>
         <input type="radio" name="affiche" value="annonce">
         <label>Evenements</label>
         <input type="radio" name="affiche" value="evenement">
         <br>
         <button type="submit">⬇️ Afficher ⬇️</button>
       </form>
       <hr>
       <div id="affperso">

       <?php if (isset($_GET['affiche'])) {
         if ($_GET['affiche']=="annonce") {
           afficheAnnnoncesPerso();
         }
         elseif ($_GET['affiche']=="evenement") {
           afficheEventPerso();
         }
       } else {
         echo "<p>Ici s'affichent vos annonces ou évènements, choisissez au dessus</p>";
       }
       ?>
       </div>
    </div>
  </body>
</html>
