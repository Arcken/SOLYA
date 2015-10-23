<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//------------Application de la mise en page---------------------//
//
// coordonnée de l'entreprise
$pdf->template['header']['fontSize'] = 12;
$pdf->template['header']['lineHeight'] = 5;
$pdf->template['header']['margin'] = array(30, 0, 0, 10);

// numéro de page
$pdf->template['infoPage']['margin'] = array(5, 5, 0, 0);
$pdf->template['infoPage']['align'] = 'R';

// numéro de bon ou facture (information du document)
$pdf->template['infoDoc']['fontSize'] = 20;
$pdf->template['infoDoc']['margin'] = array(10, 5, 0, 0);
$pdf->template['infoDoc']['fontFace'] = 'B';
$pdf->template['infoDoc']['align'] = 'R';

// date
$pdf->template['infoDate']['fontSize'] = 12;
$pdf->template['infoDate']['margin'] = array(30, 5, 0, 0);
$pdf->template['infoDate']['color'] = array('r' => 150, 'g' => 150, 'b' => 150);
$pdf->template['infoDate']['align'] = 'R';

// partie client
$pdf->template['client']['fontSize'] = 12;
$pdf->template['client']['margin'] = array(40, 5, 0, 120);
$pdf->template['client']['align'] = 'L';

// pied de page
$pdf->template['footer']['fontSize'] = 8;
$pdf->template['footer']['lineHeight'] = 5;
$pdf->template['footer']['color'] = array('r' => 150, 'g' => 150, 'b' => 150);
$pdf->template['footer']['align'] = 'C';
$pdf->template['footer']['margin'] = array(277, 40, 0, 40);

// entete de produit
$pdf->template['productHead']['fontFace'] = 'B';
$pdf->template['productHead']['color'] = array('r' => 50, 'g' => 50, 'b' => 50);
$pdf->template['productHead']['margin'] = array(20, 0, 0, 10);
$pdf->template['productHead']['padding'] = array(4, 4, 0, 0);

// liste des produits
$pdf->template['product']['fontSize'] = 10;
$pdf->template['product']['lineHeight'] = 5;
$pdf->template['product']['backgroundColor2'] = array('r' => 211, 'g' => 213, 'b' => 213);
$pdf->template['product']['color'] = array('r' => 50, 'g' => 50, 'b' => 50);
$pdf->template['product']['color2'] = array('r' => 50, 'g' => 50, 'b' => 50);
$pdf->template['product']['margin'] = array(1, 0, 0, 6);
$pdf->template['product']['padding'] = array(1, 4, 1, 4);

// entete des totaux
$pdf->template['totalHead']['lineHeight'] = 1;
$pdf->template['totalHead']['backgroundColor'] = array('r' => 195, 'g' => 0, 'b' => 130);
$pdf->template['totalHead']['margin'] = array(10, 0, 0, 0);

// liste des totaux
$pdf->template['total']['lineHeight'] = 5;
$pdf->template['total']['margin'] = array(0, 0, 0, 120);
$pdf->template['total']['padding'] = array(2, 0, 0, 0);


//element personnalisé motif

$pdf->template['motif']['fontSize'] = 15;
$pdf->template['motif']['margin'] = array(20, 5, 0, 0);
$pdf->template['motif']['fontFace'] = 'B';
$pdf->template['motif']['align'] = 'R';

// element personnalisé Commentaire sur le Bon
$pdf->template['commentaire']['margin'] = array(75, 5, 0, 10);

// element personnalisé Bon sortie associé au bon
$pdf->template['champEntete2']['margin'] = array(75, 5, 0, 120);

//trait entête produit
$pdf->template['traitEnteteProduit']['lineHeight'] = 1;
$pdf->template['traitEnteteProduit']['backgroundColor'] = array('r' => 50, 'g' => 50, 'b' => 50);
$pdf->template['traitEnteteProduit']['margin'] = array(85, 0, 0, 0);

//trait inferieur produit
$pdf->template['traitEnteteProduitInf']['lineHeight'] = 1;
$pdf->template['traitEnteteProduitInf']['backgroundColor'] = array('r' => 50, 'g' => 50, 'b' => 50);
$pdf->template['traitEnteteProduitInf']['margin'] = array(97, 0, 0, 0);

//trait bas du footer
$pdf->template['traitBas']['lineHeight'] = 0.5;
$pdf->template['traitBas']['backgroundColor'] = array('r' => 150, 'g' => 150, 'b' => 150);
$pdf->template['traitBas']['margin'] = array(275, 40, 0, 40);
