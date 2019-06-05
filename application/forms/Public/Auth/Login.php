<?php

class Application_Form_Public_Auth_Login extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');   //la action la definisco dal controller che gestisce la form

        $this->addElement('text', 'email', array(
            'validators' => array(array('EmailAddress')),
            'required' => true,
            'label' => 'E-mail',
            'decorators' => $this->elementDecorators,
            ));

        $this->addElement('password', 'psw', array(
            'validators' => array(array('StringLength', true, array(5,15))),
            'required' => true,
            'label' =>'Password',
            'decorators' => $this->elementDecorators,
            ));

        $this->addElement ('submit', 'login', array(
            'label' => 'Login',
            'decorators' => $this->buttonDecorators,
            ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form',
        ));
    }
}
