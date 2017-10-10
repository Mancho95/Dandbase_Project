<?php

class EPersonaggio
{
    public $nomepg;
    public $classepg;
    public $livello;
    public $puntiferita;
    public $forza=10;
    public $destrezza;
    public $saggezza;
    public $costituzione;
    public $intelligenza;
    public $carisma;
    public $_equipaggiamento=array();

    /*I metodi che iniziano per get (a parte i metodi getMod) sono tutti dei getters classici che ritornano
    il valore per cui sono stati creati.*/

    public function getPuntiFerita(){
        return($this->puntiferita);
    }

    public function getLivello(){
        return($this->livello);
    }

    public function getForza(){
        return ($this->forza);
    }

    /* A cosa servono i metodi: getModNomestatistica()
     Prendo il valore della statistica e li trasformo nel modificatore. Il modificatore è
    -5 per 0
    -5 per 1
    -4 per 2
    -4 per 3
    -3 per 4
    -3 per 5
    ...
    0 per 10
    0 per 11
    1 per 12
    1 per 13
    2 per 14
    2 per 15
    ...
    E cosi via. Il valore della statistica deve essere minimo 0 e non ha un limite massimo. In pratica ogni
    due punti ottengo un punto al modificatore statistica. Se il valore della statistica è meno di 0 lancio
    un'eccezione che verrà successivamente gestita. Tutti i metodi getModNomestatistica() sono funzioni
    utili a trasformare il valore della statistica e ritornare il valore del modificatore associato.*/

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

    /*Il metodo addEquipaggiamento() prende come parametro un oggetto della classe equipaggiamento e lo inserisce
    nell'array $_equipaggiamento che conterrà tutti gli equipaggiamenti associati al personaggio.*/

    public function addEquipaggiamento(EEquipaggiamento $equipaggiamento){
        array_push($this->_equipaggiamento, $equipaggiamento);
    }

    /*Il metodo getEquipaggiamento() è il getter dell'array $_equipaggiamento.*/

    public function getEquipaggiamento(){
        return($this->_equipaggiamento);
    }

    /*Il metodo equipaggia() si occupa di modificare il valore della statistica in base a cosa abbiamo equipaggiato
    la prima parte è utile se ci sono più elementi nell'array $_equipaggiamento, la seconda parte serve se nell'array
    c'è solo un elemento. Lancia un'eccezione quando l'equipaggiamento inserito ha un valore alla statistica minore di
    0, che come per i personaggi, non puù verificarsi. Il valore minimo della statistica dell'equip deve essere almeno 0*/

    public function equipaggia(){
        if(count($this->_equipaggiamento)>1){
            foreach($this->_equipaggiamento as $equip) {
                $statmod = $equip->getStatisticaModificata();
                if ($this->$equip->getValoreStatistica() < 0) {
                    throw new Exception("$statmod value should be minimum 0.");
                } else {
                    $this->$statmod = $this->$statmod + $equip->getValoreStatistica();
                }
            }
        }
        elseif(isset($this->_equipaggiamento[0])){
            $statmod=$this->_equipaggiamento[0]->getStatisticaModificata();
            if($this->_equipaggiamento[0]->getValoreStatistica() < 0) {
                throw new Exception("$statmod value should be minimum 0.");
            } else {
                $this->$statmod=$this->$statmod+$this->_equipaggiamento[0]->getValoreStatistica();
            }
        }
    }
}