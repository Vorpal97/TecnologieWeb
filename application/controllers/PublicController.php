<?php

class PublicController extends Zend_Controller_Action
{

    protected $_logger;

    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get('log');
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


}











