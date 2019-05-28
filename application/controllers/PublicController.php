<?php

class PublicController extends Zend_Controller_Action
{

    protected $_logger;
    protected $_form;


    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get('log');
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registerForm = $this->getRegisterForm();
    }

    public function indexAction()
    {
         $this->_logger->info('Attivato:    '. __METHOD__);
    }

    public function catalogAction()
    {
        $this->_logger->info('Attivato:    '. __METHOD__);
    }

    public function faqAction()
    {
        $this->_logger->info('Attivato:    '. __METHOD__);
    }

    public function loginAction()
    {
        $this->_logger->info('Attivato:    '. __METHOD__);
    }

    public function registerAction()
    {
        $this->_logger->info('Attivato:    '. __METHOD__);
    }

    public function profileAction()
    {
        $this->_logger->info('Attivato:    '. __METHOD__);
    }

    private function getLoginForm()
    {
        $this->_form = new Application_Form_Public_Auth_Login();
        return $this->_form;
    }

    private function getRegisterForm()
    {
      $this->$_form = new Application_Form_Public_Auth_Register();
      return $this->$_form;
    }

}
