<?php

/**
 * @access public
 * @package Entity
 */
class EUtente
{
    /**
     * @AttributeType string
     */
    public $nome;
    /**
     * @AttributeType string
     */
    public $cognome;
    /**
     * @AttributeType string
     */
    public $username;
    /**
     * @AttributeType string
     */
    public $password;
    /**
     * @AttributeType string
     */
    public $email;
    /**
     * @AssociationType Entity.EAvventura
     * @AssociationMultiplicity 0..*
     * @AssociationKind Aggregation
     */
    public $_adventures=array();

    /** Aggiunge un avventura all'utente
     * @access public
     * @param $newAvventura EAvventura
     */
    public function addAdventure(EAvventura $newAvventura){
        $this->_adventures[]=$newAvventura;
    }
    /** Ritorna un array contentente tutte le avventure pubblicate dall'utente
     * @access public
     * @return array()
     */
    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCognome(){
        return $this->cognome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getAdventure(){
        return $this->_adventures;
    }
    /** Genera il codice di attivazione dell'account
     * @access public
     */
    public function generateRandomCode() {
        $this->activation_code=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(20/strlen($x)) )),1,20);
    }
    /** Ritorna il codice di attivazione dell'account
     * @access public
     * @return string
     */
    public function getActivationCode(){
        return $this->activation_code;
    }
    /** Ritorna il boolean relativo all'attivazione dell'account
     * @access public
     * @return boolean
     */
    public function getActiveAccount(){
        return $this->activation;
    }
}
?>
