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
                               onclick="orderby('<?php echo $sAction?>','pays_id','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','pays_id','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Nom
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','pays_nom','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','pays_nom','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Abréviation pays
                    </th>
                    <th class="colTitle">
                        Devise
                    </th>
                    <th class="colTitle">
                        Abréviation devise
                    </th>
                    <th class="colTitle">
                        Symbole devise
                    </th>
                </tr>
                <?php
                if ($resAllPays != 0 && is_array($resAllPays)) {
                    foreach ($resAllPays as $pays) {
                        ?>
                        <tr>
                            <td class="colData" colspan="3">
            <?php echo $pays->pays_id ?>
                            </td>
                            <td class="colData" colspan="3">
            <?php echo $pays->pays_nom ?>
                            </td>
                            <td class="colData">
            <?php echo $pays->pays_abv ?>
                            </td>
                            <td class="colData">
            <?php echo $pays->pays_dvs_nom ?>                        
                            </td>
                            <td class="colData">
            <?php echo $pays->pays_dvs_abv ?>
                            </td>
                            <td class="colData">
            <?php echo $pays->pays_dvs_sym ?>
                            </td>
                            <td class="colTdIco"><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = "index.php?action=pays_detail&paysId=<?php echo $pays->pays_id ?>"'/></td>

                            <td class="colTdIco"><img src="img/icon/delete.png" alt="" title="Supprimer"
                                     onclick='delElt(<?php echo $pays->pays_id ?>, "paysId", "pays", "pays_del")'/></td>
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
            <input type="button" onclick='location.href = "index.php?action=pays_add"' value="Ajouter">
        </div>
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}