<?php

class Application_Service_Auth
{
    protected $_adminModel;
    protected $_auth;
    
    public function __construct()
    {
        $this->_adminModel = new Application_Model_Admin();
    }
    
    public function authenticate($credenzials) 
    {
        $adapter = $this->getAuthAdapter($credenzials);
        $auth = $this->getAuth();
        $result = $auth->authenticate($adapter);
        
        if(!$result->isValid())
        {
            return false;
        }
        $user = $this->_adminModel->getUser($credenzials['username']);
        $auth->getStorage()->write($user);
        return true;
    }
    
     public function getAuth()
    {
        if (null === $this->_auth)
        {
            $this->_auth = Zend_Auth::getInstance();
        }
        return $this->_auth;
    }
    
    public function logout()     //per il logout
    {
        $this->getAuth()->clearIdentity();  //cleariamo la variabile auth, azzera $session ecc.
    }
    
    public function getIdentity()   //per quando ci servono le caratteristiche dell'utente loggato memorizzato nell'applicazione    
    {
        $auth = $this->getAuth();
        if ($auth->hasIdentity())
        {
            return $auth->getIdentity();
        }
        return false;
    }
    
    
    
    private function getAuthAdapter($values)
    {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table_Abstract::getDefaultAdapter(),
                'utente',
                'username',
                'psw');
        $authAdapter->setIdentity($values['username']);
        $authAdapter->setCredential($values['psw']);
        return $authAdapter;
    }
     
}
