<?php

class Application_Model_Reservation extends App_Model_Abstract {

    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }

    public function getPrenotazioneByAuto($id) {
        return $this->getResource('Prenotazione')->getPrenotazioneByAuto($id);
    }

    public function setPrenotazione($dati) {
        /* $in = $dati->inizio;
          $fin = $dati->fine;
          $auto = $dati->auto;
          $utente = $dati->utente; */
        return $this->getResource('Prenotazione')->setPrenotazione($dati);
    }

    public function getPrenotazioni($mese, $anno) {
        return $this->getResource('ProspettoStaff')->getPrenotazioni($mese, $anno);
    }

}
