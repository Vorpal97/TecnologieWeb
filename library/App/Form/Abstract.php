<?php
class App_Form_Abstract extends Zend_Form
{
  public $elementDecorators = array(
    'ViewHelper',
    array(array('elem1' => 'HtmlTag'),array('tag' => 'td', 'class' => 'element')),
    array(array('elem2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors','openOnly' => true, 'placement' => 'append')),
    'Errors',
    array(array('elem3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
    array('Label', array('tag' => 'td', 'style' => 'float:right;')),
    array(array('elem4' => 'HtmlTag'), array('tag' => 'tr')),
  );

  public $elementFaqDecorators = array(
    'ViewHelper',
    array(array('elem1' => 'HtmlTag'),array('tag' => 'td', 'class' => 'element')),
    array(array('elem2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors','openOnly' => true, 'placement' => 'append')),
    'Errors',
    array(array('elem3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
    array('Label', array('tag' => 'td', 'style' => 'float:right;')),
    array(array('elem4' => 'HtmlTag'), array('tag' => 'tr')),
  );

  public $elementMessageDecorators = array(
    'ViewHelper',
    array(array('elem1' => 'HtmlTag'),array('tag' => 'td', 'class' => 'element')),
    array(array('elem2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors','openOnly' => true, 'placement' => 'append')),
    'Errors',
    array(array('elem3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
    array('Label', array('tag' => 'td', 'style' => 'float:right;')),
    array(array('elem4' => 'HtmlTag'), array('tag' => 'tr')),
  );


  public $buttonDecorators = array(
    'ViewHelper',   //genera il button
    array(array('button1' => 'HtmlTag'),array('tag' => 'td')),
    array(array('button2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'button')),
    array(array('button3' => 'HtmlTag'),array('tag' => 'tr')),
  );

  public $fileDecorators = array(
    'File', //serve il wrapper spefcifico per gli elementi di tipo file
    array(array('file1' => 'HtmlTag'), array('tag' => 'td', 'class' => 'file')),
    array(array('file2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors', 'openOnly' => true, 'placement' => 'append')),
    'Errors',
    array(array('file3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
    array('Label', array('tag' => 'td', 'style' => 'float:right')),
    array(array('file4' => 'HtmlTag'), array('tag' => 'tr')),
  );

}
