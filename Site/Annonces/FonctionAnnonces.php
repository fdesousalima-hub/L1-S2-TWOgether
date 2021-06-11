<?php
function ListeAnnoncesID(){   //Permet de récupèrer toute les annonces
  $connexion=connexion();     //en fonction d'une région ou pas

  if (!isset($_GET['region']) || $_GET['region']=="all") {
    $req = "SELECT * FROM annonces ORDER BY dateEtHeure DESC";

  }else{
  $req = "SELECT * FROM annonces WHERE region_id=\"".$_GET["region"]."\" ORDER BY dateEtHeure DESC";
 }

  $resultat = mysqli_query ($connexion,$req);
  $tab = array();

     while ( $ligne = mysqli_fetch_assoc ($resultat) ){
         array_push($tab,$ligne);
     }
   return $tab;
   }

function afficheAnnonces(){   //Permet d'afficher les annonces
  $connexion=connexion();
  $tab=ListeAnnoncesID();

  if (empty($tab)) {
    echo "<h1> Pas d'annonce dans cette region :/ </h1>";
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
            </div>";
            if (estConnecté()) {
            if ($tab[$key]['users_id']==$_SESSION['id'] || $_SESSION['admin']==1) {
              echo "<a href=\"SupprimerAnnonce.php?id=".$tab[$key]['id']."\"> Supprimer cette annonce</a>";
            }
          }
    echo  "</article><hr>";
  }
}
 ?>
