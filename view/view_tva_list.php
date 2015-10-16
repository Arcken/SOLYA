<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_list.css" rel="stylesheet">
    <div class="corpsCenter">
        <div class="colOnlyOne">
            <h2> Liste des éléments </h2>
            
            <table class="tableList">
                <tr>
                    <th class="colTitle">
                        ID
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','tva_id','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','tva_id','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Libellé
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','tva_lbl','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','tva_lbl','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Taux
                    </th>    
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','tva_taux','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','tva_taux','ASC');"/>
                    </th>
                </tr>
                <?php
                if ($resAllTva != 0 && is_array($resAllTva)) {
                    foreach ($resAllTva as $tva) {
                        ?>
                        <tr>
                            <td  class="colData" colspan="3">
                                <?php echo $tva->tva_id ?>
                            </td>
                            <td  class="colData" colspan="3">
                                <?php echo $tva->tva_lbl ?>
                            </td>
                            <td  class="colData" colspan="3">
                                <?php echo $tva->tva_taux ?>
                            </td>
                            <td class="colTdIco"><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = "index.php?action=tva_detail&tvaId=<?php echo $tva->tva_id ?>"'/></td>

                            <td class="colTdIco"><img src="img/icon/delete.png" alt="" title="Supprimer"
                                     onclick='delElt(<?php echo $tva->tva_id ?>, "tvaId", "tva", "tva_del")'/></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <?php
            if ($iTotal > $nbRow) {
                // affichage des liens vers les pages
                Tool::affichePages($rowStart, $nbRow, $iTotal, $sAction);
            }
            ?>
        </div>
        <div class="bas">
            <input type="button" onclick='location.href = "index.php?action=tva_add"' value="Ajouter">
        </div>
    </div>
    <?php
} else {
    echo 'Le silence est d\'or';
}