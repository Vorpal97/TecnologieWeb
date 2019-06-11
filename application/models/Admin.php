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

    public function getStaffList()
    {
        return $this->getResource('Staff')->getStaffList();
    }

    public function addStaff($newstaff)
    {
        return $this->getResource('Staff')->addStaff($newstaff);
    }

}
