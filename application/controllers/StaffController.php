<?php

class StaffController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('staff');
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

    public function inserisciAction()
    {
        // action body
    }

    public function modificaAction()
    {
        // action body
    }

    public function cancellaAction()
    {
        // action body
    }

    public function visualizzaAction()
    {
        // action body
    }


}











