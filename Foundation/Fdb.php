<?php

/**
 * @access public
 * @package foundation
 */
class Fdb
{
    /**
     * @var $_connection variabile di connessione al database
     */
    private $_connection;
    /**
     * @var $_result contiene il risultato dell'ultima query
     */
    private $_result;
    /**
     * @var $_table contiene il nome  della tabella
     */
    protected $_table;
    /**
     * @var $_key contiene la primary key della tabella
     */
    protected $_key;
    /**
     * @var $_return_class contiene il tipo della classe da restituire
     */
    protected $_return_class;
    /**
     * @var $_auto_increment variabile booleana settata a true se la tabella ha una chiave che si autoincrementa
     */
    protected $_auto_increment=false;
    /** Costruttore classe Fdb
     * @access public
     * @global array $config
     */
    public function __construct() {
        global $config;
        $this->connect( $config['db']['type'], $config['db']['host'], $config['db']['database'], $config['db']['user'], $config['db']['password']);
    }
    /** Effettua la connessione al database
     * @access public
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $database
     * @return boolean
     */
    public function connect($type,$host,$database,$user,$password) {
        try {
            $this->_connection = new PDO("$type:host=$host;dbname=$database;charset=utf8mb4", $user, $password);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        debug('Connection to database successful');
        $this->query('SET names \'utf8\'');
        return true;
    }

    /** Passa una query al database
     * @access public
     * @param string $query
     * @return boolean
     */
    public function query($query) {
        try {
            $this->_result = $this->_connection->query($query);
        } catch(PDOException $e) {
            echo "Query error" . $e->getMessage();
        }
        debug($query);
        $this->_error = $this->_connection->errorInfo();
        debug($this->_error);
        if ($this->_error)
            return false;
        else
            return true;
    }
    /** Restituisce il risultato in un array associativo
     * @access public
     * @return array|boolean ritorna false solo se result è vuoto
     */
    public function getResultAssoc() {
        if ($this->_result != false) {
            $numero_righe=$this->_result->rowCount();
            debug('Number of results:'. $numero_righe);
            if ($numero_righe>0) {
                $return = $this->_result->fetchAll(PDO::FETCH_ASSOC);
                $this->_result=false;
                return $return;
            }
        }
        return false;
    }
    /** Restituisce il risultato in un array
     * @access public
     * @return array|boolean ritorna false solo se result è vuoto
     */
    public function getResult() {
        if ($this->_result!=false) {
            $numero_righe=$this->_result->rowCount();
            debug('Number of results:'. $numero_righe);
            if ($numero_righe>0) {
                $row = $this->_result->fetch(PDO::FETCH_ASSOC);
                $this->_result=false;
                return $row;
            }
        }
        return false;
    }
    /**Restituisce un oggetto della classe Entity il cui tipo è contenuto in _return_class contentente i risultati della query
     * @access public
     * @return mixed
     */
    public function getObject() {
        $numero_righe=$this->_result->rowCount();
        debug('Number of results:'. $numero_righe);
        if ($numero_righe>0) {
            $row = $this->_result->fetchObject($this->_return_class);
            $this->_result=false;
            return $row;
        } else
            return false;
    }
    /**Restituisce un array di oggetti della classe Entity il cui tipo è contenuto in _return_class contentente i risultati della query
     * @access public
     * @return mixed
     */
    public function getObjectArray() {
        $numero_righe=$this->_result->rowCount();
        debug('Number of results:'. $numero_righe);
        if ($numero_righe>0) {
            $return=array();
            while ($row = $this->_result->fetchObject($this->_return_class)) {
                $return[]=$row;
            }
            $this->_result=false;
            return $return;
        } else
            return false;
    }
    /** Memorizza elementi sul database
     * @access public
     * @param $object
     * @return bool
     */
    public function store($object) {
        $i=0;
        $values='';
        $fields='';
        debug($this->_table);
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
        $query="INSERT INTO $this->_table ($fields) VALUES ($values)";
        $this->_connection->exec($query);
        $error = $this->_connection->errorInfo();
        if ($error)
            $return = false;
        else
            $return = true;
        debug($query);
        debug($error);
        if ($this->_auto_increment) {
            $result=$this->_connection->lastInsertId();
            return $result;
        } else {
            return $return;
        }
    }
    /** Estrae oggetti dal database
     * @access public
     * @param $key
     * @return bool
     */
    public function load ($key) {
        $query='SELECT * ' .
            'FROM `'.$this->_table.'` ' .
            'WHERE `'.$this->_key.'` = \''.$key.'\'';
        $this->query($query);
        return $this->getObject();
    }
    /** Elimina un elemento dal database
     * @access public
     * @param $object
     * @return bool
     */
    public function delete(& $object) {
        debug($object);
        $arrayObject=$object->getObjectVars();
        debug($arrayObject);
        $query='DELETE ' .
            'FROM `'.$this->_table.'` ' .
            'WHERE `'.$this->_key.'` = \''.$arrayObject[$this->_key].'\'';
        unset($object);
        return $this->query($query);
    }
    /** Modifica elemento del database
     * @access public
     * @param $object
     * @return bool
     */
    public function update($object) {
        $i=0;
        $fields='';
        foreach ($object as $key=>$value) {
            if (!($this->_auto_increment && $key == $this->_key) && substr($key, 0, 1)!='_') {
                if ($i==0) {
                    $fields.='`'.$key.'` = \''.$value.'\'';
                } else {
                    $fields.=', `'.$key.'` = \''.$value.'\'';
                }
                $i++;
            }
            debug($fields);
        }
        $query='UPDATE `'.$this->_table.'` SET '.$fields.' WHERE `'.$this->_key.'` = \''.$object["$this->_key"].'\'';
        return $this->query($query);
    }
    /** Effettua una ricerca sul database //DA TESTARE
     * @access public
     * @param array $parametri
     * @param string $ordinamento
     * @param string $limit
     * @return array
     */
    function search($parametri = array(), $ordinamento = '', $limit = '') {
        $filtro='';
        for ($i=0; $i<count($parametri); $i++) {
            if ($i>0) $filtro .= ' AND';
            $filtro .= ' `'.$parametri[$i][0].'` '.$parametri[$i][1].' \''.$parametri[$i][2].'\'';
        }
        $query='SELECT * ' .
            'FROM `'.$this->_table.'` ';
        if ($filtro != '')
            $query.='WHERE '.$filtro.' ';
        if ($ordinamento!='')
            $query.='ORDER BY '.$ordinamento.' ';
        if ($limit != '')
            $query.='LIMIT '.$limit.' ';
        $this->query($query);
        return $this->getObjectArray();
    }
}
?>