

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
    console.log($("#typeBon").select().text());
    switch (typeBon) {

        case "":
            $('#divTable').hide();
            $('#zoneBtnBon').hide();
            $('#divBsArea').hide();
            break;

        case "1":
        case "2":
        case "3":
        case "4":
        case "5":
        case "6":
        case "7":
            $('#divBsArea').hide();
            $('#bonSortie').val('');
            $('#divTable').show();
            $('#zoneBtnBon').show();
            break;

        case "8":
        case "9":
        case "10":
        case "11":
        case "12":
            $('#divBsArea').show();
            $('#divTable').show();
            $('#zoneBtnBon').show();
            break;

    }
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

function getLotsFromCurReference($row) {

    $refIdId = 'refId' + $row;
    $valInput = $('#' + $refIdId);
    $divAlert = $('#alert');
    $divAlert.text('');
    $typeBon = $('#typeBon').val();

    //requète à la base
    $.getJSON(
            // url cible
            'ws/webService.php',
            //Paramètres
                    {test: 'Solya', action: 'getLots', refId: $valInput.val(), typeBon: $typeBon},
            //Callback
            function (json) {

                console.log("json" + json);
                var $myTab = '<table id="tabAlert">\n' +
                        ' <tr>\n  ' +
                        '<th>N°LOT</th>\n  ' +
                        '<th>DLC/DLUO</th>\n  ' +
                        '<th>QTE STOCK</th>\n  ' +
                        '<th>QTE INITIAL</th>\n' +
                        ' </tr>\n';

                for (var key in json) {
                    console.log('lot_id' + json[key].lot_id);
                    d = new Date(json[key].lot_dlc);
                    $myTab += ' <tr>\n   ' +
                            '<td>' + json[key].lot_id + '</td>\n   ' +
                            '<td>' + d.getDate() + '/' + d.getMonth() +
                            '/' + d.getFullYear().toString().substring(2, 4) +
                            '</td>\n   ' +
                            '<td>' + json[key].lot_qt_stock + '</td>\n   ' +
                            '<td>' + json[key].lot_qt_init + '</td>\n' +
                            ' </tr>\n';
                }
                $myTab += '</table>';
                console.log($myTab);
                $divAlert.append($myTab);
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
        case "2":
        case "3":
        case "4":
        case "5":
        case "6":
        case "7":
            //On récupère l'action pour déterminer le traitement
             $sAction = $('#action').val();
            //On construit L'id de la ligne si nous sommes sur une modification 
             $ligIdId='ligId'+$row;
            //On récupère la valeur de la ligne 
            //Si elle est vide cela correspond à une insertion de ligne 
            //sinon cela correspond à une modification
             $ligId   =$('#'+$ligIdId).val();
             console.log('$ligID = '+$('#'+$ligIdId).val());
            
            if ($sAction === "bon_detail" && $ligId!== "" ){
                //Cas de la modification du bon de sortie
                //Récupère la quantité initial 
                $lotQteOldId = 'ligQteOld' + $row;
                $ligQteOld = $('#' + $lotQteOldId).val();
                console.log('pouete pouete '+$ligQteOld);
                
                //Récupère la quantité en stock du lot
                $.getJSON(
                        // url cible
                        'ws/webService.php',
                        //Paramètres
                                {test: 'Solya', action: 'getLot', lotId: $valInput.val()},
                        //Callback
                        function (json) {

                            //Initialisation de la variable nb
                            var $nb = '';
                            for (var key in json) {
                                console.log('lot_Qte ' + json[key].lot_qt_stock);
                                
                                //La nouvelle quantité sortie doit être inférieur 
                                //à qté en stock 
                                $nb = parseFloat(json[key].lot_qt_stock);
                                
                                console.log('lotqtstk = '+json[key].lot_qt_stock);
                                console.log('oldValue = '+$ligQteOld);
                                console.log('$nb = '+$nb);
                            }
                            //Enfin on change la valeur de l'attribut Max de l'input Qte
                            $inptQte.attr('max', $nb);
                        }
                        );
            } else {
                //Cas de l'insertion d'un bon de sortie
                //Récupère la quantité en stock du lot
                $.getJSON(
                        // url cible
                        'ws/webService.php',
                        //Paramètres
                                {test: 'Solya', action: 'getLot', lotId: $valInput.val()},
                        //Callback
                        function (json) {

                            //Initialisation de la variable nb
                            var $nb = '';
                            for (var key in json) {
                                console.log('lot_Qte ' + json[key].lot_qt_stock);
                                //Récupération de la valeur qte qui doit être utilisé pour créer la limit
                                $nb = parseFloat(json[key].lot_qt_stock);
                                console.log('$nb='+$nb);
                            }
                            //Enfin on change la valeur de l'attribut Max de l'input Qte
                            $inptQte.attr('max', $nb);
                        }
                        );

            }
            break;

        case "8":
        case "9":
        case "10":
        case "11":
        case "12":

            //On récupère l'action pour déterminer le traitement
             $sAction = $('#action').val();
            //On construit L'id de la ligne si nous sommes sur une modification 
             $ligIdId='ligId'+$row;
            //On récupère la valeur de la ligne 
            //Si elle est vide cela correspond à une insertion de ligne 
            //sinon cela correspond à une modification
             $ligId   =$('#'+$ligIdId);
             console.log('$ligID = '+$('#'+$ligIdId).val());

            if ($ligId && $sAction === "bon_detail" && ($ligId.val()!=="")  ) {
                //Cas de la modification d'un bon de retour
                //Récupère la quantité initial 
                $lotQteOldId = 'ligQteOld' + $row;
                $ligQteOld = $('#' + $lotQteOldId).val();
                console.log($ligQteOld);
                $.getJSON(
                        // url cible
                        'ws/webService.php',
                        //Paramètres
                                {test: 'Solya', action: 'getLot', lotId: $valInput.val()},
                        //Callback
                        function (json) {
                            //Initialisation de la variable nb
                            var $nb = '';
                            for (var key in json) {
                                //Récupération de la valeur qte qui doit être utilisé pour créer la limit
                                //La quantité retourner 
                                //doit être < ou = à la quantité initial - la qté en stock  + l'ancienne valeur retourné
                                //
                                $nb = parseFloat(json[key].lot_qt_init) - parseFloat(json[key].lot_qt_stock) + parseFloat($ligQteOld);
                                console.log('$nb='+$nb);
                            }
                            //Enfin on change la valeur de l'attribut Max de l'input Qte
                            $inptQte.attr('max', $nb);
                        }
                        );
            } else {

                //Cas de l'insertion d'un bon de retour
                //Récupère la quantité initial 
                $.getJSON(
                        // url cible
                        'ws/webService.php',
                        //Paramètres
                                {test: 'Solya', action: 'getLot', lotId: $valInput.val()},
                        //Callback
                        function (json) {
                            //Initialisation de la variable nb
                            var $nb = '';
                            for (var key in json) {
                                //Récupération de la valeur qte qui doit être utilisé pour créer la limit
                                //La quantité retourné  
                                //doit être < ou = à la qté initial - la qté en stock
                                $nb = parseFloat(json[key].lot_qt_init) - parseFloat(json[key].lot_qt_stock);
                                console.log('$nb='+$nb);
                            }
                            //Enfin on change la valeur de l'attribut Max de l'input Qte
                            $inptQte.attr('max', $nb);
                        }
                        );
                    }
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

    if (parseFloat($inptQte.val()) <= parseFloat($inptQte.attr('max'))) {
        $color = 'green';
        $inptQte.css('color', $color);
    } else {
        $color = 'red';
        $inptQte.css('color', $color);
    }
}