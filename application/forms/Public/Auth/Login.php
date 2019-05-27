<?php
class Application_Form_Public_Auth_Login extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');   //la action la definisco dal controller che gestisce la form
        
        $this->addElement('text', 'username', array(
            'filters' => array ('StringTrim','StringToLower'),
            'validators' => array(array('StringLength', true, array(5,15))),
            'required' => true,
            'label' => 'Username',
            ));
        
        $this->addElement('text', 'password', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(array('StringLength', true, array(5,15))),
            'required' => true,
            'label' =>'Password',
            ));
        
        $this->addElement ("submit", 'add', array(
            'label' => 'Login!',
            ));
    }
}