<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function usertAction()
    {
        return new ViewModel();
    }
	 
	 public function registrationAction()
    {
        $user = new Application_Model_DbTable_Users();
        $form = new Application_Form_Registration();
        $this->view->form=$form;
        if($this->getRequest()->isPost()){
            if($form->isValid($_POST)){
                $user->insert($form->getValues());
                $this->_redirect('/');
					 //regisztralj be ez a legfontosabb azta pedig mar a tobbi menni fog magatol... vagy ha nem regisztralsz akkor adj puszikaaat 
            }
        }
    }

    public function loginAction()
    {
        $user = new Application_Model_DbTable_Users();
        $form = new Application_Form_Login();
        $this->view->form = $form;
        if($this->getRequest()->isPost()){
            if($form->isValid($_POST)){
                $data = $form->getValues();
                $auth = Zend_Auth::getInstance();
                $authAdapter = new Zend_Auth_Adapter_DbTable($user->getAdapter(),'users');
                $authAdapter->setIdentityColumn('nickname')
                            ->setCredentialColumn('password');
                $authAdapter->setIdentity($data['nickname'])
                            ->setCredential($data['password']);
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()){
                    $storage = new Zend_Auth_Storage_Session();
                    $storage->write($authAdapter->getResultRowObject());
                    $this->_redirect('/');
                } else {
                   $this->view->message = 'Login failed.';
                }         
            }
        }
    }

    public function logoutAction()
    {
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->_redirect('/');
    }
}
