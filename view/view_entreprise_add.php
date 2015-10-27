
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<link type="text/css" href="css/style_list.css" rel="stylesheet">
<script src="js/js_contact.js" type="text/javascript"></script>


<!--Corps de la page-->
<div class="corps">

    <!-- En-tête choix du type contact-->
    <form id="form_ent_pers" class="form" action="index.php" method="get">
        <input name='token'
               type="text"
               value ='<?php echo rand(1, 1000000) ?>' 
               hidden>

        <!--Partie informations de l'entreprise--> 
        <div class="col20" id ="add_ent">
            <label for="fmju">Forme juridique :</label>
           
            <select name="fmju" id="fmju" required>
                <option value="" selected > Aucun </option>
                <?php foreach ($resAllFmju as $oFmju) { ?>
                    <option 
                        value ="<?php echo $oFmju->fmju_id ?>">
                        <?php echo $oFmju->fmju_id ?> </option>
                <?php } ?>
            </select>
            
            <label for="catEnt">Catégorie:</label>
           
            <select name="catEnt" id="catEnt" required>
                <option value="" selected > Aucun </option>
                <?php foreach ($resAllCatEnt as $oCatEnt) { ?>
                    <option 
                        value ="<?php echo $oCatEnt->catent_id ?>">
                        <?php echo $oCatEnt->catent_lbl ?> </option>
                <?php } ?>
            </select>
           
            <label for="cptCode">Code compte :</label>
           
            <input name="cptCode" type="text">
           
            <label for="cptNom">Nom :</label>
       
            <input name="cptNom" type="text" required>
        
            <label for ="entHoraire">Horaires :</label>
      
            <input name="entHoraire" 
                   type="text">
      
            <label for ="entSiren">N°SIREN :</label>
        
            <input name="entSiren" 
                   type="text">
      
            <label for ="entTva">N°TVA Intra :</label>
    
            <input name="entTva" 
                   type="text">
    
            <label for ="entSite">Site internet: </label>
       
            <input name="entSite" 
                   type="text"
                   title='Site vitrine de l\'entreprise'>
         
            <label for ="entEcom">Site e-commerce :</label>
    
            <input name="entEcom"
                   title='site ecommerce de l\'entreprise'
                   type="text">
      
            <label for="cptCom">Commentaire :</label>
     
            <textarea name="cptCom" title='Commentaire'></textarea>
        </div>
     <!--Partie de Mail/téléphone -->  
        <div class="col30" >
                <table id='tableMail' class="tableList">
                    <tr>
                        <th class="colTitle">Libellé du mail</th>
                        <th class="colTitle">Adresse mail :</th>
                    </tr>
                    <tr id='mailLigne' hidden>
                        <td>
                            <input name="mailLbl[]"
                                   title="eg : Administratif, personnel.."
                                   type="text" 
                                   id="mailLblNID"
                                   required
                                   value="0" >
                        </td>
                        <td>
                            <input name="mailAdr[]" 
                                   type="email"
                                   id="mailAdrNID"
                                   required
                                   value="truc@truc.fr" >
                        </td>
                        <td class="bonLigneImg">
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick="delLigne('mailLigne');" class="tdImgTd"/>
                        </td>
                    </tr>
                </table>
                <input type="button" 
                       value="Ajouter mail" 
                       onclick="addLigne('tableMail', 'mailLigne');">
        </div>
            
        <div class="col40">
              <table id='tableTel' class="tableList">
                    <tr>
                        <th class="colTitle">Libellé du téléphone</th>
                        <th class="colTitle">Indicatif pays </th>
                        <th class="colTitle">Numéro de téléphone </th>
                    </tr>
              
                    <tr id='telLigne' hidden>
                        <td >
                        <input name="telLbl[]"
                               title="eg : Administratif, personnel.."
                               type="text"
                               id="telLblNID"
                               value="0" 
                               required>
                        </td>
                        <td>
                        <input name="telInd[]"
                               title="Indicatif du numéro de téléphone eg : +33.."
                               type="text"
                               id="telIndNID"
                               >
                        </td>
                        <td>
                        <input name="telNum[]"
                               title="Sans l'indicatif pays eg :6 10 10 10 10.."
                               type="text"
                               id="telNumNID"
                               value="0" 
                               required>
                        </td>
                        <td class="bonLigneImg">
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick="delLigne('telLigne');" class="tdImgTd"/>
                        </td>
                    </tr>
            </table>
            <input type="button"
                   value="Ajouter un téléphone" 
                   onclick="addLigne('tableTel', 'telLigne');">
        </div>
        <!--Partie Adresse l'écran :-->

        <div class="col90">
            <table id="adrTable" class="tableList">
                
                <tr>
                    <th class="colTitle">Libellé de l'adresse</th>
                    <th class="colTitle">Numéro </th>
                    <th class="colTitle">Voie </th>
                    <th class="colTitle">Rue </th>  
                    <th class="colTitle">Code postal </th>
                    <th class="colTitle">Ville </th>
                    <th class="colTitle">Etat </th>
                    <th class="colTitle">Pays </th>
                </tr>
                
                <tr id='adrLigne'
                    hidden>
                    <td class="colData">
                        <input name="adrLbl[]" 
                               type="text" 
                               id="adrLblNID"
                               value="0" 
                               required> 
                    </td>
                    <td class="colData">
                        <input name="adrNum[]" 
                               type="text" 
                               id="adrNumNID"> 
                    </td>
                    <td class="colData">
                        <input name="adrVoie[]" 
                               type="text" 
                               id="adrVoieNID"
                               > 
                    </td>
                    <td class="colData">
                        <input name="adrRue1[]" 
                               type="text" 
                               id="adrRue1NID"
                               > 
                        <br>
                        <input name="adrRue2[]"
                               type="text" 
                               id="adrRue2NID"
                               > 
                        <br>
                        <input name="adrRue3[]" 
                               type="text" 
                               id="adrRue3NID"> 
                    </td>
                    <td class="colData">
                        <input name="adrCp[]"
                               type="text" 
                               id="adrCpNID"> 
                    </td>

                    <td class="colData">
                        <input name="adrVille[]"
                               type="text" 
                               id="adrVilleNID">
                    </td>    
                    <td class="colData"> 
                        <input name="adrEtat[]"
                               type="text"
                               id="adrEtatNID"> 
                    </td>
                    <td class="colData">
                        <select name="paysId[]" id="paysIdNID" required>
                            <option value="0" selected> --Pays-- </option>
                            <!--La combobox est vide car elle est remplie en ajax-->
                        </select>
                    </td>
                    <td class="bonLigneImg">
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick="delLigne('adrLigne');" class="tdImgTd"/>
                    </td>
                </tr>
            </table>
            <input type="button" 
                   value="Ajouter ligne" 
                   onclick="addLigne('adrTable', 'adrLigne');
                            fillPays('paysId',nRowCount);"
                   >
                <script type="text/javascript">
                    nRowCount=1;
                </script>
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


