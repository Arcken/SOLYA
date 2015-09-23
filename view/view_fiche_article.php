
<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <?php if (isset($res)) echo $res; ?>
        <form class="form" action="index.php" method="get">
            <div class="col30">
                <div>
                    <!--
                    <label for="fiartId"> Code de la fiche article </label><br>
                    <input name="fiartId" value="<?php //echo $resMaxIdFiart['MAX(fiart_id)']  ?>" readonly type="text">
                    <img src="img/icon/accept.png" alt=""/>
                    <br>
                    -->
                    <label for="fiartLbl"> Libellé de la fiche article </label><br>
                    <input name="fiartLbl" placeholder="description" required type="text">
                    <br>
                    <label for="gamme"> Gamme: </label><br>                    
                    <select name="gamme[]" id="selGamme" onclick="listSelect('selGamme', 'listGamme')" 
                            multiple="multiple" required="" size='3'>
                        <option value="" selected="">Aucun</option>

                        <!-- Boucle permettant d'afficher toutes les valeurs dans la combobox-->

                        <?php if (is_array($resAllGa) && $resAllGa != 0) {
                            foreach ($resAllGa as $value) {
                                ?>
                                <option value="<?php echo $value->ga_id ?>">
                                <?php echo $value->ga_lbl ?> </option>
                            <?php }
                        }
                        ?>
                    </select>

                    <img src="img/icon/add.png" alt="" onClick="popup('ga_add');" title="Créer gamme"/><br>
                    <label for="listGamme">Gamme sélectionnée:</label>
                    <br>                        
                    <span id="listGamme" class="listchoisis">                        
                    </span>
                    <br>
                    <label for="pays"> Pays: </label><br>
                    <select name="pays" id="selPays" required>
                        <option value="" selected>Aucun</option>
                        <!-- Boucle permettant d'afficher toutes les valeurs dans la combobox-->
                        <?php if (is_array($resAllPays) && $resAllPays != 0) {
                            foreach ($resAllPays as $pays) {
                                ?>
                                <option value="<?php echo $pays->pays_id ?>">
                                <?php echo $pays->pays_nom ?> </option>
                            <?php }
                        }
                        ?>                        
                    </select>                    
                    <img src="img/icon/add.png" alt="" onClick="popup('pays_add');" title="Créer pays"/>                   
                    <br>
                </div>

                <div>
                    <div>
                        <label for="fiartIng"> Ingrédients: </label><br>               
                        <textarea name="fiartIng" rows="3" cols="25" placeholder="Saisie"></textarea>
                        <br>
                    </div>
                    <div>                    
                        <label for="fiartAlg"> Allergénes: </label><br>
                        <textarea name="fiartAlg" rows="3" cols="25" placeholder="Saisie"></textarea>
                    </div>
                </div>

            </div>
            <div class="col30" id="ComFiart">
                <div>                    
                    <label for="fiartCom"> Commentaire de la fiche: </label><br>
                    <textarea name="fiartCom" rows="3" cols="25" placeholder="Saisie"></textarea>
                </div>
                <div>                    
                    <label for="fiartComTech"> Commentaire technique de la fiche: </label><br>
                    <textarea name="fiartComTech" rows="3" cols="25" placeholder="Saisie"></textarea>
                </div>
                <div>                    
                    <label for="fiartComUtil"> Commentaire d'utilisation de la fiche: </label><br>
                    <textarea name="fiartComUtil" rows="3" cols="25" placeholder="Saisie"></textarea>
                </div>
                <div>                    
                    <label for="fiartDescFr"> Description Française de la fiche: </label><br>
                    <textarea name="fiartDescFr" rows="3" cols="25" placeholder="Saisie"></textarea>
                </div>
                <div>                    
                    <label for="fiartDescEng"> Description Anglaise de la fiche: </label><br>
                    <textarea name="fiartDescEng" rows="3" cols="25" placeholder="Saisie"></textarea>
                </div>
                <div>                    
                    <label for="fiartDescEsp"> Description Espagnole de la fiche: </label><br>
                    <textarea name="fiartDescEsp" rows="3" cols="25" placeholder="Saisie"></textarea>
                </div>


            </div>
            <div class="col30" id="divNut">
                <label> Table de nutrition: </label>
                <img src="img/icon/add.png" onClick="popup('nut_add');" title="Créer nouvel élément" alt=""/>
                </br>
                </br>
                <!-- Boucle permettant d'afficher chaque résultat une input box et son label-->
    <?php if (is_array($resAllNut) && $resAllNut != 0) {
        foreach ($resAllNut as $value) {
            ?>
                        <label for="<?php echo 'nut' . $value->nut_id ?>"><?php echo $value->nut_lbl ?></label>
                        </br>
                        <input name="<?php echo 'nut' . $value->nut_id ?>" placeholder="saisie"> </br>                               
                        <?php
                    }
                }
                ?>
                <br>
            </div>
            <div class="bas">
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset"> 
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                <input name="fiartPhoto" id="action" value="rien" type="text" hidden>
            </div>
        </form>
    </div>

    <?php
} else
    echo 'Le silence est d\'or'

    
?>