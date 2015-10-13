<?php
//On inclut les classes gérant les exceptions
require_once $path . '/exception/ExceptionThrower.php';
require_once $path . '/exception/MySQLException.php';

/**
 * Class de connexion à la base de données,
 * contient :
 * méthode statique de connexion à la base,
 * méthode statique générique envoyant les requêtes "sécurisé" à la base 
 * 
 * @throws MySQLException
 */
class Connection {

    private static $cnx;
    private static $iLimLbl;

    /**
     * Méthode static de connexion à la base de données,
     * il n'est pas nécessaire d'appeler cette méthode,
     * les autres méthodes vont le faire si besoin.
     * Sauf si besoin de prendre la main sur la connexion
     * pour gérer des transaction.
     * 
     * @return type identifiant de connexion
     * @throws MySQLException
     */
    public static function getConnection() {
        global $host, $user, $pwd, $base, $iLimLbl;
        self::$iLimLbl = $iLimLbl;
        // singleton de la connexion
        // empty détermine si une variable est considérée comme vide.
        // Une variable est considérée comme vide si elle n'existe pas,
        // ou si sa valeur équivaut à FALSE.
        // La fonction empty() ne génère pas d'alerte si la variable n'existe pas. 
        if (empty(self::$cnx)) {

            try {
                //echo "mysql:host=$host;dbname=$base $user $passwd";
                self::$cnx = new PDO("mysql:host=" . $host . ";charset=utf8;dbname=" . $base, $user, $pwd,
                        // Beaucoup d'applications web utilisent des connexions persistantes aux serveurs de base de données. 
                        // Les connexions persistantes ne sont pas fermées à la fin du 
                        // script, mais sont mises en cache et réutilisées lorsqu'un 
                        // autre script demande une connexion en utilisant les mêmes 
                        // paramètres. Le cache des connexions persistantes vous permet 
                        // d'éviter d'établir une nouvelle connexion à chaque fois 
                        // qu'un script doit accéder à une base de données, 
                        // rendant l'application web plus rapide.
                        // On en profite aussi pour paramétrer la connexion.
                        // On la sort du Mode Erreur Silencieux et passe les erreurs en Exception.
                        // Certaines erreurs ne pouvant être géré (eg :Fatal Error, Run Time)
                        // on utilisera la classe ExceptionThrower qui permettras de les gérer comme Exceptions.
                        // Voir (exception/ExceptionThrower)
                        array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => true, PDO::ERRMODE_EXCEPTION => true));
            } catch (Exception $e) {
                throw new MySQLException($e->getMessage(), self::$cnx);
            }
        }
        return self::$cnx;
    }

    /**
     * Envoie une requète à la base de données
     * Le code requète permet de choisir le type de résultat attendu par la requête
     *
     * 0 = Résultat attendu ramène une seul ligne
     * 1 = Résultat attendue ramène plusieurs ligne
     * 2 = Résultat attendu ramène le nombres de lignes impacté par celle-ci
     * 
     * $format est optionnel, par défaut -> PDO::FETCH_OBJ
     * Si $CodeRequete n'est pas renseigné, sa valeur est à 0 par défaut.
     * 
     * @param int $CodeRequete de 0 à 2
     * @param string $sql
     * @param array $tParam
     * @param [int $format]
     * @return un tableau en fonction du format
     * @throws MySQLException
     */
    public static function request($codeRequete = 0, $sql, $tParam = NULL, $format = PDO::FETCH_OBJ) {

        
        try {
            global $resEr;
            global $resMessage;
            ExceptionThrower::Start();
            if (empty(self::$cnx)) {
                self::$cnx = Connection::getConnection();
            }



            if ($tParam == null) {
                $stm = self::$cnx->query($sql);
                
            } else {
                
                $stm = self::$cnx->prepare($sql);
                $stm->execute($tParam);
            }
            
            switch ($codeRequete) {

                //requête résultat simple

                case 0:

                    $result = $stm->fetch($format);
                    $stm->closeCursor();
                    if (!$result){
                        $result=0;
                    }
                    break;


                //requête résultats Multiple

                case 1:

                    $result = $stm->fetchAll($format);
                    $stm->closeCursor();
                    if (!$result){
                        $result=0;
                    }
                    break;


                //requête Nombre de lignes impacté
                case 2:
                    $result = $stm->rowCount();
                    $stm->closeCursor();
                    if (!$result){
                        $result=0;
                    }
                    break;
            }
            
            ExceptionThrower::Stop();
            return $result;
            
        } catch (Exception $e) { 
            //Les erreurs de la base de données étant gérer avec le SQLSTATE.
            //Cela permet de récupérer le SQLSTATE quoiqu'il arrive.
            //Car selon les cas il est récupéré soit sur le statement
            //soit sur la connexion directement.
            //On le place ensuite dans $resErr qui est afiché dans le footer.
           if(isset($stm)){ 
               $resEr = $stm->errorCode();
           }else{
               $resEr =self::$cnx->errorCode();
           }
           switch ($resEr) {
                case '23000':
                    $resEr = "<b>23000</b> Elément utilisé par un autre enregistrement";
                    break;
                case 'HY000':
                    $resEr = "<b>HY000</b> Erreur inattendu";
                    break;
            }
            throw new MySQLException("Erreur sur la requête : $sql || état de la requète -->" .$resEr, self::$cnx);;
           return $result=0;
           
        } 
    }
    
    /**
     * Méthode static permettant comme son nom l'indique 
     * de récupérer l'id du dernier enregistrement inséré
     * dans la base de données. 
     * @return type
     */
    public static function dernierId() {
        if (empty(self::$cnx)) {
            self::$cnx = Connection::getConnection();
        }
        return self::$cnx->lastInsertId();
    }
}
