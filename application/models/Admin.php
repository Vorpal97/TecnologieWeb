<?php

class Application_Model_Admin extends App_Model_Abstract
{
    public function __construct()
    {
    }
    
    public function getUser($info)
    {
        return $this->getResource('User')->getUser($info);
    }
}

