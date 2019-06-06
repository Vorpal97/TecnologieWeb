<?php

class Application_Resource_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'utente';
    protected $_primary = 'id_utente';
    protected $_rowClass = 'Application_Resource_User_Item';
    
    public function init()
    {
    }
    
    public function addNewUser ($newuser)
    {
        $this->insert($newuser);
    }
    
    public function getUser($mail)
    {
        return $this->fetchRow($this->select()->where('email = ?', $mail));
    }
}