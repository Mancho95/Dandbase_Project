<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 11/08/17
 * Time: 16.39
 */

class CUtente {
    private $_errore = '';

    public function mostra() {
        $view = USingleton::getInstance('VUtente');
        $FUtente = new FUtente();
        $utente = $FUtente->load($view->getUsername());
        $view->setLayout('default');
        $view->impostaDati('username', $utente->getUsername());
        $view->impostaDati('password', $utente->getPassword());
        $view->impostaDati('nome', $utente->getNome());
        $view->impostaDati('cognome', $utente->getCognome());
        $view->impostaDati('mail', $utente->getEmail());
        return $view->processaTemplate();
    }

    public function modificaPassword () {
        $view = USingleton::getInstance('VUtente');
        $modifiche = $view->getModifiche();
        if ($modifiche['old'] == $view->getPassword()){
            if ($modifiche['new'] == $modifiche['new_1']){
                $FUtente = new FUtente();
                $utente = $FUtente->load($view->getUsername());
                $FUtente->update(array($utente->getUsername, $modifiche['new'], $utente->getTipologiaUtente(), $utente->getNome(),
                    $utente->getCognome(), $utente->getEmail(), $utente->getStato()));
            }
            else $this->_errore = 'Le password non coincidono';
        }
        else $this->_errore = 'Password sbagliata';

        if ($this->_errore != '') {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('modPassword');
            $result.=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        }
        else {
            $view->setLayout('conferma');
            return $view->processaTemplate();
        }

    }

    public function modificaMail () {
        $view = USingleton::getInstance('VUtente');
        $modifiche = $view->getModifiche();
        if ($modifiche['new'] == $modifiche['new_1']){
            $FUtente = new FUtente();
            $utente = $FUtente->load($view->getUsername());
            $FUtente->update(array($utente->getUsername, $utente->getPassword(), $utente->getTipologiaUtente(), $utente->getNome(),
                $utente->getCognome(), $modifiche['new'], $utente->getStato()));
        }
        else $this->_errore = 'Le mail non coincidono';

        if ($this->_errore != '') {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('modMail');
            $result.=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        }
        else {
            $view->setLayout('conferma');
            return $view->processaTemplate();
        }
    }

    public function smista() {
        $view=USingleton::getInstance('VUtente');
        switch ($view->getTask()) {
            case 'mostra':
                return $this->mostra();
            case 'modifica_password':
                return $this->modificaPassword();
            case 'modifica_mail':
                return $this->modificaMail();
        }
    }

}