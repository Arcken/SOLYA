<?php 
    if (isset($_REQUEST['login'])){
    
     echo '<span> Authentification requise pour accéder au contenu de cette page </span>';
     
    }  

?>
<link type="text/css" href="css/style_connexion.css" rel="stylesheet" >
<div id="bloc_form_cnx">
    
    <h1 class="connexion"><?php echo $sPageTitle ?></h1>
    
    <form class="connexion" action ="index.php" method ="post" >
        <input type="text" require="required" name="login"></input>
        <input type="password" require="required" name="pwd"></input>
        <input type="submit" name ="action" value="connexion"></input>
    </form>
</div>
<div>
    <img src="img/site/logoSolya.png"/>
</div>
  
  

