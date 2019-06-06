<?php

class StaffController extends Zend_Controller_Action
{
    protected $_form = null;

    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->view->insertForm = $this->getInsertForm();
    }
    
    public function getInsertForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_Staff_Auto_Insert();
        $this->_form->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' =>'inserisci'),
            'default'
        ));
        return $this->_form;
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
