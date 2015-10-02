<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

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
                <input name="beDate" placeholder="description" type="text"
                       >
                <br>
                <label for="beCom"> Commentaire</label><br>
                <textarea name="beCom" placeholder="description">Com</textarea>
                <br>
            </div>
            <div class="col50">
                <label for="beFraisDouane"> Frais de douane </label><br>
                <input name="beFraisDouane" placeholder="description" type="text"
                       value ="150">
                <br>
                <label for="beFraisTransport"> Frais de transport </label><br>
                <input name="beFraisTransport" placeholder="description" type="text"
                       >
                <br>
                <label for="beFraisBancaire"> Frais bancaire </label><br>
                <input name="beFraisBancaire" placeholder="description" type="text"
                       >
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
                    <tr id="beligne" hidden="">
                        
                        <td  class="beLigneId">
                            <input type="text" name="refId[NID]"  id="refIdNID" onblur='getReference("NID")'>
                        </td>
                        <td class="beLigneCode">
                            <input type="text" value="MXSI01" name="refCode[NID]" id="refCodeNID">
                        </td>
                        <td>
                            <textarea name="refLbl[NID]" id="refLblNID" class="beLigneT">Tablette chocolat du Mexique 70% cacao</textarea>
                           
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="4" name="beligPu[NID]" id="beligPuNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="5" name="ligQte[NID]" id ="ligQteNID"
                                   onblur='beCcDroitDouane("beligPu[NID]",
                                               "beligTauxDouane[NID]",
                                               "ligQte[NID]",
                                               "beligDd[NID]")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="6" name="beligDd[NID]" id="beligDdNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="7" name="beligTauxDouane[NID]" 
                                   id="beligTauxDouaneNID" readonly="">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="8" name="beligTaxe[NID]" id="beligTaxeNID"
                                   onblur='beCc("beligDd[NID]","beligTaxe[NID]","calculFd[NID]")'>
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="9" name="calculFd[NID]" id="calculFdNID" readonly="">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="10" name="beligFb[NID]" id="beligFbNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="11" name="calculFb[NID]" id="calculFbNID" readonly="">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="12" name="beligFt[NID]" id="beligFtNID">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="13" name="calculFt[NID]" id="calculFtNID" readonly="">
                        </td>
                        <td>
                            <input type="date" name="beligDlc[NID]" id="beligDlcNID">
                            
                        </td>
                        <td >
                            <textarea name="beligDepot[NID]" id="beligDepotNID" class="beLigneT">Commentaire</textarea>
                        </td>
                        <td>
                            <textarea name="beligCom[NID]" id="beligComNID"  class="beLigneT">Commentaire</textarea>
                        </td>
                        <td  class="beLigneImg">
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick='delLigne("beligne")' class="tdImgTd"/>
                        </td>
                    </tr>
                </table>
                <input type="button" value="Ajouter ligne" onclick='ajoutBeLigne("beTable","beligne")'>
            </div>
            <div class="bas">
                    <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                    <input name="Calcul" type="button" value="Calcul" onclick="beCalcul()">
                    <input name="clear" type="reset"> 
                    <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                </div>
        </form>
        
    </div>
    
    <?php
} else {
    echo 'Le silence est d\'or';
}