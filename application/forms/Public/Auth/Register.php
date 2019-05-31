<?php

class Application_Form_Public_Auth_Register extends App_Form_Abstract
{

  public function init()
  {


    $this->setMethod('post');
    $this->setName('register');
    $this->setAction('');


    $this->addElement('text', 'nome', array(
      'filters' => array('StringTrim','StringToLower'),
      'validators' => array(array('StringLength',true,array(3,20))),
      'required' => true,
      'label' => 'Nome',
      'decorators' => $this->elementDecorators,
    ));

    $this->addElement('text', 'cognome', array(
      'validators' => array(array('StringLength', true, array(3,20))),
      'required' => true,
      'label' => 'Cognome',
      'decorators' => $this->elementDecorators,
    ));

    $this->addElement('password', 'psw', array(
      'validators' => array(array('StringLength', true, array(5,15))),
      'required' => true,
      'label' => 'Password',
      'decorators' => $this->elementDecorators,
    ));

    $this->addElement('text', 'email', array(
      'validators' => array(array('EmailAddress')),
      'required' => true,
      'label' => 'E-mail',
      'decorators' => $this->elementDecorators,
    ));

    $this->addElement('text', 'data', array(
      'validators' => array(array('date')),
      'required' => true,
      'label' => 'Data di nascita (yyyy-mm-dd) ',
      'decorators' => $this->elementDecorators,
    ));

    $categories = array(
      'altro' => 'Altro',
      'lavoratore' => 'Lavoratore',
      'studente' => 'Studente');

		$this->addElement('select', 'occupazione', array(
            'label' => 'Occupazione',
            'required' => true,
			'multiOptions' => $categories,
      'decorators' => $this->elementDecorators,
		));

    $this->addElement('text', 'residenza', array(
      'validators' => array(array('StringLength', true, array(2,30))),
      'required' => true,
      'label' => 'Residenza',
      'decorators' => $this->elementDecorators,
    ));


    $this->addElement('submit','register',array(
      'label' => 'Register',
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
