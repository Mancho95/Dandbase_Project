<?php

/**
 * @access public
 * @package Entity
 */
class EAvventura
{
    /**
     * @AssociationType Entity.EUtente
     * @AssociationMultiplicity 1
     */
    public $username;
    /**
     * @AttributeType string
     */
    public $nome;
    /**
     * @AttributeType string
     */
    public $descrizione;
    /**
     * @AttributeType string
     */
    public $versione;
    /**
     * @AttributeType string
     */
    public $file;
    /**
     * @AssociationType Entity.ECommento
     * @AssociationMultiplicity 0..*
     * @AssociationKind aggregation
     */
    public $_comments=array();

    /** Set dell'utente che ha creato l'avventura
     * @access public
     * @param $creator EUtente
     */
    public function setUser(EUtente $creator){
        $this->_user=$creator;
    }
    /** Ritorna l'utente che ha creato l'avventura
     * @access public
     * @return EUtente
     */
    public function getUser(){
        return $this->_user;
    }
    /** Aggiunge un commento all'avventura
     * @access public
     * @param $comment ECommento
     */
    public function addComment(ECommento $comment) {
        array_push($this->_comments, $comment);
    }
    /** Ritorna un array con i commenti relativi all'avventura
     * @access public
     * @return array()
     */
    public function getComments() {
        return ($this->_comments);
    }
    /** Ritorna una stringa contenente il valore in percentuale di upvote
     * @access public
     * @return string
     */
    public function getUpvotePercentage(){
        $up_n=0;
        $preferences=count($this->_comments);
        if($preferences>0) {
            foreach ($this->_comments as $comment) {
                if ($comment->preference == true) {
                    $up_n++;
                }
            }
            return floor(($up_n/$preferences)*100).'%';
        }
        else
            return $up_n.'%';
    }
    /** Set dell'avventura su approvata
     * @access public
     */
    public function setApproved(){
        $this->approved=true;
    }
}
?>