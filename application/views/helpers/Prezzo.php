<?php

class Zend_View_Helper_Prezzo extends Zend_View_Helper_HtmlElement {

    public function prezzo($prezzo) {
        $currency = new Zend_Currency();
        $res = $currency->toCurrency($prezzo);
        return $res;
    }

}
