<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>
    <script type="text/javascript" src="js/calculFct.js" ></script>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <div class="corps">
        <form class="form" action="index.php" method="get">
            <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
            <div class="col90">

                <label for="invId"> Inventaire numéro: </label><br>
                <input name="invId" 
                       id="invId"
                       type="text"
                       readonly=""
                       >
                <br>

                <label for="invDate"> Inventaire date: </label><br>
                <input name="invDate" 
                       id="invDate"
                       type="date"
                       >
                <br>

                <label for="invLbl"> Inventaire libellé: </label><br>
                <input name="invLbl" 
                       id="invLbl"
                       type="text"
                       >
                <br>



             
                    <table class="beLigne" id="beTable">
                        <tr id="titreGnl">
                            <th>
                                Lot
                            </th>
                            <th>
                                Référence
                            </th>
                            <th>
                                Qt stock
                            </th>
                            <th>
                                Qt réelle
                            </th>
                            <th>
                                Commentaire
                            </th>                            
                            <th>
                                Différence
                            </th>
                            <th>
                                DLC-DLUO
                            </th>
                        </tr>
                        <tr id="idLigne" hidden="">

                            <td  class="beLigneId">
                                <!-- Appel de fonction qui recherche une reference 
                                selon son id-->
                                <input type="text" 
                                       name="lotId[NID]" 
                                       id="lotIdNID"
                                       >
                            </td>
                            <td class="beLigneCode">
                                <input type="text"
                                       name="refCode[NID]" 
                                       id="refCodeNID"
                                       onblur=''>
                            </td>
                            <td class="beLigneNb">
                                <input type="number" 
                                       value="1"
                                       min="0"
                                       step="0.01"
                                       name="liginvQtStock[NID]" 
                                       id="liginvQtStockNID">
                            </td>
                            <td class="beLigneNb">
                                <input type="number" 
                                       value="1"
                                       min="0"
                                       step="0.01"
                                       name="liginvQtReel[NID]" 
                                       id="liginvQtReelNID"
                                       onchange='ccSoustraction("liginvQtStockNID",
                                                           "liginvQtReelNID",
                                                           "diffLigNID");'>
                            </td>
                            <td >
                                <textarea name="liginvLbl[NID]" 
                                          id="liginvLblNID" 
                                          class="beLigneT"></textarea>
                            </td>
                            <td>
                                <input type="number" 
                                       value="0" 
                                       step="0.01"
                                       name="diffLig[NID]" 
                                       id="diffLigNID"
                                       value="">                            
                            </td>
                            <td>
                                <input name="lotDlc" 
                                       id="lotDlc"
                                       type="date"
                                       >
                            </td>

                        </tr>


                        <?php
                        //Pour chaque lot en stock
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
                                           >
                                </td>
                                <td class="beLigneCode">
                                    <!-- On récupére le refcode du lot et 
                                           on l'affiche -->
                                    <input type="text"
                                           name="refCode[<?php echo $idLigne ?>]" 
                                           id="refCode<?php echo $idLigne ?>"
                                           value="<?php echo ReferenceManager::getRefCode($oLot->lot_id)->ref_code ?>"
                                           onblur=''>
                                </td>
                                <td class="beLigneNb">
                                    <input type="number" 

                                           min="0"
                                           step="0.01"
                                           name="liginvQtStock[<?php echo $idLigne ?>]" 
                                           id="liginvQtStock<?php echo $idLigne ?>"
                                           value='<?php echo $oLot->lot_qt_stock ?>'
                                           >
                                </td>
                                <td class="beLigneNb">
                                    <input type="number" 
                                           onchange='ccSoustraction("liginvQtStock<?php echo $idLigne ?>",
                                                                   "liginvQtReel<?php echo $idLigne ?>",
                                                                   "diffLig<?php echo $idLigne ?>");'
                                           min="0"
                                           step="0.01"
                                           name="liginvQtReel[<?php echo $idLigne ?>]" 
                                           id="liginvQtReel<?php echo $idLigne ?>">
                                </td>
                                <td >
                                    <textarea name="liginvLbl[<?php echo $idLigne ?>]" 
                                              id="liginvLbl<?php echo $idLigne ?>" 
                                              class="beLigneT"></textarea>
                                </td>

                                <td class="beLigneCode">
                                    <input type="text" 
                                           value=""

                                           name="bonId[<?php echo $idLigne ?>]" 
                                           id="bonId<?php echo $idLigne ?>"
                                           onblur=''>
                                </td>
                                <td>
                                    <input type="number" 
                                           value="0" 
                                           step="0.01"
                                           name="diffLig[<?php echo $idLigne ?>]" 
                                           id="diffLig<?php echo $idLigne ?>"
                                           value="">                            
                                </td>
                                <td>
                                    <input name="lotDlc" 
                                           id="lotDlc"
                                           type="date"
                                           value='<?php echo $oLot->lot_dlc ?>'
                                           >
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
                        nRowCount = parseInt(<?php echo count($resStock) ?>);
                    </script>
               


            </div>
        </form>
    </div>


    <?php
} else {
    echo 'Le silence est d\'or';
}