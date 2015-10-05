<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <script type="text/javascript" src="js/beFct.js" ></script>
    <div class="corps">
        <form class="form" action="index.php" method="get">
            <div class="col50">

                <label for="factRef"> Référence de facture </label><br>
                <input name="factRef" placeholder="description" type="text"
                       >
                <br>
                <label for="beLbl"> Libellé du bon </label><br>
                <input name="beLbl" placeholder="description" type="text"
                       >
                <br>
                <label for="beDate"> Date</label><br>
                <input name="beDate" placeholder="description" type="date"
                       >
                <br>
                <label for="beCom"> Commentaire</label><br>
                <textarea name="beCom" placeholder="description">Com</textarea>
                <br>
            </div>
            <div class="col50">
                <label for="beFraisDouane"> Frais de douane </label><br>
                <input name="beFraisDouane" id="beFraisDouane" 
                       placeholder="description" type="text" value ="0">
                <br>
                
                <label for="beFraisBancaire"> Frais bancaire </label><br>
                <input name="beFraisBancaire" id="beFraisBancaire" 
                       placeholder="description" type="text" value="0">
                <br>
                <label for="beFraisTransport"> Frais de transport </label><br>
                <input name="beFraisTransport" id="beFraisTransport" 
                       placeholder="description" type="text" value="0">
                <br>
            </div>
            <div class="col90">
                <table class="beLigne" id="beTable">
                    <tr id="titreGnl">
                        <th colspan="5">
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
                            DLC DLUO
                        </th>
                        <th rowspan="2">
                            Dépôt
                        </th>
                        <th rowspan="2">
                            Commentaire
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
                            PU
                        </th>
                        <th>
                            Qt
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
                            Calcul
                        </th>
                        <th>
                            Frais
                        </th>
                        <th>
                            Calcul
                        </th>
                        <th>
                            Frais
                        </th>
                        <th>
                            Calcul
                        </th>
                        
                    </tr>
                    <tr id="idLigne" hidden="">
                        
                        <td  class="beLigneId">
                            <!-- Appel de fonction qui recherche une reference selon son id, il faut préciser le champs-->
                            <input type="number" name="refId[NID]"  id="refIdNID" 
                                   onblur='getReference("NID","ref_id","be")' min="0">
                        </td>
                        <td class="beLigneCode">
                            <input type="text" value="MXSI01" name="refCode[NID]" 
                                   id="refCodeNID">
                        </td>
                        <td>
                            <textarea name="refLbl[NID]" id="refLblNID"
                                      class="beLigneT"></textarea>
                           
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="0" name="beligPu[NID]" 
                                   id="beligPuNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="0" name="ligQte[NID]" 
                                   id ="ligQteNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Calcul droit de douane selon le pu et le taux 
                            récupérés par getreference-->
                            <input type="text" value="0" name="beligDd[NID]" 
                                   id="beligDdNID"
                                   onfocus='beCcDroitDouane("beligPuNID",
                                               "beligTauxDouaneNID",
                                               "ligQteNID",
                                               "beligDdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="0" name="beligTauxDouane[NID]" 
                                   id="beligTauxDouaneNID" readonly="">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="0" name="beligTaxe[NID]" 
                                   id="beligTaxeNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Additionne droit de douane et taxe -->
                            <input type="text" value="0" name="calculFd[NID]" 
                                   id="calculFdNID" readonly=""
                                   onfocus='beCc("beligDdNID","beligTaxeNID","calculFdNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="0" name="beligFb[NID]" 
                                   id="beligFbNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais bancaire dans total pour le calcul final -->
                            <input type="text" value="0" name="calculFb[NID]" 
                                   id="calculFbNID" readonly=""
                                   onfocus='beCopieChamps("beligFbNID","calculFbNID")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="0" name="beligFt[NID]" 
                                   id="beligFtNID">
                        </td>
                        <td class="beLigneNb">
                            <!-- Copie frais transport dans total pour le calcul final -->
                            <input type="text" value="0" name="calculFt[NID]" 
                                   id="calculFtNID" readonly=""
                                   onfocus='beCopieChamps("beligFtNID","calculFtNID")'>
                        </td>
                        <td>
                            <input type="date" name="beligDlc[NID]" id="beligDlcNID">
                            
                        </td>
                        <td >
                            <textarea name="beligDepot[NID]" id="beligDepotNID" 
                                      class="beLigneT"></textarea>
                        </td>
                        <td>
                            <textarea name="beligCom[NID]" id="beligComNID"  
                                      class="beLigneT"></textarea>
                        </td>
                        <td  class="beLigneImg">
                            <!-- Efface la ligne en cours -->
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick='delLigne("idLigne")' class="tdImgTd"/>
                        </td>
                    </tr>
                </table>
                <!-- Ajoute une ligne -->
                <input type="button" value="Ajouter ligne" 
                       onclick='addLigne("beTable","idLigne")'>
            </div>
            <div class="bas">
                    <input name="btnForm" type="submit" 
                           value="<?php echo $sButton; ?>">
                    <!-- Mets à jour chaque champs calcul selon les champs
                    de l'entête-->
                    <input name="Calcul" type="button" value="Calcul" 
                           onclick="beCalcul()">
                    <input name="clear" type="reset"> 
                    <input name="action" id="action" 
                           value="<?php echo $sAction ?>" type="text" hidden>
                </div>
        </form>
        
    </div>
    
    <?php
} else {
    echo 'Le silence est d\'or';
}