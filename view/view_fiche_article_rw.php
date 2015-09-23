
<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    $listGamme = '';
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <form class="form" action="index.php" method="get">

            <div class="col30">
                <div>

                    <label for="fiartId"> Code de la fiche article </label><br>
                    <input name="fiartId" value="<?php echo $resFiartDetail->fiart_id ?>" 
                           readonly type="text">
                    <br>
                    <label for="fiartLbl"> Libellé de la fiche article </label><br>
                    <input name="fiartLbl" placeholder="description" required 
                           type="text" value="<?php echo $resFiartDetail->fiart_lbl ?>">
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
                                           
                                            $listGamme = $listGamme.$gamme->ga_lbl." ";
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
                        <option value="" selected>Aucun</option>
                        <!-- Boucle permettant d'afficher toutes les valeurs dans la combobox-->
                        <?php
                        if (is_array($resAllPays) && $resAllPays != 0) {
                            foreach ($resAllPays as $pays) {
                                ?>
                                <option value="<?php echo $pays->pays_id ?>" <?php if ($pays->pays_id == $resFiartDetail->pays_id) {
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
                        <textarea name="fiartIng" rows="4" cols="30" placeholder="Saisie"><?php 
                        echo $resFiartDetail->fiart_ing ?></textarea>
                        <br>
                    </div>
                    <div>                    
                        <label for="fiartAlg"> Allergénes: </label><br>
                        <textarea name="fiartAlg" rows="4" cols="30" placeholder="Saisie"><?php 
                        echo $resFiartDetail->fiart_alg ?></textarea>
                    </div>
                </div>

            </div>
            <div class="col50">
                <label> Table de nutrition: </label>
                
                </br>
                </br>
                <!-- Boucle permettant d'afficher chaque résultat une input box et son label-->
                <div id="divNut">
                <?php
                if (isset($resAllNut) && is_array($resAllNut) && $resAllNut != 0) {
                    foreach ($resAllNut as $nut) {
                        ?>
                        <label for="<?php echo 'nut' . $nut->nut_id ?>"><?php echo $nut->nut_lbl ?></label>
                        </br>
                        <input name="<?php echo 'nut' . $nut->nut_id ?>" 
                               placeholder="saisie" value="<?php
                               if(is_array($resNutFiart) && $resNutFiart!=0) {
                                foreach ($resNutFiart as $nutVal){
                                    if ($nutVal->nut_id == $nut->nut_id) echo $nutVal->nutfiart_val;
                                }
                               }
                               ?>"> </br>                               
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
                <input name="fiartPhoto" id="action" value="rien" type="text" hidden>
            </div>
        </form>
    </div>

    <?php
} else
    echo 'Le silence est d\'or'


    
?>