<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
      $this->_helper->layout->setLayout('user');
      $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
        // action body
        $this->view->livello = $this->_authService->getIdentity()->autenticazione; //passa alla vista le informazione sul livello di permessi dell'utente
    }

    public function logoutAction()
    {
        $this->_authService->logout();
	return $this->_helper->redirector('index','public');
    }

    public function profiloAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione; //passa alla vista le informazione sul livello di permessi dell'utente

        // action body
    }

    public function editaprofiloAction()
    {
        // action body
    }


}
