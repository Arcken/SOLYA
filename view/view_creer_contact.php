
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="js/formChooser.js" type="text/javascript"></script>

<div class="corps">

    <form id="form_ctc_chx" class="form" action="index.php" method="get">
        <div class="haut">
            <div> 
                <label for="typeCtc"> Type de contact: </label><br>
                <select id="typeCtc" name="typeCtc" onChange="formChooser()">
                    <option value="0">--Type contact--</option>
                    <option value="1">Entreprise</option>
                    <option value="2">Personne</option>
                </select>
            </div>
        </div>
    </form>

    <form id="form_add_ent" class="form" action="index.php" method="get" hidden>
        <div class="gauche">

            <label for="ENT_NOM">Nom de l'entreprise :</label><br>
            <input name="ENT_NOM" type="text"></input>
            <br>
            <label for="ENT_HORAIRE">Horaires de l'entreprise :</label><br>
            <input name="ENT_HORAIRE" type="text"></input>
            <br>
            <label for="ENT_ECOMMERCE">Site E-commerce :</label><br>
            <input name="ENT_ECOMMERCE" type="text"></input>
            <br>
            <label for="ENT_NIC">N°NIC :</label><br>
            <input name="ENT_NIC" type="text"></input>
            <br>
            <label for="ENT_NAF">N°NAF :</label><br>
            <input name="ENT_NAF" type="text"></input>
            <br>
            <label for="ENT_SIREN">N°SIREN :</label><br>
            <input name="ENT_SIREN" type="text"></input>
            <br>
            <label for="ENT_CLE_TVA">N°CLE TVA :</label><br>
            <input name="ENT_CLE_TVA" type="text"></input>
            <br>
            <label for="ENT_COM">Commentaire :</label><br>
            <textarea name="ENT_COM" type="text"></textarea>
            <br>
        </div>

        <?php require 'view/view_address.php'; ?>

        <div class="droite">
            <label for="MAIL_ADR">Adresse mail :</label><br>
            <input name="MAIL_ADR" type="text"></input>
            <br>
            <label for="TEL_IND">Indicatif pays :</label><br>
            <textarea name="TEL_IND" type="text"></textarea>
            <br>
            <label for="TEL_NUM">Numéro de téléphone :</label><br>
            <textarea name="TEL_NUM" type="text"></textarea>
            <br>
        </div>

        <div class="bas">
            <input name="btnForm" type="submit" value="<?php echo $sButton; ?>" ></input>
            <input name="clear" type="reset"> 
            <input name="action" value="<?php echo $sAction ?>" type="text" hidden>
        </div>
    </form>

    <form id="form_add_prs" class="form" action="index.php" method="get" hidden>
        <div class="gauche"> 
            
            <label for="PRS_ENT">Entreprise :</label><br>
            <select name="PRS_ENT"id="PRS_ENT" onChange="" >
                    <option value="0">Nom de l'entreprise</option>
                    <option value="1">truc</option>
                    <option value="2">machin</option>
                </select>
            <br>
            <label for ="PRS_NOM">Nom :</label><br>
            <input name="PRS_NOM" type="text"></input>
            <br>
            <label for ="PRS_PRENOM1">Prénom :</label><br>
            <input name="PRS_PRENOM1" type="text"></input>
            <br>
            <label for ="PRS_PRENOM2">Deuxième prénom :</label><br>
            <input name="PRS_PRENOM2" type="text"></input>
            <br>
            <label for ="PRS_PRENOM3">Troisième prénom :</label><br>
            <input name="PRS_PRENOM3" type="text"></input>
            <br>
            <label for ="PRS_DTN">Date de naissance :</label><br>
            <input name="PRS_DTN" type="text"></input>
            <br>
        </div>

        <?php require 'view/view_address.php'; ?>
        
        <div class="droite">
            <label for="MAIL_ADR">Adresse mail :</label><br>
            <input name="MAIL_ADR" type="text"></input>
            <br>
            <label for="TEL_IND">Indicatif pays :</label><br>
            <textarea name="TEL_IND" type="text"></textarea>
            <br>
            <label for="TEL_NUM">Numéro de téléphone :</label><br>
            <textarea name="TEL_NUM" type="text"></textarea>
            <br>
            <label for='CAT_CTC[]'>Catégorie contact :</label> <br>
            <input id='CB_CLI'   type="checkbox" name='CAT_CTC[]' value='Client'>Client <br>
            <input id='CB_FOUR'  type="checkbox" name='CAT_CTC[]' value='Fournisseur'>Fournisseur <br>
            <input id='CB_PRSPT' type="checkbox" name='CAT_CTC[]' value='Prospect'>Prospect <br>
        </div>
        
        <div class="bas">    
            <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
            <input name="clear"   type="reset"> 
            <input name="action"  value="<?php echo $sAction ?>" type="text" hidden>
        </div>

    </form>





</div>


