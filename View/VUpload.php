<?php
/**
 * @access public
 * @package View
 */
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
     * Restituisce il task passato tramite GET o POST
     *
     * @return mixed
     */
    public function getTask() {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }
    /**
     * Restituisce il controller passato tramite GET o POST
     *
     * @return mixed
     */
    public function getController() {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }
    /**
     * Restituisce il cod_avventura passato tramite GET o POST
     *
     * @return mixed
     */
    public function getDatiMostra() {
        if (isset($_REQUEST['cod_avventura']))
            return $_REQUEST['cod_avventura'];
        else
            return false;
    }
    /**
     * Processa il layout scelto nella variabile _layout
     *
     * @return string
     */
    public function processaTemplate() {
        $this->assign('nick',$this->getUsername());
        $contenuto=$this->fetch('upload_'.$this->_layout.'.tpl');
        return $contenuto;
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
     * Prende i valori contenuti nella variabile superglobale $_FILES e li inserisce in un array
     *
     * @return mixed
     */
    public function getPic() {
        $dati_richiesti=array('tmp_name', 'type');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_FILES['advpic'][$dato]))
                $dati[$dato]=$_FILES['advpic'][$dato];
        }
        return $dati;
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
            if(isset($_SESSION[$dato])&&$dato!='nome')
                $dati[$dato]=$_SESSION[$dato];
        }
        return $dati;
    }
}