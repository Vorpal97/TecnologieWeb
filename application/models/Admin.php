<?php

class Application_Model_Admin extends App_Model_Abstract
{
    public function __construct()
    {
    }

    public function getUser($info)
    {
        return $this->getResource('User')->getUser($info);
    }

    public function editUser($data, $id)
    {
        return $this->getResource('User')->editUser($data, $id);
    }

    public function getUserList()
    {
        return $this->getResource('User')->getUserList();
    }

    public function getUserStatus($userid){

        return $this->getResource('User')->getUserStatus($userid);
    }

    public function setUserStatus($userid, $userState){

        return $this->getResource('User')->setUserStatus($userid, $userState);
    }


    public function removeUser($userid)
    {
        return $this->getResource('User')->removeUser($userid);
    }

    public function addFaq($newfaq)
    {
        return $this->getResource('Faq')->addNewFaq($newfaq);
    }

    public function removeFaq($faqId)
    {
        return $this->getResource('Faq')->removeFaq($faqId);
    }

    public function getFaqById($faqId)
    {
        return $this->getResource('Faq')->getFaqById($faqId);
    }
    public function updateFaq($faqId, $faq)
    {
        return $this->getResource('Faq')->updateFaq($faqId, $faq);
    }


    public function getStaffList()
    {
        return $this->getResource('Staff')->getStaffList();
    }

    public function addStaff($newstaff)
    {
        return $this->getResource('Staff')->addStaff($newstaff);
    }

    public function removeStaff($userid)
    {
        return $this->getResource('Staff')->removeStaff($userid);
    }

    public function updateStaff($userid, $values)
    {
        return $this->getResource('Staff')->updateStaff($userid, $values);
    }


    public function getStaffMemberById($userid)
    {
        return $this->getResource('Staff')->getStaffMemberById($userid);
    }

    public function getRentsByMonth()
    {
        return $this->getResource('Prospetto')->getRentsByMonth();
    }

    public function getSender(){
        return $this->getResource('Sender')->getSender();
    }

    public function getUsers(){
        return $this->getResource('User')->getUsers();
    }

    public function getUserMessage($userid){
      return $this->getResource('Messaggio')->getUserMessage($userid);
    }

    public function getUserById($userid){
      return $this->getResource('User')->getUserById($userid);
    }

    public function getAdmin(){
      return $this->getResource('User')->getAdmin();
    }

    public function sendMessage($message){
      return $this->getResource('Messaggio')->sendMessage($message);

    }

}
