<!-- Menu de toute les pages -->
<?php session_start();
require_once('../FonctionGeneral.php');?>
<div id="menu">
  <img src="../Images/ecology.png" class="ImageEco" alt="Erreur Images" onclick="document.location='../index.php'">
  <?php if (isset($_SESSION['nom'])) {
    echo "<div class=\"shadowbox onglet\" onclick=\"document.location='../Profil/index.php'\">
      <p>Profil</p><p> <a href=\"../Deconnexion/index.php\"><img class=\"imageDeco\" src=\"../Images/deconnexion.png\"></a></p>
    </div>";
  }else{
    echo "<div id=\"formulaire\"><div class=\"shadowbox inscripConnect\" onclick=\"document.location='../Connexion/index.php'\">
      <p>Connexion</p>
    </div>
    <div class=\"shadowbox inscripConnect right\" onclick=\"document.location='../Inscription/index.php'\">
      <p>Inscription</p>
    </div></div>";
  } ?>
  <div class="shadowbox onglet" onclick="document.location='../Annonces/index.php'">
    <p>Annonces</p>
  </div>
  <div class="shadowbox onglet" onclick="document.location='../Evenements/index.php'">
    <p>Evenement</p>
  </div>
  <div class="shadowbox onglet" onclick="document.location='../Map/index.php'">
    <p>Map</p>
  </div>
  <div class="shadowbox onglet" onclick="document.location='../Boutique/index.php'">
    <p>Boutique</p>
  </div>
  </div>
