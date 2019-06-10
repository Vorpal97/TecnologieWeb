<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract{
    protected $_name = 'faq';
    protected $_primary = 'id_faq';
    protected $_rowClass = 'Application_Resource_Faq_Item';

    public function init(){

    }

    public function getFaq (){

        $select = $this->select()
        ->where('domanda != ""')
        ->order('time_stamp');

        return $this->fetchAll($select);
    }

    public function addNewFaq ($newfaq)
    {
        $this->insert($newfaq);
    }

    public function removeFaq ($faqId)
    {
        $this->delete('id_faq = ' . $faqId);
    }



}
