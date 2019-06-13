<?php

class UserController extends Zend_Controller_Action {

    protected $_catalogModel = null;
    protected $_reservationModel = null;
    protected $_authService = null;
    protected $_form = null;
    protected $_adminModel = null;

    public function init() {
        $this->_adminModel = new Application_Model_Admin();
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione;
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_reservationModel = new Application_Model_Reservation();
        $this->view->id_utente = $this->_authService->getIdentity()->id_utente;
        $this->view->editForm = $this->getForm();
        
    }

    public function getForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_User_Edit_EditProfile();
        $this->_form->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'updateprofile'),
            'default'
        ));
        return $this->_form;
    }
    
    public function updateprofileAction()
    {
        if(!$this->getRequest()->isPost())
        {
            $this->_helper->redirector('index','public');
        }
        $form = $this->_form;
        if (!$form->isValid($_POST)) {
            return $this->render('profilo');
        }
        $id = $this->_getParam('iduser', null);
        $values = $form->getValues();
        $oldpass = $values['oldpass'];
        if($values['psw'] == '' || $values['oldpass'] == '')
        {
        $dati = array(
            'email' => $values['email']
                );
        } else if (!is_null($this->_adminModel->getUserByPass($oldpass)))
        {   
            $dati = array(
                'email' => $values['email'],
                'psw' => $values['psw']
            );
        } else 
            {
                $form->setDescription('La password attuale non è corretta');
                return $this->render('profilo');
            }
        $this->_adminModel->editUser($dati, $id);
        $this->_helper->redirector('profilo');
    }
    
    public function getloggeduserAction()
    {
        $user = $this->_authService->getIdentity()->username;
        $loggeduser = $this->_adminModel->getUser($user);
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
        $data = $this->getloggeduserAction();
        $this->_form->populate($data->toArray());
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'updateprofile',
            'iduser' => $data->id_utente),
            'default'
        ));
        return $this->_form;
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
        if ($idUtente != 0 && $durata != 0) {
            $this->_reservationModel->setPrenotazione(array('data_inizio' => $dataInizio, 'data_fine' => $dataFine, 'id_auto' => $idAuto, 'id_utente' => $idUtente, 'costo' => $costo));
        }
        if ($idAuto != 0){
            $dataAuto = $this->_catalogModel->getAutoById($idAuto);
        }
        $this->view->assign(array('data_inizio' => $dataInizio, 'data_fine' => $dataFine, 'id_auto' => $idAuto, 'id_utente' => $idUtente, 'dataAuto' => $dataAuto));
    }
}
