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

    public function init()
    {
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
    }

    public function catalogAction()
    {
        $this->_logger->info('Attivato:    ' . __METHOD__);
        $this->view->azione = $this->getRequest()->getActionName();
        //parte per il db

        $prezzoMin = $this->_getParam('minimo', null);
        $prezzoMax = $this->_getParam('massimo', null);
        $numeroPosti = $this->_getParam('posti', null);

        $totAuto = $this->_catalogModel->getAuto();

        /*if (is_null($prezzoMin) && is_null($prezzoMax) && is_null($numeroPosti) && $prezzoMin == 0 && $prezzoMax == 0 && $numeroPosti == 0) {
            foreach ($totAuto as $auto) {
                $autoList[] = $auto->id_auto;
            }
            $prods = $this->_catalogModel->getAuto();
            $this->view->assign(array('products' => $prods));
        } else{
            $prods = $this->_catalogModel->getAutoByPrezzo($prezzoMin, $prezzoMax);
            $this->view->assign(array('products' => $prods));
         * 
        }*/
        if (/*!is_null($prezzoMin) && !is_null($prezzoMax) && !is_null($numeroPosti)*/ is_null($prezzoMin) && is_null($prezzoMax) && is_null($numeroPosti)){
            /*foreach ($totAuto as $auto) {
                $autoList[] = $auto->id_auto;
            }*/
            $prods = $this->_catalogModel->getAuto();
            $this->view->assign(array('products' => $prods));
        } else {
            $prods = $this->_catalogModel->getAutoByPrezzo($prezzoMin, $prezzoMax);
            $this->view->assign(array('products' => $prods));
        }

    }

    public function faqAction()
    {
        $this->view->azione = $this->getRequest()->getActionName();
        $this->_logger->info('Attivato:    '. __METHOD__);

        $totFaq= $this->_faqModel->getFaq();

        foreach ($totFaq as $faq){
            $faqList[] = $faq->id_faq;
        }
        $prods=$this->_faqModel->getFaq();

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
            $form->setDescription('Email o Password errati. Riprova');
            return $this->render('index');
        }
        if (false === $this->_authService->authenticate($form->getValues()))
        {
            $form->setDescription('Errore di autenticazione. Riprova');
            return $this->render('catalog');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->autenticazione);
    }


}


