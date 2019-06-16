<?php

class Zend_View_Helper_ImmaginiIcon extends Zend_View_Helper_HtmlElement {

    public function immaginiIcon($imgFile) {
        $res = '<img src="' . $this->view->baseUrl('images/icon/' . $imgFile) . '" style="width:20px; height:20px;">';
        return $res;
    }

}
