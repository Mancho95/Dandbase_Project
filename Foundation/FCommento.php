<?php

/**
 * @access public
 * @package foundation
 */
class FCommento extends Fdb
{
    public function __construct() {
        $this->_table='commento';
        $this->_key='cod_commento';
        $this->_return_class='ECommento';
        $this->_auto_increment=true;
        USingleton::getInstance('Fdb');
    }
    public function loadCommenti($cod_avventura){
        $parametri=array();
        $parametri[]=array('cod_avventura','=',$cod_avventura);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }

    public function loadCommento($cod_commento){
        $parametri=array();
        $parametri[]=array('cod_commento','=',$cod_commento);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
}
?>