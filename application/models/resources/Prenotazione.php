<?php

class Application_Resource_Prenotazione extends Zend_Db_Table_Abstract {

    protected $_name = 'prenotazione';
    protected $_primary = 'id_prenotazione';
    protected $_rowClass = 'Application_Resource_Prenotazione_Item';

    public function init() {
        
    }

    public function getPrenotazioneByAuto($id) {
        $query = 'id_auto = ' . $id;
        $select = $this->select()
                ->where($query);
        
        return $this->fetchAll($select);
    }
    
    public function setPrenotazione ($data){
        $this->insert($data);
    }
    
    public function getPrenotazioni ($mese){
        $query = 'MONTH(data_inizio) =' . $mese;
        $select = $this->select()
                ->where($query)
                ->order('id_auto');
        
        return $this->fetchAll($select);
    }
}