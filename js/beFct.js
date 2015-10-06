

//Variable d'incrément pour addLigne
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

    //on récupére la valeur de l'input prix unitaire
    $pu = parseFloat($("input[id='" + $source1 + "']").val());
    console.log("PU : " + $pu);
    //on récupére la valeur de l'input taux douane
    $tauxDouane = parseFloat($("input[id='" + $source2 + "']").val());
    console.log("Taux douane : " + $tauxDouane);
    //on récupére la valeur de l'input quantité
    $qt = parseFloat($("input[id='" + $source3 + "']").val());
    console.log("Quantité : " + $qt);

    //on effectue le calcul puis on met l'input cible à jour    
    $res = $("input[id='" + $cible + "']").val(parseFloat($tauxDouane * $pu
            * $qt / 100));

    console.log("Droit unitaire : " + $res.val());
    console.log("FIN CC DROIT DOUANE");
}

//-----------------calcul bon entree------------------

/**
 * Fonction qui calcul le total d'une ligne:
 *  qt*pu+tDouane+tBanque+tTransport
 * @param $cible
 * id de l'input cible
 * @returns {undefined}
 */
function beTotalLigne($cible) {
    console.log("DEBUT beTotalLigne");
    //On parcours ligne par ligne
    $('tr').not('#titreGnl, #titreCol, #idLigne').each(function () {
        //id de la ligne pour contrôle
        $idLigne = $(this).attr('id');
        //prix unitaire
        $puVal = parseFloat($(this).find('[id^="beligPu"]').val());
        //quantité
        $qtVal = parseFloat($(this).find('[id^="ligQte"]').val());
        //Total douane
        $tDouane = parseFloat($(this).find('[id^="totalFd"]').val());
        //Total banque
        $tBanque = parseFloat($(this).find('[id^="totalFb"]').val());
        //Total Transport
        $tTransport = parseFloat($(this).find('[id^="totalFt"]').val());
        //MAJ de l'input cible
        $(this).find('[id^="' + $cible + '"]').val($puVal * $qtVal +
                $tDouane + $tBanque + $tTransport);
        console.log("total ligne: " + $idLigne);
    });
    console.log("FIN beTotalLigne");
}

/**
 * Recalcul les cases droit douane et totaux(douane,banque,transport,total)
 * sans tenir compte des entêtes (frais douane, frais banque, frais transport)
 * @returns {undefined}
 */
function beCalculReset() {

    console.log("DEBUT beCalculReset");
    $('tr').not('#titreGnl, #titreCol, #idLigne').each(function () {
        //id de la ligne pour contrôle
        $idLigne = $(this).attr('id');
        //********************Partie case droit de douane******************
        //input du prix unitaire
        $source1 = $(this).find('[id^="beligPu"]').attr('id');
        console.log($idLigne + ": " + $source1);
        //input du taux de douane
        $source2 = $(this).find('[id^="beligTauxDouane"]').attr('id');
        console.log($idLigne + ": " + $source2);
        //input de la quantité
        $source3 = $(this).find('[id^="ligQte"]').attr('id');
        console.log($idLigne + ": " + $source3);
        //input du droit de douane
        $cible = $(this).find('[id^="beligDd"]').attr('id');
        console.log($idLigne + ": " + $cible);
        //Appel de la fonction
        beCcDroitDouane($source1, $source2, $source3, $cible);

        //********************FIN droit de douane******************
        //********************Partie case total douane******************

        //On fait un tableau contenant les id des opérants
        $tabOperant = [$(this).find('[id^="beligDd"]').attr('id'),
            $(this).find('[id^="beligTaxe"]').attr('id')];
        //On récupére la cible
        $cible = $(this).find('[id^="totalFd"]').attr('id');
        //Appel de la fonction
        ccAddition($tabOperant, $cible);

        //********************FIN case total douane******************
        //********************Partie case total banque******************

        //On récupère l'input source
        $source = $(this).find('[id^="beligFb"]').attr('id');
        //On récupére la cible
        $cible = $(this).find('[id^="totalFb"]').attr('id');
        //Appel de la fonction
        copieChamps($source, $cible);

        //********************FIN case total Banque******************
        //********************Partie case total transport******************

        //On récupère l'input source
        $source = $(this).find('[id^="beligFt"]').attr('id');
        //On récupére la cible
        $cible = $(this).find('[id^="totalFt"]').attr('id');
        //Appel de la fonction
        copieChamps($source, $cible);

        //********************FIN case total transport******************
        //********************Partie case total ************************
        //On récupére la cible
        $cible = $(this).find('[id^="totalLig"]').attr('id');
        //Appel de la fonction
        beTotalLigne($cible);
        //********************FIN case total ***************************
    });
    console.log("FIN beCalculReset");
}

/**
 * Fonction qui ajoute dans chaque ligne:
 *          (frais douane entête diviser par qtTtotal)*qtLigne 
 *          à la case total douane (addition avec son contenu)
 *          (frais bancaire entête diviser par qtTtotal)*qtLigne
 *          à la case total banque (addition avec son contenu)
 *          (frais transport entête diviser par qtTtotal)*qtLigne
 *          à la case total douane (addition avec son contenu)
 * @returns {undefined}
 */
function beCalcul() {
    console.log('DEBUT BECALCUL');

    //on récupére les frais de l'entête du bon
    $fDouaneVal = parseFloat($('[id="beFraisDouane"]').val());
    console.log("frais douane: " + $fDouaneVal);
    $fBancaireVal = parseFloat($('[id="beFraisBancaire"]').val());
    console.log("frais bancaire: " + $fBancaireVal);
    $fTransportVal = parseFloat($('[id="beFraisTransport"]').val());
    console.log("frais transport: " + $fTransportVal);

    //On récupère la quantité totale d'article
    $qtTotalVal = 0;
    //Pour chaque balise tr dont l'id est différent de celle des titres 
    //et du squelette (idligne)
    $('tr').not('#titreGnl, #titreCol, #idligne').each(function () {

        //On cherche l'input quantité descendant de tr et on récupére la valeur
        $qtTotalVal += parseFloat($(this).find('[id^="ligQte"]').val());
    });
    console.log("Qt total: " + $qtTotalVal);

    //Pour chaque frais de l'entête on calcul la valeur par article
    $fdUniteVal = parseFloat($fDouaneVal / $qtTotalVal);
    console.log("Frais douane par unité: " + $fdUniteVal);
    $fbUniteVal = parseFloat($fBancaireVal / $qtTotalVal);
    console.log("Frais bancaire par unité: " + $fbUniteVal);
    $ftUniteVal = parseFloat($fTransportVal / $qtTotalVal);
    console.log("Frais transport par unité: " + $ftUniteVal);

    //Pour chaque balise tr dont l'id est différent de celle des titres 
    //et du squelette (idligne)
    $('tr').not('#titreGnl, #titreCol, #idLigne').each(function () {

        //idligne pour le control
        $idLigne= $(this).attr('id');

        //On récupére la valeur du prix unitaire
        $lignePuVal = parseFloat($(this).find('[id^="beligPu"]').val());

        //On récupére la quantité descendant de ce tr
        $ligneQtVal = parseFloat($(this).find('[id^="ligQte"]').val());
        console.log($idLigne + ": " + "qtLigne " + $ligneQtVal);

        //On récupére l'input et la valeur de la case total douane ligne
        //descendant de ce tr
        $ligneTotalFd = $(this).find('[id^="totalFd"]');
        $ligneTotalFdVal = parseFloat($ligneTotalFd.val());
        console.log($idLigne + ": " + "Total FD: " + $ligneTotalFdVal);

        //On fait le calcul 'frais de douane unitaire entête * quantité ligne 
        // + total douane ligne' et on met à jour la case total douane ligne        
        $ligneTotalFd.val($fdUniteVal * $ligneQtVal + $ligneTotalFdVal);
        console.log($idLigne + ": " + "Total FD MAJ : " + $ligneTotalFd.val());

        //On récupére l'input et la valeur de la case total banque ligne
        //descendant de ce tr
        $ligneTotalFb = $(this).find('[id^="totalFb"]');
        $ligneTotalFbVal = parseFloat($ligneTotalFb.val());
        console.log($idLigne + ": " + "Total FB: " + $ligneTotalFbVal);

        //On fait le calcul 'frais de banque unitaire entête * quantité ligne 
        // + total banque ligne' et on met à jour la case total banque ligne
        $ligneTotalFb.val($fbUniteVal * $ligneQtVal + $ligneTotalFbVal);
        console.log($idLigne + ": " + "Total FB MAJ : " + $ligneTotalFb.val());

        //On récupére l'input et la valeur de la case total ligne transport 
        //descendant de tr
        $ligneTotalFt = $(this).find('[id^="totalFt"]');
        $ligneTotalFtVal = parseFloat($ligneTotalFt.val());
        console.log($idLigne + ": " + "Total FT: " + $ligneTotalFtVal);

        //On fait le calcul 'frais de transport unitaire entête * quantité ligne
        // + total transport ligne' et on met à jour la case 
        // total transport ligne
        $ligneTotalFt.val($ftUniteVal * $ligneQtVal + $ligneTotalFtVal);
        console.log($idLigne + ": " + "Total Ft MAJ : " + $ligneTotalFt.val());

        //Calcul du coût unitaire, on prend fd, fb, et ft unitaire de l'entête 
        //que l'on additionne avec le pu
        //
        // on prend pour chaque ligne le total de douane ligne unitaire,
        // le total de banque ligne unitaire, le total de transport ligne unitaire
        // que l'on additionne puis on divise l'ensemble par la quantité ligne
        // 
        // Enfin on additionne les deux calculs précédents que l'on met dans
        // cout unitiare
        // 

        $coutUnitaire = $lignePuVal + $fdUniteVal + $fbUniteVal + $ftUniteVal
                + ($ligneTotalFd.val() + $ligneTotalFb.val() +
                        $ligneTotalFt.val()) / $ligneQtVal;
        console.log($idLigne + ": cout unitaire " + $coutUnitaire);
        $(this).find('[id^="beligCu"]').val($coutUnitaire);
    });

    console.log('FIN BECALCUL');
}