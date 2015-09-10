<?php ?>
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<div class="corps">
    <form class="form" action="index.php" method="get">
        <div class="gauche">
            <div> 
                <label for="fiartId"> Code de la fiche article </label><br>
                <input name="fiartId" placeholder="Abréviation pays-gammes" required type="text">
                <img src="img/icon/accept.png" alt=""/>
                <br>
                <label for="fiartLbl"> Libellé de la fiche article </label><br>
                <input name="fiartLbl" placeholder="description" required type="text">
                <br>
                <label for="gamme"> Gamme: </label><br>
                <select name="gamme">
                    <option value="1">Sirop</option>
                    <option value="2">Tablette</option>
                    <option value="2">Graine</option>                        
                </select>
                <a href="" onClick="popup('view/view_gamme.php');">
                    <img src="img/icon/add.png" alt="" title="Créer gamme"/>
                </a>
                <br>
                <label for="pays"> Pays: </label><br>
                <select name="pays">
                    <option value="1">Mexique</option>
                    <option value="2">France</option>
                    <option value="2">Angleterre</option>                        
                </select>
                <a href="" onClick="popup('view_pays.php');">
                    <img src="img/icon/add.png" alt="" title="Créer pays"/>
                </a>
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
            <p> Table de nutrition: </p>
            <!-- affichage de la liste des champs de nutrition 
            avec foreach input text et label pour chaque
            -->
            <a href="" onClick="popup('view_nutrition.php');">
                <img src="img/icon/add.png" alt=""/>
            </a>
            <br>
        </div>
        <div class="bas">
                <input name="btnForm" type="submit" value="<?php echo $sButton;?>">
                <input name="clear" type="reset"> 
                <input name="action" value="<?php echo $sAction ?>" type="text" hidden>
            </div>
    </form>
</div>