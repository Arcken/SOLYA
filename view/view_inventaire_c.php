<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <div class="corps">
        <form class="form" action="index.php" method="get">
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



                <div class="col90">
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
                                Bon id
                            </th>
                            <th>
                                Différence
                            </th>
                        </tr>
                        <tr id="idLigne" hidden="">

                            <td  class="beLigneId">
                                <!-- Appel de fonction qui recherche une reference 
                                selon son id-->
                                <input type="number" 
                                       name="lotId[NID]" 
                                       id="lotIdNID"
                                       onblur='' 
                                       min="0">
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
                                       name="liginv_qt_stock[NID]" 
                                       id="liginv_qt_stockNID">
                            </td>
                            <td class="beLigneNb">
                                <input type="number" 
                                       value="1"
                                       min="0"
                                       step="0.01"
                                       name="liginv_qt_reel[NID]" 
                                       id="liginv_qt_reelNID">
                            </td>
                            <td >
                                <textarea name="liginvLbl[NID]" 
                                          id="liginvLblNID" 
                                          class="beLigneT"></textarea>
                            </td>
                            <td>
                                <textarea name="ligCom[NID]" 
                                          id="ligComNID"  
                                          class="beLigneT"></textarea>
                            </td>
                            <td class="beLigneCode">
                                <input type="text"
                                       name="bonId[NID]" 
                                       id="bonIdNID"
                                       onblur=''>
                            </td>
                            <td>
                                <input type="number" 
                                       value="0" 
                                       step="0.01"
                                       name="diffLig[NID]" 
                                       id="diffLigNID"
                                       value="">                            
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
                </div>


            </div>
        </form>
    </div>


                <?php
            } else {
                echo 'Le silence est d\'or';
            }