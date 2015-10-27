<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_bon.css" rel="stylesheet">
    <div class="corps">
        <form class="form" action="index.php" method="get" 
               onsubmit='return uniqueValueInForm("lotId")'>
            <input name='token' type="text" value ='<?php echo rand(1, 1000000) ?>' hidden/>
            <div class="col30">

                <label for="invDate"> Date </label><br>
                <input name="invDate" 
                       id="invDate"
                       type="date"
                       value="<?php echo date('Y-m-d')?>"
                       required=""
                       >
                <br>

                <label for="invLbl"> Libellé </label><br>
                <input name="invLbl" 
                       id="invLbl"
                       type="text"
                       >
                <br>
                </div>
            <div class="col90">
                <!-- Ligne de titre-->
                <table class="beLigne" id="beTable">
                    <tr id="titreGnl" class="trColTitre">
                        <th class="colTitlSupUnique">
                            Lot
                        </th>
                        <th class="colTitlSupUnique">
                            Référence
                        </th>
                        <th class="colTitlSupUnique">
                            Lot Id Producteur
                        </th>
                        <th class="colTitlSupUnique">
                            Qt stock
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
                            <!-- Appel de fonction qui recherche une reference 
                            selon son id-->
                            <input type="text" 
                                   name="lotId[NID]" 
                                   id="lotIdNID"
                                   required=""
                                   value="1"
                                   onblur='getLotDetail("NID")'
                                   >
                        </td>
                        <td>
                            <input type="text"
                                   name="refCode[NID]" 
                                   id="refCodeNID"
                                   readonly="">
                        </td>
                        <td>
                            <input type="text"
                                   name="lotIdProducteur[NID]" 
                                   id="lotIdProducteurNID"
                                   readonly="">
                        </td>
                        <td>
                            <input type="number" 
                                   value="1"
                                   min="0"
                                   step="any"
                                   name="liginvQtStock[NID]" 
                                   id="liginvQtStockNID"
                                   readonly="">
                        </td>
                        <td >
                            <textarea name="liginvLbl[NID]" 
                                      id="liginvLblNID" 
                                      class="beLigneT"></textarea>
                        </td>
                        <td class="tdDate">
                            <input name="lotDlc[NID]" 
                                   id="lotDlc[NID]"
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
                    //Pour chaque lot en stock
                    if (is_array($resStock)){
                    for ($i = 0; $i < count($resStock); $i++) {
                        //l'id du tr html est i+1, 0 étant celle du squellette
                        $idLigne = $i + 1;
                        //On récupère un objet lot
                        $oLot = $resStock[$i];
                        ?>
                        <tr id="idLigne<?php echo $idLigne ?>">
                            <td  class="beLigneId">
                                <!-- Appel de fonction qui recherche une reference 
                                selon son id-->
                                <input type="text" 
                                       name="lotId[<?php echo $idLigne ?>]" 
                                       id="lotId<?php echo $idLigne ?>"
                                       value='<?php echo $oLot->lot_id ?>'
                                       required=""
                                       readonly=""
                                       >
                            </td>
                            <td class="beLigneCode">
                                <!-- On récupére le refcode du lot et 
                                       on l'affiche -->
                                <input type="text"
                                       name="refCode[<?php echo $idLigne ?>]" 
                                       id="refCode<?php echo $idLigne ?>"
                                       value="<?php echo $resStockRefCode[$i] ?>"
                                       readonly="">
                            </td>
                            <td class="beLigneCode">
                                <input type="text"
                                       name="lotIdProducteur[NID]" 
                                       id="lotIdProducteurNID"
                                        value='<?php echo $oLot->lot_id_producteur ?>'
                                        readonly="">
                            </td>
                            <td class="beLigneNb">
                                <input type="number" 
                                       min="0"
                                       step="any"
                                       name="liginvQtStock[<?php echo $idLigne ?>]" 
                                       id="liginvQtStock<?php echo $idLigne ?>"
                                       value='<?php echo $oLot->lot_qt_stock ?>'
                                       readonly=""
                                       >
                            </td>
                            <td >
                                <textarea name="liginvLbl[<?php echo $idLigne ?>]" 
                                          id="liginvLbl<?php echo $idLigne ?>" 
                                          class="beLigneT"></textarea>
                            </td>
                            <td>
                                <input name="lotDlc[<?php echo $idLigne ?>]" 
                                       id="lotDlc<?php echo $idLigne ?>"
                                       type="date"
                                       value='<?php echo $oLot->lot_dlc ?>'
                                       readonly=""
                                       >
                            </td>

                        </tr>
                    <?php } }?>
                </table>
                <!-- Ajoute une ligne -->
                <input type="button" 
                       value="Ajouter ligne" 
                       onclick='addLigne("beTable", "idLigne")'>
                <script type="text/javascript">
                    //On initialise le compte de ligne pour la fonction addLigne
                    $count = <?php echo count($resStock) ?>;
                    if ($count >1){
                    nRowCount = parseInt(<?php echo count($resStock) ?>);
                } else {
                    nRowCount = 0;
                }
                </script>



            </div>
            <div class="bas">
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
                <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
            </div>
        </form>
    </div>


    <?php
} else {
    echo 'Le silence est d\'or';
}