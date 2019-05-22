<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

  protected $_logger;

  protected function _initLogging(){
    $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/log/log.log');
    $logger = new Zend_Log($writer);
    Zend_Registry::set('log', $logger);
    $this->_logger = $logger;
    $logger->info('Bootstrap ' .__METHOD__);
  }

}
