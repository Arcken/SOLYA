
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
 * Fonction pour tester les appels de js
 * Affiche une boite de message
 * @returns rien
 */
function test() {   //------------------------Appelable partout
    alert('Coucou');
}

/**
 * Fonction qui recherche le nombre d'occurence dans une table
 * @param $champs champs cible dans la table
 * @param $table nom de la table
 * @param $source nom de l'input contenant la valeur à chercher
 * @param $cible id du bloc html à modifier, 
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
 * 
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
            // If medium password matches the reg ex
            $('#passForce').text('Mot de passe moyen!');
        } else {
            // If password is ok
            $('#passForce').text('Mot de passe faible!');
        }
    }

}


/**
 * fonction qui teste si le pass et sa confirmation sont identique, affiche une alertbox si différents
 * @returns {Boolean}
 */
function verifPass() { //appel dans view_utilisateur 
    var test = false;

    if ($('#pass').val().length >= 8
            ) {
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
 * Fonction qui appel une page en spécifier le choix du trie pour les reqêtes
 * @param $action
 *  action à effectuer pour le contrôleur
 * @param $champs
 *  champs sur lequel porte le tri de la requéte
 * @returns rien
 */
function orderby($action, $champs) { //appel partout
    window.open('index.php?action=' + $action + "&orderby=" + $champs, '_self');
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
function delElt($id, $codetype, $type, $action, $precision) { //appel partout

    $resBool = confirm("Voulez-vous supprimez l'élément: \n" + $type + " numéro: " + $id);
    if ($resBool && $precision == null) {
        window.open('index.php?action=' + $action + "&" + $codetype + "=" + $id, '_self');
    }
    else if ($resBool && $precision.constructor === Array) {
        $url = "index.php?action=" + $action + "&" + $codetype + "=" + $id;
        for (var $key in $precision[$id]) {
            var $value = $precision[$id][$key];
            $url += "&" + $key + "=" + $value;
        }
        window.open($url, '_self');
    }
}

/**
 * Fonction qui définit le script à effectuer sur le bloc unload de la page affiché
 * @returns {undefined}
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


function getReference($row, $champs, $form) {
    $valInput = $("input[id='refId" + $row + "']");
    console.log("valeur case refid: " + $valInput.val());
    $textareaLblRef = $("textarea[id='refLbl" + $row + "']");
    $inputTD = $("input[id='beligTauxDouane" + $row + "']");
    console.log("valeur case lbl: " + $textareaLblRef.val());

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getRef', champs: $champs, value: $valInput.val()},
    function (json) {

        console.log("json: " + json);

        for (var key in json) {
            console.log("champs : " + $champs);
            console.log("formulaire : " + $form);
            if ($champs == "ref_id" && $form == "be")
                retourJsonRefid(key, json);

        }
    }
    );
}

function retourJsonRefid(key, json) {
    console.log('lbl' + json[key].ref_lbl);
    $textareaLblRef.val(json[key].ref_lbl);
    console.log('taux' + json[key].dd_taux);
    $inputTD.val(json[key].dd_taux);
}

