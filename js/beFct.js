
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
        console.log("pu: " + $puVal);
        //quantité
        $qtVal = parseFloat($(this).find('[id^="ligQte"]').val());
        console.log("qt: " + $qtVal);
        //Total douane
        $tDouane = parseFloat($(this).find('[id^="totalFd"]').val());
        console.log("T douane: " + $tDouane);
        //Total banque
        $tBanque = parseFloat($(this).find('[id^="totalFb"]').val());
        console.log("T banque: " + $tBanque);
        //Total Transport
        $tTransport = parseFloat($(this).find('[id^="totalFt"]').val());
        console.log("T transport: " + $tTransport);
        //MAJ de l'input cible
        $(this).find('[id^="' + $cible + '"]').val($puVal * $qtVal +
                $tDouane + $tBanque + $tTransport);
        console.log("total ligne: " + $idLigne);
    });
    console.log("FIN beTotalLigne");
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
    $fTransportVal = parseFloat($('[id="beFraisTrans"]').val());
    console.log("frais transport: " + $fTransportVal);

    //On récupère la quantité totale d'article
    $qtTotalVal = 0;
    //Pour chaque balise tr dont l'id est différent de celle des titres 
    //et du squelette (idligne)
    $('tr').not('#titreGnl, #titreCol, #idLigne').each(function () {

        //On ne tiend pas compte des lignes à supprimer
        if (!$(this).find('[id^="ligSupp"]') || !$(this).find('[id^="ligSupp"]').is(':checked')) {
            console.log("ligne calculé: " + $(this).attr('id'));

            //On cherche l'input quantité descendant de tr et on récupére la valeur
            $qtTotalVal += parseFloat($(this).find('[id^="ligQte"]').val());
        }
    });
    console.log("Qt total: " + $qtTotalVal);

    //Pour chaque frais de l'entête on calcul la valeur par article
    $fdUniteVal = parseFloat($fDouaneVal / $qtTotalVal);
    console.log("Frais douane par unité: " + $fdUniteVal);
    $fbUniteVal = parseFloat($fBancaireVal / $qtTotalVal);
    console.log("Frais bancaire par unité: " + $fbUniteVal);
    $ftUniteVal = parseFloat($fTransportVal / $qtTotalVal);
    console.log("Frais transport par unité: " + $ftUniteVal);

    //On récupére l'input beTotal et on met sa valeur à zéro pour éviter 
    //des erreurs
    $totalBe = $('[id="beTotal"]');
    $totalBe.val(0);

    //Pour chaque balise tr dont l'id est différent de celle des titres 
    //et du squelette (idligne)
    $('tr').not('#titreGnl, #titreCol, #idLigne').each(function () {

        //Si la checkbox n'existe pas ou n'est pas coché on effectue le calcul
        if (!$(this).find('[id^="ligSupp"]') || !$(this).find('[id^="ligSupp"]').is(':checked')) {
           
            //idligne pour le control dans la console
            $idLigne = $(this).attr('id');
             console.log("ligne calculé: " + $(this).attr('id'));

            //On récupére la quantité descendant de ce tr
            $ligneQtVal = parseFloat($(this).find('[id^="ligQte"]').val());
            console.log($idLigne + ": qtLigne " + $ligneQtVal);

            //On met à jour le champs poids
            //poids unitaire
            $lignePoidsUnitaire = $(this).find('[id^="refPoidsBrut"]');
            //poids total
            $lignePoids = $(this).find('[id^="totalPoids"]');
            //calcul
            $lignePoids.val(parseFloat($lignePoidsUnitaire.val()) * $ligneQtVal);

            //On met à jour le champs droit douane
            //On passe en paramètre les id des inputs
            beCcDroitDouane($(this).find('[id^="beligPu"]').attr('id'),
                    $(this).find('[id^="beligTauxDouane"]').attr('id'),
                    $(this).find('[id^="ligQte"]').attr('id'),
                    $(this).find('[id^="beligDd"]').attr('id'));

            //On récupére l'input de la case droit douane ligne
            //descendant de ce tr
            $ligneDroitDouane = $(this).find('[id^="beligDd"]');

            //On récupére l'input de la case taxe ligne
            //descendant de ce tr
            $ligneTaxe = $(this).find('[id^="beligTaxe"]');

            //On additionne les deux valeurs précédentes qui donnent le total
            //actuel de douane
            $ligneTempsTotalDouane = parseFloat($ligneDroitDouane.val()) +
                    parseFloat($ligneTaxe.val());

            console.log($idLigne + ": Total FD: " + $ligneTempsTotalDouane);

            //On fait le calcul 'frais de douane unitaire entête * quantité ligne 
            // + total temps douane ligne' et on met à jour la case total douane ligne
            //et on stock sa valeur dans une variable pour un calcul plus tard
            $ligneTotalFd = $(this).find('[id^="totalFd"]');
            $ligneTotalFd.val($fdUniteVal * $ligneQtVal + $ligneTempsTotalDouane);
            console.log($idLigne + ": Total FD MAJ : " + $ligneTotalFd.val());
            $ligneTotalFdVal = parseFloat($ligneTotalFd.val());

            //On récupére l'input et la valeur de la case frais banque ligne
            //descendant de ce tr
            $ligneFraisBancaire = $(this).find('[id^="beligFb"]');
            $ligneTempsTotalFbVal = parseFloat($ligneFraisBancaire.val());
            console.log($idLigne + ": Total FB: " + $ligneTempsTotalFbVal);

            //On fait le calcul 'frais de banque unitaire entête * quantité ligne 
            // + total temp banque ligne' et on met à jour la case total banque ligne
            //et on stock sa valeur dans une variable pour un calcul plus tard
            $ligneTotalFb = $(this).find('[id^="totalFb"]');
            $ligneTotalFb.val($fbUniteVal * $ligneQtVal + $ligneTempsTotalFbVal);
            console.log($idLigne + ": Total FB MAJ : " + $ligneTotalFb.val());
            $ligneTotalFbVal = parseFloat($ligneTotalFb.val());

            //On récupére l'input et la valeur de la case prix transport ligne 
            //descendant de tr
            $lignePrixFt = $(this).find('[id^="beligFt"]');
            $ligneTempsTotalFtVal = parseFloat($lignePrixFt.val());
            console.log($idLigne + ": Total FT: " + $ligneTempsTotalFtVal);

            //On fait le calcul 'frais de transport unitaire entête * quantité ligne
            // + total transport ligne' et on met à jour la case 
            // total transport ligne
            //et on stock sa valeur dans une variable pour un calcul plus tard
            $ligneTotalFt = $(this).find('[id^="totalFt"]');
            $ligneTotalFt.val($ftUniteVal * $ligneQtVal + $ligneTempsTotalFtVal);
            console.log($idLigne + ": " + "Total Ft MAJ : " + $ligneTotalFt.val());
            $ligneTotalFtVal = parseFloat($ligneTotalFt.val());

            //MAJ du total ligne
            $totalLigne = $(this).find('[id^="totalLig"]');
            beTotalLigne($(this).find('[id^="totalLig"]').attr('id'));

            //Calcul du coût unitaire
            //on prend le total ligne que l'on divise par la quantitée de la ligne
            $coutUnitaire = parseFloat($(this).find('[id^="totalLig"]').val() / $ligneQtVal);
            console.log($idLigne + ": cout unitaire " + $coutUnitaire);
            $(this).find('[id^="beligCuAchat"]').val($coutUnitaire);

            //On met à jour le total du bon en lui ajoutant le total de la ligne en cours
            $totalBe.val(parseFloat($totalBe.val()) + parseFloat($totalLigne.val()));
        } else {
            //On met 0 au total de la ligne, c'est juste indicatif pour
            //l'utilisateur
            $totalLigne = $(this).find('[id^="totalLig"]').val(0);
        }

    });

    console.log('FIN BECALCUL');

}

/**
 * Fonction de caulcul de quantité minimum pour la midification de bon d'entrée
 * @param $cible
 * Id de l'input cible
 * @param $qtInit
 * Valeur qt initiale du lot enregistré
 * @param $qtStock
 * Valeur qt stock du lot enregistré
 * @returns {undefined}
 */
function ctrlUpdQtInit($cible, $qtInit, $qtStock) {

    //On récupère l'input cible
    $inpQt = $('[id="' + $cible + '"]');

    //On récupère les valeurs en les transformant en décimaux
    $qInit = parseFloat($qtInit);
    $qStock = parseFloat($qtStock);

    //Le minimum qui peut-être saisie dans la case quantité de l'upd du bon d'entrée
    //est la différence entre la qtinit et la qtStock du lot déja enregistré
    //qui correspond aux articles déja sortis
    $qtInitMin = $qInit - $qStock;

    //si les deux valeurs sont identiques, c'est qu'il n'y a aucune variation de
    //stock, par conséquent on interdit le 0
    if ($qInit == $qStock) {
        $qtInitMin = 0.01;
    }
    //Enfin on change la valeur de l'attribut Min de l'input Qt
    $inpQt.attr('min', $qtInitMin);
}
