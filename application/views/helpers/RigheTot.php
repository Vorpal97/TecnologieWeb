<?php

class Zend_View_Helper_RigheTot extends Zend_View_Helper_HtmlElement {

    public function righeTot($val, $str) {
        $res = '<tr class="grigio"><th class="tab10h2">' . $str . '</th>
                              <td class="tab10"></td><td class="tab10"></td><td class="tab10"></td><td class="tab10"></td><td class="tab10"></td><td class="tab10"></td>
                              <td class="tab10">' . $val . '</td>';
        return $res;
    }

}
