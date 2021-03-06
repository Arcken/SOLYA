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
    }
    ?>

    <!-- Fin des tests entête, code de la page -->
    <div class="corpsCenter">

         <!-- On choisit le titre du bloc selon si c'est une popup-->
            <?php if ($nv != 0) { ?>            
                
                <h2> <?php
                    echo $sPageTitle;
                }
                ?></h2>
                
        <form class="form" id="fTva" action="index.php" method="post">
            <input name='token' 
                   type="text" 
                   value ='<?php echo rand(1,1000000)?>' 
                   hidden/>            
                <div class="col30"> 
                <label for="tvaLbl"> Libellé</label>
                <input name="tvaLbl" 
                       placeholder="Saisie" 
                       required type="text"
                       pattern=".{3,}" 
                       title="3 caractères minimum">            
                <br>
                <label for="tvaTaux"> Taux </label>
                <input name="tvaTaux" 
                       placeholder="Saisie" 
                       required 
                       type="number"
                       step="any"
                       min="0"
                       title="Minimum 0">            
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
} else {
    echo 'Le silence est d\'or';
}