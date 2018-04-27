<?php

class CUpload {

    private $_errore='';

    /**
     * Crea un utente sul database controllando che non esista già
     *
     * @return mixed
     */
    public function creaAvventura() {
        $view=USingleton::getInstance('VUpload');
        $dati_avventura=$view->getDatiAvventura();
        $avventura=new EAvventura();
        $FAvventura=new FAvventura();
        $keys=array_keys($dati_avventura);
        $i=0;
        $uploaded=false;
        $count=array_filter($dati_avventura);
        if(count($dati_avventura)==count($count)) {
            foreach ($dati_avventura as $dato) {
                $avventura->$keys[$i] = $dato;
                $i++;
            }
            $FAvventura->store($avventura);
            $uploaded = true;
        }
        else $this->_errore='There are some empty fields';
        if (!$uploaded) {
            $view->impostaErrore($this->_errore);
            $this->_errore='';
            $view->setLayout('problemi');
            $result=$view->processaTemplate();
            $view->setLayout('default');
            $result.=$view->processaTemplate();
            $view->impostaErrore('');
            return $result;
        } else {
            $view->setLayout('conferma');
            return $view->processaTemplate();
        }
    }

    public function moduloUpload() {
        $VUpload = USingleton::getInstance('VUpload');
        $VUpload->setLayout('default');
        return $VUpload->processaTemplate();
    }

    public function smista() {
        $view=USingleton::getInstance('VUpload');
        switch ($view->getTask()) {
            case 'upload':
                return $this->creaAvventura();
            case 'modulo':
                return $this->moduloUpload();
        }
    }
}