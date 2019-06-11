<?php

class Application_Form_Admin_Manage_Staff extends App_Form_Abstract
{

  public function init()
  {


    $this->setMethod('post');
    $this->setName('register');
    $this->setAction('');


    $this->addElement('text', 'nome', array(
      'filters' => array('StringTrim','StringToLower'),
      'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('StringLength', true, array(3,20,'messages'=>'Il nome deve contenere min 3 caratteri e max 20'))),
      'required' => true,
      'label' => 'Nome',
      'decorators' => $this->elementDecorators,
    ));

    $this->addElement('text', 'cognome', array(
      'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('StringLength', true, array(3,20,'messages'=>'Il cognome deve contenere min 3 caratteri e max 20'))),
      'required' => true,
      'label' => 'Cognome',
      'decorators' => $this->elementDecorators,
    ));

    $this->addElement('text', 'username', array(
      'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('StringLength', true, array(3,20,'messages'=>'Lo username deve contenere min 3 caratteri e max 20'))),
      'required' => true,
      'label' => 'Username',
      'decorators' => $this->elementDecorators,
    ));


    $this->addElement('password', 'psw', array(
      'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('StringLength', true, array(5,15,'messages'=>'La password deve contenere min 5 caratteri e max 15'))),
      'required' => true,
      'label' => 'Password',
      'decorators' => $this->elementDecorators,
    ));

    $this->addElement('submit','register',array(
      'label' => 'Salva',
      'decorators' => $this->buttonDecorators,
    ));

    $this->setDecorators(array(
      'FormElements',
      array('HtmlTag', array('tag' => 'table', 'class' =>'zend_form')),
      array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
      'Form',
    ));
  }
}
