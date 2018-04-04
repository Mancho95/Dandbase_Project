<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
function __autoload($class_name) {
    switch ($class_name[0]) {
        case 'V':
            require_once ('View/'.$class_name.'.php');
            break;
        case 'F':
            require_once ('Foundation/'.$class_name.'.php');
            break;
        case 'E':
            require_once ('Entity/'.$class_name.'.php');
            break;
        case 'C':
            require_once ('Controller/'.$class_name.'.php');
            break;
        case 'U':
            require_once ('Foundation/Utility/'.$class_name.'.php');
    }
}

?>
