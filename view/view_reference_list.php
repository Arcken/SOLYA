<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
    
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <div>
            <table id="tableRef">
                <script type='text/javascript'>
                    $tabRefs=new Array();
                </script>
                <tr> <!--En-tête du tableau-->
                    <th class="colTitle" id="colImg">Image</th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','ref_code');">
                        Code référence
                    </th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','ref_lbl');">
                        Libéllé
                    </th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','fiart_id');">
                        Fiche article associé 
                    </th>
                    <th class="colTitle">Marque</th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','ref_poids_net');">
                        Poids net
                    </th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','ref_emb_vlm_ctn');">
                        Volume net 
                    </th>
                    <th class="colTitle">Qte Stock</th>
                    <th class="colTitle">DLUO</th>
                    <th class="colTitle">Coût d'achat</th>
                    <th class="colTitle">PV Part</th>
                    <th class="colTitle">Marge Part</th>
                    <th class="colTitle">Coeff Part</th>
                    <th class="colTitle">PV Pro</th>
                    <th class="colTitle">Marge Pro</th>
                    <th class="colTitle">Coeff Pro</th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','tva_id');">
                        TVA
                    </th>
                    <th class="colTitle">Code Douanier</th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','dd_id');">
                        Droit de douane 
                    </th> 
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','ref_emb_lbl');">
                        Conditionnement
                    </th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','ref_st_min');">
                        Stock Minimum 
                    </th>
                    <th class="colTitle" 
                        onclick="orderby('<?php echo $sAction?>','ref_com');">
                        Commentaire 
                    </th>
                    <th></th>
                    <th></th>
                </tr>
                
                <!--Données du tableau -->
                  <?php if (isset($toRef)&& is_array($toRef)) {
                         foreach($toRef as $oRef){ ?> 
                
                    <script type='text/javascript'>
                        var $tRef = new Array();
                        $tRef['refCode']= "<?php echo $oRef->ref_code; ?>";
                        $tRef['refLbl'] = "<?php echo $oRef->ref_lbl; ?>";
                        $tabRefs[<?php echo $oRef->ref_id ?>]=$tRef;
                    </script>
                    
                     <tr>
                        <td class="colData">
                            <?php if($oRef->ref_photos_pref!=''){ ?>
                                     <img src="<?php echo $imgMiniPath.$oRef->ref_photos_pref.'_lbl.jpg'; ?>" 
                                          onclick ='location.href="index.php?action=ref_detail&idRef="+ <?php echo $oRef->ref_id; ?>'
                            <?php }else{
                                     echo 'Aucune photos définis';
                        }?>
                        </td>
                        <td class="colData"><?php echo $oRef->ref_code; ?></td>
                        <td class="colData"><?php echo $oRef->ref_lbl;  ?></td>
                        <td class="colData" id='colFiart' 
                            onclick='location.href="index.php?action=fiart_detail&fiartId="+<?php echo $oRef->fiart_id ;?>'
                            ><?php $oFiArt =  FicheArticleManager::getFicheArticleById($oRef->fiart_id);
                                                  echo $oFiArt->fiart_lbl; ?>
                        </td>
                        <td class="colData"><?php echo $oRef->ref_mrq;  ?></td>
                        <td class="colData"><?php echo $oRef->ref_poids_net;    ?></td>
                        <td class="colData"><?php echo $oRef->ref_emb_vlm_ctn;  ?></td>
                        <td class="colData"><?php echo 'QTE STOCK'  ?></td>
                        <td class="colData"><?php echo 'DLUO'  ?></td>
                        <td class="colData"><?php echo "Coût d'achat"  ?></td>
                        <td class="colData">
                            <?php
                                $oPve = PrixVenteManager::getCurPrixVente($oRef->ref_id);
                               
                                if($oPve === 0){
                                   $oPve = new PrixVente();
                                   $oPve->pve_ent='indéfinis';
                                   $oPve->pve_per='indéfinis';
                                }
                                echo $oPve->pve_per; ?>
                        </td>
                        <td class="colData"><?php echo 'RIEN'  ?></td>
                        <td class="colData"><?php echo 'RIEN'  ?></td>
                        <td class="colData">
                            <?php echo $oPve->pve_ent; ?>
                        </td>
                        <td class="colData"><?php echo 'RIEN'  ?></td>
                        <td class="colData"><?php echo 'RIEN'  ?></td>
                        <td class="colData"><?php $oTva   =  TvaManager::getTvaById($oRef->tva_id);
                                                  echo $oTva->tva_lbl.' '.$oTva->tva_taux; ?>
                        </td>
                        <td class="colData"><?php echo 'RIEN'  ?></td>
                        <td class="colData"><?php $oDd    =  DroitDouaneManager::getDroitDouaneById($oRef->dd_id);
                                                  echo $oDd->dd_taux.' '.$oDd->dd_lbl; ?>
                        </td>
                        <td class="colData"><?php echo $oRef->ref_emb_lbl;      ?></td>
                        <td class="colData"><?php echo $oRef->ref_st_min;       ?></td>
                        <td class="colData"><?php echo $oRef->ref_com;          ?></td>
                            <!--<img src="img/icon/read.png" onclick='location.href="index.php?action=read_ref"'</img>-->
                        <td>
                            <img src="img/icon/modify.png" 
                                  onclick='location.href="index.php?action=ref_detail&idRef="+ <?php echo $oRef->ref_id; ?>'
                             />
                        </td>
                        
                        <td>
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick='delElt(<?php echo $oRef->ref_id ?>, "idRef", "Référence", "ref_del", $tabRefs)'
                             />
                        </td>
                     </tr>

                   <?php } ?>
            </table>
             <?php
        if ($iTotal > $iNbPage) {
            // affichage des liens vers les pages
            Tool::affichePages($limite, $iNbPage, $iTotal, $sAction);
        }
        ?>
          <?php }?>
        
    </div>
       
          
    
    
    
<?php
} else {
    echo 'Le silence est d\'or';
}
?>