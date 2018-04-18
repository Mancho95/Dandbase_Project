<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 06/08/17
 * Time: 14.54
 */

class USession {

    private $_durataSessione = 360; // in secondi

    public function __construct() {
        session_start();
        debug($_SESSION);
    }
    function imposta_valore($chiave,$valore) {
        $_SESSION[$chiave]=$valore;
    }
    function cancella_valore($chiave) {
        unset($_SESSION[$chiave]);
    }
    function leggi_valore($chiave) {
        if (isset($_SESSION[$chiave]))
            return $_SESSION[$chiave];
        else
            return false;
    }
    function controlloInattivita() {
        if ( !null == $this->leggi_valore('username') ) { // controllo se la sessione esiste
            $inattivita = time() - $this->leggi_valore('timeout');
            if ($inattivita > $this->_durataSessione) { // controllo il tempo di inattività
                session_unset();
                session_destroy();
                return true;
            } else
                $this->imposta_valore('timeout', time());
        }
        return false;
    }

}
