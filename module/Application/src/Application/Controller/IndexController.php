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

class IndexController extends AbstractActionController
{
	protected $advertTable;
	protected $categoryTable;
    public function indexAction()
		{
			$display_name = "";
			if ($this->zfcUserAuthentication()->hasIdentity()) 
				{
					//echo 'loged in';
					$display_name = $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
					//echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
				}
			$res = $this->get_adverts_table()->get_all();
			$i = 0;
			foreach($res as $item)
				{
					$adverts[$i]['id'] = $item->id;
					$adverts[$i]['title'] = $item->title;
					$adverts[$i]['address'] = $item->address;
					$adverts[$i]['pictures'] = $item->pictures;
					$i++;
				}
			return new ViewModel(array('user' => $display_name, 'adverts' => $adverts, "count" => $i));
		}
	public function get_adverts_table()
      {
         if (!$this->advertTable) {
            $sm = $this->getServiceLocator();
            $this->advertTable = $sm->get('Application\Model\AdvertTable');
         }
         return $this->advertTable;
      }
}
