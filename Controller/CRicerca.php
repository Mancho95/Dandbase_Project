<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 07/08/17
 * Time: 16.48
 */

class CRicerca {
    /**
     * @var int
     */
    private $_annunci_per_pagina=2;

    private $_errore = '';

    /**
     * Seleziona sul database i libri con id più alto e li mostra nella pagina principale
     *
     * @return string contenuto del template processato
     */
    /*public function ultimiArrivi() {
        $view = USingleton::getInstance('VRicerca');
        $this->_annunci_per_pagina=4;
        $FLibro=new FLibro();
        $limit=$view->getPage()*$this->_annunci_per_pagina.','.$this->_annunci_per_pagina;
        $num_risultati=count($FLibro->search());
        $pagine = ceil($num_risultati/$this->_annunci_per_pagina);
        $risultato=$FLibro->search(array(), '`ISBN` DESC', $limit);
        if ($risultato!=false) {
            $array_risultato=array();
            foreach ($risultato as $item) {
                $tmpLibro=$FLibro->load($item->ISBN);
                $array_risultato[]=array_merge(get_object_vars($tmpLibro),array('media_voti'=>$tmpLibro->getMediaVoti()));
            }
        }
        $view->impostaDati('pagine',$pagine);
        $view->impostaDati('task','ultimi_arrivi');
        $view->impostaDati('dati',$array_risultato);
        return $view->processaTemplate();
    }*/

    /**
     * Seleziona sul database i libri per mostrarli all'utente e li filtra
     * in base alle variabili passate
     * es categorie o stringhe di ricerca
     *
     * @return string
     */
    public function lista(){
        $view = USingleton::getInstance('VRicerca');
        $FCatalogo = new FCatalogo();
        $parametri = $view->getParola();
        $limit = $view->getPage()*$this->_annunci_per_pagina.','.$this->_annunci_per_pagina;
        $num_risultati=count($FCatalogo->search(array($parametri, '', ''))->getCatalogo());
        $pagine = ceil($num_risultati/$this->_annunci_per_pagina);
        $foo = array ($parametri, $view->getOrdinamento(), $limit);
        $risultato = $FCatalogo->search($foo)->getCatalogo(); //array di EAnnunci
        $view->impostaDati('pagine',$pagine);
        $view->impostaDati('task','cerca');
        $param = implode(",^,", $parametri); //stringa che verrà passata tra le pagine dei risultati
        $view->impostaDati('parametri','stringa='.$param);
        $view->impostaDati('dati',$risultato);
        $strumenti = $view->aggiungiStrumenti();
        $view->setLayout('lista');
        return $strumenti.$view->processaTemplate();
    }

    /**
     * Mostra i dettagli di un libro, con la descrizione completa, i commenti e il form per l'invio di commenti, solo per utenti registrati
     *
     * @return string
     */
    public function dettagli($oldAnnuncioID = null) {
        $view = USingleton::getInstance('VRicerca');
        if( !is_null($oldAnnuncioID))
            $id_annuncio = $oldAnnuncioID;
        else
            $id_annuncio = $view->getIdAnnuncio();
        $FAnnuncio = new FAnnuncio();
        $dati = $FAnnuncio->load($id_annuncio)->getObjectVars();
        $dati['acquirente'] = $view->getUsername();
        $view->setLayout('dettagli');
        $view->impostaDati('dati',$dati);
        return $view->processaTemplate();
    }

    /**
     * Mostra gli annunci dell'utente registrato
     * @return mixed
     */
    public function mieiAnnunci() {
        $view = USingleton::getInstance('VRicerca');
        $FCatalogo = new FCatalogo();
        $dati = $FCatalogo->iMieiAnnunci($view->getUsername())->getCatalogo();
        $view->setLayout('mieiAnnunci');
        $view->impostaDati('dati',$dati);
        return $view->processaTemplate();
    }

    /**
     * Inserisce un commento nel database collegandolo al relativo libro
     *
     * @return string
     */
    /*public function inserisciCommento() {
        $session=USingleton::getInstance('USession');
        $username=$session->leggi_valore('username');
        if ($username!=false) {
            $view = USingleton::getInstance('VRicerca');
            $ECommento = new ECommento();
            $ECommento->libroISBN=$view->getIdLibro();
            $ECommento->voto=$view->getVoto();
            $ECommento->testo=$view->getCommento();
            $FCommento=new FCommento();
            $FCommento->store($ECommento);
            return $this->dettagli();
        }
    }*/

    public function nuovoAnnuncio() {
        $view = USingleton::getInstance('VRicerca');
        $FAnnuncio = new FAnnuncio();
        $FLibro = new FLibro();
        if ($FLibro->load($view->getIsbn) != false) {
            $FAnnuncio->store(array('', date("d-m-y"), $view->getIsbn(), $view->getUsername(), $view->getCorso(),
                $view->getCittà(), $view->getSpedisce(), $view->getDescrizione(), $view->getCondizione(), $view->getFoto(), $view->getPrezzo()));
        }
        else $this->_errore = 'Isbn non trovato, controllare i dati immessi';

        if ($this->_errore != '') {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('modulo');
            $result.=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        }
        else {
            $view->setLayout('conferma_creazione');
            return $view->processaTemplate();
        }
    }

    public function modulo(){
        $view=USingleton::getInstance('VRicerca');
        $view->setLayout('default');
        return $view->processaTemplate();
        }

    public function search(){
        $view=USingleton::getInstance('VRicerca');
        $view->setLayout('risultati');
        $param=$view->getDatiRicerca();
        $FAvventura = new FAvventura();
        $avventura=$FAvventura->loadRicerche($param);
        $view->impostaAvventure($avventura);
        return $view->processaTemplate();
    }

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

    public function randomizeAdventure(){
        $view=USingleton::getInstance('VRicerca');
        $view->setLayout('mostra');
        $view->impostaAdmin($_SESSION['username']);
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
            case 'dettagli':
                return $this->dettagli();
            case 'cerca':
                return $this->lista();
            case 'miei_annunci':
                return $this->mieiAnnunci();
        }
    }

}