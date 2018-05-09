<?php
/**
 * @access public
 * @package Controller
 */
class CHome {
    /**
     * Imposta la pagina, controlla l'autenticazione
     */
    public function impostaPagina () {
        $CRegistrazione = USingleton::getInstance('CRegistrazione');
        $VHome = USingleton::getInstance('VHome');
        $session = USingleton::getInstance('USession');
        if( $session->controlloInattivita() ) {
            $CRegistrazione->setSessionExpired();
            $contenuto = $CRegistrazione->moduloLogin();
        } else {
            $contenuto = $this->smista();
        }
        $registrato=$CRegistrazione->getUtenteRegistrato();
        $VHome->impostaContenuto($contenuto);
        if ($registrato) {
            $VHome->impostaPaginaRegistrato();
        } else {
            $VHome->impostaPaginaGuest();
        }
        $VHome->mostraPagina();
    }
    /**
     * Prende l'errore da index.php e lo passa al Controller CUtente
     */
    public function geterrore($errore){
        $CUtente=USingleton::getInstance('CUtente');
        $CUtente->setErrore($errore);
    }
    /**
     * Prende l'errore da index.php e lo passa al Controller CUpload
     */
    public function geterrore2($errore){
        $CUpload=USingleton::getInstance('CUpload');
        $CUpload->setErrore($errore);
    }
    /**
     * Smista le richieste ai vari controller
     *
     * @return mixed
     */
    public function smista() {
        $view = USingleton::getInstance('VHome');
        switch ($view->getController()) {
            case 'ricerca':
                $CRicerca= USingleton::getInstance('CRicerca');
                return $CRicerca->smista();
            case 'profile':
                $CUtente= USingleton::getInstance('CUtente');
                return $CUtente->smista();
            case 'registrazione':
                $CRegistrazione = USingleton::getInstance('CRegistrazione');
                return $CRegistrazione->smista();
            case 'upload':
                $CUpload = USingleton::getInstance('CUpload');
                return $CUpload->smista();
            default:
                $CRegistrazione = USingleton::getInstance('CRegistrazione');
                return $CRegistrazione->smista();
        }
    }

}
