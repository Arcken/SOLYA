<?php //Test si l'utilisateur est connecté si non retour à connexion.
 if (isset($_SESSION['auth']) && $_SESSION['auth'] == TRUE){
    require_once 'view/view_menu.php';
 
 }
 else{
     echo '<span> Authentification requise pour accéder au contenu de cette page </span></br>
           <a href="../index.php">"Cliquez ici pour vous connecter"</a>';
     
    } 
 ?>
    
    




