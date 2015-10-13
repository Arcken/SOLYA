<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

    //On regarde si la fenètre est une popup, si oui on choisit un header et un
    //footer différent
    if ($nv == 0) {
        ?>
        <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

        <?php
    } else {
        ?>
        <link type="text/css" href="./css/style_new_view.css" rel="stylesheet">
        <?php
        require $path . '/view/view_new_view_header.php';
    }
    ?>

    <!-- Fin des tests entête, code de la page -->
    <div class="corps">
        <form class="form" id="fMc" action="index.php">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <!-- On choisit le titre du bloc selon si c'est une popup-->
            <?php if ($nv == 0) { ?>            
                <h2>Saisie</h2>
            <?php } else { ?>
                <h2> <?php
                    echo $sPageTitle;
                }
                ?></h2>

            <div> 
                <label for="consLbl"> Libellé: </label>
                <input name="consLbl" placeholder="Saisie" required type="text">            
                <br>            
            </div>

            <div class="bas">
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset">
            </div>
        </form>

    </div>

    <?php
    //Test si la fenêtre est une popup, si oui on charge un footer
    if ($nv == 1) {
        require $path . '/view/view_new_view_footer.php';
    }
} else {
    echo 'Le silence est d\'or';
}