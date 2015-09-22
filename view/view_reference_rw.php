<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">

        <form class ="form">
            <div class=" haut"> 
                
                <label for="ficheArticle"> Associée fiche article: </label><br>
                <select  name="ficheArticle" title="Choisir un élément" required>
                    <option value="">Aucun</option>
                    
              <?php if (isset($toFiArts) && is_array($toFiArts)){ 
                        foreach($toFiArts as $oFiArt) { ?>
                    
                    <?php if ($oFiArt->fiart_id === $oRef->fiart_id) {?>
                            <option value="<?php echo $oFiArt->fiart_id ?>" selected>
                            <?php echo 'Id :'.$oFiArt->fiart_id.' | '.$oFiArt->fiart_lbl ?> </option>
                            
                    <?php }else{?>
                            <option value="<?php echo $oFiArt->fiart_id ?>">
                            <?php echo 'Id :'.$oFiArt->fiart_id.' | '.$oFiArt->fiart_lbl ?> </option>
                            
                    <?php }
                    
                        }
                   
                   } ?>
                </select>
                <a href="" onClick="popup('view_fiche_article.php');">
                    <img src="img/icon/add.png" alt="" title="Créer"/>
                </a>
            </div>


            <div class="col30"> 

                <label for="refLbl"> Libellé: </label><br>          
                <input name="refLbl" type="text" placeholder="Nom de la référence" required value="<?php echo $oRef->ref_lbl; ?>"></input>
                <br>
                <label for="refStMin"> Stock minimum: </label><br>
                <input name="refStMin" placeholder="###,##" type="text" value="<?php echo $oRef->ref_st_min; ?>"></input>         
                <br>
                <label for="refPoidsBrut"> Poids brut de l'article: </label><br>
                <input name="refPoidsBrut" placeholder="gramme ### ###,##" type="text" value="<?php echo $oRef->ref_poids_brut; ?>">         
                <br>
                <label for="refPoidsNet"> Poids net de l'article: </label><br>
                <input name="refPoidsNet" placeholder="gramme ### ###,##" type="text" value="<?php echo $oRef->ref_poids_net; ?>">         
                <br>
                <label for="refVolume"> Volume de l'article: </label><br>
                <input name="refVolume" placeholder="litre ###,###" type="text" >         
                <br>
                <label for="modeConservation"> Mode de conservation </label><br>
                <select name="modeConservation" title="Choisir un élément" required>
                    <option value="" selected>Aucun</option>
                    
                    <?php
                    if (isset($toModCons) && is_array($toModCons)){
                        foreach($toModCons as $oModCons) { ?>

                               <?php if ($oModCons->cons_id === $oRef->cons_id) {?>
                                <option value="<?php echo $oModCons->cons_id;?>" selected>
                                <?php echo 'Id :'.$oModCons->cons_id.' | '.$oModCons->cons_lbl ?> </option>

                        <?php }else{?>
                                <option value="<?php  echo $oModCons->cons_id ?>">
                                <?php echo 'Id :'. $oModCons->cons_id.' | '.$oModCons->cons_lbl ?> </option>

                        <?php }

                        }
                    
                    }?>
                        
                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_mode_conservation.php');"/>
                <br>
                <label for="dureeConservation"> Durée de conservation </label><br>
                <select name="dureeConservation" title="Choisir un élément" required>
                    <option value="" selected>Aucun</option>
                    
                    <?php
                    if (isset($toDurCons) && is_array($toDurCons)){
                        foreach($toDurCons as $oDurCons) { 
                            if(!empty($oDurCons->Ddc_lbl) && $oDurCons->dc_lbl !== '') {?>
                                <option value=<?php echo $oDurCons->dc_id ?>>
                                <?php echo $oDurCons->dc_nb.' | '.$oDurCons->dc_lbl ?> </option>
                        <?php }else{ ?>
                                <option value=<?php echo $oDurCons->dc_id ?>>
                                <?php echo $oDurCons->dc_nb.' | '.$oDurCons->dc_lbl ?> </option>
                        <?php }
                        }
                    }
                    ?>
                        
                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_duree_conservation.php');" />
                <br>
            </div>

            <div class="col30">
                <label for="refEmbLbl">Description de l'emballage :</label><br>
                <input name="refEmbLbl" placeholder="Pot en verre 250gr" type="text">         
                <br>
                <label for="refEmbCouleur" >Couleur : </label><br>
                <input name="refEmbCouleur" placeholder="Rouge !" type="text">         
                <br> 
                <label for="refEmbVlmCtn">Volume de produit contenu:</label><br>
                <input name="refEmbVlmCtn" placeholder="###,### EN LITRE" type="text">         
                <br>
                <label for="refEmbDimLng">Longueur : </label><br>
                <input name="refEmbDimLng" placeholder="###,##" type="text">         
                <br>
                <label for="refEmbDimLrg">Largeur : </label><br>
                <input name="refEmbDimLrg" placeholder="###,##" type="text">         
                <br>
                <label for="refEmbDimHt">Hauteur : </label><br>
                <input name="refEmbDimHt" placeholder="###,##" type="text"> 
                <br>
                <label for="refEmbDimDiam">Diamètre : </label><br>
                <input name="refEmbDimDiam" placeholder="###,##" type="text">         
                <br>

            </div>

            <div class="col30">

                <label for="pvePer"> Prix de vente particulier: </label><br>
                <input name="pvePer" placeholder="### ###,##" type="text">         
                <br>
                <label for="pveEnt"> Prix de vente entreprise: </label><br>
                <input name="pveEnt" placeholder="### ###,##" type="text">         
                <br>
                <label for="tva"> Taux de TVA: </label><br>
                <select name="tva" title="Choisir un élément" required>
                   <option value="" selected>Aucun</option>
                    
                    <?php
                    if (isset($toTvas) && is_array($toTvas)){
                    foreach($toTvas as $oTva) { ?>
                    <?php if(!empty($oTva->tva_lbl) && $oTva->tva_lbl !== '') { ?>
                            <option value=<?php echo $oTva->tva_id ?>>
                      <?php echo $oTva->tva_lbl.' | '.$oTva->tva_taux.' %' ?> </option>
                    <?php 
                        }else { ?>
                             <option value=<?php echo $oTva->tva_id ?>>
                      <?php echo $oTva->tva_lbl.''.$oTva->tva_taux.' %' ?> </option>
                  <?php }
                    }
                    
                    }?>
                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_tva.php');" />

                <br>
                <label for="droitDouane"> Droit de douanes: </label><br>
                <select name="droitDouane" title="Choisir un élément" required>
                    
                     <option value="" selected>Aucun</option>
                     
                    <?php 
                     if (isset($toDroitDouanes) && is_array($toDroitDouanes)){
                        foreach($toDroitDouanes as $oDroitDouane) {
                            if(!empty($oDroitDouane->dd_lbl) && $oDroitDouane->dd_lbl !== '') { ?>
                         ?>
                                <option value=<?php echo $oDroitDouane->dd_id ?>>
                          <?php echo $oDroitDouane->dd_lbl.' | '.$oDroitDouane->dd_taux.' %' ?> </option>
                            
                     <?php  }else{ ?>
                         <option value=<?php echo $oDroitDouane->dd_id ?>>
                          <?php echo $oDroitDouane->dd_lbl.''.$oDroitDouane->dd_taux.' %' ?> </option>
                          <?php 
                            }
                        }
                    }?>
                         
                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_droit_douane.php');"/>
            </div>
            
            <div class="col30">
                <label for="refCom"> Commentaire : </label><br>
                <textarea name="refCom" rows="4" cols="25" placeholder="Commentaire sur la référence" ></textarea>
                <br>
                <label for="dtlsTechs"> Détails techniques : </label><br>
                <textarea name="dtlsTechs" rows="4" cols="25" placeholder="Détails techniques" ></textarea>
            </div>
            <div class="bas">
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>"/>
            <input id ='clearForm' name="clear"   type="reset" onclick="formChooser()"/> 
            <input name="action"  value="<?php echo $sAction ?>" type="text" hidden/>
            </div>
   
    </form>
 </div>
    <?php
} else {
    echo 'Le silence est d\'or';
}
?>