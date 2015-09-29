<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {

?>

        
            <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

        <div class="corps">

            <form class="form" id="fGa" action="index.php">
               <div>
                   <label for="gaId"> Id de la gamme: </label>
                   <input name="gaId" value="<?php echo $resGaDetail->ga_id?>" type="text" readonly="">            
                    <br>
                    <label for="gaLbl"> Libellé de la gamme: </label>
                    <input name="gaLbl" value="<?php echo $resGaDetail->ga_lbl?>" required type="text">            
                    <br>                
                    <label for="gaAbv"> Abréviation de la gamme: </label>
                    <input name="gaAbv" value="<?php echo $resGaDetail->ga_abv?>" required type="text">            
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
    ?>