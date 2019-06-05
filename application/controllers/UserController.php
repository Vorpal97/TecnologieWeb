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
    }

    public function logoutAction()
    {
        $this->_authService->logout();
	return $this->_helper->redirector('index','public');	
    }

    public function profiloAction()
    {
        // action body
    }

    public function editaprofiloAction()
    {
        // action body
    }


}




