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
                return new ViewModel(array(
                        'adverts' => $this->get_adverts_table()->get_all(),
                    ));
            }
        public function AdvertAction()
            {
                $advert_id = $this->getEvent()->getRouteMatch()->getParam("advert_id");
                return new ViewModel(array('advert_id' => $advert_id));
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
