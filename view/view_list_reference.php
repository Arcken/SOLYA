<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
    
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <div>
            <table id="tableRef">
                <tr>
                    <th class="colTitle">Image</th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_code');">Code référence</th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_lbl');">Libéllé </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','dc_id');">Durée conservation </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','cons_id');">Mode de conservation </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','fiart_id');">Fiche article associé </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','dd_id');">Droit de douane </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','tva_id');">TVA</th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_st_min');">Stock Minimum </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_poids_brut');">Poids brut</th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_poids_net');">Poids net</th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_emb_vlm_ctn');">Volume contenu </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_emb_lbl');">Libéllé de l'emballage</th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_emb_couleur');">Couleur de l'emballage</th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_emb_dim_lng');">Longueur de l'emballage </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_emb_dim_lrg');">Largeur </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_emb_dim_ht');">Hauteur </th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_emb_dim_diam');">Diamètre</th>
                    <th class="colTitle" onclick="orderby('<?php echo $sAction?>','ref_com');">Commentaire </th>
                    <th></th>
                    <th></th>
                </tr>
                  <?php if (isset($toRef)&& is_array($toRef)) {
                         foreach($toRef as $oRef){ ?> 
                     <tr>
                        <td class="colData"><?php if($oRef->ref_photos_pref!=''){ ?>
                        <img src="<?php echo $imgMiniPath.$oRef->ref_photos_pref.'_lbl.jpg'; ?>" onclick ='location.href="index.php?action=ref_detail&idRef="+ <?php echo $oRef->ref_id; ?>';
                        
                        <?php }else{
                            echo 'Aucune photos définis';
                        }?>
                                    </td>
                        <td class="colData"><?php echo $oRef->ref_code; ?></td>
                        <td class="colData"><?php echo $oRef->ref_lbl; ?></td>
                        <td class="colData"><?php $oDc = DureeConservationManager::getDureeConservationById($oRef->dc_id); 
                                                  echo $oDc->dc_nb.' '.$oDc->dc_lbl; ?></td>
                        <td class="colData"><?php if(isset($oRef->cons_id) && $oRef->cons_id !=''){ $oMc = ModeConservationManager::getModeConservationById($oRef->cons_id);
                                                     echo $oMc->cons_lbl;
                                                  }else{
                                                     echo 'Rien';    
                                                  } ?></td>
                        <td class="colData"><?php $oFiArt=  FicheArticleManager::getFicheArticleById($oRef->fiart_id);
                                                  echo $oFiArt->fiart_lbl; ?></td>
                        <td class="colData"><?php $oDd=  DroitDouaneManager::getDroitDouaneById($oRef->dd_id);
                                                  echo $oDd->dd_taux.' '.$oDd->dd_lbl; ?></td>
                        <td class="colData"><?php $oTva=  TvaManager::getTvaById($oRef->tva_id);
                                                  echo $oTva->tva_lbl.' '.$oTva->tva_taux; ?></td>
                        <td class="colData"><?php echo $oRef->ref_st_min; ?></td>
                        <td class="colData"><?php echo $oRef->ref_poids_brut; ?></td>
                        <td class="colData"><?php echo $oRef->ref_poids_net; ?></td>
                        <td class="colData"><?php echo $oRef->ref_emb_vlm_ctn; ?></td>
                        <td class="colData"><?php echo $oRef->ref_emb_lbl; ?></td>
                        <td class="colData"><?php echo $oRef->ref_emb_couleur; ?></td>
                        <td class="colData"><?php echo $oRef->ref_emb_dim_lng; ?></td>
                        <td class="colData"><?php echo $oRef->ref_emb_dim_lrg; ?></td>
                        <td class="colData"><?php echo $oRef->ref_emb_dim_ht; ?></td>
                        <td class="colData"><?php echo $oRef->ref_emb_dim_diam; ?></td>
                        <td class="colData"><?php echo $oRef->ref_com; ?></td>
                            <!--<img src="img/icon/read.png" onclick='location.href="index.php?action=read_ref"'</img>-->
                        <td> <img src="img/icon/modify.png" onclick='location.href="index.php?action=ref_detail&idRef="+ <?php echo $oRef->ref_id; ?>'</img>
                        </td>
                        <td><img src="img/icon/delete.png" alt="" title="Supprimer"
                             onclick='delElt(<?php echo $oRef->ref_id ?>, "refId", "Référence", "ref_del")'/></td>
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