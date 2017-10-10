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
    public $valstatmod=-2;

    /*I metodi servono per restituire statmod e valstatmod che sono rispettivamente il nome della statistica modificata
    e il valore che va a modificare la statistica (non il modificatore)*/

    public function getStatisticaModificata(){
        return ($this->statmod);
    }
    public function getValoreStatistica(){
        return ($this->valstatmod);
    }
}