<?php

class VUpload extends View {
    /**
     * @var string $_layout
     */
    private $_layout='default';

    /**
     * restituisce la username passata tramite GET o POST
     *
     * @return mixed
     */

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

    public function getDatiMostra() {
        if (isset($_REQUEST['cod_avventura']))
            return $_REQUEST['cod_avventura'];
        else
            return false;
    }

    /**
     * @return string
     */
    public function processaTemplate() {
        $this->assign('nick',$this->getUsername());
        $contenuto=$this->fetch('upload_'.$this->_layout.'.tpl');
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

    /**
     * Restituisce l'array contenente i dati dell'avventura
     *
     * @return array();
     */
    public function getDatiAvventura() {
        $dati_richiesti=array('username','nome','descrizione','versione');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        return $dati;
    }

}