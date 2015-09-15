<?php if (isset($_SESSION['group']) && $_SESSION['group'] >=0){ ?>
<div class="corps" id="fEmb" action="index.php">
    <form>
        <div>
            <label for="embLbl"> Libellé: </label>
            <input name="embLbl" placeholder="Description" type="text">         
            <br>
            <label for="embCouleur"> Taux: </label>
            <input name="embCouleur" placeholder="Couleur" type="text">         
            <br>
            <label for="embType"> Taux: </label>
            <input name="embType" placeholder="Type" type="text">         
            <br>
        </div>
         <div class="bas">
            <input type="submit">
            <input name="clear" type="reset">
        </div>
    </form>
    <div>
        <p> Liste des éléments </p>
        <!-- affichage de la liste des éléments de "EMBALLAGE" 
        avec foreach label pour chaque et bouton modifier
        -->
    </div>
</div>
<?php
}
else echo 'Le silence est d\'or'
?>