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
                        <option value=<?php echo $oFiArt->fiart_id ?>> <?php echo 'Id :'.$oFiArt->fiart_id.' '.$oFiArt->fiart_lbl ?> </option>
                   <?php }
                   
                   } ?>
                </select>
                <a href="" onClick="popup('view_fiche_article.php');">
                    <img src="img/icon/add.png" alt="" title="Créer"/>
                </a>
            </div>


            <div class="col30"> 

                <label for="refLbl"> Libellé: </label><br>          
                <input name="refLbl" type="text" placeholder="Nom de la référence" required></input>
                <br>
                <label for="refStMin"> Stock minimum: </label><br>
                <input name="refStMin" placeholder="###,##" type="text">         
                <br>
                <label for="refPoidsBrut"> Poids brut de l'article: </label><br>
                <input name="refPoidsBrut" placeholder="gramme ### ###,##" type="text">         
                <br>
                <label for="refPoidsNet"> Poids net de l'article: </label><br>
                <input name="refPoidsNet" placeholder="gramme ### ###,##" type="text">         
                <br>
                <label for="refVolume"> Volume de l'article: </label><br>
                <input name="refVolume" placeholder="litre ###,###" type="text">         
                <br>
                <label for="modeConservation"> Mode de conservation </label><br>
                <select name="modeConservation" title="Choisir un élément" required>
                    <option value="" selected>Aucun</option>
                    
                    <?php
                    if (isset($toModCons) && is_array($toModCons)){
                    foreach($toModCons as $oModCons) { ?>
                        <option value="<?php echo $oModCons->CONS_ID ?>"> <?php echo $oModCons->CONS_LBL ?> </option>
                    <?php }
                    
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
                            if(!empty($oDurCons->DC_LBL) && $oDurCons->DC_LBL !== '') {?>
                            <option value=<?php echo $oDurCons->DC_ID ?>>
                             <?php echo $oDurCons->DC_NB.' | '.$oDurCons->DC_LBL ?> </option>
                        <?php }else{ ?>
                                <option value=<?php echo $oDurCons->DC_ID ?>>
                                <?php echo $oDurCons->DC_NB.' | '.$oDurCons->DC_LBL ?> </option>
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
                    <?php if(!empty($oTva->TVA_LBL) && $oTva->TVA_LBL !== '') { ?>
                            <option value=<?php echo $oTva->TVA_ID ?>>
                      <?php echo $oTva->TVA_LBL.' | '.$oTva->TVA_TAUX.' %' ?> </option>
                    <?php 
                        }else { ?>
                             <option value=<?php echo $oTva->TVA_ID ?>>
                      <?php echo $oTva->TVA_LBL.''.$oTva->TVA_TAUX.' %' ?> </option>
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
                            if(!empty($oDroitDouane->DD_LBL) && $oDroitDouane->DD_LBL !== '') { ?>
                         ?>
                                <option value=<?php echo $oDroitDouane->DD_ID ?>>
                          <?php echo $oDroitDouane->DD_LBL.' | '.$oDroitDouane->DD_TAUX.' %' ?> </option>
                            
                     <?php  }else{ ?>
                         <option value=<?php echo $oDroitDouane->DD_ID ?>>
                          <?php echo $oDroitDouane->DD_LBL.''.$oDroitDouane->DD_TAUX.' %' ?> </option>
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