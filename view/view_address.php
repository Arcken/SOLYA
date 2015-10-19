
<input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
<div class="col30" id="add_adr" style="display:none" >
    
            <label for="adr_num">Numéro :</label><br>
            <input name="adr_num" type="text"></input>
            <br>
            <label for="adr_voie" >Voie :</label><br>
            <input name="adr_voie" type="text"></input>
            <br>
            <label for="adr_rue1">RUE :</label><br>
            <input name="adr_rue1" type="text"></input>
            <br>
            <input name="adr_rue2" type="text"></input>
            <br>
            <input name="adr_rue2" type="text"></input>
            <br>
            <label for="adr_cp">Code postal :</label><br>
            <input name="adr_cp" type="text"></input>
            <br>
            <label for="adr_ville">Ville :</label><br>
            <input name="adr_ville" type="text"></input>
            <br>
            <label for="adr_etat">Etat :</label><br>
            <input name="adr_etat" type="text"></input>
            <br>
            <label for="pays_id">Pays :</label><br>
            <select name="pays_id" id="PAYS_ID" required >
                <option value="0" selected> --Pays-- </option>
                    <?php foreach ($toPays as $oPays) {?>
                <option value ="<?php echo $oPays->pays_id ?>"> <?php echo $oPays->pays_nom ?> </option>
                    <?php } ?>
            </select>
</div>

