<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
    <script type="text/javascript" src="js/js_function.js"></script>
    <script type="text/javascript" src="js/js_reference.js"></script>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    
    <div class="corps">

        <form class ="form" method="POST" enctype="multipart/form-data">
            <div class=" haut"> 
                
                <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
                <label for="ficheArticle"> Associée fiche article: </label>
                <select id="ficheArticle" name="ficheArticle" title="Choisir un élément"
                        required onchange="changeRefCodeAtTime();">
                    <option value="" selected>Aucun</option>
                    
                   <?php if (isset($toFiArts) && is_array($toFiArts)){ 
                        foreach($toFiArts as $oFiArt) { ?>
                        <option value=<?php echo $oFiArt->fiart_id ?>>
                   <?php echo 'Id :'.$oFiArt->fiart_id.' '.$oFiArt->fiart_lbl ?>
                        </option>
                   <?php }
                   
                   } ?>
                </select>
                
                    <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_fiche_article.php');"/>
               
            </div>


            <div class="col30"> 
                <input id="pays_abv" name="pays_abv" type="text"  hidden/>
                <input id="ga_abv" name="ga_abv" type="text"  hidden/>
                <label for="refCode">Code référence: </label> 
                <input id="refCode" name="refCode"
                       type="text" 
                       placeholder="Code de la référence"
                       required  
                       pattern=".{6,}" 
                       autocomplete="off" 
                       onkeyup="getLastRefCode();"
                      
                       onfocus="getLastRefCode();"  
                                
                       onblur="$('#divSuggest').hide();
                                confirmRefCode();" 
                       title="6 caractères Minimum Chiffres/Lettres" />
                
                 <img id="refCodVld" 
                      src="img/icon/accept.png" 
                      alt="" 
                      title="Code référence Valide" 
                      hidden />
                 <img id="refCodInvld" 
                      src="img/icon/delete.png" 
                      alt="" 
                      title="Code référence Non Valide" 
                      hidden />
                <div id="divSuggest" style="display:none">
                    <span id="resSugg"></span>
                </div>
                
                <label for="refLbl"> Libellé: </label>    
                <input name="refLbl" 
                       type="text"
                       placeholder="Nom de la référence" 
                       title="3 caractères minimum"
                       pattern=".{3,}"
                       required>
              
                <label for="refMrq"> Marque: </label>
                      
                <input name="refMrq"
                       type="text" 
                       placeholder="Marque de la référence">
              
                <label for="refStMin"> Stock minimum: </label>
                
                <input name="refStMin" 
                       placeholder="###,##"
                       type="text">         
               
                <label for="refPoidsBrut"> Poids brut: </label>
               
                <input name="refPoidsBrut"
                       placeholder="gramme ### ###,##" 
                       type="text">         
               
                <label for="refPoidsNet"> Poids net : </label>
                
                <input name="refPoidsNet" 
                       placeholder="gramme ### ###,##" 
                       type="text">             
               
                <label for="modeConservation"> Mode de conservation: </label>
               
                <select name="modeConservation" 
                        id="modeConservation" 
                        title="Choisir un élément" 
                        >
                    <option value="" 
                            selected>Aucun</option>
                    
                    <?php
                    if (isset($toModCons) && is_array($toModCons)){
                    foreach($toModCons as $oModCons) { ?>
                        <option value="<?php echo $oModCons->cons_id ?>"> <?php echo $oModCons->cons_lbl ?> </option>
                    <?php }
                    
                    }?>
                        
                </select>
                <img src="img/icon/add.png" 
                     alt="" title="Créer" 
                     onClick="popup('mc_add');"/>
               
                <label for="dureeConservation"> Durée de conservation: </label>
                
                <select name="dureeConservation" 
                        title="Choisir un élément" >
                    <option value="" selected>Aucun</option>
                    
                    <?php
                    if (isset($toDurCons) && is_array($toDurCons)){
                        foreach($toDurCons as $oDurCons) { 
                            if(!empty($oDurCons->dc_lbl) && $oDurCons->dc_lbl !== '') {?>
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
                <img src="img/icon/add.png" 
                     alt="" 
                     title="Créer" 
                     onClick="popup('dc_add');" />
               
            </div>

            <div class="col30">
                <label for="refEmbLbl">Description emballage:</label>
               
                <input name="refEmbLbl" 
                       placeholder="Description" 
                       type="text">         
               
                <label for="refEmbCouleur" >Couleur:</label>
               
                <input name="refEmbCouleur" 
                       placeholder="Couleur" 
                       type="text">         
                
                <label for="refEmbVlmCtn">Volume net:</label>
               
                <input name="refEmbVlmCtn"
                       placeholder="###,### EN LITRE" 
                       type="text">         
                
                <label for="refEmbDimLng">Longueur:</label>
               
                <input name="refEmbDimLng" 
                       placeholder="###,##" 
                       type="text">         
               
                <label for="refEmbDimLrg">Largeur:</label>
                
                <input name="refEmbDimLrg" 
                       placeholder="###,##" 
                       type="text">         
               
                <label for="refEmbDimHt">Hauteur:</label>
                <br>
                <input name="refEmbDimHt" 
                       placeholder="###,##" 
                       type="text"> 
                
                <label for="refEmbDimDiam">Diamètre:</label>
                
                <input name="refEmbDimDiam" 
                       placeholder="###,##" 
                       type="text">         
                

            </div>

            <div class="col30">
                <label for="refCodeDouane">Code douane:</label>
                
                <input name="refCodeDouane" 
                       type="text"
                       placeholder="Code douane" 
                       title="3 caractères minimum"
                       pattern=".{3,}"
                       >
                
                <label for="pvePer">Prix de vente particulier:</label>
               
                <input name="pvePer" 
                       placeholder="### ###,##" 
                       type="text">         
               
                <label for="pveEnt">Prix de vente entreprise:</label>
             
                <input name="pveEnt" 
                       placeholder="### ###,##"
                       type="text">         
             
                <label for="tva">Taux de TVA:</label>
            
                <select name="tva" 
                        title="Choisir un élément"
                        required>
                   <option value="" 
                           selected>Aucun</option>
                    
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
                <img src="img/icon/add.png" 
                     alt="" 
                     title="Créer" 
                     onClick="popup('tva_add');" />

            
                <label for="droitDouane"> Droit de douanes: </label>
                <select name="droitDouane" 
                        title="Choisir un élément" 
                        >
                    
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
                <img src="img/icon/add.png" 
                     alt="" 
                     title="Créer" 
                     onClick="popup('dd_add');"/>
              
                <label for="refCom"> Commentaire: </label><br>
                <textarea name="refCom" 
                          rows="4" 
                          cols="25" 
                          placeholder="Commentaire sur la référence" ></textarea>
               
                     <div class='impImg'>
                        <fieldset><legend>Image</legend>                           

                            <label for="img_upload[]">
                                Image(<?php echo $imgExtension ?>|max<?php echo $imgMaxSize / 1000 ?>Ko):
                            </label>
                               
                            <input type="hidden" 
                                   name="MAX_FILE_SIZE" 
                                   value="<?php echo $imgMaxSize ?>" />
                              

                            <input type="file" 
                                   name="img_upload[]"  
                                   id="img_upload" multiple=""/>


                        </fieldset>
                    </div>
            </div>
          
            
            <div class="bas">
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>"/>
            <input id ='clearForm' 
                   name="clear"   
                   type="reset"/> 
            <input name="action"  
                   value="<?php echo $sAction ?>" 
                   type="text" 
                   hidden/>
            <inut name="refPhoto" 
                  value="rien" 
                  id="action" 
                  type="text" 
                  hidden/>
            </div>
    </form>
 </div>
    <?php
} else {
    echo 'Le silence est d\'or';
}
