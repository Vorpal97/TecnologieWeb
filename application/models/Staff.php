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
     
     public function removeAuto($auto)
     {
         return $this->getResource('Auto')->removeAuto($auto);
     }
     
     public function editAuto ($updatedAuto, $id)
     {
         return $this->getResource('Auto')->editAuto($updatedAuto, $id);
     }
 }
