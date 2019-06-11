<?php
class Zend_View_Helper_Immagine extends Zend_View_Helper_HtmlElement
{
	private $_attrs;
	
	public function immagine($imgFile, $attrs = false)
	{
		if (empty($imgFile)) {
			$imgFile = 'default.jpg';
		}
		if (null !== $attrs) {
			$_attrs = $this->_htmlAttribs($attrs);
		} else {
			$_attrs = '';
		}
		$res = '<img src="' . $this->view->baseUrl('images/catalog/' . $imgFile) . '" ' . $_attrs . '>';
		return $res;
	}
}