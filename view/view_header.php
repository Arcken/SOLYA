<link type="text/css" href="css/style_header.css" rel="stylesheet">

<!--Bloc du header-->
<div id="bloc_header">
    
     <!--Image du menu -->
    <img id='img_header' src='files/Bandeau_SOLYA.png'></img>
    
    <!--Titre De la page -->
    <h1><?php echo $sPageTitle ?></h1>
    
    <!--Bloc des informations utilisateurs-->
    <div id="bloc_user_info">
        
        <!-- Titre du bloc Informations utilisateurs-->
        <span id="ui_title">Informations :</span>
        
        <!-- Paragraphe contenant le nom et prénom-->
        <p id ="ui_info">
            <span><?php print_r($_SESSION['name']) ?></span>
            <span><?php print_r($_SESSION['lastname']) ?></span>
        </p>
        
        <!-- Bloc contenant le bouton-->
        <div id="ui_bloc_btn">
            <form action="index.php" >
            <input id="ui_btn_deco" type="submit" name="action" value="deconnexion" ></input>
            </form>
        </div>
        
    </div>
</div>
<body class="zone_client">


 