<?php

class Application_Model_Faq extends App_Model_Abstract{

    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }

    public function getFaq(){
        return $this->getResource('Faq')->getFaq();
    }
}
