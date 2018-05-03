<?php

/**
 * @access public
 * @package foundation
 */
class FAvventura extends Fdb
{
    public function __construct() {
        $this->_table='avventura';
        $this->_key='cod_avventura';
        $this->_return_class='EAvventura';
        $this->_auto_increment=true;
        USingleton::getInstance('Fdb');
    }
    public function loadRicerche($param){
        $parametri=array();
        $parametri[]=array('nome','=',$param['nome'],'versione','=',$param['versione']);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }

    public function loadAvventure($username){
        $parametri=array();
        $parametri[]=array('username','=',$username);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }

    public function loadMostra($cod_avventura){
        $parametri=array();
        $parametri[]=array('cod_avventura','=',$cod_avventura);
        $arrayCommenti=parent::search($parametri);
        return $arrayCommenti;
    }

    public function store($object) {
        $i=0;
        $values='';
        $fields='';
        foreach ($object as $key=>$value) {
            if (!($this->_auto_increment && $key == $this->_key) && substr($key, 0, 1)!='_') {
                if ($i==0) {
                    $fields.='`'.$key.'`';
                    $values.='\''.$value.'\'';
                } else {
                    $fields.=', `'.$key.'`';
                    $values.=', \''.$value.'\'';
                }
                $i++;
            }
        }
        $query='INSERT INTO '.$this->_table.' ('.$fields.') VALUES ('.$values.')';
        $return = $this->query($query);
        if ($this->_auto_increment) {
            $query='SELECT LAST_INSERT_ID() AS `id`';
            $this->query($query);
            $result=$this->getResult();
            return $result['id'];
        } else {
            return $return;
        }
    }
}
?>