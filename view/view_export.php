<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <script type="text/javascript" src="js/exportFct.js" ></script>

    <div class="corps">
        <ul>
            <li><a href="view/export/export_bon.php?test=accésValide">Bon reprise/sortie</a></li>
            <li><a href="view/export/export_bon_entree.php?test=accésValide">Bon entree</a></li>
            <li><a href="view/export/export_utilisateur.php?test=accésValide">Utilisateur</a></li>
        </ul>
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}