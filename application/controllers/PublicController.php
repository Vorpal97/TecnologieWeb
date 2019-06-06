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

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get('log');
        $this->view->loginForm = $this->getLoginForm();
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_publicModel = new Application_Model_Public();
        $this->_faqModel = new Application_Model_Faq();
        $this->_authService = new Application_Service_Auth();
        $this->view->registerForm = $this->getRegisterForm();
    }

    public function indexAction()
    {
        $this->_logger->info('Attivato:    ' . __METHOD__);
        $this->view->azione = $this->getRequest()->getActionName();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione; //passa alla vista le informazione sul livello di permessi dell'utente
    }

    public function catalogAction()
    {
        $this->_logger->info('Attivato:    ' . __METHOD__);
        $this->view->azione = $this->getRequest()->getActionName();
        $this->view->livello = $this->_authService->getIdentity()->autenticazione; //passa alla vista le informazione sul livello di permessi dell'utente
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

    public function faqAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
        $this->_logger->info('Attivato:    ' . __METHOD__);
        $this->view->livello = $this->_authService->getIdentity()->autenticazione;

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
        $this->_publicModel->addUser($values);
        $this->_helper->redirector('login');
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
            $form->setDescription('Email o password errati, riprova.');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->autenticazione);
    }
}
