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

                <label for="numFact"> Numéro de facture </label><br>
                <input name="numFact"  id="nFact" placeholder="Numéro de Facture" type="text" required>
                <br>
                <label for="typeBon"> Type du bon </label><br>
                <select name="typeBon" id="typeBon" placeholder="description" type="text"
                        required onchange="formChooserBon();">
                    <option value="" selected>Aucun</option>
                    <?php foreach($resDocLbl as $lbl){?>
                        <option value="<?php echo $lbl->doclbl_id;?>"><?php echo $lbl->doclbl_lbl;?></option>
                    <?php } ?>
                </select>
                <br>
                <label for="bonDate"> Date</label><br>
                <input name="bonDate" placeholder="Date" type="text" >
                <br>
                <label for="bonCom">Commentaire</label><br>
                <textarea name="bonCom" placeholder="Commentaire">Com</textarea>
                <br>
            </div>
            <div class="col90" id="divTable" style ='display:none'>
                <table  id="bonTable">
                    <tr>
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
                        <th rowspan="2" id="thImg">
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
                    <tr id="bonligne" hidden>
                        <td  class="bonLigneId">
                            <input type="text" name="refId[]" onblur="getReferenceBonFromId('0');">
                        </td>
                        <td class="bonLigneCode">
                            <input type="text" value="MXSI01" name="refCode[]" onblur="getReferenceBonFromRefCode('0');">
                        </td>
                        <td>
                            <textarea name="refLbl[]" class="bonLigneT"
                                      rows="4" cols="30"
                            >Tablette chocolat du Mexique 70% cacao</textarea>
                           
                        </td>
                         <td class="bonLigneId">
                             <input type="text" name="lotId[]">
                        </td>
                        <td class="bonLigneNb">
                            <input type="text" value="4" name="ligQte[]">
                        </td>
                        
                        <td >
                            <textarea name="bonligDepot[]" class="bonLigneT"
                                      rows="2" cols="30">Dépot?</textarea>
                        </td>
                        <td>
                            <textarea name="bonligCom[]" class="bonLigneT" 
                                      rows="2" cols="30">Commentaire</textarea>
                        </td>
                        <td class="bonLigneImg">
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick='delLigne("bonligne");' class="tdImgTd"/>
                        </td>
                    </tr>
                </table>
                <input type="button" value="Ajouter ligne" onclick="ajoutBonLigne('bonTable');">
            </div>
            <div class="bas">
                    <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                    <input id='clearForm' name="clear" type="reset"> 
                    <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                </div>
        </form>
        
    </div>
    
    <?php
} else {
    echo 'Le silence est d\'or';
}
