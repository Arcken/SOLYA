<link type="text/css" href="css/style_header.css" rel="stylesheet">

<div id="bloc_header">
     <!--Image du menu -->
    <img id='img_header' src='files/Bandeau_SOLYA.png'></img>
    <h1><?php echo $sPageTitle ?></h1>
    <div id="bloc_user_info">
        
        <span id="ui_title"><strong>Informations de connexion:</strong></span>
        <p id ="ui_info">
            <span><?php print_r($_SESSION['name']) ?></span>
            <span><?php print_r($_SESSION['lastname']) ?></span>
        </p>  
        <div id="ui_bloc_btn"><button id="ui_btn_deco" type =button name="deconnect" value="Déconnexion" onclick="">Déconnexion</button></div>
    </div>
</div>
<?php  

?>
 