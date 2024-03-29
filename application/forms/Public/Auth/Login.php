<?php

class Application_Form_Public_Auth_Login extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');   //la action la definisco dal controller che gestisce la form

        $this->addElement('text', 'username', array(
            'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('StringLength', true, array(3,15,'messages'=>"L'username deve contenere min 3 caratteri e max 15"))),
            'required' =>true,
            'label' => 'Username',
            'decorators' => $this->elementDecorators,
            ));

        $this->addElement('password', 'psw', array(
            'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('StringLength', true, array(4,15,'messages'=>'La password deve contenere min 4 caratteri e max 15'))),
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
            array('Description', array('placement' => 'prepend', 'class' => 'errors')),
            'Form',
        ));


    }
}
