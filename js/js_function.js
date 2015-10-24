
/**
 * Fonction d'ajout de ligne
 * On prend tous ce qui se trouvent entre <tr id=idLigne> et </tr>
 * On modifie les valeurs nécessaires et on ajoute l'ensemble au document avant
 * la fin de la balise table
 * @param $table
 * Table html du document
 * @param $idTr
 * 
 * @returns {undefined}
 */
function addLigne($table, $idTr) {

    //on incrémente le compteur, cette variable est à instancier dans le formualaire
    //elle prendra comme valeur 0 pour les formulaires d'ajout
    //elle prendra comme valeur le nombre de ligne déja enregistré pour les 
    //formaulaires de modification
    nRowCount++;

    //On récupére le squelette du code entre le balises <tr id=$idTr> et </tr>
    $ligne = $('#' + $idTr).html();
    //On créé une variable qui est l'id du nouveau tr
    $id = $idTr + nRowCount;
    //on remplace tous les mots NID par le même numéro de ligne 
    $ligne = $ligne.replace(/NID/g, nRowCount);
    //on vide toutes les valeur des input pour 
    //que le require du formulaire fonctionne
    $ligne = $ligne.replace(/value="[^*"]*"/g, 'value=""');
    //On remplace idLigne par le nouvel id $id
    $ligne = $ligne.replace($idTr, $id);
    //On ajoute le code à la fin de la table
    $('#' + $table).append('<tr id="' + $id + '">' + $ligne + "</tr>");
}


/**
 * Fonction qui efface une balise html selon son id
 * @param $cible
 * Id de la balise cible
 * @returns {undefined}
 */
function delLigne($cible) {
    $res = confirm("Voulez vous supprimer cette ligne");
    if ($res) {
        $('#' + $cible).remove();
    }
}


/**
 * Fonction d'ouverture de nouvelle fenetre, 
 *      elle attend l'action du contrôleur en paramètre
 * @param $action 
 * action a effectuer pour le contrôleur
 * @returns {Boolean}
 */
function popup($action) //------------------------Appelable partout
{
    var width = 700;
    var height = 500;
    var left = (screen.width - width) / 2;
    var top = (screen.height - height) / 2;
    var params = 'width=' + width + ', height=' + height;
    params += ', top=' + top + ', left=' + left;
    params += ', directories=no';
    params += ', location=no';
    params += ', menubar=no';
    params += ', resizable=no';
    params += ', scrollbars=no';
    params += ', status=no';
    params += ', toolbar=no';
    newwin = window.open('index.php?action=nv_' + $action, 'windowname5', params);

    if (window.focus) {
        newwin.focus();
    }

    return false;
}

/**
 * 
 * @param $champs 
 * champs cible dans la table
 * @param $table 
 * nom de la table
 * @param $source 
 * nom de l'input contenant la valeur à chercher
 * @returns {undefined}
 */
function cptOccurence($champs, $table, $source) {
    //on récupére la valeur de l'input
    $valeur = $("input[id=" + $source + "]").val();
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getNombre', table: $table, champs: $champs, valeur: $valeur},
    function (json) {
        //La web service renvoie le nombre d'enregistrement trouvé
        if (json.total == 0) {
            //Si aucun enr trouvé on affiche
            return false;
        }
        else {
            //Si 1 ou plusieurs enr trouvé on affiche
            return true;
        }
    }
    );
}


function uniqueValueInForm($id) {

    //Tableau pour la valeur des inputs
    var $tabInputVal = new Array;
    //boolean de retour
    var $bTest = true;
    //pour chaque input commençant avec l'id mais != de lotIdP
    $('[id^="' + $id + '"]').not('[id^="' + $id + 'NID"], [id^="lotIdP"]').each(function () {
        //On test si la valeur est dans le tableau
        if ($tabInputVal.indexOf($(this).val()) > -1) {
            $bTest = false;
        }
        //On rajoute la valeur dans le tableau
        $tabInputVal.push($(this).val());
    });

    if (!$bTest)
        alert('Le formulaire comporte des doublons');
    return $bTest;
}


/**
 * Fonction qui recherche le nombre d'occurence dans une table
 * @param $champs 
 * champs cible dans la table
 * @param $table 
 * nom de la table
 * @param $source 
 * nom de l'input contenant la valeur à chercher
 * @param $cible 
 * id du bloc html à modifier, 
 * affiche une image de validation si aucun doublon
 * ou une croix pour un doublon
 * @returns {undefined}
 */
function verifUnique($champs, $table, $source, $cible) {  //appel dans view_utilisateur 
    //on récupére la valeur de l'input
    $valeur = $("input[id=" + $source + "]").val();
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getNombre', table: $table, champs: $champs, valeur: $valeur},
    function (json) {
        //La web service renvoie le nombre d'enregistrement trouvé
        if (json.total == 0) {
            //Si aucun enr trouvé on affiche
            $('#' + $cible).html('<img src="img/icon/accept.png">');
        }
        else {
            //Si 1 ou plusieurs enr trouvé on affiche
            $('#' + $cible).html('<img src="img/icon/delete.png">');
        }
    }
    );
}

/**
 * fonction qui rend visible une image si le pass 
 * et la confirmation sont identique
 * @returns boolean
 */
function verifPassImg() { //appel dans view_utilisateur 
    //on teste que le pass et sa confirmation ne soient pas nul
    //et soient identique
    if ($('#pass').val() != ''
            && $('#confirmPass').val() != ''
            && $('#pass').val() == $('#confirmPass').val())
    {
        $('#passValid').show();
    }
    else
        $('#passValid').hide();
}

/**
 * fonction qui test la solidité du mot de passe
 * @returns {undefined}
 */
function verifPassForce() { //appel dans view_utilisateur 
    //Si le pass est nom nul
    if ($('#pass').val() != ''
            )
    {
        // Doit contenir des majuscules, des chiffres et des minuscules
        var strongRegex = new RegExp("^(?=.{10,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$", "g");


        // Doit contenir soit des majuscules et des minuscules soit des minuscules et des chiffres
        var mediumRegex = new RegExp("^(?=.{8,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");


        // Doit faire au minimum huit caractères
        var okRegex = new RegExp("(?=.{8,}).*", "g");

        //On test si la longueur et trop courte
        if (okRegex.test($('#pass').val()) === false) {

            alert('Le mot de passe doit contenir 8 caractères minimum');

            //On teste la régle la plus forte
        } else if (strongRegex.test($('#pass').val())) {

            $('#passForce').text('Mot de passe fort!');
        } else if (mediumRegex.test($('#pass').val())) {
            // Si le mot de pass est moyen
            $('#passForce').text('Mot de passe moyen!');
        } else {
            // Si le mot de passe est faible
            $('#passForce').text('Mot de passe faible!');
        }
    }
}


/**
 * fonction qui teste si le pass et sa confirmation sont identique, 
 * affiche une alertbox si différents
 * @returns {Boolean}
 */
function verifPass() {  
    
    if ($('#pass').val().length >= 8) {
        if ($('#pass').val() != ''
                && $('#confirmPass').val() != ''
                && $('#pass').val() == $('#confirmPass').val())
        {
            return true;
        }
        else {
            alert('Le mot de passe et sa confirmation doivent être identique');
            return false;
        }
    }
    else
        alert('Le mot de passe doit être au moins de huit caractères');
    return false;
}


/**
 * Fonction qui appel qui rappel la même page en scpécifiant le tri 
 * pour les requètes
 * @param $action
 *  action à effectuer pour le contrôleur
 *  @param $ordre
 *  tri: ASC ou DESC
 * @param $champs
 *  champs sur lequel porte le tri de la requéte
 */
function orderby($action, $champs, $ordre) {
    window.open('index.php?action=' + $action + '&tri=' + $ordre + '&orderby=' + $champs, '_self');
}


/**
 * Fonction qui affiche une boite de confirmation pour la suppression
 * @param {string ou int} $id
 *  id de l'élément à effacer
 * @param string $codetype
 *  champs id l'élément
 * @param string $type
 * Type d'élément à supprimer (s'affiche dans la message box)
 * @param string $action
 * Action à effectuer pour le contrôleur
 * @param  précision[$id][key]
 * Arguments suplémentaire à passer dans l'url si besoin.(Optionnel)
 * @returns {undefined}
 */
function delElt($id, $codetype, $type, $action, $precision) {

    $resBool = confirm("Voulez-vous supprimez l'élément: \n" +
            $type + " numéro: " + $id);
    //si des précision sont définis 
    if ($resBool && $precision == null) {

        window.open('index.php?action=' + $action + "&" +
                $codetype + "=" + $id, '_self');
    }

    //Si $précision est un tableau
    else if ($resBool && $precision.constructor === Array) {

        $url = "index.php?action=" + $action + "&" + $codetype + "=" + $id;
        //On incorpore les cases du tableau à la variable url
        for (var $key in $precision[$id]) {
            var $value = $precision[$id][$key];
            $url += "&" + $key + "=" + $value;
        }
        window.open($url, '_self');
    }
}


/**
 * Fonction qui définit le script à effectuer sur le bloc unload de la page
 * selon l'action définie
 */
function selMaj() { // Appel partout
    var $action = $('#action').val();

    switch ($action) {


        case 'nv_ga_add':
            $("#newView").prop('onunload', window.opener.getGamme());
            break;

        case 'nv_mc_add' :
            $("#newView").prop('onunload', window.opener.getMc());
            break;

        case 'nv_nut_add' :
            $("#newView").prop('onunload', window.opener.getNut());
            break;


        case 'nv_pays_add':
            $("#newView").prop('onunload', window.opener.getPays());
            break;
    }
}

/**
 * Récupère les informations du lot à partir de son id et modifie des éléments
 * html selon leur id
 * @param  $row
 * id de la ligne à modifier dans le formulaire
 * @returns {undefined}
 */

function getLotDetail($row) {
    console.log('recherche' + $row);
    $lotIdVal = $('#lotId' + $row).val();
    console.log($lotIdVal);
    //Ajax
    $.getJSON(
            // page cible
            'ws/webService.php',
            //Paramètres
                    {test: 'Solya', action: 'getLot', lotId: $lotIdVal},
            //Callback
            function (json) {
                $refCodeInp = $('#refCode' + $row);
                $lotIdProducteurInp = $('#lotIdProducteur' + $row);
                $lotQtStockInp = $('#liginvQtStock' + $row);
                $lotQtReelInp = $('#liginvQtReel' + $row);
                $lotDlcInp = $('#lotDlc' + $row);
                for (var key in json) {
                    console.log(json);
                    $refCodeInp.val(json[key].ref_code);
                    $lotIdProducteurInp.val(json[key].lot_id_producteur);
                    $lotQtStockInp.val(json[key].lot_qt_stock);
                    $lotQtReelInp.prop('max', parseFloat(json[key].lot_qt_init));
                    $lotDlcInp.val(json[key].lot_dlc);
                }
            }
            );
        }


/**
 * Met à jour un bloc html selon les choix d'une combobox
 * @param $select
 * combobox source des données
 * @param $target
 * bloc p, div ou autre à modifier
 * @returns {undefined}
 */
function listSelect($select, $target) { //appel dans fiche article
    //on récupére la combox et ses options choisis
    $a = $('#' + $select + ' option:selected');
    //On écrit les valeurs récupérés dans un bloc html
    $('#' + $target).html($a.text());
}




//------------------------------AJAX---------------------------------

/**
 * Récupére les enregistrements de la table GAMME et met à jour la combobox
 * @returns {undefined}
 */
function getGamme() { //appel partout

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllGamme'},
    function (json) {
        console.log('dedans');
        var $select = $('#selGamme');
        console.log($select);
        $select.empty();
        $select.append('<option value="">Aucun</option>');
        for (var key in json) {
            $select.append('<option value="' + json[key].ga_id + '">'
                    + json[key].ga_lbl + '</option>');
        }
    }
    );
}

/**
 * * Récupére les enregistrements de la table Mode conservation et met à jour la combobox
 * @returns {undefined}
 */
function getMc() {

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllMc'},
    function (json) {
        console.log('dedans getMc');
        var $select = $('#modeConservation');
        console.log($select);
        $select.empty();
        $select.append('<option value="">Aucun</option>');
        for (var key in json) {
            $select.append('<option value="' + json[key].cons_id + '">'
                    + json[key].cons_lbl + '</option>');
        }
    }
    );
}


/**
 * * Récupére les enregistrements de la table NUTRITION et met à jour la combobox
 * @returns {undefined}
 */
function getNut() {

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllNut'},
    function (json) {
        console.log('dedans');
        var $divNut = $('#divNut');
        $('#divNut').empty();

        $divNut.append('<label> Table de nutrition: </label><br><br>');
        for (var key in json) {
            $divNut.append('<label for="nut' + json[key].nut_id + '">'
                    + json[key].nut_lbl + '</label><br>');
            $divNut.append('<input type="text" name="nut' + json[key].nut_id + '" '
                    + ' placeholder="saisie">');
            $divNut.append('<input type="text" class="inputSmall" name="nutAjr' + json[key].nut_id + '"'
                    + ' placeholder="###.#"><br>');
        }
    }
    );
}


/**
 * * Récupére les enregistrements de la table PAYS et met à jour la combobox
 * @returns {undefined}
 */
function getPays() {

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllPays'},
    function (json) {
        console.log('dedans');
        var $selectCol1 = $('#selPays');
        $selectCol1.empty();
        $selectCol1.append('<option value="">Aucun</option>');
        for (var key in json) {
            $selectCol1.append('<option value="' + json[key].PAYS_ID + '">'
                    + json[key].PAYS_NOM + '</option>');
        }
    }
    );
}

/**
 * Fonction ajax qui recherche une référence selon un champs
 * on spécifie le formulaire pour adapter la callback
 * @param $row
 * Ligne en cours du formulaire
 * @param $source
 * Id du champs source pour obtenir sa valeur
 * @param $champs
 * Champs pour la recherche
 * @param $form
 * Nom du formulaire
 * @returns {undefined}
 */
function getReference($row, $source, $champs, $form) {
    //On récupére la valeur de l'input
    $valInput = $("input[id='" + $source + "']").val();

    $.ajax({
            url: "ws/webService.php", // code cible    
            dataType: "jsonp", 
            data: {test: 'Solya', action: 'getRef', champs: $champs, value: $valInput}
        }).done(
    function (json) {

        for (var key in json) {
            //Si le champs est refid et le formulaire appelant est le bon entrée
            if ($champs == "ref_id" && $form == "be") {
                //On récupére les blocs html à modifier
                $inputRefCode = $("input[id='refCode" + $row + "']");
                $textareaLblRef = $("textarea[id='refLbl" + $row + "']");
                $inputRefPoidsBrut = $("input[id='refPoidsBrut" + $row + "']");
                $inputTD = $("input[id='beligTauxDouane" + $row + "']");

                //On assigne les valeurs récupérés par le json dans les blocs html
                $inputRefCode.val(json[key].ref_code);
                $textareaLblRef.val(json[key].ref_lbl);
                $inputRefPoidsBrut.val(json[key].ref_poids_brut);
                $inputTD.val(json[key].dd_taux);
            }
            if ($champs == "ref_code" && $form == "be") {
                //On récupére les blocs html à modifier
                $inputRefId = $("input[id='refId" + $row + "']");
                $textareaLblRef = $("textarea[id='refLbl" + $row + "']");
                $inputRefPoidsBrut = $("input[id='refPoidsBrut" + $row + "']");
                $inputTD = $("input[id='beligTauxDouane" + $row + "']");

                //On assigne les valeurs récupérés par le json dans les blocs html
                $inputRefId.val(json[key].ref_id);
                $textareaLblRef.val(json[key].ref_lbl);
                $inputRefPoidsBrut.val(json[key].ref_poids_brut);
                $inputTD.val(json[key].dd_taux);
            }

        }
    }
    );
}
