<?php

class Zend_View_Helper_Durata extends Zend_View_Helper_Abstract {

    public function durata($inizio, $fine) {
        $a = strtotime($inizio);
        $b = strtotime($fine);
        $durata = 1+(($b - $a) / 3600) / 24;
        return $durata;
    }
}