<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */?>
<link type="text/css" href="css/style_infos.css" rel="stylesheet">
<script type='text/javascript' src='js/infoFct.js'></script>
<aside id='asideInfos'>
    <div id="blocSearch">
        <h3>Recherche:</h3>
        <!--Champ pour le moteur de recherche-->
        <input id='inptSearch' type="text" onkeyup="search()">
        <br>
        <br>
        <label for="table"> Choix de recherche : </label>
        <br>
        
        Reference
        <input type='radio' 
               name='table' 
               value='reference' 
               title='Recherche une référence par libéllé' 
               onclick='changeRequest()'
               >
        Lot
        <input type='radio' 
               name='table' 
               value='lot' 
               title='Recherche les lots associé à la référence'
               onclick='changeRequest()'>
       
        
        <input type='text' id='request' name='request' value='' hidden>
        <br>
        <br>
        <div id='resSearch'style='display:none'>
        </div>
        
    </div>
    
    <div id="alert" style='display:none'>
    </div>
</aside>
