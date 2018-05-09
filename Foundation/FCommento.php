<?php
/**
 * @access public
 * @package foundation
 */
class FCommento extends Fdb
{
    /**
     * Costruttore di classe
     */
    public function __construct() {
        $this->_table='commento';
        $this->_key='cod_commento';
        $this->_return_class='ECommento';
        $this->_auto_increment=true;
        USingleton::getInstance('Fdb');
    }
    /**
     * Restituisce un array contenente tutti i commenti corrispondenti all'avventura selezionata
     *
     * @param string $cod_avventura
     * @return array
     */
    public function loadCommenti($cod_avventura){
        $parametri=array();
        $parametri[]=array('cod_avventura','=',$cod_avventura);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
    /**
     * Restituisce un array contenente un commento, si utilizza quando deve essere cancellato
     *
     * @param string $cod_commento
     * @return array
     */
    public function loadCommento($cod_commento){
        $parametri=array();
        $parametri[]=array('cod_commento','=',$cod_commento);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
}
?>