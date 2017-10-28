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


}