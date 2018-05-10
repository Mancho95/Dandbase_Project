<?php
/**
 * @access public
 * @package Controller
 */
class CUtente {
    /**
     * @var string $_errore
     */
    private $_errore = '';
    /**
     * Setta il valore della variabile $_errore, utilizzato in CHome per prendere gli errori da index.php
     *
     * @param string $errore
     */
    public function setErrore($errore){
        $this->_errore=$errore;
    }
    /**
     * Mostra il profilo dell'utente loggato
     *
     * @return string
     */
    public function mostra() {
        $view = USingleton::getInstance('VUtente');
        if($this->_errore==true)
           $view->impostaDati('errore',$this->_errore);
        $FAvventura = new FAvventura();
        $nomeutente=$view->getUsername();
        $view->setLayout('default');
        $view->impostaDati('username', $view->getUsername());
        $view->impostaDati('password', $view->getPassword());
        $view->impostaDati('mail', $view->getEmail());
        $avventura=$FAvventura->loadAvventure($nomeutente);
        $view->impostaDati('_adventures_list',$avventura);
        return $view->processaTemplate();
    }
    /**
     * Modifica la password dell'utente loggato, poi restituisce un template per avvertire dell'avvenuta/mancata modifica
     *
     * @return string
     */
    public function modificaPassword () {
        $view = USingleton::getInstance('VUtente');
        $modifiche = $view->getModifiche();
        if ($modifiche['old'] == $view->getPassword()){
            if ($modifiche['new'] == $modifiche['new_1']){
                $FUtente = new FUtente();
                //$utente = $FUtente->load($view->getUsername());
                $user=USingleton::getInstance('EUtente');
                $user->username=$view->getUsername();
                $user->password=$modifiche['new'];
                $user->nome=$view->getNome();
                $user->cognome=$view->getCognome();
                $user->email=$view->getEmail();
                $FUtente->update($user);
            }
            else $this->_errore = 'Passwords dont match!';
        }
        else $this->_errore = 'Wrong password';

        if ($this->_errore != '') {
            $view->impostaDati('errore',$this->_errore);
            $this->_errore='';
            $view->setLayout('cambiopw');
            $result=$view->processaTemplate();
            $view->impostaDati('errore','');
            return $result;
        }
        else {
            $view->impostaDati('errore','Password changed correctly!');
            $this->mostra();
            $view->setLayout('default');
            return $view->processaTemplate();
        }
    }
    /**
     * Modifica l'email dell'utente loggato, poi restituisce un template per avvertire dell'avvenuta/mancata modifica
     *
     * @return string
     */
    public function modificaMail () {
        $view = USingleton::getInstance('VUtente');
        $modifiche = $view->getModifiche();
        if ($modifiche['new'] == $modifiche['new_1']){
            $FUtente = new FUtente();
            //$utente = $FUtente->load($view->getUsername());
            $user=USingleton::getInstance('EUtente');
            $user->username=$view->getUsername();
            $user->password=$view->getPassword();
            $user->nome=$view->getNome();
            $user->cognome=$view->getCognome();
            $user->email=$modifiche['new'];
            $FUtente->update($user);
        }
        else $this->_errore = 'Emails dont match!';

        if ($this->_errore != '') {
            $view->impostaDati('errore',$this->_errore);
            $this->_errore='';
            $view->setLayout('cambioem');
            $result=$view->processaTemplate();
            $view->impostaDati('errore','');
            return $result;
        }
        else {
            $view->impostaDati('errore','Email changed correctly!');
            $this->mostra();
            $view->setLayout('default');
            return $view->processaTemplate();
        }
    }
    /**
     * Restituisce il form per modificare l'immagine del profilo
     *
     * @return string
     */
    public function profilepic() {
        $VUtente = USingleton::getInstance('VUtente');
        $VUtente->impostaDati('username', $VUtente->getUsername());
        $VUtente->setLayout('uploadimg');
        return $VUtente->processaTemplate();
    }
    /**
     * Restituisce il form per modificare la password
     *
     * @return string
     */
    public function changepw(){
        $VUtente=USingleton::getInstance('VUtente');
        $VUtente->setLayout('cambiopw');
        return $VUtente->processaTemplate();
    }
    /**
     * Restituisce il form per modificare l'email
     *
     * @return string
     */
    public function changeem(){
        $VUtente=USingleton::getInstance('VUtente');
        $VUtente->setLayout('cambioem');
        return $VUtente->processaTemplate();
    }
    /**
     * Smista le richieste ai vari metodi
     *
     * @return mixed
     */
    public function smista() {
        $view=USingleton::getInstance('VUtente');
        switch ($view->getTask()) {
            case 'changeimg':
                return $this->profilepic();
            case 'mostra':
                return $this->mostra();
            case 'changepw':
                return $this->changepw();
            case 'changeem':
                return $this->changeem();
            case 'modifica_password':
                return $this->modificaPassword();
            case 'modifica_mail':
                return $this->modificaMail();
        }
    }
}