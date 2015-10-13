<?php

/**
 * Gestion des erreurs avec les exceptions
 */
class MySQLException extends Exception {

    private $cnx = "";


    public function __construct($Msg, $cnx) {
        parent :: __construct($Msg);
        $this->cnx = $cnx;
    }

    /**
     * Retourne le message, la ligne et le fichier d'origine de l'erreur
     * 
     * @return string
     */
    public function RetourneErreur() {
        $msg = '<div><strong>' . $this->getMessage() . '</strong>';
        if (isset($this->cnx) && $this->cnx !== null) {
            $msg .= '<br>' . $this->cnx->errorInfo()[0] ;
        }
        $msg .= '<br>Trace : ' . str_replace("#", "<br>", $this->getTraceAsString());
        $msg .= ' dans ' . $this->getFile();
        $msg .= ' ligne : ' . $this->getLine();
        $msg .= '</div>';
        return $msg;
    }

}
