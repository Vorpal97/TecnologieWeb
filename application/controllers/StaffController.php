<?php

class StaffController extends Zend_Controller_Action
{
    protected $_form = null;
    protected $_staffModel = null;

    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->view->insertForm = $this->getInsertForm();
        $this->_staffModel = new Application_Model_Staff();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }
    
    private function getInsertForm()
    {
        
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_Staff_Auto_Insert();
        $this->_form->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' =>'addauto'),
            'default', true
        ));
        return $this->_form;
    }
    
    public function addautoAction()
    {
        if (!$this->getRequest()->isPost())
        {
            $this->_helper->redirector('index');
        }
        $form = $this->_form;
        if (!$form->isValid($_POST))
        {
            return $this->render('inserisci');
        }
        $values = $form->getValues();
        $this->_staffModel->addAuto($values);
        $this->_helper->redirector('inserisci');
    }

    public function indexAction()
    {
        // action body
    }

    public function inserisciAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
    }

    public function modificaAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
    }

    public function cancellaAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
    }

    public function visualizzaAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
    }


}
