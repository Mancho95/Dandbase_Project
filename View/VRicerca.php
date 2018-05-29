<?php
/**
 * @access public
 * @package View
 */
class VRicerca extends View {
    /**
     * @var string _layout
     */
    private $_layout='default';
    /**
     * Processa il layout scelto nella variabile _layout
     *
     * @return string
     */
    public function processaTemplate() {
        return $this->fetch('ricerca_'.$this->_layout.'.tpl');
    }
    /**
     * Ritorna l'username contenuto nelle variabili di sessione
     *
     * @return mixed
     */
    public function getUsername() {
        if (isset($_SESSION['username'])) {
            return $_SESSION['username'];
        } else
            return false;
    }
    /**
     * Imposta il layout
     *
     * @param string $layout
     */
    public function setLayout($layout) {
        $this->_layout=$layout;
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
     * Restituisce il nome e la versione dell'avventura tramite GET o POST
     *
     * @return mixed
     */
    public function getDatiRicerca() {
        $dati_richiesti=array('nome','versione');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        return $dati;
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
     * Restituisce il cod_avventura, l'username, il testo e il voto passato tramite GET o POST di un commento
     *
     * @return mixed
     */
    public function getDatiCommento() {
        $dati_richiesti=array('cod_avventura','username','testo','upvote');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
            if(isset($_SESSION[$dato]))
                $dati[$dato]=$_SESSION[$dato];
        }
        return $dati;
    }
    /**
     * Imposta la media voti da mostrare nel template
     *
     * @param array $value
     */
    public function impostaUpvote($value){
        if($value==true)
        $this->assign('_upvote',$value.'%');
        elseif($value==false)
        $this->assign('_upvote','No comments already. Be the first!');
        if($value=='&')
        $this->assign('_upvote','0%');
    }
}