<?php

class AdminController extends Zend_Controller_Action
{

  protected $_faqform = null;
  protected $_staffform = null;
  protected $_faqModel = null;
  protected $_adminModel = null;
  protected $_messageform = null;



  public function init()
  {
    /* Initialize action controller here */
    $this->_helper->layout->setLayout('main');
    $this->_authService = new Application_Service_Auth();
    $this->view->faqForm = $this->getFaqForm();
    $this->view->staffForm = $this->getStaffForm();
    $this->view->messageForm = $this->getMessageForm();
    $this->_faqModel = new Application_Model_Faq();
    $this->_adminModel = new Application_Model_Admin();


  }

  public function managefaqAction()
  {
    $this->view->azione = $this->getRequest()->getActionName();  
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
    $this->view->azione = $this->getRequest()->getActionName();  
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    $rents = $this->_adminModel->getRentsByMonth();
    $this->view->assign(array('rents' => $rents));

  }

  public function usermanagerAction()
  {
    $this->view->azione = $this->getRequest()->getActionName();  
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    $users = $this->_adminModel->getUserList();
    $this->view->assign(array('users' => $users));
  }

  public function staffmanagerAction()
  {
    $this->view->azione = $this->getRequest()->getActionName();  
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

  private function getMessageForm(){
    $urlHelper = $this->_helper->getHelper('url');
    $this->_messageform  = new Application_Form_Inbox_Send();
    return $this->_messageform;

  }

  public function addnewfaqAction(){
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
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
     $this->view->azione = $this->getRequest()->getActionName();
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

  }

  public function savefaqAction(){
    $faqId = $this->_getParam('faqid', null);
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    if($faqId == null){
      $this->_helper->redirector('index');
    }
    if (!$this->getRequest()->isPost()) {
      $this->_helper->redirector('index');
    }
    $form = $this->_faqform;
    if (!$form->isValid($_POST)) {
      return $this->render('managefaq');
    }
    $values = $form->getValues();
    $this->_adminModel->updateFaq($faqId, $values);
    $this->_helper->redirector('managefaq');
  }

  public function addnewstaffmemberAction(){
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
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

  public function removestaffmemberAction(){
    $userid = $this->_getParam('userid', null);
    if($userid != null){
      $this->_adminModel->removeStaff($userid);
      $this->_helper->redirector('staffmanager');
    }
  }

  public function editstaffmemberAction(){
    $this->view->azione = $this->getRequest()->getActionName();  
    $urlHelper = $this->_helper->getHelper('url');
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    $userid = $this->_getParam('userid', null);
    $member = $this->_adminModel->getStaffMemberById($userid);

    $editStaffForm = $this->_staffform;
    $editStaffForm->populate(array("nome" => $member[0]->nome, "cognome" => $member[0]->cognome, "username" => $member[0]->username, "psw" => $member[0]->psw));
    $editStaffForm->setAction($urlHelper->url(array(
      'controller' => 'admin',
      'action' => 'savemember',
      'userid' => $userid),
      'default'
    ));
    $this->view->form = $editStaffForm;

  }

  public function savememberAction(){
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    $userid = $this->_getParam('userid', null);

    if($userid == null){
        $this->_helper->redirector('index');
    }
    if (!$this->getRequest()->isPost()) {
      $this->_helper->redirector('index');
    }
    $form = $this->_staffform;
    if (!$form->isValid($_POST)) {
      return $this->render('staffmanager');
    }
    $values = $form->getValues();

    $this->_adminModel->updateStaff($userid,$values);

    $this->_helper->redirector('staffmanager');

  }

  public function toggleuserAction(){
      $userid = $this->_getParam('userid', null);
      if($userid != null){
        $user =  $this->_adminModel->getUserStatus($userid);
        switch($user['abilitato']){
          case 0: $this->_adminModel->setUserStatus($userid, 1); break;
          case 1: $this->_adminModel->setUserStatus($userid, 0); break;
        }
      }
      $this->_helper->redirector('usermanager');

  }

  public function removeuserAction(){
    $userid = $this->_getParam('userid', null);
    if($userid != null){
      $this->_adminModel->removeUser($userid);
      $this->_helper->redirector('usermanager');

    }
  }

  public function messaggiAction(){
    $this->view->azione = $this->getRequest()->getActionName();  
    $userid = $this->_getParam('userid', null);
    $urlHelper = $this->_helper->getHelper('url');
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    $this->view->senders = $this->_adminModel->getSender();
    if($userid != null){
      $messaggi = $this->_adminModel->getUserMessage($userid);
      $user = $this->_adminModel->getUserById($userid);
      $this->view->assign(array('messaggi' => $messaggi));
      $this->view->user = $user;
      $admin = $this->_adminModel->getAdmin();
      $this->view->admin = $admin;
      $this->_messageform->setAction($urlHelper->url(array(
        'controller' => 'admin',
        'action' => 'sendmessage',
        'destinatario' => $destinatario ),
        'default'
      ));

    }
  }

  public function sendmessageAction(){
    $destinatario = $this->_getParam('userid', null);
    $this->view->livello = $this->_authService->getIdentity()->autenticazione;
    if (!$this->getRequest()->isPost()) {
      $this->_helper->redirector('index');
    }
    $form = $this->_messageform;
    if (!$form->isValid($_POST)) {
      return $this->render('messaggi');
    }
    $values = $form->getValues();
    $admin = $this->_adminModel->getAdmin();
    $values['id_mittente'] = $admin['id_utente'];
    $values['id_destinatario'] = $destinatario;
    $this->_adminModel->sendMessage($values);
    $this->_helper->redirector('messaggi','admin',null,array('userid' => $destinatario));

  }

}
