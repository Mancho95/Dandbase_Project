<?php
/**
 * @access public
 * @package Controller
 */
class CRicerca {
    /**
     * @var string $_errore
     */
    private $_errore = '';
    /**
     * @var string $support
     */
    private $support='';
    /**
     * Carica il modulo di ricerca di un avventura
     *
     * @return string
     */
    public function modulo(){
        $view=USingleton::getInstance('VRicerca');
        $view->setLayout('default');
        return $view->processaTemplate();
        }
    /**
     * Serve per impostare il valore support  utile a ricaricare l'avventura commentata
     *
     * @param $support
     */
    public function impostaSupport($support){
        $this->support=$support;
    }
    /**
     * Carica il modulo di visualizzazione dei risultati della ricerca di un avventura
     *
     * @return string
     */
    public function search(){
        $view=USingleton::getInstance('VRicerca');
        $view->setLayout('risultati');
        $param=$view->getDatiRicerca();
        $FAvventura = new FAvventura();
        $avventura=$FAvventura->loadRicerche($param);
        $view->impostaDati('_adventures_list',$avventura);
        return $view->processaTemplate();
    }
    /**
     * Carica il modulo di visualizzazione dell'avventura scelta
     *
     * @return string
     */
    public function show(){
        $view=USingleton::getInstance('VRicerca');
        $view->impostaDati('user',$view->getUsername());
        $view->setLayout('mostra');
        if($this->support==false)
            $param=$view->getDatiMostra();
        else{
            $param=$this->support;
            $this->support='';
            }
        $FCommento=new FCommento();
        $FUtente=new FUtente();
        $FAvventura = new FAvventura();
        $avventura=$FAvventura->loadMostra($param);
        $commento=$FCommento->loadCommenti($param);
        if($commento){
        foreach($commento as $c){
            $user=$FUtente->loadUser($c->username);
            $c->propic=$user[0]->propic;
            $c->pictype=$user[0]->pictype;
        }
        }
        $view->impostaDati('_adventures_list',$avventura);
        $view->impostaDati('_comments_list',$commento);
        $var=false;
        if($commento)
            $var=$this->getUpvotePercentage($commento);
        $view->impostaUpvote($var);
        return $view->processaTemplate();
    }
    /**
     * Aggiunge un commento all'avventura attuale
     *
     * @return string
     */
    public function addComment(){
        $view=USingleton::getInstance('VRicerca');
        $param=$view->getDatiCommento();
        $commento=new ECommento();
        $FCommento=new FCommento();
        $keys=array_keys($param);
        $i=0;
        $uploaded=false;
        if(isset($param['cod_avventura']) && isset($param['username']) && isset($param['testo']) && isset($param['upvote'])) {
            foreach ($param as $dato) {
                $commento->$keys[$i] = $dato;
                $i++;
            }
            unset($commento->pictype);
            unset($commento->propic);
            $FCommento->store($commento);
            $uploaded = true;
            $view->impostaDati('errore','Your comment was uploaded correctly!');
        }
        else $this->_errore='There are some empty fields, comment not uploaded';
        $this->support=$commento->cod_avventura;
        if (!$uploaded) {
            foreach ($param as $dato) {
                $commento->$keys[$i] = $dato;
                $i++;
            }
            $this->support=$commento->cod_avventura;
            $view->impostaDati('errore',$this->_errore);
            $this->_errore='';
            return $this->show();
        } else {
            return $this->show();
        }
    }
    /**
     * Calcola la percentuale degli upvote presenti tra i commenti
     *
     * @param array $var
     * @return float
     */
    public function getUpvotePercentage($var){
        $c=0;
        foreach ($var as $arr){
            if($arr->upvote==true){
                $c++;
            }
        }
        $result=($c/count($var))*100;
        $rounded=round($result,0);
        if($rounded==0){
            $rounded='&';
        }
        return $rounded;
    }
    /**
     * Carica un avventura randomica tra tutte le avventure presenti nel Database
     *
     * @return string
     */
    public function randomizeAdventure(){
        $view=USingleton::getInstance('VRicerca');
        $view->setLayout('mostra');
        $view->impostaDati('user',$view->getUsername());
        $FAvventura = new FAvventura();
        $FCommento = new FCommento();
        $FUtente=new FUtente();
        $avventura=$FAvventura->search();
        $n = array_rand($avventura, 1);
        $avventura2=$FAvventura->loadMostra($avventura[$n]->cod_avventura);
        $commento=$FCommento->loadCommenti($avventura[$n]->cod_avventura);
        foreach($commento as $c){
            $user=$FUtente->loadUser($c->username);
            $c->propic=$user[0]->propic;
            $c->pictype=$user[0]->pictype;
        }
        $view->impostaDati('_adventures_list',$avventura2);
        $view->impostaDati('_comments_list',$commento);
        $var=false;
        if($commento)
            $var=$this->getUpvotePercentage($commento);
        $view->impostaUpvote($var);
        return $view->processaTemplate();
    }
    /**
     * Smista le richieste ai vari metodi
     *
     * @return mixed
     */
    public function smista() {
        $view=USingleton::getInstance('VRicerca');
        switch ($view->getTask()) {
            case 'random':
                return $this->randomizeAdventure();
            case 'modulo':
                return $this->modulo();
            case 'ricerca':
                return $this->search();
            case 'mostra':
                return $this->show();
            case 'commenta':
                return $this->addComment();
        }
    }

}