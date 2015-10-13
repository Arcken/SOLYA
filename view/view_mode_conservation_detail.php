<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">

        <form class="form" id="fGa" action="index.php">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <div>
                <label for="consId"> Id: </label>
                <input name="consId" value="<?php echo $resMcDetail->cons_id ?>" type="text" disabled="">            
                <br>
                
                <label for="consLbl"> Libellé: </label>
                <input name="consLbl" value="<?php echo $resMcDetail->cons_lbl ?>" required type="text"
                       pattern=".{3,}" title="3 caractères minimum">            
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
