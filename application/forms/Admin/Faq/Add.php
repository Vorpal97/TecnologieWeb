<?php

class Application_Form_Admin_Faq_Add extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('add');
        $this->setAction('');   //la action la definisco dal controller che gestisce la form

        $this->addElement('textarea', 'domanda', array(
            'style' => array("height: 150px;"),
            'id' =>'domanda',
            'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true)),
            'required' =>true,
            'label' => 'Domanda',
            'decorators' => $this->elementFaqDecorators,
            ));

            $this->addElement('textarea', 'risposta', array(
                'style' => array("height: 150px;"),
                'id' =>'risposta',
                'validators' => array(array('validator'=>'NotEmpty','options'=>array('messages'=>'Il campo non può essere lasciato vuoto'),'breakChainOnFailure'=>true)),
                'required' =>true,
                'label' => 'Risposta',
                'decorators' => $this->elementFaqDecorators,
                ));

        $this->addElement ('submit', 'aggiungi', array(
            'label' => 'Salva',
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
