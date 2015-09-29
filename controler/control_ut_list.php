<?php

require_once $path . '/model/Utilisateur.php';
require_once $path . '/model/UtilisateurManager.php';
$resAllUtilisateurs = UtilisateurManager::getAllUtilisateurs();
$sPageTitle = "Liste des utilisateurs";
