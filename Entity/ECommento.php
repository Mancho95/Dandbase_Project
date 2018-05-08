<?php

/**
 * @access public
 * @package Entity
 */

class ECommento
{
    /**
     * @AttributeType int
     */
    public $cod_avventura;
    /**
     * @AttributeType string
     */
    public $testo;
    /**
     * @AttributeType bool
     */
    public $upvote;
    /**
     * @AssociationType Entity.EUtente
     * @AssociationMultiplicity 1
     */
    public $username;

    /** Set dell'utente che ha commentato
     * @access public
     * @param $creator EUtente
     */
    public function setUser(EUtente $creator){
        $this->_user=$creator;
    }
    /** Ritorna l'utente che ha commentato
     * @access public
     * @return EUtente
     */
    public function getUser(){
        return $this->_user;
    }
}
?>