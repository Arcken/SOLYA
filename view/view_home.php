<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
    <!--<link href="css/style_home.css" type="text/css" rel="stylesheet">-->
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_list.css" rel="stylesheet">

    <div class="corpsCenter">
        <div class="colOnlyOne">
            <img src="img/site/logoSolya.png">
        </div>
        
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}
