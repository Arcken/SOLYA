<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>



    <!--


                    Ajouter le mode de paiement







    -->




    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <script type="text/javascript" src="js/calculFct.js" ></script>
    <script type="text/javascript" src="js/beFct.js" ></script>
    <div class="corps">
        <form class="form" action="index.php" method="get">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <div class="col50">
                <label for="beId"> Bon entré numéro: </label><br>
                <input name="beId" 
                       id="beId"
                       type="text"
                       value="<?php echo $resBeDetail->be_id ?>"
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
                       >
                <br>
                <label for="beCom"> Commentaire</label><br>
                <textarea name="beCom" 
                          id="beCom"
                          placeholder="description"><?php echo $resBeDetail->be_com ?></textarea>
                <br>
            </div>
            <div class="col50">
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

            <div class="col90">
                <table class="beLigne" id="beTable">
                    <tr id="titreGnl">
                        <th rowspan="2">
                            ID ligne
                        </th>
                        <th colspan="8">
                            Référence
                        </th>
                        <th colspan="4">
                            Douane
                        <th colspan="2">
                            Banque
                        </th>
                        <th colspan="2">
                            Transport
                        </th>
                        <th rowspan="2">
                            Total ligne
                        </th>
                        <th rowspan="2">
                            DLC DLUO
                        </th>
                        <th rowspan="2">
                            Dépôt
                        </th>
                        <th rowspan="2">
                            Commentaire
                        </th>
                        <th rowspan="2">
                            Coût unitaire
                        </th>
                        <th rowspan="2">
                            Supp
                        </th>
                    </tr>
                    <tr id="titreCol">
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
                            Lot
                        </th>
                        <th>
                            PU
                        </th>
                        <th>
                            Qt
                        </th>
                        <th>
                            Pd U
                        </th>
                        <th>
                            Poids
                        </th>
                        <th>
                            Droit
                        </th>
                        <th>
                            Taux
                        </th>
                        <th>
                            Taxe
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Frais
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Prix
                        </th>
                        <th>
                            Total
                        </th>

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
                        <td class="beLigneCode">
                            <input type="text"
                                   name="refCode[NID]" 
                                   id="refCodeNID">
                        </td>
                        <td>
                            <textarea name="refLbl[NID]" 
                                      id="refLblNID"
                                      class="beLigneT"></textarea>                           
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="" 
                                   name="lotIdProducteur[NID]" 
                                   id="lotIdProducteurNID"
                                   title="Lot du producteur">
                        </td>
                        <td class="beLigneNb">
                            <input type="number"
                                   min="0.01"
                                   step="0.01"
                                   value="1" 
                                   name="beligPu[NID]" 
                                   id="beligPuNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="number"
                                   min="0.01"
                                   step="0.01"
                                   value="1" 
                                   name="ligQte[NID]" 
                                   id ="ligQteNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="refPoidsBrut[NID]" 
                                   id="refPoidsBrutNID">
                        </td>
                        <!-- Calcul totalPoids Multiplication entre la quantité
                        et le pois unitaire-->
                        <td class="beLigneNb">
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="totalPoids[NID]" 
                                   id="totalPoidsNID"
                                   onfocus='ccMultiplier(["ligQteNID",
                                                   "refPoidsBrutNID"],
                                                       "totalPoidsNID")'>
                        </td>
                        <td class="beLigneNb">
                            <!-- Calcul droit de douane selon le pu, le taux 
                            et la quantité-->
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="beligDd[NID]" 
                                   id="beligDdNID"
                                   onfocus='beCcDroitDouane("beligPuNID",
                                                       "beligTauxDouaneNID",
                                                       "ligQteNID",
                                                       "beligDdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <!-- Calcul droit de douane selon le pu, le taux 
                            et la quantité-->
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="beligTauxDouane[NID]" 
                                   id="beligTauxDouaneNID"
                                   onchange='beCcDroitDouane("beligPuNID",
                                                       "beligTauxDouaneNID",
                                                       "ligQteNID",
                                                       "beligDdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="beligTaxe[NID]" 
                                   id="beligTaxeNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Additionne droit de douane et taxe-->
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="totalFd[NID]" 
                                   id="totalFdNID" 
                                   readonly=""
                                   onfocus='ccAddition(
                                                       ["beligDdNID", "beligTaxeNID"],
                                                       "totalFdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="beligFb[NID]" 
                                   id="beligFbNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais bancaire dans total -->
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="totalFb[NID]" 
                                   id="totalFbNID"
                                   readonly=""
                                   onfocus='copieChamps("beligFbNID",
                                                       "totalFbNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="beligFt[NID]" 
                                   id="beligFtNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais transport dans total-->
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="totalFt[NID]" 
                                   id="totalFtNID"
                                   readonly=""
                                   onfocus='copieChamps("beligFtNID",
                                                       "totalFtNID")'>
                        </td>
                        <td class="beLigneNb">
                            <!-- Total de la ligne: appel la fonction qui
                            calcul le total de la ligne-->
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="totalLig[NID]" 
                                   id="totalLigNID"
                                   readonly=""
                                   onfocus='beTotalLigne("totalLigNID")'>
                        </td>
                        <td>
                            <input type="date" 
                                   name="lotDlc[NID]" 
                                   id="lotDlcNID">
                        </td>
                        <td >
                            <textarea name="ligComDep[NID]" 
                                      id="ligComDepNID" 
                                      class="beLigneT"></textarea>
                        </td>
                        <td>
                            <textarea name="ligCom[NID]" 
                                      id="ligComNID"  
                                      class="beLigneT"></textarea>
                        </td>
                        <td>
                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   value="0" 
                                   name="beligCuAchat[NID]" 
                                   id="beligCuAchatNID"
                                   >                            
                        </td>
                        <td  class="beLigneImg">

                            <!-- Efface la ligne en cours, n'est visible 
                            que pour les lignes ajoutées -->
                            <img src="img/icon/delete.png" 
                                 alt="" 
                                 title="Supprimer"
                                 onclick='delLigne("idLigne")' 
                                 class="tdImgTd"/>
                        </td>
                    </tr>


                    <!-- Fin du squelette-->    


                    <!-- Construction des lignes récupérées-->

                    <?php
                    //Pour chaque ligne de bon
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
                                       onfocus='ctrlUpdQtInit("ligQte<?php echo $idLigne ?>",
                                                               "<?php echo $oLot->lot_qt_init ?>",
                                                               "<?php echo $oLot->lot_qt_stock ?>")'>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       name="refPoidsBrut[<?php echo $idLigne ?>]" 
                                       id="refPoidsBrut<?php echo $idLigne ?>"
                                       value="<?php echo $oRef->ref_poids_brut ?>">
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       name="totalPoids[<?php echo $idLigne ?>]" 
                                       id="totalPoids<?php echo $idLigne ?>"
                                       onfocus='ccMultiplier(["ligQte<?php echo $idLigne ?>",
                                                           "refPoidsBrut<?php echo $idLigne ?>"],
                                                               "totalPoids<?php echo $idLigne ?>")'>
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
                                       onfocus='beCcDroitDouane("beligPu<?php echo $idLigne ?>",
                                                               "beligTauxDouane<?php echo $idLigne ?>",
                                                               "ligQte<?php echo $idLigne ?>",
                                                               "beligDd<?php echo $idLigne ?>")'>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       value="<?php echo $oDd->dd_taux ?>"
                                       name="beligTauxDouane[<?php echo $idLigne ?>]" 
                                       id="beligTauxDouane<?php echo $idLigne ?>"
                                       onchange='beCcDroitDouane("beligPu<?php echo $idLigne ?>",
                                                               "beligTauxDouane<?php echo $idLigne ?>",
                                                               "ligQte<?php echo $idLigne ?>",
                                                               "beligDd<?php echo $idLigne ?>")'>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       value="<?php echo $oBelig->belig_taxe ?>" 
                                       name="beligTaxe[<?php echo $idLigne ?>]" 
                                       id="beligTaxe<?php echo $idLigne ?>">
                            </td>
                            <td class="beLigneNb">
                                <!-- Additionne droit de douane et taxe, mets à jour
                                le total-->
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       value="0" 
                                       name="totalFd[<?php echo $idLigne ?>]" 
                                       id="totalFd<?php echo $idLigne ?>" 
                                       readonly=""
                                       onfocus='ccAddition(
                                                               ["beligDd<?php echo $idLigne ?>",
                                                               "beligTaxe<?php echo $idLigne ?>"],
                                                               "totalFd<?php echo $idLigne ?>")'>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       value="<?php echo $oBelig->belig_fb ?>"
                                       name="beligFb[<?php echo $idLigne ?>]" 
                                       id="beligFb<?php echo $idLigne ?>">
                            </td>
                            <td class="beLigneNb">
                                <!-- Copie frais bancaire dans total -->
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       name="totalFb[<?php echo $idLigne ?>]" 
                                       id="totalFb<?php echo $idLigne ?>"
                                       readonly=""
                                       onfocus='copieChamps("beligFb<?php echo $idLigne ?>",
                                                               "totalFb<?php echo $idLigne ?>")'>
                            </td>
                            <td class="beLigneNb">
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       value="<?php echo $oBelig->belig_ft ?>"
                                       name="beligFt[<?php echo $idLigne ?>]" 
                                       id="beligFt<?php echo $idLigne ?>">
                            </td>
                            <td class="beLigneNb">
                                <!-- Copie frais transport dans total-->
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       name="totalFt[<?php echo $idLigne ?>]" 
                                       id="totalFt<?php echo $idLigne ?>"
                                       readonly=""
                                       onfocus='copieChamps("beligFt<?php echo $idLigne ?>",
                                                               "totalFt<?php echo $idLigne ?>")'>
                            </td>
                            <td class="beLigneNb">
                                <!-- Total de la ligne-->
                                <input type="text" 
                                       type="number"
                                       min="0"
                                       step="0.01"
                                       name="totalLig[<?php echo $idLigne ?>]" 
                                       id="totalLig<?php echo $idLigne ?>"
                                       readonly=""
                                       onfocus='beTotalLigne("totalLig<?php echo $idLigne ?>")'>
                            </td>
                            <td>
                                <input type="date" 
                                       name="lotDlc[<?php echo $idLigne ?>]" 
                                       id="lotDlc<?php echo $idLigne ?>"
                                       value="<?php echo $oLot->lot_dlc ?>">
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
                            <td>
                                <input type="number"
                                       min="0"
                                       step="0.01"
                                       name="beligCuAchat[<?php echo $idLigne ?>]" 
                                       id="beligCuAchat<?php echo $idLigne ?>"
                                       value="<?php echo $oBelig->belig_cu_achat ?>">                            
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
                        </tr>
                        <!-- Fin construction lignes récupérées-->

                    <?php } ?>
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
            <div>
                <label for="beTotal">Total</label>
                <input type="text" 
                       name="beTotal" 
                       id="beTotal"
                       value="<?php echo $resBeDetail->be_total ?>">
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
    echo 'Le silence est d\'or';
}