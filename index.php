<head>
<meta charset="UTF-8"></meta>
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php //Test si l'utilisateur est connecté si non retour à connexion.<?php
    session_start();
    require_once 'controler/control.php'; //appel page du contrôleur
    
    if (isset($_SESSION['auth']) && $_SESSION['auth'] == TRUE){
        
        require_once 'view/view_header.php';
        require_once 'view/view_menu.php';?>
        <div class = "bloc_traitement">';
        <?php require_once 'controler/control.php'; //appel page du contrôleur ?>
        </div>
        <?php require_once 'view/view_footer.php'; 
    
    }else if (!isset($_SESSION['auth'])){
        
    }
    else{
     echo '<span> Authentification requise pour accéder au contenu de cette page </span></br>
           <a href="index.php?action=Connexion">"Cliquez ici pour vous connecter"</a>';
     
    }?>
   <title> <?php echo $sTitle; ?> </title>
  </body>   

