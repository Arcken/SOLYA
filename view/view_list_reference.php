<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <div class="col50">
      <?php if (isset($toRef)) {
                 foreach($toRef as $oRef){ ?> 
            <span name="<?php echo $oRef->ref_id; ?>"><?php echo $oRef->ref_id.' '.$oRef->ref_lbl; ?></span>
            <img src="img/icon/read.png" onclick='location.href("index.php?action=read_ref")'</img>
            <img src="img/icon/modify.png" onclick='location.href("index.php?action=updt_ref")'</img>
           <?php } 
            
            }
        ?>
    </div>
    
<?php
} else {
    echo 'Le silence est d\'or';
}
?>