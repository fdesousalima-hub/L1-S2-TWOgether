<?php

function actuSession($id){    //Permet de mettre à jour une session
  $connexion=connexion();
  $req="SELECT * FROM users WHERE id=\"".$id."\";";
  $resultat=mysqli_query($connexion,$req);
  $ligne=mysqli_fetch_assoc($resultat);
    foreach ($ligne as $key => $value) {
      $_SESSION[$key]=$value;
    }
  }

function connexion(){   //Permet de ce connécter à la base de données
  $connexion = mysqli_connect("localhost","fabio","fabio","io2");
  if (!$connexion) {
      echo "Pas de connexion au serveur " ;
    }else{
    mysqli_set_charset($connexion, "utf8");
    return $connexion;
    }
  }

  function afficheRegion(){ //Permet d'afficher les régions
    $connexion=connexion();
    $req="SELECT * FROM regions;";
    $resultat=mysqli_query($connexion,$req);
    echo "<select name=\"region\">";
    while ($ligne = mysqli_fetch_assoc($resultat)) {
        echo "<option value=\"".$ligne['id']."\">".$ligne['nom']."</option>";
      }
    echo "</select>";
  }

  function afficheImage($id){   //Permet d'affiché une image
            $connexion=connexion();
            $req = "SELECT id, type, img_blob FROM images WHERE id = ".$id;
            $resultat = mysqli_query ($connexion, $req);
            $ligne = mysqli_fetch_row ($resultat);
              return "<img src=\"data:".$ligne['1'].";base64," . base64_encode($ligne['2']) ."\" alt=\"L'image ne peut être affichée\"/>";

  }

  function estConnecté(){     //Permet de vérifier si un utilisateur est connecté
    return (isset($_SESSION['id'])) ;
  }

  function importImg(){   //Permet d'importer une image dans la base de données
    $connexion = connexion();
    $resultat = false;
    $img_blob = '';
    $img_taille = 0;
    $img_type = '';
    $img_nom = '';
    $taille_max = 250000;
    $resultat = is_uploaded_file($_FILES['fic']['tmp_name']);
    if (!$resultat) {
      header("Location: ../index.php");
    } else {
        $img_taille = $_FILES['fic']['size'];
        if ($img_taille > $taille_max) {
          header("Location: ".$_SERVER['HTTP_REFERER']."?erreur=taille");
        }
        $img_type = $_FILES['fic']['type'];
        $img_nom = $_FILES['fic']['name'];
        $img_blob = file_get_contents ($_FILES['fic']['tmp_name']);
        $req = "INSERT INTO images ( nom, taille, type, img_blob  ) VALUES ( '" . $img_nom . "',  '" . $img_taille . "',  '" . $img_type . "',  '" . addslashes($img_blob) . "') ";
        $resultat = mysqli_query ($connexion,$req);
        $reqID="SELECT LAST_INSERT_ID()";
        $resultatID=mysqli_query($connexion,$reqID);
        $id=mysqli_fetch_assoc($resultatID);
        return $id['LAST_INSERT_ID()'];
    }
  }

  function Redirection(){ //Permet de recupérer la derniére page visité
    if (isset($_SERVER['HTTP_REFERER'])) {
      return $_SERVER['HTTP_REFERER'];
    }else{
      return "../index.php";
    }
  }
 ?>
