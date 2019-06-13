<?php

class Application_Resource_Messaggio extends Zend_Db_Table_Abstract {

    protected $_name = 'messaggio';
    protected $_primary = 'id_messaggio';
    protected $_rowClass = 'Application_Resource_Messaggio_Item';

    public function init() {

    }
}
