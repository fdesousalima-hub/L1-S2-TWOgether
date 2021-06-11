<?php
//Page qui permet de se déconnecter
require_once('../FonctionGeneral.php');
  session_start();
  session_destroy();
  header("Location: ".Redirection());

 ?>
