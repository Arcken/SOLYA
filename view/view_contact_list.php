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
                        N° de compte
                    </th>
                    <th class="colTdIco">
                     <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','cpt_id','DESC');"/>
                    </th>
                    <th class="colTdIco">
                    <img src ="img/icon/up.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','cpt_id','ASC');"/>
                    </th>
                     <th class="colTitle">
                        CODE Compte
                    </th>
                    <th class="colTdIco">
                     <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','cpt_code','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','cpt_code','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Nom
                    </th>
                    <th class="colTdIco">
                     <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','cpt_nom','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','cpt_nom','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Date de création
                    </th>
                    <th class="colTdIco">
                     <img src ="img/icon/down.png" 
                               title="Tri décroissant" 
                               onclick="orderby('<?php echo $sAction?>','cpt_date','DESC');"/>
                    </th>
                    <th class="colTdIco">
                       <img src ="img/icon/up.png" 
                               title="Tri croissant" 
                               onclick="orderby('<?php echo $sAction?>','cpt_date','ASC');"/>
                    </th>
                    <th class="colTitle">
                        Commentaire
                    </th>
                </tr>
                <?php
                if (isset($resAllCpt) && is_array($resAllCpt)) {
                    foreach ($resAllCpt as $oCompte) {
                        ?>
                        <tr>
                            <td class="colData" colspan="3">
                                <?php echo $oCompte->cpt_id ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $oCompte->cpt_code ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $oCompte->cpt_nom ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $oCompte->cpt_date ?>
                            </td>
                            <td class="colData" colspan="3">
                                <?php echo $oCompte->cpt_com ?>
                            </td>
                            <?php if($oCompte->cpt_type==0){?>
                            <td class="colTdIco">
                                <img src="img/icon/modify.png" 
                                    alt="" 
                                    title="Modifier"
                                    onclick='
                                        location.href ="index.php?action=pers_upd&cptId=<?php echo $oCompte->cpt_id ?>"'/>
                            </td>
                            <?php }else{?>
                            
                             <td class="colTdIco">
                                <img src="img/icon/modify.png" 
                                    alt="" 
                                    title="Modifier"
                                    onclick='
                                        location.href ="index.php?action=ent_upd&cptId=<?php echo $oCompte->cpt_id ?>"'/>
                            </td>
                            <?php } ?>
                            
                            <?php if($oCompte->cpt_type==0){?>
                            <td class="colTdIco">
                                <img src="img/icon/delete.png" 
                                     alt="" 
                                     title="Supprimer"
                                     onclick='delElt(<?php echo $oCompte->cpt_id ?>, "gaId", "compte", "pers_del")'/>
                            </td>
                            <?php }else{ ?>
                             <td class="colTdIco">
                                <img src="img/icon/delete.png" 
                                     alt="" 
                                     title="Supprimer"
                                     onclick='delElt(<?php echo $oCompte->cpt_id ?>, "cptId", "compte", "ent_del")'/>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <?php
            
            if (isset ($iTota) && $iTotal > $nbRow) {
                // affichage des liens vers les pages
                Tool::affichePages($rowStart, $nbRow, $iTotal, $sAction);
            }
            ?>
        </div>
    </div>
        <?php
}else {
    echo 'Le silence est d\'or';
}