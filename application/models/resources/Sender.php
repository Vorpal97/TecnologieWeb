<?php

class Application_Resource_Sender extends Zend_Db_Table_Abstract {

    protected $_name = 'sender';
    protected $_primary = 'id_mittente';
    protected $_rowClass = 'Application_Resource_Sender_Item';

    public function init() {

    }

    public function getSender(){
      return $this->fetchAll($this->select()->where('id_mittente != 0'));
    }
}
