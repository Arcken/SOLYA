/**
 * Fonction d'ouverture de nouvelle fenetre, 
 *      elle attend la page à afficher en paramètre
 * @param string 
 * action a effectuer pour le contrôleur
 * @returns {Boolean}
 */
function popup(action)
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
    newwin = window.open('index.php?action=nv_' + action, 'windowname5', params);

    if (window.focus) {
        newwin.focus()
    }
    return false;
}

/**
 * Fonction pour tester les appels de js
 * Affiche une boite de message
 * @returns rien
 */
function test() {
    alert('Coucou');
}

/**
 * Fonction qui appel une page en spécifier le choix du trie pour les reqêtes
 * @param string
 *  action à effectuer pour le contrôleur
 * @param string
 *  champs sur lequel porte le tri de la requéte
 * @returns rien
 */
function orderby(action, champs) {
    window.open('index.php?action=' + action + "&orderby=" + champs, '_self');
}

/**
 * Fonction qui affiche une boite de confirmation pour la suppression
 * @param string ou int
 *  id de l'élément à effacer
 * @param string
 *  champs id l'élément
 * @param string
 * Type d'élément à supprimer (s'affiche dans la message box)
 * @param string
 * Action à effectuer pour le contrôleur
 * @returns {undefined}
 */
function delElt(id, codetype, type, action) {
    $resBool = confirm("Voulez-vous supprimez l'élément: " + type + " numéro: " + id);
    if ($resBool) {
        window.open('index.php?action=' + action + "&" + codetype + "=" + id, '_self')
    }
}

/**
 * Fonction qui définit le script à effectuer sur le bloc unload de la page affiché
 * @returns {undefined}
 */
function selMaj() {
    var $action = $('#action').val();

    switch ($action) {

        case 'nv_nut_add' :
            $("#newView").prop('onunload', window.opener.getNut());
            break;

        case 'nv_ga_add':
            $("#newView").prop('onunload', window.opener.getGamme());
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
function listSelect($select, $target) {
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
function getGamme() {

    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllGamme'},
    function (json) {
        console.log('dedans');
        var $selectCol1 = $('#selGamme');
        $selectCol1.empty();
        $selectCol1.append('<option value="">Aucun</option>');
        for (var key in json) {
            $selectCol1.append('<option value="' + json[key].GA_ID + '">'
                    + json[key].GA_LBL + '</option>');
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

        for (var key in json) {
            $divNut.append('<label for="nut' + json[key].NUT_ID + '>'
                    + json[key].NUT_LBL + '</label>');
            $divNut.append('<input type="text" value="nut' + json[key].NUT_ID 
                    + '">' + json[key].NUT_LBL + '</input><br>');
        }
    }
    );
}