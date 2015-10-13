
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="js/CtcAddFct.js" type="text/javascript"></script>


<!--Corps de la page-->
<div class="corps">
    
   <!-- En-tête choix du type contact-->
    <form id="form_add_ctc" class="form" action="index.php" method="get">
        <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
        <div class="haut">
            
                <label for="typeCtc"> Type de contact: </label><br>
                <select id="typeCtc" name="typeCtc" onChange="formChooser()" required>
                    <option value="" selected>--Type contact--</option>
                    <option value="1">Entreprise</option>
                    <option value="2">Personne</option>
                </select>
            
        </div>

   
        <!--Partie gauche de l'écran : Civilité--> 
        <div class="col30" id ="add_ent" style="display:none">
            <label for="ENT_NOM">Nom de l'entreprise :</label><br>
            <input name="ENT_NOM" type="text"/>
            <br>
            <label for="ENT_HORAIRE">Horaires de l'entreprise :</label><br>
            <input name="ENT_HORAIRE" type="text"/>
            <br>
            <label for="ENT_ECOMMERCE">Site E-commerce :</label><br>
            <input name="ENT_ECOMMERCE" type="text"/>
            <br>
            <label for="ENT_NIC">N°NIC :</label><br>
            <input name="ENT_NIC" type="text"/>
            <br>
            <label for="ENT_NAF">N°NAF :</label><br>
            <input name="ENT_NAF" type="text"/>
            <br>
            <label for="ENT_SIREN">N°SIREN :</label><br>
            <input name="ENT_SIREN" type="text"/>
            <br>
            <label for="ENT_CLE_TVA">N°CLE TVA :</label><br>
            <input name="ENT_CLE_TVA" type="text"/>
            <br>
            <label for="ENT_COM">Commentaire :</label><br>
            <textarea name="ENT_COM" type="text"></textarea>
            <br>
        </div>
   
           
       <!-- Partie gauche de l'écran : Civilité -->
        <div class="col30" id="add_prs" style="display:none"> 
            <label for="PRS_ENT">Entreprise :</label><br>
            <select name="PRS_ENT"id="PRS_ENT" onChange="" required>
                    <option value="">Nom de l'entreprise</option>
                    <option value="1">truc</option>
                    <option value="2">machin</option>
                </select>
            <br>
            <label for="CIV_CODE">Civilité :</label><br>
            <select name="CIV_CODE" id="CIV_LBL" required>
                <option value="" selected > --Civilité-- </option>
                    <?php foreach ($toCiv as $oCiv) {?>
                <option value ="<?php echo $oCiv->civ_id?>"> <?php echo $oCiv->civ_code ?> </option>
                    <?php } ?>
                </select>
            <br>
            <label for ="PRS_NOM">Nom :</label><br>
            <input name="PRS_NOM" type="text"/>
            <br>
            <label for ="PRS_PRENOM1">Prénom :</label><br>
            <input name="PRS_PRENOM1" type="text"/>
            <br>
            <label for ="PRS_PRENOM2">Deuxième prénom :</label><br>
            <input name="PRS_PRENOM2" type="text"/>
            <br>
            <label for ="PRS_PRENOM3">Troisième prénom :</label><br>
            <input name="PRS_PRENOM3" type="text"/>
            <br>
            <label for ="PRS_DTN">Date de naissance :</label><br>
            <input name="PRS_DTN" type="text"/>
            <br>
        </div>
        
       <!--Partie central de l'écran : Informations de localisation-->
        <?php require 'view/view_address.php'; ?>
        
       <!--Partie de droite : Mail/téléphone Catégorie contact-->  
        <div class="col30" id="add_tel_mail" style="display:none">
            <label for="MAIL_ADR">Adresse mail :</label><br>
            <input name="MAIL_ADR" type="text"/>
            <br>
            <label for="TEL_IND">Indicatif pays :</label><br>
            <textarea name="TEL_IND" type="text"></textarea>
            <br>
            <label for="TEL_NUM">Numéro de téléphone :</label><br>
            <textarea name="TEL_NUM" type="text"></textarea>
            <br>
            <label for='CAT_CTC[]'>Catégorie contact :</label> <br>
            <input class='CB_CLI'   type="checkbox" name='CAT_CTC[]' value='Client' onclick="cbChooser()"/>Client <br>
            <input class='CB_FOUR'  type="checkbox" name='CAT_CTC[]' value='Fournisseur' onclick="cbChooser()"/>Fournisseur <br>
            <input class='CB_PRSPT' type="checkbox" name='CAT_CTC[]' value='Prospect' onclick="cbChooser()" />Prospect <br>
            
        </div>
        
       <!--Zone des boutons-->
        <div class="bas" id="btn_zone" style="display:none">    
            <input name="btnForm" type="submit" value="<?php echo $sButton; ?>"/>
            <input id ='clearForm' name="clear"   type="reset" onclick="formChooser()"/> 
            <input name="action"  value="<?php echo $sAction ?>" type="text" hidden/>
        </div>
    </form>
</div>


