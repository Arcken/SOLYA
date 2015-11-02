<?php
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <link type="text/css" href="css/style_list.css" rel="stylesheet">

    <div class="corpsCenter">
        <div class="colOnlyOne">
            <h2> Liste des éléments </h2>
            
            <table class="tableList">
                <tr>
                    <th class="colTitle">
                        Id
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','be_id','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','be_id','ASC');"/>
                    </th>
                    <th  class="colTitle">
                        Libellé
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','be_lbl','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','be_lbl','ASC');"/>
                    </th>
                    <th  class="colTitle">
                        Facture
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','be_fact_num','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','be_fact_num','ASC');"/>
                    </th>
                    <th  class="colTitle">
                        Commentaire
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','be_com','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','be_com','ASC');"/>
                    </th>
                    <th  class="colTitle">
                        Total
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','be_total','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','be_total','ASC');"/>
                    </th>
                    <th  class="colTitle">
                        Date
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','be_date','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','be_date','ASC');"/>
                    </th>
                </tr>
                <?php
                if (isset($resBeList) && is_array($resBeList)) {
                    foreach ($resBeList as $be) {
                        ?>
                        <tr>
                            <td class="colData" colspan="3">
                                <?php echo $be->be_id ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $be->be_lbl ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $be->be_fact_num ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $be->be_com ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $be->be_total ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $be->be_date ?>
                            </td>
                            <td class="colTdIco">
                                <img src="img/icon/read.png" title="Consulter PDF"
                                     onclick='window.open(
                                              "index.php?action=nv_be_pdf&beId=<?php echo $be->be_id ?>")'/>
                            </td>
                            <td class="colTdIco"><img src="img/icon/modify.png" alt="" title="Modifier"
                                     onclick='location.href = "index.php?action=be_detail&beId=<?php echo $be->be_id ?>"'/>
                            </td>
                           

                            

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
            <input type="button" onclick='location.href = "index.php?action=be_add"' value="Ajouter">
        </div>
    </div>

    <?php
} else {
    echo 'Le silence est d\'or';
}