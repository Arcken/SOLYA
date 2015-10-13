<?php if (isset($_SESSION['group']) && $_SESSION['group'] >=0){ ?>
<div>
    <form>
        <input name='token' type="text" value ='<?php echo rand(1,1000000)?>' hidden/>
        <div> 
            <label for="tvaLbl"> Libellé: </label>
            <input name="tvaLbl" placeholder="Saisie" required type="text">            
            <br>
            <label for="tvaTaux"> Libellé: </label>
            <input name="tvaTaux" placeholder="###,##" required type="text">            
            <br>
            <input type="submit">
            <input name="clear" type="reset"> 
        </div>
    </form>
    <div>
        <p> Liste des éléments </p>
        <!-- affichage de la liste des éléments de "GAMMME" 
        avec foreach label pour chaque et bouton modifier
        -->
        <p> Conservation1 <img src="../img/icon/process.png" alt="" onclick="" title="Modifier"/> </p>
    </div>
</div>
<?php
}
else echo 'Le silence est d\'or'
?>