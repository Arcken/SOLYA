<?php if (isset($_SESSION['group']) && $_SESSION['group'] >=0){ ?>
<div>
    <form>
        <div>
            <label for="utNom"> Nom de familler: </label>
            <input name="utNom" placeholder="Nom" type="text">         
            <br>
            <label for="utPrenom1"> Prénom usuelle: </label>
            <input name="utPrenom1" placeholder="prenom" type="text">         
            <br>
            <label for="utPrenom2"> Deuxième prénom: </label>
            <input name="utPrenom2" placeholder="prenom" type="text">         
            <br>
            <label for="utPrenom3"> Troisième prénom: </label>
            <input name="utPrenom3" placeholder="prenom" type="text">         
            <br>
            <label for="utDtn"> Date de naissance: </label>
            <input name="utDtn" placeholder="##/##/####" type="text">         
            <br>
            <label for="utLogin"> Nom d'utilisateur: </label>
            <input name="utLogin" placeholder="Texte" type="text">         
            <br>
            <label for="utPass"> Mot de passe: </label>
            <input name="utDtn" placeholder="pas de cractère accentuée" type="password">         
            <br>
            <label for="utActif"> Compte actif: </label>
            <input name="utActif" type="radio" value="1" checked>Oui            
            <input name="utActif" type="radio" value="0">Non
            <br>
            <input type="submit">
            <input name="clear" type="reset">
        </div>
    </form>
    <div
        <p> Liste des éléments </p>
        <!-- affichage de la liste des éléments de "UTILISATEUR" 
        avec foreach label pour chaque et bouton modifier
        -->
    </div>
</div>

<?php
}
else echo 'Le silence est d\'or'
?>