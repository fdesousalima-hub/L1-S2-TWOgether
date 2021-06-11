<?php
//Page qui permet de supprimer une annonces
require_once('../FonctionGeneral.php');

  if (isset($_GET['id'])) {
    $connexion=connexion();
    $req="DELETE FROM annonces WHERE id=".$_GET['id'];
    $resultat=mysqli_query($connexion,$req);
    
    header("Location: ".$_SERVER['HTTP_REFERER']);
  }else {
    header("Location: ../index.php");
  }

 ?>
