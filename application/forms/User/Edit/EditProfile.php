<?php
    class Application_Form_User_Edit_EditProfile extends App_Form_Abstract
    {
        public function init()
        {
            $this->setMethod('post');
            $this->setName('edit');
            $this->setAction('');
            
            $this->addElement('text', 'email', array(
                'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('EmailAddress',true, array('messages' => "L'email inserita non è nel formato emailaddress@hostname"))),
                'required' => true,
                'label' => 'E-mail',
                'decorators'=>$this->elementDecorators,
                ));
            
            $this->addElement('password', 'oldpass', array(
                'validators' => array(array('StringLength', true, array(5,15,'messages'=>'La password deve contenere min 5 caratteri e max 15'))),
                'label' => 'Password attuale',
                'decorators' => $this->elementDecorators,
            ));
            
            $this->addElement('password', 'psw', array(
                'validators' => array(array('StringLength', true, array(5,15,'messages'=>'La password deve contenere min 5 caratteri e max 15'))),
                'label' => 'Nuova Password',
                'decorators' => $this->elementDecorators,
            ));
            
            $this->addElement('text', 'residenza', array(
                'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true),array('StringLength', true, array(2,30,'messages'=>'Il campo deve contenere min 2 caratteri e max 30'))),
                'required' => true,
                'label' => 'Residenza',
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
            
            
            
            $this->addElement('submit','salva',array(
            'label' => 'Salva',
            'decorators' => $this->buttonDecorators,
            ));
            
            $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'message')),
            'Form',
            ));

        }
    }