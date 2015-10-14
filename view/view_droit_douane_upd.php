<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>    
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <form class="form" id="fDd" action="index.php">
            <input name='token' 
                   type="text" 
                   value ='<?php echo rand(1, 1000000) ?>' 
                   hidden/>            
            <div class="col90"> 
                <label for="ddId"> ID </label>
                <input name="ddId" 
                       type="text"
                       readonly=""
                       value="<?php echo $resDdDetail->dd_id ?>">            
                <br>
                
                <label for="ddLbl"> Libellé </label>
                <input name="ddLbl" 
                       placeholder="Saisie" 
                       required type="text"
                       pattern=".{3,}" 
                       title="3 caractères minimum"
                       value="<?php echo $resDdDetail->dd_lbl ?>">            
                <br>

                <label for="ddTaux"> Taux </label>
                <input name="ddTaux" 
                       placeholder="Saisie" 
                       required 
                       type="number"
                       step="any"
                       min="0"
                       title="Minimum 0"
                       value="<?php echo $resDdDetail->dd_taux ?>">            
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