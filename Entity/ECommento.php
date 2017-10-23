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
    public $id;
    /**
     * @AttributeType string
     */
    public $text;
    /**
     * @AttributeType string
     */
    public $preference;
    /**
     * @AssociationType Entity.EUtente
     * @AssociationMultiplicity 1
     */
    public $_user;

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