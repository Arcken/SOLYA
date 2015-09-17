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
        <div> 
            <label for="nutLbl"> Libellé: </label>
            <input name="nutLbl" placeholder="Saisie" required type="text">
            <br>
            <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
            <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
            <input name="clear" type="reset"> 
        </div>
    </form>
    <div>
        <p> Liste des éléments </p>
        <?php foreach ($resAllNut as $value) { ?>
        <p><?php echo $value->NUT_LBL ?></p>
        <?php } ?>
    </div>
</div>

<?php
if ($nv == 1) require $path.'/view/view_new_view_footer.php';
}
else echo 'Le silence est d\'or'
?>