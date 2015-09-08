<link type="text/css" href="css/style_header.css" rel="stylesheet">
<?php print_r($_SESSION); ?>
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
        <div id="ui_bloc_btn">
            <form action="index.php" >
            <input id="ui_btn_deco" type="submit" name="Action" value="Deconnexion" ></input>
            </form>
        </div>
    </div>
</div>
<?php  

?>
 