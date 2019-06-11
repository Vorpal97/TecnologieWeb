<?php

class AdminController extends Zend_Controller_Action
{

    protected $_faqform = null;
    protected $_staffform = null;
    protected $_faqModel = null;
    protected $_adminModel = null;



    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout->setLayout('main');
        $this->_authService = new Application_Service_Auth();
        $this->view->faqForm = $this->getFaqForm();
        $this->view->staffForm = $this->getStaffForm();
        $this->_faqModel = new Application_Model_Faq();
        $this->_adminModel = new Application_Model_Admin();


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
      $staffs = $this->_adminModel->getStaffList();

      $this->view->assign(array('staff' => $staffs));

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
                    'action' => 'addnewfaq'),
                    'default'
        ));
        return $this->_faqform;
    }

    private function getStaffForm(){
      $urlHelper = $this->_helper->getHelper('url');
      $this->_staffform  = new Application_Form_Admin_Manage_Staff();
      $this->_staffform->setAction($urlHelper->url(array(
                  'controller' => 'admin',
                  'action' => 'addnewstaffmember'),
                  'default'
      ));
      return $this->_staffform;

    }

    public function addnewfaqAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_faqform;
        if (!$form->isValid($_POST)) {
            return $this->render('managefaq');
        }
        $values = $form->getValues();
        $this->_adminModel->addFaq($values);
        $this->_helper->redirector('managefaq');
    }

    public function removefaqAction(){
      $faqId = $this->_getParam('faqid', null);
      if($faqId != null){
        $this->_adminModel->removeFaq($faqId);
        $this->_helper->redirector('managefaq');
      }
    }

    public function editfaqAction(){
      $urlHelper = $this->_helper->getHelper('url');
      $this->view->livello = $this->_authService->getIdentity()->autenticazione;
      $faqId = $this->_getParam('faqid', null);
      $faq = $this->_adminModel->getFaqById($faqId);

      $editFaqForm = $this->_faqform;
      $editFaqForm->populate(array("domanda" => $faq[0]->domanda, "risposta" => $faq[0]->risposta));
      $editFaqForm->setAction($urlHelper->url(array(
                  'controller' => 'admin',
                  'action' => 'savefaq',
                  'faqid' => $faqId),
                  'default'
      ));
      $this->view->form = $editFaqForm;

//      $this->view->faq = $faq;

    }

    public function savefaqAction(){
      $faqId = $this->_getParam('faqid', null);
      // remove old faq
      if($faqId != null){
        $this->_adminModel->removeFaq($faqId);
        // add new edited faq
        if (!$this->getRequest()->isPost()) {
          $this->_helper->redirector('index');
        }
        $form = $this->_faqform;
        if (!$form->isValid($_POST)) {
          return $this->render('managefaq');
        }
        $values = $form->getValues();
        $this->_adminModel->addFaq($values);
        $this->_helper->redirector('managefaq');
      }
    }

    public function addnewstaffmemberAction(){
      if (!$this->getRequest()->isPost()) {
          $this->_helper->redirector('index');
      }
      $form = $this->_staffform;
      if (!$form->isValid($_POST)) {
          return $this->render('staffmanager');
      }
      $values = $form->getValues();
      $this->_adminModel->addStaff($values);
      $this->_helper->redirector('staffmanager');

    }
}
