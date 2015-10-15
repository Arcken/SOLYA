<?php
//Contrôle si la connection de l'utilisateur est valide
//Le 'group' permet de choisir si l'utilisateur à accés à la page
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_list.css" rel="stylesheet">
    
    <div class="corps">
        <div class="list">
            <h2> Liste des éléments </h2>
            
            <table class="tableList">
                <tr>
                    <th class="colTitle">
                        Id
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','cons_id','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','cons_id','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Libellé
                    </th> 
                    <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','cons_lbl','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','cons_lbl','ASC');"/>
                    </th>
                </tr>
                <?php
                if ($resAllMc != 0 && is_array($resAllMc)) {
                    foreach ($resAllMc as $modeConservation) {
                        ?>
                        <tr>
                            <td  class="colData" colspan="3">
                                <?php echo $modeConservation->cons_id ?>
                            </td>
                            <td  class="colData" colspan="3">
                                <?php echo $modeConservation->cons_lbl ?>
                            </td>
                            <td class="colTdImg"><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = 
                                        "index.php?action=mc_detail&consId=<?php echo $modeConservation->cons_id ?>"'/></td>

                            <td class="colTdImg"><img src="img/icon/delete.png" alt="" title="Supprimer"
                                     onclick='delElt(<?php echo $modeConservation->cons_id ?>, "consId", "Mode conservation", "mc_del")'/></td>
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
            <input type="button" onclick='location.href = "index.php?action=mc_add"' value="Ajouter">
        </div>
    </div>
    <?php
} else {
    echo 'Le silence est d\'or';
}