<?php

class Application_Resource_Auto extends Zend_Db_Table_Abstract{
    protected $_name = 'auto';
    protected $_primary = 'id_auto';
    protected $_rowClass = 'Application_Resource_Auto_Item';
    
    public function init(){
        
    }
    
    public function getAuto (){
        
        $select = $this->select()
                ->where('prezzo != 0')
                ->order('marca');
        return $this->fetchAll($select);
    }
}

