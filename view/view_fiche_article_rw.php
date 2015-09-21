
<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <form class="form" action="index.php" method="get">
            <div>
            <div class="gauche">
                <div>
                    <?php foreach ($resFiartDetail as $fiart){?>
                    <label for="fiartId"> Code de la fiche article </label><br>
                    <input name="fiartId" value="<?php echo $fiart->fiart_id ?>" 
                           readonly type="text">
                    <br>
                    <label for="fiartLbl"> Libellé de la fiche article </label><br>
                    <input name="fiartLbl" placeholder="description" required 
                           type="text" value="<?php echo $fiart->fiart_lbl?>">
                    <br>
                    <label for="gamme"> Gamme: </label><br>                    
                    <select name="gamme[]" id="selGamme" onclick="" 
                            multiple="multiple" required="" size='3'>
                        <option value="" selected="">Aucun</option>

                        <!-- Boucle permettant d'afficher toutes les valeurs dans la combobox-->
                        
                        <?php
                                foreach ($resAllGamme as $gamme) {            ?>
                                 <option value="<?php echo $gamme->GA_ID ?>"  
                                     <?php if ($gamme->ga_id == $fiart->ga_id){
                                        ?>selected<?php } ?> >>
                                 <?php echo $gamme->GA_LBL ?> </option>
                        <?php   }
                        
                               ?>
                    </select>

                    <img src="img/icon/add.png" alt="" onClick="popup('ga_add');" title="Créer gamme"/><br>
                    <label for="listGamme">Gamme sélectionnée:</label>
                    <br>                        
                    <span id="listGamme" class="listchoisis">                        
                    </span>
                    <br>
                    <label for="pays"> Pays: </label><br>
                    <select name="pays" id="selPays">
                        <option value="" selected>Aucun</option>
                        <!-- Boucle permettant d'afficher toutes les valeurs dans la combobox-->
                        <?php if(is_array($resAllPays) && $resAllPays!=0) {
                                foreach ($resAllPays as $pays) { 
                                    ?>
                                    <option value="<?php echo $pays->PAYS_ID ?>" <?php if ($pays->PAYS_ID == $fiart->pays_id){
                                        ?>selected<?php } ?> >
                                            <?php echo $pays->PAYS_NOM ?> </option>
                          <?php }
                        
                              } ?>                        
                    </select>                    
                    <img src="img/icon/add.png" alt="" onClick="popup('pays_add');" title="Créer pays"/>                   
                    <br>
                </div>

                <div>
                    <div>
                        <label for="fiartIng"> Ingrédients: </label><br>               
                        <textarea name="fiartIng" rows="4" cols="30" placeholder="Saisie">
                            <?php echo $fiart->fiart_ing?>
                        </textarea>
                        <br>
                    </div>
                    <div>                    
                        <label for="fiartAlg"> Allergénes: </label><br>
                        <textarea name="fiartAlg" rows="4" cols="30" placeholder="Saisie">
                            <?php echo $fiart->fiart_alg?>
                        </textarea>
                    </div>
                </div>

            </div>
            <div class="droite" id="divNut">
                <label> Table de nutrition: </label>
                <img src="img/icon/add.png" onClick="popup('nut_add');" title="Créer nouvel élément" alt=""/>
                </br>
                </br>
                <!-- Boucle permettant d'afficher chaque résultat une input box et son label-->
                <?php if(isset($resAllNut) && is_array($resAllNut) && $resAllNut!=0) {
                        foreach ($resAllNut as $value) { ?>
                            <label for="<?php echo 'nut' . $value->NUT_ID ?>"><?php echo $value->NUT_LBL ?></label>
                        </br>
                        <input name="<?php echo 'nut' . $value->NUT_ID ?>" placeholder="saisie"> </br>                               
                        <?php
                        
                        }
                      }
                ?>
                <br>
            </div>
                    <?php } ?>
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