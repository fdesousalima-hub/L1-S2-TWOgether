<?php require_once('../FonctionGeneral.php'); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Profil.css">
  </head>

  <body>
    <?php include('../Menu/Menu.php'); ?>
    <div id="contenu">
      <?php
        if (!estConnecté()) {
          header("Location: ../index.php");
        }else{
       ?>
      <h1>Modification du profil</h1>
      <?php
      if (isset($_GET['etat'])) {
      if ($_GET['etat']=="succes") {
      echo "<h3 id=\"ok\">Profil modifié avec succès</h3>";
    }else if($_GET['etat']=="fail"){
      echo "<h3 id=\"alert\">Vous n'avez rien modifié</h3>";
    }}?>
    <div id="Modif">
      <form action="SauvegardeModifProfil.php" method="post">
          <div class="case">
            <label id="nom" for="nom">Nom:</label>
            <input type="text" name="nom" placeholder="Exemple: Dupond" value="<?php echo $_SESSION['nom']; ?>">
          </div>
          <div class="case">
            <label id="prenom" for="prenom">Prenom:</label>
            <input type="text" name="prenom" placeholder="Exemple: Jean" value="<?php echo $_SESSION['prenom']; ?>">
          </div>
          <div class="case">
            <label id="pseudo" for="Pseudo">Pseudo:</label>
            <input type="text" name="pseudo" placeholder="Pseudo" value="<?php echo $_SESSION['pseudo']; ?>">
          </div>
          <div class="case">
            <label id="tel" for="phnumber">Téléphone:</label>
            <input type="tel" name="phone" pattern="0[1-9][0-9]{8}" value="<?php echo $_SESSION['phone']; ?>">
          </div>
          <div class="case">
          <label id="mail" for="email">Adresse email:</label>
          <input type="email" name="email" placeholder="exemple@quelquechose.truc" value="<?php echo $_SESSION['email']; ?>">
        </div>
        <div class="case">
          <label id="region" for="region">Région:</label>
            <?php
            $connexion=connexion();
            //Affiche régions
            $req="SELECT * FROM regions;";
            $reqSESSION="SELECT * FROM regions WHERE id=\"".$_SESSION['region_id']."\";";
            $resultat=mysqli_query($connexion,$req);
            $resultatSESSION=mysqli_query($connexion,$reqSESSION);
            $ligneSESSION= mysqli_fetch_assoc($resultatSESSION);
            echo "<select name=\"region\">";
            while ($ligne = mysqli_fetch_assoc($resultat)) {
              if ($ligneSESSION['id']!=$ligne['id']) {
                echo "<option value=\"".$ligne['id']."\">".$ligne['nom']."</option>";
              }else {
                echo "<option value=\"".$ligne['id']."\" selected>".$ligne['nom']."</option>";
              }
              }
            echo "</select>";
            ?>
            </div>
            <div class="lastcase">
          <button type="submit" name="button">Modifier</button>
      </form>
    <?php } ?>
       <a href="index.php">Retour au profil ➡️</a>
       </div>
    </div>
    </div>
  </body>
</html>
