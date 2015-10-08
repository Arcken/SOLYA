<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">


    <div class="corps">
        <div class="list">
            <h2> Liste des bons de sortie et de retour :  </h2>
 
            <table>
                <tr>
                    <th class="colTitle"
                        onclick="orderby('<?php echo $sAction?>','ref_code','DESC');">
                       ID :
                    </th>
                    <th class="colTitle"
                        onclick="orderby('<?php echo $sAction?>','ref_code','DESC');">
                       TYPE :
                    </th>      
                    <th class="colTitle"
                        onclick="orderby('<?php echo $sAction?>','ref_code','DESC');">
                       N°FACTURE : 
                    </th>  
                    <th class="colTitle"
                        onclick="orderby('<?php echo $sAction?>','ref_code','DESC');">
                       DATE :
                    </th>  
                    <th class="colTitle"
                        onclick="orderby('<?php echo $sAction?>','ref_code','DESC');">
                       BON SORTIE ASSOCIE :
                    </th>  
                </tr>
                <?php
                if (is_array($resAllBon)) {
                    foreach ($resAllBon as $oBon) {
                        ?>
                        <tr>
                            <td style="border-right: solid 2px black;">
                                <?php echo $oBon->bon_id ?>
                            </td>
                            <td><?php foreach($toDocLbl as $oDocLbl){
                                        if($oDocLbl->doclbl_id === $oBon->doclbl_id){
                                            echo $oDocLbl->doclbl_lbl ;
                                        }
                            }?>
                            </td>
                            <td style="border-right: solid 2px black;">
                                <?php echo $oBon->num_fact ?>
                            </td>
                            <td style="border-right: solid 2px black;">
                                <?php echo $oBon->bon_date ?>
                            </td>
                            <td style="border-right: solid 2px black;">
                                <?php echo $oBon->bon_sortie_assoc ?>
                            </td>
                            <td><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = 
                                                "index.php?action=bon_detail&bonId=".
                                                "<?php echo $oBon->bon_id ?>"'/></td>


                        </tr>

                        <?php
                    }
                }
                ?>
            </table>
            <?php
            if ($iTotal > $iNbPage) {
                // affichage des liens vers les pages
                Tool::affichePages($limite, $iNbPage, $iTotal, $sAction);
            }
            ?>
        </div>
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}
?>