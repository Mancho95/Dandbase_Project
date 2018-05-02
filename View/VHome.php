<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 06/08/17
 * Time: 10.01
 */

class VHome extends View {
    /**
     * @var string $_main_content
     */
    private $_main_content;

    /**
     * @var array $_main_button
     */
    private $_main_button=array();

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
     * Aggiunge il modulo di login in $_top_content per l'utente non autenticato -----------NON USATO--------
     */
    public function aggiungiModuloLogin() {
        $VRegistrazione=USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('default');
        $modulo_login=$VRegistrazione->processaTemplate();
        $this->_top_content.=$modulo_login;

    }

    /**
     * aggiunge il tasto per il login nel menu (per gli utenti non autenticati)
     */

    public function aggiungiTastoLogin() {
        $tasto_registrazione = array('testo' => 'Sign In', 'link' => '?controller=registrazione&task=login');
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
        $this->assign('menu',$this->_main_button); //non usato
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
        $this->assign('menu',$this->_main_button); //non usato
        $this->aggiungiTastoHomepage();
        $this->aggiungiTastoRegistrazione();
        $this->aggiungiTastoLogin();
        $this->aggiungiTastoSearch();
        $this->aggiungiTastoContact();
    }

    /**
     * aggiunge il tasto logout al menu
     */
    public function aggiungiTastoLogout() {
        $tasto_logout=array('testo' => 'Logout', 'link' => '?controller=registrazione&task=esci');
        $this->_top_button[]=$tasto_logout;
    }

    /**
     * aggiunge il tasto per la registrazione nel menu (per gli utenti non autenticati)
     */
    public function aggiungiTastoRegistrazione() {
        $tasto_registrazione = array('testo' => 'Sign Up', 'link' => '?controller=registrazione&task=registra');
        $this->_top_button[] = $tasto_registrazione;
    }

    public function aggiungiTastoSearch() {
        $tasto_boxmail = array('testo' => 'Search adventure', 'link' => '?controller=ricerca&task=modulo');
        $this->_top_button[] = $tasto_boxmail;

    }

    public function aggiungiTastoProfilo() {
        $tasto_profilo = array('testo' => 'Profile', 'link' => '?controller=profile&task=mostra');
        $this->_top_button[] = $tasto_profilo;

    }

    public function aggiungiTastoUpload() {
        $tasto_mieiannunci = array('testo' => 'Upload adventure', 'link' => '?controller=upload&task=modulo');
        $this->_top_button[] = $tasto_mieiannunci;

    }

    public function aggiungiTastoContact() {
        $tasto_mieiannunci = array('testo' => 'Contact Us', 'link' => '?controller=registrazione&task=contatta');
        $this->_top_button[] = $tasto_mieiannunci;

    }

    public function aggiungiTastoHomepage() {
        $tasto_mieiannunci = array('testo' => 'Homepage', 'link' => '.');
        $this->_top_button[] = $tasto_mieiannunci;

    }

    /**
     * imposta i tasti per le categorie nel menu principale
     */
    /*public function impostaTastiCategorie($categorie){
        $sotto_tasti=array();
        $tasti=array();
        foreach ($categorie as $categoria){
            $sotto_tasti[]=array('testo' => $categoria['categoria'], 'link' => '?controller=ricerca&task=lista&categoria='.$categoria['categoria']);
        }
        $tasti[]=array('testo' => 'Categorie', 'link' => '#', 'submenu' => $sotto_tasti);
        $this->_main_button=$tasti;
    }*/

}