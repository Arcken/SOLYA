<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">

    <div class="corps">
        <form class="form" action="index.php" method="post">
            <div class="col50">

                <label for="factRef"> Référence de facture </label><br>
                <input name="factRef" placeholder="description" type="text"
                       >
                <br>
                <label for="beLbl"> Libellé du bon </label><br>
                <input name="beLbl" placeholder="description" type="text"
                       >
                <br>
                <label for="beDate"> Date</label><br>
                <input name="beDate" placeholder="description" type="text"
                       >
                <br>
            </div>
            <div class="col50">
                <label for="beFraisDouane"> Frais de douane </label><br>
                <input name="beFraisDouane" placeholder="description" type="text"
                       >
                <br>
                <label for="beDroitDouane"> Droit de douane </label><br>
                <input name="beDroitDouane" placeholder="description" type="text"
                       >
                <br>
                <label for="beFraisBancaire"> Frais bancaire </label><br>
                <input name="beFraisBancaire" placeholder="description" type="text"
                       >
                <br>
            </div>
            <div class="col90">
                <table class="beLigne" id="beTable">
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Code
                        </th>
                        <th>
                            Libellé ref
                        </th>
                        <th>
                            PU
                        </th>
                        <th>
                            Qt
                        </th>
                        <th>
                            Droit douane
                        </th>
                        <th>
                            Frais douane
                        </th>
                        <th>
                            Frais bancaire
                        </th>
                        <th>
                            Frais transport
                        </th>
                        <th>
                            DLC
                        </th>
                        <th>
                            Commentaire
                        </th>
                        
                        
                        <th>
                            
                        </th>
                    </tr>
                    <tr id="beligne" hidden="">
                        <td  class="beLigneId">
                            <input type="text" name="refId[]"  class="id" onblur='getReference("refId","beligne")'>
                        </td>
                        <td>
                            <input type="text" value="MXSI01" name="refCode[]">
                        </td>
                        <td>
                            <textarea name="refLbl[]">Tablette chocolat du Mexique 70% cacao</textarea>
                           
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="56.0" name="beligPu[]">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="4.00" name="ligQte[]">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="10" name="beligDd[]">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="0.2" name="beligFd[]">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="15" name="beligFb[]">
                        </td>
                        <td class="beLigneNb">
                            <input type="text" value="15" name="beligFt[]">
                        </td>
                        <td>
                            <input type="text" value="11/12/2016" name="beligDlc[]">
                            
                        </td>
                        <td>
                            <textarea name="refLbl[]">Commentaire</textarea>
                        </td>
                        <td>
                            <img src="img/icon/delete.png" alt="" title="Supprimer"
                             onclick='delLigne("beligne")'/>
                        </td>
                    
                </table>
                <input type="button" value="Ajouter ligne" onclick='ajoutBeLigne("beTable","beligne")'>
            </div>
        </form>
        
    </div>
    
    <?php
} else {
    echo 'Le silence est d\'or';
}