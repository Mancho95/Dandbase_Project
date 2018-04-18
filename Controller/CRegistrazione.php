<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 06/08/17
 * Time: 12.09
 */

class CRegistrazione {

    /**
     * @var string $_errore
     */
    private $_errore='';

    private $_avviso='';

    public $_check=false;

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
            //var_dump($session->leggi_valore('username'));
            //autenticato
        } elseif ($task == 'autentica' && $controller == 'registrazione') {
            //controlla autenticazione
            $autenticato = $this->autentica($this->_username, $this->_password);
        }
        if ($task == 'esci' && $controller == 'registrazione') {
            //logout
            $this->logout();
            $autenticato = false;
        }
        $VRegistrazione->impostaErrore($this->_errore);
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
        $view=USingleton::getInstance('VRegistrazione');
        if ($utente != false) {
            if ($username == $utente->getUsername() && $password == $utente->getPassword()) {
                $session = USingleton::getInstance('USession');
                $session->imposta_valore('username',$username);
                $session->imposta_valore('nome_cognome',$utente->getNome().' '.$utente->getCognome());
                $session->imposta_valore('timeout',time());
                return true;
            }
            else $this->_errore='Username o password errati';//username password errati
        }
        else $this->_errore='L\'account non esiste'; //account non esiste

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
            //utente non esiste
            if($dati_registrazione['password_1']==$dati_registrazione['password']) {
                unset($dati_registrazione['password_1']);
                $keys=array_keys($dati_registrazione);
                $i=0;
                foreach ($dati_registrazione as $dato) {
                    $utente->$keys[$i]=$dato;
                    $i++;
                }
                //$utente->generaCodiceAttivazione();
                //var_dump($utente);
                $FUtente->store($utente);
                //$this->emailAttivazione($utente);
                $registrato=true;
            } else {
                $this->_errore='Error: Passwords dont match!';
            }
        } else {
            //utente esistente
            $this->_errore='Error: Username already used!';
        }
        if (!$registrato) {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('registrazione');
            $result.=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        } else {
            $view->setLayout('conferma');
            return $view->processaTemplate();
        }
    }

    /**
     * Invia un email contenente il codice di attivazione per un utente appena registrato
     *
     * @global array $config
     * @param EUtente $utente
     * @return boolean
     */
    /*public function emailAttivazione(EUtente $utente) {
        global $config;
        $view=USingleton::getInstance('VRegistrazione');
        $view->setLayout('email_attivazione');
        $view->impostaDati('username',$utente->username);
        $view->impostaDati('nome_cognome',$utente->nome.' '.$utente->cognome);
        $view->impostaDati('codice_attivazione',$utente->getCodiceAttivazione());
        $view->impostaDati('email_webmaster',$config['email_webmaster']);
        $view->impostaDati('url',$config['url_bookstore']);
        $corpo_email=$view->processaTemplate();
        $email=USingleton::getInstance('UEmail');
        return $email->invia_email($utente->email,$utente->nome.' '.$utente->cognome,'Attivazione account bookstore',$corpo_email);
    }*/

    /**
     * Attiva un utente che inserisce un codice di attivazione valido oppure clicca sul link di autenticazione nell'email
     *
     * @return string
     */
    /*public function attivazione() {
        $view = USingleton::getInstance('VRegistrazione');
        $dati_attivazione=$view->getDatiAttivazione();
        $FUtente=new FUtente();
        $utente=$FUtente->load($dati_attivazione['username']);
        if ($dati_attivazione!=false) {
            if ($utente->getCodiceAttivazione()==$dati_attivazione['codice']) {
                $utente->stato='attivo';
                $FUtente->update($utente);
                $view->setLayout('conferma_attivazione');
            } else {
                $view->impostaErrore('Il codice di attivazione &egrave; errato');
                $view->setLayout('problemi');
            }
        } else {
            $view->setLayout('attivazione');
        }
        return $view->processaTemplate();
    }*/

    /**
     * Mostra il modulo di registrazione
     *
     * @return string
     */
    public function moduloRegistrazione() {
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('registrazione');
        return $VRegistrazione->processaTemplate();
    }

    public function moduloFAQ() {
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('FAQ');
        return $VRegistrazione->processaTemplate();
    }

    public function modulocontatta() {
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('contattaci');
        return $VRegistrazione->processaTemplate();
    }

    public function modulologgato() {
        $VRegistrazione = USingleton::getInstance('VUtente');
        $VRegistrazione->setLayout('default');
        return $VRegistrazione->processaTemplate();
    }
    /**
     * Mostra il modulo di login
     *
     * @return string
     */
    public function moduloLogin() {
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $VRegistrazione->setLayout('moduloLogin');
        if( isset($_REQUEST['idAnnuncio']) )
            $VRegistrazione->impostaDati('annuncio',$_REQUEST['idAnnuncio']);
        return $VRegistrazione->processaTemplate();
    }

    /**
     * Effettua il logout
     */
    public function logout() {
        $session = USingleton::getInstance('USession');
        $session->cancella_valore('username');
        $session->cancella_valore('nome_cognome');
        $VRegistrazione = USingleton::getInstance('VRegistrazione');
        $this->_check=false;
        $VRegistrazione->setLayout('logout');
        return $VRegistrazione->processaTemplate();
    }

    /**
     * Reindirizza alla home, o all'url dell'annuncio precedente il login
     */
    public function reindirizza() {
        $view = new VRegistrazione();;
        if ( $view->getAnnuncioOldURL() ){
            $view = new VRegistrazione();
            $oldAnnuncioID = $view->getAnnuncioOldURL();
            return CRicerca::dettagli($oldAnnuncioID);  // reindirizza all'annuncio visualizzato prima del login
        }
        else if($this->getUtenteRegistrato()){
            $this->_avviso='Logged in correctly!';
            $view->impostaAvviso($this->_avviso);
            $view->setLayout('loggato');
            return $view->processaTemplate(); // home
        }
        else if($this->getUtenteRegistrato()==false){
            $this->_errore='User and password dont match!';
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('moduloLogin');
            $result.=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        }



    }

    public function goHome(){
        $view=new VRegistrazione();
        if($this->getUtenteRegistrato()){
            $view->impostaAvviso('');
            $view->setLayout('loggato');
            return $view->processaTemplate();
        }
        else {
            $view->setLayout('default');
            return $view->processaTemplate();
        }
    }

    /**
     * Set dell'errore (usato solo da CHome quando la sessione è scaduta
     */
    public function setErrore($errore) {
        $view = USingleton::getInstance('VRegistrazione');
        $view->impostaErrore($errore);
        $this->_errore = '';
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