<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <script type="text/javascript" src="js/exportFct.js" ></script>

    <div class="corps">
        <a href="index.php?action=export&cat=utilisateur">test</a>

    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}