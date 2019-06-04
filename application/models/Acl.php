<?php

class Application_Model_Acl extends Zend_Acl 
{
    public function __construct() 
    {
        //per visitatori del sito
        $this->addRole(new Zend_Acl_Role('visitor'))
                ->add(new Zend_Acl_Resource('index'))
                ->add(new Zend_Acl_Resource('error'))
                ->add(new Zend_Acl_resource('public'))
                ->allow('visitor', array('index','error','public'));
        
        //per utente registrato
        $this->addRole(new Zend_Acl_Role('user'), 'visitor')
             ->addResource(new Zend_Acl_Resource ('user'))
             ->allow('user','user');
        
    }
}