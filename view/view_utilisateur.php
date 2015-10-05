<?php if (isset($_SESSION['group']) && $_SESSION['group'] >= 0) { ?>
    <link type="text/css" href="css/style_formulaire.css" rel="stylesheet">
    <div class="corps">
        <form class="form" onsubmit="return verifPass()">
            <div class="col90">
                <label for="utNom"> Nom de familler: </label>
                <input name="utNom" placeholder="Nom" type="text">         
                <br>

                <label for="utPrenom"> Prénom: </label>
                <input name="utPrenom" placeholder="prenom" type="text">         
                <br>  

                <label for="utLogin"> Nom d'utilisateur: </label>
                <!-- Fonction qui vérifie unicité du login-->
                <input name="utLogin" id='utLogin' placeholder="Texte" type="text" required=""  
                       autocomplete="off" pattern=".{3,}" title="3 caractères minimum"
                       onblur="verifUnique('ut_login', 'utilisateur', 'utLogin', 'verifUnique')" >
                <a id='verifUnique'></a>            
                <br>

                <label for="utPass"> Mot de passe: </label>
                <!-- Fonction qui vérifie la force du mot de passe et sa longueur-->
                <input name="utPass" id='pass' placeholder="Au moins 8 caractères" 
                       autocomplete="off" pattern=".{8,}" title="8 caractères minimum"
                       onblur='verifPassForce()' type="password" required=""> 
                <a id='passForce'></a>
                <br>

                <label for="utPass2"> Confirmation mot de passe: </label>
                <!-- Fonction qui vérifie que la confirmation et le mot de passe 
                soient identique-->
                <input name="utPass2" id='confirmPass' 
                       placeholder="pas de cractère accentuée" type="password" required=""
                       onkeyup='verifPassImg()'>
                <img id="passValid" src="img/icon/accept.png" hidden style="border: none;">
                <br>

                <label for="utActif"> Compte actif: </label>
                <input name="utActif" type="radio" value="1" checked>Oui            
                <input name="utActif" type="radio" value="0">Non
                <br>  

                <label for="Groupe"> Groupe: </label>
                <select name="Groupe" required="">
                    <option value="">Aucun</option>
                    <?php foreach ($resAllGroupes as $groupe) { ?>
                        <option value="<?php echo $groupe->grp_id ?>">
                            <?php echo $groupe->grp_nom; ?> | <?php echo $groupe->grp_des; ?></option>
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
} else {
    echo 'Le silence est d\'or';
}
