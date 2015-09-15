<?php if (isset ($_SESSION['group']) && $_SESSION['group']>=0){?>
<link href="css/style_home.css" type="text/css" rel="stylesheet">


        <div id = "bloc_accueil">
            <span> <?php print_r($_SESSION); ?> </span>
            </br>
            <span> <?php echo "Action = ".$sAction; ?></span>
        </div>
   

<?php
}
else echo 'Le silence est d\'or'
?>
    




