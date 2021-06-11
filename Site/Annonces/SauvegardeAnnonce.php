<?php
//Page pour crée l'annonce dans la base de données
session_start();
require_once('../FonctionGeneral.php');
$connexion=connexion();

if(isset($_POST['nom_objet']) && isset($_POST['date/heure']) && isset($_FILES['fic']) && isset($_POST['description']) && isset($_POST['region'])){
  $img_id=importImg();
  $req="INSERT INTO annonces(nom_objet, dateEtHeure ,description ,image_id ,users_id ,region_id) VALUES
  (\"".$_POST['nom_objet']."\",\"".$_POST['date/heure']."\",\"".$_POST['description']."\",\"".$img_id."\",\"".$_SESSION['id']."\",\"".$_POST['region']."\")";
  $resultat = mysqli_query($connexion, $req );

  $url=$_SESSION['lien'];
   unset($_SESSION['lien']);

   $find    = '=';
   $pos = stripos($url, $find);

   if ($pos === false) {
     header("Location: ".$url."?creation=ok");
   }else{
     header("Location: ".$url."&?creation=ok");
   }

}else{
  header("Location: CreerAnnonce.php");
}

?>
