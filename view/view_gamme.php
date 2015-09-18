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



    <!-- Fin des tests, code de la page -->
    <div class="corps">

        <form class="form" id="fGa" action="index.php">
            <!-- On choisit le titre du bloc selon si c'est une popup-->
            <?php if ($nv == 0) { ?>            
                <h2>Saisie</h2>
            <?php } else { ?>
                <h2> <?php echo $sPageTitle;
    } ?></h2>

            <img src="img/icon/add.png" alt="" onclick="window.opener.getGamme()"title="Maj gamme fen parent"/>
            <div> 
                <label for="gaLbl"> Libellé de la gamme: </label>
                <input name="gaLbl" placeholder="Saisie" required type="text">            
                <br>                
                <label for="gaAbv"> Abréviation de la gamme: </label>
                <input name="gaAbv" placeholder="Saisie" required type="text">            
                <br> 
            </div>
            
            <div class="bas">
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset">
            </div>
        </form>
        
        <div class="list">
            <h2> Liste des éléments </h2>
            <?php
            if($resAllGa!=0 && is_array($resAllGa)){
            foreach ($resAllGa as $value) {
                echo $value->GA_LBL
                ?>,  <?php echo $value->GA_ABV ?> <br>
                <?php
            }
            
            }
            ?>
        </div>
    </div>



    <?php
    //Test si la fenêtre est une popup, si oui on charge un footer
    if ($nv == 1)
        require $path . '/view/view_new_view_footer.php';
} else
    echo 'Le silence est d\'or'
    
?>