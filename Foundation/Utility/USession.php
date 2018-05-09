<?php
/**
 * @access public
 * @package Foundation
 * @subpackage Utility
 */
class USession {
    /**
     * @var string $_durataSessione
     */
    private $_durataSessione = 360;
    /**
     * Costruttore di classe
     */
    public function __construct() {
        session_start();
        debug($_SESSION);
    }
    /**
     * Funzione che setta le variabili di sessione
     *
     * @param string $chiave
     * @param string $valore
     */
    function imposta_valore($chiave,$valore) {
        $_SESSION[$chiave]=$valore;
    }
    /**
     * Funzione che cancella le variabili di sessione
     *
     * @param string $chiave
     */
    function cancella_valore($chiave) {
        unset($_SESSION[$chiave]);
    }
    /**
     * Funzione che legge le variabili di sessione
     *
     * @param string $chiave
     */
    function leggi_valore($chiave) {
        if (isset($_SESSION[$chiave]))
            return $_SESSION[$chiave];
        else
            return false;
    }
    /**
     * Funzione che controlla l'inattività dell'utente attivo durante la sessione
     *
     * @return mixed
     */
    function controlloInattivita() {
        if ( !null == $this->leggi_valore('username') ) {
            $inattivita = time() - $this->leggi_valore('timeout');
            if ($inattivita > $this->_durataSessione) {
                session_unset();
                session_destroy();
                return true;
            } else
                $this->imposta_valore('timeout', time());
        }
        return false;
    }
}
