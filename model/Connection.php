<?php

require $path . '/exception/ExceptionThrower.php';

/**
 * Class de connexion à la base de données,
 * contient :
 * méthode statique de connexion à la base,
 * méthode statique envoyant les requêtes "sécurisé" à la base 
 * 
 * @throws MySQLException
 */
class Connection {

    private static $cnx;
    private static $iLimLbl;

    /**
     * Se connecte à la base de données, il n'est pas nécessaire d'appeler cette méthode,
     * les autres méthodes vont le faire si besoin.
     * @return type identifiant de connexion
     * @throws MySQLException
     */
    public static function getConnection() {
        global $host, $user, $pwd, $base, $iLimLbl;
        self::$iLimLbl = $iLimLbl;
        // singleton de la connexion
        // empty détermine si une variable est considérée comme vide. Une variable est considérée comme vide si elle n'existe pas, ou si sa valeur équivaut à FALSE. La fonction empty() ne génère pas d'alerte si la variable n'existe pas. 
        if (empty(self::$cnx)) {

            // Pas de try ... catch ici,on laisse l'appelant gérer l'erreur
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
     * 1 = Résultat  attendue ramène plusieurs ligne
     * 2 = Résultat attendu ramène l'état de la requète
     * 
     * $format est optionnel, par défaut -> PDO::FETCH_OBJ
     * Si $CodeRequete n'est pas renseigné, sa valeur est à 0 par défaut.
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
            
           if(isset($stm)){ 
               $resEr = $stm->errorCode();
           }else{
               $resEr =self::$cnx->errorCode();
           }
           
           throw new MySQLException("Erreur sur la requête : $sql || état de la requète -->" .$resEr, self::$cnx);;
           return $result=0;
           
        } 
    }

    public static function dernierId() {
        if (empty(self::$cnx)) {
            self::$cnx = Connection::getConnection();
        }
        return self::$cnx->lastInsertId();
    }

    public static function getLimLbl() {
        return self::$iLimLbl;
    }

}
