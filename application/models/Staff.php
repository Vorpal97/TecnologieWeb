<?php
 class Application_Model_Staff extends App_Model_Abstract
 {
     public function __construct() 
     {
     }
     
     public function addAuto($newAuto)
     {
         return $this->getResource('Auto')->addNewAuto($newAuto);
     }
 }
