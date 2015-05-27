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

class AdvertsController extends AbstractActionController
{
	protected $advertTable;
	public function AdvertsAction()
      {
			if ($this->zfcUserAuthentication()->hasIdentity()) 
				{
					//echo 'loged in';
					$display_name = $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
					//echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
				}
			return new ViewModel(array('adverts' => $this->get_adverts_table()->get_all(), 'user' => $display_name));
      }
   public function AdvertAction()
      {
         if ($this->zfcUserAuthentication()->hasIdentity()) 
				{
					//echo 'loged in';
					$display_name = $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
					//echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
				}
			$advert_id = $this->getEvent()->getRouteMatch()->getParam("advert_id");
			$advert = $this->get_adverts_table()->get_advert($advert_id);
			$images = explode(",", $advert->pictures);
         return new ViewModel(array('advert' => $advert, 'images' => $images, 'user' => $display_name));
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
