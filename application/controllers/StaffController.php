<?php

class StaffController extends Zend_Controller_Action {

    protected $_form = null;
    protected $_catalogModel = null;
    protected $_staffModel = null;
    protected $_reservationModel = null;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->_staffModel = new Application_Model_Staff();
        $this->view->form = $this->getForm();
        $this->_catalogModel = new Application_Model_Catalog();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione;
        $this->_reservationModel = new Application_Model_Reservation();
    }

    private function getForm() {

        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_Staff_Auto_Save();
        $this->_form->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'addauto'), 'default', true
        ));
        return $this->_form;
    }

    public function updateautoAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index', 'public');
        }
        $form = $this->_form;
        if (!$form->isValid($_POST)) {
            return $this->render('modifica');
        }
        $values = $form->getValues();
        $autoid = $this->getParam('idauto', null);
        $this->_staffModel->editAuto($values, $autoid);
        $this->_helper->redirector('modifica');
    }

    public function addautoAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_form;
        if (!$form->isValid($_POST)) {
            return $this->render('inserisci');
        }
        $values = $form->getValues();
        $this->_staffModel->addAuto($values);
        $this->_helper->redirector('inserisci');
    }

    public function indexAction() {
        // action body
    }

    public function inserisciAction() {
        $this->view->azione = $this->getRequest()->getActionName();
    }

    public function modificaAction() {
        $this->view->azione = $this->getRequest()->getActionName();
        $autoid = $this->_getParam('idauto', null);
        $this->view->idauto = $autoid;
        $urlHelper = $this->_helper->getHelper('url');
        $data = $this->_catalogModel->getAutoById($autoid);
        $precompiled = array(
            "marca" => $data[0]->marca,
            "modello" => $data[0]->modello,
            "targa" => $data[0]->targa,
            "segmento" => $data[0]->segmento,
            "alimentazione" => $data[0]->alimentazione,
            "immagine" => $data[0]->immagine,
            "cilindrata" => $data[0]->cilindrata,
            "potenza" => $data[0]->potenza,
            "cavalli" => $data[0]->cavalli,
            "prezzo" => $data[0]->prezzo,
            "colore" => $data[0]->colore,
            "n_posti" => $data[0]->n_posti,
        );
        $this->_form->populate($precompiled);
        $this->_form->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'updateauto',
                    'idauto' => $data[0]->id_auto), 'default'
        ));
        return $this->_form;
    }

    public function cancellaAction() {
        $this->view->azione = $this->getRequest()->getActionName();
        $autoid = $this->_getParam('idauto', null);
        if (is_null($autoid)) {
            $this->_helper->redirector('index', 'public');
        } else {
            $this->_staffModel->removeAuto($autoid);
            $this->_helper->redirector('catalog', 'public');
        }
    }

    public function visualizzaAction() {
        $this->view->azione = $this->getRequest()->getActionName();
        
        $mese = $this->_getParam('mese', null);
        $oggi = date("m");
        
        switch ($mese){
            case 1:
                $query = 'Gennaio';
                break;
            case 2:
                $query = 'Febbraio';
                break;
            case 3:
                $query = 'Marzo';
                break;
            case 4:
                $query = 'Aprile';
                break;
            case 5:
                $query = 'Maggio';
                break;
            case 6:
                $query = 'Giugno';
                break;
            case 7:
                $query = 'Luglio';
                break;
            case 8:
                $query = 'Agosto';
                break;
            case 9:
                $query = 'Settembre';
                break;
            case 10:
                $query = 'Ottobre';
                break;
            case 11:
                $query = 'Novembre';
                break;
            case 12:
                $query = 'Dicembre';
        }
        
        switch ($oggi){
            case 1:
                $query = 'Gennaio';
                break;
            case 2:
                $query = 'Febbraio';
                break;
            case 3:
                $query = 'Marzo';
                break;
            case 4:
                $query = 'Aprile';
                break;
            case 5:
                $query = 'Maggio';
                break;
            case 6:
                $query = 'Giugno';
                break;
            case 7:
                $query = 'Luglio';
                break;
            case 8:
                $query = 'Agosto';
                break;
            case 9:
                $query = 'Settembre';
                break;
            case 10:
                $query = 'Ottobre';
                break;
            case 11:
                $query = 'Novembre';
                break;
            case 12:
                $query = 'Dicembre';
        }
        
        if (!is_null($mese)){
            $pren = $this->_reservationModel->getPrenotazioni($mese);
        } else {
            $pren = $this->_reservationModel->getPrenotazioni($oggi);
        }
        $this->view->assign(array('prenotazioni' => $pren, 'mese' => $query));
    }
}