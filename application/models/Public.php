<?php

class Application_Model_Public extends App_Model_Abstract
{
    public function __construct() {
                $this->_logger = Zend_Registry::get('log'); 
    }
    
    public function addUser($newuser)
    {
        return $this->getResource('User')->addNewUser($newuser);
    }
}
