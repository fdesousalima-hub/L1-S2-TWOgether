<?php
//Cette page permet de validé un événement
require_once('../FonctionGeneral.php');
$connexion=connexion();

if (isset($_GET['valide']) && isset($_GET['id'])) {
  if ($_GET['valide']==1) {

    $req="UPDATE evenements SET validé=1 WHERE id=".$_GET['id'];
    $resultat=mysqli_query($connexion,$req);

    header("Location: ".$_SERVER['HTTP_REFERER']);

  }elseif($_GET['valide']==2) {

    $req="UPDATE evenements SET validé=2 WHERE id=".$_GET['id'];
    $resultat=mysqli_query($connexion,$req);
    
    header("Location: ".$_SERVER['HTTP_REFERER']);
  }
}else{
  header("Location: index.php");
} ?>
