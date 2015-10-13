
<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    $listGamme = '';
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <form class="form" action="index.php"  method="POST" enctype="multipart/form-data">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <div class="col30">
                <div>                    
                    <label for="fiartLbl"> Libellé de la fiche article </label><br>
                    <input name="fiartLbl" placeholder="description" required 
                           type="text" value="<?php echo $resFiartDetail->fiart_lbl ?>"
                           pattern=".{3,}" title="3 caractères minimum">
                    <br>
                    <label for="gamme"> Gamme: </label><br>                    
                    <select name="gamme[]" id="selGamme" onclick="listSelect('selGamme', 'listGamme')" 
                            multiple="multiple" required="" size='3'>
                                <?php foreach ($resAllGamme as $gamme) { ?>
                            <option value="<?php echo $gamme->ga_id ?>"  

                                    <?php
                                    foreach ($resRegrouperFiart as $regrouper) {

                                        if ($gamme->ga_id == $regrouper->ga_id) {
                                            ?>selected<?php
                                            $listGamme = $listGamme . $gamme->ga_lbl . " ";
                                        }
                                    }
                                    ?> 
                                    >
                                        <?php
                                        echo $gamme->ga_lbl;
                                        ?> </option>
                        <?php }
                        ?>
                    </select>
                    <br>

                    <label for="listGamme">Gamme sélectionnée:</label>
                    <br>                        
                    <span id="listGamme" class="listchoisis">
                        <?php echo $listGamme;
                        ?>
                    </span>
                    <br>
                    <br>
                    <label for="pays"> Pays: </label><br>
                    <select name="pays" id="selPays">

                        <!-- Boucle permettant d'afficher toutes les valeurs dans la combobox-->
                        <?php
                        if (is_array($resAllPays) && $resAllPays != 0) {
                            foreach ($resAllPays as $pays) {
                                ?>
                                <option value="<?php echo $pays->pays_id ?>" 
                                <?php if ($pays->pays_id == $resFiartDetail->pays_id) {
                                    ?>selected<?php } ?> >
                                    <?php echo $pays->pays_nom ?> </option>
                                <?php
                            }
                        }
                        ?>                        
                    </select>                    
                    <br>
                </div>

                <div>
                    <div>
                        <label for="fiartIng"> Ingrédients: </label><br>               
                        <textarea name="fiartIng" rows="2" cols="25" 
                                  placeholder="Saisie"><?php echo $resFiartDetail->fiart_ing ?></textarea>
                        <br>
                    </div>
                    <div>                    
                        <label for="fiartAlg"> Allergénes: </label><br>
                        <textarea name="fiartAlg" rows="2" cols="25" 
                                  placeholder="Saisie"><?php echo $resFiartDetail->fiart_alg ?></textarea>
                    </div>
                </div>
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
                        if ($resFiartDetail->fiart_photos != '') {
                            $tabPhoto = explode(',', $resFiartDetail->fiart_photos);
                            foreach ($tabPhoto as $image) {
                                if ($image != '') {
                                    ?>
                                    <tr>
                                        <td> <input type="radio" name="fiartPhotosPref" 
                                                    value="<?php echo $image ?>"
                                                    <?php if ($image == $resFiartDetail->fiart_photos_pref) echo ' checked '; ?>></td>
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

            <div class="col30" id="ComFiart">
                <div>                    
                    <label for="fiartCom"> Commentaire de la fiche: </label><br>
                    <textarea name="fiartCom" rows="2" cols="25" placeholder="Saisie"><?php echo $resFiartDetail->fiart_com ?></textarea>
                </div>
                <div>                    
                    <label for="fiartComTech"> Commentaire technique de la fiche: </label><br>
                    <textarea name="fiartComTech" rows="2" cols="25" placeholder="Saisie"><?php echo $resFiartDetail->fiart_com_tech ?></textarea>
                </div>
                <div>                    
                    <label for="fiartComUtil"> Commentaire d'utilisation de la fiche: </label><br>
                    <textarea name="fiartComUtil" rows="2" cols="25" placeholder="Saisie"><?php echo $resFiartDetail->fiart_com_util ?></textarea>
                </div>
                <div>                    
                    <label for="fiartDescFr"> Description Française de la fiche: </label><br>
                    <textarea name="fiartDescFr" rows="2" cols="25" placeholder="Saisie"><?php echo $resFiartDetail->fiart_desc_fr ?></textarea>
                </div>
                <div>                    
                    <label for="fiartDescEng"> Description Anglaise de la fiche: </label><br>
                    <textarea name="fiartDescEng" rows="2" cols="25" placeholder="Saisie"><?php echo $resFiartDetail->fiart_desc_eng ?></textarea>
                </div>
                <div>                    
                    <label for="fiartDescEsp"> Description Espagnole de la fiche: </label><br>
                    <textarea name="fiartDescEsp" rows="2" cols="25" placeholder="Saisie"><?php echo $resFiartDetail->fiart_desc_esp ?></textarea>
                </div>


            </div>

            <div class="col30" id="divNut">
                <label> Table de nutrition: </label>

                </br>
                </br>
                <!-- Boucle permettant d'afficher chaque résultat une input box et son label-->
                <div>
                    <?php
                    if (isset($resAllNut) && is_array($resAllNut) && $resAllNut != 0) {
                        foreach ($resAllNut as $nut) {
                            ?>
                            <label for="<?php echo 'nut' . $nut->nut_id ?>"><?php echo $nut->nut_lbl ?></label>
                            </br>
                            <input name="<?php echo 'nut' . $nut->nut_id ?>" 
                                   placeholder="saisie" value="<?php
                                   if (is_array($resNutFiart) && $resNutFiart != 0) {
                                       foreach ($resNutFiart as $nutVal) {
                                           if ($nutVal->nut_id == $nut->nut_id)
                                               echo $nutVal->nutfiart_val;
                                       }
                                   }
                                   ?>"> 
                            <input  class="inputSmall" name="<?php echo 'nutAjr' . $nut->nut_id ?>" 
                                   placeholder="###.#" value="<?php
                                   if (is_array($resNutFiart) && $resNutFiart != 0) {
                                       foreach ($resNutFiart as $nutVal) {
                                           if ($nutVal->nut_id == $nut->nut_id)
                                               echo $nutVal->nutfiart_ajr;
                                       }
                                   }
                                   ?>">
                            </br>                               
                                   <?php
                               }
                           }
                           ?>
                </div>
                <br>
            </div>

            <div class="bas">
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset"> 
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                <?php
                if ($resFiartDetail->fiart_photos == '') {
                    ?>
                    <input name="fiartPhotosPref" value="" type="text" hidden>                
                <?php } ?>

                <input name="fiartPhotos" value="<?php echo $resFiartDetail->fiart_photos ?>" type="text" hidden>
            </div>
        </form>
    </div>

    <?php
} else
    echo 'Le silence est d\'or'






    
?>