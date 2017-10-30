<?php

/**
 * @access public
 * @package foundation
 */
class FAvventura
{
    public function __construct() {
        $this->_table='avventura';
        $this->_key='cod_avventura';
        $this->_return_class='EAvventura';
        $this->_auto_increment=true;
        USingleton::getInstance('Fdb');
    }
    public function loadAvventure($username){
        $parametri=array();
        $parametri[]=array('username','=',$username);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
}
?>