<?php

class UserController extends Zend_Controller_Action {

    protected $_catalogModel = null;
    protected $_reservationModel = null;
    protected $_authService = null;
    protected $_form = null;
    protected $_adminModel = null;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione;
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_reservationModel = new Application_Model_Reservation();
        $this->_adminModel = new Application_Model_Admin();
        $this->view->id_utente = $this->_authService->getIdentity()->id_utente;
        $this->view->editForm = $this->getForm();
        
    }

    public function getForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_User_Edit_EditProfile();
        $data = $this->getloggeduserAction();
        $precompiled = array(
            "email" => $data->email,
        );
        $this->_form->populate($precompiled);
        $this->_form->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => ''),
            'default', true
        ));
        return $this->_form;
    }
    
    public function getloggeduserAction()
    {
        $username = $this->_authService->getIdentity()->username;
        $loggeduser = $this->_adminModel->getUser($username);
        return $loggeduser;
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
        $costo = $this->_getParam('costo', null);
        $durata = $this->_getParam('durata', null);
        $rif = substr($dataInizio, 5,6);
        if ($idUtente != 0 && $durata != 0) {
            $this->_reservationModel->setPrenotazione(array('data_inizio' => $dataInizio, 'data_fine' => $dataFine, 'id_auto' => $idAuto, 'id_utente' => $idUtente, 'mese_rif' => $rif, 'costo' => $costo, 'durata' => $durata));
        }
        if ($idAuto != 0){
            $dataAuto = $this->_catalogModel->getAutoById($idAuto);
        }
        $this->view->assign(array('data_inizio' => $dataInizio, 'data_fine' => $dataFine, 'id_auto' => $idAuto, 'id_utente' => $idUtente, 'dataAuto' => $dataAuto));
    }
}
