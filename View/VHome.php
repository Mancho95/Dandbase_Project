<?php
/**
 * @access public
 * @package View
 */

class VHome extends View {
    /**
     * @var string $_main_content
     */
    private $_main_content;
    /**
     * @var string $_top_content
     */
    private $_top_content;
    /**
     * @var array $_top_button
     */
    private $_top_button=array();
    /**
     * @var string $_layout
     */
    private $_layout='default';
    /**
     * aggiunge il tasto per il login nel menu (per gli utenti non autenticati)
     */
    public function aggiungiTastoLogin() {
        $tasto_registrazione = array('testo' => 'Sign In', 'link' => '/Dandbase_Project/Login');
        $this->_top_button[] = $tasto_registrazione;
    }
    /**
     * Assegna il contenuto al template e lo manda in output
     */
    public function mostraPagina() {
        $this->assign('top_content',$this->_top_content);
        $this->assign('tasti_in_cima',$this->_top_button);
        $this->display('home_'.$this->_layout.'.tpl');
    }
    /**
     * imposta il contenuto principale alla variabile privata della classe
     */
    public function impostaContenuto($contenuto) {
        $this->_main_content=$contenuto;
    }
    /**
     * Restituisce il controller passato tramite richiesta GET o POST
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
     * Imposta la pagina per gli utenti registrati/autenticati
     */
    public function impostaPaginaRegistrato() {
        $session=USingleton::getInstance('USession');
        $this->assign('title','Dandbase');
        $nickname=$session->leggi_valore('username');
        $this->assign('content_title','Welcome back, '.$nickname);
        $this->assign('nick', $nickname);
        $this->assign('main_content',$this->_main_content);
        $this->aggiungiTastoProfilo();
        $this->aggiungiTastoLogout();
        $this->aggiungiTastoUpload();
        $this->aggiungiTastoSearch();
        $this->aggiungiTastoContact();
    }
    /*
     * imposta la pagina per gli utenti non registrati/autenticati
     */
    public function impostaPaginaGuest() {
        $this->assign('title','Dandbase');
        $this->assign('content_title','Welcome Guest');
        $this->assign('main_content',$this->_main_content);
        $this->aggiungiTastoHomepage();
        $this->aggiungiTastoRegistrazione();
        $this->aggiungiTastoLogin();
        $this->aggiungiTastoSearch();
        $this->aggiungiTastoContact();
    }
    /**
     * aggiunge il tasto logout al menu (per gli utenti autenticati)
     */
    public function aggiungiTastoLogout() {
        $tasto_logout=array('testo' => 'Logout', 'link' => '/Dandbase_Project/Logout');
        $this->_top_button[]=$tasto_logout;
    }
    /**
     * aggiunge il tasto per la registrazione nel menu (per gli utenti non autenticati)
     */
    public function aggiungiTastoRegistrazione() {
        $tasto_registrazione = array('testo' => 'Sign Up', 'link' => '/Dandbase_Project/Register');
        $this->_top_button[] = $tasto_registrazione;
    }
    /**
     * aggiunge il tasto per la ricerca
     */
    public function aggiungiTastoSearch() {
        $tasto_boxmail = array('testo' => 'Search adventure', 'link' => '/Dandbase_Project/Search');
        $this->_top_button[] = $tasto_boxmail;

    }
    /**
     * aggiunge il tasto per visualizzare il profilo (per gli utenti autenticati)
     */
    public function aggiungiTastoProfilo() {
        $tasto_profilo = array('testo' => 'Profile', 'link' => '/Dandbase_Project/Profile');
        $this->_top_button[] = $tasto_profilo;

    }
    /**
     * aggiunge il tasto per andare sul modulo di upload (per gli utenti autenticati)
     */
    public function aggiungiTastoUpload() {
        $tasto_mieiannunci = array('testo' => 'Upload adventure', 'link' => '/Dandbase_Project/Upload');
        $this->_top_button[] = $tasto_mieiannunci;

    }
    /**
     * aggiunge il tasto per contattare l'admin
     */
    public function aggiungiTastoContact() {
        $tasto_mieiannunci = array('testo' => 'Contact Us', 'link' => '/Dandbase_Project/ContactUs');
        $this->_top_button[] = $tasto_mieiannunci;

    }
    /**
     * aggiunge il tasto per l'homepage (per gli utenti non autenticati)
     */
    public function aggiungiTastoHomepage() {
        $tasto_mieiannunci = array('testo' => 'Homepage', 'link' => '/Dandbase_Project/Homepage');
        $this->_top_button[] = $tasto_mieiannunci;

    }
}