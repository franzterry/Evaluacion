<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Prueba;

use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Config\Reader\Ini;
use Zend\Mvc\MvcEvent;
use Zend\Config\Config;


class Module implements InitProviderInterface, ConfigProviderInterface, AutoloaderProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{
    public function init(ModuleManagerInterface $mm) {
        $events = $mm->getEventManager();
        $sharedEvents = $events->getSharedManager();

        $sharedEvents->attach('Zend\Mvc\Application', 'bootstrap', array($this, 'initConfig'));
    }
    
    public function initConfig(MvcEvent $e) {
        $application = $e->getApplication();
        $services = $application->getServiceManager();
        $services->setFactory('ConfigIniPrueba', function ($services) {
            $reader = new Ini();
            $data = $reader->fromFile(__DIR__ . '/config/config.ini');
            return new Config($data);
        });
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig() {
        return array();
    }

    public function getControllerConfig() {
        return array(
            'factories' => array(
                'Prueba\Controller\Prueba' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $config = $locator->get('ConfigIniPrueba');
                    $empleadoDao = $locator->get('Prueba\Model\EmpleadoDao');

                    $controller = new \Prueba\Controller\PruebaController($config);
                    $controller->setEmpleadoDao($empleadoDao);
                    return $controller;
                }
            )
        );
    }
}
