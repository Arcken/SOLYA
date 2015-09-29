<?php if (isset($_SESSION['group']) && $_SESSION['group'] >=0){ 
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
    <form class="form" id="fNut" action="index.php">
        <div class="col90"> 
            <label for="nutLbl"> Libellé: </label>
            <input name="nutLbl" placeholder="Saisie" required type="text"
                   pattern=".{3,}" title="3 caractéres minimum">
            <br>
        </div>
        <div class='bas'>
            <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
            <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
            <input name="clear" type="reset"> 
        </div>
    </form>
    <div>
        <p> Liste des éléments </p>
   <?php 
         if(is_array($resAllNut) && $resAllNut!=0) {
            foreach ($resAllNut as $value) { ?>
                <p><?php echo $value->nut_lbl ?></p>
   <?php    }
         } ?>
    </div>
</div>

<?php 
    if ($nv === 1){ 
        require $path.'/view/view_new_view_footer.php';
    }
}else{
    echo '<p> Le silence est d\'or </p>';
}
?>  