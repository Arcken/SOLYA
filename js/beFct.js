

//Variable d'incrément pour ajoutBeLigne
nRowCount = 1;

/**
 * Fonction d'ajout de ligne pour le bon d'entrée
 * On prend tous ce qui se trouvent entre <tr id=beligne> et </tr>
 * On modifie les valeurs nécessaires et on ajoute l'ensemble au document avant
 * la fin de la balise table
 * @param $table
 * Table html du document
 * @returns {undefined}
 */
function addLigne($table) {
    //On récupére le squelette du code entre le balises <tr id=idLigne> et </tr>
    $ligne = $('#idLigne').html();
    console.log($ligne);
    //On modifie l'id de la balise tr en incorporant un numéro de ligne
    $id = "idLigne" + nRowCount;
    //on remplace tous les mots NID par le même numéro de ligne 
    $ligne = $ligne.replace(/NID/g, nRowCount);
    //On remplace beligne par 'beligne + numéro de ligne'
    $ligne = $ligne.replace(/idLigne/, $id); 
    //On ajoute le code à la fin de la table
    $('#' + $table).append('<tr id="' + $id + '">' + $ligne + "</tr>");
    console.log($ligne);
    //on incrémente le compteur
    nRowCount++;
}

//-----------------calcul bon entree------------------
/**
 * Fonction de calcul du droit de douane pour le bon d'entrée
 * @param $source1
 * nom de l'input prix unitaire
 * @param $source2
 * nom de l'input taux de douane
 * @param $source3
 * nom de l'input quantité
 * @param $cible
 * nom de l'input droit de douane
 * @returns {undefined}
 */
function beCcDroitDouane($source1, $source2, $source3, $cible) {
    console.log("DEBUT CC DROIT DOUANE");

    //on récupére la valeur de l'input
    $pu = parseFloat($("input[id='" + $source1 + "']").val());
    console.log("PU : " + $pu);
    //on récupére la valeur de l'input
    $tauxDouane = parseFloat($("input[id='" + $source2 + "']").val());
    console.log("Taux douane : " + $tauxDouane);
    //on récupére la valeur de l'input
    $qt = parseFloat($("input[id='" + $source3 + "']").val());
    console.log("Quantité : " + $qt);


    //on effectue le calcul puis on met l'input cible à jour    
    $res = $("input[id='" + $cible + "']").val(parseFloat($tauxDouane * $pu / 100));

    console.log("Droit unitaire : " + $res.val());

    console.log("FIN CC DROIT DOUANE");
}

/**
 * Fonction copie valeur de champs dans un autre
 * @param $source
 * id de la source
 * @param $cible
 * id de la cible
 * @returns {undefined}
 */
function beCopieChamps($source, $cible) {
    $1 = parseFloat($("input[id='" + $source + "']").val());
    console.log("Source : " + $1);
    $res = $("input[id='" + $cible + "']").val(parseFloat($1));
    console.log("res ad: " + $res.val());

}

/**
 * Fonction d'addition entre deux éléments html
 * @param $source1
 * id de l'input opérant
 * @param $source2
 * id de l'input opérant
 * @param $cible
 * id de l'input résultat
 * @returns {undefined}
 */
function beCc($source1, $source2, $cible) {
    console.log("DEBUT ADDITION");
    //on récupére la valeur de l'input
    $1 = parseFloat($("input[id='" + $source1 + "']").val());
    console.log("champs 1 ad: " + $1);
    //on récupére la valeur de l'input
    $2 = parseFloat($("input[id='" + $source2 + "']").val());
    console.log("champs 2 ad: " + $2);
    //on effectue le calcul puis on met à jour l'input cible à jour    
    $res = $("input[id='" + $cible + "']").val(parseFloat($1 + $2));
    console.log("res ad: " + $res.val());
    console.log("FIN ADDITION");
}

function beCalcul() {
    console.log('DEBUT BECALCUL');

    //on récupére les frais de l'entête du bon
    $fDouaneVal = parseFloat($('[id="beFraisDouane"]').val());
    console.log("frais douane: " + $fDouaneVal);
    $fBancaireVal = parseFloat($('[id="beFraisBancaire"]').val());
    console.log("frais bancaire: " + $fBancaireVal);
    $fTransportVal = parseFloat($('[id="beFraisTransport"]').val());
    console.log("frais transport: " + $fTransportVal);


    //On récupère la quantité totale d'élément
    $qtTotalVal = 0;
    //Pou chaque balise tr dont l'id est différent
    $('tr').not('#titreGnl, #titreCol, #beligne').each(function () {
        //On cherche l'input quantité descendant de tr et on récupére la valeur
        $qtTotalVal += parseFloat($(this).find('[id^="ligQte"]').val());

    });
    console.log("Qt total: " + $qtTotalVal);


    //on calcule la valeur pour chaque unité les frais de l'entête
    $fdUniteVal = parseFloat($fDouaneVal / $qtTotalVal);
    console.log("Frais douane par unité: " + $fdUniteVal);
    $fbUniteVal = parseFloat($fBancaireVal / $qtTotalVal);
    console.log("Frais bancaire par unité: " + $fbUniteVal);
    $ftUniteVal = parseFloat($fTransportVal / $qtTotalVal);
    console.log("Frais transport par unité: " + $ftUniteVal);

    //Pou chaque balise tr dont l'id est différent
    $('tr').not('#titreGnl, #titreCol, #beligne').each(function () {
        //console.log($(this).get());
        //$ligneQtVal = parseFloat($(this).find('[id^="ligQte"]').val());
        //console.log("qtLigne " + $ligneQtVal);

        //On récupére l'input et la valeur de la case calcul douane descendant de tr
        $ligneCalculFd = $(this).find('[id^="calculFd"]');
        $ligneCalculFdVal = parseFloat($ligneCalculFd.val());
        console.log("Calcul FD: " + $ligneCalculFdVal);

        //On fait le calcul 'frais de douane unitaire + calcul douane' et on met
        //à jour la case calcul
        $ligneCalculFd.val($fdUniteVal + $ligneCalculFdVal);
        console.log("calcul FD MAJ : " + $ligneCalculFd.val());


        //On récupére l'input et la valeur de la case calcul banque descendant de tr
        $ligneCalculFb = $(this).find('[id^="calculFb"]');
        $ligneCalculFbVal = parseFloat($ligneCalculFb.val());
        console.log("Calcul FB: " + $ligneCalculFbVal);

        //On fait le calcul 'frais de banque unitaire + calcul banque' et on met
        //à jour la case calcul
        $ligneCalculFb.val($fbUniteVal + $ligneCalculFbVal);
        console.log("calcul FB MAJ : " + $ligneCalculFb.val());


        //On récupére l'input et la valeur de la case calcul transport descendant de tr
        $ligneCalculFt = $(this).find('[id^="calculFt"]');
        $ligneCalculFtVal = parseFloat($ligneCalculFt.val());
        console.log("Calcul FT: " + $ligneCalculFtVal);

        //On fait le calcul 'frais de transport unitaire + calcul transport' et on met
        //à jour la case calcul
        $ligneCalculFt.val($ftUniteVal + $ligneCalculFtVal);
        console.log("calcul Ft MAJ : " + $ligneCalculFt.val());

    });


    console.log('FIN BECALCUL');

}