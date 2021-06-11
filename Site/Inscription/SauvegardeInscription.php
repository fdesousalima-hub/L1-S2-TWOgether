<?php
//Page qui inscrit un utilisateur
require_once('../FonctionGeneral.php');
$connexion=connexion();
if (isset($_POST['nom']) && isset($_POST['prenom']) &&
    isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['region'])) {
      $reqPseudo="SELECT * FROM users where pseudo=\"".$_POST['pseudo']."\";";
      $reqMail="SELECT * FROM users WHERE email=\"".$_POST['email']."\";";

      $resultatPseudo = mysqli_query($connexion, $reqPseudo);
      $resultatMail = mysqli_query($connexion, $reqMail);

      if (mysqli_num_rows($resultatPseudo) == 0) {
        if (mysqli_num_rows($resultatMail) == 0) {
          $mdp=password_hash($_POST['password'],PASSWORD_DEFAULT);
          $req="INSERT INTO users(nom,prenom,pseudo,email,phone,region_id,password) VALUES
          (\"".$_POST['nom']."\",\"".$_POST['prenom']."\",\"".$_POST['pseudo']."\",\"".$_POST['email']."\",\"".$_POST['phone']."\",\"".$_POST['region']."\",\"".$mdp."\")";
          $resultat = mysqli_query($connexion, $req );
          include_once('../Connexion/SauvegardeConnexion.php');
        }else{
          header("Location: index.php?erreur=email");
        }
      }else{
        header("Location: index.php?erreur=pseudo");
      }
    }
    else{
      header("Location: index.php");
    }
 ?>
