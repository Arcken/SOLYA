<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
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
                             onclick="orderby('<?php echo $sAction ?>', 'nut_id', 'DESC');"/>
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/up.png" 
                             title="Tri croissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'nut_id', 'ASC');"/>
                    </th>
                    <th class="colTitle">
                        Nom
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/down.png" 
                             title="Tri décroissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'nut_lbl', 'DESC');"/>
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/up.png" 
                             title="Tri croissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'nut_lbl', 'ASC');"/>
                    </th>
                </tr>
                <?php
                if ($resAllNut != 0 && is_array($resAllNut)) {
                    foreach ($resAllNut as $nut) {
                        ?>
                        <tr>
                            <td class="colData" colspan="3">
                                <?php echo $nut->nut_id ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $nut->nut_lbl ?>
                            </td>
                            <td class="colTdIco"><img src="img/icon/modify.png" alt="" title="Modifier"
                                                      onclick='location.href = "index.php?action=nut_detail&nutId=<?php echo $nut->nut_id ?>"'/></td>

                            <td class="colTdIco"><img src="img/icon/delete.png" alt="" title="Supprimer"
                                                      onclick='delElt(<?php echo $nut->nut_id ?>, "nutId", "nutrition", "nut_del")'/></td>

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
        <div>
            <input type="button" onclick='location.href = "index.php?action=nut_add"' value="Ajouter">
        </div>
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}

