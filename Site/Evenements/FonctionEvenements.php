<?php
function ListeEventID(){  //Permet de récupèrer tout les évènements validés
  $connexion=connexion();
  if (!isset($_GET['region'])) {
    $req = "SELECT * FROM evenements WHERE validé='1' ORDER BY dateFinal";
  }else{
  $req = "SELECT * FROM evenements WHERE validé='1' and region_id=\"".$_GET["region"]."\" ORDER BY dateFinal";
 }
  $resultat = mysqli_query ($connexion,$req);
  $tab = array();
     while ( $ligne = mysqli_fetch_assoc ($resultat) ){
         array_push($tab,$ligne);
     }
   return $tab;
   }
function afficheEvent(){    //Permet d'afficher les évènements validés
  $connexion=connexion();
  $tab=ListeEventID();
  if (empty($tab)) {
    echo "<h1> Il n'y a pas d'évènements près de chez vous </h1>
          <a href=\"CreerEvenements.php\">En créer un !</a>";
  }
  foreach ($tab as $key => $value) {
    $reqUser="SELECT * FROM users WHERE id=\"".$tab[$key]['user_id']."\";";
    $resultatUser=mysqli_query($connexion,$reqUser);
    $user=mysqli_fetch_assoc($resultatUser);
    $reqRegion="SELECT nom FROM regions WHERE id=\"".$tab[$key]['region_id']."\";";
    $resultatRegion=mysqli_query($connexion,$reqRegion);
    $region=mysqli_fetch_assoc($resultatRegion);

    echo "<article class=\"article\">
            <h3 id=\"nom\">".$tab[$key]['nom']."</h3>
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
          </article>";
  }
}
 ?>
