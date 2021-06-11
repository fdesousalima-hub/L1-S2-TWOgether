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
      } ?>
      
      <div id="contenu">
        <?php
        if(isset($_GET['erreur'])){
          if ($_GET['erreur']=="nonCo") {
            echo "<h1>Connecte-toi avant!</h1>";
          }else{
            echo "<h1>CONNECTEZ VOUS</h1>";
        }
          }else{
            echo "<h1>CONNECTEZ VOUS</h1>";
        } ?>
      <div class="CaseStyle">
      <form action="SauvegardeConnexion.php" method="post">

        <div class="case">
          <label for="pseudo">Pseudo:</label>
          <input type="text" name="pseudo" required>
        </div>
        <div class="case">
          <label for="password">Mot de passe:</label>
          <input type="password" name="password" required>
        </div>
          <button type="submit" name="button">Go</button>
      </form>
      <?php
      if (isset($_GET['erreur'])) {
        if ($_GET['erreur']=="PseudoMdp") {
          echo "Pseudo ou Mot de passe incorrect <br><br>";
        }
      }
       ?>
      <a href='../Inscription/index.php'> Pas encore de compte ? Inscris toi !</a>
   </div>
 </div>
  </body>
</html>
