<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel;

class ViewController extends AbstractActionController
{

	protected $postTable;

    public function getPostTable()
    {
        if (!$this->postTable) {
            $sm = $this->getServiceLocator();
            $this->postTable = $sm->get('Blog\Model\PostTable');
        }
        return $this->postTable;
    }

    public function indexAction()
    {
			if ($this->zfcUserAuthentication()->hasIdentity()) 
				{
					//echo 'loged in';
					$display_name = $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
					$user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
					//echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
				}
			else
				{
					$display_name = "";
					$user_id = 0;
				}
			return new ViewModel(array(
            'posts' => $this->getPostTable()->get_post_by_user($user_id), "user" => $display_name,
			));
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
}
