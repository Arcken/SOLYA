<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">

        <form class="form" id="fDc" action="index.php" method="post">
            <input name='token' 
                   type="text" 
                   value ='<?php echo rand(1, 1000000) ?>' 
                   hidden/>
            <div class="col90">
                <label for="dcId"> ID: </label>
                <input name="dcId" 
                       type="text"
                       value="<?php echo $resDcDetail->dc_id ?>"
                       readonly="">            
                <br>
                <label for="dcLbl"> Libellé: </label>
                <input name="dcLbl" 
                       placeholder="Saisie" 
                       required type="text"
                       pattern=".{3,}"
                       title="3 caractères minimum"
                       value="<?php echo $resDcDetail->dc_lbl ?>">            
                <br>
                <label for="dcNb"> Valeur: </label>
                <input name="dcNb" 
                       placeholder="nombre de jours ###" 
                       required type="number"
                       min="1"
                       title="Minimum 1"
                       value="<?php echo $resDcDetail->dc_nb ?>"
                       >
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
