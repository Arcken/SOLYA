<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
     <link type="text/css" href="css/style_list.css" rel="stylesheet">
    <script type="text/javascript" src="js/function.js"></script>

    <div class="corps">
        <div>
            <table class="tableList">
                <tr>
                    <th class="colTitle">
                       ID 
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_id','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_id','ASC');"/>
                    </th>
                    <th class="colTitle">
                       TYPE 
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','doclbl_id','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','doclbl_id','ASC');"/>
                    </th>      
                    <th class="colTitle">
                       N°FACTURE
                    </th>
                    <th class="colTdImg">
                        <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_fact_num','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_fact_num','ASC');"/>
                    </th>  
                    <th class="colTitle">
                       DATE  
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_date','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_date','ASC');"/>
                    </th>  
                    <th class="colTitle">
                       BON SORTIE ASSOCIE
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_sortie_assoc','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','bon_sortie_assoc','ASC');"/>
                    </th>
                    <th>
                        
                    </th>
                    <th>
                        
                    </th>
                    
                </tr>
                <?php
                if (is_array($resAllBon)) {
                    foreach ($resAllBon as $oBon) {
                        ?>
                        <tr>
                            <td class="colData" colspan="3">
                                <?php echo $oBon->bon_id ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php foreach($toDocLbl as $oDocLbl){
                                        if($oDocLbl->doclbl_id === $oBon->doclbl_id){
                                            echo $oDocLbl->doclbl_lbl ;
                                        }
                            }?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $oBon->bon_fact_num ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $oBon->bon_date ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php if($oBon->bon_sortie_assoc != null){
                                         echo $oBon->bon_sortie_assoc;
                                      }else{
                                         echo 'indéfinis';
                                      } ?>
                            </td>
                            <td class="colTdImg"><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = 
                                                "index.php?action=bon_detail&bonId=<?php echo $oBon->bon_id ?>"' />
                               </td>
                               <td class="colTdImg">
                                <img src="img/icon/read.png" title="Consulter"
                                     onclick='window.open(
                                              "index.php?action=nv_bon_pdf&bonId=<?php echo $oBon->bon_id ?>")'
                             />
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>
            </table>
            <?php
            if ($iTotal > $nbRow) {
                // affichage des liens vers les pages
                Tool::affichePages($rowStart, $nbRow, $iTotal, $sAction);
            }
            ?>
        </div>
        <div class="bas">
            <input type="button" onclick='location.href = "index.php?action=bon_add"' value="Ajouter">
        </div>
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}