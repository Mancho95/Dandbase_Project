<?php

/**
 * Created by PhpStorm.
 * User: xamnoch
 * Date: 04/10/17
 * Time: 18.11
 */
class EEquipaggiamento
{
    public $nome;
    public $tipo;
    public $statmod='forza';
    public $valstatmod=4;

    public function getStatisticaModificata(){
        return ($this->statmod);
    }
    public function getValoreStatistica(){
        return ($this->valstatmod);
    }
}