<?php

class Zend_View_Helper_ImmagineBack extends Zend_View_Helper_HtmlElement {

    public function immagineBack($imgFile) {
        $res = 'url(\'' . $this->view->baseUrl('images/samples/' . $imgFile) . '\')';
        return $res;
    }

}
