<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Job\Controller\Job',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
           
                
            // action list company
            'company' => array(
		'type' => 'Literal',
		'options' => array(
			'route' => '/company',
			'defaults' => array(
                             '__NAMESPACE__' => 'Job\Controller',
				'controller' => 'Company',
				'action' => 'index',
			),
                ),
               'may_terminate' => true,
                'child_routes' => array(
                        // action company/register
			'register' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/register[/:action][/:id]',
					'constraints' => array(
                                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            'id'     => '[0-9]+',
					),
					'defaults' => array(
                                            'controller' => 'Job\Controller\Company',
                                            'action'     => 'register',
					),
				),
			),
                    //action company edit
                    'edit' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/edit[/:action][/:id]',
					'constraints' => array(
                                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            'id'     => '[0-9]+',
					),
					'defaults' => array(
                                            'controller' => 'Job\Controller\Company',
                                            'action'     => 'edit',
					),
				),
			),
                        // action company/add
			'add' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/add[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
					),
					'defaults' => array(
                                                'controller' => 'Job\Controller\Company',
						'action'     => 'add',
					),
				),
			),
                        // action company/ delete
			'delete' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/delete[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
					),
					'defaults' => array(
                                            'controller' => 'Job\Controller\Company',
                                            'action'     => 'delete',
					),
				),
			),
                        // action company/detail
                        'detail' => array(
                            'type'    => 'segment',
                            'options' => array(
                                    'route'    => '/detail[/:action][/:id]',
                                    'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
                                    ),
                                    'defaults' => array(
						'controller' => 'Job\Controller\Company',
						'action'     => 'detail',
                                    ),
				),
			),
                    
                    ),
            ),
            
             // action list category
            'category' => array(
		'type' => 'Literal',
		'options' => array(
			'route' => '/category',
			'defaults' => array(
                             '__NAMESPACE__' => 'Job\Controller',
				'controller' => 'Category',
				'action' => 'index',
			),
                ),
               'may_terminate' => true,
                'child_routes' => array(    
                    //action category edit
                    'edit' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/edit[/:action][/:id]',
					'constraints' => array(
                                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                            'id'     => '[0-9]+',
					),
					'defaults' => array(
                                            'controller' => 'Job\Controller\Category',
                                            'action'     => 'edit',
					),
				),
			),
                        // action category/add
			'add' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/add[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
					),
					'defaults' => array(
                                                'controller' => 'Job\Controller\Category',
						'action'     => 'add',
					),
				),
			),
                        // action category/ delete
			'delete' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/delete[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
					),
					'defaults' => array(
                                            'controller' => 'Job\Controller\Category',
                                            'action'     => 'delete',
					),
				),
			),
                    ),
            ),
        ),
      ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
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
            'Job\Controller\Company' => 'Job\Controller\CompanyController',
            'Job\Controller\Job' => 'Job\Controller\JobController',
            'Job\Controller\Category' => 'Job\Controller\CategoryController'
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
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
