<?php

class Application_Resource_Messaggio extends Zend_Db_Table_Abstract {

    protected $_name = 'messaggio';
    protected $_primary = 'id_messaggio';
    protected $_rowClass = 'Application_Resource_Messaggio_Item';

    public function init() {

    }

    public function getUserMessage($userid){
    $select = $this->select()->where('id_mittente = ' . $userid . ' OR id_destinatario = ' . $userid)
                               ->order('time_stamp');

      return $this->fetchAll($select);
    }

    public function sendMessage($message){
          $this->insert($message);
    }
}
