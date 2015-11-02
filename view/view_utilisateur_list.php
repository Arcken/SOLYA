<?php 
if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>

    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet"> 
    <link type="text/css" href="css/style_list.css" rel="stylesheet">
    <div class="corpsCenter">
        <div class="colOnlyOne">
            <table class="tableList">
                <tr>
                    <th class="colTitle">
                        Login
                    </th><th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ut_login','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ut_login','ASC');"/>
                    </th>
                    
                    <th class="colTitle">
                        Nom
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ut_nom','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ut_nom','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Prénom
                    </th> 
                    <th class="colTdIco">
                       <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','ut_prenom','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','ut_prenom','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Actif
                    </th>
                </tr>

                <?php foreach ($resAllUtilisateurs as $utilisateur) { ?>
                    <tr>
                        <td class="colData" colspan="3">
                            <?php echo $utilisateur->ut_login ?>
                        </td>
                        <td class="colData" colspan="3">
                            <?php echo $utilisateur->ut_nom ?>
                        </td>
                        <td class="colData" colspan="3">
                            <?php echo $utilisateur->ut_prenom ?>
                        </td>
                        <td class="colData" colspan="3">
                            <?php echo $utilisateur->ut_actif ?>
                        </td>
                        <td class="colTdIco"><img src="img/icon/modify.png" alt="" title="Modifier"
                                 onclick='location.href = "index.php?action=utilisateur_upd&utLogin=<?php echo $utilisateur->ut_login ?>"'/></td>
                    </tr>
                <?php } ?>
            </table>
            <?php
             if ($iTotal > $nbRow) {
                // affichage des liens vers les pages
                Tool::affichePages($rowStart, $nbRow, $iTotal, $sAction);
            }
            ?>
        </div>
         <div class="bas">
            <input type="button" onclick='location.href = "index.php?action=utilisateur_add"' value="Ajouter">
        </div>
    </div>
    
    <?php
} else {
    echo 'Le silence est d\'or';
}
