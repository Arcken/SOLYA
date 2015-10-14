<?php
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
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

    <div class="corps">
        <form class="form" id="fNut" action="index.php">
            <input name='token' type="text" value ='<?php echo rand(1, 1000000) ?>' hidden/>
            <div class="col90">
                <label for="nutId"> ID: </label>
                <input name="nutId" 
                       readonly="" 
                       value="<?php echo $resNutDetail->nut_id ?>" 
                       type="text">
                <br>
                <label for="nutLbl"> Libellé: </label>
                <input name="nutLbl"  
                       value="<?php echo $resNutDetail->nut_lbl ?>" 
                       type="text"
                       pattern=".{3,}" 
                       title="3 caractères minimum">
                <br>
            </div>
            <div class='bas'>
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset"> 
            </div>
        </form>

    </div>

    <?php
    if ($nv === 1) {
        require $path . '/view/view_new_view_footer.php';
    }
} else {
    echo '<p> Le silence est d\'or </p>';
}
