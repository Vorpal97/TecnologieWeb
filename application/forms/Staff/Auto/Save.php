<?php

class Application_Form_Staff_Auto_Save extends App_Form_Abstract {

    public function init() {
        $this->setMethod('post');
        $this->setName('insert');
        $this->setAction('');

        $this->addElement('text', 'marca', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true)),
            'required' => true,
            'label' => 'Marca',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'modello', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true)),
            'required' => true,
            'label' => 'Modello',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'targa', array(
            'filters' => array('StringToUpper'),
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true), array('StringLength', true, array(7, 7, 'messages' => 'La targa deve contenere esattamente 7 caratteri'))),
            'required' => true,
            'label' => 'Targa',
            'decorators' => $this->elementDecorators,
        ));

        $segmenti = array(
            'null' => '',
            'Berlina Sportiva' => 'Berlina Sportiva',
            'SUV' => 'SUV',
            'Supercar' => 'Supercar',
            'Musclecar' => 'Musclecar',
            'Utilitaria' => 'Utilitaria'
        );

        $this->addElement('select', 'segmento', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true)),
            'required' => true,
            'multiOptions' => $segmenti,
            'label' => 'Segmento',
            'decorators' => $this->elementDecorators,
        ));

        $alimentazione = array(
            'null' => '',
            'Diesel' => 'Diesel',
            'Benzina' => 'Benzina',
            'Elettrica' => 'Elettrica',
            'Hybrid Diesel' => 'Hybrid Diesel'
        );

        $this->addElement('select', 'alimentazione', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true)),
            'required' => true,
            'multiOptions' => $alimentazione,
            'label' => 'Alimentazione',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('file', 'immagine', array(
            'label' => 'Immagine di anteprima',
            'destination' => APPLICATION_PATH . '/../public/images/catalog',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 102400),
                array('Extension', false, array('jpg'))),
            'decorators' => $this->fileDecorators,
        ));

        $this->addElement('text', 'cilindrata', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true), array('Digits', true, array('messages' => 'Puoi inserire soltanto numeri'))),
            'required' => true,
            'label' => 'Cilindrata',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'potenza', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true), array('Digits', true, array('messages' => 'Puoi inserire soltanto numeri'))),
            'required' => true,
            'label' => 'Potenza',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'cavalli', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true), array('Digits', true, array('messages' => 'Puoi inserire soltanto numeri'))),
            'required' => true,
            'label' => 'Cavalli',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'prezzo', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true), array('Int', true, array('messages' => 'Il prezzo deve essere un intero'))),
            'required' => true,
            'label' => 'Prezzo (Intero)',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'colore', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true)),
            'required' => true,
            'label' => 'Colore',
            'decorators' => $this->elementDecorators,
        ));

        $posti = array(
            'null' => '',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5'
        );

        $this->addElement('select', 'n_posti', array(
            'validators' => array(array('validator' => 'NotEmpty', 'options' => array('messages' => 'Il campo non può essere lasciato vuoto'), 'breakChainOnFailure' => true)),
            'required' => true,
            'multiOptions' => $posti,
            'label' => 'Numero posti',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('file', 'immagine', array(
            'label' => 'Immagine di anteprima',
            'destination' => APPLICATION_PATH . '/../public/images/catalog',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 1024000),
                array('Extension', false, array('jpg'))),
            'decorators' => $this->fileDecorators,
        ));

        $this->addElement('submit', 'salva', array(
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
