<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <div class="corps">
        <form class="form" action="index.php" method="get">
            <div class="gauche">
                <div> <?php print_r($resMaxIdFiart)?>                
                    <label for="fiartId"> Code de la fiche article </label><br>
                    <input name="fiartId" placeholder="<?php echo $resMaxIdFiart["MAX(FIART_ID)"]?>" type="text">
                    <img src="img/icon/accept.png" alt=""/>
                    <br>
                    <label for="fiartLbl"> Libellé de la fiche article </label><br>
                    <input name="fiartLbl" placeholder="description" required type="text">
                    <br>
                    <label for="gamme"> Gamme: </label><br>                    
                    <select name="gamme" id="selGamme">
                        <option value="0">Aucun</option>
                        <?php foreach ($resAllGa as $value) { ?>
                            <option value="<?php echo $value->GA_ID ?>">
                                <?php echo $value->GA_LBL ?> </option>
                        <?php } ?>
                    </select>
                    
                    <img src="img/icon/add.png" alt="" onClick="popup('ga_add');" title="Créer gamme"/>
                    
                    <br>
                    <label for="pays"> Pays: </label><br>
                    <select name="pays" id="selPays">
                        <option value="0">Aucun</option>
                        <?php foreach ($resAllPays as $value) { ?>
                            <option value="<?php echo $value->PAYS_ID ?>">
                                <?php echo $value->PAYS_NOM ?> </option>
                        <?php } ?>                        
                    </select>                    
                        <img src="img/icon/add.png" alt="" onClick="popup('pays_add');" title="Créer pays"/>                   
                    <br>
                </div>

                <div>
                    <div>
                        <label for="fiartIng"> Ingrédients: </label><br>               
                        <textarea name="fiartIng" rows="4" cols="30" placeholder="Saisie"></textarea>
                        <br>
                    </div>
                    <div>                    
                        <label for="fiartAlg"> Allergénes: </label><br>
                        <textarea name="fiartAlg" rows="4" cols="30" placeholder="Saisie"></textarea>
                    </div>
                </div>

            </div>
            <div class="droite">
                <label> Table de nutrition: </label>
                <img src="img/icon/add.png" onClick="popup('nut_add');" title="Créer nuvel élément" alt=""/>
                </br>
                </br>
                <?php foreach ($resAllNut as $value) { ?>
                <label for="<?php echo $value->NUT_LBL?>"><?php echo $value->NUT_LBL?></label>
                
                </br>
                <input name="<?php echo $value->NUT_LBL?>" placeholder="saisie"> </br>                               
                        <?php } ?>                
                    
                <br>
            </div>
            <div class="bas">
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset"> 
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
            </div>
        </form>
    </div>
    <?php
} else
    echo 'Le silence est d\'or'

    
?>