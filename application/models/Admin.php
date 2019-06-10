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

}
