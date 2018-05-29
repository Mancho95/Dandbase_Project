<?php
/**
 * @access public
 * @package Foundation
 */
class FUtente extends Fdb{
    /**
     * Costruttore di classe
     */
    public function __construct() {
        $this->_table='utente';
        $this->_key='username';
        $this->_return_class='EUtente';
        USingleton::getInstance('Fdb');
    }
    /**
     * Restituisce un array contenente i valori dell'utente selezionato in base alla username
     *
     * @param string $username
     * @return array
     */
    public function loadUser($username){
        $parametri=array();
        $parametri[]=array('username','=',$username);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
}
?>
