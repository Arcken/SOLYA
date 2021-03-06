
<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <?php            if (isset($res)) {
                echo $res;
            }
            ?>
        <form class="form" id="formFiart" action="index.php" method="post" 
              enctype="multipart/form-data">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <div class="col30">
                <div>
                    <label for="fiartLbl"> Libellé</label>
                    <input name="fiartLbl" placeholder="description" 
                           required type="text"
                           pattern=".{3,}" title="3 caractères minimum">
                    
                    <label for="gamme"> Gamme: </label>                    
                    <select name="gamme[]" id="selGamme" 
                            onclick="listSelect('selGamme', 'listGamme')" 
                            multiple="multiple" required="" size='3'>
                        <option value="" selected="">Aucun</option>

         <!-- Boucle permettant d'afficher toutes les valeurs dans la combobox-->

                        <?php
                        if (is_array($resAllGa) && $resAllGa != 0) {
                            foreach ($resAllGa as $value) {
                                ?>
                                <option value="<?php echo $value->ga_id ?>">
                                    <?php echo $value->ga_lbl ?> 
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                    <img src="img/icon/add.png" alt="" 
                         onClick="popup('ga_add');" title="Créer gamme"/><br>
                    <label for="listGamme">Gamme sélectionnée:</label>

                    <span id="listGamme" class="listchoisis">                        
                    </span>
                    <hr>

                    <label for="pays"> Pays: </label>
                    <select name="pays" id="selPays" required>
                        <option value="" selected>Aucun</option>
   <!-- Boucle permettant d'afficher toutes les valeurs dans la combobox-->
                        <?php
                        if (is_array($resAllPays) && $resAllPays != 0) {
                            foreach ($resAllPays as $pays) {
                                ?>
                                <option value="<?php echo $pays->pays_id ?>">
                                    <?php echo $pays->pays_nom ?> </option>
                                <?php
                            }
                        }
                        ?>                        
                    </select>                    
                    <img src="img/icon/add.png" alt="" 
                         onClick="popup('pays_add');" 
                         title="Créer pays"/>                   
                </div>

                <div>
                    <div>
                        <label for="fiartIng"> Ingrédients: </label>               
                        <textarea name="fiartIng" rows="3" cols="25" 
                                  placeholder="Saisie"></textarea>
                    </div>
                    
                    <div>                    
                        <label for="fiartAlg"> Allergènes: </label>
                        <textarea name="fiartAlg" rows="3" cols="25" 
                                  placeholder="Saisie"></textarea>
                    </div>
                </div>
                
                <div class='impImg'>
                    <fieldset><legend>Image</legend>                           

                        <label for="img_upload">Image (<?php echo $imgExtension ?> | max. 
                            <?php echo $imgMaxSize / 1000 ?> Ko) :</label>
                        <input type="hidden" name="MAX_FILE_SIZE" 
                               value="<?php echo $imgMaxSize ?>" />
                        <br>
                        <input type="file" name="img_upload[]"  
                               id="img_upload" multiple=""/>


                    </fieldset>
                </div>

            </div>
            <div class="col30" id="ComFiart">
                <div>                    
                    <label for="fiartCom"> Commentaire: </label>
                    <textarea name="fiartCom" rows="3" cols="25" 
                              placeholder="Saisie"></textarea>
                </div>
                
                <div>                    
                    <label for="fiartComTech"> Commentaire technique: </label>
                    <textarea name="fiartComTech" rows="3" cols="25"
                              placeholder="Saisie"></textarea>
                </div>
                
                <div>                    
                    <label for="fiartComUtil"> Commentaire d'utilisation: </label>
                    <textarea name="fiartComUtil" rows="3" cols="25" 
                              placeholder="Saisie"></textarea>
                </div>
                
                <div>                    
                    <label for="fiartDescFr"> Description Française: </label>
                    <textarea name="fiartDescFr" rows="3" cols="25" 
                              placeholder="Saisie"></textarea>
                </div>
                
                <div>                    
                    <label for="fiartDescEng"> Description Anglaise: </label>
                    <textarea name="fiartDescEng" rows="3" cols="25" 
                              placeholder="Saisie"></textarea>
                </div>
                
                <div>                    
                    <label for="fiartDescEsp"> Description Espagnole: </label>
                    <textarea name="fiartDescEsp" rows="3" cols="25" 
                              placeholder="Saisie"></textarea>
                </div>


            </div>
            <div class="col30" id="divNut">
                <label> Table de nutrition: </label>
                <img src="img/icon/add.png" onClick="msgConfirmPopup('Ajouter un élément videra les champs de nutrition', 'nut_add');" 
                     title="Créer nouvel élément" alt=""/>
                
                </br>
                <div id="lsNut">
<!-- Boucle permettant d'afficher pour chaque résultat une input box et son label-->
                <?php
                if (is_array($resAllNut) && $resAllNut != 0) {
                    foreach ($resAllNut as $value) {
                        ?>
                        <label for="<?php echo 'nut' . $value->nut_id ?>">
                            <?php echo $value->nut_lbl ?></label>
                        
                        <input name="<?php echo 'nut' . $value->nut_id ?>" 
                               placeholder="saisie"
                               title="Saisie de type texte">
                        <input class="inputSmall" 
                               name="<?php echo 'nutAjr' . $value->nut_id ?>" 
                               placeholder="###.#"
                               title="saisie de type: 999.9">
                                                      
                        <?php
                    }
                }
                ?>
                </div>
            </div>
            
            <div class="bas">
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset"> 
                <input name="action" id="action" value="<?php echo $sAction ?>"
                       type="text" hidden>
                <input name="fiartPhoto" id="action" value="rien"
                       type="text" hidden>
            </div>
        </form>
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}