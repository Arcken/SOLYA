<?php if (isset($_SESSION['group']) && $_SESSION['group'] >=0){ ?>
<link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
<div class="corps">
    <form class="form">
        <div class="col90">
            <label for="utNom"> Nom de familler: </label>
            <input name="utNom" type="text" value="<?php echo $resUtilisateur->ut_nom?>">         
            <br>
            <label for="utPrenom"> Prénom: </label>
            <input name="utPrenom" type="text" value="<?php echo $resUtilisateur->ut_prenom?>">         
            <br>            
            <label for="utLogin"> Nom d'utilisateur: </label>
            <input name="utLogin" type="text" value="<?php echo $resUtilisateur->ut_login?>">         
            <br>
            <label for="utPass"> Mot de passe: </label>
            <input name="utPass" type="password" value="<?php echo $resUtilisateur->ut_pass?>">         
            <br>
            <label for="utActif"> Compte actif: </label>
            <input name="utActif" type="radio" 
                   value="1" <?php if ($resUtilisateur->ut_actif == 1) echo 'checked'?>>Oui            
            <input name="utActif" type="radio" 
                   value="0" <?php if ($resUtilisateur->ut_actif == 0) echo 'checked'?>>Non
            <br>
            <label for="Groupe"> Groupe: </label>
            <select name="Groupe" required="">
                <?php foreach ($resAllGroupes as $groupe){?>
                <option value="<?php echo $groupe->grp_id?>" 
                    <?php if ($groupe->grp_id == $resUtilisateur->grp_id) echo 'selected';?>>
                    <?php echo $groupe->grp_nom;?> | <?php echo $groupe->grp_des;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <input name="btnForm" type="submit" value="<?php echo $sButton; ?>">
                <input name="clear" type="reset"> 
                <input name="action" id="action" value="<?php echo $sAction ?>" type="text" hidden>
        </div>
    </form>
    
</div>

<?php
}
else echo 'Le silence est d\'or'
?>