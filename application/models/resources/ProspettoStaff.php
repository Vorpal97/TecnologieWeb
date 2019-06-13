<?php

class Application_Resource_ProspettoStaff extends Zend_Db_Table_Abstract {

    protected $_name = 'prospettostaff';
    protected $_primary = 'id_prenotazione';
    protected $_rowClass = 'Application_Resource_ProspettoStaff_Item';

    public function init() {
        
    }

    public function getPrenotazioni($mese, $anno) {
        $query = 'MONTH(data_inizio) =' . $mese . ' AND YEAR(data_inizio) =' . $anno;
        $select = $this->select()
                ->where($query)
                ->order('id_auto');
        return $this->fetchAll($select);
    }
}