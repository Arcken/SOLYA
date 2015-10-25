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
        <form class="form" 
              action="index.php"
              method="post"
              onsubmit='return uniqueValueInForm("lotId")'>
            <div class="col50">
                
                <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
                <label for="numFact"> Numéro de facture </label><br>
                <input name="numFact"  id="nFact" placeholder="Numéro de Facture" type="text" >
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
                <input name="bonDate" placeholder="Date" type="Date" required>
                <br>
                <label for="bonCom">Commentaire</label><br>
                <textarea name="bonCom" placeholder="Commentaire">Com</textarea>
                <br>
                <label for="cptId"> N°compte associé:</label><br>
                <input name="cptId" placeholder="Identifiant compte associé" type="texte">
                <div id='divBsArea' style='display:none;'>
                    <label for="bonSortie">Bon de sortie associé :</label><br>
                    <input name="bonSortie" placeholder="N° du bon de sortie" id="bonSortie">
                </div>
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
                    <tr id="idLigne" hidden>
                        <td  class="bonLigneId">
                            <input type="text" name="refId[]" id='refIdNID' onblur="getReferenceBonFromId('NID');">
                        </td>
                        <td class="bonLigneCode">
                            <input type="text"
                                   value="0" 
                                   name="refCode[]" 
                                   id='refCodeNID' 
                                   onblur="getReferenceBonFromRefCode('NID');"
                                   required>
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
                                    name="lotId[]" 
                                    id='lotIdNID' 
                                    onfocus="getLotsFromCurReference('NID');"
                                    value="1"
                                    required
                                    >
                        </td>
                        <td class="bonLigneNb">
                            <input type="number" name="ligQte[]" id='ligQteNID' 
                                   value="1" step="any"
                                   onblur="confirmQteStock('NID');"
                                   onfocus="limitQteMax('NID');" min='1' 
                                   required>
                        </td>
                        
                        <td >
                            <textarea name="ligDepot[]" id='ligDepotNID' class="bonLigneT"
                                      rows="2" cols="30"
                                      >Dépot?</textarea>
                        </td>
                        <td>
                            <textarea name="ligCom[]" id ='ligComNID' class="bonLigneT" 
                                      rows="2" cols="30">Commentaire</textarea>
                        </td>
                        <td class="bonLigneImg">
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                                 onclick="delLigne('idLigne');" class="tdImgTd"/>
                        </td>
                    </tr>
                </table>
                <input type="button" value="Ajouter ligne" onclick="addLigne('bonTable','idLigne');">
                <script type="text/javascript">
                    nRowCount=1;
                </script>
            </div>
            <div class="bas" id="zoneBtnBon" style='display:none'>
                    <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                    <input id='clearForm' name="clear" type="reset"> 
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