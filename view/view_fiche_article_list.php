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
                    <th class="colTitle"> Photo                  
                    </th>
                    <th class="colTitle">
                        Identifiant                 
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/down.png" 
                             title="Tri décroissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'fiart_id', 'DESC');"/>
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/up.png" 
                             title="Tri croissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'fiart_id', 'ASC');"/>
                    </th>
                    <th class="colTitle">
                        Libellé         
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/down.png" 
                             title="Tri décroissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'fiart_lbl', 'DESC');"/>
                    </th>
                    <th class="colTdIco">
                        <img src ="img/icon/up.png" 
                             title="Tri croissant" 
                             onclick="orderby('<?php echo $sAction ?>', 'fiart_lbl', 'ASC');"/>
                    </th>
                </tr>
        <?php
        $fiartControl = '';
        $fiartGamme = '';
        if (isset($resFiartList) && is_array($resFiartList)) {
            foreach ($resFiartList as $value) {
                ?>
                        
                            <tr>
                                <td class="colImg"><img src="<?php echo $imgMiniPath . $value->fiart_photos_pref . '_lbl.jpg' ?>" alt="" title="Modifier"
                                         onclick='location.href = "index.php?action=fiart_detail&fiartId=<?php echo $value->fiart_id ?>"'/></center></td>
                                <td class="colData" colspan="3"><?php echo $value->fiart_id ?></td>
                                <td class="colData" colspan="3"><?php echo $value->fiart_lbl ?></td>               
                                
                                <td class="colTdIco"><img src="img/icon/modify.png" alt="" title="Modifier"
                                         onclick='location.href = "index.php?action=fiart_detail&fiartId=<?php echo $value->fiart_id ?>"'/></td>

                                <td class="colTdIco"><img src="img/icon/delete.png" alt="" title="Modifier"
                                         onclick='delElt(<?php echo $value->fiart_id ?>, "fiartId", "Fiche article", "fiart_del")'/></td>

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
    </div>
    <?php
} else {
    echo 'Le silence est d\'or';
}
    
