<?php
require_once('../FonctionGeneral.php');

function UserConnexion($tabPost){   //Permet de connecter un utilisateur
 $connexion=connexion();
 if (isset($tabPost['pseudo']) && isset($tabPost['password'])) {
   $req="SELECT * FROM users WHERE pseudo=\"".$tabPost['pseudo']."\";";
   $resultat=mysqli_query($connexion,$req);
     $ligne=mysqli_fetch_assoc($resultat);
     if (password_verify($tabPost['password'],$ligne['password']) && $ligne['pseudo']==$tabPost['pseudo']) {
       foreach ($ligne as $key => $value) {
         $_SESSION[$key]=$value;
       }
       $url=$_SESSION['lien'];
        unset($_SESSION['lien']);
       header("Location: ".$url);
     }else{
       header("Location: ../Connexion/index.php?erreur=PseudoMdp");
     }
   }else{
     header("Location: ../Connexion/index.php");
   }
}
 ?>
