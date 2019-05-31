<?php

class Application_Model_Catalog extends App_Model_Abstract{
    
    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }
    
    public function getAuto(){
        return $this->getResource('Auto')->getAuto();
    }
    
    public function getAutoByPrezzo($min, $max){
        return $this->getResource('Auto')->getAutoByPrezzo($min, $max);
    }
}