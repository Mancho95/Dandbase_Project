<?php
/**
 * @access public
 * @package Controller
 */
class CRegistrazione {
    /**
     * @var string $_errore
     */
    private $_errore='';
    /**
     * @var string $_avviso
     */
    private $_avviso='';
    /**
     * @var boolean $_session_checker
     */
    private $_session_checker=false;
    /**
     * Controlla se l'utente è registrato ed autenticato
     *
     * @return boolean
     */
    public function getUtenteRegistrato() {
        $autenticato = false;
        $session = USingleton::getInstance('USession');
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $task = $VRegistrazione->getTask();
        $controller = $VRegistrazione->getController();
        $this->_username = $VRegistrazione->getUsername();
        $this->_password = $VRegistrazione->getPassword();
        if ($session->leggi_valore('username') != false) {
            $autenticato = true;
        } elseif ($task == 'autentica' && $controller == 'registrazione') {
            $autenticato = $this->autentica($this->_username, $this->_password);
        }
        if ($task == 'esci' && $controller == 'registrazione') {
            $this->logout();
            $autenticato = false;
        }
        $VRegistrazione->impostaDati('errore',$this->_errore);
        $this->_errore = '';
        return $autenticato;
    }
    /**
     * Controlla se una coppia username e password corrispondono ad un utente registrato ed in tal caso impostano le variabili di sessione relative all'autenticazione
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function autentica($username, $password) {
        $FUtente = new FUtente();
        $utente = $FUtente->load($username);
        if ($utente != false) {
            if ($username == $utente->getUsername() && $password == $utente->getPassword()) {
                $session = USingleton::getInstance('USession');
                $session->imposta_valore('username',$username);
                $session->imposta_valore('email',$utente->getEmail());
                $session->imposta_valore('name',$utente->getNome());
                $session->imposta_valore('surname',$utente->getCognome());
                $session->imposta_valore('password',$utente->getPassword());
                $session->imposta_valore('timeout',time());
                return true;
            }
            else $this->_errore='Username o password errati';
        }
        else $this->_errore='L\'account non esiste';

        return false;
    }
    /**
     * Crea un utente sul database controllando che non esista già
     *
     * @return mixed
     */
    public function creaUtente() {
        $view=USingleton::getInstance('VRegistrazione');
        $dati_registrazione=$view->getDatiRegistrazione();
        $utente=new EUtente();
        $FUtente=new FUtente();
        $result = $FUtente->load($dati_registrazione['username']);
        $registrato=false;
        if ($result==false) {
            if($dati_registrazione['password_1']==$dati_registrazione['password']) {
                unset($dati_registrazione['password_1']);
                $keys=array_keys($dati_registrazione);
                $i=0;
                foreach ($dati_registrazione as $dato) {
                    $utente->$keys[$i]=$dato;
                    $i++;
                }
                $FUtente->store($utente);
                $registrato=true;
                $path="profileimages/".$dati_registrazione['username'];
                $path2="profileimages/defaultttt";
                copy($path2,$path);
            } else {
                $this->_errore='Error: Passwords dont match!';
            }
        } else {
            $this->_errore='Error: Username already used!';
        }
        if (!$registrato) {
            $view->impostaDati('errore',$this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('registrazione');
            $result.=$view->processaTemplate();
            $view->impostaDati('errore','');
            return $result;
        } else {
            $view->setLayout('conferma');
            return $view->processaTemplate();
        }
    }
    /**
     * Mostra il modulo di registrazione
     *
     * @return string
     */
    public function moduloRegistrazione() {
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        if($this->getUtenteRegistrato()==0){
            $VRegistrazione->setLayout('registrazione');
        }
        else{
            $this->_avviso='You can\'t go to the registration page if you are logged in!';
            $VRegistrazione->impostaDati('avviso',$this->_avviso);
            $VRegistrazione->setLayout('default');
        }
        return $VRegistrazione->processaTemplate();
    }
    /**
     * Mostra la pagina delle Frequently Asked Questions
     *
     * @return string
     */
    public function moduloFAQ() {
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('FAQ');
        return $VRegistrazione->processaTemplate();
    }
    /**
     * Mostra la pagina per contattare l'amministratore
     *
     * @return string
     */
    public function modulocontatta() {
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('contattaci');
        return $VRegistrazione->processaTemplate();
    }
    /**
     * Mostra il modulo di login
     *
     * @return string
     */
    public function moduloLogin() {
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        if($this->_session_checker==true){
            $this->_errore='Session expired! Please login again!';
            $VRegistrazione->impostaDati('avviso',$this->_errore);
            $this->_session_checker=false;
        }
        if($this->getUtenteRegistrato()==0){
            $VRegistrazione->setLayout('moduloLogin');
        }
        else{
            $this->_avviso='You can\'t go to the login page if you are logged in!';
            $VRegistrazione->impostaDati('avviso',$this->_avviso);
            $VRegistrazione->setLayout('default');
        }
        return $VRegistrazione->processaTemplate();
    }
    /**
     * Effettua il logout
     *
     * @return string
     */
    public function logout() {
        $session = USingleton::getInstance('USession');
        $session->cancella_valore('username');
        $session->cancella_valore('nome_cognome');
        $session->cancella_valore('password');
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $this->_avviso='Logged out correctly!';
        $VRegistrazione->impostaDati('avviso',$this->_avviso);
        $VRegistrazione->setLayout('default');
        return $VRegistrazione->processaTemplate();
    }
    /**
     * Reindirizza alla home dopo il login
     *
     * @return string
     */
    public function reindirizza() {
        $view = USingleton::getInstance('VRegistrazione');
        if($this->getUtenteRegistrato()){
            $this->_avviso='Logged in correctly!';
            $view->impostaDati('avviso',$this->_avviso);
            $view->impostaDati('loggato',true);
            $view->setLayout('default');
            return $view->processaTemplate();
        }
        else if($this->getUtenteRegistrato()==false){
            $this->_errore='User and password dont match!';
            $view->impostaDati('errore',$this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('moduloLogin');
            $result.=$view->processaTemplate();
            $view->impostaDati('errore','');
            return $result;
        }
    }
    /**
     * Reindirizza alla home quando viene cliccato un tasto che porta alla homepage
     *
     * @return string
     */
    public function goHome(){
        $view=new VRegistrazione();
        if($this->getUtenteRegistrato()){
            $view->impostaDati('avviso','');
            $view->impostaDati('loggato',true);
            $view->setLayout('default');
            return $view->processaTemplate();
        }
        else {
            $view->setLayout('default');
            return $view->processaTemplate();
        }
    }
    /**
     * Set della variabile _session_checker che serve a controllare se la sessione è scaduta
     */
    public function setSessionExpired(){
        $this->_session_checker=true;
    }
    /**
     * Smista le richieste ai relativi metodi della classe
     *
     * @return mixed
     */
    public function smista() {
        $view = USingleton::getInstance('VRegistrazione');
        switch ($view->getTask()) {
            case 'contatta':
                return $this->modulocontatta();
            case 'faq':
                return $this->moduloFAQ();
            case 'login':
                return $this->moduloLogin();
            case 'registra':
                return $this->moduloRegistrazione();
            case 'salva':
                return $this->creaUtente();
            case 'esci':
                return $this->logout();
            case 'autentica':
                return $this->reindirizza();
            default:
                return $this->goHome();
        }
    }

}