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
     * Restituisce il valore della variabile Username dell'entità EUtente
     *
     * @return string
     */
    public function getUsername ()
    {
        return $this->username;
    }
    /**
     * Restituisce il valore della variabile Password dell'entità EUtente
     *
     * @return string
     */
    public function getPassword ()
    {
        return $this->password;
    }
    /**
     * Restituisce il valore della variabile Nome dell'entità EUtente
     *
     * @return string
     */
    public function getNome ()
    {
        return $this->nome;
    }
    /**
     * Restituisce il valore della variabile Cognome dell'entità EUtente
     *
     * @return string
     */
    public function getCognome ()
    {
        return $this->cognome;
    }
    /**
     * Restituisce il valore della variabile Email dell'entità EUtente
     *
     * @return string
     */
    public function getEmail ()
    {
        return $this->email;
    }
}
?>
