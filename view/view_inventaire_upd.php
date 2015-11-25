<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>
    <script type="text/javascript" src="js/js_calcul.js" ></script>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_bon.css" rel="stylesheet">
    
    <div class="corps">
        <?php ?>
        <form class="form" id="invAdd" action="index.php" method="post" 
              onsubmit='return uniqueValueInForm("lotId")'>
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <div class="col30">

                <label for="invId"> Inventaire numéro: </label><br>
                <input name="invId" 
                       id="invId"
                       type="text"
                       readonly=""
                       value="<?php echo $resInventaireDetail->inv_id?>">
                <br>

                <label for="invDate"> Inventaire date: </label><br>
                <input name="invDate" 
                       id="invDate"
                       type="date"
                       value="<?php echo $resInventaireDetail->inv_date?>"
                       required=""
                       >
                <br>

                <label for="invLbl"> Inventaire libellé: </label><br>
                <input name="invLbl" 
                       id="invLbl"
                       type="text"
                       value="<?php echo $resInventaireDetail->inv_lbl?>"
                       >
                <br>
            </div>
                <div class="col90">
                    <table class="beLigne" id="beTable">
                        <tr id="titreGnl" class="trColTitre">
                            <th class="colTitlSupUnique">
                                ID ligne
                            </th>
                            <th class="colTitlSupUnique">
                                Lot
                            </th>
                            <th class="colTitlSupUnique">
                                Lot id producteur
                            </th>
                            <th class="colTitlSupUnique">
                                Référence
                            </th>
                            <th class="colTitlSupUnique">
                                Qt stock
                            </th>
                            <th class="colTitlSupUnique">
                                Qt init
                            </th>
                            <th class="colTitlSupUnique">
                                Qt réelle
                            </th>
                            <th class="colTitlSupUnique">
                                Différence
                            </th>
                            <th class="colTitlSupUnique">
                                Commentaire
                            </th>                            
                            
                            <th class="colTitlSupUnique">
                                DLC-DLUO
                            </th>
                        </tr>
                        <tr id="idLigne" hidden="">
                            <td>
                                 <input type="text" 
                                       name="liginvId[NID]" 
                                       id="liginvIdNID"
                                       readonly=""                                       
                                       value=""
                                       >
                            </td>

                            <td  class="beLigneId">
                                <!-- Appel de fonction qui recherche un lot 
                                selon son id-->
                                <input type="text" 
                                       name="lotId[NID]" 
                                       id="lotIdNID"
                                       onblur='getLotDetail("NID")'
                                       >
                            </td>
                            <td class="beLigneCode">
                                <input type="text"
                                       name="refCode[NID]" 
                                       id="refCodeNID"
                                       readonly="">
                            </td>
                            <td class="beLigneCode">
                                <input type="text"
                                       name="lotIdProducteur[NID]" 
                                       id="lotIdProducteurNID"
                                       readonly="">
                            </td>
                            <td class="beLigneNb">
                                <input type="number" 
                                       value="1"
                                       min="0"
                                       required=""
                                       name="liginvQtStock[NID]" 
                                       id="liginvQtStockNID"
                                       readonly="">
                            </td>
                            <td class="beLigneNb">
                                <input type="number" 
                                       value="1"
                                       min="0"
                                       required=""
                                       name="lotQtInit[NID]" 
                                       id="lotQtInitNID"
                                       readonly="">
                            </td>
                            <td class="beLigneNb">
                                <input type="number" 
                                       value="1"
                                       min="0"
                                       step="any"
                                       required=""
                                       name="liginvQtReel[NID]" 
                                       id="liginvQtReelNID"
                                       onchange='ccSoustraction("liginvQtReelNID",
                                                           "liginvQtStockNID",
                                                           "diffLigNID");'>
                            </td>
                            <td>
                                <input type="number" 
                                       value="0" 
                                       step="any"
                                       name="diffLig[NID]" 
                                       id="diffLigNID"
                                       >                            
                            </td>
                            <td >
                                <textarea name="liginvLbl[NID]" 
                                          id="liginvLblNID" 
                                          class="beLigneT"></textarea>
                            </td>
                            
                            <td>
                                <input name="lotDlc" 
                                       id="lotDlc"
                                       type="date"
                                       readonly=""
                                       >
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


                        <?php
                        //Pour chaque ligne d'inventaire
                        for ($i = 0; $i < count($resAllLigneInventaire); $i++) {
                            //l'id du tr html est i+1, 0 étant celle du squellette
                            $idLigne = $i + 1;
                            //On récupère un objet ligneInventaire
                            $oLiginv = $resAllLigneInventaire[$i];
                            ?>
                            <tr id="idLigne<?php echo $idLigne ?>">
                                <td>
                                 <input type="text" 
                                       name="liginvId[<?php echo $idLigne ?>]" 
                                       id="liginvId<?php echo $idLigne ?>"
                                       readonly=""
                                       value="<?php echo $oLiginv->liginv_id ?>"
                                       
                                       >
                            </td>
                                <td  class="beLigneId">
                                    <!-- Appel de fonction qui recherche une reference 
                                    selon son id-->
                                    <input type="text" 
                                           name="lotId[<?php echo $idLigne ?>]" 
                                           id="lotId<?php echo $idLigne ?>"
                                           value='<?php echo $oLiginv->lot_id ?>'
                                           readonly=""
                                           >
                                </td>
                                 <td class="beLigneCode">
                                <input type="text"
                                       name="lotIdProducteur[NID]" 
                                       id="lotIdProducteurNID"
                                        value='<?php echo $resAllLots[$i]->lot_id_producteur ?>'
                                        readonly="">
                            </td>
                                <td class="beLigneCode">
                                    <!-- On récupére le refcode du lot et 
                                           on l'affiche -->
                                    <input type="text"
                                           name="refCode[<?php echo $idLigne ?>]" 
                                           id="refCode<?php echo $idLigne ?>"
                                           value="<?php echo $resAllRefCode[$i]->ref_code ?>"
                                           readonly="">
                                </td>
                                <td class="beLigneNb">
                                    <input type="number" 
                                           min="0"
                                           name="liginvQtStock[<?php echo $idLigne ?>]" 
                                           id="liginvQtStock<?php echo $idLigne ?>"
                                           value='<?php echo $resAllLots[$i]->lot_qt_stock ?>'
                                           readonly=""
                                           >
                                </td>
                                <td class="beLigneNb">
                                    <input type="number" 
                                           min="0"
                                           name="lotQtInit[<?php echo $idLigne ?>]" 
                                           id="lotQtInit<?php echo $idLigne ?>"
                                           value='<?php echo $resAllLots[$i]->lot_qt_stock ?>'
                                           readonly=""
                                           >
                                </td>
                                <td class="beLigneNb">
                                    <input type="number" 
                                           onchange='ccSoustraction("liginvQtReel<?php echo $idLigne ?>",
                                                                   "liginvQtStock<?php echo $idLigne ?>",
                                                                   "diffLig<?php echo $idLigne ?>");'
                                           min="0"
                                           step="any"
                                           max="<?php echo $resAllLots[$i]->lot_qt_init ?>"
                                           name="liginvQtReel[<?php echo $idLigne ?>]" 
                                           id="liginvQtReel<?php echo $idLigne ?>"
                                           value='<?php echo $oLiginv->liginv_qt_reel ?>'
                                           >
                                </td>
                                <td>
                                    <input type="number" 
                                           value="0" 
                                           step="any"
                                           name="diffLig[<?php echo $idLigne ?>]" 
                                           id="diffLig<?php echo $idLigne ?>"
                                           readonly=""
                                           >                            
                                </td>
                                <td >
                                    <textarea name="liginvLbl[<?php echo $idLigne ?>]" 
                                              id="liginvLbl<?php echo $idLigne ?>" 
                                              class="beLigneT"><?php echo $oLiginv->liginv_lbl ?></textarea>
                                </td>

                                <td>
                                    <input name="lotDlc" 
                                           id="lotDlc"
                                           type="date"
                                           value='<?php echo $resAllLots[$i]->lot_dlc ?>'
                                           readonly="">
                                </td>
                                

                            </tr>
                        <?php } ?>
                    </table>
                    <!-- Ajoute une ligne -->
                    <input type="button" 
                           value="Ajouter ligne" 
                           onclick='addLigne("beTable", "idLigne")'>
                    <script type="text/javascript">
                        //On initialise le compte de ligne pour la fonction addLigne
                        nRowCount = parseInt(<?php if (is_array($resStock)) {
                                echo count($resStock);
                            } else {
                                echo 0;
                            }
                            ?>);
                    </script>
               

                </div>
            
            <div class="bas">
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                 <input name="btnForm" type="submit" value="Executer">
                <input name="clear" type="reset">
            </div>
        </form>
    </div>


    <?php
} else {
    echo 'Le silence est d\'or';
}