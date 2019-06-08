<?php

class AdminController extends Zend_Controller_Action
{

    protected $_faqform = null;
    protected $_faqModel = null;


    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->view->faqForm = $this->getFaqForm();
        $this->_faqModel = new Application_Model_Faq();

    }

    public function indexAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function managefaqAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
      $totFaq = $this->_faqModel->getFaq();

      foreach ($totFaq as $faq) {
        $faqList[] = $faq->id_faq;
      }
      $prods = $this->_faqModel->getFaq();

      $this->view->assign(array('products' => $prods));

    }

    public function rentstatsAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function usermanagerAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function staffmanagerAction()
    {
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    }

    public function logoutAction()
    {
      $this->_authService->logout();
      return $this->_helper->redirector('index','public');
    }

    private function getFaqForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_faqform  = new Application_Form_Admin_Faq_Add();
        $this->_faqform->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'authenticate'),
                    'default'
        ));
        return $this->_faqform;
    }

    public function addnewfaqAction()
    {
//        if (!$this->getRequest()->isPost()) {
//            $this->_helper->redirector('index');
//        }
//        $form = $this->_registerform;
//        if (!$form->isValid($_POST)) {
//            return $this->render('register');
//        }
//        $values = $form->getValues();
//        $this->_publicModel->addUser($values);
//        $this->_helper->redirector('login');
    }

}
