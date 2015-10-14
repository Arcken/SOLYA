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
                
                <label for="beFactNum"> Référence de facture </label><br>
                <input name="beFactNum" 
                       id="beFactNum"
                       placeholder="Numéro de la facture achat" 
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
                       >
                <br>
                <label for="beCom"> Commentaire</label><br>
                <textarea name="beCom" 
                          id="beCom"
                          placeholder="description"></textarea>
                <br>
            </div>
            <div class="col50">
                <label for="beFraisDouane"> Frais de douane </label><br>
                <input name="beFraisDouane" 
                       id="beFraisDouane" 
                       type="number"
                       min="0"
                       step="any"
                       value ="0">
                <br>
                <label for="beFraisBancaire"> Frais bancaires </label><br>
                <input name="beFraisBancaire" 
                       id="beFraisBancaire" 
                       type="number"
                       min="0"
                       step="any"
                       value ="0">
                <br>
                <label for="beFraisTrans"> Frais de transport </label><br>
                <input name="beFraisTrans" 
                       id="beFraisTrans" 
                       type="number"
                       min="0"
                       step="any"
                       value ="0">
                <br>
                
                <label for="beInfoTrans"> Information transport</label><br>
                <textarea name="beInfoTrans" 
                          placeholder="description"></textarea>
                <br>
            </div>
            
            <div class="col90">
                <table class="beLigne" id="beTable">
                    <tr id="titreGnl">
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
                    <tr id="idLigne" hidden="">

                        <td  class="beLigneId">
                            <!-- Appel de fonction qui recherche une reference 
                            selon son id-->
                            <input type="number" 
                                       name="refId[NID]" 
                                       id="refIdNID"
                                       onblur='getReference("NID",
                                                            "refIdNID",
                                                            "ref_id",
                                                            "be")' 
                                       min="0"
                                       required
                                       value="0">
                        </td>
                        <td class="beLigneCode">
                            <input type="text"
                                       name="refCode[NID]" 
                                       id="refCodeNID"
                                       onblur='getReference("NID",
                                                            "refCodeNID",
                                                            "ref_code",
                                                            "be")'
                                       value=" "                     
                                       required>
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
                                   value="1"
                                   min="0.01"
                                   step="any"
                                   name="beligPu[NID]" 
                                   id="beligPuNID"
                                   required>
                        </td>
                        <td class="beLigneNb">
                            <input type="number" 
                                   value="1"
                                   min="0.01"
                                   step="any"
                                   name="ligQte[NID]" 
                                   id ="ligQteNID"
                                   required>
                        </td>
                        <td class="beLigneNb">
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any"
                                   name="refPoidsBrut[NID]" 
                                   id="refPoidsBrutNID"
                                   required>
                        </td>
                        <td class="beLigneNb">
                            <!-- Calcul totalPoids: Multiplication entre la quantité
                            et le pois unitaire-->
                            <input type="number" 
                                   value="0"
                                   min="0.00"
                                   step="any"
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
                                       value="0"
                                       min="0"
                                       step="any"
                                       name="beligDd[NID]" 
                                       id="beligDdNID"
                                       onfocus='beCcDroitDouane("beligPuNID",
                                                           "beligTauxDouaneNID",
                                                           "ligQteNID",
                                                           "beligDdNID")'
                                       required>
                        </td>
                        <td class="beLigneNb">
                            <!-- Calcul droit de douane selon le pu, le taux 
                                et la quantité-->
                            <input type="number" 
                                       value="0"
                                       min="0"                                   
                                       step="any"
                                       name="beligTauxDouane[NID]" 
                                       id="beligTauxDouaneNID"
                                       onchange='beCcDroitDouane("beligPuNID",
                                                           "beligTauxDouaneNID",
                                                           "ligQteNID",
                                                           "beligDdNID")'
                                       required>
                        </td>
                        <td class="beLigneNb">
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any"
                                   name="beligTaxe[NID]" 
                                   id="beligTaxeNID"
                                   required>
                        </td>
                        <td class="beLigneNb">
                            <!-- Additionne droit de douane et taxe-->
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="totalFd[NID]" 
                                   id="totalFdNID" 
                                   readonly=""
                                   required
                                   onfocus='ccAddition(
                                                       ["beligDdNID", "beligTaxeNID"],
                                                       "totalFdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any"
                                   name="beligFb[NID]" 
                                   id="beligFbNID"
                                   required>
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais bancaire dans total -->
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any"
                                   name="totalFb[NID]" 
                                   id="totalFbNID"
                                   readonly=""
                                   required
                                   onfocus='copieChamps("beligFbNID",
                                                       "totalFbNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="beligFt[NID]" 
                                   required
                                   id="beligFtNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais transport dans total-->
                            <input type="number" 
                                   value="0"
                                   min="0"
                                   step="any" 
                                   name="totalFt[NID]" 
                                   id="totalFtNID"
                                   readonly=""
                                   required
                                   onfocus='copieChamps("beligFtNID",
                                                       "totalFtNID")'>
                        </td>
                        <td class="beLigneNb">
                            <!-- Total de la ligne: appel la fonction qui
                                calcul le total de la ligne-->
                            <input type="number" 
                                   value="0" 
                                   step="any"
                                   name="totalLig[NID]" 
                                   id="totalLigNID"
                                   readonly=""
                                   onfocus='beTotalLigne("totalLigNID")'>
                        </td>
                        <td>
                            <input type="date" 
                                   name="lotDlc[NID]" 
                                   id="lotDlcNID"
                                   value="<?php echo date('Y-m-d')?>"
                                   required>
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
                                   value="0" 
                                   step="any"
                                   name="beligCuAchat[NID]" 
                                   id="beligCuAchatNID"
                                   value=""
                                   required>                            
                        </td>
                        <td  class="beLigneImg">
                            <!-- Efface la ligne en cours -->
                            <img src="img/icon/delete.png" 
                                 alt="" 
                                 title="Supprimer"
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
                <input type="button" 
                       value="control ligne" 
                       onclick='ctrlFormValide()'>
            </div>
            <div>
                <label for="beTotal">Total</label>
                <input type="text" 
                       name="beTotal" 
                       id="beTotal"
                       value="0">
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