<link href="css/style_home.css" type="text/css" rel="stylesheet">
<?php //Test si l'utilisateur est connecté si non retour à connexion.
 if (isset($_SESSION['auth']) && $_SESSION['auth'] == TRUE){
    require_once 'view/view_header.php';
    require_once 'view/view_menu.php';
    
     ?>

    <div class = "bloc_traitement">
        <div id = "bloc_accueil">
            <span> <?php print_r($_SESSION); ?> </span>
            </br>
            <span> <?php echo "Action = ".$sAction; ?></span>
        </div>
    </div>
    <?php
    require_once 'view/view_footer.php';
    }
 else{
     echo '<span> Authentification requise pour accéder au contenu de cette page </span></br>
           <a href="../index.php">"Cliquez ici pour vous connecter"</a>';
     
    } 
 ?>
    
    




