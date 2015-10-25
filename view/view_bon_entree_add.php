<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>
    
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
     <link type="text/css" href="css/style_bon.css" rel="stylesheet">
    <script type="text/javascript" src="js/js_calcul.js" ></script>
    <script type="text/javascript" src="js/js_bonEntree.js" ></script>
    <div class="corps">
        <?php //Contrôle selon l'inventaire
            $tInventaire = InventaireManager::getInventaireOpen();
            if (!isset($tInventaire) || !is_array($tInventaire)){?>
        <form class="form" action="index.php" method="post" onsubmit="return ctrlFormValide();">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <div class="col30">
                
                <label for="beFactNum"> Référence de facture </label><br>
                <input name="beFactNum" 
                       id="beFactNum"
                       placeholder="Saisie" 
                       title="Numéro de la facture achat"
                       type="text"
                       >
                <br>
                <label for="beLbl"> Libellé du bon </label><br>
                <input name="beLbl" 
                       id="beLbl"
                       placeholder="texte" 
                       type="text"
                       >
                <br>
                <label for="beDate"> Date</label><br>
                <input name="beDate" 
                       id="beDate"
                       type="date"
                       required
                       value='<?php echo date('Y-m-d')?>'
                       >
                <br>
                <label for="beCom"> Commentaire</label><br>
                <textarea name="beCom" 
                          id="beCom"
                          placeholder="description"></textarea>
                <br>
            </div>
            <div class="col30">
                <label for="beFraisDouane"> Frais de douane </label><br>
                <input name="beFraisDouane" 
                       id="beFraisDouane" 
                       type="number"
                       required=""
                       min="0"
                       step="any"
                       value ="0">
                <br>
                <label for="beFraisBancaire"> Frais bancaires </label><br>
                <input name="beFraisBancaire" 
                       id="beFraisBancaire" 
                       type="number"
                       required=""
                       min="0"
                       step="any"
                       value ="0">
                <br>
                <label for="beFraisTrans"> Frais de transport </label><br>
                <input name="beFraisTrans" 
                       id="beFraisTrans" 
                       type="number"
                       min="0"
                       required=""
                       step="any"
                       value ="0">
                <br>
                
                <label for="beInfoTrans"> Information transport</label><br>
                <textarea name="beInfoTrans" 
                          placeholder="description"></textarea>
                <br>
            </div>
            <div class="col30">
                <label for="cptId"> Compte </label><br>
                <input name="cptId" 
                       id="cptId" 
                       type="texte"
                       >
                <br>
                <label for="cptNom"> Nom </label><br>
                <input name="cptNom" 
                       id="cptNom" 
                       type="texte"
                       >
                <br>
                <label for="cptCom"> Comentaire </label><br>
                <textarea name="cptCom" id="cptCom"></textarea>
                <br>
            </div>
            <div class="col90">
                <table class="beLigne" id="beTable">
                    <tr id="titreGnl" class="trColTitre">
                        <th colspan="8" class="colTitleSup">
                            Référence
                        </th>
                        <th rowspan="2" class="colTitlSupUnique">
                            DLC DLUO
                        </th>
                        <th colspan="3" class="colTitleSup">
                            Douane
                        <th colspan="2" class="colTitleSup">
                            Banque
                        </th>
                        <th colspan="2" class="colTitleSup">
                            Transport
                        </th>
                        <th colspan="2" class="colTitleSup">
                            Calcul lot
                        </th>
                        <th colspan="2" class="colTitleSup">
                            Calcul unitaire
                        </th>
                        <th rowspan="2" class="colTitlSupUnique">
                            Rapport Frais/coût
                        </th>
                        <th rowspan="2" class="colTitlSupUnique">
                            Dépôt
                        </th>
                        <th rowspan="2" class="colTitlSupUnique">
                            Commentaire
                        </th>                       
                        <th rowspan="2" class="colTitlSupUnique">
                            Supp
                        </th>
                    </tr>
                    <tr id="titreCol" class="trColTitre">
                        <th class="colTitleLeft">
                            Id
                        </th>
                        <th class="colTitleMiddle">
                            Code
                        </th>
                        <th class="colTitleMiddle">
                            Libellé
                        </th>
                        <th class="colTitleMiddle">
                            Lot
                        </th>
                        <th class="colTitleMiddle">
                            PU
                        </th>
                        <th class="colTitleMiddle">
                            Qt
                        </th>
                        <th class="colTitleMiddle">
                            Pd U
                        </th>
                        <th class="colTitleRight">
                            Poids
                        </th>
                        <th class="colTitleMiddle">
                            Taux
                        </th>
                        <th class="colTitleMiddle">
                            Taxe
                        </th>
                        <th class="colTitleRight">
                            Total
                        </th>
                        <th class="colTitleLeft">
                            Frais
                        </th>
                        <th class="colTitleRight">
                            Total
                        </th>
                        <th class="colTitleLeft">
                            Prix
                        </th>
                        <th class="colTitleRight">
                            Total
                        </th>
                        <th class="colTitleLeft">
                            Frais
                        </th>
                        <th class="colTitleRight">
                            Coûts
                        </th>
                        <th class="colTitleLeft">
                            Frais
                        </th>
                        <th class="colTitleRight">
                            Coûts
                        </th>

                    </tr>
                    <tr id="idLigne" hidden="">

                        <td>
                            <!-- Appel de fonction qui recherche une reference 
                            selon son id-->
                            <input type="number" 
                                        name="refId[NID]" 
                                        accept=""          id="refIdNID"
                                        onblur='getReference("NID",
                                                            "refIdNID",
                                                            "ref_id",
                                                            "be")' 
                                        min="0"
                                        required
                                        title="ID de la référence"
                                        value="0">
                        </td>
                        <td>
                            <input type="text"
                                       name="refCode[NID]" 
                                       id="refCodeNID"
                                       onblur='getReference("NID",
                                                            "refCodeNID",
                                                            "ref_code",
                                                            "be")'
                                        title="Code de la référence"
                                       value=" "                     
                                       required>
                        </td>
                        <td>
                            <textarea name="refLbl[NID]" 
                                      id="refLblNID"
                                      readonly=""
                                      class="beLigneT"></textarea>                           
                        </td>
                        <td>
                            <input type="text" 
                                   value="" 
                                   name="lotIdProducteur[NID]" 
                                   id="lotIdProducteurNID"
                                   title="Lot du producteur">
                        </td>
                        <td>
                            <input type="number" 
                                   value="1"
                                   min="0.01"
                                   step="any"
                                   name="beligPu[NID]" 
                                   id="beligPuNID"
                                   title="Prix unitaire"
                                   required>
                        </td>
                        <td>
                            <input type="number" 
                                   value="1"
                                   min="0.01"
                                   step="any"
                                   name="ligQte[NID]" 
                                   id ="ligQteNID"
                                   title="Quantité"
                                   required
                                   onchange='ccMultiplier(["ligQteNID",
                                                   "refPoidsBrutNID"],
                                                       "totalPoidsNID")'>
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any"
                                   name="refPoidsBrut[NID]" 
                                   id="refPoidsBrutNID"
                                   title="Poids brut de l'article"
                                   required
                                   onchange='ccMultiplier(["ligQteNID",
                                                   "refPoidsBrutNID"],
                                                       "totalPoidsNID")'>
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0.00"
                                   step="any"
                                   name="totalPoids[NID]" 
                                   id="totalPoidsNID"
                                   readonly=""
                                   title="Poids total du lot"
                                   class="readOnly"
                                   >
                        </td>
                        <td>
                            <input type="date" 
                                   name="lotDlc[NID]" 
                                   id="lotDlcNID"
                                   title="Dlc du lot"
                                   value="<?php echo date('Y-m-d')?>"
                                   style="width: 110px;"
                                   required>
                        </td>
                        <td>
                            
                            <input type="number" 
                                       value="0"
                                       min="0"
                                       step="any"
                                       name="beligDd[NID]" 
                                       id="beligDdNID"
                                       title="Droit de douane du lot"
                                       onchange='ccAddition(
                                                       ["beligDdNID", "beligTaxeNID"],
                                                       "totalFdNID")'
                                       required>
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any"
                                   name="beligTaxe[NID]" 
                                   id="beligTaxeNID"
                                   title="Taxe du lot"
                                   onchange='ccAddition(
                                                       ["beligDdNID", "beligTaxeNID"],
                                                       "totalFdNID")'
                                   required>
                        </td>
                        <td>
                            
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="totalFd[NID]" 
                                   id="totalFdNID" 
                                   readonly=""
                                   required
                                   title="Total de douane du lot"
                                   >
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any"
                                   name="beligFb[NID]" 
                                   id="beligFbNID"
                                   title="Frais bancaire du lot"
                                   required
                                   onchange='copieChamps("beligFbNID",
                                                       "totalFbNID")'>
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any"
                                   name="totalFb[NID]" 
                                   id="totalFbNID"
                                   readonly=""
                                   required
                                   class="readOnly"
                                   title="Total de frais bancaire du lot"
                                  >
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="beligFt[NID]" 
                                   required
                                   title="Frais de transport du lot"
                                   id="beligFtNID"
                                   onchange='copieChamps("beligFtNID",
                                                       "totalFtNID")'>
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="totalFt[NID]" 
                                   id="totalFtNID"
                                   readonly=""
                                   required
                                   class="readOnly"
                                   title="Total de frais de transport du lot"
                                   >
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="totalFraisLot[NID]" 
                                   id="totalFraisLotNID"
                                   readonly=""
                                   required
                                   class="readOnly"
                                   title="Total frais du lot"
                                   >
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="coutLot[NID]" 
                                   id="coutLotNID"
                                   readonly=""
                                   required
                                   class="readOnly"
                                   title="Total frais du lot"
                                   >
                        </td>
                         <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="totalFraisUnitaire[NID]" 
                                   id="totalFraisUnitaireNID"
                                   readonly=""
                                   required
                                   class="readOnly"
                                   title="Total frais unitaire"
                                   >
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="beligCuAchat[NID]" 
                                   id="beligCuAchatNID"
                                   readonly=""
                                   required
                                   class="readOnly"
                                   title="Coût unitaire"
                                   >
                        </td>
                         <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="rapportFraisCout[NID]" 
                                   id="rapportFraisCoutNID"
                                   readonly=""
                                   required
                                   class="readOnly"
                                   title="Rapport frais/coût"
                                   >
                        </td>
                        <td >
                            <textarea name="ligComDep[NID]" 
                                      id="ligComDepNID" 
                                      title="Precision pour le dépôt"
                                      class="beLigneT"></textarea>
                        </td>
                        <td>
                            <textarea name="ligCom[NID]" 
                                      id="ligComNID"  
                                      title="Commentaire du lot"
                                      class="beLigneT"></textarea>
                        </td>
                        <td>
                            <!-- Efface la ligne en cours -->
                            <img src="img/icon/delete.png" 
                                 alt="" 
                                 title="Supprimer la ligne"
                                 onclick='delLigne("idLigne")' 
                                 class="tdImgTd"/>
                        </td>
                    </tr>
                </table>
                <!-- Ajoute une ligne -->
                <input type="button" 
                       value="Ajouter ligne" 
                       onclick='addLigne("beTable", "idLigne")'>
                <script type="text/javascript">
                //On initialise le compte de ligne pour la fonction addLigne
                    nRowCount = 0;
                </script>
            </div>
            <div class="col90">
                <label for="beTotal">Total</label>
                <input type="text" 
                       name="beTotal" 
                       id="beTotal"
                       value="0"><br>
                <label for="beModePai">Mode de paiement</label>
                <textarea name="beModePai" 
                        id="beModePai" 
                        title="Mode de paiement"
                        ></textarea><br>
                <label for="beComPai">Commentaire paiement</label>
                <textarea name="beComPai" 
                        id="beComPai" 
                        title="Mode de paiement"
                        ></textarea>
            </div>
            <div class="bas">
                <input name="btnForm" 
                       type="submit" 
                       value="<?php echo $sButton; ?>">
                <!-- Mets à jour chaque champs calcul selon les champs
                de l'entête-->
                <input name="Calcul" 
                       type="button" 
                       value="Calcul" 
                       onclick="beCalcul()">
                
                <input name="clear" 
                       type="reset"> 
                <input name="action" 
                       id="action" 
                       value="<?php echo $sAction ?>" 
                       type="text" 
                       hidden>
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