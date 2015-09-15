<?php
if ($nv == 0) {    
    ?>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <?php
    } else {
        ?>
        <link type="text/css" href="./css/style_new_view.css" rel="stylesheet">
        <?php
    require $path.'/view/view_new_view_header.php';
    }
    ?>
    
    <div class="corps">
        <form class="form" id="fPays" action="index.php">
            <h2>Ajouter Pays</h2>                
            <div> 
                <label for="paysNom"> Nom du pays: </label>
                <input name="paysNom" placeholder="Saisie" required type="text">            
                <br>                
                 <label for="paysAbv"> Abréviation du pays: </label>
                <input name="paysAbv" placeholder="Saisie" required type="text">            
                <br>
                <label for="paysDvsNom"> Devise du pays: </label>
                <input name="paysDvsNom" placeholder="Saisie" required type="text">            
                <br>
                <label for="paysDvsAbv"> Abréviation de la devise </label>
                <input name="paysDvsAbv" placeholder="Saisie" required type="text">            
                <br>
                <label for="paysDvsSym"> Symbole de la devise </label>
                <input name="paysDvsSym" placeholder="Saisie" required type="text">            
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
            <?php                foreach ($resPays as $value) {
                echo $value->PAYS_NOM ?>,  <?php echo $value->PAYS_ABV ?> <br>
                    <?php
                }
            ?>
        </div>
    </div>
    <?php if ($nv == 1)     require $path.'/view/view_new_view_footer.php';?>