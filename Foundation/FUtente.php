<?php
/**
 * @access public
 * @package Foundation
 */
class FUtente extends Fdb{
    public function __construct() {
        $this->_table='utente';
        $this->_key='username';
        $this->_return_class='EUtente';
        USingleton::getInstance('Fdb');
    }
}

?>
