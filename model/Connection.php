<?php


require_once 'exception/MySQLException.php';
 /**
     * Class de connexion à la base de données,
	 * contient :
	 * méthode statique de connexion à la base,
	 * méthode statique envoyant les requêtes "sécurisé" à la base 
     * 
     * @throws MySQLException
     */
class Connexion {

    private static $cnx;

    /**
     * Se connecte à la base de données, il n'est pas nécessaire d'appeler cette méthode,
     * les autres méthodes vont le faire si besoin.
     * 
     * @return type identifiant de connexion
     * @throws MySQLException
     */
    public static function getConnexion() {
    
        // singleton de la connexion
        // empty détermine si une variable est considérée comme vide. Une variable est considérée comme vide si elle n'existe pas, ou si sa valeur équivaut à FALSE. La fonction empty() ne génère pas d'alerte si la variable n'existe pas. 
        if (empty(self::$cnx)) {
            $fichier = 'config/param.ini.php';
if (file_exists($fichier) && is_file($fichier)) {
    $config = parse_ini_file($fichier, true);

    $host = $config['SQL']['host'];
    $user = $config['SQL']['user'];
    $pwd  = $config['SQL']['pwd'];
    $base = $config['SQL']['base'];
    
    } else {
    throw new MySQLException("Impossible de trouver le fichier de configuration 'config/param.ini.php'"
    , self::$cnx);
}
            // Pas de try ... catch ici,on laisse l'appelant gérer l'erreur
            try {
                //echo "mysql:host=$host;dbname=$base $user $passwd";
                self::$cnx = new PDO("mysql:host=".$host.";charset=utf8;dbname=".$base, $user, $pwd,
                        // Beaucoup d'applications web utilisent des connexions persistantes aux serveurs de base de données. 
                        // Les connexions persistantes ne sont pas fermées à la fin du 
                        // script, mais sont mises en cache et réutilisées lorsqu'un 
                        // autre script demande une connexion en utilisant les mêmes 
                        // paramètres. Le cache des connexions persistantes vous permet 
                        // d'éviter d'établir une nouvelle connexion à chaque fois 
                        // qu'un script doit accéder à une base de données, 
                        // rendant l'application web plus rapide. 
						
                        array(\PDO::ATTR_PERSISTENT => true));
            } catch (Exception $e) {
                throw new MySQLException($e->getMessage(), self::$cnx);
            }
        }
        return self::$cnx;
    }

    /**
     * Envoie une requête préparé 
     * et retourne le résultat dans le format PDO demandé.<br>
     * Si nécessaire, ne pas oublier de tester le nbre d'enreg retourné avec
     * $result->rowCount()
     * 
     * $format est optionnel, par défaut -> PDO::FETCH_OBJ
     * Si $tParam n'est pas renseigné, la fonction execute une requête simple.
     * @param string $sql
     * @param array $tParam
     * @param [int $format]
     * @return un tableau en fonction du format
     * @throws MySQLException
     */
    public static function requetes($sql, $tParam = null, $format = PDO::FETCH_OBJ) {

        if (empty(self::$cnx)) {
            self::$cnx = Connexion::getConnexion();
        }
        //Libération des ressources précédentes
        //PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
        //donc le try .. catch est inutile
		
        //Si $tParam = null on lance une requete simple
        if ($tParam === null) {

            $stm = self::$cnx->query($sql);
            $result = $stm->fetchAll($format);
            $stm->closeCursor();
        }
		
        //Sinon on lance une requete préparée prenant $tParam en paramètres
        else {
            $stm = self::$cnx->prepare($sql);
            $stm->execute($tParam);
            $result = $stm->fetchAll($format);
            $stm->closeCursor();
        }
        if (!$result) {
            throw new MySQLException("Erreur sur la requête : $sql", self::$cnx);
        } else {
            return $result;
        }
    }
/**
     * Envoie une requête préparé 
     * et retourne le résultat dans le format PDO demandé.<br>
     * Si nécessaire, ne pas oublier de tester le nbre d'enreg retourné
     * 
     * 
     * $format est optionnel, par défaut -> PDO::FETCH_OBJ
     * Si $tParam n'est pas renseigné, la fonction execute une requête simple.
     * @param string $sql
     * @param int $ParamUn  
     * @param array $tParam
     * @param [int $format]
     * @return un tableau en fonction du format
     * @throws MySQLException
     */
    public static function requeteFetch($sql,$tParam=null,$paramUn=null,$paramDeux=null,$format = PDO::FETCH_BOTH) {

        if (empty(self::$cnx)) {
            self::$cnx = Connexion::getConnexion();
        }
        //Libération des ressources précédentes
        //PDO::query() retourne un objet PDOStatement, ou FALSE si une erreur survient. 
        //donc le try .. catch est inutile
		
        //Si $tParam = null on lance une requete simple
        if ($tParam === null && $paramUn ===null && $paramDeux===null) {

            $stm = self::$cnx->query($sql);
            $result = $stm->fetch($format);
            $stm->closeCursor();
        }
		
        //Sinon on lance une requete préparée prenant param un et deux en paramêtre en tant qu'int en paramètres
        //Spécifique pour bind des valeurs sur le limit de getBDby5($page,$limite) de BDManager.
        if($tParam===null && isset($paramUn) && isset($paramDeux) ) {
            
            $stm = self::$cnx->prepare($sql);
            $stm->bindParam(1,$paramUn,PDO::PARAM_INT);
            $stm->bindParam(2,$paramDeux,PDO::PARAM_INT);
            $stm->execute();
            $result=$stm->fetchAll($format);
            $stm->closeCursor();
            return $result;
        }
        //Sinon on effectue une requete préparé prenant $tParam en paramètres
        else {
            $stm = self::$cnx->prepare($sql);
            $stm->execute($tParam);
            $result = $stm->fetchAll($format);
            $stm->closeCursor();
        }
      
        
        if (!$result) {
            throw new MySQLException("Erreur sur la requête : $sql", self::$cnx);
        } else {
            return $result;
        }
    }

    /**
     * Retourne l'identifiant de la dernière ligne insérée
     * 
     * @return String
     */
    public static function dernierId() {
        if (empty(self::$cnx)) {
            self::$cnx = Connexion::getConnexion();
        }
        return self::$cnx->lastInsertId();
    }

}
