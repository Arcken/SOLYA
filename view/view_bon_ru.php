<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_bon.css" rel="stylesheet">
    <script type="text/javascript" src="js/bonFct.js" ></script>

    <div class="corps">
        <form class="form" action="index.php" method="get">
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

                <label for="numFact"> Numéro de facture </label><br>
                <input name="numFact"  id="nFact" 
                       placeholder="Numéro de Facture" 
                       value="<?php if (isset($oBon->bon_fact_num)) {
                                        echo $oBon->bon_fact_num;
                                    } ?>" 
                       type="text" >
                <br>
                <label for="typeBon"> Type du bon </label><br>

                <?php foreach ($resDocLbl as $lbl) {
                    if ($oBon->doclbl_id === $lbl->doclbl_id) {
                        ?>
                        <input name="typeBon" id="typeBon" 
                               placeholder="description" 
                               type="text"
                               value="<?php echo $lbl->doclbl_id; ?>" 
                               hidden> 
                        <input type="text" 
                               value="<?php echo $lbl->doclbl_lbl; ?>" 
                               title="Non modifiable" disabled>
        <?php } ?>
    <?php } ?>
                </select>
                <br>
                <label for="bonDate"> Date</label><br>
                <input name="bonDate" 
                       placeholder="Date" 
                       type="Date"
                       format='DD-MM-YYYY'
                       required 
                       value="<?php echo $oBon->bon_date ?>">
                <br>
                <label for="bonCom">Commentaire</label><br>
                <textarea name="bonCom" 
                          placeholder="Commentaire"><?php echo $oBon->bon_com ?></textarea>
                <br>
                <?php
                switch ($oBon->doclbl_id) {

                    case '8':
                    case '9':
                    case '10':
                    case '11':
                    case '12':
                        ?>
                        <div id='divBsArea' >
                            <label for="bonSortie">Bon de sortie associé :</label><br>
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
                        <th rowspan="2">
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
                        <td class="bonLigneId">
                            <input type="text"
                                   name="ligId[]" 
                                   id="ligIdNID"
                                   >
                        </td>
                        <td  class="bonLigneId">
                            <input type="text" 
                                   name="refId[]" 
                                   id='refIdNID' 
                                   onblur="getReferenceBonFromId('NID');">
                        </td>
                        <td class="bonLigneCode">
                            <input type="text" 
                                   value="" name="refCode[]" id='refCodeNID' 
                                   onblur="getReferenceBonFromRefCode('NID');">
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
                                   onfocus="getLotsFromCurReference('NID');"
                                   >
                        </td>
                        <td class="bonLigneNb">
                            <input type="number" name="ligQte[]" id='ligQteNID' value="" 
                                   step="any"
                                   onblur="confirmQteStock('NID');"
                                   onfocus="limitQteMax('NID');" min='1'cols="15" >
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
                                <td class="bonLigneId">
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
                                           onblur='getReferenceBonFromId("<?php echo $ligId ?>")'>
                                </td>
                                <td class="bonLigneCode">
                                    <input type="text"
                                           name="refCode[<?php echo $ligId ?>]" 
                                           id="refCode<?php echo $ligId ?>"
                                           value="<?php echo $oRef->ref_code ?>"
                                           onblur="getReferenceBonFromRefCode('<?php echo $ligId ?>')">
                                </td>
                                <td>
                                    <textarea name="refLbl[<?php echo $ligId ?>]" 
                                              id="refLbl<?php echo $ligId ?>"
                                              class="beLigneT"
                                              ><?php echo $oRef->ref_lbl ?></textarea>                           
                                </td>
                                <td class="bonLigneId">
                                    <input type="text" 
                                           name="lotId[<?php echo $ligId ?>]" 
                                           id='lotId<?php echo $ligId ?>' 
                                           onfocus="getLotsFromCurReference('<?php echo $ligId ?>');"
                                           value=<?php echo $oLot->lot_id ?>
                                           >
                                </td>
                                <td class="bonLigneNb">
                                    <input type="number" name="ligQte[<?php echo $ligId ?>]"
                                           step="any"
                                           id='ligQte<?php echo $ligId ?>' 
                                           value="<?php echo $oLigne->lig_qte; ?>" 
                                           onblur="confirmQteStock('<?php echo $ligId ?>');"
                                           onfocus="limitQteMax('<?php echo $ligId ?>');" min='0'
                                           cols="15" >
                                </td>
                                <td class="bonLigneNb" hidden>
                                    <input type="number" name="ligQteOld[<?php echo $ligId ?>]"
                                           step="any"    
                                           id='ligQteOld<?php echo $ligId ?>' 
                                           value="<?php echo $oLigne->lig_qte; ?>"
                                           onblur="confirmQteStock('<?php echo $ligId ?>');"
                                           onfocus="limitQteMax('<?php echo $ligId ?>');" min='1' >
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
                <input type="button" value="Ajouter ligne" onclick="addLigne('bonTable');">

                <script type="text/javascript">
                    //On initialise le compte de ligne pour la fonction addLigne
                    nRowCount = parseInt(<?php echo count($resAllBonLignes) ?>);
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
    echo 'Le silence est d\'or';
}
