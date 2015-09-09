<?php ?>
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<div class="corps">
    <form class="form">
        <div class="gauche">
            <div> 
                <label for="fiartId"> Code de la fiche article </label>
                <input name="fiartId" placeholder="Abréviation pays-gammes" required type="text">
                <img src="img/icon/accept.png" alt=""/>
                <br>
                <label for="fiartLbl"> Libellé de la fiche article </label>
                <input name="fiartLbl" placeholder="description" required type="text">
                <br>
                <label for="gamme"> Gamme: </label>
                <select name="gamme">
                    <option value="1">Sirop</option>
                    <option value="2">Tablette</option>
                    <option value="2">Graine</option>                        
                </select>
                <a href="" onClick="popup('view_gamme.php');">
                    <img src="img/icon/add.png" alt=""/>
                </a>
                <br>
                <label for="pays"> Pays: </label>
                <select name="pays">
                    <option value="1">Mexique</option>
                    <option value="2">France</option>
                    <option value="2">Angleterre</option>                        
                </select>
                <a href="" onClick="popup('view_pays.php');">
                    <img src="img/icon/add.png" alt=""/>
                </a>
                <br>
            </div>

            <div>
                <div
                    <label for="fiartIng"> Ingrédients: </label>                    
                    <textarea name="fiartIng" rows="4" cols="30" placeholder="Saisie"></textarea>
                    <br>
                </div>
                <div>                    
                    <label for="fiartAlg"> Allergénes: </label>
                    <textarea rows="4" cols="30" placeholder="Saisie"></textarea>
                </div>
            </div>
            <div>
                <input value="Submit" type="submit">
                <input name="clear" type="reset"> 
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

    </form>
</div>