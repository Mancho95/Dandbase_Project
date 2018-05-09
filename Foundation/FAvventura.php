<?php
/**
 * @access public
 * @package foundation
 */
class FAvventura extends Fdb
{
    /**
     * Costruttore di classe
     */
    public function __construct() {
        $this->_table='avventura';
        $this->_key='cod_avventura';
        $this->_return_class='EAvventura';
        $this->_auto_increment=true;
        USingleton::getInstance('Fdb');
    }
    /**
     * Restituisce un array contenente tutte le avventure che corrispondono alla ricerca
     *
     * @param array $param
     * @return array
     */
    public function loadRicerche($param){
        $parametri=array();
        if($param['nome']==0 && count($param)==2){
            unset($param['nome']);
            $casex=true;
        }
        $keys=array_keys($param);
        if(count($param)==2)
            $parametri[]=array('nome','=',$param['nome'],'versione','=',$param['versione']);
        elseif($keys[0]=='nome')
            $parametri[]=array('nome','=',$param['nome']);
        elseif($casex==true)
            $parametri[]=array('versione','=',$param['versione']);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
    /**
     * Restituisce un array contenente tutte le avventure che corrispondono all'user loggato durante la sessione
     *
     * @param string $username
     * @return array
     */
    public function loadAvventure($username){
        $parametri=array();
        $parametri[]=array('username','=',$username);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
    /**
     * Restituisce un array contenente l'avventura da mostrare selezionata
     *
     * @param string $cod_avventura
     * @return array
     */
    public function loadMostra($cod_avventura){
        $parametri=array();
        $parametri[]=array('cod_avventura','=',$cod_avventura);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }
}
?>