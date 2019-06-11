<?php

class Zend_View_Helper_Date extends Zend_View_Helper_Abstract {

    public function date($in, $fin) {
        $c = 0;
        $oggi = date("Y-m-d");

        if ($in < $oggi && $in != 0) {
            $res = '<p style="text-align: center;">Non siamo autorizzati a tornare indietro nel tempo</p><p style="text-align: center">La data di inizio inserita è: ' . $in . '</p><p style="text-align: center">Controllare il calendario e sceglierne un\'altra';
            $c += 1;
        } else if ($in > $fin) {
            $res = '<p style="text-align: center;">La data di fine precede la data di inizio</p><p style="text-align: center;">Inserire le date nel giusto ordine</p>';
            $c += 1;
        } else if ($in == 0 || $fin == 0) {
            $res = '<p style="text-align: center;">Inserire la data di inizio e fine desiderate<p>';
            $c += 1;
        } else {
            $res = 1;
        }
        return $res;
    }

}
