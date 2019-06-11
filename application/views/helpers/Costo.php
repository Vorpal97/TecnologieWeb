<?php

class Zend_View_Helper_Costo extends Zend_View_Helper_Abstract {

    public function costo($prezzo, $durata, $tipo=null, $style=null) {
        $currency = new Zend_Currency();
        $costo = $prezzo * $durata;
        $formatted = '<p ' . $style . '>' . $tipo . ': ' . $currency->toCurrency($costo) . '</p>';
        return $formatted;
    }
}
