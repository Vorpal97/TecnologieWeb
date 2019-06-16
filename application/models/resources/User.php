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

  public function editUser ($data, $id)
  {
      $this->update($data, 'id_utente = '.$id);
  }

  public function getUser($user)
  {
    return $this->fetchRow($this->select()->where('username = ?', $user));
  }

  public function getUserList()
  {
    return $this->fetchAll($this->select()
    ->where('autenticazione LIKE "user"')
    ->order('cognome'));
  }

  public function removeUser($userid){
    $this->delete("id_utente = " . $userid);
  }

  public function getUserStatus($userid){
    $select = $this->select()
    ->where('id_utente = ' . $userid);

    return $this->fetchRow($select);
  }

  public function setUserStatus($userid, $userState){
    $data = array('abilitato' => $userState);
    $this->update($data, 'id_utente = ' . $userid);
  }

  public function getUserById($userid){
    return $this->fetchRow($this->select()->where('id_utente = ' . $userid));
  }

  public function getAdmin(){
    return $this->fetchRow($this->select()->where('autenticazione LIKE "admin"'));
  }

  public function getUsers(){
    return $this->fetchAll($this->select()->where('autenticazione LIKE "user"'));

  }

}
