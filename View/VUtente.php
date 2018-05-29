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
     * Prende i valori contenuti nella variabile superglobale $_FILES e li inserisce in un array
     *
     * @return mixed
     */
    public function getPic() {
        $dati_richiesti=array('tmp_name', 'type');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_FILES['propic'][$dato]))
                $dati[$dato]=$_FILES['propic'][$dato];
        }
        return $dati;
    }
    /**
     * restituisce la mail contenuta nelle variabili di Sessione
     *
     * @return mixed
     */
    public function getEmail() {
        if (isset($_SESSION['email']))
            return $_SESSION['email'];
        else
            return false;
    }
    /**
     * restituisce la password contenuta nelle variabili di Sessione
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
     * restituisce la username contenuta nelle variabili di Sessione
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
     * restituisce il nome contenuto nelle variabili di Sessione
     *
     * @return mixed
     */
    public function getNome() {
        if (isset($_SESSION['name']))
            return $_SESSION['name'];
        else
            return false;
    }
    /**
     * restituisce il cognome contenuto nelle variabili di Sessione
     *
     * @return mixed
     */
    public function getCognome() {
        if (isset($_SESSION['surname']))
            return $_SESSION['surname'];
        else
            return false;
    }
    /**
     * restituisce l'immagine del profilo contenuta nelle variabili di Sessione
     *
     * @return mixed
     */
    public function getPropic() {
        if (isset($_SESSION['propic']))
            return $_SESSION['propic'];
        else
            return false;
    }
    /**
     * restituisce il tipo dell'immagine del profilo contenuto nelle variabili di Sessione
     *
     * @return mixed
     */
    public function getPictype() {
        if (isset($_SESSION['pictype']))
            return $_SESSION['pictype'];
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
     * imposta il layout
     *
     * @param string $layout
     */
    public function setLayout($layout) {
        $this->_layout=$layout;
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