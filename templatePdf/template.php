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
$pdf->template['header']['margin'] = array(24, 0, 0, 10);
// numéro de page
//$pdf->template['infoPage']['fontSize']=15;
$pdf->template['infoPage']['margin'] = array(5, 5, 0, 0);
$pdf->template['infoPage']['align'] = 'R';
// numéro de Bon
$pdf->template['infoFacture']['margin'] = array(60, 5, 0, 10);
$pdf->template['infoFacture']['fontFace'] = 'B';
// date
$pdf->template['infoDate']['fontSize'] = 10;
$pdf->template['infoDate']['margin'] = array(20, 0, 0, 120);
$pdf->template['infoDate']['color'] = array('r'=>150, 'g'=>150, 'b'=>150);
// partie client
$pdf->template['client']['fontSize'] = 15;
$pdf->template['client']['margin'] = array(30, 0, 0, 120);
// pied de page
$pdf->template['footer']['fontSize'] = 11;
$pdf->template['footer']['lineHeight'] = 5;
$pdf->template['footer']['color'] = array('r'=>100, 'g'=>100, 'b'=>100);
$pdf->template['footer']['align'] = 'L';
$pdf->template['footer']['margin'] = array(255, 40, 0, 40);
// entete de produit
$pdf->template['productHead']['fontFace'] = 'B';
$pdf->template['productHead']['color'] = array('r'=>195, 'g'=>0, 'b'=>130);
$pdf->template['productHead']['margin'] = array(20, 0, 0, 0);
$pdf->template['productHead']['padding'] = array(4, 4, 0, 14);
// liste des produits
$pdf->template['product']['fontSize'] = 10;
$pdf->template['product']['lineHeight'] = 5;
$pdf->template['product']['backgroundColor2'] = array('r'=>255, 'g'=>255, 'b'=>255);
$pdf->template['product']['color'] = array('r'=>50, 'g'=>50, 'b'=>50);
$pdf->template['product']['color2'] = array('r'=>50, 'g'=>50, 'b'=>50);
$pdf->template['product']['margin'] = array(1, 0, 0, 10);
$pdf->template['product']['padding'] = array(1, 4, 1, 4);
// entete des totaux
$pdf->template['totalHead']['lineHeight'] = 1;
$pdf->template['totalHead']['backgroundColor'] = array('r'=>195, 'g'=>0, 'b'=>130);
$pdf->template['totalHead']['margin'] = array(10, 0, 0, 0);
// liste des totaux
$pdf->template['total']['lineHeight'] = 5;
$pdf->template['total']['margin'] = array(0, 0, 0, 120);
$pdf->template['total']['padding'] = array(2, 0, 0, 0);

// element personnalisé Commentaire sur le Bon
$pdf->template['commentaire']['margin'] = array(70, 5, 0, 10);

// element personnalisé Bon sortie associé au bon
$pdf->template['bonSortieAssoc']['margin'] = array(70, 5, 0, 110);

//trait entête produit
$pdf->template['traitEnteteProduit']['lineHeight'] = 1;
$pdf->template['traitEnteteProduit']['backgroundColor'] = array('r'=>195, 'g'=>0, 'b'=>130);
$pdf->template['traitEnteteProduit']['margin'] = array(80, 0, 0, 0);

//trait bas du footer
$pdf->template['traitBas']['lineHeight'] = 1;
$pdf->template['traitBas']['backgroundColor'] = array('r'=>255, 'g'=>210, 'b'=>255);
$pdf->template['traitBas']['margin'] = array(290, 40, 0, 40);
