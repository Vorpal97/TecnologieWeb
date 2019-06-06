<?php
class Zend_View_Helper_AuthInfo extends Zend_View_Helper_Abstract   //estrae un valore associato all'utente attualmente loggato
{   
    protected $_authService;

    public function authInfo ($info = null)     //prende come parametro un dato $info, che sarà la proprietà dell utente. Inizializzata a nulla se non specificato
    {
        if (null === $this->_authService) {
            $this->_authService = new Application_Service_Auth(); //crea un istanza di app_serv_aut
        }
        if (null === $info) {
            return;
        }
        if (false === $this->isLoggedIn()) { //loggedin ritorna true se è loggato l utente
            return;
        }
        return $this->_authService->getIdentity()->$info; //ritorniamo la componente $info dell'attuale utente loggato
    }

	public function isLoggedIn()
    {
        return $this->_authService->getAuth()->hasIdentity();      //se getauth ha qualcosa, faccio has identity che torna true
    }
}

