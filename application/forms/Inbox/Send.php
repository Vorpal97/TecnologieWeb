<?php

class Application_Form_Inbox_Send extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('send');
        $this->setAction('');   //la action la definisco dal controller che gestisce la form

        $this->addElement('text', 'corpo', array(
            'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true)),
            'required' =>true,
            'decorators' => $this->elementMessageDecorators,
            ));

        $this->addElement ('submit', 'invia', array(
            'label' => 'Invia',
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
