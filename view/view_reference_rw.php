<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <script type="text/javascript" src="js/refFct.js"></script>

    <div class="corps">

        <form class ="form" id='ref_detail' method="POST" enctype="multipart/form-data">
            <div class=" haut"> 

                <label for="ficheArticle"> Associée fiche article: </label><br>
                <select  name="ficheArticle" title="Choisir un élément" required 
                         onchange="changeRefCodeAtTime()">
                    <option value="">Aucun</option>

                    <?php
                    if (isset($toFiArts) && is_array($toFiArts)) {
                        foreach ($toFiArts as $oFiArt) {

                            if ($oFiArt->fiart_id === $rsRef->fiart_id) {
                                ?>
                                <option value="<?php echo $oFiArt->fiart_id ?>" selected>
                                    <?php echo 'Id :' . $oFiArt->fiart_id . ' | ' . $oFiArt->fiart_lbl ?> </option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $oFiArt->fiart_id ?>">
                                    <?php echo 'Id :' . $oFiArt->fiart_id . ' | ' . $oFiArt->fiart_lbl ?> </option>

                                <?php
                            }
                        }
                    }
                    ?>
                </select>
                <a href="" onClick="popup('view_fiche_article.php');">
                    <img src="img/icon/add.png" alt="" title="Créer"/>
                </a>
            </div>


            <div class="col30"> 
               <input id="pays_abv" name="pays_abv" type="text" hidden>
               <input id="ga_abv" name="ga_abv" type="text" hidden>
               <label for="refCode">Code de la référence : </label><br>    
               <input id="refCode" name="refCode" type="text" placeholder="Code de la référence"
                       required autocomplete="off" onkeyup="getLastRefCode()" 
                       onfocus="getLastRefCode()" onblur="$('#divSuggest').hide()"
                       title="7 caractères Minimum (Chiffres/Lettres)" 
                       pattern=".{7,}" value="<?php echo $rsRef->ref_code; ?>">
                <br>
                <div id="divSuggest" style="display:none">
                </div>
                <label for="refLbl"> Libellé: </label><br>          
                <input name="refLbl" type="text" placeholder="Nom de la référence" 
                       title="3 caractères minimum" pattern=".{3,}" required 
                       value="<?php echo $rsRef->ref_lbl; ?>">
                <br>
                <label for="refMrq"> Marque: </label><br>          
                <input name="refMrq" type="text" placeholder="Marque de la référence" value="<?php echo $rsRef->ref_mrq; ?>">
                <br>
                <label for="refStMin"> Stock minimum: </label><br>
                <input name="refStMin" placeholder="###,##" type="text" value="<?php echo $rsRef->ref_st_min; ?>">         
                <br>
                <label for="refPoidsBrut"> Poids brut de l'article: </label><br>
                <input name="refPoidsBrut" placeholder="gramme ### ###,##" type="text" value="<?php echo $rsRef->ref_poids_brut; ?>">         
                <br>
                <label for="refPoidsNet"> Poids net de l'article: </label><br>
                <input name="refPoidsNet" placeholder="gramme ### ###,##" type="text" value="<?php echo $rsRef->ref_poids_net; ?>">         
                <br>
                <label for="modeConservation"> Mode de conservation </label><br>
                <select name="modeConservation" title="Choisir un élément" required>
                    <option value="" selected>Aucun</option>

                    <?php
                    if (isset($toModCons) && is_array($toModCons)) {
                        foreach ($toModCons as $oModCons) {
                            ?>

                            <?php if ($oModCons->cons_id === $rsRef->cons_id) { ?>
                                <option value="<?php echo $oModCons->cons_id; ?>" selected>
                                    <?php echo 'Id :' . $oModCons->cons_id . ' | ' . $oModCons->cons_lbl ?> </option>

                            <?php } else { ?>
                                <option value="<?php echo $oModCons->cons_id ?>">
                                    <?php echo 'Id :' . $oModCons->cons_id . ' | ' . $oModCons->cons_lbl ?> </option>

                                <?php
                            }
                        }
                    }
                    ?>

                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_mode_conservation.php');"/>
                <br>
                <label for="dureeConservation"> Durée de conservation </label><br>
                <select name="dureeConservation" title="Choisir un élément" required>
                    <option value="" selected>Aucun</option>

                    <?php
                    if (isset($toDurCons) && is_array($toDurCons)) {
                        foreach ($toDurCons as $oDurCons) {
                            if ($oDurCons->dc_id === $rsRef->dc_id) {

                                if (!empty($oDurCons->dc_lbl) && $oDurCons->dc_lbl !== '') {
                                    ?>
                                    <option value="<?php echo $oDurCons->dc_id ?>" selected>
                                        <?php echo $oDurCons->dc_nb . ' | ' . $oDurCons->dc_lbl ?> </option>
                                <?php } else { ?>
                                    <option value="<?php echo $oDurCons->dc_id ?>" selected>
                                        <?php echo $oDurCons->dc_nb . ' | ' . $oDurCons->dc_lbl ?> </option>
                                    <?php
                                }
                            } else {

                                if (!empty($oDurCons->dc_lbl) && $oDurCons->dc_lbl !== '') {
                                    ?>
                                    <option value="<?php echo $oDurCons->dc_id ?>">
                                        <?php echo $oDurCons->dc_nb . ' | ' . $oDurCons->dc_lbl ?> </option>
                                <?php } else { ?>
                                    <option value="<?php echo $oDurCons->dc_id ?>">
                                        <?php echo $oDurCons->dc_nb . ' | ' . $oDurCons->dc_lbl ?> </option>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>

                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_duree_conservation.php');" />
                <br>
            </div>

            <div class="col30">
                <label for="refEmbLbl">Description de l'emballage :</label><br>
                <input name="refEmbLbl" placeholder="Pot en verre 250gr" type="text" value="<?php echo $rsRef->ref_emb_lbl ?>">         
                <br>
                <label for="refEmbCouleur" >Couleur : </label><br>
                <input name="refEmbCouleur" placeholder="Rouge !" type="text" value="<?php echo $rsRef->ref_emb_couleur ?>">         
                <br> 
                <label for="refEmbVlmCtn">Volume de produit contenu:</label><br>
                <input name="refEmbVlmCtn" placeholder="###,### EN LITRE" type="text" value="<?php echo $rsRef->ref_emb_vlm_ctn ?>">         
                <br>
                <label for="refEmbDimLng">Longueur : </label><br>
                <input name="refEmbDimLng" placeholder="###,##" type="text" value="<?php echo $rsRef->ref_emb_dim_lng ?>">         
                <br>
                <label for="refEmbDimLrg">Largeur : </label><br>
                <input name="refEmbDimLrg" placeholder="###,##" type="text" value="<?php echo $rsRef->ref_emb_dim_lrg ?>">         
                <br>
                <label for="refEmbDimHt">Hauteur : </label><br>
                <input name="refEmbDimHt" placeholder="###,##" type="text" value="<?php echo $rsRef->ref_emb_dim_ht ?>"> 
                <br>
                <label for="refEmbDimDiam">Diamètre : </label><br>
                <input name="refEmbDimDiam" placeholder="###,##" type="text" value="<?php echo $rsRef->ref_emb_dim_diam ?>">         
                <br>

            </div>

            <div class="col30">

                    <label for="pvePer"> Prix de vente particulier: </label><br>
                    <input name="pvePer" placeholder="### ###,##" type="text" value='<?php echo $oPve->pve_per; ?>'>         
                    <br>
                    <label for="pveEnt"> Prix de vente entreprise: </label><br>
                    <input name="pveEnt" placeholder="### ###,##" type="text" value='<?php echo $oPve->pve_ent; ?>'>         
                    <br>
                    <label for="tva"> Taux de TVA: </label><br>
                    <select name="tva" title="Choisir un élément" required>
                        <option value="" selected>Aucun</option>

                        <?php
                        if (isset($toTvas) && is_array($toTvas)) {
                            foreach ($toTvas as $oTva) {
                                if ($oTva->tva_id === $rsRef->tva_id) {
                                    if (!empty($oTva->tva_lbl) && $oTva->tva_lbl !== '') {
                                        ?>
                                        <option value="<?php echo $oTva->tva_id ?>" selected>
                                            <?php echo $oTva->tva_lbl . ' | ' . $oTva->tva_taux . ' %' ?> </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $oTva->tva_id ?>" selected>
                                            <?php echo $oTva->tva_lbl . '' . $oTva->tva_taux . ' %' ?> </option>
                                        <?php
                                    }
                                } else {
                                    if (!empty($oTva->tva_lbl) && $oTva->tva_lbl !== '') {
                                        ?>
                                        <option value="<?php echo $oTva->tva_id ?>">
                                            <?php echo $oTva->tva_lbl . ' | ' . $oTva->tva_taux . ' %' ?> </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $oTva->tva_id ?>">
                                            <?php echo $oTva->tva_lbl . '' . $oTva->tva_taux . ' %' ?> </option>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                    <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_tva.php');" />

                    <br>
                    <label for="droitDouane"> Droit de douanes: </label><br>
                    <select name="droitDouane" title="Choisir un élément" required>

                        <option value="" selected>Aucun</option>

                        <?php
                        if (isset($toDroitDouanes) && is_array($toDroitDouanes)) {
                            foreach ($toDroitDouanes as $oDroitDouane) {
                                if ($oDroitDouane->dd_id === $rsRef->dd_id) {
                                    if (!empty($oDroitDouane->dd_lbl) && $oDroitDouane->dd_lbl !== '') {
                                        ?>
                                        ?>
                                        <option value="<?php echo $oDroitDouane->dd_id ?>" selected>
                                            <?php
                                            echo $oDroitDouane->dd_lbl . ' | ' . $oDroitDouane->dd_taux . ' %'
                                            ?> 
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $oDroitDouane->dd_id ?>" selected>
                                            <?php
                                            echo $oDroitDouane->dd_lbl . '' . $oDroitDouane->dd_taux . ' %'
                                            ?>
                                        </option>
                                        <?php
                                    }
                                } else {
                                    if (!empty($oDroitDouane->dd_lbl) && $oDroitDouane->dd_lbl !== '') {
                                        ?>
                                        ?>
                                        <option value="<?php echo $oDroitDouane->dd_id ?>" selected>
                                            <?php
                                            echo $oDroitDouane->dd_lbl . ' | ' . $oDroitDouane->dd_taux . ' %'
                                            ?> 
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $oDroitDouane->dd_id ?>" selected>
                                            <?php
                                            echo $oDroitDouane->dd_lbl . '' . $oDroitDouane->dd_taux . ' %'
                                            ?>
                                        </option>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>

                    </select>
                    <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_droit_douane.php');"/>
                    <br>
                    <label for="refCom"> Commentaire : </label><br>
                    <textarea name="refCom" rows="4" cols="25" placeholder="Commentaire sur la référence" ><?php echo $rsRef->ref_com; ?></textarea>
                    <div class='impImg'>
                        <fieldset><legend>Image</legend>                           

                            <label for="img_upload">Image (<?php echo $imgExtension ?> | max. 
                                <?php echo $imgMaxSize / 1000 ?> Ko) :</label>
                            <br/>       
                            <input type="hidden" name="MAX_FILE_SIZE" 
                                   value="<?php echo $imgMaxSize ?>" />
                            <br/>       

                            <input type="file" name="img_upload[]"  
                                   id="img_upload" multiple=""/>


                        </fieldset>
                    </div>
                    <div class="imgList">
                        <table>
                            <?php
                            if ($rsRef->ref_photos != '') {
                                $tabPhoto = explode(',', $rsRef->ref_photos);
                                foreach ($tabPhoto as $image) {
                                    if ($image != '') {
                                        ?>
                                        <tr>
                                            <td> <input type="radio" name="refPhotosPref" 
                                                        value="<?php echo $image ?>"
                                                        <?php if ($image == $rsRef->ref_photos_pref) echo ' checked '; ?>></td>
                                            <td><img src="<?php echo $imgMiniPath . $image . '_lbl.jpg' ?>" 
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

                <div class="bas">
                    <input name="btnForm" type="submit" value="<?php echo $sButton; ?>"/>
                    <input name='retour'  type="button" value='Retour' onclick='location.href = "index.php?action=ref_list";'/> 
                    <input name="action"  value="<?php echo $sAction ?>" type="text" hidden/>
                    <input name="idRef"   type='text' value="<?php echo $rsRef->ref_id; ?>" hidden>
                    <?php
                    if ($rsRef->ref_photos == '') {
                        ?>
                        <input name="refPhotosPref" value="" type="text" hidden>                
                    <?php } ?>

                    <input name="refPhotos" value="<?php echo $rsRef->ref_photos ?>" type="text" hidden>
                </div>

            </form>
        </div>
        <?php
    } else {
        echo 'Le silence est d\'or';
    }
    ?>