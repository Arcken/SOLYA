<?php ?>
<form>
    <div> 
        <label for="ficheArticle"> Fiche article associée </label>
        <select required="required" name="ficheArticle">
            <option value="cacao">Volvo</option>
            <option value="chocolat">Saab</option>
            <option value="caramel">Mercedes</option>
            <option value="huile de cacao">Audi</option>
        </select>
        <img src="../img/icon/add.png" alt=""/>          
    </div>
    <br>
    <div>
        <div> 
            <label for="refArt"> Référence: </label>
            <input name="refArt" value="MX01A" required="" type="text">
            <img src="../img/icon/accept.png" alt=""/>
            <br>
            <label for="refLbl"> Libellé: </label>
            <input name="refLbl" value="huile de cacao en bouteille" required type="text">         
            <br>
            <label for="refStMin"> Stock minimum: </label>
            <input name="refStMin" value="2" type="text">         
            <br>
            <label for="refPoids"> Poids de l'article: </label>
            <input name="refPoids" value="2" type="text">         
            <br>
            <label for="refVolume"> Volume de l'article: </label>
            <input name="refVolume" value="0,304" type="text">         
            <br>
            <label for="modeConservation"> Mode de conservation </label>
            <select name="modeConservation">
                <option value="Au frais">Au frais</option>
                <option value="A 5°C">A 5°C</option>
            </select>
            <img src="../img/icon/add.png" alt=""/>
            <br>
            <label for="dureeConservation"> Durée de conservation </label>
            <select name="dureeConservation">
                <option value="365">365 jours</option>
                <option value="60">60 jours</option>
            </select>
            <img src="../img/icon/add.png" alt=""/>
            <br>
            <label for="emballage"> Emballage </label>
            <select name="emballage">
                <option value="1">bocal 250g</option>
                <option value="2">sac papier kraft</option>
            </select>
            <img src="../img/icon/add.png" alt=""/>
        </div>

    </div>
    <input value="Submit" type="submit"> 
</form>
