<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function managefaqAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function rentstatsAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function usermanagerAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function staffmanagerAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function logoutAction()
    {
      $this->_authService->logout();
      return $this->_helper->redirector('index','public');
    }


}
