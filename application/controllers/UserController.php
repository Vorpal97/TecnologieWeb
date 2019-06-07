<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
      $this->_helper->layout->setLayout('main');
      $this->_authService = new Application_Service_Auth();
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
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


}
