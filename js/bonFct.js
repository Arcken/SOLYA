

/**
 * Choisis les éléments à afficher selon la valeur du TypeBon
 * 
 * 
 * @returns {undefined}
 */
function formChooserBon() {
    //Listener pour click sur le bouton réinitialiser
    $('#clearForm').click(function () {
        location.href = 'index.php?action=bon_add';
    });


    var typeBon = $("#typeBon").val();

    switch (typeBon) {

        case "":
            $('#divTable').hide();
            $('#zoneBtnBon').hide();
            break;

        default:
            $('#divTable').show();
            $('#zoneBtnBon').show();
            break;

    }
}


/**
 * Ajoute une ligne de bon à la page 
 *  
 * @param {String} $row
 * @returns {undefined}
 */
nRowCount = 1;
function ajoutBonLigne($table) {

    $('#nbLigne').val(nRowCount);
    $ligne = $('#bonligne').html();
    $id = "bonligne" + nRowCount;
    //on remplace tous les mots NID par le même numéro de ligne 
    $ligne = $ligne.replace(/NID/g, nRowCount);
    //On remplace beligne par 'beligne + numéro de ligne'
    $ligne = $ligne.replace(/bonligne>/, $id);

    $('#' + $table).append('<tr id="' + $id + '">' + $ligne + "</tr>");
    console.log($ligne);
    nRowCount++;
}

/**
 * Récupère les informations de la référence 
 * par son ID  
 * @param {String} $row
 * @returns {undefined}
 */
function getReferenceBonFromId($row) {

//Champs sur lequel la valeur va être prise
    $refId = 'refId' + $row;
    $valInput = $('#' + $refId);

//Construction des Ids et récupération des éléments concernés
    $refIdId = 'refId' + $row;
    $refCodId = 'refCode' + $row;
    $refLblId = 'refLbl' + $row;

    $inptRefId = $('#' + $refIdId);
    $inptCodeRef = $('#' + $refCodId);
    $txtAreaLblRef = $('#' + $refLblId);

//requète à la base
    $.getJSON(
            // url cible
            'ws/webService.php',
            //Paramètres
                    {test: 'Solya', action: 'getRef', champs: 'ref_id', value: $valInput.val()},
            //Callback
            function (json) {

                console.log("json" + json);

                for (var key in json) {
                    console.log('lbl' + json[key].ref_lbl);
                    $inptRefId.val(json[key].ref_id);
                    $inptCodeRef.val(json[key].ref_code);
                    $txtAreaLblRef.val(json[key].ref_lbl);

                }
            }
            );

        }

/**
 * Récupère les informations de la référence 
 * par son REFCODE  
 * @param {String} $row
 * @returns {undefined}
 */
function getReferenceBonFromRefCode($row) {

    //Construction des Ids
    $refIdId = 'refId' + $row;
    $refCodId = 'refCode' + $row;
    $refLblId = 'refLbl' + $row;

    //Champs de valeur de départ
    $valInput = $('#' + $refCodId);

    //Champs à modifier
    $inptRefId = $('#' + $refIdId);
    $inptCodeRef = $('#' + $refCodId);
    $txtAreaLblRef = $('#' + $refLblId);



    //requète à la base
    $.getJSON(
            // url cible
            'ws/webService.php',
            //Paramètres
                    {test: 'Solya', action: 'getRef', champs: 'ref_code', value: $valInput.val()},
            //Callback
            function (json) {



                for (var key in json) {

                    $inptRefId.val(json[key].ref_id);
                    $inptCodeRef.val(json[key].ref_code);
                    $txtAreaLblRef.val(json[key].ref_lbl);

                }
            }
            );

        }

/**
 * Récupère les lots associé à la référence et les affiches dans la zone infos
 * @param {String} $row
 * @returns {undefined}
 */

function getLotsFromReference($row) {
    
    $refIdId = 'refId' + $row;
    $valInput = $('#' + $refIdId);
    $divAlert = $('#alert');
    $divAlert.text('');
    $typeBon=$('#typeBon').val();
    
    //requète à la base
    $.getJSON(
            // url cible
            'ws/webService.php',
            //Paramètres
                    {test: 'Solya', action: 'getLots', refId: $valInput.val(), typeBon:$typeBon},
            //Callback
            function (json) {

                console.log("json" + json);
                $divAlert.append('<table id="tabAlert">\n\
                               <th>N°Lot</th>\n\
                               <th>DLUO</th>\n\
                               <th>QTE EN STOCK</th>\n\
                               <th>QTE INITIAL</th>');

                for (var key in json) {
                    console.log('lot_id' + json[key].lot_id);
                    d = new Date(json[key].lot_date_max);
                    $divAlert.append(
                            '<tr>\n\
                                  <td>' + json[key].lot_id + '</td>\n\
                                  <td>' + d.getDate() + '/' + d.getMonth() +
                                    '/' + d.getFullYear().toString().substring(2, 4)+
                                  '</td>\n\
                                  <td>' + json[key].lot_qt_stock + '</td>\n\
                                  <td>' + json[key].lot_qt_init + '</td>\n\
                             </tr>');
                }
                $divAlert.append('</table>');
                $divAlert.show();
            }
            );



        }

/**
 * Fonction permettant de limiter la valeur
 * du champs qte pour qu'elle ne dépasse pas la qte en stock.
 * 
 * @param {String} $row
 * @returns {undefined}
 */
function limitQteMax($row) {

    //id des éléments à modifier
    $lotIdId = 'lotId' + $row;
    $lotQteId = 'ligQte' + $row;

    //Récupération des inputs
    var $valInput = $('#' + $lotIdId);
    var $inptQte = $('#' + $lotQteId);
    var $typeBon = $('#typeBon').val();

    switch ($typeBon) {
        //Bon de sortie 

        case "1":
            //Récupère la quantité en stock du lot
            $.getJSON(
                    // url cible
                    'ws/webService.php',
                    //Paramètres
                            {test: 'Solya', action: 'getLotQte', lotId: $valInput.val()},
                    //Callback
                    function (json) {

                        //Initialisation de la variable nb
                        var $nb = '';
                        for (var key in json) {

                            console.log('lot_Qte ' + json[key].lot_qt_stock);

                            //Récupération de la valeur qte qui doit être utilisé pour créer la limit
                            $nb = parseInt(json[key].lot_qt_stock);



                        }
                        //Enfin on change la valeur de l'attribut Max de l'input Qte
                        $inptQte.attr('max', $nb);
                    }
                    );
                    break;

                case "2":
                    
                    //Récupère la quantité initial 
                    $.getJSON(
                            // url cible
                            'ws/webService.php',
                            //Paramètres
                                    {test: 'Solya', action: 'getLotQte', lotId: $valInput.val()},
                            //Callback
                            function (json) {

                                //Initialisation de la variable nb
                                var $nb = '';
                                for (var key in json) {

                                   

                                    //Récupération de la valeur qte qui doit être utilisé pour créer la limit
                                    $nb=parseInt(json[key].lot_qt_init)-parseInt(json[key].lot_qt_stock);



                                }
                                //Enfin on change la valeur de l'attribut Max de l'input Qte
                                $inptQte.attr('max', $nb);
                            }
                            );
                            break;
                    }
        }


        function confirmQteStock($row) {

            //id des éléments à modifier
            $lotQteId = 'ligQte' + $row;
            console.log($lotQteId);
            //Récupération des inputs
            var $inptQte = $('#' + $lotQteId);
            console.log('Valeur dans l\'input: ' + $inptQte.val());
            console.log('Valeur de l\'attribut Max :' + $inptQte.attr('max'));

            if ($inptQte.val() <= parseInt($inptQte.attr('max'))) {
                $color = 'green';
                $inptQte.css('color', $color);
            } else {
                $color = 'red';
                $inptQte.css('color', $color);
            }
        }