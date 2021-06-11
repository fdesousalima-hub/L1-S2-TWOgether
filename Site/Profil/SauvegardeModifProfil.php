<?php
//Page qui met à jour le profil
session_start();
require_once('../FonctionGeneral.php');
$connexion=connexion();
if (estConnecté()) {
if (!empty($_POST)) {
  $req="UPDATE users SET ";
  if ($_POST['nom']!=$_SESSION['nom']) {
    $req=$req."nom='".$_POST['nom']."' ";
  }
  if ($_POST['prenom']!=$_SESSION['prenom']) {
    $req=$req."prenom='".$_POST['prenom']."' ";
  }
  if ($_POST['phone']!=$_SESSION['phone']) {
    $req=$req."phone='".$_POST['phone']."' ";
  }
  if ($_POST['email']!=$_SESSION['email']) {
    $req=$req."email='".$_POST['email']."' ";
  }
  if ($_POST['pseudo']!=$_SESSION['pseudo']) {
    $req=$req."pseudo='".$_POST['pseudo']."' ";
  }
  if ($_POST['region']!=$_SESSION['region_id']) {
    $req=$req."region_id='".$_POST['region']."' ";
  }
  $req=$req."WHERE id=".$_SESSION['id'].";";
  $resultat=mysqli_query($connexion, $req);
  if ($resultat) {
    actuSession($_SESSION['id']);
    header("Location: ModifProfil.php?etat=succes");
  }else{
    header("Location: ModifProfil.php?etat=fail");
  }
}else{
  header("Location: ModifProfil.php");
}
}else{
  header("Location: ../index.php");
}
 ?>
