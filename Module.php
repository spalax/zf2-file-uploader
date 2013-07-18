<?php
namespace Zf2FileUploader;

use Zf2FileUploader\Options\ModuleOptions;
use Zend\Di\Di;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\ModuleManager\Feature\InputFilterProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\Di\DiAbstractServiceFactory;
use Zend\ServiceManager\Di\DiInstanceManagerProxy;

class Module
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        /* @var $sm \Zend\ServiceManager\ServiceManager */
        $sm = $e->getApplication()->getServiceManager();

        /* @var $di \Zend\Di\Di */
        $di = $sm->get('di');

        $config = $sm->get('config');
        $options = new ModuleOptions(isset($config['uploader']) ?
                                           $config['uploader'] :
                                           array());

        $di->instanceManager()->addSharedInstance($options, 'Zf2FileUploader\Options\ModuleOptions');
        $di->instanceManager()->addSharedInstance($sm->get('Doctrine\ORM\EntityManager'),
                                                           'Doctrine\ORM\EntityManager');

        $di->instanceManager()->setTypePreference('Zf2FileUploader\Entity\ImageInterface',
                                                  array($options->getImageEntityClass()));

//        $inputFilterManager->addPeeringServiceManager($sm);
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
                )
            )
        );
    }
}
