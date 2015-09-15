<?php

$sPageTitle = "Connexion";
$sAction = '';
$sButton = "Envoyer";
$nv = ''; //variable de contrôle pour les popups
//$sPhp_Action='';
//$sButton='';

if (!isset($_SESSION['auth'])) {

    require $path . '/view/view_connection.php';
} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deconnexion') {

    session_destroy();
    session_commit();
    $_SESSION = array();
    require $path . '/view/view_connection.php';
} else {
    if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'nv_') === FALSE) {
        $nv = 0;
        if (isset($_REQUEST['action'])) {
            $sAction = $_REQUEST['action'];
        }

        /* ----------------------------Traitement des données-------------------- */

        switch ($sAction) {

            case "home":
            case "connexion":
                $sPageTitle = "Accueil";
                break;

            //Catalogue
            case "fiart_add":
                $sPageTitle = "Ajout de Fiche Article";
                require $path . '/model/FicheArticle.php';
                require $path . '/model/FicheArticleManager.php';
                require $path . '/model/Gamme.php';
                require $path . '/model/GammeManager.php';
                
                $resGa = GammeManager::getAllGammes();
                
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {

                    $oFiArt = new FicheArticle();
                    //$oFiArt->fiart_id      = $_REQUEST[''];
                    $oFiArt->fiart_pays_id = $_REQUEST['pays'];
                    $oFiArt->fiart_lbl = $_REQUEST['fiartLbl'];
                    //$oFiArt->fiart_photos  = $_REQUEST[''];
                    $oFiArt->fiart_ing = $_REQUEST['fiartIng'];
                    $oFiArt->fiart_alg = $_REQUEST['fiartAlg'];
                    echo $oFiArt->fiart_lbl;
                    $result = FicheArticleManager::addFicheArticle($oFiArt);
                    echo $result;
                }

                break;
            //Créer un contact    
            case "ctc_add":
                $sPageTitle = "Ajouter un contact";
                
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                    
                    switch ($_REQUEST['typeCtc']){
                        
                        case "1":
                            break;
                        
                        case "2" :
                            
                            if (isset($_REQUEST['PRS_NOM']) && !empty($_REQUEST['PRS_NOM'])){
                                require $path.'/model/Personne.php';
                                require $path.'/model/PersonneManager.php';
                                
                                try{
                            
                                $cnx=Connection::getConnection();
                                $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $cnx->beginTransaction();
                                
                                $oPers = new Personne();
                                $oPers->PRS_NOM     =$_REQUEST['PRS_NOM'];
                                $oPers->PRS_PRENOM  =$_REQUEST['PRS_PRENOM'];
                                $oPers->PRS_PRENOM2 =$_REQUEST['PRS_PRENOM2'];
                                $oPers->PRS_PRENOM3 =$_REQUEST['PRS_PRENOM3'];
                                $oPers->PRS_DTN     =$_REQUEST['PRS_DTN'];
                                
                                $resAddCtc = PersonneManager::addPersonne($oPers);
                                $idPers = Connection::dernierId();
                            
                                
                                if (isset($_REQUEST['ADR_VILLE'])){
                                    
                                    require $path.'/model/Adresse.php';
                                    require $path.'/model/AdresseManager.php';
                                    
                                    $oAddr = new Adresse();
                                    $oAddr->PAYS_ID   =1;
                                    $oAddr->ADR_NUM   =$_REQUEST['ADR_NUM'];
                                    $oAddr->ADR_VOIE  =$_REQUEST['ADR_VOIE'];
                                    $oAddr->ADR_RUE1  =$_REQUEST['ADR_RUE1'];
                                    $oAddr->ADR_RUE2  =$_REQUEST['ADR_RUE2'];
                                    $oAddr->ADR_RUE3  =$_REQUEST['ADR_RUE3'];
                                    $oAddr->ADR_CP    =$_REQUEST['ADR_CP'];
                                    $oAddr->ADR_VILLE =$_REQUEST['ADR_VILLE'];
                                    $oAddr->ADR_ETAT  =$_REQUEST['ADR_ETAT'];
                                    
                                    $resAddCtc += ''. AdresseManager::addAddresse($oAddr);
                                    $idAdr=  Connection::dernierId();
                                    
                                    if (isset($idAdr)&&isset($idPers)){
                                         require $path.'/model/DomicilierPrs.php';
                                         require $path.'/model/DomicilierPrsManager.php';
                                         
                                        $oDomPrs=new DomicilierPrs();
                                        $oDomPrs->ADRPER_LBL ="truc";
                                        $oDomPrs->ADR_ID     =$idAdr;
                                        $oDomPrs->PRS_ID     =$idPers;
                                        
                                        $resAddCtc += ' '.DomicilierPrsManager::addDomicilierPrs($oDomPrs);
                                    }
                                }
                                
                                if (isset($_REQUEST['MAIL_ADR'])){
                                    require $path.'/model/Mail.php';
                                    require $path.'/model/MailManager.php';
                                    
                                    $oMail = new Mail();
                                    $oMail->MAIL_ADR = $_REQUEST['MAIL_ADR'];
                                    
                                    $resAddCtc += ' '. MailManager::addMail($oMail);
                                    $idMail=  Connection::dernierId();
                                    
                                    if(isset($idMail) && isset($idPers)){
                                        require $path.'/model/ContacterPrs.php';
                                        require $path.'/model/ContacterPrsManager.php';
                                         
                                        $oCtcPrs=new ContacterPrs();
                                        $oCtcPrs->MAILPER_LBL ="truc";
                                        $oCtcPrs->MAIL_ID     =$idMail;
                                        $oCtcPrs->PRS_ID      =$idPers;
                                        
                                       $resAddCtc += ' '. ContacterPrsManager::addContacterPrs($oCtcPrs);
                                    }
                                }
                                
                                if(isset($_REQUEST['TEL_NUM'])&& isset($_REQUEST['TEL_IND'])){
                                    
                                    require $path.'/model/Telephone.php';
                                    require $path.'/model/TelephoneManager.php';
                                    
                                    $oTel=new Telephone();
                                    $oTel->TEL_IND = $_REQUEST['TEL_IND'];
                                    $oTel->TEL_NUM = $_REQUEST['TEL_NUM'];
                                    
                                    $resAddCtc += ' '.TelephoneManager::addTel($oTel);
                                    $idTel = Connection::dernierId();
                                    
                                    if (isset($idTel)){
                                        
                                        require $path.'/model/JoindrePrs.php';
                                        require $path.'/model/JoindrePrsManager.php';
                                        
                                        $oJoindrePrs = new JoindrePrs();
                                        $oJoindrePrs->PRS_ID=$idPers;
                                        $oJoindrePrs->TEL_ID=$idTel;
                                        $oJoindrePrs->TELPER_LBL="truc";
                                        
                                        $resAddCtc += ' '.JoindrePrsManager::addJoindrePrs($oJoindrePrs);
                                    }
                                }
                                
                            $cnx->commit();
                            echo $resAddCtc;
                             
                            }catch(MySQLException $e){
                                $e->RetourneErreur();
                                $cnx->rollback();
                            }
                            
                        }
                       
                    }
                    break;
                }
                break;

            //gamme
            case "ga_add":
                $sPageTitle = "Ajouter une gamme";
                require $path . '/model/Gamme.php';
                require $path . '/model/GammeManager.php';
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                    $oGa = new Gamme();
                    $oGa->GA_LBL = $_REQUEST['gaLbl'];
                    $oGa->GA_ABV = $_REQUEST['gaAbv'];
                    $result = GammeManager::addGamme($oGa);
                    echo $result;
                }
                $resGa = GammeManager::getAllGammes();
                break;
                
                case "pays_add":
                $sPageTitle = "Ajouter un pays";
                require $path . '/model/Pays.php';
                require $path . '/model/PaysManager.php';
                if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                    $oGa = new Pays();
                    
                    $result = GammeManager::addGamme($oPays);
                    echo $result;
                }
                $resPays = GammeManager::getAllPays();
                break;
        }

        /* ----------------------------Affichage--------------------------------- */
        require_once $path . '/view/view_header.php';
        require_once $path . '/view/view_menu.php';
        switch ($sAction) {

            case "home":
            case "connexion":
                require $path . '/view/view_home.php';
                break;

            //Catalogue
            case "fiart_add":
                $sPageTitle = "Ajouter une fiche article";
                require $path . '/view/view_fiche_article.php';
                break;

            case "ga_add":
            case "ga_add_add":

                $sPageTitle = "Ajouter une gamme";
                require $path . '/view/view_gamme.php';
                break;

            case "ctc_add":
                require $path . '/view/view_creer_contact.php';
                break;
        }
        require_once $path . '/view/view_footer.php';
    } else {
        /* ----------------------------Popup--------------------------------- */

        if (isset($_REQUEST['action']) && strpos($_REQUEST['action'], 'nv_') !== FALSE) {
            $sAction = $_REQUEST['action'];
            $nv = 1;
            /* ----------------------------Traitement--------------------------------- */
            switch ($sAction) {
                case "nv_ga_add":
                    require $path . '/model/Gamme.php';
                    require $path . '/model/GammeManager.php';
                    if (isset($_REQUEST['btnForm']) && $_REQUEST['btnForm'] == "Envoyer") {
                        $oGa = new Gamme();
                        $oGa->GA_LBL = $_REQUEST['gaLbl'];
                        $oGa->GA_ABV = $_REQUEST['gaAbv'];
                        $result = GammeManager::addGamme($oGa);
                        
                    }
                    $resGa = GammeManager::getAllGammes();
                    break;
            }

            /* ----------------------------Affichage--------------------------------- */
            switch ($sAction) {
                case "nv_ga_add":
                    include $path . '/view/view_gamme.php';
                    
                    break;
            }
        }
    }
}
?>