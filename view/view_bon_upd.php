<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_bon.css" rel="stylesheet">
    <script type="text/javascript" src="js/js_bon.js" ></script>

    <div class="corps">
        
        <?php //Contrôle selon l'inventaire
            $tInventaire = InventaireManager::getInventaireOpen();
            if (!isset($tInventaire) || !is_array($tInventaire)){?>
        <form class="form" action="index.php" method="post"  onsubmit='return uniqueValueInForm("lotId")'>
            <div class="col50">
                <!-- valeur du token du formulaire en cours -->
                <input name='token' 
                       type="text" 
                       value ='<?php echo rand(1, 1000000) ?>' 
                       hidden/>

                <input name='bonId' 
                       type="text" 
                       value ='<?php echo $oBon->bon_id; ?>' 
                       hidden/>

                <label for="numFact"> Numéro de facture </label>
                <input name="numFact"  id="nFact" 
                       placeholder="Numéro de Facture" 
                       value="<?php if (isset($oBon->bon_fact_num)) {
                                        echo $oBon->bon_fact_num;
                                    } ?>" 
                       type="text" >
                
                <label for="typeBon"> Type du bon </label>
                    <input type="text" 
                        value="<?php echo $oDocLbl->doclbl_lbl; ?>" 
                        title="Non modifiable" readonly>
                
                
                    <input type="text" 
                        value="<?php echo $oDocLbl->doclbl_id; ?>" 
                        title="Non modifiable" 
                        id="typeBonId" hidden>
               
                <label for="bonDate"> Date</label>
                <input name="bonDate" 
                       placeholder="Date" 
                       type="Date"
                       format='DD-MM-YYYY'
                       required 
                       value="<?php echo $oBon->bon_date ?>">
               
                <label for="bonCom">Commentaire</label>
                <textarea name="bonCom" 
                          placeholder="Commentaire"><?php echo $oBon->bon_com ?></textarea>
                
                <label for="cptId"> N°compte associé:</label>
                
                <input name="cptId" 
                       placeholder="Identifiant compte associé" 
                       type="texte"
                       value="<?php echo $oBon->cpt_id ?>">
               
                <?php
                switch ($oBon->doclbl_id) {

                    case '8':
                    case '9':
                    case '10':
                    case '11':
                    case '12':
                        ?>
                        <div id='divBsArea' >
                            <label for="bonSortie">Bon de sortie associé :</label>
                            <input name="bonSortie" 
                                   placeholder="N° du bon de sortie" 
                                   id="bonSortie" value="<?php echo $oBon->bon_sortie_assoc ?>">
                        </div>
            <?php break;
    }
    ?>
            </div>
            <div class="col90" id="divTable">
                <table  id="bonTable">
                    <tr>
                        <th rowspan="2" hidden>
                            Ligne Id
                        </th>
                        <th colspan="3">
                            Référence
                        </th>
                        <th colspan="2">
                            Lot
                        </th>
                        <th rowspan="2">
                            Dépôt
                        </th>
                        <th rowspan="2">
                            Commentaire
                        </th>                        
                        <th rowspan="2" id="thImg"> Supprimer
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Code
                        </th>
                        <th>
                            Libellé
                        </th>
                        <th>
                            N°Lot
                        </th>
                        <th>
                            Qte
                        </th>


                    </tr>
                    <!-- Squelette de construction des lignes-->
                    <tr id="idLigne" hidden>
                        <td class="bonLigneId" hidden>
                            <input type="text"
                                   name="ligId[]" 
                                   id="ligIdNID"
                                   value="0"
                                   >
                        </td>
                        <td  class="bonLigneId">
                            <input type="text" 
                                   name="refId[]" 
                                   id='refIdNID' 
                                   onblur="getReferenceBonFromId('NID');"
                                   value="1"
                                   required>
                        </td>
                        <td class="bonLigneCode">
                            <input type="text" 
                                   value="" name="refCode[]" id='refCodeNID' 
                                   onblur="getReferenceBonFromRefCode('NID');"
                                   >
                        </td>
                        <td>
                            <textarea name="refLbl[]" 
                                      id='refLblNID' 
                                      class="bonLigneT"
                                      rows="4" cols="30"
                                      ></textarea>

                        </td>
                        <td class="bonLigneId">
                            <input type="text" 
                                   name="lotId[]" id='lotIdNID' 
                                   required
                                   value="1"
                                   onfocus="getLotsFromCurReference('NID');"
                                   >
                        </td>
                        <td class="bonLigneNb">
                            <input type="number" name="ligQte[]" id='ligQteNID' value="1" 
                                   step="any"
                                   onkeyup="confirmQteStock('NID');"
                                   onfocus="limitQteMax('NID');" min='1'cols="15" 
                                   required>
                        </td>

                        <td >
                            <textarea name="ligComDep[]" id='ligDepotNID' 
                                      class="bonLigneT"
                                      rows="2" cols="30"></textarea>
                        </td>
                        <td>
                            <textarea name="ligCom[]" id ='ligComNID' 
                                      class="bonLigneT" 
                                      rows="2" cols="30"></textarea>
                        </td>
                        <td class="bonLigneImg">
                            <img src="img/icon/delete.png" 
                                 alt="" 
                                 title="Supprimer"
                                 onclick="delLigne('idLigne');" />
                        </td>
                    </tr>
                    <?php
                    if (is_array($resAllBonLignes)) {
                        //Pour chaque ligne de bon
                        for ($i = 0; $i < count($resAllBonLignes); $i++) {
                            //l'id du tr html est i+1, 0 étant celle du squellette
                            $ligId = $i + 1;
                            //On récupère un objet be_ligne
                            $oBonLig = $resAllBonLignes[$i];
                            //On récupère un objet ligne
                            $oLigne = $resLignes[$i];
                            //On récupère un objet lot
                            $oLot = $resAllLots[$i];
                            //On récupére un objet référence
                            $oRef = $resAllRefs[$i];
                            ?>
                            <tr id="idLigne<?php echo $ligId ?>">
                                <td class="bonLigneId" hidden>
                                    <input type="text"
                                           name="ligId[<?php echo $ligId ?>]" 
                                           id="ligId<?php echo $ligId ?>"
                                           value="<?php echo $oBonLig->lig_id ?>">
                                </td>
                                <td  class="bonLigneId">

                                    <input type="texte" 
                                           name="refId[<?php echo $ligId ?>]" 
                                           id="refId<?php echo $ligId ?>"
                                           value="<?php echo $oLot->ref_id ?>"
                                           onblur='getReferenceBonFromId("<?php echo $ligId ?>")'
                                           required>
                                </td>
                                <td class="bonLigneCode">
                                    <input type="text"
                                           name="refCode[<?php echo $ligId ?>]" 
                                           id="refCode<?php echo $ligId ?>"
                                           value="<?php echo $oRef->ref_code ?>"
                                           onblur="getReferenceBonFromRefCode('<?php echo $ligId ?>')"
                                           required>
                                </td>
                                <td>
                                    <textarea name="refLbl[<?php echo $ligId ?>]" 
                                              id="refLbl<?php echo $ligId ?>"
                                              class="beLigneT"
                                              required
                                              ><?php echo $oRef->ref_lbl ?></textarea>                           
                                </td>
                                <td class="bonLigneId">
                                    <input type="text" 
                                           name="lotId[<?php echo $ligId ?>]" 
                                           id='lotId<?php echo $ligId ?>' 
                                           onfocus="getLotsFromCurReference('<?php echo $ligId ?>');"
                                           required
                                           value="<?php echo $oLot->lot_id ?>"
                                           >
                                </td>
                                <td class="bonLigneNb">
                                    <input type="number" name="ligQte[<?php echo $ligId ?>]"
                                           step="any"
                                           id='ligQte<?php echo $ligId ?>' 
                                           value="<?php echo $oLigne->lig_qte; ?>" 
                                           onblur="confirmQteStock('<?php echo $ligId ?>');"
                                           onfocus="limitQteMax('<?php echo $ligId ?>');" min='0'
                                           required
                                           cols="15" >
                                </td>
                                <td class="bonLigneNb" hidden>
                                    <input type="number" name="ligQteOld[<?php echo $ligId ?>]"
                                           step="any"    
                                           id='ligQteOld<?php echo $ligId ?>' 
                                           value="<?php echo $oLigne->lig_qte; ?>"
                                           onblur="confirmQteStock('<?php echo $ligId ?>');"
                                           onfocus="limitQteMax('<?php echo $ligId ?>');" min='1'
                                           required>
                                </td>
                                <td class="bonLigneNb">
                                    <textarea name="ligComDep[<?php echo $ligId ?>]" 
                                              id="ligComDep<?php echo $ligId ?>" 
                                              class="beLigneT"
                                              ><?php echo $oLigne->lig_com_dep ?></textarea>
                                </td>
                                <td>
                                    <textarea name="ligCom[<?php echo $ligId ?>]" 
                                              id="ligCom<?php echo $ligId ?>"  
                                              class="beLigneT"
                                              ><?php echo $oLigne->lig_com ?></textarea>
                                </td>
                                <td>

                                    <input type="checkbox" 
                                           name="ligSupp[<?php echo $ligId ?>]" 
                                           id="ligSupp<?php echo $ligId ?>"
                                           value="<?php echo $ligId ?>">

                                </td>
                            </tr>
                      <?php }
                        }?>   
                </table>
                <input type="button" value="Ajouter ligne" onclick="addLigne('bonTable','idLigne');">

                <script type="text/javascript">
                    //On initialise le compte de ligne pour la fonction addLigne
                    nRowCount = parseInt(<?php if (is_array($resAllBonLignes)){
                        echo count($resAllBonLignes) ;
                        } else {
                            echo 0;
                        }
                        ?>
                </script>
            </div>
            <div class="bas" id="zoneBtnBon" >
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input id='clearForm' name="clear" type="reset"> 
                <input name="retour" type="button" onclick="location.href = 'index.php?action=bon_list'" value="retour">
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
            </div>
        </form>

    </div>

    <?php
        } else {
            echo $invMes;
        }
    } else {
        echo 'Le silence est d\'or';
    }