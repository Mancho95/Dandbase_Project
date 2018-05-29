<?php
/**
 * @access public
 * @package Controller
 */
class CUpload {
    /**
     * @var string $_errore
     */
    private $_errore='';
    /**
     * Setta il valore della variabile $_errore, utilizzato in CHome per prendere gli errori da index.php
     *
     * @param string $errore
     */
    public function setErrore($errore){
        $this->_errore=$errore;
    }
    /**
     * Crea un avventura sul database, controllando che il form di caricamento sia completo
     *
     * @return mixed
     */
    public function creaAvventura() {
        $view=USingleton::getInstance('VUpload');
        $dati_avventura=$view->getDatiAvventura();
        $img=$view->getPic();
        $tipiconsentiti=array('image/png','image/jpg','image/jpeg','image/gif');
        $avventura=new EAvventura();
        $FAvventura=new FAvventura();
        $keys=array_keys($dati_avventura);
        $i=0;
        $uploaded=false;
        $count=array_filter($dati_avventura);
        if($img['tmp_name']!=false) {
            if (in_array($img['type'], $tipiconsentiti)) {
                if (count($dati_avventura) == count($count)) {
                    foreach ($dati_avventura as $dato) {
                        $avventura->$keys[$i] = $dato;
                        $i++;
                    }
                    $img2 = file_get_contents($img['tmp_name']);
                    $img2 = base64_encode($img2);
                    $avventura->advpic = $img2;
                    $avventura->pictype = $img['type'];
                    $FAvventura->store($avventura);
                    $uploaded = true;
                } else $this->_errore = 'There are some empty fields';
            }
            else {
                $this->_errore = 'The file is not an image';
            }
        }
        else{
            $this->_errore='You must upload an image!';
        }
        if (!$uploaded) {
            $view->impostaDati('errore',$this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('default');
            $result.=$view->processaTemplate();
            $view->impostaDati('errore','');
            return $result;
        } else {
            $view->setLayout('conferma');
            return $view->processaTemplate();
        }
    }
    /**
     * Mostra il modulo di upload di un'avventura
     *
     * @return string
     */
    public function moduloUpload() {
        $VUpload = USingleton::getInstance('VUpload');
        $VUpload->setLayout('default');
        return $VUpload->processaTemplate();
    }
    /**
     * Cancella un'avventura e restituisce il template che avverte di avvenuta cancellazione
     *
     * @return string
     */
    public function deleteAdventure(){
        $view=USingleton::getInstance('VUpload');
        $FAvventura=new FAvventura;
        $param=$view->getDatiMostra();
        $avventura=$FAvventura->loadMostra($param);
        $FAvventura->delete($avventura[0]);
        $view2=USingleton::getInstance('VRegistrazione');
        $view2->setLayout('default');
        $view2->impostaDati('avviso','Adventure deleted');
        return $view2->processaTemplate();
    }
    /**
     * Cancella un commento e restituisce il template che avverte di avvenuta cancellazione
     *
     * @return string
     */
    public function deleteComment(){
        $view=USingleton::getInstance('VUpload');
        $FCommento=new FCommento;
        $param=$view->getDatiMostra();
        $commento=$FCommento->loadCommento($param);
        $FCommento->delete($commento[0]);
        $view2=USingleton::getInstance('VRegistrazione');
        $view2->setLayout('default');
        $view2->impostaDati('avviso','Comment deleted');
        return $view2->processaTemplate();
    }
    /**
     * Smista le richieste ai vari metodi
     *
     * @return mixed
     */
    public function smista() {
        $view=USingleton::getInstance('VUpload');
        switch ($view->getTask()) {
            case 'upload':
                return $this->creaAvventura();
            case 'modulo':
                return $this->moduloUpload();
            case 'deletea':
                return $this->deleteAdventure();
            case 'deletec':
                return $this->deleteComment();
        }
    }
}