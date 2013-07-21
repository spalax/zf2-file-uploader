<?php
return array(
    'definition' => array(
        'class' => array(
            'Zf2FileUploader\Resource\Persister\AggregatePersister' => array(
                'addPersister' => array(
                    array('type' => 'Zf2FileUploader\Resource\Persister\PersisterInterface',
                          'required' => true)
                )
            ),

            'Zf2FileUploader\Resource\Remover\AggregateRemover' => array(
                'addRemover' => array(
                    array('type' => 'Zf2FileUploader\Resource\Remover\RemoverInterface',
                          'required' => true)
                )
            ),

            'Zf2FileUploader\Resource\Handler\AggregateHandler' => array(
                'addHandler' => array(
                    array('type' => 'Zf2FileUploader\Resource\Handler\HandlerInterface',
                          'required' => true)
                )
            )
        )
    ),

    'allowed_controllers' => array(
        // this config is required, otherwise the MVC won't even attempt to ask Di for the controller!
        'Zf2FileUploader\Controller\Images\CreateController',
        'Zf2FileUploader\Controller\Images\ListController'
    ),

    'instance' => array(

        'Zf2FileUploader\Service\Cleaner\ResourceTemporaryCleaner' => array(
            'parameters'=> array(
                'remover' => 'Zf2FileUploader\Resource\Remover\AggregateRemover'
            )
        ),

        'Zf2FileUploader\InputData\CreateImageResourceData' => array(
            'parameters' => array(
                'resourceFactory' => 'Zf2FileUploader\Resource\ResourceFactory'
            )
        ),

        'Zf2FileUploader\Controller\Images\CreateController' => array(
            'parameters' => array(
                'createResourceData' => 'Zf2FileUploader\InputData\CreateImageResourceData'
            )
        ),

        'Zf2FileUploader\Resource\Persister\AggregatePersister' => array(
            'injections' => array(
                'Zf2FileUploader\Resource\Persister\FilesystemPersister',
                'Zf2FileUploader\Resource\Persister\DatabasePersister',
                'Zf2FileUploader\Resource\Persister\Image\FilesystemPersister',
                'Zf2FileUploader\Resource\Persister\Image\DatabasePersister'
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
                'persister' => 'Zf2FileUploader\Resource\Persister\AggregatePersister',
                'cleaner' => 'Zf2FileUploader\Service\Cleaner\ResourceTemporaryCleaner'
            )
        ),

        'Zf2FileUploader\Service\Resource\HandleService' => array(
            'parameters' => array(
                'handler' => 'Zf2FileUploader\Resource\Handler\AggregateHandler'
            )
        ),

        'preference' => array(
            'Zf2FileUploader\Options\TemporaryCleanerOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zf2FileUploader\Options\InputValidatorOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zf2FileUploader\Options\PersisterOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zf2FileUploader\Options\ImageResourceOptionsInterface' => 'Zf2FileUploader\Options\ModuleOptions',
            'Zf2FileUploader\I18n\Translator\TranslatorInterface' => 'Zf2FileUploader\I18n\Translator\Translator',
            'Zend\EventManager\EventManagerInterface' => 'EventManager',
            'Zend\ServiceManager\ServiceLocatorInterface' => 'ServiceManager'
        )
    )
);
