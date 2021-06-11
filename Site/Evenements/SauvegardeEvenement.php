<?php
//Page pour crée l'évenement dans la base de données
  session_start();
  require_once('../FonctionGeneral.php');
  $connexion=connexion();
  if(isset($_POST['nom']) && isset($_POST['date']) && isset($_FILES['fic']) && isset($_POST['description']) && isset($_POST['region'])){

    $img_id=importImg();
    $req="INSERT INTO evenements(nom, dateFinal ,description ,image_id ,user_id ,region_id) VALUES
    (\"".$_POST['nom']."\",\"".$_POST['date']."\",\"".$_POST['description']."\",\"".$img_id."\",\"".$_SESSION['id']."\",\"".$_POST['region']."\")";
    $resultat = mysqli_query($connexion, $req );

    $url=$_SESSION['lien'];
     unset($_SESSION['lien']);
     
    header("Location: ".$url."?creation=ok");
  }else{
    header("Location: CreerEvenements.php");
  }

?>
