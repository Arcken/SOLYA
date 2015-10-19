
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="js/CtcAddFct.js" type="text/javascript"></script>


<!--Corps de la page-->
<div class="corps">

    <!-- En-tête choix du type contact-->
    <form id="form_add_pers" class="form" action="index.php" method="get">
        <input name='token'
               type="text"
               value ='<?php echo rand(1, 1000000) ?>' 
               hidden>

        <!--Partie gauche de l'écran : Civilité--> 
        <div class="col30" id ="add_ent">
            <label for="fmju">Forme juridique :</label>
            <br>
            <select name="fmju" id="fmju" required>
                <option value="" selected > Aucun </option>
                <?php foreach ($resAllFmju as $oFmju) { ?>
                    <option 
                        value ="<?php echo $oFmju->fmju_id ?>">
                        <?php echo $oCiv->fmju_lbl ?> </option>
                <?php } ?>
            </select>
            
            <label for="catEnt">Forme juridique :</label>
            <br>
            <select name="catEnt" id="catEnt" required>
                <option value="" selected > Aucun </option>
                <?php foreach ($resAllCatEnt as $oCatEnt) { ?>
                    <option 
                        value ="<?php echo $oCatEnt->catent_id ?>">
                        <?php echo $oCatEnt->catent_lbl ?> </option>
                <?php } ?>
            </select>
            <br>
            <label for="cpt_nom">Nom :</label>
            <br>
            <input name="cpt_nom" type="text">
            <br>
        </div>


        <!-- Renseignement de l'entreprise : -->
        <div class="col30" id="add_ent">
            <br>
            <label for ="ent_horaire">Horaires :</label>
            <br>
            <input name="ent_horaire" 
                   type="text">
            <br>
            <label for ="ent_siren">N°SIREN :</label>
            <br>
            <input name="ent_siren" 
                   type="text">
            <br>
            <label for ="ent_tva">N°TVA Intra :</label>
            <br>
            <input name="ent_tva" 
                   type="text">
            <br>
            <label for ="ent_site">Site internet: </label>
            <br>
            <input name="ent_site" 
                   type="text"
                   title='Site vitrine de l\'entreprise'>
            <br>
            <label for ="ent_ecom">Site e-commerce :</label>
            <br>
            <input name="ent_ecom"
                   title='site ecommerce de l\'entreprise'
                   type="text">
            <br>
        </div>

        <!--Partie central de l'écran : Informations de localisation-->

        <div class="col30" hidden>
            <table id="addrTable">
                
                <tr>
                    <th>Numéro :</th>
                    <th>Voie :</th>
                    <th colspan='3'>Rue :</th>  
                    <th>Code postale :</th>
                    <th>Ville :</th>
                    <th>Etat :</th>
                    <th>Pays :</th>
                </tr>
                
                <tr id='addrLigne'>
                    <td>
                        <input name="adr_num" type="text"> 
                    </td>
                    <td>
                        <input name="adr_voie" type="text"> 
                    </td>
                    <td>
                        <input name="adr_rue1" type="text"> 
                        <input name="adr_rue2" type="text"> 
                        <input name="adr_rue3" type="text"> 
                    </td>
                    <td>
                        <input name="adr_cp" type="text"> 
                    </td>

                    <td>
                        <input name="adr_ville" type="text">
                    </td>    
                    <td> 
                        <input name="adr_etat" type="text"> 
                    </td>
                    <td>
                        <select name="pays_id" id="pays_id" required >
                            <option value="0" selected> --Pays-- </option>
                            <?php foreach ($toPays as $oPays) { ?>
                                <option value ="<?php echo $oPays->pays_id ?>"> <?php echo $oPays->pays_nom ?> </option>
                            <?php } ?>
                        </select>
                    </td>    
                </tr>
            </table>
            <input type="button" 
                   value="Ajouter ligne" 
                   onclick="addLigne('addrTable', 'addrLigne');"
                   >
        </div>

            <!--Partie de droite : Mail/téléphone Catégorie contact-->  
        <div class="col30" >
                <table id='tableMail'>
                    <tr>
                        <th>Libéllé du mail</th>
                        <th>Adresse mail :</th>
                    </tr>
                    <tr id='mailLigne'>
                        <td>
                            <input name="mail_lbl"
                                   title="eg : Administratif, personnel.."
                                   type="text" 
                                   >
                        </td>
                        <td>
                            <input name="mail_adr" 
                                   type="text"
                                   >
                        </td>
                    </tr>
                </table>
                <input type="button" 
                       value="Ajouter ligne" 
                       onclick="addLigne('mailTable', 'mailLigne');">
        </div>
            
        <div class="col30">
              <table id='tableTel' hidden>
                    <tr>
                        <th>Libéllé du téléphone</th>
                        <th>Indicatif pays </th>
                        <th>Numéro de téléphone </th>
                    </tr>
              
                    <tr id='telLigne'>
                        <input name="tel_lbl"
                               title="eg : Administratif, personnel.."
                               type="text"
                               >

                        <input name="tel_ind"
                               title="Indicatif du numéro de téléphone eg : +33.."
                               type="text"
                               >

                        <input name="tel_num"
                               title="Sans l'indicatif pays eg :6 10 10 10 10.."
                               type="text"
                               >
                    </tr>
            </table>
            <input type="button"
                   value="Ajouter un téléphone" 
                   onclick="addLigne('telTable', 'telLigne');">
        </div>

            <!--Zone des boutons-->
            <div class="bas" 
                 id="btn_zone" 
                 >    

                <input name="btnForm" 
                       type="submit" 
                       value="<?php echo $sButton; ?>"
                       >

                <input id ='clearForm' 
                       name="clear"   
                       type="reset" 
                       >

                <input name="action" 
                       value="<?php echo $sAction ?>" 
                       type="text" 
                       hidden
                       >
            </div>
    </form>
</div>


