<?php

class Application_Resource_Staff extends Zend_Db_Table_Abstract{
    protected $_name = 'utente';
    protected $_primary = 'id_utente';
    protected $_rowClass = 'Application_Resource_User_Item';

    public function init(){

    }

    public function getStaffList (){

        $select = $this->select()
        ->where('autenticazione LIKE "staff"')
        ->order('nome');

        return $this->fetchAll($select);
    }

    public function addStaff ($newstaff)
    {
        $newstaff['autenticazione'] = 'staff';
        $this->insert($newstaff);
    }

}
