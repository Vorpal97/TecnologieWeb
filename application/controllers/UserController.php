<?php

class UserController extends Zend_Controller_Action {

    protected $_catalogModel = null;
    protected $_reservationModel = null;
    protected $_authService = null;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione;
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_reservationModel = new Application_Model_Reservation();
        $this->view->id_utente = $this->_authService->getIdentity()->id_utente;
    }

    public function indexAction() {
        $this->view->azione = $this->getRequest()->getActionName();
    }

    public function logoutAction() {
        $this->_authService->logout();
        return $this->_helper->redirector('index', 'public');
    }

    public function profiloAction() {
        $this->view->azione = $this->getRequest()->getActionName();
        // action body
    }

    public function editaprofiloAction() {
        // action body
    }

    public function preventivoAction() {


        $idAuto = $this->_getParam('idAuto', null);
        $inizio = $this->_getParam('dataInizio');
        $fine = $this->_getParam('dataFine');

        if (!is_null($idAuto)) {
            $prods = $this->_catalogModel->getAutoById($idAuto);
        }
        if ($inizio != 0 && $fine != 0) {
            $pren = $this->_reservationModel->getPrenotazioneByAuto($idAuto);
        }
        $this->view->assign(array('products' => $prods, 'prenotazioni' => $pren));
    }

    public function prenotazioneAction() {

        $dataInizio = $this->_getParam('data_inizio', null);
        $dataFine = $this->_getParam('data_fine', null);
        $idAuto = $this->_getParam('id_auto', null);
        $idUtente = $this->_getParam('id_utente', null);
        if ($idUtente != 0) {
            $this->_reservationModel->setPrenotazione(array('data_inizio' => $dataInizio, 'data_fine' => $dataFine, 'id_auto' => $idAuto, 'id_utente' => $idUtente));
        }
        if ($idAuto != 0){
            $dataAuto = $this->_catalogModel->getAutoById($idAuto);
        }
        $this->view->assign(array('data_inizio' => $dataInizio, 'data_fine' => $dataFine, 'id_auto' => $idAuto, 'id_utente' => $idUtente, 'dataAuto' => $dataAuto));
    }
}
