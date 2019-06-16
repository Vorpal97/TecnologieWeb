<?php

class Application_Resource_Auto extends Zend_Db_Table_Abstract {

    protected $_name = 'auto';
    protected $_primary = 'id_auto';
    protected $_rowClass = 'Application_Resource_Auto_Item';

    public function init() {

    }

    public function addNewAuto($newauto)
    {
        $this->insert($newauto);
    }

    public function getAuto($paged = null) {

        $select = $this->select()
                ->where('prezzo != 0')
                ->order('marca');

        //peginator
        if (null !== $paged) { //se non è richiesta paginata saltiamo il blocco, e tramite una fetch all si ritorna il risultato della richiesta
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select); //definisce la  sorgente informativa
            $paginator = new Zend_Paginator($adapter); //oggetto che rappresenta i dati paginati
            //zend_paginator opera in modalità lazy, ritorna solo la pagina richiesta ma bufferizza tutte, così quando fa una richiesta ad un altra pagina non rifa tutto, potrebbero servirgli nelle chiamate successive, ottimizza l'accesso al db
            $paginator->setItemCountPerPage(5) //proprietà della paginazione, tuple estratte che vogliamo associare ad ogni pagina, c'è un unica scheda prodotto, lo si vede selezionando una sottocategoria
                    ->setCurrentPageNumber((int) $paged); //il secondo parametro è quello che rappresenta quella estratta, con l'operatore di casting int, questo perche il parametro deriva dalla rotta
            // acquisito dunque come stringa, invece il metodo vuole come parametro un intero
            return $paginator; //rappresenta la pagina iesima con i suoi contenuti
        }
        //fine paginator

        return $this->fetchAll($select);
    }

    public function getAutoByPrezzo($min, $max, $paged = null) {

        $query = $min . ' <=  prezzo AND prezzo <= ' . $max;
        $select = $this->select()
                ->where($query)
                ->order('marca');


        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(3)
                    ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
    }

    public function getAutoByPosti($posti) {

        $query = 'n_posti >= ' . $posti;
        $select = $this->select()
                ->where($query)
                ->order('marca');
        return $this->fetchAll($select);
    }

    public function getAutoByAll($min, $max, $posti, $paged=null) {
        $query = 'n_posti >= ' . $posti . ' AND ' . $min . ' <=  prezzo AND prezzo <= ' . $max;
        $select = $this->select()
                ->where($query)
                ->order('marca');

        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(3)
                    ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
    }

    public function getAutoById($id){
/* Modificato da Cucchiarelli: tolto il codice commentato e sostituito con un'unica istruzione
        $query = 'id_auto = ' . $id;
        $select = $this->select()
                       ->where($query);
        return $this->fetchAll($select);
*/
        return $this->find($id)->current();

    }

    public function editAuto($data, $id)
    {
        $this->update($data,'id_auto = ' .$id);
    }
    
    public function removeAuto($autoid)
    {
        $this->delete('id_auto = ' .$autoid);
    }
}
