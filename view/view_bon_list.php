<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <script type="text/javascript" src="js/function.js"></script>

    <div class="corps">
        <div>
            <table id="tableBon">
                <tr>
                    <th class="colTitle">
                       ID 
                       <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_id','DESC');"/>
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_id','ASC');"/>
                    </th>
                    <th class="colTitle">
                       TYPE 
                       <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','doclbl_id','DESC');"/>
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','doclbl_id','ASC');"/>
                    </th>      
                    <th class="colTitle">
                       N°FACTURE   
                        <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_fact_num','DESC');"/>
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_fact_num','ASC');"/>
                    </th>  
                    <th class="colTitle">
                       DATE  
                       <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_date','DESC');"/>
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_date','ASC');"/>
                    </th>  
                    <th class="colTitle">
                       BON SORTIE ASSOCIE
                       <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_sortie_assoc','DESC');"/>
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_sortie_assoc','ASC');"/>
                    </th>  
                </tr>
                <?php
                if (is_array($resAllBon)) {
                    foreach ($resAllBon as $oBon) {
                        ?>
                        <tr>
                            <td class="colData">
                                <?php echo $oBon->bon_id ?>
                            </td>
                            <td class="colData">
                                <?php foreach($toDocLbl as $oDocLbl){
                                        if($oDocLbl->doclbl_id === $oBon->doclbl_id){
                                            echo $oDocLbl->doclbl_lbl ;
                                        }
                            }?>
                            </td>
                            <td class="colData">
                                <?php echo $oBon->bon_fact_num ?>
                            </td>
                            <td class="colData">
                                <?php echo $oBon->bon_date ?>
                            </td>
                            <td class="colData">
                                <?php if($oBon->bon_sortie_assoc != null){
                                         echo $oBon->bon_sortie_assoc;
                                      }else{
                                         echo 'indéfinis';
                                      } ?>
                            </td>
                            <td><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = 
                                                "index.php?action=bon_detail&bonId=<?php echo $oBon->bon_id ?>"' />
                           </td>


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