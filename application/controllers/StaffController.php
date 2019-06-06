<?php

class StaffController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
        // action body
    }

<<<<<<< HEAD
        public function logoutAction()
=======
    public function logoutAction()
>>>>>>> b50b22f6713d356335cf7ad745ed2f6fc128cb2c
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
<<<<<<< HEAD
=======











>>>>>>> b50b22f6713d356335cf7ad745ed2f6fc128cb2c
