<?php

class Application_Service_Auth
{
    protected $_adminModel;
    protected $_auth;
    
    public function __construct()
    {
        $this->_adminModel = new Application_Model_Admin();
    }
    
    private function getAuthAdapter($values)
    {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_table_Abstract::getDefaultAdapter(),
                'utente',
                'id_utente',
                'psw');
        $authAdapter->setIdentity($values['email']);
        $authAdapter->setCredential($values['psw']);
        return $authAdapter;
    }
    
    public function getAuth()
    {
        if (null === $this->_auth)
        {
            $this->_auth =Zend_Auth::getInstance();
        }
        return $this->_auth;
    }
    
    public function logout()
    {
        $this->getAuth()->clearIdentity();
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
    
    public function authenticate($credenziali) 
    {
        $adapter = $this->getAuthAdapter($credenziali);
        $auth = $this->getAuth();
        $result = $auth->authenticate($adapter);
        
        if(!$result->isValid())
        {
            return false;
        }
        $user = $this->_adminModel->getUser($credenziali['email']);
        $auth->getStorage()->write($user);
        return true;
    }
}
