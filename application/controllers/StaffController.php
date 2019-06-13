<?php

class StaffController extends Zend_Controller_Action {

    protected $_editform = null;
    protected $_insertform = null;
    protected $_catalogModel = null;
    protected $_staffModel = null;
    protected $_reservationModel = null;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->_staffModel = new Application_Model_Staff();
        $this->view->insertform = $this->getinsertForm();
        $this->view->editform = $this->geteditForm();
        $this->_catalogModel = new Application_Model_Catalog();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione;
        $this->_reservationModel = new Application_Model_Reservation();
    }

    private function getinsertForm() {

        $urlHelper = $this->_helper->getHelper('url');
        $this->_insertform = new Application_Form_Staff_Auto_Insert();
        $this->_insertform->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'addauto'), 'default'
        ));
        return $this->_insertform;
    }

    private function geteditForm() {

        $urlHelper = $this->_helper->getHelper('url');
        $this->_editform = new Application_Form_Staff_Auto_Edit();
        $this->_editform->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'updateauto'), 'default'
        ));
        return $this->_editform;
    }
    
    public function validateinsertAction() 
    {
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $insertform = new Application_Form_Staff_Auto_Insert();
        $response = $insertform->processAjax($_POST); 
        if ($response !== null) {
        	   $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
    
    public function validateeditAction() 
    {
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $editform = new Application_Form_Staff_Auto_Edit();
        $response = $editform->processAjax($_POST); 
        if ($response !== null) {
        	   $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
    
    

    public function updateautoAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index', 'public');
        }
        $form = $this->_editform;
        if (!$form->isValid($_POST)) {
            return $this->render('modifica');
        }
        $values = $form->getValues();
        $autoid = $this->getParam('idauto', null);
        $this->_staffModel->editAuto($values, $autoid);
        $this->_helper->redirector('catalog', 'public');
    }

    public function addautoAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_insertform;
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
        $urlHelper = $this->_helper->getHelper('url');
        $data = $this->_catalogModel->getAutoById($autoid);
        $this->_editform->populate($data->toArray());
        $this->_editform->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'updateauto',
                    'idauto' => $autoid), 'default'
        ));
        return $this->_editform;
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
        $anno = date("Y");
        
        switch ($mese) {
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

        switch ($oggi) {
            case 1:
                $query2 = 'Gennaio';
                break;
            case 2:
                $query2 = 'Febbraio';
                break;
            case 3:
                $query2 = 'Marzo';
                break;
            case 4:
                $query2 = 'Aprile';
                break;
            case 5:
                $query2 = 'Maggio';
                break;
            case 6:
                $query2 = 'Giugno';
                break;
            case 7:
                $query2 = 'Luglio';
                break;
            case 8:
                $query2 = 'Agosto';
                break;
            case 9:
                $query2 = 'Settembre';
                break;
            case 10:
                $query2 = 'Ottobre';
                break;
            case 11:
                $query2 = 'Novembre';
                break;
            case 12:
                $query2 = 'Dicembre';
        }

        if (!is_null($mese)) {
            $pren = $this->_reservationModel->getPrenotazioni($mese, $anno);
        } else {
            $pren = $this->_reservationModel->getPrenotazioni($oggi, $anno);
        }
        $id = $pren->id_auto;
        $prod = $this->_catalogModel->getAutoById($id);
        $this->view->assign(array('prenotazioni' => $pren, 'product' => $prod, 'mese' => $query, 'oggi' => $query2));
    }
}