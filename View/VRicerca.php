<?php
/**
 * Created by PhpStorm.
 * User: enrico
 * Date: 08/08/17
 * Time: 12.57
 */

class VRicerca extends View {

    /**
     * @var string _layout
     */
    private $_layout='default';

    /**
     * restituisce il numero della pagina (utilizzato nella visualizzazione dei libri) passato per GET o POST
     * @return int
     */
    public function getPage() {
        if (isset($_REQUEST['page'])) {
            return $_REQUEST['page'];
        } else
            return 0;
    }

    /**
     * Processa il layout scelto nella variabile _layout
     *
     * @return string
     */
    public function processaTemplate() {
        return $this->fetch('ricerca_'.$this->_layout.'.tpl');
    }

    /**
     * Imposta l'eventuale errore nel template
     *
     * @param string $errore
     */
    public function impostaErrore($errore) {
        $this->assign('errore',$errore);
    }

    /**
     * Imposta i dati nel template identificati da una chiave ed il relativo valore
     *
     * @param string $key
     * @param mixed $valore
     */
    public function impostaDati($key,$valore) {
        $this->assign($key,$valore);
    }

    /**
     * Aggiunge gli strumenti di filtro per la ricerca
     *
     */
    public function aggiungiStrumenti() {
        $VRegistrazione=USingleton::getInstance('VRicerca');
        $VRegistrazione->setLayout('avanzata');
        return $VRegistrazione->processaTemplate();

    }

    /**
     * Ritorna l'id dell'annuncio passato tramite GET o POST
     *
     * @return mixed
     */
    public function getIdAnnuncio() {
        if (isset($_REQUEST['id_annuncio'])) {
            return $_REQUEST['id_annuncio'];
        } else
            return false;
    }

    public function getIsbn() {
        if (isset($_REQUEST['isbn'])) {
            return $_REQUEST['isbn'];
        } else
            return false;
    }

    public function getUsername() {
        if (isset($_SESSION['username'])) {
            return $_SESSION['username'];
        } else
            return false;
    }

    public function getCorso() {
        if (isset($_REQUEST['corso'])) {
            return $_REQUEST['corso'];
        } else
            return false;
    }

    public function getCittà() {
        if (isset($_REQUEST['città'])) {
            return $_REQUEST['città'];
        } else
            return false;
    }

    public function getSpedisce() {
        if (isset($_REQUEST['spedisce'])) {
            return $_REQUEST['spedisce'];
        } else
            return false;
    }

    public function getCondizione() {
        if (isset($_REQUEST['condzione'])) {
            return $_REQUEST['condzione'];
        } else
            return false;
    }

    public function getDescrizione() {
        if (isset($_REQUEST['descrizione'])) {
            return $_REQUEST['descrizione'];
        } else
            return false;
    }

    public function getFoto() {
        if (isset($_REQUEST['foto'])) {
            return $_REQUEST['foto'];
        } else
            return false;
    }

    public function getPrezzo() {
        if (isset($_REQUEST['prezzo'])) {
            return $_REQUEST['prezzo'];
        } else
            return false;
    }

    /**
     * @param string $layout
     */
    public function setLayout($layout) {
        $this->_layout=$layout;
    }

    /**
     * restituisce il voto passato tramite GET o POST
     *
     * @return mixed
     */
    /*public function getVoto() {
        if (isset($_REQUEST['voto'])) {
            return $_REQUEST['voto'];
        } else
            return false;
    }*/

    /**
     * Restituisce il commento
     *
     * @return mixed
     */
    /*public function getCommento() {
        if (isset($_REQUEST['commento'])) {
            return $_REQUEST['commento'];
        } else
            return false;
    }*/

    /**
     * Restituisce categoria
     *
     * @return mixed
     */
    /*public function getCategoria() {
        if (isset($_REQUEST['categoria']))
            return $_REQUEST['categoria'];
        else
            return false;
    }*/

    /**
     * restituisce la stringa di ricerca in un array
     *
     * @return mixed
     */
    public function getParola() {
        if (isset($_REQUEST['keyword'])) // ricerca semplice
            return array($_REQUEST['keyword']);
        else {
            if (isset($_REQUEST['stringa'])) { // ricerca avanzata
                $stringa = explode(",^,", $_REQUEST['stringa']);
                if ( sizeof($stringa) == 1) {//eseguito dalla ricerca avanzata la prima volta (e non nel cambio pagina)
                    if (isset($_REQUEST['anno_stampa'])) $stringa['anno_stampa'] = $_REQUEST['anno_stampa']; else $stringa['anno_stampa'] = '';
                    if (isset($_REQUEST['comune'])) $stringa['comune'] = $_REQUEST['comune']; else $stringa['comune'] = '';
                    if (isset($_REQUEST['se_spedisce']) AND $_REQUEST['se_spedisce'] == 'on') $stringa['se_spedisce'] = 1; else $stringa['se_spedisce'] = '';
                    if (isset($_REQUEST['condizione'])) $stringa['condizione'] = $_REQUEST['condizione']; else $stringa['condizione'] = '';
                    if (isset($_REQUEST['prezzo'])) $stringa['prezzo'] = $_REQUEST['prezzo']; else $stringa['prezzo'] = '';
                }
                else {
                    $stringa['anno_stampa'] = $stringa[1]; unset($stringa[1]);
                    $stringa['comune'] = $stringa[2]; unset($stringa[2]);
                    $stringa['se_spedisce'] = $stringa[3]; unset($stringa[3]);
                    $stringa['condizione'] = $stringa[4]; unset($stringa[4]);
                    $stringa['prezzo'] = $stringa[5]; unset($stringa[5]);
                }
                return $stringa;
            }
            else
                return false;
        }

    }

    /**
     * restituisce un array con l'ordinamento e il limite
     *
     * @return array
     */
    public function getOrdinamento() {
        if (isset($_REQUEST['ordinamento']))
            return $_REQUEST['ordinamento'];
        else
            return '';
    }

    /**
     * @return mixed
     */
    public function getTask() {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }

    public function getDatiRicerca() {
        $dati_richiesti=array('nome','versione');
        $dati=array();
        foreach ($dati_richiesti as $dato) {
            if (isset($_REQUEST[$dato]))
                $dati[$dato]=$_REQUEST[$dato];
        }
        return $dati;
    }

    public function getDatiMostra() {
        if (isset($_REQUEST['cod_avventura']))
            return $_REQUEST['cod_avventura'];
        else
            return false;
    }

    public function impostaAvventure($value){
        $this->_adventures_list=$value;
        $this->assign('_adventures_list',$this->_adventures_list);
        //$prova=implode(",",$this->_adventures_list);
        //foreach ($this->_adventures_list as $lista)
        //  echo($lista[i]);
    }

}