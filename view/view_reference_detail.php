<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0){ ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet" >
     <link type="text/css" href="css/style_list.css" rel="stylesheet" >
    <script type="text/javascript" src="js/js_reference.js"></script>
    
    <div class="corps">

        <form class ="form" id='ref_detail' method="POST" enctype="multipart/form-data" >
            <div class=" haut"> 

                <label for="ficheArticle">Fiche article associée : </label>
                <br>
                <input  name="ficheArticle" 
                        type="text"
                        size="15"
                        <?php
                            foreach ($toFiArts as $oFiArt) {
                                if ($oFiArt->fiart_id === $rsRef->fiart_id) {?>
                                    value="<?php echo 'Id :' 
                                    . $oFiArt->fiart_id . ' | ' . $oFiArt->fiart_lbl; ?> "
                           <?php } } ?> 
                        readonly>                   
            </div>


            <div class="col30"> 
                
                <label for="refCode">Code de la référence : </label><br>    
                <input id="refCode" 
                       name="refCode" 
                       type="text"
                       autocomplete="off"  
                       value="<?php echo $rsRef->ref_code; ?>"
                       readonly>
                <br>
                <label for="refLbl"> Libellé: </label><br>          
                <input name="refLbl" type="text" 
                       value="<?php echo $rsRef->ref_lbl; ?>"
                       readonly>
                <br>
                <label for="refMrq"> Marque: </label><br>          
                <input name="refMrq" type="text" 
                       value="<?php echo $rsRef->ref_mrq; ?>"
                       readonly>
                <br>
                <label for="refStMin"> Stock minimum: </label><br>
                <input name="refStMin" type="text" 
                       value="<?php echo $rsRef->ref_st_min; ?>"
                       readonly>         
                <br>
                <label for="refPoidsBrut"> Poids brut: </label><br>
                <input name="refPoidsBrut"  type="text" 
                       value="<?php echo $rsRef->ref_poids_brut; ?>"
                       readonly>         
                <br>
                <label for="refPoidsNet"> Poids net: </label><br>
                <input name="refPoidsNet"  type="text" 
                       value="<?php echo $rsRef->ref_poids_net; ?>"
                       readonly>         
                <br>
                <label for="modeConservation"> Mode de conservation </label><br>
                <input name="modeConservation" type="text" 
                           <?php foreach ($toModCons as $oModCons) {
                                     if ($oModCons->cons_id === $rsRef->cons_id) { ?>
                                       value='<?php echo $oModCons->cons_lbl; ?>'
                               <?php }
                            }?>
                       readonly>
                        <br>
                <label for="dureeConservation"> Durée de conservation </label><br>
                <input name="dureeConservation" 
                       type="text" 
                            <?php
                                foreach ($toDurCons as $oDurCons) {
                                    if($oDurCons->dc_id === $rsRef->dc_id) {?>
                                    value=" <?php echo $oDurCons->dc_nb.' | '.$oDurCons->dc_lbl; ?> "    
                                  <?php }
                               } ?>
                       readonly>
                        <br>
                    </div>

                    <div class="col30">
                        <label for="refEmbLbl">Description de l'emballage :</label><br>
                        <input name="refEmbLbl"  
                               type="text" 
                               value="<?php echo $rsRef->ref_emb_lbl; ?>"
                               readonly>         
                        <br>
                        <label for="refEmbCouleur" >Couleur : </label><br>
                        <input name="refEmbCouleur" 
                               type="text" 
                               value="<?php echo $rsRef->ref_emb_couleur; ?>"
                               readonly>         
                        <br> 
                        <label for="refEmbVlmCtn">Volume net:</label><br>
                        <input name="refEmbVlmCtn" 
                               type="text" 
                               value="<?php echo $rsRef->ref_emb_vlm_ctn; ?>"
                               readonly>         
                        <br>
                        <label for="refEmbDimLng">Longueur : </label><br>
                        <input name="refEmbDimLng" 
                               type="text" 
                               value="<?php echo $rsRef->ref_emb_dim_lng; ?>"
                               readonly>         
                        <br>
                        <label for="refEmbDimLrg">Largeur : </label><br>
                        <input name="refEmbDimLrg" 
                               type="text" 
                               value="<?php echo $rsRef->ref_emb_dim_lrg; ?>"
                               readonly>         
                        <br>
                        <label for="refEmbDimHt">Hauteur : </label><br>
                        <input name="refEmbDimHt" 
                               type="text" 
                               value="<?php echo $rsRef->ref_emb_dim_ht; ?>"
                               readonly> 
                        <br>
                        <label for="refEmbDimDiam">Diamètre : </label><br>
                        <input name="refEmbDimDiam" 
                               type="text" 
                               value="<?php echo $rsRef->ref_emb_dim_diam; ?>"
                               readonly>         
                        <br>

                    </div>

                    <div class="col30">
                        <label for="refCodeDouane"> Code douane: </label>
                        <br>
                        <input name="refCodeDouane" 
                               type="text"
                               placeholder="Code douane" 
                               title="3 caractères minimum"
                               pattern=".{3,}"
                               value="<?php echo $rsRef->ref_code_douane;?>"
                               readonly>
                        <br>
                        <label for="pvePer"> Prix de vente particulier: </label>
                        <br>
                        <input name="pvePer"  
                               type="text" 
                               value='<?php echo $oPve->pve_per; ?>'
                               readonly>         
                        <br>
                        <label for="pveEnt"> Prix de vente entreprise: </label>
                        <br>
                        <input name="pveEnt" 
                               type="text" 
                               value='<?php echo $oPve->pve_ent; ?>'
                               readonly>         
                        <br>
                        <label for="tva"> Taux de TVA: </label>
                        <br>
                        <input name="tva" 
                               type="text"
                               size="20"
                            <?php
                                foreach ($toTvas as $oTva) {
                                    if ($oTva->tva_id === $rsRef->tva_id) {?>
                                    value ="<?php echo $oTva->tva_lbl.' '.$oTva->tva_taux.'%'; ?>"
                                <?php }
                                }?>
                               readonly>           
                        <br>
                        <label for="droitDouane"> Droit de douanes: </label>
                        <br>
                        <input name="droitDouane" 
                               type="text"
                        <?php
                            if (isset($toDroitDouanes) && is_array($toDroitDouanes)) {
                                foreach ($toDroitDouanes as $oDroitDouane) {
                                    if ($oDroitDouane->dd_id === $rsRef->dd_id) { ?>
                                        value="<?php echo $oDroitDouane->dd_lbl 
                                              . ' ' . $oDroitDouane->dd_taux.'%' ;?>"
                              <?php } 
                                }
                            }?>
                                readonly>    
                        <br>
                        <label for="refCom"> Commentaire : </label>
                        <br>
                        <textarea name="refCom" 
                                  rows="4" 
                                  cols="25"
                                  readonly
                                  ><?php echo $rsRef->ref_com; ?></textarea>
                        <div class="imgList">
                            <table>
                                <?php
                                if ($rsRef->ref_photos != '') {
                                    $tabPhoto = explode(',', $rsRef->ref_photos);
                                    foreach ($tabPhoto as $image) {
                                        if ($image != '') {
                                            ?>
                                            <tr>
                                                <td> <input type="radio" 
                                                            name="refPhotosPref" 
                                                            value="<?php echo $image ?>"
                                                            <?php if ($image == $rsRef->ref_photos_pref) 
                                                            {echo ' checked ';}?>
                                                            readonly></td>
                                                <td><img src="<?php echo $imgMiniPath . $image . '_lbl.jpg';?>" 
                                                         alt=""/></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col90" id='tableLot'>
                     <?php if (is_array($toLots)){?>
                        <table class="tableList">
                            <tr>
                                <th class='colTitle'>
                                    N°Lot</th>
                                <th class='colTitle'>
                                    DLC/DLUO</th>
                                <th class='colTitle'>
                                    QTE STOCK</th>
                                <th class='colTitle'>
                                    QTE INITIAL</th>
                            </tr>
                            
                                
                              <?php foreach($toLots as $oLot){?>
                            <tr>
                                          <td class='colData'>
                                              <?php echo $oLot->lot_id ?>
                                          </td>
                                          <?php list($year, $month, $day) = explode("-", $oLot->lot_dlc);?>
                                          <td class='colData'>
                                              <?php echo $day.'/'.$month.'/'.$year ?>
                                          </td>
                                          <td class='colData'>
                                              <?php echo $oLot->lot_qt_stock ?>
                                          </td>
                                          <td class='colData'>
                                              <?php echo $oLot->lot_qt_init ?>
                                          </td>
                            </tr>
                              <?php } ?>
                            
                        </table>
                     <?php } else{ ?>
                        <span>Aucun lot associé à cette référence</span>
                     <?php } ?>  
                    </div>
                    <div class="bas">
                        <input name='retour'  
                               type="button" 
                               value='Retour' 
                               onclick='location.href = "index.php?action=ref_list";'/> 
                        <input name="action"  
                               value="<?php echo $sAction; ?>"
                               type="text"
                               hidden/>
                        <input name="idRef" id="refId"  
                               type='text'
                               value="<?php echo $rsRef->ref_id; ?>"
                               hidden>
                        
                        
                    </div>
                   
                </form>
            </div>
   

            <?php
        }else{ 
            echo 'Le silence est d\'or';
        }

