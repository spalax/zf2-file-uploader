<?php
return array(
    'definition' => array(
        'class' => array(
            'Zf2FileUploader\Resource\Persister\AggregatePersister' => array(
                'addPersister' => array(
                    array('type' => 'Zf2FileUploader\Resource\Persister\PersisterInterface')
                )
            ),

            'Zf2FileUploader\Resource\Remover\AggregateRemover' => array(
                'addRemover' => array(
                    'remover' => array('type' => 'Zf2FileUploader\Resource\Remover\RemoverInterface',
                                       'required' => true)
                )
            )
        )
    ),

    'allowed_controllers' => array(
        // this config is required, otherwise the MVC won't even attempt to ask Di for the controller!
        'Zf2FileUploader\Controller\Images\CreateController'
    ),

    'instance' => array(

        'Zf2FileUploader\Resource\Persister\AggregatePersister' => array(
            'injections' => array(
                'Zf2FileUploader\Resource\Persister\FilesystemPersister',
                'Zf2FileUploader\Resource\Persister\DatabasePersister'
            )
        ),

        'Zf2FileUploader\Resource\Remover\AggregateRemover' => array(
            'injections' => array(
                'Zf2FileUploader\Resource\Remover\FilesystemRemover',
                'Zf2FileUploader\Resource\Remover\DatabaseRemover'
            )
        ),

        'Zf2FileUploader\Service\TemporaryResourcesCleaner' => array(
            'parameters' => array(
                'remover' => 'Zf2FileUploader\Resource\Remover\AggregateRemover'
            )
        ),

        'Zf2FileUploader\Service\Resource\SaveService' => array(
            'parameters' => array(
                'persister' => 'Zf2FileUploader\Resource\Persister\AggregatePersister'
            )
        ),

        'preference' => array(
            'Zf2FileUploader\Options\TemporaryCleanerOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zf2FileUploader\Options\InputValidatorOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zf2FileUploader\Options\PersisterOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zf2FileUploader\Resource\Handler\HandlerInterface' => array('Zf2FileUploader\Resource\Handler\AggregateHandler'),
            'Zend\EventManager\EventManagerInterface' => 'EventManager',
            'Zend\ServiceManager\ServiceLocatorInterface' => 'ServiceManager'
        )
    )
);
