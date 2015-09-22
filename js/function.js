/**
 * Fonction d'ouverture de nouvelle fenetre, 
 *      elle attend la page à afficher en paramètre
 * @param {type} string action a effectuer pour le contrôleur
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

function test(){
    alert('Coucou');
}

function orderby(action,champs){
    window.open('index.php?action=' + action + "&orderby=" + champs, '_self');
    
}

function delElt(id,codetype,type,action){
$resBool = confirm("Voulez-vous supprimez l'élément: " + type + " numéro: " + id);
if ($resBool){
    window.open('index.php?action=' + action + "&" + codetype + "=" + id, '_self')
}
}


function getGamme() {

    console.log('dedans');
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllGamme'},
    function(json) {
        console.log('dedans');
        var $selectCol1 = $('#selGamme');       
        $selectCol1.empty();
        $selectCol1.append('<option value="">Aucun</option>');
        for (var key in json) {
            $selectCol1.append('<option value="'+json[key].GA_ID +'">'+json[key].GA_LBL+'</option>');            
        }
       
    }
    );
}

function getPays() {

    console.log('dedans');
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllPays'},
    function(json) {
        console.log('dedans');
        var $selectCol1 = $('#selPays');       
        $selectCol1.empty();
        $selectCol1.append('<option value="">Aucun</option>');
        for (var key in json) {
            $selectCol1.append('<option value="'+json[key].PAYS_ID +'">'+json[key].PAYS_NOM+'</option>');            
        }
       
    }
    );
}

function getNut() {

    console.log('dedans');
    $.getJSON(
            'ws/webService.php', // code cible         
            {test: 'Solya', action: 'getAllNut'},
    function(json) {
        console.log('dedans');
        var $divNut = $('#divNut');       
        $('#divNut').empty();
        
        
        for (var key in json) {
            $divNut.append('<label for="nut'+json[key].NUT_ID +'>'+json[key].NUT_LBL+'</label>' );
            $divNut.append('<input type="text" value="nut'+json[key].NUT_ID +'">'+json[key].NUT_LBL+'</input><br>');            
        }   
    }
    );
}

function selMaj(){
    var $action = $('#action').val();   
    
    switch ($action){
        
        case 'nv_nut_add' :
            console.log("switch");
            $("#newView").prop('onunload',window.opener.getNut());
        break;
        
        case 'nv_ga_add':
            
            $("#newView").prop('onunload',window.opener.getGamme());
        break;
        
        case 'nv_pays_add':
            
           $("#newView").prop('onunload',window.opener.getPays());  
        break;
        

        
    }
}

/**
 * Met à jour un bloc html selon les choix d'une combobox
 * @param {Combobox, source des données} $select
 * @param {bloc p ou idv ou autre à modifier} $target
 * @returns {undefined}
 */        
function listSelect($select,$target){
    //on récupére la combox et ses options choisis
    $a = $('#' + $select + ' option:selected');
    //On écrit les valeurs récupérés dans un bloc html
    $('#' + $target).html($a.text());    
}
