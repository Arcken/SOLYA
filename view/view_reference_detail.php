<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0){ ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet" >
     <link type="text/css" href="css/style_list.css" rel="stylesheet" >
    <script type="text/javascript" src="js/js_reference.js"></script>
    
    <div class="corps">

        <form class ="form" id='ref_detail' method="POST" enctype="multipart/form-data" >
            <div class=" haut"> 

                <label for="ficheArticle">Fiche article associée: </label>
                
                <input  name="ficheArticle" 
                        type="text"
                        size="15"
                        value="<?php echo 'Id :' 
                               . $oFiArt->fiart_id . ' | ' . $oFiArt->fiart_lbl; ?> "
                        readonly>                   
            </div>


            <div class="col30"> 
                
                <label for="refCode">Code de la référence: </label>    
                <input id="refCode" 
                       name="refCode" 
                       type="text"
                       autocomplete="off"  
                       value="<?php echo $oRef->ref_code; ?>"
                       readonly>
                
                <label for="refLbl"> Libellé: </label>          
                <input name="refLbl" type="text" 
                       value="<?php echo $oRef->ref_lbl; ?>"
                       readonly>
                
                <label for="refMrq"> Marque: </label>          
                <input name="refMrq" type="text" 
                       value="<?php echo $oRef->ref_mrq; ?>"
                       readonly>
                
                <label for="refStMin"> Stock minimum: </label>
                <input name="refStMin" type="text" 
                       value="<?php echo $oRef->ref_st_min; ?>"
                       readonly>         
                
                <label for="refPoidsBrut"> Poids brut: </label>
                <input name="refPoidsBrut"  type="text" 
                       value="<?php echo $oRef->ref_poids_brut; ?>"
                       readonly>         
                
                <label for="refPoidsNet"> Poids net: </label>
                <input name="refPoidsNet"  type="text" 
                       value="<?php echo $oRef->ref_poids_net; ?>"
                       readonly>         
                
                <label for="modeConservation"> Mode de conservation:</label>
                <textarea name="modeConservation" 
                          type="text" 
                          rows="4" 
                          cols="25"
                          readonly><?php echo $oModCons->cons_lbl;?></textarea>
                        
                <label for="dureeConservation"> Durée de conservation:</label>
                <input name="dureeConservation" 
                       type="text" 
                       value=" <?php echo $oDurCons->dc_nb.' | '.$oDurCons->dc_lbl; ?> "  
                       readonly>
                        
                    </div>

                    <div class="col30">
                        <label for="refEmbLbl">Description de l'emballage:</label>
                        <input name="refEmbLbl"  
                               type="text" 
                               value="<?php echo $oRef->ref_emb_lbl; ?>"
                               readonly>         
                        
                        <label for="refEmbCouleur" >Couleur: </label>
                        <input name="refEmbCouleur" 
                               type="text" 
                               value="<?php echo $oRef->ref_emb_couleur; ?>"
                               readonly>         
                         
                        <label for="refEmbVlmCtn">Volume net:</label>
                        <input name="refEmbVlmCtn" 
                               type="text" 
                               value="<?php echo $oRef->ref_emb_vlm_ctn; ?>"
                               readonly>         
                        
                        <label for="refEmbDimLng">Longueur: </label>
                        <input name="refEmbDimLng" 
                               type="text" 
                               value="<?php echo $oRef->ref_emb_dim_lng; ?>"
                               readonly>         
                        
                        <label for="refEmbDimLrg">Largeur: </label>
                        <input name="refEmbDimLrg" 
                               type="text" 
                               value="<?php echo $oRef->ref_emb_dim_lrg; ?>"
                               readonly>         
                        
                        <label for="refEmbDimHt">Hauteur: </label>
                        <input name="refEmbDimHt" 
                               type="text" 
                               value="<?php echo $oRef->ref_emb_dim_ht; ?>"
                               readonly> 
                        
                        <label for="refEmbDimDiam">Diamètre: </label>
                        <input name="refEmbDimDiam" 
                               type="text" 
                               value="<?php echo $oRef->ref_emb_dim_diam; ?>"
                               readonly>         
                        

                    </div>

                    <div class="col30">
                        <label for="refCodeDouane"> Code douane: </label>
                        
                        <input name="refCodeDouane" 
                               type="text"
                               placeholder="Code douane" 
                               title="3 caractères minimum"
                               pattern=".{3,}"
                               value="<?php echo $oRef->ref_code_douane;?>"
                               readonly>
                        
                        <label for="pvePer"> Prix de vente particulier: </label>
                        
                        <input name="pvePer"  
                               type="text" 
                               value='<?php echo $oPve->pve_per; ?>'
                               readonly>         
                        
                        <label for="pveEnt"> Prix de vente entreprise: </label>
                        
                        <input name="pveEnt" 
                               type="text" 
                               value='<?php echo $oPve->pve_ent; ?>'
                               readonly>         
                        
                        <label for="tva"> Taux de TVA: </label>
                        
                        <input name="tva" 
                               type="text"
                               size="20"
                               value ="<?php echo $oTva->tva_lbl.' '.$oTva->tva_taux.'%'; ?>"
                               readonly>           
                        
                        <label for="droitDouane"> Droit de douanes: </label>
                        
                        <input name="droitDouane" 
                               type="text"
                               value="<?php echo $oDroitDouane->dd_lbl 
                                           . ' ' . $oDroitDouane->dd_taux.'%' ;?>"
                         
                                readonly>    
                        
                        <label for="refCom"> Commentaire: </label>
                        
                        <textarea name="refCom" 
                                  rows="4" 
                                  cols="25"
                                  readonly
                                  ><?php echo $oRef->ref_com; ?></textarea>
                        <div class="imgList">
                            <table>
                                <?php
                                if ($oRef->ref_photos != '') {
                                    $tabPhoto = explode(',', $oRef->ref_photos);
                                    foreach ($tabPhoto as $image) {
                                        if ($image != '') {
                                            ?>
                                            <tr>
                                                <td> <input type="radio" 
                                                            name="refPhotosPref" 
                                                            value="<?php echo $image ?>"
                                                            <?php if ($image == $oRef->ref_photos_pref) 
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
                               value="<?php echo $oRef->ref_id; ?>"
                               hidden>
                        
                        
                    </div>
                   
                </form>
            </div>
   

            <?php
        }else{ 
            echo 'Le silence est d\'or';
        }

