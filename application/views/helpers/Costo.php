<?php

class Zend_View_Helper_Costo extends Zend_View_Helper_Abstract {

    public function costo($prezzo, $durata) {
        $currency = new Zend_Currency();
        $costo = $prezzo * $durata;
        $formatted = '<p>Costo: ' . $currency->toCurrency($costo) . '</p>';
        return $formatted;
    }
}
