<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/home',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
				'home2' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
				'about' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/about',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Info',
                        'action'     => 'about',
                    ),
                ),
            ),
            'adverts' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/adverts[/:category_id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Adverts',
                        'action'     => 'adverts',
								'category_id'     => '0',
                    ),
                ),
            ),
             'advert' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/adverts/advert[/:advert_id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Adverts',
                        'action'     => 'advert',
                        'advert_id'     => '1',
                    ),
                ),
            ),
				'state1' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/state1',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Info',
                        'action'     => 'state1',
                    ),
                ),
            ),
				'state2' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/state2',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Info',
                        'action'     => 'state2',
                    ),
                ),
            ),
				'state3' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/state3',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Info',
                        'action'     => 'state3',
                    ),
                ),
            ),
				'state4' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/state4',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Info',
                        'action'     => 'state4',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            
         
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
		  'factories' => array(
				'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
			),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
				'Application\Controller\Info' => 'Application\Controller\InfoController',
            'Application\Controller\Adverts' => 'Application\Controller\AdvertsController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/adverts/adverts' => __DIR__ . '/../view/application/adverts/adverts.phtml',
				'application/info/about' => __DIR__ . '/../view/application/info/about.phtml',
				'application/info/state1' => __DIR__ . '/../view/application/info/state1.phtml',
				'application/info/state2' => __DIR__ . '/../view/application/info/state2.phtml',
				'application/info/state3' => __DIR__ . '/../view/application/info/state3.phtml',
				'application/info/state4' => __DIR__ . '/../view/application/info/state4.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
