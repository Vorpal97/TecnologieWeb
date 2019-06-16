<?php

class UserController extends Zend_Controller_Action {

    protected $_catalogModel = null;
    protected $_reservationModel = null;
    protected $_authService = null;
    protected $_form = null;
    protected $_adminModel = null;
    protected $_messageform = null;

    public function init() {
        $this->_adminModel = new Application_Model_Admin();
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_reservationModel = new Application_Model_Reservation();
        $this->view->id_utente = $this->_authService->getIdentity()->id_utente;
        $this->view->editForm = $this->getForm();
        $this->view->messageForm = $this->getMessageForm();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function getForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_User_Edit_EditProfile();
        $this->_form->setAction($urlHelper->url(array(
                    'controller' => 'user',
                    'action' => 'updateprofile'), 'default'
        ));
        return $this->_form;
    }

    private function getMessageForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_messageform = new Application_Form_Inbox_Send();
        return $this->_messageform;
    }

    public function updateprofileAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index', 'public');
        }
        $form = $this->_form;
        if (!$form->isValid($_POST)) {
            return $this->render('profilo');
        }
        $id = $this->_getParam('iduser', null);
        $values = $form->getValues();
        $oldpass = $values['oldpass'];
        if ($values['psw'] == '' || $values['oldpass'] == '') {
            $dati = array(//popolamento dell'array di valori barbaro necessario se si vuole modificare questi dati senza per forza modificare la password
                'email' => $values['email'],
                'residenza' => $values['residenza'],
                'occupazione' => $values['occupazione']
            );
        } else if ($this->_adminModel->getUserById($id)->psw == $values['oldpass']) {
            $dati = array(
                'email' => $values['email'],
                'psw' => $values['psw'],
                'residenza' => $values['residenza'],
                'occupazione' => $values['occupazione']
            );
        } else {
            $form->setDescription('La password attuale non è corretta');
            return $this->render('profilo');
        }
        $this->_adminModel->editUser($dati, $id);
        $form->setDescription('Modifica avvenuta con successo');
        $this->render('profilo');
    }

    public function getloggeduserAction() {
        $user = $this->_authService->getIdentity()->username;
        $loggeduser = $this->_adminModel->getUser($user);
        return $loggeduser;
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
                    'iduser' => $data->id_utente), 'default'
        ));
        return $this->_form;
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
        }else ($pren = 0);
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
        if ($idAuto != 0) {
            $dataAuto = $this->_catalogModel->getAutoById($idAuto);
        }
        $this->view->assign(array('data_inizio' => $dataInizio, 'data_fine' => $dataFine, 'id_auto' => $idAuto, 'id_utente' => $idUtente, 'dataAuto' => $dataAuto));
    }

    public function messaggiAction() {
        $userid = $this->_authService->getIdentity()->id_utente;
        $this->view->azione = $this->getRequest()->getActionName();
        $urlHelper = $this->_helper->getHelper('url');
        if ($userid != null) {
            $messaggi = $this->_adminModel->getUserMessage($userid);
            $user = $this->_adminModel->getUserById($userid);
            $this->view->assign(array('messaggi' => $messaggi));
            $this->view->user = $user;
            $this->_messageform->setAction($urlHelper->url(array(
                        'controller' => 'user',
                        'action' => 'sendmessage'), 'default'
            ));
        }
    }

    public function sendmessageAction() {
        $admin = $this->_adminModel->getAdmin();
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_messageform;
        if (!$form->isValid($_POST)) {
            return $this->render('messaggi');
        }
        $values = $form->getValues();
        $values['id_mittente'] = $this->_authService->getIdentity()->id_utente;
        $values['id_destinatario'] = $admin->id_utente;
        $this->_adminModel->sendMessage($values);
        $this->_helper->redirector('messaggi', 'user');
    }

}
