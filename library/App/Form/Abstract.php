<?php
class App_Form_Abstract extends Zend_Form
{
    public $elementDecorators = array(
        'ViewHelper',
        array(array('alias1' => 'HtmlTag'),array('tag' => 'td', 'class' => 'element')),
		array(array('alias2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors','openOnly' => true, 'placement' => 'append')),
		'Errors',
		array(array('alias3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
        array('Label', array('tag' => 'td', 'style' => 'width:130px;float:right;')),
        array(array('alias4' => 'HtmlTag'), array('tag' => 'tr')),
        );

    public $buttonDecorators = array(
        'ViewHelper',   //genera il button
        array(array('button1' => 'HtmlTag'),array('tag' => 'td')),
        array(array('button2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'button')),
        array(array('button3' => 'HtmlTag'),array('tag' => 'tr')),
    );

}
