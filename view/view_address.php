
<input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
<div class="col30" id="add_adr" style="display:none" >
    
            <label for="ADR_NUM">Numéro :</label><br>
            <input name="ADR_NUM" type="text"></input>
            <br>
            <label for="ADR_VOIE" >Voie :</label><br>
            <input name="ADR_VOIE" type="text"></input>
            <br>
            <label for="ADR_RUE1">RUE :</label><br>
            <input name="ADR_RUE1" type="text"></input>
            <br>
            <input name="ADR_RUE2" type="text"></input>
            <br>
            <input name="ADR_RUE3" type="text"></input>
            <br>
            <label for="ADR_CP">Code postal :</label><br>
            <input name="ADR_CP" type="text"></input>
            <br>
            <label for="ADR_VILLE">Ville :</label><br>
            <input name="ADR_VILLE" type="text"></input>
            <br>
            <label for="ADR_ETAT">Etat :</label><br>
            <input name="ADR_ETAT" type="text"></input>
            <br>
            <label for="PAYS_ID">Pays :</label><br>
            <select name="PAYS_ID" id="PAYS_ID" required >
                <option value="0" selected> --Pays-- </option>
                    <?php foreach ($toPays as $oPays) {?>
                <option value ="<?php echo $oPays->pays_id ?>"> <?php echo $oPays->pays_nom ?> </option>
                    <?php } ?>
            </select>
</div>

