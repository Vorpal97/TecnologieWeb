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
        
    }

    public function catalogAction()
    {
        // action body
    }

    public function faqAction()
    {
        // action body
    }

    public function loginAction()
    {
        // action body
    }

    public function registerAction()
    {
        // action body
    }


}









