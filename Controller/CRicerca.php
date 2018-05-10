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
        $view->impostaAvventure($avventura);
        return $view->processaTemplate();
    }
    /**
     * Carica il modulo di visualizzazione dell'avventura scelta
     *
     * @return string
     */
    public function show(){
        $view=USingleton::getInstance('VRicerca');
        $view2=USingleton::getInstance('VUtente');
        $view->impostaAdmin($_SESSION['username']);
        $nick=$view2->getUsername();
        $view->impostaUsername($nick);
        $view->setLayout('mostra');
        $param=$view->getDatiMostra();
        $FCommento=new FCommento();
        $FAvventura = new FAvventura();
        $avventura=$FAvventura->loadMostra($param);
        $commento=$FCommento->loadCommenti($param);
        $view->impostaAvventure($avventura);
        $view->impostaCommenti($commento);
        $var=false;
        if($commento)
            $var=$this->getUpvotePercentage($commento);
        $view->impostaUpvote($var);
        return $view->processaTemplate();
    }
    /**
     * Carica il modulo di visualizzazione dell'avventura attuale dopo aver commentato
     *
     * @param string $support
     * @return string
     */
    public function showaftercomment($support){
        $view=USingleton::getInstance('VRicerca');
        $view2=USingleton::getInstance('VUtente');
        $view->impostaAdmin($_SESSION['username']);
        $nick=$view2->getUsername();
        $view->impostaUsername($nick);
        $view->setLayout('mostra');
        $param=$support;
        $FCommento=new FCommento();
        $FAvventura = new FAvventura();
        $avventura=$FAvventura->loadMostra($param);
        $commento=$FCommento->loadCommenti($param);
        $view->impostaAvventure($avventura);
        $view->impostaCommenti($commento);$var=false;
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
            $FCommento->store($commento);
            $uploaded = true;
            $view->impostaCommentato();
        }
        else $this->_errore='There are some empty fields, comment not uploaded';
        $support=$commento->cod_avventura;
        if (!$uploaded) {
            foreach ($param as $dato) {
                $commento->$keys[$i] = $dato;
                $i++;
            }
            $support=$commento->cod_avventura;
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            return $this->showaftercomment($support);
        } else {
            return $this->showaftercomment($support);
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
        $view->impostaAdmin($_SESSION['username']);
        $view->impostaUsername($_SESSION['username']);
        $FAvventura = new FAvventura();
        $FCommento = new FCommento();
        $avventura=$FAvventura->search();
        $n = array_rand($avventura, 1);
        $avventura2=$FAvventura->loadMostra($avventura[$n]->cod_avventura);
        $commento=$FCommento->loadCommenti($avventura[$n]->cod_avventura);
        $view->impostaAvventure($avventura2);
        $view->impostaCommenti($commento);$var=false;
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