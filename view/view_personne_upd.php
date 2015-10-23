
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<link type="text/css" href="css/style_list.css" rel="stylesheet">
<script src="js/js_contact.js" type="text/javascript"></script>


   


<!--Corps de la page-->
<div class="corps">

    <!-- En-tête choix du type contact-->
    <form id="form_add_pers" class="form" action="index.php" method="get">
        <input name='token'
               type="text"
               value ='<?php echo rand(1, 1000000) ?>' 
               hidden/>

        <!--Partie gauche de l'écran : Civilité--> 
        <div class="col20" id ="addPers">
            <label for="civilite">Civilité :</label>
            <br>
            <select name="civilite" id="civilite" required>
               <option value="" selected > Aucun </option>
                <?php foreach ($resAllCivs as $oCiv) { 
                    if ($oPersonne->civ_id === $oCiv->civ_id){?>
                    <option 
                        value ="<?php echo $oCiv->civ_id ?>" selected>
                        <?php echo $oCiv->civ_code ?> </option>
                <?php }else{?>
                        <option 
                        value ="<?php echo $oCiv->civ_id ?>" >
                        <?php echo $oCiv->civ_code ?> </option>
                <?php }
                
                    } ?>
            </select>
            <br>
            <label for="cptCode">Code compte :</label>
            <br>
            <input name="cptCode" 
                   type="text"
                   value="<?php echo $oCompte->cpt_code ?>">
            <br>
            <label for="cptNom" >Nom :</label>
            <br>
            <input name="cptNom" required
                   type="text"
                   value="<?php echo $oCompte->cpt_nom ?>"
                    >
            <br>
            <label for ="prsPrenom1">Prénom :</label>
            <br>
            <input name="prsPrenom1" 
                   type="text"
                   value="<?php echo $oPersonne->prs_prenom1 ?>">
            <br>
            <label for ="prsPrenom2">Deuxième prénom :</label>
            <br>
            <input name="prsPrenom2" 
                   type="text"
                   value="<?php echo $oPersonne->prs_prenom2 ?>">
            <br>
            <label for ="prsDtn">Date de naissance :</label>
            <br>
            <input name="prsDtn" 
                   type="Date"
                   title='Date de naissance de la personne'
                   value="<?php echo $oPersonne->prs_dtn ?>">
            <br>
            <label for="cptCom">Commentaire :</label>
            <br>
            <textarea name="cptCom"
                      title='Commentaire'><?php echo $oCompte->cpt_com ?></textarea>
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
                                   value="truc@truc.fr">
                        </td>
                        <td class="bonLigneImg">
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick="delLigne('mailLigne');" class="tdImgTd"/>
                        </td>
                    </tr>
                    
                    <?php
                    //On initialise ligId la variable qui nous sert à déterminer les case à supprimer
                     $ligId=0;
                    //Pour chaque mail enregistré on créé une nouvelle ligne
                    if (is_array($resAllMail)) {
                            foreach($resAllMail as $oMail){
                                
                                $ligId=$ligId+1; ?>
                    
                             <tr id='mailLigne<?php echo $ligId ?>'>
                                 <td hidden>
                                    <input name="mailId[<?php echo $ligId ?>]"
                                           title="eg : Administratif, personnel.."
                                           type="text" 
                                           id="mailId<?php echo $ligId ?>"
                                           required
                                           value="<?php echo $oMail->mail_id ?>" >
                                </td>
                                <td>
                                    <input name="mailLbl[<?php echo $ligId ?>]"
                                           title="eg : Administratif, personnel.."
                                           type="text" 
                                           id="mailLbl<?php echo $ligId ?>"
                                           required
                                           value="<?php echo $oMail->mail_lbl ?>" >
                                </td>
                                <td>
                                    <input name="mailAdr[<?php echo $ligId ?>]" 
                                           type="email"
                                           id="mailAdr<?php echo $ligId ?>"
                                           required
                                           value="<?php echo $oMail->mail_adr ?>">
                                </td>
                               <td class="bonLigneImg">
                                     <input type="checkbox" 
                                           name="ligSupp[<?php echo $ligId ?>]" 
                                           id="ligSupp<?php echo $ligId ?>"
                                           value="<?php echo $oMail->mail_id ?>">
                                </td>
                            </tr>
                    <?php   }
                         }?>
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
                    
                  <?php
                  //On créé une ligne pour chaque téléphone présent
                  if (is_array($resAllTel)) {
                       foreach($resAllTel as $oTel){
                           
                           $ligId=$ligId+1; ?>
                        
                            <tr id='telLigne<?php echo $ligId ?>'>
                                <td hidden>
                                    <input name="telId[<?php echo $ligId ?>]"
                                           title="eg : Administratif, personnel.."
                                           type="text" 
                                           id="mailId"
                                           required
                                           value="<?php echo $oTel->tel_id ?>" >
                                </td>
                                <td >
                                <input name="telLbl[<?php echo $ligId ?>]"
                                       title="eg : Administratif, personnel.."
                                       type="text"
                                       id="telLbl<?php echo $ligId ?>"
                                       value="<?php echo $oTel->tel_lbl ?>" 
                                       required>
                                </td>
                                <td>
                                <input name="telInd[<?php echo $ligId ?>]"
                                       title="Indicatif du numéro de téléphone eg : +33.."
                                       type="text"
                                       value='<?php echo $oTel->tel_ind ?>'
                                       id="telInd<?php echo $ligId ?>"
                                       >
                                </td>
                                <td>
                                <input name="telNum[<?php echo $ligId ?>]"
                                       title="Sans l'indicatif pays eg :6 10 10 10 10.."
                                       type="text"
                                       id="telNum<?php echo $ligId ?>"
                                       value="<?php echo $oTel->tel_num ?>" 
                                       required>
                                </td>
                                <td class="bonLigneImg">
                                     <input type="checkbox" 
                                           name="ligSupp[<?php echo $ligId ?>]" 
                                           id="ligSupp<?php echo $ligId ?>"
                                           value="<?php echo $oTel->tel_id ?>">
                                </td>
                            </tr>
                 <?php } 
                   } ?>
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
                
               <?php
               //Pour chaque élément récupéré on créé une ligne adresse 
               if (is_array($resAllAdr)) {
                       foreach($resAllAdr as $oAdr){
                           $ligId=$ligId+1; ?>
                
                    <tr id='adrLigne<?php echo $ligId ?>'>
                        
                        <td class="colData" hidden>
                            <input name="adrId[<?php echo $ligId ?>]" 
                                   type="text" 
                                   id="adrLbl<?php echo $ligId ?>"
                                   value="<?php echo $oAdr->adr_id ?>" 
                                   required>
                            
                        <td class="colData">
                            <input name="adrLbl[<?php echo $ligId ?>]" 
                                   type="text" 
                                   id="adrLbl<?php echo $ligId ?>"
                                   value="<?php echo $oAdr->adr_lbl ?>"
                                   required> 
                        </td>
                        <td class="colData">
                            <input name="adrNum[<?php echo $ligId ?>]" 
                                   type="text" 
                                   value="<?php echo $oAdr->adr_num ?>" 
                                   id="adrNum<?php echo $ligId ?>"> 
                        </td>
                        <td class="colData">
                            <input name="adrVoie[<?php echo $ligId ?>]" 
                                   type="text" 
                                   value="<?php echo $oAdr->adr_voie ?>" 
                                   id="adrVoie<?php echo $ligId ?>"
                                   > 
                        </td>
                        <td class="colData">
                            <input name="adrRue1[<?php echo $ligId ?>]" 
                                   type="text" 
                                   value="<?php echo $oAdr->adr_rue1 ?>" 
                                   id="adrRue1<?php echo $ligId ?>"
                                   > 
                            <br>
                            <input name="adrRue2[<?php echo $ligId ?>]"
                                   type="text" 
                                   value="<?php echo $oAdr->adr_rue2 ?>" 
                                   id="adrRue2<?php echo $ligId ?>"
                                   > 
                            <br>
                            <input name="adrRue3[<?php echo $ligId ?>]" 
                                   type="text" 
                                   value="<?php echo $oAdr->adr_rue3 ?>" 
                                   id="adrRue3<?php echo $ligId ?>"> 
                        </td>
                        <td class="colData">
                            <input name="adrCp[<?php echo $ligId ?>]"
                                   type="text" 
                                   value="<?php echo $oAdr->adr_cp ?>" 
                                   id="adrCp<?php echo $ligId ?>"> 
                        </td>

                        <td class="colData">
                            <input name="adrVille[<?php echo $ligId ?>]"
                                   type="text" 
                                   value="<?php echo $oAdr->adr_ville ?>" 
                                   id="adrVille<?php echo $ligId ?>">
                        </td>    
                        <td class="colData"> 
                            <input name="adrEtat[<?php echo $ligId ?>]"
                                   type="text"
                                   value="<?php echo $oAdr->adr_etat ?>" 
                                   id="adrEtat<?php echo $ligId ?>"> 
                        </td>
                        <td class="colData">
                            <select name="paysId[<?php echo $ligId ?>]" 
                                    id="paysId<?php echo $ligId ?>"  
                                    required>
                          
                  <?php foreach ($resAllPays as $oPays) { 
                           if ($oAdr->pays_id === $oPays->pays_id){?>
                                <option 
                                   value ="<?php echo $oPays->pays_id ?>" selected>
                                <?php echo $oPays->pays_nom ?> </option>
                  <?php    }else{?>
                                <option 
                                value ="<?php echo $oPays->pays_id ?>" >
                                <?php echo $oPays->pays_nom ?> </option>
                    <?php }
                
                    } ?>
                            </select>
                        </td>
                         <td class="bonLigneImg">
                                     <input type="checkbox" 
                                           name="ligSupp[<?php echo $ligId ?>]" 
                                           id="ligSupp<?php echo $ligId ?>"
                                           value="<?php echo $oAdr->adr_id ?>">
                        </td>
                </tr>
                       <?php }
               } ?>
            </table>
            <input type="button" 
                   value="Ajouter ligne" 
                   onclick="addLigne('adrTable', 'adrLigne');
                            fillPays('paysId',nRowCount);"
                   >
                <script type="text/javascript">
                    //On initialise le compte de ligne pour la fonction addLigne
                    //En additionnant le nombre d'enregistrement contenue.
                     $nbMail = parseInt(<?php echo count($resAllMail) ?>);
                     $nbTel = parseInt(<?php echo count($resAllTel) ?>);
                     $nbAdr = parseInt(<?php echo count($resAllAdr) ?>);
                     nRowCount = $nbMail+$nbTel+$nbAdr;
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
                       onclick="location.href='index.php?action=pers_add'"
                       >

                <input name="action" 
                       value="<?php echo $sAction ?>" 
                       type="text" 
                       hidden
                       >
            </div>
    </form>
</div>


