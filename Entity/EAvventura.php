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
     * @AttributeType mixed
     */
    public $advpic;
    /**
     * @AttributeType string
     */
    public $pictype;
}
?>