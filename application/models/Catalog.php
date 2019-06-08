<?php

class Application_Model_Catalog extends App_Model_Abstract{
    
    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }
    
    public function getAuto($paged=null){
        return $this->getResource('Auto')->getAuto($paged);
    }
    
    public function getAutoByPrezzo($min, $max, $paged=null){
        return $this->getResource('Auto')->getAutoByPrezzo($min, $max, $paged);
    }
    
    public function getAutoByPosti($posti){
        return $this->getResource('Auto')->getAutoByPosti($posti);
    }
    
    public function getAutoByAll ($min, $max, $posti, $paged=null){
        return $this->getResource('Auto')->getAutoByAll($min, $max, $posti, $paged);
    }
    
    public function getAutoById ($id){
        return $this->getResource('Auto')->getAutoById($id);
    }
}