<?php
return array(
    'definition' => array(
        'class' => array(
            'Zf2FileUploader\Resource\Handler\Persister\Image\AggregatePersister' => array(
                'addPersister' => array(
                    array('type' => 'Zf2FileUploader\Resource\Handler\Persister\ImagePersisterInterface',
                          'required' => true)
                )
            ),

            'Zf2FileUploader\Resource\Handler\Remover\AggregateRemover' => array(
                'addRemover' => array(
                    array('type' => 'Zf2FileUploader\Resource\Handler\Remover\RemoverInterface',
                          'required' => true)
                )
            ),

            'Zf2FileUploader\Resource\Handler\Processor\Image\AggregateProcessor' => array(
                'addProcessor' => array(
                    array('type' => 'Zf2FileUploader\Resource\Handler\Processor\ImageProcessorInterface',
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

        'Zf2FileUploader\Service\Cleaner\ImageTemporaryCleaner' => array(
            'parameters'=> array(
                'remover' => 'Zf2FileUploader\Resource\Handler\Remover\AggregateRemover'
            )
        ),

        'Zf2FileUploader\Resource\Handler\Persister\Image\AggregatePersister' => array(
            'injections' => array(
                'Zf2FileUploader\Resource\Handler\Persister\Image\FilesystemPersister',
                'Zf2FileUploader\Resource\Handler\Persister\Image\DatabasePersister'
            )
        ),

        'Zf2FileUploader\Resource\Handler\Remover\AggregateRemover' => array(
            'injections' => array(
                'Zf2FileUploader\Resource\Handler\Remover\FilesystemRemover',
                'Zf2FileUploader\Resource\Handler\Remover\DatabaseRemover'
            )
        ),

        'Zf2FileUploader\Service\Image\SaveService' => array(
            'parameters' => array(
                'persister' => 'Zf2FileUploader\Resource\Handler\Persister\Image\AggregatePersister',
                'cleaner' => 'Zf2FileUploader\Service\Cleaner\ImageTemporaryCleaner'
            )
        ),

        'preference' => include __DIR__.'/di/preference.config.php'
    )
);
