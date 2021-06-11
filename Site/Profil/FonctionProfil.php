<?php
function listeTabAnnonce(){   //Permet de récupèrer toute les annonces
  $connexion=connexion();     //de l'utilisateur connecté
  $req = "SELECT * FROM annonces WHERE users_id=\"".$_SESSION["id"]."\" ORDER BY dateEtHeure DESC";
  $resultat = mysqli_query ($connexion,$req);
  $tab = array();
     while ( $ligne = mysqli_fetch_assoc ($resultat) ){
         array_push($tab,$ligne);
     }
   return $tab;
}
function afficheAnnnoncesPerso(){  //Permet d'afficher les annonces
  $connexion=connexion();
  $tab=listeTabAnnonce();
  if (empty($tab)) {
    echo "<h1> Vous n'avez pas créé d'annonce :/ </h1>
          <a href=\"../Annonces/CreerAnnonce.php\">Cliquez ici pour créer votre première !</a>";
  }
  foreach ($tab as $key => $value) {
    $reqUser="SELECT * FROM users WHERE id=\"".$tab[$key]['users_id']."\";";
    $resultatUser=mysqli_query($connexion,$reqUser);
    $user=mysqli_fetch_assoc($resultatUser);
    $reqRegion="SELECT nom FROM regions WHERE id=\"".$tab[$key]['region_id']."\";";
    $resultatRegion=mysqli_query($connexion,$reqRegion);
    $region=mysqli_fetch_assoc($resultatRegion);

    echo "<article class=\"article\">
            <h3 id=\"nom\">".$tab[$key]['nom_objet']."</h3>
            ".afficheImage($tab[$key]['image_id'])."<br>
            Région: ".$region['nom']."<br>
            Utilisateur: ".$user['pseudo']."<br>
            <div class=\"texte\"><p>
            Description: ".$tab[$key]['description']."<br>
            <br>Pour le contacter:<br><br> Email: ".$user['email'];
            if (!empty($user['phone'])) {
              echo "<br>Ou Téléphone: ".$user['phone'];
            }
    echo   "</p><pre class=\"date\">".date($tab[$key]['dateEtHeure'])."</pre>
            <a href=\"../Annonces/SupprimerAnnonce.php?id=".$tab[$key]['id']."\" color=\"red\"> Supprimer cette annonce</a>
            </div>
          </article>";
  }
}

function listeTabEvent(){               //Permet de récupèrer toute les évènements
  $connexion=connexion();               //de l'utilisateur connecté
  $req = "SELECT * FROM evenements WHERE user_id=\"".$_SESSION["id"]."\" ORDER BY dateFinal";
  $resultat = mysqli_query ($connexion,$req);
  $tab = array();

     while ( $ligne = mysqli_fetch_assoc ($resultat) ){
         array_push($tab,$ligne);
     }
   return $tab;
}

function afficheEventPerso(){   //Permet d'afficher les évènements
  $connexion=connexion();
  $tab=listeTabEvent();
  if (empty($tab)) {
    echo "<h1> Vous n'avez pas créé d'évènement :/ </h1>
          <a href=\"../Evenements/CreerEvenements.php\">Cliquez ici pour créer votre premier !</a>";
  }
  foreach ($tab as $key => $value) {
    $reqUser="SELECT * FROM users WHERE id=\"".$tab[$key]['user_id']."\";";
    $resultatUser=mysqli_query($connexion,$reqUser);
    $user=mysqli_fetch_assoc($resultatUser);
    $reqRegion="SELECT nom FROM regions WHERE id=\"".$tab[$key]['region_id']."\";";
    $resultatRegion=mysqli_query($connexion,$reqRegion);
    $region=mysqli_fetch_assoc($resultatRegion);
    echo "<article class=\"article\">";
    if ($tab[$key]['validé']==0) {
      echo "<span><h3>Votre évènement est en cours de validation par nos administrateurs soyez patient :)</h3></span>";
    }
    if ($tab[$key]['validé']==1) {
      echo "<h2>Validé</h2>";
    }
    if ($tab[$key]['validé']==2) {
      echo "<h2>Non Validé</h2>";
    }
    echo      "<h3 id=\"nom\">".$tab[$key]['nom']."</h3>
            <section id=\"head\">".afficheImage($tab[$key]['image_id'])."<br>
            Région: ".$region['nom']."<br>
            Utilisateur: ".$user['pseudo']."</section><br>
            <div class=\"texte\"><p>
            Description: ".$tab[$key]['description']."<br>
            <br>Pour le contacter:<br><br> Email: ".$user['email'];
            if (!empty($user['phone'])) {
              echo "<br>Ou Téléphone: ".$user['phone'];
            }
    echo   "</p><pre class=\"date\">".date($tab[$key]['dateFinal'])."</pre>
            </div>
          </article>";
  }
}
 ?>
