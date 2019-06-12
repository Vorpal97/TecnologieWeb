<?php

class Application_Resource_Prospetto extends Zend_Db_Table_Abstract {

    protected $_name = 'prospetto';
    protected $_primary = 'mese';
    protected $_rowClass = 'Application_Resource_Prospetto_Item';

    public function init() {

    }

    public function getRentsByMonth(){
      $select = $this->select()
                     ->where('mese !=0');

      $result = $this->fetchAll($select);
      $mesi = array(  1 => "Gennaio", 2 => "Febbraio",  3 => "Marzo",
                      4 => "Aprile",  5 => "Maggio",    6 => "Giugno",
                      7 => "Luglio",  8 => "Agosto",    9 => "Settembre",
                      10 => "Ottobre", 11 => "Novembre",  12 => "Dicembre");
      foreach ($result as $prospetto) {
        $prospetto->mese = $mesi[$prospetto->mese];
      }
      return $result;
    }
}
