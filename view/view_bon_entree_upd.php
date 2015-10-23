<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_bon.css" rel="stylesheet">
    <script type="text/javascript" src="js/calculFct.js" ></script>
    <script type="text/javascript" src="js/beFct.js" ></script>
    <div class="corps">
        <?php //Contrôle selon l'inventaire
            $tInventaire = InventaireManager::getInventaireOpen();
            if (!isset($tInventaire) || !is_array($tInventaire)){?>
        <form class="form" action="index.php" method="get" onsubmit="ctrlFormValide();">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <div class="col30">
                <label for="beId"> Bon entré numéro: </label><br>
                <input name="beId" 
                       id="beId"
                       type="text"
                       value="<?php echo $resBeDetail->be_id ?>"
                       readonly=""
                       >
                <br>
                <label for="beFactNum"> Référence de facture </label><br>
                <input name="beFactNum" 
                       id="beFactNum"
                       placeholder="description" 
                       type="text"
                       value="<?php echo $resBeDetail->be_fact_num ?>"
                       >
                <br>
                <label for="beLbl"> Libellé du bon </label><br>
                <input name="beLbl" 
                       id="beLbl"
                       placeholder="description" 
                       type="text"
                       value="<?php echo $resBeDetail->be_lbl ?>"
                       >
                <br>
                <label for="beDate"> Date</label><br>
                <input name="beDate" 
                       id="beDate"
                       placeholder="description" 
                       type="date"
                       value="<?php echo $resBeDetail->be_date ?>"
                       required=""
                       >
                <br>
                <label for="beCom"> Commentaire</label><br>
                <textarea name="beCom" 
                          id="beCom"
                          placeholder="description"><?php echo $resBeDetail->be_com ?></textarea>
                <br>
            </div>
            <div class="col30">
                <label for="beFraisDouane"> Frais de douane </label><br>
                <input name="beFraisDouane" 
                       id="beFraisDouane" 
                       type="number"
                       min="0"
                       step="0.01"
                       value="<?php echo $resBeDetail->be_frais_douane ?>">
                <br>
                <label for="beFraisBancaire"> Frais bancaires </label><br>
                <input name="beFraisBancaire" 
                       id="beFraisBancaire" 
                       type="number"
                       min="0"
                       step="0.01"
                       value="<?php echo $resBeDetail->be_frais_bancaire ?>">
                <br>
                <label for="beFraisTrans"> Frais de transport </label><br>
                <input name="beFraisTrans" 
                       id="beFraisTrans" 
                       type="number"
                       min="0"
                       step="0.01"
                       value="<?php echo $resBeDetail->be_frais_trans ?>">
                <br>

                <label for="beInfoTrans"> Information transport</label><br>
                <textarea name="beInfoTrans" 
                          placeholder="description"
                          ><?php echo $resBeDetail->be_info_trans ?></textarea>
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
                        <th rowspan="2" class="colTitlSupUnique">
                            ID ligne
                        </th>
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
                        <th></th> <!-- colonne pour le champs cahé lotId -->

                    </tr>

                    <!-- Squelette des lignes
                    Une fonction js copie le code html entre les balise tr 
                    où id=idLigne et le rajoute à la fin du tr en rennomant les id
                    NID est remplacé par incrément et idligne est complété du
                    même incrément
                    -->
                    <tr id="idLigne" hidden="">
                        <td class="beLigneId">
                            <input type="text"
                                   name="ligId[NID]" 
                                   id="ligIdNID"
                                   readonly="">
                        </td>
                        <td  class="beLigneId">
                            <!-- Appel de fonction qui recherche une reference 
                            selon son id, il faut préciser le champs-->
                            <input type="number" 
                                   name="refId[NID]" 
                                   id="refIdNID"
                                   onblur='getReference("NID",
                                                       "refIdNID",
                                                       "ref_id",
                                                       "be")' min="0">
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
                                      class="beLigneT"
                                      readonly=""></textarea>                           
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
                        <input type="number" 
                                   value=""
                                   hidden=""                                  
                                   name="lotId[NID]" 
                                   id="lotIdNID"
                                   >
                    </tr>


                    <!-- Fin du squelette-->    


                    <!-- Construction des lignes récupérées-->

                    <?php
                    //Pour chaque ligne de bon
                    if (isset($resAllBeLigneBE) && is_array($resAllBeLigneBE)){
                    for ($i = 0; $i < count($resAllBeLigneBE); $i++) {
                        //l'id du tr html est i+1, 0 étant celle du squellette
                        $idLigne = $i + 1;
                        //On récupère un objet be_ligne
                        $oBelig = $resAllBeLigneBE[$i];
                        //On récupère un objet ligne
                        $oLigne = $resLignes[$i];
                        //On récupère un objet lot
                        $oLot = $resAllLots[$i];
                        //On récupére un objet référence
                        $oRef = $resAllRefs[$i];
                        //On récupére un objet droit douane
                        $oDd = $resAllDds[$i];
                        ?>
                        <tr id="idLigne<?php echo $idLigne ?>">
                            <td class="beLigneId">
                                <input type="text"
                                       name="ligId[<?php echo $idLigne ?>]" 
                                       id="ligId<?php echo $idLigne ?>"
                                       value="<?php echo $oBelig->lig_id ?>"
                                       readonly="">
                            </td>
                            <td  class="beLigneId">
                                <!-- Appel de fonction qui recherche une reference 
                                selon son id, il faut préciser le champs-->
                                <input type="number" 
                                       name="refId[<?php echo $idLigne ?>]" 
                                       id="refId<?php echo $idLigne ?>"
                                       value="<?php echo $oLot->ref_id ?>"
                                       onblur='getReference("<?php echo $idLigne ?>",
                                                               "refId<?php echo $idLigne ?>",
                                                               "ref_id",
                                                               "be")' min="0">
                            </td>
                            <td class="beLigneCode">
                                <input type="text"
                                       name="refCode[<?php echo $idLigne ?>]" 
                                       id="refCode<?php echo $idLigne ?>"
                                       value="<?php echo $oRef->ref_code ?>">
                            </td>
                            <td>
                                <textarea name="refLbl[<?php echo $idLigne ?>]" 
                                          id="refLbl<?php echo $idLigne ?>"
                                          class="beLigneT"
                                          readonly=""
                                          ><?php echo $oRef->ref_lbl ?></textarea>                           
                            </td>
                            <td class="beLigneNb">
                                <input type="text" 
                                       name="lotIdProducteur[<?php echo $idLigne ?>]" 
                                       id="lotIdProducteur<?php echo $idLigne ?>"
                                       title="Lot du producteur"
                                       value="<?php echo $oLot->lot_id_producteur ?>">
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0.01"
                                       step="0.01"
                                       name="beligPu[<?php echo $idLigne ?>]" 
                                       id="beligPu<?php echo $idLigne ?>"
                                       value="<?php echo $oBelig->belig_pu ?>">
                            </td>
                            <td class="beLigneNb">
                                <!-- La quantité minimum que l'on peut mettre à
                                jour est définie par un calcul-->
                                <input type="number"
                                       step="0.01"
                                       name="ligQte[<?php echo $idLigne ?>]" 
                                       id ="ligQte<?php echo $idLigne ?>"
                                       value="<?php echo $oLigne->lig_qte ?>"
                                       min="<?php echo $oLot->lot_qt_stock ?>")>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       name="refPoidsBrut[<?php echo $idLigne ?>]" 
                                       id="refPoidsBrut<?php echo $idLigne ?>"
                                       value="<?php echo $oRef->ref_poids_brut ?>"
                                       >
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       name="totalPoids[<?php echo $idLigne ?>]" 
                                       id="totalPoids<?php echo $idLigne ?>"
                                       readonly=""
                                       onfocus='ccMultiplier(["ligQte<?php echo $idLigne ?>",
                                                           "refPoidsBrut<?php echo $idLigne ?>"],
                                                            "totalPoids<?php echo $idLigne ?>")'>
                            </td>

                            <td>
                            <input type="date" 
                                   name="lotDlc[<?php echo $idLigne ?>]" 
                                   id="lotDlc<?php echo $idLigne ?>"
                                   title="Dlc du lot"
                                   value="<?php echo $oLot->lot_dlc ?>"
                                   style="width: 110px;"
                                   required>
                            </td>
                            <td class="beLigneNb">
                                <!-- Calcul droit de douane selon le pu et le taux 
                                récupérés par getreference-->
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       value="<?php echo $oBelig->belig_dd ?>" 
                                       name="beligDd[<?php echo $idLigne ?>]" 
                                       id="beligDd<?php echo $idLigne ?>"
                                       required=""
                                       onchange='ccAddition(
                                                       ["beligDdNID", "beligTaxeNID"],
                                                       "totalFdNID")'>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       value="<?php echo $oBelig->belig_taxe ?>" 
                                       name="beligTaxe[<?php echo $idLigne ?>]" 
                                       id="beligTaxe<?php echo $idLigne ?>"
                                       onchange='ccAddition(
                                                       ["beligDdNID", "beligTaxeNID"],
                                                       "totalFdNID")'
                                            required="">
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="any"
                                       value="<?php echo ($oBelig->belig_dd + $oBelig->belig_taxe) ?>" 
                                       name="totalFd[<?php echo $idLigne ?>]" 
                                       id="totalFd<?php echo $idLigne ?>" 
                                       required=""
                                       readonly="">
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="any"
                                       value="<?php echo $oBelig->belig_fb ?>"
                                       name="beligFb[<?php echo $idLigne ?>]" 
                                       id="beligFb<?php echo $idLigne ?>"
                                       onchange='copieChamps("beligFbNID",
                                                       "totalFbNID")'>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="any"
                                       name="totalFb[<?php echo $idLigne ?>]" 
                                       id="totalFb<?php echo $idLigne ?>"
                                       readonly=""
                                       >
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       value="<?php echo $oBelig->belig_ft ?>"
                                       name="beligFt[<?php echo $idLigne ?>]" 
                                       id="beligFt<?php echo $idLigne ?>"
                                       required=""
                                       onchange='copieChamps("beligFtNID",
                                                       "totalFtNID")'>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       name="totalFt[<?php echo $idLigne ?>]" 
                                       id="totalFt<?php echo $idLigne ?>"
                                       readonly=""
                                       >
                            </td>
                            <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="totalFraisLot[<?php echo $idLigne ?>]" 
                                   id="totalFraisLot<?php echo $idLigne ?>"
                                   readonly=""
                                   required
                                   title="Total frais du lot"
                                   >
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="coutLot[<?php echo $idLigne ?>]" 
                                   id="coutLot<?php echo $idLigne ?>"
                                   readonly=""
                                   required
                                   title="Total frais du lot"
                                   >
                        </td>
                         <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="totalFraisUnitaire[<?php echo $idLigne ?>]" 
                                   id="totalFraisUnitaire<?php echo $idLigne ?>"
                                   readonly=""
                                   required
                                   title="Total frais unitaire"
                                   >
                        </td>
                        <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="beligCuAchat[<?php echo $idLigne ?>]" 
                                   id="beligCuAchat<?php echo $idLigne ?>"
                                   value='<?php echo $oBelig->belig_cu_achat ?>'
                                   readonly=""
                                   required
                                   title="Coût unitaire"
                                   >
                        </td>
                         <td>
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="rapportFraisCout[<?php echo $idLigne ?>]" 
                                   id="rapportFraisCout<?php echo $idLigne ?>"
                                   readonly=""
                                   required
                                   title="Rapport frais/coût"
                                   >
                        </td>
                            <td >
                                <textarea name="ligComDep[<?php echo $idLigne ?>]" 
                                          id="ligComDep<?php echo $idLigne ?>" 
                                          class="beLigneT"
                                          ><?php echo $oLigne->lig_com_dep ?></textarea>
                            </td>
                            <td>
                                <textarea name="ligCom[<?php echo $idLigne ?>]" 
                                          id="ligCom<?php echo $idLigne ?>"  
                                          class="beLigneT"
                                          ><?php echo $oLigne->lig_com ?></textarea>
                            </td>
                            <td  class="beLigneImg">
                                <!-- Pour supprimer les lignes qui existe déja, 
                                on affiche une case à cocher si l'id du lot
                                n'est pas présent dans le tableau $resAllLotsBons-->
                                 <?php 
                                       if (!in_array($oLot->lot_id, $resAllLotsBons)){ ?>
                                <input type="checkbox" 
                                       name="ligSupp[<?php echo $idLigne ?>]" 
                                       id="ligSupp<?php echo $idLigne ?>"
                                       >
                                       <?php } ?>
                            </td>
                            <input type="number" 
                                   value="<?php echo $oLot->lot_id ?>"
                                   hidden=""                                  
                                   name="lotId[<?php echo $idLigne ?>]" 
                                   id="lotId<?php echo $idLigne ?>"
                                   >
                        </tr>
                        <!-- Fin construction lignes récupérées-->

                    <?php } }?>
                </table>
                <!-- Ajoute une ligne -->
                <input type="button" 
                       value="Ajouter ligne" 
                       onclick='addLigne("beTable", "idLigne")'>
                <!-- On rajout un arg taille tab de ligne-->
                <script type="text/javascript">
                    //On initialise le compte de ligne pour la fonction addLigne
                    nRowCount = parseInt(<?php echo count($resAllBeLigneBE) ?>);
                </script>
            </div>
             <div class="col90">
                <label for="beTotal">Total</label>
                <input type="text" 
                       name="beTotal" 
                       id="beTotal"
                       value="<?php echo $resBeDetail->be_total ?>"
                       readonly=""><br>
                <label for="beModePai">Mode de paiement</label>
                <textarea name="beModePai" 
                        id="beModePai" 
                        title="Mode de paiement"
                        ><?php echo $resBeDetail->be_mode_pai ?></textarea><br>
                <label for="beComPai">Commentaire paiement</label>
                <textarea name="beComPai" 
                        id="beComPai" 
                        title="Mode de paiement"
                        ><?php echo $resBeDetail->be_com_pai ?></textarea>
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