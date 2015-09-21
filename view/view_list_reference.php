<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <div class="col20">
            <table id="tableRef">
                <tr>
                    <th class="colTitle">Id </th>
                    <th class="colTitle">Libéllé </th>
                    <th></th>
                </tr>
                  <?php if (isset($toRef)&& is_array($toRef)) {
                         foreach($toRef as $oRef){ ?> 
                     <tr>
                        <td><?php echo $oRef->ref_id; ?></td>
                        <td><?php echo $oRef->ref_lbl; ?></td>
                        <td>
                            <!--<img src="img/icon/read.png" onclick='location.href="index.php?action=read_ref"'</img>-->
                            <img src="img/icon/modify.png" onclick='location.href="index.php?action=ref_detail&idRef="+ <?php echo $oRef->ref_id; ?>'</img>
                        </td>
                     </tr>

                   <?php } ?>
            </table>
          <?php }?>
        
    </div>
       
          
    
    
    
<?php
} else {
    echo 'Le silence est d\'or';
}
?>