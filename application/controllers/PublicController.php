<?php

class PublicController extends Zend_Controller_Action
{
    protected $_logger = null;
    protected $_registerform = null;
    protected $_loginform = null;
    protected $_catalogModel = null;
    protected $_publicModel = null;
    protected $_faqModel = null;
    protected $_authService = null;
    protected $_adminModel = null;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get('log');
        $this->view->loginForm = $this->getLoginForm();
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_publicModel = new Application_Model_Public();
        $this->_faqModel = new Application_Model_Faq();
        $this->_adminModel = new Application_Model_Admin();
        $this->_authService = new Application_Service_Auth();
        if($this->_authService->getAuth()->hasIdentity())
            {
                $this->view->livello = $this->_authService->getIdentity()->autenticazione;
            }
        $this->view->registerForm = $this->getRegisterForm();
    }

    public function indexAction()
    {
        $this->_logger->info('Attivato:    ' . __METHOD__);
        $this->view->azione = $this->getRequest()->getActionName();
    }

    public function catalogAction()
    {
        $this->_logger->info('Attivato:    ' . __METHOD__);
        $this->view->azione = $this->getRequest()->getActionName();
        //parte per il db

        $prezzoMin = $this->_getParam('minimo', null);
        $prezzoMax = $this->_getParam('massimo', null);
        $numeroPosti = $this->_getParam('posti', null);

        $paged = $this->_getParam('pagina', 1);
        //$totAuto = $this->_catalogModel->getAuto();

        if ((is_null($prezzoMin) && is_null($prezzoMax) && is_null($numeroPosti))||($prezzoMin==0 && $prezzoMax==9999 && $numeroPosti==0)) {
            $prods = $this->_catalogModel->getAuto($paged);
        } else if ($numeroPosti==0 && ($prezzoMin!=0 || $prezzoMax!=9999)) {
            $prods = $this->_catalogModel->getAutoByPrezzo($prezzoMin, $prezzoMax);
        } else if ($numeroPosti!=0 && $prezzoMin==0 && $prezzoMax==9999){
            $prods = $this->_catalogModel->getAutoByPosti($numeroPosti);
        } else {
            $prods = $this->_catalogModel->getAutoByAll($prezzoMin, $prezzoMax, $numeroPosti);
        }

        $this->view->assign(array('products' => $prods));
    }

    public function validateloginAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $loginform = new Application_Form_Public_Auth_Login();
        $response = $loginform->processAjax($_POST);
        if ($response !== null) {
        	   $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);
        }
    }

    public function validateregisterAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $registerform = new Application_Form_Public_Auth_Register();
        $response = $registerform->processAjax($_POST);
        if ($response !== null) {
        	   $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);
        }
    }

    public function faqAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
        $this->_logger->info('Attivato:    ' . __METHOD__);
        $totFaq = $this->_faqModel->getFaq();

        foreach ($totFaq as $faq) {
            $faqList[] = $faq->id_faq;
        }
        $prods = $this->_faqModel->getFaq();

        $this->view->assign(array('products' => $prods));
    }

    public function loginAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
        $this->_logger->info('Attivato:    ' . __METHOD__);
    }

    public function registerAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
        $this->_logger->info('Attivato:    ' . __METHOD__);
    }

    public function profileAction()
    {
        $this->_logger->info('Attivato:    ' . __METHOD__);
    }

    private function getLoginForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_loginform = new Application_Form_Public_Auth_Login();
        $this->_loginform->setAction($urlHelper->url(array(
                    'controller' => 'public',
                    'action' => 'authenticate'),
                    'default'
        ));
        return $this->_loginform;
    }

    public function addnewuserAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_registerform;
        if (!$form->isValid($_POST)) {
            return $this->render('register');
        }
        $values = $form->getValues();
        if (!is_null($this->_adminModel->getUser($values['username'])))
        {
            $form->setDescription('Username già in utilizzo.');
            $this->render('register');
        } else
            {
                $this->_publicModel->addUser($values);
                $this->_helper->redirector('login');
            }
    }

    private function getRegisterForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_registerform = new Application_Form_Public_Auth_Register();
        $this->_registerform->setAction($urlHelper->url(array(
                    'controller' => 'public',
                    'action' => 'addnewuser'), 'default', true
        ));
        return $this->_registerform;
    }

    public function authenticateAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost())
        {
            return $this->_helper->redirector('login');
        }
        $form = $this->_loginform;
        if (!$form->isValid($request->getPost()))
        {
            $form->setDescription('Dati non validi, riprova.');
            return $this->render('login');
        }
        if (false === $this->_authService->authenticate($form->getValues()))
        {
            $form->setDescription('Username o password errati, riprova.');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', 'public');
    }

    public function prenotazione(){
        $this->_logger->info('Attivato:    ' . __METHOD__);
        $this->view->azione = $this->getRequest()->getActionName();
    }
}
