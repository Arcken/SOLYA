<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">

        <form class ="form">
            <div class=" haut"> 
                <label for="ficheArticle"> Fiche article associée </label><br>
                <select required="required" name="ficheArticle" title="Choisir un élément">
                    <option value="cacao">Volvo</option>
                    <option value="chocolat">Saab</option>
                    <option value="caramel">Mercedes</option>
                    <option value="huile de cacao">Audi</option>
                </select>
                <a href="" onClick="popup('view_fiche_article.php');">
                    <img src="img/icon/add.png" alt="" title="Créer"/>
                </a>
            </div>


            <div class="gauche"> 

                <label for="refLbl"> Libellé: </label><br>          
                <textarea name="refLbl" rows="4" cols="25" placeholder="Description de la réf" required></textarea>
                <br>
                <label for="refStMin"> Stock minimum: </label><br>
                <input name="refStMin" placeholder="###,##" type="text">         
                <br>
                <label for="refPoidsBrut"> Poids brut de l'article: </label><br>
                <input name="refPoidsBrut" placeholder="gramme ### ###,##" type="text">         
                <br>
                <label for="refPoidsNet"> Poids net de l'article: </label><br>
                <input name="refPoidsNet" placeholder="gramme ### ###,##" type="text">         
                <br>
                <label for="refVolume"> Volume de l'article: </label><br>
                <input name="refVolume" placeholder="litre ###,###" type="text">         
                <br>
                <label for="modeConservation"> Mode de conservation </label><br>
                <select name="modeConservation" title="Choisir un élément">
                    <option value="Au frais">Au frais</option>
                    <option value="A 5°C">A 5°C</option>
                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_mode_conservation.php');"/>
                <br>
                <label for="dureeConservation"> Durée de conservation </label><br>
                <select name="dureeConservation" title="Choisir un élément">
                    <option value="365">365 jours</option>
                    <option value="60">60 jours</option>
                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_duree_conservation.php');" />
                <br>
            </div>

            <div class="centre">
                <label for="refEmbLbl">Description de l'emballage :</label><br>
                <input name="refEmbLbl" placeholder="Pot en verre 250gr" type="text">         
                <br>
                <label for="refEmbCouleur" >Couleur : </label><br>
                <input name="refEmbCouleur" placeholder="Rouge !" type="text">         
                <br> 
                <label for="refEmbVlmCtn">Volume de produit contenu:</label><br>
                <input name="refEmbVlmCtn" placeholder="###,### EN LITRE" type="text">         
                <br>
                <label for="refEmbDimLng">Longueur : </label><br>
                <input name="refEmbDimLng" placeholder="###,##" type="text">         
                <br>
                <label for="refEmbDimLrg">Largeur : </label><br>
                <input name="refEmbDimLrg" placeholder="###,##" type="text">         
                <br>
                <label for="refEmbDimHt">Hauteur : </label><br>
                <input name="refEmbDimHt" placeholder="###,##" type="text"> 
                <br>
                <label for="refEmbDimDiam">Diamètre : </label><br>
                <input name="refEmbDimDiam" placeholder="###,##" type="text">         
                <br>

            </div>

            <div class="droite">

                <label for="pvePer"> Prix de vente particulier: </label><br>
                <input name="pvePer" placeholder="### ###,##" type="text">         
                <br>
                <label for="pveEnt"> Prix de vente entreprise: </label><br>
                <input name="pveEnt" placeholder="### ###,##" type="text">         
                <br>
                <label for="tva"> Taux de TVA: </label><br>
                <select name="tva" title="Choisir un élément">
                    <option value="1">TVA de 5,5%</option>
                    <option value="2">TVA de 20%</option>
                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_tva.php');" />

                <br>
                <label for="droitDouane"> Droit de douanes: </label><br>
                <select name="droitDouane" title="Choisir un élément">
                    <option value="1">Droit de 8,5%</option>
                    <option value="2">Droit de 12%</option>
                </select>
                <img src="img/icon/add.png" alt="" title="Créer" onClick="popup('view_droit_douane.php');"/>
            </div>
            <div class="bas">
                <input value="Submit" type="submit">
                <input name="clear" type="reset"> 
            </div>
    </div>
    </form>

    <?php
} else {
    echo 'Le silence est d\'or';
}
?>