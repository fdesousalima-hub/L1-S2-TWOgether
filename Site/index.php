<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
    <link rel="stylesheet" href="CSS/Menu.css">
    <link rel="stylesheet" href="CSS/Main.css">
  </head>

  <body>
    <?php session_start();
    require_once('FonctionGeneral.php');?>
    <div id="menu">
      <img src="Images/ecology.png" class="ImageEco" alt="Erreur Images" onclick="document.location='index.php'">
      <?php if (isset($_SESSION['nom'])) {
        echo "<div class=\"shadowbox onglet\" onclick=\"document.location='Profil/index.php'\">
          <p>Profil</p><p> <a href=\"Deconnexion/index.php\"><img class=\"imageDeco\"src=\"Images/deconnexion.png\"></a></p>
        </div>";
      }else{
        echo "<div id=\"formulaire\"><div class=\"shadowbox inscripConnect\" onclick=\"document.location='Connexion/index.php'\">
          <p>Connexion</p>
        </div>
        <div class=\"shadowbox inscripConnect right\" onclick=\"document.location='Inscription/index.php'\">
          <p>Inscription</p>
        </div></div>";
      } ?>
      <div class="shadowbox onglet" onclick="document.location='Annonces/index.php'">
        <p>Annonces</p>
      </div>
      <div class="shadowbox onglet" onclick="document.location='Evenements/index.php'">
        <p>Evenement</p>
      </div>
      <div class="shadowbox onglet" onclick="document.location='Map/index.php'">
        <p>Map</p>
      </div>
      <div class="shadowbox onglet" onclick="document.location='Boutique/index.php'">
        <p>Boutique</p>
      </div>
      </div>
    <div id="contenu">
      <h1>Accueil</h1>
      <p id="welcome"><marquee  height= "150px" direction="down" behavior="slide" >Bienvenue sur TWOgether</marquee></p>
      <section><h4>TWOgether est un site de partage grâce auquel vous pourrez optimiser de façon durable votre quotidien.</h4>
        <p id="Text">
      Vous vous séparez d'objets dont vous n'avez plus l'usage ? Allez dans l'onglet annonces et mettez votre offre en ligne ! <br>
      Vous voulez participer à une action engagée ou rencontrer des gens dans la même optique écologique que vous ? Cliquez sur évènement ! <br><br>
      <span>Pour participez commencez par vous créer un compte !</span></p>
    </section>
      <footer>
        <p id="foot"><a href="Contact/Contact.php">Contacter</a></p>
      </footer>
    </div>
  </body>
</html>
