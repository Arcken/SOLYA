<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <div class="corps">
        <div class="col90">
            <input type="button" onclick='location.href = "index.php?action=utilisateur_add"' value="Ajouter">
            
            <table>
                <tr>
                    <th>
                        Login
                    </th>
                    <th>
                        Nom
                    </th>
                    <th>
                        Prénom
                    </th>                
                    <th>
                        Actif
                    </th>
                    <th>
                        Modifier
                    </th>
                </tr>
                
                    <?php foreach ($resAllUtilisateurs as $utilisateur) { 
                        if ($utilisateur->grp_id <= $_SESSION['group']) {?>
                        <tr>
                        <td><?php echo $utilisateur->ut_login ?></td>
                        <td><?php echo $utilisateur->ut_nom ?></td>
                        <td><?php echo $utilisateur->ut_prenom ?></td>
                        <td><?php echo $utilisateur->ut_actif ?></td>
                        <td><img src="img/icon/modify.png" alt="" title="Modifier"
                                 onclick='location.href = "index.php?action=utilisateur_detail&utLogin=<?php echo $utilisateur->ut_login ?>"'/></td>
                        </tr>
                            <?php
                        }
                    }
                        ?>
                
            </table>
        </div>
    </div>
    <?php
} else
    echo 'Le silence est d\'or'

    
?>