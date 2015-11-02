<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">

        <form class="form" id="fTva" action="index.php" method="post">
            <input name='token' 
                   type="text" 
                   value ='<?php echo rand(1, 1000000) ?>' 
                   hidden/>       
            
            <div class="col90">
                <label for="tvaId"> ID</label>
                <input name="tvaId" 
                       type="text"
                       value="<?php echo $resTvaDetail->tva_id ?>"
                       readonly="">            
                <br>
                <label for="tvaLbl"> Libellé</label>
                <input name="tvaLbl" 
                       placeholder="Saisie" 
                       required type="text"
                       pattern=".{3,}" 
                       title="3 caractères minimum"
                       value="<?php echo $resTvaDetail->tva_lbl ?>"
                       >            
                <br>
                <label for="tvaTaux"> Taux </label>
                <input name="tvaTaux" 
                       placeholder="Saisie" 
                       required 
                       type="number"
                       step="any"
                       min="0"
                       title="Minimum 0"
                       value="<?php echo $resTvaDetail->tva_taux ?>"
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