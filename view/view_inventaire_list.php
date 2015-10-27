<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) {
    ?>

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
                             onclick="orderby('<?php echo $sAction ?>', 'inv_id', 'DESC');"/>
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/up.png" 
                             title="Tri croissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'inv_id', 'ASC');"/>
                    </th>
                    <th class="colTitle">
                        Libellé
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/down.png" 
                             title="Tri décroissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'inv_lbl', 'DESC');"/>
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/up.png" 
                             title="Tri croissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'inv_lbl', 'ASC');"/>
                    </th>
                    <th class="colTitle">
                        Date
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/down.png" 
                             title="Tri décroissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'inv_date', 'DESC');"/>
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/up.png" 
                             title="Tri croissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'inv_date', 'ASC');"/>
                    </th>
                </tr>
                <?php
                if ($resAllInventaire != 0 && is_array($resAllInventaire)) {
                    foreach ($resAllInventaire as $inventaire) {
                        ?>
                        <tr>
                            <td class="colData" colspan="3">
            <?php echo $inventaire->inv_id ?>
                            </td>
                            <td class="colData" colspan="3">
            <?php echo $inventaire->inv_lbl ?>
                            </td>
                            <td class="colData" colspan="3">
                            <?php echo $inventaire->inv_date ?>
                            </td>
                            
                            <td class="colTdIco"> <img src="img/icon/read.png" title="Consulter"
                                onclick='location.href="index.php?action=nv_inv_pdf&invId="+
                                           <?php echo $inventaire->inv_id ; ?>'
                                />
                            </td>
            <?php if ($inventaire->inv_vld == 0) { ?>
                            
                                
                                <td class="colTdIco"><img src="img/icon/modify.png" alt="" title="Modifier"
                                                          onclick='location.href = "index.php?action=inventaire_upd&invId=<?php echo $inventaire->inv_id ?>"'/></td>
                                <td class="colTdIco"><img src="img/icon/delete.png" alt="" title="Supprimer"
                                                          onclick='delElt(<?php echo $inventaire->inv_id ?>, "invId", "inventaire", "inventaire_del")'/></td>

            <?php } else { ?>
                                <td class="colTdIco"><img src="img/icon/modify_desat.png" alt="" title="Modifier"/>
                                <td class="colTdIco"><img src="img/icon/delete_desat.png" alt="" title="Supprimer"/>
            <?php } ?>

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
            <input type="button" onclick='location.href = "index.php?action=inventaire_add"' value="Ajouter">
        </div>
    </div>
    <?php
} else {
    echo 'Le silence est d\'or';
}