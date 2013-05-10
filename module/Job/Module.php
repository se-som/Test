<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Job;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Job\Model\Category;
use Job\Model\CategoryTable;
use Job\Model\Subject;
use Job\Model\SubjectTable;
use Job\Model\Jobs;
use Job\Model\JobsTable;
use Job\Model\Jobcategory;
use Job\Model\JobcategoryTable;
use Job\Model\Percentage;
use Job\Model\PercentageTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
// Add these import statements:
    // getAutoloaderConfig() and getConfig() methods here

    // Add this method:
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Job\Model\CategoryTable' =>  function($sm) {
                    $tableGateway = $sm->get('CategoryTableGateway');
                    $table = new CategoryTable($tableGateway);
                    return $table;
                },
                'CategoryTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Category());
                    return new TableGateway('B_category', $dbAdapter, null, $resultSetPrototype);
                },
                 'Job\Model\SubjectTable' =>  function($sm) {
                    $tableGateway = $sm->get('SubjectTableGateway');
                    $table = new SubjectTable($tableGateway);
                    return $table;
                },
                'SubjectTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Subject());
                    return new TableGateway('B_subject', $dbAdapter, null, $resultSetPrototype);
                }, 
                'Job\Model\JobcategoryTable' =>  function($sm) {
                    $tableGateway = $sm->get('JobcategoryTableGateway');
                    $table = new JobcategoryTable($tableGateway);
                    return $table;
                },
                'JobcategoryTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Jobcategory());
                    return new TableGateway('B_jobcategory', $dbAdapter, null, $resultSetPrototype);
                },
                'Job\Model\JobsTable' =>  function($sm) {
                    $tableGateway = $sm->get('JobsTableGateway');
                    $table = new JobsTable($tableGateway);
                    return $table;
                },
                'JobsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Jobs());
                    return new TableGateway('B_jobs', $dbAdapter, null, $resultSetPrototype);
                }, 
                'Job\Model\PercentageTable' =>  function($sm) {
                    $tableGateway = $sm->get('PercentageTableGateway');
                    $table = new PercentageTable($tableGateway);
                    return $table;
                },
                'PercentageTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Percentage());
                    return new TableGateway('B_percentage', $dbAdapter, null, $resultSetPrototype);
                },   
            ),
        );
    }
}