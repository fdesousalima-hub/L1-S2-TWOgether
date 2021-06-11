<?php require_once('../FonctionGeneral.php');?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <link rel="stylesheet" href="../CSS/Inscription.css">
  </head>
    <body>
      <?php include('../Menu/Menu.php');
      //Redirection
      if (estConnecté()) {
        header("Location: ../index.php");
      }else{
        $url="http://localhost".$_SERVER['REQUEST_URI'];
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=$url && ( !isset($_SESSION['lien']) || $_SESSION['lien']!=$url)) {
          $_SESSION['lien']=Redirection();
        }else {
          $_SESSION['lien']=$url;
        }
      }
      ?>
      <div id="contenu">
        <h1>Rejoins-Nous !</h1>
        <div class="CaseStyle">
          <form action="SauvegardeInscription.php" method="post">
            <div class="case">
              <label id="nom" for="nom">*Nom:</label>
              <input type="text" name="nom" placeholder="Exemple: Dupond" required>
            </div>
            <div class="case">
              <label id="prenom" for="prenom">*Prenom:</label>
              <input type="text" name="prenom" placeholder="Exemple: Jean" required>
            </div>
            <div class="case">
              <label id="tel" for="phnumber">Téléphone:</label>
              <input type="tel" name="phone" pattern="0[1-9][0-9]{8}">
            </div>
            <div class="case">
            <label id="mail" for="email">*Adresse email:<?php if (isset($_GET['erreur'])) {
              if($_GET['erreur'] == "email"){
                echo "(L'EMAIL est déjà utilisé)";
              }
            } ?></label>
            <input type="email" name="email" placeholder="exemple@quelquechose.truc" required>
          </div>
          <div class="case">
            <label id="region" for="region">Région:</label>
              <?php  afficheRegion(); ?>
          </div>
          <div class="case">
            <label id="pseudo" for="Pseudo">*Pseudo:<?php if (isset($_GET['erreur'])) {
              if ($_GET['erreur']=="pseudo") {
                echo "(Le PSEUDO est déjà utilisé)";
              }
            } ?></label>
            <input type="text" name="pseudo" placeholder="Pseudo" required>
          </div>
          <div class="case">
            <label id="pwd" for="password">*Mot de Passe:</label>
            <input type="password" name="password" required>
          </div>
            <button type="submit" name="button">Go</button>
          </form>
       </div>
      </div>
    </body>
  </html>
