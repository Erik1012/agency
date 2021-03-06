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
	protected $categoryTable;
	public function AdvertsAction()
      {
			$display_name="";
			if ($this->zfcUserAuthentication()->hasIdentity()) 
				{
					//echo 'loged in';
					$display_name = $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
					//echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
				}
			$message = "";
			if(isset($_POST['search_sub']))
				{
					$adverts = $this->get_adverts_table()->search_by_key($_POST['search_key']);
					$message = "Результат пошуку \"".$_POST['search_key']."\"";
				}
			else
				{
					$adverts = $this->get_adverts_table()->get_all();
				}
			//echo '<pre>';
			//$test = $this->get_adverts_table()->search_by_key("adv");
			//var_dump($test);
			//echo '</pre>';
			$category_id = $this->getEvent()->getRouteMatch()->getParam("category_id");
			$categories = $this->get_category_table()->get_all();
			return new ViewModel(array('adverts' => $adverts, 'user' => $display_name, "categories" => $categories, "message" => $message));
      }
   public function AdvertAction()
      {
         $display_name="";
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
			public function get_category_table()
            {
                if (!$this->categoryTable) {
                    $sm = $this->getServiceLocator();
                    $this->categoryTable = $sm->get('Application\Model\CategoryTable');
                }
                return $this->categoryTable;
            }
}
