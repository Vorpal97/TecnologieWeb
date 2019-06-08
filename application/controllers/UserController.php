<?php

class UserController extends Zend_Controller_Action
{
    protected $_catalogModel = null;
    //protected $_reservationModel = null;

    public function init()
    {
      $this->_helper->layout->setLayout('main');
      $this->_authService = new Application_Service_Auth();
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
      $this->_catalogModel = new Application_Model_Catalog();
      //$this->_reservationModel = new Application_Model_Reservation();
    }

    public function indexAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
    }

    public function logoutAction()
    {
        $this->_authService->logout();
	return $this->_helper->redirector('index','public');
    }

    public function profiloAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
        // action body
    }

    public function editaprofiloAction()
    {
        // action body
    }
    
    public function prenotazioneAction()
    {
        $idAuto = $this->_getParam('idAuto', null);
        
        if(!is_null($idAuto)){
            $prods = $this->_catalogModel->getAutoById($idAuto);
        }
        $this->view->assign(array('products' => $prods));
    }
}
