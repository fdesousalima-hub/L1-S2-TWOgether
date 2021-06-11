<?php
function afficheUser(){             //Permet de faire une liste déroulante
  $connexion=connexion();           //de tout les utilisateurs non administrateur
  $req="SELECT * FROM users WHERE admin=0;";
  $resultat=mysqli_query($connexion,$req);

  echo "<select name=\"users\">";
  while ($ligne = mysqli_fetch_assoc($resultat)) {
      echo "<option value=\"".$ligne['id']."\">".$ligne['pseudo']."</option>";
    }
  echo "</select>";
}

function afficheInfo($UserId){  //Permet d'afficher les informations
  $connexion=connexion();       //d'un utilisateur
  $req="SELECT * FROM users WHERE id=".$UserId;
  $resultat=mysqli_query($connexion,$req);
  $ligne=mysqli_fetch_assoc($resultat);

  $reqRegion="SELECT * FROM regions WHERE id=".$ligne['region_id'];
  $resultatRegion=mysqli_query($connexion,$reqRegion);
  $Region=mysqli_fetch_assoc($resultatRegion);

  echo "<h3>Info de l'utilisateur</h3>
        <p>Nom: ".$ligne['nom']."<br>
           Prenom: ".$ligne['prenom']."<br>
           Pseudo: ".$ligne['pseudo']."<br>
           Email: ".$ligne['email']."<br>
           Region: ".$Region['nom']."<br>
        </p><hr>";
}

function listeTabAnnonceUser($UserId){  //Permet de récupèrer toute les annonces
  $connexion=connexion();               //d'un utilisateur
  $req = "SELECT * FROM annonces WHERE users_id=\"".$UserId."\" ORDER BY dateEtHeure DESC";
  $resultat = mysqli_query ($connexion,$req);

  $tab = array();
     while ( $ligne = mysqli_fetch_assoc ($resultat) ){
         array_push($tab,$ligne);
     }

   return $tab;
}

function afficheAnnoncesPersoUser($UserId){ //Permet d'afficher les annonces
  $connexion=connexion();                   //d'un utilisateur
  $tab=listeTabAnnonceUser($UserId);

  if (empty($tab)) {
    echo "<h1> Il n'a pas d'annonce </h1><hr>";
  }

  foreach ($tab as $key => $value) {

    $reqUser="SELECT * FROM users WHERE id=\"".$tab[$key]['users_id']."\";";
    $resultatUser=mysqli_query($connexion,$reqUser);
    $user=mysqli_fetch_assoc($resultatUser);

    $reqRegion="SELECT nom FROM regions WHERE id=\"".$tab[$key]['region_id']."\";";
    $resultatRegion=mysqli_query($connexion,$reqRegion);
    $region=mysqli_fetch_assoc($resultatRegion);

    echo "<article class=\"articles\">
            <h3>".$tab[$key]['nom_objet']."</h3>
            ".afficheImage($tab[$key]['image_id'])."
            <div class=\"texte\"><p>
            Région: ".$region['nom']."<br>
            Utilisateur: ".$user['pseudo']."<br>
            Description: ".$tab[$key]['description']."<br>
            <br>Pour le contacter:<br><br> Email: ".$user['email'];
            if (!empty($user['phone'])) {
              echo "<br>Ou Téléphone: ".$user['phone'];
            }
    echo   "</p><pre class=\"date\">".date($tab[$key]['dateEtHeure'])."</pre>
            <a href=\"../Annonces/SupprimerAnnonce.php?id=".$tab[$key]['id']."\" color=\"red\"> Supprimer cette annonce</a>
            </div>
          </article><hr>";
  }
}

function listeTabEventUser($UserId){  //Permet de récupèrer tout les évènements
  $connexion=connexion();             //d'un utilisateur
  $req = "SELECT * FROM evenements WHERE user_id=\"".$UserId."\" ORDER BY dateFinal";
  $resultat = mysqli_query ($connexion,$req);
  $tab = array();
     while ($ligne = mysqli_fetch_assoc ($resultat) ){
         array_push($tab,$ligne);
     }

   return $tab;
}

function afficheEventPersoUser($UserId){  //Permet d'afficher les évènements
  $connexion=connexion();                 //d'un utilisateur
  $tab=listeTabEventUser($UserId);        //et de les valider

  if (empty($tab)) {
    echo "<h1> Il n'a pas d'évènement </h1><hr>";
  }

  foreach ($tab as $key => $value) {
    $reqUser="SELECT * FROM users WHERE id=\"".$tab[$key]['user_id']."\";";
    $resultatUser=mysqli_query($connexion,$reqUser);
    $user=mysqli_fetch_assoc($resultatUser);

    $reqRegion="SELECT nom FROM regions WHERE id=\"".$tab[$key]['region_id']."\";";
    $resultatRegion=mysqli_query($connexion,$reqRegion);
    $region=mysqli_fetch_assoc($resultatRegion);

    if ($tab[$key]['validé']==0) {
      echo "<h2>Validation en cours</h2>";
      echo "<a href=\"ValidéEvent.php?valide=1&id=".$tab[$key]['id']."\">Valide</a><br>";
      echo "<a href=\"ValidéEvent.php?valide=2&id=".$tab[$key]['id']."\">Non Valide</a>";
    }

    if ($tab[$key]['validé']==1) {
      echo "<h2>Validé</h2>";
      echo "<a href=\"ValidéEvent.php?valide=2&id=".$tab[$key]['id']."\">Le rendre non valide</a>";
    }

    if ($tab[$key]['validé']==2) {
      echo "<h2>Non Validé</h2>";
      echo "<a href=\"ValidéEvent.php?valide=1&id=".$tab[$key]['id']."\">Le rendre valide</a>";
    }

    echo "<article class=\"articles\">
            <h3>".$tab[$key]['nom']."</h3>
            ".afficheImage($tab[$key]['image_id'])."
            <div class=\"texte\"><p>
            Région: ".$region['nom']."<br>
            Utilisateur: ".$user['pseudo']."<br>
            Description: ".$tab[$key]['description']."<br>
            <br>Pour le contacter:<br><br> Email: ".$user['email'];
            if (!empty($user['phone'])) {
              echo "<br>Ou Téléphone: ".$user['phone'];
            }
    echo   "</p><pre class=\"date\">".date($tab[$key]['dateFinal'])."</pre>
            </div>
          </article><hr>";
  }
}
function listeTabEvent(){     //Permet de récupèrer tout les évènements
  $connexion=connexion();
  $req = "SELECT * FROM evenements ORDER BY dateFinal";
  $resultat = mysqli_query ($connexion,$req);

  $tab = array();
      while ( $ligne = mysqli_fetch_assoc ($resultat) ){
         array_push($tab,$ligne);
     }

   return $tab;
}

function afficheEvent(){  //Permet d'afficher tout les évènements
  $connexion=connexion();
  $tab=listeTabEvent();

  if (empty($tab)) {
    echo "<h1> Il n'a pas d'évènement </h1><hr>";
  }

  foreach ($tab as $key => $value) {
    $reqUser="SELECT * FROM users WHERE id=\"".$tab[$key]['user_id']."\";";
    $resultatUser=mysqli_query($connexion,$reqUser);
    $user=mysqli_fetch_assoc($resultatUser);

    $reqRegion="SELECT nom FROM regions WHERE id=\"".$tab[$key]['region_id']."\";";
    $resultatRegion=mysqli_query($connexion,$reqRegion);
    $region=mysqli_fetch_assoc($resultatRegion);

    if ($tab[$key]['validé']==0) {
      echo "<h2>Validation en cours</h2>";
      echo "<a href=\"ValidéEvent.php?valide=1&id=".$tab[$key]['id']."\">Valide</a><br>";
      echo "<a href=\"ValidéEvent.php?valide=2&id=".$tab[$key]['id']."\">Non Valide</a>";
    }

    if ($tab[$key]['validé']==1) {
      echo "<h2>Validé</h2>";
      echo "<a href=\"ValidéEvent.php?valide=2&id=".$tab[$key]['id']."\">Le rendre non valide</a>";
    }

    if ($tab[$key]['validé']==2) {
      echo "<h2>Non Validé</h2>";
      echo "<a href=\"ValidéEvent.php?valide=1&id=".$tab[$key]['id']."\">Le rendre valide</a>";
    }

    echo "<article class=\"articles\">
            <h3>".$tab[$key]['nom']."</h3>
            ".afficheImage($tab[$key]['image_id'])."
            <div class=\"texte\"><p>
            Région: ".$region['nom']."<br>
            Utilisateur: ".$user['pseudo']."<br>
            Description: ".$tab[$key]['description']."<br>
            <br>Pour le contacter:<br><br> Email: ".$user['email'];
            if (!empty($user['phone'])) {
              echo "<br>Ou Téléphone: ".$user['phone'];
            }
    echo   "</p><pre class=\"date\">".date($tab[$key]['dateFinal'])."</pre>
            </div>
          </article><hr>";
  }
}
 ?>
