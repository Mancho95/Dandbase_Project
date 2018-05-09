<?php
/**
 * @access public
 * @package Foundation
 * @subpackage Utility
 */
class USingleton
{
    /**
     * La variabile statica privata che conterrà l'istanza univoca
     * della nostra classe.
     */
    private static $instances = array();
    /**
     * Il costruttore in cui ci occuperemo di inizializzare la nostra
     * classe. E' opportuno specificarlo come privato in modo che venga
     * visualizzato automaticamente un errore dall'interprete se si cerca
     * di istanziare la classe direttamente.
     */
    private function __construct()
    {
        // vuoto
    }
    /**
     * Il metodo statico che si occupa di restituire l'istanza univoca della classe.
     *
     * @return mixed
     */
    public static function getInstance($c)
    {
        if( ! isset( self::$instances[$c] ) )
        {
            self::$instances[$c] = new $c;
        }
        return self::$instances[$c];
    }
}
?>