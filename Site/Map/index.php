<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TWOgether</title>
    <link rel="stylesheet" href="../CSS/Main.css">
    <link rel="stylesheet" href="../CSS/Menu.css">
  </head>

  <body>
    <?php include('../Menu/Menu.php'); ?>

    <div id="contenu">
      <h1>Map</h1>
      <h3>Lieux de recyclage</h3>
      <form action="index.php" method="get">
        <input type="search" name="search" value="" placeholder="Rechercher...">
        <button type="submit">➡️</button>
      </form>
      <br>
      <?php if (isset($_GET['search'])) {
        echo " <iframe src=\"https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d5625023.060179895!2d2.5022014565602!3d46.496365211720956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s".$_GET['search']."+en+France!5e0!3m2!1sfr!2spt!4v1556822120463!5m2!1sfr!2spt\"
          width=\"800\" height=\"600\"></iframe>";
      }else{
        echo " <iframe src=\"https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d5625023.060179895!2d2.5022014565602!3d46.496365211720956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1srecyclage+en+France!5e0!3m2!1sfr!2spt!4v1556822120463!5m2!1sfr!2spt\"
          width=\"800\" height=\"600\"></iframe>";
      }?>
    </div>
  </body>
</html>
