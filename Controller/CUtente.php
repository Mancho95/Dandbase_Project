<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 11/08/17
 * Time: 16.39
 */

class CUtente {
    private $_errore = '';

    public function setErrore($errore){
        $this->_errore=$errore;
    }

    public function mostra() {
        $view = USingleton::getInstance('VUtente');
        if($this->_errore==true)
           $view->impostaErrore($this->_errore);
        $FUtente = new FUtente();
        $FAvventura = new FAvventura();
        $utente = $FUtente->load($view->getUsername());
        $nomeutente=$view->getUsername();
        $view->setLayout('default');
        $view->impostaDati('username', $utente->getUsername());
        $view->impostaDati('password', $utente->getPassword());
        $view->impostaDati('nome', $utente->getNome());
        $view->impostaDati('cognome', $utente->getCognome());
        $view->impostaDati('mail', $utente->getEmail());
        $avventura=$FAvventura->loadAvventure($nomeutente);
        $view->impostaAvventure($avventura);
        return $view->processaTemplate();
    }


    public function modificaPassword () {
        $view = USingleton::getInstance('VUtente');
        $modifiche = $view->getModifiche();
        if ($modifiche['old'] == $view->getPassword()){
            if ($modifiche['new'] == $modifiche['new_1']){
                $FUtente = new FUtente();
                $utente = $FUtente->load($view->getUsername());
                $user=USingleton::getInstance('EUtente');
                $user->username=$utente->getUsername();
                $user->password=$modifiche['new'];
                $user->nome=$utente->getNome();
                $user->cognome=$utente->getCognome();
                $user->email=$utente->getEmail();
                $FUtente->update($user);
            }
            else $this->_errore = 'Passwords dont match!';
        }
        else $this->_errore = 'Wrong password';

        if ($this->_errore != '') {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('cambiopw');
            $result=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        }
        else {
            $view->impostaErrore('Password changed correctly!');
            $this->mostra();
            $view->setLayout('default');
            return $view->processaTemplate();
        }

    }

    public function modificaMail () {
        $view = USingleton::getInstance('VUtente');
        $modifiche = $view->getModifiche();
        if ($modifiche['new'] == $modifiche['new_1']){
            $FUtente = new FUtente();
            $utente = $FUtente->load($view->getUsername());
            $user=USingleton::getInstance('EUtente');
            $user->username=$utente->getUsername();
            $user->password=$utente->getPassword();
            $user->nome=$utente->getNome();
            $user->cognome=$utente->getCognome();
            $user->email=$modifiche['new'];
            $FUtente->update($user);
        }
        else $this->_errore = 'Emails dont match!';

        if ($this->_errore != '') {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('cambioem');
            $result=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        }
        else {
            $view->impostaErrore('Email changed correctly!');
            $this->mostra();
            $view->setLayout('default');
            return $view->processaTemplate();
        }
    }

    public function profilepic() {
        $VUtente = USingleton::getInstance('VUtente');
        $VUtente->impostaDati('username', $_SESSION['username']);
        $VUtente->setLayout('uploadimg');
        return $VUtente->processaTemplate();
    }

    public function changepw(){
        $VUtente=USingleton::getInstance('VUtente');
        $VUtente->setLayout('cambiopw');
        return $VUtente->processaTemplate();
    }

    public function changeem(){
        $VUtente=USingleton::getInstance('VUtente');
        $VUtente->setLayout('cambioem');
        return $VUtente->processaTemplate();
    }

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