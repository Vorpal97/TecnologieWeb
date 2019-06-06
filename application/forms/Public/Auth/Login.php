<?php

class Application_Form_Public_Auth_Login extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');   //la action la definisco dal controller che gestisce la form

        $this->addElement('text', 'email', array(
            'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('EmailAddress',true, array('messages' => "L'email inserita non è nel formato emailaddress@hostname"))),
            'required' =>array('required','messages'=>'ciao'),
            'label' => 'E-mail',
            'decorators' => $this->elementDecorators,
            ));

        $this->addElement('password', 'psw', array(
            'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('StringLength', true, array(5,15,'messages'=>'La password deve contenere min 5 caratteri e max 15'))),
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
