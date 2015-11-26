<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
    
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
 <link type="text/css" href="css/style_list.css" rel="stylesheet">
    <div class="corpsCenter">
        <div class="colOnlyOne">
            
            <table id="tableRef" class="tableList">
                <script type='text/javascript'>
                    $tabRefs=new Array();
                </script>
                <tr> <!--En-tête du tableau-->
                    <th class="colTitle" id="colImg">
                        Image
                    </th>
                    <th class="colTitle">
                        Code référence
                    </th>
                     <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_code','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_code','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Libéllé
                    </th>
                     <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_lbl','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_lbl','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Fiche article associé 
                    </th>
                     <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','fiart_id','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','fiart_id','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Marque
                    </th>
                     <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_mrq','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_mrq','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Poids net
                    </th>
                    <th class="colTdIco">
                    <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_poids_net','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_poids_net','ASC');"/>
                    </th>                    
                    <th class="colTitle">
                        Volume net 
                    </th>
                    <th class="colTdIco">
                    <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_emb_vlm_ctn','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_emb_vlm_ctn','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Qte Stock
                    </th>                     
                    <th class="colTitle">
                        DLUO
                    </th>                     
                    <th class="colTitle">
                        Coût d'achat moyen
                    </th>                     
                    <th class="colTitle">
                        PV Part
                    </th>
                    <th class="colTitle">
                        Marge Part
                    </th>
                    <th class="colTitle">
                        Coeff Part
                    </th>
                    <th class="colTitle">
                        PV Pro
                    </th>
                    <th class="colTitle">
                        Marge Pro
                    </th>
                    <th class="colTitle">
                        Coeff Pro
                    </th>
                    <th class="colTitle">
                        TVA
                    </th>
                     <th class="colTdIco">
                    <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','tva_id','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','tva_id','ASC');"/>
                    </th>
                    <th class="colTitle">Code Douanier</th>
                     <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_code_douane','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_code_douane','ASC');"/>
                    </th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','dd_id','DESC');">
                        Droit de douane 
                    </th>
                   <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','dd_id','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','dd_id','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Conditionnement
                    </th>
                     <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_emb_lbl','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_emb_lbl','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Stock Minimum 
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_st_min','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_st_min','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Commentaire 
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_com','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ref_com','ASC');"/>
                    </th>
                </tr>
                
                <!--Données du tableau -->
            <?php if (isset($resLigRefs)&& is_array($resLigRefs)) {
                      for($i=0;$i<count($resLigRefs['ref']);$i++){ ?> 
                
                    <script type='text/javascript'>
                        //On créé un tableau javascript récupérant les données pour
                        //alimenter la fonction delElt
                        
                        var $tRef = new Array();
                        $tRef['refCode']= "<?php echo $resLigRefs['ref'][$i]->ref_code; ?>";
                        $tRef['refLbl'] = "<?php echo $resLigRefs['ref'][$i]->ref_lbl; ?>";
                        $tabRefs[<?php echo $resLigRefs['ref'][$i]->ref_id ?>]=$tRef;
                    </script>
                    
                     <tr>
                        <td class="colData">
                            <?php if($resLigRefs['ref'][$i]->ref_photos_pref!=''){ ?>
                                     <img src="<?php echo $imgMiniPath. 'lbl_' . $resLigRefs['ref'][$i]->ref_photos_pref; ?>" 
                                          onclick ='location.href="index.php?action=ref_detail&idRef="
                                                   + <?php echo $resLigRefs['ref'][$i]->ref_id; ?>'
                            <?php }else{
                                     echo 'Aucune photos définie';
                        }?>
                        </td>
                        <td class="colData" colspan="3"><?php echo $resLigRefs['ref'][$i]->ref_code; ?></td>
                        <td class="colData" colspan="3"><?php echo $resLigRefs['ref'][$i]->ref_lbl;  ?></td>
                        <td class="colLinkCell" colspan="3" id='colFiart' 
                            onclick='location.href="index.php?action=fiart_detail&fiartId="
                                     +<?php echo $resLigRefs['ref'][$i]->fiart_id ;?>'
                            
                            style="cursor:pointer;"><?php echo $resLigRefs['fiart'][$i]->fiart_lbl; ?>
                        </td>
                        <td class="colData" colspan="3"><?php echo $resLigRefs['ref'][$i]->ref_mrq;  ?></td>
                        <td class="colData" colspan="3"><?php echo $resLigRefs['ref'][$i]->ref_poids_net;    ?></td>
                        <td class="colData" colspan="3"><?php echo $resLigRefs['ref'][$i]->ref_emb_vlm_ctn;  ?></td>
                        <td class="colData"><?php
                                                //Si la valeur en stock n'est pas définis on echo indéfinis
                                                if($resLigRefs['stock'][$i]->nb!=''){
                                                    echo $resLigRefs['stock'][$i]->nb;
                                                }else{
                                                    echo 'indéfinis';   
                                                }?></td>
                        <td class="colData"
                            title="Date la plus courte en stock">
                                <?php echo $resLigRefs['lot'][$i]->lot_dlc;  ?></td>
                        <td class="colData" 
                            title="Sur article en stock">
                         <?php
                             //Si la valeur du coutAchatMoyen = indéfinis
                             //aucune valeur n'est disponible pour le cout d'achat
                                if($resLigRefs['cuAchM'][$i]->nb != 'indéfinis'){
                                    echo round($resLigRefs['cuAchM'][$i]->nb,2);
                                    
                                }else{
                                    echo $resLigRefs['cuAchM'][$i]->nb;
                                }?></td>
                        <td class="colData">
                            <?php
                                if($resLigRefs['pve'][$i] === 0){
                                    
                                   $resLigRefs['pve'][$i] = new PrixVente();
                                   $resLigRefs['pve'][$i]->pve_ent='indéfinis';
                                   $resLigRefs['pve'][$i]->pve_per='indéfinis';
                                   
                                }
                                echo $resLigRefs['pve'][$i]->pve_per; ?>
                        </td>
                          
                        <td class="colData"><?php echo $resLigRefs['margePart'][$i]  ?></td>
                        <td class="colData"><?php echo $resLigRefs['coefPart'][$i]  ?></td>
                        <td class="colData">
                            <?php echo $resLigRefs['pve'][$i]->pve_ent; ?>
                        </td>
                        <td class="colData"><?php echo $resLigRefs['margePro'][$i]  ?></td>
                        <td class="colData"><?php echo $resLigRefs['coefPro'][$i]  ?></td>
                        <td class="colData" colspan="3">
                            <?php echo $resLigRefs['tva'][$i]->tva_lbl
                                       .' '.$resLigRefs['tva'][$i]->tva_taux; ?>
                        </td>
                        <td class="colData" colspan="3">
                            <?php //Si le code douanier n'est pas définis on echo indéfinis
                                    if ($resLigRefs['ref'][$i]->ref_code_douane != ''){
                                        echo $resLigRefs['ref'][$i]->ref_code_douane;
                                   }else{
                                       echo 'indéfinis';
                                   } ?>
                        </td>
                        <td class="colData" colspan="3">
                            <?php  echo $resLigRefs['dd'][$i]->dd_lbl.' '.
                                        $resLigRefs['dd'][$i]->dd_taux; ?>
                        </td>
                        <td class="colData" colspan="3">
                            <?php 
                                //Si l'embalage n'est pas définis on echo indéfinis
                                if($resLigRefs['ref'][$i]->ref_emb_lbl!=''){
                                    echo $resLigRefs['ref'][$i]->ref_emb_lbl;

                                }else{
                                    echo 'indéfinis';    
                                }?>
                        </td>
                        <td class="colData" colspan="3">
                            <?php echo $resLigRefs['ref'][$i]->ref_st_min;?>
                        </td>
                        <td class="colData" colspan="3">
                            <?php echo $resLigRefs['ref'][$i]->ref_com; ?>
                        </td>
                        <td class="colTdIco">
                            <img src="img/icon/read.png" title="Consulter"
                                  onclick='location.href="index.php?action=ref_detail&idRef="+
                                           <?php echo $resLigRefs['ref'][$i]->ref_id; ?>'
                             />
                        </td>
                        <td class="colTdIco">
                            <img src="img/icon/modify.png" title="Modifier"
                                  onclick='location.href="index.php?action=ref_upd&idRef="+
                                   <?php echo $resLigRefs['ref'][$i]->ref_id; ?>'
                             />
                        </td>
                        
                        <td class="colTdIco">
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick='delElt(<?php echo $resLigRefs['ref'][$i]->ref_id ?>,
                                                 "idRef",
                                                 "Référence",
                                                 "ref_del",
                                                 $tabRefs)'
                             />
                        </td>
                     </tr>

            <?php }
            
           }?>
                       
            </table>
            <div class="bas">
                <input type="button" onclick='location.href = "index.php?action=bon_add"' value="Ajouter">
            </div>
        </div>
    </div>
        
        
             <?php
        if ($iTotal > $nbRow) {
            // affichage des liens vers les pages
            Tool::affichePages($rowStart, $nbRow, $iTotal, $sAction);
        }
        ?>
        
<?php
} else {
    echo 'Le silence est d\'or';
}
