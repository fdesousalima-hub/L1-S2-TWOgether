<?php
//Page qui permet de supprimer tout ce qui est liés a un utilisateur
require_once('../FonctionGeneral.php');
  if (isset($_GET['id'])) {
    $connexion=connexion();
    $reqAnnonce="DELETE FROM annonces WHERE users_id=".$_GET['id'];
    $resultatAnnonce=mysqli_query($connexion,$reqAnnonce);

    $reqEvent="DELETE FROM evenements WHERE user_id=".$_GET['id'];
    $resultatEvent=mysqli_query($connexion,$reqEvent);

    $req="DELETE FROM users WHERE id=".$_GET['id'];
    $resultat=mysqli_query($connexion,$req);

    header("Location: index.php?affiche=utilisateur");

  }else {
    header("Location: ../index.php");
  }

 ?>
