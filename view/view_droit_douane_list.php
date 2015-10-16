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
                     <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','dd_id','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','dd_id','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Libellé
                    </th>
                     <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','dd_lbl','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','dd_lbl','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Taux
                    </th>  
                     <th class="colTdImg">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','dd_taux','DESC');"/>
                    </th>
                    <th class="colTdImg">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','dd_taux','ASC');"/>
                    </th>
                </tr>
                <?php
                if ($resAllDd != 0 && is_array($resAllDd)) {
                    foreach ($resAllDd as $dd) {
                        ?>
                        <tr>
                            <td  class="colData" colspan="3">
                                <?php echo $dd->dd_id ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $dd->dd_lbl ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $dd->dd_taux ?>
                            </td>
                            <td class="colTdImg"><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = "index.php?action=dd_detail&ddId=<?php echo $dd->dd_id ?>"'/></td>

                            <td class="colTdImg"><img src="img/icon/delete.png" alt="" title="Supprimer"
                                     onclick='delElt(<?php echo $dd->dd_id ?>, "ddId", "droit douane", "dd_del")'/></td>
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
             <input type="button" onclick='location.href = "index.php?action=dd_add"' value="Ajouter">
        </div>
    </div>
    <?php
} else {
    echo 'Le silence est d\'or';
}