<?php

class EPersonaggio
{
    public $nomepg;
    public $classepg;
    public $livello;
    public $puntiferita;
    public $forza;
    public $destrezza;
    public $saggezza;
    public $costituzione;
    public $intelligenza;
    public $carisma;
    public $_equipaggiamento=array();

    public function getPuntiFerita(){
        return($this->puntiferita);
    }

    public function getLivello(){
        return($this->livello);
    }

    public function getForza(){
        return ($this->forza);
    }

    public function getModForza()
    {
        if ($this->forza < 0) {
            throw new Exception('Strenght value should be minimum 0.');
        } else {
            $modfor = $this->forza / 2;
            $modfor = floor($modfor) - 5;
            return ($modfor);
        }
    }

    public function getDestrezza(){
        return ($this->destrezza);
    }

    public function getModDestrezza()
    {
        if ($this->destrezza < 0) {
            throw new Exception('Dexterity value should be minimum 0.');
        } else {
            $moddes = $this->destrezza / 2;
            $moddes = floor($moddes) - 5;
            return ($moddes);
        }
    }

    public function getSaggezza(){
        return ($this->saggezza);
    }

    public function getModSaggezza()
    {
        if ($this->saggezza < 0) {
            throw new Exception('Wisdom value should be minimum 0.');
        } else {
            $modsag = $this->saggezza / 2;
            $modsag = floor($modsag) - 5;
            return ($modsag);
        }
    }

    public function getCostituzione(){
        return ($this->costituzione);
    }

    public function getModCostituzione()
    {
        if ($this->costituzione < 0) {
            throw new Exception('Constitution value should be minimum 0.');
        } else {
            $modcos = $this->costituzione / 2;
            $modcos = floor($modcos) - 5;
            return ($modcos);
        }
    }

    public function getIntelligenza(){
        return ($this->intelligenza);
    }

    public function getModIntelligenza()
    {
        if ($this->intelligenza < 0) {
            throw new Exception('Intelligence value should be minimum 0.');
        } else {
            $modint = $this->intelligenza / 2;
            $modint = floor($modint) - 5;
            return ($modint);
        }
    }

    public function getCarisma(){
        return ($this->carisma);
    }

    public function getModCarisma()
    {
        if ($this->carisma < 0) {
            throw new Exception('Charisma value should be minimum 0.');
        } else {
            $modcar = $this->carisma / 2;
            $modcar = floor($modcar) - 5;
            return ($modcar);
        }
    }

    public function addEquipaggiamento(EEquipaggiamento $equipaggiamento){
        array_push($this->_equipaggiamento, $equipaggiamento);
    }

    public function getEquipaggiamento(){
        return($this->_equipaggiamento);
    }

    public function equipaggia(){
        if(count($this->_equipaggiamento)>1){
            foreach($this->_equipaggiamento as $equip) {
                $statmod = $equip->getStatisticaModificata();
                if ($this->$equip->getValoreStatistica < 0) {
                    throw new Exception("$statmod value should be minimum 0.");
                } else {
                    $this->$statmod = $this->$statmod + $equip->getValoreStatistica();
                }
            }
        }
        elseif(isset($this->_equipaggiamento[0])){
            $statmod=$this->_equipaggiamento[0]->getStatisticaModificata();
            if($this->_equipaggiamento[0]->getValoreStatistica < 0) {
                throw new Exception("$statmod value should be minimum 0.");
            } else {
                $this->$statmod=$this->$statmod+$this->_equipaggiamento[0]->getValoreStatistica();
            }
        }
    }
}