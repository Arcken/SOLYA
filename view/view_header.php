<link type="text/css" href="css/style_header.css" rel="stylesheet">
  <script type="text/javascript" src="lib/jquery.js"></script>
  </head>
<!--Bloc du header-->
<div id="bloc_header">
    
     <!--Image du menu -->
     <div id="header_img">
         <p>.</p>
     </div>
     <div id="header_title">
    <!--Titre De la page -->
    <h1><?php echo $sPageTitle ?></h1>
     </div>
    <!--Bloc des informations utilisateurs-->
    <div id="header_user_info">
        
        <!-- Titre du bloc Informations utilisateurs-->
        <p id="ui_title">Informations :</p>
        
        <!-- Paragraphe contenant le nom et prénom-->
        <p id ="ui_info">
            <span><?php print_r($_SESSION['name']) ?></span>
            <span><?php print_r($_SESSION['lastname']) ?></span>
        </p>
        
        <!-- Bloc contenant le bouton-->
        <div>
            <form action="index.php" >
            <input id="ui_btn_deco" type="submit" name="action" value="deconnexion" ></input>
            </form>
        </div>
        
    </div>
</div>
<body class="zone_client">