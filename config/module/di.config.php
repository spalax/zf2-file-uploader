<?php
return array(
//    'definition' => array(
//        'class' => array(
//            'Zend\View\Resolver\AggregateResolver' => array(
//                'attach' => array(
//                    'resolver' => array('type' => 'Zend\View\Resolver\ResolverInterface',
//                                        'required' => true)
//                )
//            ),
//            'Zf2FileUploader\View\Renderer\UploaderRenderer' => array(
//                'setResolver' => array(
//                    'resolver' => array('type' => 'Zend\View\Resolver\ResolverInterface',
//                                        'required' => true)
//                )
//            )
//        )
//    ),
    'allowed_controllers' => array(
        // this config is required, otherwise the MVC won't even attempt to ask Di for the controller!
        'Zf2FileUploader\Controller\Images\CreateController'
    ),
    'instance' => array(
        'Zf2FileUploader\Service\TemporaryResourcesCleaner' => array(
            'parameters' => array(
                'remover' => 'Zf2FileUploader\Service\Remover\TemporaryResourceRemover'
            )
        ),
        'Zf2FileUploader\Request\CreateRequest' => array(
            'injections' => array(
                'Zend\Validator\Date'
            )
        ),

        'Zf2FileUploader\Controller\Images\CreateController' => array(
            'parameters' => array(
                'createResourceData' => 'Zf2FileUploader\InputData\CreateImageResourceData'
            )
        ),

        'preference' => array(
            'Zf2FileUploader\Options\TemporaryCleanerOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zf2FileUploader\Options\InputValidatorOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zend\EventManager\EventManagerInterface' => 'EventManager',
            'Zend\ServiceManager\ServiceLocatorInterface' => 'ServiceManager'
        )
    )
);
