<?php ?>
<form>
    <div> 
        <label for="ficheArticle"> Fiche article associée </label>
        <select required="required" name="ficheArticle" title="Choisir un élément">
            <option value="cacao">Volvo</option>
            <option value="chocolat">Saab</option>
            <option value="caramel">Mercedes</option>
            <option value="huile de cacao">Audi</option>
        </select>
        <img src="../img/icon/add.png" alt="" title="Créer"/>          
    </div>
    <br>
    <div>
        <div> 
            <label for="refId"> Référence: </label>
            <input name="refId" placeholder="pays-gamme-n°" 
                   required="" type="text">
            <img src="../img/icon/accept.png" alt=""/>
            <br>
            <label for="refLbl"> Libellé: </label>            
            <textarea name="refLbl" rows="4" cols="30" 
                      placeholder="Description de la réf" required></textarea>
            <br>
            <label for="refStMin"> Stock minimum: </label>
            <input name="refStMin" placeholder="2" type="text">         
            <br>
            <label for="refPoids"> Poids de l'article: </label>
            <input name="refPoids" placeholder="2" type="text">         
            <br>
            <label for="refVolume"> Volume de l'article: </label>
            <input name="refVolume" placeholder="0,304" type="text">         
            <br>
            <label for="modeConservation"> Mode de conservation </label>
            <select name="modeConservation" title="Choisir un élément">
                <option value="Au frais">Au frais</option>
                <option value="A 5°C">A 5°C</option>
            </select>
            <img src="../img/icon/add.png" alt="" title="Créer"/>
            <br>
            <label for="dureeConservation"> Durée de conservation </label>
            <select name="dureeConservation" title="Choisir un élément">
                <option value="365">365 jours</option>
                <option value="60">60 jours</option>
            </select>
            <img src="../img/icon/add.png" alt="" title="Créer"/>
            <br>
            <label for="emballage"> Emballage </label>
            <select name="emballage" title="Choisir un élément">
                <option value="1">bocal 250g</option>
                <option value="2">sac papier kraft</option>
            </select>
            <img src="../img/icon/add.png" alt="" title="Créer"/>
        </div>
        <div>
            
        </div>
            <label for="pvePer"> Prix de vente particulier: </label>
            <input name="pvePer" placeholder="7" type="text">         
            <br>
            <label for="pveEnt"> Prix de vente entreprise: </label>
            <input name="pveEnt" placeholder="5" type="text">         
            <br>
            <label for="tva"> Taux de TVA: </label>
            <select name="tva" title="Choisir un élément">
                <option value="1">TVA de 5,5%</option>
                <option value="2">TVA de 20%</option>
            </select>
            <img src="../img/icon/add.png" alt="" title="Créer"/>
            <br>
            <label for="droitDouane"> Droit de douanes: </label>
             <select name="droitDouane" title="Choisir un élément">
                <option value="1">Droit de 8,5%</option>
                <option value="2">Droit de 12%</option>
            </select>
            <img src="../img/icon/add.png" alt="" title="Créer"/>
            <br>
            
            <label for="compte"> Compte du fournisseur: </label>
             <select name="compte" title="Choisir un élément">
                <option value="1">Eurocorp</option>
                <option value="2">Mexican enterprise</option>
            </select>
            <img src="../img/icon/add.png" alt="" title="Créer"/>            
            <br>
            <label for="pacA"> Prix A: </label>
            <input name="pacA" placeholder="### ###,##" type="text">         
            <br>
            <label for="pacB"> Prix B: </label>
            <input name="pacB" placeholder="### ###,##" type="text">         
            <br>
            <label for="pacC"> Prix C: </label>
            <input name="pacC" placeholder="### ###,##" type="text">         
            <br>
    <input value="Submit" type="submit">
    <input name="clear" type="reset"> 
     </div>
</form>
