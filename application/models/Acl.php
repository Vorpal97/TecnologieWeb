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
             ->add (new Zend_Acl_Resource ('user'))
             ->allow('user','user');

        //per utente staff
        $this->addRole(new Zend_Acl_Role('staff'),'user')
             ->add (new Zend_Acl_Resource ('staff'))
             ->allow ('staff','staff');

        //per utente admin
        $this->addRole(new Zend_Acl_Role('admin'),'staff')
             ->add (new Zend_Acl_Resource ('admin'))
             ->allow ('admin','admin');

    }
}
