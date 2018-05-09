<?php
/**
 * @access public
 * @package View
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
     * Processa il layout scelto nella variabile _layout
     *
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
     * Imposta il valore user nel template
     *
     * @param string $user
     */
    public function impostaUsername($user){
        $this->assign('user',$user);
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
     * Imposta le avventure da mostrare nel template
     *
     * @param array $value
     */
    public function impostaAvventure($value){
        $this->_adventures_list=$value;
        $this->assign('_adventures_list',$this->_adventures_list);
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