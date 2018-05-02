<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 11/08/17
 * Time: 16.39
 */

class VUtente extends View {
    /**
     * @var string $_layout
     */
    private $_layout='default';

    /**
     * @var array $_adventures_list
     */
    private $_adventures_list=array();


    /**
     * restituisce la password passata tramite GET o POST
     *
     * @return mixed
     */
    public function getPassword() {
        if (isset($_SESSION['password']))
            return $_SESSION['password'];
        else
            return false;
    }

    /**
     * restituisce la username passata tramite GET o POST
     *
     * @return mixed
     */
    /*public function getUsername() {
        if (isset($_REQUEST['username']))
            return $_REQUEST['username'];
        else
            return false;
    }*/
    public function getUsername() {
        if (isset($_SESSION['username']))
            return $_SESSION['username'];
        else
            return false;
    }


    /**
     * @return mixed
     */
    public function getTask() {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }

    /**
     * @return mixed
     */
    public function getController() {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }

    /**
     * @return string
     */
    public function processaTemplate() {
        $contenuto=$this->fetch('utente_'.$this->_layout.'.tpl');
        return $contenuto;
    }

    /**
     * Imposta l'eventuale errore nel template
     *
     * @param string $errore
     */
    public function impostaErrore($errore) {
        $this->assign('errore',$errore);
    }

    /**
     * imposta il layout
     *
     * @param string $layout
     */
    public function setLayout($layout) {
        $this->_layout=$layout;
    }

    /**
     * Imposta i dati nel template identificati da una chiave ed il relativo valore
     *
     * @param string $key
     * @param mixed $valore
     */
    public function impostaDati($key,$valore) {
        $this->assign($key,$valore);
    }

    public function impostaAvventure($value){
        $this->_adventures_list=$value;
        $this->assign('_adventures_list',$this->_adventures_list);
        //$prova=implode(",",$this->_adventures_list);
        //foreach ($this->_adventures_list as $lista)
          //  echo($lista[i]);
    }

    /**
     * Restituisce l'array contenente i dati che andranno a sovrascrivere i vecchi
     *
     * @return array();
     */
    public function getModifiche() {
        $dati_richiesti=array('old', 'new', 'new_1');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        return $dati;
    }

}