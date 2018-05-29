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
    public $cod_commento;
    /**
     * @AssociationType Entity.EAvventura
     * @AssociationMultiplicity 1
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
    /**
     * @AssociationType Entity.EUtente
     * @AssociationMultiplicity 1
     */
    public $propic;
    /**
     * @AssociationType Entity.EUtente
     * @AssociationMultiplicity 1
     */
    public $pictype;
}
?>