<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <form class="form" id="fPays" action="index.php">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <h2>Ajouter Pays</h2>                
            <div>
                <label for="paysId"> Id du pays: </label>
                   <input name="paysId" 
                          value="<?php echo $resPaysDetail->pays_id?>"
                          type="text" 
                          readonly="">            
                    <br>
                    
                <label for="paysNom"> Nom du pays: </label>
                <input name="paysNom" 
                       placeholder="Saisie" 
                       required type="text"
                       pattern=".{3,}" 
                       title="3 caractères minimum"
                       value="<?php echo $resPaysDetail->pays_nom?>">            
                <br>   
                
                <label for="paysAbv"> Abréviation du pays: </label>
                <input name="paysAbv" 
                       placeholder="Saisie" 
                       required type="text"
                       pattern=".{2,}" 
                       title="2 caractères minimum"
                       value="<?php echo $resPaysDetail->pays_abv?>">            
                <br>
                
                <label for="paysDvsNom"> Devise du pays: </label>
                <input name="paysDvsNom" 
                       placeholder="Saisie" 
                       required type="text"
                       pattern=".{3,}" 
                       title="3 caractères minimum"
                       value="<?php echo $resPaysDetail->pays_dvs_nom?>">            
                <br>
                
                <label for="paysDvsAbv"> Abréviation de la devise </label>
                <input name="paysDvsAbv" 
                       placeholder="Saisie" 
                       required 
                       type="text"
                       pattern=".{2,}" 
                       title="2 caractères minimum">
                       value="<?php echo $resPaysDetail->pays_dvs_abv?>">
                <br>
                
                <label for="paysDvsSym"> Symbole de la devise </label>
                <input name="paysDvsSym" 
                       placeholder="Saisie" 
                       required 
                       type="text"
                       pattern=".{1,}" 
                       title="1 caractère minimum">
                       value="<?php echo $resPaysDetail->pays_dvs_sym?>">
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
