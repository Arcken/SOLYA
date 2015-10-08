<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <script type="text/javascript" src="js/calculFct.js" ></script>
    <script type="text/javascript" src="js/beFct.js" ></script>
    <div class="corps">
        <form class="form" action="index.php" method="get">
            <div class="col50">

                <label for="beFactNum"> Référence de facture </label><br>
                <input name="beFactNum" 
                       id="beFactNum"
                       placeholder="description" 
                       type="text"
                       value="<?php echo $resBeDetail->be_fact_num?>"
                       >
                <br>
                <label for="beLbl"> Libellé du bon </label><br>
                <input name="beLbl" 
                       id="beLbl"
                       placeholder="description" 
                       type="text"
                       value="<?php echo $resBeDetail->be_lbl?>"
                       >
                <br>
                <label for="beDate"> Date</label><br>
                <input name="beDate" 
                       id="beDate"
                       placeholder="description" 
                       type="date"
                       value="<?php echo $resBeDetail->be_date?>"
                       >
                <br>
                <label for="beCom"> Commentaire</label><br>
                <textarea name="beCom" 
                          id="beCom"
                          placeholder="description"><?php echo $resBeDetail->be_com?></textarea>
                <br>
            </div>
            <div class="col50">
                <label for="beFraisDouane"> Frais de douane </label><br>
                <input name="beFraisDouane" 
                       id="beFraisDouane" 
                       placeholder="description" 
                       type="text" 
                       value="<?php echo $resBeDetail->be_frais_douane?>">
                <br>
                <label for="beFraisBancaire"> Frais bancaires </label><br>
                <input name="beFraisBancaire" 
                       id="beFraisBancaire" 
                       placeholder="description" 
                       type="text" 
                       value="<?php echo $resBeDetail->be_frais_bancaire?>">
                <br>
                <label for="beFraisTrans"> Frais de transport </label><br>
                <input name="beFraisTrans" 
                       id="beFraisTrans" 
                       placeholder="description" 
                       type="text" 
                       value="<?php echo $resBeDetail->be_frais_trans?>">
                <br>
                
                <label for="beInfoTrans"> Information transport</label><br>
                <textarea name="beInfoTrans" 
                          placeholder="description"
                          >value="<?php echo $resBeDetail->be_info_trans?></textarea>
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
                            P
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
                    <!-- Squelette de construction des lignes-->
                    
                    <?php //Pour chaque ligne de bon
                    for($i = 0; $i < count($resAllBeLigneBE);$i++){
                        //l'id du tr html est i+1, 0 étant celle du squellette
                        $ligId = $i +1;
                        //On récupère un objet be_ligne
                        $oBelig = $resAllBeLigneBE[$i];
                        //On récupère un objet ligne
                        $oLigne = $resLignes[$i];
                        //On récupère un objet lot
                        $oLot = $resAllLots[$i];
                        //On récupére un objet référence
                        $oRef = $resAllRefs[$i];
                        ?>
                    <tr id="idLigne<?php echo $ligId?>">
                        <td class="beLigneId">
                            <input type="text"
                                   name="ligId<?php echo $ligId?>" 
                                   id="ligId<?php echo $ligId?>"
                                   value="<?php echo $oBelig->lig_id?>">
                        </td>
                        <td  class="beLigneId">
                            <!-- Appel de fonction qui recherche une reference 
                            selon son id, il faut préciser le champs-->
                            <input type="number" 
                                   name="refId[<?php echo $ligId?>]" 
                                   id="refId<?php echo $ligId?>"
                                   value="<?php echo $oLot->ref_id?>"
                                   onblur='getReference("<?php echo $ligId?>",
                                                       "ref_id",
                                                       "be")' min="0">
                        </td>
                        <td class="beLigneCode">
                            <input type="text"
                                   name="refCode[<?php echo $ligId?>]" 
                                   id="refCode<?php echo $ligId?>"
                                   value="<?php echo $oRef->ref_code?>">
                        </td>
                        <td>
                            <textarea name="refLbl[<?php echo $ligId?>]" 
                                      id="refLbl<?php echo $ligId?>"
                                      class="beLigneT"
                                      ><?php echo $oRef->ref_lbl?></textarea>                           
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   name="lotIdProducteur[<?php echo $ligId?>]" 
                                   id="lotIdProducteur<?php echo $ligId?>"
                                   title="Lot du producteur"
                                   value="<?php echo $oLot->lot_id_producteur?>">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   name="beligPu[<?php echo $ligId?>]" 
                                   id="beligPu<?php echo $ligId?>"
                                   value="<?php echo $oBelig->belig_pu?>">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   name="ligQte[<?php echo $ligId?>]" 
                                   id ="ligQte<?php echo $ligId?>"
                                   value="<?php echo $oLigne->lig_qte?>">
                        </td>
                        <td class="beLigneNb">
                            <input type="text"
                                   name="refPoidsBrut[<?php echo $ligId?>]" 
                                   id="refPoidsBrut<?php echo $ligId?>"
                                   value="<?php echo $oRef->ref_poids_brut?>">
                        </td>
                        <td class="beLigneNb">
                            <input type="text"
                                   name="totalPoids[<?php echo $ligId?>]" 
                                   id="totalPoids<?php echo $ligId?>"
                                   onfocus='ccMultiplier(["ligQte<?php echo $ligId?>",
                                                   "refPoidsBrut<?php echo $ligId?>"],
                                                       "totalPoids<?php echo $ligId?>")'>
                        </td>
                        <td class="beLigneNb">
                            <!-- Calcul droit de douane selon le pu et le taux 
                            récupérés par getreference-->
                            <input type="text" 
                                   value="<?php echo $oBelig->belig_dd?>" 
                                   name="beligDd[<?php echo $ligId?>]" 
                                   id="beligDd<?php echo $ligId?>"
                                   onfocus='beCcDroitDouane("beligPu<?php echo $ligId?>",
                                                       "beligTauxDouane<?php echo $ligId?>",
                                                       "ligQte<?php echo $ligId?>",
                                                       "beligDd<?php echo $ligId?>")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   name="beligTauxDouane[<?php echo $ligId?>]" 
                                   id="beligTauxDouane<?php echo $ligId?>"
                                   onchange='beCcDroitDouane("beligPu<?php echo $ligId?>",
                                                       "beligTauxDouane<?php echo $ligId?>",
                                                       "ligQte<?php echo $ligId?>",
                                                       "beligDd<?php echo $ligId?>")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="<?php echo $oBelig->belig_taxe?>" 
                                   name="beligTaxe[<?php echo $ligId?>]" 
                                   id="beligTaxe<?php echo $ligId?>">
                        </td>
                        <td class="beLigneNb">
                            <!-- Additionne droit de douane et taxe, mets à jour
                            le total-->
                            <input type="text" 
                                   value="0" 
                                   name="totalFd[<?php echo $ligId?>]" 
                                   id="totalFd<?php echo $ligId?>" 
                                   readonly=""
                                   onfocus='ccAddition(
                                                       ["beligDd<?php echo $ligId?>", "beligTaxe<?php echo $ligId?>"],
                                                       "totalFd<?php echo $ligId?>")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="<?php echo $oBelig->belig_fb?>"
                                   name="beligFb[<?php echo $ligId?>]" 
                                   id="beligFb<?php echo $ligId?>">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais bancaire dans total -->
                            <input type="text" 
                                   value="0" 
                                   name="totalFb[<?php echo $ligId?>]" 
                                   id="totalFb<?php echo $ligId?>"
                                   readonly=""
                                   onfocus='copieChamps("beligFb<?php echo $ligId?>",
                                                       "totalFb<?php echo $ligId?>")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="<?php echo $oBelig->belig_ft?>"
                                   name="beligFt[<?php echo $ligId?>]" 
                                   id="beligFt<?php echo $ligId?>">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais transport dans total-->
                            <input type="text" 
                                   value="0" 
                                   name="totalFt[<?php echo $ligId?>]" 
                                   id="totalFt<?php echo $ligId?>"
                                   readonly=""
                                   onfocus='copieChamps("beligFt<?php echo $ligId?>",
                                                       "totalFt<?php echo $ligId?>")'>
                        </td>
                        <td class="beLigneNb">
                            <!-- Total de la ligne-->
                            <input type="text" 
                                   value="0" 
                                   name="totalLig[<?php echo $ligId?>]" 
                                   id="totalLig<?php echo $ligId?>"
                                   readonly=""
                                   onfocus='beTotalLigne("totalLig<?php echo $ligId?>")'>
                        </td>
                        <td>
                            <input type="date" 
                                   name="lotDlc[<?php echo $ligId?>]" 
                                   id="lotDlc<?php echo $ligId?>"
                                   value="<?php echo $oLot->lot_dlc?>">
                        </td>
                        <td >
                            <textarea name="ligComDep[<?php echo $ligId?>]" 
                                      id="ligComDep<?php echo $ligId?>" 
                                      class="beLigneT"
                                      ><?php echo $oLigne->lig_com_dep?></textarea>
                        </td>
                        <td>
                            <textarea name="ligCom[<?php echo $ligId?>]" 
                                      id="ligCom<?php echo $ligId?>"  
                                      class="beLigneT"
                                      ><?php echo $oLigne->lig_com?></textarea>
                        </td>
                        <td>
                            <input type="text" 
                                   name="beligCuAchat[<?php echo $ligId?>]" 
                                   id="beligCuAchat<?php echo $ligId?>"
                                   value="<?php echo $oBelig->belig_cu_achat?>">                            
                        </td>
                        <td  class="beLigneImg">
                            <!-- Pour supprimer les lignes qui existe déja, 
                            on affiche une case à cocher. 
                            Pour que le tableau soit complet on masque 
                            cette case pour les nouvelles lignes-->
                            <input type="checkbox" 
                                   name="ligSupp[<?php echo $ligId?>]" 
                                   id="beligCuAchat<?php echo $ligId?>">
                            
                        </td>
                    </tr>
                   <!-- Fin du quelette de construction des lignes-->
                   <tr id="idLigne" hidden="">
                        <td class="beLigneId">
                            <input type="text"
                                   name="ligId[NID]" 
                                   id="ligIdNID">
                        </td>
                        <td  class="beLigneId">
                            <!-- Appel de fonction qui recherche une reference 
                            selon son id, il faut préciser le champs-->
                            <input type="number" 
                                   name="refId[NID]" 
                                   id="refIdNID"
                                   onblur='getReference("NID",
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
                            <input type="text" 
                                   value="0" 
                                   name="beligPu[NID]" 
                                   id="beligPuNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="0" 
                                   name="ligQte[NID]" 
                                   id ="ligQteNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="0" 
                                   name="refPoidsBrut[NID]" 
                                   id="refPoidsBrutNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="0" 
                                   name="totalPoids[NID]" 
                                   id="totalPoidsNID"
                                   onfocus='ccMultiplier(["ligQteNID",
                                                   "refPoidsBrutNID"],
                                                       "totalPoidsNID")'>
                        </td>
                        <td class="beLigneNb">
                            <!-- Calcul droit de douane selon le pu et le taux 
                            récupérés par getreference-->
                            <input type="text" 
                                   value="0" 
                                   name="beligDd[NID]" 
                                   id="beligDdNID"
                                   onfocus='beCcDroitDouane("beligPuNID",
                                                       "beligTauxDouaneNID",
                                                       "ligQteNID",
                                                       "beligDdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="0" 
                                   name="beligTauxDouane[NID]" 
                                   id="beligTauxDouaneNID"
                                   onchange='beCcDroitDouane("beligPuNID",
                                                       "beligTauxDouaneNID",
                                                       "ligQteNID",
                                                       "beligDdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="0" 
                                   name="beligTaxe[NID]" 
                                   id="beligTaxeNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Additionne droit de douane et taxe, mets à jour
                            le total-->
                            <input type="text" 
                                   value="0" 
                                   name="totalFd[NID]" 
                                   id="totalFdNID" 
                                   readonly=""
                                   onfocus='ccAddition(
                                                       ["beligDdNID", "beligTaxeNID"],
                                                       "totalFdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="0" 
                                   name="beligFb[NID]" 
                                   id="beligFbNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais bancaire dans total -->
                            <input type="text" 
                                   value="0" 
                                   name="totalFb[NID]" 
                                   id="totalFbNID"
                                   readonly=""
                                   onfocus='copieChamps("beligFbNID",
                                                       "totalFbNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" 
                                   value="0" 
                                   name="beligFt[NID]" 
                                   id="beligFtNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais transport dans total-->
                            <input type="text" 
                                   value="0" 
                                   name="totalFt[NID]" 
                                   id="totalFtNID"
                                   readonly=""
                                   onfocus='copieChamps("beligFtNID",
                                                       "totalFtNID")'>
                        </td>
                        <td class="beLigneNb">
                            <!-- Total de la ligne-->
                            <input type="text" 
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
                            <input type="text" 
                                   name="beligCuAchat[NID]" 
                                   id="beligCuAchatNID"
                                   value="">                            
                        </td>
                        <td  class="beLigneImg">
                            <!-- Pour supprimer les lignes qui existe déja, 
                            on affiche une case à cocher. 
                            Pour que le tableau soit complet on masque 
                            cette case pour les nouvelles lignes-->
                            <input type="checkbox" 
                                   name="ligSupp[NID]" 
                                   id="beligCuAchatNID"
                                   hidden="">
                            <!-- Efface la ligne en cours, n'est visible 
                            que pour les lignes ajoutées -->
                            <img src="img/icon/delete.png" 
                                 alt="" 
                                 title="Supprimer"
                                 onclick='delLigne("idLigne")' 
                                 class="tdImgTd"/>
                        </td>
                    </tr>
                    <?php }?>
                   <!-- Construction des lignes existantes-->
                </table>
                <!-- Ajoute une ligne -->
                <input type="button" 
                       value="Ajouter ligne" 
                       onclick='addLigne("beTable", "idLigne")'>
                <!-- On rajout un arg taille tab de ligne-->
                <script type="text/javascript">
                //On initialise le compte de ligne pour la fonction addLigne
                    nRowCount = parseInt(<?php echo count($resAllBeLigneBE)?>);
                </script>
            </div>
            <div>
                <label for="beTotal">Total</label>
                <input type="text" 
                       name="beTotal" 
                       id="beTotal"
                       value="<?php echo $resBeDetail->be_total?>">
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